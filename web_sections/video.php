<section class="page-section bg-light" style="padding-top:20px; margin-top:20px;" id="portfolio">
    <?php
    // Kết nối tới cơ sở dữ liệu SQLite
    try {
        $pdo = new PDO('sqlite:C:/xampp/htdocs/phone_store/phone_store.sqlite');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Không thể kết nối tới cơ sở dữ liệu: " . $e->getMessage());
    }

    // Truy vấn để lấy sản phẩm có state = 'new'
    $stmt = $pdo->query("SELECT name, video FROM products WHERE state = 'new' ORDER BY product_id DESC LIMIT 1");
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product):
        $productName = htmlspecialchars($product['name']);
        $productVideo = htmlspecialchars($product['video']);
    ?>

    <section class="page-section bg-light" style="padding-top:20px; margin-top:20px;" id="portfolio">
        <div class="container" style="margin-top: 30px;">
            <div class="text-center">
                <h2 class="section-heading text-uppercase rainbow">Sản phẩm vừa mới ra mắt</h2>
                <h3 class="section-subheading text-muted "><?php echo $productName; ?></h3>
            </div>
        </div>

        <main>
            <section id="latest-model" class="py-4">
                <div class="container">
                    <div class="video-container" style="border-radius: 45px; overflow: hidden;">
                        <iframe
                            width="100%"
                            height="100%"
                            src="<?php echo $productVideo; ?>"
                            title="<?php echo $productName; ?> Video"
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </section>
        </main>
    </section>

    <?php
    else:
        echo '<p>Không có sản phẩm nào để hiển thị.</p>';
    endif;
    ?>
</section>
