<?php 

session_start();



//echo "<pre>";
//print_r($_SESSION['keranjang']);
//echo "</pre>";

$koneksi = new mysqli("localhost","n1569713_erik","Erik6969","n1569713_kitchenviki");

//if (empty($_SESSION['keranjang']) OR !isset($_SESSION['keranjang']))
if (empty($_SESSION['keranjang']))
{
	echo "<script>alert('keranjang Kosong, Silahkan Belanja Dulu');</script>";
	echo "<script>location='index.php';</script>";
}

 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Keranjang Belanja</title>
 	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 </head>
 <body>
<!--Navbar-->
	<?php include "menu.php" ?>

	<section class="konten">
		<div class="container mt-5">
			<h1>Keranjang Belanja</h1>
			<hr>
			<table class="table table-bordered">
				<thead>
						
					<tr>
						<th>No</th>
						<th>Produk</th>
						<th>Harga</th>
						<th>Jumlah</th>
						<th>Sub Harga</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $nomor=1;  ?>
					<?php foreach ($_SESSION['keranjang'] as $id_produk => $jumlah): ?>
					<?php 

					$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
					$pecah = $ambil->fetch_assoc();
					$pecahInt = (int) $pecah['harga_produk'];
					$subharga = $pecahInt*$jumlah;
					
					 ?>
					
					<tr>
						<td><?php echo $nomor;?></td>
						<td><?php echo $pecah['nama_produk']; ?></td>
						<td>Rp. <?php echo number_format($pecah['harga_produk']);?></td>
						<td><?php echo $jumlah; ?></td>
						<td>Rp. <?php echo number_format($subharga);?></td>
						<td> 
							<a href="hapuskeranjang.php?id=<?php echo $id_produk ?>" class="btn btn-danger btn-xs">Hapus</a>
						</td>
					</tr>
					<?php $nomor++; ?>
					<?php endforeach ?>
				</tbody>
			</table>
			<a href="index.php" class="btn btn-default">Lanjutkan Belanja</a>
			<a href="checkout.php" class="btn btn-primary">Checkout</a>
		</div>
	</section>

	<?php include "footer.php" ?>
 </body>
 </html>
