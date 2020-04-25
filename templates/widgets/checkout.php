<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/session.php");

if(is_logged_in()) {
?>
<li>
    <a class="btn btn-danger" href="/restaurant/logout.php">Log out</a>
</li>

<?php
} else {
?>

<li class="navbar-text checkout-widget">
    5 items, €50
</li>
<li class="checkout-widget">
    <a href="/checkout.php"><i class="fas fa-shopping-cart"></i></a>
</li>

<?php
}
?>