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
      <div class="item active" style="background-image: url('<?=getRandomImage()?>')">
        <div class="carousel-caption">
          <h2>You choose it, we bring it!</h2>
        </div>
      </div>

      <div class="item" style="background-image: url('<?=getRandomImage()?>')">
        <div class="carousel-caption">
          <h2>Your favourite restaurant, at your door!</h2>
        </div>
      </div>

      <div class="item" style="background-image: url('<?=getRandomImage()?>')">
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
   .image:hover{
     opacity: 0.5;

   }

   .imageText{
      visibility: hidden;
   }

   .column{
      flex: 33%;
      max-width:33%;
}

   @media screen and (max-width: 700px){
    .column{
      flex: 100%;
      max-width:100%;
}

@media screen and (max-width: 1100px) and (min-width: 701px){
    .column{
      flex: 50%;
      max-width:50%;
}
   }
   
    </style>

 <?php 
           echo "<div style=\"margin-bottom:50px\">
                  <h1 style=\"text-align: center\">We work with...</h1>";
            $restaurants = db_simple_query("select * from restaurants");
            echo "<div class=\"row\" style=\"display: flex;
            flex-wrap: wrap;
            padding: 0 4px;\">";

            $i = 1;

            foreach($restaurants as $restaurant){
              if($i % 3 == 0 || $i == 1){
                echo "<div class=\"column\" style=\"
                padding: 0 4px; text-align:center\">";}
              

              echo "<div class\"imageContainer\">
                <img class=\"image\" style=\" margin-top: 8px;
                vertical-align: middle;
                width: 100%;
                -webkit-filter: grayscale(100%); /* Safari 6.0 - 9.0 
                filter: grayscale(100%);
              \" src=\"" . $restaurant["image_url"] ."\">
              <div class=\"imageText\">Image 1 Text</div>
            </div>";
            $i++;

            if($i % 3 == 0 || $i == 1){
              echo "</div>";
            }
            }
            echo "</div></div></div>";

  ?>
  <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/templates/widgets/footer.php"); ?>

  </body>
</html>

