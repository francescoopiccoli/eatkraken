<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/session.php");

if(session_is_logged_in()) {
?>

<?php
} else {
?>

<li><a href="/checkout.php"><i class="fas fa-shopping-cart"></i></a></li>

<?php
}
?>