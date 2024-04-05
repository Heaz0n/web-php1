<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Каталог товаров</title>
</head>
<body>

<h2>Каталог товаров</h2>
<table border="1">
    <tr>
        <th>Название</th>
        <th>Описание</th>
        <th>Цена</th>
        <th>Действия</th>
    </tr>
    <?php
    // Подключаем файл с подключением к базе данных
    require_once 'db_connection.php';

    // Получаем список товаров
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["description"] . "</td>";
            echo "<td>" . $row["price"] . "</td>";
            echo "<td><a href='edit.php?id=" . $row["id"] . "'>Редактировать</a> | <a href='delete.php?id=" . $row["id"] . "'>Удалить</a></td>";
            echo "</tr>";
        }
    } else {
        echo "0 результатов";
    }
    ?>
</table>

<a href="add.php">Добавить товар</a>

<?php
// Закрываем соединение
$conn->close();
?>

</body>
</html>
