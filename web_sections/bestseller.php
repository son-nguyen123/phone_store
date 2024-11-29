<?php
include 'db.php';

$productStmt = $pdo->query("SELECT * FROM products");
$products = $productStmt->fetchAll();
?>
<section class="page-section bg-light" id="about">
<div class="best_sellers">
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <div class="section_title new_arrivals_title">
                    <h2>Best Sellers</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="product_slider_container">
                    <div class="owl-carousel owl-theme product_slider">
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <div class="owl-item product_slider_item">
                                <div class="product-item">
                                    <div class="product <?php echo ($row['discount'] > 0) ? 'discount' : ''; ?>">
                                        <div class="product_image">
                                            <img src="<?php echo $row['image']; ?>" alt="">
                                        </div>
                                        <?php if ($row['discount'] > 0) { ?>
                                            <div class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center">
                                                <span>-$<?php echo $row['discount']; ?></span>
                                            </div>
                                        <?php } ?>
                                        <div class="product_info">
                                            <h6 class="product_name">
                                                <a href="single.php?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a>
                                            </h6>
                                            <div class="product_price">
                                                $<?php echo $row['price']; ?>
                                                <?php if ($row['discount'] > 0) { ?>
                                                    <span>$<?php echo $row['original_price']; ?></span>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

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

<?php
// Close the database connection
mysqli_close($connection);
?>
</section>
