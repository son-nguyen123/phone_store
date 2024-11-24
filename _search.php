<?php
include 'db.php';
header('Content-Type: application/json');

try {
    $search = '%' . ($_GET['search'] ?? '') . '%';
    $products = [];

    if (!empty(trim($_GET['search'] ?? ''))) {
        $stmt = $pdo->prepare("SELECT * FROM products WHERE name LIKE :query COLLATE NOCASE");
        $stmt->execute(['query' => $search]);
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    echo json_encode($products);
} catch (PDOException $e) {
    error_log("Error fetching products: " . $e->getMessage());
    echo json_encode(["status" => "error", "message" => "Error fetching products."]);
}
?>