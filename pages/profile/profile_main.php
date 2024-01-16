<?php
require_once '../../connection.php';
session_start();
$userID = $_SESSION['id_user'];

$userDetails = $conn->prepare('SELECT a.* from customers a where a.customer_id=?');
$userDetails->execute([$userID]);
$userDetails_ = $userDetails->fetch();


$user_order = $conn->prepare('SELECT a.* from pending_orders a where a.customer_id=?');
$user_order->execute([$userID]);
$user_order_ = $user_order->fetchall();

?>
<div style="margin-bottom: 200px;" class="container-sm container-md container-lg-fluid">
    <div class="container-fluid  my-1">
        <div class="card">

            <div class="card-body">
                <div class="d-flex justify-content-center">

                    <i class="fa fa-user bg-light" style="color:black;  padding:10px; border-radius: 760px;" aria-hidden="true"></i>


                    <h4 class="card-title m-2">HELLO!</h4>
                    <h4 class="card-title m-2 ">
                        <?php echo $userDetails_['customer_name'] ?>

                    </h4>
                    <!-- <button style="background-color: black;" onclick="to_EditProfile()" class="text-white  btn rounded-pill" type="button" data-bs-toggle="modal" data-bs-target="#modalId3">
                        <i class="fa fa-edit" aria-hidden="true"></i>
                        Edit</button> -->
                </div>

            </div>
        </div>
        <div class="row my-2">
            <div class="col-sm-12 col-md-6 col-lg-5">
                <div class="card">
                    <div style="background-color: black;" class="card-head">
                        <h5 class="text-center text-white"> Checked Out Invoices </h5>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Invoice Created</th>
                                    <th>Invoice No.</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($user_order_ as $row) : ?>
                                    <tr>
                                        <td><?php echo $row['dateTimeAdded'] ?></td>
                                        <td><?php echo $row['invoice_no'] ?></td>
                                        <td><?php echo strtoupper($row['order_status']) ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-7">
        <!-- <div class="card">
                    <div class="card-head primary_bg">
                        <h5 class="text-center text-white"> PAST ATTENDED AUCTIONS </h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex">

                            <table class="table ">

                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-sm-12 col-md-12 col-lg-6">
                                                    <img src="exampleImage.jpg" class="card-image">
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-6">
                                                    <div class="row">
                                                        <div class="col-sm-12 col-md-12 col-lg-4">
                                                            <p class="mx-0">Item Name:</p>
                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-8">
                                                            <p class="mx-0 text-center">Example name</p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12 col-md-12 col-lg-4">
                                                            <p class="mx-0">Winner:</p>
                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-8">
                                                            <p class="mx-0 text-center">Example name</p>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12 col-md-12 col-lg-4">
                                                            <p class="mx-0">End Date:</p>
                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-8">
                                                            <p class="mx-0 text-center">Example Date</p>
                                                        </div>

                                                    </div>
                                                </div>

                                        </td>
                                    </tr>


                                </tbody>
                            </table>

                        </div>

                    </div>
                </div> -->
    </div>
</div>
</div>
</div>


<!-- Modal Body -->
<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
<div class="modal fade" id="modalId3" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div style="background-color: black;" class="modal-header ">
                <h5 class="modal-title text-white" id="modalTitleId">EDIT PROFILE</h5>
                <button type="button" class="btn-close text-white bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label for="">
                    <img src="exampleImage.jpg" class="card-image round">
                </label>
                <label>PROFILE PICTURE</label>
                <input type="file" class="form-control" />
                <label>NAME</label>
                <input class="form-control" type="text" placeholder="Enter your name here" />
                <label>Email</label>
                <input class="form-control" type="email" placeholder="Enter your email here" />
                <label>Password</label>
                <input class="form-control" type="password" placeholder="Enter your password here" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button style="background-color: black;" type="button" class="btn text-white ">Save</button>
            </div>
        </div>
    </div>
</div>


<!-- Optional: Place to the bottom of scripts -->
<script>
    const myModal = new bootstrap.Modal(document.getElementById('modalId'), options)
</script>
<script>

</script>