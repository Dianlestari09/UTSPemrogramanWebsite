<?php
include 'config/config.php';
include 'config/koneksi.php';
include 'lib/redirect.php';
include 'header.php';

$limit = 5;
$noPage = isset($_GET['p']) ? (int)$mysqli->real_escape_string($_GET['p']) : 1;
$offset = ($noPage - 1) * $limit;
$search_query = isset($_GET['q']) ? trim($mysqli->real_escape_string($_GET['q'])) : '';

if (empty($search_query)) {
    $sqlIndex = "SELECT
        article.id,
        article.title,
        article.picture,
        article.content,
        article.date,
        article.views,
        author.id AS author_id,
        author.nickname,
        category.id AS category_id,
        category.name
        FROM
        article
        INNER JOIN article_author ON article.id = article_author.article_id
        INNER JOIN author ON article_author.author_id = author.id
        INNER JOIN article_category ON article.id = article_category.article_id
        INNER JOIN category ON article_category.category_id = category.id
        ORDER BY
        article.date DESC
        LIMIT ?, ?";
    $sql_rec = "SELECT id FROM article";
} else {
    $search_term = "%$search_query%";
    $sqlIndex = "SELECT
        article.id,
        article.title,
        article.picture,
        article.content,
        article.date,
        article.views,
        author.id AS author_id,
        author.nickname,
        category.id AS category_id,
        category.name
        FROM
        article
        INNER JOIN article_author ON article.id = article_author.article_id
        INNER JOIN author ON article_author.author_id = author.id
        INNER JOIN article_category ON article.id = article_category.article_id
        INNER JOIN category ON article_category.category_id = category.id
        WHERE
        article.title LIKE ? OR article.content LIKE ?
        ORDER BY
        article.date DESC
        LIMIT ?, ?";
    $sql_rec = "SELECT id FROM article WHERE title LIKE ? OR content LIKE ?";
}

$stmt_rec = $mysqli->prepare($sql_rec);
if ($search_query) {
    $stmt_rec->bind_param("ss", $search_term, $search_term);
} else {
    $stmt_rec->execute();
}
$stmt_rec->execute();
$total_rec = $stmt_rec->get_result();
$total_rec_num = $total_rec->num_rows;
$total_page = ceil($total_rec_num / $limit);

$stmt = $mysqli->prepare($sqlIndex);
if ($search_query) {
    $stmt->bind_param("ssii", $search_term, $search_term, $offset, $limit);
} else {
    $stmt->bind_param("ii", $offset, $limit);
}
$stmt->execute();
$qryIndex = $stmt->get_result();
?>
<div class="container-fluid">
    <div class="row">
        <div class="container konten-wrapper">
            <div class="panel panel-default">
                <div class="panel-body main">
                    <div class="col-md-8">
                        <h3>Hasil Pencarian: <?php echo htmlspecialchars($search_query) ?: 'Semua Berita'; ?></h3>
                        <?php if ($qryIndex->num_rows == 0) { ?>
                            <p>Tidak ada hasil ditemukan untuk "<?php echo htmlspecialchars($search_query); ?>".</p>
                        <?php } else { ?>
                            <?php while ($index = $qryIndex->fetch_assoc()) { ?>
                            <div class="post">
                                <div class="row post-title">
                                    <div class="col-sm-12">
                                        <a href="<?php echo $base_url . "detail.php?id=" . $index['id'] . "&judul=" . urlencode(strtolower(str_replace(" ", "-", $index['title']))); ?>">
                                            <h2><?php echo htmlspecialchars(strtoupper($index['title'])); ?></h2>
                                        </a>
                                    </div>
                                </div>
                                <div class="row post-meta">
                                    <div class="col-sm-3">
                                        <i class="glyphicon glyphicon-user"></i> 
                                        <a href="<?php echo $base_url . "author.php?id=" . $index['author_id']; ?>">
                                            <?php echo htmlspecialchars($index['nickname']); ?>
                                        </a>
                                    </div>
                                    <div class="col-sm-3">
                                        <i class="glyphicon glyphicon-calendar"></i> 
                                        <?php echo htmlspecialchars($index['date']); ?>
                                    </div>
                                    <div class="col-sm-3">
                                        <i class="glyphicon glyphicon-eye-open"></i> 
                                        <?php echo (int)$index['views']; ?>x
                                    </div>
                                    <div class="col-sm-3">
                                        <i class="glyphicon glyphicon-folder-open"></i> 
                                        <a href="<?php echo $base_url . "kategori.php?id=" . $index['category_id'] . "&kat=" . urlencode(strtolower(str_replace(" ", "-", $index['name']))); ?>">
                                            <em><?php echo htmlspecialchars($index['name']); ?></em>
                                        </a>
                                    </div>
                                </div>
                                <div class="row post-content">
                                    <div class="col-sm-12 excerpt">
                                        <img src="<?php echo $base_url . "images/" . htmlspecialchars($index['picture']); ?>" class="wow fadeIn" alt="<?php echo htmlspecialchars($index['title']); ?>">
                                        <?php echo htmlspecialchars(substr(strip_tags($index['content']), 0, 200)); ?>...
                                        <a href="<?php echo $base_url . "detail.php?id=" . $index['id'] . "&judul=" . urlencode(strtolower(str_replace(" ", "-", $index['title']))); ?>">
                                            Selengkapnya <i class="glyphicon glyphicon-chevron-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        <?php } ?>
                        <ul class="pagination">
                            <?php if ($total_rec_num > $limit) { ?>
                                <?php if ($noPage > 1) { ?>
                                    <li>
                                        <a href="<?php echo $base_url . "search.php?q=" . urlencode($search_query) . "&p=" . ($noPage - 1); ?>">
                                            <i class="glyphicon glyphicon-chevron-left"></i>
                                        </a>
                                    </li>
                                <?php } ?>
                                <?php for ($page = 1; $page <= $total_page; $page++) { ?>
                                    <?php if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $total_page)) { ?>
                                        <?php
                                        if ($page == $total_page && $noPage <= $total_page - 5) echo "<li class='active'><a>...</a></li>";
                                        if ($page == $noPage) echo "<li class='active'><a href='#'>$page</a></li>";
                                        else echo "<li><a href='" . $base_url . "search.php?q=" . urlencode($search_query) . "&p=$page'>$page</a></li>";
                                        if ($page == 1 && $noPage >= 6) echo "<li class='active'><a>...</a></li>";
                                        ?>
                                    <?php } ?>
                                <?php } ?>
                                <?php if ($noPage < $total_page) { ?>
                                    <li>
                                        <a href="<?php echo $base_url . "search.php?q=" . urlencode($search_query) . "&p=" . ($noPage + 1); ?>">
                                            <i class="glyphicon glyphicon-chevron-right"></i>
                                        </a>
                                    </li>
                                <?php } ?>
                            <?php } ?>
                        </ul>
                    </div>
                    <?php include 'sidebar.php'; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>