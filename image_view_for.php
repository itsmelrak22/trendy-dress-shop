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
            <div class="m-2">
                <label for="#imageInput"><b>FRONT LOGO</b></label>
                <button id="remove_btn" class="btn btn-danger form-control">REMOVE</button>
                <input accept=".png" class=" form-control" type="file" id="imageInput" />
                <img class="m-1" id="previewImage" src="#" alt="Preview Image" style="display: none; width:200px">

            </div>
            <div class="m-2">
                <label for="#imageInput"> <b>BACK LOGO</b></label>
                <button id="remove_btn1" class="btn btn-danger form-control">REMOVE</button>
                <input accept=".png" class=" form-control" type="file" id="imageInput1" />
                <img class="m-1" id="previewImage1" src="#" alt="Preview Image" style="display: none; width:200px">

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

        $('#remove_btn').hide()
        $('#remove_btn1').hide()
        // Load and set a background image
        var bg_1 = $('#example1').attr('imgsrc')
        var bg_2 = $('#example2').attr('imgsrc')
        var canvas1 = new fabric.Canvas('example1');
        setBackground(canvas1, bg_1)

        var canvas2 = new fabric.Canvas('example2');
        setBackground(canvas2, bg_2)


        $('#imageInput').change(function(e) {
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
        $('#imageInput1').change(function(e) {
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

        $('#remove_btn').on('click', function() {
            removeSelected(canvas1)
            // Hide the button after generating the view
            setBackground(canvas1, bg_1)
        });
        $('#remove_btn1').on('click', function() {
            removeSelected(canvas2)
            // Hide the button after generating the view
            setBackground(canvas2, bg_2)
        });




        $('#submit_images').on('click', function() {
            let tempBack = [];
            canvas2.getObjects().forEach((object) => {
                tempBack.push(object.getSrc())
            })
            //Get MainCanvas
            var dataURLtempBack = canvas2.toDataURL();


            let tempFront = [];
            canvas1.getObjects().forEach((object) => {
                tempFront.push(object.getSrc())
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
                        $('#modalId').modal('toggle')
                    }

                    //$('#modalId').modal('hide');
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
                selectable: false, // Make it non-selectable
                evented: false, // Make it non-evented
            });

            // Add the background image to the canvas at the bottom layer (z-index: -1)
            canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas), {
                // You can specify additional options here if needed
            });
        });
    }

    $('#imageInput').change(function() {
        if ($(this).val()) {
            $('#remove_btn').show();
        } else {
            $('#remove_btn').hide();
        }
    });


    $('#imageInput1').change(function() {
        if ($(this).val()) {
            $('#remove_btn1').show();
        } else {
            $('#remove_btn1').hide();
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