<?php
include '../config/koneksi.php';
include 'header.php';
error_log("Memuat ubah-komentar.php");
$stmt_check = $mysqli->prepare("SELECT status FROM buku_tamu WHERE id = ?");
$stmt_check->bind_param("i", $_GET['id']);
$stmt_check->execute();
$data_qry = $stmt_check->get_result();
$data = $data_qry->fetch_assoc();

$new_status = $data['status'] == 'tidak' ? 'ya' : 'tidak';
$stmt = $mysqli->prepare("UPDATE buku_tamu SET status = ? WHERE id = ?");
$stmt->bind_param("si", $new_status, $_GET['id']);
if ($stmt->execute()) {
    header("location:buku-tamu.php");
} else {
    die("Error updating 'buku_tamu': " . $mysqli->error);
}