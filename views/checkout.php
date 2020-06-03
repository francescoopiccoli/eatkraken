<?php
$title = "Checkout";
$isCheckoutPage = true; // for checkout widget
?>
<!DOCTYPE html>
<html lang="en">
<?php include($_SERVER['DOCUMENT_ROOT'] . "/views/widgets/common_head.php"); ?>
  <body>

    <?php include($_SERVER['DOCUMENT_ROOT'] . "/views/widgets/navbar.php"); ?>

    <div class="main-content">

    <div class="container-fluid text-center mainbody">   
    <?php if(count($cart_items) > 0) { ?>   
      <div class="row content checkout-main">
        <div class="col-sm-12"> 

          <div class="row checkout-total-row">
            <div class="col-sm-3">
              <b class="checkout-body" >Deliver to:</b>
              <br><br>
              <b id="full_name"><?= $cart_name; ?></b> (<a href="#" onclick="editName()">edit</a>)
              <br>  
              <span id="address"><?= $cart_addr; ?></span> (<a href="#" onclick="editAddress()">edit</a>)
              <br>
              <i id="city"><?= $cart_city ?></i> (<a href="#" data-target="#modal-city" data-toggle="modal">edit</a>)

            </div>
            <div class="col-sm-3">
              <b class="checkout-body" >Contacts:</b>
              <br><br>
              <span id="mail"><?= $cart_email ?></span> (<a href="#" onclick="editMail()">edit</a>)
              <br>
              <span id="phone"><?= $cart_phone ?></span> (<a href="#" onclick="editPhone()">edit</a>)
            </div>

           
              <div class="col-sm-2 text-center">
              <b class="checkout-body">Shipping</b>
                <h3><?= $cart_shipping_total ?>€</h3>
              </div>
              <div class="col-sm-2 text-center">
              <b class="checkout-body" >Total</b>

                <h3><?= $cart_total ?>€</h3>
              </div>
              <div class="col-sm-2 text-center">
              <form action="checkout.php" method="post">
                <input type="hidden" name="confirm">
                <button type="submit" class="btn btn-default btn-ek-confirm btn-lg" >Confirm</button>
              </form>
            </div>
          </div>

          <?php foreach($cart_orders as $restaurant => $items) { ?>
          <div class="row">
            <div class="col-sm-10">
              <h2><?= db_get_restaurant_name($restaurant); ?></h2>
              <?php if(cart_get_restaurant_shipping($restaurant) == 2 && !db_restaurant_can_deliver($restaurant, cart_get_city())) { ?>
              <div class="red-message">As this restaurant cannot deliver to your city, its items will be ignored.</div>
              <?php } ?>
              
              <i id="notes-<?= $restaurant; ?>">
                <?= (cart_get_restaurant_message($restaurant) ? cart_get_restaurant_message($restaurant) : "No message to the restaurant") ; ?>
              </i> 
              (<a href="#" onclick="editNotes(<?= $restaurant; ?>)">edit</a>)
            </div>

            <div class="col-sm-2">
              <br>
              <select id="shipping-<?= $restaurant ?>" class="form-control" onchange="changeShipping(<?= $restaurant; ?>);">
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
            <img alt="product_image" title="product_image" class="dish-thumbnail checkout-product-image" src=<?=$item['image_url']?>>

            </div>
            <div class="col-sm-7">
              <h3><a class="food-title" href="/product.php?code=<?= $item['code']; ?>"><?= $item['name']; ?></a></h3>
              <i class="description"><?= $item['description']; ?></i>
              <br>
            </div>

            <div class="col-sm-1 text-center">
              <b class="price-col"><?= $item['price']; ?>€</b>
            </div>
              <?php /* allergenes warnings? */ ?>
              <div class="col-sm-1 text-center">
              <form action="checkout.php" method="post">
                <input type="hidden" name="dish" value="<?= $item['code']; ?>">
                <input type="hidden" name="remove" value="true">
                <button type="submit" onclick="return confirmAction();" class="btn btn-default btn-ek-danger">Remove</button>
              </form>
            </div>
          </div>
          <hr class="hr">

          <?php } }?>
          
        </div>
      </div>
    </div>
    
    <div class="modal fade" id="modal-city"  tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <form class="modal-content" action="checkout.php" method="post">
          <div class="modal-header">
            <h4 class="modal-title">Select delivery city</h4>
            <input class="btn btn-sm btn-primary" type="submit" id="city-dropdown-submit-btn" value="Confirm">
            
          </div>
          <div class="modal-body">
            <select name="set_city" class="form-control">
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
    </div><?php } 
                else{echo "<h1>Your cart is empty</h1><h2>Add something from the list!</h2><br><br><img alt=\"eatkraken_logo\" class=\"octopus-logo\" src=\"../images/logo_image.png\">";}?>  
    </div></div>

    <?php include($_SERVER['DOCUMENT_ROOT'] . "/views/widgets/footer.php"); ?>
  </body>
</html>

