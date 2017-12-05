<?php
require_once('variables.php');
session_start();



    $Bfirstname = $_POST[Bfirstname];
    $Blastname = $_POST[Blastname];
    $Baddress = $_POST[Baddress];
    $Bcity = $_POST[Bcity];
    $Bstate = $_POST[Bstate];
    $Bzip = $_POST[Bzip];

    $billing_info = $Baddress . ', ' .$Bcity. ' ' .$Bstate . ' ' .$Bzip;

    $isActive = $_POST[isActive];

    $stripeToken = $_POST[stripeToken];
    $stripeTokenType = $_POST[stripeTokenType];
    $email = $_POST[stripeEmail];

    $totalCost = $_SESSION['totalPrice'] + 10;


//BUILD DB CONNECTION
$dbConnection = mysqli_connect(HOST,USER,PASSWORD,DBNAME) or die('connection failed');

//BUILD FIRST QUERY
$query = "INSERT INTO customer(first, last, address, email, billingAmount, isActive)"."VALUES('$Bfirstname', '$Blastname', '$billing_info', '$email', '$totalCost', '$isActive')";

//TALK TO DB 
$result = mysqli_query($dbConnection, $query) or die('query 1 failed');

// UPDATE ORDER 
//get id of user just added
$recent_id= mysqli_insert_id($dbConnection);

$launcherArray = $_SESSION['orderedLaunchers'];
//loop through array of packages selected
foreach($_SESSION['orderedLaunchers'] as $launcherID){
    $lquantity = $_SESSION['launcher'.$launcherID];

    //build query
    $query3 = "INSERT INTO `order`(customerId, launcherId, quantity) VALUES ($recent_id, $launcherID, $lquantity)";

    echo $query3;

    //try delete record
    $result3 = mysqli_query($dbConnection, $query3) or die ('update software skill query failed');    

}; //end foreach


//-----------DISPLAYING INFO BELOW---------
//BUILD THE SECOND QUERY
$query2 = "SELECT * FROM spudLaunchers";

//TALK TO DB 2
$result2 = mysqli_query($dbConnection, $query2) or die('query 2 failed');

?>

<?php require_once('head.php'); ?>
<body>
<?php require_once('nav.php'); ?>
<div class="container">
<div class="content">
<h1>Confirm</h1>
<h2 class="conh2">Thank You!</h2>

<?php

echo 'First Name: ' . $Bfirstname . '<br>';
echo 'Last Name: ' . $Blastname . '<br>';
echo 'Billing Address: ' . $billing_info . '<br>';
echo 'Email: ' . $email . '<br>';

echo '<h2 class="conh2">Order:</h2>';

$_SESSION['totalPrice'] = 0;

while($row = mysqli_fetch_array($result2)){
        if ($_SESSION['launcher'.$row['id']] > 0) {
            echo '<form action="cart.php" method="POST">';
            echo '<div class="invRow">';
            echo '<div class="w33"><h2>'.$row['name'].'</h2></div>';
            echo '<div class="w33"><p class="qtyInd">'.$_SESSION['launcher'.$row['id']].'</p></div>';
            echo '<div class="w33">';
            $price = $row['price'] * $_SESSION['launcher'.$row['id']];
            $_SESSION['totalPrice'] += $price;
            echo '<p>$'.$price.'</p>';
            echo '</div>';
            echo '</div>';
            echo '<input type="hidden" value="'.$row['id'].'" name="updatedID">';
            echo '</form>';
        }
    }
    echo '<div class="lastRow"></div>';
    echo '<div class="totalField"><p class="addShip">+ $10 shipping</p></div>';
    $newTotal = $_SESSION['totalPrice'] + 10;
    echo '<div class="totalField"><div class="totalPrice">$'.$newTotal.'</div></div>';

?>

<div class="keepOpen"></div>
</div> <!-- end content -->

<?php require_once('footer.php'); ?>
</div> <!-- end container -->
</body>
<script type="text/javascript" src="js/main.js"></script>
</html>