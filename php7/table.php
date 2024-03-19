<?php
// Подключение к базе данных
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "php7";

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получение данных из таблицы users
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

echo "<!DOCTYPE html>";
echo "<html>";
echo "<head>";
echo "<title>Пользователи</title>";
echo "<style>";
echo "table {";
echo "  border-collapse: collapse;";
echo "  width: 100%;";
echo "}";
echo "th, td {";
echo "  border: 1px solid black;";
echo "  padding: 8px;";
echo "}";
echo "th {";
echo "  background-color: #f2f2f2;";
echo "}";
echo "</style>";
echo "</head>";
echo "<body>";

if ($result->num_rows > 0) {
    // Вывод данных каждой строки таблицы
    echo "<h2>Список пользователей:</h2>";
    echo "<table>";
    echo "<tr><th>ID</th><th>Username</th><th>Password</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["id"]."</td><td>".$row["username"]."</td><td>".$row["password"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 результатов";
}

echo "</body>";
echo "</html>";

$conn->close();
?>
