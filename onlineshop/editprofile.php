
<?php
	//1. connect and select database
	$conn = mysqli_connect("localhost", "root", "", "login");
	if(!$conn){
		die("Connection Failed");
	}
	
	//2. execute sql query
	$sql = "SELECT * FROM profiles WHERE OnOROffLine = '1' ";
	$result = mysqli_query($conn, $sql);
	if(!$result){
		die("query failed : " . mysqli_error($conn));
	}
	
	//3. use returned data
	$row = mysqli_fetch_assoc($result);
	$fname = $row["fname"];
	$lname = $row["lname"];
	$usrgender = $row["gender"];

  	$BirthDate = $row["bday"];
  	$DBMonth = date('m', strtotime($row["bday"]));
  	$DBDate = date("d", strtotime($row["bday"]));
  	$DBYear = date("Y", strtotime($row["bday"]));


  	$bday_msg= $row["age"];
	$email = $row["email"];
	$username = $row["username"];
	$password = $row["password"];


	//4. close database
	mysqli_close($conn);
?>

<?php

$fname_error ="";
$lname_error="";
$email_error = "";

$user_error="";
$pw_error="";
$confirmpw_error="";
$error_counter=0;

if(isset($_POST["save"])){

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
									 
		if($password == $cpassword)
		{
			//password matched. Perform update
			//1. connect and select database


			if($error_counter == 0){

			$conn = mysqli_connect("localhost", "root", "", "login");
			if(!$conn){
				die("Connection Failed");
			}

			//2. execute sql query


			$sql = "UPDATE profiles SET ";
			$sql .= "fname='{$fname}'";
			$sql .= ", ";
			$sql .= "lname='{$lname}'";
			$sql .= ", ";
			$sql .= "gender='{$gender}'";
			$sql .= ", ";
			$sql .= "bday='{$BirthDate}'";
			$sql .= ", ";
			$sql .= "age='{$bday_msg}'";
			$sql .= ", ";
			$sql .= "email='{$email}'";
			$sql .= ", ";
			$sql .= "username='{$username}'";
			$sql .= ", ";
			$sql .= "password='{$password}'";
			$sql .= " WHERE ";
			$sql .= "OnOROffLine = '1'";
			$result = mysqli_query($conn, $sql);
			if(!$result){
				die("query failed : " . mysqli_error($conn));
			}
			
			//3. use returned data
			if(mysqli_affected_rows($conn) > 0){
				//query affected some rows
				$message = "<font color=green>Successfully Saved!</font>";
			}
			
			//4. close database
			mysqli_close($conn);
			}else{
				$message = "<font color=red>Passwords did not match.</font>";
			}
		}else{
			    $confirmpw_error = "<font color=red>Passwords did not match.</font>";
   				
		}
	}
?>






<?php include ('header.php'); ?>
		<body>
			<?php include('navigation.php'); ?>		
				<div class="content">	
					<h1 class="style4">Edit Profile</h1>
							<center><h2><?php echo @$message; ?></h2></center><br/>
							<div>
								<div class="row-fluid">				
									<form class="form" method="POST" action="editprofile.php"/>
													
													

													<div class="control-group">
														<label class="control-label" for="fname">First name</label>
														<div class="controls">
															<center><input type="text" class="input-style" id="fname" name="fname" value="<?php echo $fname;?>" required/></center>
															<?php echo @$fname_error; ?>
														</div>
													</div>
													
													<div class="control-group">
														<label class="control-label" for="lname">Last name</label>
														<div class="controls">
															<center><input type="text" class="input-style" id="lname" name="lname" value="<?php echo $lname;?>" required/></center>
															<?php echo @$lname_error; ?>
														</div>
													</div>

													<div class="control-group">
														<label class="control-label" for="gender">Gender</label>
														<div class="controls">
															<center>
																<select required="required" id="gender" name="gender" value="<?php echo $gender;?>">
													            	<option>Gender </option>
													            	<option <?php echo ($usrgender == "Male" ? "selected" : ""); ?> value="Male">Male</option>
													            	<option <?php echo ($usrgender == "Female" ? "selected" : ""); ?> value="Female">Female</option>    
													            </select>	
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
															            <option <?php if ($DBMonth == $i) { ?>selected<?php } ?>>
															            <?php echo $i; ?>
															            </option>
															        <?php endfor; ?>
													            </select>    

													            <select required="required" id="dd" name="dd">
													            	<option>Day</option>
															        
															        <?php for($i=1;$i<=31;$i++):?>
															            <option <?php if ($DBDate == $i) { ?>selected<?php } ?>>
															            <?php echo $i; ?>
															            </option>
														            <?php endfor; ?>
													            </select>

													            <select required="required" id="yyyy" name="yyyy">
														            <option>year</option>
														            <?php for($i=2015;$i>=1900;$i--):?>
														            	<option  <?php if ($DBYear == $i) { ?>selected<?php } ?>>
														            	<?php echo $i; ?>
														            	</option>
														            <?php endfor; ?>  
												         		</select>
															</center>
														</div>
													</div>


													<div class="control-group">
														<label class="control-label" for="email">Age</label>
														<div class="controls">
															<center>
															<label><?php echo @$bday_msg; ?></label>
														</div>
													</div>

													<div class="control-group">
														<label class="control-label" for="email">Email</label>
														<div class="controls">
															<center><input type="text" class="input-style" id="email" name="email"  value="<?php echo $email;?>" required/></center>
															<?php echo @$email_error; ?>
														</div>
													</div>
													
													<div class="control-group">
														<label class="control-label" for="username">Username</label>
														<div class="controls">
															<center><input type="text" class="input-style" id="username" name="username"  value="<?php echo $username;?>" required/></center>
															<?php echo @$user_error; ?>
														</div>
													</div>
													
													<div class="control-group">
														<label class="control-label" for="password">Password</label>
														<div class="controls">
															<center><input type="password" class="input-style" id="password" name="password" placeholder="Enter your Password" required/></center>
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
															<button id="save" name="save" type="submit" class="butons">Save Edit</button>
														</div>
													</div>
									</form>
								</div>
							</div>
				</div>
		</body>	
<?php include ('footer.php')?>