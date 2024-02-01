<?php


spl_autoload_register(function ($class) {
  include '../models/' . $class . '.php';
});

if (!isset($_SESSION['admin_email'])) {

  echo "<script>window.open('login.php','_self')</script>";
} else {

  ?>

  <?php

    if (isset($_GET['edit_product'])) {

      $edit_id = $_GET['edit_product'];

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
                  <input type="text" name="product_title" class="form-control" required value="<?php echo $p_title; ?>" >
                </div>
              </div>

              <div class="form-group">
                <!-- form-group Starts -->

                <label class="col-md-3 control-label"> Select A Manufacturer </label>

                <div class="col-md-6">

                  <select name="manufacturer" class="form-control" >

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

                  <select name="product_cat" class="form-control" >

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


                  <select name="cat" class="form-control" >

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

                  <input type="text" name="product_price" class="form-control" required value="<?php echo $p_price; ?>" >

                </div>

              </div><!-- form-group Ends -->

              <div class="form-group">
                <!-- form-group Starts -->

                <label class="col-md-3 control-label"> Product Sale Price </label>

                <div class="col-md-6">

                  <input type="text" name="psp_price" class="form-control" required value="<?php echo $psp_price; ?>" >

                </div>

              </div><!-- form-group Ends -->

              
              <div class="form-group">
                <!-- form-group Starts -->

                <label class="col-md-3 control-label"> Product Keywords </label>

                <div class="col-md-6">

                  <input type="text" name="product_keywords" class="form-control" required value="<?php echo $p_keywords; ?>">

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



if (isset($_POST['update'])) {

  $product_title = $_POST['product_title'];
  $manufacturer_id = $_POST['manufacturer'];
  $product_cat = $_POST['product_cat'];
  $cat = $_POST['cat'];
  $product_price = $_POST['product_price'];
  $psp_price = $_POST['psp_price'];
  $product_keywords = $_POST['product_keywords'];

  $psp_price = $_POST['psp_price'];


  $status = "product";


  try {
    $product = new Product();
    $product->beginTransaction();
    $product->setQuery("UPDATE products 
                        SET 
                          `product_title`     = '$product_title', 
                          `p_cat_id`          = '$product_cat', 
                          `cat_id`            = '$cat', 
                          `manufacturer_id`   = '$manufacturer_id',
                          `date`              = NOW(), 
                          `product_keywords`  = '$product_keywords',
                          `product_price`     = '$product_price',
                          `product_psp_price` = '$psp_price',
                          `status`            = '$status' 
                        WHERE product_id      = '$p_id'");

    $product->commit();

    echo "<script> alert('Product has been updated successfully') </script>";

    echo "<script>window.open('index.php?view_products','_self')</script>";

  }  catch (\PDOException $e) {
    $product->rollback();
    echo $e->getMessage();
  }


}

?>