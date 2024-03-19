<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
    $file_name = $_FILES["image"]["name"];
    $file_tmp = $_FILES["image"]["tmp_name"];
    $file_size = $_FILES["image"]["size"];
    $file_type = $_FILES["image"]["type"];

    $name = $_POST["name"]; // Имя изображения, может быть также введено пользователем
    $path = "path//" . $file_name;

    if (move_uploaded_file($file_tmp, $path)) {
        $insert_query = "INSERT INTO images (path, size, name) VALUES ('$path', '$file_size', '$name')";
        mysqli_query($conn, $insert_query);
        header("Location: index.php"); // Перенаправляем обратно на главную страницу
    } else {
        echo "Ошибка при загрузке изображения.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Загрузка изображения</title>
</head>
<body>
    <h1>Загрузка изображения</h1>
    <form action="upload_image.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Имя изображения"><br>
        <input type="file" name="image" accept="image/*"><br>
        <input type="submit" value="Загрузить">
    </form>
</body>
</html>
