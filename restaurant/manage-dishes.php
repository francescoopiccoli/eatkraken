<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/session.php");

if(!restaurant_is_logged_in()) {
  header("Location: /");
  exit;
}
?>
<?php
function get_dishes(){
  return db_stmt_query("select code, name, price, image_url from dishes where restaurant = ?", [restaurant_get_logged_id()]);
}

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

