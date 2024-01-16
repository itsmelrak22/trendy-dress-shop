<?php
session_start();

$loggedIN = false;
if (isset($_SESSION['id_user'])) {
    echo "HEREEEEEEEEEEEEEEEEE";
    $loggedIN = true;
}

?>
<style>
    /* Custom CSS to style the navbar */
    .navbar {
        position: fixed;
        top: 0;
        width: 100%;
        background-color: #f8f8f8;
        padding: 10px;
        z-index: 100;
        /* Adjust the z-index value as needed */
    }
</style>
<nav class="navbar navbar-expand-lg navbar-light " style="background-color:black">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><img class="rounded-pill" src="assets/images/Logo_mini.jpeg" style="width: 120px;" /></a>
        <button class="navbar-toggler" style="background-color:white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a onclick="to_dashboard()" style="cursor: pointer;" class="nav-link active text-white " aria-current="page">Products</a>
                </li>

                <!-- <li class="nav-item">
                        <a onclick="to_myauction()" style="cursor: pointer;" class="nav-link active " aria-current="page">My Auction</a>
                    </li>
                    <li class="nav-item">
                        <a onclick="to_mybids()" style="cursor: pointer;" class="nav-link active " aria-current="page">My Bids</a>
                    </li>
                    -->

            </ul>
            <ul class="navbar-nav justify-content-end ">

                <!-- <li class="nav-item">
                        <a onclick="to_aboutus()" style="cursor: pointer;" class="nav-link active text-white " aria-current="page">About Us</a>
                    </li> -->
                <li id='cart_nav' style="padding-top: 0px;" class="nav-item btn-group ">
                    <a style="cursor: pointer;" class="nav-link  text-white" aria-current="page"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i> Cart</a>
                </li>
                <?php if ($loggedIN) : ?>
                    <li style="padding-top: 0px;" class="nav-item btn-group">
                        <a id="triggerId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="cursor: pointer;" class="nav-link text-white">
                            <i class="fa fa-user" style="border-radius: 650px;" aria-hidden="true"></i> Account
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end " aria-labelledby="triggerId">
                            <li class="dropdown-item"><a onclick="to_portfolio()" type="button" class="dropdown-item">Profile</a></li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item"><a onclick="logout()" type="button" class="dropdown-item">Logout</a></li>
                        </ul>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a onclick="login_()" style="cursor: pointer;" class="nav-link active text-white " aria-current="page">Login</a>
                    </li>
                <?php endif ?>
                <li>
                    <form class="d-flex">

                        <input class="form-control me-2" type="search" placeholder="Search item here" aria-label="Search">
                        <button class="btn  btn-light" type="submit">Search</button>
                    </form>
                </li>

            </ul>
            <!-- 
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  
                    <li class="nav-item">
                        <a onclick="to_userVerification()" style="cursor: pointer;" class="nav-link active " aria-current="page">User Verification</a>
                    </li>
                    <li class="nav-item">
                        <a onclick="to_itemVerification()" style="cursor: pointer;" class="nav-link active " aria-current="page">Item Verification</a>
                    </li>
                    <li class="nav-item">
                        <a onclick="to_transactionHistory()" style="cursor: pointer;" class="nav-link active " aria-current="page">Transaction History</a>
                    </li>
                    <li class="nav-item">
                        <a onclick="to_reports()" style="cursor: pointer;" class="nav-link active " aria-current="page">Reports</a>
                    </li>
                    <li class="nav-item">
                        <a onclick="to_pending()" style="cursor: pointer;" class="nav-link active " aria-current="page">Pending</a>
                    </li>
                </ul>
                <ul class="navbar-nav justify-content-end ">
                    <li>
                        <form class="d-flex">
                            <button class="btn text-white primary_bg" type="submit">Search</button>
                            <input class="form-control me-2" type="search" placeholder="Search item here" aria-label="Search">

                        </form>
                    </li>

                    <li style="padding-top: 0px;" class=" btn-group ">
                        <a id=" triggerId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="cursor: pointer;" class="nav-link  "><i class="fa fa-user" style="color:black; background-color:grey; padding:10px; border-radius: 650px;" aria-hidden="true"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end " aria-labelledby="triggerId">
                            <li class="dropdown-item disabled">ADMIN</li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item"><a onclick="logout()" type="button" class="dropdown-item">Logout</a></li>

                        </ul>
                    </li>


                </ul>
        -->







        </div>
    </div>
</nav>




<div class="div_insert">
    <!-- Modal -->
    <div class="modal fade" id="modalId231321" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div style="background-color: black;" class="modal-header">
                    <h5 class="modal-title text-white" id="modalTitleId">Cart</h5>
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id='cart_body'>

                </div>

            </div>
        </div>
    </div>

</div>
<script>
    $('#cart_nav').click(function(e) {
        e.preventDefault();
        fetchCartDetails()

    });

    function fetchCartDetails() {
        $.post("pages/cart_details/cart_details.php", {

            },
            function(data) {
                if (data === 'No User') {
                    login_()

                } else {
                    $('#cart_body').html(data)
                    $('#modalId231321').modal('toggle')
                }

            }
        );
    }

    function fetchCartDetails_() {
        $.post("pages/cart_details/cart_details.php", {

            },
            function(data) {
                if (data === 'No User') {
                    login_()

                } else {
                    $('#cart_body').html(data)

                }

            }
        );
    }
</script>