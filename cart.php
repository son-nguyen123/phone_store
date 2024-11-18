<!DOCTYPE html>
<html lang="en">

<head>
    <title>Colo Shop</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Colo Shop Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="LoginStyle.css">
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
    <link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
    <link rel="stylesheet" type="text/css" href="styles/main_styles.css">
    <link rel="stylesheet" type="text/css" href="styles/responsive.css">
    <link rel="icon" type="image/x-icon" href="Favicon.ico" />
    <link rel="icon" href="icon.png" type="image/png">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        body {
            flex-direction: column;
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }

        body,
        html {
            color: #fff;
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
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
            cursor: pointer;
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
    <!-- Navbar -->
    <?php include 'web_sections/navbar.php'; ?>
    <!--Test-->
    <?php require 'db.php'; ?>

    <!-- Main Content -->
    <div class="profile-container">
        <h2>Giỏ hàng</h2>

        <table>
            <tr class="table1">
                <th style="width: 5%">STT</th>
                <th style="width: 30%">Tên sản phẩm</th>
                <th style="width: 20%">Ảnh sản phẩm</th>
                <th style="width: 15%">Đơn giá</th>
                <th style="width: 10%">Số lượng</th>
                <th style="width: 15%">Thành tiền</th>
                <th style="width: 5%">Xóa</th>
            </tr>

            <?php
            // Sample data for products in the cart
            $products = [
                ['name' => 'IPhone 16', 'price' => 22190000, 'quantity' => 1, 'image' => 'shoe1.jpg'],
                ['name' => 'IPhone 16 Plus', 'price' => 25490000, 'quantity' => 2, 'image' => 'shoe2.jpg'],
                ['name' => 'IPhone 16 Promax', 'price' => 34390000, 'quantity' => 1, 'image' => 'shoe3.jpg'],
            ];

            $totalAmount = 0;
            foreach ($products as $index => $product) {
                $subtotal = $product['price'] * $product['quantity'];
                $totalAmount += $subtotal;
                echo "<tr>
                <td>" . ($index + 1) . "</td>
                <td>{$product['name']}</td>
                <td><img src='{$product['image']}' alt='Product Image' width='50'></td>
                <td class='total'>" . number_format($product['price'], 0, ',', '.') . " đ</td>
                <td><input class='number' type='number' value='{$product['quantity']}' min='1'></td>
                <td>" . number_format($subtotal, 0, ',', '.') . " đ</td>
                <td><button type='button' onclick='deleteItem(this)' class='delete-button'>Xóa</button></td>
            </tr>";
            }
            ?>

            <tr>
                <td colspan="5">Tổng tiền</td>
                <td class="total"><?php echo number_format($totalAmount, 0, ',', '.') . ' đ'; ?></td>
                <td></td>
            </tr>
        </table>

        <form class="profile-form">

            <label class="form-label">Người nhận:</label>
            <input type="text" name="name" required><br><br>

            <label class="form-label">Điện thoại:</label>
            <input type="text" name="phone" required><br><br>

            <label class="form-label">Địa chỉ:</label>
            <input type="text" name="address" required><br><br>

            <label class="form-label">Ghi chú:</label>
            <textarea name="notes"></textarea><br><br>


            <button class="order" type="submit">Đặt hàng</button>
        </form>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>