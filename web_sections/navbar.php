<?php session_start();?>

<div class="super_container">

    <!-- Header -->
    <header class="header trans_500">
        
        <!-- Top Navigation -->
        <div class="top_nav">
            <div class="container">
                <div class="row">
                   
                    <div class="col-md-6 text-right">
                        <div class="top_nav_right">
                            <ul class="top_nav_menu">
                                
                                <!-- Currency / Language / My Account -->
                                
                                
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Main Navigation -->
        <div class="main_nav_container">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-right">
                        <div class="logo_container">
                            <a href="#">SON<span></span></a>
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
                                <!-- Display user's account or sign-in link -->
<li>
    <?php if (isset($_SESSION['username'])): ?>
        <a href="logged1.php">
            <i class="fa fa-user" aria-hidden="true"></i> <?php echo htmlspecialchars($_SESSION['username']); ?>
        </a>
    <?php else: ?>
        <a href="RealLogin.php">
            <i class="fa fa-user" aria-hidden="true"></i> Sign In
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
                    <a href="#">
                        usd
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="menu_selection">
                        <li><a href="#">cad</a></li>
                        <li><a href="#">aud</a></li>
                        <li><a href="#">eur</a></li>
                        <li><a href="#">gbp</a></li>
                    </ul>
                </li>
                <li class="menu_item has-children">
                    <a href="#">
                        English
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="menu_selection">
                        <li><a href="#">French</a></li>
                        <li><a href="#">Italian</a></li>
                        <li><a href="#">German</a></li>
                        <li><a href="#">Spanish</a></li>
                    </ul>
                </li>
                <li class="menu_item has-children">
                    <a href="#">
                        My Account
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="menu_selection">
                        <li><a href="#"><i class="fa fa-sign-in" aria-hidden="true"></i>Sign In</a></li>
                        <li><a href="#"><i class="fa fa-user-plus" aria-hidden="true"></i>Register</a></li>
                    </ul>
                </li>
                <li class="menu_item"><a href="#">home</a></li>
                <li class="menu_item"><a href="#">shop</a></li>
                <li class="menu_item"><a href="#">promotion</a></li>
                <li class="menu_item"><a href="#">pages</a></li>
                <li class="menu_item"><a href="#">blog</a></li>
                <li class="menu_item"><a href="#">contact</a></li>
            </ul>
        </div>
    </div>
</div>
