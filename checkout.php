<?php 
session_start();
$dbase_conn = new mysqli("localhost","n1569713_lesbrownice","Elang123","n1569713_lesbrownice");
if (!isset($_SESSION['pelanggan'])) 

{
	echo "<script>alert('Silahkan Login');</script>";
	echo "<script>location='login.php';</script>";
}

if (empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"]))
{
	echo "<script>alert('keranjang Kosong, Silahkan Belanja Dulu');</script>";
	echo "<script>location='index.php';</script>";
}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Checkout</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="admin/assets/css/font1.css">
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
					</tr>
				</thead>
				<tbody>
					<?php $nomor=1;  ?>
					<?php $totalbelanja=0;  ?>
					<?php foreach ($_SESSION['keranjang'] as $id_produk => $jumlah): ?>
					<?php 

					$ambil = $dbase_conn->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
					$pecah = $ambil->fetch_assoc();
					$subharga = $pecah['harga_produk']*$jumlah;
					//echo "<pre>";
					//print_r($pecah);
					//echo "</pre>";
					 ?>
					
					<tr>
						<td><?php echo $nomor;?></td>
						<td><?php echo $pecah['nama_produk']; ?></td>
						<td>Rp. <?php echo number_format($pecah['harga_produk']);?></td>
						<td><?php echo $jumlah; ?></td>
						<td>Rp. <?php echo number_format($subharga);?></td>
					</tr>
					<?php $nomor++; ?>
					<?php $totalbelanja+=$subharga; ?>
					<?php endforeach ?>
					<tfoot>
						<tr>
							<th colspan="4">Total Belanja</th>
							<th>Rp. <?php echo number_format($totalbelanja) ?></th>
						</tr>
					</tfoot	>
				</tbody>
			</table>
			<form method="post">
					<div class="row">
						
						<div class="col-md-4"><div class="form-group">
						<input type="text" readonly value="<?php echo $_SESSION['pelanggan']['nama_pelanggan']?>" class="form-control">
					</div>
					</div>

					<div class="col-md-4"><div class="form-group"> 
						<input type="text" readonly value="<?php echo $_SESSION['pelanggan']['telepon_pelanggan']?>" class="	form-control">
					</div>
					</div>
						<div class="col-md-4">
							<select class="form-control" name="id_ongkir">
								<option value="">Cek Ongkir</option>
								<?php 
								$ambil=$dbase_conn->query("SELECT * FROM ongkir"); 
								while($perongkir=$ambil->fetch_assoc()){
								?>

								<option value="<?php echo $perongkir['id_ongkir'] ?>">
									<?php echo $perongkir['nama_kota'] ?>
									Rp. <?php echo number_format($perongkir['tarif']) ?>
								</option>
								<?php } ?>
							</select>
						</div>
					</div>	

							<div class="form-group mt-5">
								<label>Alamat Lengkap Pengiriman</label>
								<textarea class="form-control mt-2" name="alamat_pengiriman" placeholder="Masukan Alamat Lengkap Pengiriman(temasuk kode pos)"></textarea>
							</div>
							<button class="btn btn-primary mt-3" name="checkout">Checkout</button>
				</form>

				<?php 
				if (isset($_POST["checkout"]))

				{

					$id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
					$id_ongkir = $_POST["id_ongkir"];
					$tanggal_pembelian = date("y-m-d");
					$alamat_pengiriman = $_POST['alamat_pengiriman'];

					$ambil=$dbase_conn->query("SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");
					$arrayongkir = $ambil->fetch_assoc();
					$nama_kota = $arrayongkir['nama_kota'];
					$tarif = $arrayongkir['tarif'];


					$total_pembelian = $totalbelanja + $tarif;

					//menyimpan data ke tabel pembelian

					$dbase_conn->query("INSERT INTO pembelian (id_pelanggan,id_ongkir,tanggal_pembelian,total_pembelian,nama_kota,tarif,alamat_pengiriman) VALUES ('$id_pelanggan','$id_ongkir','$tanggal_pembelian','$total_pembelian','$nama_kota','$tarif','$alamat_pengiriman') ");

					//mendapatkan id pembelian terbaru

					$id_pembelian_barusan = $dbase_conn->insert_id;
					foreach($_SESSION["keranjang"] as $id_produk => $jumlah )

					{

						//mendapatkan data produk dari id produk

						$ambil = $dbase_conn->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
						$perproduk = $ambil->fetch_assoc();

						$nama  = $perproduk['nama_produk'];
						$harga = $perproduk['harga_produk'];
						$berat = $perproduk['berat_produk'];

						$subberat = $perproduk['berat_produk']*$jumlah;
						$subharga = $perproduk['harga_produk']*$jumlah; 
						$dbase_conn->query("INSERT INTO pembelian_produk (id_pembelian,id_produk,nama,harga,berat,subberat,subharga,jumlah) 
							VALUES ('$id_pembelian_barusan','$id_produk','$nama','$harga','$berat','$subberat','$subharga','$jumlah')");


						//update stock
						$dbase_conn->query("UPDATE produk SET stock_produk=stock_produk -$jumlah WHERE id_produk='$id_produk'");

					}

					//mengkosongkan keranjang 

					unset($_SESSION["keranjang"]);



					//tampilan dialihkan ke halaman nota pembelian yang baru
					echo "<script>alert('Pembelian Sukses')</script>";
					echo "<script>location='nota.php?id=$id_pembelian_barusan'</script>";






				}


				 ?>



		</div>
	</section>
	<!--<pre><?php print_r($_SESSION['pelanggan']) ?></pre>
	<pre><?php print_r($_SESSION['keranjang']) ?></pre>-->

	<?php include "footer.php" ?>

</body>
</html>