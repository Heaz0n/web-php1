<?php
include 'config.php';

$id = $_POST['id'] ?? '';
$name = $_POST['name'] ?? '';
$description = $_POST['description'] ?? '';
$price = $_POST['price'] ?? '';

// Проверяем, все ли необходимые поля были переданы
if ($id && $name && $description && $price) {
    // Подготовленный запрос для обновления данных
    $sql = "UPDATE items SET name=?, description=?, price=? WHERE id=?";
    $stmt = $conn->prepare($sql);

    // Привязываем параметры к подготовленному запросу
    $stmt->bind_param("sssi", $name, $description, $price, $id);

    // Выполняем запрос
    if ($stmt->execute()) {
        echo "Данные товара успешно обновлены";
    } else {
        echo "Ошибка при выполнении запроса: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Ошибка: Не удалось получить все необходимые данные для обновления товара";
}

$conn->close();
?>
