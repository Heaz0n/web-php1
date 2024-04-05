<?php
// Подключаем файл с конфигурацией базы данных
require_once 'db_connection.php';

// Создаем соединение с базой данных
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем соединение с базой данных
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Обработка формы добавления
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Подготавливаем SQL запрос с использованием подготовленных выражений
    $sql = "INSERT INTO products (name, description, price) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Привязываем параметры к подготовленному выражению
    $stmt->bind_param("sss", $name, $description, $price);

    // Получаем данные из формы
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Выполняем запрос
    if ($stmt->execute()) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Добавить товар</title>
</head>
<body>

<h2>Добавить товар</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Название: <input type="text" name="name"><br>
    Описание: <textarea name="description"></textarea><br>
    Цена: <input type="text" name="price" pattern="\d+(\.\d)?" title="Введите только цифры"><br>
    <input type="submit" value="Добавить">
</form>

</body>
</html>

<?php
$conn->close();
?>
