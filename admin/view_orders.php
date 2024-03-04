<?php
if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php','_self')</script>";
} else {
?>


<div class="row"><!-- 2 row Starts -->
    <div class="col-lg-12"><!-- col-lg-12 Starts -->
        <div class="panel panel-default"><!-- panel panel-default Starts -->
            <div class="panel-heading"><!-- panel-heading Starts -->
                <h3 class="panel-title"><!-- panel-title Starts -->
                    <i class="fa fa-money fa-fw"></i> View Orders
                </h3><!-- panel-title Ends -->
            </div><!-- panel-heading Ends -->
            <div class="panel-body"><!-- panel-body Starts -->
                <div class="table-responsive"><!-- table-responsive Starts -->
                    <table class="table table-bordered table-hover table-striped"><!-- table table-bordered table-hover table-striped Starts -->
                        <thead><!-- thead Starts -->
                            <tr>
                                <th>#</th>
                                <th>Customer</th>
                                <th>Invoice</th>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Size</th>
                                <th>Order Date</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead><!-- thead Ends -->
                        <tbody><!-- tbody Starts -->
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
                                    <td><?php echo $time_date ?></td>
                                    <td><?php echo $total_price ?></td>
                                    <td>
                                        <?php
                                        if ($order_status == 'pending') {
                                            echo '<div style="color:red;">Pending</div>';
                                        } else if ($order_status == 'transit') {
                                            echo '<div style="color:orange;">Transit</div>';
                                        }else if($order_status == 'delivered'){
                                            echo '<div style="color:blue;">Delivered</div>';
                                        }else{
                                            echo '<div style="color:green;">Cancelled</div>';
                                        }
                                            
                                        ?>
                                    </td>
                                    <td>
                                        <a href="index.php?edit_orders=<?php echo $order_id; ?>">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                    </td>
                                    <td>
                                        <a href="index.php?order_delete=<?php echo $order_id; ?>">
                                            <i class="fa fa-trash-o"></i> Delete
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>