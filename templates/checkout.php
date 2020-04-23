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
          <span id="address">AAA BBB CCC</span> (<a href="">edit</a>)
        </div>
        
        <div class="col-sm-2 text-center">
          Shipping
          <h2>€5</h2>
        </div>
        <div class="col-sm-2 text-center">
          Total
          <h2>€55</h2>
        </div>
      </div>

      <h2>Pizzeria Scarsa</h2>
      
      <div class="row checkout-results-row">
        <div class="col-sm-2">
          <img class="thumbnail-small" src="https://cdn-media.italiani.it/site-caserta/2019/01/pizza-con-ananas-caserta-2.jpg">
        </div>
        <div class="col-sm-5">
          <h3>Pizza Margherita</h3>
          <p>1350Kcal</p>
          <small><i>message</i> (<a href="">edit</a>)</small>
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
          <h3>€50</h3>
          +warnings?
        </div>
      </div>



    </div>
  </div>
</div>


<?php include($_SERVER['DOCUMENT_ROOT'] . "/templates/widgets/footer.php"); ?>

</body>
</html>

