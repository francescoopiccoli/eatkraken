<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/session.php");

if(isset($_GET['logout'])) {
    restaurant_log_out();
    header("Location: /");
} elseif(isset($_GET['login']) && strlen($_GET['login']) == 32) {
    if(restaurant_log_in($_GET['login']))
        header("Location: /restaurant/");
    else
        header("Location: /");
} else {
    header("Location: /404.php");
}

?>