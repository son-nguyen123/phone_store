<?php
include 'db.php';

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

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
            background-color: #f2f2f2;
        }

        .cart {
            color: #fff;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
            width: 100%;
        }

        .profile-container {
            width: 80%;
            padding: 20px;
            border: 2px solid #ddd;
            border-radius: 8px;
            background-color: white;
            margin-top: 450px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #adb3b8;
            margin-bottom: 5%;
            color: white;
        }

        th,
        td {
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

        .profile-form label {
            font-size: 1.1em;
            color: black;
            margin-top: 10px;
            display: block;
            font-weight: bold;
        }

        .profile-form input,
        .profile-form textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 4px;
            background-color: #fff;
            color: #444;
            font-size: 1em;
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
                                <td>
                                    <input class='number' type='number' value='{$cartItem['quantity']}' min='1' data-product-id='{$product['product_id']}' onchange='updateQuantity(this)'>
                                </td>
                                <td>" . number_format($subtotal, 0, ',', '.') . " USD</td>
                                <td>
                                    <input type='hidden' name='product_id' value='{$product['product_id']}'>
                                    <button type='button' onclick='deleteItem(this)' class='delete-button'>Xóa</button>
                                </td>
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

                <div class="thanh">
                    <div class="delivery-status">
                        <div class="status-bar">
                            <div class="status-step completed">
                                <span class="dot checked"></span>
                                <p>Thông tin khách hàng</p>
                            </div>
                            <div class="status-line-1"></div>
                            <div class="status-step completed">
                                <span class="dot"></span>
                                <p>Thanh toán</p>
                            </div>
                            <div class="status-line-2"></div>
                            <div class="status-step completed">
                                <span class="dot"></span>
                                <p>Vận chuyển</p>
                            </div>
                        </div>
                    </div>
                </div>

                <button class="order" type="submit">Đặt hàng</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function deleteItem(button) {
            var row = button.closest('tr');
            var productId = row.querySelector('input[name="product_id"]').value;

            $.ajax({
                url: '_remove_from_cart.php',
                type: 'POST',
                data: {
                    product_id: productId
                },
                success: function(response) {
                    if (response === 'success') {
                        row.remove();
                        updateTotalAmount();
                        alert('Item removed from cart!');
                    } else {
                        alert('Failed to remove item.');
                    }
                },
                error: function() {
                    alert('An error occurred while removing the item.');
                }
            });
        }

        function updateQuantity(input) {
            var row = input.closest('tr');
            var productId = row.querySelector('input[name="product_id"]').value;
            var newQuantity = input.value;

            $.ajax({
                url: '_update_cart.php',
                type: 'POST',
                data: {
                    product_id: productId,
                    quantity: newQuantity
                },
                success: function(response) {
                    if (response === 'success') {
                        var price = parseFloat(row.querySelector('.total').innerText.replace(' USD', '').replace(',', ''));
                        var newSubtotal = price * newQuantity;
                        row.querySelector('td:nth-child(6)').innerText = newSubtotal.toFixed(2) + ' USD';
                        updateTotalAmount();
                    } else {
                        alert('Failed to update quantity.');
                    }
                },
                error: function() {
                    alert('An error occurred while updating the quantity.');
                }
            });
        }

        function updateTotalAmount() {
            var totalAmount = 0;
            document.querySelectorAll('tr').forEach(function(row) {
                var subtotalCell = row.querySelector('td:nth-child(6)');
                if (subtotalCell) {
                    totalAmount += parseFloat(subtotalCell.innerText.replace(' USD', '').replace(',', ''));
                }
            });

            document.querySelector('.total').innerText = totalAmount.toFixed(2) + ' USD';
        }
    </script>
</body>

</html>