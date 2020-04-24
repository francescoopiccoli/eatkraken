<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/database.php");
// extract from DB -> https://phpdelusions.net/pdo#prepared


$product = db_get_product($productCode);

$title = "Order" . $product["name"] . "- EatKraken";

$product_name = $product["name"];
$product_desc = $product["description"];;
$product_price = $product["price"];

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

function allergenes($gluten_free, $lactose_free, $vegan, $fresh, $zero_waste){
    $allergene = "<ul style=\"list-style-type: none;\">";
    if($gluten_free){
        $allergene .= "<li>Gluten free</li>";
    }

    if($lactose_free){
        $allergene .= "<li>Lactose free</li>";
    }

    if($vegan){
        $allergene .= "<li>Vegan</li>";
    }

    if($fresh){
        $allergene .= "<li>Daily sourced</li>";

    }

    if($zero_waste){
        $allergene .= "<li>Zero waste</li>";
    }
    return $allergene . "</ul>";
}
$product_allergenes = allergenes($product_flag_gluten_free, $product_flag_lactose_free, $product_flag_vegan, $product_flag_fresh, $product_flag_zero_waste);

$product_nutri_facts = "
<ul style= \"list-style-type: none;\">
<li>Kcal: $product_nutri_kcal</li>
<li>Carbs: $product_nutri_carbs</li>
<li>Fats: $product_nutri_fats</li>
<li>Proteins:  $product_nutri_proteins</li>
</ul>";

require_once($_SERVER['DOCUMENT_ROOT'] . "/templates/product.php");

?>