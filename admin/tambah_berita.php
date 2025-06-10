<?php
include '../config/koneksi.php';
include 'header.php';

// Pastikan author sudah login
if (!isset($_SESSION['id_author'])) {
    header("Location: login.php");
    exit();
}

// Ambil daftar kategori dari database
$stmt_kat = $mysqli->prepare("SELECT id, name FROM category ORDER BY name ASC");
$stmt_kat->execute();
$qry_kat = $stmt_kat->get_result();

// Proses form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn_publish'])) {
    $errors = [];
    
    // Validasi input
    if (empty($_POST['judul'])) {
        $errors[] = "Judul berita harus diisi";
    }
    if (empty($_POST['kategori'])) {
        $errors[] = "Kategori harus dipilih";
    }
    if (empty($_FILES['gambar']['name'])) {
        $errors[] = "Gambar harus diupload";
    }

    // Validasi gambar
    if ($_FILES['gambar']['error'] == UPLOAD_ERR_OK) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $max_size = 2 * 1024 * 1024; // 2MB
        $file_info = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($file_info, $_FILES['gambar']['tmp_name']);
        
        if (!in_array($mime_type, $allowed_types)) {
            $errors[] = "Format file tidak didukung (hanya JPG, PNG, GIF)";
        }
        if ($_FILES['gambar']['size'] > $max_size) {
            $errors[] = "Ukuran file terlalu besar (maks 2MB)";
        }
    }

    // Jika tidak ada error, proses data
    if (empty($errors)) {
        $judul = $mysqli->real_escape_string($_POST['judul']);
        $content = $mysqli->real_escape_string($_POST['content']);
        $tanggal = date('Y-m-d H:i:s');
        $author_id = $_SESSION['id_author'];
        $category_id = (int)$_POST['kategori'];
        
        // Upload gambar
        $ext = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
        $new_filename = uniqid().'.'.strtolower($ext);
        $upload_path = "../images/".$new_filename;
        
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $upload_path)) {
            // Mulai transaction
            $mysqli->begin_transaction();
            
            try {
                // Insert ke tabel article
                $stmt = $mysqli->prepare("INSERT INTO article (title, content, picture, date, views) VALUES (?, ?, ?, ?, 0)");
                $stmt->bind_param("ssss", $judul, $content, $new_filename, $tanggal);
                $stmt->execute();
                $article_id = $mysqli->insert_id;
                
                // Insert ke article_author
                $stmt_aa = $mysqli->prepare("INSERT INTO article_author (article_id, author_id) VALUES (?, ?)");
                $stmt_aa->bind_param("ii", $article_id, $author_id);
                $stmt_aa->execute();
                
                // Insert ke article_category
                $stmt_ac = $mysqli->prepare("INSERT INTO article_category (article_id, category_id) VALUES (?, ?)");
                $stmt_ac->bind_param("ii", $article_id, $category_id);
                $stmt_ac->execute();
                
                $mysqli->commit();
                $_SESSION['success'] = "Berita berhasil dipublikasikan";
                header("Location: berita.php");
                exit();
            } catch (Exception $e) {
                $mysqli->rollback();
                unlink($upload_path); // Hapus file yang sudah diupload
                $errors[] = "Gagal menyimpan data: ".$e->getMessage();
            }
        } else {
            $errors[] = "Gagal mengupload gambar";
        }
    }
    
    // Jika ada error, tampilkan
    if (!empty($errors)) {
        echo '<div class="alert alert-danger">';
        foreach ($errors as $error) {
            echo '<p>'.$error.'</p>';
        }
        echo '</div>';
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
                    <h2 class="page-header"><i class="fa fa-newspaper-o"></i> Tambah Berita</h2>
                    
                    <form method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-8">
                                <!-- Editor Berita -->
                                <div class="form-group">
                                    <input type="text" class="form-control" name="judul" placeholder="Judul Berita" required>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" name="content" id="editor" rows="15" required></textarea>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <!-- Sidebar Kanan -->
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label>Tanggal Publikasi</label>
                                            <input type="text" class="form-control" value="<?= date('d/m/Y') ?>" disabled>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Kategori</label>
                                            <select class="form-control" name="kategori" required>
                                                <option value="">Pilih Kategori</option>
                                                <?php while ($kategori = $qry_kat->fetch_assoc()): ?>
                                                    <option value="<?= $kategori['id'] ?>"><?= htmlspecialchars($kategori['name']) ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Gambar Utama</label>
                                            <input type="file" name="gambar" id="gambar" required>
                                            <p class="help-block">Ukuran maksimal 2MB (JPG, PNG, GIF)</p>
                                            <div id="image-preview">
                                                <img id="preview" src="../images/no-image.jpg" class="img-responsive" style="max-height: 200px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <hr>
                                <button type="submit" name="btn_publish" class="btn btn-primary">
                                    <i class="fa fa-check"></i> Publikasikan
                                </button>
                                <a href="berita.php" class="btn btn-default">
                                    <i class="fa fa-times"></i> Batal
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CKEditor -->
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    // Inisialisasi CKEditor
    CKEDITOR.replace('editor', {
        toolbar: [
            { name: 'document', items: ['Source'] },
            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike'] },
            { name: 'paragraph', items: ['NumberedList', 'BulletedList', 'Blockquote'] },
            { name: 'links', items: ['Link', 'Unlink'] },
            { name: 'insert', items: ['Image', 'Table'] },
            { name: 'styles', items: ['Format', 'Font', 'FontSize'] },
            { name: 'colors', items: ['TextColor', 'BGColor'] }
        ],
        height: 400
    });

    // Preview gambar sebelum upload
    document.getElementById('gambar').addEventListener('change', function(e) {
        var reader = new FileReader();
        reader.onload = function(event) {
            document.getElementById('preview').src = event.target.result;
        };
        reader.readAsDataURL(e.target.files[0]);
    });
</script>
