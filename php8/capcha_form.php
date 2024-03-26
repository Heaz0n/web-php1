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

// Функция для генерации случайной текстовой буквы
function generateRandomCharacter() {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    return $characters[rand(0, strlen($characters) - 1)];
}

// Генерация капчи
$value1 = generateRandomCharacter();
$value2 = generateRandomCharacter();

// Вычисление ответа на капчу (вычитание ASCII-кодов символов)
$answer = ord($value1) - ord($value2);

// Сохранение капчи в базе данных
$sql = "INSERT INTO captcha (value1, value2, answer) VALUES ('$value1', '$value2', '$answer')";
if ($conn->query($sql) === TRUE) {
    echo "Captcha created successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Вывод капчи на экран
echo "$value1 - $value2 = ";

// Закрытие соединения с базой данных
$conn->close();
?>


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
        // Форма для ввода ответа на капчу
        echo '<form action="check_captcha.php" method="post">';
        echo '<label for="captcha">Введите ответ на капчу:</label>';
        echo '<input type="text" id="captcha" name="captcha">';
        echo '<input type="submit" value="Проверить">';
        echo '</form>';
        ?>
    </div>
</body>
</html>
