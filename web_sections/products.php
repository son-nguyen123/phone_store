<div class="new_arrivals">
    <div class="container" style="margin-top: 1px;">
        <div class="text-center">
            <h2 class="section-heading text-uppercase rainbow">Products</h2>
        </div>

        <!-- Sắp xếp và lọc theo giá -->
        <div class="sort-container">
            <span>Sắp xếp theo</span>
            <div class="sort-options">
                <a href="?order=" class="sort-option <?= $order == '' ? 'active' : '' ?>">All</a>
                <a href="?order=low-high" class="sort-option <?= $order == 'low-high' ? 'active' : '' ?>">Thấp đến cao</a>
                <a href="?order=high-low" class="sort-option <?= $order == 'high-low' ? 'active' : '' ?>">Cao đến thấp</a>
            </div>
        </div>

        <!-- Lọc theo thương hiệu -->
        <div class="sort-container">
            <span>Chọn thương hiệu</span>
            <div class="sort-options">
                <a href="?brand=" class="sort-option <?= $brand_filter == '' ? 'active' : '' ?>">All</a>
                <a href="?brand=apple" class="sort-option <?= $brand_filter == 'apple' ? 'active' : '' ?>">Apple</a>
                <a href="?brand=samsung" class="sort-option <?= $brand_filter == 'samsung' ? 'active' : '' ?>">Samsung</a>
                <a href="?brand=xiaomi" class="sort-option <?= $brand_filter == 'xiaomi' ? 'active' : '' ?>">Xiaomi</a>
            </div>
        </div>

        <!-- Lọc theo giá -->
        <div class="sort-container">
            <span>Lọc theo giá</span>
            <form method="GET" class="price-filter-form">
                <div class="d-flex">
                    <input type="number" name="min_price" placeholder="Min Price" value="<?= $min_price ?>" class="form-control">
                    <span>-</span>
                    <input type="number" name="max_price" placeholder="Max Price" value="<?= $max_price ?>" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary mt-2">Apply</button>
            </form>
        </div>

        <!-- Hiển thị sản phẩm -->
        <div class="row">
            <div class="col">
                <div class="product-grid" data-isotope='{ "itemSelector": ".product-item", "layoutMode": "fitRows" }'>
                    <?php foreach ($products as $product): ?>
                        <div class="product-item <?= strtolower($product['brand']); ?>">
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
