<?php

include '../koneksi.php';
// require_once '../function.php';
require_once '../admin-dash/data/proses.php';
session_start();
$id_user = $_SESSION['id_user'];
$username = $_SESSION['username'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS LINK -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- bootsrap link -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- icon -->
    <link rel="icon" href="../img/icon_logo.png" type="image/x-icon">
    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title>WishList-GoBook</title>
</head>

<body>
    <!-- NAVBAR -->
    <div class="header-detail" style="padding: 25px;width: 100;">
        <nav class="navbar navbar-expand-lg" style="background: #ffc93c;">
            <div class="container">
                <a class="navbar-brand" href="index.php"><img src="../img/logofix.png" width="125px"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto ">
                        <li class="nav-item mt-1">
                            <a class="nav-link active" aria-current="page" href="index.php">Beranda</a>
                        </li>
                        <li class="nav-item mt-1">
                            <a class="nav-link active" href="#">Kategori</a>
                        </li>
                        <li class="nav-item mt-1">
                            <a class="nav-link active" href="search.php"><i class="bi bi-search"></i></a>
                        </li>
                        <li class="nav-item mt-1">
                            <a class="nav-link active" href="wishlist.php"><i class="bi bi-cart"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <!-- NAVBAR END -->
    <!-- main -->
    <div class="container-fluid p-5">
        <div class="row">
            <div class="wishList">
                <div class="card book-wish p-3">
                    <h4>WishList Kamu <i class="bi bi-bag-heart"></i></h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th colspan="2">Buku</th>
                                <th scope="col">harga</th>
                                <th scope="col">stok</th>
                                <th scope="col">Akses</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($koneksi, "SELECT  * ,buku.gambar as gbbuku FROM wishlist LEFT JOIN buku ON wishlist.id_buku = buku.id_buku LEFT JOIN penulis ON buku.id_penulis = penulis.id_penulis GROUP BY wishlist.id_buku ORDER BY wishlist.id_buku DESC");
                            $no = 1;
                            if (mysqli_num_rows($query) > 0) {
                                while ($data = mysqli_fetch_array($query)) {
                                    $no++;
                            ?>
                                    <?php
                                    if (count($errors) == 1) {
                                        foreach ($errors as $tampilerror) {
                                    ?>
                                            <div class="alert alert-danger" role="alert">
                                                <?= $tampilerror ?>
                                            </div>
                                        <?php }
                                    } elseif (count($errors) > 1) {
                                        foreach ($errors as $tampilerror) {
                                        ?>
                                            <div class="alert alert-danger" role="alert">
                                                <li><?= $tampilerror ?></li>
                                            </div>
                                        <?php }
                                    } elseif (!empty($success)) {
                                        ?>
                                        <div class="alert alert-success" role="alert">
                                            <?= $success ?>
                                        </div>
                                    <?php } ?>
                                    <tr class="text-center">
                                        <td><?php
                                            if (!empty($data['gbbuku'])) {
                                            ?>
                                                <img src="../img/gambar_buku/<?= $data['gbbuku'] ?>" width="100px">
                                            <?php
                                            } else {
                                            ?>
                                                <img src="../img/gambar_buku/noimage.png" width="100px">
                                            <?php } ?>
                                        </td>
                                        <td><?= $data['nama_buku'] ?></td>
                                        <td><?= $data['harga'] ?></td>
                                        <td> <?php
                                                if ($data['stok'] < 1) {
                                                    $stok = "Stok Habis";
                                                    $color = "danger";
                                                } else {
                                                    $stok = "Stok Tersedia";
                                                    $color = "success";
                                                }
                                                ?>
                                            <p class="status"><strong><span class="text-<?= $color ?>"><?= $stok ?></span></strong></p>
                                        </td>
                                        <td>
                                            <a href="#" type="button" class="btn btn-danger btn-md" data-bs-toggle="modal" data-bs-target="#hapusData<?= $no ?>"><i class="bi bi-trash"></i></a>
                                        </td>
                                    </tr>
                                    <!-- Hapus MODAL -->
                                    <div class="modal fade" id="hapusData<?= $no ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-md">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Wish List</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="" method="POST">
                                                        <input type="hidden" class="form-control" id="id_wishlist" name="id_wishlist" aria-describedby="" value="<?= $data['id_wishList'] ?>" readonly>
                                                        <h5 class="text-center">Apakah anda yakin ingin menghapus buku dari daftar Wish List? <br><br>
                                                            <img src="../img/gambar_buku/<?= $data['gbbuku'] ?>" width="150px"><br>
                                                            <span class="text-danger"><?= $data['nama_buku'] ?></span><br>
                                                            <span class="text-secondary">Oleh <?= $data['nama_pena'] ?></span>
                                                        </h5>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tidak</button>
                                                            <button type="submit" class="btn btn-primary" name="btnHapusFav">Hapus</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hapus Modal end -->
                                <?php } ?>
                            <?php } else {
                            ?>
                                <tr style="vertical-align: middle;">
                                    <td>
                                        <h4 class="text-center">Kamu belum menambah wishlist!</h4>
                                        <img src="../img/empty_cart.png" width="400px">
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- main end -->
    <!-- Buku pilihan -->
    <div class="best-sell mt-3" style="padding: 40px;">
        <div class="container-fluid text-center">
            <h2 class="text-start">Rekomendasi buku buat kamu <?= $username ?></h2>
            <div class="row">
                <?php
                $query = mysqli_query($koneksi, "SELECT * ,buku.gambar as gbbuku FROM buku LEFT JOIN penulis ON buku.id_penulis = penulis.id_penulis LIMIT 4");
                while ($data = mysqli_fetch_array($query)) {
                ?>
                    <div class=" col-3">
                        <a href="detail.php?id_buku=<?= $data['id_buku'] ?>">
                            <div class="card">
                                <div class="product-img">
                                    <?php
                                    if (!empty($data['gbbuku'])) {
                                    ?>
                                        <img src="../img/gambar_buku/<?= $data['gbbuku'] ?>" width="100px">
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