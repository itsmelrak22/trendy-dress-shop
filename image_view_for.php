<?php
$image1 = $_POST['image1'];
$image2 = $_POST['image2'];
$id = $_POST['id'];

require_once 'connection.php';

$fetchDetails = $conn->prepare('SELECT a.* from products a where a.product_id=?');
$fetchDetails->execute([$id]);

$fetchDetails_ = $fetchDetails->fetch();
// admin_area/product_images/<?php echo $product_data['product_img1'] 
?>
<style>
    .custom-input {

        width: 350px;
    }

    .image-container {
        position: relative;
        display: inline-block;
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

    @font-face {
        font-family: 'Fonstars';
        src: url('./assets/fonts/fonstars/fonstars.otf') format('truetype');
    }

    @font-face {
        font-family: 'Operation Napalm';
        src: url('./assets/fonts/operation-napalm/operation-napalm.ttf') format('truetype');
    }

    @font-face {
        font-family: 'Unitblock';
        src: url('./assets/fonts/unitblock/unitblock.ttf') format('truetype');
    }

    @font-face {
        font-family: 'OSerif';
        src: url('./assets/fonts/oserif/oserif.ttf') format('truetype');
    }

    @font-face {
        font-family: 'Public Pixel';
        src: url('./assets/fonts/public-pixel/public-pixel.ttf') format('truetype');
    }


</style>


<div id="div_set" id_src="<?php echo $id ?>" style="margin-top:30px" class="d-flex">
    <div class="d-flex m-2">

        <div class="image-container m-4" id="frontView">
            <label for=""><b>FRONT VIEW</b></label>
            <canvas imgsrc="<?php echo $image1 ?>" class="custom-input" width="400" height="450" id="example1"></canvas>
            <div class="magnifier1"></div>
        </div>



        <div class="image-container m-4" id="backView">
            <label for=""><b>BACK VIEW</b></label>
            <canvas imgsrc="<?php echo $image2 ?>" class="custom-input" width="400" height="450" id="example2"></canvas>
            <div class="magnifier2"></div>
        </div>


    </div>
    <div class="col">
        <div class="p-1">
            <div class="m-1">
                <h4 id="price_id" price='<?php echo $fetchDetails_['product_price'] ?>' class="mb-0">&#8369; <span id="price_tag"> <?php echo $fetchDetails_['product_price'] ?></span></h4>
            </div>
            <label for="">Quantity</label>
            <input value="1" type="number" placeholder="Enter quantity" id="qty" class="form-control" type="text" />
        </div>
        <div class="p-1">
            <label for="">Size</label>
            <select class="form-control" name="" id="size_sel">
                <option value="sm" selected>Small (SM)</option>
                <option value="md">Medium (MD)</option>
                <option value="lg">Large (LG)</option>
                <option value="xl">Extra Large (XL)</option>
            </select>
        </div>

    </div>


    <div class="m-4">

        <div class="col-lg-12">


            <div class="tab">
                <button class="tablinks" id="front" onclick="openTab(event, 'Front')">Front</button>
                <button class="tablinks" id="back" onclick="openTab(event, 'Back')">Back</button>
            </div>

            <div id="Front" class="tabcontent" >
                <div class="m-2">
                    <div>
                        <label for="#fronImageInput"><b>FRONT TEXT</b></label>
                    </div>
                    <div>
                        <label for="frontColorPicker"><b>SELECT COLOR</b></label>
                        <input type="color" id="frontColorPicker" name="frontColorPicker" value="#ffffff">
                        <p id="frontColorDisplay">Selected Color: #ffffff</p>
                    </div>
                    <select id="frontFontFamily" onchange="updateDisplayFront(this.value)">
                        <option value="">Select a font</option>
                    </select>
                    <h6>Font Display:  <p id="frontFontDisplay" style="font-size: 20px;">Select a font</p> </h6>
                    <label for="#frontTextInput"><b>TEXT INPUT</b></label>
                    <button class="btn btn-primary btn-sm my-1" id="frontAddTextBtn">Add Text</button>
                    <button class="btn btn-danger btn-sm my-1" id="frontRemoveTextBtn">Remove Text</button>
                    <textarea name="text_input" id="frontTextInput" cols="30" rows="10"></textarea>



                    <div>
                        <label for="#fronImageInput"><b>FRONT LOGO</b></label>
                    </div>
                    <input accept=".png" class=" form-control" type="file" id="fronImageInput" />
                    <img class="m-1" id="previewImage" src="#" alt="Preview Image" style="display: none; width:200px">
                    <button id="frontRemoveBtn" class="btn btn-danger form-control">REMOVE</button>
                </div>
            </div>


            <div id="Back" class="tabcontent"  >
                <div class="m-2">
                <div>
                        <label for="#"><b>BACK TEXT</b></label>
                    </div>
                    <div>
                        <label for="backColorPicker"><b>SELECT COLOR</b></label>
                        <input type="color" id="backColorPicker" name="backColorPicker" value="#ffffff">
                        <p id="backColorDisplay">Selected Color: #ffffff</p>
                    </div>
                    <select id="backFontFamily" onchange="updateDisplayBack(this.value)">
                        <option value="">Select a font</option>
                    </select>
                    <h6>Font Display:  <p id="backFontDisplay" style="font-size: 20px;">Select a font</p> </h6>
                    <label for="#backTextInput"><b>TEXT INPUT</b></label>
                    <button class="btn btn-primary btn-sm my-1" id="backAddTextBtn">Add Text</button>
                    <button class="btn btn-danger btn-sm my-1" id="backRemoveTextBtn">Remove Text</button>
                    <textarea name="text_input" id="backTextInput" cols="30" rows="10"></textarea>

                    <div>
                        <label for="#backImageInput"><b>BACK LOGO</b></label>
                    </div>
                    <input accept=".png" class=" form-control" type="file" id="backImageInput" />
                    <img class="m-1" id="previewImage1" src="#" alt="Preview Image" style="display: none; width:200px">
                    <button id="backRemoveBtn" class="btn btn-danger form-control">REMOVE</button>

                </div>
            </div>


            <div class="p-1 border ">
                <div style="background-color: black">
                    <p style="text-align: center;" class="text-white ">CUSTOMIZATION LIST</p>
                </div>

                <table>
                    <thead></thead>

                    <tbody>
                        <tr>
                            <td> <label for="#viewFrontView">FRONT VIEW</label></td>

                            <td> <input type="checkbox" name="" id="viewFrontView" checked /></td>

                        </tr>
                        <tr>
                            <td> <label for="#viewBackView">BACK VIEW</label></td>
                            <td> <input type="checkbox" name="" id="viewBackView" checked /></td>

                        </tr>
                        <!-- <tr>
                                                                    <td><label for="">NO LOGO</label></td>
                                                                    <td> <input type="checkbox" name="" id="" checked /></td>

                                                                </tr> -->
                    </tbody>
                </table>
            </div>
            <!-- // <img id="see_generated" alt="" /> -->




        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/fontfaceobserver@2.1.0/fontfaceobserver.standalone.js"></script>

<script>
    window.onload = function() {
        // document.getElementById('front').click()
    };

    var canvas = new fabric.Canvas('c');

    // Define an array with all fonts
    var fonts = ['Fonstars', 'Operation Napalm', 'Unitblock', 'OSerif', 'Public Pixel'];


    // Populate the fontFamily select
    var frontSelect = document.getElementById("frontFontFamily");
    var backSelect = document.getElementById("backFontFamily");
    fonts.forEach(function(font) {
        let option = document.createElement('option');
        option.value = font;
        option.text = font;
        option.style.fontFamily = font;
        frontSelect.add(option);
    });

    fonts.forEach(function(font) {
        let option = document.createElement('option');
        option.value = font;
        option.text = font;
        option.style.fontFamily = font;
        backSelect.add(option);
    });

    function updateDisplayFront(font) {
        var display = document.getElementById('frontFontDisplay');
        display.textContent = font;
        display.style.fontFamily = font;
    }

    function updateDisplayBack(font) {
        var display = document.getElementById('backFontDisplay');
        display.textContent = font;
        display.style.fontFamily = font;
    }

    function openTab(evt, tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";
    }
    function initiateTab1(){
        setTimeout(() => {
            document.getElementById('front').click()
        }, 500)

        document.getElementById('frontColorPicker').addEventListener('input', function() {
            document.getElementById('frontColorDisplay').innerText = 'Selected Color: ' + this.value;
        });

        document.getElementById('backColorPicker').addEventListener('input', function() {
            document.getElementById('colorDisplay2').innerText = 'Selected Color: ' + this.value;
        });
    }




    

</script>

<script>
    $(document).ready(function() {
        $('#qty').on('change', function(e) {
            if (Number.parseInt($(this).val()) >= 1) {
                let num = Number.parseFloat($('#price_id').attr('price')) * Number.parseInt($(this).val())
                $('#price_tag').text(num)
                console.log(num)
            } else {
                Number.parseInt($(this).val(1))
            }

        })
        // Initialize Fabric.js canvas

        $('#frontRemoveBtn').hide()
        $('#backRemoveBtn').hide()
        // Load and set a background image
        var bg_1 = $('#example1').attr('imgsrc')
        var bg_2 = $('#example2').attr('imgsrc')
        var canvas1 = new fabric.Canvas('example1');
        setBackground(canvas1, bg_1)

        var canvas2 = new fabric.Canvas('example2');
        setBackground(canvas2, bg_2)

        $('#frontAddTextBtn').on('click', function() {
            let text = $('#frontTextInput')[0].value
            console.log(text)
            if(Boolean(text)){
                setText(canvas1, text)
            }else{
                alert("Insert Text")
            }
        });
        
        $('#backAddTextBtn').on('click', function() {
            let text = $('#backTextInput')[0].value
            console.log(text)
            if(Boolean(text)){
                setText2(canvas2, text)
            }else{
                alert("Insert Text")
            }
        });

        function setText(canvas1, text) {
            let canvasTemp = canvas1
            var canvasText = new fabric.IText(text, {
                left: 10,  // position of text
                top: 10,
                fontFamily:  $('#frontFontFamily').val(),
                fill: $('#frontColorPicker').val(),
                lineHeight: 1.1,
            });
            canvasText.bringToFront();
            canvasTemp.isDrawingMode = false
            canvasTemp.add(canvasText);
            canvasTemp.setActiveObject(canvasText);
            canvasTemp.renderAll();
        }

        $('#frontRemoveTextBtn').on('click', function() {
            var activeObject = canvas1.getActiveObject();
            if (activeObject && activeObject.type === 'i-text') {
                canvas1.remove(activeObject);
            }
        });

        function setText2(canvas2, text) {
            let canvasTemp = canvas2
            var canvasText = new fabric.IText(text, {
                left: 10,  // position of text
                top: 10,
                fontFamily:  $('#backFontFamily').val(),
                fill: $('#backColorPicker').val(),
                lineHeight: 1.1,
            });
            canvasText.bringToFront();
            canvasTemp.isDrawingMode = false
            canvasTemp.add(canvasText);
            canvasTemp.setActiveObject(canvasText);
            canvasTemp.renderAll();
        }

        $('#frontRemoveTextBtn').on('click', function() {
            var activeObject = canvas1.getActiveObject();
            if (activeObject && activeObject.type === 'i-text') {
                canvas1.remove(activeObject);
            }
        });

        $('#backRemoveTextBtn').on('click', function() {
            var activeObject = canvas2.getActiveObject();
            if (activeObject && activeObject.type === 'i-text') {
                canvas1.remove(activeObject);
            }
        });



        $('#fronImageInput').change(function(e) {
            var file = e.target.files[0];
            var imageType = /^image\//;

            if (imageType.test(file.type)) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    $('#previewImage')
                        .attr('src', event.target.result)
                        .show();
                    addlogo(canvas1, event.target.result, bg_1)
                };

                reader.readAsDataURL(file);
            }
        });
        $('#backImageInput').change(function(e) {
            var file = e.target.files[0];
            var imageType = /^image\//;

            if (imageType.test(file.type)) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    $('#previewImage1')
                        .attr('src', event.target.result)
                        .show();
                    addlogo(canvas2, event.target.result, bg_2)
                };

                reader.readAsDataURL(file);
            }
        });

        $('#frontRemoveBtn').on('click', function() {
            removeSelected(canvas1)
            // Hide the button after generating the view
            setBackground(canvas1, bg_1)
        });
        $('#backRemoveBtn').on('click', function() {
            removeSelected(canvas2)
            // Hide the button after generating the view
            setBackground(canvas2, bg_2)
        });

        $('#submit_images').off('click').on('click', function(event) {
            event.stopPropagation();
            let tempBack = [];
            canvas2.getObjects().forEach((object) => {
                tempBack.push(object.getSrc())
            })
            //Get MainCanvas
            var dataURLtempBack = canvas2.toDataURL();


            let tempFront = [];
            canvas1.getObjects().forEach((object) => {
                if( object.type == "image" ){
                    console.log(object.type)
                    tempFront.push(object.getSrc())
                }
            })

            //Get MainCanvas
            var dataURLtempFront = canvas1.toDataURL();

            $('#see_generated').attr("src", dataURLtempBack)

            $.post("action_customizeImage/GenerateImage.php", {
                    dataURLtempFront,
                    tempFront,
                    dataURLtempBack,
                    tempBack,
                    quantity: $('#qty').val(),
                    id: $('#div_set').attr('id_src'),
                    priceTotal: $('#price_tag').text(),
                    size: $('#size_sel').val()
                },
                function(data) {
                    if (data === 'No User') {
                        login_()
                        $('#modalId').modal('toggle')
                    } else {
                        alert(data)
                        // $('#modalId').modal('toggle')
                    }

                    //$('#modalId').modal('hide');
                }

            );

        });


        function loadAndUse(font) {
            var myfont = new FontFaceObserver(font)
            myfont.load()
                .then(function() {
                    // when font is loaded, use it.
                    canvas2.getActiveObject().set("fontFamily", font);
                    canvas2.requestRenderAll();
                }).catch(function(e) {
                    console.log(e)
                    alert('font loading failed ' + font);
                });
            }
    });

    function removeSelected(canvas) {


        var selection = canvas.getActiveObject();
        canvas.remove(selection);
        canvas.discardActiveObject();
        canvas.requestRenderAll();

    }



    function addlogo(canvas, img1, bg_image) {
        var canvasTemp = canvas
        setBackground(canvasTemp, bg_image)
        fabric.Image.fromURL(img1, function(img) {
            img.set({
                // You can adjust the properties of the background image here

                selectable: true, // Make it non-selectable
                evented: true, // Make it non-evented
            });

            img.scaleToWidth(100); // Adjust the size of the logo
            canvasTemp.add(img); // Add the logo to the canvas
        });

    }

    function setBackground(canvas, img) {

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

    $('#fronImageInput').change(function() {
        if ($(this).val()) {
            $('#frontRemoveBtn').show();
        } else {
            $('#frontRemoveBtn').hide();
        }
    });


    $('#backImageInput').change(function() {
        if ($(this).val()) {
            $('#backRemoveBtn').show();
        } else {
            $('#backRemoveBtn').hide();
        }
    });
    $('#viewFrontView').on('change', function() {
        if ($(this).is(':checked')) {
            $('#frontView').show();
        } else {
            $('#frontView').hide();

        }
        if ($(this).is(':checked')) {

            $('#add_logo').show();

        } else if (!$(this).is(':checked') && !$('#viewBackView').is(':checked')) {
            $('#add_logo').hide();
            $('#tab').hide();
        }
    });
    $('#viewBackView').on('change', function() {
        if ($(this).is(':checked')) {
            $('#backView').show();
        } else {
            $('#backView').hide();

        }
        if ($(this).is(':checked')) {

            $('#add_logo').show();

        } else if (!$(this).is(':checked') && !$('#viewFrontView').is(':checked')) {
            $('#add_logo').hide();
        }
    });

    //---------------------------------END--------------------------------------------------------
</script>