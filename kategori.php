<?php include 'header.php';
if (!isset($_GET['id'])) redirect('404');
$limit = 5;
$noPage = isset($_GET['p']) ? $mysqli->real_escape_string($_GET['p']) : 1;
$offset = ($noPage - 1) * $limit;

$sqlKategori = "SELECT name FROM category WHERE id='".$mysqli->real_escape_string($_GET['id'])."'";
$qryKategori = $mysqli->query($sqlKategori);
$jumlah = $qryKategori->num_rows;

if ($jumlah > 0) {
    $kategori = $qryKategori->fetch_assoc();
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
    INNER JOIN article_category ON article.id = article_category.article_id
    INNER JOIN category ON article_category.category_id = category.id
    INNER JOIN article_author ON article.id = article_author.article_id
    INNER JOIN author ON article_author.author_id = author.id
    WHERE category.id = '".$mysqli->real_escape_string($_GET['id'])."'
    ORDER BY
    article.date DESC
    LIMIT ".$mysqli->real_escape_string($offset).",".$mysqli->real_escape_string($limit);

    $sql_rec = "SELECT article.id FROM article INNER JOIN article_category ON article.id = article_category.article_id WHERE article_category.category_id = '".$mysqli->real_escape_string($_GET['id'])."'";
    $total_rec = $mysqli->query($sql_rec);
    $total_rec_num = $total_rec->num_rows;
    $qryIndex = $mysqli->query($sqlIndex);
    $total_page = ceil($total_rec_num/$limit);
} else {
    echo "<script>window.location = '404.php'</script>";
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="container konten-wrapper">
            <div class="panel panel-default">
                <div class="panel-body main">
                    <div class="col-md-8">
                        <h4>Berita dengan kategori "<strong><?php echo $kategori['name']; ?></strong>"</h4>
                        <?php while ($post_kat = $qryIndex->fetch_assoc()) { ?>
                        <div class="post">
                            <div class="row post-title">
                                <div class="col-sm-12">
                                    <a href="<?php echo $base_url."detail.php?id=".$post_kat['id']."&amp;judul=".strtolower(str_replace(" ", "-", $post_kat['title'])); ?>">
                                        <h2><?php echo strtoupper($post_kat['title']); ?></h2>
                                    </a>
                                </div>
                            </div>
                            <div class="row post-meta">
                                <div class="col-sm-3">
                                    <i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;
                                    <a href="<?php echo $base_url."author.php?id=".$post_kat['author_id']; ?>">
                                        <?php echo $post_kat['nickname']; ?>
                                    </a>
                                </div>
                                <div class="col-sm-3">
                                    <i class="glyphicon glyphicon-calendar"></i>&nbsp;&nbsp;
                                    <?php echo $post_kat['date']; ?>
                                </div>
                                <div class="col-sm-3">
                                    <i class="glyphicon glyphicon-eye-open"></i>&nbsp;&nbsp;
                                    <?php echo $post_kat['views']; ?>x
                                </div>
                                <div class="col-sm-3">
                                    <i class="glyphicon glyphicon-folder-open"></i>&nbsp;&nbsp;<em><?php echo $post_kat['name']; ?></em>
                                </div>
                            </div>
                            <div class="row post-content">
                                <div class="col-sm-12 excerpt">
                                    <img src="<?php echo $base_url."images/".$post_kat['picture']; ?>" class="wow fadeIn">
                                    <?php echo substr(strip_tags($post_kat['content']), 0, 200); ?>...
                                    <a href="<?php echo $base_url."detail.php?id=".$post_kat['id']."&amp;judul=".strtolower(str_replace(' ', '-', $post_kat['title'])); ?>">
                                        Selengkapnya <i class="glyphicon glyphicon-chevron-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <?php include 'sidebar.php'; ?>
                    <div class="col-md-12">
                        <ul class="pagination">
                            <?php if ($total_rec_num > $limit) { ?>
                                <?php if ($noPage > 1) { ?>
                                    <li>
                                        <a href="<?php echo $base_url."kategori.php?id=".$_GET['id']."&amp;p=".($noPage-1); ?>">
                                            <i class="glyphicon glyphicon-chevron-left"></i>
                                        </a>
                                    </li>
                                <?php } ?>
                                <?php for ($page = 1; $page <= $total_page; $page++) { ?>
                                    <?php if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $total_page)) { ?>
                                        <?php
                                        $showPage = $page;
                                        if ($page == $total_page && $noPage <= $total_page-5) echo "<li class='active'><a>...</a></li>";
                                        if ($page == $noPage) echo "<li class='active'><a href='#'>".$page."</a></li>";
                                        else echo "<li><a href='".$_SERVER['PHP_SELF']."?id=".$_GET['id']."&amp;p=".$page."'>".$page."</a></li>";
                                        if ($page == 1 && $noPage >= 6) echo "<li class='active'><a>...</a></li>";
                                        ?>
                                    <?php } ?>
                                <?php } ?>
                                <?php if ($noPage < $total_page) { ?>
                                    <li>
                                        <a href="<?php echo $base_url."kategori.php?id=".$_GET['id']."&amp;p=".($noPage+1); ?>">
                                            <i class="glyphicon glyphicon-chevron-right"></i>
                                        </a>
                                    </li>
                                <?php } ?>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>