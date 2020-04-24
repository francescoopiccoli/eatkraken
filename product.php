<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/database.php");
// extract from DB -> https://phpdelusions.net/pdo#prepared


$product = db_get_product($productCode);

$title = "Order" . $product["name"] . "- EatKraken";
$product_name = $product["name"];
$product_desc = $product["description"];;
$product_price = $product["price"];
$product_allergenes = $product["allergenes"];
$product_ingredients = $product["ingredients"];
$product_nutri_carbs = $product["nutri_carbs"];
$product_nutri_fats = $product["nutri_fats"];
$product_nutri_kcal = $product["nutri_kcal"];
$product_nutri_proteins = $product["nutri_proteins"];
$product_flag_gluten_free = $product["flag_gluten_free"];
$product_flag_lactose_free = $product["flag_lactose_free"];
$product_flag_vegan = $product["flag_vegan"];
$product_flag_fresh = $product["flag_fresh"];
$product_flag_zero_waste = $product["flag_zero_waste"];
$product_image_url = $product["image_url"];






require_once($_SERVER['DOCUMENT_ROOT'] . "/templates/product.php");

?>