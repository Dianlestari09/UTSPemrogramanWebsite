<?php
if (isset($_POST['page'])) {
    include 'Pagination.php';
    include '../config/koneksi.php';

    $start = !empty($_POST['page']) ? (int)$_POST['page'] : 0;
    $limit = 3;

    // Get number of rows
    $queryNum = $mysqli->query("SELECT COUNT(*) as postNum FROM article");
    $resultNum = $queryNum->fetch_assoc();
    $rowCount = $resultNum['postNum'];

    // Initialize pagination class
    $pagConfig = [
        'baseURL' => 'lib/getData.php',
        'totalRows' => $rowCount,
        'currentPage' => $start,
        'perPage' => $limit,
        'contentDiv' => 'posts_content'
    ];
    $pagination = new Pagination($pagConfig);

    // Get rows
    $query = $mysqli->query("SELECT 
        article.id, 
        article.title, 
        article.picture, 
        article.date, 
        author.nickname 
        FROM article 
        INNER JOIN article_author ON article.id = article_author.article_id 
        INNER JOIN author ON article_author.author_id = author.id 
        ORDER BY article.date DESC 
        LIMIT $start,$limit");

    if ($query->num_rows > 0) { ?>
        <div class="posts_list">
            <?php while ($row = $query->fetch_assoc()) { 
                $postID = $row['id'];
            ?>
                <div class="list_item">
                    <a href="<?php echo $base_url . "detail.php?id=" . $postID . "&judul=" . strtolower(str_replace(" ", "-", $row['title'])); ?>">
                        <img src="<?php echo $base_url . "images/" . $row['picture']; ?>" class="img-responsive">
                        <h2><?php echo htmlspecialchars($row['title']); ?></h2>
                    </a>
                    <p>Oleh: <?php echo htmlspecialchars($row['nickname']); ?> | <?php echo $row['date']; ?></p>
                </div>
            <?php } ?>
        </div>
        <?php echo $pagination->createLinks(); ?>
    <?php }
}
?>