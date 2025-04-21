<?php
include 'connection.php';

// Query to select all news articles
$sql = "SELECT 
a.id,
a.date,
a.title,
a.content,
a.picture,
au.nickname AS author_name,
c.name AS category_name
FROM dbms_berita.article a
JOIN dbms_berita.article_author aa ON a.id = aa.article_id
JOIN dbms_berita.author au ON aa.author_id = au.id
JOIN dbms_berita.article_category ac ON a.id =ac.article_id
JOIN dbms_berita.category c ON ac.category_id = c.id";


$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Berita Hari Ini</title>
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="height: 100px; display: flex;">
    <main id='main-content'>
      <div id='profil-wrapper' style='display :flex; flex-direction:row;'>
        <img src="asset/logo.jpg" class="logo" style="width:70px;padding: 10px;">
        <div id='text-wrapper' style='display: flex; flex-direction:column'>
          <h4 style="color: #fff;">Spot Instagramable di Malang Raya</h4>
          <h5 style="color: grey;">Menyuguhkan keindahan alam dan tempat bersejarah </h5>
        </div>
      </div>
  </nav>
  <!--navbar kedua -->
  <nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <div class="container-fluid">
      <div class="collapse navbar-collapse" id="navbarScroll">
        <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">

          <li class="nav-item">
            <a class="nav-link" style="color: #fff;" href="index.php">Home</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" style="color: #fff;" href="about.php">About</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" style="color: #fff;" href="contact.php">Contact</a>
          </li>

        </ul>
      </div>
  </nav>
  <?php
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      echo "<div class='pembungkusartikel'>";
      echo "<h1>" . $row['title'] . "</h1>";
      echo "<h5>" . $row['author_name'] . "</h5>";
      echo "<h6>kategori: " . $row['category_name'] . "</h6>";
      echo "<h7>" . $row['date'] . "</h7>";
      echo "<img class='article-image' src='" . htmlspecialchars("asset/" . $row['picture']) . "' alt='Article Image'>";
      echo "<p class='article-content'>" . substr(strip_tags($row['content']), 0, 200) . "...</p>";
      echo "<a href='detail.php?id=" . $row['id'] . "' class='read-more-btn'>Baca Selengkapnya</a>";
      echo "</div>";
    }
  } else {
    echo "0 result";
  }
  $conn->close();
  ?>

  <div class="footer">
    <footer>CopyRight : Dian 2025</footer>
  </div>
</body>

</html>