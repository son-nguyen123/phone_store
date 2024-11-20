<?php
include 'db.php';
session_start();

$productStmt = $pdo->query("SELECT * FROM products");
$iphones = $productStmt->fetchAll();

echo "<script>console.log(" . json_encode($iphones) . ");</script>";
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
	<link rel="stylesheet" type="text/css" href="styles.css">
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
			margin-top: 50px;
			/* Adjust value as needed */
		}

		.navbar-container {
			position: absolute;
			top: 10%;
			/* Adjust this percentage to control vertical position */
			left: 50%;
			transform: translateX(-50%);
		}



		.navbar-nav {
			list-style: none;
			padding-bottom: 25%;
			margin: 0;
		}

		.navbar-nav .nav-item {
			display: inline-block;
			margin-right: 20px;
			/* Khoảng cách giữa các item */
		}

		.navbar-nav .nav-link {
			text-decoration: none;
			color: black;
		}

		.navbar-nav .nav-link:hover {
			color: blue;
		}

		.rainbow {
			background: linear-gradient(to right, #0090f7, #ba62fc, #f2416b);
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
		}

		.banner {
			vertical-align: middle;
			display: flex;
			font-family: 'Calibri', sans-serif !important;
			background-color: #eee;
		}

		.mt-100 {
			margin-top: 100px;
		}

		.carousel .carousel-indicators li {
			display: inline-block;
			width: 10px;
			height: 10px;
			text-indent: -99px;
			cursor: pointer;
			border: 1px solid #fff;
			background: #fff;
			border-radius: 2px;
		}

		.banner {
			margin-top: 11%;
		}

		.carousel-inner img {
			width: 100vw;
			height: auto;
			object-fit: cover;
		}

		.carousel .carousel-indicators li {
			display: inline-block;
			width: 10px;
			height: 10px;
			text-indent: -99px;
			cursor: pointer;
			border: 1px solid #fff;
			background: #fff;
			border-radius: 2px;
		}

		table td {
			color: black;
		}
		
	</style>
</head>

<body id="page-top">
	<!-- Navigation-->
	<?php include 'web_sections/navbar.php'; ?>
	<!-- Slider -->
	<div class="banner">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12 p-0">
					<div class="card card-raised card-carousel">
						<div id="carouselindicators" class="carousel slide" data-ride="carousel" data-interval="3000">
							<ol class="carousel-indicators">
								<li data-target="#carouselindicators" data-slide-to="0" class=""></li>
								<li data-target="#carouselindicators" data-slide-to="1" class="active"></li>
								<li data-target="#carouselindicators" data-slide-to="2" class=""></li>
							</ol>
							<div class="carousel-inner">
								<div class="carousel-item active carousel-item-left">
									<img class="d-block w-100" src="images/iPhone-16-banner-1.png" alt="First slide">
								</div>
								<div class="carousel-item carousel-item-next carousel-item-left">
									<img class="d-block w-100" src="images/iPhone-16-banner-2.jpg" alt="Second slide">
								</div>
								<div class="carousel-item">
									<img class="d-block w-100" src="images/iPhone-16-banner-3.png" alt="Third slide">
								</div>
							</div>
							<a class="carousel-control-prev" href="#carouselindicators" role="button" data-slide="prev" data-abc="true">
								<i class="fa fa-chevron-left"></i>
								<span class="sr-only">Previous</span>
							</a>
							<a class="carousel-control-next" href="#carouselindicators" role="button" data-slide="next" data-abc="true">
								<i class="fa fa-chevron-right"></i>
								<span class="sr-only">Next</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

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
	<section class="page-section bg-light" style="padding-top:20px; margin-top:20px;" id="portfolio">
		<div class="container" style="margin-top: 30px;">
			<div class="text-center">
				<h2 class="section-heading text-uppercase rainbow">Sản phẩm vừa mới ra mắt</h2>
				<h3 class="section-subheading text-muted ">IPHONE 16 PRO</h3>
			</div>
		</div>


		<main>
			<section id="latest-model" class="py-4">
				<div class="container">
					<div class="video-container" style="border-radius: 45px; overflow: hidden;">
						<iframe
							width="100%"
							height="100%"
							src="images/Introducing-iPhone 16-Pro .mp4"
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
			<h2 class="section-heading text-uppercase rainbow">Tính Năng</h2>
		</div>
	</div>

	<section id="capabilities" class="py-5">
		<div class="container position-relative">
			<!-- Scrollable Row -->
			<div id="scrollContainer" class="d-flex overflow-hidden" style="scroll-behavior: smooth;">
				<!-- Item 1 -->
				<div class="boxRect position-relative me-2" style="background-image: url('Images/iphone_15.png'); background-size: contain; background-position: center; background-repeat: no-repeat; min-width: 300px;">
					<div class="content position-absolute bottom-0 start-0 p-3 text-white">
						<h3>Bướm joshi</h3>
						<p class="mb-0">Far enough to see the damn Galaxy.</p>
					</div>
				</div>
				<!-- Item 2 -->
				<div class="boxRect position-relative me-2" style="background-image: url('Images/iphone_15.png'); background-size: contain; background-position: center; background-repeat: no-repeat; min-width: 300px;">
					<div class="content position-absolute bottom-0 start-0 p-3 text-white">
						<h3>Bướm joshi</h3>
						<p class="mb-0">Far enough to see the damn Galaxy.</p>
					</div>
				</div>
				<!-- Item 3 -->
				<div class="boxRect position-relative me-2" style="background-image: url('Images/iphone_15.png'); background-size: contain; background-position: center; background-repeat: no-repeat; min-width: 300px;">
					<div class="content position-absolute bottom-0 start-0 p-3 text-white">
						<h3>Super CPU</h3>
						<p class="mb-0">Strong enough to grind Genshin Impact with your fat ass.</p>
					</div>
				</div>
				<!-- Item 4 -->
				<div class="boxRect position-relative me-2" style="background-image: url('Images/iphone_15.png'); background-size: contain; background-position: center; background-repeat: no-repeat; min-width: 300px;">
					<div class="content position-absolute bottom-0 start-0 p-3 text-white">
						<h3>10000000mAh Battery</h3>
						<p class="mb-0">Last longer than you parents.</p>
					</div>
				</div>
				<!-- Item 5 -->
				<div class="boxRect position-relative me-2" style="background-image: url('Images/iphone_15.png'); background-size: contain; background-position: center; background-repeat: no-repeat; min-width: 300px;">
					<div class="content position-absolute bottom-0 start-0 p-3 text-white">
						<h3>Biodegradable</h3>
						<p class="mb-0">It will explodes in anytime to kill you and save the environment.</p>
					</div>
				</div>
			</div>
			<!-- Left and Right Buttons -->
			<button id="scrollLeft" class="btn btn-primary position-absolute top-50 start-0 translate-middle-y">
				&#9664;
			</button>
			<button id="scrollRight" class="btn btn-primary position-absolute top-50 end-0 translate-middle-y">
				&#9654;
			</button>
		</div>
	</section>

	<script>
		// JavaScript for Scrolling
		const scrollContainer = document.getElementById('scrollContainer');
		const scrollLeft = document.getElementById('scrollLeft');
		const scrollRight = document.getElementById('scrollRight');

		scrollLeft.addEventListener('click', () => {
			scrollContainer.scrollLeft -= 300; // Adjust scroll distance as needed
		});

		scrollRight.addEventListener('click', () => {
			scrollContainer.scrollLeft += 300; // Adjust scroll distance as needed
		});
	</script>

	<!--test-->
	<section class="page-section bg-light" id="about">
		<div class="container" style="margin-top: 1px;">
			<div class="text-center">
				<h2 class="section-heading text-uppercase rainbow">Flagship</h2>
				<h3 class="section-subheading text-muted">So Sánh Giữa Các Hãng </h3>
			</div>
		</div>

		<div class="table-responsive">
			<table class="table text-center">
				<div class="table-responsive">
					<table class="table text-center">
						<thead>
							<tr>
								<th></th>
								<th>
									<img src="iPhone/ip16.png" height="300px" width="auto" /><br />
									<span style="color: black;">iPong X</span>
								</th>
								<th>
									<img src="iPhone/ip16.png" height="300px" width="auto" /><br />
									<span style="color: black;">iPhone 15 Pro Max</span>
								</th>
								<th>
									<img src="iPhone/ip16.png" height="300px" width="auto" /><br />
									<span style="color: black;">Samsung Galaxy S24 Ultra</span>
								</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><img src="Images/cpu.png" width="30px" /></td>
								<td><img src="Images/cpu.png" width="35px" /></td>
								<td style="color: black;">Pong Chip X100</td>
								<td style="color: black;">Apple A17 Pro</td>
								<td style="color: black;">Snapdragon 8 Gen 3</td>
							</tr>
							<tr>
								<td><img src="Images/stack-2.png" width="30px" /></td>
								<td><img src="Images/ram.png" width="40px" /></td>
								<td style="color: black;">512GB</td>
								<td style="color: black;">6GB</td>
								<td style="color: black;">12GB</td>
							</tr>
							<tr>
								<td><img src="Images/cpu-2.png" width="30px" /></td>
								<td><img src="Images/gpu.png" width="40px" /></td>
								<td style="color: black;">RTX 4090Ti</td>
								<td style="color: black;">Apple GPU</td>
								<td style="color: black;">Adreno 750</td>
							</tr>
							<tr>
								<td><img src="Images/device-tablet.png" width="30px" /></td>
								<td><img src="Images/screen.png" width="40px" /></td>
								<td style="color: black;">6.7" Super XDR</td>
								<td style="color: black;">6.7" OLED</td>
								<td style="color: black;">6.8" Dynamic AMOLED</td>
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
						<?php foreach ($iphones as $iphone): ?>
							<div class="product-item iphone">
								<div class="product discount product_filter">
									<div class="product_image">
										<a href="single.php?id=<?php echo $iphone['product_id']; ?>">
											<img src="<?php echo htmlspecialchars($iphone['image']); ?>" alt="<?php echo htmlspecialchars($iphone['name']); ?>" width="100" height="auto">
										</a>
									</div>
									<div class="favorite favorite_left"></div>
									<div class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center">
										<span>-$20</span>
									</div>
									<div class="product_info">
										<h6 class="product_name">
											<a href="single.php?id=<?php echo $iphone['product_id']; ?>"><?php echo htmlspecialchars($iphone['name']); ?></a>
										</h6>
										<div class="product_price">
											$<?php echo number_format($iphone['price'] * (1 - 0.20), 2); ?>
											<span><?php echo number_format($iphone['price'], 2); ?></span>
										</div>
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
		$(document).ready(function() {
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