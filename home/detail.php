<?php

include '../koneksi.php';
require_once '../admin-dash/data/proses.php';
session_start();
$userID = $_SESSION['id_user'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <!-- bootsrap link -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title>detail-GoBook</title>
</head>

<body>
    <!-- Navbar -->
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
                            <a class="nav-link active" href="#kategori">Kategori</a>
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
    <!-- detail-content -->
    <div class="detail" style="margin: 20px 0 90px 0; ">
        <div class="container">
            <div class="row">
                <?php
                $id_buku = $_GET['id_buku'];
                $query = mysqli_query($koneksi, "SELECT *,buku.gambar as gbrbuku FROM buku LEFT JOIN penulis ON buku.id_penulis = penulis.id_penulis LEFT JOIN kategori ON buku.id_kategori = kategori.id_kategori LEFT JOIN penerbit ON buku.id_penerbit = penerbit.id_penerbit WHERE id_buku = '$id_buku'");
                while ($data = mysqli_fetch_assoc($query)) {
                ?>
                    <div class="col-4">
                        <div class="card p-5">
                            <?php
                            if (!empty($data['gbrbuku'])) {
                            ?>
                                <img src="../img/gambar_buku/<?= $data['gbrbuku'] ?>">
                            <?php
                            } else {
                            ?>
                                <img src="../img/gambar_buku/noimage.png">
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-8">
                        <h2 class="title"><?= $data['nama_buku'] ?></h2>
                        <h4 class="text-bold" style="color: red;">RP. <?= number_format($data['harga']) ?></h4>
                        <!-- format stok tersedia -->
                        <?php
                        if ($data['stok'] < 1) {
                            $stok = "Stok Habis";
                            $color = "danger";
                        } else {
                            $stok = "Stok Tersedia";
                            $color = "success";
                        }
                        ?>
                        <p class="status">Status : <span class="text-<?= $color ?>"><?= $stok ?></span></p>
                        <hr>
                        <div class="desc">
                            <h5><strong>Deskripsi</strong></h5>
                            <p>
                                <?= $data['deskripsi'] ?>
                            </p>
                        </div>
                        <div class="product-detail mt-3">
                            <h5> <strong>Spesifikasi Produk</strong> </h5>
                            <table class="table table-bordered" width="20%">
                                <tr>
                                    <th>Penulis</th>
                                    <td><?= $data['nama_pena'] ?></td>
                                </tr>
                                <tr>
                                    <th>Penerbit</th>
                                    <td><?= $data['nama_penerbit'] ?></td>
                                </tr>
                                <tr>
                                    <th>Berat</th>
                                    <td><?= $data['berat'] ?></td>
                                </tr>
                                <tr>
                                    <th>Kategori</th>
                                    <td><?= $data['kategori'] ?></td>
                                </tr>
                            </table>
                        </div>
                        <!-- <button class="btn shadow">Beli Sekarang <i class="bi bi-bag-plus"></i></button> -->
                        <!-- add wishlist -->
                        <form action="" method="post">
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
                            <input type="hidden" class="form-control" id="id_buku" name="id_buku" aria-describedby="" value="<?= $data['id_buku'] ?>" readonly>
                            <input type="hidden" class="form-control" id="id_user" name="id_user" aria-describedby="" value="<?= $userID ?>" readonly>
                            <button class="btn shadow" name="btnFav" type="submit">Wish List <i class="bi bi-bookmark-heart"></i></button>
                        </form>

                        <!-- add wishlist end -->

                    </div>
            </div>

        </div>
    </div>
    <!-- detail-content end-->
    <!-- another book -->
    <div class="best-sell mt-5" style="padding: 40px;">
        <div class="container-fluid text-center">
            <h4 class="text-start">Karangan <?= $data['nama_pena'] ?> lainnya :</h4>
            <div class="row">
                <?php
                    $filter = $data['nama_pena'];
                    $sql = mysqli_query($koneksi, "SELECT *,buku.gambar as gbrbuku FROM buku LEFT JOIN penulis ON buku.id_penulis = penulis.id_penulis WHERE nama_pena = '$filter' LIMIT 4");
                    while ($result = mysqli_fetch_array($sql)) {
                ?>
                    <div class="col-md-3">
                        <a href="detail.php?id_buku=<?= $data['id_buku'] ?>">
                            <div class="card">
                                <div class="product-img">
                                    <?php
                                    if (!empty($result['gbrbuku'])) {
                                    ?>
                                        <img src="../img/gambar_buku/<?= $result['gbrbuku'] ?>" width="100px">
                                    <?php
                                    } else {
                                    ?>
                                        <img src="../img/gambar_buku/noimage.png" width="100px">
                                    <?php } ?>
                                </div>
                                <div class="title-product mt-2" style="line-height: 8px;">
                                    <h5 style="font-size: 18px;"><?= $result['nama_buku'] ?></h5>
                                    <p style="color: #8D8D8D;">Oleh <Span><?= $result['nama_pena'] ?></Span></p>
                                </div>
                                <div class="prize text-center">
                                    <p style="color: #285430;">Rp.<?= number_format($result['harga']) ?></p>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php
                }
    ?>
    </div>
    <!-- another book end-->
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
                        <h3><strong>Informasi</strong></h4>
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
    <!-- MODAL WISHLIST -->
    <div class="modal fade" id="hapusData<?= $no ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Hapus Buku</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <input type="hidden" class="form-control" id="id_buku" name="id_buku" aria-describedby="" value="<?= $record['id_buku'] ?>" readonly>
                        <h5 class="text-center">Apakah anda yakin ingin menghapus data buku ini? <br>
                            <span class="text-danger"><?= $record['nama_buku'] ?></span>
                        </h5>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tidak</button>
                            <button type="submit" class="btn btn-primary" name="btnHapus">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL WISHLIST END -->
    <!-- Footer end-->
    <script src="../js/bootstrap.min.js"></script>
</body>

</html>