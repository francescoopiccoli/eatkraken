<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/session.php");
?>

<!DOCTYPE html>
<html lang="en">
  <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/templates/widgets/common_head.php"); ?>
  <style>
  td{
    padding:10px;
  }
 
  </style>
  <body>

    <?php include($_SERVER['DOCUMENT_ROOT'] . "/templates/widgets/navbar.php"); ?>
    <div class="mainbody"> 
        <div class="home-inner container" style= "background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 1)), url(<?=$product_image_url?>);">
          <div class="caption text-center">

            <img class="circular--landscape" id="profile-pic" src=<?=$product_image_url?>>
            <h1><?= $product_name ?></h1>
            <p class="lead"><?= $product_desc ?></p>
            <h3><b>€<?= $product_price ?></b><small style="color: #ccc; font-weight: 500;"> / piece</small></h3>
            <a class="homePageButton" id="cart-add-btn" href="/product.php?code=<?= $product_id; ?>&add">
            <?php
              if(!$addToCart || !$addSuccess) {
                echo "Add to cart";
              } else {
                echo "Added!";
              }
            ?>
            </a>
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

    <div class="container-fluid threeColumnsHome">
      <div class="row">
        <div class="col-xs-12 col-sm-4 text-center ">
          <h2 style="margin-top: 15px;">Product info</h2>
          <?= $product_allergenes ?>
        </div>
        <div class="col-xs-12 col-sm-4 text-center ">
          <h2 style="margin-top: 15px;">Ingredients</h2>
          <div><?= $product_ingredients ?></div>
        </div>
        <div class="col-xs-12 col-sm-4 text-center ">
          <h2 style="margin-top: 15px;">Nutritional facts  (x 100g)</h2>
          <?= $product_nutri_facts ?>
          </div>
      </div>
    </div>

    <?php include($_SERVER['DOCUMENT_ROOT'] . "/templates/widgets/footer.php"); ?>
  </body>
</html>

