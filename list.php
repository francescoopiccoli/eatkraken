<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/database.php");


$cities = db_get_cities();
$categories = db_get_categories();

$options = array(
  array("id" => 1, "name" => "Fresh"),
  array("id" => 2, "name" => "Gluten-free"),
  array("id" => 3, "name" => "Lactose-free"),
  array("id" => 4, "name" => "Vegan"),
  array("id" => 5, "name" => "Zero-waste"),
);

$categories = db_get_categories();


$results = db_get_dishes($city, $cat, $deadline, $flags);

$title = "All products";



require_once($_SERVER['DOCUMENT_ROOT'] . "/templates/list.php");

?>