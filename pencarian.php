<?php  

$koneksi = new mysqli("localhost","n1569713_erik","Erik6969","n1569713_kitchenviki");
$keyword = $_GET["keyword"];
$semuadata=array();
$ambil = $koneksi->query("SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%' OR deskripsi_produk LIKE '%$keyword%'");
while($pecah = $ambil->fetch_assoc())
{
	$semuadata[]=$pecah;
}

//echo "<pre>";
//print_r ($semuadata);
//echo "</pre>";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Pencarian</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="admin/assets/css/font1.css">
</head>
<body>
	<?php include "menu.php" ?>

	<div class="container mt-5">
		<h3>Hasil pencarian : <?php echo $keyword ?></h3>

		<?php if (empty($semuadata)): ?>
		<div class="alert alert-danger"> Pencarian <strong> <?php echo $keyword ?></strong> tidak ditemukan</div>
		<?php endif  ?>

		<div class="row row-cols-4">

		<?php foreach($semuadata as $key => $value): ?>

		<div class="container">	
			  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
    <div class="card" style="width: 18rem;">
    <img src="foto_produk/<?php echo $value['foto_produk']; ?>" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title"><?php echo $value['nama_produk']; ?></h5>
      <p class="card-text">..</p>
    </div>
    <ul class="list-group list-group-flush">
      <li class="list-group-item">Rp. <?php echo number_format($value['harga_produk']); ?></li>
    </ul>
    <div class="card-body">
      <a href="beli.php?id=<?php echo $value['id_produk']; ?>" class="btn btn-outline-success">Beli</a>
      <a href="detail.php?id=<?php echo $value['id_produk']; ?>" class="btn btn-outline-info">Detail</a>
    </div>
  </div>
	</div>
</div>
	<?php endforeach ?>


	</div>	

				</div>



<?php include "footer.php" ?>
</body>
</html>