<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/shipping_methods.php");

/* Simple library for database-related functions */

$GLOBALS['db_name'] = "yhqbrujn";
$GLOBALS['db_host'] = "balarama.db.elephantsql.com";
$GLOBALS['db_username'] = "yhqbrujn"; 
$GLOBALS['db_password'] = "vTdT4LC9LlOf_rgw6fA-Uz54Q-_xefB5";
$GLOBALS['db_pdo_data'] = "pgsql:host=".$GLOBALS['db_host']." port=5432 dbname=".$GLOBALS['db_name']." user=".$GLOBALS['db_username']." password=".$GLOBALS['db_password'];

date_default_timezone_set('Europe/Rome');

// indices: simple_query(...)[row][column]
function db_simple_query($query_text) {
    $connection = new PDO($GLOBALS['db_pdo_data'], $GLOBALS['db_username'], $GLOBALS['db_password'], array(PDO::ATTR_PERSISTENT => true));
    try {
        if($query = $connection->query($query_text)) 
            return $query->fetchAll();
        else
            return false;
    } catch (Exception $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
    $connection = null;
}
function db_stmt_query($query_text, $params) {
    $connection = new PDO($GLOBALS['db_pdo_data'], $GLOBALS['db_username'], $GLOBALS['db_password'], array(PDO::ATTR_PERSISTENT => true));
    
    $stmt = $connection->prepare($query_text);
    $stmt->execute($params);
    $res = $stmt->fetchAll();
    $connection = null;

    if($res)
        return $res;
    else
        return false;
}


function db_get_cities() {
    return db_simple_query("select * from cities");
}
function db_get_city_name($code) {
    $city = db_stmt_query("select name from cities where code = ?", [$code]);
    if($city && count($city) > 0) 
        return $city[0][0];
    else
        return "";
}

function db_get_categories() {
    return db_simple_query("select * from categories order by name asc");
}

function db_get_cost_home_delivery($restaurant){
	return db_stmt_query("select cost_home_delivery from restaurants where code=?",[$restaurant])[0][0];
}

function db_get_cost_takeaway($restaurant){
	return db_stmt_query("select shipping_cost from restaurants where code=?",[$restaurant])[0][0];
}

function db_get_cost_eat_in($restaurant){
	return db_stmt_query("select cost_eat_in from restaurants where code=?",[$restaurant])[0][0];
}

function db_get_item_price($code) {
    $price = db_stmt_query("select price from dishes where code = ?", [$code]);
    if($price && count($price) > 0) 
        return $price[0]['price'];
    else
        return -1;
}
function db_get_items_cost($order){
	return db_stmt_query("SELECT sum(price) FROM dishes, order_items WHERE order_items.ord=? and dishes.code=order_items.item;", [$order]);
}

function db_get_shipping_cost($restaurant, $method) {
    // 1. is $method supported? no -> -1 in db
    switch ($method) {
        case 0:
            return db_get_cost_eat_in($restaurant);
            break;
        case 1:
            return db_get_cost_takeaway($restaurant);
            break;
        case 2:
            return db_get_cost_home_delivery($restaurant);
            break;
        default:
            return -1;
    }
    // 2. yes -> return cost for chosen method
    return 0;
}

function db_get_shipping_methods($restaurant) {
    $methods = array();
    foreach (shipping_methods() as $id => $item) {
        $cost = db_get_shipping_cost($restaurant, $id);
        if($cost >= 0)
            array_push($methods, array(
                "id" => $id,
                "name" => $item['name'],
                "cost" => $cost
            ));
    }
    return $methods;
}

function db_get_dishes($city, $cat, $time, $flags) {
    // must be consistent with one in list.php
    $supportedFlags = array(
        array('code' => 1, 'name' => "fresh"),
        array('code' => 2, 'name' => "gluten_free"),
        array('code' => 3, 'name' => "lactose_free"),
        array('code' => 4, 'name' => "vegan"),
        array('code' => 5, 'name' => "zero_waste"),
    );
    $flagsText = "";
    foreach($supportedFlags as $flag) {
        if(in_array($flag['code'], $flags))
            $flagsText .= " and dishes.flag_".$flag['name']. " = true";
    }

    $connection = new PDO($GLOBALS['db_pdo_data'], $GLOBALS['db_username'], $GLOBALS['db_password'], array(PDO::ATTR_PERSISTENT => true));
    
    $stmt = $connection->prepare(
        "select dishes.code, dishes.name, dishes.price, dishes.image_url, dishes.restaurant as restaurant_id, restaurants.name as restaurant_name".
        " from dishes, restaurants, delivers_to".
        " where restaurants.code = delivers_to.restaurant".
        " and delivers_to.city = :city".
        " and dishes.restaurant = restaurants.code".
        ($cat > 0 ? " and dishes.category = :cat" : "").
        ($time > 0 ? " and dishes.delivery_time < :time" : "").
        $flagsText . 
        " order by name asc");

    $options = ['city' => $city];
    if($cat > 0) $options['cat'] = $cat;
    if($time > 0) $options['time'] = $time;
    $stmt->execute($options);
    $res = $stmt->fetchAll();
    $connection = null;
    return $res;
}


function db_get_product($code){
    $product = db_stmt_query("select * from dishes where code = ?",[$code]);
    if(count($product) > 0)
        return $product[0];
    else
        return false;
}
function db_get_product_delivery_time($code){
    $product = db_stmt_query("select delivery_time from dishes where code = ?", [$code]);
    if(count($product) > 0)
        return $product[0][0];
    else
        return false;
}

function db_get_order($code){
    $order = db_stmt_query("select * from orders where code = ?",[$code]);
    if(count($order) > 0)
        return $order[0];
    else
        return false;
}

/*make orders*/
function db_insert_empty_order($restaurant, $full_name, $address, $email, $city, $phone, $shipping_type, $items_cost, $delivery_time){
    $delivery_deadline = time() + $delivery_time * 60; // starting from when order is placed
    //die($delivery_time . " " . date("Y-m-d H:i:s", time()) . " " . date("Y-m-d H:i:s", $delivery_deadline));
    $shipping_cost = db_get_shipping_cost($restaurant, $shipping_type);
	$total_cost = $items_cost + $shipping_cost;

    $connection = new PDO($GLOBALS['db_pdo_data'], $GLOBALS['db_username'], $GLOBALS['db_password'], array(PDO::ATTR_PERSISTENT => true));

    $stmt = $connection->prepare(
        "insert into orders (restaurant, full_name, address, email, city, phone, shipping_type, shipping_cost, total_cost, delivery_deadline, status) ".
        "values (:restaurant, :full_name, :address, :email, :city, :phone, :shipping_type, :shipping_cost, :total_cost, :delivery_deadline, 0)"
    );
    
    $res = $stmt->execute([
        "restaurant" => $restaurant, 
        "full_name" => $full_name, 
        "address" => $address, 
        "email" => $email, 
        "city" => $city, 
        "phone" => $phone, 
        "shipping_type" => $shipping_type, 
        "shipping_cost" => $shipping_cost, 
        "total_cost" => $total_cost, 
        "delivery_deadline" => date("Y-m-d H:i:s", $delivery_deadline) // https://stackoverflow.com/questions/2374631/pdoparam-for-dates
    ]);
    if(!$res)
        print_r($stmt->errorInfo());

    $connection = null;
    if($res)
        return db_get_last_order_code();
    else
        return false;
    
}

function db_get_last_order_code(){
    $res = db_simple_query("SELECT MAX(code) FROM orders");
    if($res && count($res) > 0)
        return $res[0][0];
    else
        return false;
}

function db_add_order_item($order, $item,$quantity,$note){
    return db_stmt_query(
        "insert into order_items (code, ord, item, quantity, notes) values (default, ?, ?, ?, ?);",
        [$order, $item, $quantity, $note]
    );
}

function db_get_restaurant_by_token($token) {
    $res = db_stmt_query("select code from restaurants where access_token = ?", [$token]);
    if($res && count($res) > 0)
        return $res[0]['code'];
    else
        return false;
}
function db_get_restaurant_name($id) {
    $res = db_stmt_query("select name from restaurants where code = ?", [$id]);
    if($res && count($res) > 0)
        return $res[0]['name'];
    else
        return false;
}

function db_get_restaurant_contact($id) {
    $res = db_stmt_query("select contact from restaurants where code = ?", [$id]);
    if($res && count($res) > 0)
        return $res[0]['contact'];
    else
        return false;
}

function db_restaurant_can_deliver($restaurant, $city) {
    $count = db_stmt_query("select count(*) from delivers_to where restaurant = ? and city = ?", [$restaurant, $city])[0][0];
    if($count > 0)
        return true;
    else
        return false;
}

function db_get_restaurant_description($id) {
    $res = db_stmt_query("select description from restaurants where code = ?", [$id]);
    if($res && count($res) > 0)
        return $res[0]['description'];
    else
        return false;
}

function db_get_restaurant_image_url($id) {
    $res = db_stmt_query("select image_url from restaurants where code = ?", [$id]);
    if($res && count($res) > 0)
        return $res[0]['image_url'];
    else
        return false;
}

//manage-dish.php
function db_get_restaurant_dishes($code){
    return db_stmt_query("select code, name, price, image_url from dishes where restaurant = ?", [$code]);
}

//orders.php
function db_get_deadline($orderID){
    return db_stmt_query("select delivery_deadline from orders where code = ?", [$orderID]);
}


function db_get_pending_orders($code){
    return db_stmt_query("select * from orders where restaurant = ? and delivery_deadline > (SELECT now() AT TIME ZONE 'Europe/Rome') and status = 0 order by delivery_deadline asc", [$code]);
}

function db_get_accepted_orders($code){
    return db_stmt_query("select * from orders where restaurant = ? and delivery_deadline > (SELECT now() AT TIME ZONE 'Europe/Rome') and status = 1 order by delivery_deadline asc", [$code]);
}
function db_get_past_orders($code){
    return db_stmt_query("select * from orders where restaurant = ? and (delivery_deadline < (SELECT now() AT TIME ZONE 'Europe/Rome') or status = 2) order by delivery_deadline desc", [$code]);
}

function db_get_delivery_costs($code){
    $res = db_stmt_query("select cost_eat_in, cost_takeaway, cost_home_delivery from restaurants where code = ?", [$code]);
    if($res && count($res) > 0)
        return $res[0];
    else
        return false;
}

function db_get_orders_items($code){
    return db_stmt_query("select * from order_items where ord = ?", [$code]);
}


function db_get_dish($code){
    return db_stmt_query("select name, price from dishes where code = ?", [$code]);
}

function db_get_city($cityID){
    return db_stmt_query("select name from cities where code = ?", [$cityID]);
}
  
?>
