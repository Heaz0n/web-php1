<?php
// admin.php

session_start();

// Подключение к базе данных
include 'includes/db.php';


// Проверяем, авторизован ли пользователь как администратор
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: logAndReg.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header class="header">
        <h1>Welcome, Admin!</h1>
    </header>

    <div class="container">
        <h2>Upload Image</h2>
        <form action="upload.php" method="post" enctype="multipart/form-data" class="upload-form">
            <input type="file" name="file" id="file">
            <button type="submit" name="submit">Upload</button>
        </form>
    </div>

    <footer class="footer">
        <p>&copy; 2024 Your Website</p>
    </footer>
</body>
</html>

