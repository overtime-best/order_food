<?php
session_start();
// Directors 
define('HOME_URL','http://localhost/food_order/');
define('CMS_URL', HOME_URL . 'CMS/');
define('ADMIN_TPL','includes/templates/');  
// Database Connection
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DBNAME', 'food_order');
$dns    = "mysql:host=" . HOST . ";dbname=" . DBNAME;

try {
    $cont = new PDO($dns, USER, PASS);
} catch (PDOException $e) {
    echo "The Connection Is Failed ! " . $e->getMessage();
}
