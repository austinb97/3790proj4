<?php
require_once('variables.php');
session_start();

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
<div class="welcome">
<h1>Welcome</h1>
</div>

<div class="cardsWrap">

<?php
	print_r($_SESSION['cartArray']);

while($row = mysqli_fetch_array($result)){
	echo '<div class="card"><div class="cardLeft">';
	echo '<img src="'.$row['image'].'">';
	echo '</div><div class="cardRight">';
	echo '<h1>'.$row['name'].'</h1>';	
	echo '<div class="closeX toggle">X</div>';
	echo '<p class="toggle">'.$row['description'].'</p>';
	echo '<h2>$'.$row['price'].'.00</h2>';
	echo '<a class="toggle" href="cart.php?id='.$row['id'].'"><button>Add to Cart</button></a>';
	echo '</div></div>';
}
?>

<!-- <div class="card">
<div class="cardLeft">
c
</div>
<div class="cardRight">
<h1>Name</h1>
<p>description text here</p>
<h2>Price</h2>
<a href="#"><button>Add to Cart</button></a>
</div>
</div> -->

</div> <!-- end cards wrap -->
<?php require_once('footer.php'); ?>
</div> <!-- end container -->
</body>
<script type="text/javascript" src="js/main.js"></script>
</html>