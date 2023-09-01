<?php 
session_start();
 $dbase_conn = new mysqli("localhost","n1569713_lesbrownice","Elang123","n1569713_lesbrownice");?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="admin/assets/css/font1.css">

    <title>LE'S BROWNICE</title>
  </head>
  <body>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    

<!--Navbar-->

<?php include "menu.php" ?>
 <!--larosel-->
<div class="container">
<div id="carouselExampleIndicators" class="carousel slide mt-5" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="admin/assets/img/karosel1.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="admin/assets/img/karosel2.jpeg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="admin/assets/img/karosel3.jpg" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
</div>

<!--konten-->
  <section class="konten">
  	<div class="container mt-5">
  		<div class="judul-kategori" style="background-color:#FFF; padding: 5px 10px;"> 
  			<h5 class="text-center"> Produk Terlaris
  			</h5>
  		</div>
  		<div class="row row-cols-4">
  			<?php $ambil=$dbase_conn->query("SELECT * FROM produk"); ?>
  			<?php while($perproduk=$ambil->fetch_assoc()){ ?>

  			<div class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
    <div class="card" style="width: 18rem;">
    <img src="foto_produk/<?php echo $perproduk['foto_produk']; ?>" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title"><?php echo $perproduk['nama_produk']; ?></h5>
      <p class="card-text">klik beli untuk masukan keranjang </p>
    </div>
    <ul class="list-group list-group-flush">
      <li class="list-group-item">Rp. <?php echo number_format($perproduk['harga_produk']); ?></li>
    </ul>
    <div class="card-body">
      <a href="beli.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-outline-success">Beli</a>
      <a href="detail.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-outline-info">Detail</a>
    </div>
  </div>
      
    </div>
      </div>
      <?php } ?>
    </div>
  </div>
  		</div>
  	</div>
  </section>
  <!--larosel-->
<div class="container">
<div id="carouselExampleIndicators" class="carousel slide mt-5" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="admin/assets/img/karosel1.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="admin/assets/img/karosel2.jpeg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="admin/assets/img/karosel3.jpg" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
</div>

<?php include "footer.php" ?>




</body>
</html>