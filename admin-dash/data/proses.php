<?php
include '../koneksi.php';
include '../function.php';

$errors = array();
$success = "";
global $koneksi;

if (isset($_POST['btnEdit'])) {
    if (editData($_POST) > 0) {
        $success = "Data berhasil di update";
    } else {
        $errors['edit'] = "Data Gagal Di update" . mysqli_error($koneksi);
    }
}

if (isset($_POST['btnTambah'])) {
    if (tambah_barang($_POST) > 0) {
        $success = "Data berhasil di tambah!";
    } else {
        $errors['tambah'] = "Data Gagal di tambahkan!" . mysqli_error($koneksi);
    }
}

if (isset($_POST['btnHapus'])) {
    $hasil = hapus($_POST['id_buku']);
    if ($hasil > 0) {
        $success = "Data Berhasil di Hapus!";
    } else {
        $errors['hapus'] = "Data gagal dihapus!";
    }
}

if (isset($_POST['btnFav'])) {
    if (AddFav($_POST) > 0) {
        $success = "Berhasil ditambah ke WishList!";
    } else {
        $errors['fav'] = "Gagal ditambah ke Wishlist";
    }
}

if (isset($_POST['btnHapusFav'])) {
    if (hapusFav($_POST) > 0) {
        $success = "Berhasil menghapus wishlist!";
    } else {
        $errors['fav'] = "Gagal menghapus Wishlist!";
    }
}
if (isset($_POST['btnUbahRole'])) {
    if (ubahRole($_POST) > 0) {
        $success = "Akses berhasil diubah!";
    } else {
        $errors['role'] = "Akses Gagal di Ubah!" . mysqli_error($koneksi);
    }
}

if (isset($_POST['btnTambahPenulis'])) {
    if (tambah_penulis($_POST) > 0) {
        $success = "Penulis Baru Berhasil Ditambahkan!";
    } else {
        $errors['penulis'] = "Penulis baru Gagal ditambah!" . mysqli_error($koneksi);
    }
}
if (isset($_POST['btnEditPenulis'])) {
    if (edit_penulis($_POST) > 0) {
        $success = "Data Penulis berhasil diedit";
    } else {
        $errors['penulis'] = "Data Penulis Gagal ditambahkan" . mysqli_error($koneksi);
    }
}

if (isset($_POST['tambahPenerbit'])) {
    if (tambah_penerbit($_POST) > 0) {
        $success = "Data Penerbit berhasil ditambah!";
    } else {
        $errors['penerbit'] = "Data Penerbit Gagal ditambahkan" . mysqli_error($koneksi);
    }
}
if (isset($_POST['btnEditPenerbit'])) {
    if (editPenerbit($_POST) > 0) {
        $success = "Data Penerbit berhasil diubah!";
    } else {
        $errors['penerbit'] = "Data Penerbit Gagal diubah!" . mysqli_error($koneksi);
    }
}
