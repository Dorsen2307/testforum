<?php
/**
 * Контроллер тем
 */
include_once '../models/TopicsModel.php';
include_once '../models/PostsModel.php';
include_once '../models/CAtegoriesModel.php';
/**
 * Метод формирования страницы темы
 * @param $smarty
 */
function indexAction($smarty) {
    $topicId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    $arrUser = isset($_SESSION['user']) ? $_SESSION['user'] : false;

    if ($topicId <= 0) {
        Header("Location: /");
        exit;
    }

    $data = getTopicWithPosts($topicId);

    if (!$data['topic']) {
        // Тема не найдена
        http_response_code(404);
        $smarty->assign('errorMessageTopic', "Тема не найдена");
        loadTemplate($smarty, 'index');
    }

    if ($data['topic']) $data['topic'] = replaceDate($data['topic']);
    if ($data['posts']) $data['posts'] = replaceDate($data['posts']);


    $smarty->assign('arrUser', $arrUser);
    $smarty->assign('topic', $data['topic']);
    $smarty->assign('posts', $data['posts']);
    loadTemplate($smarty, 'topic');
}

/**
 * Создание новой темы
 * @param $smarty
 * @return void
 */
function createtopicAction() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        echo json_encode([
            'success' => false,
            'message' => 'Неверный метод запроса'
        ]);
        exit;
    }
    $title = isset($_POST['title']) ? trim($_POST['title']) : '';
    $content = isset($_POST['content']) ? trim($_POST['content']) : '';
    $categoryId = isset($_POST['category_id']) ? intval($_POST['category_id']) : null;
    $userId = isset($_SESSION['user']) ? intval($_SESSION['user']['id']) : null;
    // todo - доработать обработку токена

    $errors = checkCreateTopicParams($title, $content, $categoryId);

    if (!empty($errors)) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'errors' => $errors,
            'message' => 'Введенные данные не прошли проверку'
        ]);
        exit;
    }

    $result = createNewTopic($categoryId, $userId, $title, $content, 0);
    if ($result) {
        echo json_encode([
            'topicId' => $result,
            'success' => true,
            'message' => 'Тема успешно создана!'
        ]);
        exit;
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Ошибка создания темы. Попробуйте позже.'
        ]);
        exit;
    }
}

/**
 * Метод формирования формы создания новой темы
 * @param $smarty
 */
function templatecreatetopicAction($smarty) {
    $arrUser = (isset($_SESSION['user'])) ? $_SESSION['user'] : false;
    if ($arrUser) {
//        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
//            if (empty($_SESSION['csrf_token'])) {
//                $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
//            }
//            $smarty->assign('csrf_token', $_SESSION['csrf_token']);
//        }

        $allCategories = getAllCategories();

        $smarty->assign('pageTitle', "Создание темы");
        $smarty->assign('allCategories', $allCategories);
        $smarty->assign('flagCreateTopic', true);
        $smarty->assign('arrUser', $arrUser);

        loadTemplate($smarty, "createtopic");
    } else {
        redirect("/");
    }
}
