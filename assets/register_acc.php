<?php
require_once '../connection.php';

if (isset($_POST["customer_name"], $_POST["customer_email"], $_POST["customer_password"])) {
    $dataToInsert = [
        'customer_name' => $_POST["customer_name"],
        'customer_email' => $_POST["customer_email"],
        'customer_pass' =>  $_POST["customer_password"],
        'complete_address' => $_POST["complete_address"]
    ];
    try {
        $conn->beginTransaction();

        $insertItem = $conn->prepare("INSERT INTO customers(customer_name, customer_email, customer_pass, complete_address) VALUES (?, ?, ?, ?)");
        $insertItem->execute(array_values($dataToInsert));

        $conn->commit();
    } catch (PDOException $err) {
        // $conn->rollBack();
        echo "error";
    }
} else {
    echo "error"; // Handle case where required parameters are not set
}
?>
