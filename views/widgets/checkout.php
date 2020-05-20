<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/session.php");
$cart = cart_get_items();

?>




<li class="checkout-widget"><a href="/checkout.php" class="btn-checkout">

<?php if(count($cart) > 0) { ?>
<span id="checkout-items"><?= count($cart); ?></span>x 
<?php } ?>

<i id="cart" class="fas fa-shopping-cart" style="font-size: 1.1em;"></i></a>
    <?php 
    if(restaurant_is_logged_in()) {
        echo "<li class=\"checkout-widget\" style=\"float:left\">
        <a class=\"btn btn-text\" href=\"/restaurant/\"><i style=\"font-size: 1.2em;\" class=\"fas fa-tools\"></i>
        </a>
        </li>";
        echo "<li class=\"checkout-widget\" id=\"settingIcon\" style=\"float:left\">
        <a class=\"btn btn-text\" href=\"/restaurant/auth.php?logout\"><i style=\"font-size: 1.2em;\" class=\"fas fa-sign-out-alt\"></i>
        </a>
        </li>";}
        else{
            echo "<li class=\"checkout-widget\" style=\"float:left\">
        <a class=\"btn btn-text\" href=\"/restaurant/login.php\"><i style=\"font-size: 1.2em;\" class=\"fas fa-sign-in-alt\"></i>
        </a>
        </li>";
        }
 ?>
</li>
