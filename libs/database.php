<?php

$GLOBALS['db_name'] = "yhqbrujn";
$GLOBALS['db_host'] = "balarama.db.elephantsql.com";
$GLOBALS['db_username'] = "yhqbrujn"; 
$GLOBALS['db_password'] = "vTdT4LC9LlOf_rgw6fA-Uz54Q-_xefB5";
$GLOBALS['db_pdo_data'] = "pgsql:host=".$GLOBALS['db_host']." port=5432 dbname=".$GLOBALS['db_name']." user=".$GLOBALS['db_username']." password=".$GLOBALS['db_password'];


/* demo only for simple static queries,
 * perform other queries directly from pages with similar syntax
 */

// indices: simple_query(...)[row][column]
function simple_query($query_text) {
    $connection = new PDO($GLOBALS['db_pdo_data']);
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
}

function count_dishes() {
    return simple_query("select count(*) from dishes")[0][0];
}

// test
echo(count_dishes());
?>