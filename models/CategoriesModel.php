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
    $stmt = mysqli_prepare($link, $sql);
    if (!$stmt) {
        mysqli_stmt_close($stmt);
        return false;
    }
    mysqli_stmt_bind_param($stmt, "i", $isActive);
    $exec = mysqli_stmt_execute($stmt);
    if (!$exec) {
        mysqli_stmt_close($stmt);
        return false;
    }
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    if (!$result) {
        return false;
    }
    return  createSmartyRecAssocArr($result);
}

function getCategoryBySlug($slug) {

}