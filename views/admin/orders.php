<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/session.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/simple_email.php");



if(!restaurant_is_logged_in()) {
  header("Location: /");
  exit;
}



/// possible POST actions:
// ?order={id}&approve
// ?order={id}&reject
if(isset($_POST['order']) && $order = db_get_order($_POST['order'])) {
  $connection = new PDO($GLOBALS['db_pdo_data'], $GLOBALS['db_username'], $GLOBALS['db_password'], array(PDO::ATTR_PERSISTENT => true));
  
  if(isset($_POST['approve'])) {
    $stmt = $connection->prepare("UPDATE orders SET status = 1  WHERE code = ? AND restaurant = ?");
    if($stmt->execute([$_POST['order'], restaurant_get_logged_id()])){
      email_approve($order['email']);
    }
  }
  if(isset($_POST['reject'])) {
    $stmt = $connection->prepare("UPDATE orders SET status = 2  WHERE code = ? AND restaurant = ?");
    if($stmt->execute([$_POST['order'], restaurant_get_logged_id()])){
      
      email_reject($order['email']);
    }
  }
  $connection = null;
}


//considers 24h format time,  keeps negative time
function getTimeLeft($orderID){
  date_default_timezone_set('Europe/Rome');
  $currentTime = strval(substr(date('Y/m/d H:i:s a', time()), 0, 16));
  $deadlineTime = strval(substr(get_deadline($orderID)[0][0], 0, 16));
  $deadlineTime = str_replace("-","/", $deadlineTime);

  $currentTimeHour = substr($currentTime, 10, -3);
  $deadlineTimeHour = substr($deadlineTime, 10, -3);

  $currentTimeMinutes = substr($currentTime, 14, 15);
  $deadlineMinutes = substr($deadlineTime, 14, 15);

  $differenceHour = $deadlineTimeHour - $currentTimeHour;
  $differenceMinutes = $deadlineMinutes - $currentTimeMinutes;

  $timeLeftInMinutes = $differenceHour * 60 + $differenceMinutes;

  if(substr($currentTime, 0, 10) ==substr($deadlineTime, 0, 10)){ // if the day is the same
    return $timeLeftInMinutes . "<i> minutes</i>";
  }


  elseif(substr($currentTime, 5, -9) == substr($deadlineTime, 5, -9)){ 
    //if the day is different but the month is the samereturns how many days have passed since the expiration
    if((substr($currentTime, 8, -6) - substr($deadlineTime, 8, -6)) == 1){
      return (substr($currentTime, 8, -6) - substr($deadlineTime, 8, -6)) . " <i> day<i/>";
    }
    else{
      return (substr($currentTime, 8, -6) - substr($deadlineTime, 8, -6)) . "<i> days<i/>";
    }
  }

  else{ // if the month is different
    if((substr($currentTime, 5, -9) - substr($currentTime, 5, -9)) == 1){
      return (substr($currentTime, 5, -9) - substr($deadlineTime, 5, -9)) . " <i> month<i/>";
    }
    else{
      return (substr($currentTime, 5, -9) - substr($deadlineTime, 5, -9)) . " <i> months<i/>";
    }
  }
}


// test authentication: http://localhost:8080/restaurant/auth.php?login=kebabkebabkebabkebabkebabkebabke
function get_deadline($orderID){
  return db_stmt_query("select delivery_deadline from orders where code = ?", [$orderID]);
}


function get_pending_orders(){
  $restaurantID= restaurant_get_logged_id();
  return db_stmt_query("select * from orders where restaurant = ? and delivery_deadline > (SELECT now() AT TIME ZONE 'Europe/Rome') and status = 0 order by delivery_deadline asc", [$restaurantID]);
}

function get_accepted_orders(){
  $restaurantID = restaurant_get_logged_id();
  return db_stmt_query("select * from orders where restaurant = ? and delivery_deadline > (SELECT now() AT TIME ZONE 'Europe/Rome') and status = 1 order by delivery_deadline asc", [$restaurantID]);
}
function get_past_orders(){
  $restaurantID = restaurant_get_logged_id();
  return db_stmt_query("select * from orders where restaurant = ? and (delivery_deadline < (SELECT now() AT TIME ZONE 'Europe/Rome') or status = 2) order by delivery_deadline desc", [$restaurantID]);
}

function deliveryCosts(){
  $restaurantID = restaurant_get_logged_id();
  return db_stmt_query("select cost_eat_in, cost_takeaway, cost_home_delivery from restaurants where code = ?", [$restaurantID]);
}


function get_restaurantName(){
  $restaurantID = restaurant_get_logged_id();
  return db_stmt_query("select name from restaurants where code = ?", [$restaurantID]);
}


function get_orders_items($i, $orders){
  return db_stmt_query("select * from order_items where ord = ?", [$orders[$i][0]]);

}


function get_dish($code){
  return db_stmt_query("select name, price from dishes where code = ?", [$code]);
}
function email_approve($addr) {
  $restaurant = db_get_restaurant_name(restaurant_get_logged_id());
  return simple_email(
    $addr,
    'EatKraken: Order approved',
    'Your order at ' . $restaurant . ' has been accepted, it will be at your place as soon as possible.<br>The EatKraken Team');
  
}
function email_reject($addr) {
  $restaurant = db_get_restaurant_name(restaurant_get_logged_id());
  return simple_email(
    $addr,
    'EatKraken: Order rejected',
    'We are sorry but your order at ' . $restaurant . ' could not be accepted, or it has been cancelled.<br>See you soon, The EatKraken Team'); 
}

function removeElement($code){
  $connection = new PDO($GLOBALS['db_pdo_data'], $GLOBALS['db_username'], $GLOBALS['db_password'], array(PDO::ATTR_PERSISTENT => true));
  $query  = "UPDATE orders SET status = 1  WHERE code = $code;";
  if($connection->query($query)){
    echo "successful";
  }
}

function get_city($cityID){
  return db_stmt_query("select name from cities where code = ?", [$cityID]);
}

?>

<!DOCTYPE html>
<html lang="en">

<?php include($_SERVER['DOCUMENT_ROOT'] . "/views/widgets/common_head.php"); ?>

<body>
  <?php include($_SERVER['DOCUMENT_ROOT'] . "/views/widgets/navbar.php"); ?>


  <div class="container-fluid text-center mainbody">  
    <div class="row content">
      <div class="col-sm-12 text-left"> 

                    <!-- accepted orders -->

        <h2>Accepted orders</h2>
        <p>
          Deliver as soon as possible. 
          <a href="javascript:window.print();" class="btn btn-sm btn-primary dont-print" style="float:right;">Print</a>
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
            $orders = get_accepted_orders();
            $k = 0;


      if($orders){
          foreach($orders as $order){ 
            $delivery_type = "";
            if($order[6]==0){
              $delivery_type ="Eat in";
              $deliveryCost = deliveryCosts()[0][0];

            }
            elseif($order[6]==1){
              $delivery_type ="Take away";
              $deliveryCost = deliveryCosts()[0][1];

            }
            else{
              $delivery_type = "Home delivery";
              $deliveryCost = deliveryCosts()[0][2];

            }?>

            <tr>
              <th scope="row"><?= $order["code"] ?></th>
              <td>
                    <?="<b>Name: </b>" . $order["full_name"]?><br>
                    <?="<b>Address:</b> " . $order["address"] ?><br>
                    <?="<b>City: </b>" . get_city($order["city"])[0][0]?><br>
                    <b>Phone: </b> <a href="tel:<?=$order["phone"] ?>"><?= $order["phone"] ?></a>
                  </td>
              <td>
              <?php

              $order_items = get_orders_items($k, $orders);
              $k++;

              foreach($order_items as $order_item){
                $dish = get_dish($order_item[2]);
                echo "<b>" . $order_item[3] . "x " . "</b>" . $dish[0][0] ."<b> ". $dish[0][1] ."€</b><br><b>Notes: </b><i>\"$order_item[4]\"</i><br><br>";
              }
              ?>
              </td>
              <td><?= ($order[8] + $order[7]) . "€" ?></td>
              <td>
              <b>Time left: </b><i><?= getTimeLeft($order[0])?><br>
                <b><?= "Delivery type: </b>
                <i> $delivery_type ($deliveryCost €)"?></i>
               <br>
                <form method="post" action="orders.php"> 
                <input type="hidden" name="order" value="<?= $order['code']; ?>">
                <input type="submit" name="reject" value="Cancel" class="btn btn-danger btn-sm dont-print" style="margin-top: 6px;"/>
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
              $orders = get_pending_orders();
              $k = 0;
            if($orders){
              foreach($orders as $order){ 
                  $delivery_type = "";
                  if($order[6]==0){
                    $delivery_type ="Eat in";
                    $deliveryCost = deliveryCosts()[0][0];
      
                  }
                  elseif($order[6]==1){
                    $delivery_type ="Take away";
                    $deliveryCost = deliveryCosts()[0][1];
      
                  }
                  else{
                    $delivery_type = "Home delivery";
                    $deliveryCost = deliveryCosts()[0][2];
      
                  }?>
                <tr>
                  <th scope="row"><?= $order["code"] ?></th>
                  <td>
                    <?="<b>Name: </b>" . $order["full_name"]?><br>
                    <?="<b>Address:</b> " . $order["address"] ?><br>
                    <?="<b>City: </b>" . get_city($order["city"])[0][0]?><br>
                    <b>Phone: </b> <a href="tel:<?=$order["phone"] ?>"><?= $order["phone"] ?></a>
                  </td>
                  <td>
                  <?php

                  $order_items = get_orders_items($k, $orders);
                  $k++;

                  foreach($order_items as $order_item){
                    $dish = get_dish($order_item[2]);
                    echo "<b>" . $order_item[3] . "x " . "</b>" . $dish[0][0] ."<b> ". $dish[0][1] ."€</b><br><b>Notes: </b><i>\"$order_item[4]\"</i><br><br>";
                  }
                  ?>
                  </td>
                  <td><?= ($order[8] + $order[7]) . "€" ?></td>
                  <td>
                  <b>Time left: </b><i><?= getTimeLeft($order[0])?><br>
                      <?= "Delivery type: <i> $delivery_type ($deliveryCost €)"?></i>

               <br>
                    <form method="post" action="orders.php">
                    <input type="hidden" name="order" value="<?= $order['code']; ?>">
                    <input type="submit" name="approve" value="Approve" class= "btn btn-success btn-sm"/> 
                    <input type="submit" name="reject" value="Reject" class="btn btn-danger btn-sm"/>
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
              $orders = get_past_orders();
              $k = 0;

            foreach($orders as $order){ 
                $delivery_type = "";
                if($order[6]==0){
                  $delivery_type ="Eat in";
                  $deliveryCost = deliveryCosts()[0][0];
    
                }
                elseif($order[6]==1){
                  $delivery_type ="Take away";
                  $deliveryCost = deliveryCosts()[0][1];
    
                }
                else{
                  $delivery_type = "Home delivery";
                  $deliveryCost = deliveryCosts()[0][2];
    
                }?>
              <tr>
              <th scope="row"><?= $order["code"] ?></th>
                  <td>
                    <?="<b>Name: </b>" . $order["full_name"]?><br>
                    <?="<b>Address:</b> " . $order["address"] ?><br>
                    <?="<b>City: </b>" . get_city($order["city"])[0][0]?><br>
                    <b>Phone: </b> <a href="tel:<?=$order["phone"] ?>"><?= $order["phone"] ?></a>
                  </td>
                <td>
                <?php

                $order_items = get_orders_items($k, $orders);
                $k++;

                foreach($order_items as $order_item){
                  $dish = get_dish($order_item[2]);
                  echo "<b>" . $order_item[3] . "x " . "</b>" . $dish[0][0] ."<b> ". $dish[0][1] ."€</b><br><b>Notes: </b><i>\"$order_item[4]\"</i><br><br>";
                }
                ?>
                </td>
                <td><?= ($order[8] + $order[7]) . "€" ?></td>
                <td>
                <b>Expired since: </b><i><?= getTimeLeft($order[0])?><br>
                  <b><?= "Delivery type: </b>
                                <i> $delivery_type ($deliveryCost €)"?></i>

               <br>

                </td>
              </tr>
              <?php } ?>

            </tbody>
          </table>
        </div>
        

      </div>
    </div>
  </div>

  <?php include($_SERVER['DOCUMENT_ROOT'] . "/views/widgets/footer.php"); ?>


</body>
</html>

