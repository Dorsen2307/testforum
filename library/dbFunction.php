<?php
/**
 * Функции работы с БД
 */
/**
 * Создание подключения к БД
 * @return bool|mysqli
 */
function createConnection() {
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if (!$link) {
        return false;
    } else {
        return $link;
    }
}