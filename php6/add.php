<?php
// Подключение к базе данных
$servername = "127.0.0.1"; // Адрес сервера базы данных
$username = "root"; // Имя пользователя базы данных
$password = ""; // Пароль базы данных
$dbname = "php6"; // Имя базы данных

$conn = new mysqli($servername, $username, $password, $dbname); // Создание соединения с базой данных

// Проверка соединения с базой данных
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); // Вывод сообщения об ошибке и прерывание скрипта, если соединение не установлено
}

// Обработка формы добавления
if ($_SERVER["REQUEST_METHOD"] == "POST") { // Проверка, был ли отправлен POST-запрос
    $name = $_POST['name']; // Получение значения поля "Название" из формы
    $description = $_POST['description']; // Получение значения поля "Описание" из формы
    $price = $_POST['price']; // Получение значения поля "Цена" из формы

    // Формирование SQL запроса для добавления нового товара в базу данных
    $sql = "INSERT INTO products (name, description, price) VALUES ('$name', '$description', '$price')";

    // Выполнение SQL запроса
    if ($conn->query($sql) === TRUE) { // Проверка успешного выполнения SQL запроса
        header("Location: index.php"); // Перенаправление пользователя на главную страницу после успешного добавления товара
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error; // Вывод сообщения об ошибке, если SQL запрос не выполнен
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
    Название: <input type="text" name="name"><br> <!-- Поле для ввода названия товара -->
    Описание: <textarea name="description"></textarea><br> <!-- Поле для ввода описания товара -->
    Цена: <input type="text" name="price"><br> <!-- Поле для ввода цены товара -->
    <input type="submit" value="Добавить"> <!-- Кнопка для отправки формы -->
</form>

</body>
</html>

<?php
$conn->close(); // Закрытие соединения с базой данных
?>
