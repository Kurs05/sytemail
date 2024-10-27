<?php 
session_start(); // Стартуем сессию

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once($_SERVER['DOCUMENT_ROOT']."/cfg/core.php");
    $username = $_POST['username'];
    $email = $_POST['email'] . '@edu'; // Добавляем @edu к введенному имени
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $db = MyDB::getInstance();
    $db->connect();

    // Проверяем, существует ли уже имя пользователя
    $stmt = $db->link->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "<div class='error-message'>Ошибка: это имя пользователя уже занято.</div>";
    } else {
        // Если имя пользователя уникально, продолжаем регистрацию
        $stmt->close(); // Закрываем предыдущий запрос

        // Подготовка запроса для защиты от SQL-инъекций
        $stmt = $db->link->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);
        
        if ($stmt->execute()) {
            header("Location: /com/home.php");
			exit;
        } else {
            echo "<div class='error-message'>Ошибка регистрации: " . $stmt->error . "</div>";
        }
    }

    $stmt->close();
    $db->close();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link rel="stylesheet" type="text/css" href="/static/css/styles.css">
</head>
<body>

<div class="registration-container">
    <h1>Регистрация</h1>

    <form method="POST">
        <label for="username">Имя пользователя:</label>
        <input type="text" name="username" required>
        
        <label for="email">Email:</label>
        <div class="email-field">
            <input type="text" name="email" placeholder="Введите начало вашей почты" required>
            <div class="email-domain">@edu</div>
        </div>
        
        <label for="password">Пароль:</label>
        <input type="password" name="password" required>
        
        <input type="submit" value="Зарегистрироваться">
    </form>

    <a class="login-link" href='/com/login.php'>Уже есть аккаунт? Войти</a>
</div>

</body>
</html>
