<?php
session_start();

// Функция для проверки роли пользователя
function checkRole($role) {
    if(isset($_SESSION['role']) && $_SESSION['role'] === $role) {
        return true;
    }
    return false;
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мой сайт</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Шапка сайта -->
    <header id="header">
        <nav>
            <ul>
                <li><a href="index.php">Главная</a></li>
                <li><a href="contacts.php">Контакты</a></li>
                <li><a href="gallery.php">Галерея</a></li>
                <?php if (checkRole('admin')): ?>
                    <li><a href="admin_panel.php">Панель администратора</a></li>
                <?php endif; ?>
                <?php if (checkRole('user')): ?>
                    <li><a href="user_panel.php">Личный кабинет</a></li>
                <?php endif; ?>
                <?php if (!isset($_SESSION['username'])): ?>
                    <li><a href="login.php">Вход</a></li>
                    <li><a href="register.php">Регистрация</a></li>
                <?php else: ?>
                    <li><a href="logout.php">Выход</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <!-- JavaScript -->
    <script>
        // JavaScript для изменения цвета фона при клике на шапку
        var header = document.getElementById("header");
        if (header) { // Проверяем наличие элемента с id "header"
            header.addEventListener("click", function() {
                var randomHue = Math.floor(Math.random() * 360); // Генерация случайного оттенка (от 0 до 360)
                this.style.backgroundColor = "hsl(" + randomHue + ", 70%, 50%)"; // Использование HSL цвета с заданным оттенком и фиксированными значениями для насыщенности и светлоты
            });
        }
    </script>
</body>
</html>
