<?php
$title = "EatKraken"; 
?>
<!DOCTYPE html>
<html lang="en">
  <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/templates/widgets/common_head.php"); ?>
  <body>
  <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/templates/widgets/navbar.php"); 
  ?>

  <?php 
  
    function getRandomImage(){
      
      //$arrayId = array(1, 2, 3, 11, 12, 21, 22, 31, 32, 41, 42, 51, 52, 53, 61, 62);
      $arrayId2 = db_simple_query("select code from dishes");

      $randIndex = array_rand($arrayId2);
      $productCode = $arrayId2[$randIndex][0];
      $imageURL = db_simple_query("select image_url from dishes where code = $productCode");
      return $imageURL[0][0];
    }
  ?>

 
  <div class="mainbody"> 
  <div class="dropdown"id="selectCity">
  <button class="btn btn-default btn-lg dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   <span style="margin-right: 20px; letter-spacing: 1px; word-spacing: 3px">Select a city to start!</span> <span style="margin-top:12px; float:right; color: #C98474" class="caret"></span>
  </button>
  <ul class="dropdown-menu cityList">
  <?php 
            $cities = db_simple_query("select * from cities");
            foreach($cities as $city){
            $link = "/list.php?city=" . $city['code'] . "&time=&category=0";
             echo "<li><a href=\"$link\">" . $city['name'] . "</a></li>";
            }
            ?>
  </ul>
</div>
  

       
       


  <div id="myCarousel" class="carousel slide" data-ride="carousel">

     <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

  <div class="carousel-inner">
      <div class="item active" style="background-image: linear-gradient(rgba(20, 25, 24, 0.1), rgba(20, 25, 24, 1)), url('<?=getRandomImage()?>')">
        <div class="carousel-caption">
          <h2>You choose it, we bring it!</h2>
        </div>
      </div>

      <div class="item" style="background-image: linear-gradient(rgba(20, 25, 24, 0.1), rgba(20, 25, 24, 1)), url('<?=getRandomImage()?>')">
        <div class="carousel-caption">
          <h2>Your favourite restaurant, at your door!</h2>
        </div>
      </div>

      <div class="item" style="background-image: linear-gradient(rgba(20, 25, 24, 0.1), rgba(20, 25, 24, 1)), url('<?=getRandomImage()?>')">
      <div class="carousel-caption">
          <h2>Free delivery on order over 20$</h2>
      </div>
    </div>
  </div>
  </div>

  <div class="container-fluid threeColumnsHome">
    <div class="row"> 
      <div class="col-xs-12 col-sm-4 text-center  "><h1>We Value Your Health...</h1><img class="homepageAllergenes" src="https://i.ya-webdesign.com/images/marshmallow-on-stick-free-png-8.png"><div class="text" id="allerg">Do you have some allergies or intollerances? Don't worry! All the products come with a complete list of allergens. You can easily select from the search page the allergenes you want to avoid, and that's it! We offer a great variety of meals, including gluten-free, lactose-free and many others. We are sure you will easily find the dish you desire.</div></div>
      <div class="col-xs-12 col-sm-4 text-center "><h1>...Animals' Life...</h1><img class="homepageAllergenes" src="https://upload.wikimedia.org/wikipedia/commons/2/26/V_de_Vegan.png"> <div class="text" id="veg">The pleasure of food should not compromise other living beings wellness. This is why we decided to implement a vegan option to the meals search. From now on, you can enjoy your meals freely: we put a special effort in involving the best restaurant with a vegan option.</div></div>
      <div class="col-xs-12 col-sm-4 text-center "><h1>...and the Environment</h1><img class="homepageAllergenes" src="https://cdn4.iconfinder.com/data/icons/eco-food-and-cosmetic-labels-1/128/Artboard_66-512.png"><div class="text" id="waste">Tired of being overwhelmed by tons of plastic packages? With Eatkraken you can give it a stop! In addiction to the vegan option, the portal supports now also the zero-waste option. We make the best to persuade restaurant to adopt full recyclable packages, to help us save the world!</div></div>
    </div>
  </div>


<style>
.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  padding: 0 4px;
}

/* Create four equal columns that sits next to each other */
.column {
  -ms-flex: 33%; /* IE10 */
  flex: 33%;
  max-width: 33%;
  padding: 0 4px;
}

.column img {
  margin-top: 8px;
  vertical-align: middle;
  width: 100%;
}


.restImage{
-webkit-filter: grayscale(100%);
 filter: grayscale(100%);
 opacity: 1;
  display: block;
  width: 100%;
  height: auto;
  transition: .5s ease;
  backface-visibility: hidden;
}


/* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .column {
    -ms-flex: 100%;
    flex: 100%;
    max-width: 100%;
  }
}

.container {
  position: relative;
  width: 100%;
  padding: 3px 3px;
}

.middle {
  transition: .5s ease;
  opacity: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  text-align: center;
}

.container:hover .restImage {
  opacity: 0.3;
}

.container:hover .middle {
  opacity: 1;
}

.restName {
  color: black;
  font-size: 26px;
  padding: 16px 32px;
  font-family: 'Acme';
}
</style>
<?php             $restaurants = db_simple_query("select * from restaurants");?>

<h1 style="text-align: center">We work with...</h1>
  <div class="row" style="margin-bottom: 20px"> 
  <div class="column">
    <div class="container">
      <?= "<img class=\"restImage\" src=\"" . $restaurants[0]["image_url"] ."\" style=\"width:100%\">"?>
      <div class="middle">
    <div class="restName"><?=$restaurants[0]["name"]?></div>
  </div>
</div>
    <div class="container">
      <?= "<img class=\"restImage\" src=\"" . $restaurants[1]["image_url"] ."\" style=\"width:100%\">"?>
      <div class="middle">
      <div class="restName"><?=$restaurants[1]["name"]?></div>
  </div>
</div>

  </div>
  <div class="column">
  <div class="container">
    <?= "<img class=\"restImage\" src=\"" . $restaurants[2]["image_url"] ."\" style=\"width:100%\">"?>
    <div class="middle">
    <div class="restName"><?=$restaurants[2]["name"]?></div>
  </div>
</div>
  <div class="container">
    <?= "<img class=\"restImage\" src=\"" . $restaurants[3]["image_url"] ."\" style=\"width:100%\">"?>
    <div class="middle">
    <div class="restName"><?=$restaurants[3]["name"]?></div>
  </div>
</div>
  <div class="container">
    <?= "<img class=\"restImage\" src=\"" . $restaurants[4]["image_url"] ."\" style=\"width:100%\">"?>
    <div class="middle">
    <div class="restName"><?=$restaurants[4]["name"]?></div>
  </div>
</div>

 
  </div>  
  <div class="column">
  <div class="container">
    <?= "<img class=\"restImage\" src=\"" . $restaurants[5]["image_url"] ."\" style=\"width:100%\">"?>
    <div class="middle">
    <div class="restName"><?=$restaurants[5]["name"]?></div>
  </div>
</div>
  <div class="container">
    <?= "<img class=\"restImage\" src=\"" . $restaurants[6]["image_url"] ."\" style=\"width:100%\">"?>
    <div class="middle">
    <div class="restName"><?=$restaurants[6]["name"]?></div>
  </div>
</div>

  </div>
</div>
  <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/templates/widgets/footer.php"); ?>

  </body>
</html>

