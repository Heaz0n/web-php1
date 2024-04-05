<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Captcha Types</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        h2 {
            text-align: center;
            margin-top: 50px;
        }
        ul {
            list-style-type: none;
            padding: 0;
            margin: 20px auto;
            width: 300px;
            text-align: center;
        }
        li {
            margin-bottom: 10px;
        }
        a {
            display: block;
            padding: 10px;
            background-color: #4caf50;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Выберите тип капчи:</h2>
    <ul>
        <li><a href="math_captcha.php">Математическая капча</a></li>
        <li><a href="text_captcha.php">Текстовая капча</a></li>
        <li><a href="object_captcha.php">Объектная капча</a></li>
    </ul>
</body>
</html>
