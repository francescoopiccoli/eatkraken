<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/database.php");


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


$results = db_get_dishes($_GET['city'], $_GET['category'], $_GET['deadline'], 0);

$title = "All products";



require_once($_SERVER['DOCUMENT_ROOT'] . "/templates/list.php");

?>