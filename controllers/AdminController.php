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

    if ($dbUser && $arrUser['role'] === 'admin' && $arrUser['role'] === $dbUser['role'] && $arrUser['email'] === $dbUser['email']) {
        $pagination = getPaginationUsers($page);
        $users = getUsers($pagination['offset']);

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