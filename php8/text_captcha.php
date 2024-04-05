<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Текстовая капча</title>
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
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
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
        <h2>Введите текст с картинки:</h2>
        <div class="captcha-image">
            <img src="gentext_captcha.php" alt="Captcha">
        </div>
        <form id="captchaForm">
            <div class="form-group">
                <label for="captcha">Текст с картинки:</label>
                <input type="text" id="captcha" name="captcha" placeholder="Введите текст с картинки">
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
            xhr.open('POST', 'verify_text_captcha.php', true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    document.getElementById('captchaResult').innerHTML = xhr.responseText; // Выводим уведомление
                    document.querySelector('.captcha-image img').src = 'gentext_captcha.php?' + Math.random(); // Обновляем изображение капчи
                }
            };
            xhr.send(formData);
        });
    </script>
</body>
</html>
