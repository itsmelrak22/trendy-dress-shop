<?php
require_once '../../connection.php';
session_start();
$userID = $_SESSION['id_user'];

$userDetails = $conn->prepare('SELECT a.* from customers a where a.customer_id=?');
$userDetails->execute([$userID]);
$userDetails_ = $userDetails->fetch();

$user_order = $conn->prepare('SELECT 
                                    A.*, 
                                    B.Total_p_price,
                                    B.size,
                                    B.mop,
                                    B.qty,
                                    C.product_title,
                                    C.product_price
                                FROM pending_orders A 
                                LEFT JOIN cart B
                                ON A.cartItems = B.p_id
                                INNER JOIN products C
                                ON B.product_id = C.product_id
                                WHERE A.customer_id = ?
                                ');
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
                    <button id="editButton" style="background-color: black;" class="text-white btn rounded-pill" type="button" data-bs-toggle="modal" data-bs-target="#modalId3">
                        <i class="fa fa-edit" aria-hidden="true"></i>
                        Update Information
                    </button>
                </div>

            </div>
        </div>
        <div class="row my-2">
            <div class="col-sm-12 col-md-12 col-lg-12">
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
                                    <th>Product</th>
                                    <th>Size</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Mode Of Payment</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($user_order_ as $row) : ?>
                                    <tr>
                                        <td><?php echo $row['dateTimeAdded'] ?></td>
                                        <td><?php echo $row['invoice_no'] ?></td>
                                        <td><?php echo $row['product_title'] ?></td>
                                        <td><?php echo $row['size'] ?></td>
                                        <td><?php echo $row['product_price'] ?></td>
                                        <td><?php echo $row['qty'] ?></td>
                                        <td><?php echo $row['Total_p_price'] ?></td>
                                        <td><?php echo strtoupper($row['order_status']) ?></td>
                                        <td><?php echo $row['mop'] == 1 ? "Online Payment" : "COD" ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<!-- Modal Body -->
<div class="modal fade" id="modalId3" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">UPDATE PROFILE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editProfileForm" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="text-center mb-2">
                        <?php if(!empty($userDetails_['customer_image'])): ?>
                            <img loading="lazy" src="updateUploads/<?php echo $userDetails_['customer_image']; ?>" alt="Profile Picture" class="img-fluid" style="max-width: 100px;">
                        <?php endif; ?>
                    </div>
                    <label for="customer_image">PROFILE PICTURE</label>
                    <input id="customer_image" name="customer_image" type="file" class="form-control" />
                    <label for="name">NAME</label>
                    <input id="name" name="name" class="form-control" type="text" placeholder="Enter your name here" value="<?php echo $userDetails_['customer_name']; ?>" />
                    <label for="email">Email</label>
                    <input id="email" name="email" class="form-control" type="email" placeholder="Enter your email here" value="<?php echo $userDetails_['customer_email']; ?>" />
                    
                    <label for="provinceDropdown">Province</label>
                    <select id="provinceDropdown" name="provinceDropdown" class="form-control">
                        <option value="" disabled selected readonly>Select Province</option>
                    </select>

                    <label for="cityDropdown">City/Municipality</label>
                    <select id="cityDropdown" name="cityDropdown" class="form-control">
                        <option value="" disabled selected readonly>Select City/Municipality</option>
                    </select>

                    <label for="barangayDropdown">Barangay</label>
                    <select id="barangayDropdown" name="barangayDropdown" class="form-control">
                        <option value="" disabled selected readonly>Select Barangay</option>
                    </select>

                    <label for="complete_address"> Subdivision/ Street / Building Number / House Number </label>
                    <textarea id="complete_address" name="complete_address" class="form-control" placeholder="Subdivision/ Street / Building Number / House Number"><?php echo $userDetails_['complete_address']; ?></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button style="background-color: black;" name="submit" type="submit" class="btn text-white">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        <?php $jsonArray = json_encode($userDetails_); ?>;
        var userDetails = <?php echo $jsonArray; ?>;
        console.log('userDetails', userDetails)
    // Fetch provinces and populate the province dropdown
    $.ajax({
        url: 'https://psgc.gitlab.io/api/provinces.json',
        type: 'GET',
        success: function(data) {
            var provinces = data;
            var provinceDropdown = $('#provinceDropdown');
            // provinceDropdown.empty(); // Clear existing options
            // provinceDropdown.append($('<option></option>').val('').text('Select Province')); // Add default option
               
            $.each(provinces, function(index, province) {
                provinceDropdown.append($('<option></option>').val(province.code).text(province.name));
            });


            if( typeof userDetails.province != 'undefined' && userDetails.province ){
                $('#provinceDropdown').val(userDetails.province);
                populateCitiesMunicipalities(userDetails.province);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching provinces: ' + error);
        }
    });

    // Function to fetch and populate cities/municipalities based on the selected province
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

                if( typeof userDetails.customer_city != 'undefined' && userDetails.customer_city ){
                    $('#cityDropdown').val(userDetails.customer_city);
                    populateBarangays(userDetails.customer_city)
                    console.log($('#cityDropdown'))
                }

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

                if( typeof userDetails.customer_barangay != 'undefined' && userDetails.customer_barangay ){
                    $('#barangayDropdown').val(userDetails.customer_barangay);
                    console.log($('#barangayDropdown'))
                }

            },
            error: function(xhr, status, error) {
                console.error('Error fetching cities/municipalities: ' + error);
            }
        });
    }

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

document.getElementById('editProfileForm').addEventListener('submit', function(event) {
    event.preventDefault();
    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var complete_address = document.getElementById('complete_address').value;
    var province = document.getElementById('provinceDropdown').value;
    var city = document.getElementById('cityDropdown').value;
    var barangay = document.getElementById('barangayDropdown').value;

    var formData = new FormData(this);
    formData.append('province', province);
    formData.append('city', city);
    formData.append('barangay', barangay);

    fetch('pages/profile/update_profile_main.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (response.ok) {
            $('#modalId3').modal('hide');
        } else {
            // Handle error
            console.log('response', response)
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

//     document.getElementById('editProfileForm').addEventListener('submit', function(event) {
//     event.preventDefault();
//     var name = document.getElementById('name').value;
//     var email = document.getElementById('email').value;
//     var complete_address = document.getElementById('complete_address').value;

//     var formData = new FormData(this);

//     fetch('pages/profile/update_profile_main.php', {
//         method: 'POST',
//         body: formData
//     })
//     .then(response => {
//         if (response.ok) {
//             $('#modalId3').modal('hide');
//         } else {
//         }
//     })
//     .catch(error => {
//         console.error('Error:', error);
//     });
// });

</script>