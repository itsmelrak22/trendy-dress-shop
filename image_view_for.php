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
<div class="row">


<h4 class="mb-3">Customize your item:</h4>
 
    <div class="col-md-6 mb-4">
            <div class="mb-3">
                <!-- <label for="qty">Quantity</label> -->
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">Quantity</span>
                    </div>
                    <input value="1" type="number" placeholder="Enter quantity" id="qty" class="form-control" type="number"  required/>
                </div>
            </div>

            <div class="mb-3">
            <!-- <label for="size_sel">Size</label> -->
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">Size</span>
                    </div>
                    <select class="form-control" name="" id="size_sel" required>
                            <!-- <option  disabled readonly selected></option> -->
                            <option value="sm" selected>Small (SM)</option>
                            <option value="md">Medium (MD)</option>
                            <option value="lg">Large (LG)</option>
                            <option value="xl">Extra Large (XL)</option>
                        </select>
                </div>
            </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="border">
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
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="row" id="div_set" id_src="<?php echo $id ?>" style="margin-top:30px" class="d-flex">
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
    <div class="col-lg-3 col-md-12 order-md-1">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Subtotal</span>
        </h4>
        <ul class="list-group" >
            <div id="subtotal_list">
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0"><?= $fetchDetails_["product_title"] ?></h6>
                    </div>
                    <span class="text-muted">P <span class="price-to-compute"  id="product_price"><?= $fetchDetails_["product_price"] ?></span> </span>
                </li>
            </div>
        </ul>
        <ul class="list-group" >
            <div id="front_subtotal_list">
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0"> Front Customization </h6>
                    </div>
                    <span class="text-muted"> <span class=""  id=""></span> </span>
                </li>
            <div>
        </ul>
        <ul class="list-group" >
            <div id="back_subtotal_list">
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0"> Back Customization </h6>
                    </div>
                    <span class="text-muted"> <span class=""  id=""></span> </span>
                </li>
            <div>
        </ul>
        <ul class="list-group" >
            <li class="list-group-item d-flex justify-content-between">
            <span>Total (PHP) <span id="total_computation"></span> </span>
            <span class="text-muted"> x </span>
            <span class="text-muted"> <span id="product_qty"> 1 </span> </span>
            <span class="text-muted"> = </span>
            <strong>P <span id="multiplied_total_computation"></span> </strong>
            </li>
        </ul>

    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/fontfaceobserver@2.1.0/fontfaceobserver.standalone.js"></script>

<script>    
    function addListItem(productTitle, productPrice, id) {
        // Get the div by its id
        var div = document.getElementById(id);

        // Create a new list item
        var listItem = document.createElement('li');
        listItem.className = 'list-group-item d-flex justify-content-between lh-condensed price-to-compute';

        // Create the inner div
        var innerDiv = document.createElement('div');
        var span = document.createElement('span');
        span.className = 'text-muted';
        span.id = 'product_title';
        span.textContent = productTitle;
        innerDiv.appendChild(span);

        // Create the span for the price
        var span = document.createElement('span');
        span.className = 'text-muted';
        span.innerHTML = 'P <span class="price-to-compute" id="product_price">' + productPrice + '</span>';

        // Append the inner div and span to the list item
        listItem.appendChild(innerDiv);
        listItem.appendChild(span);

        // Append the list item to the div
        div.appendChild(listItem);

        computeTotalPriceAndAssignBasicInfo()
    }

    function removeListItem(productTitle, id) {
        // Get the div by its id
        var div = document.getElementById(id);

        // Get all list items in the div
        var listItems = div.getElementsByTagName('li');

        // Loop through each list item
        for (var i = 0; i < listItems.length; i++) {
            // Get the product title of the list item
            var listItemProductTitle = listItems[i].getElementsByTagName('span')[0].textContent;

            // If the product title matches the given product title, remove the list item
            if (listItemProductTitle === productTitle) {
                div.removeChild(listItems[i]);
                break;
            }
        }

        computeTotalPriceAndAssignBasicInfo()
    }

    function computeTotalPriceAndAssignBasicInfo() {
        let elements = document.getElementsByClassName("price-to-compute");
        let total = 0;
        for(let i = 0; i < elements.length; i++) {
            let price = parseInt(elements[i].textContent, 10);
            if(!isNaN(price)) {
                total += price;
            }
        }

        let product_qty = document.getElementById("product_qty");
        let total_computation = document.getElementById('total_computation');
        let size = document.getElementById('size_sel');

        total_computation.textContent = total;
        document.getElementById('multiplied_total_computation').textContent = total * Number(product_qty.textContent);

        // Basic
        basicInfo.priceTotal = total * Number(product_qty.textContent);
        basicInfo.quantity = Number(product_qty.textContent);
        basicInfo.size = size.value

        if(basicInfo.frontViewChecked){
            // Front
            frontViewData.selectedColor = document.getElementById("frontSelectedColor").value,
            frontViewData.selectedFont = document.getElementById("frontFontFamily").value,
            frontViewData.selectedCustomizeBy = document.getElementById("frontTextCustomizeBy").value,
            frontViewData.lengthInput = document.getElementById("frontTextLength").value,
            frontViewData.widthInput = document.getElementById("frontTextWidth").value,
            frontViewData.textInput = document.getElementById("frontTextInput").value
        }

        if(basicInfo.backViewChecked){
            // Back
            backViewData.selectedColor = document.getElementById("backSelectedColor").value,
            backViewData.selectedFont = document.getElementById("backFontFamily").value,
            backViewData.selectedCustomizeBy = document.getElementById("backTextCustomizeBy").value,
            backViewData.lengthInput = document.getElementById("backTextLength").value,
            backViewData.widthInput = document.getElementById("backTextWidth").value,
            backViewData.textInput = document.getElementById("backTextInput").value
        }

        console.log('basicInfo', basicInfo)
        console.log('frontViewData', frontViewData)
        console.log('backViewData', backViewData)
    }

    function validateInput(input) {
        if(input){
            var value = input.value;
            if (value < 1 || value > 4) {
                alert("Please enter a value between 1 and 4.");
                input.value = "";
            }
        }
    }

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
        var display = document.getElementById('frontFontFamily');
        // display.value = `  ${font}`;
        display.style.fontFamily = font;
    }

    function updateDisplayBack(font) {
        var display = document.getElementById('backFontFamily');
        // display.value = `  ${font}`;
        display.style.fontFamily = font;
    }

    function updateDisplayColorFront(color) {
        var display = document.getElementById('frontSelectedColor');
        display.value = `  ${color}`;
        // display.style.fontFamily = color;
    }
    function updateDisplayColorBack(color) {
        var display = document.getElementById('backSelectedColor');
        display.value = `  ${color}`;
        // display.style.fontFamily = color;
    }

    function updateDisplayBack(font) {
        var display = document.getElementById('backFontDisplay');
        display.value = font;
        display.style.fontFamily = font;
    }

    function openTab(evt, tabName) {
        //viewBackView
        //viewFrontView
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

        openTab2( tabName == "Front" ? "frontView" : "backView" )
    }

    function openTab2( tabName) {
        //frontView
        //backView
        const counterPart = tabName == "frontView" ? "backView" : "frontView" ;

        document.getElementById(tabName).style.display = "block";
        document.getElementById(counterPart).style.display = "none";
    }
    function initiateTab1(){
        setTimeout(() => {
            document.getElementById('front').click()
            computeTotalPriceAndAssignBasicInfo()
        }, 100)

        document.getElementById('frontColorPicker').addEventListener('input', function() {
            document.getElementById('frontColorDisplay').innerText = 'Selected Color: ' + this.value;
        });

        document.getElementById('backColorPicker').addEventListener('input', function() {
            document.getElementById('colorDisplay2').innerText = 'Selected Color: ' + this.value;
        });
    }

      var basicInfo = {
            id: $('#div_set').attr('id_src'),
            quantity : 0, 
            size: null,
            priceTotal : 0,
            frontViewChecked: true,
            backViewChecked: true,
        }

        var frontViewData = {
            selectedColor : '',
            selectedFont : '',
            selectedCustomizeBy : '',
            lengthInput : '',
            widthInput : '',
            textInput : '',
            logoInput: '',
            backgroundImage : ''
        }

        var backViewData = {
            selectedColor : '',
            selectedFont : '',
            selectedCustomizeBy : '',
            lengthInput : '',
            widthInput : '',
            textInput : '',
            logoInput: '',
            backgroundImage : ''
        }
    $(document).ready(function() {
        $('#qty').on('change', function(e) {
            if (Number.parseInt($(this).val()) >= 1) {
                let num = Number.parseFloat($('#product_price')[0].textContent) * Number.parseInt($(this).val())
                $('#product_price').value
                $('#product_qty')[0].textContent = $(this).val()

                computeTotalPriceAndAssignBasicInfo()
            } else {
                Number.parseInt($(this).val(1))
            }

        })

        $('#frontTextCustomizeBy').on('change', function(e) {
            console.log($(this).val());
            let value = $(this).val();
            if( value ){
                removeListItem(`Customized by print`, 'front_subtotal_list')
                removeListItem(`Customized by embroide`, 'front_subtotal_list')

                addListItem(`Customized by ${value}`, '300', 'front_subtotal_list')
            }

        })
        $('#backTextCustomizeBy').on('change', function(e) {
            console.log($(this).val());
            let value = $(this).val();
            if( value ){
                removeListItem(`Customized by print`, 'back_subtotal_list')
                removeListItem(`Customized by embroide`, 'back_subtotal_list')

                addListItem(`Customized by ${value}`, '300', 'back_subtotal_list')
            }

        })
        // Initialize Fabric.js canvas

        $('#frontRemoveBtn').hide()
        $('#backRemoveBtn').hide()
        // Load and set a background image
        var bg_1 = $('#frontCanvas').attr('imgsrc')
        var bg_2 = $('#backCanvas').attr('imgsrc')
        var canvas1 = new fabric.Canvas('frontCanvas');
        setBackground(canvas1, bg_1)

        var canvas2 = new fabric.Canvas('backCanvas');
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
            let fontFamily = $('#frontFontFamily').val();
            let color = $('#frontSelectedColor').val();

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
                document.getElementById('frontAddTextBtn').disabled = true;
                addListItem("Custom Text", "300", 'front_subtotal_list')

            }
        }

        function checkCanvasForText(canvas) {
            var objects = canvas.getObjects();
            for (var i = 0; i < objects.length; i++) {
                if (objects[i].type === 'i-text') {
                    return true;  // Return true as soon as a text object is found
                }
            }
            return false;  // Return false if no text object is found
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




        $('#frontRemoveTextBtn').on('click', function() {
            var activeObject = canvas1.getActiveObject();
            if (activeObject && activeObject.type === 'i-text') {
                canvas1.remove(activeObject);

                if (!checkCanvasForText(canvas1)) {
                    document.getElementById('frontAddTextBtn').disabled = false;
                    removeListItem('Front Custom Text');
                }
            }
        });

        $('#backRemoveTextBtn').on('click', function() {
            var activeObject = canvas2.getActiveObject();
            if (activeObject && activeObject.type === 'i-text') {
                canvas2.remove(activeObject);

                if (!checkCanvasForText(canvas2)) {
                    document.getElementById('backAddTextBtn').disabled = false;
                    removeListItem('Back Custom Text');
                }
            }
        });

        

        function setText2(canvas2, text) {
            let fontFamily = $('#backFontFamily').val();
            let color = $('#backSelectedColor').val();

            // If no font is selected, use a default one
            if (!fontFamily) {
                fontFamily = 'Arial';  // Replace 'Arial' with your default font
            }

            // If no color is selected, use black
            if (!color) {
                color = '#000000';  // Black color
            }

            
            let canvasTemp = canvas2
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

            if (checkCanvasForText(canvas2)) {
                document.getElementById('backAddTextBtn').disabled = true;
                addListItem("Custom Text", "300", 'back_subtotal_list')
            }
        }


        $('#frontImageInput').change(function(e) {
            var file = e.target.files[0];
            var imageType = /^image\//;

            if (imageType.test(file.type)) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    $('#frontPreviewImage')
                        .attr('src', event.target.result)
                        .show();
                    addlogo(canvas1, event.target.result, bg_1, 'Front')
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
                    $('#backPreviewImage')
                        .attr('src', event.target.result)
                        .show();
                    addlogo(canvas2, event.target.result, bg_2, 'Back')
                };

                reader.readAsDataURL(file);
            }
        });

        $('#frontRemoveBtn').on('click', function() {
            // removeSelected(canvas1)
            // // Hide the button after generating the view
            removeImageFromCanvas(canvas1);
            $('#frontPreviewImage').attr('src', '').css('display', 'none');
            $('#frontImageInput').val('');
            $('#frontRemoveBtn').hide()
            removeListItem("Front Customized Logo")
        });
        $('#backRemoveBtn').on('click', function() {
            
            removeImageFromCanvas(canvas2);
            $('#backPreviewImage').attr('src', '').css('display', 'none');
            $('#backImageInput').val('');
            $('#backRemoveBtn').hide()
            removeListItem("Back Customized Logo")
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

        $('#submit_images').off('click').on('click', function(event) {
            event.stopPropagation();

            let backLogo = [];
            canvas2.getObjects().forEach((object) => {
                backLogo.push(object.getSrc())
            })
            //Get MainCanvas
            var backCanvas = canvas2.toDataURL();


            let frontLogo = [];
            canvas1.getObjects().forEach((object) => {
                if( object.type == "image" ){
                    console.log(object.type)
                    frontLogo.push(object.getSrc())
                }
            })

            //Get MainCanvas
            var frontCanvas = canvas1.toDataURL();

            $('#see_generated').attr("src", backCanvas)


            frontViewData.logoInput = frontLogo
            frontViewData.backgroundImage = frontCanvas

            backViewData.logoInput = backLogo
            backViewData.backgroundImage = backCanvas

            $.post("action_customizeImage/GenerateImage.php", {
                    "basicInfo": basicInfo,
                    "frontViewData": frontViewData,
                    "backViewData": backViewData,
                },
                function(data) {
                    if (data === 'No User') {
                        login_()
                        $('#modalId').modal('toggle')
                    } else {
                        alert(data)
                        // $('#modalId').modal('toggle')
                    }

                    $('#modalId').modal('hide');
                }

            );
        });
        
        $('#submit_customize_data').off('click').on('click', function(event) {
            event.stopPropagation();

            let backLogo = [];
            canvas2.getObjects().forEach((object) => {
                backLogo.push(object.getSrc())
            })
            //Get MainCanvas
            var backCanvas = canvas2.toDataURL();


            let frontLogo = [];
            canvas1.getObjects().forEach((object) => {
                if( object.type == "image" ){
                    console.log(object.type)
                    frontLogo.push(object.getSrc())
                }
            })

            //Get MainCanvas
            var frontCanvas = canvas1.toDataURL();

            $('#see_generated').attr("src", backCanvas)


            frontViewData.logoInput = frontLogo
            frontViewData.backgroundImage = frontCanvas

            backViewData.logoInput = backLogo
            backViewData.backgroundImage = backCanvas

            $.post("action_customizeImage/GenerateImage.php", {
                    "basicInfo": basicInfo,
                    "frontViewData": frontViewData,
                    "backViewData": backViewData,
                },
                function(data) {
                    if (data === 'No User') {
                        login_()
                        $('#modalId').modal('toggle')
                    } else {
                        alert(data)
                        // $('#modalId').modal('toggle')
                    }

                    $('#modalId').modal('hide');
                }

            );
        });
    });

    function removeSelected(canvas) {


        var selection = canvas.getActiveObject();
        canvas.remove(selection);
        canvas.discardActiveObject();
        canvas.requestRenderAll();

    }

    function addlogo(canvas, img1, bg_image, position) {
        var canvasTemp = canvas
        let id = position == 'Front' ? 'front_subtotal_list' : 'back_subtotal_list';
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

        addListItem(`Customized Logo`, "300", id);
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

    $('#frontImageInput').change(function() {
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

    $('#viewFrontView, #viewBackView').on('change', () => {
        if ($('#viewFrontView').is(':checked')) {
            $('#frontView').show();
            basicInfo.frontViewChecked = true
        } else {
            $('#frontView').hide();
            basicInfo.frontViewChecked = false

            // If front view is unchecked, ensure back view is checked
            if (!$('#viewBackView').is(':checked')) {
                $('#viewBackView').prop('checked', true);
                $('#backView').show();
                basicInfo.backViewChecked = true

            }
        }

        if ($('#viewBackView').is(':checked')) {
            $('#backView').show();
            basicInfo.backViewChecked = true

        } else {
            $('#backView').hide();
            basicInfo.backViewChecked = false
            // If back view is unchecked, ensure front view is checked
            if (!$('#viewFrontView').is(':checked')) {
                $('#viewFrontView').prop('checked', true);
                $('#frontView').show();
                basicInfo.frontViewChecked = true

            }
        }

        this.computeTotalPriceAndAssignBasicInfo()
    });




    //---------------------------------END--------------------------------------------------------
</script>