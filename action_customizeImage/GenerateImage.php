<?php
session_start();

require_once '../connection.php';

if (isset($_SESSION['id_user'])) {
    $userID = $_SESSION['id_user'];

    $basicInfo = $_POST['basicInfo'];
    $frontViewData = $_POST['frontViewData'];
    $backViewData = $_POST['backViewData'];

    $id = $basicInfo[ "id" ];
    $quantity = $basicInfo[ "quantity" ];
    $size = $basicInfo[ "size" ];
    $priceTotal = $basicInfo[ "priceTotal" ];
    $status = 0;

    if($basicInfo["frontViewChecked"]){
        $frontDataUrl = explode(',', $frontViewData["backgroundImage"]);

        if( isset( $frontViewData["logoInput"] ) && $frontViewData["logoInput"] ){
            $frontLogo = $frontViewData["logoInput"];
        }
    }

    if($basicInfo["backViewChecked"]){
        $backDataUrl = explode(',', $backViewData["backgroundImage"]);

        if( isset( $backViewData["logoInput"] ) && $backViewData["logoInput"] ){
            $backLogo = $backViewData["logoInput"];
        }
    }

    try {
        $conn->beginTransaction();
        $insert = $conn->prepare("INSERT 
                                    INTO cart( `product_id`,
                                                `qty`,
                                                `Total_p_price`,
                                                `size`,
                                                `frontImage`,
                                                `backImage`,
                                                `user_id`,
                                                `status`
                                                ) 
                                    VALUES( ?, ?, ?, ?, ?, ?, ?, ?)");

        $insert->execute([
                            $id, 
                            $quantity, 
                            $priceTotal, 
                            $size, 
                            $frontDataUrl[1], 
                            $backDataUrl[1], 
                            $userID, 
                            $status]
                        );
        $lastKey = $conn->lastInsertId('p_id');

        if (isset($frontDataUrl)) { 
            $image_data = base64_decode($frontDataUrl[1]);
            file_put_contents("../admin_area/order_images/generated_front_$lastKey.png", $image_data);
        }
        if (isset($backDataUrl)) {
            $image_data = base64_decode($backDataUrl[1]);

            file_put_contents("../admin_area/order_images/generated_back_$lastKey.png", $image_data);
         }


        if (isset($frontLogo)) {
            foreach ($frontLogo as $row) {
                $insertLogo = $conn->prepare('INSERT into tbl_logo_list(cartID,logoType,imageBase64) values(?,?,?)');
                $insertLogo->execute([$lastKey, 0, explode(',', $row)[1]]);
                // Save the image to a file
                $imageData = base64_decode(explode(',', $row)[1]);

                $new_target_dir = "../admin_area/order_images/$lastKey/front";

                if (!file_exists( "$new_target_dir" )) {
                    mkdir("$new_target_dir", 0777, true);
                }
                file_put_contents("$new_target_dir/image_front.png", $imageData);
            }
        }
        if (isset($backLogo)) {
            foreach ($backLogo as $row) {
                $insertLogo = $conn->prepare('INSERT into tbl_logo_list(cartID,logoType,imageBase64) values(?,?,?)');
                $insertLogo->execute([$lastKey, 1, explode(',', $row)[1]]);
                // Save the image to a file
                $imageData = base64_decode(explode(',', $row)[1]);
                $new_target_dir = "../admin_area/order_images/$lastKey/back";

                if (!file_exists( "$new_target_dir" )) {
                    mkdir("$new_target_dir", 0777, true);
                }
                file_put_contents("$new_target_dir/image_back.png", $imageData);
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
