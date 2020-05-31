<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/session.php");
$cart = cart_get_items();

?>




<li class="checkout-widget">
    <a href="/checkout.php" class="btn-checkout">
        <span id="checkout-items">
            <?php if(count($cart) > 0) echo count($cart); ?>
        </span>
        <span id="checkout-x" <?php if(count($cart) == 0) echo 'style="display: none;"' ?>>
            x&nbsp;&nbsp;
        </span>
        <i id="cart" title="cart" class="fas fa-shopping-cart widgetDimension"></i>
    </a>
</li>

<?php 
if(restaurant_is_logged_in()) {
    echo "<li class=\"checkout-widget settingIcon\">
    <a title=\"manage\" class=\"btn btn-text\" href=\"/restaurant/\"><i class=\"fas fa-tools fontAwesomeLogos\"></i>
    </a>
    </li>";
    echo "<li class=\"checkout-widget settingIcon\">
    <a title=\"log out\" class=\"btn btn-text\" href=\"/restaurant/auth.php?logout\"><i class=\"fas fa-sign-out-alt fontAwesomeLogos\"></i>
    </a>
    </li>";}
    else{
        echo "<li class=\"checkout-widget\">
    <a title=\"sign in\" class=\"btn btn-text\" href=\"/restaurant/login.php\"><i class=\"fas fa-sign-in-alt fontAwesomeLogos\"></i>
    </a>
    </li>";
} ?>