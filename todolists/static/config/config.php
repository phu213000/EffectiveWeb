<?php 
try {
  $host = "localhost";
  $dbname = "todolists";
  $user = "root";
  $pass = "root";

  $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  

}
catch(Exception $e)
{
  echo "Error is  " . $e->getMessage();
}
?>