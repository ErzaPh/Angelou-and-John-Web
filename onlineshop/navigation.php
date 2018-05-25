
<?php include('connection.php');
	session_start();
		if(isset($_SESSION['sess_username']) || isset($_COOKIE['kookii']))
		{
			$name = $_SESSION["sess_username"];	
			$loginFlag = mysql_query("SELECT * FROM profiles where username='$name'");
  			$res = mysql_fetch_array($loginFlag) or die (mysql_error());

		  	echo"<div id='navigation'><hr>";
				if($res['OnOROffLine']==1)
				{
					include('session_name.php');
				}
				
			echo"<ul>
					<li><a href='index.php'>ANGELOU AND JOHN MUSIC SHOP |</a></li>
					<li><a href='allprod.php'>SHOP NOW! |</a></li>
					<li><a href='editprofile.php'>EDIT PROFILE |</a></li>
					<li><a href='logout.php'>LOG OUT |</a><li>
				</ul>
				</div>";
		}
		else{
			echo"<div id='navigation'><hr>
			<ul>
				<li class='active'><a href='index.php'>ANGELOU AND JOHN MUSIC SHOP|</a></li>
				<li><a href='allprod.php'>SHOP NOW! |</a></li>
				<li><a href='login_client.php'>LOGIN</a></li>
			</ul>
			</div>";
		}
?>