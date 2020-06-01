<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/session.php");
$title = "Add dish - Eatkraken";

if(!restaurant_is_logged_in()) {
  header("Location: /");
  exit;
} 

if(isset($_POST["submit"])){

  $name = htmlentities($_POST["ProductName"]);
  $description = htmlentities($_POST["ProductDescription"]);
  $price = htmlentities($_POST["ProductPrice"]);
  $restaurant = restaurant_get_logged_id();
  $category = htmlentities($_POST["ProductCategory"]);
  $ingredients = htmlentities($_POST["ProductIngredients"]);
  $nutri_kcal = htmlentities($_POST["nutri_kcal"]);
  $nutri_carbs = htmlentities($_POST["nutri_carbs"]);
  $nutri_fats = htmlentities($_POST["nutri_fat"]);
  $nutri_proteins = htmlentities($_POST["nutri_protein"]);


  if(isset($_POST['glutenFree']) && $_POST['glutenFree'] == "true"){
    $flag_gluten_free = 'true';
  }
  else{
    $flag_gluten_free = 'false';
  }

  if(isset($_POST['lactoseFree']) && $_POST['lactoseFree'] == "true"){
    $flag_lactose_free = 'true';
  }
  else{
    $flag_lactose_free = 'false';
  }
  
  if(isset($_POST['vegan']) && $_POST['vegan'] == "true"){
    $flag_vegan = "true";
  }
  else{
    $flag_vegan = 'false';
  }

  if(isset($_POST['fresh']) && $_POST['fresh'] == "true"){
    $flag_fresh = 'true';
  }
else{
    $flag_fresh = 'false';
  }

  if(isset($_POST['zeroWaste']) && $_POST['zeroWaste'] == "true"){
    $flag_zero_waste = 'true';
  }
  else{
    $flag_zero_waste = 'false';
  }

  $image_url = htmlentities($_POST["imageUrl"]);
  $delivery_time = htmlentities($_POST["deliveryTime"]);


  $connection = new PDO($GLOBALS['db_pdo_data'], $GLOBALS['db_username'], $GLOBALS['db_password'], array(PDO::ATTR_PERSISTENT => true));

 
  $stmt = $connection->prepare(
    "insert into dishes (name, description, price, restaurant, category, ingredients, nutri_carbs, nutri_fats, nutri_kcal, nutri_proteins, flag_gluten_free, flag_lactose_free, flag_vegan, flag_fresh, flag_zero_waste, image_url, delivery_time) " .
   "VALUES (:name, :description, :price, :restaurant, :category, :ingredients, :nutri_carbs, :nutri_fats, :nutri_kcal, :nutri_proteins, :flag_gluten_free, :flag_lactose_free, :flag_vegan, :flag_fresh, :flag_zero_waste, :image_url, :delivery_time)"
  );

  $res = $stmt->execute([
  "name" => $name,
  "description" =>  $description,
  "price" =>  $price,
  "restaurant" =>  $restaurant,
  "category" =>  $category,
  "ingredients" =>  $ingredients,
  "nutri_carbs" =>  $nutri_carbs,
  "nutri_fats" =>  $nutri_fats,
  "nutri_kcal" =>  $nutri_kcal,
  "nutri_proteins" =>  $nutri_proteins,
  "flag_gluten_free" => $flag_gluten_free,
  "flag_lactose_free" =>  $flag_lactose_free,
  "flag_vegan" =>  $flag_vegan,
  "flag_fresh" =>  $flag_fresh,
  "flag_zero_waste" => $flag_zero_waste,
  "image_url" =>  $image_url,
  "delivery_time" =>  $delivery_time
  ]);

  //print_r($stmt->errorInfo());
  $connection = null;
  }
  
require_once($_SERVER['DOCUMENT_ROOT'] . "/views/admin/add-dish.php");

?>


