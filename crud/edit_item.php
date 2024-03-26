<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Item</title>
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

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // Получение данных элемента из базы данных
        $item_id = $_GET['id'];
        $sql = "SELECT * FROM items WHERE id = $item_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $name = $row['name'];
            $description = $row['description'];
            // Другие поля элемента каталога
        }
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Обработка данных формы
        $name = $_POST['name'];
        $description = $_POST['description'];
        // Другие поля элемента каталога

        // Обновление данных элемента в базе данных
        $sql = "UPDATE items SET name='$name', description='$description' WHERE id=$item_id";
        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }

    $conn->close();
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>"><br>
        <label for="description">Description:</label><br>
        <textarea id="description" name="description"><?php echo $description; ?></textarea><br>
        <!-- Другие поля элемента каталога -->
        <input type="submit" value="Save">
        <input type="button" value="Delete" onclick="deleteItem()">
    </form>

    <script>
        function deleteItem() {
            if (confirm("Are you sure you want to delete this item?")) {
                window.location.href = "delete_item.php?id=<?php echo $item_id;
