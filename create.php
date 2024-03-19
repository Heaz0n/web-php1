<!DOCTYPE html>
<html>
<head>
    <title>Добавить элемент</title>
</head>
<body>
    <h1>Добавить элемент</h1>
    <form action="create_process.php" method="POST" enctype="multipart/form-data">
        Название: <input type="text" name="name"><br>
        Изображение: <input type="file" name="image"><br>
        <input type="submit" value="Сохранить">
    </form>
</body>
</html>
