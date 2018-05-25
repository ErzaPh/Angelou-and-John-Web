<?php 
	require('connection.php');;
	mysql_query("DELETE FROM cart WHERE id = $_GET[id]") or die (mysql_error());
	header('Location: cart.php');
?>


