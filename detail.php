<?php session_start(); ?>
<?php $dbase_conn = new mysqli("localhost","n1569713_lesbrownice","Elang123","n1569713_lesbrownice");?>
<?php 

$id_produk = $_GET["id"];

$ambil = $dbase_conn->query("SELECT * FROM produk WHERE id_produk='$id_produk' ");
$detail = $ambil->fetch_assoc();

//echo "<pre>";
//print_r($detail);
//echo "</pre>";


 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Detail Produk</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="admin/assets/css/font1.css">
</head>
<body>

<!--Navbar-->
	<?php include "menu.php" ?>

	<section class="konten">
		<div class="container mt-5">
			<div class="row"> 
			<div class="col row-cols-1">
				<img src="foto_produk/<?php echo $detail["foto_produk"]; ?>" class="img-responsive"> 
			</div>
			<div class="col-md-6">
				<h2><?php echo $detail["nama_produk"] ?></h2>
				<h4>Rp. <?php  echo number_format($detail["harga_produk"]); ?></h4>

				<h5>Stock : <?php echo $detail['stock_produk'] ?></h5>

				<form method="post">
					<div class="form-group">
						<div class="input-group">
							<input type="number" min="1" class="form-control" name="jumlah" max="<?php echo $detail['stock_produk'] ?>">
							<div class="input-group-btn">
								<button class="btn btn-primary" name="beli">Beli</button>
							</div>
						</div>
					</div>
				</form>

				<?php

				//jika ada tombol beli
				if (isset($_POST["beli"])) 
				{

				//Mendapatkan jumlah yg di input
					$jumlah = $_POST["jumlah"];

				//Masukan keranjang belanja
					$_SESSION["keranjang"][$id_produk] = $jumlah;
					echo "<script>alert('Produk Telah Masuk Ke Keranjang Belanja')</script>";
					echo "<script>location='keranjang.php';</script>";
				}

				 ?>

				<p><?php echo $detail["deskripsi_produk"]; ?></p>
			</div>	
			</div> 
		</div>
	</section>
	<?php include "footer.php" ?>

</body>
</html>