<?php
session_start();

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
//     $fetchItems = $conn->prepare("SELECT A.*, B.product_img1 as img1 FROM products AS A 
//     INNER JOIN product_colors AS B
//     ON A.product_id = B.product_id ORDER BY A.product_id DESC LIMIT ?, ?");
//     $fetchItems->bindValue(1, $offset, PDO::PARAM_INT);
//     $fetchItems->bindValue(2, $itemsPerPage, PDO::PARAM_INT);
//     $fetchItems->execute();
//     $fetchItems_ = $fetchItems->fetchAll();

//     $query = "
//     SELECT DISTINCT C.p_cat_id, C.p_cat_title 
//     FROM product_categories AS C 
//     LEFT JOIN products AS A ON C.p_cat_id = A.p_cat_id
//     LEFT JOIN product_colors AS B ON A.product_id = B.product_id";

// try {
//     // Prepare and execute the query
//     $stmt = $conn->prepare($query);
//     $stmt->execute();

//     // Fetch all rows as associative array
//     $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
// } catch (PDOException $e) {
//     // Handle database errors
//     echo "Error fetching categories: " . $e->getMessage();
// }

// Fetch categories data from the database
$query = "SELECT p_cat_id, p_cat_title FROM product_categories";
try {
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Handle database errors
    echo "Error fetching categories: " . $e->getMessage();
}

if (isset($_POST['page'])) {
    $currentPage = $_POST['page'];
    $offset = ($currentPage - 1) * $itemsPerPage;
} else {
    $currentPage = 1;
    $offset = 0;
}

// Check if search query is set
if (isset($_SESSION['searchItem'])) {
    $searchQuery = '%' . $_SESSION['searchItem'] . '%'; // Add wildcard characters
    $query = "SELECT A.*, B.product_img1 as img1 , B.color_id
              FROM products AS A 
              INNER JOIN product_colors AS B ON A.product_id = B.product_id 
              WHERE A.custom_status = 1 AND A.product_title LIKE ? OR B.product_desc LIKE ?
              ORDER BY A.product_id DESC 
              LIMIT ?, ?";
    
    try {
        // Prepare and execute the query
        $fetchItems = $conn->prepare($query);
        $fetchItems->bindValue(1, $searchQuery, PDO::PARAM_STR);
        $fetchItems->bindValue(2, $searchQuery, PDO::PARAM_STR);
        $fetchItems->bindValue(3, $offset, PDO::PARAM_INT);
        $fetchItems->bindValue(4, $itemsPerPage, PDO::PARAM_INT);
        $fetchItems->execute();
        $fetchItems_ = $fetchItems->fetchAll();
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error fetching items: " . $e->getMessage();
    }
} else {
    // Original query without search condition
    $query = "SELECT A.*, B.product_img1 as img1, B.color_id
              FROM products AS A 
              INNER JOIN product_colors AS B ON A.product_id = B.product_id 
              WHERE A.custom_status = 1
              ORDER BY A.product_id DESC 
              LIMIT ?, ?";
    
    try {
        // Prepare and execute the query
        $fetchItems = $conn->prepare($query);
        $fetchItems->bindValue(1, $offset, PDO::PARAM_INT);
        $fetchItems->bindValue(2, $itemsPerPage, PDO::PARAM_INT);
        $fetchItems->execute();
        $fetchItems_ = $fetchItems->fetchAll();
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error fetching items: " . $e->getMessage();
    }
}

    $topSalesQuery = "
        SELECT 
        B.product_id, 
        B.product_title, 
        C.product_desc, 
        B.product_price, 
        C.product_img1 AS img1, 
        COUNT(A.product_id) AS total_sales
        FROM 
        cart AS A 
        INNER JOIN 
        products AS B ON A.product_id = B.product_id 
        INNER JOIN 
        product_colors AS C ON B.product_id = C.product_id 
        WHERE 
        A.status = 1
        GROUP BY 
        B.product_id, B.product_title, C.product_desc, B.product_price, C.product_img1
        ORDER BY 
        total_sales DESC
        LIMIT 
        4;
    ";

try {
    // Prepare and execute the query
    $topSalesStmt = $conn->prepare($topSalesQuery);
    $topSalesStmt->execute();

    // Fetch top sales products
    $topSalesProducts = $topSalesStmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Handle database errors
    echo "Error fetching top sales products: " . $e->getMessage();
}



?>
<style>
    .fixed-height-card {
        height: 450px;
    }
    
    .card {
        max-height: 350px; 
    }

    .card-body {
        max-height: 300px; 
        overflow: hidden; 
    }

    .custom-text {
        font-size: 14px; 
        overflow: hidden; 
        white-space: nowrap; 
        text-overflow: ellipsis;
    }
    
    
</style>

<div class="album py-5 bg-light">
    <div class="row">
        <!-- Categories Section -->
        <!-- Top Sales Products Section -->
        <div class="col-md-12">
            <?php if( isset($_SESSION['searchItem']) )  {?>
                <form  method="get">
                    <div class="input-group mb-3 mx-2 my-2">
                        <span class="input-group-text " id="basic-addon1"> "<?= $_SESSION['searchItem'] ?>" Results</span>
                        <input class="btn btn-sm" type="submit" value="clear">
                    </div>
                </form>
            <?php }  ?>
        </div>
            <div class="col-md-2">
                <div class="list-group" style="padding-left: 10px;">
                    <h3 class="my-4">Categories</h3>
                    <span style="cursor: pointer;" class="list-group-item list-group-item-action active" onclick="applyFilter('all')">All</span>
                    <?php foreach ($categories as $category) : ?>
                        <span style="cursor: pointer;"  class="list-group-item list-group-item-action " onclick="applyFilter('<?php echo $category['p_cat_id']; ?>')"><?php echo $category['p_cat_title']; ?></span>
                    <?php endforeach; ?>
                </div>
            </div>


            <div class="col-md-10">
                <div class="row row-cols-1 row-cols-md-4 g-3" style="padding: 10px;">
                    
                    <?php
                    // Repeat the items in $fetchItems_ to create a set of 100 items
                    $repeatTimes = 100;
                    $repeatedItems = array_fill(0, $repeatTimes, $fetchItems_);

                    // Flatten the array to get a single-dimensional array
                    $flatItems = array_merge(...$repeatedItems);

                    foreach ($fetchItems_ as $row) :
                        $colors = $conn->prepare("SELECT * FROM `product_colors` WHERE `product_id` = ? AND `color_id` = ?");
                        $colors->bindValue(1, $row['product_id']);
                        $colors->bindValue(2, $row['color_id']);
                        $colors->execute();
                        $colors_ = $colors->fetchAll();

                        $display_img = "admin_area/product_images/product/" .  $row['product_id'] . "/" . $colors_[0]["color_name"] . "/" . $colors_[0]["product_img1"];
                        $display_desc = $colors_[0]["product_desc"];
                        $display_url = $colors_[0]["product_url"];
                    ?>

                        <div class="tCol" cat-id="<?php echo  ($row['p_cat_id']);?>">
                            
                            <div class="card shadow-sm">
                            
                                <h6 class="card-title text-center mt-2"><?php echo $row['product_title'] ?></h6>
                                <div class="card-body d-flex justify-content-center">
                                    <img loading="lazy" src="<?= $display_img ?>" class="card-image" loding="lazy" />
                                </div>
                                <p class="mx-0 my-1 text-center px-2 custom-text"><?= $display_desc ?></p>
                                <span style="font-size:15px;" class="mx-0 my-1 text-center custom-text">&#8369; <?php echo $row['product_price'] ?></span>
                                <a href="viewProduct_customize_main.php?itemID=<?php echo $row['product_id'] ?>&slug=<?= $display_url ?>" style="background-color: black;" class="btn m-2 rounded-pill text-white product_link custom-text">View</a>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
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

<script>
    function applyFilter(selectedCategory) {
        var categories = document.querySelectorAll('.list-group-item');

        categories.forEach(function(category) {
            category.classList.remove('active');
        });

        if (selectedCategory === 'all') {
            categories.forEach(function(category) {
                if (category.textContent.trim() === 'All') {
                    category.classList.add('active');
                }
            });

            var items = document.querySelectorAll('.tCol');
            items.forEach(function(item) {
                item.style.display = 'block';
            });

            return;
        }

        categories.forEach(function(category) {
            if (category.getAttribute('onclick').includes(selectedCategory)) {
                category.classList.add('active');
            }
        });

        var items = document.querySelectorAll('.tCol');

        items.forEach(function(item) {
            var category = item.getAttribute('cat-id');

            if (selectedCategory === category) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }

</script>