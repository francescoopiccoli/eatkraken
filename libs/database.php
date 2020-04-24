<?php

$GLOBALS['db_name'] = "yhqbrujn";
$GLOBALS['db_host'] = "balarama.db.elephantsql.com";
$GLOBALS['db_username'] = "yhqbrujn"; 
$GLOBALS['db_password'] = "vTdT4LC9LlOf_rgw6fA-Uz54Q-_xefB5";
$GLOBALS['db_pdo_data'] = "pgsql:host=".$GLOBALS['db_host']." port=5432 dbname=".$GLOBALS['db_name']." user=".$GLOBALS['db_username']." password=".$GLOBALS['db_password'];


/* demo only for simple static queries,
 * perform other queries directly from pages with similar syntax
 */

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
    $cities = db_simple_query("select * from cities");
    return $cities;
}

function db_get_categories() {
    return array(
        array("id" => 5, "name" => "Asian"),
        array("id" => 6, "name" => "Asian > Chinese"),
        array("id" => 7, "name" => "Asian > Sushi"),
        array("id" => 1, "name" => "Buns"),
        array("id" => 2, "name" => "Buns > Burgers"),
        array("id" => 3, "name" => "Buns > Kebab"),
        array("id" => 8, "name" => "Pizza"),
      );
}

function db_get_dishes($city, $cat, $deadline, $flags) {
    return array(
        array(
          "id" => 123,
          "name" => "Pizza Margherita",
          "price" => 15,
          "picture_url" => "https://cdn-media.italiani.it/site-caserta/2019/01/pizza-con-ananas-caserta-2.jpg",
          "restaurant_id" => 1,
          "restaurant_name" => "Pizzeria Scarsa SNC"
        ),
      
        array(
          "id" => 234,
          "name" => "Durum Kebab",
          "price" => 7,
          "picture_url" => "https://tourismembassy.com/media/multimedia/images/45e1696726edab87cfec4dae6049d63e.jpg",
          "restaurant_id" => 2,
          "restaurant_name" => "KeBZ"
        )
      );
}




?>