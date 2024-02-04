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

    <div id="items_diplay_0">
        <!-- CONTENTS HERE -->
    </div>

    <!-- <div class="pagination">
        <button id="prevPage" onclick="changePage(-1)">Previous</button>
        <span id="customizeCurrentPage">1</span>
        <button id="nextPage" onclick="changePage(1)">Next</button>
    </div> -->


</div>

<script>
    let customizeCurrentPage = 1;
    let customizeTotalPages = $('#paginationData').data('total-pages');

    $(document).ready(function() {

        fetchData(customizeCurrentPage)
    });

    function fetchData(page) {
        $.post("pages/customize/components/fetchItems.php", { page: page },
            function(data) {
                $('#items_diplay_0').html(data);
                $('#customizeCurrentPage').text(page);
                // $('#prevPage').prop('disabled', page === 1);
                // $('#nextPage').prop('disabled', page === customizeTotalPages || customizeTotalPages === 0);
            }
        );
    }

    function changePage(delta) {
        customizeCurrentPage += delta;
        if (customizeCurrentPage < 1) {
            customizeCurrentPage = 1;
        }
        if (customizeCurrentPage > customizeTotalPages) {
            customizeCurrentPage = customizeTotalPages;
        }
        fetchData(customizeCurrentPage);
    }

</script>