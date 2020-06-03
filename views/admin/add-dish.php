
<!DOCTYPE html>
<html lang="en">

<?php include($_SERVER['DOCUMENT_ROOT'] . "/views/widgets/common_head.php"); ?>

<body>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/views/widgets/navbar.php"); ?>


<div class="container-fluid text-center mainbody">    
  <div class="row content">
    <div class="col-sm-12 text-left"> 
      <h2 class="text-left">Insert new dish</h2>
      
      <form method="POST">
        <input type="text" maxlength="30" class="form-control" placeholder="Name" name="ProductName" required>
        <br>
        <input type="text" maxlength="200" class="form-control" placeholder="Short description"  name="ProductDescription" required>
        <br>
        <select name="ProductCategory" class="form-control" required>
          <option value="">Category</option>
          <?php
            foreach ($categories as $category) {
              $selected = ($category['code'] == $selectedCategory? "selected" : "");
              echo("<option value=\"{$category['code']}\" {$selected}>{$category['name']}</option>");
            }
          ?>
        </select>
        <br>
        <input type="number" min="0" step="0.01" class="form-control" placeholder="Price" name="ProductPrice" required>
        <br>
        <input type="text" maxlength="300" class="form-control" placeholder="Ingredients"  name="ProductIngredients" required>
        <br>
        <input type="url" maxlength="400" class="form-control" placeholder="image url"  name="imageUrl" required>
        <br>
        <input type="number" min="3" class="form-control" placeholder="Estimated delivery time"  name="deliveryTime" required>
        <br>

        <label><b class="field-titles">Nutritional facts:</b></label>
        <div class="row text-center">

        <div class="col-sm-3">
          <input type="number" min="0" step="0.01" class="form-control" placeholder="kcal" name="nutri_kcal" required>
        </div>

        <div class="col-sm-3">
         <input type="number" min="0" step="0.01" class="form-control" placeholder="carb" name="nutri_carbs" required>
        </div>

        <div class="col-sm-3">
         <input type="number" min="0" step="0.01" class="form-control" placeholder="fat" name="nutri_fat" required>
        </div>

        <div class="col-sm-3">
         <input type="number" min="0" step="0.01" class="form-control" placeholder="protein" name="nutri_protein" required>
        </div>
      </div>
<br>

<label><b class="field-titles">Allergenes:</b></label>
<div class="text-left">
          <input type="checkbox" name="glutenFree" class="form-check-input" id="1" value="true">
          <label class="form-check-label" for="1">Gluten free</label><br>

          <input type="checkbox" name="lactoseFree" class="form-check-input" id="2" value="true">
          <label class="form-check-label" for="2">Lactose free</label><br>

          <input type="checkbox" name="vegan" class="form-check-input" id="3" value="true">
          <label class="form-check-label" for="3">Vegan</label><br>

          <input type="checkbox" name="fresh" class="form-check-input" id="4" value="true">
          <label class="form-check-label" for="4">Fresh</label><br>

          <input type="checkbox" name="zeroWaste" class="form-check-input" id="5" value="true">
          <label class="form-check-label" for="5">Zero waste</label><br>
      </div>

      <br>
      <br>
      <div class="text-right">
        <input type="submit" value="ADD" class="btn btn-default btn-lg add-dish-btn-submit" name="submit">
        <input type="reset" value="RESET" class="btn btn-default btn-lg add-dish-btn-reset" name="reset">
      </div>
      </form>
    </div>
  </div>
</div>

<br><br>
<?php include($_SERVER['DOCUMENT_ROOT'] . "/views/widgets/footer.php"); ?>

</body>
</html>

