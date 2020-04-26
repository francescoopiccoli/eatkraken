<?php
/* Simple library for session-related functions */

require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/database.php");

session_start();

function cart_get_items() {
    if(!isset($_SESSION['cart']))
        return array();
    else
        return $_SESSION['cart'];
}

function cart_get_orders() {
    $items = cart_get_items();
    $orders = array();

    foreach($items as $item) {
        $restaurant = $item['restaurant'];
        $newItem = true;
        foreach ($orders as $rName => $rItems) {
            if($rName == $restaurant) {
                $newItem = false;
                array_push($orders[$rName], $item);
            }
        }
        if($newItem) {
            $orders[$restaurant] = array($item);
        }
    }
    return $orders;
}
function cart_add_item($id) {
    $product = db_get_product($id);
    if(!$product) return false;

    $price = $product['price'];
    $restaurant = $product['restaurant'];

    if($price < 0) return false; // invalid item

    // store price for better DB performance and to avoid final price to be different from when the user added it
    if(!isset($_SESSION['cart']))
        $_SESSION['cart'] = array(
            array(
                "id" => $id,
                "restaurant" => $restaurant,
                "price" => $price
            )
        );
    else
        array_push($_SESSION['cart'], array("id" => $id, "restaurant" => $restaurant, "price" => $price));
    
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
function restaurant_log_in($token) {
    $restaurant_id = db_get_restaurant_by_token($token);
    if($restaurant_id > 0) {
        $_SESSION['restaurant_id'] = $restaurant_id;
        return true;
    } else {
        return false;
    }
}
function restaurant_is_logged_in() {
    return isset($_SESSION['restaurant_id']);
}
function restaurant_get_logged_id() {
    if(!restaurant_is_logged_in())
        return -1;
    else
        return $_SESSION['restaurant_id'];
}

function restaurant_log_out() {
    if(isset($_SESSION['restaurant_id']))
        unset($_SESSION['restaurant_id']);
}

?>