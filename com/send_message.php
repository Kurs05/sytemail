<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once($_SERVER['DOCUMENT_ROOT'] . "/cfg/core.php");

    $sender_id = $_SESSION['user_id'];
    $receiver_id = $_POST['receiver_id'];
    $message = $_POST['message'];
	$topic = $_POST['topic_sender'];
	
    // Проверка на наличие данных
    if (!empty($receiver_id) && !empty($message) && !empty($topic)) { // Добавлена закрывающая скобка здесь
    $db = MyDB::getInstance();
    $db->connect();

    // Подготовленный запрос для отправки сообщения
    $stmt = $db->link->prepare("INSERT INTO messages (sender_id, receiver_id, message, created_at, topic) VALUES (?, ?, ?, NOW(), ?)"); // Исправлено местоположение параметра
    $stmt->bind_param("iiss", $sender_id, $receiver_id, $message, $topic); // Убедитесь, что порядок соответствует запросу

    if ($stmt->execute()) {
        echo "<p>Сообщение успешно отправлено!</p>";
        header("Location: /com/home.php");
        exit;
    } else {
        echo "<p>Ошибка при отправке сообщения: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $db->close();
} else {
    echo "<p>Пожалуйста, заполните все поля.</p>";
}
}
?>
