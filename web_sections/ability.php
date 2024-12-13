<section id="capabilities" class="py-5">
    <?php
    // Kết nối tới cơ sở dữ liệu SQLite
    try {
        $pdo = new PDO('sqlite:C:/xampp/htdocs/phone_store/phone_store.sqlite'); // Đảm bảo đường dẫn đúng
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Không thể kết nối tới cơ sở dữ liệu: " . $e->getMessage());
    }

    // Truy vấn để lấy dữ liệu từ bảng 'ability'
    $stmt = $pdo->query("SELECT title, description, image_url FROM ability");
    $abilities = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($abilities): ?>
        <div class="container position-relative">
            <!-- Scrollable Row -->
            <div id="scrollContainer" class="d-flex overflow-hidden" style="scroll-behavior: smooth;">
                <?php foreach ($abilities as $ability): ?>
                    <div class="boxRect position-relative me-2" style="background-image: url('<?php echo htmlspecialchars($ability['image_url']); ?>'); background-size: contain; background-position: center; background-repeat: no-repeat; min-width: 300px;">
                        <div class="content position-absolute bottom-0 start-0 p-3 text-white">
                            <h4><?php echo htmlspecialchars($ability['title']); ?></h4>
                            <p class="mb-0"><?php echo htmlspecialchars($ability['description']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <button id="scrollLeft" class="btn position-absolute top-50 start-0 translate-middle-y" 
            style="background-color: gray; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">
            &#9664;
            </button>
            <button id="scrollRight" class="btn position-absolute top-50 end-0 translate-middle-y" 
            style="background-color: gray; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">
            &#9654;
            </button>
        </div>
    <?php else: ?>
        <p>Không có tính năng nào để hiển thị.</p>
    <?php endif; ?>
</section>

<script>
const scrollContainer = document.getElementById('scrollContainer');
const scrollLeft = document.getElementById('scrollLeft');
const scrollRight = document.getElementById('scrollRight');

scrollLeft.addEventListener('click', () => {
    scrollContainer.scrollLeft -= 300;
});

scrollRight.addEventListener('click', () => {
    scrollContainer.scrollLeft += 300;
});
</script>
