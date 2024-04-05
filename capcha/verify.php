<?php
session_start();

// Проверка наличия введенного значения капчи
if (isset($_POST['captcha']) && !empty($_POST['captcha'])) {
    // Получение значения капчи из сессии
    $captcha_session = $_SESSION['captcha_code'];

    // Получение значения капчи из формы
    $captcha_input = $_POST['captcha'];

    // Подключение к базе данных
    $db_host = '127.0.0.1'; 
    $db_user = 'root';
    $db_pass = '';
    $db_name = 'php8';

    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Проверка введенного значения капчи
    $sql = "SELECT * FROM captcha WHERE captcha_code = '$captcha_session' AND captcha_value = '$captcha_input'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Капча верна
        echo "Капча верна!";
        
        // Удаление капчи из базы данных после проверки
        $sql_delete = "DELETE FROM captcha WHERE captcha_code = '$captcha_session'";
        mysqli_query($conn, $sql_delete);
    } else {
        // Капча неверна
        echo "Капча неверна!";
    }

    // Очистка сессии
    unset($_SESSION['captcha_code']);
} else {
    // Вывести сообщение об ошибке, если введенное значение капчи отсутствует
    echo "Ошибка: Введите значение капчи!";
}
?>
