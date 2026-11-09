<?php
/**
 * Контроллер главной страницы
 */
include_once '../models/CategoriesModel.php';
include_once '../models/TopicsModel.php';

/**
 * Метод формирования главной страницы
 * @param $smarty
 */
function indexAction($smarty) {
    $arrUser = isset($_SESSION['user']) ? $_SESSION['user'] : false;
    $categoryId = isset($_GET['cat_id']) ? $_GET['cat_id'] : null;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

    $allCategories = getAllCategories();

    if (!isset($_GET['cat_id'])) {
        $pagination = getPaginationTopics($page);
        $allTopics = getAllTopics($pagination['offset']);
    } else {
        $pagination = getPaginationTopics($page, $categoryId);
        $allTopics = getAllTopics($pagination['offset'], $categoryId);
        $smarty->assign('catId', $categoryId);
    }

    $allTopics = replaceDate($allTopics);

    $smarty->assign('pageTitle', "Главная страница");
    $smarty->assign('topicName', "Добро пожаловать в IT Forum");
    $smarty->assign('topicDescription', "Обсуждаем всё про разработку, инфраструктуру, инструменты и карьерные вопросы.");
    $smarty->assign('allCategories', $allCategories);
    $smarty->assign('allTopics', $allTopics);
    $smarty->assign('arrUser', $arrUser);
    $smarty->assign('pagination', $pagination);

    loadTemplate($smarty, 'index');
}



