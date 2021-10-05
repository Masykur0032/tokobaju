<?php 
session_start();
if (!isset($_SESSION['username'])) {
	header("location:index.php");
}
include "head.php";
?>
<div class="container">
<br><br>
<center>
	<table class="tb_customer">
		<tr>
			<th>Nama</th>
			<th>Alamat</th>
			<th>username</th>
			<th>Password</th>
			<th>Aksi</th>
		</tr>
		<?php $data->tampil_customer() ?>
	</table>
<br><br>
</center>
</div>