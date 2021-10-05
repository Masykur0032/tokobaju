<?php
session_start();
if (!isset($_SESSION['username'])) {
	header("location:index.php");
}
include "head.php"; ?>
<div class="container">
	<br><br>
<center>
	<table class="tb_customer">
		<tr>
			<th>Nama barang</th>
			<th>Total Harga</th>
            <th>Status</th>
			<th>Aksi</th>
		</tr>
		<?php $data->tampil_transaksi() ?>
	</table>
<br><br>
</div>