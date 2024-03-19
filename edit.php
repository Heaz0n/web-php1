<!DOCTYPE html>
<html>
<head>
    <title>Редактировать элемент</title>
</head>
<body>
    <h1>Редактировать элемент</h1>
    <?php
    require_once 'config.php';

    $id = $_GET['id'];

    $sql = "SELECT * FROM catalog WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>
    <form action="edit_process.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        Название: <input type="text" name="name" value="<?php echo $row['name']; ?>"><br>
        Изображение: <input type="file" name="image"><br>
        <input type="submit" value="Сохранить">
    </form>
</body>
</html>
