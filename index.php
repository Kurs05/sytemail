<?php
session_start();

// Проверяем, если пользователь не авторизован, перенаправляем на страницу входа
if (!isset($_SESSION['user_id'])) {
    header("Location: /com/login.php");
    exit(); // Останавливаем выполнение кода после перенаправления
}

define("INDEX", ""); // УСТАНОВКА КОНСТАНТЫ ГЛАВНОГО КОНТРОЛЛЕРА

require_once($_SERVER['DOCUMENT_ROOT'] . "/cfg/core.php"); 

// ПОДКЛЮЧЕНИЕ К БД
$db = new MyDB();
$db->connect();

// ГЛАВНЫЙ КОНТРОЛЛЕР
$option = isset($_GET['option']) ? $_GET['option'] : '';
switch ($option) {
    case "page":
        include($_SERVER['DOCUMENT_ROOT'] . "/com/page.php");
        break;
    default:
        include($_SERVER['DOCUMENT_ROOT'] . "/com/home.php");
        break;
}

include($_SERVER['DOCUMENT_ROOT'] . "/templates/template.php");
$db->close();
?>
