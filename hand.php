<?php 
include "root.php";
if (isset($_GET["act"])) {
	if ($_GET["act"]=="login") {
		$data->login($_POST['username'],$_POST['password']);
	}
	if ($_GET["act"]=="daftar") {
		$data->daftar($_POST['nama'],$_POST['alamat'],$_POST['username'],$_POST['password']);
	}
	if ($_GET["act"]=="logout") {
		session_start();
		unset($_SESSION['id_cust'],$_SESSION['nama_cust'],$_SESSION['username_cust']);
		header("location:index.php");
	}
	if ($_GET["act"]=="tambah_keranjang") {
		$data->tambah_keranjang($_POST['id'],$_POST['id_customer'],$_POST['jumlah_beli']);		
	}
	if ($_GET["act"]=="hapus_keranjang") {
		$data->hapus_keranjang($_GET['id'],$_GET['id_customer']);
	}
	if ($_GET["act"]=="update_transaksi") {
		$data->update_transaksi($_GET['id'],$_FILES['foto']['name'],$_FILES['foto']['tmp_name'],$_FILES['foto']['type'],);
	}
}	
?>