<nav class="main trans_500 d-none d-lg-block">
    <div class="main_nav_container">
        <div class="logo_container">
            <a href="index.php" class="logo">SSHOP</a>
        </div>
        <div class="navbar-container">
            <nav class="navbar">
                <ul class="navbar_menu">
                    <li><a href="index.php">Cửa Hàng</a></li>
                    <li><a href="iphone.php">Sản phẩm</a></li>
                    <li><a href="samsung.php">Tin tức</a></li>
                    <li><a href="contact.php">Liên hệ</a></li>
                    <li><a href="contact.php">Về Chúng Tôi</a></li>
                </ul>
                <div class="search-bar">
                    <button id="searchBtn" class="search-btn">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                    <div class="search-container">
                        <input type="text" id="searchQuery" placeholder="Nhập sản phẩm cần tìm" onkeyup="searchComponents()">
                        <div id="searchDropdown" class="dropdown-results"></div>
                    </div>
                </div>
                <ul class="navbar_user">
                    <li>
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <a href="logged1.php">
                                <?php if (isset($_SESSION['profile_image']) && !empty($_SESSION['profile_image'])): ?>
                                    <img src="<?= htmlspecialchars($_SESSION['profile_image']); ?>" alt="User Avatar" class="user-avatar">
                                <?php else: ?>
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                <?php endif; ?>
                                <?= htmlspecialchars($_SESSION['username']); ?>
                            </a>
                        <?php else: ?>
                            <a href="RealLogin.php">
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </a>
                        <?php endif; ?>
                    </li>
                    <li class="checkout">
                        <a href="cart.php">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            <span id="checkout_items" class="checkout_items"></span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</nav>
<nav class="mobile-nav d-block d-lg-none">
    <div class="main_nav_container d-flex align-items-center">
        <div class="logo_container">
            <a href="index.php" class="logo">SSHOP</a>
        </div>
        <div class="navbar-container d-flex justify-content-center align-items-center">
            <div class="search-bar">
                <button id="mobileSearchBtn" class="search-btn">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
                <div class="search-container">
                    <input type="text" id="mobileSearchQuery" placeholder="Nhập sản phẩm cần tìm" onkeyup="searchComponents()">
                    <div id="mobileSearchDropdown" class="dropdown-results"></div>
                </div>
            </div>
            <ul class="navbar_user d-flex align-items-center">
                <li>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <a href="logged1.php">
                            <?php if (isset($_SESSION['profile_image']) && !empty($_SESSION['profile_image'])): ?>
                                <img src="<?= htmlspecialchars($_SESSION['profile_image']); ?>" alt="User Avatar" class="user-avatar">
                            <?php else: ?>
                                <i class="fa fa-user" aria-hidden="true"></i>
                            <?php endif; ?>
                        </a>
                    <?php else: ?>
                        <a href="RealLogin.php">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </a>
                    <?php endif; ?>
                </li>
                <li class="checkout">
                    <a href="cart.php">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        <span id="mobile_checkout_items" class="checkout_items"></span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
.main_nav_container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 15px;
}

.logo_container {
    margin-right: auto;
}

.navbar-container {
    margin-left: auto;
}

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
    list-style: none;
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

.user-avatar {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    margin-right: 8px;
}

.mobile-nav {
    padding: 10px 15px;
    background: #fff;
}

.mobile-nav .main_nav_container {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.mobile-nav-right {
    display: flex;
    align-items: center;
    gap: 15px;
}

.mobile-nav .search-container.expanded {
    width: 200px;
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
</style>

<script>
document.getElementById('searchBtn').addEventListener('click', function() {
    const searchContainer = document.querySelector('.search-container');
    searchContainer.classList.toggle('expanded');
    if (searchContainer.classList.contains('expanded')) {
        document.getElementById('searchQuery').focus();
    }
});

document.getElementById('mobileSearchBtn').addEventListener('click', function() {
    const searchContainer = document.querySelector('.mobile-nav .search-container');
    searchContainer.classList.toggle('expanded');
    if (searchContainer.classList.contains('expanded')) {
        document.getElementById('mobileSearchQuery').focus();
    }
});

function searchComponents() {
    const searchQuery = document.getElementById("searchQuery").value.trim();
    const mobileSearchQuery = document.getElementById("mobileSearchQuery").value.trim();
    const searchDropdown = document.getElementById("searchDropdown");
    const mobileSearchDropdown = document.getElementById("mobileSearchDropdown");
    const activeQuery = searchQuery || mobileSearchQuery;
    const activeDropdown = searchQuery ? searchDropdown : mobileSearchDropdown;

    if (activeQuery.length > 0) {
        activeDropdown.style.display = 'block';

        const xhr = new XMLHttpRequest();
        xhr.open("GET", "_search.php?search=" + encodeURIComponent(activeQuery), true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                try {
                    const response = JSON.parse(xhr.responseText);
                    let output = response.length === 0 ? 
                        "<div class='dropdown-item' disabled>No results found</div>" : 
                        response.map(product => `
                        <div class='dropdown-item' onclick='window.location.href="single.php?product_id=${encodeURIComponent(product.product_id)}"' >
                            <img src='${product.image}' alt='${product.name}' style='width: 60px; height: 60px; margin-right: 10px;'>
                            <div>
                                <strong>${product.name}</strong>
                                <span>${new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(product.price)}</span>
                            </div>
                        </div>`).join('');
                    activeDropdown.innerHTML = output;
                } catch (error) {
                    console.error("Error parsing JSON:", error);
                    activeDropdown.innerHTML = "<div class='dropdown-item' disabled>Invalid response from server</div>";
                }
            }
        };
        xhr.send();
    } else {
        searchDropdown.style.display = 'none';
        mobileSearchDropdown.style.display = 'none';
    }
}

document.addEventListener('click', function(event) {
    const searchQuery = document.getElementById('searchQuery');
    const mobileSearchQuery = document.getElementById('mobileSearchQuery');
    const searchDropdown = document.getElementById('searchDropdown');
    const mobileSearchDropdown = document.getElementById('mobileSearchDropdown');
    
    if (!searchQuery.contains(event.target) && !searchDropdown.contains(event.target)) {
        searchDropdown.style.display = 'none';
    }
    
    if (!mobileSearchQuery.contains(event.target) && !mobileSearchDropdown.contains(event.target)) {
        mobileSearchDropdown.style.display = 'none';
    }
});
</script>