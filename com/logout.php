<?php
session_start();
session_destroy(); // Уничтожаем все данные сессии

header("Location: /com/login.php"); // Перенаправляем на страницу входа
exit();
?>
