<?php 
session_start();
 $dbase_conn = new mysqli("localhost","root","","tokobrownis");?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Pelanggan</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="admin/assets/css/font1.css">
</head>
<body>

<!--Navbar-->
	<?php include "menu.php" ?>
<div class="container mt-5">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Login Pelanggan</h3>
				</div>
				<div class="panel-body">
					<form method="post">
						<div class="form-group mt-3">
							<label>Email</label>
							<input type="email" class="form-control" name="email">
						</div>
						<div class="form-group mt-3	">
							<label>Password</label>
							<input type="password" class="form-control" name="password">
						</div>
						<button class="btn btn-outline-primary mt-4" name="login">Login</button>
					</form>
				</div>
			</div>
			</div>
		</div>
	</div>

<?php 
if (isset($_POST["login"]))
{
	$email = $_POST['email'];
	$password = $_POST['password'];

	$ambil = $dbase_conn->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email' AND password_pelanggan='$password'");

	$akunyangcocok = $ambil->num_rows;
	if ($akunyangcocok==1)
	{
		$akun = $ambil->fetch_assoc();
		$_SESSION['pelanggan'] = $akun;
		echo "<script>alert('Anda Sukses Login')</script>";

		if (isset($_SESSION["keranjang"]) OR !empty($_SESSION["keranjang"])) 
		{
			echo "<script>location='checkout.php'</script>";
		}

		else
		{
			echo "<script>location='riwayat	.php'</script>";
		}

		echo "<script>location='checkout.php';</script>";
	}	
	else 
	{
		echo "<script>alert('Anda Gagal Login, Periksa Akun Anda');</script>";
		echo "<script>location='login.php';</script>";
	}
}
 include "footer.php"

 ?>


</body>
</html>