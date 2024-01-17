<?php
require_once '../../../connection.php';
session_start();

if (!isset($_SESSION['id_user'])) {
    echo 'No User';
    exit();
}

$userID = $_SESSION['id_user'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
    $newAddress = isset($_POST['newAddress']) ? $_POST['newAddress'] : '';

    $updateAddress = $conn->prepare('UPDATE customers SET complete_address = ? WHERE customer_id = ?');
    $updateAddress->execute([$newAddress, $userID]);

    
    if ($updateAddress->rowCount() > 0) {
        echo 'Address updated successfully';
    } else {
        echo 'Failed to update address';
    }
} else {
    echo 'Invalid request';
}


?>
