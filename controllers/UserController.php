<?php
/**
 * Контроллер пользователя
 */
include_once '../models/UsersModel.php';
include_once '../models/TopicsModel.php';
include_once '../models/PostsModel.php';
include_once '../models/AdminModel.php';
/**
 * Формирование профиля пользователя
 * @param $smarty object
 */
function indexAction($smarty) {
    $arrUser = isset($_SESSION['user']) ? $_SESSION['user'] : null;
    if (!$arrUser) {
        redirect("/");
    }
    $otherUserId = isset($_GET['user_id']) ? $_GET['user_id'] : null;
    $tab = isset($_GET['tab']) ? $_GET['tab'] : 'about';
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $isCurrentUser = false; // Это чужой профиль
    $allTopics = [];
    $allPosts = [];

    if (!$otherUserId || (int)$arrUser['id'] === (int)$otherUserId) {
        $isCurrentUser = true; // Это наш профиль
        $userId = $arrUser['id'];
        $arrUser['roleName'] = replaceRoleToName($arrUser['role']);
        $smarty->assign('arrProfile', $arrUser);
        if ($arrUser['role'] === 'admin') {
            $smarty->assign('isAdmin', true);
        }
    } else {
        $userId = $otherUserId;
        $arrOtherUser = getUserById($otherUserId);
        $arrOtherUser['roleName'] = replaceRoleToName($arrOtherUser['role']);
        $smarty->assign('arrProfile', $arrOtherUser);
    }

    if ($tab == 'topics') {
        $pagination = getPaginationTopics($page, null, $userId);
        if ($pagination) {
            $allTopics = getAllActiveTopics($pagination['offset'], null, $userId);
            $allTopics = replaceDate($allTopics);
        }
        $smarty->assign('userId', $userId);
        $smarty->assign('allTopics', $allTopics);
        $smarty->assign('pagination', $pagination);
    }

    if ($tab == 'posts') {
        $pagination = getPaginationPosts($page, null, $userId);
        if ($pagination) {
            $allPosts = getAllPosts($pagination['offset'], null, $userId);
            $allPosts = replaceDate($allPosts);
        }
        $smarty->assign('userId', $userId);
        $smarty->assign('posts', $allPosts);
        $smarty->assign('pagination', $pagination);
    }

    $arrUser['displayName'] = $arrUser['username'];

    $smarty->assign('arrUser', $arrUser);
    $smarty->assign('isCurrentUser', $isCurrentUser);
    $smarty->assign('isProfile', true);
    $smarty->assign('tab', $tab);
    $smarty->assign('pageTitle', 'Профиль');

    loadTemplate($smarty, 'profile');
}

/**
 * Открытие формы регистрации пользователя
 * @param $smarty
 */
function templateregistrationAction($smarty) {
    if (!isset($_SESSION['user'])) {
        $user = getUsers(1);
        if (!$user)  { // Если пользователей еще не зарегистрировано
            $smarty->assign('role', ROLE[1]); // Назначаем роль администратора
        }

        $smarty->assign('flagReg', true);
        loadTemplate($smarty, 'registration');
    }
}

/**
 * Открытие формы авторизации пользователя
 */
function templateauthAction($smarty) {
    if (!isset($_SESSION['user'])) {
        $smarty->assign('flagAuth', true);
        loadTemplate($smarty, 'authorization');
    }
}

/**
 * AJAX регистрация пользователя
 */
function registrationAction() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        echo json_encode([
            'success' => false,
            'message' => 'Неверный метод запроса'
        ]);
        exit;
    }
    $userName = isset($_POST['userName']) ? trim($_POST['userName']) : '';
    $role = isset($_POST['role']) ? trim($_POST['role']) : null;
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $confirmPassword = isset($_POST['confirmPassword']) ? $_POST['confirmPassword'] : '';

    $errors = checkRegisterParams($userName, $email, $password, $confirmPassword);

    if (!empty($errors)) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'Введенные данные не прошли проверку',
            'errors' => $errors
        ]);
        exit;
    }

    $pwHash = password_hash($password, PASSWORD_BCRYPT);
    $role = !is_null($role) ? $role : 'user';
    $userData = registrationNewUser($userName, $email, $pwHash, $role );

    if ($userData['success']) {
        $userData = $userData[0];
        $userName = $userData['username'] ?: $userData['email'];
        $_SESSION['user'] = $userData;
        $_SESSION['user']['displayName'] = $userName;
        $_SESSION['user']['role'] = $role;

        logActivity($userData['id'], 'user_registered',null, [
            'nickname' => $userData['username']

        ]);

        echo json_encode([
            'success' => true,
            'message' => 'Регистрация успешна!',
            'userName' => $userName
        ]);
        exit;
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Ошибка регистрации. Попробуйте позже.'
        ]);
        exit;
    }
}

/**
 * AJAX авторизация пользователя
 */
function authorizationAction() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        echo json_encode([
            'success' => false,
            'message' => 'Неверный метод запроса'
        ]);
        exit;
    }
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    $errors = checkAuthParams($email, $password);

    if (!empty($errors)) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'Введенные данные не прошли проверку',
            'errors' => $errors
        ]);
        exit;
    }

    $userData = loginUser($email);

    if ($userData['success'] && password_verify($password, $userData[0]['password_hash'])) {
        $userData = $userData[0];

        $link = createConnection();
        $banInfo = isUserBanned($link, $userData['id']);
        if ($banInfo['banned']) {
            echo json_encode([
                'success' => false,
                'message' => "Вы заблокированы: {$banInfo['reason']}. Срок: " . ($banInfo['expires_at'] ?? 'навсегда')
            ]);
            exit;
        }

        $userName = $userData['username'];
        $_SESSION['user'] = $userData;
        $_SESSION['user']['displayName'] = $userName;
        // обновляем дату входа
        updateLastLogin($userData['id']);

        echo json_encode([
            'success' => true,
            'message' => 'Авторизация успешна!',
            'userName' => $userName
        ]);
        exit;
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Ошибка регистрации. Попробуйте позже.'
        ]);
        exit;
    }
}

/**
 * Разлогинирование пользователя
 */
function logoutAction() {
    if (isset($_SESSION['user'])) {
        unset($_SESSION['user']);
    }
    redirect("/");
}

/**
 * Обновление данных пользователя
 * @return void
 */
function updateuserdataAction() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        echo json_encode([
            'success' => false,
            'message' => 'Неверный метод запроса'
        ]);
        exit;
    }

    $id = isset($_SESSION['user']['id']) ? intval($_SESSION['user']['id']) : 0;
    $oldDataUser = getUserById($id);
    $username = isset($_POST['login']) ? $_POST['login'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $about = isset($_POST['about']) ? $_POST['about'] : '';
    $photo = isset($_FILES['photo']) ? $_FILES['photo'] : [];

    $errors = checkProfileParams($username, $email, $password, $photo);

    if (!empty($errors)) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'Введенные данные не прошли проверку',
            'errors' => $errors
        ]);
        exit;
    }

    $pwdHash = $password == '' ? '' : password_hash($password, PASSWORD_BCRYPT);

    $userData = updateUser($id, $username, $email, $password, $pwdHash, $about, $photo);

    if (isset($userData['isChanged']) && !$userData['isChanged']) {
        echo json_encode([
            'success' => false,
            'errors' => $userData['errors']
        ]);
        exit;
    }

    $message = isset($userData['message']) ? $userData['message'] : '';

    if ($userData['success']) {
        $userData = $userData[0];
        $_SESSION['user'] = $userData;
        $_SESSION['user']['displayName'] = $userData['username'];
        $_SESSION['user']['photo'] = $userData['photo'];

        logActivity($id, 'user_changed_data',null, [
            'nickname' => $userData['username'],
            'old_name' => $oldDataUser['username'] !== $userData['username'] ? $oldDataUser['username'] : null
        ]);

        echo json_encode([
            'success' => true,
            'message' => $message,
            'newUserData' => $userData
        ]);
        exit;
    } else {
        echo json_encode([
            'success' => false,
            'message' => $message
        ]);
        exit;
    }
}