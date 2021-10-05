<?php 
session_start();
if (!isset($_SESSION['username'])) {
	header("location:index.php");
}
include "head.php";
?>
<div class="container">
		<form class="ftambah" action="hand.php?act=tambah_kategori" method="post">
		<input type="text" name="nama_kat" placeholder="Nama Kategori"><br>
		<input type="submit" value="simpan">
	</form>
</div>