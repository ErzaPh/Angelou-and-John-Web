<!--DB Connect-->
<?php include('connection.php'); ?>	
	<!-- figure out the total pages in the database -->

<!-- CSS Background Color Changer-->
<style>
	#buttons{
	  display:-webkit-box;
	  -webkit-box-orient: horizontal;
	  -webkit-box-pack: center;
	}
	  section> div{
		height:20px;
		width:20px;
		margin:5px;
	  }
	  #blue{
		  background:#23607f;
	  }
	  #maroon{
		  background:#530133;
	  }
	  #green{
		  background:#52673b;
	  }
	  #red{
		  background:#675f3b;
	  }
	  #black{
		  background:black;
	  }
	  #violet{
		  background:#502c6e;
 	} 
</style>

	<!--Script Background Color Changer-->
  	<script>
 			function change(color){
			document.body.style.background = color;}		
  	</script>

<?php include ('header.php'); ?>
<?php include('connection.php'); ?>
<!--figure out the total pages in the database-->
<?php $result = mysql_query("SELECT * FROM products"); ?>

<body>
   	<?php include('navigation.php'); ?>
	<div class="mainMain">
	  	<div style="width:100%; margin-top:0px; margin-bottom:-500px;">
			<h1 class="h1stayl">We have all items available!</h1>	

			<?php
			// display data in table
			echo "<table border='5' cellpadding='5' style='width:60%; margin-left:15%; padding:20px;'>";
			echo "<tr>
					<th>Product Image</th>
					<th style='padding-left:80px; padding-right:80px;'>Product Detail</th>
					<th style='padding:20px;'>Item Price</th>					
					<th>Buy Now!</th>
				  </tr>";
					// loop through results of database query, displaying them in the table 
					while($row=mysql_fetch_assoc($result))
					{
						echo "<tr>";
						echo "<td>" .'<img src="allprodpictures.php?id='.$row['id'].'"/>' . "</td>";
						echo "<td style='text-align:center;'>Name: " . $row['controlname'] ."<br>Description: ". $row['description'] ."<br>Available Color: ". $row['colors'] ."</td>";
						echo "<td style='text-align:center;'>Price: Php " . $row['price'] . "</td>";
						echo "<td><a href='addtocart.php?id=". $row['id'] . " '><img src='images/cart-add-icon.png' width='50' height='50' /></a></td>";
						echo "</tr>";
					}
					// loop through results of database query, displaying them in the table 
					// close table>
					echo "</table>";
			?>
		
		</div>
	</div>

		<div class="imageWrapper" style="background:transparent;"> <!--style="background:transparent;" this one is bg below sa Welcome! hantod sa tumoy sa product table. once set to anycolor aside to 'transparent', dli machange ang color ug apil sa bg changer-->
			<h5>Choose Theme:</h5>
			<section id="buttons">
			  <div id="blue" onclick="change('#23607f')"></div>
			  <div id="maroon" onclick="change('#530133')"></div>
			  <div id="green" onclick="change('#52673b')"></div>
			  <div id="red" onclick="change('#675f3b')"></div>
			  <div id="black" onclick="change('black')"></div>
			  <div id="violet" onclick="change('#502c6e')"></div>
			</section>				
		</div>
</body>
<?php include ('footer.php'); ?>