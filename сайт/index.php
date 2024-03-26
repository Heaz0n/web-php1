<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мой сайт</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header id="header"> <!-- Добавляем id="header" для доступа к элементу header -->
        <?php include 'header.php'; ?>
    </header>
    
    <main>
        <h1>Добро пожаловать на мой сайт</h1>
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
