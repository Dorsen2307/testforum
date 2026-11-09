<?php
/**
 * Модель категорий
 */
/**
 * Запрос всех категорий
 * @return array|bool
 */
function getAllCategories($isActive=1) {
    $link = createConnection();
    $sql = 'SELECT * FROM categories WHERE is_active = ?';
    $types = 'i';
    $params = [$isActive];

    $result = getDataFromDb($link, $sql, $types, $params);

    if (!$result) {
        return false;
    }
    return  createSmartyRecAssocArr($result);
}

/**
 * Запрос категорий по id
 * @return array|bool
 */
function getCategoriesById($catId) {
    $link = createConnection();
    $sql = 'SELECT * FROM categories WHERE id = ?';
    $types = 'i';
    $params = [$catId];

    $result = getDataFromDb($link, $sql, $types, $params);

    if (!$result) {
        return false;
    }
    return  createSmartyRecAssocArr($result)[0];
}
