<?php
/**
 * Контроллер пользователя
 */
include_once '../models/UsersModel.php';
/**
 * Формирование профиля пользователя
 * @param $smarty object
 */
function indexAction($smarty) {
    $smarty->assign('pageTitle', 'Профиль');

    loadTemplate($smarty, 'profile');
}

/**
 * Открытие формы регистрации пользователя
 * @param $smarty
 */
function templateregistrationAction($smarty) {
    $smarty->assign('flagReg', true);
    loadTemplate($smarty, 'registration');
}

/**
 * Открытие формы авторизации пользователя
 */
function templateauthAction($smarty) {
    $smarty->assign('flagAuth', true);
    loadTemplate($smarty, 'authorization');
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

    $userData = registrationNewUser($userName, $email, $pwHash);

    if ($userData['success']) {
        $userData = $userData[0];
        $userName = $userData['username'] ?: $userData['email'];
        $_SESSION['user'] = $userData;
        $_SESSION['user']['displayName'] = $userName;

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

    $userData = loginUser($email, $password);

    if ($userData['success']) {
        $userData = $userData[0];
        $userName = $userData['username'] ?: $userData['email'];
        $_SESSION['user'] = $userData;
        $_SESSION['user']['displayName'] = $userName;

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