<?php include "root.php"; ?>
<link rel="stylesheet" type="text/css" href="../css/index.css">
<div class="container">
	<nav>
		<ul class="left">
			<li><a href="">Home</a></li>
			<li><a href="customer.php">Customer</a></li>
			<li><a href="barang.php">Barang</a></li>
			<li><a href="kategori.php">Kategori</a></li>
			<li><a href="transaksi.php">Transaksi</a></li>
		</ul>
		<ul class="right">
			<li><a href=""><?php echo $_SESSION['nama']; ?> (logout)</a></li>
		</ul>
		<div class="both"></div>
	</nav>
	<header style="border-bottom:1px solid #f1f1f1">
		<h1>BELANJA.COM</h1>
		<p>Selamat datang di halaman admin <?php echo $_SESSION['nama']; ?></p>
	</header>

</div>