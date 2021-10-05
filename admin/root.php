<?php 
Class bigdata
{
	
	function __construct()
	{
		$conn = mysqli_connect("localhost","masykur","masykurw","tokobaju");
		//mysql_connect("localhost","root","");
		mysqli_select_db($conn,"toko_baju");
	}
	function login($username,$password){
		$conn = mysqli_connect("localhost","masykur","masykurw","tokobaju");
		$query=mysqli_query($conn,"select * from admin where username='$username' and password='$password'");
		$check=mysqli_num_rows($query);
		if ($check > 0) {
			$data=mysqli_fetch_array($query);
			session_start();
			$_SESSION['id']=$data['id'];
			$_SESSION['nama']=$data['nama'];
			$_SESSION['username']=$data['username'];
			header("location:home.php");
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
	function tampil_customer(){
		$conn = mysqli_connect("localhost","masykur","masykurw","tokobaju");
		$query=mysqli_query($conn,"select * from customer");
		while ($data=mysqli_fetch_array($query)) {
			?>
			<tr>
				<td><?php echo $data['nama'] ?></td>
				<td><?php echo $data['alamat'] ?></td>
				<td><?php echo $data['username'] ?></td>
				<td><?php echo $data['password'] ?></td>
				<td><a class="b" href="hand.php?act=hapus_cust&id=<?php echo $data['id'] ?>">Hapus</a></td>
			</tr>
			<?php
		}
	}
	function tampil_kategori(){
		$conn = mysqli_connect("localhost","masykur","masykurw","tokobaju");
		$query=mysqli_query($conn,"select * from kategori");
		while ($data=mysqli_fetch_array($query)) {
			?>
			<tr>
				<td><?php echo $data['nama_kategori'] ?></td>
				<td><a class="b" href="hand.php?act=hapus_cat&id=<?php echo $data['id'] ?>">Hapus</a></td>
			</tr>
			<?php
		}
	}
	function hapus_cust($id){
		$conn = mysqli_connect("localhost","masykur","masykurw","tokobaju");
		$query=mysqli_query($conn,"delete from customer where id='$id'");
		if ($query) {
			?>
			<script type="text/javascript">
				alert("data berhasil dihapus");
				window.location.href="customer.php";
			</script>
			<?php
		}else{

			?>
			<script type="text/javascript">
				alert("data gagal dihapus");
				window.location.href="customer.php";
			</script>
			<?php
		}
	}
	function tambah_cat($nama_cat){
		$conn = mysqli_connect("localhost","masykur","masykurw","tokobaju");
		$query=mysqli_query($conn,"insert into kategori set nama_kategori='$nama_cat'");
		if ($query) {
			?>
			<script type="text/javascript">
				alert("data berhasil ditambahkan");
				window.location.href="kategori.php";
			</script>
			<?php
		}else{

			?>
			<script type="text/javascript">
				alert("data gagal ditambahkan");
				window.location.href="kategori.php";
			</script>
			<?php
		}

	}
	function tampil_kategori1(){
		$conn = mysqli_connect("localhost","masykur","masykurw","tokobaju");
		$query=mysqli_query($conn,"select * from kategori");
		while ($data=mysqli_fetch_array($query)) {
			?><option value="<?php echo $data['id'] ?>"><?php echo $data['nama_kategori'] ?></option>
			<?php
		}
	}
	function tambah_barang($nama_barang,$qty,$harga,$ket,$namagambar,$tmpgambar,$type_foto,$kategori){
		if ($type_foto!="image/jpeg"&&$type_foto!="image/jpg"&&$type_foto!="image/png"&&$type_foto!="image/gif") {
					?>
		            <script type="text/javascript">
		            alert( "Gunakan file yang benar");
		            window.location.href="barang.php";
		            </script>
		            <?php
		}else{
			$destination="gambar/$namagambar";
			move_uploaded_file($tmpgambar, $destination);
			$conn = mysqli_connect("localhost","masykur","masykurw","tokobaju");
            $query=mysqli_query($conn,"insert into barang set nama_barang='$nama_barang',qty='$qty',harga='$harga',keterangan='$ket',gambar='$destination',kategori=$kategori");
            if ($query) {
					?>
		            <script type="text/javascript">
		            alert( "Barang Berhasil Ditambahkan");
		            window.location.href="barang.php";
		            </script>
		            <?php
            }else{
            		echo mysqli_error($conn);
            }               

		}
	}
	function simpan_edit_barang($id,$nama_barang,$qty,$harga,$ket,$namagambar,$tmpgambar,$type_foto,$kategori){
		if ($type_foto!="image/jpeg"&&$type_foto!="image/jpg"&&$type_foto!="image/png"&&$type_foto!="image/gif") {
					?>
		            <script type="text/javascript">
		            alert( "Gunakan file yang benar");
		            window.location.href="barang.php";
		            </script>
		            <?php
		}else{
			$destination="gambar/$namagambar";
			move_uploaded_file($tmpgambar, $destination);
			$conn = mysqli_connect("localhost","masykur","masykurw","tokobaju");
            $query=mysqli_query($conn,"update barang set nama_barang='$nama_barang',qty='$qty',harga='$harga',keterangan='$ket',gambar='$destination',kategori=$kategori where id='$id'");
            if ($query) {
					?>
		            <script type="text/javascript">
		            alert( "Barang Berhasil Disimpan");
		            window.location.href="barang.php";
		            </script>
		            <?php
            }else{
            		echo mysqli_error($conn);
            }               

		}
	}
	function tampil_barang(){
		$conn = mysqli_connect("localhost","masykur","masykurw","tokobaju");
		$query=mysqli_query($conn,"select * from barang order by id DESC");
		$no=1;
		while ($data=mysqli_fetch_array($query)) {
			?>
			<tr>
				<td><?= $no ?></td>
				<td><img src="<?php echo $data['gambar'] ?>"></td>
				<td><?php echo $data['nama_barang'] ?></td>
				<td><?php echo $data['qty'] ?></td>
				<td><?php echo $data['harga'] ?></td>
				<td><?php echo $data['keterangan'] ?></td>
				<td><a class="a" href="edit_barang.php?id=<?php echo $data['id'] ?>">edit</a> <a class="b" href="hand.php?act=hapus_barang&id=<?php echo $data['id'] ?>">Hapus</a></td>
			</tr>
			<?php
			$no++;
		}
	}
	function hapus_barang($id){
		$conn = mysqli_connect("localhost","masykur","masykurw","tokobaju");
		$query=mysqli_query($conn,"delete from barang where id='$id'");
            if ($query) {
					?>
		            <script type="text/javascript">
		            alert( "Barang Berhasil Dihapus");
		            window.location.href="barang.php";
		            </script>
		            <?php
            }else{
            		echo mysqli_error($conn);
            }
	}
	function hapus_cat($id){
		$conn = mysqli_connect("localhost","masykur","masykurw","tokobaju");
		$query=mysqli_query($conn,"delete from kategori where id='$id'");
            if ($query) {
					?>
		            <script type="text/javascript">
		            alert( "Kategori Berhasil Dihapus");
		            window.location.href="kategori.php";
		            </script>
		            <?php
            }else{
            		echo mysqli_error($conn);
            }  
	}

	function tampil_transaksi(){
		$conn = mysqli_connect("localhost","masykur","masykurw","tokobaju");
		$query=mysqli_query($conn,"select * from transaksi");
		while ($data=mysqli_fetch_array($query)) {
			?>
			<tr>
				<td><?php echo $data['nama_barang'] ?></td>
				<td><?php echo $data['total_harga'] ?></td>
				<td><?php echo $data['status'] ?></td>
				<td><a class="a" href="hand.php?act=update_trans&id=<?php echo $data['id'] ?>">Update</a>&nbsp;<a class="b" href="hand.php?act=hapus_trans&id=<?php echo $data['id'] ?>">Hapus</a></td>
			</tr>
			<?php
		}
	}
	function hapus_trans($id){
		$conn = mysqli_connect("localhost","masykur","masykurw","tokobaju");
		$query=mysqli_query($conn,"delete from transaksi where id='$id'");
            if ($query) {
					?>
		            <script type="text/javascript">
		            alert( "Transaksi Berhasil Dihapus");
		            window.location.href="transaksi.php";
		            </script>
		            <?php
            }else{
            		echo mysqli_error($conn);
            }  
	}
	function update_trans($id){
		$conn = mysqli_connect("localhost","masykur","masykurw","tokobaju");
		$query=mysqli_query($conn,"update transaksi set status='Terbayar' where id='$id'");
            if ($query) {
					?>
		            <script type="text/javascript">
		            alert( "Transaksi Berhasil Diupdate");
		            window.location.href="transaksi.php";
		            </script>
		            <?php
            }else{
            		echo mysqli_error($conn);
            }  
	}

}
$data=new bigdata();
 ?>