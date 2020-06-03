<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/session.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/simple_email.php");

$title = "Checkout - EatKraken";

// possible POST actions:
// ?confirm
// ?dish={ID}&remove
// ?dish={ID}&confirm_add (if there are any allergene warnings) -> don't implement yet
// ?restaurant={ID}&set_shipping={MODE}
// ?restaurant={ID}&set_message={X}
// ?set_full_name={X}
// ?set_address={X}
// ?set_phone={X}
// ?set_email={X}
// ?set_city={X}

if(isset($_POST['confirm'])) {
    // 1. check phone & email -> failure: show warning msg-danger and go on
    // however address is not mandatory, e.g. if user takes away or eats in
    if(cart_get_phone() == "" || cart_get_email() == "" || cart_get_full_name() == "") {
        echo '<script>alert("Valid full name, e-mail and phone number must be specified");</script>';
        header("refresh:0; url=/checkout.php");
        exit;

    } elseif(count(cart_get_items()) == 0) {
        echo '<script>alert("Cart is empty!");</script>';
        header("refresh:0; url=/");
        exit;
    } else {
        // 2. insert into DB each order
        $orders = cart_get_orders();
        $codes = array();
        foreach($orders as $restaurant => $items) {
            // ignore if can't be delivered
            if(cart_get_restaurant_shipping($restaurant) != 2 || db_restaurant_can_deliver($restaurant, cart_get_city())) {
                $delivery_time = 0;
                // delivery time of order is set to max. of all items
                foreach($items as $item) {
                    $t = db_get_product_delivery_time($item['code']);
                    if($t > $delivery_time)
                        $delivery_time = $t;
                }

                $code = db_insert_empty_order(
                    $restaurant, 
                    cart_get_full_name(), 
                    cart_get_address(), 
                    cart_get_email(), 
                    cart_get_city(), 
                    cart_get_phone(), 
                    cart_get_restaurant_shipping($restaurant), 
                    cart_get_restaurant_total($restaurant), 
                    $delivery_time
                );

                // simple algorithm for duplicate elimination & calc. quantity of each item item
                $items_multi = array();
                foreach($items as $item) {
                    $found = false;
                    foreach ($items_multi as $k => $item_new) {
                        if($item['code'] == $item_new['code']) {
                            $found = true;
                            $item_new['quantity'] += 1;
                            $items_multi[$k] = $item_new; // necessary step because $item_new is passed by value, not ref.
                            break;
                        }
                    }
                    if(!$found)
                        array_push($items_multi, 
                            array("code" => $item["code"], "restaurant" => $item["restaurant"],
                                  "price" => $item["price"], "quantity" => 1)
                        );
                }
                
                if($code) {
                    array_push($codes, $code);
                    
                    foreach($items_multi as $item) { // we are NOT passing "items" directly -> see line 59
                        db_add_order_item($code, $item['code'], $item['quantity'], cart_get_restaurant_message($restaurant));
                    }
                } else {
                    die("DB error");
                }
            } elseif (cart_get_restaurant_shipping($restaurant) == 2 && !db_restaurant_can_deliver($restaurant, cart_get_city())) {
                // if delivery to specified city is not possible, show a warning and proceed
                echo '<script>alert("Restaurant '. db_get_restaurant_name($restaurant) .' can\'t be delivered to your city, order will be ignored");</script>';
            }
        }

        // 3. send confirm email
        simple_email(cart_get_email(), "Your EatKraken order has been placed","We will inform you once it gets approved by the restaurant.");

        // 4. clean-up cart
        cart_empty();

        // 5. show msg-..., redirect to homepage after 10 seconds
        header("refresh:0; url=/");
        die('<script>alert("Your order has been sent!\\nYou will receive a confirmation e-mail shortly");</script>');
    }
}

if(isset($_POST['dish'])) {
    if(isset($_POST['remove'])) {
        cart_rm_first($_POST['dish']);
    }
}

if(isset($_POST['restaurant'])) {
    if(isset($_POST['set_shipping'])) {
        cart_set_restaurant_shipping($_POST['restaurant'], $_POST['set_shipping']);
    }
    if(isset($_POST['set_message'])) {
        cart_set_restaurant_message($_POST['restaurant'], $_POST['set_message']);
    }
}
if(isset($_POST['set_address'])) {
    cart_set_address($_POST['set_address']);
}
if(isset($_POST['set_full_name'])) {
    cart_set_full_name($_POST['set_full_name']);
}
if(isset($_POST['set_phone'])) {
    cart_set_phone($_POST['set_phone']);
}
if(isset($_POST['set_email'])) {
    cart_set_email($_POST['set_email']);
}
if(isset($_POST['set_city'])) {
    cart_set_city($_POST['set_city']);
}

$cart_orders = cart_get_orders();
$cart_items = cart_get_items();

$cart_name = (cart_get_full_name() != "" ? cart_get_full_name() : "Enter Full Name");
$cart_addr = cart_get_address();
$cart_email = (cart_get_email() == "" ? "No email specified" : cart_get_email());
$cart_phone = (cart_get_phone() == "" ? "No phone specified" : cart_get_phone());
$cart_city = (db_get_city_name(cart_get_city()) == "" ? "No city specified" : db_get_city_name(cart_get_city()));
$cities = db_get_cities();

$cart_item_total = cart_get_total();
$cart_shipping_total = cart_get_shipping_total();
$cart_total = $cart_item_total + $cart_shipping_total;

require_once($_SERVER['DOCUMENT_ROOT'] . "/views/checkout.php");

?>
