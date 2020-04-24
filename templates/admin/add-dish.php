<!DOCTYPE html>
<html lang="en">

<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/database.php");

if(isset($_POST["submit"])){

  $productName = mysqli_real_escape_string($_POST["ProductName"]);
  $ProductDescription = mysqli_real_escape_string($_POST["ProductDescription"]);
  $ProductCategory = mysqli_real_escape_string($_POST["ProductCategory"]);
  $ProductPrice = mysqli_real_escape_string($_POST["ProductPrice"]);
  $ProductIngredients = mysqli_real_escape_string($_POST["ProductIngredients"]);
  $nutri_kcal = mysqli_real_escape_string($_POST["nutri_kcal"]);
  $nutri_carb = mysqli_real_escape_string($_POST["nutri_carbs"]);
  $nutri_fat = mysqli_real_escape_string($_POST["nutri_fat"]);
  $nutri_protein = mysqli_real_escape_string($_POST["nutri_protein"]);
  $glutenFree = mysqli_real_escape_string(isset($_POST['glutenFree']) ? $_POST['glutenFree'] : 'no');
  $lactoseFree = mysqli_real_escape_string(isset($_POST['lactoseFree']) ? $_POST['lactoseFree'] : 'no');
  $vegan = mysqli_real_escape_string(isset($_POST['vegan']) ? $_POST['vegan'] : 'no');
  $fresh = mysqli_real_escape_string(isset($_POST['fresh']) ? $_POST['fresh'] : 'no');
  $zeroWaste = mysqli_real_escape_string(isset($_POST['zeroWaste']) ? $_POST['zeroWaste'] : 'no');
  $ProductDescription = mysqli_real_escape_string($_POST["imageUrl"]);
  $ProductCategory = mysqli_real_escape_string($_POST["deliveryTime"]);

  $query = "INSERT INTO dishes";
}


?>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/templates/widgets/common_head.php"); ?>
<body>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/templates/widgets/navbar.php"); ?>


<div class="container-fluid text-center mainbody">    
  <div class="row content">
    <div class="col-sm-12 text-left"> 
      <h2 class="text-left">Insert new dish</h2>
      
      <form action="<?php $_SERVER['PHP_SELF'] ?>"  method="POST">
        <input type="text" class="form-control" placeholder="Name" name="ProductName" required>
        <br>
        <input type="text" class="form-control" placeholder="Short description"  name="ProductDescription" required>
        <br>
        <input type="text" class="form-control" placeholder="Category"  name="ProductCategory" required>
        <br>
        <input type="text" class="form-control" placeholder="Price" name="ProductPrice" required>
        <br>
        <input type="text" class="form-control" placeholder="Ingredients"  name="ProductIngredients" required>
        <br>
        <input type="text" class="form-control" placeholder="image url"  name="imageUrl" required>
        <br>
        <input type="text" class="form-control" placeholder="Estimated delivery time"  name="deliveryTime" required>
        <br>

        <label><h4>Nutritional facts:</h4></label>
        <div class="row text-center">

        <div class="col-sm-3">
          <input type="text" class="form-control" placeholder="kcal" name="nutri_kcal" required>
        </div>

        <div class="col-sm-3">
         <input type="text" class="form-control" placeholder="carb" name="nutri_carbs" required>
        </div>

        <div class="col-sm-3">
         <input type="text" class="form-control" placeholder="fat" name="nutri_fat" required>
        </div>

        <div class="col-sm-3">
         <input type="text" class="form-control" placeholder="protein" name="nutri_protein" required>
        </div>
      </div>
<br>

<label><h4>Allergenes:</h4></label>
<div class="text-left">
          <input type="checkbox" name="glutenFree" class="form-check-input" id="exampleCheck1">
          <label class="form-check-label" for="exampleCheck1">Gluten free</label><br>

          <input type="checkbox" name="lactoseFree" class="form-check-input" id="exampleCheck1">
          <label class="form-check-label" for="exampleCheck1">Lactose free</label><br>

          <input type="checkbox" name="vegan" class="form-check-input" id="exampleCheck1">
          <label class="form-check-label" for="exampleCheck1">Vegan</label><br>

          <input type="checkbox" name="fresh"class="form-check-input" id="exampleCheck1">
          <label class="form-check-label" for="exampleCheck1">Fresh</label><br>

          <input type="checkbox" name="zeroWaste" class="form-check-input" id="exampleCheck1">
          <label class="form-check-label" for="exampleCheck1">Zero waste</label><br>
      </div>

      <br>
      <br>
      <div class="text-right">
        <input type="submit" value="Send" class="btn btn-success  btn-lg" name="submit">
        <input type="reset" value="Reset" class="btn btn-danger  btn-lg" name="reset">
      </div>
      </form>
    </div>
  </div>
</div>

<br><br>
<?php include($_SERVER['DOCUMENT_ROOT'] . "/templates/widgets/footer.php"); ?>

</body>
</html>

