<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Страница с боковой панелью и сообщениями</title>
    <link rel="stylesheet" type="text/css" href="/static/css/styles.css">
	<script src="/static/js/message.js"></script>
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

                        $db = MyDB::getInstance();
                        $db->connect();
						$current_user_id = $_SESSION['user_id'];
                        $query = "SELECT id, username FROM users WHERE id != ?";
                        $stmt = $db->link->prepare($query);
						$stmt->bind_param("i", $current_user_id);  // Привязка параметра для исключения текущего пользователя
						$stmt->execute();
						$stmt->bind_result($id, $username);

						// Формирование выпадающего списка
						while ($stmt->fetch()) {
							echo "<option value='" . $id . "'>" . $username . "</option>";
						}

						$stmt->close();

                        $db->close();
                        ?>
                    </select>
					<label for= "topic_sender">Тема:</label>
					<textarea id ="topic_sender" name ="topic_sender"required></textarea>
                    
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

        $user_id = $_SESSION['user_id'];  // ID текущего пользователя (получатель)

        
        $db->connect();

        // Запрос для получения сообщений
        $query = "SELECT  messages.id AS message_id , users.username AS sender, messages.message, messages.created_at ,messages.topic
                  FROM messages 
                  JOIN users ON messages.sender_id = users.id 
                  WHERE messages.receiver_id = ? 
                  ORDER BY messages.created_at DESC";

        $stmt = $db->link->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->bind_result($message_id, $sender, $message, $created_at, $topic);
?>
<form id="messageForm" method="post">
    <div id="messageActions" style="display: none;">
        <!-- Панель с кнопками -->
        <button type="button" id="deleteMessages">Удалить</button>
        <button type="button" id="markReadMessages">Пометить как прочитанное</button>
        <!-- Можно добавить другие кнопки -->
    </div>

    <?php while ($stmt->fetch()): ?>
        <div class='message-conteiner'>
            <input type="checkbox" class="message-checkbox" name="message_ids[]" value="<?php echo $message_id; ?>" onclick="toggleActions()">
            <a href='/com/message.php?message_id=<?php echo $message_id; ?>' class='message'>
                <div class='message-item'><p><strong>От:</strong> <?php echo $sender; ?></p></div>
                <div class='message-item'><p><strong>Тема:</strong> <?php echo $topic; ?></p></div>
                <div class='message-item'><p><strong>Сообщение:</strong> <?php echo $message; ?></p></div>
                <p><em>Дата:</em> <?php echo $created_at; ?></p>
            </a>
        </div>
        <hr>
    <?php endwhile; ?>
</form>
<div id="notification" style="display: none;"></div>

<?php
$stmt->close();
$db->close();
?>

        <footer>
            <p>Поставьте нам 10!!!</p>
        </footer>
    </div>
<script>
    function toggleActions() {
        // Получаем все чекбоксы с классом 'message-checkbox'
        var checkboxes = document.querySelectorAll('.message-checkbox');
        var anyChecked = false;

        // Проверяем, есть ли хотя бы один отмеченный чекбокс
        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                anyChecked = true;
            }
        });

        // Показываем или скрываем панель с кнопками в зависимости от того, отмечен ли хотя бы один чекбокс
        var actions = document.getElementById('messageActions');
        if (anyChecked) {
            actions.style.display = 'block'; // Показываем панель
        } else {
            actions.style.display = 'none'; // Скрываем панель
        }
    }
</script>
<script src="/static/js/modal.js"></script>
</body>
</html>
