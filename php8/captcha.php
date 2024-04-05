<?php
// captcha.php

session_start();

// Создаем изображение для капчи
$image = imagecreatetruecolor(200, 50);

// Генерируем случайный фон
$background_color = imagecolorallocate($image, rand(200, 255), rand(200, 255), rand(200, 255));
imagefill($image, 0, 0, $background_color);

// Генерируем случайный текст для капчи
$captcha_text = substr(md5(rand()), 0, 6);
$_SESSION['captcha'] = $captcha_text;

// Наносим текст на изображение
$text_color = imagecolorallocate($image, 0, 0, 0);
imagestring($image, 5, 50, 20, $captcha_text, $text_color);

// Отображаем изображение как капчу
header('Content-type: image/png');
imagepng($image);
imagedestroy($image);
?>
<!-- Форма с капчей -->
<form action="process_form.php" method="post">
    <!-- Остальные поля формы -->
    
    <!-- Капча -->
    <label for="captcha">Введите код с картинки:</label><br>
    <img src="captcha.php" alt="Captcha Image"><br>
    <input type="text" id="captcha" name="captcha" required><br>
    
    <!-- Кнопка отправки формы -->
    <button type="submit">Отправить</button>
</form>
#captcha_image {
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f9f9f9;
    font-family: Arial, sans-serif;
    font-size: 18px;
    padding: 5px;
}