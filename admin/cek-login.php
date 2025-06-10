<?php
session_start();
include '../config/koneksi.php';
$username = $mysqli->real_escape_string($_POST['username']);
$password = $mysqli->real_escape_string($_POST['password']);
$stmt = $mysqli->prepare("SELECT id, nickname, password FROM author WHERE nickname = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$qry = $stmt->get_result();
$data = $qry->fetch_assoc();
if ($data && $password === $data['password']) { // Ganti dengan password_verify jika password di-hash
    session_regenerate_id(true);
    $_SESSION['admin'] = 1;
    $_SESSION['id_author'] = $data['id'];
    $_SESSION['nm_author'] = $data['nickname'];
    $_SESSION['level'] = 'author';
    error_log("Login berhasil, sesi: " . print_r($_SESSION, true));
    header('location:beranda.php');
} else {
    error_log("Login gagal untuk username: $username");
    header('location:index.php?failed');
}
?>