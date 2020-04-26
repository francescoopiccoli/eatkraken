<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/session.php");

$cart = cart_get_items();

if(is_logged_in()) {
?>
<li>
    <a class="btn btn-danger" href="/restaurant/logout.php">Log out</a>
</li>

<?php
} else {
?>

<li class="navbar-text checkout-widget">
    <?php if(count($cart) == 0) { ?>
        Your cart is empty
    <?php } else { ?>
    <?= count($cart); ?> items, <?= cart_get_total(); ?>€
</li>
<li class="checkout-widget">
    <a href="/checkout.php" class="btn btn-default btn-checkout"><i class="fas fa-shopping-cart"></i></a>
    <?php } ?>
</li>

<?php
}
?>