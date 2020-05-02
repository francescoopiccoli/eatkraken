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
        <div class="home-inner container" style= "background-image: linear-gradient(rgba(20, 25, 24, 0.1), rgba(20, 25, 24, 1)), url('<?=$product_image_url?>');">
          <div class="caption text-center">

            <img class="circular--landscape" id="profile-pic" src=<?=$product_image_url?>>
            <h1><?= $product_name ?></h1>
            <p class="lead"><?= $product_desc ?></p>
            <h3><b>€<?= $product_price ?></b><small style="color: #ccc; font-weight: 500;"> / piece</small></h3>
            <form action="/product.php?code=<?= $product_id; ?>" method="post">
              <input type="hidden" name="add">
              <button type="submit" class="homePageButton" id="cart-add-btn"<?= $product_id; ?>>
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

    <div class="container-fluid threeColumnsHome">
      <div class="row">
        <div class="col-xs-12 col-sm-4 text-left ">
          <h2 style="margin-top: 15px; text-align:center">Product info</h2>
          <?= $product_allergenes ?>
        </div>
        <div class="col-xs-12 col-sm-4 text-center ">
          <h2 style="margin-top: 15px;">Ingredients</h2>
          <div><?= $product_ingredients ?></div>
        </div>
        <div class="col-xs-12 col-sm-4 text-left ">
          <h2 style="margin-top: 15px; text-align:center">Nutritional facts  (x 100g)</h2>
          <?= $product_nutri_facts ?>
          </div>
      </div>
    </div>

    <div class="container-fluid justify-content-center "  style="background-color: #F0F0F0; width:100%">
          <div class="row justify-content-center" style="padding: 30px;">
          <div class="col-xs-12 col-sm-4 text-center"><?php echo "<img style=\"width:100%; opacity: 0.7; border: 1px solid; border-radius: 80%\" src=\"$restaurant_image_url\">"?>
          </div>
          <div class="col-xs-12 col-sm-8 text-center">
            <h2 style="margin-top: 30px;"> <?= $restaurant_name?></h2>
            <hr style="border-color: #bbb; width: 30%">
            <div style="width:100%; text-align: center;">
            <?= "<i>$restaurant_description</i>"?></div>
          </div>
      </div>
    </div>

    <?php include($_SERVER['DOCUMENT_ROOT'] . "/templates/widgets/footer.php"); ?>
  </body>
</html>

