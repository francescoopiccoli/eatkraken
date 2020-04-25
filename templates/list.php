<!DOCTYPE html>
<html lang="en">
<?php include($_SERVER['DOCUMENT_ROOT'] . "/templates/widgets/common_head.php"); ?>
<body>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/templates/widgets/navbar.php"); ?>

<div class="container-fluid text-center mainbody">    
  <div class="row">
    <div class="col-sm-3 .bg-secondary sidenav text-left">
      <br><br>
      <h4>Deliverable to</h4>
      <select name="" id="" class="form-control">
        <?php
          foreach ($cities as $city) {
            echo("<option value=\"{$city["code"]}\">{$city["name"]}</option>");
          }
        ?>
      </select>
      <br>
      <h4>Deliver before</h4>
      <input type="datetime-local" name="" id="" class="form-control">
      <br>
      <h4>In category</h4>
      <select name="" id="" class="form-control">
        <option value="0" selected>All</option>
        <?php
          foreach ($categories as $category) {
            echo("<option value=\"{$category["code"]}\">{$category["name"]}</option>");
          }
        ?>
        <option value="-1">Others</option>
      </select>
      <br>
      <h4>Show only</h4>
      <div class="">
        <?php
          foreach($options as $option) {
            echo("<input type=\"checkbox\" name=\"opt_{$option["code"]}\"> ".
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
</div>


<?php include($_SERVER['DOCUMENT_ROOT'] . "/templates/widgets/footer.php"); ?>

</body>
</html>

