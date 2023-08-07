<?php 
session_start();
$dbase_conn = new mysqli("localhost","n1569713_erik","Erik6969","n1569713_kitchenviki");

//jika belum login tapi di akses paksa

if (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"])) 
{
		echo "<script>alert('Silahkan Login')</script>";
		echo "<script>location='login.php';</script>";
		exit();
}	

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Toko Ktchen Viki</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="admin/assets/css/font1.css">
</head>
<body>

<!--Navbar-->
	<?php include "menu.php" ?>
	<!--<pre><?php print_r($_SESSION) ?></pre>-->
	<section class="riwayat">
		<div class="container mt-5">
			<h3>Riwayat Belanja Pelanggan <?php echo $_SESSION["pelanggan"]["nama_pelanggan"] ?></h3>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>No</th>
						<th>Tanggal</th>
						<th>Status</th>
						<th>Total</th>
						<th>Opsi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$nomor=1; 
					//mendapatkan id pelanggan
					$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];

					$ambil = $dbase_conn->query("SELECT * FROM pembelian WHERE id_pelanggan='$id_pelanggan'");
					while($pecah = $ambil->fetch_assoc()){


					 ?>
					<tr>
						<td><?php echo $nomor; ?></td>
						<td><?php echo $pecah["tanggal_pembelian"] ?></td>
						<td>
							<?php echo $pecah["status_pembelian"] ?>
							<br><?php if (!empty($pecah['resi_pengiriman'])): ?>
							Resi : <?php echo $pecah['resi_pengiriman']; ?>
							<?php endif ?>
							</td>
						<td>Rp. <?php echo number_format($pecah["total_pembelian"])?></td>
						<td>
							<a href="nota.php?id=<?php echo $pecah['id_pembelian'] ?>" class="btn btn-info">Nota</a>
							<?php if ($pecah['status_pembelian']=="pending"): ?>
								
							<a href="pembayaran.php?id=<?php echo $pecah["id_pembelian"];  ?>" class="btn btn-success">Intput Pembayaran</a>
							<?php else: ?>
							<a href="lihat_pembayaran.php?id=<?php echo $pecah["id_pembelian"]; ?>" class="btn btn-warning">
								Lihat Pembayaran
							</a>

							<?php endif ?>


						</td>
					</tr>
					<?php $nomor++; ?>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</section>

	<?php include "footer.php" ?>

</body>
</html>