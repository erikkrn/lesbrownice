<?php 

$ambil = $dbase_conn->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
$fotoproduk = $pecah['foto_produk'];
if (file_exists("foto_produk/$fotoproduk"))
{

	unlink("foto_produk/$fotoproduk");
}

$dbase_conn->query("DELETE FROM produk WHERE id_produk='$_GET[id]'");

echo "<script>alert('produk Terhapus');</script>";	
echo "<script>location='index.php?halaman=produk';</script>";
 ?>	