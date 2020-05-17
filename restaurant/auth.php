<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/session.php");

if(isset($_POST['logout'])) {
    restaurant_log_out();
    header("Location: /");
} elseif(isset($_POST['login'])) {
    if(restaurant_log_in($_POST['login']))
        header("Location: /restaurant/");
    else
        header("Location: /restaurant/login.php");
} else {
    header("Location: /404.php");
}

?>