<?php 
session_start();
$koneksi = new mysqli("localhost","root","","kitchenviki");

$id_pembelian = $_GET['id'];
$ambil = $koneksi->query("SELECT * FROM pembayaran LEFT JOIN pembelian ON pembayaran.id_pembelian=pembelian.id_pembelian WHERE 
	pembelian.id_pembelian='$id_pembelian'");
$detbay = $ambil->fetch_assoc();

//echo "<pre>";
//print_r ($detbay);
//echo "</pre>";


//validaso ke 1
if (empty($detbay)) 
{
	echo "<script>alert('Belum ada data pembelian')</script>";
	echo "<script>location='riwayat.php';</script>";
	exit();
}

//validasi ke 2
//echo "<pre>";
//print_r($_SESSION);
//echo "</pre>";
if ($_SESSION["pelanggan"]['id_pelanggan']!==$detbay["id_pelanggan"]) 
{
	echo "<script>alert('Anda tidak berhak melihat data ini')</script>";
	echo "<script>location='riwayat.php';</script>";
	exit();
}

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Lihat Pembayaraan</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>

	<!--Navbar-->
	<nav class="navbar navbar-default">
		<div class="container">

			<ul class="nav navbar-nav">
				<li><a href="index.php">Home</a></li>
				<li><a href="keranjang.php">Keranjang</a></li>
				<?php if (isset($_SESSION['pelanggan'])):?>
				<li><a href="riwayat.php">Riwayat Belanja</a></li>
				<li><a href="logout.php">Logout</a></li>

				<?php else : ?>
				<li><a href="login.php">Login</a></li>
				<li><a href="daftar.php">Daftar</a></li>
				<?php endif  ?>
				
				<li><a href="checkout.php">Checkout</a></li>
			</ul>
	</div>
	</nav>

			<div class="container">
				<h3>Lihat Pembayaran</h3>
				<div class="row">
					<div class="col-md-6">
						<table class="table">
							<tr>
								<th>Nama</th>
								<td><?php echo $detbay["nama"] ?></td>
							</tr>
							<tr>
								<th>Bank</th>
								<td><?php echo $detbay["bank"] ?></td>
							</tr>
							<tr>
								<th>Tanggal</th>
								<td><?php echo $detbay["tanggal"] ?></td>
							</tr>
							<tr>
								<th>Jumlah</th>
								<td>Rp. <?php echo number_format($detbay["jumlah"]) ?></td>
							</tr>
						</table>
					</div>
					<div class="col-md-6">
						<img src="bukti_pembayaran/<?php echo $detbay['bukti'] ?>" class="img-responsive">
					</div>
				</div>
			</div>
<?php include "footer.php" ?>

</body>
</html>