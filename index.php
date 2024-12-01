<?php
include 'db.php';

$productStmt = $pdo->query("SELECT * FROM products");
$products = $productStmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Colo Shop Template">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="plugins/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
    <link rel="stylesheet" href="styles/main_styles.css">
    <link rel="stylesheet" href="styles/responsive.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="icon" href="Favicon.ico" type="image/x-icon">
</head>

<body id="page-top">
    <?php include 'web_sections/navbar.php'; ?>
    <?php include 'web_sections/banner.html'; ?>
    <?php include 'web_sections/benefit.html'; ?>
    <?php include 'web_sections/video.html'; ?>
    <?php include 'web_sections/ability.html'; ?>
    <?php include 'web_sections/comparison.php'; ?>
    <?php include '_add_to_card.php'; ?>

    <div class="new_arrivals">
        <div class="container">
            <div class="row text-center">
                <div class="col">
                    <h2 class="new_arrivals_title">Products</h2>
                </div>
            </div>
            <div class="row">
                <div class="col text-center">
                    <ul class="arrivals_grid_sorting clearfix button-group filters-button-group">
                        <li class="grid_sorting_button button active" data-filter="*">All</li>
                        <li class="grid_sorting_button button" data-filter=".iphone">Iphone</li>
                        <li class="grid_sorting_button button" data-filter=".samsung">Samsung</li>
                        <li class="grid_sorting_button button" data-filter=".xiaomi">Xiaomi</li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="product-grid" data-isotope='{ "itemSelector": ".product-item", "layoutMode": "fitRows" }'>
                        <?php foreach ($products as $product): ?>
                            <div class="product-item iphone">
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
                                            $<?= number_format($product['price'] * 0.80, 2); ?>
                                            <span><?= number_format($product['price'], 2); ?></span>
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

    <div class="blogs">
        <div class="container">
            <div class="row text-center">
                <div class="col">
                    <h2>Latest Blogs</h2>
                </div>
            </div>
            <div class="row blogs_container">
                <?php for ($i = 1; $i <= 3; $i++): ?>
                    <div class="col-lg-4 blog_item_col">
                        <div class="blog_item">
                            <div class="blog_background" style="background-image:url(images/blog_<?= $i; ?>.jpg)"></div>
                            <div class="blog_content d-flex flex-column align-items-center justify-content-center text-center">
                                <h4 class="blog_title">Here are the trends I see coming this fall</h4>
                                <span class="blog_meta">by admin | Dec 01, 2017</span>
                                <a class="blog_more" href="#">Read more</a>
                            </div>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
    </div>

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