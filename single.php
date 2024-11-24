<?php
include 'db.php';

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $query = "SELECT * FROM iphone WHERE id = :product_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        echo "<script>console.log(" . json_encode($product) . ");</script>";
    } else {
        echo "<script>console.log('No product found with id: " . $product_id . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Single Product</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    </style>
</head>
<body>
    <div class="super_container">
        <?php include 'web_sections/navbar.php'; ?>

        <div class="container single_product_container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumbs d-flex flex-row align-items-center">
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i>iPhone</a></li>
                            <li class="active"><a href="#"><i class="fa fa-angle-right"></i><?php echo htmlspecialchars($product['name'] ?? 'Product'); ?></a></li>
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
                                        <li><img src="images/<?php echo htmlspecialchars($product['image_thumb1'] ?? 'default-image.jpg'); ?>" data-image="images/<?php echo htmlspecialchars($product['image1'] ?? 'default-image.jpg'); ?>"></li>
                                        <li><img src="images/<?php echo htmlspecialchars($product['image_thumb2'] ?? 'default-image.jpg'); ?>" data-image="images/<?php echo htmlspecialchars($product['image2'] ?? 'default-image.jpg'); ?>"></li>
                                        <li><img src="images/<?php echo htmlspecialchars($product['image_thumb3'] ?? 'default-image.jpg'); ?>" data-image="images/<?php echo htmlspecialchars($product['image3'] ?? 'default-image.jpg'); ?>"></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-9 image_col order-lg-2 order-1">
                                <div class="single_product_image">
                                    <div class="single_product_image_background" style="background-image:url(images/<?php echo htmlspecialchars($product['image1'] ?? 'default-image.jpg'); ?>)"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="product_details">
                        <div class="product_details_title">
                            <h2><?php echo htmlspecialchars($product['name'] ?? 'Product Name'); ?> <?php echo htmlspecialchars($product['storage'] ?? 'N/A'); ?></h2>
                            <p><?php echo nl2br(htmlspecialchars($product['description'] ?? 'No description available.')); ?></p>
                        </div>
                        <div class="free_delivery d-flex flex-row align-items-center justify-content-center">
                            <span class="ti-truck"></span><span>free delivery</span>
                        </div>
                        <div class="original_price"><?php echo htmlspecialchars($product['original_price'] ?? '0'); ?> VND</div>
                        <div class="product_price"><?php echo htmlspecialchars($product['discounted_price'] ?? '0'); ?> VND</div>
                        <div class="quantity d-flex flex-column flex-sm-row align-items-sm-center">
                            <span>Quantity:</span>
                            <div class="quantity_selector">
                                <span class="minus"><i class="fa fa-minus"></i></span>
                                <span id="quantity_value">1</span>
                                <span class="plus"><i class="fa fa-plus"></i></span>
                            </div>
                            <div class="red_button add_to_cart_button"><a href="#">add to cart</a></div>
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
                                <div class="col-lg-5 desc_col">
                                    <div class="tab_title">
                                        <h4>Description</h4>
                                    </div>
                                    <div class="tab_text_block">
                                        <h2><?php echo htmlspecialchars($product['name_1'] ?? ''); ?></h2>
                                        <p><?php echo nl2br(htmlspecialchars($product['description_1'] ?? '')); ?></p>
                                    </div>
                                    <div class="tab_image">
                                        <img src="images/<?php echo htmlspecialchars($product['image_desc1'] ?? 'default-image.jpg'); ?>" alt="">
                                    </div>
                                </div>
                                <div class="col-lg-5 offset-lg-2 desc_col">
                                    <div class="tab_image">
                                        <img src="images/<?php echo htmlspecialchars($product['image_desc2'] ?? 'default-image.jpg'); ?>" alt="">
                                    </div>
                                    <div class="tab_text_block">
                                        <h2><?php echo htmlspecialchars($product['name_3'] ?? ''); ?></h2>
                                        <p><?php echo nl2br(htmlspecialchars($product['description_3'] ?? '')); ?></p>
                                    </div>
                                </div>
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
                                            <tr>
                                                <th>Screen Size:</th>
                                                <td><?php echo htmlspecialchars($product['screen_size'] ?? ''); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Screen Technology:</th>
                                                <td><?php echo htmlspecialchars($product['screen_technology'] ?? ''); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Rear Camera:</th>
                                                <td><?php echo htmlspecialchars($product['rear_camera'] ?? ''); ?></td>
                                            </tr>
                                        <?php } else { ?>
                                            <tr>
                                                <td colspan="2">No additional information available.</td>
                                            </tr>
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
        document.addEventListener("DOMContentLoaded", () => {
            const tabs = document.querySelectorAll(".tab");
            const tabContainers = document.querySelectorAll(".tab_container");

            tabs.forEach(tab => {
                tab.addEventListener("click", () => {
                    tabs.forEach(t => t.classList.remove("active"));
                    tabContainers.forEach(c => c.classList.remove("active"));

                    tab.classList.add("active");
                    document.getElementById(tab.getAttribute("data-active-tab")).classList.add("active");
                });
            });
        });
    </script>
</body>
</html>