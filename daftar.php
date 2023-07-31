<?php $koneksi = new mysqli("localhost","n1569713_erik","Erik6969","n1569713_kitchenviki");?>
<!DOCTYPE html>
<html>
<head>
	<title>Daftar</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="admin/assets/css/font1.css">
</head>
<body>

<!--Navbar-->
	<?php include "menu.php" ?>


<div class="container mt-5">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel panel-heading">
					<h3 class="panel-title">Daftar Pelanggan</h3>
				</div>
				<div class="panel-body">
					<form method="post" class="form-horizontal">
						<div class="form-group">
						<label class="control-label col-md-3">Nama</label>
						<div class="col-md-7">
							<input type="text" class="form-control" name="nama">
						</div>
						</div>

							<div class="form-group">
						<label class="control-label col-md-3">Email</label>
						<div class="col-md-7">
							<input type="email" class="form-control" name="email" required>
						</div>
						</div>

							<div class="form-group">
						<label class="control-label col-md-3">Password</label>
						<div class="col-md-7">
							<input type="text" class="form-control" name="password" required>
						</div>
						</div>

							<div class="form-group">
						<label class="control-label col-md-3">Alamat</label>
						<div class="col-md-7">
							<textarea class="form-control" name="alamat" required></textarea>
						</div>
						</div>

							<div class="form-group">
						<label class="control-label col-md-3">Telp/HP</label>
						<div class="col-md-7">
							<input type="text" class="form-control" name="telepon" required>
						</div>
						</div>

						<div class="form-group">
							<div class="col-md-7 col-md-offset-3">
								<button class="btn btn-outline-primary mt-4" name="daftar">Daftar</button>
							</div>
						</div>
					</form>

					<?php 
					//jika diekan tombol daftar
					if (isset($_POST["daftar"])) 

					{
						//mengambil data
						$nama = $_POST['nama'];
						$email = $_POST['email'];
						$password = $_POST['password'];
						$alamat = $_POST['alamat'];
						$telepon = $_POST['telepon'];

						//cek plagiat email
						$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email'");
						$yangcocok = $ambil->num_rows;
						if ($yangcocok==1) 
						{
							echo "<script>alert('Pendaftaran Gagal, Email Sudah Digunakan')</script>";
							echo "<script>location='daftar.php'</script>";
						}
						else 
						{
							//input ke data pelanggan
							$koneksi->query("INSERT INTO pelanggan(email_pelanggan,password_pelanggan,nama_pelanggan,telepon_pelanggan,alamat_pelanggan) VALUES('$email','$password','$nama','$telepon','$alamat')");

							echo "<script>alert('Pendaftaran Sukses, Silahkan Login')</script>";
							echo "<script>location='login.php'</script>";

						}


					}

					 ?>

				</div>
			</div>
		</div>
	</div>
</div>



	<?php include "footer.php" ?>

</body>
</html>