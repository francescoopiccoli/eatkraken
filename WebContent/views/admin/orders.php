<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/session.php");

$delivery_cost = db_get_delivery_costs(restaurant_get_logged_id());

//considers 24h format time,  keeps negative time
function getTimeLeft($deadline){

  date_default_timezone_set('Europe/Rome');
  $currentTime = strval(substr(date('Y/m/d H:i:s a', time()), 0, 16));
  $deadlineTime = strval(substr($deadline, 0, 16));
  $deadlineTime = str_replace("-","/", $deadlineTime);

  $currentTimeHour = substr($currentTime, 10, -3);
  $deadlineTimeHour = substr($deadlineTime, 10, -3);

  $currentTimeMinutes = substr($currentTime, 14, 15);
  $deadlineMinutes = substr($deadlineTime, 14, 15);

  $differenceHour = $deadlineTimeHour - $currentTimeHour;
  $differenceMinutes = $deadlineMinutes - $currentTimeMinutes;

  $timeLeftInMinutes = $differenceHour * 60 + $differenceMinutes;
  $timeLeftInMinutes = str_replace("-", "", $timeLeftInMinutes);

  if(substr($currentTime, 0, 10) ==substr($deadlineTime, 0, 10)){ // if the day is the same
    if($timeLeftInMinutes < 59){
    return $timeLeftInMinutes . "<i> minutes</i>";}
    else{
      return round($timeLeftInMinutes/60) . "h " . $timeLeftInMinutes%60 . " minutes";
    }
  }


  elseif(substr($currentTime, 5, -9) == substr($deadlineTime, 5, -9)){
    //if the day is different but the month is the samereturns how many days have passed since the expiration
    if((substr($currentTime, 8, -6) - substr($deadlineTime, 8, -6)) == 1){
      return (substr($currentTime, 8, -6) - substr($deadlineTime, 8, -6)) . " <i> day</i>";
    }
    else{
      return (substr($currentTime, 8, -6) - substr($deadlineTime, 8, -6)) . "<i> days</i>";
    }
  }

  else{ // if the month is different
    if((substr($currentTime, 5, -9) - substr($currentTime, 5, -9)) == 1){
      return (substr($currentTime, 5, -9) - substr($deadlineTime, 5, -9)) . " <i> month</i>";
    }
    else{
      return (substr($currentTime, 5, -9) - substr($deadlineTime, 5, -9)) . " <i> months</i>";
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<?php include($_SERVER['DOCUMENT_ROOT'] . "/views/widgets/common_head.php"); ?>

<body>
  <?php include($_SERVER['DOCUMENT_ROOT'] . "/views/widgets/navbar.php"); ?>


  <div class="container-fluid text-center mainbody main-content">  
    <div class="row content">
      <div class="col-sm-12 text-left"> 

                    <!-- accepted orders -->

        <h2>Accepted orders</h2>
        <p>
          Deliver as soon as possible. 
          <a href="javascript:window.print();" class="btn btn-default dont-print btn-print">Print</a>
        </p>

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
          $orders = db_get_accepted_orders(restaurant_get_logged_id());

          if($orders){
            foreach($orders as $order){ 
              $shipping_type = shipping_method_name_by_id($order['shipping_type']);
              $deliveryCost = $delivery_cost[shipping_method_colname_by_id($order['shipping_type'])];
            ?>

            <tr>
              <th scope="row"><?= $order["code"] ?></th>
              <td>
                    <?="<b>Name: </b>" . $order["full_name"]?><br>
                    <?="<b>Address:</b> " . $order["address"] ?><br>
                    <?="<b>City: </b>" . db_get_city($order["city"])[0][0]?><br>
                    <b>Phone: </b> <a href="tel:<?=$order["phone"] ?>"><?= $order["phone"] ?></a>
                  </td>
              <td>
              <?php

              $order_items = db_get_orders_items($order["code"]);
              if($order_items){
                foreach($order_items as $order_item){
                  $dish = db_get_dish($order_item[2]);
                  echo "<b>" . $order_item[3] . "x " . "</b>" . $dish[0][0] ."<b> ". $dish[0][1] ."€</b><br><b>Notes: </b><i>\"$order_item[4]\"</i><br><br>";
                }
              }
              ?>
              </td>
              <td><?= $order[8] . "€" ?></td>
              <td>
              <b>Time left: </b><i> <?= getTimeLeft($order['delivery_deadline'])?></i><br>
              <b>Order type:</b>
                <?= $shipping_type . " (" . $deliveryCost . "€)" ?>
               <br>
                <form method="post" action="orders.php"> 
                <input type="hidden" name="order" value="<?= $order['code']; ?>">
                <input type="submit" onclick="return confirmAction();" name="reject" value="Cancel" class="btn btn-default btn-sm dont-print btn-reject margin-6"/>
                </form> 

              </td>
            </tr>
            <?php }} ?>

          </tbody>
        </table>

        <br><br>

        <div class="dont-print">
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


              <!-- pending orders -->
            <?php 
            $orders = db_get_pending_orders(restaurant_get_logged_id());

            if($orders){
              foreach($orders as $order){   
                $shipping_type = shipping_method_name_by_id($order['shipping_type']);
                $deliveryCost = $delivery_cost[shipping_method_colname_by_id($order['shipping_type'])];
            ?>
                <tr>
                  <th scope="row"><?= $order["code"] ?></th>
                  <td>
                    <?="<b>Name: </b>" . $order["full_name"]?><br>
                    <?="<b>Address:</b> " . $order["address"] ?><br>
                    <?="<b>City: </b>" . db_get_city($order["city"])[0][0]?><br>
                    <b>Phone: </b> <a href="tel:<?=$order["phone"] ?>"><?= $order["phone"] ?></a>
                  </td>
                  <td>
                  <?php

                  $order_items = db_get_orders_items($order["code"]);
                  if($order_items){
                  foreach($order_items as $order_item){
                    $dish = db_get_dish($order_item[2]);
                    echo "<b>" . $order_item[3] . "x " . "</b>" . $dish[0][0] ."<b> ". $dish[0][1] ."€</b><br><b>Notes: </b><i>\"$order_item[4]\"</i><br><br>";
                  }}
                  ?>
                  </td>
                  <td><?= $order[8] . "€" ?></td>
                  <td>
                  <b>Time left: </b><i><?= getTimeLeft($order['delivery_deadline'])?></i><br>
                  <b>Order type:</b>
                  <?= $shipping_type . " (" . $deliveryCost . "€)" ?>

               <br>
                    <form method="post" action="orders.php">
                    <input type="hidden" name="order" value="<?= $order['code']; ?>">
                    <input type="submit" name="approve" value="Approve" class= "btn btn-default btn-sm btn-approve"/> 
                    <input type="submit" onclick="return confirmAction();" name="reject" value="Reject" class="btn btn-default btn-sm btn-reject"/>
                    </form> 

                  </td>
                </tr>
              <?php }} ?>

            </tbody>
          </table>
        </div>

        <br><br>


        <!-- past orders -->

        <div class="dont-print">
          <h2>Past orders</h2>
          <p>Past orders include both accepted and rejected orders.</p>

          <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">User</th>
                <th scope="col">Order</th>
                <th scope="col">Due total</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody>
            <?php 
            
            $orders = db_get_past_orders(restaurant_get_logged_id());
            if($orders){
              foreach($orders as $order){ 
                $shipping_type = shipping_method_name_by_id($order['shipping_type']);
                $deliveryCost = $delivery_cost[shipping_method_colname_by_id($order['shipping_type'])];
            ?>
              <tr>
              <th scope="row"><?= $order["code"] ?></th>
                  <td>
                    <?="<b>Name: </b>" . $order["full_name"]?><br>
                    <?="<b>Address:</b> " . $order["address"] ?><br>
                    <?="<b>City: </b>" . db_get_city($order["city"])[0][0]?><br>
                    <b>Phone: </b> <a href="tel:<?=$order["phone"] ?>"><?= $order["phone"] ?></a>
                  </td>
                <td>
                <?php

                $order_items = db_get_orders_items($order["code"]);
                if($order_items){
                  foreach($order_items as $order_item){
                    $dish = db_get_dish($order_item[2]);
                    echo "<b>" . $order_item[3] . "x " . "</b>" . $dish[0][0] ."<b> ". $dish[0][1] ."€</b><br><b>Notes: </b><i>\"$order_item[4]\"</i><br><br>";
                  }}
                ?>
                </td>
                <td><?= $order[8]. "€" ?></td>
                <td>
                <b>Expired: </b><i><?= $order['delivery_deadline'] ?></i><br>
                  
                <b>Order type:</b>
                <?= $shipping_type . " (" . $deliveryCost . "€)" ?><br>
                <?= ($order['status'] == 2 ? "<i class=\"text-danger\">This order was rejected</i>" : "") ?>
               <br>

                </td>
              </tr>
              <?php }} ?>

            </tbody>
          </table>
        </div>
        

      </div>
    </div>
  </div>

  <?php include($_SERVER['DOCUMENT_ROOT'] . "/views/widgets/footer.php"); ?>
</body>
</html>

