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

function db_get_dishes($city, $cat, $deadline, $flags) {
    $connection = new PDO($GLOBALS['db_pdo_data']);

    $time = $deadline - 0; // todo: "0" must be current timestamp
    
    $stmt = $connection->prepare(
        "select dishes.code, dishes.name, dishes.price, dishes.picture_url, dishes.restaurant as restaurant_id, restaurants.name as restaurant_name".
        " from dishes, restaurants, delivers_to".
        " where dishes.code = delivers_to.dish".
        " and delivers_to.city = :city".
        " and dishes.restaurant = restaurants.code".
        " and dishes.category = :cat".
        " and dishes.preparation_time < :time".
        // todo: flags "and dishes.flag_vegan = 1".
        "order by name asc");
    $stmt->execute(['city' => $city, 'cat' => $cat, 'time' => $time]);
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




?>