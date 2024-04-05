<?php
session_start();

// Подключение к базе данных
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "php8";

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получаем случайное изображение и его категорию из базы данных
$sql = "SELECT image_name, category FROM object_captcha ORDER BY RAND() LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $captcha_image = $row['image_name'];
    $captcha_category = $row['category'];

    // Сохраняем категорию в сессии
    $_SESSION['captcha_category'] = $captcha_category;

    // Генерация изображения капчи
    header('Content-Type: image/png');
    $captcha_image_path = __DIR__ . "/captcha_images/" . $captcha_image; // Абсолютный путь к изображению
    readfile($captcha_image_path);
} else {
    echo "Ошибка: Не удалось получить изображение капчи из базы данных.";
}

// Закрытие соединения с базой данных
$conn->close();
?>
