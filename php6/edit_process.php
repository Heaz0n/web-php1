<?php
include 'config.php';

// Проверяем, существуют ли значения в массиве $_POST
if(isset($_POST['id'], $_POST['name'], $_POST['description'], $_POST['price'])) {
    // Присваиваем значения переменным
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Формируем SQL запрос
    $sql = "UPDATE items SET name='$name', description='$description', price='$price' WHERE id=$id";

    // Выполняем запрос
    if ($conn->query($sql) === TRUE) {
        echo "Данные товара успешно обновлены";
    } else {
        echo "Ошибка: " . $sql . "<br>" . $conn->error;
    }
} else {
    // Выводим сообщение об ошибке, если не все данные были отправлены
    echo "Ошибка: Не удалось получить все данные для обновления товара.";
}

$conn->close();
?>
