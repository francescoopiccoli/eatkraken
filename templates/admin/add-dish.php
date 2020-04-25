<!DOCTYPE html>
<html lang="en">

<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/database.php");

if(isset($_POST["submit"])){


  $code = 10; // autoincrement??
  $productName = mysqli_real_escape_string($_POST["ProductName"]);
  $productDescription = mysqli_real_escape_string($_POST["ProductDescription"]);
  $productPrice = mysqli_real_escape_string($_POST["ProductPrice"]);
  $restaurant = ""; //??
  $productCategory = mysqli_real_escape_string($_POST["ProductCategory"]);
  $productIngredients = mysqli_real_escape_string($_POST["ProductIngredients"]);
  $nutri_kcal = mysqli_real_escape_string($_POST["nutri_kcal"]);
  $nutri_carb = mysqli_real_escape_string($_POST["nutri_carbs"]);
  $nutri_fat = mysqli_real_escape_string($_POST["nutri_fat"]);
  $nutri_protein = mysqli_real_escape_string($_POST["nutri_protein"]);
  $glutenFree = mysqli_real_escape_string(isset($_POST['glutenFree']) ? $_POST['glutenFree'] : 'no');
  $lactoseFree = mysqli_real_escape_string(isset($_POST['lactoseFree']) ? $_POST['lactoseFree'] : 'no');
  $vegan = mysqli_real_escape_string(isset($_POST['vegan']) ? $_POST['vegan'] : 'no');
  $fresh = mysqli_real_escape_string(isset($_POST['fresh']) ? $_POST['fresh'] : 'no');
  $zeroWaste = mysqli_real_escape_string(isset($_POST['zeroWaste']) ? $_POST['zeroWaste'] : 'no');
  $productImageURL = mysqli_real_escape_string($_POST["imageUrl"]);
  $productDeliveryTime = mysqli_real_escape_string($_POST["deliveryTime"]);

  try{
   
    $connection = new PDO($GLOBALS['db_pdo_data']);
    $stmt = $connection->prepare("INSERT INTO dishes VALUES (:code, :productName, :productDescription, :productPrice, :restaurant, :productCategory, :productIngredients, :nutri_carb, :nutri_fat, :nutri_kcal, :nutri_protein, :glutenFree, :lactoseFree, :vegan, :fresh, :zeroWaste, :productImageURL, :productDeliveryTime");

    $stmt->bindParam(':code', $code);
    $stmt->bindParam(':productName', $productName);
    $stmt->bindParam(':productDescription', $productDescription);
    $stmt->bindParam(':productPrice', $productPrice);
    $stmt->bindParam(':restaurant', $restaurant);
    $stmt->bindParam(':productCategory', $productCategory);
    $stmt->bindParam(':productIngredients', $productIngredients);
    $stmt->bindParam(':nutri_carb', $nutri_carb);
    $stmt->bindParam(':nutri_fat', $nutri_fat);
    $stmt->bindParam(':nutri_kcal', $nutri_kcal);
    $stmt->bindParam(':nutri_protein', $nutri_protein);
    $stmt->bindParam(':glutenFree', $glutenFree);
    $stmt->bindParam(':lactoseFree', $lactoseFree);
    $stmt->bindParam(':vegan', $vegan);
    $stmt->bindParam(':zeroWaste', $zeroWaste);
    $stmt->bindParam(':productImageURL', $productImageURL);
    $stmt->bindParam(':productDeliveryTime', $productDeliveryTime);
    $stmt->execute();
  }
  catch(PDOException $e){
    echo "Error: " . $e->getMessage();
  }

  $connection = null;
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

