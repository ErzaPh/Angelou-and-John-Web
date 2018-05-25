
<?php include ('header.php'); ?>	
<body>
	  <div class="mainMain">
	  <div style="width:100%; margin-top:10px; margin-bottom:-450px;">
		<h1 class="h1stayl">ANGELOU AND JOHN MUSIC SHOP<br>Please Login To Purchase</h1>	

<?php 	include('connection.php'); 

	//error_reporting(0);
	session_start();
		if(!isset($_COOKIE['kookii'])){
	echo ">>>>>>>>>>>>>>>>>>>> Click <a href='login_client.php'>HERE</a> to Login.";
	}
	elseif(isset($_COOKIE['kookii'])){


			$result = mysql_query("SELECT * FROM products WHERE id = $_GET[id] ");
			$row = mysql_fetch_array($result) or die (mysql_error());
			$name = $_SESSION["sess_username"];
			$ptitle = $row['controlname'];
			$pprice=$row['price'];

		$sql = "INSERT into cart (controlname,price,client_name) values ('{$ptitle}','{$pprice}','{$name}')"; 
	    if (!mysql_query($sql)) 
	        die ('Error: ' . mysql_error());  
		else
	    header("Location:cart.php");
	}
?>
</div>
<?php include ('footer.php'); ?>