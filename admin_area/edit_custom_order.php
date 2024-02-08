<?php
    require("../PHPMailer/src/PHPMailer.php");
    require("../PHPMailer/src/SMTP.php");
spl_autoload_register(function ($class) {
    include '../models/' . $class . '.php';
  });
  


if (!isset($_SESSION['admin_email'])) {
    // If not logged in, redirect to login page
    echo "<script>window.open('login.php','_self')</script>";
    exit(); // Stop further execution
}

if(isset($_GET['edit_custom_order'])) {
    $custom_order_id = $_GET['edit_custom_order'];


    $customOrderRequest = new CustomProductRequest;
    $customOrderRequests = $customOrderRequest::getCustomRequest($custom_order_id);

    // echo "<pre>";
    // echo print_r($customOrderRequests);
    // echo "</pre>";
    
    if($customOrderRequests) {
       

?>
<div class="row"><!-- 1 row Starts -->
    <div class="col-lg-12"><!-- col-lg-12 Starts -->
        <ol class="breadcrumb"><!-- breadcrumb Starts -->
            <li>
                <i class="fa fa-dashboard"></i> Dashboard / Custom Order Info
            </li>
        </ol><!-- breadcrumb Ends -->
    </div><!-- col-lg-12 Ends -->
</div><!-- 1 row Ends -->
<div class="row"><!-- 2 row Starts -->
    <div class="col-lg-12"><!-- col-lg-12 Starts -->
        <div class="panel panel-default"><!-- panel panel-default Starts -->
            <div class="panel-heading" ><!-- panel-heading Starts -->
                <h3 class="panel-title" ><!-- panel-title Starts -->
                    <i class="fa fa-money fa-fw" ></i> Custom Order Info
                </h3><!-- panel-title Ends -->
            </div><!-- panel-heading Ends -->
            <div class="panel-body" ><!-- panel-body Starts -->
                <form class="form-horizontal"  method="post" enctype="multipart/form-data" ><!-- form-horizontal Starts -->
                    
                    <div class="form-group" >
                        <label class="col-md-3 control-label" >Customer Name</label>
                        <div class="col-md-9" >
                            <input type="text" name="customer_name" class="form-control" value="<?= $customOrderRequests->customer_name; ?>" readonly >
                        </div>
                    </div>
                    <div class="form-group" >
                        <label class="col-md-3 control-label" >Customer Email</label>
                        <div class="col-md-9" >
                            <input type="text" name="customer_email" class="form-control" value="<?= $customOrderRequests->customer_email; ?>" readonly >
                        </div>
                    </div>
                    <div class="form-group" >
                        <label class="col-md-3 control-label" >Selected Color</label>
                        <div class="col-md-9" >
                            <input type="text" name="selected_color" class="form-control" value="<?= $customOrderRequests->selected_color; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group" >
                        <label class="col-md-3 control-label" >Selected Font</label>
                        <div class="col-md-9" >
                            <input type="text" name="selected_font" class="form-control" style="font-family: <?= $customOrderRequests->selected_font; ?> !important;    " value="<?= $customOrderRequests->selected_font; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group" >
                        <label class="col-md-3 control-label" >Text Input</label>
                        <div class="col-md-9" >
                            <textarea class="form-control" name="text_input" id="text_input" cols="30" rows="10" readonly><?= $customOrderRequests->text_input ?></textarea>
                        </div>
                    </div>
                    <div class="form-group" >
                        <label class="col-md-3 control-label" >Text Length</label>
                        <div class="col-md-9" >
                            <input type="text" name="text_length" class="form-control" value="<?= $customOrderRequests->text_length; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group" >
                        <label class="col-md-3 control-label" >Text Width</label>
                        <div class="col-md-9" >
                            <input type="text" name="text_width" class="form-control" value="<?= $customOrderRequests->text_width; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group" >
                        <label class="col-md-3 control-label" >Remarks/Note</label>
                        <div class="col-md-9" >
                            <textarea class="form-control" name="remarks" id="remarks" cols="30" rows="10" readonly><?= $customOrderRequests->remarks ?></textarea>
                        </div>
                    </div>
                    <div class="form-group" >
                        <label class="col-md-3 control-label" >Logo Uploaded</label>
                        <div class="col-md-9" >
                            <img src="<?= $customOrderRequests->uploaded_logo ?>" alt="logo-uploaded" width="150" height="150">
                        </div>
                    </div>
                    <div class="form-group" >
                        <label class="col-md-3 control-label" >Logo Length</label>
                        <div class="col-md-9" >
                            <input type="text" name="logo_length" class="form-control" value="<?= $customOrderRequests->logo_length; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group" >
                        <label class="col-md-3 control-label" >Logo Width</label>
                        <div class="col-md-9" >
                            <input type="text" name="logo_width" class="form-control" value="<?= $customOrderRequests->logo_width; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group" >
                        <label class="col-md-3 control-label" >Image Uploaded</label>
                        <div class="col-md-9" >
                            <img src="<?= $customOrderRequests->uploaded_image ?>" alt="uploaded_image" width="300" height="300">
                        </div>
                    </div>
                    <div class="form-group" >
                        <label class="col-md-3 control-label" >Image Generated</label>
                        <div class="col-md-9" >
                            <img src="<?= $customOrderRequests->generated_image ?>" alt="generated_image" width="300" height="300">
                        </div>
                    </div>

                    <div class="form-group" >
                        <label class="col-md-3 control-label" >Update Status?</label>
                        <div class="col-md-9" >
                            <select name="custom_order_status" class="form-control">
                                <option <?php if(!$customOrderRequests->status) echo "selected" ?> readonly disabled></option>
                                <option value="TO_SHIP" <?php if($customOrderRequests->status == 'TO_SHIP') echo 'selected'; ?>>TO SHIP</option>
                                <option value="TRANSIT" <?php if($customOrderRequests->status == 'TRANSIT') echo 'selected'; ?>>TRANSIT</option>
                                <option value="DELIVERED" <?php if($customOrderRequests->status == 'DELIVERED') echo 'selected'; ?>>DELIVERED</option>
                                <option value="CANCELLED" <?php if($customOrderRequests->status == 'CANCELLED') echo 'selected'; ?>>CANCELLED</option>
                                <option value="CONFIRMED" <?php if($customOrderRequests->status == 'CONFIRMED') echo 'selected'; ?>>CONFIRMED</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>
                    </div>

                    <div class="form-group" ><!-- form-group Starts -->
                        <label class="col-md-3 control-label" >Send Email to customer?</label>
                        <div class="col-md-9" >
                            <input type="checkbox" name="send_email"  value="true" >
                        </div>
                    </div><!-- form-group Ends -->  
             
                    <div id="hiddenInputs">
                        <input type="hidden" name="id" value="<?= $customOrderRequests->id ?>">
                    </div>
                    
                    <div class="form-group" >
                        <label class="col-md-8 control-label" ></label>
                        <div class="col-md-4" >
                            <input type="submit" name="update" value="Update Now" class="btn btn-primary form-control" >
                        </div>
                    </div>
                </form><!-- form-horizontal Ends -->
            </div><!-- panel-body Ends -->
        </div><!-- panel panel-default Ends -->
    </div><!-- col-lg-12 Ends -->
</div><!-- 2 row Ends -->
<?php
    } else {
        echo "Order not found!";
    }
} else {
    echo "<script>window.open('index.php?view_orders','_self')</script>";
    exit();
}

if(isset($_POST['update'])) {



    include("../send_email.php");

    // echo "<pre>";
    // echo print_r($_POST);
    // echo "</pre>";

    $status = isset( $_POST["custom_order_status"] ) && $_POST["custom_order_status"] ? $_POST["custom_order_status"] : NULL;
    $send_email = isset( $_POST["send_email"] ) ? true : false;

    $customer_email = $customOrderRequests->customer_email;
    $customer_name = $customOrderRequests->customer_name;

  
    // Query to update the order details in the database
    $update_custom_order_query = "UPDATE custom_product_requests SET `status`='$status' WHERE id='$custom_order_id'";
    $run_update_order = mysqli_query($con, $update_custom_order_query);
    
    // Check if the update query was successful
    if($run_update_order) {
        if($send_email){
            sendCustomerEmail($customer_email, $customer_name, $status, "$status confirmation.");
        }
        echo "<script>alert('Custom Order has been updated successfully')</script>";
        echo "<script>window.open('index.php?view_custom_orders','_self')</script>";
    } else {
        echo "<script>alert('Failed to update order')</script>";
    }
}
?>
