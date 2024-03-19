<!DOCTYPE html>
<html>
<head>
    <title>Проверка капчи</title>
</head>
<body>
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

    // Получение ответа пользователя на капчу
    if(isset($_POST['captcha'])) {
        $user_answer = $_POST['captcha'];

        // Получение правильного ответа на капчу из базы данных
        $sql = "SELECT answer FROM captcha ORDER BY id DESC LIMIT 1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $correct_answer = $row['answer'];
        } else {
            echo "No captcha found!";
        }

        // Проверка ответа пользователя
        if ($user_answer == $correct_answer) {
            echo "Captcha passed!";
            echo "<br><button onclick='window.history.back()'>Назад</button>";
            echo "<form action='create_captcha.php' method='post'>";
            echo "<input type='submit' value='Рестарт капчи'>";
            echo "</form>";
        } else {
            echo "Incorrect captcha!";
            echo "<br><button onclick='window.history.back()'>Назад</button>";
            echo "<form action='create_captcha.php' method='post'>";
            echo "<input type='submit' value='Рестарт капчи'>";
            echo "</form>";
        }
    } else {
        echo "No captcha provided!";
        echo "<br><button onclick='window.history.back()'>Назад</button>";
    }

    // Закрытие соединения с базой данных
    $conn->close();
    ?>
</body>
</html>
