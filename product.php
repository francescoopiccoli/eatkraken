<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/database.php");



// extract from DB -> https://phpdelusions.net/pdo#prepared
$connection = new PDO($GLOBALS['db_pdo_data']);

$stmt = $pdo->prepare('SELECT * FROM users WHERE email = ? AND status=?');
$stmt->execute([$email, $status]);
$user = $stmt->fetch();

try {
    if($query = $connection->query($query_text)) 
        return $query->fetchAll();
    else
        return false;
} catch (Exception $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
$connection = null;

$title = "Order Greta Burger - EatKraken";
$product_name = "Greta Burger";
$product_desc = "sssss";

require_once($_SERVER['DOCUMENT_ROOT'] . "/templates/product.php");

?>