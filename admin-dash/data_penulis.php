<?php

include '../koneksi.php';
include 'data/proses.php';
session_start();
$username = $_SESSION['username'];
$akses = $_SESSION['akses'];
if (!isset($username)) {
    header('location:../index.php');
}
if ($akses != 'admin') {
    header('location:../index.php');
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>GoBook Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/feather/feather.css">
    <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="images/icon_logo.png" />
    <!-- bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Bootsratp -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo mr-5" href="index.php"><img src="images/logofix.png" class="mr-2" alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini" href="index.php"><img src="images/logo_stretch.png" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="icon-menu"></span>
                </button>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                            <img src="images/faces/face28.jpg" alt="profile" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                            <p class="dropdown-item">
                                <i class="bi bi-person-fill text-primary"></i>
                                <strong>Admin | <?= $username ?></strong>
                            </p>
                            <a href="../logout.php" class="dropdown-item">
                                <i class="ti-power-off text-primary"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="icon-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">
                            <i class="icon-grid menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                            <i class="icon-layout menu-icon"></i>
                            <span class="menu-title">Data</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="ui-basic">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="data_buku.php">Data Buku</a></li>
                                <li class="nav-item"> <a class="nav-link" href="data_user.php">Data User</a></li>
                                <li class="nav-item"> <a class="nav-link" href="#">Data Penulis</a></li>
                                <li class="nav-item"> <a class="nav-link" href="data_penerbit.php">Data Penerbit</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h5 class="card-title">Data Penulis</h5>
                                        </div>
                                        <div class="col-md-8">
                                            <form class="d-flex" action="data_mitra.php" method="POST">
                                                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="cari">
                                                <button class="btn btn-outline-dark" type="submit" name="btnCari"><i class="bi bi-search"></i></button>
                                            </form>
                                        </div>
                                    </div>
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
                                    <!-- Button Tambah -->
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahPenulis">
                                        Tambah <i class="bi bi-plus-lg"></i>
                                    </button>
                                    <!-- Button Tambah -->
                                    <table class="table table-bordered mt-3">
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Nama Lengkap</th>
                                            <th>Nama Pena</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Tempat Lahir</th>
                                            <th colspan="2">Akses</th>
                                        </tr>
                                        <?php
                                        if (isset($_POST['btnCari'])) {
                                            $cari = $_POST['cari'];
                                            $query = mysqli_query($koneksi, "SELECT * FROM penulis WHERE penulis.nama_pena LIKE '%$cari%' GROUP BY penulis.id_penulis ORDER BY penulis.id_penulis DESC");
                                        } else {
                                            $query = mysqli_query($koneksi, "SELECT * FROM penulis");
                                        }
                                        $no = 1;
                                        while ($record = mysqli_fetch_assoc($query)) {
                                        ?>
                                            <tr>
                                                <td class="text-center"><?= $no++ ?></td>
                                                <td><?= $record['nama_lengkap'] ?></td>
                                                <td><?= $record['nama_pena'] ?></td>
                                                <td class="text-center"><?= $record['tanggal_lahir'] ?></td>
                                                <td class="text-center"><?= $record['tempat_lahir'] ?></td>
                                                <td class="text-center">
                                                    <!-- <a href="#" type="button" class="btn btn-warning btn-md" data-bs-toggle="modal" data-bs-target="#preview"><i class="bi bi-eye"></i></a> -->
                                                    <a href="#" type="button" class="btn btn-primary btn-md" data-bs-toggle="modal" data-bs-target="#ubahData<?= $no ?>"><i class="bi bi-pencil-square"></i></a>
                                                    <a href="data_penulis.php?id_penulis=<?= $record['id_penulis'] ?>" type="button" class="btn btn-danger btn-md" data-bs-toggle="modal" data-bs-target="#hapusDataPenulis<?= $no ?>"><i class="bi bi-trash"></i></a>
                                                </td>
                                            </tr>
                                            <!-- EDIT MODAL -->
                                            <div class="modal fade" id="ubahData<?= $no ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Update Data Penulis</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="" method="POST" enctype="multipart/form-data">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <input type="hidden" class="form-control" id="id_penulis" name="id_penulis" aria-describedby="" value="<?= $record['id_penulis'] ?>" readonly>
                                                                        <div class="mb-3">
                                                                            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                                                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" aria-describedby="" value="<?= $record['nama_lengkap'] ?>">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="nama_pena" class="form-label">Nama Pena</label>
                                                                            <input type="text" class="form-control" id="nama_pena" name="nama_pena" aria-describedby="" value="<?= $record['nama_pena'] ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="mb-3">
                                                                            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                                                            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" aria-describedby="" value="<?= $record['tanggal_lahir'] ?>">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                                                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" aria-describedby="" value="<?= $record['tempat_lahir'] ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary" name="btnEditPenulis">Simpan</button>
                                                                    </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Edit Modal end -->
                                            <!-- Hapus MODAL -->
                                            <div class="modal fade" id="hapusDataPenulis<?= $no ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                            <!-- Hapus Modal end -->
                                        <?php } ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023. GOBOOK COMPANY
                            All rights reserved.</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"></span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- Tambah penulis MODAL -->
    <div class="modal fade" id="tambahPenulis" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Penulis</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="hidden" class="form-control" id="id_penulis" name="id_buku" aria-describedby="" value="" readonly>
                                <div class="mb-3">
                                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" aria-describedby="" value="">
                                </div>
                                <div class="mb-3">
                                    <label for="nama_pena" class="form-label">Nama Pena</label>
                                    <input type="text" class="form-control" id="nama_pena" name="nama_pena" aria-describedby="" value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" aria-describedby="" value="">
                                </div>
                                <div class="mb-3">
                                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" aria-describedby="" value="">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="btnTambahPenulis">Simpan</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- js bundle bootsrap -->
    <script src="../js/bootstrap.min.js"></script>
    <!-- plugins:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="vendors/chart.js/Chart.min.js"></script>
    <script src="vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="js/dataTables.select.min.js"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/hoverable-collapse.js"></script>
    <script src="js/template.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="js/dashboard.js"></script>
    <script src="js/Chart.roundedBarCharts.js"></script>
    <!-- End custom js for this page-->
</body>

</html>