<?php
/**
 * Контроллер администрирования
 */
include_once '../models/UsersModel.php';
include_once '../models/AdminModel.php';
/**
 * Главная страница администратора
 * @param $smarty
 */
function indexAction($smarty) {
    $arrUser = isset($_SESSION['user']) ? $_SESSION['user'] : false;
    $dbUser = getUserById($arrUser['id']);
    if ($dbUser && $arrUser['role'] === 'admin' && $arrUser['role'] === $dbUser['role'] && $arrUser['email'] === $dbUser['email']) {
        $dataCount = getData();
        $recentActivity = getRecentActivity();

        $smarty->assign('view', $dataCount);
        $smarty->assign('recentActivity', $recentActivity);
        $smarty->assign('isAdministration', true);
        $smarty->assign('pageTitle', 'Администрирование форума');
        loadTemplate($smarty, "administration");
    }
}