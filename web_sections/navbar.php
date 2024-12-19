<header class="header trans_500">
    <div class="main_nav_container" style="margin-right: 20px;>
        <div class="container" >
            <div class="row align-items-center" >
                <!-- Logo và menu bên trái -->
                <div class="col-lg-6" >
                    <div class="logo_container">
                    <a href="index.php" class="logo" style="margin-left: 100px; font-size: 32px;">SSHOP</a>

                    </div>
                    
                    <nav class="navbar" style=" margin-left: 20px; ">
                        <ul class="navbar_menu">
                            <li><a href="index.php">Cửa Hàng</a></li>
                            <li><a href="iphone.php">Sản phẩm</a></li>
                            <li><a href="samsung.php">Tin tức</a></li>
                            <li><a href="contact.php">Liên hệ</a></li>
                            <li><a href="contact.php">Về Chúng Tôi</a></li>
                        </ul>
                    </nav>
                </div>

                <!-- Tìm kiếm và giỏ hàng bên phải -->
                <div class="col-lg-6 d-flex justify-content-end align-items-center">
                    <div class="search-bar" style="margin-right: 10px;">
                        <button id="searchBtn" class="search-btn">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                        <div class="search-container">
                            <input
                                type="text"
                                id="searchQuery"
                                placeholder="Nhập sản phẩm cần tìm"
                                onkeyup="searchComponents()">
                            <div id="searchDropdown" class="dropdown-results"></div>
                        </div>
                    </div>
                    <ul class="navbar_user" style="margin-right: 120px;">
                        <li>
                            <?php if (isset($_SESSION['user_id'])): ?>
                                <a href="logged1.php">
                                    <?php if (isset($_SESSION['profile_image']) && !empty($_SESSION['profile_image'])): ?>
                                        <img src="<?= htmlspecialchars($_SESSION['profile_image']); ?>" alt="User Avatar" class="user-avatar">
                                    <?php else: ?>
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                    <?php endif; ?>
                                    <?php echo htmlspecialchars($_SESSION['username']); ?>
                                </a>
                            <?php else: ?>
                                <a href="RealLogin.php">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </a>
                            <?php endif; ?>
                        </li>
                        <li class="checkout" style="margin-left: 30px;">
                            <a href="cart.php">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <span id="checkout_items" class="checkout_items"></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>

<style>
    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        flex-wrap: wrap;
    }

    .navbar_menu {
        list-style: none;
        display: flex;
        padding: 0;
        margin: 0;
        flex-wrap: wrap;
        gap: 20px;
    }

    .navbar_menu li {
        margin: 0;
    }

    .navbar_menu li a {
        color: #333;
        font-size: 16px;
        text-decoration: none;
        padding: 10px;
        transition: color 0.3s ease;
    }

    .navbar_menu li a:hover {
        color: #ff6f61;
    }

    .navbar_user {
        display: flex;
        align-items: center;
        padding: 0;
        gap: 10px;
    }

    .search-bar {
        position: relative;
    }

    .search-container {
        display: inline-block;
        position: absolute;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 0;
        opacity: 0;
        transition: width 0.3s ease, opacity 0.3s ease;
    }

    .search-container input {
        width: 100%;
        padding: 8px 12px;
        border: 1px solid #ccc;
        border-radius: 25px;
        outline: none;
        font-size: 14px;
    }

    .search-btn {
        background-color: transparent;
        border: none;
        cursor: pointer;
        font-size: 16px;
        padding: 8px 12px;
        margin-right: 10px;
        border-radius: 25px;
        transition: background-color 0.3s ease;
    }

    .search-btn:hover {
        background-color: #f0f0f0;
    }

    .search-container.expanded {
        width: 400px;
        opacity: 1;
    }

    .dropdown-results {
        display: none;
        position: absolute;
        top: 40px;
        left: 0;
        right: 0;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 5px;
        z-index: 1000;
        max-height: 300px;
        overflow-y: auto;
    }

    .dropdown-item {
        padding: 10px;
        display: flex;
        align-items: center;
        cursor: pointer;
        text-align: left;
    }

    .dropdown-item img {
        margin-right: 10px;
        width: 60px;
        height: 60px;
    }

    .dropdown-item:hover {
        background-color: #f0f0f0;
    }

    .dropdown-item div {
        display: flex;
        flex-direction: column;
    }

    .dropdown-item strong {
        font-size: 14px;
        font-weight: bold;
    }

    .dropdown-item span {
        font-size: 12px;
        color: #888;
    }

    @media (max-width: 768px) {
        .navbar_menu {
            flex-direction: column;
            align-items: flex-start;
        }

        .search-btn {
            font-size: 14px;
        }
    }
    .user-avatar {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    margin-right: 8px;
}
</style> 

<script>
    document.getElementById('searchBtn').addEventListener('click', function() {
        const searchContainer = document.querySelector('.search-container');
        searchContainer.classList.toggle('expanded');
        if (searchContainer.classList.contains('expanded')) {
            document.getElementById('searchQuery').focus();
        }
    });

    function searchComponents() {
        const searchQuery = document.getElementById("searchQuery").value.trim();
        const searchDropdown = document.getElementById("searchDropdown");

        if (searchQuery.length > 0) {
            searchDropdown.style.display = 'block';

            const xhr = new XMLHttpRequest();
            xhr.open("GET", "_search.php?search=" + encodeURIComponent(searchQuery), true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    try {
                        const response = JSON.parse(xhr.responseText);
                        let output = response.length === 0 ?
                            "<div class='dropdown-item' disabled>No results found</div>" :
                            response.map(product => `
                            <div class='dropdown-item' onclick='window.location.href="single.php?product_id=${encodeURIComponent(product.product_id)}"'>
                                <img src='${product.image}' alt='${product.name}' style='width: 60px; height: 60px; margin-right: 10px;'>
                                <div>
                                    <strong>${product.name}</strong>
                                    <span>${new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(product.price)}</span>
                                </div>
                            </div>`).join('');
                        searchDropdown.innerHTML = output;
                    } catch (error) {
                        console.error("Error parsing JSON:", error);
                        searchDropdown.innerHTML = "<div class='dropdown-item' disabled>Invalid response from server</div>";
                    }
                }
            };
            xhr.send();
        } else {
            searchDropdown.style.display = 'none';
        }
    }

    document.addEventListener('click', function(event) {
        const searchQuery = document.getElementById('searchQuery');
        const searchDropdown = document.getElementById('searchDropdown');
        if (!searchQuery.contains(event.target) && !searchDropdown.contains(event.target)) {
            searchDropdown.style.display = 'none';
        }
    });
</script>