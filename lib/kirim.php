<?php
include '../config/koneksi.php';

function anti_injection($data) {
    global $mysqli;
    return $mysqli->real_escape_string(stripslashes(strip_tags(htmlspecialchars($data, ENT_QUOTES))));
}

$nama_lengkap = anti_injection($_POST['nama_lengkap'] ?? '');
$email = anti_injection($_POST['email'] ?? '');
$subjek = anti_injection($_POST['subjek'] ?? '');
$isi_pesan = anti_injection($_POST['pesan'] ?? '');
$tanggal = date('Y-m-d H:i:s');
$error = [];

if (strlen($nama_lengkap) < 2) {
    $error[] = 'Mohon Isi Nama Lengkap!';
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error[] = 'Mohon Isi Dengan Email Yang Valid!';
}

if (strlen($subjek) < 4) {
    $error[] = 'Mohon Isi Subjek!';
}

if (strlen($isi_pesan) < 4) {
    $error[] = 'Mohon Isi Pesan!';
}

if (!empty($error)) {
    echo json_encode(['type' => 'error', 'messages' => $error]);
    exit;
}

$query = "INSERT INTO pesan (email, nama_lengkap, subjek, isi_pesan, status, tanggal) 
          VALUES ('$email', '$nama_lengkap', '$subjek', '$isi_pesan', 'belum_dibaca', '$tanggal')";
$send = $mysqli->query($query);

if (!$send) {
    echo json_encode(['type' => 'error', 'text' => 'Terjadi Kesalahan: ' . $mysqli->error]);
    exit;
}

echo json_encode(['type' => 'message', 'text' => 'Terima Kasih! Pesan Anda Telah Kami Terima.']);
exit;
?>