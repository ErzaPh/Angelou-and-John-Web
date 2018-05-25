<?php
	error_reporting(E_ALL);
		if(isset($_GET['id']) && is_numeric($_GET['id'])) {

			$link = mysql_connect("localhost", "root", "") or die("Could not&amp;nbsp;connect: " . mysql_error());

			mysql_select_db("login") or die(mysql_error());

			$sql = "SELECT photo FROM products WHERE id={$_GET['id']}";

			$result = mysql_query("$sql") or die("Invalid query: " . mysql_error());

			echo mysql_result($result, 0);
			mysql_close($link);

		}
?>
 