<?php
session_start();
include 'config.php'; // Sesuaikan dengan file config Anda

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $mysqli->real_escape_string($_POST['nama']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $komentar = $mysqli->real_escape_string($_POST['komentar']);

    $sql = "INSERT INTO buku_tamu (nama, email, komentar, status, tanggal) 
            VALUES ('$nama', '$email', '$komentar', 'tidak', NOW())";

    if ($mysqli->query($sql)) {
        $_SESSION['success'] = "Pesan berhasil dikirim! Menunggu persetujuan admin.";
    } else {
        $_SESSION['error'] = "Gagal mengirim pesan: " . $mysqli->error;
    }
    
    header("Location: buku-tamu.php"); // Redirect kembali
    exit();
} else {
    header("Location: buku-tamu.php");
    exit();
}
?>