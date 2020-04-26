<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/session.php");

if(!restaurant_is_logged_in()) {
  header("Location: /");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<?php 

if(isset($_POST["submit"])){


  $productName = $_POST["ProductName"];
  $productDescription = $_POST["ProductDescription"];
  $productPrice = $_POST["ProductPrice"];
  $restaurant = 2; //??
  $productCategory = $_POST["ProductCategory"];
  $productIngredients = $_POST["ProductIngredients"];
  $nutri_kcal = $_POST["nutri_kcal"];
  $nutri_carb = $_POST["nutri_carbs"];
  $nutri_fat = $_POST["nutri_fat"];
  $nutri_protein = $_POST["nutri_protein"];


  if(!isset($_POST['glutenFree'])){
    $glutenFree = 'false';
  }
  else{
    $glutenFree = $_POST['glutenFree'];
  }

  if(!isset($_POST['lactoseFree'])){
    $lactoseFree = 'false';
  }
  else{
    $lactoseFree = $_POST['lactoseFree'];
  }

  
  if(!isset($_POST['vegan'])){
    $vegan = false;
  }
  else{
    $vegan = $_POST['vegan'];
  }

  
  if(!isset($_POST['fresh'])){
    $fresh = 'false';
  }
  else{
    $fresh = $_POST['fresh'];
  }

  
  if(!isset($_POST['zeroWaste'])){
    $zeroWaste = 'false';
  }
  else{
    $zeroWaste = $_POST['zeroWaste'];
  }

  $productImageURL = $_POST["imageUrl"];
  $productDeliveryTime = $_POST["deliveryTime"];

  $connection = new PDO($GLOBALS['db_pdo_data']);
  print_r($_POST);

  try{
   
    $stmt = $connection->prepare("INSERT INTO 'dishes' (name, description, price, restaurant, category, ingredients, nutri_carbs, nutri_fats, nutri_kcal, nutri_proteins, flag_gluten_free, flag_lactose_free, flag_vegan, flag_fresh, flag_zero_waste, image_url, delivery_time)
     VALUES (:productName, :productDescription, :productPrice, :restaurant, :productCategory, :productIngredients, :nutri_carb, :nutri_fat, :nutri_kcal, :nutri_protein, :glutenFree, :lactoseFree, :vegan, :fresh, :zeroWaste, :productImageURL, :productDeliveryTime)");

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
    $stmt->bindParam(':fresh', $fresh);
    $stmt->bindParam(':zeroWaste', $zeroWaste);
    $stmt->bindParam(':productImageURL', $productImageURL);
    $stmt->bindParam(':productDeliveryTime', $productDeliveryTime);
    $inserted = $stmt->execute();
    
    if($inserted){
      echo "New records created successfully";}

    else{
      echo "error";
    }
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
          <input type="checkbox" name="glutenFree" class="form-check-input" id="1">
          <label class="form-check-label" for="1">Gluten free</label><br>

          <input type="checkbox" name="lactoseFree" class="form-check-input" id="2">
          <label class="form-check-label" for="2">Lactose free</label><br>

          <input type="checkbox" name="vegan" class="form-check-input" id="3">
          <label class="form-check-label" for="3">Vegan</label><br>

          <input type="checkbox" name="fresh"class="form-check-input" id="4">
          <label class="form-check-label" for="4">Fresh</label><br>

          <input type="checkbox" name="zeroWaste" class="form-check-input" id="5">
          <label class="form-check-label" for="5">Zero waste</label><br>
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

