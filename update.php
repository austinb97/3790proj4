<?php
require_once('variables.php');

$launcherId = $_GET[id];

//BUILD DB CONNECTION
$dbConnection = mysqli_connect(HOST,USER,PASSWORD,DBNAME) or die('connection failed');

//BUILD THE QUERY
$query = "SELECT * FROM spudLaunchers WHERE id=$launcherId";

//TALK TO DB
$result = mysqli_query($dbConnection, $query) or die('query failed1');

$found = mysqli_fetch_array($result);

?>

<?php require_once('head.php'); ?>
<body>
<?php require_once('nav.php'); ?>
<div class="container">
<div class="content">
	<h1>Update Launcher</h1>
<form action="<?php $SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
	<fieldset>
		<label><p>Launcher Name: </p><input required value="<?php echo $found['name']; ?>" type="text" name="name"></label>
		<label><p>Inventory Amount: </p><input required value="<?php echo $found['inventory']; ?>" type="number" name="inventory"></label>
		<label><p>Price: </p><input required value="<?php echo $found['price']; ?>" type="number" name="price"></label>
		<label><p>Description: </p><input required value="<?php echo $found['description']; ?>" type="text" name="description"></label>
	</fieldset>
	<input type="hidden" name="id" value="<?php echo $found['id']; ?>">
	<input class="submitBtn" type="submit" name="updateBtn" value="Update">
</form>

<?php
$name = $_POST[name];
$inventory = $_POST[inventory];
$price = $_POST[price];
$description = $_POST[description];
$id = $_POST[id];

if(isset($_POST['updateBtn'])){
	
		//BUILD DB CONNECTION
		$dbConnection = mysqli_connect(HOST,USER,PASSWORD,DBNAME) or die('connection failed');

		//BUILD THE QUERY
		$query = "UPDATE spudLaunchers SET name='$name', inventory='$inventory', price='$price', description='$description', id='$id' WHERE id='$id'";
		// echo $query;

		//TALK TO DB
		$result = mysqli_query($dbConnection, $query) or die('query failed 2');

		//HANG UP WHEN DONE
		mysql_close($dbConnection);

		header('Location: inventory.php');

};
?>

</div> <!-- end content -->

<?php require_once('footer.php'); ?>
</div> <!-- end container -->
</body>
</html>