<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/session.php");


$cities = db_get_cities();
$categories = db_get_categories();

$options = array(
  array("code" => 1, "name" => "Fresh"),
  array("code" => 2, "name" => "Gluten-free"),
  array("code" => 3, "name" => "Lactose-free"),
  array("code" => 4, "name" => "Vegan"),
  array("code" => 5, "name" => "Zero-waste"),
);

$categories = db_get_categories();

$selectedCity = (isset($_GET['city']) ? $_GET['city'] : "");
$selectedCategory = (isset($_GET['category']) ? $_GET['category'] : "");
$deliveryTime = (isset($_GET['time']) && $_GET['time'] > 0 ? $_GET['time'] : "");
$selectedFlags = array();

foreach($_GET as $name => $v) {
  if(substr($name,0,4) == "opt_")
    array_push($selectedFlags, substr($name,4));
}

$results = db_get_dishes($_GET['city'], $_GET['category'], $_GET['time'], $selectedFlags);

$title = "All products";

require_once($_SERVER['DOCUMENT_ROOT'] . "/views/list.php");

?>