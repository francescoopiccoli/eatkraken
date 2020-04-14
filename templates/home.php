<?php
$title = "EatKraken"; 
?>
<!DOCTYPE html>
<html lang="en">
  <?php require_once("widgets/common_head.php"); ?>
  <body>
  <?php require_once("widgets/navbar.php"); ?>


  <div class="mainbody"> 
    
  <div id="myCarousel" class="carousel slide" data-ride="carousel">

    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

  <div class="carousel-inner">

      <div class="item active" style="background-image: url(https://images.unsplash.com/photo-1561760041-ca62af0d9047?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80);">
        <div class="carousel-caption">
          <h2>You choose it, we bring it!</h2>
          <button type="button" class="btn btn-primary">Check the list!</button>
        </div>
      </div>

      <div class="item" style="background-image: url(https://video-images.vice.com/articles/59ca67cc3c5a224d52beeafc/lede/1506437421227-perche-non-ci-sono-donne-tra-i-kebabbari.jpeg?crop=0.999247554552295xw:1xh;center,center);">
        <div class="carousel-caption">
          <h2>Your favourite restaurant, at your door!</h2>
          <button type="button" class="btn btn-primary">Check the list!</button>
        </div>
      </div>

      <div class="item" style="background-image: url(https://www.larena.it/image/policy:1.4667048:1456192040/image.jpg?f=16x9&w=1200&$p$f$w=9b37ea6);">
        <div class="carousel-caption">
          <h2>Free delivery on order over 20$</h2>
        <a href="index.html"><button type="button" class="btn btn-primary">Check the list!</button></a>
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

  <?php require_once("widgets/footer.php"); ?>

  </body>
</html>

