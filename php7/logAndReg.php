<?php
session_start();

include 'includes/db.php'; // Подключаем файл с настройками для соединения с базой данных

$registration_error = ''; // Переменная для хранения сообщения об ошибке при регистрации
$login_error = ''; // Переменная для хранения сообщения об ошибке при входе

if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['register'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if ($password != $confirm_password) {
            $registration_error = "Пароли не совпадают.";
        } else {
            // Проверяем, существует ли пользователь с таким же именем
            $check_sql = "SELECT * FROM users WHERE username = ?";
            $check_stmt = $pdo->prepare($check_sql);
            $check_stmt->execute([$username]);
            $existing_user = $check_stmt->fetch();

            if ($existing_user) {
                $registration_error = "Этот аккаунт уже существует";
            } else {
                $sql = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
                $stmt = $pdo->prepare($sql);

                if ($stmt->execute([$username, $password, 'user'])) {
                    header("Location: index.php#login?registration=success");
                    exit();
                } else {
                    $registration_error = "При регистрации произошла ошибка: " . $stmt->errorInfo()[2];
                }
            }
        }
    } else {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username, $password]);
        $user = $stmt->fetch();

        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            header("Location: index.php");
            exit();
        } else {
            $login_error = "Неправильное имя пользователя или пароль.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход и регистрация</title>
    <style>
body {
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    font-family: 'Jost', sans-serif;
    background: linear-gradient(to bottom, #0575E6, #021B79); /* Градиент от светлого синего к темному синему */
}
.main {
    width: 350px;
    height: 500px;
    overflow: hidden;
    border-radius: 10px;
    box-shadow: 5px 20px 50px #000;
}
#chk {
    display: none;
}
.signup, .login {
    position: relative;
    width: 100%;
    height: 100%;
    transition: .5s ease-in-out;
}
label {
    color: #fff;
    font-size: 2.3em;
    justify-content: center;
    display: flex;
    margin: 60px;
    font-weight: bold;
    cursor: pointer;
    transition: .5s ease-in-out;
}
input {
    width: 60%;
    height: 20px;
    background: #e0dede;
    justify-content: center;
    display: flex;
    margin: 20px auto;
    padding: 10px;
    border: none;
    outline: none;
    border-radius: 5px;
}
button {
    width: 60%;
    height: 40px;
    margin: 10px auto;
    justify-content: center;
    display: block;
    color: #fff;
    background: #573b8a;
    font-size: 1em;
    font-weight: bold;
    margin-top: 20px;
    outline: none;
    border: none;
    border-radius: 5px;
    transition: .2s ease-in;
    cursor: pointer;
}
button:hover {
    background: #6d44b8;
}
.login {
    height: 460px;
    background: #eee;
    border-radius: 60% / 10%;
    transform: translateY(-180px);
}
.login label {
    color: #573b8a;
    transform: scale(.6);
}
#chk:checked ~ .login {
    transform: translateY(-500px);
}
#chk:checked ~ .login label {
    transform: scale(1);    
}
#chk:checked ~ .signup label {
    transform: scale(.6);
}
.message {
    color: red; 
    font-size: 18px;
    margin-top: 10px;
    text-align: center;
}
</style>
</head>
<body>
    <div class="main">
        <input type="checkbox" id="chk">
        <div class="signup">
            <label for="chk">Зарегистрироваться</label>
            <div class="message">
                <?php echo $registration_error; ?>
            </div>
            <form action="logAndReg.php" method="post">
                <input type="text" name="username" id="username" placeholder="Логин" required>
                <input type="password" name="password" id="password" placeholder="Пароль" required>
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Подтвердите пароль" required>
                <button type="submit">Регистрация</button>
                <input type="hidden" name="register" value="1">
            </form>
        </div>
        <div class="login" id="login">
            <label for="chk">Вход</label>
            <div class="message">
                <?php echo $login_error; ?>
            </div>
            <form action="logAndReg.php" method="post">
                <input type="text" name="username" id="username" placeholder="Логин" required>
                <input type="password" name="password" id="password" placeholder="Пароль" required>
                <button type="submit">Вход</button>
                <input type="hidden" name="login" value="1">
            </form>
        </div>
    </div>
</body>
</html>
