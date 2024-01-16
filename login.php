<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['id_user'])) {

    echo "<script>window.location.href = 'index.php';</script>";
    exit();
}

?>

<div class="container ">


    <div class="row login_style ">
        <!-- <div class="col-sm-12 col-md-6 col-lg-6  ">
                <div class="design-inside ">
                    <div class="logo">
                        <img src="exampleImage.jpg" class="card-image">
                    </div>


                </div>

            </div> -->
        <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
            <div class="border design-inside bg-white  rounded-3">
                <div class="logo">
                    <img src="assets/images//Logo_mini.jpeg" alt="Logo">
                </div>
                <div class="justify-conten-center bg-success" id="alert-container"></div>


                <div class="mb-3">
                    <label for="username" class="form-label">Email</label>
                    <input placeholder="Enter Email" id="username_text" type="text" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input id="pass_text" placeholder="Enter Password" type="password" name="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <button onclick="loginAction()" id="loginbtnID" type="submit" style="background-color: black;" class="btn  text-white form-control"> LOGIN</button>
                </div>
                <!-- MODAL FOR REGISTRATION  CONTROLLER-->
                <p for="password" class="form-label">Not registered yet? <a data-bs-toggle="modal" data-bs-target="#modalId4" class="text-primary cursor-pointer">Register Here!</a></p>
                <div id="error-message" class="text-danger">
                </div>

            </div>

        </div>
    </div>
</div>

<!-- MODAL FOR REGISTRATION -->
<div class="modal fade" id="modalId4" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div style="background-color: black;" class="modal-header ">
                <h5 class="modal-title text-white" id="modalTitleId">REGISTER ACCOUNT</h5>
                <button type="button" class="btn-close text-white bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- <label for="">
                        <img src="exampleImage.jpg" class="card-image round">
                    </label>
                    <label>PROFILE PICTURE</label>
                    <input type="file" class="form-control" /> -->
                <label>NAME</label>
                <input id="name_text" class="form-control" type="text" placeholder="Enter your name here" />
                <label>Email</label>
                <input id="username1_text" class="form-control" type="email" placeholder="Enter your email here" />
                <label>Password</label>
                <input id="pass1_text" class="form-control" type="password" placeholder="Enter your password here" />
                <!-- <label>Re-Type Password</label>
                    <input class="form-control" type="password" placeholder="Enter your password here" /> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="loginbtnID1" onclick="toReg()" style="background-color: black;" type="button" class="btn text-white ">REGISTER</button>
            </div>
        </div>
    </div>
</div>

<script>
    function toReg() {
        btnDisable("#loginbtnID1", false);
        $.post(
            "./assets/register_acc.php", {
                customer_email: $("#username1_text").val(),
                customer_password: $("#pass1_text").val(),
                customer_name:$("#name_text").val()
            },
            function(data) {
                if (data === "success") {
                    alert("Account Created Successfully");
                    $("#modalId4").modal('hide');
                } else {
                    alert("Account is not created.");
                    btnDisable("#loginbtnID1", false);
                }
            }
        );
    }
  
</script>