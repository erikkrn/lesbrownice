<?php 
session_start();
$koneksi = new mysqli("localhost","n1569713_erik","Erik6969","n1569713_kitchenviki");

//jika belum login tapi di akses paksa

if (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"])) 
{
		echo "<script>alert('Silahkan Login')</script>";
		echo "<script>location='login.php';</script>";
		exit();
}	

//mendapatkan id pembayaran

$idpem = $_GET['id'];
$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$idpem'");
$detpem = $ambil->fetch_assoc();

//mendapatkan id pelanggan yg beli

$id_pelanggan_beli = $detpem["id_pelanggan"];

//mendapatkan id pelanggan yg login

$id_pelanggan_login = $_SESSION["pelanggan"]["id_pelanggan"];

if ($id_pelanggan_login !== $id_pelanggan_beli) 
{
	echo "<script>alert('Anda bukan pemilik akun')</script>";
		echo "<script>location='riwayat.php';</script>";
		exit();
}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Pembayaran</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="admin/assets/css/font1.css">
</head>
<body>
	<!--Navbar-->
	<?php include "menu.php" ?>

	<div class="container">
		<h2>Konfirmasi Pembayaran</h2>
		<p>kirim bukti pembayaran anda disini</p>
		<div class="alert alert-info">Total Tagihan Anda <strong><?php echo number_format($detpem["total_pembelian"]) ?></strong></div>

		<form method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label>Nama Pembayar</label>
				<input type="text" class="form-control" name="nama" >
			</div>
			<div class="form-group">
				<label>Bank</label>
				<input type="text" class="form-control" name="bank">
			</div>
			<div class="form-group">
				<label>Jumlah</label>
				<input type="number" class="form-control" name="jumlah" min="1">
			</div>
			<div class="form-group">
				<label>Foto Bukti</label>
				<input type="file" class="form-control" name="bukti">
				<p class="text-danger">Foto bukti harus .JPG max 2MB</p>
			</div>
			<button class="btn btn-primary" name="kirim">Kirim</button>
		</form>
	</div>

<?php 
//jika ditekan tombol kirim
if (isset($_POST["kirim"])) 

{
	//upload dulu foto buktinya
	$namabukti = $_FILES["bukti"]["name"];
	$lokasibukti = $_FILES["bukti"]["tmp_name"];
	$namafiks = date("ymdHis").$namabukti;
	move_uploaded_file($lokasibukti, "bukti_pembayaran/$namafiks");

	$nama = $_POST["nama"];
	$bank = $_POST["bank"];
	$jumlah =  $_POST["jumlah"];
	$tanggal = date("y-m-d");

	//simpan pembayaran
	$koneksi->query("INSERT INTO pembayaran(id_pembelian,nama,bank,jumlah,tanggal,bukti) VALUES ('$idpem','$nama','$bank','$jumlah','$tanggal','$namafiks')");

	//update data pembelian dari pending ke sukses
	$koneksi->query("UPDATE pembelian SET status_pembelian='sudah kirim pembayaran' WHERE id_pembelian='$idpem'");


echo "<script>alert('Terimakasih Sudah Mengirimkan Data Pembayaran')</script>";
	echo "<script>location='riwayat.php';</script>";
		
}	


 ?>

<?php include "footer.php" ?>
</body>
</html>