<?php
// logout.php

session_start();

// Удаляем все данные сеанса
session_unset();

// Уничтожаем сессию
session_destroy();

// Проверяем, был ли пользователь администратором
if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    // Если пользователь был администратором, перенаправляем на страницу регистрации
    header("Location: logAndReg.php");
} else {
    // Если пользователь был обычным пользователем, перенаправляем на страницу авторизации
    header("Location: logAndReg.php");
}
exit();
?>
