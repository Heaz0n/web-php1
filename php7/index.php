<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: logAndReg.php");
    exit();
}

include 'includes/db.php'; // Подключаемся к базе данных

// Запрос для получения всех комментариев
$sql = "SELECT * FROM comments";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Проверяем, была ли отправлена форма добавления комментария
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["content"])) {
    // Получаем содержимое комментария из формы
    $content = $_POST["content"];
    
    // Вставляем новый комментарий в базу данных
    $sql = "INSERT INTO comments (author, content) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION['username'], $content]);
    
    // Перезагружаем страницу для отображения нового комментария
    header("Location: index.php");
    exit();
}

// Обработчик лайков
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["comment_id"]) && isset($_POST["action"]) && $_POST["action"] === "like") {
    $commentId = $_POST["comment_id"];
    // Увеличиваем счетчик лайков для комментария в базе данных
    $sql = "UPDATE comments SET likes = likes + 1 WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$commentId]);
    exit();
}

// Обработчик удаления комментариев (только для администратора)
if ($_SESSION['role'] === 'admin' && $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["comment_id"]) && isset($_POST["action"]) && $_POST["action"] === "delete") {
    $commentId = $_POST["comment_id"];
    // Удаляем комментарий из базы данных
    $sql = "DELETE FROM comments WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$commentId]);
    exit();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добро пожаловать</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        /* Стили для комментариев */
        .comment {
            margin-bottom: 20px;
            text-align: center; /* Центрирование комментариев */
        }
        .comment .author {
            font-weight: bold;
        }
        .comment .content {
            margin-left: 20px;
        }
        .comment .likes {
            margin-top: 10px;
        }
        .comment .controls {
            margin-top: 10px;
        }
        .comment .controls .edit, .comment .controls .delete {
            display: none;
        }
        /* Стили для администратора */
        <?php if ($_SESSION['role'] == 'admin'): ?>
        .comment .controls .edit, .comment .controls .delete {
            display: inline;
        }
        <?php endif; ?>
    </style>
</head>
<body>

<header>
    <nav>
        <ul>
            <li><a href="index.php">Главная</a></li>
            <li><a href="contacts.php">Контакты</a></li>
            <li><a href="gallery.php">Галерея</a></li>
        </ul>
    </nav>
</header>

<?php
if ($_SESSION['role'] == 'admin') {
    echo "<h2>Добро пожаловать, Администратор!</h2>";
    echo "<p>Панель администратора: добавление, редактирование, удаление контента.</p>";
} else {
    echo "<h2>Добро пожаловать, Пользователь!</h2>";
    echo "<p>Пользовательский кабинет: просмотр контента, взаимодействие с функциями.</p>";
}
?>

<!-- Кнопка выхода из учетной записи -->
<form action="logout.php" method="post">
    <button type="submit">Выход</button>
</form>

<!-- Форма для добавления комментариев -->
<h2>Добавить комментарий</h2>
<form action="index.php" method="post">
    <textarea name="content" cols="30" rows="5" placeholder="Введите ваш комментарий"></textarea>
    <button type="submit">Отправить</button>
</form>

<!-- Вывод комментариев -->
<h2>Комментарии</h2>
<?php foreach ($comments as $comment): ?>
    <div class="comment">
        <div class="author"><?= $comment['author'] ?></div>
        <div class="content"><?= $comment['content'] ?></div>
        <div class="likes" id="likes<?= $comment['id'] ?>"><?= $comment['likes'] ?> Likes</div> <!-- Отображение количества лайков -->
        <div class="controls">
            <?php if ($_SESSION['role'] === 'admin'): ?>
                <span class="edit">Редактировать</span>
                <span class="delete" data-comment-id="<?= $comment['id'] ?>">Удалить</span>
            <?php endif; ?>
            <button class="like-btn" data-comment-id="<?= $comment['id'] ?>">Лайк</button>
        </div>
    </div>
<?php endforeach; ?>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const likeButtons = document.querySelectorAll('.like-btn');
        likeButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                const commentId = btn.dataset.commentId;
                // Отправить запрос на сервер для увеличения счетчика лайков для комментария с id = commentId
                fetch('index.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({
                        comment_id: commentId,
                        action: 'like',
                    }),
                })
                .then(response => {
                    if (response.ok) {
                        // Обновить отображение количества лайков без перезагрузки страницы
                        const likesContainer = document.getElementById('likes' + commentId);
                        likesContainer.textContent = parseInt(likesContainer.textContent) + 1 + ' Likes';
                    }
                });
            });
        });

        const deleteButtons = document.querySelectorAll('.delete');
        deleteButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                const commentId = btn.dataset.commentId;
                // Отправить запрос на сервер для удаления комментария с id = commentId
                fetch('index.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({
                        comment_id: commentId,
                        action: 'delete',
                    }),
                })
                .then(response => {
                    if (response.ok) {
                        // Удалить соответствующий комментарий из DOM без перезагрузки страницы
                        btn.parentElement.parentElement.remove();
                    }
                });
            });
        });
    });
</script>

</body>
</html>
