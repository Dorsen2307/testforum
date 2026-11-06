<?php
/**
 * Модель тем
 */
/**
 * Запрос всех тем или по id категории
 * @return bool|array
 */
function getAllTopics($offset, $catId=null, $userId=null) {
    $link = createConnection();
    $types = '';
    $params = [];

    $sql = "SELECT t.*";

    if ($userId === null) {
        $sql .= ", u.username";
    }

    $sql .= " FROM topics t";

    if ($userId === null) {
        $sql .= " INNER JOIN users u ON t.user_id = u.id ";
    }

    $sql .= " WHERE t.is_active = 1";

    if ($userId !== null) {
        $sql .= " AND t.user_id = ? ";
        $types .= 'i';
        $params[] = $userId;
    }

    if ($catId !== null) {
        $sql .= " AND t.category_id = ?";
        $types .= 'i';
        $params[] = $catId;
    }

    $sql .= " ORDER BY t.id DESC
             LIMIT ? OFFSET ?";
    $types .= 'ii';

    array_push($params, PER_PAGE_TOPICS, $offset);

    $result = getDataFromDb($link, $sql, $types, $params);

    if (!$result) return false;
    return createSmartyRecAssocArr($result);
}

/**
 * Проверка параметров для создания темы
 * @param $title string заголовок темы
 * @param $content string сообщение
 * @param $categoryId string id категории
 * @return array результат - ассоциативный массив
 */
function checkCreateTopicParams($title, $content, $categoryId) {
    $errors = [];
    $title = checkInput($title);
    $content = checkInput($content);

    if (!$title) {
        $errors['title'] = 'Введите заголовок темы';
    } elseif (strlen($title) > 250) {
        $errors['title'] = 'Заголовок должен быть не более 250 символов';
    }

    if (!$content) {
        $errors['content'] = 'Введите текст сообщения';
    }

    if (!$categoryId) {
        $errors['category_id'] = 'Выберите категорию';
    }

    return $errors;
}

/**
 * Записывает новую тему в БД
 * @param $category_id integer id категории
 * @param $user_id integer id пользователя
 * @param $title string заголовок темы
 * @param $content string сообщение темы
 * @return bool|mysqli_result
 */
function createNewTopic($categoryId, $userId, $title, $content, $postCount) {
    $link = createConnection();
    $isActive = 1;
    $sql = "INSERT INTO topics (category_id, user_id, title, content, post_count, is_active) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($link, $sql); // Создаем объект statement для обработки
    if (!$stmt) {
        mysqli_stmt_close($stmt);
        return false;
    }
    mysqli_stmt_bind_param($stmt, 'iissii', $categoryId, $userId, $title, $content, $postCount, $isActive); // Привязываем значения
    $exec = mysqli_stmt_execute($stmt); // Выполняем запрос
    if (!$exec) {
        mysqli_stmt_close($stmt);
        return false;
    }
    $result = mysqli_stmt_insert_id($stmt); // Достаем id результата
    mysqli_stmt_close($stmt);
    return $result;
}

/**
 * Запрос постов по id темы
 * @return bool|array
 */
function getTopicWithPosts($offset, $topicId) {
    $link = createConnection();
    $sql = "SELECT 
                t.id AS topic_id,
                t.title AS topic_title,
                t.content AS topic_content,
                t.category_id,
                t.created_at AS topic_created,
                tu.username AS topic_author,
                
                p.id AS post_id,
                p.content AS post_content,
                p.created_at AS post_created,
                pu.id AS author_id,
                pu.username AS post_author
            FROM topics t
            JOIN users tu ON t.user_id = tu.id
            LEFT JOIN posts p ON p.topic_id = t.id
            LEFT JOIN users pu ON p.user_id = pu.id
            WHERE t.id = ? AND t.is_active = 1
            ORDER BY p.created_at ASC
            LIMIT ? OFFSET ?";

    $types = 'iii';
    $params = [$topicId, PER_PAGE_POSTS, $offset];

    $result = getDataFromDb($link, $sql, $types, $params);
    if (!$result) {
        return false;
    }
    $rows = createSmartyRecAssocArr($result);

    if (empty($rows)) {
        return ['topic' => null, 'posts' => []];
    }

    // Формируем структуру: один объект темы + массив постов
    $firstPost = $rows[0];
    $topic = [
        'id' => (int)$firstPost['topic_id'],
        'title' => $firstPost['topic_title'],
        'content' => $firstPost['topic_content'],
        'category_id' => (int)$firstPost['category_id'],
        'author' => $firstPost['topic_author'],
        'created_at' => $firstPost['topic_created']
    ];

    $posts = [];
    foreach ($rows as $row) {
        // Пост может быть NULL, если LEFT JOIN не нашёл ни одного (тема пустая)
        if ($row['post_id'] !== null) {
            $posts[] = [
                'id' => (int)$row['post_id'],
                'content' => $row['post_content'],
                'created_at' => $row['post_created'],
                'author_id' => $row['author_id'],
                'author' => $row['post_author']
            ];
        }
    }

    return ['topic' => $topic, 'posts' => $posts];
}

/**
 * Запрос offset для пагинации тем по id категории или пользователя
 * @param $page
 * @param $catId
 * @param $userId
 * @return array|bool
 */
function getPaginationTopics($page, $catId=null, $userId=null) {
    $link = createConnection();
    $types = '';
    $params = [];

    // Считаем общее число записей
    $sql = "SELECT COUNT(*) AS total FROM topics WHERE is_active = 1";
    if ($catId !== null) {
        $sql .= " AND category_id = ?";
        $types .= 'i';
        $params[] = $catId;
    }
    if ($userId !== null) {
        $sql .= " AND user_id = ?";
        $types .= 'i';
        $params[] = $userId;
    }

    $total = getDataFromDb($link, $sql, $types, $params);

    if (!$total) {
        return false;
    }
    $total = createSmartyRecAssocArr($total)[0];

    $totalPages = max(1, (int)ceil($total['total'] / PER_PAGE_TOPICS));

    if ($page > $totalPages) {
        $page = $totalPages;
    }

    $offset = ($page - 1) * PER_PAGE_TOPICS;

    return [
        'offset' => $offset,
        'totalPages' => $totalPages
    ];
}