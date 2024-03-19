<!DOCTYPE html>
<html>
<head>
    <title>Проверка капчи</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
        }
        .container {
            text-align: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .message {
            font-size: 20px;
            margin-bottom: 20px;
        }
        .button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .button:hover {
            background-color: #0056b3;
        }
        iframe {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
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
                echo "Капча не найдена!";
            }

            // Проверка ответа пользователя
            if ($user_answer == $correct_answer) {
                echo "<div class='message'>Капча пройдена!</div>";
                echo "<button class='button' onclick='window.history.back()'>Назад</button>";
                echo "<form action='create_captcha.php' method='post'>";
                echo "<input class='button' type='submit' value='Рестарт капчи'>";
                echo "</form>";
            } else {
                echo "<div class='message'>Неверная капча!</div>";
                // Воспроизведение видео с YouTube
                echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/1esS29i42mg?autoplay=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>';
                echo "<button class='button' onclick='window.history.back()'>Назад</button>";
                echo "<form action='create_captcha.php' method='post'>";
                echo "<input class='button' type='submit' value='Рестарт капчи'>";
                echo "</form>";
            }
        } else {
            echo "<div class='message'>Капча не предоставлена!</div>";
            echo "<button class='button' onclick='window.history.back()'>Назад</button>";
        }

        // Закрытие соединения с базой данных
        $conn->close();
        ?>
    </div>
</body>
</html>
