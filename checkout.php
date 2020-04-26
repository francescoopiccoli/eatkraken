<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/session.php");

$orders = cart_get_orders();

$title = "Checkout - EatKraken";

require_once($_SERVER['DOCUMENT_ROOT'] . "/templates/checkout.php");

?>