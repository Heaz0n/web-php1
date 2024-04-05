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

// Генерируем случайный текст для капчи
$captcha_text = generateRandomString(6); // Генерируем строку из 6 символов

// Сохраняем сгенерированный текст капчи в базе данных
$sql = "INSERT INTO text_captcha (captcha_text) VALUES ('$captcha_text')";
if ($conn->query($sql) !== TRUE) {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Генерация изображения с текстовой капчей
$im = imagecreatetruecolor(200, 50);
$bg_color = imagecolorallocate($im, 255, 255, 255);
$text_color = imagecolorallocate($im, 255, 255, 255);

// Нанесение текста на изображение
imagestring($im, 5, 10, 10, $captcha_text, $text_color);

// Отправка HTTP-заголовка о типе содержимого
header('Content-type: image/png');

// Вывод изображения в формате PNG
imagepng($im);

// Очистка памяти
imagedestroy($im);

// Закрытие соединения с базой данных
$conn->close();

// Функция для генерации случайной строки
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>
