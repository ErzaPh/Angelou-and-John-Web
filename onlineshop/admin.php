<?php include ('header.php'); ?>

<body>
<?php include('navigation.php'); ?>

	<div class="content">
		  
	<h2 class="style4"> Admin Login</h2>
<br>
		<?php include('header.php'); ?>

		<div>
			<div class="row-fluid">
				<form class="form" method="POST" action="loginprocess3.php">

					<div class="control-group">
						<label class="control-label" for="username">Username</label>

						<div class="controls">
							<center>
								<input type="text" class="input-style" id="username" name="username" placeholder="Username" required/>
							</center>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="password">Password</label>
					
						<div class="controls">
							<center>
								<input type="password" class="input-style" id="password" name="password" placeholder="Password" required/>
							</center>
						</div>
					</div>
					
					<div class="control-group">
						<div>
							<button id="buttonsubmit" name="login" type="submit" class="butons">Sign in</button>
						</div>
					</div>
				</form>
				<br>
				<center>Not a member? Sign up <a href='sign_up.php'>Here</a></center>
			</div>
		</div>
	</div>
	<?php include ('footer.php'); ?>   

	