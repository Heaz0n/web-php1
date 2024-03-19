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

// Обработка загрузки файла
if(isset($_FILES['file'])) {
    $file = $_FILES['file'];

    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];

    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');

    if(in_array($fileExt, $allowedExtensions)) {
        $fileNameNew = uniqid('', true) . "." . $fileExt;
        $fileDestination = 'images//' . $fileNameNew;
        move_uploaded_file($fileTmpName, $fileDestination);

        // Сохранение информации о файле в базе данных
        $sql = "INSERT INTO images (path, size, name) VALUES ('$fileDestination', '$fileSize', '$fileName')";
        $conn->query($sql);

        echo "Файл успешно загружен.";
    } else {
        echo "Неверный формат файла. Допустимые форматы: jpg, jpeg, png, gif.";
    }
}
?>