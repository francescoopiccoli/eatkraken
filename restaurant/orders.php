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
  $timeLeftInMinutes = str_replace("-", "", $timeLeftInMinutes);
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

require_once($_SERVER['DOCUMENT_ROOT'] . "/views/admin/orders.php");

?>



