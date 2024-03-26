<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Каталог</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php
    // Подключение к базе данных
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "crud";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Выборка всех элементов каталога
    $sql = "SELECT id, name FROM items";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<ul>";
        while($row = $result->fetch_assoc()) {
            echo "<li><a href='edit_item.php?id=".$row["id"]."'>" . $row["name"] . "</a></li>";
        }
        echo "</ul>";
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>
</body>
</html>
