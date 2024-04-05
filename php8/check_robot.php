<!DOCTYPE html>
<html>
<head>
    <title>Robot Check</title>
</head>
<body>
    <?php
    // Проверяем, был ли отправлен текст для проверки на робота
    if(isset($_POST['robot_verification'])) {
        $user_text = $_POST['robot_verification'];

        // Пример условия для проверки на робота (здесь можно вставить свою логику проверки)
        if ($user_text === "I am not a robot") {
            echo "Вы не робот!";
        } else {
            echo "Вы робот!";
        }
    } else {
        echo "Текст для проверки на робота не был отправлен!";
    }
    ?>
</body>
</html>
