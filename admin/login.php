<?php

    session_start();
    include("includes/db.php");

?>

<!DOCTYPE HTML>
<html>

    <head>
        <title>Admin Login</title>
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="bootstrap/css/login.css">
    </head>

    <body>

        <div class="container"><!-- container Starts -->
            <form class="form-login" action="" method="post"><!-- form-login Starts -->
                <h2 class="form-login-heading">Admin Login</h2>
                <input type="text" class="form-control mb-3" name="admin_email" placeholder="Email Address" required>
                <input type="password" class="form-control mb-3" name="admin_pass" placeholder="Password" required>
                <div class="text-center">
                    <button class="btn btn-lg btn-primary btn-block" type="submit" name="admin_login">Log in</button>
                </div>
            </form><!-- form-login Ends -->
        </div><!-- container Ends -->
    </body>
</html>

<?php

    if(isset($_POST['admin_login'])){

        $admin_email = mysqli_real_escape_string($con,$_POST['admin_email']);
        $admin_pass = mysqli_real_escape_string($con,$_POST['admin_pass']);

        $get_admin = "select * from admins where admin_email='$admin_email' AND admin_pass='$admin_pass'";
        $run_admin = mysqli_query($con,$get_admin);
        $count = mysqli_num_rows($run_admin);

        if($count==1){

            $_SESSION['admin_email']=$admin_email;
            echo "<script>alert('You are Logged in into admin panel')</script>";
            echo "<script>window.open('index.php?dashboard','_self')</script>";

        }
        else {
            echo "<script>alert('Email or Password is Wrong')</script>";
        }

    }

?>
