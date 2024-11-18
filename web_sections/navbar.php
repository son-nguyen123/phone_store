<?php session_start();?>
<!---->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Buttons</title>
    <style>
        /* CSS cho các nút */
        button {
            background-color: #4CAF50; /* Màu nền xanh lá */
            color: white; /* Màu chữ trắng */
            font-family: 'Arial', sans-serif; /* Font chữ */
            font-size: 16px; /* Kích thước chữ */
            border: none; /* Không viền */
            padding: 10px 20px; /* Khoảng cách trong */
            margin: 5px; /* Khoảng cách ngoài */
            cursor: pointer; /* Con trỏ chuột khi hover */
            border-radius: 15px; /* Bo góc */
        }

        button:hover {
            background-color: #45a049; /* Màu nền khi hover */
        }

        /* CSS cho các biểu tượng trong nút */
        button .icon {
            margin-right: 8px; /* Khoảng cách giữa biểu tượng và chữ */
        }
    </style>
<!---->

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
                                <!-- Display user's account or sign-in link -->
<li>
    <?php if (isset($_SESSION['username'])): ?>
        <a href="logged1.php">
            <i class="fa fa-user" aria-hidden="true"></i> <?php echo htmlspecialchars($_SESSION['username']); ?>
        </a>
    <?php else: ?>
        <a href="RealLogin.php">
            <i class="fa fa-user" aria-hidden="true"></i> <button>
            <span class="icon">🛒</span>
            <span>Giỏ hàng</span>
        </button>
        </a>
    <?php endif; ?>
</li>

                                <li class="checkout">
                                    <a href="cart.php">
                                        <i class="fa fa-shopping-cart" aria-hidden="true">
                                            <button>
            <span class="icon">🛒</span>
            <span>Giỏ hàng</span>
        </button>
                                        </i>
                                        <span id="checkout_items" class="checkout_items"></span>
                                    </a>
                                </li>
<!---->
<!---->

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

