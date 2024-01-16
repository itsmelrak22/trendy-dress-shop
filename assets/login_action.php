<?php

require_once '../connection.php';
//   email: $("#inloginemail").val(),
//       pass: $("#inloginpass").val(),
$email = $_POST['email'];
$password = $_POST['pass'];
// $checkUser = $conn->prepare('SELECT a.id,count(a.id) as cnt from users_db a ');
$checkUser = $conn->prepare('SELECT a.customer_id,count(a.customer_id) as cnt from customers a where a.customer_email=? and a.customer_pass=?;');
$checkUser->execute([$email, $password]);
$checkUser_ = $checkUser->fetch();

if ($checkUser_['cnt'] > 0) {
    session_start();
    $_SESSION['id_user'] =
        $checkUser_['customer_id'];
  
    echo 'success';
}
