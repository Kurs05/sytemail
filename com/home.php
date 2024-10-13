<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Страница с боковой панелью и сообщениями</title>
    <link rel="stylesheet" type="text/css" href="/static/css/styles.css">
</head>
<body>

    <!-- Боковая панель -->
    <div class="sidebar">
        <h2>Меню</h2>
		<button id="openModalBtn">Написать </button>
		<div id="messageModal" class="modal">
		
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Написать сообщение</h2>

                <!-- Форма для написания сообщения -->
                <form id="messageForm" method="POST" action="/com/send_message.php">
                    <label for="receiver">Выберите адресата:</label>
                    <select id="receiver" name="receiver_id" required>
                        <option value="">-- Выберите пользователя --</option>
                        <!-- Здесь должны быть добавлены реальные пользователи из базы данных -->
                        <?php
                        // Пример PHP для получения списка пользователей
                        require_once($_SERVER['DOCUMENT_ROOT'] . "/cfg/core.php");

                        $db = new MyDB();
                        $db->connect();

                        $query = "SELECT id, username FROM users";
                        $db->run($query);
                        while ($user = $db->fetch()) {
                            echo "<option value='" . $user['id'] . "'>" . $user['username'] . "</option>";
                        }

                        $db->close();
                        ?>
                    </select>

                    <label for="message">Сообщение:</label>
                    <textarea id="message" name="message" required></textarea>

                    <input type="submit" value="Отправить">
                </form>
            </div>
        </div>
		<script src="/static/js/modal.js"></script>
		<a href='/com/logout.php'>Выйти</a>
    </div>

    <!-- Основное содержимое -->
    <div class="content">
        <h1>Ваши полученные сообщения:</h1>

        <?php
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /com/login.php");
            exit;
        }

        require_once($_SERVER['DOCUMENT_ROOT'] . "/cfg/core.php");

        $user_id = $_SESSION['user_id'];  // ID текущего пользователя (получатель)

        $db = new MyDB();
        $db->connect();

        // Запрос для получения сообщений
        $query = "SELECT users.username AS sender, messages.message, messages.created_at 
                  FROM messages 
                  JOIN users ON messages.sender_id = users.id 
                  WHERE messages.receiver_id = ? 
                  ORDER BY messages.created_at DESC";

        $stmt = $db->link->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->bind_result($sender, $message, $created_at);

        // Отображение полученных сообщений
        while ($stmt->fetch()) {
            echo "<div class='message'>";
            echo "<p><strong>От:</strong> $sender</p>";
            echo "<p><strong>Сообщение:</strong> $message</p>";
            echo "<p><em>Дата:</em> $created_at</p>";
            echo "</div><hr>";
        }

        // Закрытие соединения
        $stmt->close();
        $db->close();
        ?>

        <footer>
            <p>Поставьте нам 10!!!</p>
        </footer>
    </div>

</body>
</html>
