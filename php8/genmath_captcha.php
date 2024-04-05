<?php
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

// Генерация случайных значений и операции
$value1 = rand(1, 10);
$value2 = rand(1, 10);
$operation = ['+', '-', '*', '/'][rand(0, 3)];

// Вычисление результата
switch ($operation) {
    case '+':
        $result = $value1 + $value2;
        break;
    case '-':
        $result = $value1 - $value2;
        break;
    case '*':
        $result = $value1 * $value2;
        break;
    case '/':
        $result = number_format($value1 / $value2, 2); // Округляем результат деления до двух знаков после запятой
        break;
}

// Сохранение капчи в базу данных
$sql = "INSERT INTO captcha (value1, value2, operation, result) VALUES ($value1, $value2, '$operation', $result)";
$conn->query($sql);

// Генерация изображения с капчей
$im = imagecreatetruecolor(100, 50);
$bg_color = imagecolorallocate($im, 0, 255, 255);
$text_color = imagecolorallocate($im, 0, 255, 255);

// Нанесение текста на изображение
$text = "$value1 $operation $value2 = ?";
imagestring($im, 5, 10, 10, $text, $text_color);

// Отправка HTTP-заголовка о типе содержимого
header('Content-type: image/png');

// Вывод изображения в формате PNG
imagepng($im);

// Очистка памяти
imagedestroy($im);

// Закрытие соединения с базой данных
$conn->close();
?>
