<?php
include 'config.php';

// Проверяем, существует ли параметр "id" в URL и является ли он числом
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM items WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        echo "Элемент успешно удален";
    } else {
        echo "Ошибка при удалении элемента: " . mysqli_error($conn);
    }
} else {
    echo "Ошибка: Некорректный идентификатор элемента";
}

$conn->close();
?>
