<?php

spl_autoload_register(function ($class) {
  include '../../models/' . $class . '.php';
});

if (!isset($_SESSION['admin_email'])) {

  echo "<script>window.open('login.php','_self')</script>";
} else {

  ?>
  <!DOCTYPE html>

  <html>

  <head>
    <title> Insert Products </title>
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>
      tinymce.init({
        selector: '#product_desc,#product_features'
      });
    </script>
    <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
  </head>

  <body>
    <div class="row">
      <!-- row Starts -->
      <div class="col-lg-12">
        <!-- col-lg-12 Starts -->
        <ol class="breadcrumb">
          <!-- breadcrumb Starts -->
          <li class="active">
            <i class="fa fa-dashboard"> </i> Dashboard / Insert Products
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
              <i class="fa fa-money fa-fw"></i> Insert Products
            </h3>
          </div><!-- panel-heading Ends -->

          <div class="panel-body">
            <!-- panel-body Starts -->
            <form class="form-horizontal" method="post" enctype="multipart/form-data" action="queries/products/insert.php">
              <!-- form-horizontal Starts -->
              <div class="form-group">
                <!-- form-group Starts -->
                <label class="col-md-3 control-label"> Product Title </label>
                <div class="col-md-6">
                  <input type="text" name="product_title" class="form-control" required>
                </div>
              </div><!-- form-group Ends -->

              <div class="form-group">
                <!-- form-group Starts -->
                <label class="col-md-3 control-label"> Select A Manufacturer </label>
                <div class="col-md-6">
                  <select class="form-control" name="manufacturer">
                    <!-- select manufacturer Starts -->
                    <option> Select A Manufacturer </option>

                    <?php
                      $get_manufacturer = "select * from manufacturers";
                      $run_manufacturer = mysqli_query($con, $get_manufacturer);
                      while ($row_manufacturer = mysqli_fetch_array($run_manufacturer)) {
                        $manufacturer_id = $row_manufacturer['manufacturer_id'];
                        $manufacturer_title = $row_manufacturer['manufacturer_title'];

                        echo "<option value='$manufacturer_id'>
                  $manufacturer_title
                  </option>";
                      }

                      ?>

                  </select><!-- select manufacturer Ends -->
                </div>
              </div><!-- form-group Ends -->


              <div class="form-group">
                <!-- form-group Starts -->
                <label class="col-md-3 control-label"> Product Category </label>
                <div class="col-md-6">
                  <select name="product_cat" class="form-control">
                    <option> Select a Product Category </option>

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
                  <select name="cat" class="form-control">
                    <option> Select a Category </option>
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

              <div>
              <hr>
              </div>

              
              <div class="form-group">
                <!-- form-group Starts -->
                <label class="col-md-3 control-label"> Product Url </label>
                <div class="col-md-6">
                  <input type="text" name="product_url" class="form-control" required>
                  <br>
                  <p style="font-size:15px; font-weight:bold;">
                    Product Url Example : navy-blue-t-shirt
                  </p>
                </div>
              </div><!-- form-group Ends -->

              <div class="form-group">
                <!-- form-group Starts -->
                <label class="col-md-3 control-label"> Product Price </label>
                <div class="col-md-6">
                  <input type="text" name="product_price" class="form-control" required>
                </div>
              </div><!-- form-group Ends -->

              <div class="form-group">
                <!-- form-group Starts -->
                <label class="col-md-3 control-label"> Product Sale Price </label>
                <div class="col-md-6">
                  <input type="text" name="psp_price" class="form-control" required>
                </div>
              </div><!-- form-group Ends -->

              <div class="form-group">
                <!-- form-group Starts -->
                <label class="col-md-3 control-label"> Product Keywords </label>
                <div class="col-md-6">
                  <input type="text" name="product_keywords" class="form-control" required>
                </div>
              </div><!-- form-group Ends -->
              <div class="form-group">
                <!-- form-group Starts -->
                <label class="col-md-3 control-label"> Product Customization </label>
                <div class="col-md-6">
                  <select name="product_custom_status" id="product_custom_status" class="form-control" required>
                    <option disabled selected value="0"> Is your product can be customize? </option>
                    <option value="1">YES</option>
                    <option value="0">NO</option>
                  </select>
                </div>
              </div><!-- form-group Ends -->


              <div class="form-group">
                <label class="col-md-3 control-label"> Product Color (required)</label>
                <button type="button" class="btn btn-info" onclick="addInput()">Add</button>
                <button type="button" class="btn btn-info" onclick="removeInput()">Remove</button>
              </div>

              <div id="inputContainer">

              </div>
              

              <div class="form-group">
                <!-- form-group Starts -->

                <label class="col-md-3 control-label"></label>

                <div class="col-md-6">

                  <input type="submit" name="submit" value="Insert Product" class="btn btn-primary form-control">

                </div>


              </div><!-- form-group Ends -->

              
              


            </form><!-- form-horizontal Ends -->

          </div><!-- panel-body Ends -->

        </div><!-- panel panel-default Ends -->

      </div><!-- col-lg-12 Ends -->

    </div><!-- 2 row Ends -->

    <script>
        let counter = 0;

        document.addEventListener('DOMContentLoaded', (event) => {
            var btn = document.querySelector('input[name="submit"]');
            btn.disabled = true;
           
        });

        function checkCounter(){
          var btn = document.querySelector('input[name="submit"]');

          if(counter < 1){
            btn.disabled = true;
          }else{
            btn.disabled = false;

          }
        }

        function addInput() {
            counter++;
            let newDiv = document.createElement('div');
            newDiv.innerHTML = `
                <div class="form-group">
                    <label class="col-md-3 control-label"> Product Color </label>
                    <div class="col-md-6">
                        <input type="text" name="product_color_${counter}" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <!-- form-group Starts -->
                    <label class="col-md-3 control-label"> Product Color Image 1 </label>
                    <div class="col-md-6">
                      <input type="file" name="product_img_${counter}_1" id="product_img_${counter}_1" class="form-control" required>
                    </div>
                  </div><!-- form-group Ends -->

                  <div class="form-group">
                    <!-- form-group Starts -->
                    <label class="col-md-3 control-label"> Product Color Image 2 </label>
                    <div class="col-md-6">
                      <input type="file" name="product_img_${counter}_2" id="product_img_${counter}_2" class="form-control" required>
                    </div>
                  </div><!-- form-group Ends -->

                  <div class="form-group">
                    <!-- form-group Starts -->
                    <label class="col-md-3 control-label"> Product Color Image 3 </label>
                    <div class="col-md-6">
                      <input type="file" name="product_img_${counter}_3" id="product_img_${counter}_3" class="form-control" required>
                    </div>

                  </div><!-- form-group Ends -->

                  <div class="form-group">
                    <!-- form-group Starts -->
                    <label class="col-md-3 control-label"> Product Url </label>
                    <div class="col-md-6">
                      <input type="text" name="product_url_${counter}" class="form-control" required>
                      <br>
                      <p style="font-size:15px; font-weight:bold;">
                        Product Url Example : navy-blue-t-shirt
                      </p>
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

                      </ul><!-- nav nav-tabs Ends -->

                      <div class="tab-content">
                        <!-- tab-content Starts -->
                        <div id="description" class="tab-pane fade in active">
                          <!-- description tab-pane fade in active Starts -->
                          <br>
                          <textarea name="product_desc_${counter}" class="form-control" rows="15" id="product_desc"></textarea>
                        </div><!-- description tab-pane fade in active Ends -->

                        <div id="features" class="tab-pane fade in">
                          <!-- features tab-pane fade in Starts -->
                          <br>
                          <textarea name="product_features_${counter}" class="form-control" rows="15" id="product_features"> </textarea>
                        </div><!-- features tab-pane fade in Ends -->

                      </div><!-- tab-content Ends -->

                    </div>

                  </div><!-- form-group Ends -->

                  <div class="form-group">
                  <!-- form-group Starts -->

                  <label class="col-md-3 control-label"> Product Label </label>

                  <div class="col-md-6">

                    <input type="text" name="product_label_${counter}" class="form-control" required>

                  </div>

                </div><!-- form-group Ends -->
                  <hr>
            `;
            document.getElementById('inputContainer').appendChild(newDiv);
            checkCounter()
        }

        function removeInput() {
            var container = document.getElementById('inputContainer');
            if (container.childNodes.length > 1) {
                container.removeChild(container.lastChild);
                counter--;
            }
            checkCounter()

        }
    </script>


  </body>

  </html>

<?php } ?>