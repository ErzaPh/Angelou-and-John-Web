
<div id="main">

	<div  style="width:100%; clear:both; ">
		
		<?php include('connection.php'); ?>

		<?php
			// figure out the total pages in the database
			$name = $_SESSION["sess_username"];	
			$result = mysql_query("SELECT * FROM userpurchase_log where client_name='$name' ");
			while($rows = mysql_fetch_assoc($result))
			{
					$quan=$rows['qty'];
					$total=$rows['gtotal'];		

				if ($quan < 1)
				{	
					mysql_query("DELETE FROM userpurchase_log WHERE qty = 0") or die (mysql_error());
				}
			}
		?>

			<h1  class="h1stayl">Your Purchase History</h1>
			<div class="imageWrapper" style="background:transparent;">
				
				<?php	// display data in table
					echo "<table border='6' cellpadding='6' style='width:60%; margin-left:20%; padding:20px;'>";
					echo "<tr> <th style='padding:10px;'>Item Name</th> <th>Price</th> <th>Quantity</th> <th>Total Amount</th> <th>Date Purchased</th></tr>";
					
					$result = mysql_query("SELECT * FROM userpurchase_log where client_name='$name' ");
					// loop through results of database query, displaying them in the table
					while($row=mysql_fetch_assoc($result))
					{
					//	if ($row['qty'] > 0)
					//	{	

						
							echo "<tr>";
							echo "<td style='text-align:center;'>" . $row['product_name'] . "</td>";
							echo "<td style='text-align:center;'> Php " . $row['price'] . "</td>";
							echo "<td style='text-align:center;'>" . $row['qty'] . "</td>";
							echo "<td style='text-align:center;'> Php " . $row['gtotal'] . "</td>";
							echo "<td style='text-align:center;'>" . $row['date_purchased'] . "</td>";
							echo "</tr>";
					//	}
						
					}
					// loop through results of database query, displaying them in the table 
					// close table>

					echo "</table>";
				?>
			</div>
	</div>
</div>