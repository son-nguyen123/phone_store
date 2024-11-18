<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phone_store";

// Create mysqli connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check MySQLi connection
if ($conn->connect_error) {
    die("Connection failed (MySQLi): " . $conn->connect_error);
}

// Optional: Create a PDO connection
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    exit("Connection failed (PDO): " . $e->getMessage());
}

// Start session (if not started already)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// --- Fetch video URL from the database ---
$videoSql = "SELECT video FROM iphone WHERE id = 1"; // Thay id = 1 bằng ID cụ thể
$videoResult = $conn->query($videoSql);

$videoUrl = ""; // Biến để lưu URL video
if ($videoResult->num_rows > 0) {
    $row = $videoResult->fetch_assoc();
    $videoUrl = $row['video'];
} else {
    $videoUrl = "default_video.mp4"; // Video mặc định nếu không tìm thấy video
}

// --- Fetch product data from the database ---
$productSql = "SELECT * FROM iphone";
$productResult = $conn->query($productSql);

// Array to store the fetched products
$iphone = [];
if ($productResult->num_rows > 0) {
    while ($row = $productResult->fetch_assoc()) {
        $iphone[] = $row; // Add each product row to the products array
    }
}

// Close the MySQLi connection
$conn->close();
?>




<!DOCTYPE html>
<html lang="en">
<head>
<title>Colo Shop</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Colo Shop Template">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="styles/responsive.css">
<link rel="icon" type="image/x-icon" href="Favicon.ico" />
		<link href="c:\Users\Lenovo\OneDrive\Attachments\startbootstrap-agency-gh-pages\startbootstrap-agency-gh-pages">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        
<style>
	 .variations {
                border: 2px solid #ccc;
                border-radius: 12px;
                padding: 10px;
                width: 400px;
            }

            .boxRect {
                border: 1px solid #ccc;
                border-radius: 10px;
                padding: 20px;
                margin-bottom: 20px;
                width: 300px;
                height: 450px;
                transition: width 1s, height 1s;
            }

            .boxRect:hover {
                width: 320px;
                height: 480px;
            }

            .rainbow-text {
                background: -webkit-linear-gradient(10deg, red, blue);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }

            .video-container {
                position: relative;
                width: 100%;
                padding-top: 56.25%;
            }

            .video-container iframe {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                border: none;
            }
			.spacing-top {
    margin-top: 50px; /* Adjust value as needed */
}
.navbar-container {
    position: absolute;
    top: 10%; /* Adjust this percentage to control vertical position */
    left: 50%;
    transform: translateX(-50%);
}



	.navbar-nav {
            list-style: none;
            padding-bottom: 25%; /* Điều chỉnh khoảng cách phía dưới */
            margin: 0;
        }

        .navbar-nav .nav-item {
            display: inline-block;
            margin-right: 20px; /* Khoảng cách giữa các item */
        }

        .navbar-nav .nav-link {
            text-decoration: none;
            color: black;
        }

        .navbar-nav .nav-link:hover {
            color: blue;
        }
}
</style>
</head>

<body id="page-top">
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="#page-top"></a>
                
                <div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
    <li class="nav-item"><a class="nav-link" href="#services" style=" padding-bottom: 60%" >Services</a></li>
    <li class="nav-item"><a class="nav-link" href="#portfolio" style=" padding-bottom: 60%">Portfolio</a></li>
    <li class="nav-item"><a class="nav-link" href="#about" style=" padding-bottom: 60%">About</a></li>
    <li class="nav-item"><a class="nav-link" href="#team" style=" padding-bottom: 60%">Team</a></li>
    <li class="nav-item"><a class="nav-link" href="#contact" style=" padding-bottom: 60%">Contact</a></li>
</ul>
                </div>
            </div>
        </nav>
        
<?php include 'web_sections/navbar.php'; ?>
<h2 style="color:white">h</h2>
<h2 style="color:white">h</h2>
<h2 style="color:white">h</h2>
<?php include 'categoryMap.php'; ?>
	<!-- Slider -->
	 
	 <!-- Deal of the week -->
	 <section class="page-section" id="services">
	<div class="deal_ofthe_week">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-6">
					<div class="deal_ofthe_week_img">
						<img src="images/iphone-16.png" alt="">
					</div>
				</div>
				<div class="col-lg-6 text-right deal_ofthe_week_col">
					<div class="deal_ofthe_week_content d-flex flex-column align-items-center float-right">
						<div class="section_title">
							<h2>Deal Of The Week</h2>
						</div>
						<ul class="timer">
							<li class="d-inline-flex flex-column justify-content-center align-items-center">
								<div id="day" class="timer_num">03</div>
								<div class="timer_unit">Day</div>
							</li>
							<li class="d-inline-flex flex-column justify-content-center align-items-center">
								<div id="hour" class="timer_num">15</div>
								<div class="timer_unit">Hours</div>
							</li>
							<li class="d-inline-flex flex-column justify-content-center align-items-center">
								<div id="minute" class="timer_num">45</div>
								<div class="timer_unit">Mins</div>
							</li>
							<li class="d-inline-flex flex-column justify-content-center align-items-center">
								<div id="second" class="timer_num">23</div>
								<div class="timer_unit">Sec</div>
							</li>
						</ul>
						<div class="red_button deal_ofthe_week_button"><a href="#">shop now</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</section>
	<!-- Benefit -->

	<div class="benefit">
		<div class="container">
			<div class="row benefit_row">
				<div class="col-lg-3 benefit_col">
					<div class="benefit_item d-flex flex-row align-items-center">
						<div class="benefit_icon"><i class="fa fa-truck" aria-hidden="true"></i></div>
						<div class="benefit_content">
							<h6>free shipping</h6>
							<p>Suffered Alteration in Some Form</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 benefit_col">
					<div class="benefit_item d-flex flex-row align-items-center">
						<div class="benefit_icon"><i class="fa fa-money" aria-hidden="true"></i></div>
						<div class="benefit_content">
							<h6>cach on delivery</h6>
							<p>The Internet Tend To Repeat</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 benefit_col">
					<div class="benefit_item d-flex flex-row align-items-center">
						<div class="benefit_icon"><i class="fa fa-undo" aria-hidden="true"></i></div>
						<div class="benefit_content">
							<h6>45 days return</h6>
							<p>Making it Look Like Readable</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 benefit_col">
					<div class="benefit_item d-flex flex-row align-items-center">
						<div class="benefit_icon"><i class="fa fa-clock-o" aria-hidden="true"></i></div>
						<div class="benefit_content">
							<h6>opening all week</h6>
							<p>8AM - 09PM</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
<!-- Portfolio Grid-->
<section class="page-section bg-light" id="portfolio">
<div class="container" style="margin-top: 30px;">
    <div class="text-center">
	<h2 class="section-heading text-uppercase">Sản phẩm vừa mới ra mắt</h2>
	<h3 class="section-subheading text-muted">IPHONE 16 PRO</h3>
    </div>
</div>


	<main>
	<section id="latest-model" class="py-4">
    <div class="container">
        <div class="video-container" style="border-radius: 45px; overflow: hidden;">
            <iframe 
                width="100%" 
                height="100%" 
                src="<?= htmlspecialchars($videoUrl) ?>" 
                title="Iphone Video" 
                allowfullscreen>
            </iframe>
        </div>
    </div>
</section>

	</main>
        </section>
	<!--test-->

	<div class="container" style="margin-top: 30px;">
    <div class="text-center">
        <h2 class="section-heading text-uppercase">Tính Năng</h2>
    </div>
</div>

	<section id="capabilities" class="py-5">
                <div class="container">
				

                    <div class="container row d-flex justify-content-center">
                        <div class="boxRect position-relative me-2" style="background-image: url('Images/Galaxy.jpg'); background-size: contain; background-position: center; background-repeat: no-repeat;">
                            <div class="content position-absolute bottom-0 start-0 p-3 text-white">
                                <h3></h3>
                                <p class="mb-0">Far enough to see the damn Galaxy.</p>
                            </div>
                        </div>

                        <div class="boxRect position-relative me-2" style="background-image: url('Images/Genshin.jpeg'); background-size: contain; background-position: center; background-repeat: no-repeat;">
                            <div class="content position-absolute bottom-0 start-0 p-3 text-white">
                                <h3>Super CPU</h3>
                                <p class="mb-0">Strong enough to grind Genshin Impact with your fat ass.</p>
                            </div>
                        </div>

                        <div class="boxRect position-relative me-2" style="background-image: url('Images/1000mAh.jpg'); background-size: contain; background-position: center; background-repeat: no-repeat;">
                            <div class="content position-absolute bottom-0 start-0 p-3 text-white">
                                <h3>10000000mAh Battery</h3>
                                <p class="mb-0">Last longer than you parents.</p>
                            </div>
                        </div>

                        <div class="boxRect position-relative" style="background-image: url('Images/Plants.jpg'); background-size: contain; background-position: center; background-repeat: no-repeat;">
                            <div class="content position-absolute bottom-0 start-0 p-3 text-white">
                                <h3>Biodegradable</h3>
                                <p class="mb-0">It will explodes in anytime to kill you and save the environment.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
			<!--test-->
			<section class="page-section bg-light" id="about">
			<div class="container" style="margin-top: 1px;">
    <div class="text-center">
        <h2 class="section-heading text-uppercase">Flagship</h2>
		<h3 class="section-subheading text-muted">So Sánh Giữa Các Hãng </h3>
    </div>
</div>
                   
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>
                                        <img src="iPhone\iphone_15.jpg" height="155px" /><br />
                                        iPong X
                                    </th>
                                    <th>
                                        <img src="iPhone\iphone_15.jpg" height="155px" /><br />
                                        iPhone 15 Pro Max
                                    </th>
                                    <th>
                                        <img src="iPhone\iphone_15.jpg" height="155px" /><br />
                                        Samsung Galaxy S24 Ultra
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><img src="Images/cpu.png" width="35px" /></td>
                                    <td>Pong Chip X100</td>
                                    <td>Apple A17 Pro</td>
                                    <td>Snapdragon 8 Gen 3</td>
                                </tr>
                                <tr>
                                    <td><img src="Images/ram.png" width="40px" /></td>
                                    <td>512GB</td>
                                    <td>6GB</td>
                                    <td>12GB</td>
                                </tr>
                                <tr>
                                    <td><img src="Images/gpu.png" width="40px" /></td>
                                    <td>RTX 4090Ti</td>
                                    <td>Apple GPU</td>
                                    <td>Adreno 750</td>
                                </tr>
                                <tr>
                                    <td><img src="Images/screen.png" width="40px" /></td>
                                    <td>6.7" Super XDR</td>
                                    <td>6.7" OLED</td>
                                    <td>6.8" Dynamic AMOLED</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
        </section>
		
            
	<!-- New Arrivals -->

	<div class="new_arrivals">
		<div class="container">
			<div class="row">
				<div class="col text-center">
					<div class="section_title new_arrivals_title">
						<h2>Products</h2>
					</div>
				</div>
			</div>
			<div class="row align-items-center">
				<div class="col text-center">
					<div class="new_arrivals_sorting">
						<ul class="arrivals_grid_sorting clearfix button-group filters-button-group">
							<li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center active is-checked" data-filter="*">all</li>
							<li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center" data-filter=".iphone">Iphone</li>
							<li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center" data-filter=".samsung">Samsung</li>
							<li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center" data-filter=".xiaomi">Xiaomi</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="row">
                <div class="col">


				<div class="product-grid" data-isotope='{ "itemSelector": ".product-item", "layoutMode": "fitRows" }'>
    <?php foreach ($iphone as $iphones): ?>
        <?php $imagePath = str_replace("C:\\xampp\\htdocs", "", $iphones["image1"]); ?>
        <div class="product-item iphone">
            <div class="product discount product_filter"> 
                <div class="product_image">
                    <!-- Link image to single.php with product ID -->
                    <a href="single.php?id=<?php echo $iphones['id']; ?>">
                        <img src="<?php echo $imagePath; ?>" alt="<?php echo htmlspecialchars($iphones['name']); ?>" width="100" height="auto">
                    </a>
                </div>
                <div class="favorite favorite_left"></div>
                <div class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center">
                    <span>-$20</span>
                </div>
                <div class="product_info">
                    <h6 class="product_name">
                        <!-- Link product name to single.php with product ID -->
                        <a href="single.php?id=<?php echo $iphones['id']; ?>"><?php echo htmlspecialchars($iphones['name']); ?></a>
                    </h6>
                    <div class="product_price">$<?php echo $iphones['original_price'] * (1 - 0.20); ?><span><?php echo $iphones['original_price']; ?></span></div>
                </div>
            </div>
            <div class="red_button add_to_cart_button"><a href="cart.php">add to cart</a></div>
        </div>
    <?php endforeach; ?>
</div>
			</div>
		</div>
	</div>

	
	
	<!-- Best Sellers -->

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

							<!-- Slide 1 -->

							<div class="owl-item product_slider_item">
								<div class="product-item">
									<div class="product discount">
										<div class="product_image">
											<img src="images/product_1.png" alt="">
										</div>
										<div class="favorite favorite_left"></div>
										<div class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center"><span>-$200</span></div>
										<div class="product_info">
											<h6 class="product_name"><a href="single.html">Fujifilm X100T 16 MP Digital Camera (Silver)</a></h6>
											<div class="product_price">$520.00<span>$590.00</span></div>
										</div>
									</div>
								</div>
							</div>

							<!-- Slide 2 -->

							<div class="owl-item product_slider_item">
								<div class="product-item iphone">
									<div class="product">
										<div class="product_image">
											<img src="images/product_2.png" alt="">
										</div>
										<div class="favorite"></div>
										<div class="product_bubble product_bubble_left product_bubble_green d-flex flex-column align-items-center"><span>new</span></div>
										<div class="product_info">
											<h6 class="product_name"><a href="single.html">Samsung CF591 Series Curved 27-Inch FHD Monitor</a></h6>
											<div class="product_price">$610.00</div>
										</div>
									</div>
								</div>
							</div>

							<!-- Slide 3 -->

							<div class="owl-item product_slider_item">
								<div class="product-item iphone">
									<div class="product">
										<div class="product_image">
											<img src="images/product_3.png" alt="">
										</div>
										<div class="favorite"></div>
										<div class="product_info">
											<h6 class="product_name"><a href="single.html">Blue Yeti USB Microphone Blackout Edition</a></h6>
											<div class="product_price">$120.00</div>
										</div>
									</div>
								</div>
							</div>

							<!-- Slide 4 -->

							<div class="owl-item product_slider_item">
								<div class="product-item accessories">
									<div class="product">
										<div class="product_image">
											<img src="images/product_4.png" alt="">
										</div>
										<div class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center"><span>sale</span></div>
										<div class="favorite favorite_left"></div>
										<div class="product_info">
											<h6 class="product_name"><a href="single.html">DYMO LabelWriter 450 Turbo Thermal Label Printer</a></h6>
											<div class="product_price">$410.00</div>
										</div>
									</div>
								</div>
							</div>

							<!-- Slide 5 -->

							<div class="owl-item product_slider_item">
								<div class="product-item iphone men">
									<div class="product">
										<div class="product_image">
											<img src="images/product_5.png" alt="">
										</div>
										<div class="favorite"></div>
										<div class="product_info">
											<h6 class="product_name"><a href="single.html">Pryma Headphones, Rose Gold & Grey</a></h6>
											<div class="product_price">$180.00</div>
										</div>
									</div>
								</div>
							</div>

							<!-- Slide 6 -->

							<div class="owl-item product_slider_item">
								<div class="product-item accessories">
									<div class="product discount">
										<div class="product_image">
											<img src="images/product_6.png" alt="">
										</div>
										<div class="favorite favorite_left"></div>
										<div class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center"><span>-$20</span></div>
										<div class="product_info">
											<h6 class="product_name"><a href="single.html">Fujifilm X100T 16 MP Digital Camera (Silver)</a></h6>
											<div class="product_price">$520.00<span>$590.00</span></div>
										</div>
									</div>
								</div>
							</div>

							<!-- Slide 7 -->

							<div class="owl-item product_slider_item">
								<div class="product-item iphone">
									<div class="product">
										<div class="product_image">
											<img src="images/product_7.png" alt="">
										</div>
										<div class="favorite"></div>
										<div class="product_info">
											<h6 class="product_name"><a href="single.html">Samsung CF591 Series Curved 27-Inch FHD Monitor</a></h6>
											<div class="product_price">$610.00</div>
										</div>
									</div>
								</div>
							</div>

							<!-- Slide 8 -->

							<div class="owl-item product_slider_item">
								<div class="product-item accessories">
									<div class="product">
										<div class="product_image">
											<img src="images/product_8.png" alt="">
										</div>
										<div class="favorite"></div>
										<div class="product_info">
											<h6 class="product_name"><a href="single.html">Blue Yeti USB Microphone Blackout Edition</a></h6>
											<div class="product_price">$120.00</div>
										</div>
									</div>
								</div>
							</div>

							<!-- Slide 9 -->

							<div class="owl-item product_slider_item">
								<div class="product-item men">
									<div class="product">
										<div class="product_image">
											<img src="images/product_9.png" alt="">
										</div>
										<div class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center"><span>sale</span></div>
										<div class="favorite favorite_left"></div>
										<div class="product_info">
											<h6 class="product_name"><a href="single.html">DYMO LabelWriter 450 Turbo Thermal Label Printer</a></h6>
											<div class="product_price">$410.00</div>
										</div>
									</div>
								</div>
							</div>

							<!-- Slide 10 -->

							<div class="owl-item product_slider_item">
								<div class="product-item men">
									<div class="product">
										<div class="product_image">
											<img src="images/product_10.png" alt="">
										</div>
										<div class="favorite"></div>
										<div class="product_info">
											<h6 class="product_name"><a href="single.html">Pryma Headphones, Rose Gold & Grey</a></h6>
											<div class="product_price">$180.00</div>
										</div>
									</div>
								</div>
							</div>
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
	<!-- Blogs -->

	<div class="blogs">
		<div class="container">
			<div class="row">
				<div class="col text-center">
					<div class="section_title">
						<h2>Latest Blogs</h2>
					</div>
				</div>
			</div>
			<div class="row blogs_container">
				<div class="col-lg-4 blog_item_col">
					<div class="blog_item">
						<div class="blog_background" style="background-image:url(images/blog_1.jpg)"></div>
						<div class="blog_content d-flex flex-column align-items-center justify-content-center text-center">
							<h4 class="blog_title">Here are the trends I see coming this fall</h4>
							<span class="blog_meta">by admin | dec 01, 2017</span>
							<a class="blog_more" href="#">Read more</a>
						</div>
					</div>
				</div>
				<div class="col-lg-4 blog_item_col">
					<div class="blog_item">
						<div class="blog_background" style="background-image:url(images/blog_2.jpg)"></div>
						<div class="blog_content d-flex flex-column align-items-center justify-content-center text-center">
							<h4 class="blog_title">Here are the trends I see coming this fall</h4>
							<span class="blog_meta">by admin | dec 01, 2017</span>
							<a class="blog_more" href="#">Read more</a>
						</div>
					</div>
				</div>
				<div class="col-lg-4 blog_item_col">
					<div class="blog_item">
						<div class="blog_background" style="background-image:url(images/blog_3.jpg)"></div>
						<div class="blog_content d-flex flex-column align-items-center justify-content-center text-center">
							<h4 class="blog_title">Here are the trends I see coming this fall</h4>
							<span class="blog_meta">by admin | dec 01, 2017</span>
							<a class="blog_more" href="#">Read more</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Newsletter -->

	<div class="newsletter">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="newsletter_text d-flex flex-column justify-content-center align-items-lg-start align-items-md-center text-center">
						<h4>Newsletter</h4>
						<p>Subscribe to our newsletter and get 20% off your first purchase</p>
					</div>
				</div>
				<div class="col-lg-6">
					<form action="post">
						<div class="newsletter_form d-flex flex-md-row flex-column flex-xs-column align-items-center justify-content-lg-end justify-content-center">
							<input id="newsletter_email" type="email" placeholder="Your email" required="required" data-error="Valid email is required.">
							<button id="newsletter_submit" type="submit" class="newsletter_submit_btn trans_300" value="Submit">subscribe</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Footer -->

	<?php include 'web_sections/footer.php'; ?>

</div>
<!-- Include scripts -->
<script src="js/owl.carousel.min.js"></script>
<script>
    $(document).ready(function () {
        $('.owl-carousel').owlCarousel({
            loop: true,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 3
                },
                1024: {
                    items: 5
                }
            }
        });
    });
</script>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="js/custom.js"></script>
<script>
    const wrapper = document.querySelector('.carousel-wrapper');
    let currentIndex = 0;

    document.querySelector('.carousel-control.left').onclick = () => {
        currentIndex = (currentIndex > 0) ? currentIndex - 1 : 3;
        wrapper.style.transform = `translateX(-${currentIndex * 100}%)`;
    };

    document.querySelector('.carousel-control.right').onclick = () => {
        currentIndex = (currentIndex < 3) ? currentIndex + 1 : 0;
        wrapper.style.transform = `translateX(-${currentIndex * 100}%)`;
    };
</script>
</body>

</html>
