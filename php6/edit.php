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

// Получение id товара из URL
$id = $_GET['id'];

// Получение информации о товаре из базы данных
$sql = "SELECT * FROM products WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// Обработка формы редактирования
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $sql = "UPDATE products SET name='$name', description='$description', price='$price' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Редактирование товара</title>
</head>
<body>

<h2>Редактирование товара</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=$id"); ?>">
    Название: <input type="text" name="name" value="<?php echo $row['name']; ?>"><br>
    Описание: <textarea name="description"><?php echo $row['description']; ?></textarea><br>
    Цена: <input type="text" name="price" value="<?php echo $row['price']; ?>"><br>
    <input type="submit" value="Сохранить">
</form>

</body>
</html>

<?php
$conn->close();
?>