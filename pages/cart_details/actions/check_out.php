<?php
require_once '../../../connection.php';
session_start();

$userID = $_SESSION['id_user'];

$fetch = $conn->prepare('SELECT GROUP_CONCAT(a.p_id) as list_ from cart a where a.user_id=? and a.status=0');
$fetch->execute([$userID]);
$listOfItems = $fetch->fetch();

$fetch_ = $conn->prepare('SELECT count(a.order_id) as countedInvoice from pending_orders a');
$fetch_->execute();
$count_ = $fetch_->fetch();


$temp = $listOfItems['list_'];
try {
    $conn->beginTransaction();


    $insert = $conn->prepare("INSERT INTO pending_orders(customer_id,invoice_no, cartItems,order_status) VALUES (?,?,?,?)");
    $insert->execute([$userID, (intval($count_['countedInvoice']) + 1), $temp, 'pending']);

    $update = $conn->prepare("UPDATE  cart  SET  status=1  where user_id=?");
    $update->execute([$userID]);

    echo "Successfully Checked out!";
    $conn->commit();
} catch (PDOException $err) {
    $conn->rollBack();
    echo $err;
}
