<?php
session_start();

include 'includes/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: logAndReg.php");
    exit();
}

if (isset($_GET['image_id'])) {
    $image_id = $_GET['image_id'];

    $stmt = $pdo->prepare("SELECT * FROM images WHERE id = ?");
    $stmt->execute([$image_id]);
    $image = $stmt->fetch();

    if ($image) {
        // Удаление изображения из базы данных
        $stmt = $pdo->prepare("DELETE FROM images WHERE id = ?");
        $stmt->execute([$image_id]);

        // Удаление файла из папки
        unlink($image['image_path']);

        header("Location: gallery.php");
        exit();
    }
}
?>
