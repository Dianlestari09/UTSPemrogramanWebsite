<?php
include '../config/koneksi.php';
include 'header.php';
error_log("Memuat berita.php");
$limit = 5;
$noPage = isset($_GET['p']) ? (int)$_GET['p'] : 1;
$offset = ($noPage - 1) * $limit;
$stmt = $mysqli->prepare("
    SELECT
        article.id,
        article.title,
        article.picture,
        article.date,
        author.id AS author_id,
        author.nickname,
        category.name
    FROM
        article
        INNER JOIN article_author ON article.id = article_author.article_id
        INNER JOIN author ON article_author.author_id = author.id
        INNER JOIN article_category ON article.id = article_category.article_id
        INNER JOIN category ON article_category.category_id = category.id
    ORDER BY article.date DESC
    LIMIT ?, ?");
$stmt->bind_param("ii", $offset, $limit);
$stmt->execute();
$qry = $stmt->get_result();
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
                            <h2 class="page-header"><i class="fa fa-newspaper-o"></i> Berita</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="tambah_berita.php" class="btn btn-sm btn-primary">
                                <i class="fa fa-plus"></i> Tambah
                            </a>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th width="35%">Judul</th>
                                        <th width="15%">Tanggal</th>
                                        <th width="15%">Penulis</th>
                                        <th width="15%">Kategori</th>
                                        <th width="15%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = $offset + 1;
                                    while ($data = $qry->fetch_assoc()) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo htmlspecialchars($data['title']); ?></td>
                                            <td><?php echo date('d/m/Y H:i', strtotime($data['date'])); ?></td>
                                            <td><?php echo htmlspecialchars($data['nickname']); ?></td>
                                            <td><?php echo htmlspecialchars($data['name']); ?></td>
                                            <td class="text-center">
                                                <a href="edit-berita.php?id=<?php echo $data['id']; ?>" class="btn btn-xs btn-warning">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="hapus-berita.php?id=<?php echo $data['id']; ?>" class="btn btn-xs btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?');">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <?php
                            $stmt_count = $mysqli->prepare("
                                SELECT COUNT(*) AS total
                                FROM article
                                INNER JOIN article_author ON article.id = article_author.article_id
                                INNER JOIN author ON article_author.author_id = author.id
                                INNER JOIN article_category ON article.id = article_category.article_id
                                INNER JOIN category ON article_category.category_id = category.id");
                            $stmt_count->execute();
                            $count = $stmt_count->get_result()->fetch_assoc();
                            $total_records = $count['total'];
                            $total_pages = ceil($total_records / $limit);
                            ?>
                            <nav>
                                <ul class="pagination">
                                    <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                                        <li class="<?php echo $noPage == $i ? 'active' : ''; ?>">
                                            <a href="?p=<?php echo $i; ?>"><?php echo $i; ?></a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
