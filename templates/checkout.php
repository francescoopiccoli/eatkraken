<?php
$title = "Checkout";
$isCheckoutPage = true; // for checkout widget
?>
<!DOCTYPE html>
<html lang="en">
<?php include($_SERVER['DOCUMENT_ROOT'] . "/templates/widgets/common_head.php"); ?>
  <body>

    <?php include($_SERVER['DOCUMENT_ROOT'] . "/templates/widgets/navbar.php"); ?>


    <div class="container-fluid text-center mainbody">    
      <div class="row content checkout-main">
        <div class="col-sm-12"> 

          <div class="row checkout-total-row">
            <div class="col-sm-3">
              <b style="font-size: 1.3em; font-family: 'Acme';">Deliver to:</b>
              <br><br>
              <span id="full_name"><?= (cart_get_full_name() != "" ? cart_get_full_name() : "Enter Full Name"); ?></span> (<a href="#" onclick="editName()">edit</a>)
              <br>  
              <span id="address"><?= cart_get_address(); ?></span> (<a href="#" onclick="editAddress()">edit</a>)

            </div>
            <div class="col-sm-3">
              <b style="font-size: 1.3em; font-family: 'Acme';">Personal information</b>
              <br><br>
              <span id="address"><?= (cart_get_email() == "" ? "No email specified" : cart_get_email()); ?></span> (<a href="#" onclick="editMail()">edit</a>)<br>
              <span id="address"><?= (cart_get_phone() == "" ? "No phone specified" : cart_get_phone()); ?></span> (<a href="#" onclick="editPhone()">edit</a>)
            </div>

           
              <div class="col-sm-2 text-center">
              <b style="font-size: 1.3em; font-family: 'Acme';">Shipping</b>
                <!-- todo! -->
                <h3><?= cart_get_shipping_total() ?>€</h3>
              </div>
              <div class="col-sm-2 text-center">
              <b style="font-size: 1.3em; font-family: 'Acme';">Total</b>

                <h3><?= cart_get_total() + cart_get_shipping_total() ?>€</h3>
              </div>
              <div class="col-sm-2 text-center">
              <form action="checkout.php" method="post">
                <input type="hidden" name="confirm">
                <?php if(count(cart_get_items()) > 0) { ?>
                <button type="submit" class="btn btn-success btn-lg" style="margin-top:20px; font-family: 'Acme';">Confirm order</button>
                <?php } ?>
              </form>
            </div>
          </div>

          <?php foreach($orders as $restaurant => $items) { ?>
          <div class="row">
            <div class="col-sm-10">
              <h2><?= db_get_restaurant_name($restaurant); ?></h2>
              <i id="notes-<?= $restaurant; ?>"><?= cart_get_restaurant_message($restaurant); ?></i> (<a href="#" onclick="editNotes(<?= $restaurant; ?>)">edit</a>)
            </div>

            <div class="col-sm-2">
              <br>
              <select name="" id="shipping-<?= $restaurant; ?>" class="form-control" onchange="changeShipping(<?= $restaurant; ?>);">
                <?php 
                $shipping_methods = db_get_shipping_methods($restaurant);
                foreach ($shipping_methods as $method) {
                  $sel = (cart_get_restaurant_shipping($restaurant) == $method['id'] ? "selected" : "");
                ?>
                <option value="<?= $method['id'] ?>" <?= $sel ?>>
                  <?= $method['name'] ?>
                  (<?= number_format($method['cost'], 2) ?>€)
                </option>
                <?php
                }
                ?>
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
                <button type="submit" class="btn btn-lg btn-danger" style="font-family: 'Acme';">Remove</button>
              </form>
            </div>
          </div>
          <hr style="border-color: #bbb;">

          <?php } }?>
          
        </div>
      </div>
    </div>


    <?php include($_SERVER['DOCUMENT_ROOT'] . "/templates/widgets/footer.php"); ?>
    <script>
      function editNotes(id) {
        notes = prompt("Enter custom message");

        if(notes != null)
          document.location = "/checkout.php?restaurant="+id+"&set_message="+encodeURI(notes);
      }

      function editName() {
        fName = prompt("Enter full name");

        if(fName != null)
          document.location = "/checkout.php?set_full_name="+encodeURI(fName);
      }
      function editAddress() {
        address = prompt("Enter delivery address");

        if(address != null)
          document.location = "/checkout.php?set_address="+encodeURI(address);
      }
      function editMail() {
        address = prompt("Enter e-mail address");

        if(address != null)
          document.location = "/checkout.php?set_email="+encodeURI(address);
      }
      function editPhone() {
        phone = prompt("Enter phone number");

        if(phone != null)
          document.location = "/checkout.php?set_phone="+encodeURI(phone);
      }
      function changeShipping(code) {
        shipping = $("#shipping-"+code).val();
        if(!isNaN(shipping))
          document.location = "/checkout.php?restaurant="+encodeURI(code)+"&set_shipping="+encodeURI(shipping);
      }
      
    </script>
  </body>
</html>

