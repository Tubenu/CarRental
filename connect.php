<?php

	$host = "localhost";
	$db_user ="root";
	$db_password = "";
	$db_name ="wypozyczalnia";
	
	$db = new mysqli($host, $db_user, $db_password, $db_name);

if ($db->connect_error) {
    die("Unable to connect database: " . $db->connect_error);
}
?>
	