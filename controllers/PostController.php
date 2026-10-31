<?php
/**
 * Контроллер постов
 */
include_once '../models/PostsModel.php';

function indexAction() {}

/**
 * Добавляет новый пост через AJAX
 * @return void
 */
function addAction() {
    $topicId = isset($_POST['topic_id']) ? $_POST['topic_id'] : false;
    $userId = isset($_SESSION['user']) ? $_SESSION['user']['id'] : false;
    $content = isset($_POST['content']) ? $_POST['content'] : false;
    $parentId = isset($_POST['parent_id']) ? $_POST['parent_id'] : false;

    if (empty($content)) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'errors' => ['content' => 'Вы ничего не написали']
        ]);
        exit();
    }

    $data = addPost($topicId, $userId, $content, !$parentId ?: $parentId);

    if (isset($data['errors'])) {
        http_response_code(400);
        echo json_encode([
            'success' => $data['success'],
            'errors' => $data['errors']
        ]);
        exit();
    } else {
        echo json_encode([
            'success' => $data['success'],
            'id' => $data['id']
        ]);
        exit();
    }
}