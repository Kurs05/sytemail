<?php
// Подключение к базе данных
require_once($_SERVER['DOCUMENT_ROOT'] . "/cfg/core.php");

$db = MyDB::getInstance();
$db->connect();

// Проверка, передан ли ID сообщения
if (isset($_GET['message_id'])) {
    $message_id = $_GET['message_id'];

    // Подготовленный запрос для выборки сообщения по ID
    $stmt = $db->link->prepare("SELECT sender_id, receiver_id, message, created_at, topic FROM messages WHERE id = ?");
    $stmt->bind_param("i", $message_id);
    $stmt->execute();
    $stmt->bind_result($sender_id, $receiver_id, $message, $created_at, $topic);

    // Проверяем, найдено ли сообщение
    if ($stmt->fetch()) {
        echo "<p><strong>Тема:</strong> $topic</p>";
        echo "<p><strong>Сообщение:</strong> $message</p>";
        echo "<p><em>Дата отправки:</em> $created_at</p>";
    } else {
        echo "<p>Сообщение не найдено.</p>";
    }

    $stmt->close();
} else {
    echo "<p>ID сообщения не указан.</p>";
}

$db->close();
?>
