<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Каталог товаров</title>
</head>
<body>
    <h2>Каталог товаров</h2>
    <a href="create.php">Добавить новый товар</a>
    <ul>
        <?php
        include 'config.php';

        $sql = "SELECT * FROM items";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<li>{$row['name']} - <a href='edit.php?id={$row['id']}'>Редактировать</a> | <a href='delete_process.php?id={$row['id']}'>Удалить</a></li>";
            }
        } else {
            echo "0 результатов";
        }
        $conn->close();
        ?>
    </ul>
</body>
</html>
