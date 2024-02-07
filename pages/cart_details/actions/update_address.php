<?php
require_once '../../../connection.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['id_user'])) {
    echo 'No User';
    exit();
}

$userID = $_SESSION['id_user'];

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if new address, province, and city are set in POST data
    if (isset($_POST['newAddress']) && isset($_POST['province']) && isset($_POST['city'])) {
        // Sanitize the input to prevent SQL injection
        $newAddress = filter_var($_POST['newAddress'], FILTER_SANITIZE_STRING);
        $province = filter_var($_POST['province'], FILTER_SANITIZE_STRING);
        $city = filter_var($_POST['city'], FILTER_SANITIZE_STRING);

        // Prepare and execute the update query
        $updateAddress = $conn->prepare('UPDATE customers SET complete_address = ?, province = ?, customer_city = ? WHERE customer_id = ?');
        $updateAddress->execute([$newAddress, $province, $city, $userID]);

        // Check if the update was successful
        if ($updateAddress->rowCount() > 0) {
             echo json_encode([$newAddress, $province, $city]);
        } else {
            echo 'Failed to update address';
        }
    } else {
        echo 'Incomplete data provided';
    }
} else {
    echo 'Invalid request';
}
?>
