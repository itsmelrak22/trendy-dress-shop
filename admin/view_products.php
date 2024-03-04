<?php
    spl_autoload_register(function ($class) {
        include '../models/' . $class . '.php';
    });
    

    if (!isset($_SESSION['admin_email'])) {

        echo "<script>window.open('login.php','_self')</script>";
    } else { 
?>
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
                                    <th>Colors (clickable)</th>
                                    <th>Customizable</th>
                                    <th>Date</th>
                                    <th>Delete</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $i = 0;
                                    $instance = new Product;
                                    $row_pro = $instance::getProductsWithColors();
                                    foreach ($row_pro as $key => $value) {
                                    $pro_id = $value['product_id'];
                                    $pro_image = $value['colors'][0]['product_img1'];
                                    $pro_title = $value['product_title'];
                                    $pro_color_name = $value['colors'][0]['color_name'];
                                    $pro_price = $value['product_price'];
                                    $pro_keywords = $value['product_keywords'];
                                    $pro_custom_status = $value['custom_status'];
                                    $pro_date = $value['date'];
                                ?>
                                    <tr>
                                        <td><?= $key + 1; ?></td>
                                        <td><?= $pro_title; ?></td>
                                        <td><img loading="lazy" src="product_images/product/<?=$pro_id?>/<?=$pro_color_name?>/<?=$pro_image?>" width="60" height="60"></td>
                                        <td> <?= $pro_price; ?></td>
                                        <td>
                                            <?php
                                                // $get_sold = "select * from pending_orders where product_id='$pro_id'";
                                                // $run_sold = mysqli_query($con, $get_sold);
                                                // // $count = mysqli_num_rows($run_sold);
                                                // // echo $count;
                                            ?>
                                        </td>
                                        <td> <?= $pro_keywords; ?> </td>
                                        <td>
                                            <?php foreach ($value["colors"] as $key => $color) { ?> 
                                                <a data-toggle="tooltip" title="Click to edit product color info" href="index.php?edit_product_colors=<?= $pro_id;?>&color=<?= $color["color_id"] ?>">
                                                    <span class="badge" style="color: black;"><?= $color["color_name"] ?></span>
                                                </a>
                                            <?php } ?> 
                                            
                                        </td>
                                        <td> <?= $pro_custom_status == 1 ? "YES" : "NO"; ?> </td>
                                        <td><?= $pro_date; ?></td>
                                        <td>
                                            <a href="index.php?delete_product=<?= $pro_id; ?>">
                                                <i class="fa fa-trash-o"> </i> Delete
                                            </a>
                                        </td>
                                        <td>
                                            <a href="index.php?edit_product=<?= $pro_id;?>">
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