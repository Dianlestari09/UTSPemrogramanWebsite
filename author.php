<?php include 'header.php';
if (!isset($_GET['id'])) redirect('404');
$limit = 5;
$noPage = isset($_GET['p']) ? $_GET['p'] : 1;
$offset = ($noPage - 1) * $limit;

$sqlAuthor = "SELECT nickname, photo, description FROM author WHERE id='".$mysqli->real_escape_string($_GET['id'])."'";
$qryAuthor = $mysqli->query($sqlAuthor) or die($mysqli->error);
$jumlah = $qryAuthor->num_rows;

if ($jumlah > 0) {
    $author = $qryAuthor->fetch_assoc();
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
    WHERE author.id = '".$mysqli->real_escape_string($_GET['id'])."'
    ORDER BY
    article.date DESC
    LIMIT ".$offset.",".$limit;

    $sql_rec = "SELECT article.id FROM article INNER JOIN article_author ON article.id = article_author.article_id WHERE article_author.author_id = '".$mysqli->real_escape_string($_GET['id'])."'";
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
                        <div class="author">
                            <div class="author-img wow fadeIn" data-wow-duration="3s" data-wow-delay="5s">
                                <img width="150" height="150" src="<?php echo $base_url; ?>images/author/<?php echo $author['photo'] ?: 'default.jpg'; ?>">
                            </div>
                            <div class="author-data">
                                <p><span class="author-name"><?php echo $author['nickname']; ?></span></p>
                                <p class="author-desc text-muted"><?php echo $author['description'] ?: 'No description available.'; ?></p>
                            </div>
                        </div>
                        <h4>Berita yang diposting oleh "<strong><?php echo $author['nickname']; ?></strong>"</h4>
                        <?php while ($post_auth = $qryIndex->fetch_assoc()) { ?>
                        <div class="post">
                            <div class="row post-title">
                                <div class="col-sm-12">
                                    <a href="<?php echo $base_url."detail.php?id=".$post_auth['id']."&judul=".strtolower(str_replace(" ", "-", $post_auth['title'])); ?>">
                                        <h2><?php echo strtoupper($post_auth['title']); ?></h2>
                                    </a>
                                </div>
                            </div>
                            <div class="row post-meta">
                                <div class="col-sm-3">
                                    <i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;<?php echo $author['nickname']; ?>
                                </div>
                                <div class="col-sm-3">
                                    <i class="glyphicon glyphicon-calendar"></i>&nbsp;&nbsp;<?php echo $post_auth['date']; ?>
                                </div>
                                <div class="col-sm-3">
                                    <i class="glyphicon glyphicon-eye-open"></i>&nbsp;&nbsp;<?php echo $post_auth['views']; ?>x
                                </div>
                                <div class="col-sm-3">
                                    <i class="glyphicon glyphicon-folder-open"></i>&nbsp;&nbsp;
                                    <a href="<?php echo $base_url."kategori.php?id=".$post_auth['category_id']."&kat=".strtolower(str_replace(' ', '-', $post_auth['name'])); ?>">
                                        <em><?php echo $post_auth['name']; ?></em>
                                    </a>
                                </div>
                            </div>
                            <div class="row post-content">
                                <div class="col-sm-12 excerpt">
                                    <img src="<?php echo $base_url."images/".$post_auth['picture']; ?>" class="wow fadeIn">
                                    <?php echo substr(strip_tags($post_auth['content']), 0, 200); ?>...
                                    <a href="<?php echo $base_url."detail.php?id=".$post_auth['id']."&judul=".strtolower(str_replace(' ', '-', $post_auth['title'])); ?>">
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
                                        <a href="<?php echo $base_url."author.php?id=".$_GET['id']."&p=".($noPage-1); ?>">
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
                                        else echo "<li><a href='".$_SERVER['PHP_SELF']."?id=".$_GET['id']."&p=".$page."'>".$page."</a></li>";
                                        if ($page == 1 && $noPage >= 6) echo "<li class='active'><a>...</a></li>";
                                        ?>
                                    <?php } ?>
                                <?php } ?>
                                <?php if ($noPage < $total_page) { ?>
                                    <li>
                                        <a href="<?php echo $base_url."author.php?id=".$_GET['id']."&p=".($noPage+1); ?>">
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