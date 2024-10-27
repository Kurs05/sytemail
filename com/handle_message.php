<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/cfg/core.php");  // Подключаем класс MyDB

$db = MyDB::getInstance();
$response = ['success' => false, 'message' => 'Ошибка обработки запроса'];

if (isset($_POST['action']) && isset($_POST['message_ids'])) {
    $message_ids = json_decode($_POST['message_ids'], true);
    
    if ($_POST['action'] == 'delete') {
        $stmt = $db->prepare("DELETE FROM messages WHERE id = ?");
        foreach ($message_ids as $id) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
        }
        $stmt->close();

        $response['success'] = true;
        $response['message'] = 'Сообщения удалены';
    } elseif ($_POST['action'] == 'mark_read') {
        $stmt = $db->prepare("UPDATE messages SET is_read = '1' WHERE id = ?");
        foreach ($message_ids as $id) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
        }
        $stmt->close();

        $response['success'] = true;
        $response['message'] = 'Сообщения помечены как прочитанные';
    }
}

$db->close();
echo json_encode($response);
?>
