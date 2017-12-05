<?php
require_once('variables.php');
session_start();

//BUILD DB CONNECTION
$dbConnection = mysqli_connect(HOST,USER,PASSWORD,DBNAME) or die('connection failed');

//BUILD THE QUERY
$query = "SELECT * FROM customer";

//TALK TO DB 
$result = mysqli_query($dbConnection, $query) or die('query failed');

?>

<?php require_once('head.php'); ?>
<body>
<?php require_once('nav.php'); ?>
<div class="container">
<div class="content">
<h1>Orders</h1>
<form action="orders.php" method="POST">

<!-- <div class="customerRow"> -->
<p class="order Name h">name</p>
<p class="order Address h">address</p>
<p class="order Email h">email</p>
<div class="order Joined h">
    <p class="order LauncherId h">id</p>
    <p class="order LauncherQuantity h">qty</p>
</div>
<p class="order Total h">total</p>
<p class="order Fulfilled h">status</p>
<!-- </div> -->

<?php

if(isset($_POST['submit'])){
    foreach ($_POST['orders'] as $ordersId){
        $queryUpdate = "UPDATE customer SET isActive=0 WHERE id=$ordersId";

        $resultUpdate = mysqli_query($dbConnection, $queryUpdate) or die('update query failed');
    };
};

while ($row = mysqli_fetch_array($result)){
echo '<div class="customerRow">';
echo '<p class="order Name b">'.$row['first'].' '.$row['last'].'</p>';
echo '<p class="order Address b">'.$row['address'].'</p>';
echo '<p class="order Email b">'.$row['email'].'</p>';
echo '<div class="order Joined b">';

$theid = $row['id'];
// FIND LAUNCHERID NAME AND QUANTITY FOR EACH CUSTOMER
$query2 = "SELECT * FROM `order` INNER JOIN `customer` ON (order.customerId = customer.id) WHERE customerId = $theid";
//TALK TO DATABASE
$resultPackage = mysqli_query($dbConnection, $query2) or die('package query failed');

while($row2 = mysqli_fetch_array($resultPackage)){
    if($row2['quantity'] > 0){
    echo '<div class="LauncherRow">';
    echo '<p class="order LauncherId b">'.$row2['launcherId'].'</p>';
    echo '<p class="order LauncherQuantity b">'.$row2['quantity'].'</p>';
    echo '</div>';
}
};

echo '</div>';
echo '<p class="order Total b">$'.$row['billingAmount'].'</p>';
echo '<p class="order Fulfilled b">';
echo ($row['isActive'] == 1 ? 'active':'completed');
echo '</p>';
echo '<input class="order check" type="checkbox" value="'.$row['id'].'" name="orders[]">';
echo '</div>';

}

?>
<input type="submit" value="Fulfill" name="submit">
</form>
<div class="keepOpen"></div>
</div> <!-- end content -->

<?php require_once('footer.php'); ?>
</div> <!-- end container -->
</body>
<script type="text/javascript" src="js/main.js"></script>
</html>