<?php
require_once '../../connection.php';
session_start();
$name = "";
$getUserDetails_ = array();
if (isset($getUserDetails_['account_status'])) {
    $account_status = $getUserDetails_['account_status'];
    $userID = $_SESSION['id_user'];
    $getUserDetails = $conn->prepare('SELECT a.*  from users_db a where a.id=?;');
    $getUserDetails->execute([$userID]);
    $getUserDetails_ = $getUserDetails->fetch();
    if (isset($getUserDetails_['lastname'])) {
        $name = $getUserDetails_['lastname'] . ', ' . $getUserDetails_['firstname'];
    } else {
        $name = "No User";
    }
} else {
    $account_status = 0;
}
?>
<div class="container">
    <!-- <h1>WELCOME! <span class="primary_text"><b><?php echo $name ?></b></span></h1> -->
    <?php if ($account_status == 0) : ?>
        <div class="d-flex">
            <!-- <h4 class="mx-2">UNVERIFIED</h4>
            <p class="m-0">Not yet verified? </p> -->
            <!-- //NEW ADDED MODAL FOR VERIFICATION controler -->
            <!-- <button type="button" class="btn text-white primary_bg  m-2 btn-sm rounded-pill" data-bs-toggle="modal" data-bs-target="#modalId">
                Verify Now
            </button> -->
        </div>
    <?php endif ?>
    <!-- id="items_diplay_0" -->
    
    <div id="custom_item">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Customize your Item
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog  modal-dialog-scrollable modal-dialog-centered modal-fullscreen" role="document"">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Customize Your item</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                    <div class="col-lg-9 col-md-12 mt-3">
            <ul class="nav nav-tabs">
                <li class="nav-item"  id="frontView">
                    <a class="nav-link active" data-bs-toggle="tab" href="#front">Front Design</a>
                </li>
                <li class="nav-item"  id="backView">
                    <a class="nav-link" data-bs-toggle="tab" href="#back">Back Design</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="front">
                    <div class="row">
                        <div class=" col-md-6 image-container">
                            <label for=""><b>FRONT VIEW</b></label>
                            <canvas imgsrc="<?php echo $image1 ?>" class="custom-input" width="400" height="400" id="frontCanvas" style="border: 1px solid black !important;"></canvas>
                            <div class="magnifier1"></div>
                        </div>
                        <div class="col-md-6" id="Front"   >
                            <div class="m-2">
                                <div>
                                    <label for="#frontImageInput"><b>FRONT TEXT</b></label>
                                </div>
                                <div>
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend" style=" width: 200px; ">
                                            <span class="input-group-text">SELECT COLOR: </span>
                                            </div>
                                            <input style="height: 36px;" type="color" id="frontColorPicker" name="frontColorPicker" value="#000000" class="form-control" onchange="updateDisplayColorFront(this.value)">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend" style=" width: 200px; ">
                                            <span class="input-group-text">SELECTED COLOR:</span>
                                            </div>
                                                <input type="text" class="form-control" readonly id="frontSelectedColor"/>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend" style=" width: 200px; ">
                                            <span class="input-group-text">SELECT FONT: </span>
                                            </div>
                                            <select id="frontFontFamily" onchange="updateDisplayFront(this.value)" class="form-control">
                                                <option selected disabled readonly></option>option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend" style=" width: 200px; ">
                                                <span class="input-group-text">TEXT SIZE (MAX 4X4): </span>
                                            </div>
                                            <input style="height: 36px;" type="number" id="frontTextLength" name="frontTextLength" class="form-control" min="1" max="4" oninput="validateInput(this)" placeholder="Length">
                                            <input style="height: 36px;" type="number" id="frontTextWidth" name="frontTextWidth" class="form-control" min="1" max="4" oninput="validateInput(this)" placeholder="Width">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend" style=" width: 200px; ">
                                            <span class="input-group-text">CUSTOMIZE BY:  </span>
                                            </div>
                                            <select class="form-control" id="frontTextCustomizeBy">
                                                <option selected disabled readonly></option>
                                                <option value="print">PRINT</option>
                                                <option value="embroide">EMBROIDE</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <span class="input-group-text" style=" width: 200px; ">TEXT INPUT:</span>
                                            <textarea name="text_input" id="frontTextInput" cols="35" rows="4"></textarea>
                                        </div>

                                        
                                        <button class="btn btn-primary btn-sm my-1" id="frontAddTextBtn">Add Text</button>
                                        <button class="btn btn-danger btn-sm my-1" id="frontRemoveTextBtn">Remove Text</button>
                                    </div>
                                </div>
                                <div>
                                    <label for="#frontImageInput"><b>FRONT LOGO</b></label>
                                </div>
                                <div>
                                    <input accept=".png" class=" form-control" type="file" id="frontImageInput" />
                                    <img loading="lazy" class="m-1" id="frontPreviewImage" src="#" alt="Preview Image" style="display: none; width:200px">
                                    <input type="hidden" id="customized_image_price" value="300" >
                                    <button id="frontRemoveBtn" class="btn btn-danger form-control">Front REMOVE</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade show" id="back">
                    <div class="row">
                        <div class=" col-md-6 image-container" >
                            <label for=""><b>BACK VIEW</b></label>
                            <canvas imgsrc="<?php echo $image2 ?>" class="custom-input" width="400" height="400" id="backCanvas" style="border: 1px solid black !important;"></canvas>
                            <div class="magnifier1"></div>
                        </div>
                        <div class="col-md-6" id="Back"   >
                            <div class="m-2">
                                <div>
                                    <label for="#backImageInput"><b>BACK TEXT</b></label>
                                </div>
                                <div>
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend" style=" width: 200px; ">
                                            <span class="input-group-text">SELECT COLOR: </span>
                                            </div>
                                            <input style="height: 36px;" type="color" id="backColorPicker" name="backColorPicker" value="#000000" class="form-control" onchange="updateDisplayColorBack(this.value)">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend" style=" width: 200px; ">
                                            <span class="input-group-text">SELECTED COLOR:</span>
                                            </div>
                                                <input type="text" class="form-control" readonly id="backSelectedColor"/>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend" style=" width: 200px; ">
                                            <span class="input-group-text">SELECT FONT: </span>
                                            </div>
                                            <select id="backFontFamily" onchange="updateDisplayBack(this.value)" class="form-control">
                                                <option selected disabled readonly></option>option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend" style=" width: 200px; ">
                                                <span class="input-group-text">TEXT SIZE (MAX 4X4): </span>
                                            </div>
                                            <input style="height: 36px;" type="number" id="backTextLength" name="backTextLength" class="form-control" min="1" max="4" oninput="validateInput(this)" placeholder="Length">
                                            <input style="height: 36px;" type="number" id="backTextWidth" name="backTextWidth" class="form-control" min="1" max="4" oninput="validateInput(this)" placeholder="Width">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend" style=" width: 200px; ">
                                            <span class="input-group-text">CUSTOMIZE BY:  </span>
                                            </div>
                                            <select class="form-control" id="backTextCustomizeBy">
                                                <option selected disabled readonly></option>
                                                <option value="print">PRINT</option>
                                                <option value="embroide">EMBROIDE</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <span class="input-group-text" style=" width: 200px; ">TEXT INPUT:</span>
                                            <textarea name="text_input" id="backTextInput" cols="35" rows="4"></textarea>
                                        </div>

                                        
                                        <button class="btn btn-primary btn-sm my-1" id="backAddTextBtn">Add Text</button>
                                        <button class="btn btn-danger btn-sm my-1" id="backRemoveTextBtn">Remove Text</button>
                                    </div>
                                </div>
                                <div>
                                    <label for="#backImageInput"><b>BACK LOGO</b></label>
                                </div>
                                <div>
                                    <input accept=".png" class=" form-control" type="file" id="backImageInput" />
                                    <img loading="lazy" class="m-1" id="backPreviewImage" src="#" alt="Preview Image" style="display: none; width:200px">
                                    <input type="hidden" id="customized_back_image_price" value="300" >
                                    <button id="backRemoveBtn" class="btn btn-danger form-control">REMOVE</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

                <!-- <form action="" method="post">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" placeholder="name@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="customizeBy" class="form-label">Customize By:</label>
                        <input type="text" class="form-control" id="customizeBy" value="Embroide" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="customImage" class="form-label">Sample Output</label>
                        <input type="file" class="form-control" id="customImage" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="remarks" class="form-label"> Remarks </label>
                        <textarea class="form-control" id="remarks" rows="3"></textarea>
                    </div>
                </form> -->
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
        </div>


    </div>

    <div id="items_diplay_0">
        <!-- CONTENTS HERE -->
    </div>

    <!-- <div class="pagination">
        <button id="prevPage" onclick="changePage(-1)">Previous</button>
        <span id="customizeCurrentPage">1</span>
        <button id="nextPage" onclick="changePage(1)">Next</button>
    </div> -->


</div>

<script>

    if( typeof customizeCurrentPage != 'undefined' ){
        customizeCurrentPage = 1;
        customizeTotalPages = $('#paginationData').data('total-pages');
    }else{
        var customizeCurrentPage = 1;
        var customizeTotalPages = $('#paginationData').data('total-pages');
    }
    
    console.log('customizeCurrentPage', customizeCurrentPage)

    $(document).ready(function() {

        fetchData(customizeCurrentPage)
    });

    function fetchData(page) {
        $.post("pages/customize/components/fetchItems.php", { page: page },
            function(data) {
                $('#items_diplay_0').html(data);
                $('#customizeCurrentPage').text(page);
                // $('#prevPage').prop('disabled', page === 1);
                // $('#nextPage').prop('disabled', page === customizeTotalPages || customizeTotalPages === 0);
            }
        );
    }

    function changePage(delta) {
        customizeCurrentPage += delta;
        if (customizeCurrentPage < 1) {
            customizeCurrentPage = 1;
        }
        if (customizeCurrentPage > customizeTotalPages) {
            customizeCurrentPage = customizeTotalPages;
        }
        fetchData(customizeCurrentPage);
    }

</script>