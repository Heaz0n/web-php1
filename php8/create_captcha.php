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

// Функция для генерации случайного текстового символа (буквы) или цифры
function generateRandomCharacter() {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    return $characters[rand(0, strlen($characters) - 1)];
}

// Функция для генерации случайной операции
function generateRandomOperation() {
    $operations = array('+', '-', '*', '/');
    return $operations[array_rand($operations)];
}

// Функция для преобразования буквы в число
function convertLetterToNumber($letter) {
    // Преобразуем букву в верхний регистр, чтобы обработать и строчные буквы
    $letter = strtoupper($letter);

    // Проверяем, что символ - буква латинского алфавита
    if (ctype_alpha($letter) && strlen($letter) == 1) {
        // Вычисляем числовое значение буквы
        $number = ord($letter) - 64; // 64 - ASCII-код буквы 'A'
        return $number;
    } else {
        // Если символ не является буквой латинского алфавита, вернем false
        return false;
    }
}

// Генерация капчи
$value1 = generateRandomCharacter();
$value2 = generateRandomCharacter();
$operation = generateRandomOperation();

// Вычисление ответа на капчу
switch ($operation) {
    case '+':
        $answer = convertLetterToNumber($value1) + convertLetterToNumber($value2);
        break;
    case '-':
        $answer = convertLetterToNumber($value1) - convertLetterToNumber($value2);
        break;
    case '*':
        $answer = convertLetterToNumber($value1) * convertLetterToNumber($value2);
        break;
    case '/':
        // Деление на ноль не должно быть разрешено
        do {
            $value2 = generateRandomCharacter();
        } while (convertLetterToNumber($value2) == 0);
        $answer = convertLetterToNumber($value1) / convertLetterToNumber($value2);
        break;
}

// Сохранение капчи в базе данных
$sql = "INSERT INTO captcha (value1, value2, operation, answer) VALUES ('$value1', '$value2', '$operation', '$answer')";
if ($conn->query($sql) === TRUE) {
    echo "Captcha created successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Закрытие соединения с базой данных
$conn->close();
?>
