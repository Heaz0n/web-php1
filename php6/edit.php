<?php
// Подключаем файл с подключением к базе данных
require_once 'db_connection.php';

// Проверяем, существует ли ключ 'id' в массиве $_GET
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Получение информации о товаре из базы данных
    $sql = "SELECT * FROM products WHERE id=$id";
    $result = $conn->query($sql);

    // Проверяем, был ли найден товар с указанным id
    if ($result->num_rows > 0) {
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
    } else {
        echo "Товар с указанным id не найден.";
    }
} else {
    echo "Не указан id товара.";
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
<?php
// Проверяем, существует ли переменная $id перед выводом формы
if (isset($id)) {
?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=$id"); ?>">
        Название: <input type="text" name="name" value="<?php echo isset($row['name']) ? $row['name'] : ''; ?>"><br>
        Описание: <textarea name="description"><?php echo isset($row['description']) ? $row['description'] : ''; ?></textarea><br>
        Цена: <input type="text" name="price" value="<?php echo isset($row['price']) ? $row['price'] : ''; ?>" pattern="\d+(\.\d{2})?" title="Введите только цифры"><br>
        <input type="submit" value="Сохранить">
    </form>
<?php
}
?>

</body>
</html>

<?php
$conn->close();
?>
