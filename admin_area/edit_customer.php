<?php
if(!isset($_SESSION['admin_email'])){
    echo "<script>window.open('login.php','_self')</script>";
} else {
    if(isset($_GET['edit_customers'])){
        $customer_id = $_GET['edit_customers'];
        $get_customer = "SELECT * FROM customers WHERE customer_id='$customer_id'";
        $run_customer = mysqli_query($con, $get_customer);
        $row_customer = mysqli_fetch_array($run_customer);

        $c_name = $row_customer['customer_name'];
        $c_email = $row_customer['customer_email'];
        $c_image = $row_customer['customer_image'];
        $c_country = $row_customer['customer_country'];
        $c_city = $row_customer['customer_city'];
        $c_contact = $row_customer['customer_contact'];
    }
?>
<div class="row"><!-- 1 row Starts -->
    <div class="col-lg-12"><!-- col-lg-12 Starts -->
        <ol class="breadcrumb"><!-- breadcrumb Starts -->
            <li>
                <i class="fa fa-dashboard"></i> Dashboard / Edit Customer
            </li>
        </ol><!-- breadcrumb Ends -->
    </div><!-- col-lg-12 Ends -->
</div><!-- 1 row Ends -->

<div class="row"><!-- 2 row Starts -->
    <div class="col-lg-12"><!-- col-lg-12 Starts -->
        <div class="panel panel-default"><!-- panel panel-default Starts -->
            <div class="panel-heading" ><!-- panel-heading Starts -->
                <h3 class="panel-title" ><!-- panel-title Starts -->
                    <i class="fa fa-money fa-fw" ></i> Edit Customer
                </h3><!-- panel-title Ends -->
            </div><!-- panel-heading Ends -->
            <div class="panel-body" ><!-- panel-body Starts -->
                <form class="form-horizontal" action="" method="post" enctype="multipart/form-data" ><!-- form-horizontal Starts -->
                    <div class="form-group" ><!-- form-group Starts -->
                        <label class="col-md-3 control-label" >Customer Name</label>
                        <div class="col-md-6" >
                            <input type="text" name="c_name" class="form-control" value="<?php echo $c_name; ?>" required>
                        </div>
                    </div><!-- form-group Ends -->
                    <div class="form-group" ><!-- form-group Starts -->
                        <label class="col-md-3 control-label" >Customer Email</label>
                        <div class="col-md-6" >
                            <input type="email" name="c_email" class="form-control" value="<?php echo $c_email; ?>" required>
                        </div>
                    </div><!-- form-group Ends -->
                    <div class="form-group" ><!-- form-group Starts -->
                        <label class="col-md-3 control-label" >Customer Image</label>
                        <div class="col-md-6" >
                            <input type="file" name="c_image" onchange="previewImage(event);">
                            <img loading="lazy" id="imagePreview" src="../updateUploads/<?php echo $c_image; ?>" width="60" height="60">
                        </div>
                    </div><!-- form-group Ends -->
                    <div class="form-group" ><!-- form-group Starts -->
                        <label class="col-md-3 control-label" >Customer Country</label>
                        <div class="col-md-6" >
                            <input type="text" name="c_country" class="form-control" value="<?php echo $c_country; ?>" required>
                        </div>
                    </div><!-- form-group Ends -->
                    <div class="form-group" ><!-- form-group Starts -->
                        <label class="col-md-3 control-label" >Customer City</label>
                        <div class="col-md-6" >
                            <input type="text" name="c_city" class="form-control" value="<?php echo $c_city; ?>" required>
                        </div>
                    </div><!-- form-group Ends -->
                    <div class="form-group" ><!-- form-group Starts -->
                        <label class="col-md-3 control-label" >Customer Contact</label>
                        <div class="col-md-6" >
                            <input type="text" name="c_contact" class="form-control" value="<?php echo $c_contact; ?>" required>
                        </div>
                    </div><!-- form-group Ends -->
                    <div class="form-group" ><!-- form-group Starts -->
                        <label class="col-md-3 control-label" ></label>
                        <div class="col-md-6" >
                            <input type="submit" name="update_customer" value="Update Customer" class="btn btn-primary form-control">
                        </div>
                    </div><!-- form-group Ends -->
                </form><!-- form-horizontal Ends -->
            </div><!-- panel-body Ends -->
        </div><!-- panel panel-default Ends -->
    </div><!-- col-lg-12 Ends -->
</div><!-- 2 row Ends -->
<?php
    if(isset($_POST['update_customer'])){
        $c_name = $_POST['c_name'];
        $c_email = $_POST['c_email'];
        $c_country = $_POST['c_country'];
        $c_city = $_POST['c_city'];
        $c_contact = $_POST['c_contact'];

        // Handle file upload
        if($_FILES['c_image']['name'] != "") {
            $c_image = $_FILES['c_image']['name'];
            $c_image_tmp = $_FILES['c_image']['tmp_name'];
            move_uploaded_file($c_image_tmp,"../updateUploads/$c_image");
        } else {
            $c_image = $c_image; // Retain existing image path if no new image is uploaded
        }

        $update_customer = "UPDATE customers SET customer_name='$c_name', customer_email='$c_email', customer_country='$c_country', customer_city='$c_city', customer_contact='$c_contact', customer_image='$c_image' WHERE customer_id='$customer_id'";
        $run_update = mysqli_query($con, $update_customer);

        if($run_update){
            echo "<script>alert('Customer details updated successfully!')</script>";
            echo "<script>window.open('index.php?view_customers','_self')</script>";
        }
    }
}
?>
