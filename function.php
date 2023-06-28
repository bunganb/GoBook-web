<?php

include '../koneksi.php';

global $errors;
function tambah_barang($data)
{
    global $koneksi;
    $judul = htmlspecialchars($data['nama_buku']);
    $penulis = htmlspecialchars($data['penulis']);
    $penerbit = htmlspecialchars($data['penerbit']);
    $stok = htmlspecialchars($data['stok_buku']);
    $berat = htmlspecialchars($data['berat']);
    $kategori = htmlspecialchars($data['kategori']);
    $harga = htmlspecialchars($data['harga_buku']);
    $deskripsi = htmlspecialchars($data['deskripsi_buku']);
    $gambar = uploadGambar();

    mysqli_query($koneksi, "INSERT INTO buku VALUES ('','$judul','$gambar','$penulis','$penerbit','$berat','$kategori','$stok','$harga','$deskripsi');");
    return mysqli_affected_rows($koneksi);
}

function hapus($id)
{
    global $koneksi;
    $file = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM buku WHERE id_buku = '$id'"));
    unlink('../img/gambar_buku/' . $file["gambar"]);
    mysqli_query($koneksi, "DELETE FROM buku WHERE id_buku = '$id'");
    return mysqli_affected_rows($koneksi);
}

function editData($data)
{
    global $koneksi;
    $id_buku = $data['id_buku'];
    $judul = $data['nama_buku'];
    $penulis = $data['penulis'];
    $penerbit = $data['penerbit'];
    $stok = $data['stok_buku'];
    $berat = $data['berat'];
    $kategori = $data['kategori'];
    $harga = $data['harga_buku'];
    $deskripsi = $data['deskripsi_buku'];
    $gambarLama = $data['gambar_lama'];

    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        unlink('../img/gambar_buku/' . $gambarLama);
        $gambar = uploadGambar();
    }

    $query = "UPDATE `buku` SET 
    `id_buku`='$id_buku',
    `nama_buku`='$judul',
    `gambar`='$gambar',
    `id_penulis`='$penulis',
    `id_penerbit`='$penerbit',
    `berat`='$berat',
    `id_kategori`='$kategori',
    `stok`='$stok',
    `harga`='$harga',
    `deskripsi`='$deskripsi'
    WHERE id_buku = '$id_buku'";
    $data = mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

function uploadGambar()
{
    $fileName = $_FILES['gambar']['name'];
    $ukuran = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    if ($error === 4) {
        $errors['gambar'] = "Tidak ada gambar yang diupload!";
        return false;
    }

    $ektensi_gbrValid = ['jpeg', 'png', 'jpg'];
    $ektensi_gbr = explode('.', $fileName);
    $ektensi_gbr = strtolower(end($ektensi_gbr));

    if (!in_array($ektensi_gbr, $ektensi_gbrValid)) {
        $errors['gambar'] = "Maaf hanya dapat mengupload gambar!";
        return false;
    }

    if ($ukuran > 1000000) {
        $$errors['gambar'] = "ukuran gambar yang anda upload terlalu besar!";
        return false;
    }

    $fileNameNew = uniqid();
    $fileNameNew .= '.';
    $fileNameNew .= $ektensi_gbr;
    $dir = "../img/gambar_buku/";

    move_uploaded_file($tmpName, $dir . $fileNameNew);
    return $fileNameNew;
}
function AddFav($data)
{
    global $koneksi;
    $id_buku = $data['id_buku'];
    $id_user = $data['id_user'];

    mysqli_query($koneksi, "INSERT INTO wishlist VALUES ('','$id_buku','$id_user')");
    return mysqli_affected_rows($koneksi);
}

function hapusFav($data)
{
    global $koneksi;
    $id_wishlist = $data['id_wishlist'];
    $sql = mysqli_query($koneksi, "DELETE FROM wishlist WHERE id_wishList = '$id_wishlist'");
    return mysqli_affected_rows($koneksi);
}

function ubahRole($data)
{
    global $koneksi;
    $id_user = $data['id_user'];
    $akses = $data['akses'];

    $query = "UPDATE user_data SET id_akses = '$akses' WHERE id_user = '$id_user'";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

// tambah data penulis

function tambah_penulis($data)
{
    global $koneksi;

    $nama_lengkap = $data['nama_lengkap'];
    $nama_pena = $data['nama_pena'];
    $tgl_lahir = date('Y-m-d', strtotime($data['tgl_lahir']));
    $tempat_lahir = $data['tempat_lahir'];

    $query = "INSERT INTO penulis VALUES('','$nama_lengkap','','$nama_pena','$tgl_lahir','$tempat_lahir')";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}
function edit_penulis($data)
{
    global $koneksi;

    $id_penulis = $data['id_penulis'];
    $nama_lengkap = $data['nama_lengkap'];
    $nama_pena = $data['nama_pena'];
    $tgl_lahir = date('Y-m-d', strtotime($data['tgl_lahir']));
    $tempat_lahir = $data['tempat_lahir'];

    $query = "UPDATE `penulis` SET 
    `id_penulis`='$id_penulis',
    `nama_lengkap`='$nama_lengkap',
    `gambar`='',
    `nama_pena`='$nama_pena',
    `tanggal_lahir`='$tgl_lahir',
    `tempat_lahir`='$tempat_lahir'
    WHERE id_penulis = '$id_penulis' ";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

function tambah_penerbit($data)
{
    global $koneksi;

    $nama_penerbit = $data['nama_penerbit'];
    $alamat = $data['alamatPenerbit'];

    $query = "INSERT INTO penerbit VALUES('','$nama_penerbit','$alamat')";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function editPenerbit($data)
{
    global $koneksi;

    $id_penerbit = $data['id_penerbit'];
    $nama_penerbit = $data['nama_penerbit'];
    $alamat = $data['alamatPenerbit'];

    $query = "UPDATE `penerbit` SET `id_penerbit`='$id_penerbit',`nama_penerbit`='$nama_penerbit',`alamat`='$alamat' WHERE id_penerbit = '$id_penerbit'";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}
