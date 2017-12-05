<?php
require_once('variables.php');
session_start();

require_once("./stripe/config.php");
?>

<?php require_once('head.php'); ?>
<body>
<?php require_once('nav.php'); ?>
<div class="container">
<div class="content">
<h1>Checkout</h1>
	<form action="confirmation.php" method="POST">
	<fieldset>
		<legend>Shipping Information</legend>
		<div class="formRow">
		<label>First Name:<br>
		<input type="text" name="Bfirstname" value="Test"></label>                    
        <label>Last Name:<br>
        <input type="text" name="Blastname" value="Name"></label>
        </div>
        <div class="formRow">
        <label>Address:<br>
        <input type="text" name="Baddress" value="102666 Okay rd"></label>
        <label>City:<br>
        <input type="text" name="Bcity" value="Citytown"></label>
        </div>
        <div class="formRow">
        <label>State:<br>
        <input type="text" name="Bstate" value="UT"></label>
        <label>Zip:<br>
        <input type="text" name="Bzip" value="80420"></label>
        </div>
        <input type="hidden" name="isActive" value="1">
	</fieldset>


	<?php	
echo '<div class="totalnbuy">';
echo '<div class="checkTotal">';
echo '<p class="pLeft">subtotal: </p><p class="pRight">$'.$_SESSION['totalPrice'].'</p>';
echo '<br><p class="pLeft">+ shipping: </p><p class="pRight">$10</p>';
$newTotal = $_SESSION['totalPrice'] + 10;
echo '<br><hr><div class="finalTotal"><p class="pLeft">Total:</p><p class="pRight">$'.$newTotal.'</p></div>';
echo '</div>';
// echo '</div>';
?>

<div class="purchase">
<form action="charge.php" method="POST" class="paymentButton">
<script
    type="text/javascript"
    src="https://checkout.stripe.com/checkout.js"
    class="stripe-button"
    data-key="<?php echo $stripe['publishable_key'];?>"
    data-name="Payment"
    data-description="Spud Shooter"
    data-amount="<?php echo $totalCost * 100 ?>"
    data-locale="auto"
></script>
</form>

</div><!-- end purchase -->

</div><!--  end totalnbuy -->

<div class="keepOpen"></div>
</form>
</div> <!-- end content -->

<?php require_once('footer.php'); ?>
</div> <!-- end container -->
</body>
<script type="text/javascript" src="js/main.js"></script>
</html>