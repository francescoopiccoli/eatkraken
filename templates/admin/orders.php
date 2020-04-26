<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/session.php");

if(!restaurant_is_logged_in()) {
  header("Location: /");
  exit;
}
//http://localhost:8080/restaurant/auth.php?login=kebabkebabkebabkebabkebabkebabke
function get_orders(){
    return db_simple_query("select * from orders where restaurant = 1 and status = 1");
}

function get_orders_items(){
  return db_simple_query("select * from order_items where ord = 0");
}

function get_dish($code){
  return db_simple_query("select name, price from dishes where code = $code");
}

  $orders = get_orders();
  $order_items = get_orders_items();
  $dishOne = get_dish($order_items[0][2]);


?>

<!DOCTYPE html>
<html lang="en">

<?php include($_SERVER['DOCUMENT_ROOT'] . "/templates/widgets/common_head.php"); ?>

<body>
  <?php include($_SERVER['DOCUMENT_ROOT'] . "/templates/widgets/navbar.php"); ?>


  <div class="container-fluid text-center mainbody">  
    <div class="row content">
      <div class="col-sm-12 text-left"> 
        <h2>Pending orders</h2>
        <p>By accepting an order, you agree to deliver it on time at the specified conditions.</p>
        
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">User</th>
              <th scope="col">Order</th>
              <th scope="col">Due total</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
          <?php 

            foreach($orders as $order){?>
            "<tr>
              <th scope="row"><?= $order[0] ?></th>
              <td>
                <b><?=$order[2]?></b><br>
                <?=$order[3] ?><br>
                <?=$order[4] ?><br>
                <a href="tel:<?=$order[5] ?>"><?=$order[5] ?></a>
              </td>
              <td>
              <?php


              foreach($order_items as $order_item){

                 $dish = get_dish($order_item[2]);
                 echo $dish[0][0] ."<b> ". $dish[0][1] ."€</b></br>";

              }
              ?>
              </td>
              <td><?= ($order[8] + $order[7]) . "€" ?></td>
              <td>
                Deliver within <b>40 minutes</b><br><b><?= $order[6] ?></b> <?= $order[7] . "€" ?><br>
                <button class="btn btn-success btn-sm">
                  Accept
                </button> 
                <button class="btn btn-danger btn-sm">
                  Refuse
                </button>
              </td>
            </tr>
            <?php } ?>

          </tbody>
        </table>

        <h2>Past orders</h2>
        see above, just instead of "actions" one sees "status" label (accepted/refused)
      </div>
    </div>
  </div>

  <?php include($_SERVER['DOCUMENT_ROOT'] . "/templates/widgets/footer.php"); ?>


</body>
</html>

