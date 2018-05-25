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
	$email = $row["email"];

	//4. close database
	mysqli_close($conn);
?>		


<?php
	
	require ("connection.php");									
	$query = mysql_query("SELECT * FROM cart") or die (mysql_error());
	$rows = mysql_fetch_assoc($query);

			if(isset($_POST['submit']))
			{
				$fname= $_POST['fname'];
				$lname= $_POST['lname'];
				$email= $_POST['email'];
				$account= $_POST['account'];
				$total= $rows['gran'];
				$prodname = $rows['controlname'];
				$quantity = $rows['qty'];

				if($total > 0){

					$query1 = mysql_query("INSERT INTO purchased (id, fname, lname, email, account, prod_name, qty, total) VALUES ('', '{$fname}','{$lname}', '{$email}', '{$account}', '{$prodname}', '{$quantity}', '{$total}') ") or die(mysql_error());
					mysql_query("truncate cart");
				    header("Location: success_order.php");
				    //header("Location: index.php");
		   		}else{
		   			$message = "<font color=red>Please purchase an item first.</font> ". "<br/>Go back to put an order <a href='cart.php'>Here</a>";
		   		}
			}

?>


<?php	
	//Para mafetch ang value ni total from cart	ug masave kay userpurchase log
	require ("connection.php");								
	$query = mysql_query("SELECT * FROM cart") or die (mysql_error());

		while($rows = mysql_fetch_assoc($query))
		{
				$prod=$rows['controlname'];
				$presyo=$rows['price'];
				$quan=$rows['qty'];
				$total=$rows['gran'];
				$cust=$rows['client_name'];

			if ($quan > 0)
			{	
				$query3= mysql_query("INSERT INTO userpurchase_log (date_purchased,client_name,product_name,price,qty,gtotal) values(NOW(),'$cust','$prod','$presyo','$quan','$total')") or die(mysql_error());
			}else{
				mysql_query("DELETE FROM userpurchase_log WHERE qty = 0") or die (mysql_error());
			}
		}

?>



<?php include('header.php'); ?>
	<?php include('navigation_client.php'); ?>
	
		<div class="content2">	
			<center><h1>CheckOut Form </h1></center>
				<br/>
			<center><h3><?php echo @$message; ?></h3></center>



			<center>
				<form method="POST" action="client_checkoutform.php">

					<table class="regcontent">
						<tr><td  class="controls2"><input  class="input-style" type = "text" name="fname"  size="34" required="required" value="<?php echo $fname; ?>"></td></tr>
						<tr><td  class="controls2"><input  class="input-style" type = "text" name="lname"  size="34" required="required" value="<?php echo $lname; ?>"></td></tr>
						<tr><td  class="controls2"><input  class="input-style" type = "email" name="email"  size="34" required="required" value="<?php echo $email; ?>"></td></tr>
						<tr><td  class="controls2"><input  class="input-style" type = "account" name="account"  size="34" required="required" placeholder="Mobile Number:"></td></tr>
						<tr><td  class="controls2"><input  class="input-style" type = "total" name="total"  size="34"  disabled= "disabled" value="<?php echo $total; ?>" ></td></tr>
						<tr><td ><input class="butons" id="submit"  name="submit" type="submit" value="Submit Order Form"></td></tr>
						
						<tr>
							<?php
							
							$query = mysql_query(" SELECT * FROM cart") or die (mysql_error());
							
							$total= $query['gran'];
							echo "<table class='regcontent'><tr><td  class='controls2'>";
							echo "<p style='color:white'>YOUR ORDER(S): <br></br></p>";
								while($row=mysql_fetch_array($query)){
																							
								echo "<li'>";
								echo "<ul><p style='color:white'>(".$row['qty'] ."&nbsp;pc/s)&nbsp;&nbsp;&nbsp;" .$row['controlname']."</p></ul>";
								echo "</li>";
								}
								echo "</td></tr></table>";
							?>
						</tr>
					</table>
				</form>
			</center>
		</div>

<?php include('footer.php'); ?>