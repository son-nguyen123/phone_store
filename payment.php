<?php
include 'db.php';  // Kết nối cơ sở dữ liệu

// Kiểm tra người dùng đã đăng nhập hay chưa
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    // Lấy thông tin giỏ hàng của người dùng
    $stmt = $pdo->prepare("SELECT cart FROM users WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->execute();

    $cartItems = $stmt->fetchColumn();
    $cart = [];

    if ($cartItems) {
        $itemsArray = explode(' ', trim($cartItems));
        foreach ($itemsArray as $item) {
            list($itemId, $quantity) = explode('-', $item);
            $cart[] = ['item_id' => $itemId, 'quantity' => (int)$quantity];
        }
    }

    // Lấy thông tin người dùng
    $stmt = $pdo->prepare("SELECT name_user, address_shipping, number FROM users WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Tính tổng giá trị đơn hàng
    $totalAmount = 0;
    foreach ($cart as $cartItem) {
        $stmt = $pdo->prepare("SELECT price FROM products WHERE product_id = :product_id");
        $stmt->bindParam(':product_id', $cartItem['item_id'], PDO::PARAM_INT);
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($product) {
            $subtotal = $product['price'] * $cartItem['quantity'];
            $totalAmount += $subtotal;
        }
    }
} else {
    // Nếu người dùng chưa đăng nhập, chuyển hướng đến trang đăng nhập
    header('Location: login.php');
    exit;
}
?>

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
        .thanh {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 30px;
        }

        .delivery-status {
            padding: 20px;
            width: 100%;
        }

        .status-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .status-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
        }

        .status-step p {
            font-size: 14px;
            color: #666;
            margin-top: 8px;
        }

        .status-step .dot {
            width: 12px;
            height: 12px;
            background-color: #d3d3d3;
            border-radius: 50%;
            position: relative;
        }

        .status-step.completed .dot {
            background-color: #4caf50;
        }

        .status-step .dot.checked {
            width: 16px;
            height: 16px;
            background-color: #4caf50;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .status-step .dot.checked::after {
            content: "✔";
            color: white;
            font-size: 10px;
        }

        .status-line-1 {
            flex: 1;
            height: 2px;
            background-color: #4caf50;
            margin-left: -50px;
            margin-right: -14px;
            margin-top: 0px;
            margin-bottom: 45px;
        }

        .status-line-2 {
            flex: 1;
            height: 2px;
            background-color: #4caf50;
            margin-left: -14px;
            margin-right: -12px;
            margin-top: 0px;
            margin-bottom: 45px;
        }

        .status-step.completed+ {
            background-color: #4caf50;
        }

        @media (min-width: 768px) {
            .profile-container {
                padding: 40px;
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
                    <?php
                    foreach ($cart as $cartItem) {
                        $stmt = $pdo->prepare("SELECT name, price FROM products WHERE product_id = :product_id");
                        $stmt->bindParam(':product_id', $cartItem['item_id'], PDO::PARAM_INT);
                        $stmt->execute();
                        $product = $stmt->fetch(PDO::FETCH_ASSOC);

                        if ($product) {
                            $subtotal = $product['price'] * $cartItem['quantity'];
                            echo "<li>{$product['name']} - {$cartItem['quantity']} cái - " . number_format($product['price'], 0, ',', '.') . " đ</li>";
                        }
                    }
                    ?>
                    <p><strong>Tổng cộng: <?php echo number_format($totalAmount, 0, ',', '.') . ' đ'; ?></strong></p>
                </ul>
            </div>

            <!-- Thông tin địa chỉ -->
            <div class="section">
                <h2>Thông Tin Nhận Hàng:</h2>
                <label for="name">Họ và Tên:</label>
                <p class="sanh"><?php echo $user['name_user']; ?></p>

                <label for="address">Địa chỉ:</label>
                <p class="sanh"><?php echo $user['address_shipping']; ?></p>

                <label for="phone">Số điện thoại:</label>
                <p class="sanh"><?php echo $user['number']; ?></p>
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
            <div class="thanh">
                    <div class="delivery-status">
                        <div class="status-bar">
                            <div class="status-step completed">
                                <span class="dot checked"></span>
                                <p>Thông tin khách hàng</p>
                            </div>
                            <div class="status-line-1"></div>
                            <div class="status-step completed">
                                <span class="dot checked"></span>
                                <p>Thanh Toán</p>
                            </div>
                            <div class="status-line-2"></div>
                            <div class="status-step completed">
                                <span class="dot"></span>
                                <p>Vận chuyển</p>
                            </div>
                        </div>
                    </div>
                </div>           
            <!-- Nút đặt hàng -->
            <form action="order_history.php" method="POST">
    <!-- Các trường dữ liệu khác của đơn hàng -->
    <button class="button" type="submit">Đặt Hàng</button>
</form>
        </div>
    </div>
</body>

</html>