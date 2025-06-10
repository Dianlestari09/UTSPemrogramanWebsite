<?php
include '../config/koneksi.php';
include 'header.php';
error_log("Memuat hapus-pesan.php");
$stmt = $mysqli->prepare("DELETE FROM pesan WHERE id = ?");
$stmt->bind_param("i", $_GET['id']);
$success = $stmt->execute();
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
if ($success) {
    echo "<meta http-equiv='refresh' content='0;url=pesan.php'>";
    echo "<h3 class='page-header'><i class='fa fa-refresh fa-spin'></i> Data berhasil dihapus</h3>";
} else {
    echo "Gagal menghapus data: " . $mysqli->error;
}
?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>