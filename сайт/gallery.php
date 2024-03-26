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

// Обработка загрузки файла
if(isset($_FILES['file'])) {
    $file = $_FILES['file'];

    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];

    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');

    if(in_array($fileExt, $allowedExtensions)) {
        if($fileSize <= 5000000) { // Максимальный размер файла (в байтах)
            $fileNameNew = uniqid('', true) . "." . $fileExt;
            $fileDestination = 'images/' . $fileNameNew;
            move_uploaded_file($fileTmpName, $fileDestination);

            // Сохранение информации о файле в базе данных
            $stmt = $conn->prepare("INSERT INTO images (path, size, name) VALUES (?, ?, ?)");
            $stmt->bind_param("sis", $fileDestination, $fileSize, $fileName);
            $stmt->execute();

            // Возвращаем URL нового изображения
            echo json_encode(array("status" => "success", "url" => $fileDestination));
            exit;
        } else {
            echo json_encode(array("status" => "error", "message" => "Размер файла слишком большой. Максимальный размер файла: 5MB."));
            exit;
        }
    } else {
        echo json_encode(array("status" => "error", "message" => "Неверный формат файла. Допустимые форматы: jpg, jpeg, png, gif."));
        exit;
    }
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

