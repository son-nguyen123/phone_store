<?php
include 'db.php'; // Đảm bảo gọi session_start() trong db.php

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['user_id'])) {
    echo "Vui lòng đăng nhập để hủy đơn hàng.";
    exit;
}

$userId = $_SESSION['user_id'];
$orderId = isset($_GET['order_id']) ? intval($_GET['order_id']) : null;

if (!$orderId || $orderId <= 0) {
    echo "Không tìm thấy đơn hàng để hủy.";
    exit;
}

// Xác minh xem đơn hàng có thuộc về người dùng không
$stmt = $pdo->prepare("SELECT * FROM orders WHERE order_id = :order_id AND customer_id = :customer_id");
$stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
$stmt->bindParam(':customer_id', $userId, PDO::PARAM_INT);
$stmt->execute();
$order = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$order) {
    echo "Đơn hàng không tồn tại hoặc không thuộc về bạn.";
    exit;
}

// Cập nhật trạng thái đơn hàng thành 'cancelled'
$stmt = $pdo->prepare("UPDATE orders SET status = 'cancelled' WHERE order_id = :order_id AND customer_id = :customer_id");
$stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
$stmt->bindParam(':customer_id', $userId, PDO::PARAM_INT);

if ($stmt->execute()) {
    echo "<script>alert('Đơn hàng đã được hủy thành công!'); window.location.href='orders.php';</script>";
} else {
    $errorInfo = $stmt->errorInfo();
    echo "Không thể hủy đơn hàng. Chi tiết lỗi: " . htmlspecialchars($errorInfo[2]);
}
?>
