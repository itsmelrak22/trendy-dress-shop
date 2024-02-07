<?php
require_once '../connection.php';

if (
    isset($_POST["customer_name"], $_POST["customer_email"], $_POST["customer_password"], $_POST["complete_address"], $_POST["gender"], $_POST["province"], $_POST["customer_city"])
) {
    // Prepare the data to insert into the database
    $dataToInsert = [
        'customer_name' => $_POST["customer_name"],
        'customer_email' => $_POST["customer_email"],
        'customer_pass' => $_POST["customer_password"],
        'complete_address' => $_POST["complete_address"],
        'gender' => $_POST["gender"],
        'province' => $_POST["province"],
        'customer_city' => $_POST["customer_city"],
        'customer_barangay' => $_POST["customer_barangay"]
    ];

    try {
        $conn->beginTransaction();

        // Prepare and execute the SQL query to insert the data
        $insertItem = $conn->prepare("INSERT INTO customers(customer_name, customer_email, customer_pass, complete_address, gender, province, customer_city, customer_barangay) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $insertItem->execute(array_values($dataToInsert));

        $conn->commit();
        echo "success"; // Send success message back to the client
    } catch (PDOException $err) {
        // Rollback the transaction and echo the error message
        $conn->rollBack();
        echo "error: " . $err->getMessage();
    }
} else {
    echo "error: Required parameters are not set."; // Send error message if required parameters are missing
}
?>
