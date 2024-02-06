<?php
if (!isset($_SESSION['admin_email'])) {
    // If not logged in, redirect to login page
    echo "<script>window.open('login.php','_self')</script>";
    exit(); // Stop further execution
}

if(isset($_GET['edit_orders'])) {
    $order_id = $_GET['edit_orders'];
    
    $edit_order_query = "SELECT po.*, c.customer_name, c.customer_email, c.complete_address FROM pending_orders AS po JOIN customers AS c ON po.customer_id = c.customer_id WHERE po.order_id='$order_id'";
    $run_edit_order = mysqli_query($con, $edit_order_query);
    $row_edit_order = mysqli_fetch_array($run_edit_order);
    
    if($row_edit_order) {
        
        $order_id = $row_edit_order['order_id'];
        $customer_name = $row_edit_order['customer_name'];
        $customer_id = $row_edit_order['customer_id'];
        $customer_email = $row_edit_order['customer_email'];
        $complete_address = $row_edit_order['complete_address'];
        $invoice_no = $row_edit_order['invoice_no'];
        $order_status = $row_edit_order['order_status'];
        
?>
<div class="row"><!-- 1 row Starts -->
    <div class="col-lg-12"><!-- col-lg-12 Starts -->
        <ol class="breadcrumb"><!-- breadcrumb Starts -->
            <li>
                <i class="fa fa-dashboard"></i> Dashboard / Edit Order
            </li>
        </ol><!-- breadcrumb Ends -->
    </div><!-- col-lg-12 Ends -->
</div><!-- 1 row Ends -->
<div class="row"><!-- 2 row Starts -->
    <div class="col-lg-12"><!-- col-lg-12 Starts -->
        <div class="panel panel-default"><!-- panel panel-default Starts -->
            <div class="panel-heading" ><!-- panel-heading Starts -->
                <h3 class="panel-title" ><!-- panel-title Starts -->
                    <i class="fa fa-money fa-fw" ></i> Edit Order
                </h3><!-- panel-title Ends -->
            </div><!-- panel-heading Ends -->
            <div class="panel-body" ><!-- panel-body Starts -->
                <form class="form-horizontal" action="" method="post" enctype="multipart/form-data" ><!-- form-horizontal Starts -->
                    <div class="form-group" ><!-- form-group Starts -->
                        <label class="col-md-3 control-label" >Order#</label>
                        <div class="col-md-9" >
                            <input type="text" name="order_id" class="form-control" value="<?php echo $order_id; ?>" >
                        </div>
                    </div><!-- form-group Ends -->
                    <div class="form-group" ><!-- form-group Starts -->
                        <label class="col-md-3 control-label" >Customer Name</label>
                        <div class="col-md-9" >
                            <input type="text" name="customer_name" class="form-control" value="<?php echo $customer_name; ?>" >
                            <input type="hidden" name="customer_id" class="form-control" value="<?php echo $customer_id; ?>" >
                        </div>
                    </div><!-- form-group Ends -->
                    <div class="form-group" ><!-- form-group Starts -->
                        <label class="col-md-3 control-label" >Invoice Number</label>
                        <div class="col-md-9" >
                            <input type="text" name="invoice_no" class="form-control" value="<?php echo $invoice_no; ?>" >
                        </div>
                    </div><!-- form-group Ends -->
                    <div class="form-group" ><!-- form-group Starts -->
                        <label class="col-md-3 control-label" >Order Status</label>
                        <div class="col-md-9" >
                            <select name="order_status" class="form-control">
                                <option value="pending" <?php if($order_status == 'pending') echo 'selected'; ?>>Pending</option>
                                <option value="transit" <?php if($order_status == 'transit') echo 'selected'; ?>>Transit</option>
                                <option value="delivered" <?php if($order_status == 'delivered') echo 'selected'; ?>>Delivered</option>
                                <option value="cancelled" <?php if($order_status == 'cancelled') echo 'selected'; ?>>Cancelled</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>
                    </div><!-- form-group Ends -->

                    <div class="form-group" ><!-- form-group Starts -->
                        <label class="col-md-8 control-label" ></label>
                        <div class="col-md-4" >
                            <input type="submit" name="update" value="Update Now" class="btn btn-primary form-control" >
                        </div>
                    </div><!-- form-group Ends -->
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
    // Retrieve form data
    $order_id = $_POST['order_id'];
    $customer_id = $_POST['customer_id'];
    $invoice_no = $_POST['invoice_no'];
    $order_status = $_POST['order_status'];
    
    // Query to update the order details in the database
    $update_order_query = "UPDATE pending_orders SET customer_id='$customer_id', invoice_no='$invoice_no', order_status='$order_status' WHERE order_id='$order_id'";
    $run_update_order = mysqli_query($con, $update_order_query);
    
    // Check if the update query was successful
    if($run_update_order) {
        echo "<script>alert('Order has been updated successfully')</script>";
        echo "<script>window.open('index.php?view_orders','_self')</script>";
    } else {
        echo "<script>alert('Failed to update order')</script>";
    }
}
?>
