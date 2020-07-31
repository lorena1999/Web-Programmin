<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Page Title</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="tableStyle.css?v=<?php echo time(); ?>">
</head>
<body>

	<table>
		<caption>Your animals</caption>
		<tr>
			<th>Name:</th>
			<th>Species:</th>
			<th>Gender:</th>
			<th>Age:</th>
			<th>Price:</th>
			<th>Photo:</th>
			<th>Quantity:</th>
			<th>Total-item:</th>
		</tr>

		<?php 

		function alert($msg) {
    		echo "<script type='text/javascript'>alert('$msg');</script>";
    	}

		function get_frequence($array, $item)
		{
			$frq = 0;
			for($i=0; $i<count($array); $i++)
			{
				if($array[$i]==$item)
					$frq++;
			}	
			return $frq;
		}

		
		function was_displayed($array, $idx)
		{
			$verdict=0;
			$item = $array[$idx];
			for($i=0; $i<count($array) && $verdict==0; $i++)
				if($array[$i]==$item && $i<$idx)
					$verdict=1;
			return $verdict;
		}

		$started=0;

		session_start();
		
		if (isset($_POST['removebtn']))
		{
			$started=1;
			$idx = key($_POST["removebtn"]);
			$new_cart = array();
			for($i=0; $i<count($_SESSION["shopping_cart"]); $i++)
				if($i!=$idx)
					array_push($new_cart, $_SESSION["shopping_cart"][$i]);
			$_SESSION["shopping_cart"] = $new_cart;
			if($_SESSION["clicks"]>0)
				$_SESSION["clicks"]--;
			display_cart();

		}

		function display_cart()
		{	
			$c=0;
			$x=0;
			$sum=0;

			foreach ($_SESSION["shopping_cart"] as $keys => $values) {
			$vrd = was_displayed($_SESSION["shopping_cart"], $c);
			if($vrd==0)
			{


		echo "<tr>";
			echo "<td>".$values["Name"]."</td>";
			echo "<td>".$values["Species"]."</td>";
			echo "<td>".$values["Gender"]."</td>";

				$today = new DateTime();
				$birthdate = new DateTime($values['Dob']);
				$interval = $today->diff($birthdate);
				echo "<td>".$interval->format('%y years %m months %d days')."</td>";
				echo "<td>".$values["Price"]."$</td>";

				echo "<td><img src='web_imgs/".$values['web_img']."'></td>";

				echo "<td>".get_frequence($_SESSION["shopping_cart"], $values)."</td>";

				$t1 = $values["Price"];
				$t2 = get_frequence($_SESSION["shopping_cart"], $values);
				$total_item = $t1*$t2;
				$sum+=$total_item;
				echo "<td>".$total_item."$</td>";
				echo "<form method='post' action='cart.php' enctype='multipart/form-data'>";
				echo "<td><button class='removebtn' name='removebtn[".$c."]'>Remove</button></td>";
				echo "</form>";
				$x++;
			echo "</tr>";

			}
			$c++;
		}
		echo "</table>";

		echo "<p>Total: ".$sum."$</p>";
	}	

		if($started==0)
			display_cart();

		 ?>

	<a href="index.php"><button class="backbtn">Back to products</button></a>

</body>
</html>
