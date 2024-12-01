<?php
include 'db.php';

if (isset($_POST['product_id'], $_POST['quantity'], $_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $productId = $_POST['product_id'];
    $quantity = (int)$_POST['quantity'];

    $stmt = $pdo->prepare("SELECT cart FROM users WHERE user_id = :userId");
    $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
    $stmt->execute();
    $currentCart = $stmt->fetchColumn() ?? '';

    $itemCounts = [];
    foreach (explode(' ', trim($currentCart)) as $item) {
        if ($item) {
            list($itemId, $qty) = explode('-', $item);
            $itemCounts[$itemId] = ($itemCounts[$itemId] ?? 0) + (int)$qty;
        }
    }

    if (isset($itemCounts[$productId])) {
        $itemCounts[$productId] = $quantity;
    }

    $updatedCart = array_map(fn($itemId, $qty) => "$itemId-$qty", array_keys($itemCounts), $itemCounts);
    sort($updatedCart);
    $updatedCartString = implode(' ', $updatedCart);

    $stmt = $pdo->prepare("UPDATE users SET cart = :cart WHERE user_id = :userId");
    $stmt->bindParam(':cart', $updatedCartString);
    $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);

    echo $stmt->execute() ? 'success' : 'error';
}
?>