<!DOCTYPE html>
<html>
<head>
    <title>Captcha Form</title>
</head>
<body>
    <form action="check_captcha.php" method="post">
        <?php
        // Подключение к базе данных
        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $dbname = "php8";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Получение капчи из базы данных
        $sql = "SELECT value1, value2, operation FROM captcha ORDER BY id DESC LIMIT 1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $value1 = $row['value1'];
            $value2 = $row['value2'];
            $operation = $row['operation'];
        } else {
            echo "No captcha found!";
        }

        // Вывод капчи на экран
        echo "$value1 $operation $value2 = <input type='text' name='captcha'><br>";
        ?>
        <input type="submit" value="Submit">
    </form>
    <form action="create_captcha.php" method="post">
        <input type="submit" value="Restart Captcha">
    </form>
    <form action="javascript:history.back()" method="post">
        <input type="submit" value="Back">
    </form>
</body>
</html>
