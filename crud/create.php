<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Создать новый товар</title>
</head>
<body>
    <h2>Создать новый товар</h2>
    <form action="create_process.php" method="post">
        Название: <input type="text" name="name"><br>
        Описание: <textarea name="description"></textarea><br>
        Цена: <input type="text" name="price"><br>
        <input type="submit" value="Создать">
    </form>
</body>
</html>
