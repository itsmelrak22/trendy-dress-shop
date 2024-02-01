<?php

spl_autoload_register(function ($class) {
    include '../../../models/' . $class . '.php';
  });

    if (isset($_POST['submit'])) {
      $grouped_files = array_chunk($_FILES, 3, true);
      $explodedString = array();
      $colors = array();
      $urls = array();
      $descs = array();
      $features = array();
      $labels = array();

      foreach ($_POST as $key => $value) {
          if (strpos($key, 'product_color') !== false) {
              $colors[$key] = $value;
          }
          if (strpos($key, 'product_url') !== false) {
              $urls[$key] = $value;
          }
          if (strpos($key, 'product_desc') !== false) {
              $descs[$key] = $value;
          }
          if (strpos($key, 'product_features') !== false) {
              $features[$key] = $value;
          }
          if (strpos($key, 'product_label') !== false) {
              $labels[$key] = $value;
          }
      }

      foreach ($colors as $key => $color) {
        $explodedString = explode('_', $key);
        $number = $explodedString[2];
        $index = $explodedString[2] - 1;
        $grouped_files[ $index ]["number"] = $number;
        $grouped_files[ $index ]["color"] = $color;
        $grouped_files[ $index ]["url"] =  $urls[ "product_url_$number" ];
        $grouped_files[ $index ]["desc"] =  $descs[ "product_desc_$number" ];
        $grouped_files[ $index ]["features"] =  $features[ "product_features_$number" ];
        $grouped_files[ $index ]["label"] =  $labels[ "product_label_$number" ];
      }

      // echo "<pre>";

      //   print_r($_POST);
      //   print_r($urls);
      //   print_r($descs);
      //   print_r($features);
      //   print_r($labels);

      //   print_r($grouped_files);
        
      // echo "</pre>";
      // exit();
      
      $target_dir = "../../product_images";

      $product_title = $_POST['product_title'];
      $product_cat = $_POST['product_cat'];
      $cat = $_POST['cat'];
      $manufacturer_id = $_POST['manufacturer'];
      $product_price = $_POST['product_price'];
      // $product_desc = $_POST['product_desc'];
      $product_keywords = $_POST['product_keywords'];

      $psp_price = $_POST['psp_price'];

      $product_custom_status = $_POST['product_custom_status'];
      // $product_label = $_POST['product_label'];

      // $product_url = $_POST['product_url'];

      // $product_features = $_POST['product_features'];

      // $product_video = $_POST['product_video'];

      $status = "product";

      // $paths = [ $_FILES['product_img1'], $_FILES['product_img2'], $_FILES['product_img3'] ];

      try {
        // Begin transaction
    
        $product = new Product();
        $product->beginTransaction();
        $product->setQuery("INSERT INTO `products` 
                            (`p_cat_id`,`cat_id`,`manufacturer_id`,`date`,`product_title`,`product_price`,`product_psp_price`,`product_keywords`,`status`, `custom_status`) 
                            VALUES ('$product_cat','$cat','$manufacturer_id',NOW(),'$product_title','$product_price','$psp_price','$product_keywords','$status', '$product_custom_status')");
        $last_id = $product->getLastInsertedId();

        foreach ($grouped_files as $key => $value) {
          $color = $value["color"];
          $number = $value['number'];
          $image1 = $value["product_img_".$number."_1"];
          $image2 = $value["product_img_".$number."_2"];
          $image3 = $value["product_img_".$number."_3"];

          $product_url =  $urls[ "product_url_$number" ];
          $product_desc =  $descs[ "product_desc_$number" ];
          $product_features =  $features[ "product_features_$number" ];
          $product_label =  $labels[ "product_label_$number" ];

          $image_array = array( $image1, $image2, $image3 );


          foreach ($image_array as $key => $value) {
            $isOk = checkUploadImage($value, $target_dir, $number, $key + 1, $last_id, $color);
            if(!$isOk){
              echo "Error Uploading";
              $product->rollback();
              exit();

            }
          }
          $url1 = basename($image1["name"]);
          $url2 = basename($image2["name"]);
          $url3 = basename($image3["name"]);

          $product->setQuery("INSERT INTO `product_colors` 
                                        (
                                          `product_id`, 
                                          `color_name`, 
                                          `product_img1`, 
                                          `product_img2`, 
                                          `product_img3`,
                                          `product_url`,
                                          `product_desc`,
                                          `product_features`,
                                          `product_label`
                                        ) 
                                VALUES (
                                          '$last_id',
                                          '$color',
                                          '$url1',
                                          '$url2',
                                          '$url3',
                                          '$product_url',
                                          '$product_desc',
                                          '$product_features',
                                          '$product_label'
                                        )");
        }
        
        // Commit the transaction
        $product->commit();
    
        echo "<script>alert('Product has been inserted successfully')</script>";
        echo "<script>window.open('../../index.php?view_products','_self')</script>";
    } catch (\PDOException $e) {
        // Rollback the transaction
        $product->rollback();
        echo $e->getMessage();
    }
    

    }

    function checkUploadImage($file, $target_dir, $number, $key, $last_id, $color) {
      if(file_exists($file['tmp_name']) || is_uploaded_file($file['tmp_name'])) {
          $new_target_dir = "$target_dir/product/$last_id/$color";

          if (!file_exists( "$new_target_dir" )) {
              mkdir("$new_target_dir", 0777, true);
          }

          $fileKey = "product_img_$number"."_".$key;
          $target_file = $new_target_dir . '/' . basename($file["name"]);
          $uploadOk = 1;
          $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  
          // Check if image file is a actual image or fake image
          if(isset($_POST["submit"])) {
              $check = getimagesize($file["tmp_name"]);
              if($check !== false) {
                  $uploadOk = 1;
              } else {
                  $uploadOk = 0;
              }
          }
  
          // // Check if file already exists
          // if (file_exists($target_file)) {
          //     $uploadOk = 0;
          // }
  
          // Allow certain file formats
          if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
              $uploadOk = 0;
          }
  
          if($uploadOk){
            move_uploaded_file($_FILES[$fileKey]['tmp_name'], $target_file);
          }

          return $uploadOk;
      }
    }
  

    ?>
