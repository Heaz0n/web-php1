<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "php6";

// Создаем подключение
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем соединение
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
