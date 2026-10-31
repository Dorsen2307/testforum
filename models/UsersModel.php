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
function registrationNewUser($name, $email, $pwHash) {
    $name = htmlspecialchars((string)$name);
    $email = htmlspecialchars($email);

    $link = createConnection();
    $sql = "INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)";
    $types = 'sss';
    $params = [$name, $email, $pwHash];

    $result = getDataFromDb($link, $sql, $params, $types);

    if ($result) {
        $sql = "SELECT * FROM users WHERE (email = ? and password_hash = ?) LIMIT 1";
        $types = 'ss';
        $params = [$email, $pwHash];

        $result = getDataFromDb($link, $sql, $params, $types);
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

    $result = getDataFromDb($link, $sql, $params, $types);
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

    $result = getDataFromDb($link, $sql, $params, $types);
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

    $result = getDataFromDb($link, $sql, $params, $types);

    return createSmartyRecAssocArr($result);
}