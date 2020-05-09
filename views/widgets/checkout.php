<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/session.php");
$cart = cart_get_items();

?>




<li class="checkout-widget"><a href="/checkout.php" class="btn-checkout">

<?php if(count($cart) > 0) { ?>
<span style="font-family:'acme'; font-size: 1.2em; text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black"><?= count($cart); ?>x </span>
<?php } ?>

<i id="cart" class="fas fa-shopping-cart" style="font-size: 1.1em; text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black"></i></a>
    <?php 
    if(restaurant_is_logged_in()) {
        echo "<li class=\"checkout-widget\" style=\"float:left\">
        <a class=\"btn btn-text\" href=\"/restaurant/auth.php?logout\"><i style=\"font-size: 1.2em; text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black\" class=\"fas fa-sign-out-alt\"></i>
        </a>
        </li>";}
 ?>
</li>