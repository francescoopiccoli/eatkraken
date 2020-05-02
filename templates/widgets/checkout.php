<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/session.php");

$cart = cart_get_items();

if($isCheckoutPage) {
?>
<li>
    <!--<a href="checkout.php?confirm" class="btn btn-success">Confirm order</a>-->
</li>
<?php
} else {
    if(restaurant_is_logged_in()) {
?>
<li>
    <a class="btn btn-text" href="/restaurant/auth.php?logout">logout</a>
</li>
<li>
</li>

<?php
}
?>

<?php if(count($cart) > 0) { ?>
<li class="navbar-text checkout-widget">
    <?= count($cart); ?> items, <?= cart_get_total(); ?>€
</li>
<?php } ?>
<li class="checkout-widget">
    <a href="/checkout.php" class="btn-checkout"><i class="fas fa-shopping-cart"></i></a>
    <?php } ?>
</li>