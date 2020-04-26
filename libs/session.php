<?php
/* Simple library for session-related functions */

session_start();

function cart_get_items() {
    if(!isset($_SESSION['cart']))
        return array();
    else
        return $_SESSION['cart'];
}
function cart_add_item($id) {
    $price = db_get_item_price($id);
    if($price <= 0)
        return false; // invalid item

    // store price for better DB performance and to avoid final price to be different from when the user added it
    if(!isset($_SESSION['cart']))
        $_SESSION['cart'] = array(
            array("id" => $id, "price" => $price)
        );
    else
        array_push($_SESSION['cart'], array("id" => $id, "price" => $price));
    
    return true;
}
function cart_get_total() {
    $total = 0;
    if(isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $total += $item["price"];
        }
    }
    return $total;
}

// Restaurant login -- todo!
function log_in($token) {
    $restaurant_id = db_get_restaurant_by_token($token);
    if($restaurant_id > 0) {
        $_SESSION['restaurant_id'] = $restaurant_id;
        return true;
    } else {
        return false;
    }
}
function is_logged_in() {
    return isset($_SESSION['restaurant_id']);
}

function logout() {
    if(isset($_SESSION['restaurant_id']))
        unset($_SESSION['restaurant_id']);
}

?>