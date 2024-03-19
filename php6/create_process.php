<?php
require_once 'config.php';

// Проверяем, существует ли ключ "name" в массиве $_POST
if(isset($_POST['name'])) {
    $name = $_POST['name'];

    $sql = "INSERT INTO catalog (name) VALUES ('$name')";

    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
    } else {
        echo "Ошибка: " . $sql . "<br>" . mysqli_error($conn);
    }
} else {
    // Если ключ "name" не существует, выводим сообщение об ошибке
    echo "Ошибка: Не удалось получить данные из формы.";
}

mysqli_close($conn);
?>
