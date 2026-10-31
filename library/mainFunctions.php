<?php
/**
 * Главные функции проекта
 */
/**
 * Формирование запрашиваемой страницы
 * @param string $controllerName название контроллера
 * @param string $actionName название функции обработки страницы внутри контроллера
 */
function loadPage($smarty, string $controllerName, string $actionName = 'index'): void
{
    include_once PATHPREFIX . $controllerName . PATHPOSTFIX;
    $function = $actionName . 'Action';
    $function($smarty);
}

// Вывод шаблона на экран
function loadTemplate($smarty, $templateName): void
{
    $smarty->display($templateName . TMPLTPOSTFIX);
}

// Преобразование объекта запроса в массив
function createSmartyRecAssocArr($record) {
    if (!$record) return false;
    $smartyRec = [];
    while ($row = mysqli_fetch_assoc($record)) {
        $smartyRec[] = $row;
    }
    return $smartyRec;
}

// Редирект
function redirect($url = "/") {
    header("Location: $url");
    exit;
}

// Форматирование даты в темах
function formatRelativeDate($timestamp) {
    $now = time();
    $diff = $now - $timestamp;
    if ($diff < 60) {
        return 'Только что';
    }

    $day = 86400;

    if ($diff < $day) {
        $date = date('Сегодня, H:i', $timestamp);
    } elseif ($diff < 2 * $day) {
        $date = date('Вчера, H:i', $timestamp);
    } elseif ($diff < 7 * $day) {
        $days = floor($diff / $day);
        $date = "$days " . plural($days, 'день', 'дня', 'дней') . ' назад, ' . date('H:i', $timestamp);
    } else {
        // Для старых дат вернём обычное форматирование
        $date = date('j M, H:i', $timestamp); // 25 Окт, 14:22
    }

    return $date;
}

// Склонение: 1 день, 2 дня, 5 дней
function plural($n, $one, $few, $many) {
    $n = abs($n) % 100;
    if ($n > 10 && $n < 20) return $many;
    $n = $n % 10;
    if ($n === 1) return $one;
    if ($n >= 2 && $n <= 4) return $few;
    return $many;
}

// Замена дат в массиве на форматированный
function replaceDate($arr) {
    // Если массив пустой — сразу возвращаем
    if (empty($arr)) {
        return $arr;
    }

    // Проверяем, является ли первый элемент массивом (значит, это список записей)
    $isList = is_array(reset($arr));

    if ($isList) {
        // Обрабатываем каждую запись в списке
        foreach ($arr as $key => $row) {
            if (!is_array($row)) {
                continue;
            }

            foreach ($row as $col => $val) {
                if ($col === 'created_at' || $col === 'last_post_at') {
                    // strtotime вернёт false, если дата битая — тогда оставляем как есть
                    $timestamp = strtotime($val);
                    if ($timestamp !== false) {
                        $arr[$key]['user_' . $col] = formatRelativeDate($timestamp);
                    }
                }
            }
        }
    } else {
        // Обработка одиночной записи
        foreach ($arr as $col => $val) {
            if ($col === 'created_at' || $col === 'last_post_at') {
                $timestamp = strtotime($val);
                if ($timestamp !== false) {
                    $arr['user_' . $col] = formatRelativeDate($timestamp);
                }
            }
        }
    }
    return $arr;
}

// Очистка данных пользователя
function checkInput($text): string
{
    $text = trim($text);
    $text = stripslashes($text);
    return htmlspecialchars($text);
}

// Запрос данных из БД с защитой от инъекций
function getDataFromDb($link, $sql, $types, $params) {
    $stmt = mysqli_prepare($link, $sql); // Создаем объект statement для обработки
    if (!$stmt) {
        mysqli_stmt_close($stmt);
        return false;
    }
    mysqli_stmt_bind_param($stmt, $types, ...$params); // Привязываем значения
    $exec = mysqli_stmt_execute($stmt); // Выполняем запрос
    if (!$exec) {
        mysqli_stmt_close($stmt);
        return false;
    }
    $result = mysqli_stmt_get_result($stmt); // Получаем результат
    mysqli_stmt_close($stmt);
    return $result;
}


//===== функция для отладки ====
function logging($fileName, $var) {
    file_put_contents(__DIR__ . '/' . $fileName . '.log', print_r($var, true) . PHP_EOL, FILE_APPEND);
}