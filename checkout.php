<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/session.php");

$title = "Checkout - EatKraken";

// possible GET actions:
// ?confirm
// ?dish={ID}&remove
// ?dish={ID}&confirm_add (if there are any allergene warnings) -> don't implement yet
// ?restaurant={ID}&set_shipping={MODE}
// ?restaurant={ID}&set_message={MODE}
// ?set_address={MODE}


if(isset($_GET['dish'])) {
    if(isset($_GET['remove'])) {
        cart_rm_first($_GET['dish']);
    }
}

if(isset($_GET['restaurant'])) {
    if(isset($_GET['set_shipping'])) {
        cart_set_restaurant_shipping($_GET['restaurant'], $_GET['set_shipping']);
    }
    if(isset($_GET['set_message'])) {
        cart_set_restaurant_message($_GET['restaurant'], $_GET['set_message']);
    }
}
if(isset($_GET['set_address'])) {
    cart_set_address($_GET['set_address']);
}

$orders = cart_get_orders();
require_once($_SERVER['DOCUMENT_ROOT'] . "/templates/checkout.php");

?>