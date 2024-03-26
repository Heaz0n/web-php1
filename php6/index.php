<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php
    // Подключение к базе данных
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "php6";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Получение списка товаров
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);
    
    ?>
    
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
    
    </body>
    </html>
    
    <?php
    $conn->close();
    ?>