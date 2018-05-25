
<?php include ('header.php'); ?>	

<body>
	  <div class="mainMain">
	  <div style="width:100%; margin-top:10px; margin-bottom:-450px;">
		<h1 class="h1stayl">ANGELOU AND JOHN MUSIC SHOP<br>Thank you!</h1>	
<?php 
session_start();
			include ('connection.php');
				$name = $_SESSION["sess_username"];	
									$query="truncate cart";
												mysql_query($query);
												//mysql_query("UPDATE profiles SET OnOROffLine= 0 where username='$name' ") or die (mysql_error());
												mysql_query("UPDATE profiles SET OnOROffLine= 0 where OnOROffLine= 1") or die (mysql_error());
												mysql_close();		
$expire = time()-86400;
setcookie('kookii', $_SESSION['sess_username'], $expire);				
session_destroy();
echo
"<br><br><center><h3>Thank you for purchasing! <br>Logging out... please wait...";

header("Refresh:2; url=index.php");								
 //header('Location: index.php');
 ?>
</div>
<?php include ('footer.php'); ?>