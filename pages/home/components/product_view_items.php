<?php
require_once '../../../connection.php';

if (isset($_POST['itemID'])) {
    $itemID = $_POST['itemID'];
} else {
    $itemID = 0;
}
// Example Fetching
$fetchItems = $conn->prepare("SELECT a.* FROM products a ORDER BY a.product_id DESC LIMIT 0, 8");
$fetchItems->execute([]);
$fetchItems_ = $fetchItems->fetchAll();
?>


    <?php foreach ($fetchItems_ as $key => $row) : ?>
        <?php if ($row['product_id'] !== $itemID) : ?>
            <div class=" bg-light row  m-1">
                <div class="col-lg-12 col-md-2 col-sm-12 d-flex justify-content-center">
                    <img class="m-1" src="admin_area\product_images\<?php echo $row['product_img1'] ?>" style="width:150px" />
                </div>
                <div class="col-lg-10 col-md-10 col-sm-12 mx-2">
                    <p class="mb-0"><?php echo $row['product_title'] ?></p>
                    <p class="mb-0">&#8369; <span class="mb-0"><?php echo $row['product_price'] ?></span></p>
                    <a href="viewProduct_main.php?itemID=<?php echo $row['product_id'] ?> &&slug=<?php echo $row['product_url'] ?>" style="background-color: black;" class="btn rounded-pill text-white form-control">View</a>
                </div>
            </div>
        <?php endif ?>
    <?php endforeach ?>

