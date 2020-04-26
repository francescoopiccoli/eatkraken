<?php
$title = "EatKraken"; 
?>
<!DOCTYPE html>
<html lang="en">
  <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/templates/widgets/common_head.php"); ?>
  <body>
  <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/templates/widgets/navbar.php"); ?>
  
  <?php 

    function getRandomImage(){
      
      $arrayId = array(1, 2, 3, 11, 12, 21, 22, 31, 32, 41, 42, 51, 52, 53, 61, 62);
      //$arrayId = db_simple_query("select code from dishes");
      $randIndex = array_rand($arrayId);
      $productCode = $arrayId[$randIndex];
      $imageURL = db_simple_query("select image_url from dishes where code = $productCode");
      return $imageURL[0][0];
    }

  ?>

  <div class="mainbody"> 
    
  <div id="myCarousel" class="carousel slide" data-ride="carousel">

    <!-- <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>-->
  <div class="carousel-inner">
     
     <div class="item active" style="background-image: url(<?= getRandomImage()?>">

        <div class="carousel-caption">
          <h2>You choose it, we bring it!</h2>
          <a href="list.php" class="homePageButton">Check the list!</a>
        </div>
      </div>

      <div class="item" style="background-image: url(<?= getRandomImage()?>">
        <div class="carousel-caption">
          <h2>Your favourite restaurant, at your door!</h2>
          <a href="list.php" class="homePageButton">Check the list!</a>
        </div>
      </div>

     <div class="item" style="background-image: url(<?= getRandomImage()?>">
        <div class="carousel-caption">
          <h2>Free delivery on order over 20$</h2>
          <a href="list.php" class="homePageButton">Check the list!</a>
        </div>
      </div>
    </div>
  </div>
  </div>

  <div class="container-fluid threeColumnsHome">
    <div class="row">
      <div class="col-xs-12 col-sm-4 text-center "><img class="homepageAllergenes" src="https://i.ya-webdesign.com/images/marshmallow-on-stick-free-png-8.png">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</div>
      <div class="col-xs-12 col-sm-4 text-center "><img class="homepageAllergenes" src="https://upload.wikimedia.org/wikipedia/commons/2/26/V_de_Vegan.png">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</div>
      <div class="col-xs-12 col-sm-4 text-center "><img class="homepageAllergenes" src="https://cdn4.iconfinder.com/data/icons/eco-food-and-cosmetic-labels-1/128/Artboard_66-512.png">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</div>
    </div>
  </div>

  <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/templates/widgets/footer.php"); ?>

  </body>
</html>

