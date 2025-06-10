<?php
include '../config/koneksi.php';
include 'header.php';
error_log("Memuat aksi-kat.php");
// Validasi aksi
$act = isset($_GET['act']) ? $_GET['act'] : '';

switch ($act) {
    case 'tambah':
        // Validasi input
        if (!empty($_POST['name'])) {
            $name = $mysqli->real_escape_string($_POST['name']);
            $description = $mysqli->real_escape_string($_POST['description']);
            
            $sql = "INSERT INTO category (name, description) VALUES (?, ?)";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("ss", $name, $description);
            
            if ($stmt->execute()) {
                $_SESSION['success'] = "Kategori berhasil ditambahkan";
            } else {
                $_SESSION['error'] = "Gagal menambahkan kategori: " . $stmt->error;
            }
        } else {
            $_SESSION['error'] = "Nama kategori wajib diisi";
        }
        break;
        
    case 'hapus':
        $id = (int)$_GET['id'];
        if ($id > 0) {
            $sql = "DELETE FROM category WHERE id = ?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("i", $id);
            
            if ($stmt->execute()) {
                $_SESSION['success'] = "Kategori berhasil dihapus";
            } else {
                $_SESSION['error'] = "Gagal menghapus kategori: " . $stmt->error;
            }
        }
        break;
        
     
    case 'update':
        $id = (int)$_POST['id'];
        if ($id > 0 && !empty($_POST['name'])) {
            $name = $mysqli->real_escape_string($_POST['name']);
            $description = $mysqli->real_escape_string($_POST['description']);
            
            $sql = "UPDATE category SET name = ?, description = ? WHERE id = ?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("ssi", $name, $description, $id);
            
            if ($stmt->execute()) {
                $_SESSION['success'] = "Kategori berhasil diperbarui";
            } else {
                $_SESSION['error'] = "Gagal memperbarui kategori: " . $stmt->error;
            }
        } else {
            $_SESSION['error'] = "Data tidak valid";
        }
        break;

    default:
        $_SESSION['error'] = "Aksi tidak valid";
}

header("Location: kategori.php");
exit();
?>