<?php
require_once '../../connection.php';
session_start();
$name = "";
$getUserDetails_ = array();
if (isset($getUserDetails_['account_status'])) {
    $account_status = $getUserDetails_['account_status'];
    $userID = $_SESSION['id_user'];
    $getUserDetails = $conn->prepare('SELECT a.*  from users_db a where a.id=?;');
    $getUserDetails->execute([$userID]);
    $getUserDetails_ = $getUserDetails->fetch();
    if (isset($getUserDetails_['lastname'])) {
        $name = $getUserDetails_['lastname'] . ', ' . $getUserDetails_['firstname'];
    } else {
        $name = "No User";
    }
} else {
    $account_status = 0;
}
?>
<div class="container">
    <!-- <h1>WELCOME! <span class="primary_text"><b><?php echo $name ?></b></span></h1> -->
    <?php if ($account_status == 0) : ?>
        <div class="d-flex">
            <!-- <h4 class="mx-2">UNVERIFIED</h4>
            <p class="m-0">Not yet verified? </p> -->
            <!-- //NEW ADDED MODAL FOR VERIFICATION controler -->
            <!-- <button type="button" class="btn text-white primary_bg  m-2 btn-sm rounded-pill" data-bs-toggle="modal" data-bs-target="#modalId">
                Verify Now
            </button> -->
        </div>
    <?php endif ?>
    <!-- id="items_diplay_0" -->
    <div id="banner_diplay_1">      
        <!-- CONTENTS HERE -->
    </div>
    <div id="items_diplay_0">
        <!-- CONTENTS HERE -->
    </div>



</div>

<!-- //NEW ADDED MODAL FOR VERIFICATION -->
<div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg modal-static" role="document">
        <div class="modal-content">
            <div class="modal-header primary_bg">
                <h5 class="modal-title text-white" id="modalTitleId">ACCOUNT VERIFICATION</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-center"> <b>ENTER TWO GOVERNMENT-ISSUED IDENTIFICATION (ID)</b> </p>
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <p>
                            List of Accepted ID:
                        <ul>
                            <li>ID TYPE 1</li>
                            <li>ID TYPE 2</li>
                            <li>ID TYPE 3</li>
                        </ul>
                        </p>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <label> Front (Government ID #1)</label>
                        <input type="file" class="form-control" />
                        <label> Back (Government ID #1)</label>
                        <input type="file" class="form-control" />
                        <label>Name</label>
                        <input type="text" placeholder="Enter Name" class="form-control" />
                    </div>
                </div>
                <p class="text-center"> <b>SECONDARY IDENTIFICATION CARD</b> </p>
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <p>
                            List of Accepted ID:
                        <ul>
                            <li>ID TYPE 1</li>
                            <li>ID TYPE 2</li>
                            <li>ID TYPE 3</li>
                        </ul>
                        </p>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <label> Front (Government ID #2)</label>
                        <input type="file" class="form-control" />
                        <label> Back (Government ID #2)</label>
                        <input type="file" class="form-control" />
                        <label>Name</label>
                        <input type="text" placeholder="Enter Name" class="form-control" />
                    </div>
                </div>
                <label>ENTER OTP CODE </label>
                <input type="text" placeholder="Enter XXXXX" class="form-control" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn primary_bg text-white">Save</button>
            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function() {

        fetchData()
        fetchBanner()
    });

    function fetchData() {

        $.post("pages/home/components/fetchItems.php", {},
            function(data) {
                $('#items_diplay_0').html(data)
            }

        );
    }

    function fetchBanner() {

        $.post("pages/home/components/fetchbanner.php", {},
            function(data) {
                $('#banner_diplay_1').html(data)
            }

        );
    }

   
</script>