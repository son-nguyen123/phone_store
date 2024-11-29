<?php
include 'db.php';

$productStmt = $pdo->query("SELECT * FROM products");
$products = $productStmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	 <title>SS</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Colo Shop Template">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
	<link rel="stylesheet" type="text/css" href="plugins/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
	<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
	<link rel="stylesheet" type="text/css" href="styles/main_styles.css">
	<link rel="stylesheet" type="text/css" href="styles/responsive.css">
	<link rel="stylesheet" type="text/css" href="styles.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="icon" type="image/x-icon" href="Favicon.ico" />

	
</head>
<!--navbar.php -->
<?php include 'web_sections/navbar.php'; ?>
<body id="page-top">
<!--banner -->
<?php include 'web_sections\banner.html'; ?>
<!--benefit -->
	<?php include 'web_sections\benefit.html'; ?>
	<!-- video-->
	<?php include 'web_sections\video.html'; ?>
	<!--ability-->

	<?php include 'web_sections\ability.html'; ?>
<!--comparation-->
	<?php include 'web_sections\comparation.html'; ?>

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
						<?php foreach ($products as $product): ?>
							<div class="product-item iphone">
								<div class="product discount product_filter">
									<div class="product_image">
										<a href="single.php?product_id=<?php echo $product['product_id']; ?>">
											<img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" width="100" height="auto">
										</a>
									</div>
									<div class="favorite favorite_left"></div>
									<div class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center">
										<span>-$20</span>
									</div>
									<div class="product_info">
										<h6 class="product_name">
											<a href="single.php?product_id=<?php echo $product['product_id']; ?>"><?php echo htmlspecialchars($product['name']); ?></a>
										</h6>
										<div class="product_price">
											$<?php echo number_format($product['price'] * (1 - 0.20), 2); ?>
											<span><?php echo number_format($product['price'], 2); ?></span>
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



		<?php include 'web_sections\bestseller.html'; ?>
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

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script src="js/jquery-3.2.1.min.js"></script> 	
	<script src="js/custom.js"></script>
	<script src="plugins/Isotope/isotope.pkgd.min.js"></script>
	<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
	<script src="plugins/easing/easing.js"></script>

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