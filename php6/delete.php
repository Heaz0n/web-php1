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

// Получение id товара из URL и удаление товара из базы данных
$id = $_GET['id'];

$sql = "DELETE FROM products WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
} else {
    echo "Error deleting record: " . $conn->error;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Удаление товара</title>
</head>
<body>

<h2>Удаление товара</h2>
<p>Вы уверены, что хотите удалить этот товар?</p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=$id"); ?>">
    <input type="submit" value="Да">
    <a href="index.php">Нет</a>
</form>

</body>
</html>

<?php
$conn->close();
?>
