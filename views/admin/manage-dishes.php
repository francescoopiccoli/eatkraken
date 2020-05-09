<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/session.php");

if(!restaurant_is_logged_in()) {
  header("Location: /");
  exit;
}
?>
<?php
function get_dishes(){
  return db_stmt_query("select code, name, price, image_url from dishes where restaurant = ?", [restaurant_get_logged_id()]);
}

function removeElement($code){
  
}

//not working for now
if(isset($_POST['remove'])) {
  $code= $dish['code'];
  echo $code;
  $connection = new PDO($GLOBALS['db_pdo_data'], $GLOBALS['db_username'], $GLOBALS['db_password'], array(PDO::ATTR_PERSISTENT => true));
  $stmt = $connection->prepare("DELETE FROM dishes WHERE code = $code;");
  $stmt->execute();
  $connection = null;
}

?>

<!DOCTYPE html>
<html lang="en">
<?php include($_SERVER['DOCUMENT_ROOT'] . "/views/widgets/common_head.php"); ?>
<body>
  
  <?php include($_SERVER['DOCUMENT_ROOT'] . "/views/widgets/navbar.php"); ?>


  <div class="container-fluid text-center mainbody">    
    <div class="row content">
      <div class="col-sm-12 text-left"> 
        <h1 style="display: inline-block">Your dishes</h1>
        <a href="add-dish.php" style="font-family: 'Acme'; float:right; margin-top: 20px;" class="btn btn-success btn-lg">Add dish</a>
        <br>
        <i>To edit a dish, please delete it and insert it again.</i>
        <hr>

        <div class="row">
          <?php 

            $dishes = get_dishes();

              foreach($dishes as $dish) { ?>
              <div class="col-md-2 col-sm-4" href="">
                <div class="panel panel-default">
                  <div class="panel-body list-thumb" style="background-image: url('<?= $dish["image_url"]; ?>'); background-size: cover; min-width: 100px; min-height: 120px;">
                  
                  </div>
                  <div class="panel-footer text-center">
                  <a style="color:black" href="/product.php?code=<?= $dish["code"];?>" target="_blank">
                    <b style="font-size:1.1em"><?= $dish["name"] ?></b>                     
                  </a>

                    <br>
                    <b><?= $dish["price"] ?>€</b> 
                    <br>
                    <form method="post" action="manage-dishes.php">
                    <input type="hidden" name="dish" value="<?= $dish['code']; ?>">
                    <input type="submit" name="remove" value="Remove" class="btn btn-danger btn-sm"/>
                    </form> 
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

