<?php 
session_start();
$koneksi = new mysqli("localhost","n1569713_erik","Erik6969","n1569713_kitchenviki"); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Nota Pembelian</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
<!--Navbar-->
	<?php include "menu.php" ?>

	<section class="konten">
		<div class="container">
			<h2>Detail Pembelian</h2>
<?php $ambil=$koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
	$detail=$ambil->fetch_assoc(); ?>

<!-- <pre><?php //print_r($detail);?></pre> -->


   <!--jika pembeli tidak sama dg yg login -->
   <?php 
   //mendapatkan id pelanggan yg beli
   $idpelangganygbeli = $detail["id_pelanggan"];

   //mendapatkan id pelanggan yg login
   $idpelangganyglogin = $_SESSION['pelanggan']['id_pelanggan'];

   if ($idpelangganygbeli!==$idpelangganyglogin) 

   {
   	echo "<script>alert('Anda Bukan pemilik Akun');</script>";
   	echo "<script>location='riwayat.php';</script>";
    exit();
   }



    ?>




	<div class="row">
		<div class="col-md-4">
			<h3>Pembelian</h3>
			<strong>No. Pembelian : <?php echo $detail['id_pembelian'] ?></strong> <br>
			Tanggal : <?php echo $detail['tanggal_pembelian']; ?> <br>
			Total : Rp <?php echo number_format($detail['total_pembelian']) ?>
		</div>
		<div class="col-md-4">
			<h3>Pelanggan</h3>
			<strong><?php echo $detail['nama_pelanggan']; ?></strong> <br>
 <p>
 	<?php echo $detail['telepon_pelanggan']; ?> <br>
 	<?php echo $detail['email_pelanggan']; ?> 

 </p>
		</div>
		<div class="col-md-4">
			<h3>Pengiriman</h3>
		<strong><?php echo $detail['nama_kota'] ?></strong> <br>
		Ongkos Kirim : Rp. <?php echo number_format($detail['tarif']); ?> <br>
		Alamat : <?php echo $detail['alamat_pengiriman'] ?>
	</div>
</div>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>Nomor</th>
			<th>Nama Produk</th>
			<th>Harga</th>
			<th>Berat</th>
			<th>Jumlah</th>
			<th>Subberat</th>
			<th>Subtotal</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian='$_GET[id]'"); ?>
		<?php while ($pecah=$ambil->fetch_assoc()) {?>
		<tr>

			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama']; ?></td>
			<td>Rp. <?php echo number_format($pecah['harga']); ?></td>
			<td><?php echo $pecah['berat']; ?> Gr.</td>
			<td><?php echo $pecah['jumlah']; ?></td>
			<td><?php echo $pecah['subberat'] ?> Gr.	</td>
			<td>Rp. <?php echo number_format($pecah['subharga']); ?></td>
			
		</tr>
		<?php $nomor++; ?>
	<?php } ?>
	</tbody>
</table>


		<div class="row">
			<div class="col-md-7">
				<div class="alert alert-info">
					<p>
						Silahkan melakukan pembayan RP. <?php echo number_format ($detail['total_pembelian']); ?> Ke <br>
						<strong>Bank BCA 123-333 VIKI FITRIA</strong>
					</p>
				</div>
			</div>
		</div>




		</div>
	</section>
	<?php include "footer.php" ?>
</body>
</html>