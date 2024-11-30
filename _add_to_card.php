<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && isset($_SESSION['user_id'])) {
    $id = $_POST['id'];
    $amount = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
    $userId = $_SESSION['user_id'];

    $stmt = $pdo->prepare("SELECT cart FROM users WHERE user_id = :userId");
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();
    $currentCart = $stmt->fetchColumn() ?? '';

    $itemCounts = [];
    foreach (explode(' ', trim($currentCart)) as $item) {
        if ($item) {
            list($itemId, $qty) = explode('-', $item);
            $itemCounts[$itemId] = ($itemCounts[$itemId] ?? 0) + (int)$qty;
        }
    }

    $itemCounts[$id] = ($itemCounts[$id] ?? 0) + $amount;

    $updatedCart = [];
    foreach ($itemCounts as $itemId => $qty) {
        $updatedCart[] = "$itemId-$qty";
    }

    sort($updatedCart);
    $updatedCartString = implode(' ', $updatedCart);

    $stmt = $pdo->prepare("UPDATE users SET cart = :cart WHERE user_id = :userId");
    $stmt->bindParam(':cart', $updatedCartString);
    $stmt->bindParam(':userId', $userId);

    if ($stmt->execute()) {
        echo "<script>alert('Item added to cart successfully!');</script>";
        echo "<script>window.location.href = window.location.href;</script>";
    } else {
        echo "<script>alert('Failed to add item to cart.');</script>";
    }
}
?>