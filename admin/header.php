
<header class="site-header">
        <div class="header-container">
            <!-- Logo hoặc tên website -->
            <a href="admin.php" class="logo">Phone Store</a>

            <!-- Menu điều hướng -->
            <nav class="nav-links">
            <a href="banners_admin.php" onclick="setActive(this)">Banner</a>
                <a href="comments_admin.php" onclick="setActive(this)">Comment</a>
                <a href="comparison_admin.php" onclick="setActive(this)">Alter</a>
                <a href="newspaper_admin.php" onclick="setActive(this)">News</a>
                <a href="orders_admin.php" onclick="setActive(this)">Order</a>
                <a href="admin.php" onclick="setActive(this)">Product</a>
                <a href="users_admin.php" onclick="setActive(this)">User</a>
            </nav>
        </div>
    </header>

    <script>
        // Function để thêm class active khi click vào một mục
        function setActive(element) {
            // Xóa class 'active' khỏi tất cả các mục
            const links = document.querySelectorAll('.nav-links a');
            links.forEach(link => link.classList.remove('active'));

            // Thêm class 'active' vào mục hiện tại
            element.classList.add('active');
        }
    </script>