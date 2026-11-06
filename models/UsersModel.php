<?php
/**
 * Модель пользователя
 */
/**
 * Регистрация нового пользователя
 * @param $email string электронная почта пользователя
 * @param $pwHash string хэш пароля
 * @param $name string имя пользователя
 * @return bool|array массив данных нового пользователя
 */
function registrationNewUser($name, $email, $pwHash, $role='user') {
    $name = htmlspecialchars((string)$name);
    $email = htmlspecialchars($email);
    $role = htmlspecialchars($role);

    $link = createConnection();
    $sql = "INSERT INTO users (username, email, password_hash, role) VALUES (?, ?, ?, ?)";
    $types = 'sss';
    $params = [$name, $email, $pwHash, $role];

    $result = executeQuery($link, $sql, $params, $types);

    if ($result) {
        $sql = "SELECT * FROM users WHERE (email = ? and password_hash = ?) LIMIT 1";
        $types = 'ss';
        $params = [$email, $pwHash];

        $result = getDataFromDb($link, $sql, $types, $params);
        $result = createSmartyRecAssocArr($result);

        if (isset($result[0])) {
            $result['success'] = true;
        } else {
            $result['success'] = false;
        }
    } else {
        $result['success'] = false;
    }
    return $result;
}

/**
 * Авторизация пользователя
 * @param $email string электронная почта пользователя
 * @param $pwd string пароль
 * @return array|bool массив данных пользователя
 */
function loginUser($email, $pwd) {
    $email = htmlspecialchars($email);
    $link = createConnection();
    $sql = "SELECT * FROM users WHERE email = ? LIMIT 1";
    $types = 's';
    $params = [$email];

    $result = getDataFromDb($link, $sql, $types, $params);
    $result = createSmartyRecAssocArr($result);
    if (isset($result[0])) {
        $result['success'] = true;
    } else {
        $result['success'] = false;
    }
    return $result;
}

/**
 * Проверка параметров для регистрации пользователя
 * @param $username string никнейм пользователя
 * @param $email string почта пользователя
 * @param $password string пароль пользователя
 * @param $confirm string повтор пароля
 * @return array результат - ассоциативный массив
 */
function checkRegisterParams($username, $email, $password, $confirm) {
    $errors = [];
    $username = checkInput($username);
    $email = checkInput($email);
    $password = checkInput($password);
    $confirm = checkInput($confirm);

    if (!$username) {
        $errors['userName'] = 'Введите имя пользователя';
    } elseif (strlen($username) < 3) {
        $errors['userName'] = 'Имя слишком короткое';
    }

    if (!$email) {
        $errors['email'] = 'Введите email';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Некорректный email';
    } elseif (checkUserEmail($email)) {
        $errors['email'] = "Пользователь с таким же email ('$email') уже зарегистрирован";
    }

    if (!$password) {
        $errors['password'] = 'Введите пароль';
    } elseif (strlen($password) < 8) {
        $errors['password'] = 'Пароль слишком короткий';
    }

    if (!$confirm) {
        $errors['confirmPassword'] = 'Повторите пароль';
    } elseif ($password !== $confirm) {
        $errors['confirmPassword'] = 'Пароли не совпадают';
    }

    return $errors;
}

/**
 * Проверка параметров для авторизации пользователя
 * @param $email string почта пользователя
 * @param $password string пароль пользователя
 * @return array результат - ассоциативный массив
 */
function checkAuthParams($email, $password) {
    $errors = [];
    $email = checkInput($email);
    $password = checkInput($password);

    if (!$email) {
        $errors['email'] = 'Введите email';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Некорректный email';
    } elseif (!checkUserEmail($email)) {
        $errors['email'] = "Пользователь с таким email ('$email') не зарегистрирован";
    }

    if (!$password) {
        $errors['password'] = 'Введите пароль';
    } elseif (strlen($password) < 8) {
        $errors['password'] = 'Пароль слишком короткий';
    } elseif (!isset($errors['email']) && !checkUserPassword($email, $password)) {
        $errors['password'] = 'Неверный пароль';
    }

    return $errors;
}

/**
 * Проверка параметров для данных профиля
 * @param $username string имя пользователя
 * @param $email string почта пользователя
 * @param $password string пароль пользователя
 * @return array результат - ассоциативный массив
 */
function checkProfileParams($username, $email, $password, $photo) {
    $errors = [];
    $username = checkInput($username);
    $email = checkInput($email);
    $password = checkInput($password);

    if ($photo['name'] <> '' && $photo['size'] <> 0) {
        $photoSize = $photo['size'];
        $photoExt = pathinfo($photo['name'], PATHINFO_EXTENSION);
        if ($photoSize > 2*1024*1024) {
            $errors['photo'] = 'Размер файла должен быть до 2 Мб. Ваш файл: ' & $photoSize/1024/1024 & ' Мб';
        } else {
            if (!in_array(strtolower($photoExt), ALLOWED_FILE)) {
                $errors['photo'] = 'Допустимы только ' . implode(', ', ALLOWED_FILE);
            }
        }
    }

    if (!$username) {
        $errors['login'] = 'Введите имя пользователя';
    } elseif (strlen($username) < 3) {
        $errors['login'] = 'Имя слишком короткое';
    }

    if ($email && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Некорректный email';
    } elseif (checkUserEmail($email)) {
        $errors['email'] = "Пользователь с таким email ('$email') уже зарегистрирован";
    }

    if ($password && strlen($password) < 8) {
        $errors['password'] = 'Пароль слишком короткий';
    }

    return $errors;
}

/**
 * Проверка пароля
 * @param $email
 * @param $password
 * @return bool
 */
function checkUserPassword($email, $password) {
    $email = (string)$email;
    $link = createConnection();
    $sql = "SELECT password_hash FROM users WHERE email = ?";
    $types = 's';
    $params = [$email];

    $result = getDataFromDb($link, $sql, $types, $params);
    $result = createSmartyRecAssocArr($result);
    $isPwd = password_verify($password, $result[0]['password_hash']); // true если совпадают

    return $isPwd;
}

/**
 * Проверка почты на наличие дубликата
 * @param $email string
 * @return array|bool массив (строка из таблицы users / пустой массив)
 */
function checkUserEmail($email) {
    $email = (string)$email;
    $link = createConnection();
    $sql = "SELECT id FROM users WHERE email = ?";
    $types = 's';
    $params = [$email];

    $result = getDataFromDb($link, $sql, $types, $params);

    return createSmartyRecAssocArr($result);
}

/**
 * Проверяет на наличие/отсутствие пользователей
 * @return bool
 */
function firstUser() {
    $link = createConnection();
    $sql = "SELECT * FROM users";
    $result = mysqli_query($link, $sql);
    if (mysqli_num_rows($result) < 0 || !$result) {
        return false;
    }
    return true;
}

/**
 * Обновляет данные пользователя
 * @param $id int id пользователя
 * @param $username string имя пользователя
 * @param $email string новый email пользователя
 * @param $password string новый пароль пользователя
 * @param $pwdHash string хэш пароля
 * @param $about string "о себе" пользователя
 * @param $photo string имя файла фото пользователя
 * @return array
 */
function updateUser($id, $username, $email, $password, $pwdHash, $about, $photo) {
    $result = getUserById($id);

    // Формируем запрос на основе измененных данных в форме
    $sqlUpdate = "UPDATE users SET ";
    $arrSqlSet = [];
    $types = '';
    $params = [];
    $isChanged = false;

    if ($username <> $result['username']) {
        $arrSqlSet[] = "username = ?";
        $types .= 's';
        $params[] = $username;
        $isChanged = true;
    }
    if ($email <> '') {
        $arrSqlSet[] = "email = ?";
        $types .= 's';
        $params[] = $email;
        $isChanged = true;
    }
    if ($password <> '') {
        $arrSqlSet[] = "password_hash = ?";
        $types .= 's';
        $params[] = $pwdHash;
        $isChanged = true;
    }
    if ($about <> $result['about']) {
        $arrSqlSet[] = "about = ?";
        $types .= 's';
        $params[] = $about;
        $isChanged = true;
    }
    $newFileName = date("Y-m-d-H-i-s") . "_" . $id . "_" . $photo['name'];
    if ($photo['name'] <> '' && $newFileName <> $result['photo']) {
        $arrSqlSet[] = "photo = ?";
        $types .= 's';
        $params[] = $newFileName;
        $isChanged = true;
    }
    $sqlSet = implode(', ', $arrSqlSet);
    $sqlUpdate .= $sqlSet;

    $sqlUpdate .= " WHERE id = ?";
    $types .= 'i';
    $params[] = $id;

    if (!$isChanged) {
        return [
            'success' => false,
            'isChanged' => $isChanged,
            'errors' => ['new-data' => 'Не введены новые данные']
        ];
    }
    $link = createConnection();
    mysqli_begin_transaction($link); // открываем транзакцию
    $resultUpdate = executeQuery($link, $sqlUpdate, $types, $params);

    if ($resultUpdate) {
        if ($photo['name'] <> '') {
            // Перемещаем файл в проект
            $resMoving = movingFileToStorageFolder($photo, $newFileName);
            if (!$resMoving) {
                mysqli_rollback($link); // Отменяем изменения
                return [
                    'success' => false,
                    'message' => 'Ошибка загрузки файла'
                ];
            }
        }
        mysqli_commit($link); // Применяем изменения

        // Обновляем данные из БД
        $sqlQuery = "SELECT * FROM users WHERE id = ? LIMIT 1";
        $types = 'i';
        $params = [$id];
        $resultQuery = getDataFromDb($link, $sqlQuery, $types, $params);
        $resultQuery = createSmartyRecAssocArr($resultQuery);

        if (isset($resultQuery[0])) {
            $resultQuery['success'] = true;
            $resultQuery['message'] = 'Данные успешно обновлены!';
        } else {
            $resultQuery['success'] = false;
            $resultQuery['message'] = 'Ошибка запроса данных.';
        }
    } else {
        $resultQuery['success'] = false;
        $resultQuery['message'] = 'Ошибка обновления данных. Попробуйте позже.';
        mysqli_rollback($link);
    }

    return $resultQuery;
}
//
///**
// * Запрос offset для пагинации тем в профиле
// * @param $page int номер страницы
// * @param $userId int id пользователя
// * @return array
// */
//function getPaginationTopicsProfile($page, $userId) {
//    $link = createConnection();
//    $sqlCount = "SELECT COUNT(*) AS topics_count FROM topics WHERE user_id = ? AND is_active = 1)";
//
//    $types = 'i';
//    $params = [$userId];
//
//    $result = getDataFromDb($link, $sqlCount, $types, $params);
//    $row = createSmartyRecAssocArr($result);
//
//    return getOffsetAndTotalPages($page, $row['topics_count']);
//}
//
///**
// * Запрос offset для пагинации постов в профиле
// * @param $page int номер страницы
// * @param $userId int id пользователя
// * @return array
// */
//function getPaginationPostsProfile($page, $userId) {
//    $link = createConnection();
//    $sqlCount = "SELECT COUNT(*) AS posts_count FROM posts WHERE user_id = ?)";
//
//    $types = 'i';
//    $params = [$userId];
//
//    $result = getDataFromDb($link, $sqlCount, $types, $params);
//    $row = createSmartyRecAssocArr($result);
//
//    return getOffsetAndTotalPages($page, $row['posts_count']);
//}

function getUserById($userId) {
    $link = createConnection();
    $sql = "SELECT * FROM users WHERE id = ? LIMIT 1";
    $types = 'i';
    $params = [$userId];

    $result = getDataFromDb($link, $sql, $types, $params);
    if (!$result) {
        return [
            'success' => false,
            'message' => 'Ошибка запроса данных пользователя'
        ];
    }

    return createSmartyRecAssocArr($result)[0];
}