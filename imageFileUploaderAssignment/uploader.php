<?php
    $target_directory = "uploadedImgs/";
    $target_file = $target_directory . basename($_FILES["uploaded"]["name"]);
    $uploadOk = 1;
    $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    //  check that image file is an image

    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["uploaded"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        }
        else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    //  check if image already exists

    if (file_exists($target_file)) {
        echo "Sorry, the file already exists.";
        $uploadOk = 0;
    }

    //  check file size

    if ($_FILES["uploaded"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    //  check and limit image file types

    if ($image_file_type != "jpg" && $image_file_type != "jpeg" && $image_file_type != "png" && $image_file_type != "gif") {
        echo "Only JPG, JPEG, PNG, & GIF files can be uploaded.";
        $uploadOk = 0;
    }

    //  check if file is acceptable for upload

    if ($uploadOk == 0) {
        echo "Your file was not uploaded.";
    }
    else {
        if (move_uploaded_file($_FILES["uploaded"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["uploaded"]["name"])) . " has been sucessfully uploaded.";
        }
        else {
            echo "There was an error uploading the file.";
        }
    }

?>