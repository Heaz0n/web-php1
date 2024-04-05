<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Капча на соответствие вещей</title>
    <a href="main.php">Назад</a>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 300px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .captcha-image {
            margin-bottom: 80px;
            max-width: 150%; /* Максимальная ширина изображения равна ширине контейнера */
            max-height: 600px; /* Максимальная высота изображения */
            overflow: center; /* Скрытие части изображения, выходящей за пределы контейнера */
        }
        .captcha-image {
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        .form-group button {
            padding: 8px 15px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Выберите соответствующую категорию:</h2>
        <div class="captcha-image">
            <img src="genobject_captcha.php" alt="Captcha">
        </div>
        <form id="captchaForm">
            <div class="form-group">
                <label for="category">Выберите категорию:</label>
                <select id="category" name="category">
                    <?php
                    // Подключение к базе данных
                    $servername = "127.0.0.1";
                    $username = "root";
                    $password = "";
                    $dbname = "php8";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Проверка подключения
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Получаем список категорий из базы данных
                    $sql = "SELECT DISTINCT category FROM object_captcha";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $category = $row['category'];
                            echo "<option value='$category'>$category</option>";
                        }
                    }

                    // Закрытие соединения с базой данных
                    $conn->close();
                    ?>
                </select>
            </div>
            <div class="form-group">
                <button type="submit">Проверить</button>
            </div>
        </form>
        <div id="captchaResult"></div> <!-- Здесь будет выводиться уведомление -->
    </div>

    <script>
        document.getElementById('captchaForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Предотвращаем отправку формы по умолчанию
            
            // Получаем данные формы
            var formData = new FormData(this);

            // Отправляем AJAX-запрос
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'verify_object_captcha.php', true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    document.getElementById('captchaResult').innerHTML = xhr.responseText; // Выводим уведомление
                    document.querySelector('.captcha-image img').src = 'genobject_captcha.php?' + Math.random(); // Обновляем изображение капчи
                }
            };
            xhr.send(formData);
        });
    </script>
</body>
</html>
