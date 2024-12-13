<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Thanh Toán</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="plugins/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
    <link rel="stylesheet" href="styles/main_styles.css">
    <link rel="stylesheet" href="styles/responsive.css">
    <style>
        body {
            background-color: #f2f2f2;

        }

        .pay {
            font-family: Arial, sans-serif;
            margin-top: 130px;
        }

        .payment {
            max-width: 800px;
            margin: 20px auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .payment h1 {
            text-align: center;
            color: #333;
            font-size: 45px;
            margin-bottom: 30px;
        }

        .section {
            margin-bottom: 20px;
        }

        .section h2 {
            margin-bottom: 10px;
            color: #555;
            font-size: 30px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .payment-option {
            display: flex;
            align-items: center;
        }

        input[type="radio"] {
            margin-right: 10px;
        }

        img {
            width: 250px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 4px;
            background-color: #3a3a3a;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            font-size: 1em;
        }

        .button:hover {
            background-color: #212529;
        }

        .section ul {
            padding-left: 20px;
            list-style-type: disc;
        }

        .section ul li {
            margin-bottom: 5px;
        }

        .section p {
            padding-left: 20px;
            color: black;
        }

        .sanh {
            background-color: #f2f2f2;
            padding: 15px;
            border-radius: 8px;
            color: black;
        }
    </style>
</head>

<body>
    <?php include 'web_sections/navbar.php'; ?>
    <div class="pay">
    <div class="payment">
        <h1>Thanh Toán</h1>

        <!-- Thông tin đơn hàng -->
        <div class="section">
            <h2>Thông Tin Đơn Hàng:</h2>
            <ul>
                <li>Sản phẩm A - 2 cái - 500.000đ</li>
                <li>Sản phẩm B - 1 cái - 300.000đ</li>
                <p><strong>Tổng cộng: 800.000đ</strong></p>
            </ul>
        </div>

        <!-- Thông tin địa chỉ -->
        <div class="section">
            <h2>Thông Tin Nhận Hàng:</h2>
            <label for="name">Họ và Tên:</label>
            <p class="sanh">Nguyễn Vĩnh Sanh</p>

            <label for="address">Địa chỉ:</label>
            <p class="sanh">KTX Trường Đh Công Nghệ Thông Tin Và Truyền Thông Việt Hàn, Đường Nam Kỳ Khởi Nghĩa Phường Hòa Quý, Quận Ngũ Hành Sơn, Đà Nẵng</p>

            <label for="phone">Số điện thoại:</label>
            <p class="sanh">0376138772</p>
        </div>

        <!-- Phương thức thanh toán -->
        <div class="section">
            <h2>Phương Thức Thanh Toán:</h2>
            <div class="payment-options">
                <label class="payment-option">
                    <input type="radio" id="cod" name="payment-method" value="cod" checked>
                    <span for="cod">Thanh Toán Khi Nhận Hàng</span>
                </label>
                <label class="payment-option">
                    <input type="radio" id="bank-transfer" name="payment-method" value="bank-transfer">
                    <span for="bank-transfer">Chuyển Khoản</span>
                </label>
                <div style="text-align: center;">
                    <img src="images/pay.jpg" alt="Mã QR Chuyển Khoản">
                </div>
            </div>
        </div>
        
        <!-- Nút đặt hàng -->
        <button class="button">Đặt Hàng</button>
    </div>
    </div>
</body>

</html>