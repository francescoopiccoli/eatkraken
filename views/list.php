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

  <div class="container-fluid text-center mainbody">    
    <form id="form" class="row" action="/list.php" method="get">
      <div class="col-sm-3 .bg-secondary sidenav text-left">
        <br><br>
        <h4>Deliverable to</h4>
        <select name="city" class="form-control form-refresh">
          <option value="">Select a city</option>
          <?php
            foreach ($cities as $city) {
              $selected = ( ($city['code'] == $selectedCity) ? "selected" : "");
              echo("<option value=\"{$city['code']}\" {$selected}>{$city['name']}</option>");
            }
          ?>
        </select>
        <br>
        <h4>Deliver within (minutes)</h4>
        <input type="number" name="time" id="" class="form-control form-refresh" placeholder="minutes" min="15" max="120" value="<?= htmlentities($deliveryTime); ?>">
        <br>
        <h4>In category</h4>
        <select name="category" id="" class="form-control form-refresh">
          <option value="0" selected>All</option>
          <?php
            foreach ($categories as $category) {
              $selected = ($category['code'] == $selectedCategory? "selected" : "");
              echo("<option value=\"{$category['code']}\" {$selected}>{$category['name']}</option>");
            }
          ?>
          <option value="-1">Others</option>
        </select>
        <br>
        <h4>Show only</h4>
        <div class="">
          <?php
            foreach($options as $option) {
              $checked = (in_array($option['code'], $selectedFlags) ? "checked" : "");
              echo("<input type=\"checkbox\" name=\"opt_{$option["code"]}\" class=\"form-refresh\" {$checked}> ".
              "<label for=\"opt_{$option["code"]}\">{$option["name"]}</label>".
              "<br>");
            }
          ?>
        </div>
      </div>
      <div class="col-sm-9 text-left"> 
        <h1><?= count($results); ?> results in your area</h1>
        <p>All of them can deliver to your address.</p>
        
        <hr>
        <div class="row">
          <?php
          foreach($results as $result) {
          ?>
          <a class="col-md-2 col-sm-4 food-card" href="/product.php?code=<?= $result["code"] ?>">
            <div class="panel panel-default">
              <div class="panel-body list-thumb" style="background-image: url('<?= $result["image_url"] ?>'); background-size: cover; min-width: 100px; min-height: 120px;">
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
    </form>
  </div>
  </div>


  <?php include($_SERVER['DOCUMENT_ROOT'] . "/views/widgets/footer.php"); ?>

</body>
</html>

