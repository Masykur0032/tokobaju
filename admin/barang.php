<?php 
session_start();
if (!isset($_SESSION['username'])) {
	header("location:index.php");
}
include "head.php";
?>
<div class="container">
	<a href="tambah.php" class="tombol">Tambah barang</a>
	<br><br>
<center>
	<table class="tb_customer">
		<tr>
			<th width="10px">No</th>
			<th width="100px">Gambar</th>
			<th>Nama Barang</th>
			<th>Stok</th>
			<th>Harga</th>
			<th>Keterangan</th>
			<th width="100px">Aksi</th>
		</tr>
		<?php $data->tampil_barang() ?>
	</table>
<br><br>
</center>

</div>