<?php

spl_autoload_register(function ($class) {
    include '../models/' . $class . '.php';
  });
  
  $customOrderRequest = new CustomProductRequest;
  $customOrderRequests = $customOrderRequest::getCustomRequests();

//   echo "<pre>";
//   echo print_r($customOrderRequests);
//   echo "</pre>";
  
  $qry = "
        ";


    if(!isset($_SESSION['admin_email'])){
        echo "<script>window.open('login.php','_self')</script>";
    }

else {

?>


    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> Dashboard / View Custom Orders
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                    <i class="fa fa-money fa-fw"> </i> View Custom Orders
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th> Name </th>
                                    <th> Email </th>
                                    <th> Submitted Image </th>
                                    <th> Status </th>
                                    <th> Actions </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($customOrderRequests as $key => $value) {
                                    $id = $value['id'];
                                    $customer_name = $value['customer_name'];
                                    $customer_email = $value['customer_email'];
                                    $generated_image = $value['generated_image'];
                                    $status = $value['status'];
                                    $imgLink = "./custom_request_images/$id/$generated_image";
                                    echo '
                                        <tr>
                                        <td> '.$customer_name.' </td>
                                        <td>'.$customer_email.' </td>
                                        <td> <img src="'.$generated_image.'" width="250" height="250"> </td>
                                        <td>'.$status.' </td>
                                        <td>
                                            <a href="index.php?edit_custom_order='.$id.'" >
                                                 View
                                            </a>
                                        </td>
                                        </tr>
                                    ';
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>




