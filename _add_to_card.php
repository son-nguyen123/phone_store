<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    if (!isset($_SESSION['user_id'])) {
        echo "<script>alert('You must be logged in to add items to the cart.');</script>";
        exit;
    }

    $id = $_POST['id'];
    $amount = 1;
    $userId = $_SESSION['user_id'];

    if ($userId && $id) {
        $cartEntry = "$id-$amount ";
        $stmt = $pdo->prepare("SELECT cart FROM users WHERE user_id = :userId");
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        $currentCart = $stmt->fetchColumn() ?? ''; // Handle null value

        $items = explode(' ', trim($currentCart));
        $itemCounts = [];

        foreach ($items as $item) {
            if ($item) {
                list($itemId, $qty) = explode('-', $item);
                $key = "$itemId";

                if (!isset($itemCounts[$key])) {
                    $itemCounts[$key] = 0;
                }
                $itemCounts[$key] += (int)$qty;
            }
        }

        $itemCounts[$id] = ($itemCounts[$id] ?? 0) + $amount;

        $updatedCart = [];
        foreach ($itemCounts as $key => $qty) {
            $updatedCart[] = "$key-$qty";
        }

        sort($updatedCart);
        $updatedCartString = implode(' ', $updatedCart);

        $stmt = $pdo->prepare("UPDATE users SET cart = :cart WHERE user_id = :userId");
        $stmt->bindParam(':cart', $updatedCartString);
        $stmt->bindParam(':userId', $userId);

        if ($stmt->execute()) {
            echo "<script>alert('Item added to cart successfully!');</script>";
            echo "<script>window.location.href = window.location.href;</script>";
            exit;
        } else {
            echo "<script>alert('Failed to add item to cart.');</script>";
        }
    }
}
?>