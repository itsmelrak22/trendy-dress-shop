<?php
require_once '../connection.php';

if (isset($_POST["customer_name"], $_POST["customer_email"], $_POST["customer_password"], $_POST["complete_address"])) {
    $dataToInsert = [
        'customer_name' => $_POST["customer_name"],
        'customer_email' => $_POST["customer_email"],
        'customer_pass' =>  $_POST["customer_password"],
        'complete_address' => $_POST["complete_address"],
        'gender' => $_POST["gender"]
    ];
    try {
        $conn->beginTransaction();

        $insertItem = $conn->prepare("INSERT INTO customers(customer_name, customer_email, customer_pass, complete_address,gender) VALUES (?, ?, ?, ?, ?)");
        $insertItem->execute(array_values($dataToInsert));

        $conn->commit();
        echo "success";
    } catch (PDOException $err) {
        // $conn->rollBack();
        echo "error";
    }
} else {
    echo "error";
}
?>




<!-- <?php
require_once '../connection.php';

if (isset($_POST["customer_name"], $_POST["customer_email"], $_POST["customer_password"],$_POST["gender"], $_FILES["customer_image"])) {
    // Process image upload
    $targetDirectory = "uploads/"; // Specify the directory where you want to save the uploaded images
    
    // Create the folder path if it doesn't exist
    if (!file_exists($targetDirectory)) {
        // Create the directory recursively
        if (!mkdir($targetDirectory, 0777, true)) {
            // Handle error if the directory creation fails
            echo "error: Failed to create folder path: $targetDirectory";
            exit();
        }
    }

    $imageFileName = uniqid() . "_" . basename($_FILES["customer_image"]["name"]); // Generate a unique filename
    $targetFile = $targetDirectory . $imageFileName;
    
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is an actual image or fake image
    $check = getimagesize($_FILES["customer_image"]["tmp_name"]);
    if ($check !== false) {
        // Allow only certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "error: Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            exit();
        }
        // Move uploaded file to specified directory
        if (!move_uploaded_file($_FILES["customer_image"]["tmp_name"], $targetFile)) {
            echo "error: Sorry, there was an error uploading your file.";
            exit();
        }
    } else {
        echo "error: File is not an image.";
        exit();
    }

    // Insert registration details into database
    $dataToInsert = [
        'customer_name' => $_POST["customer_name"],
        'customer_email' => $_POST["customer_email"],
        'customer_pass' => $_POST["customer_password"],
        'gender' => $_POST["gender"],
        'complete_address' => $_POST["complete_address"],
        'customer_image' => $imageFileName // Store only the image filename in the database
    ];
    try {
        $conn->beginTransaction();

        $insertItem = $conn->prepare("INSERT INTO customers(customer_name, customer_email, customer_pass, complete_address,gender, customer_image) VALUES (?, ?, ?, ?, ?, ?)");
        $insertItem->execute(array_values($dataToInsert));

        $conn->commit();
        echo "success";
    } catch (PDOException $err) {
        // $conn->rollBack();
        echo "error: Failed to insert data into database.";
    }
} else {
    echo "error: Required parameters are not set.";
}
?> -->
