<?php
require_once '../../connection.php';
session_start();
$userID = $_SESSION['id_user'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $completeAddress = $_POST['complete_address'] ?? '';
    $province = $_POST['province'] ?? '';
    $city = $_POST['city'] ?? '';
    $barangay = $_POST['barangay'] ?? '';


    $uploadsDirectory = "../../updateUploads/";
    if (!is_dir($uploadsDirectory)) {
        mkdir($uploadsDirectory, 0777, true); // Creates the directory recursively
    }

    // Check if file is uploaded successfully
    if(isset($_FILES['customer_image']) && $_FILES['customer_image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['customer_image']['tmp_name'];
        $fileName = $_FILES['customer_image']['name'];
        // Move the uploaded file to the desired location
        $targetPath = $uploadsDirectory . $fileName; // Adjust the target directory as per your requirement
        move_uploaded_file($fileTmpPath, $targetPath);
    } else {
        // Handle if no file is uploaded or if there's an error
    }


    $updateQuery = $conn->prepare("UPDATE customers 
                                    SET customer_name = ?, 
                                        customer_email = ?, 
                                        complete_address = ?, 
                                        customer_image = ?, 
                                        province = ?, 
                                        customer_city = ?,
                                        customer_barangay = ?
                                    WHERE customer_id = ?");
    $updateResult = $updateQuery->execute([$name, $email, $completeAddress, $fileName, $province, $city, $barangay, $userID]);

    // $updateQuery = $conn->prepare("UPDATE customers SET customer_name = ?, customer_email = ?, complete_address = ?, customer_image = ? WHERE customer_id = ?");
    // $updateResult = $updateQuery->execute([$name, $email, $completeAddress, $fileName, $userID]);

    if ($updateResult) {

        echo json_encode(['success' => true]);
    } else {

        echo json_encode(['success' => false, 'message' => 'Failed to update profile. Please try again.']);
    }
} else {
    // Invalid request method
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
