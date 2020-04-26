<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/session.php");

$orders = cart_get_orders();

$title = "Checkout - EatKraken";

// possible GET actions:
// ?confirm
// ?dish={ID}&remove
// ?dish={ID}&confirm_add (if there are any allergene warnings)
// ?restaurant={ID}&set_shipping={MODE}
// ?restaurant={ID}&set_message={MODE}

require_once($_SERVER['DOCUMENT_ROOT'] . "/templates/checkout.php");

?>