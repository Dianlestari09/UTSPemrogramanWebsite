<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Di bagian atas file index.php (setelah session_start())
if (isset($_GET['logout']) && $_GET['logout'] === 'success') {
    echo '<script>
    Swal.fire({
        title: "Logout Berhasil",
        text: "Anda telah keluar dari sistem",
        icon: "success",
        confirmButtonText: "OK"
    });
    </script>';
}

error_log("Session data di index.php: " . print_r($_SESSION, true));
/*
if (isset($_SESSION['admin'])) {
    header('location:beranda.php');
}
*/
include '../config/koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login Administrator | Kilas Info Bersama Dian</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../dist/css/admin.css">
    <script src="../assets/jquery/jquery-1.12.0.min.js"></script>
    <script async defer src="../assets/bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">LOGIN ADMINISTRATOR</h3>
                    </div>
                    <div class="panel-body">
                        <?php if (isset($_GET['failed'])) { ?>
                            <div class="alert alert-danger">
                                Nickname atau Password Salah.
                            </div>
                        <?php } ?>
                        <form method="POST" action="cek-login.php">
                            <div class="form-group">
                                <label>Nickname</label>
                                <input class="form-control" name="username" type="text" placeholder="Nickname" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input class="form-control" name="password" type="password" placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" type="submit">LOGIN</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>