<?php 
include "root.php";
if (isset($_GET["act"])) {
	if ($_GET["act"]=="login") {
		$data->login($_POST['username'],$_POST['password']);
	}
	if ($_GET["act"]=="hapus_cust") {
		$data->hapus_cust($_GET['id']);
	}
	if ($_GET["act"]=="tambah_kategori") {
		$data->tambah_cat($_POST['nama_kat']);
	}
	if ($_GET["act"]=="tambah_barang") {
		$data->tambah_barang($_POST['nama_barang'],$_POST['qty'],$_POST['harga'],$_POST['ket'],$_FILES['foto']['name'],$_FILES['foto']['tmp_name'],$_FILES['foto']['type'],$_POST['kategori']);
		
	}
	if ($_GET["act"]=="hapus_cat") {
		$data->hapus_cat($_GET["id"]);
	}
	if ($_GET["act"]=="update_trans") {
		$data->update_trans($_GET["id"]);
	}
	if ($_GET["act"]=="hapus_trans") {
		$data->hapus_trans($_GET["id"]);
	}
	if ($_GET["act"]=="simpan_edit_barang") {
		$data->simpan_edit_barang($_POST['id'],$_POST['nama_barang'],$_POST['qty'],$_POST['harga'],$_POST['ket'],$_FILES['foto']['name'],$_FILES['foto']['tmp_name'],$_FILES['foto']['type'],$_POST['kategori']);
		}
		if ($_GET["act"]=="hapus_barang") {
		$data->hapus_barang($_GET["id"]);
		}
}
 ?>