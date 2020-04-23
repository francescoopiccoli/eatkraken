<!DOCTYPE html>
<html lang="en">
<?php include($_SERVER['DOCUMENT_ROOT'] . "/templates/widgets/common_head.php"); ?>
<body>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/templates/widgets/navbar.php"); ?>

<div class="mainbody"> 
    <div class="home-inner container">
      <div class="caption text-center">
        <h1><?= $product_name ?></h1>
        <p class="lead"><?= $product_desc ?></p>
        <h3><b>€<?= $price ?></b><small>/piece</small></h3>
        <button id="btn-cart-add">Add to cart</button>
      </div>
    </div>
</div>

<div class="container-fluid threeColumnsHome">
  <div class="row">
    <div class="col-xs-12 col-sm-4 text-center ">
      <h2>Allergenes</h2>
      <?= $product_allergenes ?>
    </div>
    <div class="col-xs-12 col-sm-4 text-center ">
      <h2>Ingredients</h2>
      <?= $product_ingredients ?>
    </div>
    <div class="col-xs-12 col-sm-4 text-center ">
      <h2>Nutritional facts</h2>
      <?= $product_nutri_facts ?>
      </div>
  </div>
</div>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/templates/widgets/footer.php"); ?>
</body>
</html>

