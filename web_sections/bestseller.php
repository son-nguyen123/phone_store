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
                        <!-- Lọc và hiển thị sản phẩm giảm giá -->
                        <?php foreach ($products as $product): ?>
                            <?php if (!empty($product['sale_price']) || !empty($product['sale_percent'])): ?>
                                <div class="owl-item product_slider_item">
                                    <div class="product-item">
                                        <div class="product <?= $product['state'] === 'sale' ? 'discount' : ''; ?>">
                                            <div class="product_image">
                                                <!-- Hiển thị hình ảnh sản phẩm -->
                                                <a href="single.php?product_id=<?= $product['product_id']; ?>">
                                                    <img src="<?= htmlspecialchars($product['image']); ?>" alt="<?= htmlspecialchars($product['name']); ?>" width="100%" height="auto">
                                                </a>
                                            </div>

                                            <div class="product_info">
                                                <h6 class="product_name">
                                                    <a href="single.php?product_id=<?= $product['product_id']; ?>"><?= htmlspecialchars($product['name']); ?></a>
                                                </h6>

                                                <!-- Hiển thị giá -->
                                                <div class="product_price">
                                                    <?php if (!empty($product['sale_price'])): ?>
                                                        <?= number_format($product['sale_price'], 0, ',', '.'); ?> VNĐ
                                                        <span><?= number_format($product['price'], 0, ',', '.'); ?> VNĐ</span>
                                                    <?php elseif (!empty($product['sale_percent'])): ?>
                                                        <?= number_format($product['price'] * (1 - $product['sale_percent'] / 100), 0, ',', '.'); ?> VNĐ
                                                        <span><?= number_format($product['price'], 0, ',', '.'); ?> VNĐ</span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
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
