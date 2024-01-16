<?php
require_once '../connection.php';
if (isset($_POST["customer_name"])) {
    $customer_name = $_POST["customer_name"];
    $customer_email = $_POST["customer_email"];
    $customer_password = $_POST["customer_password"];
}

try {
    $conn->beginTransaction();

    $insertNewAcc = $conn->prepare("INSERT INTO customers( customer_name, customer_email, customer_pass) VALUES (?,?,?)");
    $insertNewAcc->execute([$customer_name, $customer_email, $customer_password]);
    echo "success";
    $conn->commit();
} catch (PDOException $err) {
    $conn->rollBack();
}
