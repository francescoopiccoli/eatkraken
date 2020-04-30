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
        <div class="col-sm-12 text-left"> 

          <div class="row checkout-total-row">
            <div class="col-sm-3">
              <b>Deliver to:</b>
              <br>  
              <b id="full_name"><?= (cart_get_full_name() != "" ? cart_get_full_name() : "Enter Full Name"); ?></b> (<a href="#" onclick="editName()">edit</a>)
              <br>  
              <span id="address"><?= cart_get_address(); ?></span> (<a href="#" onclick="editAddress()">edit</a>)
            </div>
            <div class="col-sm-3">
              <b>Personal information</b>
              <br>  
              <span id="address"><?= (cart_get_email() == "" ? "No email specified" : cart_get_email()); ?></span> (<a href="#" onclick="editMail()">edit</a>)<br>
              <span id="address"><?= (cart_get_phone() == "" ? "No phone specified" : cart_get_phone()); ?></span> (<a href="#" onclick="editPhone()">edit</a>)
            </div>

            <div class="col-sm-2">
            </div>
            
            <div class="col-sm-2 text-center">
              Shipping
              <!-- todo! -->
              <h2>€<?= cart_get_shipping_total() ?></h2>
            </div>
            <div class="col-sm-2 text-center">
              Total
              <h2>€<?= cart_get_total() + cart_get_shipping_total() ?></h2>
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
                <?php /* todo: show only supported shipping methods */ ?>
                <option value="1">Home delivery (+€5)</option>
                <option value="2">Eat in (free)</option>
              </select>
            </div>
          </div>

          <?php 
          foreach($items as $item) { 
            $item = db_get_product($item['code']);
          ?>
          <div class="row checkout-results-row">
            <div class="col-sm-2">
            <img class="circular--landscape" id="profile-pic" style ="width:140px; height:140px; text-align:center"src=<?=$item['image_url']?>>

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
          <hr style="border-color: #bbb;">

          <?php } ?>
          
          <?php }  ?>
          <a href="checkout.php?confirm" class="btn btn-success btn-lg" style="float:right">Confirm order</a>


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

