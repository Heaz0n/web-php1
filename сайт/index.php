<?php
session_start();

// Проверка авторизации пользователя
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Если пользователь авторизован, то можно отобразить контент страницы
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мой сайт</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <main>
        <h1>Добро пожаловать на мой сайт, <?php echo $_SESSION['username']; ?>!</h1>
        <section>
            <p>Это образцовый абзац.</p>
            <h2>Подзаголовок</h2>
            <h3>Еще один подзаголовок здесь</h3>
            <p>Это еще один абзац с каким-то случайным текстом в нем.</p>
            <h2>Еще подзаголовок</h2>
            <p>Еще один абзац с рандомным текстом.</p>
        </section>
    </main>

    <footer>
        <?php include 'footer.php'; ?>
    </footer>
</body>
</html>
