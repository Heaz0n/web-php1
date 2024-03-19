<?php
// Подключение к базе данных
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "php4";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получение списка изображений из базы данных
$sql = "SELECT * FROM images";
$result = $conn->query($sql);

echo "<h2>Галерея изображений</h2>";

if ($result->num_rows > 0) {
    echo "<div style='display: flex; flex-wrap: wrap;'>";
    while($row = $result->fetch_assoc()) {
        echo "<div style='margin: 10px;'>";
        echo "<a href='" . $row['path'] . "' target='_blank'>";
        echo "<img src='" . $row['path'] . "' style='width: 150px; height: 150px;' />";
        echo "</a>";
        echo "<p>Название: " . $row['name'] . "</p>";
        echo "<p>Размер: " . $row['size'] . " байт</p>";
        echo "<p>Лайки: " . $row['likes'] . "</p>";
        echo "<p>Просмотры: " . $row['views'] . "</p>";
        echo "</div>";
    }
    echo "</div>";
} else {
    echo "Нет изображений.";
}

$conn->close();
?>