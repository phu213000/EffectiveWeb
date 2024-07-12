<?php 
define('HOSTNAME','localhost');
define('USERNAME','root');
define('PASSWORD','root');
define('DATABASE','pay');

$conn = new PDO('mysql:host=' . HOSTNAME . ';dbname=' . DATABASE, USERNAME, PASSWORD);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if(!$conn){
    die('Connection failed');
}

?>