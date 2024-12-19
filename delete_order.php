<?php
include 'db.php';
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    // Kiểm tra xem có truyền order_id trong URL không
    if (isset($_GET['order_id'])) {
        $orderId = (int) $_GET['order_id'];

        // Lấy thông tin đơn hàng của người dùng hiện tại từ bảng orders
        $stmt = $pdo->prepare("SELECT * FROM orders WHERE order_id = :order_id AND customer_id = :user_id");
        $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $order = $stmt->fetch(PDO::FETCH_ASSOC);

        // Kiểm tra xem đơn hàng có tồn tại và thuộc về người dùng này không
        if ($order) {
            // Xóa đơn hàng khỏi bảng orders
            $stmt = $pdo->prepare("DELETE FROM orders WHERE order_id = :order_id");
            $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);

            if ($stmt->execute()) {
                echo "<script>alert('Order deleted successfully!'); window.location.href = 'order_history.php';</script>";
            } else {
                // Hiển thị lỗi nếu không thể xóa
                $error = $stmt->errorInfo();
                echo "<script>alert('Failed to delete the order. Error: " . $error[2] . "'); window.location.href = 'order_history.php';</script>";
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
