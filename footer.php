<?php
$alam = 'SELECT
article.id,
article.title,
article.picture,
article.date,
author.id AS author_id,
author.nickname,
article.views,
category.id AS category_id
FROM
article
INNER JOIN article_author ON article.id = article_author.article_id
INNER JOIN author ON article_author.author_id = author.id
INNER JOIN article_category ON article.id = article_category.article_id
INNER JOIN category ON article_category.category_id = category.id
WHERE
category.id = "4"
ORDER BY
article.date DESC
LIMIT 0, 5';

$pendidikan = 'SELECT
article.id,
article.title,
article.picture,
article.date,
author.id AS author_id,
author.nickname,
article.views,
category.id AS category_id
FROM
article
INNER JOIN article_author ON article.id = article_author.article_id
INNER JOIN author ON article_author.author_id = author.id
INNER JOIN article_category ON article.id = article_category.article_id
INNER JOIN category ON article_category.category_id = category.id
WHERE
category.id = "5"
ORDER BY
article.date DESC
LIMIT 0, 5';

$taman = 'SELECT
article.id,
article.title,
article.picture,
article.date,
author.id AS author_id,
author.nickname,
article.views,
category.id AS category_id
FROM
article
INNER JOIN article_author ON article.id = article_author.article_id
INNER JOIN author ON article_author.author_id = author.id
INNER JOIN article_category ON article.id = article_category.article_id
INNER JOIN category ON article_category.category_id = category.id
WHERE
category.id = "6"
ORDER BY
article.date DESC
LIMIT 0, 5';

$list_alam = $mysqli->query($alam) or die("Error Alam: ".$mysqli->error);
$list_pendidikan = $mysqli->query($pendidikan) or die("Error Pendidikan: ".$mysqli->error);
$list_taman = $mysqli->query($taman) or die("Error Taman: ".$mysqli->error);
?>
<div class="container-fluid footer">
    <div class="row footer-upper">
        <div class="container">
            <div class="col-md-4">
                <h3 class="page-header">Alam</h3>
                <ul class="news-list">
                    <?php while ($alam_list = $list_alam->fetch_array()) { ?>
                        <li>
                            <a href="<?php echo $base_url."detail.php?id=".$alam_list['id']."&judul=".strtolower(str_replace(" ", "-", $alam_list['title'])); ?>">
                                <img src="<?php echo $base_url."images/".$alam_list['picture']; ?>" class="img-responsive wow fadeIn">
                            </a>
                            <p>Oleh: <a href="<?php echo $base_url."author.php?id=".$alam_list['author_id']; ?>"><?php echo $alam_list['nickname']; ?></a>&nbsp;&nbsp;&ndash;&nbsp;&nbsp;<?php echo $alam_list['date']; ?></p>
                            <a href="<?php echo $base_url."detail.php?id=".$alam_list['id']."&judul=".strtolower(str_replace(" ", "-", $alam_list['title'])); ?>">
                                <?php echo $alam_list['title']; ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-md-4">
                <h3 class="page-header">Pendidikan</h3>
                <ul class="news-list">
                    <?php while ($pendidikan_list = $list_pendidikan->fetch_array()) { ?>
                        <li>
                            <a href="<?php echo $base_url."detail.php?id=".$pendidikan_list['id']."&judul=".strtolower(str_replace(" ", "-", $pendidikan_list['title'])); ?>">
                                <img src="<?php echo $base_url."images/".$pendidikan_list['picture']; ?>" class="img-responsive wow fadeIn">
                            </a>
                            <p>Oleh: <a href="<?php echo $base_url."author.php?id=".$pendidikan_list['author_id']; ?>"><?php echo $pendidikan_list['nickname']; ?></a>&nbsp;&nbsp;&ndash;&nbsp;&nbsp;<?php echo $pendidikan_list['date']; ?></p>
                            <a href="<?php echo $base_url."detail.php?id=".$pendidikan_list['id']."&judul=".strtolower(str_replace(" ", "-", $pendidikan_list['title'])); ?>">
                                <?php echo $pendidikan_list['title']; ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-md-4">
                <h3 class="page-header">Taman</h3>
                <ul class="news-list">
                    <?php while ($taman_list = $list_taman->fetch_array()) { ?>
                        <li>
                            <a href="<?php echo $base_url."detail.php?id=".$taman_list['id']."&judul=".strtolower(str_replace(" ", "-", $taman_list['title'])); ?>">
                                <img src="<?php echo $base_url."images/".$taman_list['picture']; ?>" class="img-responsive wow fadeIn">
                            </a>
                            <p>Oleh: <a href="<?php echo $base_url."author.php?id=".$taman_list['author_id']; ?>"><?php echo $taman_list['nickname']; ?></a>&nbsp;&nbsp;&ndash;&nbsp;&nbsp;<?php echo $taman_list['date']; ?></p>
                            <a href="<?php echo $base_url."detail.php?id=".$taman_list['id']."&judul=".strtolower(str_replace(" ", "-", $taman_list['title'])); ?>">
                                <?php echo $taman_list['title']; ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="row footer-bottom">
        <div class="col-md-12">
            <span class="copy">Copyright &copy; <?php echo date('Y'); ?> NarasiDian</span>
        </div>
    </div>
</div>
<script src="<?php echo $base_url; ?>assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo $base_url; ?>assets/ticker/jquery.ticker.min.js"></script>
<script src="<?php echo $base_url; ?>assets/wow/dist/wow.min.js"></script>
<script src="<?php echo $base_url; ?>dist/js/portalberita.js"></script>
</body>
</html>