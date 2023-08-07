<?php 

echo "<script>alert('id Pelanggan terkirim');</script>";
$ambil = $dbase_conn->query("SELECT * FROM pelanggan WHERE id_pelanggan='$_GET[id]'");
echo "<script>alert('id pelanggan ditemukan di database');</script>";
$pecah = $ambil->fetch_assoc();
echo "<script>alert('data pelanggan sudah di parse');</script>";
$dbase_conn->query("DELETE FROM pelanggan WHERE id_pelanggan='$_GET[id]'");

echo "<script>alert('data Terhapus');</script>";	
echo "<script>location='index.php?halaman=pelanggan';</script>";
 ?>	