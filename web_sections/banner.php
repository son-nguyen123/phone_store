<?php
// Kết nối tới cơ sở dữ liệu SQLite
try {
    $pdo = new PDO('sqlite:C:/xampp/htdocs/phone_store/phone_store.sqlite'); // Đường dẫn tới tệp SQLite
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Không thể kết nối tới cơ sở dữ liệu: " . $e->getMessage());
}

// Truy vấn để lấy dữ liệu từ bảng 'banners'
try {
    $stmt = $pdo->query("SELECT image_path, alt_text, slide_order, active FROM banners ORDER BY slide_order ASC");
    $banners = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Lỗi khi truy vấn dữ liệu: " . $e->getMessage());
}
?>

<div class="banner">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 p-0">
                <div class="card card-raised card-carousel">
                    <div id="carouselindicators" class="carousel slide" data-bs-ride="carousel" data-interval="3000">
                        <ol class="carousel-indicators">
                            <?php foreach ($banners as $index => $banner): ?>
                                <li data-target="#carouselindicators" data-slide-to="<?= $index ?>" class="<?= $banner['active'] ? 'active' : '' ?>"></li>
                            <?php endforeach; ?>
                        </ol>
                        <div class="carousel-inner">
                            <?php foreach ($banners as $index => $banner): ?>
                                <div class="carousel-item <?= $banner['active'] ? 'active' : '' ?>">
                                    <img class="d-block w-100" src="<?= htmlspecialchars($banner['image_path']); ?>" alt="<?= htmlspecialchars($banner['alt_text']); ?>">
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <a class="carousel-control-prev" href="#carouselindicators" role="button" data-slide="prev" data-abc="true">
                            <i class="fa fa-chevron-left"></i>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselindicators" role="button" data-slide="next" data-abc="true">
                            <i class="fa fa-chevron-right"></i>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
