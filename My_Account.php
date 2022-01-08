
<style>
    .update-info:hover,
    .order-history:hover,
    .shopping-cart:hover,
    .checkout:hover {
        color: orange !important;
    }
    
    .update-info i:hover,
    .order-history i:hover,
    .shopping-cart i:hover,
    .checkout i:hover {
        color: orange !important;
    }
</style>

<?php 
    if(!isset($_SESSION['email'])){
        echo '<meta http-equiv="refresh" content="0;URL=index.php">';
    }
    else{
?>

<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-4" style="height: 50%; text-align: center; margin-top: 2em; margin-bottom: 2em">
            <a href="index.php?page=update_info" class="update-info" style="color: darkgray; text-decoration: none;">
                <i style="color:darkgray; font-size: 10em;" class="fa fa-user" aria-hidden="true"></i>
                <div>Infomation</div>
            </a>
        </div>
        <div class="col-sm-12 col-md-4" style="height: 50%; text-align: center; margin-top: 2em; margin-bottom: 2em">
            <a href="index.php?page=order_history" class="order-history" style="color: darkgray; text-decoration: none;">
                <i style="color: darkgray; font-size: 10em;" class="fa fa-history" aria-hidden="true"></i>
                <div>Order History</div>
            </a>
        </div>
        <div class="col-sm-12 col-md-4" style="height: 50%; text-align: center; margin-top: 2em; margin-bottom: 2em">
            <a href="index.php?page=shopping_cart" class="shopping-cart" style="color: darkgray; text-decoration: none;">
                <i style="color: darkgray; font-size: 10em;" class="fa fa-shopping-cart" aria-hidden="true"></i>
                <div>Shopping Cart</div>
            </a>
        </div>
    </div>
</div>
<?php
    }
    ?>