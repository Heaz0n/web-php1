<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <h2>Gallery</h2>
    <div class="gallery">
        <?php
        // Вывод изображений из базы данных
        $db_host = '127.0.0.1';
        $db_user = 'root';
        $db_password = '';
        $db_name = 'php6';

        $conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT * FROM gallery_images";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<a data-fancybox="images" href="' . $row['image_path'] . '"><img src="' . $row['image_path'] . '" alt="' . $row['image_name'] . '"></a>';
            }
        } else {
            echo "0 results";
        }

        mysqli_close($conn);
        ?>
    </div>

    <!-- Форма загрузки изображения -->
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload Image" name="submit">
    </form>

    <?php include 'footer.php'; ?>
</body>
</html>
