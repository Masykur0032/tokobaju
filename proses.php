<?php include "head.php"; ?>
<div class="container">
	<br><br>
<center>
	<table class="tb_customer">
		<tr>
			<th>Nama barang</th>
			<th>Harga</th>
			<th>Jumlah beli</th>
			<th>Total Harga</th>
            <th>Status</th>
            <th>Bukti Pembayaran</th>
			<th>Aksi</th>
		</tr>
		<?php $data->proses_transaksi($_SESSION["id_cust"]) ?>
	</table>
<br><br>
</div>