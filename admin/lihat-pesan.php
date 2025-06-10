<?php
include '../config/koneksi.php';
include 'header.php';
error_log("Memuat lihat-pesan.php");
$stmt_pesan = $mysqli->prepare("
    SELECT
        id,
        email,
        nama_lengkap,
        subjek,
        isi_pesan,
        status,
        tanggal
    FROM
        pesan
    WHERE
        id = ?");
$stmt_pesan->bind_param("i", $_GET['id']);
$stmt_pesan->execute();
$qry_pesan = $stmt_pesan->get_result();
$pesan = $qry_pesan->fetch_assoc();

$stmt_update = $mysqli->prepare("UPDATE pesan SET status = 'dibaca' WHERE id = ?");
$stmt_update->bind_param("i", $_GET['id']);
$stmt_update->execute();
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
                            <h2 class="page-header"><i class="fa fa-envelope"></i> Detail Pesan</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="pesan-table">
                                <tr>
                                    <th width="15%">nama_lengkap</th>
                                    <td width="5%">:</td>
                                    <td width="80%"><?php echo htmlspecialchars($pesan['nama_lengkap']); ?></td>
                                </tr>
                                <tr>
                                    <th>Email nama_lengkap</th>
                                    <td>:</td>
                                    <td><?php echo htmlspecialchars($pesan['email']); ?></td>
                                </tr>
                                <tr>
                                    <th>Subjek</th>
                                    <td>:</td>
                                    <td><?php echo htmlspecialchars($pesan['subjek']); ?></td>
                                </tr>
                                <tr>
                                    <th>Tanggal</th>
                                    <td>:</td>
                                    <td><?php echo htmlspecialchars($pesan['tanggal']); ?></td>
                                </tr>
                            </table>
                            <hr>
                            <div class="message-content">
                                <p><?php echo htmlspecialchars($pesan['isi_pesan']); ?></p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="pesan.php" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
                            <a href="hapus-pesan.php?id=<?php echo $pesan['id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus Pesan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
