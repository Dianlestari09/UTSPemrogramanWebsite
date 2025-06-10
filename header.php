<?php
error_reporting(0);
require_once 'config/config.php';
require_once 'config/koneksi.php';
require_once 'lib/site_title.php';
require_once 'lib/redirect.php';

// Fetch categories
$sqlKat = 'SELECT
category.id,
category.name
FROM
category
INNER JOIN article_category ON category.id = article_category.category_id
GROUP BY
category.name
ORDER BY
category.id ASC
LIMIT 0, 5';
$qryKat = $mysqli->query($sqlKat) or die($mysqli->error);

// Fetch breaking news
$sqlBreaking = 'SELECT article.id, article.title FROM article ORDER BY article.date DESC LIMIT 0, 5';
$qryBreaking = $mysqli->query($sqlBreaking);

$url = $_SERVER['REQUEST_URI'];
$explode_url = explode("/", $url);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo site_title(); ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/hover-min.css">
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="dist/css/style.css">
    <link rel="stylesheet" href="assets/wow/css/animate.css">
    <script src="<?php echo $base_url; ?>assets/jquery/jquery-1.12.0.min.js"></script>
</head>
<body>
<div class="container-fluid wrapper">
    <div class="row">
        <nav class="navbar navbar-inverse navbar-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav headline-container">
                        <p class="navbar-text headline">Breaking News</p>
                        <li>
                            <ul id="headlines" class="headlines">
                                <?php while ($breaking_news = $qryBreaking->fetch_array()) { ?>
                                <li>
                                    <a href="<?php echo $base_url."detail.php?id=".$breaking_news['id']."&amp;judul=".strtolower(str_replace(" ", "-", $breaking_news['title'])); ?>">
                                        <?php echo $breaking_news['title']; ?>
                                    </a>
                                </li>
                                <?php } ?>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <?php if ($explode_url[2] == 'index.php' || $explode_url[2] == '') { ?>
                            <li class="active"><a href="index.php">Beranda</a></li>
                        <?php } else { ?>
                            <li><a href="index.php">Beranda</a></li>
                        <?php } ?>
                        <?php
                        $pages = [
                            ['link' => 'about.php', 'nm_halaman' => 'Tentang'],
                            ['link' => 'contact.php', 'nm_halaman' => 'Kontak'],
                            ['link' => 'buku-tamu.php', 'nm_halaman' => 'Buku Tamu']
                        ];
                        foreach ($pages as $hal) {
                            if ($hal['link'] == $explode_url[2]) {
                        ?>
                            <li class="active"><a href="<?php echo $base_url.$hal['link']; ?>"><?php echo $hal['nm_halaman']; ?></a></li>
                        <?php } else { ?>
                            <li><a href="<?php echo $base_url.$hal['link']; ?>"><?php echo $hal['nm_halaman']; ?></a></li>
                        <?php } } ?>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="row header-wrapper">
        <div class="container">
            <div class="header">
                <h3 class="site-title">NarasiDian</h3>
                <h4 class="site-description">Sumber Informasi Terkini</h4>
            </div>
            <nav class="navbar navbar-default navbar-bottom">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                        <ul class="nav navbar-nav">
                            <?php if ($explode_url[2] == 'index.php' || $explode_url[2] == '') { ?>
                                <li class="active"><a href="index.php" class="hvr-sweep-to-top"><i class="glyphicon glyphicon-home"></i></a></li>
                            <?php } else { ?>
                                <li><a href="index.php" class="hvr-sweep-to-top"><i class="glyphicon glyphicon-home"></i></a></li>
                            <?php } ?>
                            <?php while ($kat_menu = $qryKat->fetch_array()) { ?>
                                <?php if (isset($_GET['id']) && $kat_menu['id'] == $_GET['id']) { ?>
                                    <li class="active">
                                        <a class="hvr-sweep-to-top" href="<?php echo $base_url."kategori.php?id=".$kat_menu['id']."&amp;kat=".strtolower($kat_menu['name']); ?>">
                                            <?php echo $kat_menu['name']; ?>
                                        </a>
                                    </li>
                                <?php } else { ?>
                                    <li>
                                        <a class="hvr-sweep-to-top" href="<?php echo $base_url."kategori.php?id=".$kat_menu['id']."&amp;kat=".strtolower($kat_menu['name']); ?>">
                                            <?php echo $kat_menu['name']; ?>
                                        </a>
                                    </li>
                                <?php } ?>
                            <?php } ?>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" id="search">
                                    <i class="glyphicon glyphicon-search"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-search">
                                    <li>
                                        <form action="search.php" class="navbar-form" role="search" method="GET">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Cari" name="q" id="search-form">
                                            </div>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
<div class="clear"></div>