<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/session.php");

if(!restaurant_is_logged_in()) {
  header("Location: /");
  exit;
}
?>
<?php
$dishes = array(
  array(
    "id" => 123,
    "name" => "Pizza Margherita",
    "price" => 15,
    "picture_url" => "https://cdn-media.italiani.it/site-caserta/2019/01/pizza-con-ananas-caserta-2.jpg",
  )
);
?>

<!DOCTYPE html>
<html lang="en">
<?php include($_SERVER['DOCUMENT_ROOT'] . "/views/widgets/common_head.php"); ?>
<body>
  <script>
  function removeDish(id) {
    if(confirm("Are you sure?")) {
      // ajax POST
      location.reload();
    }
  }
  </script>

  <?php include($_SERVER['DOCUMENT_ROOT'] . "/views/widgets/navbar.php"); ?>


  <div class="container-fluid text-center mainbody">    
    <div class="row content">
      <div class="col-sm-12 text-left"> 
        <h1>Your dishes</h1>
        <p>
          Here are all the dishes in your restaurant, sorted alphabetically.
        </p>
        <br>
        <a href="add-dish.php" class="btn btn-success btn-sm">Add</a>
        
        <hr>
        <div class="row">
          <?php foreach($dishes as $dish) { ?>
          <div class="col-md-2 col-sm-4" href="">
            <div class="panel panel-default">
              <div class="panel-body list-thumb" style="background-image: url('<?= $dish["picture_url"]; ?>'); background-size: cover; min-width: 100px; min-height: 120px;">
              
              </div>
              <div class="panel-footer text-center">
                <b><?= $dish["name"] ?></b> 
                <br>
                <a class="btn btn-primary btn-sm" href="/product.php?id=<?= $dish["id"]; ?>" target="_blank">
                  View
                </a>
                <button class="btn btn-danger btn-sm" onclick="removeDish(<?= $dish["id"]; ?>)">
                  Remove
                </button>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>

  <?php include($_SERVER['DOCUMENT_ROOT'] . "/views/widgets/footer.php"); ?>
  </body>
</html>

