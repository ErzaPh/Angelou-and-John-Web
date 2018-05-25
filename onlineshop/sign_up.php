<?php

//retrieve our data from POST
$fname_error ="";
$lname_error="";
$email_error = "";

$user_error="";
$pw_error="";
$confirmpw_error="";
$error_counter=0;

if(isset($_POST["signup"])){

// ******************************************************************************* First Name

  $fname = $_POST['fname'];


		 if(!preg_match("/^[a-z .\-]+$/i", $fname)){
			$fname_error = "<font color=red>must not have numbers or special characters</font>";
			$error_counter++;
		  }
		

// ******************************************************************************* Last Name

  $lname = $_POST['lname'];


 		if(!preg_match("/^[a-z .\-]+$/i", $lname)){
			$lname_error = "<font color=red>must not have numbers or special characters</font>";
			$error_counter++;
		}


// ******************************************************************************* Gender

  $gender = $_POST["gender"];

		if($gender=="")
		{
			$gender_error="<font color=red>Please select a gender.</font>";
		}


// ******************************************************************************* Birthday

  $Month = $_POST["mm"];
  $Date = $_POST["dd"];
  $Year = $_POST["yyyy"];
  $BirthDate = $Year . "-" . $Month . "-" . $Date;


if($Month=="Month" or $Date=="Day" or $Year=="Year"){
      $bday_msg = "<font color=red>Invalid Date of Birth!</font>";
      $error_counter++;
    }else{
      $born = new DateTime("$BirthDate");
      $current = new DateTime('today');
      $bday_msg = $born->diff($current)->y . " year(s) old.";
    } 



// ******************************************************************************* Email

  $email = $_POST["email"];


      $email_filter = $email;
        // Remove all illegal characters from email
       $email_filter = filter_var($email_filter, FILTER_SANITIZE_EMAIL);
        // Validate e-mail
      if (!filter_var($email_filter, FILTER_VALIDATE_EMAIL) == true) {
        $email_error = "<font color=red>Invalid Email</font>";
        $error_counter++;
       }


// ******************************************************************************* Username

  $username = $_POST["username"];


      if(preg_match('#[^a-z0-9]+#i', $username)){
        $user_error= "<font color=red>Username must Letters and numbers Only.</font>";
        $error_counter++;
      }



// ******************************************************************************* Password

  $password = $_POST["password"];


      if(strlen($_POST['password']) < 6){
        $pw_error = "<font color=red>Password must be more than 6 characters.</font>";
        $error_counter++;
      }





  $cpassword= $_POST["cpassword"];

  
// ******************************************************************************* Compare Passwords


  if($password != $cpassword){
    $confirmpw_error = "<font color=red>Password did not match.</font>";
    $error_counter++;
  }



	if(strlen($username) > 30)
	    header('Location: sign_up.php');
		
		
	include ('connection.php');

		//check email if already exists
		$query = mysql_query("SELECT * FROM profiles WHERE email='$email'");
			if(mysql_num_rows($query) != 0)
				{
					echo "Email already exists.";
				}
				
				else 
				{
						//check username
						$query = mysql_query("SELECT * FROM profiles WHERE username='$username'");
							if(mysql_num_rows($query) != 0)
									{
									echo "Username already exists";
									}
							else
							{

									

													//insert data					 
													//sanitize username
													$username = mysql_real_escape_string($username);

													if($error_counter == 0){
													 
														$query = "INSERT INTO profiles (fname, lname, email, age, bday, gender, username, password)
																VALUES ( '{$fname}', '{$lname}', '{$email}', '{$bday_msg}', '{$BirthDate}', '{$gender}', '{$username}', '{$password}');";
														mysql_query($query);
														 
														mysql_close();
			 
														header ('Location:success_reg.php');
													}else{
														echo "<font color=red>Some information you entered might be invalid or you left it blank. Please sign in again.</font>";
														echo  "<br/><font color=red><a href=\"sign_up.php\">Click here to go back.</a></font>";
													}	
							} 
				}	
}
	
?>


<?php include ('header.php'); ?>
		<body>
			<?php include('navigation.php'); ?>		
				<div class="content">	
					<h1 class="style4">Sign Up</h1>
						<?php include('header.php'); ?>
							<div>
								<div class="row-fluid">				
									<form class="form" method="POST" action="sign_up.php"/>
													
													<?php echo @$message; ?>

													<div class="control-group">
														<label class="control-label" for="fname">First name</label>
														<div class="controls">
															<center><input type="text" class="input-style" id="fname" name="fname" placeholder="First name" required/></center>
															<?php echo @$fname_error; ?>
														</div>
													</div>
													
													<div class="control-group">
														<label class="control-label" for="lname">Last name</label>
														<div class="controls">
															<center><input type="text" class="input-style" id="lname" name="lname" placeholder="Last name" required/></center>
															<?php echo @$lname_error; ?>
														</div>
													</div>

													<div class="control-group">
														<label class="control-label" for="gender">Gender</label>
														<div class="controls">
															<center>
																<select required="required" id="gender" name="gender">
													            	<option>Gender</option>
													            	<option value="Male">Male</option>
													            	<option value="Female">Female</option>    
													            </select>
													            <br/><?php echo @$gender_error; ?>
															</center>
														</div>
													</div>
													

													<div class="control-group">
														<label class="control-label" for="bday">Birthday</label>
														<div class="controls">
															<center>
																<select required="required" id="mm" name="mm" >    
												            		<option>Month</option>

														            <?php for($i=1;$i<=12;$i++):?>
															            <option <?php if (isset($Month) == $i) { ?>selected<?php } ?>>
															            <?php echo $i; ?>
															            </option>
															        <?php endfor; ?>
													            </select>    

													            <select required="required" id="dd" name="dd" >
													            	<option>Day</option>
															        
															        <?php for($i=1;$i<=31;$i++):?>
															            <option <?php if (isset($Day) == $i) { ?>selected<?php } ?>>
															            <?php echo $i; ?>
															            </option>
														            <?php endfor; ?>
													            </select>

													            <select required="required" id="yyyy" name="yyyy">
														            <option>Year</option>
														            <?php for($i=2015;$i>=1900;$i--):?>
														            	<option  <?php if (isset($Year) == $i) { ?>selected<?php } ?>>
														            	<?php echo $i; ?>
														            	</option>
														            <?php endfor; ?>  
												         		</select>
												         		<label for="bday"><?php echo @$bday_msg; ?></label>
															</center>
														</div>
													</div>

													<div class="control-group">
														<label class="control-label" for="email">Email</label>
														<div class="controls">
															<center><input type="text" class="input-style" id="email" name="email" placeholder="Email" required/></center>
															<?php echo @$email_error; ?>
														</div>
													</div>
													
													<div class="control-group">
														<label class="control-label" for="username">Username</label>
														<div class="controls">
															<center><input type="text" class="input-style" id="username" name="username" placeholder="Username" required/></center>
															<?php echo @$user_error; ?>
														</div>
													</div>
													
													<div class="control-group">
														<label class="control-label" for="password">Password</label>
														<div class="controls">
															<center><input type="password" class="input-style" id="password" name="password" placeholder="Password" required/></center>
															<?php echo @$pw_error; ?>
														</div>
													</div>

													<div class="control-group">
														<label class="control-label" for="cpassword">Confirm Password</label>
														<div class="controls">
															<center><input type="password" class="input-style" id="cpassword" name="cpassword" placeholder="Confirm Password" required/></center>
															<?php echo @$confirmpw_error; ?>
														</div>
													</div>








													<div class="control-group">
														<div>
															<button id="signup" name="signup" type="submit" class="butons">Sign Up</button>
														</div>
													</div>
									</form>
								</div>
							</div>
				</div>
		</body>	
<?php include ('footer.php'); ?>
	   