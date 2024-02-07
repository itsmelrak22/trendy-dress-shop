<?php
require_once '../../connection.php';
session_start();
$name = null;
$getUserDetails_ = array();
$userID = $_SESSION['id_user'];
$getUserDetails = $conn->prepare('SELECT a.*  from customers a where a.customer_id=?;');
$getUserDetails->execute([$userID]);
$getUserDetails_ = $getUserDetails->fetch();
if (isset($getUserDetails_['lastname'])) {
    $name = $getUserDetails_['lastname'] . ', ' . $getUserDetails_['firstname'];
} 

// echo "<pre>" ;
// // echo print_r($_POST["customNote"]);
// echo print_r($getUserDetails_);
// echo "</pre>";
?>
<style>
    .custom-input {

        width: 350px;
    }

    .image-container {
        /* position: relative;
        display: inline-block; */
    }

    .magnifier1 {
        position: absolute;
        width: 250px;
        /* Adjust the width as needed */
        height: 250px;
        /* Adjust the height as needed */
        border: 2px solid #ccc;
        background: rgba(255, 255, 255, 0.5);
        display: none;
        pointer-events: none;
        background-size: 400% 400%;
        background-image: url("<?php echo $image1 ?>")
            /* Adjust the background size for zoom */
    }

    .magnifier2 {
        position: absolute;
        width: 250px;
        /* Adjust the width as needed */
        height: 250px;
        /* Adjust the height as needed */
        border: 2px solid #ccc;
        background: rgba(255, 255, 255, 0.5);
        display: none;
        pointer-events: none;
        background-size: 400% 400%;
        background-image: url("<?php echo $image2 ?>")
            /* Adjust the background size for zoom */
    }

</style>
<div class="container">
    <!-- <h1>WELCOME! <span class="primary_text"><b><?php echo $name ?></b></span></h1> -->
    <?php if (!$name) : ?>
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
        <?php if($getUserDetails_['customer_id']){

            echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#customizeItemModal">
                Customize your Item
                </button>';
        } ?>

        <!-- Modal -->
        <div class="modal fade" id="customizeItemModal" tabindex="-1" aria-labelledby="customizeItemModalLabel" aria-hidden="true">
            <form action="./pages/customize/saveData.php" method="post" id="saveData" enctype="multipart/form-data" >
                <div class="modal-dialog  modal-dialog-scrollable modal-dialog-centered modal-fullscreen" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="customizeItemModalLabel">Customize Your item</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Quantity</span>
                                            </div>
                                            <input value="1" type="number" placeholder="Enter quantity" id="customQty" class="form-control" type="number"  required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <!-- <div class="border">
                                        <div style="background-color: black">
                                            <p style="text-align: center;" class="text-white ">CUSTOMIZATION LIST</p>
                                        </div>
                                        <table>
                                            <thead></thead>
                                            <tbody>
                                                <tr>
                                                    <td> <label for="#customViewFrontView">FRONT VIEW</label></td>
                                                    <td> <input type="checkbox" name="" id="customViewFrontView" checked /></td>
                                                </tr>
                                                <tr>
                                                    <td> <label for="#customViewBackView">BACK VIEW</label></td>
                                                    <td> <input type="checkbox" name="" id="customViewBackView" checked /></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div> -->
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-9 col-md-12 mt-3">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item"  id="customFrontView">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#customFront"> Design</a>
                                        </li>
                                        <!-- <li class="nav-item"  id="customBackView">
                                            <a class="nav-link" data-bs-toggle="tab" href="#customBack">Back Design</a>
                                        </li> -->
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="customFront">
                                                <div class="row">
                                                    <div class=" col-md-6 image-container">
                                                        <label for=""><b>VIEW</b></label>
                                                        <canvas imgsrc="" class="custom-input" width="400" height="400" id="customFrontCanvas" style="border: 1px solid black !important;"></canvas>
                                                        <div class="magnifier1"></div>
                                                    </div>
                                                    <div class="col-md-6" id="Front">
                                                        <div class="m-2">
                                                            <div>
                                                                <label ><b>TEXT</b></label>
                                                            </div>
                                                            <div>
                                                                <div class="mb-3">
                                                                    <div class="input-group-prepend" style=" max-width: 300px; ">
                                                                        <span class="input-group-text">UPLOAD IMAGE OF YOUR ITEM: </span>
                                                                        <input accept="image/*" class="form-control" type="file" id="customFrontBackgroundImageInput" name="customFrontBackgroundImageInput"/>

                                                                    </div>
                                                                    <div class="input-group">
                                                                    </div>
                                                            
                                                                </div>
                                                            </div>
                                                            <div id="customizeColumns">
                                                                <div class="mb-3">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend" style=" width: 200px; ">
                                                                        <span class="input-group-text">SELECT COLOR: </span>
                                                                        </div>
                                                                        <input style="height: 36px;" type="color" id="customFrontColorPicker" name="customFrontColorPicker" value="#000000" class="form-control" onchange="updateCustomDisplayColorFront(this.value)">
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend" style=" width: 200px; ">
                                                                        <span class="input-group-text">SELECTED COLOR:</span>
                                                                        </div>
                                                                            <input type="text" class="form-control" readonly id="customFrontSelectedColor" name="customFrontSelectedColor"/>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend" style=" width: 200px; ">
                                                                        <span class="input-group-text">SELECT FONT: </span>
                                                                        </div>
                                                                        <select id="customFrontFontFamily" onchange="updateCustomDisplayFront(this.value)" class="form-control" name="customFrontFontFamily">
                                                                            <option selected disabled readonly></option>option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend" style=" width: 200px; ">
                                                                            <span class="input-group-text">TEXT SIZE (MAX 4X4): </span>
                                                                        </div>
                                                                        <input style="height: 36px;" type="number" id="customFrontTextLength" name="customFrontTextLength" class="form-control" min="1" max="4" oninput="validateCustomInput(this)" placeholder="Length">
                                                                        <input style="height: 36px;" type="number" id="customFrontTextWidth" name="customFrontTextWidth" class="form-control" min="1" max="4" oninput="validateCustomInput(this)" placeholder="Width">
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend" style=" width: 200px; ">
                                                                        <span class="input-group-text">CUSTOMIZE BY:  </span>
                                                                        </div>
                                                                        <select class="form-control" id="customFrontTextCustomizeBy" name="customFrontTextCustomizeBy">
                                                                            <option selected disabled readonly></option>
                                                                            <option value="print">PRINT</option>
                                                                            <option value="embroide">EMBROIDE</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <div class="input-group">
                                                                        <span class="input-group-text" style=" width: 200px; ">TEXT INPUT:</span>
                                                                        <textarea name="text_input" id="customFrontTextInput" cols="35" rows="4" name="customFrontTextInput"></textarea>
                                                                    </div>

                                                                    
                                                                    <button type="button" class="btn btn-primary btn-sm my-1" id="customFrontAddTextBtn" onclick="test()">Add Text</button>
                                                                    <button type="button" class="btn btn-danger btn-sm my-1" id="customFrontRemoveTextBtn">Remove Text</button>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <div class="input-group">
                                                                        <span class="input-group-text" style=" width: 200px; ">REMARKS/NOTE:</span>
                                                                        <textarea id="customNote" cols="35" rows="4" name="customNote"></textarea>
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend" style=" width: 200px; ">
                                                                            <span class="input-group-text">LOGO SIZE (MAX 4X4): </span>
                                                                        </div>
                                                                        <input style="height: 36px;" type="number" id="customFrontLogoLength" name="customFrontLogoLength" class="form-control" min="1" max="4" oninput="validateCustomInput(this)" placeholder="Length">
                                                                        <input style="height: 36px;" type="number" id="customFrontLogoWidth" name="customFrontLogoWidth" class="form-control" min="1" max="4" oninput="validateCustomInput(this)" placeholder="Width">
                                                                    </div>
                                                                </div>

                                                                <div>
                                                                    <label for="#customFrontImageInput"><b>LOGO</b></label>
                                                                </div>
                                                                <div>
                                                                    <input accept=".png" class=" form-control" type="file" id="customFrontImageInput" name="customFrontImageInput" />
                                                                    <img loading="lazy" class="m-1" id="customFrontPreviewImage" src="#" alt="Preview Image" style="display: none; width:200px">
                                                                    <input type="hidden" id="customized_image_price" value="300" >
                                                                    <button id="customFrontRemoveBtn" class="btn btn-danger form-control">REMOVE</button>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" name="submitCostumize" class="btn btn-primary" value="Save changes">
                        </div>
                    </div>
                </div>
            </form>
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
<!-- <script src="./assets/js/jquery-3.6.3.js"></script> -->
<script src="./assets/js/fabric.min.js"></script>
<script src="./assets/js/bootstrap.bundle.min.js"></script>
<script src="./assets/js/global_productview.js"></script>
<script src="./assets/js/logout.js"></script>
<script src="./assets/js/login_action.js"></script>
<script src="./assets/js/global_.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fontfaceobserver@2.1.0/fontfaceobserver.standalone.js"></script>

<script>
        var canvas = new fabric.Canvas('c');

        // Define an array with all fonts
        var fonts = ['Fonstars', 'Operation Napalm', 'Unitblock', 'OSerif', 'Public Pixel'];


        // Populate the fontFamily select
        var frontSelect = document.getElementById("customFrontFontFamily");
        fonts.forEach(function(font) {
            let option = document.createElement('option');
            option.value = font;
            option.text = font;
            option.style.fontFamily = font;
            frontSelect.add(option);
        });

</script>

<script>

    $(document).ready(function() {
        if( typeof customizeCurrentPage != 'undefined' ){
        customizeCurrentPage = 1;
            customizeTotalPages = $('#paginationData').data('total-pages');
        }else{
            var customizeCurrentPage = 1;
            var customizeTotalPages = $('#paginationData').data('total-pages');
        }
    

        fetchData(customizeCurrentPage)
        $('#customFrontRemoveBtn').hide()
        $('#customizeColumns').hide()

        var canvas1 = new fabric.Canvas('customFrontCanvas');
        var background = $('#customFrontCanvas').attr('imgsrc')


        $('#customFrontImageInput').change(function(e) {
            var file = e.target.files[0];
            var imageType = /^image\//;

            if (imageType.test(file.type)) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    $('#customFrontPreviewImage')
                        .attr('src', event.target.result)
                        .show();
                    addCustomlogo(canvas1, event.target.result, background, 'Front')
                };

                reader.readAsDataURL(file);
            }
        });

        $('#customFrontBackgroundImageInput').change(function(e) {

            if ($('#customFrontBackgroundImageInput').get(0).files.length === 0) {
                console.log("No files selected.");
                 $('#customizeColumns').hide()
                return
            }


            $('#customizeColumns').show()
            var file = e.target.files[0];
            var imageType = /^image\//;

            if (imageType.test(file.type)) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    setCustomBackground(canvas1, event.target.result)
                };

                reader.readAsDataURL(file);
            }
        });

        $('#customFrontRemoveBtn').on('click', function() {
            // removeSelected(canvas1)
            // // Hide the button after generating the view
            removeImageFromCanvas(canvas1);
            $('#customFrontPreviewImage').attr('src', '').css('display', 'none');
            $('#customFrontImageInput').val('');
            $('#customFrontRemoveBtn').hide()
        });

        $('#customFrontImageInput').change(function() {
            if ($(this).val()) {
                $('#customFrontRemoveBtn').show();
            } else {
                $('#customFrontRemoveBtn').hide();
            }
        });

        
        $('#customFrontImageInput').change(function() {
            if ($(this).val()) {
                $('#customFrontRemoveBtn').show();
            } else {
                $('#customFrontRemoveBtn').hide();
            }
        });

        $('#customFrontAddTextBtn').on('click', function() {
            let text = $('#customFrontTextInput')[0].value
            console.log(text)
            if(Boolean(text)){
                setText(canvas1, text)
            }else{
                alert("Insert Text")
            }
        });

        $('#customFrontRemoveTextBtn').on('click', function() {
            var activeObject = canvas1.getActiveObject();
            if (activeObject && activeObject.type === 'i-text') {
                canvas1.remove(activeObject);

                if (!checkCanvasForText(canvas1)) {
                    document.getElementById('customFrontAddTextBtn').disabled = false;
                }
            }
        });


        $('form').on('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting via the browser.
            var customCanvas = canvas1.toDataURL();

            var formData = new FormData(this); // Create a new FormData object and pass the form to it.
            formData.append('customCanvas', customCanvas)
            formData.append('customer_id', <?= $userID ?>);
            $.ajax({
                type: 'POST', // The HTTP method for the request.
                url: $(this).attr('action'), // The URL to send the data to.
                data: formData, // The data to send.
                processData: false, // Tell jQuery not to process the data.
                contentType: false, // Tell jQuery not to set contentType.
                success: function(response) {
                    // The function to execute upon a successful request.
                    console.log(response);
                    if(response == 'success'){
                        alert(" Successfully Submit a customize request, please wait for our email response. Thank you! ");
                        window.location.href=''

                    }

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // The function to execute upon an error.
                    console.log(textStatus, errorThrown);
                }
            });
        });


    })




</script>

<script>

function checkCanvasForText(canvas) {
            var objects = canvas.getObjects();
            for (var i = 0; i < objects.length; i++) {
                if (objects[i].type === 'i-text') {
                    return true;  // Return true as soon as a text object is found
                }
            }
            return false;  // Return false if no text object is found
        }

    function setText(canvas1, text) {
        let fontFamily = $('#customFrontFontFamily').val();
        let color = $('#customFrontSelectedColor').val();

        // If no font is selected, use a default one
        if (!fontFamily) {
            fontFamily = 'Arial';  // Replace 'Arial' with your default font
        }

        // If no color is selected, use black
        if (!color) {
            color = '#000000';  // Black color
        }

        
        let canvasTemp = canvas1
        var canvasText = new fabric.IText(text, {
            left: 10,  // position of text
            top: 10,
            fontFamily: fontFamily,
            fill: color,
            lineHeight: 1.1,
        });
        canvasText.bringToFront();
        canvasTemp.isDrawingMode = false
        canvasTemp.add(canvasText);
        canvasTemp.setActiveObject(canvasText);
        canvasTemp.renderAll();

        if (checkCanvasForText(canvas1)) {
            document.getElementById('customFrontAddTextBtn').disabled = true;
        }
    }


    function removeImageFromCanvas(canvas) {
            var objects = canvas.getObjects();
            for (var i = 0; i < objects.length; i++) {
                if (objects[i].type === 'image') {
                    canvas.remove(objects[i]);  // Remove the image object
                    break;  // Exit the loop as soon as an image is found and removed
                }
            }
            canvas.renderAll();  // Update the canvas
        }

    
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
    
    function updateCustomDisplayFront(font) {
        var display = document.getElementById('customFrontFontFamily');
        display.style.fontFamily = font;
    }
    
    function updateCustomDisplayColorFront(color) {
        var display = document.getElementById('customFrontSelectedColor');
        display.value = `${color}`;
        // display.style.fontFamily = color;
    }

    function validateCustomInput(input) {
        if(input){
            var value = input.value;
            if (value < 1 || value > 4) {
                alert("Please enter a value between 1 and 4.");
                input.value = "";
            }
        }
    }

    function addCustomlogo(canvas, img1, bg_image, position) {
        var canvasTemp = canvas
        let id = position == 'Front' ? 'front_subtotal_list' : 'back_subtotal_list';
        fabric.Image.fromURL(img1, function(img) {
            img.set({
                // You can adjust the properties of the background image here

                selectable: true, // Make it non-selectable
                evented: true, // Make it non-evented
            });

            img.scaleToWidth(100); // Adjust the size of the logo
            canvasTemp.add(img); // Add the logo to the canvas
        });

        // addListItem(`Customized Logo`, "300", id);
    }

    function setCustomBackground(canvas, img) {

        fabric.Image.fromURL(img, function(img) {
            img.set({
                // You can adjust the properties of the background image here
                height: img.height,
                scaleX: canvas.width / img.width,
                scaleY: canvas.height / img.height,
                selectable: true, // Make it non-selectable
                evented: false, // Make it non-evented
            });

            // Add the background image to the canvas at the bottom layer (z-index: -1)
            canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas), {
                // You can specify additional options here if needed
            });
        });
    }
</script>