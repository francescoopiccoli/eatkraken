<?php

/* Simple library for database-related functions */

$GLOBALS['db_name'] = "yhqbrujn";
$GLOBALS['db_host'] = "balarama.db.elephantsql.com";
$GLOBALS['db_username'] = "yhqbrujn"; 
$GLOBALS['db_password'] = "vTdT4LC9LlOf_rgw6fA-Uz54Q-_xefB5";
$GLOBALS['db_pdo_data'] = "pgsql:host=".$GLOBALS['db_host']." port=5432 dbname=".$GLOBALS['db_name']." user=".$GLOBALS['db_username']." password=".$GLOBALS['db_password'];

// indices: simple_query(...)[row][column]
function db_simple_query($query_text) {
    $connection = new PDO($GLOBALS['db_pdo_data']);
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
    $connection = new PDO($GLOBALS['db_pdo_data']);
    
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

function db_get_categories() {
    return db_simple_query("select * from categories order by name asc");
}

function db_get_cost_home_delivery($restaurant){
	return db_simple_query("select cost_home_delivery from restaurants where code=$restaurant");
}

function db_get_cost_takeaway($restaurant){
	return db_simple_query("select shipping_cost from restaurants where code=$restaurant");
}

function db_get_cost_eat_in($restaurant){
	return db_simple_query("select cost_eat_in from restaurants where code=$restaurant");
}

function db_get_item_price($code) {
    $price = db_stmt_query("select price from dishes where code = ?", [$code]);
    if($price && count($price) > 0) 
        return $price[0]['price'];
    else
        return -1;
}
function db_get_items_cost($order){
	return db_simple_query("SELECT sum(price) FROM dishes, order_items WHERE order_items.ord=$order and dishes.code=order_items.item;");
}

function db_get_shipping_cost($order){
	switch ($shipping_type) {
	case 0:
		$shipping_cost = db_get_cost_eat_in();
		break;
	case 1:
		$shipping_cost = db_get_cost_takeaway();
		break;
	case 2:
		$shipping_cost = db_get_cost_home_delivery();
		break;
	}
	return $shipping_cost;
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

    $connection = new PDO($GLOBALS['db_pdo_data']);
    
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


function db_get_product($productCode){
    $product = db_simple_query("select * from dishes where code = $productCode");
    if(count($product) > 0)
        return $product[0];
    else
        return false;
}

/*make orders*/
function db_new_order($restaurant, $full_name, $address, $city, $phone, $shipping_type, $delivery_deadline, $status){

	$total_cost = db_get_items_cost($order)+db_get_shipping_cost($order);
	$shipping_cost=db_get_shipping_cost($order);

	db_simple_query("insert into orders (code, restaurant, full_name, address, city, phone, shipping_type, shipping_cost, total_cost, delivery_deadline, status) values (default, $restaurant, $full_name, $address, $city, $phone, $shipping_type, $shipping_cost, $total_cost, $delivery_deadline, $status);");

	$order = db_get_last_order_code();
	return db_new_order_items($item,$order,$quantity,$note);
}

function db_get_last_order_code(){
	return db_simple_query("SELECT MAX(code) AS lastOrderCode FROM order;");
}

function db_new_order_items($item,$order,$quantity,$note){
	return db_simple_query("insert into order_items (code, ord, item, quantity, note) values (default, $order, $itemCode, $quantity, $note);");
}

function db_get_restaurant_by_token($token) {
    $res = db_stmt_query("select code from restaurants where access_token = ?", [$token]);
    if(count($res) > 0)
        return $res[0]['code'];
    else
        return false;
}
function db_get_restaurant_name($id) {
    $res = db_stmt_query("select name from restaurants where code = ?", [$id]);
    if(count($res) > 0)
        return $res[0]['name'];
    else
        return false;
}

function db_get_restaurant_description($id) {
    $res = db_stmt_query("select description from restaurants where code = ?", [$id]);
    if(count($res) > 0)
        return $res[0]['description'];
    else
        return false;
}

?>
