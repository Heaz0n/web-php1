<?php
include 'config.php';

// Проверяем, был ли передан параметр id через URL
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM items WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Элемент не найден";
        exit();
    }
} else {
    echo "Ошибка: Не указан ID элемента для редактирования";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Редактировать товар</title>
</head>
<body>
    <h2>Редактировать товар</h2>
    <form action="edit_process.php" method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        Название: <input type="text" name="name" value="<?php echo $row['name']; ?>"><br>
        Описание: <textarea name="description"><?php echo $row['description']; ?></textarea><br>
        Цена: <input type="text" name="price" value="<?php echo $row['price']; ?>"><br>
        <input type="submit" value="Сохранить">
    </form>
</body>
</html>
