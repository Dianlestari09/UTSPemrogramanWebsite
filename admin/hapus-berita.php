<?php
include '../config/koneksi.php';
include 'header.php';
error_log("Memuat hapus-berita.php");
$stmt_berita = $mysqli->prepare("SELECT picture FROM article WHERE id = ?");
$stmt_berita->bind_param("i", $_GET['id']);
$stmt_berita->execute();
$qry_berita = $stmt_berita->get_result();
$num = $qry_berita->num_rows;
$data = $qry_berita->fetch_assoc();
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
if ($num == 0) {
    header('location:berita.php');
} else {
    $mysqli->begin_transaction();
    try {
        // Delete from article_author
        $stmt_aa = $mysqli->prepare("DELETE FROM article_author WHERE article_id = ?");
        $stmt_aa->bind_param("i", $_GET['id']);
        $stmt_aa->execute();

        // Delete from article_category
        $stmt_ac = $mysqli->prepare("DELETE FROM article_category WHERE article_id = ?");
        $stmt_ac->bind_param("i", $_GET['id']);
        $stmt_ac->execute();

        // Delete from article
        $stmt = $mysqli->prepare("DELETE FROM article WHERE id = ?");
        $stmt->bind_param("i", $_GET['id']);
        $stmt->execute();

        if ($data['picture'] && file_exists("../images/" . $data['picture'])) {
            unlink("../images/" . $data['picture']);
        }

        $mysqli->commit();
        echo "<meta http-equiv='refresh' content='0;url=berita.php'>";
        echo "<h3 class='page-header'><i class='fa fa-refresh fa-spin'></i> Data berhasil dihapus</h3>";
    } catch (Exception $e) {
        $mysqli->rollback();
        echo "Gagal menghapus data: " . $e->getMessage();
    }
}
?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>