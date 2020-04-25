<!DOCTYPE html>
<html lang="en">
  <?php include($_SERVER['DOCUMENT_ROOT'] . "/templates/widgets/common_head.php"); ?>
  <body>

    <?php include($_SERVER['DOCUMENT_ROOT'] . "/templates/widgets/navbar.php"); ?>
    <div class="mainbody"> 
        <div class="home-inner container" style= "background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 1)), url(<?=$product_image_url?>);">
          <div class="caption text-center">
            <h1><?= $product_name ?></h1>
            <p class="lead"><?= $product_desc ?></p>
            <h3><b>€<?= $product_price ?></b><small style="color: #ccc; font-weight: 500;"> / piece</small></h3>
            <button class="homePageButton" id="cart-add-btn">Add to cart</button>
            <br>
            <span id="cart-add-msg"></span>
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

    <script>
      $(document).ready(function() {
        $("#cart-add-btn").click(function() {
          /* TODO : jquery */
          alert("*horrible crash noises*");

          if(true) {
            $("#cart-add-btn").text("Added!");
            $("#cart-add-msg").val("");
          } else {
            $("#cart-add-msg").val("An error has occurred, please try again");
          }

        });
      });
    </script>
  </body>
</html>

