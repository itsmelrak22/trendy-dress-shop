<?php
require_once '../../../connection.php';

// Example Fetching
$fetchItems = $conn->prepare("SELECT a.* FROM products a ORDER BY a.product_id DESC LIMIT 0, 8");
$fetchItems->execute([]);
$fetchItems_ = $fetchItems->fetchAll();
?>
<style>
    .fixed-height-card {
        height: 450px;
        /* You can add other styles as needed */
    }
</style>
<div class="row m-2">
    <?php foreach ($fetchItems_ as $row) : ?>
        <div class="col-sm-12 col-md-3 col-lg-3">
            <div class="card fixed-height-card">
                <h6 class="card-title text-center mt-2"><?php echo $row['product_title'] ?></h6>
                <div class="card-body  d-flex justify-content-center">

                    <img src="admin_area\product_images\<?php echo $row['product_img1'] ?>" class="card-image" />
                </div>


                <p class="mx-0 my-1 text-center  px-2"><?php echo $row['product_desc'] ?></p>

                <span style="font-size:15px;" class="mx-0 my-1 text-center">&#8369; <?php echo $row['product_price'] ?></span>
                <a href="viewProduct_main.php?itemID=<?php echo $row['product_id'] ?> &&slug=<?php echo $row['product_url'] ?>" style="background-color: black;" class="btn  m-2 rounded-pill text-white product_link">View</a>
            </div>

        </div>

    <?php endforeach ?>

</div>