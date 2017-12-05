<?php
require_once('variables.php');

$launcherId = $_GET[id];

//BUILD DB CONNECTION
$dbConnection = mysqli_connect(HOST,USER,PASSWORD,DBNAME) or die('connection failed');

if(isset($_POST['delete'])){
	$query = "DELETE FROM spudLaunchers WHERE id=$_POST[id]";

	$result = mysqli_query($dbConnection, $query) or die ('delete query failed');
	@unlink($_POST['photo']);

	header("Location: http://dgm3760.austinbroadhead.com/proj4/inventory.php");

	exit;

}
//BUILD THE QUERY
$query = "SELECT * FROM spudLaunchers WHERE id=$launcherId";

//TALK TO DB
$result = mysqli_query($dbConnection, $query) or die('query failed');

$found = mysqli_fetch_array($result);

?>

<?php require_once('head.php'); ?>
<body>
<?php require_once('nav.php'); ?>
<div class="container">
<div class="content">
	<h1>Delete</h1>
<?php
	echo '<h2>'.$found['name'].'</h2>';
	echo '<img class="launcherImg" src="productImages/'.$found['image'].'">';
	echo '<p>'.$found['description'].'</p>';
	//HANG UP WHEN DONE
	mysql_close($dbConnection);
?>

<form action="delete.php" method="POST">
	<input type="hidden" name="photo" value="productImages/<?php echo $found['image']; ?>">
	<input type="hidden" name="id" value="<?php echo $found['id']; ?>">
	<input class="deleteBtn" type="submit" name="delete" value="DELETE">
</form>

</div> <!-- end content -->

<?php require_once('footer.php'); ?>
</div> <!-- end container -->
</body>
</html>