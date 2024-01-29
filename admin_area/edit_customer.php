<?php

include("includes/db.php");

if(isset($_GET['customer_id'])){
    $customer_id = $_GET['customer_id'];

    $get_customer = "SELECT * FROM customers WHERE customer_id='$customer_id'";
    $run_customer = mysqli_query($con, $get_customer);
    $row_customer = mysqli_fetch_array($run_customer);

    $c_name = $row_customer['customer_name'];
    $c_email = $row_customer['customer_email'];
    $c_image = $row_customer['customer_image'];
    $c_country = $row_customer['customer_country'];
    $c_city = $row_customer['customer_city'];
    $c_contact = $row_customer['customer_contact'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Customer</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <table align="center" width="750">
            <tr>
                <td colspan="6" align="center"><h2>Edit Customer:</h2></td>
            </tr>
            <tr>
                <td align="right">Customer Name:</td>
                <td><input type="text" name="c_name" value="<?php echo $c_name; ?>" required/></td>
            </tr>
            <tr>
                <td align="right">Customer Email:</td>
                <td><input type="email" name="c_email" value="<?php echo $c_email; ?>" required/></td>
            </tr>
            <tr>
                <td align="right">Customer Image:</td>
                <td><input type="file" name="c_image" /><img src="../customer/customer_images/<?php echo $c_image; ?>" width="60" height="60"></td>
            </tr>
            <tr>
                <td align="right">Customer Country:</td>
                <td><input type="text" name="c_country" value="<?php echo $c_country; ?>" required/></td>
            </tr>
            <tr>
                <td align="right">Customer City:</td>
                <td><input type="text" name="c_city" value="<?php echo $c_city; ?>" required/></td>
            </tr>
            <tr>
                <td align="right">Customer Contact:</td>
                <td><input type="text" name="c_contact" value="<?php echo $c_contact; ?>" required/></td>
            </tr>
            <tr>
                <td colspan="6" align="center"><input type="submit" name="update_customer" value="Update Customer" /></td>
            </tr>
        </table>
    </form>
</body>
</html>

<?php

if(isset($_POST['update_customer'])){

    $c_name = $_POST['c_name'];
    $c_email = $_POST['c_email'];
    $c_country = $_POST['c_country'];
    $c_city = $_POST['c_city'];
    $c_contact = $_POST['c_contact'];

    $update_customer = "UPDATE customers SET customer_name='$c_name', customer_email='$c_email', customer_country='$c_country', customer_city='$c_city', customer_contact='$c_contact' WHERE customer_id='$customer_id'";
    $run_update = mysqli_query($con, $update_customer);


    if($run_update){
        echo "<script>alert('Customer details updated successfully!')</script>";
        echo "<script>window.open('index.php?view_customers','_self')</script>";
    }
}
?>
