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
        .comparisonTableCustom {
            width: 100%;
            border-collapse: collapse;
        }

        .comparisonTableCustom th,
        .comparisonTableCustom td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        /* Đảm bảo chữ ẩn đi và chỉ hiện khi hover */
        .boxRect .content {
            opacity: 0;
            /* Ẩn nội dung */
            transition: opacity 0.3s ease-in-out;
            /* Thêm hiệu ứng chuyển động khi hiển thị */
        }

<<<<<<< HEAD
.boxRect:hover .content {
    opacity: 1; /* Hiển thị chữ khi hover */
}
.filters-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin: 20px 0;
            font-family: Arial, sans-serif;
        }

        /* Each filter container */
        .filter-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        /* Title of the filter section */
        .filter-title {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }

        /* Filter options (links) */
        .filter-options {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .filter-option {
            text-decoration: none;
            color: #666;  /* Tăng độ xám cho màu chữ */
            font-size: 14px;
            padding: 5px 15px;
            border-radius: 20px;
            background-color: #e0e0e0;  /* Tăng độ xám cho nền */
            transition: background-color 0.3s, color 0.3s;
        }

        .filter-option:hover {
            background-color: #007bff;
            color: #fff;
        }

        .filter-option.active {
            background-color: #007bff;
            color: #fff;
        }

        /* Price filter form */
        .price-filter-form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .price-inputs {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .form-control {
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 120px;
        }

        .form-control:focus {
            border-color: #007bff;
            outline: none;
        }

        .btn-apply {
            padding: 10px 15px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-apply:hover {
            background-color: #0056b3;
        }
         /* Căn giữa nút Xem thêm */
         .custom-container_tb {
            display: flex;
            justify-content: center;
            align-items: center;
          /* Chiếm toàn bộ chiều cao màn hình */
            flex-direction: column;
        }

        /* Nút Xem thêm dài 10cm */
        .custom-btn-view-more_tb {
            padding: 10px 40px;  /* Thêm padding trái phải để tạo chiều dài */
            background-color: #007bff;
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            display: inline-block;
            text-align: center;
            width: auto;  /* Giữ chiều rộng tự động */
            min-width: 10cm; /* Đảm bảo nút có chiều dài 10cm */
        }

        .custom-btn-view-more_tb:hover {
            background-color: #0056b3;
        }

        /* Khung nội dung (ẩn theo mặc định) */
        .custom-comparison-content_tb {
            display: none;
            margin-top: 20px;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            
            margin: 20px auto; /* Căn giữa theo chiều ngang */
        }

        /* Tùy chọn hiển thị nội dung */
        .custom-comparison-content_tb.show {
            display: block;
        }
        .comparisonSectionCustom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 20px auto;
        max-width: 800px; /* Giới hạn chiều rộng */
    }

    .comparisonSectionCustom div {
        position: relative;
        flex: 1;
        margin: 0 10px; /* Khoảng cách giữa 2 thanh */
    }

    .comparisonSectionCustom input[type="text"] {
        width: 100%;
        padding: 10px; /* Trả về padding đầy đủ */
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .comparisonTitleCustom {
        text-align: center;
        font-size: 24px; /* Làm nổi bật hơn */
        font-weight: bold;
        color: #333;
        margin-bottom: 20px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .comparisonTableCustom {
        width: 100%;
        max-width: 800px;
        margin: 20px auto;
        border-collapse: collapse;
        background-color: #ffffff;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
        font-family: Arial, sans-serif;
        font-size: 13px;
    }

    .comparisonTableCustom th {
        background-color: #4CAF50;
        color: #fff;
        font-weight: bold;
        text-align: center;
        padding: 10px;
        font-size: 14px;
        border-bottom: 2px solid #388E3C;
    }

    .comparisonTableCustom td {
        text-align: center;
        padding: 8px;
        font-size: 12px;
        border-bottom: 1px solid #f1f1f1;
        color: #555;
        word-break: break-word;
    }

    .comparisonTableCustom td:first-child {
        font-weight: bold;
        background-color: #f8f9fa;
        color: #333;
        text-align: left;
        padding-left: 8px;
    }

    .comparisonTableCustom img {
        width: 60px;
        height: auto;
        object-fit: cover;
        border-radius: 4px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
    }

    .comparisonTableCustom tbody tr:nth-child(odd) {
        background-color: #f9f9f9;
    }

    .comparisonTableCustom tbody tr:hover {
        background-color: #f1f3f5;
        transition: background-color 0.3s ease;
    }
=======
        .boxRect:hover .content {
            opacity: 1;
            /* Hiển thị chữ khi hover */
        }

        .banner {
            vertical-align: middle;
			display: flex;
			font-family: 'Calibri', sans-serif !important;
			background-color: #eee;
		}
>>>>>>> 49bdd43066f77c27fdf591607f3a8b3c25d65234

		.mt-100 {
			margin-top: 100px;
		}

		.carousel .carousel-indicators li {
			display: inline-block;
			width: 10px;
			height: 10px;
			text-indent: -99px;
			cursor: pointer;
			border: 1px solid #fff;
			background: #fff;
			border-radius: 2px;
		}

		.banner {
			margin-top: 11%;
		}

		.carousel-inner img {
			width: 100vw;
			height: auto;
			object-fit: cover;
		}
    </style>
</head>

<body id="page-top">
    <?php include 'web_sections/navbar.php'; ?>
    <?php include 'web_sections/banner.php'; ?>
    <?php include 'web_sections/benefit.html'; ?>
    <?php include 'web_sections/video.php'; ?>
    <?php include 'web_sections/ability.php'; ?>
    <?php include 'web_sections/comparison.php'; ?>
    <div class="custom-container_tb">
    <!-- Nút Xem thêm -->
    <button class="custom-btn-view-more_tb" onclick="toggleComparison()">Lựa Chọn So Sánh</button>

    <!-- Nội dung so sánh, sẽ ẩn ban đầu -->
    <div id="comparison" class="custom-comparison-content_tb">
        <?php include 'web_sections/comparison_choice.php'; ?>
    </div>
</div>
    <?php include '_add_to_card.php'; ?>

    <div class="new_arrivals">
        <div class="container" style="margin-top: 1px;">
            <div class="text-center">
                <h2 class="section-heading text-uppercase rainbow">Products</h2>
            </div>

            <div class="filters-container">
    <!-- Sort Options -->
    <div class="filter-container">
        <span class="filter-title">Sắp xếp theo</span>
        <div class="filter-options">
            <a href="?order=" class="filter-option <?= $order == '' ? 'active' : '' ?>">Tất cả</a>
            <a href="?order=low-high" class="filter-option <?= $order == 'low-high' ? 'active' : '' ?>">Thấp đến cao</a>
            <a href="?order=high-low" class="filter-option <?= $order == 'high-low' ? 'active' : '' ?>">Cao đến thấp</a>
        </div>
    </div>

    <!-- Brand Filter -->
    <div class="filter-container">
        <span class="filter-title">Chọn thương hiệu</span>
        <div class="filter-options">
            <a href="?brand=" class="filter-option <?= $brand_filter == '' ? 'active' : '' ?>">Tất cả</a>
            <a href="?brand=apple" class="filter-option <?= $brand_filter == 'apple' ? 'active' : '' ?>">Apple</a>
            <a href="?brand=samsung" class="filter-option <?= $brand_filter == 'samsung' ? 'active' : '' ?>">Samsung</a>
            <a href="?brand=xiaomi" class="filter-option <?= $brand_filter == 'xiaomi' ? 'active' : '' ?>">Xiaomi</a>
        </div>
    </div>

    <!-- Price Filter -->
    <div class="filter-container">
        <span class="filter-title">Lọc theo giá</span>
        <form method="GET" class="price-filter-form">
            <div class="price-inputs">
                <input type="number" name="min_price" placeholder="Min Price" value="<?= isset($min_price) ? $min_price : ''; ?>" class="form-control">
                <span>-</span>
                <input type="number" name="max_price" placeholder="Max Price" value="<?= isset($max_price) ? $max_price : ''; ?>" class="form-control">
            </div>
            <button type="submit" class="btn-apply">Áp dụng</button>
        </form>
    </div>
</div>

            <div class="row">
    <div class="col">
        <!-- Container hỗ trợ grid layout -->
        <div class="product-grid d-flex flex-wrap" data-isotope='{ "itemSelector": ".product-item", "layoutMode": "fitRows" }'>
            <?php foreach ($products as $product): ?>
                <!-- Mỗi sản phẩm được hiển thị trong cột -->
                <div class="product-item col-md-4 mb-4 <?= strtolower($product['brand']); ?>">
                    <div class="product product_filter">
                        <div class="product_image">
                            <a href="single.php?product_id=<?= $product['product_id']; ?>">
                                <img src="<?= htmlspecialchars($product['image']); ?>" alt="<?= htmlspecialchars($product['name']); ?>" width="100%" height="auto">
                            </a>
                        </div>

                        <!-- Hiển thị trạng thái 'new' -->
                        <?php if (strtolower($product['state']) == 'new'): ?>
                            <div class="product_bubble product_bubble_left product_bubble_green d-flex flex-column align-items-center">
                                <span>New</span>
                            </div>
                        <?php endif; ?>

                        <!-- Hiển thị giảm giá bằng sale_percent -->
                        <?php if ($product['sale_percent'] > 0): ?>
                            <div class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center">
                                <span>-<?= $product['sale_percent']; ?>%</span>
                            </div>
                        <?php endif; ?>

                        <div class="product_info">
                            <h6 class="product_name">
                                <a href="single.php?product_id=<?= $product['product_id']; ?>"><?= htmlspecialchars($product['name']); ?></a>
                            </h6>

                            <!-- Hiển thị giá -->
                            <div class="product_price">
                                <?php if ($product['sale_price'] > 0): ?>
                                    <?= number_format($product['sale_price'], 0, ',', '.'); ?> VNĐ
                                    <span><?= number_format($product['price'], 0, ',', '.'); ?> VNĐ</span>
                                <?php elseif ($product['sale_percent'] > 0): ?>
                                    <?= number_format($product['price'] * (1 - $product['sale_percent'] / 100), 0, ',', '.'); ?> VNĐ
                                    <span><?= number_format($product['price'], 0, ',', '.'); ?> VNĐ</span>
                                <?php else: ?>
                                    <?= number_format($product['price'], 0, ',', '.'); ?> VNĐ
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Nút "Add to Cart" -->
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

<?php include 'web_sections/bestseller.php'; ?>

						<!-- Slider Navigation -->

						<div class="product_slider_nav_left product_slider_nav d-flex align-items-center justify-content-center flex-column">
							<i class="fa fa-chevron-left" aria-hidden="true"></i>
						</div>
						<div class="product_slider_nav_right product_slider_nav d-flex align-items-center justify-content-center flex-column">
							<i class="fa fa-chevron-right" aria-hidden="true"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    <div class="newsletter">
        <div class="container">
            <div class="row">
                
            </div>
        </div>
    </div>
    </div>
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
    </div>
    <?php include 'web_sections/footer.php'; ?>

    

</div>
<script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.owl-carousel').owlCarousel({
                loop: true,
                nav: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    768: {
                        items: 3
                    },
                    1024: {
                        items: 5
                    }
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="plugins/Isotope/isotope.pkgd.min.js"></script>
    <script src="plugins/easing/easing.js"></script>
    <script src="scrolledPosition.js"></script>
<<<<<<< HEAD
    <script>
    // Hàm hiển thị và ẩn nội dung khi nhấn nút
    function toggleComparison() {
        var comparisonContent = document.getElementById('comparison');
        comparisonContent.classList.toggle('show');
    }
</script>
=======
    <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<!-- Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
>>>>>>> 49bdd43066f77c27fdf591607f3a8b3c25d65234

<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>

<script src="js/custom.js"></script>
</body>

</html>
