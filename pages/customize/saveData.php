<?php
require_once '../../connection.php';
date_default_timezone_set('Asia/Manila');
$today = date('Y-m-d H:i:s');
    // echo "<pre>" ;
    // // echo print_r($_POST["customNote"]);
    // echo print_r($_FILES);
    // echo "</pre>";

    $customer_id                    =   isset($_POST['customer_id']) && $_POST['customer_id']  ? $_POST['customer_id'] : null;
    $customFrontColorPicker         =   isset($_POST['customFrontColorPicker']) && $_POST['customFrontColorPicker']  ? $_POST['customFrontColorPicker'] : null;
    $customFrontSelectedColor       =   isset($_POST['customFrontSelectedColor']) && $_POST['customFrontSelectedColor']  ? $_POST['customFrontSelectedColor'] : null;
    $customFrontFontFamily          =   isset($_POST['customFrontSelectedColor']) && $_POST['customFrontSelectedColor']  ? $_POST['customFrontSelectedColor'] : null;
    $customFrontTextLength          =   isset($_POST['customFrontTextLength']) && $_POST['customFrontTextLength']  ? $_POST['customFrontTextLength'] : null;
    $customFrontTextWidth           =   isset($_POST['customFrontTextWidth']) && $_POST['customFrontTextWidth']  ? $_POST['customFrontTextWidth'] : null;
    $customFrontTextCustomizeBy     =   isset($_POST['customFrontTextCustomizeBy']) && $_POST['customFrontTextCustomizeBy']  ? $_POST['customFrontTextCustomizeBy'] : null;
    $text_input                     =   isset($_POST['text_input']) && $_POST['text_input']  ? $_POST['text_input'] : null;
    $customFrontLogoLength          =   isset($_POST['customFrontLogoLength']) && $_POST['customFrontLogoLength']  ? $_POST['customFrontLogoLength'] : null;
    $customFrontLogoWidth           =   isset($_POST['customFrontLogoWidth']) && $_POST['customFrontLogoWidth']  ? $_POST['customFrontLogoWidth'] : null;
    $customNote                     =   isset($_POST['customNote']) && $_POST['customNote']  ? $_POST['customNote'] : null;
    $customCanvas                   =   isset($_POST['customCanvas']) && $_POST['customCanvas']  ? $_POST['customCanvas'] : null;
    
    $customFrontBackgroundImageInputFile = null;
    $customFrontImageInputFile = null;
    $customGeneratedImage = null;

    
    if($customCanvas){
        $customCanvasDataUrl = explode(',', $customCanvas);
    }

    $dataToInsert = [
        'customer_id'           =>  $customer_id,
        // 'uploaded_image'        =>  $_POST["uploaded_image"],
        'selected_color'        =>  $customFrontSelectedColor,
        'selected_font'         =>  $customFrontFontFamily,
        'text_length'           =>  $customFrontTextLength,
        'text_width'            =>  $customFrontTextWidth,
        'text_input'            =>  $text_input,
        'remarks'               =>  $customNote,
        // 'uploaded_logo'         =>  $_POST["uploaded_logo"],
        'logo_length'           =>  $customFrontLogoLength,
        'logo_width'            =>  $customFrontLogoWidth,
        'created_at'            =>  $today
    ];

    try {
        $conn->beginTransaction();

        $insertItem = $conn->prepare("INSERT INTO custom_product_requests(
                                                    customer_id, 
                                                    selected_color,
                                                    selected_font,
                                                    text_length,
                                                    text_width,
                                                    text_input,
                                                    remarks,
                                                    logo_length,
                                                    logo_width,
                                                    created_at
                                                    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?,?)");
        $insertItem->execute(array_values($dataToInsert));

        $lastInsertedId = $conn->lastInsertId();

        $mainDir = "../../admin_area/";
        $target_dir = "custom_request_images/";
        $target_dir = $target_dir.$lastInsertedId;

        // Create dynamic directories if they do not exist
        if (!file_exists($mainDir.$target_dir . "/background" )) {
            mkdir($mainDir.$target_dir . "/background", 0777, true);
        }
        // Create dynamic directories if they do not exist
        if (!file_exists($mainDir.$target_dir . "/logo" )) {
            mkdir($mainDir.$target_dir . "/logo", 0777, true);
        }
        if (!file_exists($mainDir.$target_dir . "/generated" )) {
            mkdir($mainDir.$target_dir . "/generated", 0777, true);
        }


        // Check if file was uploaded without errors
        if(isset($_FILES["customFrontBackgroundImageInput"]) && $_FILES["customFrontBackgroundImageInput"]["error"] == 0){
            $customFrontBackgroundImageInputFile = $target_dir . "/background/" . basename($_FILES["customFrontBackgroundImageInput"]["name"]);

            // Save file to target directory
            if(move_uploaded_file($_FILES["customFrontBackgroundImageInput"]["tmp_name"], $mainDir.$customFrontBackgroundImageInputFile)){
                // echo "Your file ". basename( $_FILES["customFrontBackgroundImageInput"]["name"]). " has been uploaded.";
            } else{
                echo "Sorry, there was an error uploading your file.";
            }
        } else{
            // echo "No file was uploaded. (customFrontBackgroundImageInput)" ;
        }

        // Check if file was uploaded without errors
        if(isset($_FILES["customFrontImageInput"]) && $_FILES["customFrontImageInput"]["error"] == 0){
            $customFrontImageInputFile = $target_dir . "/logo/" . basename($_FILES["customFrontImageInput"]["name"]);

            // Save file to target directory
            if(move_uploaded_file($_FILES["customFrontImageInput"]["tmp_name"], $mainDir.$customFrontImageInputFile)){
                // echo "Your file ". basename( $_FILES["customFrontImageInput"]["name"]). " has been uploaded.";
            } else{
                echo "Sorry, there was an error uploading your file.";
            }
        } else{
            // echo "No file was uploaded. (customFrontImageInput)";
        }

        if (isset($customCanvasDataUrl)) { 
            $image_data = base64_decode($customCanvasDataUrl[1]);
            $customGeneratedImage = $target_dir . "/generated_image.png";
            file_put_contents($mainDir.$customGeneratedImage, $image_data);
        }


        $dataToUpdate = [
            'uploaded_image'        =>  $customFrontBackgroundImageInputFile,
            'uploaded_logo'         =>  $customFrontImageInputFile,
            'generated_image'       =>  $customGeneratedImage,
        ];

        $dataToUpdate[] = $lastInsertedId;


        $updateItem = $conn->prepare("UPDATE custom_product_requests SET 
            uploaded_image = ?, 
            uploaded_logo = ?, 
            generated_image = ? 
        WHERE id = ?");

        $updateItem->execute(array_values($dataToUpdate));

        $conn->commit();
        echo "success"; // Send success message back to the client
    } catch (PDOException $err) {
        // Rollback the transaction and echo the error message
        $conn->rollBack();
        echo "error: " . $err->getMessage();
    }
