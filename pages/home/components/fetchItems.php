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
    
    .card {
        max-height: 350px; /* Set a maximum height for the card */
    }

    .card-body {
        max-height: 300px; /* Set a maximum height for the card body */
        overflow: hidden; /* Hide the overflow content */
    }

    .custom-text {
        font-size: 14px; /* Adjust the font size as needed */
        overflow: hidden; /* Hide the overflow content */
        white-space: nowrap; /* Prevent text from wrapping */
        text-overflow: ellipsis; /* Show an ellipsis (...) when text overflows */
    }
</style>
<div class="album py-5 bg-light">
    <div class="row row-cols-1 row-cols-md-4 g-3">
        <?php
        // Repeat the items in $fetchItems_ to create a set of 100 items
        $repeatTimes = 100;
        $repeatedItems = array_fill(0, $repeatTimes, $fetchItems_);

        // Flatten the array to get a single-dimensional array
        $flatItems = array_merge(...$repeatedItems);

        foreach ($flatItems as $row) :
        ?>
            <div class="col">
                <div class="card shadow-sm">
                    <h6 class="card-title text-center mt-2"><?php echo $row['product_title'] ?></h6>
                    <div class="card-body d-flex justify-content-center">
                        <img src="admin_area\product_images\<?php echo $row['product_img1'] ?>" class="card-image" />
                    </div>
                    <p class="mx-0 my-1 text-center px-2 custom-text"><?php echo $row['product_desc'] ?></p>
                    <span style="font-size:15px;" class="mx-0 my-1 text-center custom-text">&#8369; <?php echo $row['product_price'] ?></span>
                    <a href="viewProduct_main.php?itemID=<?php echo $row['product_id'] ?>&slug=<?php echo $row['product_url'] ?>" style="background-color: black;" class="btn m-2 rounded-pill text-white product_link custom-text">View</a>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>

<!-- <div class="album py-5 bg-light">
    <div class="row row-cols-1 row-cols-md-4 g-3">
        <?php foreach ($fetchItems_ as $row) : ?>
            <div class="col">
                <div class="card shadow-sm">
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
</div> -->

