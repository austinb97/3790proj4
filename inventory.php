<?php
require_once('variables.php');

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
	<h1>Inventory</h1>

	<div class="w33">
	<h3>Name</h3>
	</div>
	<div class="w33">
	<h3>Inventory</h3>
	</div>

	<br>

<?php
	while($row = mysqli_fetch_array($result)){
		echo '<div class="invRow">';
		echo '<div class="w33"><h2>'.$row['name'].'</h2></div>';
		echo '<div class="w33"><p>'.$row['inventory'].'</p></div>';
		echo '<div class="w33"><a class="updateLink" href="update.php?id='.$row['id'].'"> update</a>';
		echo '<a class="deleteLink" href="delete.php?id='.$row['id'].'">delete</a></div>';
		echo '</div>';
	};
	//HANG UP WHEN DONE
	mysql_close($dbConnection);
?>
<a href="add.php"><button class="submitBtn">Add Launcher</button></a>
</div> <!-- end content -->

<?php require_once('footer.php'); ?>
</div> <!-- end container -->
</body>
<script type="text/javascript" src="js/main.js"></script>
</html>