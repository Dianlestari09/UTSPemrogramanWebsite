<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
error_log("Session data di header.php: " . print_r($_SESSION, true));
if (!isset($_SESSION['admin'])) {
    error_log("Sesi admin tidak ada, mengalihkan ke index.php");
    header('location:index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../dist/css/admin.css">
    <script src="../assets/jquery/jquery-1.12.0.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Administrator</a>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="http://localhost/berita/index.php" target="_blank">
                            <i class="fa fa-globe"></i> Kunjungi Situs
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user"></i> <?php echo $_SESSION['nm_author']; ?> <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="#" id="logout-btn">
                                    Logout <i class="fa fa-sign-out"></i>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <script>
    document.getElementById("logout-btn").addEventListener("click", function(e) {
        e.preventDefault();
        if (confirm("Apakah Anda yakin ingin logout?")) {
            window.location.href = "logout.php";
        }
    });
    </script>
</body>

</html>
