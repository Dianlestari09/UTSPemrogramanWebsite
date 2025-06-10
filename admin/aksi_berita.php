<?php
session_start();
include '../config/koneksi.php';

// Debug
error_log("Aksi berita diakses");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn_publish'])) {
    $message = [];
    
    // Validasi gambar
    $file_name_gambar = $_FILES['gambar']['name'];
    $file_extension_gambar = strtolower(pathinfo($file_name_gambar, PATHINFO_EXTENSION));
    $file_weight_gambar = $_FILES['gambar']['size'];
    $target_path_gambar = "../images/";
    $file_max_weight = 2048000; // 2MB
    $ok_ext = ['jpg', 'png', 'gif', 'jpeg'];

    if (empty($file_name_gambar)) {
        $message[] = "Anda belum memilih gambar";
    } elseif (!in_array($file_extension_gambar, $ok_ext)) {
        $message[] = "Format file tidak didukung (hanya JPG, PNG, GIF)";
    } elseif ($file_weight_gambar > $file_max_weight) {
        $message[] = "Ukuran file terlalu besar (maks 2MB)";
    }

    // Validasi input
    if (empty($_POST['judul'])) {
        $message[] = "Judul berita harus diisi";
    }
    if (empty($_POST['kategori'])) {
        $message[] = "Kategori harus dipilih";
    }

    if (empty($message)) {
        // Upload gambar
        $new_file_name = uniqid().'.'.$file_extension_gambar;
        $upload_path = $target_path_gambar.$new_file_name;
        
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $upload_path)) {
            // Proses simpan ke database
            $mysqli->begin_transaction();
            try {
                // Insert article
                $stmt = $mysqli->prepare("INSERT INTO article (title, picture, content, date, views) 
                                        VALUES (?, ?, ?, ?, 0)");
                $stmt->bind_param("ssss", 
                    $mysqli->real_escape_string($_POST['judul']),
                    $new_file_name,
                    $mysqli->real_escape_string($_POST['teks_berita']),
                    date('Y-m-d H:i:s')
                );
                $stmt->execute();
                $article_id = $mysqli->insert_id;

                // Insert article_author
                $stmt_aa = $mysqli->prepare("INSERT INTO article_author (article_id, author_id) VALUES (?, ?)");
                $stmt_aa->bind_param("ii", $article_id, $_SESSION['id_author']);
                $stmt_aa->execute();

                // Insert article_category
                $stmt_ac = $mysqli->prepare("INSERT INTO article_category (article_id, category_id) VALUES (?, ?)");
                $stmt_ac->bind_param("ii", $article_id, (int)$_POST['kategori']);
                $stmt_ac->execute();

                $mysqli->commit();
                $_SESSION['success'] = "Berita berhasil dipublikasikan";
                header("Location: berita.php");
                exit();
            } catch (Exception $e) {
                $mysqli->rollback();
                // Hapus file yang sudah diupload jika gagal
                if (file_exists($upload_path)) {
                    unlink($upload_path);
                }
                $_SESSION['error'] = "Gagal menyimpan data: " . $e->getMessage();
                header("Location: tambah_berita.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Gagal mengupload gambar";
            header("Location: tambah_berita.php");
            exit();
        }
    } else {
        $_SESSION['error'] = implode("<br>", $message);
        header("Location: tambah_berita.php");
        exit();
    }
} else {
    header("Location: tambah_berita.php");
    exit();
}
?>