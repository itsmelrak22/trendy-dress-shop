<?php
require_once '../connection.php';

$email = $_POST['email'];
$password = $_POST['pass'];

$checkUser = $conn->prepare('SELECT a.customer_id, COUNT(a.customer_id) as cnt FROM customers a WHERE a.customer_email=? AND a.customer_pass=? GROUP BY a.customer_id;');
$checkUser->execute([$email, $password]);
$checkUser_ = $checkUser->fetch();

if ($checkUser_['cnt'] > 0) {
    session_start();
    $_SESSION['id_user'] = $checkUser_['customer_id'];
    echo 'success';
}
