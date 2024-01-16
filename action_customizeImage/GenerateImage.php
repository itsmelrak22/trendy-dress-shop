<?php
session_start();

require_once '../connection.php';
if (isset($_SESSION['id_user'])) {
    $userID = $_SESSION['id_user'];

    $dataURLtempFront = explode(',', $_POST['dataURLtempFront']);
    $dataURLtempBack = explode(',', $_POST['dataURLtempBack']);

    if (isset($_POST['tempBack'])) {
        $tempFront = $_POST['tempFront'];
    }

    if (isset($_POST['tempBack'])) {
        $tempBack = $_POST['tempBack'];
    }



    $quantity = $_POST['quantity'];
    $id = $_POST['id'];
    $size = $_POST['size'];
    $priceTotal = $_POST['priceTotal'];
    try {
        $conn->beginTransaction();
        $insert = $conn->prepare('INSERT into cart(product_id,qty,Total_p_price,size,frontImage,backImage,user_id) values(?,?,?,?,?,?,?)');
        $insert->execute([$id, $quantity, $priceTotal, $size, $dataURLtempFront[1], $dataURLtempBack[1], $userID]);
        $lastKey = $conn->lastInsertId('p_id');
        if (isset($_POST['tempBack'])) {
            foreach ($tempFront as $row) {
                $insertLogo = $conn->prepare('INSERT into tbl_logo_list(cartID,logoType,imageBase64) values(?,?,?)');
                $insertLogo->execute([$lastKey, 0, explode(',', $row)[1]]);
            }
        }
        if (isset($_POST['tempBack'])) {
            foreach ($tempBack as $row) {
                $insertLogo = $conn->prepare('INSERT into tbl_logo_list(cartID,logoType,imageBase64) values(?,?,?)');
                $insertLogo->execute([$lastKey, 1, explode(',', $row)[1]]);
            }
        }


        $conn->commit();
        echo 'Added to Cart Successfully!';
    } catch (\Throwable $th) {
        echo $th;
        $conn->rollBack();
    }
} else {
    echo "No User";
}
