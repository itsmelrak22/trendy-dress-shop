<?php
    require_once '../../../connection.php';

    $itemsPerPage = 16;

    if (isset($_POST['page'])) {
        $currentPage = $_POST['page'];
        $offset = ($currentPage - 1) * $itemsPerPage;
    } else {
        $currentPage = 1;
        $offset = 0;
    }

    // Calculate the total number of pages
    $totalPages = ceil($conn->query("SELECT COUNT(*)
    FROM products AS A 
    INNER JOIN product_colors AS B
    ON A.product_id = B.product_id")->fetchColumn() / $itemsPerPage);

    // echo json_decode($totalPages);
    // echo json_decode($currentPage);

    $fetchItems = $conn->prepare("SELECT A.*, B.product_img1 as img1 FROM products AS A 
    INNER JOIN product_colors AS B
    ON A.product_id = B.product_id ORDER BY A.product_id DESC LIMIT ?, ?");
    $fetchItems->bindValue(1, $offset, PDO::PARAM_INT);
    $fetchItems->bindValue(2, $itemsPerPage, PDO::PARAM_INT);
    $fetchItems->execute();
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

        foreach ($fetchItems_ as $row) :
            $colors = $conn->prepare("SELECT * FROM `product_colors` WHERE `product_id` = ?");
            $colors->bindValue(1, $row['product_id']);
            $colors->execute();
            $colors_ = $colors->fetchAll();
            
            $display_img = "admin_area/product_images/product/" .  $row['product_id'] . "/" . $colors_[0]["color_name"] . "/" . $colors_[0]["product_img1"];
            $display_desc = $colors_[0]["product_desc"];
            $display_url = $colors_[0]["product_url"];
        ?>
            <div class="col">
                <div class="card shadow-sm">
                    <h6 class="card-title text-center mt-2"><?php echo $row['product_title'] ?></h6>
                    <div class="card-body d-flex justify-content-center">
                        <img src="<?= $display_img ?>" class="card-image" />
                    </div>
                    <p class="mx-0 my-1 text-center px-2 custom-text"><?= $display_desc ?></p>
                    <span style="font-size:15px;" class="mx-0 my-1 text-center custom-text">&#8369; <?php echo $row['product_price'] ?></span>
                    <a href="viewProduct_main.php?itemID=<?php echo $row['product_id'] ?>&slug=<?= $display_url ?>" style="background-color: black;" class="btn m-2 rounded-pill text-white product_link custom-text">View</a>
                </div>
            </div>
        <?php endforeach ?>
    </div>
    <div id="paginationData" data-total-pages="<?php echo $totalPages; ?>"></div>
    <nav class="mx-auto mt-3" aria-label="...">
        <ul class="pagination justify-content-center">
            <li class="page-item <?php echo ($currentPage == 1) ? 'disabled' : ''; ?>">
                <button id="prevPage" class="page-link" onclick="changePage(-1)" tabindex="-1" aria-disabled="true">Previous</button>
            </li>

            <?php
            for ($i = 1; $i <= $totalPages; $i++) {
                echo '<li class="page-item ' . (($i == $currentPage) ? 'active' : '') . '"><button class="page-link" onclick="fetchData(' . $i . ')">' . $i . '</button></li>';
            }
            ?>

            <li class="page-item <?php echo ($currentPage == $totalPages) ? 'disabled' : ''; ?>">
                <button id="nextPage" class="page-link" onclick="changePage(1)">Next</button>
            </li>
        </ul>
    </nav>
</div>
<!-- <div class="pagination mb-5">
    <button id="prevPage" <?php echo ($currentPage == 1) ? 'disabled' : ''; ?> onclick="changePage(-1)">Previous</button>

    <?php
    for ($i = 1; $i <= $totalPages; $i++) {
        echo '<span class="page-link" onclick="fetchData(' . $i . ')">' . $i . '</span>';
    }
    ?>

    <button id="nextPage" <?php echo ($currentPage == $totalPages) ? 'disabled' : ''; ?> onclick="changePage(1)">Next</button>
</div> -->
