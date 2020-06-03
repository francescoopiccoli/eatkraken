<?php
/* simple AJAX page for adding an item to cart */

require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/session.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/database.php");


if(isset($_POST['code'])) {
    if(cart_add_item($_POST['code']))
        die("ok");
} 

die("error");
?>
