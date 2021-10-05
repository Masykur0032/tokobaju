<?php 
session_start();
if (!isset($_SESSION['username'])) {
	header("location:index.php");
}
include "head.php";
?>
<div class="container">
	<form class="ftambah" action="hand.php?act=tambah_barang" enctype="multipart/form-data" method="post">
		<input type="text" name="nama_barang" placeholder="Nama Barang"><br>
		<input type="text" name="qty" placeholder="Jumlah barang"><br>
		<input type="text" name="harga" placeholder="Harga"><br>
		<textarea name="ket" placeholder="Keterangan"></textarea><br>
		<input type="file" name="foto"> (foto)<br>
		<select name="kategori">
			<?php $data->tampil_kategori1() ?>
		</select><br>
		<input type="submit" value="simpan">
	</form>
</div>