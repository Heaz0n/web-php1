<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мой сайт</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Общие стили */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        /* Стили для шапки */
        header {
            background-color: #3B8EA5; /* Прозрачный холодный синий */
            color: #fff;
            padding: 20px;
            text-align: center;
            cursor: pointer; /* Добавляем указатель мыши для элемента header */
        }
        header nav ul {
            list-style-type: none;
            padding: 0;
        }
        header nav ul li {
            display: inline;
            margin-right: 20px;
        }
        header nav ul li a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            transition: color 0.3s ease;
        }
        header nav ul li a:hover {
            color: #ff6600;
        }
    </style>
</head>
<body>
    <!-- Шапка сайта -->
    <header id="header">
        <nav>
            <ul>
                <li><a href="index.php">Главная</a></li>
                <li><a href="contacts.php">Контакты</a></li>
                <li><a href="gallery.php">Галерея</a></li>
            </ul>
        </nav>
    </header>
    <!-- JavaScript -->
    <script>
        // JavaScript для изменения цвета фона при клике на шапку
        document.getElementById("header").addEventListener("click", function() {
            var randomHue = Math.floor(Math.random() * 360); // Генерация случайного оттенка (от 0 до 360)
            this.style.backgroundColor = "hsl(" + randomHue + ", 70%, 50%)"; // Использование HSL цвета с заданным оттенком и фиксированными значениями для насыщенности и светлоты
        });
    </script>
</body>
</html>
