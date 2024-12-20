<!DOCTYPE html>
<html lang="en">

<head>
    <title>Contact Us</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Colo Shop Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
    <link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
    <link rel="stylesheet" href="plugins/themify-icons/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="plugins/jquery-ui-1.12.1.custom/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="styles/contact_styles.css">
    <link rel="stylesheet" type="text/css" href="styles/contact_responsive.css">
    <link rel="stylesheet" href="css/footer.css">
    <style>
        .floating-icons {
            position: fixed;
            bottom: 20px;
            right: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            z-index: 1000;
        }

        .icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            animation: bounce 2s infinite;
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .icon i {
            font-size: 30px;
            color: #fff;
        }

        .icon.messenger {
            background-color: #0078FF;
        }

        .icon.zalo {
            background-color: #0084FF;
        }

        .icon:hover {
            transform: scale(1.1);
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-10px);
            }
            60% {
                transform: translateY(-5px);
            }
        }
    </style>
</head>

<body>
    <?php include 'web_sections/navbar.php'; ?>
    <div class="floating-icons">
        <div class="icon messenger" onclick="openLink('https://m.me/yourMessengerID')">
            <i class="fa fa-facebook"></i>
        </div>
        <div class="icon zalo" onclick="openLink('https://zalo.me/yourZaloID')">
            <i class="fa fa-instagram"></i>
        </div>
    </div>

    <div class="super_container">
        <div class="container contact_container">
            <div class="row">
                <div class="col">
                    <!-- Breadcrumbs -->
                    <div class="breadcrumbs d-flex flex-row align-items-center">
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li class="active"><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>Liên hệ</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Map Container -->
            <div class="row">
                <div class="col">
                    <div id="google_map">
                        <div class="map_container">
                            <div id="map">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d239.7334662812403!2d108.25314567252283!3d15.975185383892294!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3142108997dc971f%3A0x1295cb3d313469c9!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBDw7RuZyBuZ2jhu4cgVGjDtG5nIHRpbiB2w6AgVHJ1eeG7gW4gdGjDtG5nIFZp4buHdCAtIEjDoG4sIMSQ4bqhaSBo4buNYyDEkMOgIE7hurVuZw!5e0!3m2!1svi!2s!4v1734324379950!5m2!1svi!2s" width="1111" height="507" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Contact Us -->
            <div class="row">
                <div class="col-lg-6 contact_col">
                    <div class="contact_contents">
                        <h1>Liên hệ</h1>
                        <p>Nếu bạn có thắc mắc gì hoặc muốn đặt hàng cho doanh nghiệp thì hãy liên hệ cho số điện thoại hoặc mail bên dưới.</p>
                        <div>
                            <p>(800) 686-6688</p>
                            <p>info.deercreative@gmail.com</p>
                        </div>
                        <div>
                            <p>Thời gian hoạt động</p>
                        </div>
                        <div>
                            <p>Giờ mở cửa: 8.00-18.00 T2-T7</p>
                            <p>Chủ nhật: Đóng cửa</p>
                        </div>
                    </div>
                    <!-- Follow Us -->
                    <div class="follow_us_contents">
                        <h1>Theo dõi</h1>
                        <ul class="social d-flex flex-row">
                            <li><a href="#" style="background-color: #3a61c9"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="#" style="background-color: #41a1f6"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="#" style="background-color: #fb4343"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                            <li><a href="#" style="background-color: #8f6247"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 get_in_touch_col">
                    <div class="get_in_touch_contents">
                        <h1>Ý kiến đóng góp:</h1>
                        <p>Hãy điền vào form để có cơ hội nhận được những phần quà bí ẩn.</p>
                        <form action="post">
                            <div>
                                <input id="input_name" class="form_input input_name input_ph" type="text" name="name" placeholder="Tên" required="required" data-error="Name is required.">
                                <input id="input_email" class="form_input input_email input_ph" type="email" name="email" placeholder="Email" required="required" data-error="Valid email is required.">
                                <input id="input_website" class="form_input input_website input_ph" type="url" name="name" placeholder="Website" required="required" data-error="Name is required.">
                                <textarea id="input_message" class="input_ph input_message" name="message" placeholder="Góp ý" rows="3" required data-error="Please, write us a message."></textarea>
                            </div>
                            <div>
                                <button id="review_submit" type="submit" class="red_button message_submit_btn trans_300" value="Submit">Gửi ý kiến</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'web_sections/footer.php'; ?>

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="styles/bootstrap4/popper.js"></script>
    <script src="styles/bootstrap4/bootstrap.min.js"></script>
    <script src="plugins/Isotope/isotope.pkgd.min.js"></script>
    <script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
    <script src="plugins/easing/easing.js"></script>
    <script src="plugins/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
    <script>
        function openLink(url) {
            window.open(url, '_blank');
        }
    </script>
</body>

</html>
