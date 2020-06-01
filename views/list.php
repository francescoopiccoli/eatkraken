<!DOCTYPE html>
<html lang="en">
<?php include($_SERVER['DOCUMENT_ROOT'] . "/views/widgets/common_head.php"); ?>
<body>
  <script>
  $(document).ready(function() {
    $(".form-refresh").change(function() {
      $("#form").submit();
    });
  });
  </script>
  <?php include($_SERVER['DOCUMENT_ROOT'] . "/views/widgets/navbar.php"); ?>

  <div class="text-center mainbody main-content">    
    <form id="form" class="row text-center" action="/list.php" method="get">
      <div class="col-xs-12 sidenav text-left">
      <div class="col-md-2 col-sm-4">
       <h4>Deliverable to:</h4>
        <select name="city" class="form-control form-refresh">
          <option value="">Select a city</option>
          <?php
            foreach ($cities as $city) {
              $selected = ( ($city['code'] == $selectedCity) ? "selected" : "");
              echo("<option value=\"{$city['code']}\" {$selected}>{$city['name']}</option>");
            }
          ?>
        </select>        <br>
</div>

        <div class="col-sm-4 col-md-2">
        <h4>Deliver within:</h4>
        <input type="number" name="time" class="form-control form-refresh" placeholder="minutes" min="15" max="120" value="<?= htmlentities($deliveryTime); ?>">
        <br>
      </div>
      <div class="col-sm-4 col-md-2">
        <h4>In category</h4>
        <select name="category" class="form-control form-refresh">
          <option value="0" selected>All</option>
          <?php
            foreach ($categories as $category) {
              $selected = ($category['code'] == $selectedCategory? "selected" : "");
              echo("<option value=\"{$category['code']}\" {$selected}>{$category['name']}</option>");
            }
          ?>
        </select>
        <br>
        </div>
        <div class="col-sm-12 col-md-6">
        <div class="options">
        <h4 id="options-allergenes-height">Show only</h4>
          <?php
            foreach($options as $option) {
              $checked = (in_array($option['code'], $selectedFlags) ? "checked" : "");
              echo("<div class=\"options\"><input type=\"checkbox\" name=\"opt_{$option["code"]}\" class=\"form-refresh\" {$checked}> ".
              "<label class=\"option-allergenes-labels\" for=\"opt_{$option["code"]}\">{$option["name"]}</label></div>");
            }
          ?>
        <br>

        </div>
      </div>
      </div>
      <div class="col-sm-12">
        <h1>
        <?=
          (count($results)>0 ? count($results) . " results in your area" : "No results found")
        ?>
        </h1>
        <?php if(count($results)>0) { ?>
        <p>All of them can deliver to your address.</p>
        <?php } ?>

        
        
        <hr>
        <div class="row results-row">
          <?php
          foreach($results as $result) {
          ?>
          <a class="col-md-2 col-sm-4 col-xs-6 food-card" href="/product.php?code=<?= $result["code"] ?>">
            <div title="dish_card" class="panel panel-default">
              <div class="panel-body list-thumb" style="background-image: url('<?= $result["image_url"] ?>'); background-size: cover; min-width: 100px; min-height: 120px;">
              </div>
              <div class="panel-footer">
                <b class="food-title-card"><?= $result["name"] ?></b> 
                <span class="text-right"><br><?= $result["price"]?>€</span>
                <br>
                <small><?= $result["restaurant_name"] ?></small>
                
              </div>
            </div>
          </a>
        <?php
        }
        ?>
      </div>
  </div>    </form>

  </div>


  <?php include($_SERVER['DOCUMENT_ROOT'] . "/views/widgets/footer.php"); ?>

</body>
</html>

