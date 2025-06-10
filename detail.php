<?php include 'header.php';
if (!isset($_GET['id'])) redirect('404');

$sqlDetail = 'SELECT
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
WHERE article.id = "'.$mysqli->real_escape_string($_GET['id']).'"';

$qryDetail = $mysqli->query($sqlDetail) or die("Error retrieving detail: ".$mysqli->error);
$found = $qryDetail->num_rows;

if ($found > 0) {
    $detail = $qryDetail->fetch_assoc();
    $stat = $detail['views'] + 1;
    $sqlStat = 'UPDATE article SET views = "'.$stat.'" WHERE id = "'.$mysqli->real_escape_string($_GET['id']).'"';
    $qryStat = $mysqli->query($sqlStat) or die("Error updating views: ".$mysqli->error);
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
                        <div class="post-detail">
                            <div class="row post-title">
                                <div class="col-sm-12">
                                    <span><?php echo strtoupper($detail['title']); ?></span>
                                </div>
                            </div>
                            <div class="row post-meta">
                                <div class="col-sm-3">
                                    <i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;
                                    <a href="<?php echo $base_url.'author.php?id='.$detail['author_id']; ?>"><?php echo $detail['nickname']; ?></a>
                                </div>
                                <div class="col-sm-3">
                                    <i class="glyphicon glyphicon-calendar"></i>&nbsp;&nbsp;<?php echo $detail['date']; ?>
                                </div>
                                <div class="col-sm-3">
                                    <i class="glyphicon glyphicon-eye-open"></i>&nbsp;&nbsp;<?php echo $detail['views']; ?>x
                                </div>
                                <div class="col-sm-3">
                                    <i class="glyphicon glyphicon-folder-open"></i>&nbsp;&nbsp;
                                    <a href="<?php echo $base_url.'kategori.php?id='.$detail['category_id'].'&kat='.strtolower($detail['name']); ?>">
                                        <em><?php echo $detail['name']; ?></em>
                                    </a>
                                </div>
                            </div>
                            <div class="row post-content">
                                <div class="col-sm-12">
                                    <div class="image wow fadeIn">
                                        <img src="<?php echo $base_url; ?>images/<?php echo $detail['picture']; ?>">
                                    </div>
                                    <div class="text">
                                        <?php echo $detail['content']; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php include 'sidebar.php'; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>