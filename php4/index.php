<!DOCTYPE html>
<html>
<head>
    <title>Загрузка изображений</title>
</head>
<body>
    <h2>Загрузить изображение</h2>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="file">
        <button type="submit" name="submit">Загрузить</button>
    </form>

    <h2>Перейти к галерее</h2>
    <a href="gallery.php">Перейти к галерее</a>
</body>
</html>
