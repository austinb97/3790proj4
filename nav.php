<nav>
	<div class="navWrap">
	<h1>Spuds R Us</h1>
	<ul>
		<li><a href="index.php">home</a></li>
		<li><a href="cart.php">cart</a></li>
		<li><a href="checkout.php">checkout</a></li>
		<?php
		if(isset($_COOKIE['username'])){
			echo '<li class="adminNav"> admin controls: </li>';
			echo '<li class="adminNav"><a href="orders.php">orders</a></li>';
			echo '<li class="adminNav"><a href="inventory.php">inventory</a></li>';
			echo '<li class="adminNav"><a href="logout.php">logout</a></li>';
		}
		?>
	</ul>
	</div>
</nav>
<img id="bgImg" src="images/dirtCompress.jpg">