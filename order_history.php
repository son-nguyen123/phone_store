<?php
include 'db.php';

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    // Xử lý yêu cầu POST khi nhấn nút Cancel Order
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])) {
        $orderId = $_POST['order_id'];

        try {
            // Sử dụng câu lệnh DELETE để xóa đơn hàng
            $stmt = $pdo->prepare("DELETE FROM orders WHERE order_id = :order_id AND customer_id = :customer_id");
            $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
            $stmt->bindParam(':customer_id', $userId, PDO::PARAM_INT);

            if ($stmt->execute()) {
                echo "<script>alert('Order has been deleted successfully.'); window.location.href = window.location.href;</script>";
            } else {
                echo "<script>alert('Failed to delete the order. Please try again later.'); window.location.href = window.location.href;</script>";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Truy vấn danh sách đơn hàng của người dùng
    try {
        $stmt = $pdo->prepare("SELECT * FROM orders WHERE customer_id = :user_id ORDER BY order_date DESC");
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        $orders = [];
    }
} else {
    header('Location: RealLogin.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <link rel="stylesheet" href="styles/bootstrap4/bootstrap.min.css">
    <link rel="stylesheet" href="plugins/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles/single_styles.css">
    <link rel="stylesheet" href="styles/single_responsive.css">
</head>
<body>
<div class="container mt-5">
    <?php if (empty($orders)): ?>
        <div class="alert alert-info" role="alert">
            You have no past orders.
        </div>
    <?php else: ?>
        <h1 class="mb-4">Your Order History</h1>
        <?php foreach ($orders as $order): ?>
            <div class="card mb-4">
                <div class="card-header">
                    <h2>Order ID: <?= $order['order_id'] ?></h2>
                </div>
                <div class="card-body">
                    <p><strong>Date:</strong> <?= date("d-m-Y H:i:s", strtotime($order['order_date'])) ?></p>
                    <p><strong>Status:</strong> <?= ucfirst($order['status']) ?></p>
                    <p><strong>Payment Status:</strong> <?= ucfirst($order['payment_status']) ?></p>
                    <p><strong>Payment Method:</strong> <?= ucfirst($order['payment_method']) ?></p>
                    <p><strong>Total Amount:</strong> <?= number_format($order['total_amount'], 0, ',', '.') ?> VND</p>
                    <p><strong>Shipping Address:</strong> <?= htmlspecialchars($order['address_shipping']) ?></p>
                    <p><strong>Notes:</strong> <?= htmlspecialchars($order['note']) ?></p>
                    <h3>Items:</h3>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach (json_decode($order['items'], true) as $item): ?>
                            <tr>
                                <td><?= htmlspecialchars($item['name']) ?></td>
                                <td><?= $item['quantity'] ?></td>
                                <td><?= number_format($item['price'], 0, ',', '.') ?> VND</td>
                                <td><?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?> VND</td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <form method="POST" action="" onsubmit="return confirm('Are you sure you want to delete this order?');">
                        <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
                        <button type="submit" class="btn btn-danger">Cancel Order</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
