<?php


spl_autoload_register(function ($class) {
  include '../models/' . $class . '.php';
});


if (!isset($_SESSION['admin_email'])) {

  echo "<script>window.open('login.php','_self')</script>";
} else {
  ?>

  <?php

    if (isset($_GET['edit_product_colors'])) {

      $edit_id = $_GET['edit_product_colors'];
      $color_id = $_GET['color'];

      $get_p =  "SELECT 
                      A.*, 
                      B.color_name, 
                      B.product_img1 AS img1,  
                      B.product_img2 AS img2,  
                      B.product_img3 AS img3, 
                      B.color_id,
                      B.product_desc,
                      B.product_features,
                      B.product_video,
                      B.product_label,
                      B.product_url
                  FROM products AS A 
                  INNER JOIN product_colors AS B
                  ON A.product_id = B.product_id
                  WHERE A.product_id = '$edit_id'
                  AND B.color_id = '$color_id'
                  ";

      $run_edit = mysqli_query($con, $get_p);

      $row_edit = mysqli_fetch_array($run_edit);

      $p_id = $row_edit['product_id'];

      $p_title = $row_edit['product_title'];

      $p_cat = $row_edit['p_cat_id'];

      $cat = $row_edit['cat_id'];

      $m_id = $row_edit['manufacturer_id'];

      $p_image1 = "product_images/product/" . $row_edit['product_id'] ."/". $row_edit['color_name'] ."/". $row_edit['img1'];

      $p_image2 = "product_images/product/" . $row_edit['product_id'] ."/". $row_edit['color_name'] ."/". $row_edit['img2'];

      $p_image3 = "product_images/product/" . $row_edit['product_id'] ."/". $row_edit['color_name'] ."/". $row_edit['img3'];

      $new_p_image1 = $row_edit['img1'];

      $new_p_image2 = $row_edit['img2'];

      $new_p_image3 = $row_edit['img3'];

      $p_price = $row_edit['product_price'];

      $p_desc = $row_edit['product_desc'];

      $p_keywords = $row_edit['product_keywords'];

      $psp_price = $row_edit['product_psp_price'];

      $p_label = $row_edit['product_label'];

      $p_url = $row_edit['product_url'];

      $p_features = $row_edit['product_features'];

      $p_video = $row_edit['product_video'];

      $color_name = $row_edit['color_name'];
    }

    $get_manufacturer = "select * from manufacturers where manufacturer_id='$m_id'";

    $run_manufacturer = mysqli_query($con, $get_manufacturer);

    $row_manfacturer = mysqli_fetch_array($run_manufacturer);

    $manufacturer_id = $row_manfacturer['manufacturer_id'];

    $manufacturer_title = $row_manfacturer['manufacturer_title'];


    $get_p_cat = "select * from product_categories where p_cat_id='$p_cat'";

    $run_p_cat = mysqli_query($con, $get_p_cat);

    $row_p_cat = mysqli_fetch_array($run_p_cat);

    $p_cat_title = $row_p_cat['p_cat_title'];

    $get_cat = "select * from categories where cat_id='$cat'";

    $run_cat = mysqli_query($con, $get_cat);

    $row_cat = mysqli_fetch_array($run_cat);

    $cat_title = $row_cat['cat_title'];

    ?>


  <!DOCTYPE html>

  <html>

  <head>

    <title> Edit Products </title>


    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>
      tinymce.init({
        selector: '#product_desc,#product_features'
      });
    </script>

  </head>

  <body>

    <div class="row">
      <!-- row Starts -->

      <div class="col-lg-12">
        <!-- col-lg-12 Starts -->

        <ol class="breadcrumb">
          <!-- breadcrumb Starts -->

          <li class="active">

            <i class="fa fa-dashboard"> </i> Dashboard / Edit Products

          </li>

        </ol><!-- breadcrumb Ends -->

      </div><!-- col-lg-12 Ends -->

    </div><!-- row Ends -->


    <div class="row">
      <!-- 2 row Starts -->

      <div class="col-lg-12">
        <!-- col-lg-12 Starts -->

        <div class="panel panel-default">
          <!-- panel panel-default Starts -->

          <div class="panel-heading">
            <!-- panel-heading Starts -->

            <h3 class="panel-title">

              <i class="fa fa-money fa-fw"></i> Edit Products

            </h3>

          </div><!-- panel-heading Ends -->

          <div class="panel-body">
            <!-- panel-body Starts -->

            <form class="form-horizontal" method="post" enctype="multipart/form-data" >
              <!-- form-horizontal Starts -->

              <div class="form-group">
                <label class="col-md-3 control-label"> Product Title </label>
                <div class="col-md-6">
                  <input type="text" name="product_title" class="form-control" required value="<?php echo $p_title; ?>" disabled>
                </div>
              </div>

              <div class="form-group">
                <!-- form-group Starts -->

                <label class="col-md-3 control-label"> Select A Manufacturer </label>

                <div class="col-md-6">

                  <select name="manufacturer" class="form-control" disabled>

                    <option value="<?php echo $manufacturer_id; ?>">
                      <?php echo $manufacturer_title; ?>
                    </option>

                    <?php

                      $get_manufacturer = "select * from manufacturers";

                      $run_manufacturer = mysqli_query($con, $get_manufacturer);

                      while ($row_manfacturer = mysqli_fetch_array($run_manufacturer)) {

                        $manufacturer_id = $row_manfacturer['manufacturer_id'];

                        $manufacturer_title = $row_manfacturer['manufacturer_title'];

                        echo "
                        <option value='$manufacturer_id'>
                        $manufacturer_title
                        </option>
                        ";
                      }

                      ?>

                  </select>

                </div>

              </div><!-- form-group Ends -->

              <div class="form-group">
                <!-- form-group Starts -->

                <label class="col-md-3 control-label"> Product Category </label>

                <div class="col-md-6">

                  <select name="product_cat" class="form-control" disabled>

                    <option value="<?php echo $p_cat; ?>"> <?php echo $p_cat_title; ?> </option>


                    <?php

                      $get_p_cats = "select * from product_categories";

                      $run_p_cats = mysqli_query($con, $get_p_cats);

                      while ($row_p_cats = mysqli_fetch_array($run_p_cats)) {

                        $p_cat_id = $row_p_cats['p_cat_id'];

                        $p_cat_title = $row_p_cats['p_cat_title'];

                        echo "<option value='$p_cat_id' >$p_cat_title</option>";
                      }


                      ?>


                  </select>

                </div>

              </div><!-- form-group Ends -->

              <div class="form-group">
                <!-- form-group Starts -->

                <label class="col-md-3 control-label"> Category </label>

                <div class="col-md-6">


                  <select name="cat" class="form-control" disabled>

                    <option value="<?php echo $cat; ?>"> <?php echo $cat_title; ?> </option>

                    <?php

                      $get_cat = "select * from categories ";

                      $run_cat = mysqli_query($con, $get_cat);

                      while ($row_cat = mysqli_fetch_array($run_cat)) {

                        $cat_id = $row_cat['cat_id'];

                        $cat_title = $row_cat['cat_title'];

                        echo "<option value='$cat_id'>$cat_title</option>";
                      }

                      ?>


                  </select>

                </div>

              </div><!-- form-group Ends -->

              <div class="form-group">
                <!-- form-group Starts -->

                <label class="col-md-3 control-label"> Product Price </label>

                <div class="col-md-6">

                  <input type="text" name="product_price" class="form-control" required value="<?php echo $p_price; ?>" disabled>

                </div>

              </div><!-- form-group Ends -->

              <div class="form-group">
                <!-- form-group Starts -->

                <label class="col-md-3 control-label"> Product Sale Price </label>

                <div class="col-md-6">

                  <input type="text" name="psp_price" class="form-control" required value="<?php echo $psp_price; ?>" disabled>

                </div>

              </div><!-- form-group Ends -->

              
              <div class="form-group">
                <!-- form-group Starts -->

                <label class="col-md-3 control-label"> Product Keywords </label>

                <div class="col-md-6">

                  <input type="text" name="product_keywords" class="form-control" required value="<?php echo $p_keywords; ?>" disabled>

                </div>

              </div><!-- form-group Ends -->

              <div class="form-group">
                <!-- form-group Starts -->

                <label class="col-md-3 control-label"> Product Url </label>

                <div class="col-md-6">

                  <input type="text" name="product_url" class="form-control" required value="<?php echo $p_url; ?>">

                  <br>

                  <p style="font-size:15px; font-weight:bold;">

                    Product Url Example : navy-blue-t-shirt

                  </p>

                </div>

              </div><!-- form-group Ends -->

              <div class="form-group">
               

                <label class="col-md-3 control-label"> Color </label>

                <div class="col-md-6">

                  <input type="text" name="color_name" class="form-control" required value="<?php echo $color_name; ?>">

                </div>

              </div>

              <div class="form-group">
                <!-- form-group Starts -->

                <label class="col-md-3 control-label"> Product Image 1 </label>

                <div class="col-md-6">

                  <input type="file" name="product_img1" class="form-control">
                  <br><img loading="lazy" src="<?php echo $p_image1; ?>" width="70" height="70">

                </div>

              </div><!-- form-group Ends -->

              <div class="form-group">
                <!-- form-group Starts -->

                <label class="col-md-3 control-label"> Product Image 2 </label>

                <div class="col-md-6">

                  <input type="file" name="product_img2" class="form-control">
                  <br><img loading="lazy" src="<?php echo $p_image2; ?>" width="70" height="70">

                </div>

              </div><!-- form-group Ends -->

              <div class="form-group">
                <!-- form-group Starts -->

                <label class="col-md-3 control-label"> Product Image 3 </label>

                <div class="col-md-6">

                  <input type="file" name="product_img3" class="form-control">
                  <br><img loading="lazy" src="<?php echo $p_image3; ?>" width="70" height="70">

                </div>

              </div><!-- form-group Ends -->


              <div class="form-group">
                <!-- form-group Starts -->

                <label class="col-md-3 control-label"> Product Tabs </label>

                <div class="col-md-6">

                  <ul class="nav nav-tabs">
                    <!-- nav nav-tabs Starts -->

                    <li class="active">

                      <a data-toggle="tab" href="#description"> Product Description </a>

                    </li>

                    <li>

                      <a data-toggle="tab" href="#features"> Product Features </a>

                    </li>

                    <li>

                      <a data-toggle="tab" href="#video"> Sounds And Videos </a>

                    </li>

                  </ul><!-- nav nav-tabs Ends -->

                  <div class="tab-content">
                    <!-- tab-content Starts -->

                    <div id="description" class="tab-pane fade in active">
                      <!-- description tab-pane fade in active Starts -->

                      <br>

                      <textarea name="product_desc" class="form-control" rows="15" id="product_desc">

<?php echo $p_desc; ?>

</textarea>

                    </div><!-- description tab-pane fade in active Ends -->


                    <div id="features" class="tab-pane fade in">
                      <!-- features tab-pane fade in Starts -->

                      <br>

                      <textarea name="product_features" class="form-control" rows="15" id="product_features">

<?php echo $p_features; ?>

</textarea>

                    </div><!-- features tab-pane fade in Ends -->


                    <div id="video" class="tab-pane fade in">
                      <!-- video tab-pane fade in Starts -->

                      <br>

                      <textarea name="product_video" class="form-control" rows="15">

<?php echo $p_video; ?>

</textarea>

                    </div><!-- video tab-pane fade in Ends -->


                  </div><!-- tab-content Ends -->

                </div>

              </div><!-- form-group Ends -->

              <div class="form-group">
                <!-- form-group Starts -->

                <label class="col-md-3 control-label"> Product Label </label>

                <div class="col-md-6">

                  <input type="text" name="product_label" class="form-control" required value="<?php echo $p_label; ?>">

                </div>

              </div><!-- form-group Ends -->

              <div class="form-group">
                <!-- form-group Starts -->

                <label class="col-md-3 control-label"></label>

                <div class="col-md-6">

                  <input type="submit" name="update" value="Update Product" class="btn btn-primary form-control">

                </div>

              </div><!-- form-group Ends -->

            </form><!-- form-horizontal Ends -->

          </div><!-- panel-body Ends -->

        </div><!-- panel panel-default Ends -->

      </div><!-- col-lg-12 Ends -->

    </div><!-- 2 row Ends -->




  </body>

  </html>

<?php } ?>


<?php


function checkUploadImage($temp_name, $target_dir, $key, $last_id, $color) {
  if(file_exists($temp_name) || is_uploaded_file($temp_name)) {
      $new_target_dir = "$target_dir/product/$last_id/$color";

      if (!file_exists( "$new_target_dir" )) {
          mkdir("$new_target_dir", 0777, true);
      }

      $fileKey = "product_img$key";
      $target_file = $new_target_dir . '/' . basename($_FILES[$fileKey]["name"]);
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

      try {
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

      } catch (\Exception $e) {
        //throw $th;
        return $e->getMessage();
      }
      return $uploadOk;
  }
}



if (isset($_POST['update'])) {

  // $product_title = $_POST['product_title'];
  // $product_cat = $_POST['product_cat'];
  // $cat = $_POST['cat'];
  // $manufacturer_id = $_POST['manufacturer'];
  // $product_price = $_POST['product_price'];
  $product_desc = $_POST['product_desc'];
  // $product_keywords = $_POST['product_keywords'];

  // $psp_price = $_POST['psp_price'];

  $product_label = $_POST['product_label'];

  $product_url = $_POST['product_url'];

  $product_features = $_POST['product_features'];

  $product_video = $_POST['product_video'];

  // $status = "product";

  $product_img1 = $_FILES['product_img1']['name'];
  $product_img2 = $_FILES['product_img2']['name'];
  $product_img3 = $_FILES['product_img3']['name'];

  $temp_name1 = $_FILES['product_img1']['tmp_name'];
  $temp_name2 = $_FILES['product_img2']['tmp_name'];
  $temp_name3 = $_FILES['product_img3']['tmp_name'];

  if (empty($product_img1)) {

    $product_img1 = $new_p_image1;
  }


  if (empty($product_img2)) {

    $product_img2 = $new_p_image2;
  }

  if (empty($product_img3)) {

    $product_img3 = $new_p_image3;
  }

  try {
    $product = new Product();
    $product->beginTransaction();
    // $product->setQuery("UPDATE products 
    //                     SET 
    //                       `p_cat_id`          = '$product_cat', 
    //                       `cat_id`            = '$cat', 
    //                       `manufacturer_id`   = '$manufacturer_id',
    //                       `date`              = NOW(), 
    //                       `product_keywords`  = '$product_keywords',
    //                       `status`            = '$status' 
    //                     WHERE product_id      = '$p_id'");

    $product->setQuery("UPDATE product_colors
                        SET 
                          `color_name`        = '$color_name', 
                          `product_img1`      = '$product_img1', 
                          `product_img2`      = '$product_img2', 
                          `product_img3`      = '$product_img3',
                          `product_label`     = '$product_label', 
                          `product_desc`      = '$product_desc', 
                          `product_features`  = '$product_features',
                          `product_video`     = '$product_video', 
                          `product_url`       = '$product_url'
                        WHERE color_id        =  '$color_id'
                        AND product_id        =  '$p_id'");


    $target_dir = "product_images";
    if($temp_name1){
      $grouped_files[] = $temp_name1;
    }
    if($temp_name2){
      $grouped_files[] = $temp_name2;
    }
    if($temp_name3){
      $grouped_files[] = $temp_name3;
    }

    foreach ($grouped_files as $key => $value) {
      $isOk = checkUploadImage($value, $target_dir, $key + 1, $p_id, $color_name);
      
      if(!$isOk){
        echo "<pre>";
        print_r($_FILES);
        echo "</pre>";
        echo "Error Uploadingss";
        $product->rollback();
        exit();
      }
    }

    $product->commit();

    
    echo "<script> alert('Product has been updated successfully') </script>";

    echo "<script>window.open('index.php?view_products','_self')</script>";

  }  catch (\PDOException $e) {
    $product->rollback();
    echo $e->getMessage();
  }


}

?>