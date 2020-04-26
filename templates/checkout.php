<?php
$title = "Checkout";

?>
<!DOCTYPE html>
<html lang="en">
<?php include($_SERVER['DOCUMENT_ROOT'] . "/templates/widgets/common_head.php"); ?>
  <body>

    <?php include($_SERVER['DOCUMENT_ROOT'] . "/templates/widgets/navbar.php"); ?>


    <div class="container-fluid text-center mainbody">    
      <div class="row content checkout-main">
        <div class="col-sm-12 text-left"> 

          <div class="row checkout-total-row">
            <div class="col-sm-8">
              <b>Deliver to:</b>
              <br>
              <span id="address">AAA BBB CCC</span> (<a href="#" onclick="editAddress()">edit</a>)
            </div>
            
            <div class="col-sm-2 text-center">
              Shipping
              <h2>€5</h2>
            </div>
            <div class="col-sm-2 text-center">
              Total
              <h2>€<?= cart_get_total() + 0 /* TODO: shipping cost */ ?></h2>
            </div>
          </div>

          <?php foreach($orders as $restaurant => $items) { ?>
          <h2><?= db_get_restaurant_name($restaurant); ?></h2>
           
          
          <?php 
          foreach($items as $item) { 
            $item = db_get_product($item['id']);
          ?>
          <div class="row checkout-results-row">
            <div class="col-sm-2">
              <img class="thumbnail-small" src="https://cdn-media.italiani.it/site-caserta/2019/01/pizza-con-ananas-caserta-2.jpg">
            </div>
            <div class="col-sm-5">
              <h3><a href="/product.php?code=<?= $item['code']; ?>"><?= $item['name']; ?></a></h3>
              <p><?= $item['nutri_kcal']; ?>Kcal</p>
              <small><i id="notes-<?= $restaurant; ?>">No custom note</i> (<a href="#" onclick="editNotes(<?= $restaurant; ?>)">edit</a>)</small>
            </div>
            <div class="col-sm-3">
              <select name="" id="" class="form-control">
                <option value="">0 (remove)</option>
                <option value="" selected>1x</option>
                <option value="">2x</option>
                <option value="">3x</option>
                <option value="">4x</option>
                <option value="">5x</option>
              </select>
              <br>
              <select name="" id="" class="form-control">
                <option value="">Home delivery (+€5)</option>
                <option value="">Eat in (free)</option>
              </select>
            </div>
            <div class="col-sm-2 text-center">
              <h3><?= $item['price']; ?>€</h3>
              +warnings?
            </div>
          </div>

          <?php } } ?>



        </div>
      </div>
    </div>


    <?php include($_SERVER['DOCUMENT_ROOT'] . "/templates/widgets/footer.php"); ?>
    <script>
      function editNotes(id) {
        notes = prompt("Enter custom message");
        $("#notes-"+id).text(notes);
      }
      function editAddress() {
        address = prompt("Enter delivery address");
        $("#address").text(address);
      }
    </script>
  </body>
</html>

