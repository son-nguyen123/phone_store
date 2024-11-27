<?php
include 'db.php';

$productId = isset($_GET['product_id']) ? (int)$_GET['product_id'] : 1;

$query = "SELECT * FROM products WHERE product_id = :productId";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
$stmt->execute();
$product = $stmt->fetch(PDO::FETCH_ASSOC);

$product = $product ?: [
    'name' => 'Product',
    'storage' => 'N/A',
    'description' => 'No description available.',
    'price' => 0,
    'discount' => 0,
    'image' => 'default-image.jpg',
    'other_images' => 'default-image.jpg',
    'long_description' => '',
    'screen_size' => '',
    'screen_technology' => '',
    'rear_camera' => '',
    'front_camera' => '',
    'chipset' => '',
    'internal_memory' => '',
    'sim_type' => '',
    'screen_resolution' => ''
];

function formatPrice($price) {
    return number_format($price) . ' VND';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Single Product</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Colo Shop Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles/bootstrap4/bootstrap.min.css">
    <link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
    <link rel="stylesheet" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
    <link rel="stylesheet" href="plugins/OwlCarousel2-2.2.1/animate.css">
    <link rel="stylesheet" href="plugins/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="plugins/jquery-ui-1.12.1.custom/jquery-ui.css">
    <link rel="stylesheet" href="styles/single_styles.css">
    <link rel="stylesheet" href="styles/single_responsive.css">
    <style>
        .tab_container { display: none; }
        .tab_container.active { display: block; }
    </style>
</head>
<body>
    <div class="super_container">
        <?php include 'web_sections/navbar.php'; include '_add_to_card.php'?>

        <div class="container single_product_container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumbs d-flex flex-row align-items-center">
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i>iPhone</a></li>
                            <li class="active"><a href="#"><i class="fa fa-angle-right"></i><?php echo htmlspecialchars($product['name']); ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-7">
                    <div class="single_product_pics">
                        <div class="row">
                            <div class="col-lg-3 thumbnails_col order-lg-1 order-2">
                                <div class="single_product_thumbnails">
                                    <ul>
                                        <?php
                                        $other_images = explode(' ', $product['other_images']);
                                        foreach ($other_images as $image) {
                                            echo '<li><img src="' . htmlspecialchars($image) . '" data-image="' . htmlspecialchars($product['image']) . '"></li>';
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-9 image_col order-lg-2 order-1">
                                <div class="single_product_image">
                                    <div class="single_product_image_background" style="background-image:url(<?php echo htmlspecialchars($product['image']); ?>)"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="product_details">
                        <div class="product_details_title">
                            <h2><?php echo htmlspecialchars($product['name']) . ' ' . htmlspecialchars($product['storage']); ?></h2>
                            <p><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
                        </div>
                        <div class="free_delivery d-flex flex-row align-items-center justify-content-center">
                            <span class="ti-truck"></span><span>free delivery</span>
                        </div>
                        <div class="original_price"><?php echo formatPrice($product['price']); ?></div>
                        <div class="product_price"><?php echo formatPrice($product['discount']); ?></div>
                        <div class="quantity d-flex flex-column flex-sm-row align-items-sm-center">
                            <span>Quantity:</span>
                            <div class="quantity_selector">
                                <span class="minus"><i class="fa fa-minus"></i></span>
                                <span id="quantity_value">1</span>
                                <span class="plus"><i class="fa fa-plus"></i></span>
                            </div>

                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $product['product_id']; ?>">
                                <button type="submit" class="red_button add_to_cart_button" style="border: none; color: inherit; cursor: pointer;">
                                    Add to Cart
                                </button>
                            </form>

                            <div class="product_favorite d-flex flex-column align-items-center justify-content-center"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tabs_section_container">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="tabs_container">
                            <ul class="tabs d-flex flex-sm-row flex-column align-items-left align-items-md-center justify-content-center">
                                <li class="tab active" data-active-tab="tab_1"><span>Description</span></li>
                                <li class="tab" data-active-tab="tab_2"><span>Additional Information</span></li>
                                <li class="tab" data-active-tab="tab_3"><span>Reviews (2)</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div id="tab_1" class="tab_container active">
                            <div class="row">
                                <div class="long_description"><?php echo $product['long_description']; ?></div>
                            </div>
                        </div>

                        <div id="tab_2" class="tab_container">
                            <div class="row">
                                <div class="col additional_info_col">
                                    <div class="tab_title additional_info_title">
                                        <h4>Additional Information</h4>
                                    </div>
                                    <table>
                                        <?php if ($product) { ?>
                                            <tr><th>Screen Size:</th><td><?php echo htmlspecialchars($product['screen_size']); ?></td></tr>
                                            <tr><th>Screen Technology:</th><td><?php echo htmlspecialchars($product['screen_technology']); ?></td></tr>
                                            <tr><th>Rear Camera:</th><td><?php echo htmlspecialchars($product['rear_camera']); ?></td></tr>
                                            <tr><th>Front Camera:</th><td><?php echo htmlspecialchars($product['front_camera']); ?></td></tr>
                                            <tr><th>Chipset:</th><td><?php echo htmlspecialchars($product['chipset']); ?></td></tr>
                                            <tr><th>Internal Memory:</th><td><?php echo htmlspecialchars($product['internal_memory']); ?></td></tr>
                                            <tr><th>SIM Type:</th><td><?php echo htmlspecialchars($product['sim_type']); ?></td></tr>
                                            <tr><th>Screen Resolution:</th><td><?php echo htmlspecialchars($product['screen_resolution']); ?></td></tr>
                                        <?php } else { ?>
                                            <tr><td colspan="2">No additional information available.</td></tr>
                                        <?php } ?>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div id="tab_3" class="tab_container">
                            <div class="row">
                                <div class="col">
                                    <h4>Reviews</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const tabs = document.querySelectorAll(".tab");
            const tabContainers = document.querySelectorAll(".tab_container");

            tabs.forEach((tab) => {
                tab.addEventListener("click", function () {
                    tabs.forEach((tab) => tab.classList.remove("active"));
                    tabContainers.forEach((container) => container.classList.remove("active"));

                    const activeTab = tab.getAttribute("data-active-tab");
                    document.getElementById(activeTab).classList.add("active");
                    tab.classList.add("active");
                });
            });
        });
    </script>
</body>
</html>