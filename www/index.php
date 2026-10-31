<?php
// Открываем сессию
session_start();

// Подключаем
include_once '../config/config.php'; // файл конфигурации
include_once '../library/mainFunctions.php'; // файл вспомогательных функций
include_once '../library/dbFunction.php'; // файл работы с БД

// переменные содержат имена контроллера и функции, если в GET нет параметров, то по умолчанию Index
$controllerName = isset($_GET['controller']) ? ucfirst($_GET['controller']) : 'Index';
$actionName = isset($_GET['action']) ? $_GET['action'] : 'index';

loadPage($smarty, $controllerName, $actionName);