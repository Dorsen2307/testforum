<?php
/**
 * Модель тем
 */
/**
 * Запрос всех тем или по id категории
 * @return bool|mysqli
 */
function getAllTopics($offset, $id=null) {
    $link = createConnection();

    if ($id !== null) {
        $sql = "SELECT t.*, u.username 
                FROM topics t 
                INNER JOIN users u ON t.user_id = u.id 
                WHERE t.category_id = ? AND t.is_active = 1 
                ORDER BY t.id DESC
                LIMIT ? OFFSET ?";

        $types = 'iii';
        $param = [$id, PER_PAGE, $offset];
    } else {
        $sql = "SELECT t.*, u.username 
                FROM topics t 
                INNER JOIN users u ON t.user_id = u.id 
                WHERE t.is_active = 1
                ORDER BY t.id DESC
                LIMIT ? OFFSET ?";

        $types = 'ii';
        $param = [PER_PAGE, $offset];
    }

    $stmt = mysqli_prepare($link, $sql); // создаем подготовленный объект statement для обработки
    if (!$stmt) {
        mysqli_stmt_close($stmt);
        return false;
    }

    mysqli_stmt_bind_param($stmt, $types, ...$param); // Привязываем значение: i = integer

    $exec = mysqli_stmt_execute($stmt); // Выполняем подготовленное выражение
    if (!$exec) {
        mysqli_stmt_close($stmt);
        return false;
    }
    $result = mysqli_stmt_get_result($stmt); // Получаем результат запроса
    mysqli_stmt_close($stmt); // Закрываем statement

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
 * @return bool|mysqli
 */
function getTopicWithPosts($topicId) {
    $link = createConnection();
    $sql = "SELECT 
                t.id AS topic_id,
                t.title AS topic_title,
                t.content AS topic_content,
                t.category_id,
                t.created_at AS topic_created,
                tu.username AS topic_author,
                
                p.id AS post_id,
                p.parent_id,
                p.content AS post_content,
                p.created_at AS post_created,
                pu.username AS post_author
            FROM topics t
            JOIN users tu ON t.user_id = tu.id
            LEFT JOIN posts p ON p.topic_id = t.id
            LEFT JOIN users pu ON p.user_id = pu.id
            WHERE t.id = ? AND t.is_active = 1
            ORDER BY p.created_at ASC";

    $stmt = mysqli_prepare($link, $sql);
    if (!$stmt) {
        mysqli_stmt_close($stmt);
        return false;
    }
    mysqli_stmt_bind_param($stmt, 'i', $topicId);
    $exec = mysqli_stmt_execute($stmt);
    if (!$exec) {
        mysqli_stmt_close($stmt);
        return false;
    }

    $result = mysqli_stmt_get_result($stmt);
    if (!$result) {
        mysqli_stmt_close($stmt);
        return false;
    }
    $rows = createSmartyRecAssocArr($result);
    mysqli_stmt_close($stmt);

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
                'parent_id' => (int)$row['parent_id'],
                'content' => $row['post_content'],
                'created_at' => $row['post_created'],
                'author' => $row['post_author']
            ];
        }
    }

    return ['topic' => $topic, 'posts' => $posts];
}

/**
 * Запрос offset для пагинации
 * @param $link
 * @param $page
 * @return array
 */
function getPagination($page, $catId=null) {
    $link = createConnection();
    // Считаем общее число записей
    $sql = "SELECT COUNT(*) AS total FROM topics WHERE is_active = 1";
    if ($catId !== null) {
        $sql .= " AND category_id = ?";
    }
    $stmt = mysqli_prepare($link, $sql);
    if (!$stmt) {
        mysqli_stmt_close($stmt);
        return false;
    }
    if ($catId !== null) {
        mysqli_stmt_bind_param($stmt, 'i', $catId);
    }

    $exec = mysqli_stmt_execute($stmt);
    if (!$exec) {
        mysqli_stmt_close($stmt);
        return false;
    }
    $total = mysqli_stmt_get_result($stmt);
    $total = createSmartyRecAssocArr($total)[0];
    mysqli_stmt_close($stmt);

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