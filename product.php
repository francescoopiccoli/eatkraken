<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/session.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/database.php");

if(!isset($_GET['code']) || !is_numeric($_GET['code'])) {
    header("Location: /404.php");
}

$product_id = $_GET['code'] / 1; // make sure it's a number -> avoid SQLinj
$product = db_get_product($product_id); 

$restaurant_id = $product["restaurant"];
$restaurant_name = db_get_restaurant_name($restaurant_id);
$restaurant_description = db_get_restaurant_description($restaurant_id);
$restaurant_image_url = db_get_restaurant_image_url($restaurant_id);


if(!$product) {
    header("Location: /404.php");
}

// 'add' in POST -> add to cart
$addToCart = isset($_POST['add']);
if($addToCart) {
    $addSuccess = cart_add_item($product_id);
}

$title = "Order " . $product["name"] . " - EatKraken";

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
    $allergene = "<table class=\"table-product-info\">";
    if($gluten_free){
       $allergene .= "<tr><td>Gluten free</td><td></td><td>&nbsp &nbsp</td><td><img class=\"product-info-logos\" src=\"images/glutine.png\"</td></tr>";

    }

    if($lactose_free){
        $allergene .= "<tr><td>Lactose free</td><td></td><td>&nbsp &nbsp</td><td><img class=\"product-info-logos\" src=\"images/latte.png\"</td></tr>";

    }

    if($vegan){
        $allergene .= "<tr><td>Vegan</td><td></td><td>&nbsp &nbsp</td><td><img class=\"product-info-logos\" src=\"images/vegan.png\"</td></tr>";

    }

    if($fresh){
       $allergene .= "<tr><td>Fresh</td><td>&nbsp &nbsp</td><td></td><td><img class=\"product-info-logos\" src=\"images/fresh.jpeg\"</td></tr>";

    }

    if($zero_waste){
        $allergene .= "<tr><td>Zero waste</td><td>&nbsp  &nbsp</td><td></td><td><img class=\"product-info-logos\" src=\"images/zero_waste.png\"</td></tr>";
    }
    return $allergene . "</table>";
}

$product_allergenes = allergenes($product_flag_gluten_free, $product_flag_lactose_free, $product_flag_vegan, $product_flag_fresh, $product_flag_zero_waste);

$product_nutri_facts = "
<table class=\"table table-bordered table-nutri-facts\">
<tr><td><b>Calories</b>:</td> <td>$product_nutri_kcal kcal</td> </tr>
<tr><td><b>Carbs</b>:</td> <td>$product_nutri_carbs g</td> </tr>
<tr><td><b>Fats</b>:</td>  <td>$product_nutri_fats g</td> </tr>
<tr><td><b>Proteins:</b></td>   <td>$product_nutri_proteins g</td> </tr>
</table>";


require_once($_SERVER['DOCUMENT_ROOT'] . "/views/product.php");
?>