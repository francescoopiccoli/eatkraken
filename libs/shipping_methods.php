<?php

// Return array of pre-defined shipping methods
function shipping_methods() {
    return array(
        array("id" => 0, "col" => "eat_in", "name" => "Eat in"),
        array("id" => 1, "col" => "eat_in", "name" => "Take away"),
        array("id" => 2, "col" => "eat_in", "name" => "Home delivery"),
    );
}

// Return shipping method name by shipping method code
function shipping_method_name_by_id($id) {
    foreach(shipping_methods() as $m) {
        if($m['id'] == $id)
            return $m['name'];
    }
    return false;
}

// Return DB column name by shipping method code
function shipping_method_colname_by_id($id) {
    foreach(shipping_methods() as $m) {
        if($m['id'] == $id)
            return "cost_{$m['col']}";
    }
    return false;
}


?>
