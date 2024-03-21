<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Редактировать товар</title>
</head>
<body>
    <h2>Редактировать товар</h2>
    <?php
    include 'config.php';

    // Проверяем, существует ли параметр "id" в URL
    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        // Используем подготовленный запрос для безопасного выполнения SQL запроса
        $sql = "SELECT * FROM items WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
    ?>
    <form action="edit_process.php" method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        Название: <input type="text" name="name" value="<?php echo $row['name']; ?>"><br>
        Описание: <textarea name="description"><?php echo $row['description']; ?></textarea><br>
        Цена: <input type="text" name="price" value="<?php echo $row['price']; ?>"><br>
        <input type="submit" value="Сохранить">
    </form>
    <?php
        } else {
            echo "Элемент не найден";
        }
        $stmt->close();
    } else {
        echo "Ошибка: Не передан идентификатор элемента для редактирования";
    }
    $conn->close();
    ?>
</body>
</html>

