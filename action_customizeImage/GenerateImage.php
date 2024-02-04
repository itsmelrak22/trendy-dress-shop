<?php
session_start();

require_once '../connection.php';
if (isset($_SESSION['id_user'])) {
    $userID = $_SESSION['id_user'];

    $dataURLtempFront = explode(',', $_POST['dataURLtempFront']);
    $dataURLtempBack = explode(',', $_POST['dataURLtempBack']);
    // $dataURLtempFront = $_POST['dataURLtempFront'];
    // $dataURLtempBack = $_POST['dataURLtempBack'];

    echo 'test';
       
    
    exit();

    if (isset($_POST['tempFront'])) {
        $tempFront = $_POST['tempFront'];
    }

    if (isset($_POST['tempBack'])) {
        $tempBack = $_POST['tempBack'];
    }

    $quantity = $_POST['quantity'];
    $id = $_POST['id'];
    $size = $_POST['size'];
    $priceTotal = 1000;
    $status = 0;
    
    try {
        $conn->beginTransaction();
        $insert = $conn->prepare('INSERT into cart(product_id,qty,Total_p_price,size,frontImage,backImage,user_id,status) values(?,?,?,?,?,?,?,?)');
        $insert->execute([$id, $quantity, $priceTotal, $size, $dataURLtempFront[1], $dataURLtempBack[1], $userID, $status]);
        $lastKey = $conn->lastInsertId('p_id');

        if (isset($_POST['dataURLtempFront'])) { 
            $image_data = base64_decode($dataURLtempFront[1]);
            file_put_contents("../admin_area/order_images/generated_front_$lastKey.png", $image_data);
        }
        if (isset($_POST['dataURLtempBack'])) {
            $image_data = base64_decode($dataURLtempBack[1]);

            file_put_contents("../admin_area/order_images/generated_back_$lastKey.png", $image_data);
         }


        if (isset($_POST['tempFront'])) {
            foreach ($tempFront as $row) {
                $insertLogo = $conn->prepare('INSERT into tbl_logo_list(cartID,logoType,imageBase64) values(?,?,?)');
                $insertLogo->execute([$lastKey, 0, explode(',', $row)[1]]);
                // Save the image to a file
                $imageData = base64_decode(explode(',', $row)[1]);
                file_put_contents("../admin_area/order_images/image_front_$lastKey.png", $imageData);
            }
        }
        if (isset($_POST['tempBack'])) {
            foreach ($tempBack as $row) {
                $insertLogo = $conn->prepare('INSERT into tbl_logo_list(cartID,logoType,imageBase64) values(?,?,?)');
                $insertLogo->execute([$lastKey, 1, explode(',', $row)[1]]);
                // Save the image to a file
                $imageData = base64_decode(explode(',', $row)[1]);
                file_put_contents("../admin_area/order_images/image_back_$lastKey.png", $imageData);
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
?>
