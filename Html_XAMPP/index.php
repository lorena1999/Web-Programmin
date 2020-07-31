<?php 	

	   function alert($msg) {
    		echo "<script type='text/javascript'>alert('$msg');</script>";
    	}

		$_SESSION["counter"]=0;	
		$_SESSION["clicks"]=0;
		$_SESSION["data_size"]=0;
		$_SESSION["animals"] = array();
		$_SESSION["shopping_cart"] = array();

		function init()
		{

			$animals = array();

			$conn = mysqli_connect('localhost', 'root');
			$db = mysqli_select_db($conn, 'petshop');

			$sql = "SELECT * FROM dogs";
			$dog_result = mysqli_query($conn, $sql);

			while($row = mysqli_fetch_array($dog_result))
			{
				array_push($_SESSION["animals"], $row);
			}

			$sql = "SELECT * FROM cats";
			$cat_result = mysqli_query($conn, $sql);

			while($row = mysqli_fetch_array($cat_result))
			{
				array_push($_SESSION["animals"], $row);
			}

			$sql = "SELECT * FROM birds";
			$bird_result = mysqli_query($conn, $sql);

			while($row = mysqli_fetch_array($bird_result))
			{
				array_push($_SESSION["animals"], $row);
			}

		}

		session_start();

		

	   if (isset($_POST['add_to_cart']))
	   {
	   		$_SESSION['clicks']++;
	   		$idx = key($_POST["add_to_cart"]);

	   		echo "<input type='submit' id='cter' value='".$_SESSION['clicks']."'>";

	   		array_push($_SESSION["shopping_cart"], $_SESSION["animals"][$idx]);
	   		$c = count($_SESSION["shopping_cart"])-1;

	   }

	   if (isset($_POST['next_page_z']))
	   {
	   		if($_SESSION["counter"]+4<$_SESSION["data_size"])
	   			$_SESSION["counter"]+=4;
	   }

	   if(isset($_POST['prev_page_a']))
	   {
	   		if($_SESSION["counter"] >= 4)
	   			$_SESSION["counter"]-=4;
	   }

	   if(isset($_POST["emptybtn"]))
	   {	
	   		$_SESSION["clicks"]=0;
	   		$_SESSION["shopping_cart"] = array();
	   		echo "<input type='submit' id='cter' value='".$_SESSION['clicks']."'>";
	   }

	   function display_one($row, $nr)
	   {
	   			$today = new DateTime();
				$birthdate = new DateTime($row['Dob']);
				$interval = $today->diff($birthdate);

				echo "<div id='img_div'>";
				echo "<img src='web_imgs/".$row['web_img']."'>";
				echo "<p>"."Name: ".$row['Name']."</p>";
				echo "<p>"."Species: ".$row['Species']."</p>";
				echo "<p>"."Gender: ".$row['Gender']."</p>";
				echo "<p>"."Age: ".$interval->format('%y years %m months %d days')."</p>";
				echo "<p>"."Price: ".$row['Price']."$</p>";
				echo "<form method='post'>";
				echo "<input type='submit' name='add_to_cart[".$nr."]' value='Add to cart'>";
				echo "</form>";
				echo "</div>";
	   }

	   function display()
	   {

	   		$conn = mysqli_connect('localhost', 'root');
			$db = mysqli_select_db($conn, 'petshop');

			$sql = "SELECT * FROM dogs";
			$dog_result = mysqli_query($conn, $sql);

			$animals = array();

			while($row = mysqli_fetch_array($dog_result))
			{
				array_push($animals, $row);
			}

			$sql = "SELECT * FROM cats";
			$cat_result = mysqli_query($conn, $sql);

			while($row = mysqli_fetch_array($cat_result))
			{
				array_push($animals, $row);
			}

			$sql = "SELECT * FROM birds";
			$bird_result = mysqli_query($conn, $sql);

			while($row = mysqli_fetch_array($bird_result))
			{
				array_push($animals, $row);
			}

			$_SESSION["data_size"] = count($animals);

			$stop = $_SESSION["counter"]+4;
			for($i=$_SESSION["counter"]; $i<$stop && $i<count($animals); $i++)
			{
				display_one($animals[$i], $i);
			}

			if($_SESSION["counter"]==0)
			{
				if(count($animals)>4)
				{
					echo "<form method='post'>";
					echo "<input type='submit' id='next_page' name='next_page_z' value='Next Page'>";
					echo "</form>";
				}
			}
			else if($_SESSION["counter"]+4>=count($animals))
			{
				echo "<form method='post'>";
				echo "<input type='submit' id='prev_page', name='prev_page_a', value='Previous Page'>";
				echo "</form>";	
			}
			else
			{
				echo "<form method='post'>";
				echo "<input type='submit' id='prev_page', name='prev_page_a', value='Previous Page'>";
				echo "<input type='submit' id='next_page' name='next_page_z' value='Next Page'>";
				echo "</form>";		
			}

	   }

 ?>


<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>

<body>

	<div id='top_bar'>
		<a href="cart.php"><i class='fas fa-shopping-cart fa-2x'></i></a>
	</div>

	<div class="dropdown">
	  <button class="dropbtn">Products</button>
	  <div class="dropdown-content">
	    <a href="dogs.php">Dogs</a>
	    <a href="cats.php">Cats</a>
	    <a href="birds.php">Birds</a>
	    <a href="index.php">All</a>
	  </div>
	</div>


	<form method="post" action="index.php" enctype="multipart/form-data">
		<button class="emptyshopp" name="emptybtn">Ditch all</button>
	</form>


	<div id="content">

		<?php 
			init();
			display();
		 ?>


		 
		<form method="post" action="index.php" enctype="multipart/form-data">

		</form>
	</div>
</body>
</html>