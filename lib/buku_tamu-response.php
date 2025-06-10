<?php
include '../config/koneksi.php';

function anti_injection($data) {
    global $mysqli;
    return $mysqli->real_escape_string(stripslashes(strip_tags(htmlspecialchars($data, ENT_QUOTES))));
}

$nama = anti_injection($_POST['nama'] ?? '');
$email = anti_injection($_POST['email'] ?? '');
$komentar = anti_injection($_POST['komentar'] ?? '');
$tanggal = date('Y-m-d H:i:s');
$error = [];

if (strlen($nama) < 2) {
    $error['nama'] = 'Mohon Isi Nama Lengkap!';
}

if (strlen($email) < 2) {
    $error['email'] = 'Mohon Isi Email!';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error['email_invalid'] = 'Mohon Isi Dengan Email Yang Valid!';
}

if (empty($komentar)) {
    $error['komentar'] = 'Isilah komentar!';
}

if (!empty($error)) {
    echo json_encode(['type' => 'error', 'errors' => $error]);
    exit;
}

$send_qry = $mysqli->query("INSERT INTO buku_tamu (nama, email, komentar, status, tanggal) 
                            VALUES ('$nama', '$email', '$komentar', 'tidak', '$tanggal')");

if (!$send_qry) {
    echo json_encode(['type' => 'invalid', 'message' => 'Terjadi Kesalahan: ' . $mysqli->error]);
    exit;
}

echo json_encode(['type' => 'sukses', 'message' => 'Terima kasih! Komentar Anda akan kami moderasi terlebih dahulu.']);
exit;
?>