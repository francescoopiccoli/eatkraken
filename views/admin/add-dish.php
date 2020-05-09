
<!DOCTYPE html>
<html lang="en">

<?php include($_SERVER['DOCUMENT_ROOT'] . "/views/widgets/common_head.php"); ?>

<body>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/views/widgets/navbar.php"); ?>


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
          <input type="checkbox" name="glutenFree" class="form-check-input" id="1" value="true">
          <label class="form-check-label" for="1">Gluten free</label><br>

          <input type="checkbox" name="lactoseFree" class="form-check-input" id="2" value="true">
          <label class="form-check-label" for="2">Lactose free</label><br>

          <input type="checkbox" name="vegan" class="form-check-input" id="3" value="true">
          <label class="form-check-label" for="3">Vegan</label><br>

          <input type="checkbox" name="fresh"class="form-check-input" id="4" value="true">
          <label class="form-check-label" for="4">Fresh</label><br>

          <input type="checkbox" name="zeroWaste" class="form-check-input" id="5" value="true">
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
<?php include($_SERVER['DOCUMENT_ROOT'] . "/views/widgets/footer.php"); ?>

</body>
</html>

