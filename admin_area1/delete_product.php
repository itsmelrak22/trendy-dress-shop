<?php



if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}

else {

?>

<?php

if(isset($_GET['delete_product'])){

    $delete_id = $_GET['delete_product'];

    // $delete_pro1 = "
    //     UPDATE cart SET `product_id` = 0 WHERE `product_id` = $delete_id;
    // ";
    // $run_delete1 = mysqli_query($con,$delete_pro1);

    $delete_pro2 = "
        DELETE FROM products WHERE `product_id` = $delete_id;
    ";

    $run_delete = mysqli_query($con,$delete_pro2);

if($run_delete){

    echo "<script>alert('One Product Has been deleted')</script>";

    echo "<script>window.open('index.php?view_products','_self')</script>";

}else{
    echo "<script>alert('Something Went wrong')</script>";

}

}

?>

<?php } ?>