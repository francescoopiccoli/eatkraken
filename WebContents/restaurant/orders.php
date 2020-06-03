<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/session.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/simple_email.php");
$title = "Orders - Eatkraken";


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


function email_approve($addr) {
  $restaurant = db_get_restaurant_name(restaurant_get_logged_id());
  $restaurantContact = db_get_restaurant_contact(restaurant_get_logged_id());
  return simple_email(
    $addr,
    'EatKraken: Order approved',
    'Your order at ' . $restaurant . ' has been accepted, it will be at your place as soon as possible.<br>
    In case of problems contact the restaurant at: ' . $restaurantContact . '<br>The EatKraken Team');
  
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

require_once($_SERVER['DOCUMENT_ROOT'] . "/views/admin/orders.php");

?>



