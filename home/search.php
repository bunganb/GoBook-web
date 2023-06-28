<?php

require_once '../function.php';
include '../koneksi.php';

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
    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <title>Cari-GoBook</title>
    <style>
        nav {
            position: absolute;
            width: 100%;
            height: 60px;
            background: #ffffff;
            box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.25);
            border-radius: 20px;
            font-family: 'Poppins', sans-serif;
            font-weight: 400;
        }

        .quote {
            margin-top: 50px;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
        }

        .header-search {
            padding: 25px;
        }

        .form-search {
            display: inline-block;
            outline: none;
            border: none;
            vertical-align: middle;
            border-radius: 20px;
            font-family: 'Roboto', sans-serif;
            width: 85%;
            height: 50px;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
        }

        .btn-submit {
            /* display: inline-block; */
            position: relative;
            vertical-align: middle;
            margin-left: -20px;
            color: inherit;
            border: none;
        }

        .btn-submit i {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            margin-right: 5px;
        }

        input[type="search"] {
            text-indent: 10px;
            -webkit-appearance: none;
            appearance: none;
        }

        input[type="search"]::-webkit-search-cancel-button {
            -webkit-appearance: none;
            appearance: none;
        }

        /* Footer */

        .footer {
            height: 300px;
            background: #ffc93c;
            padding: 20px;
        }

        .footer ul {
            list-style: none;
            font-family: 'Poppins', sans-serif;
            font-weight: 400;
            line-height: 30px;
        }

        .footer li i {
            margin-right: 8px;
        }

        .footer h3 {
            margin-left: 30px;
        }

        .footer .row {
            margin-top: 20px;
        }

        /* Footer end */
        .copyright {
            padding: 5px;
        }

        .copyright a {
            color: inherit;
        }

        .copyright p {
            margin-left: 370px;
        }
    </style>
</head>

<body>
    <!-- NAVBAR -->
    <div class="header-search">
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
        <div class="quote">
            <h2 class="text-center">Segudang ilmu ada di Buku,<br>
                Segudang Buku ada di GoBook.</h2>
            <h5 class="text-center">Temukan dunia yang kamu cari.</h5>
        </div>
        <!-- SEARCH BAR -->
        <div class="box-search container text-center mt-5">
            <table class="table-search">
                <form action="search.php" method="post">
                    <input class="form-search" type="search" placeholder="  Search" aria-label="Search" name="cari">
                    <button href="" class="btn-submit" type="submit" name="btnCari"><i class="bi bi-search me-2"></i></button>
                </form>
            </table>
        </div>
        <!-- SEARCH BAR END -->
        <div class="quote">
            <div class="kategori-all">
                <div class="container">
                    <div class="genre-group row">
                        <div class="genre-item col-md-3">
                            <a href="" style="text-decoration: none;color:inherit">
                                <img src="../img/bisnis.png" alt="">
                                <h5>Bisnis & Ekonomi</h5>
                            </a>
                        </div>
                        <div class="genre-item col-md-3">
                            <a href="" style="text-decoration: none;color:inherit">
                                <img src="../img/Novel.png" alt="">
                                <h5>Novel</h5>
                            </a>
                        </div>
                        <div class="genre-item col-md-3">
                            <a href="" style="text-decoration: none;color:inherit">
                                <img src="../img/pd.png" alt="">
                                <h5>Pengembangan Diri</h5>
                            </a>
                        </div>
                        <div class="genre-item col-md-3">
                            <a href="" style="text-decoration: none;color:inherit">
                                <img src="../img/pendidikan.png" alt="">
                                <h5>Pendidikan</h5>
                            </a>
                        </div>
                        <div class="genre-item col-md-3">
                            <a href="" style="text-decoration: none;color:inherit">
                                <img src="../img/religi.png" alt="">
                                <h5>Religi</h5>
                            </a>
                        </div>
                        <div class="genre-item col-md-3">
                            <a href="" style="text-decoration: none;color:inherit">
                                <img src="../img/tekno.png" alt="">
                                <h5>Tekologi</h5>
                            </a>
                        </div>
                        <div class="genre-item col-md-3">
                            <a href="" style="text-decoration: none;color:inherit">
                                <img src="../img/komik.png" alt="">
                                <h5>Komik</h5>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- NAVBAR END -->
    <!-- main -->
    <!-- Buku pilihan -->
    <div class="best-sell" style="padding: 40px;">
        <div class="container-fluid text-center">
            <?php
            if (isset($_POST['btnCari'])) {
                $cari = $_POST['cari'];
                $query = mysqli_query($koneksi, "SELECT *,buku.gambar as gbrbuku FROM buku LEFT JOIN penulis ON buku.id_penulis = penulis.id_penulis WHERE buku.nama_buku LIKE '%$cari%' ORDER BY buku.id_buku DESC");
                $hasilCari = "Hasil Pencarian untuk $cari";
            } else {
                $hasilCari = "Menampilkan semua buku";
                $query = mysqli_query($koneksi, "SELECT *,buku.gambar as gbrbuku FROM buku LEFT JOIN penulis ON buku.id_penulis = penulis.id_penulis");
            }
            ?>
            <h2 class="text-start"><?= $hasilCari ?></h2>
            <div class="row">
                <?php
                while ($data = mysqli_fetch_array($query)) {
                ?>
                    <div class="mt-4 col-3">
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
    <!-- main end-->
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