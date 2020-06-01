<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/session.php");
?>

<!DOCTYPE html>
<html lang="en">
  <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/views/widgets/common_head.php"); ?>
  <body>

    <?php include($_SERVER['DOCUMENT_ROOT'] . "/views/widgets/navbar.php"); ?>
    <div class="mainbody"> 
        <div title="image of the product" class="home-inner container " style= "background-image: linear-gradient(rgba(20, 25, 24, 0.1), rgba(20, 25, 24, 1)), url('<?=$product_image_url?>');">
          <div class="caption text-center">

            <span><a target="_blank" href="<?= $product_image_url?>"><img alt="image_product" title="view image" id="profile-pic" src=<?=$product_image_url?>></a></span>
            <h1><?= $product_name ?></h1>
            <p class="lead"><?= $product_desc ?></p>
            <h3><b>€<?= $product_price ?></b><small id="small"> / piece</small></h3>
            <form action="/product.php?code=<?= $product_id; ?>" method="post">
              <input type="hidden" name="add">
              <button type="submit" class="product-page-button" id="cart-add-btn" onclick="return ajaxAddCart(<?= $product_id; ?>);">
              <?php
                if(!$addToCart || !$addSuccess) {
                  echo "Add to cart";
                } else {
                  echo "Added!";
                }
              ?>
              </button>
            </form>
            
            <br>
            <span id="cart-add-msg">

            <?php
              if($addToCart && !$addSuccess) {
                echo "Error adding, try again?";
              }
            ?>
            </span>
          </div>
        </div>  
    </div>

    <div class="container-fluid main-3c-view">
      <div class="row">
        <div class="col-xs-12 col-sm-4 text-left ">
          <h2 class="text-center" >Product info</h2>
          <?= $product_allergenes ?>
        </div>
        <div class="col-xs-12 col-sm-4 text-center ">
          <h2  class="text-center">Ingredients</h2>
          <div id="ingredients"><?= $product_ingredients ?></div>
        </div>
        <div class="col-xs-12 col-sm-4 text-left ">
          <h2 class="text-center">Nutritional facts  (x 100g)</h2>
          <?= $product_nutri_facts ?>
          </div>
      </div>
    </div>

    <div id="cont-rest" class="container-fluid justify-content-center" >
          <div class="row justify-content-center">
          <div class="col-xs-12 col-sm-4 text-center"><?php echo "<img id=\"rest-image\" alt=\"restaurant_image\" title=\"restaurant_image\" src=\"$restaurant_image_url\">"?>
          </div>
          <div class="col-xs-12 col-sm-8 text-center">
            <h2 id="rest-name"> <?= $restaurant_name?></h2>
            <hr class="hr-narrow">
            <div id="rest-desc">
            <i><?= $restaurant_description ?></i></div>
          </div>
      </div>
    </div>

    <?php include($_SERVER['DOCUMENT_ROOT'] . "/views/widgets/footer.php"); ?>
  </body>
</html>

