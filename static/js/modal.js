// modal.js

// Получаем модальное окно
var modal = document.getElementById('messageModal');

// Получаем кнопку, которая открывает модальное окно
var btn = document.getElementById('openModalBtn');

// Получаем элемент <span>, который закрывает модальное окно
var span = document.getElementsByClassName('close')[0];

// Когда пользователь нажимает на кнопку, открываем модальное окно
btn.onclick = function() {
    modal.style.display = 'block';
}

// Когда пользователь нажимает на <span> (x), закрываем модальное окно
span.onclick = function() {
    modal.style.display = 'none';
}

// Когда пользователь кликает в любое место вне модального окна, закрываем его
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}
