<?php

// if (isset($_SESSION['id'])) {
//     echo ("<script>window.location.href = 'login.php';</script>");
//     exit();
// }
// CHECK IF USERID IS SET
require_once 'connection.php';
session_start();
// if (!isset($_SESSION['id_user'])) {
//     unset($_SESSION['id_user']);
//     unset($_SESSION['access']);
//     //var_dump($_SESSION['id']);
//     echo ("<script>localStorage.clear();window.location.href = 'index.php';</script>");
//     // var_dump($_SESSION['id']);
//     //    echo ("<script>localStorage.clear();window.location.href = 'login.php';</script>");
// }
if (isset($_SESSION['access'])) {
    $access = $_SESSION['access'];
} else {
    $access = 0;
}
// CHECK IF USERID EXIST IN DB
// $userid =  base64_decode($_SESSION['nbscisuserid']);
// $selPersonel = $conn->prepare('SELECT count(personelId) as cnt from tblpersonnel2 where personelId = ?');
// $selPersonel->execute([$userid]);
// $pdetails = $selPersonel->fetch();
// if ($pdetails['cnt'] == 0) {
// echo ("<script>localStorage.clear();window.location.href = './pages/login/login_main.php';</script>");
// }

//GET HERE THROUGH POST YOUR ITEM_ID
if (isset($_GET['itemID'])) :
    $slug = $_GET['itemID'];
    $slug_ = $_GET['slug'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id =? LIMIT 1");

    $stmt->execute([$slug]);
    $product_data = $stmt->fetch();
    if (!isset($product_data['product_id'])) :
        $slug = 'Product Not Found';
    endif;
else :
    $slug = 'Product Not Found';
endif;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <title><?php echo $slug_ ?></title>
</head>

<body>
    <div id="nav_content">

    </div>
    <?php if (isset($_GET['slug'])) : ?>

        <style>
            /* Add custom CSS to set the height and center the carousel images */
            #carouselId .carousel-item img {
                object-fit: contain;
                max-height: 400px;
                width: 100%;
                margin: 0 auto;
                /* To center the image horizontally */
            }
        </style>
        <?php if (isset($product_data['product_id'])) : ?>
            <div id="contents" style="margin-top: 100px" class="container">

                <div class="row">
                    <div class="card  col-sm-12 col-md-8 col-lg-8">

                        <div class="card-body">
                            <h5 class="card-title ">ITEM DETAILS #<?php echo $slug ?> </h5>
                            <p class="card-text  text-center title_item text-uppercase"><?php echo $product_data['product_title'] ?></p>

                            <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active" aria-current="true" aria-label="First slide"></li>
                                    <li data-bs-target="#carouselId" data-bs-slide-to="1" aria-label="Second slide"></li>
                                    <li data-bs-target="#carouselId" data-bs-slide-to="2" aria-label="Third slide"></li>
                                </ol>
                                <div class="carousel-inner" role="listbox">
                                    <div class="carousel-item active">
                                        <img src="admin_area/product_images/<?php echo $product_data['product_img1'] ?>" class="w-100 d-block" alt="First slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="admin_area/product_images/<?php echo $product_data['product_img2'] ?>" class="w-100 d-block" alt="Second slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="admin_area/product_images/<?php echo $product_data['product_img3'] ?>" class="w-100 d-block" alt="Third slide">
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                            <table>
                                <tbody>
                                    <tr>

                                        <td colspan="10">Price: </td>
                                        <td> <span style="font-size: 20px;font-weight:bold">&#8369; <?php echo $product_data['product_price'] ?></span> </td>
                                    </tr>
                                    <tr>

                                        <td colspan="10">Item Description: </td>
                                        <td>
                                            <p class="m-0"><?php echo $product_data['product_desc'] ?></p>
                                        </td>
                                    </tr>
                                </tbody>

                            </table>
                            <div class="row">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td> <button data-bs-toggle="modal" data-bs-target="#modalId" style="background-color: black;" class="btn form-control text-white"><i class="fa fa-cart-plus" aria-hidden="true"></i> Customize</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>



                    <div class="card shadow col-sm-12 col-md-4 col-lg-4 ">
                        <!-- <img style="align-self: center;" src="exampleImage.jpg" class="card-img-top card-image-viewing" alt="Card image"> -->
                        <div class="card-body">
                            <h5 class="card-title ">OTHER ITEMS</h5>
                            <hr>

                            <div id="other_item_view_display_list">

                            </div>


                        </div>
                    </div>

                    <!-- Modal Body -->
                    <!-- CUSTOMIZATION -->
                    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                    <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-fullscreen" role="document">
                            <div class="modal-content">
                                <div class="modal-header text-white" style="background-color: black;">
                                    <h5 class="modal-title" id="modalTitleId">CUSTOMIZE ITEM</h5>
                                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div id='body_con' class="modal-body">
                                    <!-- //CODE -->









                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button id="submit_images" type="button" style="background-color: black;" class="btn text-white"><i class="fa fa-cart-plus" aria-hidden="true"></i>Add To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>


            </div>
        <?php else : ?>
            <style>
                #prod_text {
                    margin-top: 200px;
                }

                #no_product {
                    justify-content: center;
                    text-align: center;
                    align-items: center;
                    height: 500px;
                }
            </style>
            <div id="no_product">
                <h1 id="prod_text" style="text-align: center; ">NO PRODUCT FOUND</h1>
            </div>
        <?php endif ?>
    <?php else : ?>
        <style>
            #prod_text {
                margin-top: 200px;
            }

            #no_product {
                justify-content: center;
                text-align: center;
                align-items: center;
                height: 500px;
            }
        </style>
        <div id="no_product">
            <h1 id="prod_text" style="text-align: center; ">NO PRODUCT FOUND</h1>
        </div>
    <?php endif ?>


    <!-- ------FOOTER------- -->
    <?php include 'footer_content/footer.php' ?>

    <!-- ------SCRIPTS---------- -->
    <script src="assets/js/jquery-3.6.3.js"></script>


    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/fabric.min.js"></script>
    <script src="assets/js/global_productview.js"></script>
    <script src="assets/js/logout.js"></script>
    <script src="assets/js/login_action.js"></script>
    <script src="assets/js/global_.js"></script>
    <script>
        $(document).ready(function() {
            fetchData(<?php echo $slug ?>)

            imageView('admin_area/product_images/<?php echo $product_data['product_img1'] ?>', 'admin_area/product_images/<?php echo $product_data['product_img2'] ?>', <?php echo   $slug  ?>)


        });

        function fetchData(itemID) {

            $.post("pages/home/components/product_view_items.php", {
                    itemID
                },
                function(data) {
                    $('#other_item_view_display_list').html(data)
                }

            );
        }

        function imageView(image1, image2, id) {
            $.post("image_view_for.php", {
                    image1,
                    image2,
                    id
                },
                function(data) {
                    $('#body_con').html(data)
                },

            );
        }
    </script>
</body>

</html>