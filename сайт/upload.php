<?php
if(isset($_FILES["fileToUpload"])) {
    $target_dir = "path/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Проверка, является ли файл изображением
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Проверка наличия файла
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Проверка размера файла
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Разрешенные форматы файлов
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Проверка наличия ошибок
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";

            // Сохранение пути к изображению в базе данных
            $db_host = '127.0.0.1';
            $db_user = 'root';
            $db_password = '';
            $db_name = 'php6';    

            $conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $image_name = basename($_FILES["fileToUpload"]["name"]);
            $image_path = $target_file;

            $sql = "INSERT INTO gallery_images (image_name, image_path) VALUES ('$image_name', '$image_path')";
            
            if (mysqli_query($conn, $sql)) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

            mysqli_close($conn);
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
} else {
    echo "No file uploaded.";
}
?>

