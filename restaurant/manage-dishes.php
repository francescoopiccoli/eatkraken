<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/session.php");

if(!restaurant_is_logged_in()) {
  header("Location: /");
  exit;
}
?>
<?php
// test authentication: http://localhost:8080/restaurant/auth.php?login=kebabkebabkebabkebabkebabkebabke
//not working for now
if(isset($_POST['remove'])) {
  $code= $dish['code'];
  echo $code;
  $connection = new PDO($GLOBALS['db_pdo_data'], $GLOBALS['db_username'], $GLOBALS['db_password'], array(PDO::ATTR_PERSISTENT => true));
  $stmt = $connection->prepare("DELETE FROM dishes WHERE code = $code;");
  $stmt->execute();
  $connection = null;
}

require_once($_SERVER['DOCUMENT_ROOT'] . "/views/admin/manage-dishes.php");

?>

