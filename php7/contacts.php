<?php
// contacts.php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: logAndReg.php");
    exit();
}

// Код страницы для всех пользователей
echo "Welcome to Contacts Page!";
// Добавьте здесь контактную информацию для всех пользователей

// Проверяем роль пользователя
if ($_SESSION['role'] == 'admin') {
    // Добавьте здесь дополнительный функционал для администратора
    echo "Admin-specific functionality";
}
?>
