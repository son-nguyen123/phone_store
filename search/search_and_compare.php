<?php
include 'db.php';

// Lấy query tìm kiếm từ URL
$searchQuery = $_GET['query'] ?? '';

// Tìm kiếm sản phẩm
if (!empty($searchQuery)) {
    $query = "SELECT product_id, name FROM products WHERE name LIKE :searchQuery LIMIT 10";
    $stmt = $pdo->prepare($query);
    $searchTerm = '%' . $searchQuery . '%';
    $stmt->bindParam(':searchQuery', $searchTerm, PDO::PARAM_STR);
    $stmt->execute();
    
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($results);
    exit;
}

// Lấy ID của sản phẩm 1 và sản phẩm 2 từ query string
$product1Id = (int)($_GET['product1_id'] ?? 0);
$product2Id = (int)($_GET['product2_id'] ?? 0);

// Nếu không có ID sản phẩm, trả về lỗi
if ($product1Id == 0 || $product2Id == 0) {
    echo json_encode(['error' => 'Both product IDs are required']);
    exit;
}

// Lấy thông tin sản phẩm 1
$query1 = "SELECT * FROM products WHERE product_id = :product1Id";
$stmt1 = $pdo->prepare($query1);
$stmt1->bindParam(':product1Id', $product1Id, PDO::PARAM_INT);
$stmt1->execute();
$product1 = $stmt1->fetch(PDO::FETCH_ASSOC) ?: [
    'name' => 'Product 1',
    'screen_size' => 'N/A',
    'chipset' => 'N/A',
    'rear_camera' => 'N/A',
    'front_camera' => 'N/A',
    'price' => 0,
];

// Lấy thông tin sản phẩm 2
$query2 = "SELECT * FROM products WHERE product_id = :product2Id";
$stmt2 = $pdo->prepare($query2);
$stmt2->bindParam(':product2Id', $product2Id, PDO::PARAM_INT);
$stmt2->execute();
$product2 = $stmt2->fetch(PDO::FETCH_ASSOC) ?: [
    'name' => 'Product 2',
    'screen_size' => 'N/A',
    'chipset' => 'N/A',
    'rear_camera' => 'N/A',
    'front_camera' => 'N/A',
    'price' => 0,
];

// Trả về dữ liệu cho hai sản phẩm
echo json_encode(['product1' => $product1, 'product2' => $product2]);
?>
