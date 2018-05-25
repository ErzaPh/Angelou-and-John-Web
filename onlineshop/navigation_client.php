<div id='navigation'>
						
										
	<hr>
	<?php include('connection.php'); 

		session_start();
			
		$name = $_SESSION["sess_username"];	
		  $loginFlag = mysql_query(" SELECT * FROM profiles where username='$name' ");
		  $res = mysql_fetch_array($loginFlag) or die (mysql_error());
		  //echo $res['OnOROffLine'];
		if($res['OnOROffLine']==1){
			include('session_name.php');
			
		}
		if($res['OnOROffLine']==0){

		echo "Please Login <a href='login.php'>here</a> to purchase";
		}

	?>
	 	<ul>
				 <li class='active'><a href='index.php'>Home</a></li>
				 <li><a href='allprod.php'>Shop</a></li>
				 <li><a href='editprofile.php'>Edit Profile</a></li>
				 <li><a href='logout.php'>Logout</a><li>
				
	 	</ul>
</div>
