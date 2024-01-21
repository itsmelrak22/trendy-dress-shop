<?php

spl_autoload_register(function ($class) {
    include '../../../models/' . $class . '.php';
  });

    if (isset($_POST['submit'])) {
      $grouped_files = array_chunk($_FILES, 3, true);

      $colors = array();
      foreach ($_POST as $key => $value) {
          if (strpos($key, 'product_color') !== false) {
              $colors[$key] = $value;
          }
      }

      $files = array();



      echo "<pre>";

        print_r($colors);

        print_r($grouped_files);
        
      echo "</pre>";
      exit();
   

      $target_dir = "../../product_images/";

      $product_title = $_POST['product_title'];
      $product_cat = $_POST['product_cat'];
      $cat = $_POST['cat'];
      $manufacturer_id = $_POST['manufacturer'];
      $product_price = $_POST['product_price'];
      $product_desc = $_POST['product_desc'];
      $product_keywords = $_POST['product_keywords'];

      $psp_price = $_POST['psp_price'];

      $product_label = $_POST['product_label'];

      $product_url = $_POST['product_url'];

      $product_features = $_POST['product_features'];

      $product_video = $_POST['product_video'];

      $status = "product";

      $paths = [ $_FILES['product_img1'], $_FILES['product_img2'], $_FILES['product_img3'] ];


      try {

        $product_img1 =  $_FILES['product_img1']['name'];
        $product_img2 =  $_FILES['product_img2']['name'];
        $product_img3 =  $_FILES['product_img3']['name'];

        $product = new Product();
        $product->setQuery("INSERT INTO `products` 
                            (`p_cat_id`,`cat_id`,`manufacturer_id`,`date`,`product_title`,`product_url`,`product_img1`,`product_img2`,`product_img3`,`product_price`,`product_psp_price`,`product_desc`,`product_features`,`product_video`,`product_keywords`,`product_label`,`status`) 
                            VALUES ('$product_cat','$cat','$manufacturer_id',NOW(),'$product_title','$product_url','$product_img1','$product_img2','$product_img3','$product_price','$psp_price','$product_desc','$product_features','$product_video','$product_keywords','$product_label','$status')");

        $isLoopOk = 1;
        foreach ($paths as $key => $path) {
          $isOk = checkUploadImage($path, $target_dir);
          if( !$isOk ) return $isLoopOk = 0;
        }
  
        if(!$isLoopOk){
          echo "Error Uploading";
          exit();
        }

        echo "<script>alert('Product has been inserted successfully')</script>";

        echo "<script>window.open('../../index.php?view_products','_self')</script>";
      } catch (\PDOException $e) {
        //throw $th;
        echo $e->getMessage();
      }

    }




    function checkUploadImage($file, $target_dir) {
      if(file_exists($file['tmp_name']) || is_uploaded_file($file['tmp_name'])) {
          $target_file = $target_dir . basename($file["name"]);
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
            move_uploaded_file($file["tmp_name"], $target_file);
          }

          return $uploadOk;
      }
  }
  

    ?>
