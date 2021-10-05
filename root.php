<?php 
Class bigdata
{
	
	function __construct()
	{
		$conn = mysqli_connect("localhost","masykur","masykurw","tokobaju");
		mysqli_select_db($conn, "toko_baju");
	}
	function login($username,$password){
		$conn = mysqli_connect("localhost","masykur","masykurw","tokobaju");
		$query=mysqli_query($conn,"select * from customer where username='$username' and password='$password'");
		$check=mysqli_num_rows($query);
		if ($check > 0) {
			$data=mysqli_fetch_array($query);
			session_start();
			$_SESSION['id_cust']=$data['id'];
			$_SESSION['nama_cust']=$data['nama'];
			$_SESSION['username_cust']=$data['username'];
			header("location:index.php");
		}
		else{
			?>
			<script type="text/javascript">
				alert("Login gagal, username atau password salah");
				window.location.href="login.php";
			</script>
			<?php
		}
	}
	function daftar($nama,$alamat,$username,$password){
		$conn = mysqli_connect("localhost","masykur","masykurw","tokobaju");
		$query=mysqli_query($conn,"select * from customer where username='$username'");
		$check=mysqli_num_rows($query);
		if ($check == 0) {
			$conn = mysqli_connect("localhost","masykur","masykurw","tokobaju");
			$q=mysqli_query($conn,"insert into customer set nama='$nama',alamat='$alamat',username='$username',password='$password'");
					if ($q) {
						?>
						<script type="text/javascript">
							alert("Pendaftaran berhasil, silahkan login");
						window.location.href="login.php";
						</script>
						<?php
					}else{
						echo "galat";
					}
		}else{
					?>
					<script type="text/javascript">
						alert("Username sudah digunakan, silahkan gunakan yang lainnya");
						window.location.href="daftar.php";
					</script>
					<?php
		}
	}
	function tampil_barang(){
		$conn = mysqli_connect("localhost","masykur","masykurw","tokobaju");
		$query=mysqli_query($conn,"SELECT barang.id,barang.nama_barang,barang.qty,barang.harga,barang.keterangan,barang.gambar,kategori.nama_kategori FROM barang INNER JOIN kategori ON barang.kategori=kategori.id order by barang.id DESC");
		while ($data=mysqli_fetch_array($query)) {
			?>
				<div class="post">
					<img src="admin/<?= $data['gambar'] ?>">
					<h3><?= $data['nama_barang'] ?></h3>
					<span><?= $data['nama_kategori'] ?></span><br>
					<span><?php echo "Rp. ".number_format($data['harga'],0,',','.') ?></span><br>
					<a href="detail.php?id=<?= $data['id'] ?>">Detail</a>
				</div>
			<?php
		}
	}
	function tampil_cat(){
		$conn = mysqli_connect("localhost","masykur","masykurw","tokobaju");
		$q=mysqli_query($conn,"select * from kategori");
		while ($data=mysqli_fetch_array($q)) {
			?>
						<li><a href="kategori.php?id=<?php echo $data['id'];?>"><?php echo $data['nama_kategori'];?></a></li>
						<?php
		}
	}

	function tampil_barang_kategori($kategori){
		$conn = mysqli_connect("localhost","masykur","masykurw","tokobaju");
		$query=mysqli_query($conn,"SELECT barang.id,barang.nama_barang,barang.qty,barang.harga,barang.keterangan,barang.gambar,kategori.nama_kategori FROM barang INNER JOIN kategori ON barang.kategori=kategori.id where barang.kategori='$kategori'");

				while ($data=mysqli_fetch_array($query)) {
					?>
				<div class="post">
					<img src="admin/<?= $data['gambar'] ?>">
					<h3><?= $data['nama_barang'] ?></h3>
					<span><?= $data['nama_kategori'] ?></span><br>
					<span><?php echo "Rp. ".number_format($data['harga'],0,',','.') ?></span><br>
					<a href="detail.php?id=<?= $data['id'] ?>">Detail</a>
				</div>
			<?php
		}
	}

	function detail($id){
		$conn = mysqli_connect("localhost","masykur","masykurw","tokobaju");
		$query=mysqli_query($conn,"SELECT barang.id,barang.nama_barang,barang.qty,barang.harga,barang.keterangan,barang.gambar,kategori.nama_kategori FROM barang INNER JOIN kategori ON barang.kategori=kategori.id where barang.id='$id'");
			$data=mysqli_fetch_array($query);
					?>
				<div class="postsingle">
					<img src="admin/<?= $data['gambar'] ?>">
					<h3><?= $data['nama_barang'] ?></h3>
					<span>Kategori : <?= $data['nama_kategori'] ?></span><br>
					<span><?php echo "Rp. ".number_format($data['harga'],0,',','.') ?></span><br>
					<?php 
						if (isset($_SESSION['username_cust'])) {
							?>
								<form action="hand.php?act=tambah_keranjang" method="post">
									<input type="hidden" name="id" value="<?= $data['id']; ?>"><br>
									<input type="hidden" name="id_customer" value="<?= $_SESSION['id_cust'] ?>">
									<input type="number" name="jumlah_beli" placeholder="jumlah beli">
									<button type="submit">Tambah ke keranjang</button>
								</form>
							<?php		
						}else{
							?>
								<a href="login.php">Login</a>
							<?php
						}
					?>
					<div class="both"></div>
					<p>Keterangan : <?= $data['keterangan'] ?></p>
					
				</div>
			<?php
		
	}
	function tambah_keranjang($id,$id_cust,$jumlah_beli){
		$conn = mysqli_connect("localhost","masykur","masykurw","tokobaju");
		$query=mysqli_query($conn,"select * from barang where id='$id'");
		$data=mysqli_fetch_array($query);
		$total_bayar=$data["harga"]*$jumlah_beli;
		$nama_barang=$data["nama_barang"];
		$harga=$data["harga"];
		$tkeranjang=mysqli_query($conn,"insert into keranjang set id_customer='$id_cust',nama_barang='$nama_barang',harga='$harga',jumlah_beli='$jumlah_beli',total_harga='$total_bayar'");
		$ttransaksi=mysqli_query($conn,"insert into transaksi set id_customer='$id_cust',nama_barang='$nama_barang',harga='$harga',jumlah_beli='$jumlah_beli',total_harga='$total_bayar',status='Belum Dibayar'");
		if ($tkeranjang) {	?>
						<script type="text/javascript">
							alert("berhasil ditambahkan ke keranjang");
						window.location.href="index.php";
						</script>
						<?php
					}else{
						echo mysqli_errno($conn);
					}
	}
	function tampil_keranjang($id_cust){
		$conn = mysqli_connect("localhost","masykur","masykurw","tokobaju");
		$query=mysqli_query($conn,"select * from keranjang where id_customer='$id_cust'");
		while ($data=mysqli_fetch_array($query)) {
			?>
			<tr>
				<td><?php echo $data['nama_barang'] ?></td>
				<td><?php echo $data['harga'] ?></td>
				<td><?php echo $data['jumlah_beli'] ?></td>
				<td><?php echo "Rp. ".number_format($data['total_harga'],0,',','.') ?></td>
				<td><a href="hand.php?act=hapus_keranjang&id=<?= $data['id'] ?>" class="b">Hapus</a></td>
			</tr>
			<?php
		}
		?>
			<tr>
			<?php 
			$sum=mysqli_query($conn,"SELECT SUM( total_harga ) AS total_harga
FROM keranjang where id_customer='$id_cust'");
			$sum_array=mysqli_fetch_array($sum);
			 ?>
				<td colspan="3">Total : </td><td><?php echo "Rp. ".number_format($sum_array['total_harga'],0,',','.') ?></td>
				<td><a href="proses.php" class="a">Proses</a></td>
			</tr>
		<?php

	}
	function hapus_keranjang($id,$id_cust){
		$conn = mysqli_connect("localhost","masykur","masykurw","tokobaju");
		$query=mysqli_query($conn,"delete from keranjang where id='$id'");
		$q=mysqli_query($conn,"delete from transaksi where id_customer='$id_cust'");
		header("location:keranjang.php");
	}

	function proses_transaksi($id_cust){
		$conn = mysqli_connect("localhost","masykur","masykurw","tokobaju");
		$query=mysqli_query($conn,"select * from transaksi where id_customer='$id_cust'");
		$q=mysqli_query($conn,"update transaksi set status='Menunggu' where id_customer='$id_cust'");
		while ($data=mysqli_fetch_array($query)) {
			?>
			<tr>
				<td><?php echo $data['nama_barang'] ?></td>
				<td><?php echo $data['harga'] ?></td>
				<td><?php echo $data['jumlah_beli'] ?></td>
				<td><?php echo "Rp. ".number_format($data['total_harga'],0,',','.') ?></td>
				<td><?php echo $data['status'] ?></td>
				<td>
					<form action="hand.php?act=img_transaksi" enctype="multipart/form-data" method="post">
						<input type="file" name="foto">
					</form>
				</td>
				<td><a href="hand.php?act=update_transaksi&id=<?= $data['id'] ?>" class="a">Simpan</a></td>
			</tr>
			<?php
		}
		?>
		<?php
	}
	function update_transaksi($id,$namagambar,$tmpgambar,$type_foto){
		$destination="gambar/$namagambar";
		move_uploaded_file($tmpgambar, $destination);
		$conn = mysqli_connect("localhost","masykur","masykurw","tokobaju");$conn = mysqli_connect("localhost","root","","toko_baju");
		$query=mysqli_query($conn,"update transaksi set gambar='$destination', status='Menunggu' where id='$id'");
		header("location:proses.php");
	}

}
$data=new bigdata();
 ?>