
<?php
// Kết nối tới cơ sở dữ liệu SQLite
try {
    $db = new PDO('sqlite:phone_store.sqlite');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Lỗi kết nối cơ sở dữ liệu: " . $e->getMessage());
}

// Xử lý khi người dùng gửi form thêm đơn hàng
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $data = [
            'customer_id' => $_POST['customer_id'] ?? 0,
            'order_date' => $_POST['order_date'] ?? date('Y-m-d H:i:s'),
            'status' => $_POST['status'] ?? '',
            'total_amount' => $_POST['total_amount'] ?? 0.00,
            'address' => $_POST['address'] ?? '',
            'payment_method' => $_POST['payment_method'] ?? '',
            'payment_status' => $_POST['payment_status'] ?? '',
            'items' => $_POST['items'] ?? '',
            'name_user' => $_POST['name_user'] ?? '',
            'number' => $_POST['number'] ?? '',
            'note' => $_POST['note'] ?? '',
            'address_shipping' => $_POST['address_shipping'] ?? '',
        ];

        $sql = "INSERT INTO orders (
            customer_id, order_date, status, total_amount, address, payment_method, payment_status, items, 
            name_user, number, note, address_shipping
        ) VALUES (
            :customer_id, :order_date, :status, :total_amount, :address, :payment_method, :payment_status, :items, 
            :name_user, :number, :note, :address_shipping
        )";

        $stmt = $db->prepare($sql);
        $stmt->execute($data);
        echo "<p style='color: green;'>Đơn hàng đã được thêm thành công!</p>";
    } catch (PDOException $e) {
        echo "<p style='color: red;'>Lỗi khi thêm đơn hàng: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
}

// Xử lý khi người dùng yêu cầu xóa đơn hàng
if (isset($_GET['delete_id'])) {
    try {
        $delete_id = (int)$_GET['delete_id'];
        $stmt = $db->prepare("DELETE FROM orders WHERE order_id = :order_id");
        $stmt->execute([':order_id' => $delete_id]);
        echo "<p style='color: green;'>Đơn hàng đã được xóa thành công!</p>";
    } catch (PDOException $e) {
        echo "<p style='color: red;'>Lỗi khi xóa đơn hàng: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
}

// Lấy danh sách đơn hàng từ cơ sở dữ liệu
try {
    $orders = $db->query("SELECT * FROM orders")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Lỗi khi lấy danh sách đơn hàng: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Đơn hàng</title>
    <link rel="stylesheet" href="admin/header_admin.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        table th {
            background-color: #007bff;
            color: white;
        }
        .delete-btn {
            color: red;
            cursor: pointer;
            text-decoration: none;
        }
        .delete-btn:hover {
            text-decoration: underline;
        }
        h1 {
            text-align: center;
        }
        form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        label {
            font-weight: bold;
        }
        input, textarea, select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .full-width {
            grid-column: span 2;
        }
        button {
            grid-column: span 2;
            padding: 10px;
            background: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background: #218838;
        }
    </style>
</head>
<body>

<?php include 'admin/header.php'; ?>

    <div class="container">
        <h1>Thêm Đơn hàng</h1>
        <form method="POST">
            <label for="customer_id">Mã khách hàng</label>
            <input type="number" name="customer_id" id="customer_id" required>

            <label for="order_date">Ngày đặt hàng</label>
            <input type="datetime-local" name="order_date" id="order_date" required>

            <label for="status">Trạng thái</label>
            <input type="text" name="status" id="status" required>

            <label for="total_amount">Tổng tiền</label>
            <input type="number" step="0.01" name="total_amount" id="total_amount" required>

            <label for="address">Địa chỉ</label>
            <textarea name="address" id="address" required></textarea>

            <label for="payment_method">Phương thức thanh toán</label>
            <input type="text" name="payment_method" id="payment_method" required>

            <label for="payment_status">Trạng thái thanh toán</label>
            <input type="text" name="payment_status" id="payment_status" required>

            <label for="items">Mặt hàng</label>
            <textarea name="items" id="items" required></textarea>

            <label for="name_user">Tên người nhận</label>
            <input type="text" name="name_user" id="name_user">

            <label for="number">Số điện thoại</label>
            <input type="text" name="number" id="number">

            <label for="note">Ghi chú</label>
            <textarea name="note" id="note"></textarea>

            <label for="address_shipping">Địa chỉ giao hàng</label>
            <textarea name="address_shipping" id="address_shipping"></textarea>

            <button type="submit">Thêm Đơn hàng</button>
        </form>

        <h1>Danh sách Đơn hàng</h1>
        <table>
            <thead>
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Tên khách hàng</th>
                    <th>Ngày đặt</th>
                    <th>Trạng thái</th>
                    <th>Tổng tiền</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= htmlspecialchars($order['order_id']) ?></td>
                        <td><?= htmlspecialchars($order['name_user']) ?></td>
                        <td><?= htmlspecialchars($order['order_date']) ?></td>
                        <td><?= htmlspecialchars($order['status']) ?></td>
                        <td><?= number_format($order['total_amount'], 2) ?> VND</td>
                        <td>
                            <a href="?delete_id=<?= $order['order_id'] ?>" class="delete-btn" onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này không?')">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
