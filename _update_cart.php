<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id']) && isset($_POST['quantity']) && isset($_SESSION['user_id'])) {
    $productId = $_POST['product_id'];
    $quantity = (int)$_POST['quantity'];
    $userId = $_SESSION['user_id'];

    // Lấy giỏ hàng hiện tại
    $stmt = $pdo->prepare("SELECT cart FROM users WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $userId);
    $stmt->execute();
    $cartString = $stmt->fetchColumn();

    $cart = [];
    if ($cartString) {
        // Chuyển chuỗi giỏ hàng thành mảng sản phẩm và số lượng
        $items = explode(' ', trim($cartString));
        foreach ($items as $item) {
            list($id, $qty) = explode('-', $item);
            $cart[$id] = (int)$qty;
        }
    }

    // Cập nhật số lượng hoặc xóa sản phẩm
    if ($quantity > 0) {
        // Nếu số lượng > 0, cập nhật số lượng của sản phẩm
        $cart[$productId] = $quantity;
    } else {
        // Nếu số lượng = 0, xóa sản phẩm khỏi giỏ hàng
        unset($cart[$productId]);
    }

    // Tạo chuỗi giỏ hàng mới sau khi xóa hoặc cập nhật sản phẩm
    $updatedCart = [];
    foreach ($cart as $id => $qty) {
        $updatedCart[] = "$id-$qty";
    }
    $cartString = implode(' ', $updatedCart);

    // Cập nhật giỏ hàng vào cơ sở dữ liệu
    $stmt = $pdo->prepare("UPDATE users SET cart = :cart WHERE user_id = :user_id");
    $stmt->bindParam(':cart', $cartString);
    $stmt->bindParam(':user_id', $userId);
    
    if ($stmt->execute()) {
        // Tính toán lại tổng tiền giỏ hàng
        $total = 0;
        foreach ($cart as $id => $qty) {
            $stmt = $pdo->prepare("SELECT price FROM products WHERE product_id = :product_id");
            $stmt->bindParam(':product_id', $id);
            $stmt->execute();
            $itemPrice = $stmt->fetchColumn();
            $total += $itemPrice * $qty;
        }

        // Tính lại subtotal của sản phẩm vừa thay đổi
        $subtotal = 0;
        if ($quantity > 0) {
            $stmt = $pdo->prepare("SELECT price FROM products WHERE product_id = :product_id");
            $stmt->bindParam(':product_id', $productId);
            $stmt->execute();
            $productPrice = $stmt->fetchColumn();
            $subtotal = $productPrice * $quantity;
        }

        // Trả về kết quả dưới dạng JSON
        echo json_encode([
            'status' => 'success',
            'subtotal' => $subtotal,
            'total' => $total
        ]);
    } else {
        echo json_encode(['status' => 'fail']);
    }
} else {
    echo json_encode(['status' => 'invalid']);
}
?>
