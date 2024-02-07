<?php
if(!isset($_SESSION['admin_email'])){
    echo "<script>window.open('login.php','_self')</script>";
} else {
    if(isset($_GET['edit_customers'])){
        $customer_id = $_GET['edit_customers'];
        $get_customer = "SELECT * FROM customers WHERE customer_id='$customer_id'";
        $run_customer = mysqli_query($con, $get_customer);
        $row_customer = mysqli_fetch_array($run_customer);

        $c_name = $row_customer['customer_name'];
        $c_email = $row_customer['customer_email'];
        $c_image = $row_customer['customer_image'];
        $c_com_address = $row_customer['complete_address'];
        $c_province = $row_customer['province'];
        $c_city = $row_customer['customer_city'];
        $c_contact = $row_customer['customer_contact'];
    }
?>
<div class="row"><!-- 1 row Starts -->
    <div class="col-lg-12"><!-- col-lg-12 Starts -->
        <ol class="breadcrumb"><!-- breadcrumb Starts -->
            <li>
                <i class="fa fa-dashboard"></i> Dashboard / Edit Customer
            </li>
        </ol><!-- breadcrumb Ends -->
    </div><!-- col-lg-12 Ends -->
</div><!-- 1 row Ends -->

<div class="row"><!-- 2 row Starts -->
    <div class="col-lg-12"><!-- col-lg-12 Starts -->
        <div class="panel panel-default"><!-- panel panel-default Starts -->
            <div class="panel-heading" ><!-- panel-heading Starts -->
                <h3 class="panel-title" ><!-- panel-title Starts -->
                    <i class="fa fa-money fa-fw" ></i> Edit Customer
                </h3><!-- panel-title Ends -->
            </div><!-- panel-heading Ends -->
            <div class="panel-body" ><!-- panel-body Starts -->
                <form class="form-horizontal" action="" method="post" enctype="multipart/form-data" ><!-- form-horizontal Starts -->
                    <div class="form-group" ><!-- form-group Starts -->
                        <label class="col-md-3 control-label" >Customer Name</label>
                        <div class="col-md-6" >
                            <input type="text" name="c_name" class="form-control" value="<?php echo $c_name; ?>" required>
                        </div>
                    </div><!-- form-group Ends -->
                    <div class="form-group" ><!-- form-group Starts -->
                        <label class="col-md-3 control-label" >Customer Email</label>
                        <div class="col-md-6" >
                            <input type="email" name="c_email" class="form-control" value="<?php echo $c_email; ?>" required>
                        </div>
                    </div><!-- form-group Ends -->

                    <!-- <div class="form-group" >
                        <label class="col-md-3 control-label" >Customer Image</label>
                        <div class="col-md-6" >
                            <input type="file" name="c_image" onchange="previewImage(event);">
                            <img loading="lazy" id="imagePreview" src="../updateUploads/<?php //echo $c_image; ?>" width="60" height="60">
                        </div>
                    </div> -->
                    
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label">Customer Province</label>
                        <div class="col-md-6">
                            <select name="c_province" id="province_dropdown" class="form-control"  required>
                                <option value="" selected disabled readonly>Select Province</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Customer City</label>
                        <div class="col-md-6">
                            <select name="c_city" id="city_dropdown" class="form-control" required>
                                <option value="" selected disabled readonly>Select City</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Customer Barangay</label>
                        <div class="col-md-6">
                            <select name="c_barangay" id="barangay_dropdown" class="form-control" required>
                                <option value="" selected disabled readonly>Select Barangay</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" ><!-- form-group Starts -->
                        <label class="col-md-3 control-label" >Sudivision / House Number</label>
                        <div class="col-md-6" >
                            <textarea  name="c_com_address" class="form-control" cols="30" rows="10" required><?php echo $c_com_address; ?></textarea>
                        </div>
                    </div><!-- form-group Ends -->
                    <div class="form-group" ><!-- form-group Starts -->
                        <label class="col-md-3 control-label" >Customer Contact</label>
                        <div class="col-md-6" >
                            <input type="text" name="c_contact" class="form-control" value="<?php echo $c_contact; ?>" required>
                        </div>
                    </div><!-- form-group Ends -->
                    <div class="form-group" ><!-- form-group Starts -->
                        <label class="col-md-3 control-label" ></label>
                        <div class="col-md-6" >
                            <input type="submit" name="update_customer" value="Update Customer" class="btn btn-primary form-control">
                        </div>
                    </div><!-- form-group Ends -->
                </form><!-- form-horizontal Ends -->
            </div><!-- panel-body Ends -->
        </div><!-- panel panel-default Ends -->
    </div><!-- col-lg-12 Ends -->
</div><!-- 2 row Ends -->
<?php
    if(isset($_POST['update_customer'])){
        $c_name = $_POST['c_name'];
        $c_email = $_POST['c_email'];
        $c_com_address = $_POST['c_com_address'];
        $c_province_code = $_POST['c_province']; // Get the selected province code
        $c_city_municipality_code = $_POST['c_city']; // Get the selected city/municipality code
        $c_contact = $_POST['c_contact'];
        $c_barangay = $_POST['c_barangay'];

        // Handle file upload
        if($_FILES['c_image']['name'] != "") {
            $c_image = $_FILES['c_image']['name'];
            $c_image_tmp = $_FILES['c_image']['tmp_name'];
            move_uploaded_file($c_image_tmp,"../updateUploads/$c_image");
        } else {
            $c_image = $c_image; // Retain existing image path if no new image is uploaded
        }

        $update_customer = "UPDATE customers SET customer_name='$c_name', customer_email='$c_email', complete_address='$c_com_address', province='$c_province_code', customer_city='$c_city_municipality_code', customer_barangay='$c_barangay', customer_contact='$c_contact', customer_image='$c_image' WHERE customer_id='$customer_id'";
        $run_update = mysqli_query($con, $update_customer);

        if($run_update){
            echo "<script>alert('Customer details updated successfully!')</script>";
            echo "<script>window.open('index.php?view_customers','_self')</script>";
        }
    }
}
?>

<script>
    <?php $jsonArray = json_encode($row_customer); ?>;
    var userDetails = <?php echo $jsonArray; ?>;
    console.log('userDetails', userDetails)

    // Function to fetch province data and populate the province dropdown
    function populateProvinceDropdown() {
        var xhr = new XMLHttpRequest();
        var url = 'https://psgc.gitlab.io/api/provinces.json';

        xhr.open('GET', url, true);

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var provinces = JSON.parse(xhr.responseText);
                var provinceDropdown = document.getElementById('province_dropdown');

                provinces.forEach(function(province) {
                    var option = document.createElement('option');
                    option.value = province.code;
                    option.text = province.name;
                    provinceDropdown.appendChild(option);
                });

                if( typeof userDetails.province != 'undefined' && userDetails.province ){
                    provinceDropdown.value = userDetails.province
                    populateCityDropdown(userDetails.province);
                }
            }
        };

        xhr.send();
    }

    // Function to fetch city data and populate the city dropdown based on the selected province
    function populateCityDropdown(provinceCode) {
        var xhr = new XMLHttpRequest();
        var url = 'https://psgc.gitlab.io/api/provinces/' + provinceCode + '/cities-municipalities.json';

        xhr.open('GET', url, true);

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var cities = JSON.parse(xhr.responseText);
                var cityDropdown = document.getElementById('city_dropdown');

                // Clear existing options
                cityDropdown.innerHTML = '';

                cities.forEach(function(city) {
                    var option = document.createElement('option');
                    option.value = city.code;
                    option.text = city.name;
                    cityDropdown.appendChild(option);
                });

                if( typeof userDetails.customer_city != 'undefined' && userDetails.customer_city ){
                    cityDropdown.value = userDetails.customer_city
                    populateBarangayDropdown(userDetails.customer_city)
                }
            }
        };

        xhr.send();
    }

    function populateBarangayDropdown(cityCode) {
        var xhr = new XMLHttpRequest();
        var url = `https://psgc.gitlab.io/api/cities-municipalities/${cityCode}/barangays.json`;

        xhr.open('GET', url, true);

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var barangays = JSON.parse(xhr.responseText);
                var barangayDropDownd = document.getElementById('barangay_dropdown');

                // Clear existing options
                barangayDropDownd.innerHTML = '';

                barangays.forEach(function(city) {
                    var option = document.createElement('option');
                    option.value = city.code;
                    option.text = city.name;
                    barangayDropDownd.appendChild(option);
                });

                if( typeof userDetails.customer_barangay != 'undefined' && userDetails.customer_barangay ){
                    var cityDropdown = document.getElementById('city_dropdown');

                    console.log("cityDropdown.value", cityDropdown.value)
                    if(cityDropdown.value){
                        barangayDropDownd.value = userDetails.customer_barangay
                    }else{
                        barangayDropDownd.value = null
                    }
                }
            }
        };

        xhr.send();
    }


    // Populate province dropdown when the page is loaded
    document.addEventListener('DOMContentLoaded', function() {
        populateProvinceDropdown();
    });

    // Populate city dropdown when the selected province changes
    document.getElementById('province_dropdown').addEventListener('change', function() {
        var selectedProvince = this.value;
        populateCityDropdown(selectedProvince);
        var selectedCity = document.getElementById("city_dropdown")
        selectedCity.value = null
        var selectedBarangay = document.getElementById("barangay_dropdown")
        selectedBarangay.value = null
    });
    document.getElementById('city_dropdown').addEventListener('change', function() {
        var selectedCity = this.value;
        populateBarangayDropdown(selectedCity);
        var selectedBarangay = document.getElementById("barangay_dropdown")
        selectedBarangay.value = null
    });


</script>
