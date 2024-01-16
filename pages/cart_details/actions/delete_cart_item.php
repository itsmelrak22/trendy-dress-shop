<?php
require_once '../../../connection.php';

$cart_id = $_POST['cartID'];

$deleteItem = $conn->prepare('DELETE FROM cart WHERE p_id=?');
$deleteItem->execute([$cart_id]);

echo 'Item Successfully Removed!';
