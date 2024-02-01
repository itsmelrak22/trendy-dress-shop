<?php
    require_once '../../../connection.php';

    if (isset($_POST['itemID'])) {
        $itemID = $_POST['itemID'];
    } else {
        $itemID = 0;
    }
    // Example Fetching
    // $fetchItems = $conn->prepare("SELECT a.* FROM products a ORDER BY a.product_id DESC LIMIT 0, 8");
    // $fetchItems->execute([]);
    // $fetchItems_ = $fetchItems->fetchAll();

    $fetchItems = $conn->prepare(
        "SELECT A.*, 
        B.product_img1 as img1, 
        B.product_desc as description,
        B.product_url as p_url
        FROM products AS A INNER JOIN product_colors AS B
    ON A.product_id = B.product_id ORDER BY A.product_id DESC LIMIT 0, 4");
    $fetchItems->execute();
    $fetchItems_ = $fetchItems->fetchAll();

    // echo "<pre>". print_r($fetchItems_) ."</pre>";

    foreach ($fetchItems_ as $key => $value) {
        $colors = $conn->prepare("SELECT * FROM `product_colors` WHERE `product_id` = ?");
        $colors->bindValue(1, $value['product_id']);
        $colors->execute();
        $colors_ = $colors->fetchAll();
        $fetchItems_[$key]["colors"] = $colors_;
    }
    
    // $fetchItems = $conn->prepare("SELECT a.* FROM products a ORDER BY a.product_id DESC LIMIT 0, 8");
    // $fetchItems->execute([]);
    // $fetchItems_ = $fetchItems->fetchAll();
?>


<?php foreach ($fetchItems_ as $key => $row) : ?>
    <?php 
        foreach ($row["colors"] as $key => $value) {
            $img1 = "admin_area/product_images/product/" .$row["product_id"] ."/". $value["color_name"] ."/". $value['product_img1'];
            $img2 = "admin_area/product_images/product/" .$row["product_id"] ."/". $value["color_name"] ."/". $value['product_img2'];
            $img3 = "admin_area/product_images/product/" .$row["product_id"] ."/". $value["color_name"] ."/". $value['product_img3'];
            $desc = $value["product_desc"];
            $url = $value["product_url"];
        }
    ?>
    <?php if ($row['product_id'] !== $itemID) : ?>
        <div class=" bg-light row  m-1">
            <div class="col-lg-12 col-md-2 col-sm-12 d-flex justify-content-center">
                <img class="m-1" src="<?= $img1 ?>" style="width:150px" />
            </div>
            <div class="col-lg-10 col-md-10 col-sm-12 mx-2">
                <p class="mb-0"><?php echo $row['product_title'] ?></p>
                <p class="mb-0">&#8369; <span class="mb-0"><?php echo $row['product_price'] ?></span></p>
                <a href="viewProduct_main.php?itemID=<?php echo $row['product_id'] ?> &&slug=<?= $url ?>" style="background-color: black;" class="btn rounded-pill text-white form-control">View</a>
            </div>
        </div>
    <?php endif ?>
<?php endforeach ?>

