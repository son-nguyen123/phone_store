<?php
include 'db.php';

// Check if user is logged in
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    // Get orders from the database
    $stmt = $pdo->prepare("SELECT * FROM orders WHERE customer_id = :user_id ORDER BY order_date DESC");
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->execute();

    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($orders)) {
        echo "<p>You have no past orders.</p>";
    } else {
        echo "<h1>Your Order History</h1>";

        // Display orders
        foreach ($orders as $order) {
            $orderDate = date("d-m-Y H:i:s", strtotime($order['order_date']));
            $totalAmount = number_format($order['total_amount'], 0, ',', '.') . ' VND';
            $status = ucfirst($order['status']);
            $paymentStatus = ucfirst($order['payment_status']);
            $paymentMethod = ucfirst($order['payment_method']);
            $items = json_decode($order['items'], true);

            echo "<div class='order'>";
            echo "<h2>Order ID: " . $order['order_id'] . "</h2>";
            echo "<p>Date: $orderDate</p>";
            echo "<p>Status: $status</p>";
            echo "<p>Payment Status: $paymentStatus</p>";
            echo "<p>Payment Method: $paymentMethod</p>";
            echo "<p>Total Amount: $totalAmount</p>";
            echo "<p>Shipping Address: " . htmlspecialchars($order['address_shipping']) . "</p>";
            echo "<p>Notes: " . htmlspecialchars($order['note']) . "</p>";
            echo "<h3>Items:</h3>";

            echo "<table border='1'>";
            echo "<thead><tr><th>Product Name</th><th>Quantity</th><th>Price</th><th>Total</th><th>Action</th></tr></thead>";
            echo "<tbody>";

            foreach ($items as $item) {
                $productName = htmlspecialchars($item['name']);
                $quantity = $item['quantity'];
                $price = number_format($item['price'], 0, ',', '.') . ' VND';
                $total = number_format($item['price'] * $quantity, 0, ',', '.') . ' VND';

                echo "<tr>";
                echo "<td>$productName</td>";
                echo "<td>$quantity</td>";
                echo "<td>$price</td>";
                echo "<td>$total</td>";
                echo "<td><a href='delete_order.php?order_id=" . $order['order_id'] . "&product_id=" . $item['product_id'] . "' onclick='return confirm(\"Are you sure you want to remove this product from your order?\");'>Remove</a></td>";
                echo "</tr>";
            }

            echo "</tbody></table>";
            echo "<a href='delete_order.php?order_id=" . $order['order_id'] . "' onclick='return confirm(\"Are you sure you want to delete this order?\");'>Delete Order</a>";
            echo "</div><hr>";
        }
    }
} else {
    echo "<p>You are not logged in. Please <a href='login.php'>log in</a> to view your order history.</p>";
}
?>

<!-- Optionally include some CSS to style the page -->
<style>
    h1, h2, h3 {
        font-family: Arial, sans-serif;
    }

    .order {
        margin-bottom: 20px;
        padding: 15px;
        border: 1px solid #ddd;
    }

    table {
        width: 100%;
        margin-top: 10px;
        border-collapse: collapse;
    }

    table th, table td {
        padding: 8px;
        text-align: left;
        border: 1px solid #ddd;
    }

    table th {
        background-color: #f4f4f4;
    }

    p {
        font-family: Arial, sans-serif;
    }

    a {
        text-decoration: none;
        color: #007bff;
    }

    a:hover {
        text-decoration: underline;
    }
</style>
