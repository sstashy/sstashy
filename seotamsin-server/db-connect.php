<?php
error_reporting(0);
date_default_timezone_set('Europe/Istanbul');

$config_password="öğqpdöğ1293*0*qwdmöğ123";
include("config.php");
if($_SERVER['SERVER_NAME']!=$config["domain"]){
  header("Location:https://".$config["domain"]);
}
date_default_timezone_set('Europe/Istanbul');
$current_date = time();

$db_servername = $config["db_servername"];
$db_username = $config["db_username"];
$db_password = $config["db_password"];
$db_dbname = $config["db_dbname"];
$cooldown = $config["cooldown"];
$conn = new mysqli($db_servername, $db_username, $db_password, $db_dbname);
$new  = mysqli_set_charset($conn,"utf8");
if ($conn->connect_error){
  die("Bağlantı Sağlanamadı : ". $conn->connect_error);
}
?>
