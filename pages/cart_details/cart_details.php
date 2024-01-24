<?php

require_once '../../connection.php';
session_start();

if (!isset($_SESSION['id_user'])) {
    echo 'No User';
    exit();
} else {
    $userID = $_SESSION['id_user'];

    $fetchCart = $conn->prepare('SELECT a.*,b.*, c.* from cart a 
    Join products b on a.product_id=b.product_id
    JOIN customers c ON a.user_id = c.customer_id
    where a.user_id =? and  a.status=0');
    $fetchCart->execute([$userID]);
    $fetchCart_ = $fetchCart->fetchAll();
}

$paymentMethods = array(
    array('id' => 1, 'name' => 'COD'),
    array('id' => 2, 'name' => 'Online Banking'),
);
?>
<!-- <style>
    .cart-container {
        display: flex;
        flex-direction: column;
    }

    .cart-item {
        display: flex;
        border: 1px solid #ccc;
        margin: 10px;
        padding: 10px;
        background-color: #fff;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
    }

    .cart-item-image {
        width: 250px;
        margin-right: 10px;
    }

    .cart-item-image img {
        max-width: 100%;
        height: auto;
    }

    .cart-item-details {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .product-id,
    .quantity,
    .total-price,
    .size {
        margin-bottom: 5px;
    }

    .cart-item-remove {
        display: flex;
        align-items: center;
        cursor: pointer;
        color: red;
        font-size: 20px;
    }
</style> -->
<style>
    #paypalDiv {
        display: none;
    }
</style> 

<style>
    .cart-container {
        display: flex;
        flex-direction: column;
    }

    .cart-item {
        display: flex;
        border: 1px solid #eee;
        margin: 10px;
        padding: 10px;
        background-color: #fff;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    .cart-item-image {
        width: 120px;
        margin-right: 10px;
    }

    .cart-item-image img {
        max-width: 100%;
        height: auto;
    }

    .cart-item-details {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .product-id,
    .quantity,
    .total-price,
    .size {
        margin-bottom: 5px;
        font-size: 14px;
        color: #333;
    }

    .cart-item-remove {
        display: flex;
        align-items: center;
        cursor: pointer;
        color: #e74c3c;
        font-size: 18px;
    }

    .checkout-button {
        margin-top: 20px;
        display: flex;
        justify-content: flex-end;
    }

    .checkout-button button {
        background-color: #f37022;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    .user-address {
        margin-bottom: 20px;
        padding: 10px;
        background-color: #f8f9fa;
        border: 1px solid #ccc;
    }

    
    @media (max-width: 768px) {
        .cart-item {
            flex-direction: column;
        }

        .cart-item-image {
            width: 100%;
            margin-bottom: 10px;
        }
    }

    /* #addressForm textarea {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        resize: vertical;
        box-sizing: border-box;
    } */

    /* #addressForm button {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 10px 15px;
        cursor: pointer;
        border-radius: 4px;
    } */

    #addressForm {
        display: flex;
        /* align-items: flex-start; */
        align-items: center;
    }

    #addressForm textarea {
        flex-grow: 1;
        margin: 0;
        margin-right: 10px; 
    }

    #addressForm button {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 6px 10px;
        cursor: pointer;
        border-radius: 4px;
        font-size: 10px;
    }

    #addressForm button:hover {
        background-color: #45a049;
    }

    #addressForm textarea:disabled {
        border: none;
        outline: none;
        resize: none;
        background-color:#f8f9fa;
    }

</style>

<?php if (count($fetchCart_) != 0) : ?>
    <div class="cart-container">
        <!-- <div class="user-address">
            <h6>Address:</h6>
            <?php if (!empty($fetchCart_[0]['complete_address'])) : ?>
                <p><?php echo $fetchCart_[0]['complete_address']; ?></p>
            <?php else : ?>
                <form id="addressForm">
                    <textarea name="newAddress" placeholder="Enter your address"></textarea>
                    <button type="button" onclick="updateAddress()">Update Address</button>
                </form>
            <?php endif; ?>
        </div> -->
        <?php foreach ($fetchCart_ as $row) : ?>
            <div class="cart-item">

                <div class="cart-item-image">
                    <?php $image = 'data:image/png;base64,' . $row['frontImage'] ?>
                    <img src="<?php echo $image ?>" alt="Product Image">
                </div>
                <div class="cart-item-image">
                    <?php $image1 = 'data:image/png;base64,' . $row['backImage'] ?>
                    <img src="<?php echo $image1 ?>" alt="Product Image">
                </div>
                <div class="cart-item-details">
                    <span class="product-id">Product ID: <?php echo $row['product_id'] ?></span>
                    <span class="product-id">Description: <?php echo $row['product_title'] ?></span>
                    <span class="quantity">Quantity: <?php echo $row['qty'] ?></span>
                    <span class="total-price">Total Price: &#8369; <?php echo $row['Total_p_price'] ?></span>
                    <span class="size">Size: <?php echo $row['size'] ?></span>
                </div>
                <div class="cart-item-remove">
                    <i onclick="deleteItem(<?php echo $row['p_id'] ?>)" class="fa fa-trash" aria-hidden="true"></i>
                </div>
            </div>
        <?php endforeach ?>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button onclick="toCheckOut(<?php echo $row['p_id'] ?>)" style="background-color: black;" type="button" class="btn  text-white">Checkout</button>
    </div>
    
    <div id="checkoutConfirmation" style="display: none;">
        <h5>Your Order Summary</h5>
        <div class="order-summary">
        </div>
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div>
                <label for="orderOption" class="form-label">Select Option:</label>
            </div>
            <div style="margin-right: 380px;"> <!-- Adjust the margin as needed -->
                <select class="form-select" id="orderOption" name="orderOption" onchange="checkOption()">
                    <?php foreach ($paymentMethods as $method) : ?>
                        <option value="<?php echo $method['id']; ?>"><?php echo $method['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button onclick="placeOrder()" class="btn btn-primary">Confirm Order</button>
        </div>

        <div class="row" id="paypalContainer" style="display: none;">
                <div class="col-lg-12">
                    <div class="p-5">
                        <form class="user">
                            <div class="form-group row">
                                <div class="form-group col-12">
                                    <label for="payment">Please input your Payment</label>
                                    <input name="payment" id="payment" type="number" class="form-control form-control-user" placeholder="Payment" required value="1000" readonly>
                                </div>
                            </div>
                        </form>
                        <button type="button" id="paymentBtn" class="btn btn-info" onclick="togglePaypalDiv()" >
                            Proceed to Payment <i class="fas fa-check"></i>
                        </button>
                        <hr>
                    </div>
                    <div class="card-body container-fluid" id="paypalDiv">
                        <span>Available Payment Methods:</span>
                        <hr>
                        <div class="form-group col-12">
                            <div class="paypal-button-container" id="paypal-button-container"></div>
                        </div>
                    </div>
                </div>
            </div>
    </div>


    <div id="confirmation" style="display: none;">
        <h5>Order Confirmed</h5>
        <p>Thank you for your purchase!</p>
    </div>
<?php else : ?>
    <div class="cart-container">
        <p class="text-center text-vertical-center">No items in cart yet.</p>
    </div>
<?php endif ?>
<!-- <button type="button" id="paymentBtn" class="btn btn-info" onclick="togglePaypalDiv()"> Proceed to Payment <i class="fas fa-check"></i> </button>
<div class="card-body container-fluid" id="paypalDiv">
                                <span>Available Payment Methods:</span>
                                <hr>
                                <div class="form-group col-12">
                                    <div class="paypal-button-container" id="paypal-button-container"></div>
                                </div>
                            </div>

                            <div class="card-body p-0"> -->

</div>
<!-- <button class="btn btn-info btn-circle" data-toggle="modal" data-target="#paymentModal" > Online Payment</button> 

<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Trendy Dress Shop - Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body card shadow py-2">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <form class="user">
                                    <div class="form-group row">
                                        <div class="form-group col-12">
                                            <label for="payment">Please input your Payment</label>
                                            <input name="payment" id="payment" type="number" class="form-control form-control-user" placeholder="Payment" required oninput="checkPayment()">
                                        </div>
                                    </div>
                                </form>
                                <button type="button" id="paymentBtn" class="btn btn-info" onclick="togglePaypalDiv()" disabled>
                                    Proceed to Payment <i class="fas fa-check"></i>
                                </button>
                                <hr>
                            </div>
                            <div class="card-body container-fluid" id="paypalDiv">
                                <span>Available Payment Methods:</span>
                                <hr>
                                <div class="form-group col-12">
                                    <div class="paypal-button-container" id="paypal-button-container"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->


<script>
    let transaction = {};

    paypal.Buttons({
        // style: {
        //     layout: 'vertical',
        //     color:  'blue',
        //     shape:  'rect',
        //     label:  'paypal'
        // },
        createOrder: function(data, actions) {
            // Set up the transaction
            let value = document.getElementById('payment').value
            return actions.order.create({
                purchase_units: [{
                amount: {
                    value: value
                }
                }]
            });
        },
        onApprove: function(data, actions) {
            // This function captures the funds from the transaction.
            return actions.order.capture().then(function(details) {
            // This function shows a transaction success message to your buyer.
                handleReservation()
                alert('Transaction completed by ' + details.payer.name.given_name);
            });
        }
    }).render('#paypal-button-container');

    function togglePaypalDiv() {
        var x = document.getElementById("paypalDiv");

        let computedStyle = window.getComputedStyle(x);
        if (computedStyle.display === "none") {
            x.style.display = "block";
        }
    }

    function checkOption(){
        let option = document.getElementById('orderOption');
        let paypalContainer = document.getElementById('paypalContainer');
        console.log(option.value);
        if (option.value == 2){
            paypalContainer.style.display = "block";
        }else{
            paypalContainer.style.display = "none";

        }
    }
</script>

<script>
    function deleteItem(cartID) {
        let answer = confirm("Delete Item?");
        if (answer) {
            $.post("pages/cart_details/actions/delete_cart_item.php", {
                    cartID
                },
                function(data) {
                    alert(data)
                    fetchCartDetails_()
                }
            );
        }

    }

    // function toCheckOut() {
    //     let answer = confirm("Are you sure to checkout now?");
    //     if (answer) {
    //         $.post("pages/cart_details/actions/check_out.php", {

    //             },
    //             function(data) {
    //                 alert(data)
    //                 fetchCartDetails_()
    //             }
    //         );
    //     }
    // }


    function toCheckOut() {
        document.querySelector('.cart-container').style.display = 'none';

        document.querySelector('.modal-footer').style.display = 'none';

        document.getElementById('checkoutConfirmation').style.display = 'block';

        populateOrderSummary();
    }


    function placeOrder() {

        let selectedPaymentMethod = document.getElementById('orderOption').value;
        let answer = confirm("Are you sure to checkout now?");
            if (answer) {
                $.post("pages/cart_details/actions/check_out.php", {
                    paymentMethod: selectedPaymentMethod
                },
                    function(data) {
                        alert(data);
                        fetchCartDetails_();
                    }
                );
            }

        document.getElementById('checkoutConfirmation').style.display = 'none';

        document.getElementById('confirmation').style.display = 'block';
    }


    // function populateOrderSummary() {
    //     let orderSummaryContainer = document.querySelector('.order-summary');

    //     orderSummaryContainer.innerHTML = "";

    //     let address = "<?php echo $row['complete_address'] ?? null; ?>";
    //     let addressElement = document.createElement('div');
    //     addressElement.className = 'user-address';

    //     if (address.trim() !== "") {
    //         addressElement.innerHTML = `
    //             <h6>Shipping Address:</h6>
    //             <p>${address}</p>
    //         `;
    //     } else {
    //         addressElement.innerHTML = `
    //             <h6>Shipping Address:</h6>
    //             <form id="addressForm">
    //                 <textarea name="newAddress" placeholder="Enter your address"></textarea>
    //                 <button type="button" onclick="updateAddress()">Update Address</button>
    //             </form>
    //         `;
    //     }

    //     orderSummaryContainer.appendChild(addressElement);

    //     let orderItem;

    //     <?php foreach ($fetchCart_ as $row) : ?>
    //         orderItem = document.createElement('div');
    //         orderItem.className = 'order-item';

    //         orderItem.innerHTML = `
    //             <span class="product-id">Product ID: <?php echo $row['product_id'] ?></span>
    //             <span class="product-id">Description: <?php echo $row['product_title'] ?></span>
    //             <span class="quantity">Quantity: <?php echo $row['qty'] ?></span>
    //             <span class="total-price">Total Price: &#8369; <?php echo $row['Total_p_price'] ?></span>
    //             <span class="size">Size: <?php echo $row['size'] ?></span>
    //         `;

    //         orderSummaryContainer.appendChild(orderItem);
    //     <?php endforeach ?>
    // }

    function populateOrderSummary() {
    let orderSummaryContainer = document.querySelector('.order-summary');

    orderSummaryContainer.innerHTML = "";

    let address = "<?php echo $row['complete_address'] ?? null; ?>";
    let addressElement = document.createElement('div');
    addressElement.className = 'user-address';

    if (address.trim() !== "") {
        addressElement.innerHTML = `
            <h6>Shipping Address:</h6>
            <p>${address}</p>
        `;
    } else {
        addressElement.innerHTML = `
            <h6>Shipping Address:</h6>
            <form id="addressForm">
                <textarea name="newAddress" placeholder="Enter your address"></textarea>
                <button type="button" onclick="updateAddress()">Update Address</button>
            </form>
        `;
    }

    orderSummaryContainer.appendChild(addressElement);

    <?php foreach ($fetchCart_ as $row) : ?>
        {
            let orderItem = document.createElement('div');
            orderItem.className = 'order-item';

            let productImageFrontSrc = 'data:image/png;base64,' + <?php echo json_encode($row['frontImage']); ?>;
            // let productImageBackSrc = 'data:image/png;base64,' + <?php echo json_encode($row['backImage']); ?>;
            
            let productImageFrontElement = document.createElement('img');
            productImageFrontElement.src = productImageFrontSrc;
            productImageFrontElement.alt = 'Product Front Image';
            productImageFrontElement.className = 'cart-item-image';
            productImageFrontElement.style.width = '50px';

            // let productImageBackElement = document.createElement('img');
            // productImageBackElement.src = productImageBackSrc;
            // productImageBackElement.alt = 'Product Back Image';
            // productImageBackElement.className = 'cart-item-image';

            orderItem.appendChild(productImageFrontElement);
            // orderItem.appendChild(productImageBackElement);

            let orderItemDetails = document.createElement('div');
            orderItemDetails.className = 'cart-item-details';
            
            orderItemDetails.innerHTML = `
                <span class="product-id">Product ID: <?php echo $row['product_id'] ?></span>
                <span class="product-id">Description: <?php echo $row['product_title'] ?></span>
                <span class="quantity">Quantity: <?php echo $row['qty'] ?></span>
                <span class="total-price">Total Price: &#8369; <?php echo $row['Total_p_price'] ?></span>
                <span class="size">Size: <?php echo $row['size'] ?></span>
            `;

            orderItem.appendChild(orderItemDetails);
            orderSummaryContainer.appendChild(orderItem);
        }
    <?php endforeach ?>
    }





    function updateAddress() {
        // fetchCartDetails_();
        let newAddress = document.querySelector('textarea[name="newAddress"]').value;
        $.post("pages/cart_details/actions/update_address.php", { newAddress },
            function(data) {
                if (data && data !== 'Failed to update address') {
                    updateAddressInModal(data);
                    disableAddressInput()
                } else {
                    alert(data);
                }
            }
        );
    }

    function updateAddressInModal(newAddress) {
        let addressElement = document.querySelector('.user-address p');
        
        if (addressElement) {
            addressElement.textContent = newAddress;
        }
    }

    function disableAddressInput() {
        let addressTextarea = document.querySelector('textarea[name="newAddress"]');
        let updateButton = document.querySelector('#addressForm button');

        if (addressTextarea && updateButton) {
            // Disable the textarea
            addressTextarea.disabled = true;

            // Hide the update button
            updateButton.style.display = 'none';
        }
    }

    // function updateAddress() {
    //     let newAddress = document.querySelector('textarea[name="newAddress"]').value;
        
    //     $.post("pages/cart_details/actions/update_address.php", {
    //         newAddress
    //     }, function(data) {
    //         alert(data);
    //         fetchCartDetails_()
    //     });
    // }
</script>