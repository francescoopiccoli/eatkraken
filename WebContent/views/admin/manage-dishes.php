<!DOCTYPE html>
<html lang="en">
<?php include($_SERVER['DOCUMENT_ROOT'] . "/views/widgets/common_head.php"); ?>
  <body>
    <div class="main-content">

      <?php include($_SERVER['DOCUMENT_ROOT'] . "/views/widgets/navbar.php"); 
       $restaurant_name = db_get_restaurant_name(restaurant_get_logged_id());
      ?>


      <div class="container-fluid text-center mainbody">    
        <div class="row content">
          <div class="col-sm-12 text-left"> 
          
            <h1 id="your-dishes"><?= $restaurant_name?></h1>
            <div>
              <a href="add-dish.php" class="btn btn-default btn-lg" id="add-dish-btn">Add dish</a>
              <a href="orders.php" id ="goToOrders" class="btn btn-default btn-lg orders-goto-btn">Go to orders</a>
            </div>

            <h3>Your dishes</h3>
            <i>To edit an already existing dish, please delete it and insert it again.</i>
            <hr>

            <div class="row">
              <?php 

                $dishes = db_get_restaurant_dishes(restaurant_get_logged_id());
                  foreach($dishes as $dish) { ?>
                  <div class="col-md-2 col-sm-4">
                    <div title="dish_card" class="panel panel-default">
                      <div class="panel-body list-thumb" style="background-image: url('<?= $dish["image_url"]; ?>'); background-size: cover; min-width: 100px; min-height: 120px;">
                      
                      </div>
                      <div class="panel-footer text-center">
                      <a class="name-link" href="/product.php?code=<?= $dish["code"];?>" target="_blank">
                        <b class="name-product-size"><?= $dish["name"] ?></b>                     
                      </a>

                        <br>
                        <b><?= $dish["price"] ?>€</b> 
                        <br>
                        <form method="post" action="/restaurant/manage-dishes.php">
                          <input type="hidden" name="dish" value="<?= $dish['code']; ?>">
                          <input type="submit" onclick="return confirmAction();" name="remove" value="Remove" class="btn btn-default btn-sm btn-remove"/>
                        </form> 
                      </div>
                    </div>
                  </div>
                  <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/views/widgets/footer.php"); ?>
  </body>
</html>

