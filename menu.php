	<nav class="navbar navbar-expand-lg navbar-light" class="navbar navbar-light" style="background-color: #e75925;">
  <div class="container">
     <img src="admin/assets/img/Logo.jpg" alt="" width="60" height="60" class="me-2">
    </a>
    <a class="navbar-brand" href="index.php" style="color: white;">LE'S<strong>BROWNICE</strong></a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php" style="color:white;">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="keranjang.php" style="color: white;">Keranjang</a>
        </li>
        <?php if (isset($_SESSION['pelanggan'])):?>
        <li class="nav-item">
          <a class="nav-link" href="riwayat.php" style="color:white;">Riwayat Belanja</a>
        </li>
         <li class="nav-item">
          <a class="nav-link" href="logout.php" style="color:white;">Logout</a>
        </li>

        <?php else : ?>
         <li class="nav-item">
          <a class="nav-link" href="login.php" style="color:white;">Login</a>
        </li>
         <li class="nav-item">
          <a class="nav-link" href="daftar.php" style="color:white;">Daftar</a>
        </li>
        <?php endif  ?>
         <li class="nav-item">
          <a class="nav-link" href="checkout.php" style="color:white;">Checkout</a>
        </li>
      </ul>
      <form class="d-flex" action="pencarian.php" method="get" class="nav-link">
        <input class="form-control me-2" type="text" placeholder="Search" aria-label="Search" name="keyword">
        <button class="btn btn-outline-primary" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

  