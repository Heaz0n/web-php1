<?php
require_once 'config.php';

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Получаем путь к изображению по ID из базы данных
    $sql = "SELECT image_path FROM catalog WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) { // Проверяем, есть ли строки в результате запроса
        $row = mysqli_fetch_assoc($result);
        $image_path = $row['image_path'];

        // Проверяем, существует ли файл изображения
        if(file_exists($image_path)) {
            // Удаляем файл изображения с сервера
            unlink($image_path);
        }

        // Удаляем элемент из каталога
        $delete_sql = "DELETE FROM catalog WHERE id=$id";

        if (mysqli_query($conn, $delete_sql)) {
            // Если успешно удалено, перенаправляем на главную страницу
            header("Location: index.php");
        } else {
            // Если произошла ошибка при удалении, выводим сообщение об ошибке
            echo "Ошибка: " . $delete_sql . "<br>" . mysqli_error($conn);
        }
    } else {
        // Если запрос не вернул строки, выводим сообщение об ошибке
        echo "Ошибка: Не удалось найти элемент с указанным ID для удаления.";
    }
} else {
    // Если не удалось получить ID элемента для удаления, выводим соответствующее сообщение
    echo "Ошибка: Не удалось получить ID элемента для удаления.";
}

mysqli_close($conn);
?>
