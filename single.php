<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phone_store";

// Create a new mysqli connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Example query to fetch product data
$sql = "SELECT * FROM iphone WHERE id = 1";  // Adjust ID to fetch the specific product
$result = $conn->query($sql);

// Fetch product data if available
$product = $result->num_rows > 0 ? $result->fetch_assoc() : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Single Product</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Colo Shop Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
    <link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
    <link rel="stylesheet" href="plugins/themify-icons/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="plugins/jquery-ui-1.12.1.custom/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="styles/single_styles.css">
    <link rel="stylesheet" type="text/css" href="styles/single_responsive.css">
    <style>
        .tab_container { display: none; }
        .tab_container.active { display: block; }
    </style>
</head>
<body>
    <div class="super_container">

        <!-- Header -->
        <?php include 'web_sections/navbar.php'; ?>

        <!-- Single Product Container -->
        <div class="container single_product_container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumbs d-flex flex-row align-items-center">
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>iPhone</a></li>
                            <li class="active"><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i><?php echo isset($product['name']) ? $product['name'] : 'Product'; ?></a></li>
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
                                        <li><img src="images/<?php echo isset($product['image_thumb1']) ? $product['image_thumb1'] : 'default-image.jpg'; ?>" data-image="images/<?php echo isset($product['image1']) ? $product['image1'] : 'default-image.jpg'; ?>"></li>
                                        <li><img src="images/<?php echo isset($product['image_thumb2']) ? $product['image_thumb2'] : 'default-image.jpg'; ?>" data-image="images/<?php echo isset($product['image2']) ? $product['image2'] : 'default-image.jpg'; ?>"></li>
                                        <li><img src="images/<?php echo isset($product['image_thumb3']) ? $product['image_thumb3'] : 'default-image.jpg'; ?>" data-image="images/<?php echo isset($product['image3']) ? $product['image3'] : 'default-image.jpg'; ?>"></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-9 image_col order-lg-2 order-1">
                                <div class="single_product_image">
                                    <div class="single_product_image_background" style="background-image:url(images/<?php echo isset($product['image1']) ? $product['image1'] : 'default-image.jpg'; ?>)"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="product_details">
                        <div class="product_details_title">
                            <h2><?php echo isset($product['name']) ? $product['name'] : 'Product Name'; ?> <?php echo isset($product['storage']) ? $product['storage'] : 'N/A'; ?></h2>
                            <p><?php echo isset($product['description']) ? $product['description'] : 'No description available.'; ?></p>
                        </div>
                        <div class="free_delivery d-flex flex-row align-items-center justify-content-center">
                            <span class="ti-truck"></span><span>free delivery</span>
                        </div>
                        <div class="original_price"><?php echo isset($product['original_price']) ? $product['original_price'] : '0'; ?> VND</div>
                        <div class="product_price"><?php echo isset($product['discounted_price']) ? $product['discounted_price'] : '0'; ?> VND</div>
                        <div class="quantity d-flex flex-column flex-sm-row align-items-sm-center">
                            <span>Quantity:</span>
                            <div class="quantity_selector">
                                <span class="minus"><i class="fa fa-minus" aria-hidden="true"></i></span>
                                <span id="quantity_value">1</span>
                                <span class="plus"><i class="fa fa-plus" aria-hidden="true"></i></span>
                            </div>
                            <div class="red_button add_to_cart_button"><a href="#">add to cart</a></div>
                            <div class="product_favorite d-flex flex-column align-items-center justify-content-center"></div>
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
                                <li class="tab" data-active-tab="tab_3"><span>Reviews (2)</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <!-- Tab Description -->
                        <!-- Tab Description -->
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
                                    <div class="tab_text_block">
                                        <h2><?php echo htmlspecialchars($product['name_2']); ?></h2>
                                        <p><?php echo nl2br(htmlspecialchars($product['description_2'])); ?></p>
                                    </div>
                                </div>
                                <div class="col-lg-5 offset-lg-2 desc_col">
                                    <div class="tab_image">
                                        <img src="images/<?php echo htmlspecialchars($product['image_desc2']); ?>" alt="">
                                    </div>
                                    <div class="tab_text_block">
                                        <h2><?php echo htmlspecialchars($product['name_3']); ?></h2>
                                        <p><?php echo nl2br(htmlspecialchars($product['description_3'])); ?></p>
                                    </div>
                                    <div class="tab_image desc_last">
                                        <img src="images/<?php echo htmlspecialchars($product['image_desc3']); ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--test-->
                        <!-- Tab Additional Info -->
                        <div id="tab_2" class="tab_container">
                            <div class="row">
                                <div class="col additional_info_col">
                                    <div class="tab_title additional_info_title">
                                        <h4>Additional Information</h4>
                                    </div>
                                    <table>
                                        <?php
                                        if ($product) { ?>
                                            <tr>
                                                <th style="width: 200px">Kích thước màn hình:</th>
                                                <td><?php echo htmlspecialchars($product['screen_size']); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Công nghệ màn hình:</th>
                                                <td><?php echo htmlspecialchars($product['screen_technology']); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Camera sau:</th>
                                                <td><?php echo htmlspecialchars($product['rear_camera']); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Camera trước:</th>
                                                <td><?php echo htmlspecialchars($product['front_camera']); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Chipset:</th>
                                                <td><?php echo htmlspecialchars($product['chipset']); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Bộ nhớ trong:</th>
                                                <td><?php echo htmlspecialchars($product['internal_memory']); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Thẻ SIM:</th>
                                                <td><?php echo htmlspecialchars($product['sim_type']); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Độ phân giải màn hình:</th>
                                                <td><?php echo htmlspecialchars($product['screen_resolution']); ?></td>
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

                        <!-- Tab Reviews -->
                        <div id="tab_3" class="tab_container">
                            <div class="row">
                                <div class="col">
                                    <h4>Reviews</h4>
                                    <!-- Add your review section here -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php $conn->close(); ?>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const tabs = document.querySelectorAll(".tab");
            const tabContainers = document.querySelectorAll(".tab_container");

            tabs.forEach((tab) => {
                tab.addEventListener("click", function () {
                    // Remove active class from all tabs and containers
                    tabs.forEach((tab) => tab.classList.remove("active"));
                    tabContainers.forEach((container) => container.classList.remove("active"));

                    // Add active class to the clicked tab and corresponding container
                    tab.classList.add("active");
                    const activeTab = tab.getAttribute("data-active-tab");
                    document.getElementById(activeTab).classList.add("active");
                });
            });
        });
    </script>
</body>
</html>