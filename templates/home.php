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
      <div class="item active" style="background-image: url(<?= getRandomImage()?>)">
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
      <div class="col-xs-12 col-sm-4 text-center  "><h1>We Value Your Health...</h1><img class="homepageAllergenes" src="https://i.ya-webdesign.com/images/marshmallow-on-stick-free-png-8.png"><div class="text" id="allerg">Do you have some allergies or intollerances? Don't worry! All the products come with a complete list of allergens. You can easily select from the search page the allergenes you want to avoid, and that's it! We offer a great variety of meals, including gluten-free, lactose-free and many others. We are sure you will easily find the dish you desire</div></div>
      <div class="col-xs-12 col-sm-4 text-center "><h1>...Animals' Life...</h1><img class="homepageAllergenes" src="https://upload.wikimedia.org/wikipedia/commons/2/26/V_de_Vegan.png"> <div class="text" id="veg">The pleasure of food should not compromise other living beings wellness. This is why we decided to implement a vegan option to the meals search. From now on, you can enjoy your meals freely. We put a special attention in involving the best restaurant with a vegan option</div></div>
      <div class="col-xs-12 col-sm-4 text-center "><h1>...and the Environment</h1><img class="homepageAllergenes" src="https://cdn4.iconfinder.com/data/icons/eco-food-and-cosmetic-labels-1/128/Artboard_66-512.png"><div class="text" id="waste">Tired of being overwhelmed by tons of plastic packages? With Eatkraken you can give it a stop! In addiction to the vegan option, the portal supports now also the zero-waste option. We make the best to persuade restaurant to adopt full recyclable packages, to help us save the world! </div></div>
    </div>
  </div>

  <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/templates/widgets/footer.php"); ?>

  </body>
</html>

