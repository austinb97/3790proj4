<?php
require_once('variables.php');
session_start();

if(isset($_GET[id])){
	$launcherId = $_GET['id'];

	if(empty($_SESSION['launcher'.$launcherId])){
	$_SESSION['launcher'.$launcherId] = 1;
	}else{
		$_SESSION['launcher'.$launcherId] += 1;
	}
	$feedback = $_SESSION['launcher'.$launcherId];
};

$updatedAmount = $_POST['changeAmount'];
$launcherId = $_POST['updatedID'];

if($updatedAmount == "+"){
	$_SESSION['launcher'.$launcherId] += 1;
}
if($updatedAmount == "-"){
	$_SESSION['launcher'.$launcherId] -= 1;
}


//BUILD DB CONNECTION
$dbConnection = mysqli_connect(HOST,USER,PASSWORD,DBNAME) or die('connection failed');

//BUILD THE QUERY
$query = "SELECT * FROM spudLaunchers";

//TALK TO DB
$result = mysqli_query($dbConnection, $query) or die('query failed');

?>

<?php require_once('head.php'); ?>
<body>
<?php require_once('nav.php'); ?>
<div class="container">
<div class="content">
	<h1>Cart</h1>
	<div class="w33">
	<h3>Name</h3>
	</div>
	<div class="w33">
	<h3>Quantity</h3>
	</div>
	<div class="w33">
	<h3>Price</h3>
	</div>
	<br>

<!-- 	<form action="checkout.php" method="POST"> -->
	<?php
	// print_r($_SESSION['cartArray']);
	 // echo '<br> feedback:';
	 // print_r($feedback);
	// echo '<br> feedback2:';
	// print_r($feedback2);

	$_SESSION['totalPrice'] = 0;

	while($row = mysqli_fetch_array($result)){
		if ($_SESSION['launcher'.$row['id']] > 0) {
			echo '<form action="cart.php" method="POST">';
			echo '<div class="invRow">';
			echo '<div class="w33"><h2>'.$row['name'].'</h2></div>';
			echo '<div class="w33"><input class="minBtn" type="submit" value="-" name="changeAmount"><p class="qtyInd">'.$_SESSION['launcher'.$row['id']].'</p><input class="plusBtn" type="submit" value="+" name="changeAmount"></div>';
			echo '<div class="w33">';
			$price = $row['price'] * $_SESSION['launcher'.$row['id']];
			$_SESSION['totalPrice'] += $price;
			echo '<p>$'.$price.'</p>';
			echo '</div>';
			echo '</div>';
			echo '<input type="hidden" value="'.$row['id'].'" name="updatedID">';
			echo '</form>';
			if(!in_array($row['id'], $_SESSION['orderedLaunchers'])){
				$_SESSION['orderedLaunchers'][] = $row['id'];
			}
		}
	}
	echo '<div class="lastRow"></div>';

	echo '<div class="totalField"><div class="totalPrice">$'.$_SESSION['totalPrice'].'</div><p class="smallTxt">+shipping</p></div>';
	echo '<div class="checkoutField"><a href="checkout.php"><button class="checkoutBtn">Checkout</button></a></div>';

?>
<div class="keepOpen"></div>

<!-- </form> -->
</div> <!-- end content -->

<?php require_once('footer.php'); ?>
</div> <!-- end container -->
</body>
<script type="text/javascript" src="js/main.js"></script>
</html>