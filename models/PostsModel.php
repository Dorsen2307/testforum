<?php
/**
 * Модель постов
 */

/**
 * Добавляет пост в БД
 * @param $topicId
 * @param $userId
 * @param $content
 * @param $parentId
 * @return array|false[]
 */
function addPost($topicId, $userId, $content, $parentId = null) {
    // Валидация длины текста
    $content = trim($content);
    if (mb_strlen($content) < 5) {
        return [
            'success' => false,
            'errors' => ['content' => 'Сообщение слишком короткое']
        ];
    }

    $link = createConnection();
    // Вставляем пост
    $sqlInsert = "INSERT INTO posts (topic_id, user_id, content, parent_id) VALUES (?, ?, ?, " . ($parentId ? '?' : 'NULL') . ")";
    $stmtInsert = mysqli_prepare($link, $sqlInsert);
    if (!$stmtInsert) {
        return [
            'success' => false,
            'errors' => ['content' => 'Ошибка запроса на добавление сообщения']
        ];
    }

    if ($parentId) {
        mysqli_stmt_bind_param($stmtInsert, "iisi", $topicId, $userId, $content, $parentId);
    } else {
        mysqli_stmt_bind_param($stmtInsert, "iis", $topicId, $userId, $content);
    }

    $execInsert = mysqli_stmt_execute($stmtInsert);

    // Увеличиваем счетчик в теме
    $sqlUpdate = "UPDATE topics SET post_count = post_count + 1 WHERE id = ?";
    $stmtUpdate = mysqli_prepare($link, $sqlUpdate);
    if (!$stmtUpdate) {
        return [
            'success' => false,
            'errors' => ['content' => 'Ошибка запроса на увеличение счетчика в теме']
        ];
    }
    mysqli_stmt_bind_param($stmtUpdate, "i", $topicId);
    $execUpdate = mysqli_stmt_execute($stmtUpdate);

    if ($execInsert && $execUpdate) {
        $newId = mysqli_stmt_insert_id($stmtInsert);
        mysqli_stmt_close($stmtInsert);
        mysqli_stmt_close($stmtUpdate);
        return [
            'success' => true,
            'id' => $newId];
    } else {
        mysqli_stmt_close($stmtInsert);
        mysqli_stmt_close($stmtUpdate);
        return [
            'success' => false,
            'errors' => ['content' => 'Ошибка сохранения поста']
        ];
    }
}

/**
 * Запрос offset для пагинации постов
 * @param $link
 * @param $page
 * @return array
 */
function getPaginationPosts($page, $topId) {
    $link = createConnection();
    // Считаем общее число записей
    $sql = "SELECT COUNT(*) AS total FROM posts WHERE topic_id = ?";
    $types = 'i';
    $params = [$topId];
    $total = getDataFromDb($link, $sql, $types, $params);

    $total = createSmartyRecAssocArr($total)[0];

    $totalPages = max(1, (int)ceil($total['total'] / PER_PAGE));

    if ($page > $totalPages) {
        $page = $totalPages;
    }

    $offset = ($page - 1) * PER_PAGE;

    return [
        'offset' => $offset,
        'totalPages' => $totalPages
    ];
}