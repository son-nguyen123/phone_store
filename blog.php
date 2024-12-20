<?php
// Kết nối tới SQLite
$pdo = new PDO('sqlite:phone_store.sqlite');

// Kiểm tra xem ID bài viết có được truyền vào không
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']); // Chuyển đổi ID sang số nguyên để tránh lỗi SQL injection

    // Lấy dữ liệu bài viết từ bảng newspaper
    $stmt = $pdo->prepare("SELECT * FROM newspaper WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $blog = $stmt->fetch(PDO::FETCH_ASSOC);

    // Nếu không tìm thấy bài viết, hiển thị thông báo lỗi
    if (!$blog) {
        die("Bài viết không tồn tại.");
    }
} else {
    die("ID bài viết không hợp lệ.");
}

// Lấy tiêu đề bài báo để hiển thị trên thẻ <title>
$title = htmlspecialchars($blog['news']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Colo Shop Template">
    <title><?= $title ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="plugins/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles/main_styles.css">
    <link rel="stylesheet" href="styles/responsive.css">
    <link rel="stylesheet" href="css/blog.css">
    <link rel="stylesheet" href="css/footer.css">
</head>

<body>
    <?php include 'web_sections/navbar.php'; ?>

    <div class="containershort">
        <!-- Phần bài viết chính -->
        <div class="main-content">
            <h1 style="text-align: center;"><?= htmlspecialchars($blog['news']) ?></h1>
            <div class="meta-info">
                <span>Ngày đăng: <?= htmlspecialchars($blog['time']) ?></span>
                <span>Tác giả: <?= htmlspecialchars($blog['author']) ?></span>
            </div>

            <!-- Hiển thị các hình ảnh và văn bản bổ sung từ others_image_news -->
            <?php
            $otherImages = json_decode($blog['others_image_news'], true);
            if ($otherImages && is_array($otherImages)):
                foreach ($otherImages as $item):
            ?>
                <div class="other-image-section">
                    <img src="<?= htmlspecialchars($item['image']) ?>" alt="Other Image" class="img-fluid">
                    <p><?= htmlspecialchars($item['text']) ?></p>
                </div>
            <?php
                endforeach;
            else:
                echo "<p>Không có hình ảnh bổ sung nào để hiển thị.</p>";
            endif;
            ?>
        </div>

        <!-- Phần cột bên phải -->
        <aside class="sidebar">
            <h2>Bài viết nổi bật</h2>
            <?php
            // Lấy bài viết khác để hiển thị trong phần "Bài viết nổi bật"
            $stmt = $pdo->query("SELECT id, image_news, news FROM newspaper WHERE id != $id ORDER BY id DESC LIMIT 5");
            $relatedBlogs = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($relatedBlogs as $relatedBlog):
            ?>
                <div class="sidebar-item">
                    <img src="<?= htmlspecialchars($relatedBlog['image_news']) ?>" alt="Image" class="img-fluid">
                    <a href="blog.php?id=<?= urlencode($relatedBlog['id']) ?>">
                        <?= htmlspecialchars($relatedBlog['news']) ?>
                    </a>
                </div>
            <?php endforeach; ?>
        </aside>
    </div>
    <?php include 'web_sections/footer.php'; ?>
</body>

</html>
