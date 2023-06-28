<?php
include 'koneksi.php';
$errors = array();
$success = "";

if (isset($_POST['register'])) {
    $email = mysqli_escape_string($koneksi, $_POST['email']);
    $username = mysqli_escape_string($koneksi, $_POST['username']);
    $pass = mysqli_escape_string($koneksi, $_POST['password']);

    // cek email 
    $cek_email = "SELECT * FROM user_data WHERE email = '$email'";
    $query = mysqli_query($koneksi, $cek_email);
    if (mysqli_num_rows($query) > 0) {
        $errors['email'] = "Maaf Email yang anda masukkan telah terdaftar!";
    }
    // cek username
    $cek_username = "SELECT * FROM user_data WHERE username = '$username'";
    $result = mysqli_query($koneksi, $cek_username);
    if (mysqli_num_rows($result) > 0) {
        $errors['username'] = "Maaf Username Yang anda masukkan telah terdaftar!";
    }
    // masukkan data
    if (count($errors) === 0) {
        $sql = "SELECT * FROM akses";
        $pass_hash = password_hash($pass, PASSWORD_DEFAULT);
        $insert_data = "INSERT INTO user_data (`id_user`, `username`, `email`, `password`, `id_akses`) VALUES ('','$username','$email','$pass_hash','2')";
        $data_in = mysqli_query($koneksi, $insert_data);
        if (mysqli_affected_rows($koneksi) > 0) {
            $success = "Selamat! anda telah berhasil daftar! Silahkan Login!";
        }
    }
}

if (isset($_POST['login'])) {
    $username = mysqli_escape_string($koneksi, $_POST['username']);
    $pass = mysqli_escape_string($koneksi, $_POST['password']);
    session_start();
    // cek username
    $cek_username = mysqli_query($koneksi, "SELECT * FROM user_data LEFT JOIN user_akses ON user_data.id_akses = user_akses.id_akses WHERE username = '$username'");
    if (mysqli_num_rows($cek_username) === 1) {
        $fetch = mysqli_fetch_assoc($cek_username);
        $fetch_pass = $fetch['password'];
        if (password_verify($pass, $fetch_pass)) {
            // cek role
            $fetch_role = $fetch['akses'];
            $fetch_id = $fetch['id_user'];
            $_SESSION['id_user'] = $fetch_id;
            $_SESSION['username'] = $username;
            $_SESSION['akses'] = $fetch_role;
            if ($fetch_role == 'admin') {
                header('location:admin-dash/');
            } elseif ($fetch_role == 'user') {
                header('location:home/');
            }
        } else {
            $errors['password'] = "Maaf Password yang anda masukkan salah!";
        }
    } else {
        $errors['username'] = "Maaf Username yang anda masukkan salah!";
    }
}
