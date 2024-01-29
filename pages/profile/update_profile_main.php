<?php
require_once '../../connection.php';
session_start();
$userID = $_SESSION['id_user'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $country = $_POST['country'] ?? '';


    $updateQuery = $conn->prepare("UPDATE customers SET customer_name = ?, customer_email = ?, customer_country = ? WHERE customer_id = ?");
    $updateResult = $updateQuery->execute([$name, $email, $country, $userID]);

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
