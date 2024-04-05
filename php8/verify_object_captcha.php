<?php
session_start();

// Подключение к базе данных
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "php8";

// Создание соединения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Проверяем, была ли отправлена выбранная категория
if (isset($_POST['category'])) {
    // Получаем выбранную категорию от пользователя
    $user_category = $_POST['category'];

    // Получаем сохраненную категорию из сессии
    $captcha_category = $_SESSION['captcha_category'];

    // Проверяем совпадение выбранной категории с сохраненной
    if ($user_category === $captcha_category) {
        echo "Капча пройдена успешно!";
    } else {
        echo "Капча введена неверно!";
    }
} else {
    echo "Ошибка: Выбранная категория не была отправлена.";
}

// Закрытие соединения с базой данных
$conn->close();
?>
