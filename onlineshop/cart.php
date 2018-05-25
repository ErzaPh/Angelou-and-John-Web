<?php include ('header.php');
include('navigation_client.php');

error_reporting (0);
session_start();

require('connection.php');
 
	echo '<center><h1 style="font-size:18px;">
		<br>Item(s) Added to Cart</h1><br>';
		
		$gran = 0;
		$query = mysql_query("SELECT * FROM cart") or die (mysql_error());


        if(mysql_num_rows($query) > 0){ 
		
		echo '<table cellspacing="2" cellpadding="3" border="5" align="center" class="regcontent">
				 <tr>
				 	<td class="controls2">
						<h4 style="color:white; text-align:center;">Product Name</h4>
					</td>

					<td class="controls2">
						<h4 style="color:white; text-align:center;">Price</h4>
					</td>

					<td class="controls2">
						<h4 style="color:white; text-align:center;">Quantity</h4>
					</td>

					<td class="controls2">
						<h4 style="color:white; text-align:center;">Total</h4>
					</td>
					
					<td>
						<h4 style="color:white; text-align:center;">Options</h4>
					</td>	
				 </tr>';
			  
				  while($rows = mysql_fetch_assoc($query)){
					  
						$prod_totalPrice = $rows['price'] * $rows['qty'];
						echo "</td></tr><tr><td><p style='color:white; text-align:justify;'>". $rows['controlname'] ."</p> </td> <td><p style='color:white;'>". number_format((float)$rows['price'], 2, '.', ','). "</p></td><td>";  
						echo "<p style='color:white;'>".$rows['qty']."</p>";

						echo "</td><td><p style='color:white;'>". number_format((float)$prod_totalPrice, 2, '.', ',') ."</p></td> ";
						
						echo '<td><a href="qty_add.php?id='. $rows['id']. ' "><img src="images/list-add.png" width="30" height="30" alt="add quantity"/></a>
								<a href="qty_minus.php?id='. $rows['id']. ' "><img src="images/minus.png" width="30" height="30" atl="subtract quantity"/></a>
								<a href="removefromcart.php?id=' . $rows['id'] . ' "><img src="images/cart-remove-icon.png" width="30" height="30" alt="remove this item from cart"/></a></td>';
						$gran = $gran + $prod_totalPrice;
				}					
				mysql_query("UPDATE cart SET gran = '$gran' ") or die (mysql_error());
			   //mysql_query("UPDATE userpurchase_log SET gtotal = '$prod_totalPrice' ") or die (mysql_error());
				$sum = number_format((float)$gran, 2, '.', ',') ;
				
						
				echo "</td></tr><tr>
				<td><h4><p style='color:white; text-align:justify;'>Total Bill</p></td>
				<td colspan='3'><h4><p style='color:white; text-align:justify;'>". $sum ."</p></td>
				<td>";
				//echo '<a href="clear.php">';

			
				$res = mysql_query('SELECT * FROM products') or die(mysql_error()); 
				$rows = mysql_fetch_assoc($res);
			 	echo '<p><center><a href="client_checkoutform.php?id='. $rows['id'] . ' " ><img src="images/icon_checkout.gif" width="120" height="30" alt="Check out orders"/></center></p>';
		}
		
	

?>



