<div class="container">
    <div class="row">
        <?php
        // Fetch latest blogs
        $stmt = $pdo->query("SELECT * FROM newspaper ORDER BY id DESC LIMIT 3");
        $blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Display blog data
        foreach ($blogs as $blog) {
            echo '<div class="col-lg-4 col-md-6 col-sm-12 blog_item_col">'; // Ensure responsiveness
            echo '<div class="blog_item">';
            echo '<div class="blog_background" style="background-image:url(' . htmlspecialchars($blog['image_news']) . '); background-size: cover; background-position: center;"></div>';
            echo '<div class="blog_content d-flex flex-column align-items-center justify-content-center text-center">';
            echo '<h4 class="blog_title">' . htmlspecialchars($blog['news']) . '</h4>'; // Display the blog title
            echo '<span class="blog_meta">by admin | Dec 01, 2017</span>'; // Adjust date and author dynamically if available in DB
            echo '<a class="blog_more" href="blog.php?id=' . urlencode($blog['id']) . '">Read more</a>';
            echo '</div></div></div>';
        }
        ?>
    </div>
</div>