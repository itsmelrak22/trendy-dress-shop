<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['id_user'])) {

    echo "<script>window.location.href = 'index.php';</script>";
    exit();
}

?>

<style>
    .row {
    height: 80vh; /* Adjust the height as needed */
}

.col-md-6 {
    width: 40%; /* Adjust the width as needed */
}

.form-control {
    width: 100%; /* Adjust the width of form controls */
}

</style>

<div class="container">
    <div class="row justify-content-center align-items-center" style="height:70vh;">
        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="border design-inside bg-white rounded-3">
                <div class="logo text-center">
                    <img loading="lazy" src="assets/images/Logo_mini.jpeg" alt="Logo">
                </div>
                <div class="justify-content-center bg-success" id="alert-container"></div>
                <div class="mb-3">
                    <label for="username" class="form-label">Email</label>
                    <input placeholder="Enter Email" id="username_text" type="text" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input id="pass_text" placeholder="Enter Password" type="password" name="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <button onclick="loginAction()" id="loginbtnID" type="submit" style="background-color: black;" class="btn text-white form-control"> LOGIN</button>
                </div>
                <p for="password" class="form-label text-center">Not registered yet? <a data-bs-toggle="modal" data-bs-target="#modalId4" class="text-primary cursor-pointer">Register Here!</a></p>
                <div id="error-message" class="text-danger"></div>
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
                <!-- <label for="customer_image">Profile Picture</label>
                <input id="customer_image" class="form-control" type="file" accept="image/*" /> -->
                <label for="name_text">NAME</label>
                <input id="name_text" class="form-control" type="text" placeholder="Enter your name here" />
                <input type="hidden" id="gender" name="gender"/>
                <label for="gender" >Gender</label>
                <div class="form-check" id="maleH">
                    <input class="form-check-input" onclick="test('male')" type="radio" name="gender" id="male" value="male">
                    <label class="form-check-label" for="male">
                        Male
                    </label>
                </div>
                <div class="form-check" >
                    <input class="form-check-input"  onclick="test('female')" type="radio" name="gender" id="female" value="female">
                    <label class="form-check-label" for="female">
                        Female
                    </label>
                </div>
                <label for="username1_text">Email</label>
                <input id="username1_text" class="form-control" type="email" placeholder="Enter your email here" />
                <label for="pass1_text">Password</label>
                <input id="pass1_text" class="form-control" type="password" placeholder="Enter your password here" />
                <label for="provinceDropdown">Province</label>
                <select id="provinceDropdown" class="form-control" onchange="populateCitiesMunicipalities(this.value)">
                    <option value="" selected disabled readonly>Select Province</option>
                </select>

                <label for="cityDropdown">City/Municipality</label>
                <select id="cityDropdown" class="form-control" onchange="populateBarangays(this.value)">
                    <option value="" selected disabled readonly>Select City/Municipality</option>
                </select>
                <label for="barangayDropdown">Barangay</label>
                <select id="barangayDropdown" class="form-control">
                    <option value="" selected disabled readonly>Select Barangay</option>
                </select>
                <label for="complete_add">Street Name/Barangay/Sbdv/Lot/Block/</label>
                <textarea id="complete_add" class="form-control" placeholder="Street Name/Brgy./Sbdv/Lot/Blk"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="registerBtn" onclick="registerAccount()" style="background-color: black;" type="button" class="btn text-white">REGISTER</button>
            </div>
        </div>
    </div>
</div>

<script>

function populateCitiesMunicipalities(provinceCode) {
        
        $.ajax({
            url: `https://psgc.gitlab.io/api/provinces/${provinceCode}/cities-municipalities.json`,
            type: 'GET',
            success: function(data) {
                
                var citiesMunicipalities = data;
                var cityDropdown = $('#cityDropdown');
                cityDropdown.empty(); // Clear existing options
                cityDropdown.append($('<option></option>').val('').text('Select City/Municipality')); // Add default option
                $.each(citiesMunicipalities, function(index, cityMunicipality) {
                    cityDropdown.append($('<option></option>').val(cityMunicipality.code).text(cityMunicipality.name));
                });


            },
            error: function(xhr, status, error) {
                console.error('Error fetching cities/municipalities: ' + error);
            }
        });
    }

    function populateBarangays(cityCode){
        $.ajax({
            url: `https://psgc.gitlab.io/api/cities-municipalities/${cityCode}/barangays.json`,
            type: 'GET',
            success: function(data) {
                var barangays = data;
                var barangayDropdown = $('#barangayDropdown');
                barangayDropdown.empty(); // Clear existing options
                barangayDropdown.append($('<option></option>').val('').text('Select Barangay')); // Add default option
                $.each(barangays, function(index, barangay) {
                    barangayDropdown.append($('<option></option>').val(barangay.code).text(barangay.name));
                });

            },
            error: function(xhr, status, error) {
                console.error('Error fetching cities/municipalities: ' + error);
            }
        });
    }
    $(document).ready(function() {
    // Fetch provinces and populate the province dropdown
    $.ajax({
        url: 'https://psgc.gitlab.io/api/provinces.json',
        type: 'GET',
        success: function(data) {
            var provinces = data;
            var provinceDropdown = $('#provinceDropdown');
            provinceDropdown.empty(); // Clear existing options
            provinceDropdown.append($('<option></option>').val('').text('Select Province')); // Add default option
            $.each(provinces, function(index, province) {
                provinceDropdown.append($('<option></option>').val(province.code).text(province.name));
            });
        },
        error: function(xhr, status, error) {
            console.error('Error fetching provinces: ' + error);
        }
    });
    // Function to fetch and populate cities/municipalities based on the selected province


    // Event listener for province dropdown change
    $('#provinceDropdown').change(function() {
        var selectedProvinceCode = $(this).val();
        if (selectedProvinceCode) {
            populateCitiesMunicipalities(selectedProvinceCode);
        } else {
            // Clear cities/municipalities dropdown if no province is selected
            $('#cityDropdown').empty();
        }
    });
});


    function test(val){
        $('#gender'). prop("value", val);
    }

    function registerAccount() {
    // Check if all required fields are filled out
    if ($("#name_text").val() === '' || $("#username1_text").val() === '' || $("#pass1_text").val() === '' || $("#complete_add").val() === '' || $("#provinceDropdown").val() === '' || $("#cityDropdown").val() === '' || $("#barangayDropdown").val() === '')   {
        alert('Please fill out all required fields.');
        return;
    }

    var formData = new FormData();
    formData.append('customer_name', $("#name_text").val());
    formData.append('customer_email', $("#username1_text").val());
    formData.append('customer_password', $("#pass1_text").val());
    formData.append('complete_address', $("#complete_add").val());
    formData.append('gender', $("#gender").val());
    formData.append('province', $("#provinceDropdown").val());
    formData.append('customer_city', $("#cityDropdown").val());
    formData.append('customer_barangay', $("#barangayDropdown").val());

    $.ajax({
        type: 'POST',
        url: './assets/register_acc.php',
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) {
            console.log(data, 'data');
            if (data.trim() === 'success') {
                alert('Account Created Successfully');
                $("#modalId4").modal('hide');
            } else {
                alert('Failed to create account. Please try again.');
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('AJAX Request Failed:', textStatus, errorThrown);
            alert('Failed to create account. Please try again.');
        }
    });
}



    // function registerAccount() {
    //     var formData = new FormData();
    //     formData.append('customer_name', $("#name_text").val());
    //     formData.append('customer_email', $("#username1_text").val());
    //     formData.append('customer_password', $("#pass1_text").val());
    //     formData.append('complete_address', $("#complete_add").val());
    //     formData.append('gender', $("#gender").val());
    //     formData.append('province', $("#provinceDropdown").val());
    //     formData.append('city', $("#cityDropdown").val());
    //     // formData.append('#provinceDropdown option:selected').text()
    //     // formData.append('#cityDropdown option:selected').text()
    //     // formData.append('customer_image', $("#customer_image")[0].files[0]);

    //     $.ajax({
    //         type: 'POST',
    //         url: './assets/register_acc.php',
    //         data: formData,
    //         contentType: false,
    //         processData: false,
    //         success: function(data) {
    //             console.log(data, 'data');

    //             if (data == 'success') {
    //                 alert('Account is not created');
    //             } else {
                    
    //                 alert('Account Created Successfully');
    //                 $("#modalId4").modal('hide');
    //             }
    //         },
    //         error: function(jqXHR, textStatus, errorThrown) {
    //             console.error('AJAX Request Failed:', textStatus, errorThrown);
    //             alert('Failed to create account. Please try again.');
    //         }
    //     });
    // }


</script>