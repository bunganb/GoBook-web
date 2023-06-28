<?php

include '../koneksi.php';
session_start();
$username = $_SESSION['username'];
if (!isset($username)) {
  header('location:../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- tittle icon -->
  <link rel="icon" href="../img/icon_logo.png" type="image/x-icon">
  <!-- CSS LINK -->
  <link rel="stylesheet" href="../css/style.css">
  <!-- bootsrap link -->
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <!-- Bootstrap Icon -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

  <title>Homepage-GoBook</title>
</head>

<body>
  <!-- Navbar -->
  <div class="header">
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand" href="#"><img src="../img/logofix.png" width="125px"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto ">
            <li class="nav-item mt-1  ">
              <a class="nav-link active" aria-current="page" href="index.php">Beranda</a>
            </li>
            <li class="nav-item mt-1">
              <a class="nav-link active" href="#kategori">Kategori</a>
            </li>
            <li class="nav-item mt-1">
              <a class="nav-link active" href="search.php"><i class="bi bi-search"></i></a>
            </li>
            <li class="nav-item mt-1">
              <a class="nav-link active" href="wishlist.php"><i class="bi bi-cart"></i></a>
            </li>
            <li class="nav-item mt-1">
              <a href="../logout.php" class="nav-link active btnLogout">
                Logout
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="quote">
      <h1 class="text-center">Segudang ilmu ada di Buku,<br>
        Segudang Buku ada di GoBook.</h1>
      <h5 class="text-center">Temukan dunia yang kamu cari.</h5>
      <img src="../img/bannerimg.png" width="400px">
    </div>
  </div>
  <!-- Navbar end-->
  <!-- Kategori -->
  <div class="category container" id="kategori">
    <h2 class="text-center">Kategori</h2>
    <div class="genre-group row">
      <div class="genre-item col-4 col-sm-2">
        <img src="../img/tekno.png" alt="">
        <h5>Teknologi</h5>
      </div>
      <div class="genre-item col-4 col-sm-2">
        <img src="../img/religi.png" alt="">
        <h5>Religi</h5>
      </div>
      <div class="genre-item col-4 col-sm-2">
        <img src="../img/novel.png" alt="">
        <h5>Novel</h5>
      </div>
      <div class="genre-item col-6 col-sm-2">
        <img src="../img/bisnis.png" alt="">
        <h5>Bisnis & Ekonomi</h5>
      </div>
      <div class="genre-item col-6 col-sm-2">
        <img src="../img/pendidikan.png" alt="">
        <h5>Pendidikan</h5>
      </div>
    </div>
    <div class="selengkapnya text-center" style="margin-top: 30px;">
      <a href="search.php" class="btn">Selengkapnya</a>
    </div>
  </div>
  <!-- Kategori end-->
  <!-- Buku pilihan -->
  <div class="best-sell mt-3" style="padding: 40px;">
    <div class="container-fluid text-center">
      <h2 class="text-start">Rekomendasi buku buat <?= $username ?></h2>
      <div class="row">
        <?php

        $query = mysqli_query($koneksi, "SELECT *,buku.gambar as gbrbuku FROM buku LEFT JOIN penulis ON buku.id_penulis = penulis.id_penulis LIMIT 4");
        while ($data = mysqli_fetch_array($query)) {
        ?>
          <div class=" col-3">
            <a href="detail.php?id_buku=<?= $data['id_buku'] ?>">
              <div class="card">
                <div class="product-img">
                  <?php
                  if (!empty($data['gbrbuku'])) {
                  ?>
                    <img src="../img/gambar_buku/<?= $data['gbrbuku'] ?>" width="100px">
                  <?php
                  } else {
                  ?>
                    <img src="../img/gambar_buku/noimage.png" width="100px">
                  <?php } ?>
                </div>
                <div class="title-product mt-2" style="line-height: 8px;">
                  <h5 style="font-size: 18px;"><?= $data['nama_buku'] ?></h5>
                  <p style="color: #8D8D8D;">Oleh <Span><?= $data['nama_pena'] ?></Span></p>
                </div>
                <div class="prize text-center">
                  <p style="color: #285430;">Rp.<?= number_format($data['harga']) ?></p>
                </div>
              </div>
            </a>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
  <!-- Buku Teratas end-->
  <!-- Banner -->
  <div class="banner">
    <div class="container">
      <div class="row">
        <div class="col-md-5">
          <img src="../img/banner.png" width="400px">
        </div>
        <div class="banner-quote col-md-7" style="margin-top:100px;">
          <h2 style="margin-bottom:35px">Temukan Buku yang kamu cari,<br>
            Jelajahi GoBook Sekarang</h2>
          <a href="search.php" class="btn-banner">Cari Di GoBook</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Banner end-->
  <!-- Ulasan -->
  <div class="ulasan">
    <h1 class="text-center mt-3">Ulasan</h1>
    <div id="carouselExampleInterval" class="carousel slide p-5" data-bs-ride="carousel">
      <div class="carousel-inner">
        <?php

        $sql = mysqli_query($koneksi, "SELECT * FROM ulasan LEFT JOIN user_data ON ulasan.id_user = user_data.id_user");
        while ($data = mysqli_fetch_array($sql)) {



        ?>
          <div class="carousel-item active" data-bs-interval="10000">
            <div class="card">
              <div class="container" style="padding-top: 50px; padding-bottom: 50px;">
                <div class="row">

                  <div class="col-md-5">
                    <img src="../img/pp.jpg" width="250px">
                  </div>
                  <div class="col-md-7">
                    <h2><span>“</span><?= $data['ulasan'] ?><span>"</span></h2>
                    <br>
                    <h3 class="acc">-<?= $data['username'] ?></h3>
                    <p class=""><em>Pengguna GoBook</em></p>
                  </div>
                </div>
              </div>
            </div>

          </div>
        <?php } ?>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
  <!-- Ulasan end-->
  <!-- Footer -->
  <div class="footer">
    <div class="footer-item">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <img src="../img/logofix.png" width="400px">
          </div>
          <div class="contact col-md-4">
            <h3><strong>Kantor</strong></h3>
            <ul>
              <li><i class="bi bi-geo-alt"></i>Karangrejo, Banyuwangi
                Jawa &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Timur - 99457</li>
              <li><i class="bi bi-envelope"></i>GoBook@Gmail.com</li>
              <li><i class="bi bi-telephone"></i>085898756088</li>
            </ul>
          </div>
          <div class="about col-md-4">
            <h3><strong>Informasi</strong> </h4>
              <ul>
                <li>Kerja Sama penerbit</li>
                <li>Cara Belanja</li>
                <li>Kebijakan Privasi</li>
              </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="copyright">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <a href="#"><i class="bi bi-instagram"></i></a>
          <a href="#"><i class="bi bi-tiktok"></i></a>
          <a href="#"><i class="bi bi-facebook"></i></a>
          <a href="#"><i class="bi bi-linkedin"></i></a>
        </div>
        <div class="col-md-6">
          <p>Copyright © Bunga Nabila 2023</p>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer end-->
  <script src="../js/bootstrap.min.js"></script>
</body>

</html>