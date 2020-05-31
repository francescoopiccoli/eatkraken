<?php
$title = "EatKraken"; 
?>
<!DOCTYPE html>
<html lang="en">
  <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/views/widgets/common_head.php"); ?>
  <body>
  <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/views/widgets/navbar.php"); 
  ?>

  <?php 
  
    function getRandomImage(){
      $imageURL = db_simple_query("select image_url from dishes order by random()");
      return $imageURL[0][0];
    }
  ?>

 
<div class="mainbody"> 
  
  <div id="myCarousel" class="carousel slide" data-ride="carousel">

    <div class="dropdown" id="select-city-outer">
      <button class="btn btn-default btn-lg dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <span id="select-city" >SELECT A CITY</span> <span class="caret"></span>
      </button>
      <ul class="dropdown-menu city-list">
        <?php 
              $cities = db_simple_query("select * from cities");
              foreach($cities as $city){
              $link = "/list.php?city=" . $city['code'] . "&time=&category=0";
              echo "<li><a href=\"$link\">" . $city['name'] . "</a></li>";
              }
        ?>
      </ul>
    </div>
     <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

  <div class="carousel-inner">
      <div title="food image" class="item active" style="background-image: linear-gradient(rgba(20, 25, 24, 0.1), rgba(20, 25, 24, 1)), url('<?=getRandomImage()?>')">
        <div class="carousel-caption">
          <h2>You choose it, we bring it!</h2>
        </div>
      </div>

      <div title="food image" class="item" style="background-image: linear-gradient(rgba(20, 25, 24, 0.1), rgba(20, 25, 24, 1)), url('<?=getRandomImage()?>')">
        <div class="carousel-caption">
          <h2>Your favourite restaurant, at your door!</h2>
        </div>
      </div>

      <div title="food image" class="item" style="background-image: linear-gradient(rgba(20, 25, 24, 0.1), rgba(20, 25, 24, 1)), url('<?=getRandomImage()?>')">
      <div class="carousel-caption">
          <h2>Sustainable food options available!</h2>
      </div>
    </div>
  </div>
  </div>

  <div class="container-fluid main-3c-view">
    <div class="row"> 
      <div class="col-xs-12 col-sm-4 text-center "><h1>We Value Your Health...</h1><img title="gluten_free_icon" alt="gluten_free_icon" class="homepageAllergenes" src="https://i.ya-webdesign.com/images/marshmallow-on-stick-free-png-8.png"><div class="text" id="allerg">Do you have some allergies or intollerances? Don't worry! All the products come with a complete list of allergens. You can easily select from the search page the allergenes you want to avoid, and that's it! We offer a great variety of meals, including gluten-free, lactose-free and many others.</div></div>
      <div class="col-xs-12 col-sm-4 text-center "><h1>...Animals' Life...</h1><img title="vegan_icon" alt="vegan_icon" class="homepageAllergenes" src="https://upload.wikimedia.org/wikipedia/commons/2/26/V_de_Vegan.png"> <div class="text" id="veg">The pleasure of food should not compromise other living beings wellness. This is why we decided to implement a vegan option to the meals search. From now on, you can enjoy your meals freely: we put a special effort in involving the best restaurant with a vegan option.</div></div>
      <div class="col-xs-12 col-sm-4 text-center "><h1>...and the Environment</h1><img title="dairy_free_icon" alt="dairy_free_icon" class="homepageAllergenes" src="https://cdn4.iconfinder.com/data/icons/eco-food-and-cosmetic-labels-1/128/Artboard_66-512.png"><div class="text" id="waste">Tired of being overwhelmed by tons of plastic packages? With Eatkraken you can give it a stop! In addiction to the vegan option, the portal supports now also the zero-waste option. We make the best to persuade restaurant to adopt full recyclable packages, to help us save the world!</div></div>
    </div>
  </div>

  <?php $restaurants = db_simple_query("select * from restaurants");?>

  <div class="restaurants-div">

    <h1 class="text-center">We work with...</h1>
    <div class="row"> 

      <div class="column">

        <div class="container">
          <?= "<img alt=\"restaurant image\"  title=\"restaurant image\" class=\"restaurant-image\" src=\"" . $restaurants[0]["image_url"] ."\">"?>
          <div class="middle">
            <div class="restaurant-name"><?=$restaurants[0]["name"]?>
            </div>
          </div>
        </div>

        <div class="container">
          <?= "<img alt=\"restaurant image\" title=\"restaurant image\" class=\"restaurant-image\" src=\"" . $restaurants[1]["image_url"] ."\">"?>
          <div class="middle">
            <div class="restaurant-name"><?=$restaurants[1]["name"]?>
            </div>
          </div>
        </div>

      </div>


      <div class="column">
        
        <div class="container">
          <?= "<img alt=\"restaurant image\" title=\"restaurant image\" class=\"restaurant-image\" src=\"" . $restaurants[2]["image_url"] ."\">"?>
          <div class="middle">
            <div class="restaurant-name"><?=$restaurants[2]["name"]?>
            </div>
          </div>
        </div>

        <div class="container">
          <?= "<img alt=\"restaurant image\" title=\"restaurant image\" class=\"restaurant-image\" src=\"" . $restaurants[3]["image_url"] ."\">"?>
          <div class="middle">
            <div class="restaurant-name"><?=$restaurants[3]["name"]?>
            </div>
          </div>
        </div>

        <div class="container">
          <?= "<img alt=\"restaurant image\" title=\"restaurant image\" class=\"restaurant-image\" src=\"" . $restaurants[4]["image_url"] ."\">"?>
          <div class="middle">
            <div class="restaurant-name"><?=$restaurants[4]["name"]?>
            </div>
          </div>
        </div>

      </div> 

      <div class="column">

        <div class="container">
          <?= "<img alt=\"restaurant image\" title=\"restaurant image\" class=\"restaurant-image\" src=\"" . $restaurants[5]["image_url"] ."\">"?>
          <div class="middle">
            <div class="restaurant-name"><?=$restaurants[5]["name"]?>
            </div>
          </div>
        </div>

        <div class="container">
          <?= "<img alt=\"restaurant image\" title=\"restaurant image\" class=\"restaurant-image\" src=\"" . $restaurants[6]["image_url"] ."\">"?>
          <div class="middle">
            <div class="restaurant-name"><?=$restaurants[6]["name"]?>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <h1 id="they-say" >They say about us...</h1>
  <div class="row home-ratings">
    <div class="col-md-4 clients">
      
      <div class="col-md-12">
        <blockquote>
          <i class="fas fa-quote-left"></i> Just what I needed! Quality food delivered right to my house, at any time I need! 
          <hr class="clients-hr">
          <cite>TrustPilot user</cite>
        </blockquote>
      </div>
    </div>

    <div class="col-md-4 clients">
      
      <div class="col-md-12">
        <blockquote>
          <i class="fas fa-quote-left"></i> A great idea which comes in a moment of great need! Nothing to add! Well done Eatkraken!
          <hr class="clients-hr">
          <cite>The Guardian</cite>
        </blockquote>
      </div>
    </div>

    <div class="col-md-4 clients">
      <div class="col-md-12">
        <blockquote>
          <i class="fas fa-quote-left"></i> Eatkraken brings home food delivery to the next level! You can really choose between a wide array of delicacies! 
          <hr class="clients-hr">
          <cite>Huffington Post</cite>
        </blockquote>
      </div>
    </div>
  </div>
</div>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . "/views/widgets/footer.php"); ?>
</body>
</html>

