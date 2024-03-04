<?php
    if(!isset($_SESSION['admin_email'])){
        echo "<script>window.open('index.php','_self')</script>";
    }
    else {
?>

<div class="row"><!-- 1 row Starts -->
    <div class="col-lg-12"><!-- col-lg-12 Starts -->
        <ol class="breadcrumb"><!-- breadcrumb Starts -->
            <!-- <li class="active">
                <i class="fa fa-dashboard"></i> Dashboard / View Customers
            </li> -->
        </ol><!-- breadcrumb Ends -->
    </div><!-- col-lg-12 Ends -->
</div><!-- 1 row Ends -->

<div class="row"><!-- 2 row Starts --> 
    <div class="col-lg-12"><!-- col-lg-12 Starts -->
        <div class="panel panel-default"><!-- panel panel-default Starts -->
            <div class="panel-heading"><!-- panel-heading Starts -->
                <h3 class="panel-title"><!-- panel-title Starts -->
                    <i class="fa fa-money fa-fw"></i> View Customers
                </h3><!-- panel-title Ends -->
            </div><!-- panel-heading Ends -->
            <div class="panel-body" ><!-- panel-body Starts -->
                <div class="table-responsive" ><!-- table-responsive Starts -->
                    <table class="table table-bordered table-hover table-striped" ><!-- table table-bordered table-hover table-striped Starts -->
                        <thead><!-- thead Starts -->
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Image</th>
                                <th>Address</th>
                                <th>Phone Number</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead><!-- thead Ends -->
                        <tbody><!-- tbody Starts -->
                            <?php
                                $i=0;
                                $get_c = "SELECT * FROM customers";
                                $run_c = mysqli_query($con,$get_c);
                                while($row_c=mysqli_fetch_array($run_c)){
                                    $c_id = $row_c['customer_id'];
                                    $c_name = $row_c['customer_name'];
                                    $c_email = $row_c['customer_email'];
                                    $c_image = $row_c['customer_image'];
                                    $c_complete_address = $row_c['complete_address'];
                                    $province_code = $row_c['province']; // Assuming this is the column in your database table for province code
                                    $city_code = $row_c['customer_city'];
                                    $barangay_code = $row_c['customer_barangay'];
                                    $c_contact = $row_c['customer_contact'];
                                    $i++;
                            ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $c_name; ?></td>
                                    <td><?php echo $c_email; ?></td>
                                    <td>
                                        <?php if(!empty($c_image)): ?>
                                            <img loading="lazy" src="../updateUploads/<?php echo $c_image; ?>" width="60" height="60" >
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span>
                                            <?php echo $c_complete_address; ?>
                                        </span>
                                        <?php
                                            // Check if city/municipality code is not null
                                            if (!is_null($barangay_code)) {
                                                echo ', <span id="barangay_' . $c_id . '"></span>';
                                            }

                                            // Check if city/municipality code is not null
                                            if (!is_null($city_code)) {
                                                echo ', <span id="city_' . $c_id . '"></span>';
                                            }

                                            // Check if province code is not null
                                            if (!is_null($province_code)) {
                                                echo ', <span id="province_' . $c_id . '"></span>';
                                            }

                                            
                                            
                                        ?>
                                        
                                    </td>
                                    <td><?php echo $c_contact; ?></td>
                                    <td>
                                        <a href="index.php?edit_customers=<?php echo $c_id; ?>">
                                            <i class="fa fa-pencil"></i> Edit
                                        </a>
                                    </td>
                                    <td>
                                        <a href="index.php?customer_delete=<?php echo $c_id; ?>" >
                                            <i class="fa fa-trash-o"></i> Delete
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody><!-- tbody Ends -->
                    </table><!-- table table-bordered table-hover table-striped Ends -->
                </div><!-- table-responsive Ends -->
            </div><!-- panel-body Ends -->
        </div><!-- panel panel-default Ends -->
    </div><!-- col-lg-12 Ends -->
</div><!-- 2 row Ends -->

<?php } ?>


<script>
    function fetchProvinceName(provinceCode, customerId) {
        console.log('provinceCode', provinceCode)
        var xhr = new XMLHttpRequest();
        var url = `https://psgc.gitlab.io/api/provinces/${provinceCode}.json`;

        xhr.open('GET', url, true);

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var provinceData = JSON.parse(xhr.responseText);
                document.getElementById(`province_${customerId}`).innerText = provinceData.name;
            }
        };

        xhr.send();
    }

    function fetchCityMunicipalityName(cityCode, customerId) {
        console.log('cityCode', cityCode)
        var xhr = new XMLHttpRequest();
        var url = `https://psgc.gitlab.io/api/cities-municipalities/${cityCode}.json`;

        xhr.open('GET', url, true);

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var cityData = JSON.parse(xhr.responseText);
                document.getElementById(`city_${customerId}`).innerText = cityData.name;
            }
        };

        xhr.send();
    }
    function fetchCityBarangayName(barangayCode, customerId) {
        console.log('barangayCode', barangayCode)
        var xhr = new XMLHttpRequest();
        var url = `https://psgc.gitlab.io/api/barangays/${barangayCode}.json`;

        xhr.open('GET', url, true);

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var barangayData = JSON.parse(xhr.responseText);
                console.log('barangayData', barangayData)
                document.getElementById(`barangay_${customerId}`).innerText = barangayData.name;
            }
        };

        xhr.send();
    }

    window.onload = function() {
    <?php
        $run_c = mysqli_query($con,$get_c);
        while($row_c=mysqli_fetch_array($run_c)){
            $province_code = $row_c['province'];
            $city_code = $row_c['customer_city'];
            $barangay_code = $row_c['customer_barangay'];
            $c_id = $row_c['customer_id'];

            // Check if province code is not null
            if (!is_null($province_code) && $province_code) {
    ?>
                fetchProvinceName('<?php echo $province_code; ?>', '<?php echo $c_id; ?>');
    <?php
            }
            
            // Check if city/municipality code is not null
            if (!is_null($city_code) && $city_code) {
    ?>
                fetchCityMunicipalityName('<?php echo $city_code; ?>', '<?php echo $c_id; ?>');
    <?php
            }

            if (!is_null($barangay_code ) && $barangay_code) {
            ?>
                fetchCityBarangayName('<?php echo $barangay_code; ?>', '<?php echo $c_id; ?>');
            <?php
            }
        }
    ?>


};

</script>
