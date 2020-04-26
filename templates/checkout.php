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
              <span id="address">No address specified</span> (<a href="#" onclick="editAddress()">edit</a>)
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
          <div class="row">
            <div class="col-sm-10">
              <h2><?= db_get_restaurant_name($restaurant); ?></h2>
              <i id="notes-<?= $restaurant; ?>">No custom message</i> (<a href="#" onclick="editNotes(<?= $restaurant; ?>)">edit</a>)
            </div>

            <div class="col-sm-2">
              <br>
              <select name="" id="" class="form-control" onchange="changeShipping(<?= $restaurant; ?>);">
                <?php /* todo: show only supported shipping methods */ ?>
                <option value="">Home delivery (+€5)</option>
                <option value="">Eat in (free)</option>
              </select>
            </div>
          </div>

          <?php 
          foreach($items as $item) { 
            $item = db_get_product($item['id']);
          ?>
          <div class="row checkout-results-row">
            <div class="col-sm-2">
              <img class="thumbnail-small" src="<?= $item['image_url']; ?>">
            </div>
            <div class="col-sm-8">
              <h3><a href="/product.php?code=<?= $item['code']; ?>"><?= $item['name']; ?></a></h3>
              <p><?= $item['nutri_kcal']; ?>Kcal</p>
            </div>

            <div class="col-sm-2 text-center">
              <h3><?= $item['price']; ?>€</h3>
              <?php /* allergenes warnings? */ ?>
              <a class="btn btn-sm btn-danger" href="checkout.php?dish=<?= $item['code']; ?>&remove">Remove</a>
            </div>
          </div>

          <?php } ?>
          <hr style="border-color: #bbb;">
          <?php } ?>



        </div>
      </div>
    </div>


    <?php include($_SERVER['DOCUMENT_ROOT'] . "/templates/widgets/footer.php"); ?>
    <script>
      function editNotes(id) {
        notes = prompt("Enter custom message");

        if(notes != null) // "cancel" pressed
          $("#notes-"+id).text(notes);
      }
      function editAddress() {
        address = prompt("Enter delivery address");
        if(address != null)
          $("#address").text(address);
      }
    </script>
  </body>
</html>

