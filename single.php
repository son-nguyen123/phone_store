<?php
include 'db.php';

$productId = (int)($_GET['product_id'] ?? 1);

$query = "SELECT * FROM products WHERE product_id = :productId";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
$stmt->execute();
$product = $stmt->fetch(PDO::FETCH_ASSOC) ?: [
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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Colo Shop Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Single Product</title>
    <link rel="stylesheet" href="styles/bootstrap4/bootstrap.min.css">
    <link rel="stylesheet" href="plugins/font-awesome-4.7.0/css/font-awesome.min.css">
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
        .long_description img {
            display: block;
            margin-left: auto;
            margin-right: auto;
            
        }
    </style>
</head>
<body>
    <div class="super_container">
        <?php include 'web_sections/navbar.php'; ?>
        <?php include '_add_to_card.php'; ?>

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
                                        <?php foreach (explode(' ', $product['other_images']) as $image): ?>
                                            <li><img src="<?= htmlspecialchars($image) ?>" data-image="<?= htmlspecialchars($product['image']) ?>"></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-9 image_col order-lg-2 order-1">
                                <div class="single_product_image">
                                    <div class="single_product_image_background" style="background-image:url(<?= htmlspecialchars($product['image']) ?>)"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="product_details">
                        <div class="product_details_title">
                            <h2><?= htmlspecialchars($product['name']) . ' ' . htmlspecialchars($product['storage']); ?></h2>
                            <p><?= nl2br(htmlspecialchars($product['description'])) ?></p>
                        </div>
                        <div class="free_delivery d-flex flex-row align-items-center justify-content-center">
                            <span class="ti-truck"></span><span>free delivery</span>
                        </div>
                        <div class="original_price"><?= formatPrice($product['price']) ?></div>
                        <div class="product_price"><?= formatPrice($product['discount']) ?></div>
                        <div class="quantity d-flex flex-column flex-sm-row align-items-sm-center">
                            <span>Quantity:</span>
                            <div class="quantity_selector">
                                <span class="minus"><i class="fa fa-minus"></i></span>
                                <span id="quantity_value">1</span>
                                <span class="plus"><i class="fa fa-plus"></i></span>
                            </div>

                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $product['product_id'] ?>">
                                <input type="hidden" id="quantity_input" name="quantity" value="1">
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
<!--this code includes tab description-->
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
                                <div class="long_description"><?= $product['long_description'] ?></div>
                            </div>
                        </div>

                        <div id="tab_2" class="tab_container">
                            <div class="row">
                                <div class="col additional_info_col">
                                    <div class="tab_title additional_info_title">
                                        <h4>Additional Information</h4>
                                    </div>
                                    <table>
                                        <?php foreach ($product as $key => $value): ?>
                                            <?php if (in_array($key, ['screen_size', 'screen_technology', 'rear_camera', 'front_camera', 'chipset', 'internal_memory', 'sim_type', 'screen_resolution'])): ?>
                                                <tr><th><?= ucfirst(str_replace('_', ' ', $key)) ?>:</th><td><?= htmlspecialchars($value) ?></td></tr>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
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
<!--end-->
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

            const quantityValueElement = document.getElementById("quantity_value");
            const minusButton = document.querySelector(".minus");
            const plusButton = document.querySelector(".plus");
            let quantity = 1;

            minusButton.addEventListener("click", function () {
                if (quantity > 1) {
                    quantity--;
                    quantityValueElement.textContent = quantity;
                }
            });

            plusButton.addEventListener("click", function () {
                quantity++;
                quantityValueElement.textContent = quantity;
            });

            const addToCartForm = document.querySelector("form");
            const quantityInput = document.getElementById("quantity_input");

            addToCartForm.addEventListener("submit", function () {
                quantityInput.value = quantity;
            });
        });
    </script>
</body>
</html>