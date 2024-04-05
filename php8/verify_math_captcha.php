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

// Получение введенного пользователем ответа на капчу
$user_answer = isset($_POST['captcha']) ? $_POST['captcha'] : null;

if ($user_answer === null) {
    echo "Ошибка! Поле captcha не было отправлено.";
    exit; 
}

// Получение правильного ответа на капчу из базы данных
$sql = "SELECT result FROM captcha ORDER BY id DESC LIMIT 1"; // Получаем последнюю добавленную капчу
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $correct_answer = $row['result'];

    // Проверка правильности ответа
    if ($user_answer == $correct_answer) {
        echo "Поздравляем! Капча пройдена успешно.";
    } else {
        echo "Ошибка! Попробуйте еще раз.";
    }
} else {
    echo "Ошибка! Капча не найдена.";
}

// Закрытие соединения с базой данных
$conn->close();
?>
