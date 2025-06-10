<?php
include '../config/koneksi.php'; // Tambahkan ini
include 'header.php';
error_log("Memuat profil.php");
$stmt_admin = $mysqli->prepare("
    SELECT
        nickname AS username,
        password,
        photo AS foto,
        description AS deskripsi
    FROM
        author
    WHERE
        id = ?");
$stmt_admin->bind_param("i", $_SESSION['id_author']);
$stmt_admin->execute();
$qry_admin = $stmt_admin->get_result();
$admin = $qry_admin->fetch_assoc();
$level_akses = 'Penulis';
?>
<div class="container-fluid body">
    <div class="row">
        <div class="col-lg-2 sidebar">
            <?php include 'sidebar.php'; ?>
        </div>
        <div class="col-lg-10 main-content">
            <div class="panel panel-default">
                <div class="panel-body">
<?php
if (isset($_POST['btn_simpan'])) {
    $message = [];
    $file_name_foto = !empty($_FILES['foto']['name']) ? $_FILES['foto']['name'] : $admin['foto'];
    if (!empty($_FILES['foto']['name'])) {
        $file_extension_foto = pathinfo($file_name_foto, PATHINFO_EXTENSION);
        $file_weight_foto = $_FILES['foto']['size'];
        $target_path_foto = "../images/author/";
        $file_max_weight = 2048000;
        $ok_ext = ['jpg', 'png', 'gif', 'jpeg', 'JPG', 'PNG', 'GIF', 'JPEG'];
        if (in_array($file_extension_foto, $ok_ext)) {
            if ($file_weight_foto <= $file_max_weight) {
                move_uploaded_file($_FILES['foto']['tmp_name'], $target_path_foto . $file_name_foto);
                if ($admin['foto'] && file_exists("../images/author/" . $admin['foto'])) {
                    unlink("../images/author/" . $admin['foto']);
                }
            } else {
                $message[] = "<b>Ukuran File</b> terlalu besar!";
            }
        } else {
            $message[] = "<b>Type File</b> tidak diperbolehkan";
        }
    }
    if (empty(trim($_POST['txt_username']))) {
        $message[] = "Nickname tidak boleh kosong!";
    }
    $password = $admin['password'];
    if (!empty($_POST['txt_passwordbaru'])) {
        if (empty(trim($_POST['txt_passwordlama']))) {
            $message[] = "Password Lama Kosong";
        } elseif ($_POST['txt_passwordlama'] != $admin['password']) {
            $message[] = "Password Lama Salah";
        } elseif (empty(trim($_POST['txt_kpassword']))) {
            $message[] = "Konfirmasi Password tidak boleh kosong!";
        } elseif ($_POST['txt_passwordbaru'] != $_POST['txt_kpassword']) {
            $message[] = "Konfirmasi Password tidak sesuai!";
        } else {
            $password = $_POST['txt_passwordbaru'];
        }
    }
    $txt_username = $mysqli->real_escape_string($_POST['txt_username']);
    $txt_deskripsi = $mysqli->real_escape_string($_POST['txt_deskripsi']);
    if (empty($message)) {
        $stmt = $mysqli->prepare("
            UPDATE author
            SET nickname = ?, password = ?, description = ?, photo = ?
            WHERE id = ?");
        $stmt->bind_param("ssssi", $txt_username, $password, $txt_deskripsi, $file_name_foto, $_SESSION['id_author']);
        if ($stmt->execute()) {
?>
            <div class="alert alert-success alert-dismissable fade in">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                Data Berhasil Diperbaharui.
            </div>
<?php
        } else {
            $message[] = "Gagal memperbarui data: " . $mysqli->error;
        }
        $stmt->close();
    }
    if (!empty($message)) {
        foreach ($message as $show_message) {
?>
            <div class="alert alert-danger alert-dismissable fade in">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $show_message; ?>
            </div>
<?php
        }
    }
}
?>
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="page-header"><i class="fa fa-user"></i> Pengaturan Profil</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="profile-pic">
                                            <img src="../images/author/<?php echo htmlspecialchars($admin['foto'] ?: 'default.jpg'); ?>">
                                        </div>
                                        <input type="file" name="foto">
                                        <label class="text-muted">Ukuran gambar maks. 2 MB dengan type: jpg, png, gif</label>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label>Nickname</label>
                                        <input type="text" class="form-control input-sm" name="txt_username" value="<?php echo htmlspecialchars($admin['username']); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Deskripsi</label>
                                        <textarea class="form-control input-sm" name="txt_deskripsi" rows="5"><?php echo htmlspecialchars($admin['deskripsi']); ?></textarea>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label>Level Akses</label><br>
                                        <label class="text-muted"><?php echo $level_akses; ?></label>
                                    </div>
                                    <div class="form-group">
                                        <label>Password Lama</label>
                                        <input type="password" class="form-control input-sm" name="txt_passwordlama">
                                    </div>
                                    <div class="form-group">
                                        <label>Password Baru</label>
                                        <input type="password" class="form-control input-sm" name="txt_passwordbaru">
                                    </div>
                                    <div class="form-group">
                                        <label>Konfirmasi Password</label>
                                        <input type="password" class="form-control input-sm" name="txt_kpassword">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <a href="beranda.php" class="btn btn-danger btn-sm">
                                        <i class="fa fa-times"></i> Batal
                                    </a>
                                    <button class="btn btn-sm btn-primary" type="submit" name="btn_simpan">
                                        <i class="fa fa-check"></i> Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
