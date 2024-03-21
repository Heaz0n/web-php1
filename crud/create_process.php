<?php
include 'config.php';

$name = $_POST['name'] ?? '';
$description = $_POST['description'] ?? '';
$price = $_POST['price'] ?? '';

// Проверяем, что цена не пустая и содержит корректное числовое значение
if (!empty($price) && is_numeric($price)) {
    // Используем подготовленный запрос для вставки данных
    $sql = "INSERT INTO items (name, description, price) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $description, $price);

    if ($stmt->execute()) {
        echo "Новый товар успешно добавлен";
    } else {
        echo "Ошибка при выполнении запроса: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Ошибка: Пожалуйста, укажите корректное значение для цены.";
}

$conn->close();
?>
