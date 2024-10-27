document.addEventListener("DOMContentLoaded", function() {
    // Элементы уведомления
    const notification = document.getElementById("notification");

    // Обработчик для кнопки "Удалить"
    document.getElementById("deleteMessages").addEventListener("click", function() {
        sendAction('delete');
    });

    // Обработчик для кнопки "Пометить как прочитанное"
    document.getElementById("markReadMessages").addEventListener("click", function() {
        sendAction('mark_read');
    });

    function sendAction(actionType) {
        // Собираем выбранные сообщения
        let checkboxes = document.querySelectorAll(".message-checkbox:checked");
        let messageIds = Array.from(checkboxes).map(checkbox => checkbox.value);

        if (messageIds.length === 0) {
            showNotification("Выберите хотя бы одно сообщение", "warning");
            return;
        }

        // AJAX запрос
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "handle_message.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                let response = JSON.parse(xhr.responseText);
                
                if (response.success) {
                    showNotification(response.message, "success");
                    console.log("Ответ от сервера:", xhr.responseText);

                    // Удаляем отмеченные сообщения с экрана только при действии удаления
                    if (actionType === 'delete') {
                        checkboxes.forEach(checkbox => {
                            checkbox.closest(".message-conteiner").remove();
                        });
                    }

                    // Помечаем сообщения как прочитанные (например, добавляем класс "прочитано")
                    if (actionType === 'mark_read') {
                        checkboxes.forEach(checkbox => {
                            let messageContainer = checkbox.closest(".message-conteiner");
                            messageContainer.classList.add("read");
                        });
                    }

                } else {
                    showNotification(response.message, "error");
                }
            }
        };

        let params = `action=${actionType}&message_ids=${JSON.stringify(messageIds)}`;
        xhr.send(params);
    }

    // Функция для показа уведомлений
    function showNotification(message, type) {
        notification.textContent = message;
        notification.className = type;
        notification.style.display = "block";

        setTimeout(function() {
            notification.style.display = "none";
        }, 3000);  // Уведомление исчезает через 3 секунды
    }
});
