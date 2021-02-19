<?php
// DB credentials.
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '102030';
$db_name = 'syslogin';
try
{
	$db = new PDO("mysql:host=".$db_host.";dbname=".$db_name,$db_user, $db_pass);
	
}
catch (PDOException $e)
{
	exit("Error: " . $e->getMessage());
} 
?>