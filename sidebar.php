<?php
$kategori_list = 'SELECT
    category.name,
    COUNT(article.id) AS jumlah,
    category.id
    FROM
    article
    INNER JOIN article_category ON article.id = article_category.article_id
    INNER JOIN category ON article_category.category_id = category.id
    GROUP BY
    category.name,
    category.id';
$list_kategori = $mysqli->query($kategori_list) or die($mysqli->error);

$terkini = 'SELECT
article.id,
article.title,
article.picture,
article.date,
author.id AS author_id,
author.nickname
FROM
article
INNER JOIN article_author ON article.id = article_author.article_id
INNER JOIN author ON article_author.author_id = author.id
ORDER BY
article.date DESC
LIMIT 0, 5';

$populer = 'SELECT
article.id,
article.title,
article.picture,
article.date,
author.id AS author_id,
author.nickname,
article.views
FROM
article
INNER JOIN article_author ON article.id = article_author.article_id
INNER JOIN author ON article_author.author_id = author.id
ORDER BY
article.views DESC
LIMIT 0, 5';

$list_terkini = $mysqli->query($terkini) or die($mysqli->error);
$list_populer = $mysqli->query($populer) or die($mysqli->error);
?>
<div class="col-md-4 sidebar">
    <div class="sidebar-item kategori">
        <h3 class="page-header">Kategori</h3>
        <ul class="nav nav-pills nav-stacked nav-kat">
            <?php while ($data_kat = $list_kategori->fetch_array()) { ?>
                <?php if (isset($_GET['id']) && $data_kat['id'] == $_GET['id']) { ?>
                    <li class="active">
                        <a href="<?php echo $base_url."kategori.php?id=".$data_kat['id']."&kat=".strtolower($data_kat['name']); ?>">
                            <?php echo $data_kat['name']; ?> <span class="badge pull-right"><?php echo $data_kat['jumlah']; ?></span>
                        </a>
                    </li>
                <?php } else { ?>
                    <li>
                        <a href="<?php echo $base_url."kategori.php?id=".$data_kat['id']."&kat=".strtolower($data_kat['name']); ?>">
                            <?php echo $data_kat['name']; ?> <span class="badge pull-right"><?php echo $data_kat['jumlah']; ?></span>
                        </a>
                    </li>
                <?php } ?>
            <?php } ?>
        </ul>
    </div>
    <div class="sidebar-item">
        <h3 class="page-header">Populer</h3>
        <ul class="news-list">
            <?php while ($populer_list = $list_populer->fetch_array()) { ?>
                <li>
                    <a href="<?php echo $base_url."detail.php?id=".$populer_list['id']."&judul=".strtolower(str_replace(" ", "-", $populer_list['title'])); ?>">
                        <img src="<?php echo $base_url."images/".$populer_list['picture']; ?>" class="img-responsive wow fadeIn">
                    </a>
                    <p>Oleh: <a href="<?php echo $base_url."author.php?id=".$populer_list['author_id']; ?>"><?php echo $populer_list['nickname']; ?></a>&nbsp;&nbsp;&ndash;&nbsp;&nbsp;<?php echo $populer_list['date']; ?></p>
                    <a href="<?php echo $base_url."detail.php?id=".$populer_list['id']."&judul=".strtolower(str_replace(" ", "-", $populer_list['title'])); ?>">
                        <?php echo $populer_list['title']; ?>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
    <div class="sidebar-item">
        <h3 class="page-header">Terkini</h3>
        <ul class="news-list">
            <?php while ($terkini_list = $list_terkini->fetch_array()) { ?>
                <li>
                    <a href="<?php echo $base_url."detail.php?id=".$terkini_list['id']."&judul=".strtolower(str_replace(" ", "-", $terkini_list['title'])); ?>">
                        <img src="<?php echo $base_url."images/".$terkini_list['picture']; ?>" class="img-responsive wow fadeIn">
                    </a>
                    <p>Oleh: <a href="<?php echo $base_url."author.php?id=".$terkini_list['author_id']; ?>"><?php echo $terkini_list['nickname']; ?></a>&nbsp;&nbsp;&ndash;&nbsp;&nbsp;<?php echo $terkini_list['date']; ?></p>
                    <a href="<?php echo $base_url."detail.php?id=".$terkini_list['id']."&judul=".strtolower(str_replace(" ", "-", $terkini_list['title'])); ?>">
                        <?php echo $terkini_list['title']; ?>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>