<?php
include '../config/koneksi.php';
include 'header.php';
error_log("Memuat edit-berita.php");
$stmt_kat = $mysqli->prepare("SELECT id, name FROM category ORDER BY name ASC");
$stmt_kat->execute();
$qry_kat = $stmt_kat->get_result();

$stmt_berita = $mysqli->prepare("
    SELECT
        article.id,
        article.title,
        article.picture,
        article.content,
        article_category.category_id
    FROM
        article
        INNER JOIN article_category ON article.id = article_category.article_id
    WHERE
        article.id = ?");
$stmt_berita->bind_param("i", $_GET['id']);
$stmt_berita->execute();
$qry_berita = $stmt_berita->get_result();
$data = $qry_berita->fetch_assoc();
if (!$data) {
    header('location:berita.php');
    exit();
}
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
$var_judul = isset($_POST['judul']) ? $_POST['judul'] : $data['title'];
$var_kategori = isset($_POST['kategori']) ? $_POST['kategori'] : $data['category_id'];
$var_teksberita = isset($_POST['teks_berita']) ? $_POST['teks_berita'] : $data['content'];
if (isset($_POST['btn_edit'])) {
    $message = [];
    // Validate image
    $file_name_gambar = !empty($_FILES['gambar']['name']) ? $_FILES['gambar']['name'] : $data['picture'];
    if (!empty($_FILES['gambar']['name'])) {
        $file_extension_gambar = pathinfo($file_name_gambar, PATHINFO_EXTENSION);
        $file_weight_gambar = $_FILES['gambar']['size'];
        $target_path_gambar = "../images/";
        $file_max_weight = 2048000;
        $ok_ext = ['jpg', 'png', 'gif', 'jpeg', 'JPG', 'PNG', 'GIF', 'JPEG'];

        if (in_array($file_extension_gambar, $ok_ext)) {
            if ($file_weight_gambar <= $file_max_weight) {
                move_uploaded_file($_FILES['gambar']['tmp_name'], $target_path_gambar . $file_name_gambar);
                if ($data['picture'] && file_exists("../images/" . $data['picture'])) {
                    unlink("../images/" . $data['picture']);
                }
            } else {
                $message[] = "<b>Ukuran File</b> terlalu besar!";
            }
        } else {
            $message[] = "<b>Type File</b> tidak diperbolehkan";
        }
    }

    $judul = $mysqli->real_escape_string($_POST['judul']);
    $kategori = $_POST['kategori'];
    $teks_berita = $mysqli->real_escape_string($_POST['teks_berita']);

    if (empty($message)) {
        $mysqli->begin_transaction();
        try {
            // Update article
            $stmt = $mysqli->prepare("UPDATE article SET title = ?, picture = ?, content = ? WHERE id = ?");
            $stmt->bind_param("sssi", $judul, $file_name_gambar, $teks_berita, $_GET['id']);
            $stmt->execute();

            // Update article_category
            $stmt_ac = $mysqli->prepare("UPDATE article_category SET category_id = ? WHERE article_id = ?");
            $stmt_ac->bind_param("ii", $kategori, $_GET['id']);
            $stmt_ac->execute();

            $mysqli->commit();
            echo "<script>alert('Data Berhasil Diperbarui'); window.location = 'berita.php'</script>";
        } catch (Exception $e) {
            $mysqli->rollback();
            $message[] = "Gagal memperbarui data: " . $e->getMessage();
        }
    }

    if (!empty($message)) {
        foreach ($message as $show_message) {
?>
            <div class="alert alert-danger alert-dismissable fade in">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?php echo $show_message; ?>
            </div>
<?php
        }
    }
}
?>
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="page-header"><i class="fa fa-newspaper-o"></i> Edit Berita</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="judul" placeholder="Judul Berita" value="<?php echo htmlspecialchars($var_judul); ?>">
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control input-sm" name="teks_berita" id="editor" rows="15"><?php echo htmlspecialchars($var_teksberita); ?></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Tanggal Posting</label>
                                        <input type="date" class="form-control input-sm" name="tgl_posting" value="<?php echo date('Y-m-d'); ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Kategori</label>
                                        <select class="form-control input-sm" name="kategori">
                                            <?php while ($kat = $qry_kat->fetch_assoc()) { ?>
                                                <option value="<?php echo $kat['id']; ?>" <?php echo $kat['id'] == $var_kategori ? 'selected' : ''; ?>><?php echo htmlspecialchars($kat['name']); ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="file" name="gambar" id="gambar">
                                        <script>
                                            document.getElementById("gambar").onchange = function () {
                                                var reader = new FileReader();
                                                reader.onload = function (e) {
                                                    document.getElementById("image").src = e.target.result;
                                                };
                                                reader.readAsDataURL(this.files[0]);
                                            };
                                        </script>
                                        <label class="text-muted">Ukuran gambar maks. 2 MB dengan type: jpg, png, gif</label>
                                        <img src="../images/<?php echo htmlspecialchars($data['picture']); ?>" width="100%" height="150" id="image">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <a href="berita.php" class="btn btn-danger btn-sm">
                                        <i class="fa fa-arrow-left"></i> Kembali
                                    </a>
                                    <button class="btn btn-sm btn-primary" type="submit" name="btn_edit">
                                        <i class="fa fa-check"></i> Edit
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
<script>
    CKEDITOR.replace('editor');
</script>
<?php include 'footer.php'; ?>