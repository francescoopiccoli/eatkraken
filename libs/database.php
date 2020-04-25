<?php

$GLOBALS['db_name'] = "yhqbrujn";
$GLOBALS['db_host'] = "balarama.db.elephantsql.com";
$GLOBALS['db_username'] = "yhqbrujn"; 
$GLOBALS['db_password'] = "vTdT4LC9LlOf_rgw6fA-Uz54Q-_xefB5";
$GLOBALS['db_pdo_data'] = "pgsql:host=".$GLOBALS['db_host']." port=5432 dbname=".$GLOBALS['db_name']." user=".$GLOBALS['db_username']." password=".$GLOBALS['db_password'];


/* demo for simple static queries */

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

function db_get_items_cost($order){
	return db_simple_query("SELECT COUNT(order_item)FROM table_name WHERE condition;");
}

function db_get_dishes($city, $cat, $deadline, $flags) {
    $connection = new PDO($GLOBALS['db_pdo_data']);

    $time = $deadline - 0; // todo: "0" must be current timestamp, $deadline desired timestamp
    
    $stmt = $connection->prepare(
        "select dishes.code, dishes.name, dishes.price, dishes.image_url, dishes.restaurant as restaurant_id, restaurants.name as restaurant_name".
        " from dishes, restaurants, delivers_to".
        " where restaurants.code = delivers_to.restaurant".
        " and delivers_to.city = :city".
        " and dishes.restaurant = restaurants.code".
        ($cat > 0 ? " and dishes.category = :cat" : "").
        ($deadline > 0 ? " and dishes.preparation_time < :time" : "").
        // todo: flags e.g. "and dishes.flag_vegan = 1".
        " order by name asc");
        
    $options = ['city' => $city];
    if($cat > 0) $options['cat'] = $cat;
    if($deadline > 0) $options['time'] = $time;
    $stmt->execute($options);
    $res = $stmt->fetchAll();
    $connection = null;
    return $res;

    /*return array(
        array(
          "code" => 123,
          "name" => "Pizza Margherita",
          "price" => 15,
          "picture_url" => "https://cdn-media.italiani.it/site-caserta/2019/01/pizza-con-ananas-caserta-2.jpg",
          "restaurant_id" => 1,
          "restaurant_name" => "Pizzeria Scarsa SNC"
        ),
      
        array(
          "code" => 234,
          "name" => "Durum Kebab",
          "price" => 7,
          "picture_url" => "https://tourismembassy.com/media/multimedia/images/45e1696726edab87cfec4dae6049d63e.jpg",
          "restaurant_id" => 2,
          "restaurant_name" => "KeBZ"
        )
      );*()*/
}


function db_get_product($productCode){
    $product = db_simple_query("select * from dishes where code = $productCode");
    if(count($product) > 0)
        return $product[0];
    else
        return false;
}

/*make orders*/
function db_new_order($restaurant, $full_name, $address, $city, $phone, $shipping_type, $shipping_cost, $total_cost, $delivery_deadline, $status){
  
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

	db_simple_query("insert into orders (code, restaurant, full_name, address, city, phone, shipping_type, shipping_cost, total_cost, delivery_deadline, status) 
				values (default, $restaurant, $full_name, $address, $city, $phone, $shipping_type, $shipping_cost, $total_cost, $delivery_deadline, $status);");

	$order = db_get_last_order_code();
	db_new_order_items($item,$order,$quantity,$note);
}

function db_get_last_order_code(){
	return db_simple_query("SELECT MAX(code) AS lastOrderCode FROM order;");
}

function db_new_order_items($item,$order,$quantity,$note){
	db_simple_query("insert into order_items (code, ord, item, quantity, note) values (default, $order, $itemCode, $quantity, $note);");
}

?>
