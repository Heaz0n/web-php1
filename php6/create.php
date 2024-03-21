<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Добавить новый товар</title>
</head>
<body>
    <h2>Добавить новый товар</h2>
    <form action="create_process.php" method="post" enctype="multipart/form-data">
        Название: <input type="text" name="name"><br>
        Описание: <textarea name="description"></textarea><br>
        Цена: <input type="text" name="price"><br>
        Изображение: <input type="file" name="image"><br>
        <input type="submit" value="Добавить">
    </form>
</body>
</html>
