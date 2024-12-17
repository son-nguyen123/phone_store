<?php
include 'db.php';
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Người dùng chưa đăng nhập.']);
    exit;
}

$userId = $_SESSION['user_id'];
$productId = $_POST['product_id'] ?? null;
$action = $_POST['action'] ?? null;

// Kiểm tra nếu action là "delete"
if ($action === 'delete' && $productId) {
    // Lấy thông tin giỏ hàng hiện tại từ cơ sở dữ liệu
    $stmt = $pdo->prepare("SELECT cart FROM users WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->execute();
    $cartItems = $stmt->fetchColumn();

    if ($cartItems) {
        // Chuyển chuỗi giỏ hàng thành mảng
        $itemsArray = explode(' ', trim($cartItems));
        $updatedCart = [];

        foreach ($itemsArray as $item) {
            list($itemId, $quantity) = explode('-', $item);

            // Giữ lại các sản phẩm không phải sản phẩm cần xóa
            if ($itemId !== $productId) {
                $updatedCart[] = $item;
            }
        }

        // Cập nhật giỏ hàng trong cơ sở dữ liệu
        $newCart = implode(' ', $updatedCart);
        $stmt = $pdo->prepare("UPDATE users SET cart = :cart WHERE user_id = :user_id");
        $stmt->bindParam(':cart', $newCart);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();

        echo json_encode(['status' => 'success', 'message' => 'Xóa sản phẩm thành công.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Không tìm thấy giỏ hàng.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Thông tin sản phẩm không hợp lệ.']);
}
?>
