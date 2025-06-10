<?php
include '../config/koneksi.php';
include 'header.php';
error_log("Memuat hapus-kat.php");
$kode = $mysqli->real_escape_string($_GET['id']);
$stmt = $mysqli->prepare("SELECT name FROM category WHERE id = ?");
$stmt->bind_param("i", $kode);
$stmt->execute();
$kat_qry = $stmt->get_result();
$kat = $kat_qry->fetch_assoc();

if (isset($_POST['hapus_btn'])) {
    $pilihan = $_POST['opt_hapus'];
    $mysqli->begin_transaction();
    try {
        if ($pilihan == 'hapus') {
            // Delete images
            $stmt_images = $mysqli->prepare("
                SELECT article.picture
                FROM article
                INNER JOIN article_category ON article.id = article_category.article_id
                WHERE article_category.category_id = ?");
            $stmt_images->bind_param("i", $kode);
            $stmt_images->execute();
            $gambar_qry = $stmt_images->get_result();
            while ($data_gbr = $gambar_qry->fetch_assoc()) {
                if ($data_gbr['picture'] && file_exists('../images/' . $data_gbr['picture'])) {
                    unlink('../images/' . $data_gbr['picture']);
                }
            }

            // Delete from article_author
            $stmt_aa = $mysqli->prepare("
                DELETE FROM article_author
                WHERE article_id IN (
                    SELECT article_id FROM article_category WHERE category_id = ?)");
            $stmt_aa->bind_param("i", $kode);
            $stmt_aa->execute();

            // Delete from article_category
            $stmt_ac = $mysqli->prepare("DELETE FROM article_category WHERE category_id = ?");
            $stmt_ac->bind_param("i", $kode);
            $stmt_ac->execute();

            // Delete from article
            $stmt_ab = $mysqli->prepare("
                DELETE FROM article
                WHERE id IN (
                    SELECT article_id FROM article_category WHERE category_id = ?)");
            $stmt_ab->bind_param("i", $kode);
            $stmt_ab->execute();

            // Delete category
            $stmt_del = $mysqli->prepare("DELETE FROM category WHERE id = ?");
            $stmt_del->bind_param("i", $kode);
            $stmt_del->execute();

            $mysqli->commit();
            echo "<script>alert('Data Berhasil Dihapus'); window.location = 'kategori.php'</script>";
        } elseif ($pilihan == 'pindah') {
            // Move to Uncategorized (assume category id 4)
            $stmt_move = $mysqli->prepare("
                UPDATE article_category
                SET category_id = 4
                WHERE category_id = ?");
            $stmt_move->bind_param("i", $kode);
            $stmt_move->execute();

            // Delete category
            $stmt_del = $mysqli->prepare("DELETE FROM category WHERE id = ?");
            $stmt_del->bind_param("i", $kode);
            $stmt_del->execute();

            $mysqli->commit();
            echo "<script>alert('Data Berhasil Dihapus'); window.location = 'kategori.php'</script>";
        }
    } catch (Exception $e) {
        $mysqli->rollback();
        echo "<script>alert('Gagal menghapus data: " . $e->getMessage() . "'); window.location = 'kategori.php'</script>";
    }
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
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="page-header"><i class="fa fa-folder-o"></i> Hapus Kategori: <strong><?php echo htmlspecialchars($kat['name']); ?></strong></h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <form action="" method="POST">
                                <div class="form-group">
                                    <input type="radio" name="opt_hapus" value="pindah" checked> Pindahkan semua posting dalam kategori ini ke "Uncategorized"
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="opt_hapus" value="hapus"> Hapus semua posting dalam kategori ini
                                </div>
                                <div class="form-group">
                                    <a class="btn btn-danger btn-sm" href="kategori.php"><i class="fa fa-times"></i> Batal</a>
                                    <button class="btn btn-primary btn-sm" name="hapus_btn" type="submit">
                                        <i class="fa fa-check"></i> Pilih
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
<?php include 'footer.php'; ?>