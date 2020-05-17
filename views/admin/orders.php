<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/session.php");

$delivery_cost = db_get_delivery_costs(restaurant_get_logged_id());

// todo: fix
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

  if(substr($currentTime, 0, 10) ==substr($deadlineTime, 0, 10)){ // if the day is the same
    return $timeLeftInMinutes . " ";
  }
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
          <a href="javascript:window.print();" class="btn btn-default dont-print" style="float:right; color:#1F618D; border-color:#1F618D; font-family:'Acme'">Print</a>
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
            $k = 0;


      if($orders){
          foreach($orders as $order){ 
            $delivery_type = "";
            if($order[6]==0){
              $delivery_type ="Eat in";
              $deliveryCost = $delivery_cost['cost_eat_in'];

            }
            elseif($order[6]==1){
              $delivery_type ="Take away";
              $deliveryCost = $delivery_cost['cost_takeaway'];
            }
            else{
              $delivery_type = "Home delivery";
              $deliveryCost = $delivery_cost['cost_home_delivery'];

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

              $order_items = db_get_orders_items($k, $orders);
              $k++;

              foreach($order_items as $order_item){
                $dish = db_get_dish($order_item[2]);
                echo "<b>" . $order_item[3] . "x " . "</b>" . $dish[0][0] ."<b> ". $dish[0][1] ."€</b><br><b>Notes: </b><i>\"$order_item[4]\"</i><br><br>";
              }
              ?>
              </td>
              <td><?= ($order[8] + $order[7]) . "€" ?></td>
              <td>
              <b>Time left: </b><i><?= getTimeLeft($order['delivery_deadline'])?><br>
                <b><?= "Delivery type: </b>
                <i> $delivery_type ($deliveryCost €)"?></i>
               <br>
                <form method="post" action="orders.php"> 
                <input type="hidden" name="order" value="<?= $order['code']; ?>">
                <input type="submit" onclick="return confirmAction();" name="reject" value="Cancel" class="btn btn-danger btn-sm dont-print" style="margin-top: 6px;"/>
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
              $k = 0;
            if($orders){
              foreach($orders as $order){ 
                  $delivery_type = "";
                  if($order['delivery_cost']==0){
                    $delivery_type ="Eat in";
                    $deliveryCost = $delivery_cost['cost_eat_in'];
      
                  }
                  elseif($order[6]==1){
                    $delivery_type ="Take away";
                    $deliveryCost = $delivery_cost['cost_eat_in'];
      
                  }
                  else{
                    $delivery_type = "Home delivery";
                    $deliveryCost = $delivery_cost['cost_eat_in'];
      
                  }?>
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

                  $order_items = db_get_orders_items($k, $orders);
                  $k++;

                  foreach($order_items as $order_item){
                    $dish = db_get_dish($order_item[2]);
                    echo "<b>" . $order_item[3] . "x " . "</b>" . $dish[0][0] ."<b> ". $dish[0][1] ."€</b><br><b>Notes: </b><i>\"$order_item[4]\"</i><br><br>";
                  }
                  ?>
                  </td>
                  <td><?= ($order[8] + $order[7]) . "€" ?></td>
                  <td>
                  <b>Time left: </b><i><?= getTimeLeft($order['delivery_deadline'])?><br>
                      <?= "Delivery type: <i> $delivery_type ($deliveryCost €)"?></i>

               <br>
                    <form method="post" action="orders.php">
                    <input type="hidden" name="order" value="<?= $order['code']; ?>">
                    <input type="submit" name="approve" value="Approve" class= "btn btn-success btn-sm"/> 
                    <input type="submit" onclick="return confirmAction();" name="reject" value="Reject" class="btn btn-danger btn-sm"/>
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
              $orders = db_get_past_orders(restaurant_get_logged_id());
              $k = 0;

            foreach($orders as $order){ 
                $delivery_type = "";
                if($order[6]==0){
                  $delivery_type ="Eat in";
                  $deliveryCost = db_get_delivery_costs(restaurant_get_logged_id()) [0][0];
    
                }
                elseif($order[6]==1){
                  $delivery_type ="Take away";
                  $deliveryCost = db_get_delivery_costs(restaurant_get_logged_id()) [0][1];
    
                }
                else{
                  $delivery_type = "Home delivery";
                  $deliveryCost = db_get_delivery_costs(restaurant_get_logged_id()) [0][2];
    
                }?>
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

                $order_items = db_get_orders_items($k, $orders);
                $k++;

                foreach($order_items as $order_item){
                  $dish = db_get_dish($order_item[2]);
                  echo "<b>" . $order_item[3] . "x " . "</b>" . $dish[0][0] ."<b> ". $dish[0][1] ."€</b><br><b>Notes: </b><i>\"$order_item[4]\"</i><br><br>";
                }
                ?>
                </td>
                <td><?= ($order[8] + $order[7]) . "€" ?></td>
                <td>
                <b>Expired since: </b><i><?= getTimeLeft($order['delivery_deadline'])?><br>
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

