<?php include "root.php"; ?>
<link rel="stylesheet" type="text/css" href="css/index.css">
<div class="container">
	<nav>
		<ul class="left">
			<li><a href="index.php">Home</a></li>
		</ul>
		<ul class="right">
		<?php
		session_start();
		if (isset($_SESSION['username_cust'])) {
			?>
			<li><a href="keranjang.php">Keranjang</a></li>
			<li><a href="hand.php?act=logout"><?= $_SESSION['nama_cust'] ?> (Logout)</a></li>
		
			<?php
		}else{ ?>
			<li><a href="login.php">Login</a></li>
			<li><a href="daftar.php">Daftar</a></li>
			<?php } ?>
		</ul>
		<div class="both"></div>
	</nav>
	<header>
		<h1>BELANJA.COM</h1>
		<p>Belanja Mudah , Murah , Gak Nguras Kantong ..!!!</p>
	</header>
	<div class="nav">
		<ul>
		<?php 
$data->tampil_cat();
		 ?>
		</ul>
	</div>
</div>

