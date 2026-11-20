<?php
/**
 * Модель администрирования
 */
/**
 * Получаем количество записей пользователей, постов и тем
 * @return array
 */
function getData() {
    $sqlView = "
        SELECT
            (SELECT COUNT(*) FROM users) AS total_users,
            (SELECT COUNT(*) FROM posts) AS total_posts,
            (SELECT COUNT(*) FROM topics) AS total_topics
    ";

    $link = createConnection();
    $result = mysqli_query($link, $sqlView);

    return createSmartyRecAssocArr($result);
}

/**
 * Запись события
 * @param int|null $userId кто совершил действие (NULL = система/аноним)
 * @param string $type 'topic_created', 'post_created', 'user_registered', 'user_changed_data', 'user_banned', 'user_unbanned', 'topic_deleted', 'report_resolved'
 * @param int|null $objectId id топика/поста/жалобы, к которой относится событие
 * @param array $meta доп. данные: название топика, срок бана, причина
 * @return void
 */
function logActivity(?int $userId, string $type, ?int $objectId = null, array $meta = []): void {
    $link = createConnection();
    $stmt = mysqli_prepare($link,
        'INSERT INTO activity_log (user_id, type, object_id, meta) VALUES (?, ?, ?, ?)');
    $metaJson = $meta ? json_encode($meta, JSON_UNESCAPED_UNICODE) : null;
    mysqli_stmt_bind_param($stmt, 'isis', $userId, $type, $objectId, $metaJson);
    mysqli_stmt_execute($stmt);
}

/**
 * Запрос для ленты событий
 * @param int $limit
 * @param int $offset
 * @return array
 */
function getRecentActivity(int $limit = LIMIT_RECENT_ACTIVITY, int $offset = 0): array
{
    $sql = 'SELECT a.id, a.type, a.object_id, a.meta, a.created_at,
                   u.username
              FROM activity_log a
              LEFT JOIN users u ON a.user_id = u.id
          ORDER BY a.created_at DESC
             LIMIT ? OFFSET ?';
    $types = 'ii';
    $params = [$limit, $offset];

    $link = createConnection();
    $result = getDataFromDb($link, $sql, $types, $params);
    $activity = createSmartyRecAssocArr($result);
    foreach ($activity as &$row) {
        $row['meta'] = json_decode($row['meta'], true); // превращаем JSON в массив
    }

    return replaceDate($activity);
}

/**
 * Запрос для пагинации пользователей в админке
 * @param $page
 * @return array|bool
 */
function getPaginationUsers($page) {
    $link = createConnection();
    $types = '';
    $params = [];
//todo разработать логику пагинации
    // Считаем общее число записей
    $sql = "SELECT COUNT(*) AS total FROM users";

    $total = getDataFromDb($link, $sql, $types, $params);

    $total = createSmartyRecAssocArr($total)[0];

    $totalCount = $total['total'];
    $totalPages = max(1, (int)ceil($totalCount / PER_PAGE_POSTS));

    if ($page > $totalPages) {
        $page = $totalPages;
    } elseif ($page < 1) {
        $page = 1;
    }

    $offset = ($page - 1) * PER_PAGE_POSTS;

    $pageList = getPageList($page, $totalPages);

    return [
        'offset' => $offset,
        'totalPages' => $totalPages,
        'total' => $totalCount,
        'currentPage' => $page,
        'pageList' => $pageList
    ];
}

/**
 * Наложение бана
 * @param mysqli $link
 * @param int $targetUserId
 * @param int|null $adminId
 * @param string $reason
 * @param int|null $days
 * @return bool|array
 */
function banUser(int $targetUserId, ?int $adminId, string $reason, ?int $days = null)
{
    $expiresAt = $days === null ? null : date('Y-m-d H:i:s', strtotime("+{$days} days"));

    $link = createConnection();
    mysqli_begin_transaction($link);
    // 1. Вставляем запись в bans
    $sql = "INSERT INTO bans (user_id, admin_id, reason, expires_at) VALUES (?, ?, ?, ?)";
    $types = 'iiss';
    $params = [$targetUserId, $adminId, $reason, $expiresAt];
    $result = executeQuery($link, $sql, $types, $params);
    if (!$result) {
        mysqli_rollback($link);
        return false;
    }

    // 2. Обновляем флаг в users (для быстрых списков)
    $sql = "UPDATE users SET is_banned = 1 WHERE id = ?";
    $types = 'i';
    $params = [$targetUserId];
    $result = executeQuery($link, $sql, $types, $params);

    if (!$result) {
        mysqli_rollback($link);
        return false;
    }

    // 3. Запрашиваем имя забаненого
    $sql = "SELECT username FROM users WHERE id = ?";
    $types = 'i';
    $params = [$targetUserId];
    $result = getDataFromDb($link, $sql, $types, $params);

    mysqli_commit($link);
    return createSmartyRecAssocArr($result)[0];
}

/**
 * Снятие бана
 * @param mysqli $link
 * @param int $userId
 * @return bool|array
 */
function unbanUser(int $userId) {
    $link = createConnection();

    mysqli_begin_transaction($link);
    // Помечаем бан как неактивный (история остаётся)
    $sql = "UPDATE bans SET is_active = 0 WHERE user_id = ? AND is_active = 1";
    $types = 'i';
    $params = [$userId];
    $ok1 = executeQuery($link, $sql, $types, $params);
    if (!$ok1) {
        mysqli_rollback($link);
        return false;
    }

    // Снимаем флаг
    $sql = "UPDATE users SET is_banned = 0 WHERE id = ?";
    $ok2 = executeQuery($link, $sql, $types, $params);
    if (!$ok2) {
        mysqli_rollback($link);
        return false;
    }

    mysqli_commit($link);

    // Запрашиваем имя разбаненого
    $sql = "SELECT username FROM users WHERE id = ?";
    $result = getDataFromDb($link, $sql, $types, $params);

    return createSmartyRecAssocArr($result)[0];
}

/**
 * Проверка бана
 * @param array $users массив пользователей
 */
function checkBanned(array $users): void {
    foreach ($users as $user) {
        if ($user['is_banned'] === 1 && !is_null($user['ban_expires_at']) && $user['ban_expires_at'] < date('Y-m-d H:i:s')) {
            $result = unbanUser($user['id']);
            logActivity(null, 'user_unbanned', null, [
                'nickname' => $result['username']
            ]);
        }
    }
}