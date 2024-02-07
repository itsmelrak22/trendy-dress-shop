<?php

require_once '../../connection.php';
session_start();

if (!isset($_SESSION['id_user'])) {
    echo 'No User';
    exit();
} else {
    $userID = $_SESSION['id_user'];

    $fetchCart = $conn->prepare('SELECT a.*,b.*, c.* FROM cart a 
                                JOIN products b ON a.product_id=b.product_id
                                JOIN customers c ON a.user_id = c.customer_id
                                WHERE a.user_id =? AND  a.status=0');
    $fetchCart->execute([$userID]);
    $fetchCart_ = $fetchCart->fetchAll();
}

$paymentMethods = array(
    array('id' => 1, 'name' => 'COD'),
    array('id' => 2, 'name' => 'Online Banking'),
);
?>
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
            <?php 

            ?>
    <div class="cart-item">
        <input type="checkbox" class="cart-item-checkbox" value="<?php echo $row['p_id']; ?>">
        <div class="cart-item-image">
            <?php $image = 'data:image/png;base64,' . $row['frontImage'] ?>
            <img loading="lazy" src="<?php echo $image ?>" alt="Product Image">
        </div>
        <div class="cart-item-image">
            <?php $image1 = 'data:image/png;base64,' . $row['backImage'] ?>
            <img loading="lazy" src="<?php echo $image1 ?>" alt="Product Image">
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

</div>


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
        let selectedProductIds = []; // Get selected product IDs from populateOrderSummary function
        let checkboxes = document.querySelectorAll('.cart-item-checkbox:checked');
        checkboxes.forEach(function(checkbox) {
            selectedProductIds.push(checkbox.value);
        });

        $.post("pages/cart_details/actions/check_out.php", {
            paymentMethod: selectedPaymentMethod,
            selectedProducts: selectedProductIds
        },
        function(data) {
            alert(data);
            fetchCartDetails_();
        });
    }

    document.getElementById('checkoutConfirmation').style.display = 'none';
    document.getElementById('confirmation').style.display = 'block';
}

    function populateOrderSummary() {
    let orderSummaryContainer = document.querySelector('.order-summary');
    orderSummaryContainer.innerHTML = "";

    let selectedProductIds = [];
    let checkboxes = document.querySelectorAll('.cart-item-checkbox:checked');
    checkboxes.forEach(function(checkbox) {
        selectedProductIds.push(checkbox.value);
    });

    // Add address section
    let addressElement = document.createElement('div');
    addressElement.className = 'user-address';

    // Check if address is available
    <?php if (!empty($fetchCart_[0]['complete_address']) && !empty($fetchCart_[0]['province']) && !empty($fetchCart_[0]['customer_city'])) : ?>
        let addressParagraph = document.createElement('p');
        addressParagraph.textContent += '<?php echo $fetchCart_[0]['complete_address']; ?>, ';
        

    $(document).ready(function() {
        $.ajax({
            url: `https://psgc.gitlab.io/api/provinces/<?php echo $fetchCart_[0]['province']; ?>/cities-municipalities.json`,
            type: 'GET',
            success: function(data) {
                let a = data.find( item => item.code == '<?php echo $fetchCart_[0]['customer_city']; ?>')
                addressParagraph.textContent += `${a.name}, `;
            },
            error: function(xhr, status, error) {
                console.error('Error fetching cities/municipalities: ' + error);
            }
        });
    })

    $(document).ready(function() {
        $.ajax({
                url: 'https://psgc.gitlab.io/api/provinces.json',
                type: 'GET',
                success: function(data) {
                    let a = data.find( (item) => {
                        return item.code =='<?php echo $fetchCart_[0]['province']; ?>'
                    } )
                    addressParagraph.textContent += a.name;
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching provinces: ' + error);
                }
        });
    });

        addressElement.appendChild(addressParagraph);
<?php else : ?>
    // let childElement = document.createElement('div');
    // childElement.textContent = 'testtt'
    // parentElement.appendChild(childElement);
    // The address is incomplete, so provide input fields for updating
    // Create address form
    let addressForm = document.createElement('form');
    addressForm.classList.add('mb-3');

    // Add province dropdown
    let provinceSelectWrapper = document.createElement('div');
    provinceSelectWrapper.classList.add('mb-3');
    addressForm.appendChild(provinceSelectWrapper);

    let provinceLabel = document.createElement('label');
    provinceLabel.htmlFor = 'provinceSelect';
    provinceLabel.classList.add('form-label');
    provinceLabel.textContent = 'Province';
    provinceSelectWrapper.appendChild(provinceLabel);

    let provinceSelect = document.createElement('select');
    provinceSelect.id = 'provinceSelect';
    provinceSelect.name = 'province';
    provinceSelect.classList.add('form-select');
    provinceSelectWrapper.appendChild(provinceSelect);

    // Add city dropdown
    let citySelectWrapper = document.createElement('div');
    citySelectWrapper.classList.add('mb-3');
    addressForm.appendChild(citySelectWrapper);

    let cityLabel = document.createElement('label');
    cityLabel.htmlFor = 'citySelect';
    cityLabel.classList.add('form-label');
    cityLabel.textContent = 'City';
    citySelectWrapper.appendChild(cityLabel);

    let citySelect = document.createElement('select');
    citySelect.id = 'citySelect';
    citySelect.name = 'city';
    citySelect.classList.add('form-select');
    citySelect.disabled = true;
    citySelectWrapper.appendChild(citySelect);

    // Add address textarea
    let addressTextareaWrapper = document.createElement('div');
    addressTextareaWrapper.classList.add('mb-3');
    addressForm.appendChild(addressTextareaWrapper);

    let addressTextareaLabel = document.createElement('label');
    addressTextareaLabel.htmlFor = 'addressTextarea';
    addressTextareaLabel.classList.add('form-label');
    addressTextareaLabel.textContent = 'Address';
    addressTextareaWrapper.appendChild(addressTextareaLabel);

    let addressTextarea = document.createElement('textarea');
    addressTextarea.id = 'addressTextarea';
    addressTextarea.name = 'newAddress';
    addressTextarea.classList.add('form-control');
    addressTextarea.placeholder = 'Enter your address';
    addressTextareaWrapper.appendChild(addressTextarea);

    // Add update button
    let updateButton = document.createElement('button');
    updateButton.type = 'button';
    updateButton.classList.add('btn', 'btn-primary');
    updateButton.textContent = 'Update Address';
    updateButton.addEventListener('click', updateAddress);
    addressForm.appendChild(updateButton);

    // Append address form to address element
    addressElement.appendChild(addressForm);

    // AJAX call to fetch province data and populate dropdown options
    $(document).ready(function() {
        $.ajax({
            url: 'https://psgc.gitlab.io/api/provinces.json',
            type: 'GET',
            success: function(data) {
                data.forEach(function(province) {
                    let option = new Option(province.name, province.code);
                    provinceSelect.appendChild(option);
                });
            },
            error: function(xhr, status, error) {
                console.error('Error fetching provinces: ' + error);
            }
        });
    });

    // When province is selected, fetch city data and populate city dropdown options
    provinceSelect.addEventListener('change', function() {
        let selectedProvinceCode = this.value;
        citySelect.innerHTML = ''; // Clear existing options
        if (selectedProvinceCode !== '') {
            citySelect.disabled = false; // Enable city dropdown
            // AJAX call to fetch city data based on selected province
            $.ajax({
                url: `https://psgc.gitlab.io/api/provinces/${selectedProvinceCode}/cities-municipalities.json`,
                type: 'GET',
                success: function(data) {
                    data.forEach(function(city) {
                        let option = new Option(city.name, city.code);
                        citySelect.appendChild(option);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching cities/municipalities: ' + error);
                }
            });
        } else {
            citySelect.disabled = true; // Disable city dropdown if no province is selected
        }
    });

    <?php endif; ?>


    // <?php if (!empty($fetchCart_[0]['complete_address']) && !empty($fetchCart_[0]['province']) && !empty($fetchCart_[0]['customer_city'])) : ?>

    //     let addressParagraph = document.createElement('p');
    //     addressParagraph.textContent += '<?php echo $fetchCart_[0]['complete_address']; ?>';
        
    // $(document).ready(function() {
    //     $.ajax({
    //             url: 'https://psgc.gitlab.io/api/provinces.json',
    //             type: 'GET',
    //             success: function(data) {
    //                 console.log(data, 'data p')
    //                 let a = data.find( (item) => {
    //                     return item.code =='<?php echo $fetchCart_[0]['province']; ?>'
    //                 } )
    //                 console.log(a, 'p')
    //                 addressParagraph.textContent += a.name;
    //             },
    //             error: function(xhr, status, error) {
    //                 console.error('Error fetching provinces: ' + error);
    //             }
    //     });
    // });

    // $(document).ready(function() {
    //     $.ajax({
    //         url: `https://psgc.gitlab.io/api/provinces/<?php echo $fetchCart_[0]['province']; ?>/cities-municipalities.json`,
    //         type: 'GET',
    //         success: function(data) {
    //             console.log(data, 'data c')
    //             let a = data.find( item => item.code == '<?php echo $fetchCart_[0]['customer_city']; ?>')
    //             console.log(a, 'C')
    //             addressParagraph.textContent += a.name;
    //         },
    //         error: function(xhr, status, error) {
    //             console.error('Error fetching cities/municipalities: ' + error);
    //         }
    //     });
    // })

    //     addressElement.appendChild(addressParagraph);
    // <?php else : ?>
    //     let addressForm = document.createElement('form');
    //     addressForm.id = 'addressForm';
        
    //     let addressTextarea = document.createElement('textarea');
    //     addressTextarea.name = 'newAddress';
    //     addressTextarea.placeholder = 'Enter your address';
    //     addressForm.appendChild(addressTextarea);

    //     let updateButton = document.createElement('button');
    //     updateButton.type = 'button';
    //     updateButton.textContent = 'Update Address';
    //     updateButton.onclick = updateAddress;
    //     addressForm.appendChild(updateButton);

    //     addressElement.appendChild(addressForm);
    // <?php endif; ?>

    // Append address section to order summary container
    orderSummaryContainer.appendChild(addressElement);

    <?php foreach ($fetchCart_ as $row) : ?>
        // Check if the current item is selected
        if (selectedProductIds.includes('<?php echo $row['p_id']; ?>')) {
            // Create an order item element
            let orderItem = document.createElement('div');
            orderItem.className = 'order-item';

            // Add image for the selected item
            let productImageContainer = document.createElement('div');
            productImageContainer.className = 'cart-item-image';
            let productImageFront = document.createElement('img');
            productImageFront.src = 'data:image/png;base64,' + '<?php echo $row['frontImage']; ?>';
            productImageFront.alt = 'Product Image Front';
            productImageContainer.appendChild(productImageFront);
            orderItem.appendChild(productImageContainer);

            // Add details of the selected item
            let productDetailsContainer = document.createElement('div');
            productDetailsContainer.className = 'cart-item-details';
            productDetailsContainer.innerHTML = `
                <span class="product-id">Product ID: <?php echo $row['product_id'] ?></span>
                <span class="product-id">Description: <?php echo $row['product_title'] ?></span>
                <span class="quantity">Quantity: <?php echo $row['qty'] ?></span>
                <span class="total-price">Total Price: &#8369; <?php echo $row['Total_p_price'] ?></span>
                <span class="size">Size: <?php echo $row['size'] ?></span>
            `;
            orderItem.appendChild(productDetailsContainer);

            // Append the order item to the order summary container
            orderSummaryContainer.appendChild(orderItem);
        }
    <?php endforeach ?>
}


    function updateAddress() {
        // fetchCartDetails_();
        let newAddress = document.querySelector('textarea[name="newAddress"]').value;
        let province = document.querySelector('select[name="province"]').value;
        let city = document.querySelector('select[name="city"]').value;
        $.post("pages/cart_details/actions/update_address.php", { newAddress, province, city },
            function(data) {
                if (data && data !== 'Failed to update address') {
                    updateAddressInModal(JSON.parse(data));
                    disableAddressInput()
                } else {
                    alert(data);
                }
            }
        );
    }

    function updateAddressInModal(newAddress) {
        let addressElement = document.querySelector('.user-address');
        
        if (addressElement) {
            addressElement.textContent = `${newAddress[0]}, `;

        $(document).ready(function() {
        $.ajax({
                url: 'https://psgc.gitlab.io/api/provinces.json',
                type: 'GET',
                success: function(data) {
                    let a = data.find( (item) => {
                        return item.code == newAddress[1]
                    } )
                    addressElement.textContent += `${a.name}, `;
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching provinces: ' + error);
                }
        });
    });

    $(document).ready(function() {
        $.ajax({
            url: `https://psgc.gitlab.io/api/provinces/${newAddress[1]}/cities-municipalities.json`,
            type: 'GET',
            success: function(data) {
                let a = data.find( item => item.code == newAddress[2])
                addressElement.textContent += a.name;
            },
            error: function(xhr, status, error) {
                console.error('Error fetching cities/municipalities: ' + error);
            }
        });
    })
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
</script>