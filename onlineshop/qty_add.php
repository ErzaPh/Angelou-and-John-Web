<?php 
	require('connection.php');
	
    mysql_query("UPDATE cart SET `qty` = qty + 1 WHERE id = $_GET[id] ") or die (mysql_error());	
	header("Location: cart.php");

?>