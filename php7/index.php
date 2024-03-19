<?php
session_start();

// Подключение к базе данных
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "php7";

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Функция регистрации пользователя
function registerUser($username, $password, $role) {
    global $conn;
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$hashedPassword', '$role')";
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Функция авторизации пользователя
function loginUser($username, $password) {
    global $conn;
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            return true;
        }
    }
    return false;
}

// Получение данных из таблицы пользователей
function getUsersData() {
    global $conn;
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);
    $usersData = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $usersData[] = $row;
        }
    }
    return $usersData;
}

// SQL-запрос для получения всех пользователей
$sql = "SELECT id, username, password FROM users";
$result = $conn->query($sql);

// Вывод таблицы пользователей
if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Username</th><th>Password</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["id"]."</td><td>".$row["username"]."</td><td>".$row["password"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 результатов";
}


// Проверка наличия сессии пользователя
function isLoggedIn() {
    return isset($_SESSION['username']);
}

// Проверка роли пользователя
function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}
// Функция для хэширования пароля
function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

// Функция для проверки пароля
function verifyPassword($password, $hash) {
    return password_verify($password, $hash);
}



// Если отправлена форма включения шифрования
if (isset($_POST['enable_encryption'])) {
    enableEncryption();
}

// Если отправлена форма выключения шифрования
if (isset($_POST['disable_encryption'])) {
    disableEncryption();
}
// Если отправлена форма регистрации
if (isset($_POST['register']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role']; // Предполагается, что здесь будет выпадающий список с выбором роли
    if (registerUser($username, $password, $role)) {
        echo "Registration successful.";
    } else {
        echo "Error: Registration failed.";
    }
}

// Если отправлена форма авторизации
if (isset($_POST['login']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (loginUser($username, $password)) {
        echo "Login successful.";
    } else {
        echo "Invalid username or password.";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Пользователи</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<?php
session_start();
// Функция для включения шифрования
function enableEncryption() {
    global $conn;
    $sql = "ALTER TABLE users MODIFY COLUMN password VARCHAR(255) NOT NULL";
    if ($conn->query($sql) === TRUE) {
        echo "Encryption enabled.";
    } else {
        echo "Error enabling encryption: " . $conn->error;
    }
}

// Функция для отключения шифрования
function disableEncryption() {
    global $conn;
    $sql = "ALTER TABLE users MODIFY COLUMN password VARCHAR(255)";
    if ($conn->query($sql) === TRUE) {
        echo "Encryption disabled.";
    } else {
        echo "Error disabling encryption: " . $conn->error;
    }
}

// Если отправлена форма включения шифрования
if (isset($_POST['enable_encryption'])) {
    enableEncryption();
}

// Если отправлена форма выключения шифрования
if (isset($_POST['disable_encryption'])) {
    disableEncryption();
}

if (isLoggedIn()) {
    echo "Hello, " . $_SESSION['username'] . "!";

    if (isAdmin()) {
        echo "<br><a href='admin_page.php'>Admin Panel</a>";
    } else {
        echo "<br><a href='user_page.php'>Additional Page for User</a>";
    }

    echo "<br><a href='javascript:history.go(-1)'>Назад</a>";
    echo "<br><a href='logout.php'>Выход</a>";
}

if (!isLoggedIn()) {
    ?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        Username: <input type="text" name="username"><br>
        Password: <input type="password" name="password"><br>
        Role: <input type="text" name="role"><br>
        <input type="submit" value="Register" name="register">
    </form>

    <br>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        Username: <input type="text" name="username"><br>
        Password: <input type="password" name="password"><br>
        <input type="submit" value="Login" name="login">
    </form>
<?php
}
$conn->close();
?>

<!-- Форма для включения и выключения шифрования -->
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="submit" name="enable_encryption" value="Включить шифрование">
    <input type="submit" name="disable_encryption" value="Выключить шифрование">
</form>

</body>
</html>

