<?php
require_once('variables.php');

?>

<?php require_once('head.php'); ?>
<body>
<?php require_once('nav.php'); ?>
<div class="container">
<div class="content">
	<h1>Add Launcher</h1>
<form action="<?php $SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
	<fieldset>
		<label><p>Launcher Name: </p><input type="text" name="name"></label>
		<label><p>Inventory Amount: </p><input type="number" name="inventory"></label>
		<label><p>Price: </p><input type="number" name="price"></label>
		<label><p>Description: </p><input type="text" name="description"></label>
		<label><p>Photo: </p><input type="file" name="photo"></label>
	</fieldset>
	<input class="submitBtn" type="submit" name="submitBtnLaunch" value="Add Launcher">
</form>

<?php
$name = $_POST[name];
$inventory = $_POST[inventory];
$price = $_POST[price];
$description = $_POST[description];
$photo = $_POST[photo];

if(isset($_POST['submitBtnLaunch'])){
	//MAKE PHOTO PATH AND NAME
	// $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
	$filename = 'productImages/'.$name.'.jpg';
	// $filepath = 'productImages/';

	// //----VERIFY IMAGE IS VALID----
	// $validImage = true;
	// //CHECK IMAGE MISSING
	// if($_FILES['photo']['size'] == 0){
	// 	echo 'No image selected';
	// 	$validImage = false;
	// };
	// //CHECK IMAGE SIZE TOO LARGE
	// if($_FILES['photo']['size'] > 204800){
	// 	echo 'image size larger than 200kb';
	// 	$validImage = false;
	// };
	// //CHECK FILE TYPE
	// if($_FILES['photo']['type'] =='image/gif' || $_FILES['photo']['type'] =='image/jpeg' || $_FILES['photo']['type'] =='image/pjpeg' || $_FILES['photo']['type'] =='image/png'){
	// 	//correct
	// }else{
	// 	echo 'Wrong file format';
	// 	$validImage = false;
	// };

	// if($validImage == true){
		//upload file
		$tmp_name = $_FILES['photo']['tmp_name'];
		move_uploaded_file($tmp_name, $filename);
		// echo $tmp_name;
		// echo '<br>'.$filename;
		@unlink($_FILES['photo']['tmp_name']);


		//BUILD DB CONNECTION
		$dbConnection = mysqli_connect(HOST,USER,PASSWORD,DBNAME) or die('connection failed');

		//BUILD THE QUERY
		$query = "INSERT INTO spudLaunchers (name, inventory, price, description, image)"."VALUES ('$name', '$inventory', '$price', '$description', '$filename')";

		//TALK TO DB
		$result = mysqli_query($dbConnection, $query) or die('query failed');

		//HANG UP WHEN DONE
		mysql_close($dbConnection);

		echo 'Successfully added new Launcher!';

		// echo $query;

	// }else{
	// 	//try again
	// 	echo 'Please try again';
	// };
};
?>

</div> <!-- end content -->

<?php require_once('footer.php'); ?>
</div> <!-- end container -->
</body>
</html>