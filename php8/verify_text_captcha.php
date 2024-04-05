<?php
session_start();

// Проверяем, был ли введен текст капчи
if (isset($_POST['captcha'])) {
    // Получаем введенный пользователем текст капчи
    $user_captcha = $_POST['captcha'];

    // Подключаемся к базе данных
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "php8";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Проверяем подключение к базе данных
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Получаем сохраненный текст капчи из базы данных
    $sql = "SELECT captcha_text FROM text_captcha ORDER BY created_at DESC LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $captcha_text = $row['captcha_text'];

        // Проверяем совпадение введенного текста с сохраненным текстом капчи
        if ($user_captcha === $captcha_text) {
            echo "Капча пройдена успешно!";
        } else {
            echo "Капча введена неверно!";
        }
    } else {
        echo "Ошибка при получении капчи из базы данных";
    }

    // Закрываем соединение с базой данных
    $conn->close();
} else {
    echo "Ошибка: Текст капчи не был отправлен.";
}
?>
