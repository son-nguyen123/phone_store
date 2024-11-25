<?php
include 'db.php';

// Default product structure with all fields
$product = [
    'product_id' => 0,
    'name' => 'Product',
    'description' => 'No description available.',
    'price' => '0.00',
    'image' => 'default-image.jpg',
    'created_at' => '',
    'storage' => '',
    'original_price' => '0.00',
    'discounted_price' => '0.00',
    'image1' => 'default-image.jpg',
    'image2' => 'default-image.jpg',
    'image3' => 'default-image.jpg',
    'image_thumb1' => 'default-image.jpg',
    'image_thumb2' => 'default-image.jpg',
    'image_thumb3' => 'default-image.jpg',
    'name_1' => '',
    'name_2' => '',
    'name_3' => '',
    'description_1' => '',
    'description_2' => '',
    'description_3' => '',
    'image_desc1' => 'default-image.jpg',
    'image_desc2' => 'default-image.jpg',
    'image_desc3' => 'default-image.jpg',
    'screen_size' => 'N/A',
    'screen_technology' => 'N/A',
    'rear_camera' => 'N/A',
    'front_camera' => 'N/A',
    'chipset' => 'N/A',
    'internal_memory' => 'N/A',
    'sim_type' => 'N/A',
    'screen_resolution' => 'N/A',
    'video' => 'N/A'
];

// Fetch product details if product_id is set
if (isset($_GET['product_id']) && is_numeric($_GET['product_id'])) {
    $product_id = (int) $_GET['product_id'];
    $sql = "SELECT * FROM products WHERE product_id = ?";

    if ($stmt = $pdo->prepare($sql)) {
        $stmt->execute([$product_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $product = array_merge($product, $result);
        }
    }
}

// Escape function for safe output
function escape($value) {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo escape($product['name']); ?> - Single Product</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles/bootstrap4/bootstrap.min.css">
    <link rel="stylesheet" href="plugins/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
    <link rel="stylesheet" href="styles/single_styles.css">
    <link rel="stylesheet" href="styles/single_responsive.css">
    <style>
        .tab_container { display: none; }
        .tab_container.active { display: block; }
    </style>
</head>
<body>
    <div class="super_container">
        <?php include 'web_sections/navbar.php'; ?>

        <!-- Product Details Section -->
        <div class="container single_product_container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumbs d-flex flex-row align-items-center">
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i> Category</a></li>
                            <li class="active"><a href="#"><i class="fa fa-angle-right"></i><?php echo escape($product['name']); ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Product Images -->
                <div class="col-lg-7">
                    <div class="single_product_pics">
                        <div class="row">
                            <div class="col-lg-3 thumbnails_col">
                                <div class="single_product_thumbnails">
                                    <ul>
                                        <li><img src="images/<?php echo escape($product['image_thumb1']); ?>" data-image="images/<?php echo escape($product['image1']); ?>"></li>
                                        <li><img src="images/<?php echo escape($product['image_thumb2']); ?>" data-image="images/<?php echo escape($product['image2']); ?>"></li>
                                        <li><img src="images/<?php echo escape($product['image_thumb3']); ?>" data-image="images/<?php echo escape($product['image3']); ?>"></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-9 image_col">
                                <div class="single_product_image">
                                    <div class="single_product_image_background" style="background-image:url(images/<?php echo escape($product['image1']); ?>)"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product Details -->
                <div class="col-lg-5">
                    <div class="product_details">
                        <div class="product_details_title">
                            <h2><?php echo escape($product['name']); ?></h2>
                            <p><?php echo escape($product['description']); ?></p>
                        </div>
                        <div class="product_price">
                            <?php if ($product['original_price'] > $product['discounted_price']) { ?>
                                <span class="original_price"><?php echo escape($product['original_price']); ?> VND</span>
                            <?php } ?>
                            <span class="discounted_price"><?php echo escape($product['discounted_price']); ?> VND</span>
                        </div>
                        <div class="free_delivery d-flex flex-row align-items-center justify-content-center">
                            <span class="ti-truck"></span><span>Free Delivery</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs Section -->
        <div class="tabs_section_container">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="tabs_container">
                            <ul class="tabs d-flex flex-sm-row flex-column align-items-left align-items-md-center justify-content-center">
                                <li class="tab active" data-active-tab="tab_1"><span>Description</span></li>
                                <li class="tab" data-active-tab="tab_2"><span>Additional Information</span></li>
                                <li class="tab" data-active-tab="tab_3"><span>Reviews</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div id="tab_1" class="tab_container active">
                            <h4>Description</h4>
                            <p><?php echo nl2br(escape($product['description_1'])); ?></p>
                        </div>
                        <div id="tab_2" class="tab_container">
                            <h4>Specifications</h4>
                            <ul>
                                <li>Screen Size: <?php echo escape($product['screen_size']); ?></li>
                                <li>Chipset: <?php echo escape($product['chipset']); ?></li>
                                <li>Internal Memory: <?php echo escape($product['internal_memory']); ?></li>
                            </ul>
                        </div>
                        <div id="tab_3" class="tab_container">
                            <h4>Reviews</h4>
                            <p>Coming soon...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Tabs -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const tabs = document.querySelectorAll(".tab");
            const tabContainers = document.querySelectorAll(".tab_container");

            tabs.forEach(tab => {
                tab.addEventListener("click", function () {
                    tabs.forEach(t => t.classList.remove("active"));
                    tabContainers.forEach(c => c.classList.remove("active"));

                    tab.classList.add("active");
                    document.getElementById(tab.dataset.activeTab).classList.add("active");
                });
            });
        });
    </script>
</body>
</html>