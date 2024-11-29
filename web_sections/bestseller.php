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
                            <?php foreach ($products as $row): ?>
                                <div class="owl-item product_slider_item">
                                    <div class="product-item">
                                        <div class="product <?= $row['discount'] > 0 ? 'discount' : '' ?>">
                                            <div class="product_image">
                                                <img src="<?= $row['image'] ?>" alt="">
                                            </div>
                                            <?php if ($row['discount'] > 0): ?>
                                                <div class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center">
                                                    <span>-$<?= $row['discount'] ?></span>
                                                </div>
                                            <?php endif; ?>
                                            <div class="product_info">
                                                <h6 class="product_name">
                                                    <a href="single.php?product_id=<?= $row['product_id'] ?>"><?= htmlspecialchars($row['name']) ?></a>
                                                </h6>
                                                <div class="product_price">
                                                    $<?= $row['price'] ?>
                                                    <?php if ($row['discount'] > 0): ?>
                                                        <span>$<?= $row['original_price'] ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
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
</section>