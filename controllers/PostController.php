<?php
/**
 * Контроллер постов
 */
include_once '../models/PostsModel.php';
include_once '../models/TopicsModel.php';
include_once '../models/AdminModel.php';

function indexAction() {}

/**
 * Добавляет новый пост через AJAX
 * @return void
 */
function addAction() {
    $topicId = isset($_POST['topic_id']) ? $_POST['topic_id'] : false;
    $userId = isset($_SESSION['user']) ? $_SESSION['user']['id'] : false;
    $userName = isset($_SESSION['user']) ? $_SESSION['user']['username'] : false;
    $content = isset($_POST['content']) ? $_POST['content'] : false;

    if (empty($content)) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'errors' => ['content' => 'Вы ничего не написали']
        ]);
        exit();
    }

    $data = addPost($topicId, $userId, $content);

    if (isset($data['errors'])) {
        http_response_code(400);
        echo json_encode([
            'success' => $data['success'],
            'errors' => $data['errors']
        ]);
        exit();
    } else {
        $topic = getAllTopics(0, null, null, $topicId)[0];
        logActivity($userId, 'post_created',$data['id'], [
            'nickname' => $userName,
            'topicName' => $topic['title']
        ]);

        echo json_encode([
            'success' => $data['success'],
            'id' => $data['id']
        ]);
        exit();
    }
}