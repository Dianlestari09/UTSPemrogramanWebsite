<?php
function site_title() {
    global $mysqli;
    $site_title = 'NarasiDian';
    $url = $_SERVER['REQUEST_URI'];
    $explode_url = explode("/", $url);

    if (!isset($_GET['id'])) {
        switch ($explode_url[2] ?? '') {
            case '':
            case 'index.php':
                $site_subtitle = 'Sumber Informasi Terkini';
                $title = "$site_title | $site_subtitle";
                break;
            case 'about.php':
                $site_subtitle = 'Tentang NarasiDian';
                $title = "$site_subtitle | $site_title";
                break;
            case 'contact.php':
                $site_subtitle = 'Kontak Kami';
                $title = "$site_subtitle | $site_title";
                break;
            case 'buku-tamu.php':
                $site_subtitle = 'Buku Tamu';
                $title = "$site_subtitle | $site_title";
                break;
            default:
                $site_subtitle = 'Halaman Tidak Ditemukan';
                $title = "$site_subtitle | $site_title";
                break;
        }
    } else {
        $id = $mysqli->real_escape_string($_GET['id']);
        $explode_again = explode("?", $explode_url[2] ?? '')[0];
        switch ($explode_again) {
            case 'kategori.php':
                $sql = "SELECT name FROM category WHERE id='$id'";
                $qry = $mysqli->query($sql) or die("Error in category title: " . $mysqli->error);
                $data = $qry->fetch_assoc();
                $site_subtitle = $data['name'] ?? 'Kategori Tidak Ditemukan';
                $title = "$site_subtitle | $site_title";
                break;
            case 'detail.php':
                $sql = "SELECT title FROM article WHERE id='$id'";
                $qry = $mysqli->query($sql) or die("Error in article title: " . $mysqli->error);
                $data = $qry->fetch_assoc();
                $site_subtitle = $data['title'] ?? 'Berita Tidak Ditemukan';
                $title = "$site_subtitle | $site_title";
                break;
            case 'author.php':
                $sql = "SELECT nickname FROM author WHERE id='$id'";
                $qry = $mysqli->query($sql) or die("Error in author title: " . $mysqli->error);
                $data = $qry->fetch_assoc();
                $site_subtitle = "Berita oleh " . ($data['nickname'] ?? 'Penulis Tidak Ditemukan');
                $title = "$site_subtitle | $site_title";
                break;
            default:
                $site_subtitle = 'Halaman Tidak Ditemukan';
                $title = "$site_subtitle | $site_title";
                break;
        }
    }

    if (isset($_GET['q'])) {
        $q = htmlspecialchars($_GET['q']);
        $site_subtitle = "Search: $q";
        $title = "$site_subtitle | $site_title";
    }

    if (isset($_GET['p'])) {
        $explode_again = explode("?", $explode_url[2] ?? '')[0];
        switch ($explode_again) {
            case 'index.php':
                $site_subtitle = 'Sumber Informasi Terkini';
                $title = "$site_title | $site_subtitle";
                break;
            case 'kategori.php':
                $sql = "SELECT name FROM category WHERE id='$id'";
                $qry = $mysqli->query($sql) or die("Error in category title: " . $mysqli->error);
                $data = $qry->fetch_assoc();
                $site_subtitle = $data['name'] ?? 'Kategori Tidak Ditemukan';
                $title = "$site_subtitle | $site_title";
                break;
            case 'detail.php':
                $sql = "SELECT title FROM article WHERE id='$id'";
                $qry = $mysqli->query($sql) or die("Error in article title: " . $mysqli->error);
                $data = $qry->fetch_assoc();
                $site_subtitle = $data['title'] ?? 'Berita Tidak Ditemukan';
                $title = "$site_subtitle | $site_title";
                break;
            case 'author.php':
                $sql = "SELECT nickname FROM author WHERE id='$id'";
                $qry = $mysqli->query($sql) or die("Error in author title: " . $mysqli->error);
                $data = $qry->fetch_assoc();
                $site_subtitle = "Berita oleh " . ($data['nickname'] ?? 'Penulis Tidak Ditemukan');
                $title = "$site_subtitle | $site_title";
                break;
            case 'search.php':
                $site_subtitle = "Search: " . htmlspecialchars($_GET['q'] ?? '');
                $title = "$site_subtitle | $site_title";
                break;
            default:
                $site_subtitle = 'Halaman Tidak Ditemukan';
                $title = "$site_subtitle | $site_title";
                break;
        }
    }

    return $title;
}
?>