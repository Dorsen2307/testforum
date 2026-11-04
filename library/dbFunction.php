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

// Запрос данных из БД с защитой от инъекций
function getDataFromDb($link, $sql, $types, $params) {
    $stmt = mysqli_prepare($link, $sql); // Создаем объект statement для обработки
    if (!$stmt) {
        return false;
    }
    if ($types !== '' && $params !== []) {
        mysqli_stmt_bind_param($stmt, $types, ...$params); // Привязываем значения
    }

    $exec = mysqli_stmt_execute($stmt); // Выполняем запрос
    if (!$exec) {
        mysqli_stmt_close($stmt);
        return false;
    }
    $result = mysqli_stmt_get_result($stmt); // Получаем результат
    mysqli_stmt_close($stmt);

    return $result;
}

/**
 * Запись данных в БД с защитой от инъекций
 * @return bool
 */
function executeQuery($link, $sql, $types, $params) {
    $stmt = mysqli_prepare($link, $sql);
    if (!$stmt) {
        return false;
    }

    if ($types !== '' && $params !== []) {
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    }

    $exec = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $exec === true;
}

/**
 * Запись данных в БД с возвращением id записи (INSERT)
 * @return integer id записи
 */
function insertAndGetId($link, $sql, $types, $params) {
    $stmt = mysqli_prepare($link, $sql);
    if (!$stmt) {
        return false;
    }

    mysqli_stmt_bind_param($stmt, $types, ...$params);

    if (!mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        return false;
    }

    $id = mysqli_insert_id($link);
    mysqli_stmt_close($stmt);

    return $id;
}