<?php 
session_start();
if (!isset($_SESSION['username'])) {
	header("location:index.php");
}
include "head.php";
$id=$_GET["id"];
$conn = mysqli_connect("localhost","root","","toko_baju");
$query=mysqli_query($conn,"select * from barang where id='$id'");
$data_edit=mysqli_fetch_array($query);
?>
<div class="container">
	<form class="ftambah" action="hand.php?act=simpan_edit_barang" enctype="multipart/form-data" method="post">
	<input type="hidden" name="id" value="<?= $data_edit['id'] ?>">	
		<input type="text" name="nama_barang" placeholder="Nama Barang" value="<?= $data_edit['nama_barang'] ?>"><br>
		<input type="text" name="qty" placeholder="Jumlah barang" value="<?= $data_edit['qty'] ?>"><br>
		<input type="text" name="harga" placeholder="Harga" value="<?= $data_edit['harga'] ?>"><br>
		<textarea name="ket" placeholder="Keterangan"><?= $data_edit['keterangan'] ?></textarea><br>
		<input type="file" name="foto" value=""> (foto)<br>
		<select name="kategori">
			<?php $data->tampil_kategori1() ?>
		</select><br>
		<input type="submit" value="simpan">
	</form>
</div>