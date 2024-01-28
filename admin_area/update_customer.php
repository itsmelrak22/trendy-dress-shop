<?php

    if(isset($_POST['update_customer'])) {
        $customer_id = $_POST['customer_id'];

        $update_query = "UPDATE customers SET 
                        customer_name = '$customer_name', 
                        customer_email = '$customer_email', 
                        customer_image = '$customer_image', 
                        customer_country = '$customer_country', 
                        customer_city = '$customer_city', 
                        customer_contact = '$customer_contact' 
                        WHERE customer_id = $customer_id";

        $update_result = mysqli_query($con, $update_query);

        if($update_result) {
            // Redirect to a page indicating successful update
            header("Location: index.php?customer_updated=1");
            exit();
        } else {
            // Handle error
            echo "Error updating customer: " . mysqli_error($con);
        }
    }
?>
