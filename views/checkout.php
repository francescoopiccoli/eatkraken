<?php
$title = "Checkout";
$isCheckoutPage = true; // for checkout widget
?>
<!DOCTYPE html>
<html lang="en">
<?php include($_SERVER['DOCUMENT_ROOT'] . "/views/widgets/common_head.php"); ?>
  <body>

    <?php include($_SERVER['DOCUMENT_ROOT'] . "/views/widgets/navbar.php"); ?>


    <div class="container-fluid text-center mainbody">    
      <div class="row content checkout-main">
        <div class="col-sm-12"> 

          <div class="row checkout-total-row">
            <div class="col-sm-3">
              <b style="font-size: 1.3em; font-family: 'Acme';">Deliver to:</b>
              <br><br>
              <b id="full_name"><?= $cart_name; ?></b> (<a href="#" onclick="editName()">edit</a>)
              <br>  
              <span id="address"><?= $cart_addr; ?></span> (<a href="#" onclick="editAddress()">edit</a>)
              <br>
              <i id="city"><?= $cart_city ?></i> (<a href="#" data-target="#modal-city" data-toggle="modal">edit</a>)

            </div>
            <div class="col-sm-3">
              <b style="font-size: 1.3em; font-family: 'Acme';">Personal information</b>
              <br><br>
              <span id="mail"><?= $cart_email ?></span> (<a href="#" onclick="editMail()">edit</a>)
              <br>
              <span id="phone"><?= $cart_phone ?></span> (<a href="#" onclick="editPhone()">edit</a>)
            </div>

           
              <div class="col-sm-2 text-center">
              <b style="font-size: 1.3em; font-family: 'Acme';">Shipping</b>
                <!-- todo! -->
                <h3><?= $cart_shipping_total ?>€</h3>
              </div>
              <div class="col-sm-2 text-center">
              <b style="font-size: 1.3em; font-family: 'Acme';">Total</b>

                <h3><?= $cart_total ?>€</h3>
              </div>
              <div class="col-sm-2 text-center">
              <form action="checkout.php" method="post">
                <input type="hidden" name="confirm">
                <?php if(count($cart_items) > 0) { ?>
                <button type="submit" class="btn btn-success btn-lg" style="font-family: 'Acme';">Confirm</button>
                <?php } ?>
              </form>
            </div>
          </div>

          <?php foreach($cart_orders as $restaurant => $items) { ?>
          <div class="row">
            <div class="col-sm-10">
              <h2><?= db_get_restaurant_name($restaurant); ?></h2>
              <?php if(cart_get_restaurant_shipping($restaurant) == 2 && !db_restaurant_can_deliver($restaurant, cart_get_city())) { ?>
              <div style="color: red;">As this restaurant cannot deliver to your city, its items will be ignored.</div>
              <?php } ?>
              
              <i id="notes-<?= $restaurant; ?>"><?= cart_get_restaurant_message($restaurant); ?></i> (<a href="#" onclick="editNotes(<?= $restaurant; ?>)">edit</a>)
            </div>

            <div class="col-sm-2">
              <br>
              <select name="" id="shipping-<?= $restaurant ?>" class="form-control" onchange="changeShipping(<?= $restaurant; ?>);">
                <?php 
                $shipping_methods = db_get_shipping_methods($restaurant);
                foreach ($shipping_methods as $method) {
                  $sel = (cart_get_restaurant_shipping($restaurant) == $method['id'] ? "selected" : "");
                ?>
                <option value="<?= $method['id'] ?>" <?= $sel ?>>
                  <?= $method['name'] ?>
                  (<?= number_format($method['cost'], 2) ?>€)
                </option>
                <?php } ?>
              </select>
            </div>
          </div>

          <?php 
          foreach($items as $item) { 
            $item = db_get_product($item['code']);
          ?>
          <div class="row checkout-results-row">
           
            <div class="col-sm-3">
            <img class="circular--landscape checkoutProductImage" style ="width:140px; height:140px; text-align:center"src=<?=$item['image_url']?>>

            </div>
            <div class="col-sm-7">
              <h3><a style="color: black; text-decoration: none; font-family: 'Acme'" href="/product.php?code=<?= $item['code']; ?>"><?= $item['name']; ?></a></h3>
              <i style="font-size: 1.2em; "><?= $item['description']; ?></i>
              <br>
            </div>

            <div class="col-sm-1 text-center">
              <b style="font-size: 2em"><?= $item['price']; ?>€</b>
            </div>
              <?php /* allergenes warnings? */ ?>
              <div class="col-sm-1 text-center">
              <form action="checkout.php" method="post">
                <input type="hidden" name="dish" value="<?= $item['code']; ?>">
                <input type="hidden" name="remove" value="true">
                <button type="submit" class="btn btn-danger" style="font-family: 'Acme';">Remove</button>
              </form>
            </div>
          </div>
          <hr style="border-color: #bbb;">

          <?php } }?>
          
        </div>
      </div>
    </div>
    
    <div class="modal fade" id="modal-city"  tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <form class="modal-content" action="checkout.php" method="post">
          <div class="modal-header">
            <h4 class="modal-title" style="display: inline;">Select delivery city</h4>
            <input class="btn btn-sm btn-primary" type="submit" value="Confirm" style="float: right;">
            
          </div>
          <div class="modal-body">
            <select name="set_city" class="form-control" style="display: inline;">
              <?php
              foreach ($cities as $city) {
                $selected = ($cart_city == $city['name'] ? "selected" : "");
                echo '<option value="'.$city['code'].'" '.$selected.'>'.$city['name'].'</option>';
              }
              ?>
            </select>
          </div>
        </form>
      </div>
    </div>

    <?php include($_SERVER['DOCUMENT_ROOT'] . "/views/widgets/footer.php"); ?>
    <script>
      function editNotes(id) {
        notes = prompt("Enter custom message");

        if(notes != null)
          $("<form>", {
            "action": "checkout.php",
            "method": "post",
          }).append(
            $("<input/>", {"type": "hidden", "name": "restaurant", "value": id})
          ).append(
            $("<input/>", {"type": "hidden", "name": "set_message", "value": notes})
          )
          .appendTo(document.body)
          .submit();
      }

      function editName() {
        fName = prompt("Enter full name");

        if(fName != null)
          $("<form>", {
            "action": "checkout.php",
            "method": "post",
          }).append(
            $("<input/>", {"type": "hidden", "name": "set_full_name", "value": fName})
          )
          .appendTo(document.body)
          .submit();
      }
      function editAddress() {
        address = prompt("Enter delivery address");

        if(address != null)
          $("<form>", {
            "action": "checkout.php",
            "method": "post",
          }).append(
            $("<input/>", {"type": "hidden", "name": "set_address", "value": address})
          )
          .appendTo(document.body)
          .submit();
      }
      function editMail() {
        address = prompt("Enter e-mail address");

        if(address != null)
          $("<form>", {
            "action": "checkout.php",
            "method": "post",
          }).append(
            $("<input/>", {"type": "hidden", "name": "set_email", "value": address})
          )
          .appendTo(document.body)
          .submit();
      }
      function editPhone() {
        phone = prompt("Enter phone number");

        if(phone != null)
          $("<form>", {
            "action": "checkout.php",
            "method": "post",
          }).append(
            $("<input/>", {"type": "hidden", "name": "set_phone", "value": phone})
          )
          .appendTo(document.body)
          .submit();
      }
      function changeShipping(restaurant) {
        shipping = $("#shipping-"+restaurant).val();
        if(!isNaN(shipping))
          $("<form>", {
              "action": "checkout.php",
              "method": "post",
            }).append(
              $("<input/>", {"type": "hidden", "name": "restaurant", "value": restaurant})
            ).append(
              $("<input/>", {"type": "hidden", "name": "set_shipping", "value": shipping})
            )
            .appendTo(document.body)
            .submit();
      }
      
    </script>
  </body>
</html>
