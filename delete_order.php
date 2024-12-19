<?php
include 'db.php';
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    // Kiểm tra xem có truyền order_id trong URL không
    if (isset($_GET['order_id'])) {
        $orderId = (int) $_GET['order_id'];

        // Kiểm tra xem đơn hàng này có thuộc về người dùng hiện tại không
        $stmt = $pdo->prepare("SELECT customer_id FROM orders WHERE order_id = :order_id");
        $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
        $stmt->execute();
        $order = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($order && $order['customer_id'] == $userId) {
            // Xóa đơn hàng khỏi bảng orders
            $stmt = $pdo->prepare("DELETE FROM orders WHERE order_id = :order_id");
            $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
            if ($stmt->execute()) {
                echo "<script>alert('Order deleted successfully!'); window.location.href = 'order_history.php';</script>";
            } else {
                echo "<script>alert('Failed to delete the order.'); window.location.href = 'order_history.php';</script>";
            }
        } else {
            // Người dùng không có quyền xóa đơn hàng này
            echo "<script>alert('You do not have permission to delete this order.'); window.location.href = 'order_history.php';</script>";
        }
    } else {
        // Không có order_id trong URL
        echo "<script>alert('No order ID specified.'); window.location.href = 'order_history.php';</script>";
    }
} else {
    // Người dùng chưa đăng nhập
    echo "<script>alert('You are not logged in.'); window.location.href = 'login.php';</script>";
}
?>
