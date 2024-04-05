<?php
$host = '127.0.0.1'; // Адрес сервера базы данных
$dbname = 'php7'; // Имя вашей базы данных
$username = 'root'; // Ваше имя пользователя базы данных
$password = ''; // Ваш пароль базы данных (если есть)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Устанавливаем режим ошибок PDO на исключения
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}
?>
