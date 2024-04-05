<?php
session_start();

include 'includes/db.php';

// Проверяем, существует ли ключ 'role' в сессии и является ли пользователь администратором
if (!isset($_SESSION['role']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'user')) {
    header("Location: index.php"); // Перенаправляем на главную страницу, если роль не установлена или не является администратором или пользователем
    exit();
}

// Проверяем роль пользователя: admin или user
$upload_permission = ($_SESSION['role'] === 'admin') ? true : false;

// Проверяем, была ли отправлена форма и имеет ли пользователь разрешение на загрузку изображений
if ($_SERVER["REQUEST_METHOD"] == "POST" && $upload_permission && isset($_FILES["file"])) {
    $target_dir = "images//";
    $target_file = $target_dir . uniqid() . '_' . basename($_FILES["file"]["name"]);

    // Проверяем размер файла (5MB)
    if ($_FILES["file"]["size"] > 5 * 1024 * 1024) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Проверяем формат файла
    $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
    $fileExt = strtolower(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION));
    if (!in_array($fileExt, $allowedExtensions)) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Перемещаем файл, если все проверки пройдены
    if ($uploadOk != 0 && move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        // Сохранение информации о файле в базе данных
        $title = basename($_FILES["file"]["name"]);
        $views = 0;
        $likes = 0;

        $sql = "INSERT INTO images (title, filename, user_id, views, likes) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute([$title, $target_file, $_SESSION['user_id'], $views, $likes])) {
            echo "File uploaded successfully.";
        } else {
            echo "Sorry, there was an error uploading your file to the database.";
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Image</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header class="header">
    <h1>Welcome, <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'User'; ?>!</h1>
</header>

<div class="container">
    <h2>Upload Image</h2>
    <?php if ($upload_permission): ?>
    <form action="upload.php" method="post" enctype="multipart/form-data" class="upload-form">
        <input type="file" name="file" id="file">
        <button type="submit" name="submit">Upload</button>
    </form>
    <?php else: ?>
    <p>Sorry, you don't have permission to upload images.</p>
    <?php endif; ?>

    <a href="index.php">Back</a>
</div>

<footer class="footer">
    <p>&copy; 2024 Your Website</p>
</footer>
</body>
</html>
