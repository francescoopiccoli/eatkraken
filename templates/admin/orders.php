<?php

/// possible POST actions:
// ?order={id}&approve
// ?order={id}&reject

require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/session.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once($_SERVER['DOCUMENT_ROOT'] . "/templates/admin/PHPMailer/src/Exception.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/templates/admin/PHPMailer/src/PHPMailer.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/templates/admin/PHPMailer/src/SMTP.php");


if(!restaurant_is_logged_in()) {
  header("Location: /");
  exit;
}

// test authentication: http://localhost:8080/restaurant/auth.php?login=kebabkebabkebabkebabkebabkebabke
function get_pending_orders(){
    $restaurantID= restaurant_get_logged_id();
    return db_stmt_query("select * from orders where restaurant = ? and delivery_deadline > NOW() and status = 0", [$restaurantID]);
}
function get_accepted_orders(){
  $restaurantID= restaurant_get_logged_id();
  return db_stmt_query("select * from orders where restaurant = ? and delivery_deadline > NOW() and status = 1", [$restaurantID]);
}
function get_past_orders(){
  $restaurantID= restaurant_get_logged_id();
  return db_stmt_query("select * from orders where restaurant = ? and (delivery_deadline < NOW() or status = 2)", [$restaurantID]);
}



function get_orders_items($i, $orders){
  return db_stmt_query("select * from order_items where ord = ?", [$orders[$i][0]]);

}


function get_dish($code){
  return db_stmt_query("select name, price from dishes where code = ?", [$code]);
}

function email(){
$mail = new PHPMailer(true);
try {
    //Server settings
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.sendgrid.net';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'info.eatkraken@gmail.com';                     // SMTP username
    $mail->Password   = 'eatkraken2020';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('info.eatkraken@gmail.com', 'Eatkraken');
        $mail->addAddress('...');     // Add a recipient

     // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Your eatkraken order';
    $mail->Body    = 'Your order has been accepted, it will be at your place as 
    soon as possible';
    $mail->AltBody = 'Your order has been accepted, it will be at your place as 
    soon as possible';

    $mail->send();
}
catch (Exception $e) {
  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}

function removeElement($code){
  $connection = new PDO($GLOBALS['db_pdo_data']);
  $query  = "UPDATE orders SET status = 1  WHERE code = $code;";
  if($connection->query($query)){
    echo "successful";
  }
}

if(isset($_POST['order'])) { 
  if(isset($_POST['approve'])) {
    $connection = new PDO($GLOBALS['db_pdo_data']);
    $stmt = $connection->prepare("UPDATE orders SET status = 1  WHERE code = ? AND restaurant = ?");
    if($stmt->execute([$_POST['order'], restaurant_get_logged_id()])){
    	email();
    }
  }

  if(isset($_POST['reject'])) {
    $connection = new PDO($GLOBALS['db_pdo_data']);
    $stmt = $connection->prepare("UPDATE orders SET status = 2  WHERE code = ? AND restaurant = ?");
    if($stmt->execute([$_POST['order'], restaurant_get_logged_id()])){
      // email user about rejection?
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include($_SERVER['DOCUMENT_ROOT'] . "/templates/widgets/common_head.php"); ?>

<body>
  <?php include($_SERVER['DOCUMENT_ROOT'] . "/templates/widgets/navbar.php"); ?>


  <div class="container-fluid text-center mainbody">  
    <div class="row content">
      <div class="col-sm-12 text-left"> 
      <h2>Accepted orders</h2>
      <p>Deliver as soon as possible</p>
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

          foreach($orders as $order){ ?>
            <tr>
              <th scope="row"><?= $order[0] ?></th>
              <td>
                <b><?=$order[2]?></b><br>
                <?=$order[3] ?><br>
                <?=$order[4] ?><br>
                <a href="tel:<?=$order[5] ?>"><?=$order[5] ?></a>
              </td>
              <td>
              <?php

              $order_items = get_orders_items($k, $orders);
              $k++;

              foreach($order_items as $order_item){
                 $dish = get_dish($order_item[2]);
                 echo $order_item[3] . "x " . $dish[0][0] ."<b> ". $dish[0][1] ."€</b><br><i>Notes: \"$order_item[4]\"</i><br><br>";
              }
              ?>
              </td>
              <td><?= ($order[8] + $order[7]) . "€" ?></td>
              <td>
                Deliver within <b>40 minutes</b><br><b><?= "Delivery type:" . $order[6] ?></b> <?= "Cost: " . $order[7] . "€" ?><br>
                <form method="post" action="orders.php"> 
                <input type="hidden" name="order" value="<?= $order['code']; ?>">
                <input type="submit" name="reject" value="Cancel" class="btn btn-danger btn-sm"/>
                </form> 

              </td>
            </tr>
            <?php } ?>

          </tbody>
        </table>

        <br><br>
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
            $orders = get_pending_orders();
            $k = 0;

          foreach($orders as $order){ ?>
            <tr>
              <th scope="row"><?= $order[0] ?></th>
              <td>
                <b><?=$order[2]?></b><br>
                <?=$order[3] ?><br>
                <?=$order[4] ?><br>
                <a href="tel:<?=$order[5] ?>"><?=$order[5] ?></a>
              </td>
              <td>
              <?php

              $order_items = get_orders_items($k, $orders);
              $k++;

              foreach($order_items as $order_item){
                 $dish = get_dish($order_item[2]);
                 echo $order_item[3] . "x " . $dish[0][0] ."<b> ". $dish[0][1] ."€</b><br><i>Notes: \"$order_item[4]\"</i><br><br>";
              }
              ?>
              </td>
              <td><?= ($order[8] + $order[7]) . "€" ?></td>
              <td>
                Deliver within <b>40 minutes</b><br><b><?= "Delivery type:" . $order[6] ?></b> <?= "Cost: " . $order[7] . "€" ?><br>
                <form method="post" action="orders.php"> 
                <input type="hidden" name="order" value="<?= $order['code']; ?>">
                <input type="submit" name="approve" value="Approve" class= "btn btn-success btn-sm"/>
                <input type="submit" name="reject" value="Reject" class="btn btn-danger btn-sm"/>
                </form> 

              </td>
            </tr>
            <?php } ?>

          </tbody>
        </table>

        <br><br>
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

          foreach($orders as $order){ ?>
            <tr>
              <th scope="row"><?= $order[0] ?></th>
              <td>
                <b><?=$order[2]?></b><br>
                <?=$order[3] ?><br>
                <?=$order[4] ?><br>
                <a href="tel:<?=$order[5] ?>"><?=$order[5] ?></a>
              </td>
              <td>
              <?php

              $order_items = get_orders_items($k, $orders);
              $k++;

              foreach($order_items as $order_item){
                 $dish = get_dish($order_item[2]);
                 echo $order_item[3] . "x " . $dish[0][0] ."<b> ". $dish[0][1] ."€</b><br><i>Notes: \"$order_item[4]\"</i><br><br>";
              }
              ?>
              </td>
              <td><?= ($order[8] + $order[7]) . "€" ?></td>
              <td>
                Expired since <b>40 minutes</b><br>
                <b><?= "Delivery type: " . $order[6] ?></b> <?= "Cost: " . $order[7] . "€" ?><br>
                Status before expiration: <b>pending</b>

              </td>
            </tr>
            <?php } ?>

          </tbody>
        </table>

      </div>
    </div>
  </div>

  <?php include($_SERVER['DOCUMENT_ROOT'] . "/templates/widgets/footer.php"); ?>


</body>
</html>

