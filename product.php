<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/database.php");

if(!isset($_GET['code']) || !is_numeric($_GET['code'])) {
    header("Location: /404.php");
}

$product = db_get_product($_GET['code'] / 1); // make sure it's a number -> avoid SQLinj

$title = "Order" . $product["name"] . " - EatKraken";

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
    $allergene = "<ul style=\"list-style-type: none; margin: 10%;\">";
    if($gluten_free){
        $allergene .= "<li style=\"border-bottom: 1px solid #e2e2e2; margin: 10px;\">Gluten free</li>";
    }

    if($lactose_free){
        $allergene .= "<li style=\"border-bottom: 1px solid #e2e2e2; margin: 10px;\">Lactose free</li>";
    }

    if($vegan){
        $allergene .= "<li style=\"border-bottom: 1px solid #e2e2e2; margin: 10px;\">Vegan</li>";
    }

    if($fresh){
        $allergene .= "<li style=\"border-bottom: 1px solid #e2e2e2; margin: 10px;\">Daily sourced</li>";

    }

    if($zero_waste){
        $allergene .= "<li style=\"border-bottom: 1px solid #e2e2e2; margin: 10px;\">Zero waste</li>";
    }
    return $allergene . "</ul>";
}

$product_allergenes = allergenes($product_flag_gluten_free, $product_flag_lactose_free, $product_flag_vegan, $product_flag_fresh, $product_flag_zero_waste);

$product_nutri_facts = "
<i>Quantities per 100 grams</i>
<table class=\"table table-bordered\">
<tr><td><b>Calories</b>:</td> <td>$product_nutri_kcal kcal</td> </tr>
<tr><td><b>Carbs</b>:</td> <td>$product_nutri_carbs g</td> </tr>
<tr><td><b>Fats</b>:</td>  <td>$product_nutri_fats g</td> </tr>
<tr><td><b>Proteins:</b></td>   <td>$product_nutri_proteins g</td> </tr>
</table>";


require_once($_SERVER['DOCUMENT_ROOT'] . "/templates/product.php");
?>