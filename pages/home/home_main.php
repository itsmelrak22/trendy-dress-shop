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

    <!-- <div class="pagination">
        <button id="prevPage" onclick="changePage(-1)">Previous</button>
        <span id="currentPage">1</span>
        <button id="nextPage" onclick="changePage(1)">Next</button>
    </div> -->


</div>

<script>
    let currentPage = 1;
    let totalPages = $('#paginationData').data('total-pages');

    $(document).ready(function() {

        fetchData(currentPage)
        fetchBanner()
    });

    // function fetchData() {

    //     $.post("pages/home/components/fetchItems.php", {},
    //         function(data) {
    //             $('#items_diplay_0').html(data)
    //         }

    //     );
    // }

    function fetchBanner() {

        $.post("pages/home/components/fetchbanner.php", {},
            function(data) {
                $('#banner_diplay_1').html(data)
            }

        );
    }
    
    function fetchData(page) {
        $.post("pages/home/components/fetchItems.php", { page: page },
            function(data) {
                $('#items_diplay_0').html(data);
                $('#currentPage').text(page);
                // $('#prevPage').prop('disabled', page === 1);
                // $('#nextPage').prop('disabled', page === totalPages || totalPages === 0);
            }
        );
    }

    function changePage(delta) {
        currentPage += delta;
        if (currentPage < 1) {
            currentPage = 1;
        }
        if (currentPage > totalPages) {
            currentPage = totalPages;
        }
        fetchData(currentPage);
    }

</script>