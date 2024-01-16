<?php

require_once '../../connection.php';
session_start();

if (!isset($_SESSION['id_user'])) {
    echo 'No User';
    exit();
} else {
    $userID = $_SESSION['id_user'];

    $fetchCart = $conn->prepare('SELECT a.*,b.*from cart a 
    Join products b on a.product_id=b.product_id
    where a.user_id =? and  a.status=0');
    $fetchCart->execute([$userID]);
    $fetchCart_ = $fetchCart->fetchAll();
}

?>
<style>
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
</style>

<?php if (count($fetchCart_) != 0) : ?>
    <div class="cart-container">
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
<?php else : ?>
    <div class="cart-container">
        <p class="text-center text-vertical-center">No items in cart yet.</p>
    </div>
<?php endif ?>

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
        let answer = confirm("Are you sure to checkout now?");
        if (answer) {
            $.post("pages/cart_details/actions/check_out.php", {

                },
                function(data) {
                    alert(data)
                    fetchCartDetails_()
                }
            );
        }
    }
</script>