<?php

// if (isset($_SESSION['id'])) {
//     echo ("<script>window.location.href = 'login.php';</script>");
//     exit();
// }
// CHECK IF USERID IS SET
session_start();
// if (!isset($_SESSION['id_user'])) {
//     unset($_SESSION['id_user']);
//     unset($_SESSION['access']);
//     //var_dump($_SESSION['id']);
//     echo ("<script>localStorage.clear();window.location.href = 'index.php';</script>");
//     // var_dump($_SESSION['id']);
//     //    echo ("<script>localStorage.clear();window.location.href = 'login.php';</script>");
// }

// CHECK IF USERID EXIST IN DB
// $userid =  base64_decode($_SESSION['nbscisuserid']);
// $selPersonel = $conn->prepare('SELECT count(personelId) as cnt from tblpersonnel2 where personelId = ?');
// $selPersonel->execute([$userid]);
// $pdetails = $selPersonel->fetch();
// if ($pdetails['cnt'] == 0) {
// echo ("<script>localStorage.clear();window.location.href = './pages/login/login_main.php';</script>");
// }


if( isset( $_REQUEST['search'] ) ){
    $searchItem = $_REQUEST['search'];
    $_SESSION['searchItem'] = $searchItem;
    print_r($_SESSION);
}else{
    unset( $_SESSION['searchItem'] );
    unset( $_REQUEST['search'] );
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Home</title>
    
    <!-- Paypal SDK -->
    <script src="https://www.paypal.com/sdk/js?client-id=Ad-DKICXtIrrhJRR4e7Bj1LMfHx1FKNPNf2rCWebJs3aX3Vv7HcNAwVHt8LMov7UJ2A7KRc3c_LrnM0z&currency=PHP&components=buttons,marks&debug=true&disable-funding=credit,card"></script>

</head>

<body>
    <div id="nav_content">

    </div>
    <div id="contents">

    </div>
    <!-- ------FOOTER------- -->
    <?php include 'footer_content/footer.php' ?>

    <!-- ------SCRIPTS---------- -->

    <!-- <script src="assets/js/jquery-3.6.3.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/global.js"></script>
    <script src="assets/js/login_action.js"></script>
    <script src="assets/js/logout.js"></script>
</body>

</html>