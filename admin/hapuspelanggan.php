<?php 

// FIXED EVERYTHING
$ambil = $dbase_conn->query("SELECT * FROM pelanggan WHERE id_pelanggan='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
$dbase_conn->query("DELETE FROM pelanggan WHERE id_pelanggan='$_GET[id]'");

echo "<script>alert('data Terhapus');</script>";	
echo "<script>location='index.php?halaman=pelanggan';</script>";
 ?>	