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
    //$allergene = "<ul class=\"list-group\">";
    $allergene = "<table style=\"margin: 0 auto;\">";
    if($gluten_free){
       // $allergene .= "<li class=\"list-group-item\">Gluten free <span style=\"float: right\"><img style=\"width:20px; height:20px;\" src=\"images/glutine.png\"</span></li>";
       $allergene .= "<tr><td>Gluten free</td><td></td><td>&nbsp &nbsp</td><td><img style=\"width:20px; height:20px;\" src=\"images/glutine.png\"</td></tr>";

    }

    if($lactose_free){
        //$allergene .= "<li class=\"list-group-item\">Lactose free <span style=\"float: right\"><img style=\"width:20px; height:20px;\" src=\"images/latte.png\"</span></li>";
        $allergene .= "<tr><td>Lactose free</td><td></td><td>&nbsp &nbsp</td><td><img style=\"width:20px; height:20px;\" src=\"images/latte.png\"</td></tr>";

    }

    if($vegan){
        //$allergene .= "<li  class=\"list-group-item\">Vegan <span style=\"float: right\"><img style=\"width:20px; height:20px;\" src=\"https://www.pinclipart.com/picdir/big/175-1754142_hot-food-organic-pepper-chili-vegetarian-vegan-vegetarian.png\"</span></li>";
        $allergene .= "<tr><td>Vegan</td><td></td><td>&nbsp &nbsp</td><td><img style=\"width:20px; height:20px;\" src=\"https://www.pinclipart.com/picdir/big/175-1754142_hot-food-organic-pepper-chili-vegetarian-vegan-vegetarian.png\"</td></tr>";

    }

    if($fresh){
       // $allergene .= "<li  class=\"list-group-item\">Daily sourced <span style=\"float: right\"><img style=\"width:20px; height:20px;\" src=\"data:image/png;base64,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\"</span></li>";
       $allergene .= "<tr><td>Daily sourced</td><td>&nbsp &nbsp</td><td></td><td><img style=\"width:20px; height:20px;\" src=\"data:image/png;base64,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\"</td></tr>";

    }

    if($zero_waste){
        //$allergene .= "<li  class=\"list-group-item\">Zero waste <span style=\"float: right\"><img style=\"width:20px; height:20px;\" src=\"https://pluspng.com/img-png/recycle-png-recycle-1304.png\"</span></li>";
        $allergene .= "<tr><td>Zero waste</td><td>&nbsp  &nbsp</td><td></td><td><img style=\"width:20px; height:20px;\" src=\"https://pluspng.com/img-png/recycle-png-recycle-1304.png\"</td></tr>";
    }
    //return $allergene . "</ul>";
    return $allergene . "</table>";
}

$product_allergenes = allergenes($product_flag_gluten_free, $product_flag_lactose_free, $product_flag_vegan, $product_flag_fresh, $product_flag_zero_waste);

$product_nutri_facts = "
<table class=\"table table-bordered\">
<tr><td><b>Calories</b>:</td> <td>$product_nutri_kcal kcal</td> </tr>
<tr><td><b>Carbs</b>:</td> <td>$product_nutri_carbs g</td> </tr>
<tr><td><b>Fats</b>:</td>  <td>$product_nutri_fats g</td> </tr>
<tr><td><b>Proteins:</b></td>   <td>$product_nutri_proteins g</td> </tr>
</table>";


require_once($_SERVER['DOCUMENT_ROOT'] . "/views/product.php");
?>