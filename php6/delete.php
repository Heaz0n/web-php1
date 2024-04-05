<?php
// Подключаем файл с подключением к базе данных
require_once 'db_connection.php';

// Проверяем, существует ли ключ 'id' в массиве $_GET
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Удаление товара из базы данных
    $sql = "DELETE FROM products WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Не указан id товара.";
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
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <input type="hidden" name="id" value="<?php echo isset($id) ? $id : ''; ?>">
    <input type="submit" value="Да">
    <a href="index.php">Нет</a>
</form>

</body>
</html>

<?php
$conn->close();
?>
