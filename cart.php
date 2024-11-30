<?php
include 'db.php';

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    $stmt = $pdo->prepare("SELECT cart FROM users WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->execute();

    $cartItems = $stmt->fetchColumn();

    if ($cartItems) {
        $itemsArray = explode(' ', trim($cartItems));
        $cart = array_map(function($item) {
            list($itemId, $quantity) = explode('-', $item);
            return [
                'item_id' => $itemId,
                'quantity' => (int)$quantity
            ];
        }, $itemsArray);
    } else {
        echo "No cart items found.";
    }
} else {
    echo "User is not logged in.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Colo Shop Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Colo Shop</title>

    <link rel="stylesheet" href="LoginStyle.css">
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="plugins/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
    <link rel="stylesheet" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
    <link rel="stylesheet" href="plugins/OwlCarousel2-2.2.1/animate.css">
    <link rel="stylesheet" href="styles/main_styles.css">
    <link rel="stylesheet" href="styles/responsive.css">
    <link rel="icon" href="icon.png" type="image/png">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            flex-direction: column;
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }

        .cart {
            color: #fff;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .profile-container {
            width: 80%;
            padding: 20px;
            border: 2px solid #ddd;
            border-radius: 8px;
            background-color: white;
            margin-top: 50%;
            margin-bottom: 3%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #adb3b8;
            margin-bottom: 5%;
            color: white;
        }

        th, td {
            padding: 8px;
            text-align: center;
            border: 1px solid #ddd;
        }

        .total {
            font-weight: bold;
            color: #40ff00;
        }

        h2 {
            text-align: center;
            margin-bottom: 3%;
            font-size: 50px;
        }

        .form-label {
            display: inline-block;
            width: 100%;
            font-weight: bold;
        }

        .table1 {
            background-color: #6c757d;
        }

        .number {
            width: 40px;
        }

        .delete-button {
            background-color: red;
            border: none;
            border-radius: 4px;
            padding: 3px;
            color: white;
        }

        .delete-button:hover {
            background-color: #ff8080;
        }

        .profile-form label {
            font-size: 1.1em;
            color: black;
            margin-top: 10px;
            display: block;
            font-weight: bold;
        }

        .profile-form input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 4px;
            background-color: #fff;
            color: #444;
            font-size: 1em;
            border: 1px solid #ccc;
        }

        .profile-form textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 4px;
            color: #444;
            font-size: 1em;
            background-color: #fff;
            color: #444;
            border: 1px solid #ccc;
        }

        .order {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            border: none;
            border-radius: 4px;
            background-color: #3a3a3a;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            font-size: 1em;
        }

        .order:hover {
            background-color: #212529;
        }

        @media (min-width: 768px) {
            .profile-container {
                padding: 40px;
            }
        }
    </style>
</head>

<body>
    <?php include 'web_sections/navbar.php'; ?>

    <div class="cart">
        <div class="profile-container">
            <h2>Giỏ hàng</h2>

            <table>
                <tr class="table1">
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Ảnh sản phẩm</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                    <th>Xóa</th>
                </tr>

                <?php
                $totalAmount = 0;

                foreach ($cart as $index => $cartItem) {
                    $stmt = $pdo->prepare("SELECT product_id, name, price, image FROM products WHERE product_id = :product_id");
                    $stmt->bindParam(':product_id', $cartItem['item_id'], PDO::PARAM_INT);
                    $stmt->execute();
                    $product = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($product) {
                        $subtotal = $product['price'] * $cartItem['quantity'];
                        $totalAmount += $subtotal;

                        echo "<tr>
                            <td>" . ($index + 1) . "</td>
                            <td>{$product['name']}</td>
                            <td><img src='{$product['image']}' alt='Product Image' width='50'></td>
                            <td class='total'>" . number_format($product['price'], 0, ',', '.') . " USD</td>
                            <td><input class='number' type='number' value='{$cartItem['quantity']}' min='1'></td>
                            <td>" . number_format($subtotal, 0, ',', '.') . " USD</td>
                            <td><button type='button' onclick='deleteItem(this)' class='delete-button'>Xóa</button></td>
                        </tr>";
                    }
                }
                ?>

                <tr>
                    <td colspan="5">Tổng tiền</td>
                    <td class="total"><?php echo number_format($totalAmount, 0, ',', '.') . ' USD'; ?></td>
                    <td></td>
                </tr>
            </table>

            <form class="profile-form">
                <label>Người nhận:</label>
                <input type="text" name="name" required>

                <label>Điện thoại:</label>
                <input type="text" name="phone" required>

                <label>Địa chỉ:</label>
                <input type="text" name="address" required>

                <label>Ghi chú:</label>
                <textarea name="notes"></textarea>

                <button class="order" type="submit">Đặt hàng</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>