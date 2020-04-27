<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/session.php");

$title = "Checkout - EatKraken";

// possible GET actions:
// ?confirm
// ?dish={ID}&remove
// ?dish={ID}&confirm_add (if there are any allergene warnings) -> don't implement yet
// ?restaurant={ID}&set_shipping={MODE}
// ?restaurant={ID}&set_message={X}
// ?set_address={X}
// ?set_phone={X}
// ?set_email={X}

if(isset($_GET['confirm'])) {
    // 1. check phone & email -> failure: show warning msg-danger and go on
    // however address is not mandatory, e.g. if user takes away or eats in
    if(cart_get_phone() == "" || cart_get_email() == "") {
        echo '<script>alert("Valid e-mail and phone number must be specified");</script>';
    } else {
        // 2. insert into DB each order
        $orders = cart_get_orders();
        foreach($orders as $restaurant => $items) {
            $code = db_insert_empty_order($restaurant, "TODO", cart_get_address(), cart_get_email(), 1, cart_get_phone(), cart_get_restaurant_shipping($restaurant), cart_get_total(), $delivery_time);
            foreach($items as $item) {
                // todo: group multiple items as one via the quantity param
                //  db_insert_new_order_item($code, $item['id'], $item['price']);

	            db_add_order_item($code, $item['id'], 1, cart_get_restaurant_message($restaurant));
            }
        }

        // 3. send confirm email
        mail(cart_get_email(), "Your EatKraken order has been placed","TODO");

        // 4. clean-up cart
        cart_empty();

        // 5. show msg-..., redirect to homepage after 10 seconds
        header("refresh:10; url=/");
        die('<script>alert("Your order has been sent!\\nYou will receive a confirmation e-mail shortly");</script>');
    }
}

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
if(isset($_GET['set_phone'])) {
    cart_set_phone($_GET['set_phone']);
}
if(isset($_GET['set_email'])) {
    cart_set_email($_GET['set_email']);
}

$orders = cart_get_orders();
require_once($_SERVER['DOCUMENT_ROOT'] . "/templates/checkout.php");

?>