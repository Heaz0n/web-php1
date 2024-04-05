<?php
session_start();

// Соединение с базой данных
$db_host = '127.0.0.1'; 
$db_user = 'root';
$db_pass = '';
$db_name = 'php8';

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Генерация случайной строки для капчи
$captcha_code = substr(md5(mt_rand()), 0, 6);

// Сохранение кода капчи в сессии
$_SESSION['captcha_code'] = $captcha_code;

// Сохранение кода капчи в базе данных
$sql = "INSERT INTO captcha (captcha_code, captcha_value) VALUES ('$captcha_code', '')";
mysqli_query($conn, $sql);

// Вывод кода капчи
echo $captcha_code;
?>
