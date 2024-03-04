<?php
if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php','_self')</script>";
} else {
?>

    <div class="row">
        <!-- 1 row Starts -->
        <div class="col-lg-12">
            <!-- col-lg-12 Starts -->
            <nav aria-label="breadcrumb">
                <!-- breadcrumb Starts -->
                <ol class="breadcrumb">
                    <!-- breadcrumb Starts -->
                    <li class="breadcrumb-item active">
                        <h3><i class="fa fa-dashboard"></i> Dashboard</h3>
                    </li>
                </ol><!-- breadcrumb Ends -->
            </nav><!-- breadcrumb Ends -->
        </div><!-- col-lg-12 Ends -->
    </div><!-- 1 row Ends -->

    <div class="row">
        <!-- 2 row Starts -->
        <!-- No content in this row -->
    </div><!-- 2 row Ends -->

    <div class="row">
        <div class="col-lg-3 col-md-6">
            <!-- col-lg-3 col-md-6 Starts -->
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-3">
                            <i class="fa fa-tasks fa-5x"></i>
                        </div>
                        <div class="col-9 text-end">
                            <div class="huge"><?php echo $count_products; ?></div>
                            <div>Products</div>
                        </div>
                    </div>
                </div>
                <a href="index.php?view_products" class="text-white text-decoration-none">
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <span class="me-3">View Details</span>
                        <span><i class="fa fa-arrow-circle-right"></i></span>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <!-- col-lg-3 col-md-6 Starts -->
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-3">
                            <i class="fa fa-support fa-5x"></i>
                        </div>
                        <div class="col-9 text-end">
                            <div class="huge"><?php echo $count_total_orders; ?></div>
                            <div>Orders</div>
                        </div>
                    </div>
                </div>
                <a href="index.php?view_orders" class="text-white text-decoration-none">
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <span class="me-3">View Details</span>
                        <span><i class="fa fa-arrow-circle-right"></i></span>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <!-- col-lg-3 col-md-6 Starts -->
            <div class="card text-white bg-danger mb-3">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-3">
                            <i class="fa fa-spinner fa-5x"></i>
                        </div>
                        <div class="col-9 text-end">
                            <div class="huge"><?php echo $count_pending_orders; ?></div>
                            <div>Pending Orders</div>
                        </div>
                    </div>
                </div>
                <a href="index.php?view_orders" class="text-white text-decoration-none">
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <span class="me-3">View Details</span>
                        <span><i class="fa fa-arrow-circle-right"></i></span>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <!-- col-lg-3 col-md-6 Starts -->
            <div class="card text-white bg-success mb-3">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-3">
                            <i class="fa fa-check fa-5x"></i>
                        </div>
                        <div class="col-9 text-end">
                            <div class="huge"><?php echo $count_completed_orders; ?></div>
                            <div>Completed Orders</div>
                        </div>
                    </div>
                </div>
                <a href="index.php?view_orders" class="text-white text-decoration-none">
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <span class="me-3">View Details</span>
                        <span><i class="fa fa-arrow-circle-right"></i></span>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- 3 row Starts -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fa fa-money fa-fw"></i> New Orders
                    </h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Order #</th>
                                    <th>Customer</th>
                                    <th>Invoice No</th>
                                    <th>Product</th>
                                    <th>Qty</th>
                                    <th>Size</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                $get_orders = "SELECT 
                                                    po.order_id,
                                                    po.customer_id,
                                                    po.invoice_no,
                                                    po.order_status,
                                                    po.cartItems,
                                                    po.order_date,
                                                    c.customer_name,
                                                    c.customer_email,
                                                    c.complete_address,
                                                    cart.product_id AS p_2,
                                                    cart.qty AS quantity,
                                                    cart.size,
                                                    cart.Total_p_price,
                                                    p.product_id AS p_1,
                                                    p.product_title
                                                FROM customer_orders AS po
                                                JOIN customers AS c ON po.customer_id = c.customer_id
                                                JOIN cart ON po.cartItems = cart.p_id
                                                JOIN products AS p ON cart.product_id = p.product_id";

                                $run_orders = mysqli_query($con, $get_orders);
                                while ($row_orders = mysqli_fetch_array($run_orders)) {
                                    $order_id = $row_orders['order_id'];
                                    $c_id = $row_orders['customer_id'];
                                    $invoice_no = $row_orders['invoice_no'];
                                    $order_status = $row_orders['order_status'];
                                    $time_date = $row_orders['order_date'];
                                    $cart_items = $row_orders['cartItems'];
                                    $size = $row_orders['size'];
                                    $customer_name = $row_orders['customer_name'];
                                    $customer_email = $row_orders['customer_email'];
                                    $customer_address = $row_orders['complete_address'];
                                    $product_id = $row_orders['p_1'];
                                    $product_title = $row_orders['product_title'];
                                    $quantity = $row_orders['quantity'];
                                    $total_price = $row_orders['Total_p_price'];

                                    $i++;
                                ?>

                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $customer_email ?></td>
                                        <td bgcolor="orange"><?php echo $invoice_no; ?></td>
                                        <td><?php echo $product_title ?></td>
                                        <td><?php echo $quantity ?></td>
                                        <td><?php echo $size ?></td>
                                        <td>
                                            <?php
                                            if ($order_status == 'pending') {
                                                echo '<div style="color:red;">Pending</div>';
                                            } else if ($order_status == 'transit') {
                                                echo '<div style="color:orange;">Transit</div>';
                                            } else if ($order_status == 'delivered') {
                                                echo '<div style="color:blue;">Delivered</div>';
                                            } else {
                                                echo '<div style="color:green;">Cancelled</div>';
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-end">
                        <a href="index.php?view_orders">View All Orders <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <!-- Implement content for the card -->
            </div>
        </div>
    </div>

<?php } ?>
