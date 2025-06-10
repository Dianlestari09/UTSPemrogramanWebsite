<?php
include '../config/koneksi.php';
include 'header.php';

// Ambil ID dari parameter URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Ambil data kategori yang akan diedit
$sql = "SELECT id, name, description FROM category WHERE id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$kategori = $result->fetch_assoc();

if (!$kategori) {
    $_SESSION['error'] = "Kategori tidak ditemukan";
    header("Location: kategori.php");
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
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="page-header">
                                <i class="fa fa-edit"></i> Edit Kategori: <?= htmlspecialchars($kategori['name']) ?>
                            </h2>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <form method="POST" action="aksi-kat.php?act=update">
                                <input type="hidden" name="id" value="<?= $kategori['id'] ?>">
                                
                                <div class="form-group">
                                    <label>Nama Kategori</label>
                                    <input type="text" name="name" class="form-control" 
                                           value="<?= htmlspecialchars($kategori['name']) ?>" required>
                                </div>
                                
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea name="description" class="form-control" rows="5"><?= 
                                        htmlspecialchars($kategori['description']) ?></textarea>
                                </div>
                                
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save"></i> Simpan Perubahan
                                </button>
                                <a href="kategori.php" class="btn btn-default">
                                    <i class="fa fa-arrow-left"></i> Kembali
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>