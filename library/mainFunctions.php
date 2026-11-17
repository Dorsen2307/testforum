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

    // Тот же календарный день
    if (date('Y-m-d', $timestamp) === date('Y-m-d', $now)) {
        return 'Сегодня, ' . date('H:i', $timestamp);
    }

    // Предыдущий календарный день
    if (date('Y-m-d', $timestamp) === date('Y-m-d', strtotime('-1 day', $now))) {
        return 'Вчера, ' . date('H:i', $timestamp);
    }

    $day = 86400;
    // Разница по календарным дням, а не по секундам:
    // 23:59 сегодня и 00:01 завтра — это 1 день, а не 2 секунды
    $daysDiff = (int) floor((strtotime(date('Y-m-d', $now)) - strtotime(date('Y-m-d', $timestamp))) / $day);

    if ($daysDiff < 7) {
        $days = plural($daysDiff, 'день', 'дня', 'дней');
        return "$daysDiff $days назад, " . date('H:i', $timestamp);
    }

    // Для старых дат вернём обычное форматирование
    return date('j M, H:i', $timestamp);
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

/** Замена дат в массиве на форматированный
 * @return array в массив добавляются конвертированные даты с префиксом user_
 */
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
                if ($col === 'created_at' || $col === 'last_post_at' || $col === 'last_login') {
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


/** Перемещаем файл из временного хранилища в папку проекта
 * @param $file array распакованный массив уровня `$file['file']`
 */
function movingFileToStorageFolder($file, $fileName) {
    // Получаем полный путь к файлу во временном хранилище
    $currentPath = $file['tmp_name'];
    // Получаем имя загружаемого файла
//    $fileName = date("Y-m-d-H-i-s") . "_" . $userId . "_" . $file['name'];
    // Формируем путь внутри проекта
    $newPath = dirname(__FILE__) . UPLOAD_PROFILE_FOLDER . $fileName;
    // Перемещаем файл из временного хранилища в наш проект
    $res =  move_uploaded_file($currentPath, $newPath);
    return $res;
}


//===== функция для отладки ====
function logging($fileName, $var) {
    // Метка времени для каждой записи
    $timestamp = date('Y-m-d H:i:s') . ' | ';

    if (is_array($var) || is_object($var)) {
        // Массивы и объекты выводим в читаемом виде с заголовком
        $type = is_array($var) ? 'Array' : get_class($var);
        $message = $timestamp . "=== {$type} ===\n" . print_r($var, true) . "=== конец {$type} ===\n";
    } elseif (is_bool($var)) {
        // bool в конкатенации превращается в пустую строку — выводим явно
        $message = $timestamp . var_export($var, true) . PHP_EOL;
    } elseif (is_null($var)) {
        $message = $timestamp . 'NULL' . PHP_EOL;
    } else {
        $message = $timestamp . print_r($var, true) . PHP_EOL;
    }

    file_put_contents(__DIR__ . '/' . $fileName . '.log', $message, FILE_APPEND);
}
//===================================


/**
 * Логика компактной пагинации
 * @param $page int текущая страница
 * @param $totalPages int всего страниц
 * @return array
 */
function getPageList($page, $totalPages) {
    $pageList = [];
    $gap = '...'; // многоточие

    if ($totalPages <= MAX_COUNT_PAGES) {
        // Страниц немного — выводим все подряд без многоточий
        $pageList = range(1, $totalPages);
    } else {
        $start = max(2, $page - SHOW_AROUND);
        $end   = min($totalPages - 1, $page + SHOW_AROUND);

        // Первая страница
        $pageList[] = 1;

        // Многоточие после первой — только если между ней и блоком реально есть пропуск
        if ($start > 2) {
            $pageList[] = $gap;
        }

        // Блок вокруг текущей
        for ($i = $start; $i <= $end; $i++) {
            $pageList[] = $i;
        }

        // Многоточие перед последней — только если между блоком и последней реально есть пропуск
        if ($end < $totalPages - 1) {
            $pageList[] = $gap;
        }

        // Последняя страница
        $pageList[] = $totalPages;
    }

    return $pageList;
}

/**
 * Преобразование ролей в нормальные названия
 */
function replaceRoleToName($role) {
    switch ($role) {
        case 'admin':
            return 'Администратор';
        case 'moderator':
            return 'Модератор';
        case 'user':
            return 'Пользователь';
        case 'banned':
            return 'Забанен';
    }
}