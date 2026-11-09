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
            (SELECT COUNT(*) FROM topics) AS total_topics;
    ";

    $link = createConnection();
    $result = mysqli_query($link, $sqlView);

    return createSmartyRecAssocArr($result)[0];
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
