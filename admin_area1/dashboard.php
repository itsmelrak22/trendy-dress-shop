<?php



if (!isset($_SESSION['admin_email'])) {

    echo "<script>window.open('login.php','_self')</script>";
} else {




    ?>

    <div class="row">
        <!-- 1 row Starts -->

        <div class="col-lg-12">
            <!-- col-lg-12 Starts -->

            <!-- <h1 class="page-header">Dashboard</h1> -->

            <ol class="breadcrumb">
                <!-- breadcrumb Starts -->

                <li class="active">

                    <i class="fa fa-dashboard"></i> Dashboard

                </li>

            </ol><!-- breadcrumb Ends -->

        </div><!-- col-lg-12 Ends -->

    </div><!-- 1 row Ends -->


    <div class="row">
        <!-- 2 row Starts -->




    </div><!-- 2 row Ends -->

    <div class="row">

        <div class="col-lg-3 col-md-6">
            <!-- col-lg-3 col-md-6 Starts -->

            <div class="panel panel-primary">
                <!-- panel panel-primary Starts -->

                <div class="panel-heading">
                    <!-- panel-heading Starts -->

                    <div class="row">
                        <!-- panel-heading row Starts -->

                        <div class="col-xs-3">
                            <!-- col-xs-3 Starts -->

                            <i class="fa fa-tasks fa-5x"> </i>

                        </div><!-- col-xs-3 Ends -->

                        <div class="col-xs-9 text-right">
                            <!-- col-xs-9 text-right Starts -->

                            <div class="huge"> <?php echo $count_products; ?> </div>

                            <div>Products</div>

                        </div><!-- col-xs-9 text-right Ends -->

                    </div><!-- panel-heading row Ends -->

                </div><!-- panel-heading Ends -->

                <a href="index.php?view_products">

                    <div class="panel-footer">
                        <!-- panel-footer Starts -->

                        <span class="pull-left"> View Details </span>

                        <span class="pull-right"> <i class="fa fa-arrow-circle-right"></i> </span>

                        <div class="clearfix"></div>

                    </div><!-- panel-footer Ends -->

                </a>

            </div><!-- panel panel-primary Ends -->
        </div><!-- col-lg-3 col-md-6 Ends -->

        <div class="col-lg-3 col-md-6">
            <!-- col-lg-3 col-md-6 Starts -->

            <div class="panel panel-red">
                <!-- panel panel-red Starts -->

                <div class="panel-heading">
                    <!-- panel-heading Starts -->

                    <div class="row">
                        <!-- panel-heading row Starts -->

                        <div class="col-xs-3">
                            <!-- col-xs-3 Starts -->

                            <i class="fa fa-support fa-5x"> </i>

                        </div><!-- col-xs-3 Ends -->

                        <div class="col-xs-9 text-right">
                            <!-- col-xs-9 text-right Starts -->

                            <div class="huge"> <?php echo $count_total_orders; ?> </div>

                            <div>Orders</div>

                        </div><!-- col-xs-9 text-right Ends -->

                    </div><!-- panel-heading row Ends -->

                </div><!-- panel-heading Ends -->

                <a href="index.php?view_orders">

                    <div class="panel-footer">
                        <!-- panel-footer Starts -->

                        <span class="pull-left"> View Details </span>

                        <span class="pull-right"> <i class="fa fa-arrow-circle-right"></i> </span>

                        <div class="clearfix"></div>

                    </div><!-- panel-footer Ends -->

                </a>

            </div><!-- panel panel-red Ends -->

        </div><!-- col-lg-3 col-md-6 Ends -->


        <div class="col-lg-3 col-md-6">
            <!-- col-lg-3 col-md-6 Starts -->

            <div class="panel panel-warning">
                <!-- panel panel-red Starts -->

                <div class="panel-heading">
                    <!-- panel-heading Starts -->

                    <div class="row">
                        <!-- panel-heading row Starts -->

                        <div class="col-xs-3">
                            <!-- col-xs-3 Starts -->

                            <i class="fa fa-spinner fa-5x"> </i>

                        </div><!-- col-xs-3 Ends -->

                        <div class="col-xs-9 text-right">
                            <!-- col-xs-9 text-right Starts -->

                            <div class="huge"> <?php echo $count_pending_orders ?> </div>

                            <div>Pending Orders</div>

                        </div><!-- col-xs-9 text-right Ends -->

                    </div><!-- panel-heading row Ends -->

                </div><!-- panel-heading Ends -->

                <a href="index.php?view_orders">

                    <div class="panel-footer">
                        <!-- panel-footer Starts -->

                        <span class="pull-left"> View Details </span>

                        <span class="pull-right"> <i class="fa fa-arrow-circle-right"></i> </span>

                        <div class="clearfix"></div>

                    </div><!-- panel-footer Ends -->

                </a>

            </div><!-- panel panel-red Ends -->

        </div><!-- col-lg-3 col-md-6 Ends -->



        <div class="col-lg-3 col-md-6">
            <!-- col-lg-3 col-md-6 Starts -->

            <div class="panel panel-info">
                <!-- panel panel-red Starts -->

                <div class="panel-heading">
                    <!-- panel-heading Starts -->

                    <div class="row">
                        <!-- panel-heading row Starts -->

                        <div class="col-xs-3">
                            <!-- col-xs-3 Starts -->

                            <i class="fa fa-check fa-5x"> </i>

                        </div><!-- col-xs-3 Ends -->

                        <div class="col-xs-9 text-right">
                            <!-- col-xs-9 text-right Starts -->

                            <div class="huge"> <?php echo $count_completed_orders ?> </div>

                            <div>Completed Orders</div>

                        </div><!-- col-xs-9 text-right Ends -->

                    </div><!-- panel-heading row Ends -->

                </div><!-- panel-heading Ends -->

                <a href="index.php?view_orders">

                    <div class="panel-footer">
                        <!-- panel-footer Starts -->

                        <span class="pull-left"> View Details </span>

                        <span class="pull-right"> <i class="fa fa-arrow-circle-right"></i> </span>

                        <div class="clearfix"></div>

                    </div><!-- panel-footer Ends -->

                </a>

            </div><!-- panel panel-red Ends -->

        </div><!-- col-lg-3 col-md-6 Ends -->


    </div>

    <div class="row">
        <!-- 3 row Starts -->

        <div class="col-lg-12">
            <!-- col-lg-8 Starts -->

            <div class="panel panel-primary">
                <!-- panel panel-primary Starts -->

                <div class="panel-heading">
                    <!-- panel-heading Starts -->

                    <h3 class="panel-title">
                        <!-- panel-title Starts -->

                        <i class="fa fa-money fa-fw"></i> New Orders

                    </h3><!-- panel-title Ends -->

                </div><!-- panel-heading Ends -->

                <div class="panel-body">
                    <!-- panel-body Starts -->

                    <div class="table-responsive">
                        <!-- table-responsive Starts -->

                        <table class="table table-bordered table-hover table-striped">
                            <!-- table table-bordered table-hover table-striped Starts -->

                            <thead>
                                <!-- thead Starts -->

                                <tr>
                                    <th>Order #</th>
                                    <th>Customer</th>
                                    <th>Invoice No</th>
                                    <th>Product Name</th>
                                    <th>Qty</th>
                                    <th>Size</th>
                                    <th>Status</th>


                                </tr>

                            </thead><!-- thead Ends -->

                            <tbody>
                                <!-- tbody Starts -->

                                <?php

                                    $i = 0;

                                    $get_order = "SELECT C.size,  A.order_id, A.dateTimeAdded, A.mop, A.invoice_no, B.customer_id, B.customer_name, B.customer_email, C.qty, C.Total_p_price, C.status, D.product_id, D.product_title, D.product_price, A.order_status
                                    FROM pending_orders A 
                                    INNER JOIN customers B 
                                    ON A.customer_id = B.customer_id 
                                    INNER JOIN cart C
                                    ON A.cartItems = C.p_id
                                    INNER JOIN products D
                                    ON C.product_id = D.product_id
                                    ORDER BY A.dateTimeAdded DESC  ";

                                    $run_order = mysqli_query($con, $get_order);

                                    while ($row_order = mysqli_fetch_array($run_order)) {


                                        $order_id = $row_order['order_id'];
                                        $c_id = $row_order['customer_id'];
                                        $invoice_no = $row_order['invoice_no'];
                                        $product_id = $row_order['product_id'];
                                        $product_title = $row_order['product_title'];
                                        $qty = $row_order['qty'];
                                        $size = $row_order['size'];
                                        $order_status = $row_order['order_status'];
                                        $customer_email = $row_order['customer_email'];


                                        $i++;

                                        ?>

                                    <tr>
                                        <td> <?= $order_id; ?></td>
                                        <td> <?= $customer_email; ?> </td>
                                        <td> <?= $invoice_no; ?> </td>
                                        <td> <?= $product_title; ?> </td>
                                        <td> <?= $qty; ?> </td>
                                        <td> <?= $size; ?> </td>
                                        <td> <?= $order_status; ?> </td>
                                    </tr>

                                <?php } ?>

                            </tbody><!-- tbody Ends -->


                        </table><!-- table table-bordered table-hover table-striped Ends -->

                    </div><!-- table-responsive Ends -->

                    <div class="text-right">
                        <!-- text-right Starts -->

                        <!-- <a href="index.php?view_orders">

                            View All Orders <i class="fa fa-arrow-circle-right"></i>

                        </a> -->

                    </div><!-- text-right Ends -->


                </div><!-- panel-body Ends -->

            </div><!-- panel panel-primary Ends -->

        </div><!-- col-lg-8 Ends -->

        <div class="col-md-4">
            <!-- col-md-4 Starts -->

            <div class="panel">
                <!-- panel Starts -->



            </div><!-- panel Ends -->

        </div><!-- col-md-4 Ends -->

    </div><!-- 3 row Ends -->

<?php } ?>