document.addEventListener("DOMContentLoaded", function() {
    const elements = document.querySelectorAll('h2, h3, p'); // выбираем все заголовки и абзацы

    // перебираем элементы и добавляем обработчик события клика
    elements.forEach(function(element) {
        element.addEventListener('click', function() {
            // генерируем случайный цвет
            const randomColor = "#" + Math.floor(Math.random()*16777215).toString(16);
            // изменяем цвет элемента
            this.style.color = randomColor;
        });
    });
});
