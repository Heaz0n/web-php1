<?php
// Подключение к базе данных
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "php8";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Функция для генерации случайного текстового символа (буквы)
function generateRandomCharacter() {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    return $characters[rand(0, strlen($characters) - 1)];
}

// Функция для генерации случайной операции
function generateRandomOperation() {
    $operations = array('+', '-', '*', '/');
    return $operations[array_rand($operations)];
}

// Генерация капчи
$value1 = generateRandomCharacter();
$value2 = generateRandomCharacter();
$operation = generateRandomOperation();

// Вычисление ответа на капчу (просто конкатенация символов)
$answer = $value1 . $value2;

// Сохранение капчи в базе данных
$sql = "INSERT INTO captcha (value1, value2, operation, answer) VALUES ('$value1', '$value2', '$operation', '$answer')";
if ($conn->query($sql) === TRUE) {
    echo "Captcha created successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Закрытие соединения с базой данных
$conn->close();
?>
