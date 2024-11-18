<!DOCTYPE html>
<html lang="en">

<head>
  <title>Shopping Cart</title>
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
  <link rel="stylesheet" type="text/css" href="styles/single_styles.css">
  <link rel="stylesheet" type="text/css" href="styles/single_responsive.css">
  <style>
    .page {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
    }

    .container {
      width: 80%;
      margin: auto;
      padding: 20px;
      border: 2px solid #ddd;
      border-radius: 8px;
      background-color: #ffcf99;
      margin-top: 2%;
      margin-bottom: 2%;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: #ffdbb3;
      margin-bottom: 5%;
    }

    th,
    td {
      padding: 8px;
      text-align: center;
      border: 1px solid #ddd;
    }

    .total {
      font-weight: bold;
      color: red;
    }

    h2 {
      text-align: center;
      margin-bottom: 3%;
      font-size: 50px;
    }

    .form-label {
      display: inline-block;
      width: 10%;
      font-weight: bold;
    }

    .table1 {
      background-color: #fd7e14;
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
      font-size: 0.9em;
      color: #444;
      margin-top: 10px;
      display: block;
    }

    .profile-form input {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: none;
      border-radius: 4px;
      background-color: #fff3e6;
      color: #444;
      font-size: 1em;
    }

    .profile-form textarea {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: none;
      border-radius: 4px;
      background-color: #fff3e6;
      color: #444;
      font-size: 1em;
    }

    .order {
      width: 100%;
      padding: 12px;
      margin-top: 20px;
      border: none;
      border-radius: 4px;
      background-color: #fd7e14;
      color: #fff;
      font-weight: bold;
      cursor: pointer;
      font-size: 1em;
    }

    .order:hover {
      background-color: #fd9d4e;
    }

    @media (min-width: 768px) {
      .profile-container {
        padding: 40px;
      }
    }
  </style>
</head>

<body>

  <div class="page">
    <div class="container">
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
  </div>

</body>

</html>