<?php
include 'db.php';

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $sql = "SELECT * FROM products WHERE product_id = ?";

    if ($stmt = $pdo->prepare($sql)) {
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->num_rows > 0 ? $result->fetch_assoc() : null;
        $stmt->close();
    }
} 

if ($product) {
    $product_name = htmlspecialchars($product['name']);
    $product_price = htmlspecialchars($product['price']);
} else {
    $product_name = 'Product';
    $product_price = '0';
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
                            <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>iPhone</a></li>
                            <li class="active"><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i><?php echo $product_name; ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-7">
                    <div class="single_product_pics">
                        <div class="row">
                            <div class="col-lg-3 thumbnails_col">
                                <div class="single_product_thumbnails">
                                    <ul>
                                        <li><img src="images/<?php echo htmlspecialchars($product['image_thumb1']); ?>" data-image="images/<?php echo htmlspecialchars($product['image1']); ?>"></li>
                                        <li><img src="images/<?php echo htmlspecialchars($product['image_thumb2']); ?>" data-image="images/<?php echo htmlspecialchars($product['image2']); ?>"></li>
                                        <li><img src="images/<?php echo htmlspecialchars($product['image_thumb3']); ?>" data-image="images/<?php echo htmlspecialchars($product['image3']); ?>"></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-9 image_col">
                                <div class="single_product_image">
                                    <div class="single_product_image_background" style="background-image:url(images/<?php echo htmlspecialchars($product['image1']); ?>)"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="product_details">
                        <div class="product_details_title">
                            <h2><?php echo $product_name; ?> <?php echo htmlspecialchars($product['storage']); ?></h2>
                            <p><?php echo htmlspecialchars($product['description']); ?></p>
                        </div>
                        <div class="free_delivery d-flex flex-row align-items-center justify-content-center">
                            <span class="ti-truck"></span><span>free delivery</span>
                        </div>
                        <div class="original_price"><?php echo htmlspecialchars($product['original_price']); ?> VND</div>
                        <div class="product_price"><?php echo htmlspecialchars($product['discounted_price']); ?> VND</div>
                        <div class="quantity d-flex flex-column flex-sm-row align-items-sm-center">
                            <span>Quantity:</span>
                            <div class="quantity_selector">
                                <span class="minus"><i class="fa fa-minus" aria-hidden="true"></i></span>
                                <span id="quantity_value">1</span>
                                <span class="plus"><i class="fa fa-plus" aria-hidden="true"></i></span>
                            </div>
                            <div class="red_button add_to_cart_button"><a href="#">add to cart</a></div>
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
                                <li class="tab" data-active-tab="tab_3"><span>Reviews</span></li>
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
                                        <h2><?php echo htmlspecialchars($product['name_1']); ?></h2>
                                        <p><?php echo nl2br(htmlspecialchars($product['description_1'])); ?></p>
                                    </div>
                                    <div class="tab_image">
                                        <img src="images/<?php echo htmlspecialchars($product['image_desc1']); ?>" alt="">
                                    </div>
                                </div>
                                <div class="col-lg-5 offset-lg-2 desc_col">
                                    <div class="tab_image">
                                        <img src="images/<?php echo htmlspecialchars($product['image_desc2']); ?>" alt="">
                                    </div>
                                    <div class="tab_text_block">
                                        <h2><?php echo htmlspecialchars($product['name_2']); ?></h2>
                                        <p><?php echo nl2br(htmlspecialchars($product['description_2'])); ?></p>
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
                                                <td><?php echo htmlspecialchars($product['screen_size']); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Chipset:</th>
                                                <td><?php echo htmlspecialchars($product['chipset']); ?></td>
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
        <?php $pdo->close(); ?>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const tabs = document.querySelectorAll(".tab");
            const tabContainers = document.querySelectorAll(".tab_container");

            tabs.forEach((tab) => {
                tab.addEventListener("click", function () {
                    tabs.forEach((tab) => tab.classList.remove("active"));
                    tabContainers.forEach((container) => container.classList.remove("active"));

                    tab.classList.add("active");
                    const activeTab = tab.getAttribute("data-active-tab");
                    document.getElementById(activeTab).classList.add("active");
                });
            });
        });
    </script>
</body>
</html>
