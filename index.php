<?php
include 'restoredata.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-Page</title>
    <link rel="icon" href="img/icon_logo.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>

<body>
    <div class="login-page">
        <div class="row">
            <div class="kiri col-6">
            </div>
            <div class="kanan col-6">
                <div class="form" style="margin-top:70px; margin-left:95px">
                    <h2 class="judul text-center">Login</h2>
                    <form class="form-card card p-4" action="index.php" method="post">
                        <h4>Selamat Datang <br> di GoBook</h4>
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
                        <div class="input-group mb-3 mt-4">
                            <span class="input-group-text" id="basic-addon1"><i class="bi bi-person-fill" style="font-size: 22px;"></i></span>
                            <input type="text" class="form-control" placeholder="Masukkan Username" aria-label="Username" aria-describedby="basic-addon1" name="username">
                        </div>
                        <div class="input-group mb-5">
                            <span class="input-group-text" id="basic-addon1"><i class="bi bi-key" style="font-size: 22px;"></i></span>
                            <input type="password" class="form-control" placeholder="Password" aria-label="Username" aria-describedby="basic-addon1" name="password">
                        </div>
                        <div class="input-group">
                            <button type="submit" class="btn" name="login">Masuk</button>
                        </div>
                    </form>
                    <p class="text-center mt-2" style="color: white;">Belum punya akun? <br><a href="reg.php" style="color: black;text-decoration: none;">Buat akun!</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>