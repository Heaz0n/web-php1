<?php
require_once 'config.php';

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT image FROM catalog WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $image_path = $row['image'];

    if(file_exists($image_path)) {
        unlink($image_path);
    }

    $sql = "DELETE FROM catalog WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
    } else {
        echo "Ошибка: " . $sql . "<br>" . mysqli_error($conn);
    }
} else {
    echo "Ошибка: Не удалось получить ID элемента для удаления.";
}

mysqli_close($conn);
?>
