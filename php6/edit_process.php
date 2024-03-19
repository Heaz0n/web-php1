<?php
require_once 'config.php';

if(isset($_POST['id']) && isset($_POST['name'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];

    $image_name = $_FILES['image']['name'];
    $image_temp = $_FILES['image']['tmp_name'];
    $image_path = 'path//' . $image_name;

    if(move_uploaded_file($image_temp, $image_path)) {
        $sql = "UPDATE catalog SET name='$name', image='$image_path' WHERE id=$id";

        if (mysqli_query($conn, $sql)) {
            header("Location: index.php");
        } else {
            echo "Ошибка: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Ошибка при загрузке изображения.";
    }
} else {
    echo "Ошибка: Не удалось получить данные из формы.";
}

mysqli_close($conn);
?>
