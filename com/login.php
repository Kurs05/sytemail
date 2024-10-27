<?php 
session_start(); // Стартуем сессию

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once($_SERVER['DOCUMENT_ROOT'] . "/cfg/core.php");

    $username = $_POST['username'];
    $password = $_POST['password'];

    $db = MyDB::getInstance();
    $db->connect();

    // Подготовка запроса для получения данных пользователя по имени
    $stmt = $db->link->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $hashed_password);
        $stmt->fetch();

        // Проверка пароля
        if (password_verify($password, $hashed_password)) {
            // Если пароль верен, сохраняем информацию о пользователе в сессию
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username;
            header("Location: /com/home.php");
            exit;
        } else {
            echo "<div class='error-message'>Неверный пароль.</div>";
        }
    } else {
        echo "<div class='error-message'>Пользователь не найден.</div>";
    }

    // Проверка на ошибки
    if ($stmt->error) {
        echo "<div class='error-message'>Ошибка выполнения запроса: " . $stmt->error . "</div>";
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
    <title>Вход</title>
    <link rel="stylesheet" type="text/css" href="/static/css/styles.css">
</head>
<body>

<div class="login-container">
    <h1>Вход в аккаунт</h1>

    <form method="POST">
        <label for="username">Имя пользователя:</label>
        <input type="text" name="username" required>
        
        <label for="password">Пароль:</label>
        <input type="password" name="password" required>
        
        <input type="submit" value="Войти">
    </form>

    <a class="register-link" href='/com/registration.php'>Регистрация</a>
</div>

</body>
</html>
