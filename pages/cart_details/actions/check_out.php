<?php
require_once '../../../connection.php';
session_start();

$userID = $_SESSION['id_user'];

$selectedPaymentMethod = $_POST['paymentMethod'] ?? '';
$selectedProductIds = $_POST['selectedProducts'] ?? array();

// print_r($selectedProductId);

try {
    $conn->beginTransaction();

    // Insert pending order
    $fetch = $conn->prepare('SELECT count(a.order_id) as countedInvoice from pending_orders a');
    $fetch->execute();
    $count_ = $fetch->fetch();

    $insert = $conn->prepare("INSERT INTO pending_orders(customer_id, invoice_no, cartItems, order_status, mop) VALUES (?, ?, ?, ?, ?)");
    $insert->execute([$userID, (intval($count_['countedInvoice']) + 1), implode(',', $selectedProductIds), 'pending', $selectedPaymentMethod]);

    // Update cart status for selected items
    foreach ($selectedProductIds as $selectedProductId) {
        $update = $conn->prepare("UPDATE cart SET status = 1, mop = ? WHERE user_id = ? AND status = 0 AND p_id = ?");
        $update->execute([$selectedPaymentMethod, $userID, $selectedProductId]);
    }

    echo "Successfully Checked out!";
    $conn->commit();
} catch (PDOException $err) {
    $conn->rollBack();
    echo $err;
}
?>
