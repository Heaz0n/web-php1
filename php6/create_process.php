<?php
include 'config.php';

$name = $_POST['name'] ?? '';
$description = $_POST['description'] ?? '';
$price = $_POST['price'] ?? '';

// Проверка наличия файла
if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $file = $_FILES['image'];

    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];

    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');

    if(in_array($fileExt, $allowedExtensions)) {
        if($fileError === 0) {
            $fileNameNew = uniqid('', true) . "." . $fileExt;
            $fileDestination = 'uploads/' . $fileNameNew;

            if (move_uploaded_file($fileTmpName, $fileDestination)) {
                // Используем подготовленный запрос для вставки данных
                $sql = "INSERT INTO items (name, description, price, image_path) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sss", $name, $description, $price, $fileDestination);

                if ($stmt->execute()) {
                    echo "Новый товар успешно добавлен";
                } else {
                    echo "Ошибка при выполнении запроса: " . $stmt->error;
                }

                $stmt->close();
            } else {
                echo "Ошибка при перемещении изображения в папку uploads";
            }
        } else {
            echo "Ошибка при загрузке файла: " . $fileError;
        }
    } else {
        echo "Ошибка: Недопустимое расширение файла. Разрешены только файлы типа JPG, JPEG, PNG и GIF.";
    }
} else {
    echo "Ошибка: Не удалось загрузить изображение или файл отсутствует.";
}

$conn->close();
?>
