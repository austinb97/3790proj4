<?php
require_once('variables.php');

// $feedback = '<a href="signup.php">Create an account</a>';

if(isset($_POST['submitBtn'])){

$tryUsername = trim($_POST['username']);
$tryPassword = trim($_POST['password']);

$username = 'admin';
$password = 'password';

if($tryUsername == $username && $tryPassword == $password){

	//save cookies
	setcookie('username', $username, time() + (60*60*24*30));
	// setcookie('name', $name, time() + (60*60*24*30));

	header('Location: index.php');

}else{
	$feedback = 'could not find user <br>';

}; //end if

}; //end if
?>

<?php require_once('head.php'); ?>
<body>
<?php require_once('nav.php'); ?>
<div class="container">

<div class="content">
<h1>Login</h1>
<form action="login.php" method="post">
		<fieldset>
			<label><p>Username: </p><input type="text" name="username" required value="<?php if(!empty($username)) echo $username; ?>"></label>
			<label><p>Password: </p><input type="password" name="password" required></label>
		</fieldset>

		<input class="submitBtn" type="submit" name="submitBtn" value="Log In">

	</form>
</div> <!-- end content -->

<?php require_once('footer.php'); ?>
</div> <!-- end container -->
</body>
<script type="text/javascript" src="js/main.js"></script>
</html>