<?php
/**
 * Контроллер администрирования
 */
include_once '../models/UsersModel.php';
include_once '../models/AdminModel.php';
include_once '../models/TopicsModel.php';
/**
 * Главная страница администратора
 * @param $smarty
 */
function indexAction($smarty) {
    $arrUser = isset($_SESSION['user']) ? $_SESSION['user'] : false;
    if (!$arrUser) {
        Header("location: /");
    }
    $dbUser = getUserById($arrUser['id']);

    if ($dbUser && $arrUser['role'] === 'admin' && $arrUser['role'] === $dbUser['role'] && $arrUser['email'] === $dbUser['email']) {
        $data = getData();
        $recentActivity = getRecentActivity();

        $smarty->assign('tab', 'view');
        $smarty->assign('data', $data);
        $smarty->assign('recentActivity', $recentActivity);
        $smarty->assign('isAdministration', true);
        $smarty->assign('tabTitle', 'Обзор');
        $smarty->assign('pageTitle', 'Администрирование форума');
        loadTemplate($smarty, "administration");
    }
}

/**
 * Страница пользователей
 * @param $smarty
 */
function usersAction($smarty) {
    $arrUser = isset($_SESSION['user']) ? $_SESSION['user'] : false;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    if (!$arrUser) {
        Header("location: /");
    }
    $dbUser = getUserById($arrUser['id']);

    // Флеш-сообщение после действия
    $flash = null;
    if (isset($_GET['success'])) {
        $flash = ['type' => 'success', 'text' => 'Действие выполнено'];
    } elseif (isset($_GET['error'])) {
        $flash = ['type' => 'error', 'text' => $arrUser['errBan']];
    }
    $smarty->assign('flash', $flash);

    if ($dbUser && $arrUser['role'] === 'admin' && $arrUser['role'] === $dbUser['role'] && $arrUser['email'] === $dbUser['email']) {
        $pagination = getPaginationUsers($page);
        $users = getUsers($pagination['offset']);

        checkBanned($users);

        foreach ($users as $key => $user) {
            $users[$key]['role_name'] = replaceRoleToName($user['role']);
        }
        $users = replaceDate($users);

        $smarty->assign('tab', 'users');
        $smarty->assign('users', $users);
        $smarty->assign('pagination', $pagination);
        $smarty->assign('isAdministration', true);
        $smarty->assign('tabTitle', 'Пользователи');
        $smarty->assign('pageTitle', 'Администрирование форума - Пользователи');
        loadTemplate($smarty, "administration");
    }
}

/**
 * Страница тем
 * @param $smarty
 */
function topicsAction($smarty) {
    $arrUser = isset($_SESSION['user']) ? $_SESSION['user'] : false;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    if (!$arrUser) {
        Header("location: /");
    }
    $dbUser = getUserById($arrUser['id']);

    if ($dbUser && $arrUser['role'] === 'admin' && $arrUser['role'] === $dbUser['role'] && $arrUser['email'] === $dbUser['email']) {
        $pagination = getPaginationTopics($page);
        $topics = getAllTopicsWithCatAndUsername($pagination['offset']);

        $smarty->assign('tab', 'topics');
        $smarty->assign('topics', $topics);
        $smarty->assign('isAdministration', true);
        $smarty->assign('tabTitle', 'Топики');
        $smarty->assign('pageTitle', 'Администрирование форума - Топики');
        loadTemplate($smarty, 'administration');
    }
}

/**
 * Страница модерации
 * @param $smarty
 */
function moderationAction($smarty) {
    $arrUser = isset($_SESSION['user']) ? $_SESSION['user'] : false;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    if (!$arrUser) {
        Header("location: /");
    }
    $dbUser = getUserById($arrUser['id']);

    if ($dbUser && $arrUser['role'] === 'admin' && $arrUser['role'] === $dbUser['role'] && $arrUser['email'] === $dbUser['email']) {

        $smarty->assign('tab', 'moderation');
        $smarty->assign('isAdministration', true);
        $smarty->assign('tabTitle', 'Модерация');
        $smarty->assign('pageTitle', 'Администрирование форума - Модерация');
        loadTemplate($smarty, 'administration');
    }
}

/**
 * Бан пользователя (пробую без использования AJAX)
 * @param $smarty
 * @return void
 */
function banAction($smarty) {
    // только POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: /?controller=admin');
        exit;
    }

    $arrUser = isset($_SESSION['user']) ? $_SESSION['user'] : false;
    if ($arrUser['role'] !== 'admin') {
        redirect("/");
    }

    $userId = (int)($_POST['user_id'] ?? 0);
    $reason = trim($_POST['reason'] ?? '');
    $mode   = $_POST['duration_mode'] ?? 'days';
    $days   = (int)($_POST['days'] ?? 0);

    if ($userId <= 0 || $reason === '') {
        // передаем ошибку через сессию
        $arrUser['errBan'] = "Не указана причина или отсутствует id пользователя";
        header('Location: /?controller=admin&action=users&error=ban');
        exit;
    }

    // Защита от бана самих себя и других админов
    if ($userId === (int)$arrUser['id']) {
        header('Location: /?controller=admin&action=users');
        exit;
    }

    $result = banUser($userId, (int)$arrUser['id'], $reason, $mode === 'forever' ? null : max(1, $days));
    if (!$result) {
        $arrUser['errBan'] = "Ошибка бана пользователя";
        header('Location: /?controller=admin&action=users&error=ban');
        exit;
    }

    // Лог активности
    logActivity((int)$arrUser['id'], 'user_banned', $userId, [
        'nickname' => $result['username'],
        'mode' => $mode,
        'days'     => $mode === 'forever' ? 'навсегда' : $days,
        'reason'   => $reason,
    ]);

    header('Location: /?controller=admin&action=users&success=banned');
    exit;
}

/**
 * Разбан пользователя (пробую без использования AJAX)
 * @param $smarty
 * @return void
 */
function unbanAction($smarty) {
    $userId = (int)($_GET['user_id'] ?? 0);
    if ($userId > 0) {
        $result = unbanUser($userId);
        logActivity((int)$_SESSION['user']['id'], 'user_unbanned', $userId, [
            'nickname' => $result['username']
        ]);
    }
    header('Location: /?controller=admin&action=users&success=unbanned');
    exit;
}