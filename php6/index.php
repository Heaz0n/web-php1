<!DOCTYPE html>
<html>
<head>
    <title>Каталог</title>
</head>
<body>
    <h1>Каталог элементов</h1>
    <a href="create.php">Добавить элемент</a>
    <br><br>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Изображение</th>
            <th>Действия</th>
        </tr>
        <?php
        require_once 'config.php';

        $sql = "SELECT * FROM catalog";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td><img src='" . $row['image'] . "' width='100'></td>";
                echo "<td><a href='edit.php?id=" . $row['id'] . "'>Редактировать</a> | <a href='delete.php?id=" . $row['id'] . "'>Удалить</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Нет элементов в каталоге</td></tr>";
        }
        ?>
    </table>
</body>
</html>
