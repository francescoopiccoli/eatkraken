<?php
$title  = "Search results";
$cities = array(
  array("id" => 1, "name" => "Bolzano"),
  array("id" => 2, "name" => "Merano"),
  array("id" => 3, "name" => "Rovereto"),
  array("id" => 4, "name" => "Trento"),
);

$options = array(
  array("id" => 1, "name" => "Fresh"),
  array("id" => 2, "name" => "Gluten-free"),
  array("id" => 3, "name" => "Lactose-free"),
  array("id" => 4, "name" => "Vegan"),
  array("id" => 5, "name" => "Vegetarian"),
);

$categories = array(
  array("id" => 5, "name" => "Asian"),
  array("id" => 6, "name" => "Asian > Chinese"),
  array("id" => 7, "name" => "Asian > Sushi"),
  array("id" => 1, "name" => "Buns"),
  array("id" => 2, "name" => "Buns > Burgers"),
  array("id" => 3, "name" => "Buns > Kebab"),
  array("id" => 8, "name" => "Pizza"),
);


$results = array(
  array(
    "id" => 123,
    "name" => "Pizza Margherita",
    "price" => 15,
    "picture_url" => "https://cdn-media.italiani.it/site-caserta/2019/01/pizza-con-ananas-caserta-2.jpg",
    "restaurant_id" => 1,
    "restaurant_name" => "Pizzeria Scarsa SNC"
  ),

  array(
    "id" => 234,
    "name" => "Durum Kebab",
    "price" => 7,
    "picture_url" => "https://tourismembassy.com/media/multimedia/images/45e1696726edab87cfec4dae6049d63e.jpg",
    "restaurant_id" => 2,
    "restaurant_name" => "KeBZ"
  )
);
?>

<!DOCTYPE html>
<html lang="en">
<?php include("widgets/common_head.php"); ?>
<body>

<?php include("widgets/navbar.php"); ?>

<div class="container-fluid text-center mainbody">    
  <div class="row content">
    <div class="col-sm-3 .bg-secondary sidenav text-left">
      <br><br>
      <h4>Deliverable to</h4>
      <div class="form-group">
        <select name="" id="" class="form-control">
          <?php
            foreach ($cities as $city) {
              echo("<option value=\"{$city["id"]}\">{$city["name"]}</option>");
            }
          ?>
        </select>
        <input type="text" name="" id="" class="form-control" placeholder="Address">
      </div>
      <br>
      <h4>Before (lo mettiamo?)</h4>
      <input type="datetime-local" name="" id="" class="form-control">
      <br>
      <h4>In category</h4>
      <select name="" id="" class="form-control">
        <option value="0" selected>All</option>
        <?php
          foreach ($categories as $category) {
            echo("<option value=\"{$category["id"]}\">{$category["name"]}</option>");
          }
        ?>
        <option value="-1">Others</option>
      </select>
      <br>
      <h4>Show only</h4>
      <div class="">
        <?php
          foreach($options as $option) {
            echo("<input type=\"checkbox\" name=\"opt_{$option["id"]}\"> ".
            "<label for=\"opt_{$option["id"]}\">{$option["name"]}</label>".
            "<br>");
          }
        ?>
      </div>
    </div>
    <div class="col-sm-9 text-left"> 
      <h1>8 results in your area</h1>
      <p>All of them can deliver to your address.</p>
      
      <hr>
      <div class="row">
        <?php
        foreach($results as $result) {
        ?>
        <a class="col-md-2 col-sm-4 food-card" href="/product.php?id=<?= $result["id"] ?>">
          <div class="panel panel-default">
            <div class="panel-body list-thumb" style="background-image: url('<?= $result["picture_url"] ?>'); background-size: cover; min-width: 100px; min-height: 120px;">
            </div>
            <div class="panel-footer">
              <b><?= $result["name"] ?></b> 
              <span class="text-right">€<?= $result["price"] ?></span>
              <br>
              <small><?= $result["restaurant_name"] ?></small>
              
            </div>
          </div>
        </a>
      </a>
      <?php
      }
      ?>
    </div>
  </div>
</div>


<?php include("widgets/footer.php"); ?>

</body>
</html>

