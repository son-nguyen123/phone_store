<div class="super_container">
    <header class="header trans_500">
        <div class="top_nav">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-right">
                        <div class="top_nav_right">
                            <ul class="top_nav_menu">
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="main_nav_container">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-right">
                        <div class="logo_container" style="text-align: left; padding: 10px;">
                            <a href="index.php" style="display: inline-block; margin-left: 0;">
                                <img src="logo.png" alt="Logo" style="height: auto; max-width: 20%; display: block;">
                            </a>
                        </div>

                        <nav class="navbar">
                            <ul class="navbar_menu">
                                <li><a href="index.php">Cửa Hàng</a></li>
                                <li><a href="iphone.php">Iphone</a></li>
                                <li><a href="samsung.php">Samsung</a></li>
                                <li><a href="xiaomi.php">Xiaomi</a></li>
                                <li><a href="realmes.php">Realmes</a></li>
                                <li><a href="phukien.php">Phụ Kiện</a></li>
                                <li><a href="hotro.php">Hổ Trợ</a></li>
                                <li><a href="lienhe.php">Liên Hệ</a></li>
                            </ul>
                            <ul class="navbar_user">
                                <li><a href="RealLogin.php"><i class="fa fa-search" aria-hidden="true"></i></a></li>
                                <li>
                                    <?php if (isset($_SESSION['username'])): ?>
                                        <a href="logged1.php">
                                            <i class="fa fa-user" aria-hidden="true"></i> <?php echo htmlspecialchars($_SESSION['username']); ?>
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
                            <div class="hamburger_container">
                                <i class="fa fa-bars" aria-hidden="true"></i>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="fs_menu_overlay"></div>
    <div class="hamburger_menu">
        <div class="hamburger_close"><i class="fa fa-times" aria-hidden="true"></i></div>
        <div class="hamburger_menu_content text-right">
            <ul class="menu_top_nav">
                <li class="menu_item has-children">
                    <a href="#">USD <i class="fa fa-angle-down"></i></a>
                    <ul class="menu_selection">
                        <li><a href="#">CAD</a></li>
                        <li><a href="#">AUD</a></li>
                        <li><a href="#">EUR</a></li>
                        <li><a href="#">GBP</a></li>
                    </ul>
                </li>
                <li class="menu_item has-children">
                    <a href="#">English <i class="fa fa-angle-down"></i></a>
                    <ul class="menu_selection">
                        <li><a href="#">French</a></li>
                        <li><a href="#">Italian</a></li>
                        <li><a href="#">German</a></li>
                        <li><a href="#">Spanish</a></li>
                    </ul>
                </li>
                <li class="menu_item has-children">
                    <a href="#">My Account <i class="fa fa-angle-down"></i></a>
                    <ul class="menu_selection">
                        <li><a href="#"><i class="fa fa-sign-in" aria-hidden="true"></i>Sign In</a></li>
                        <li><a href="#"><i class="fa fa-user-plus" aria-hidden="true"></i>Register</a></li>
                    </ul>
                </li>
                <li class="menu_item"><a href="#">Home</a></li>
                <li class="menu_item"><a href="#">Shop</a></li>
                <li class="menu_item"><a href="#">Promotion</a></li>
                <li class="menu_item"><a href="#">Pages</a></li>
                <li class="menu_item"><a href="#">Blog</a></li>
                <li class="menu_item"><a href="#">Contact</a></li>
            </ul>
        </div>
    </div>
</div>

<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">