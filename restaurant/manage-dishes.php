<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/session.php");

if(!restaurant_is_logged_in()) {
  header("Location: /");
  exit;
}

// possible POST actions:
// ?dish={ID}&remove

if(isset($_POST['dish'])) {
  db_stmt_query("DELETE FROM dishes WHERE code = ? AND restaurant = ?", [$_POST['dish'], restaurant_get_logged_id()]);
}

require_once($_SERVER['DOCUMENT_ROOT'] . "/views/admin/manage-dishes.php");

?>

