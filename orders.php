<?php
include 'db.php'; // Đảm bảo đã gọi session_start() trong db.php

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "Vui lòng đăng nhập.";
    exit;
}

$userId = $_SESSION['user_id'];

// Fetch orders for the logged-in user
$stmt = $pdo->prepare("SELECT * FROM orders WHERE customer_id = :customer_id ORDER BY order_date DESC");
$stmt->bindParam(':customer_id', $userId, PDO::PARAM_INT);
$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch Sử Đơn Hàng</title>
    <link rel="stylesheet" href="styles/orders.css">
    <style>
        /* Your CSS styles here */
    </style>
</head>
<body>
    <div class="container">
        <h2>Lịch Sử Đơn Hàng</h2>
        <?php if ($orders): ?>
            <table>
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Ngày Đặt Hàng</th>
                        <th>Tổng Tiền</th>
                        <th>Trạng Thái</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $index => $order): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo $order['order_date']; ?></td>
                            <td><?php echo number_format($order['total_amount'], 0, ',', '.') . ' USD'; ?></td>
                            <td><?php echo $order['status']; ?></td>
                            <td>
                                <!-- Ensure that the order_id is being passed correctly -->
                                <a href="cancel_order.php?order_id=<?php echo $order['order_id']; ?>" class="btn cancel-btn">Hủy Đơn Hàng</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="no-orders">Bạn chưa có đơn hàng nào.</p>
        <?php endif; ?>
    </div>
</body>
</html>
