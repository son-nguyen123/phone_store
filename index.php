<?php
include 'db.php';

// Lấy giá trị sắp xếp và lọc từ URL
$order = isset($_GET['order']) ? $_GET['order'] : '';
$brand_filter = isset($_GET['brand']) ? $_GET['brand'] : '';
$min_price = isset($_GET['min_price']) ? (float)$_GET['min_price'] : null;
$max_price = isset($_GET['max_price']) ? (float)$_GET['max_price'] : null;

// Khởi tạo câu lệnh cơ sở
$query = "SELECT * FROM products WHERE 1";

// Lọc theo thương hiệu
if ($brand_filter) {
    $query .= " AND brand = :brand";
}

// Lọc theo giá
if ($min_price !== null && $max_price !== null) {
    $query .= " AND (price * 0.80) BETWEEN :min_price AND :max_price";
} elseif ($min_price !== null) {
    $query .= " AND (price * 0.80) >= :min_price";
} elseif ($max_price !== null) {
    $query .= " AND (price * 0.80) <= :max_price";
}

// Xử lý sắp xếp
if ($order == 'low-high') {
    $query .= " ORDER BY price ASC";
} elseif ($order == 'high-low') {
    $query .= " ORDER BY price DESC";
}

// Chuẩn bị câu lệnh
$productStmt = $pdo->prepare($query);

// Gán giá trị cho các tham số
if ($brand_filter) {
    $productStmt->bindParam(':brand', $brand_filter, PDO::PARAM_STR);
}
if ($min_price !== null) {
    $productStmt->bindParam(':min_price', $min_price, PDO::PARAM_INT);
}
if ($max_price !== null) {
    $productStmt->bindParam(':max_price', $max_price, PDO::PARAM_INT);
}

// Thực thi truy vấn
$productStmt->execute();
$products = $productStmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SS</title>

    <!-- Thêm các liên kết CSS và JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="plugins/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
    <link rel="stylesheet" href="styles/main_styles.css">
    <link rel="stylesheet" href="styles/responsive.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/sortby.css">
    <link rel="stylesheet" href="css/comparison_website.css">
    <link rel="icon" href="Favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <style>
        .comparisonTableCustom { width: 100%; border-collapse: collapse; }
        .comparisonTableCustom th, .comparisonTableCustom td { border: 1px solid black; padding: 8px; text-align: left; }
        /* Đảm bảo chữ ẩn đi và chỉ hiện khi hover */
.boxRect .content {
    opacity: 0; /* Ẩn nội dung */
    transition: opacity 0.3s ease-in-out; /* Thêm hiệu ứng chuyển động khi hiển thị */
}

.boxRect:hover .content {
    opacity: 1; /* Hiển thị chữ khi hover */
}


    </style>
</head>
<body id="page-top">
    <?php include 'web_sections/navbar.php'; ?>
    <?php include 'web_sections/banner.html'; ?>
    <?php include 'web_sections/benefit.html'; ?>
    <?php include 'web_sections/video.php'; ?>
    <?php include 'web_sections/ability.php'; ?>
    <?php include 'web_sections/comparison.php'; ?>
    <?php include '_add_to_card.php'; ?>

    <div class="new_arrivals">
        <div class="container" style="margin-top: 1px;">
            <div class="text-center">
                <h2 class="section-heading text-uppercase rainbow">Products</h2>
            </div>

            <div class="sort-container">
                <span>Sắp xếp theo</span>
                <div class="sort-options">
                    <a href="?order=" class="sort-option <?= $order == '' ? 'active' : '' ?>">All</a>
                    <a href="?order=low-high" class="sort-option <?= $order == 'low-high' ? 'active' : '' ?>">Thấp đến cao</a>
                    <a href="?order=high-low" class="sort-option <?= $order == 'high-low' ? 'active' : '' ?>">Cao đến thấp</a>
                </div>
            </div>

            <div class="sort-container">
                <span>Chọn thương hiệu</span>
                <div class="sort-options">
                    <a href="?brand=" class="sort-option <?= $brand_filter == '' ? 'active' : '' ?>">All</a>
                    <a href="?brand=apple" class="sort-option <?= $brand_filter == 'apple' ? 'active' : '' ?>">Apple</a>
                    <a href="?brand=samsung" class="sort-option <?= $brand_filter == 'samsung' ? 'active' : '' ?>">Samsung</a>
                    <a href="?brand=xiaomi" class="sort-option <?= $brand_filter == 'xiaomi' ? 'active' : '' ?>">Xiaomi</a>
                </div>
            </div>

            <div class="sort-container">
                <span>Lọc theo giá</span>
                <form method="GET" class="price-filter-form">
                    <div class="d-flex">
                        <input type="number" name="min_price" placeholder="Min Price" value="<?= isset($min_price) ? $min_price : ''; ?>" class="form-control">
                        <span>-</span>
                        <input type="number" name="max_price" placeholder="Max Price" value="<?= isset($max_price) ? $max_price : ''; ?>" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Apply</button>
                </form>
            </div>

            <div class="row">
                <div class="col">
                    <div class="product-grid" data-isotope='{ "itemSelector": ".product-item", "layoutMode": "fitRows" }'>
                        <?php foreach ($products as $product): ?>
                            <div class="product-item <?= strtolower($product['brand']); ?>">
                                <div class="product discount product_filter">
                                    <div class="product_image">
                                        <a href="single.php?product_id=<?= $product['product_id']; ?>">
                                            <img src="<?= htmlspecialchars($product['image']); ?>" alt="<?= htmlspecialchars($product['name']); ?>" width="100" height="auto">
                                        </a>
                                    </div>
                                    <div class="favorite favorite_left"></div>
                                    <div class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center">
                                        <span>-$20</span>
                                    </div>
                                    <div class="product_info">
                                        <h6 class="product_name">
                                            <a href="single.php?product_id=<?= $product['product_id']; ?>"><?= htmlspecialchars($product['name']); ?></a>
                                        </h6>
                                        <div class="product_price">
                                            <?= number_format($product['price'] * 0.80, 0, ',', '.'); ?> VNĐ
                                            <span><?= number_format($product['price'], 0, ',', '.'); ?> VNĐ</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="red_button add_to_cart_button">
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="id" value="<?= $product['product_id']; ?>">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" style="border: none; color: inherit; cursor: pointer; background: transparent; width: 100%; height: 100%; text-align: center;">
                                            Add to Cart
                                        </button>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'web_sections/bestseller.php'; ?>

    <?php include 'web_sections/news.php'; ?>

    <div class="newsletter">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 text-center text-lg-left">
                    <h4>Newsletter</h4>
                    <p>Subscribe to our newsletter and get 20% off your first purchase</p>
                </div>
                <div class="col-lg-6">
                    <form action="post">
                        <div class="newsletter_form d-flex flex-md-row flex-column align-items-center justify-content-lg-end justify-content-center">
                            <input id="newsletter_email" type="email" placeholder="Your email" required>
                            <button id="newsletter_submit" type="submit" class="newsletter_submit_btn trans_300">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include 'web_sections/footer.php'; ?>

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.owl-carousel').owlCarousel({
                loop: true,
                nav: true,
                responsive: {
                    0: { items: 1 },
                    768: { items: 3 },
                    1024: { items: 5 }
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="plugins/Isotope/isotope.pkgd.min.js"></script>
    <script src="plugins/easing/easing.js"></script>
    <script src="scrolledPosition.js"></script>
</body>
</html>
