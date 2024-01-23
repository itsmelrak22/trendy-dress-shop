<?php



if (!isset($_SESSION['admin_email'])) {

    echo "<script>window.open('login.php','_self')</script>";
} else {

    ?>


    <div class="row">
        <!--  1 row Starts -->

        <div class="col-lg-12">
            <!-- col-lg-12 Starts -->

            <ol class="breadcrumb">
                <!-- breadcrumb Starts -->

                <li class="active">

                    <i class="fa fa-dashboard"></i> Dashboard / View Products

                </li>

            </ol><!-- breadcrumb Ends -->

        </div><!-- col-lg-12 Ends -->

    </div><!--  1 row Ends -->

    <div class="row">
        <!-- 2 row Starts -->

        <div class="col-lg-12">
            <!-- col-lg-12 Starts -->

            <div class="panel panel-default">
                <!-- panel panel-default Starts -->

                <div class="panel-heading">
                    <!-- panel-heading Starts -->

                    <h3 class="panel-title">
                        <!-- panel-title Starts -->

                        <i class="fa fa-money fa-fw"></i> View Products

                    </h3><!-- panel-title Ends -->


                </div><!-- panel-heading Ends -->

                <div class="panel-body">
                    <!-- panel-body Starts -->

                    <div class="table-responsive">
                        <!-- table-responsive Starts -->

                        <table class="table table-bordered table-hover table-striped">
                            <!-- table table-bordered table-hover table-striped Starts -->

                            <thead>

                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Price</th>
                                    <th>Sold</th>
                                    <th>Keywords</th>
                                    <th>Date</th>
                                    <th>Delete</th>
                                    <th>Edit</th>



                                </tr>

                            </thead>

                            <tbody>

                                <?php

                                    $i = 0;

                                    $get_pro = "SELECT A.*, B.color_name, B.product_img1 AS img1,  B.product_img2 AS img2,  B.product_img3 AS img3, B.color_id  
                                    FROM products AS A 
                                    INNER JOIN product_colors AS B
                                    ON A.product_id = B.product_id
                                    WHERE A.status = 'product' 
                                    ";

                                    $run_pro = mysqli_query($con, $get_pro);

                                    while ($row_pro = mysqli_fetch_array($run_pro)) {

                                        $pro_id = $row_pro['product_id'];

                                        $pro_title = $row_pro['product_title'];

                                        $pro_image = $row_pro['img1'];

                                        $pro_price = $row_pro['product_price'];

                                        $pro_keywords = $row_pro['product_keywords'];

                                        $pro_date = $row_pro['date'];

                                        $pro_color_id = $row_pro['color_id'];

                                        $i++;

                                        ?>

                                    <tr>

                                        <td><?php echo $i; ?></td>

                                        <td><?php echo $pro_title; ?></td>

                                        <td><img src="product_images/<?php echo $pro_image; ?>" width="60" height="60"></td>

                                        <td> <?php echo $pro_price; ?></td>

                                        <td>
                                            <?php

                                                    $get_sold = "select * from pending_orders where product_id='$pro_id'";
                                                    $run_sold = mysqli_query($con, $get_sold);
                                                    // $count = mysqli_num_rows($run_sold);
                                                    // echo $count;
                                                    ?>
                                        </td>

                                        <td> <?php echo $pro_keywords; ?> </td>

                                        <td><?php echo $pro_date; ?></td>

                                        <td>

                                            <a href="index.php?delete_product=<?= $pro_id; ?>">

                                                <i class="fa fa-trash-o"> </i> Delete

                                            </a>

                                        </td>

                                        <td>

                                            <a href="index.php?edit_product=<?= $pro_id;?>&color=<?= $pro_color_id ?>">

                                                <i class="fa fa-pencil"> </i> Edit

                                            </a>

                                        </td>

                                    </tr>

                                <?php } ?>


                            </tbody>


                        </table><!-- table table-bordered table-hover table-striped Ends -->

                    </div><!-- table-responsive Ends -->

                </div><!-- panel-body Ends -->

            </div><!-- panel panel-default Ends -->

        </div><!-- col-lg-12 Ends -->

    </div><!-- 2 row Ends -->




<?php } ?>