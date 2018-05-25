<?php

				
ob_start(); //Turn on output buffering (pra paspas mag load)
session_start();

 
if(isset($_POST["login"])){

		$username = $_POST['username'];
		$password = $_POST['password'];
		 
		require_once('connection.php');
		 
		$username = mysql_real_escape_string($username);
		$query = "SELECT id, username, password
				FROM profiles
				WHERE username = '$username' ";
		
		$result = mysql_query($query);
		 
		if(mysql_num_rows($result) == 0) // User not found. So, redirect to login_form again.
		{
			echo "<font color=red>user not found</font>";
			header('Location: login_client.php');
		}
		 
		
		$userData = mysql_fetch_array($result, MYSQL_ASSOC);

		if($password != $userData['password']) // Incorrect password. So, redirect to login_form again.
		{
			echo "<font color=red>incorrect password</font>";
			header('Location: login_client.php');
		}else{ // Redirect to dashboard page after successful login.
			session_regenerate_id();
			$_SESSION['sess_user_id'] = $userData['id'];
			$_SESSION['sess_username'] = $userData['username'];
			$user=$_SESSION['sess_username'];
			mysql_query("UPDATE profiles SET OnOROffLine=1 where  username='$user' ") or die (mysql_error());
			
			$expire = time()+86400;
					setcookie('kookii', $_SESSION['sess_username'], $expire); // A cookie is often used to identify a user
					// get user of the current session ------------ refresh if session ends without activity

			header('Location: index.php');
		}
}

?>