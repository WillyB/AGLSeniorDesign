<html>
	<head>
		<title>CS505 Project 1</title>
	</head>
		<form name ="form1" method ="post" action ="login.php">
		<p align="right">
		<input method="post" type="submit" name="Submit2" value="logout" align="top|right"/>
		</p>
		</form>
	<body bgcolor="silver">
		<h1>CS505 Project 1: COMPARTMENTS</h1>
		<h3>By Anastasia Kazadi</h3>
    		
	<?php
		if (isset($_POST['Submit2'])) 
		{
			header("Location: login.php");
		}
	?>		
			<h2>Choose an action and click on the link:</h2>
			<h3>View <a href="custviewinventory.php"> inventory</a></h3>
			<h3>View <a href="cart.php">my cart</a></h3>
			<h3>View <a href="custvieworder.php">my orders</a></h3>
		</body>
</html>