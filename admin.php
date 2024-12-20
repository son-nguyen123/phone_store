
<?php
// Kết nối tới cơ sở dữ liệu SQLite
try {
    $db = new PDO('sqlite:phone_store.sqlite');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Lỗi kết nối cơ sở dữ liệu: " . $e->getMessage());
}

// Xử lý khi người dùng gửi form thêm sản phẩm
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $data = [
            'brand' => $_POST['brand'] ?? '',
            'name' => $_POST['name'] ?? '',
            'storage' => $_POST['storage'] ?? '',
            'description' => $_POST['description'] ?? '',
            'price' => $_POST['price'] ?? 0,
            'image' => $_POST['image'] ?? '',
            'other_images' => $_POST['other_images'] ?? '',
            'screen_size' => $_POST['screen_size'] ?? '',
            'screen_technology' => $_POST['screen_technology'] ?? '',
            'rear_camera' => $_POST['rear_camera'] ?? '',
            'front_camera' => $_POST['front_camera'] ?? '',
            'chipset' => $_POST['chipset'] ?? '',
            'internal_memory' => $_POST['internal_memory'] ?? '',
            'sim_type' => $_POST['sim_type'] ?? '',
            'screen_resolution' => $_POST['screen_resolution'] ?? '',
            'long_description' => $_POST['long_description'] ?? '',
            'video' => $_POST['video'] ?? '',
            'state' => $_POST['state'] ?? 'old',
            'sale_price' => $_POST['sale_price'] ?? 0,
            'sale_percent' => $_POST['sale_percent'] ?? 0,
        ];

        $sql = "INSERT INTO products (
            brand, name, storage, description, price, image, other_images, screen_size, screen_technology, 
            rear_camera, front_camera, chipset, internal_memory, sim_type, screen_resolution, long_description, 
            video, state, sale_price, sale_percent
        ) VALUES (
            :brand, :name, :storage, :description, :price, :image, :other_images, :screen_size, :screen_technology, 
            :rear_camera, :front_camera, :chipset, :internal_memory, :sim_type, :screen_resolution, :long_description, 
            :video, :state, :sale_price, :sale_percent
        )";

        $stmt = $db->prepare($sql);
        $stmt->execute($data);
        echo "<p style='color: green;'>Sản phẩm đã được thêm thành công!</p>";
    } catch (PDOException $e) {
        echo "<p style='color: red;'>Lỗi khi thêm sản phẩm: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
}

// Xử lý khi người dùng yêu cầu xóa sản phẩm
if (isset($_GET['delete_id'])) {
    try {
        $delete_id = (int)$_GET['delete_id'];
        $stmt = $db->prepare("DELETE FROM products WHERE product_id = :product_id");
        $stmt->execute([':product_id' => $delete_id]);
        echo "<p style='color: green;'>Sản phẩm đã được xóa thành công!</p>";
    } catch (PDOException $e) {
        echo "<p style='color: red;'>Lỗi khi xóa sản phẩm: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
}

// Lấy danh sách sản phẩm từ cơ sở dữ liệu
try {
    $products = $db->query("SELECT * FROM products")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Lỗi khi lấy danh sách sản phẩm: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <link rel="stylesheet" href="admin/header_admin.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        table th {
            background-color: #007bff;
            color: white;
        }
        .delete-btn {
            color: red;
            cursor: pointer;
            text-decoration: none;
        }
        .delete-btn:hover {
            text-decoration: underline;
        }
        h1 {
            text-align: center;
        }
        form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        label {
            font-weight: bold;
        }
        input, textarea, select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .full-width {
            grid-column: span 2;
        }
        button {
            grid-column: span 2;
            padding: 10px;
            background: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background: #218838;
        }

    </style>
</head>
<body>
<?php include 'admin/header.php'; ?>
<div class="container">
    <h1>Thêm sản phẩm mới</h1>
    <form method="POST" action="">
        <div>
            <label for="brand">Thương hiệu</label>
            <input type="text" id="brand" name="brand" required>
        </div>
        <div>
            <label for="name">Tên sản phẩm</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="storage">Dung lượng</label>
            <input type="text" id="storage" name="storage" required>
        </div>
        <div>
            <label for="price">Giá</label>
            <input type="number" id="price" name="price" required>
        </div>
        <div>
            <label for="image">Hình ảnh chính</label>
            <input type="text" id="image" name="image" required>
        </div>
        <div>
            <label for="other_images">Hình ảnh khác</label>
            <input type="text" id="other_images" name="other_images">
        </div>
        <div>
            <label for="screen_size">Kích thước màn hình</label>
            <input type="text" id="screen_size" name="screen_size">
        </div>
        <div>
            <label for="screen_technology">Công nghệ màn hình</label>
            <input type="text" id="screen_technology" name="screen_technology">
        </div>
        <div>
            <label for="rear_camera">Camera sau</label>
            <input type="text" id="rear_camera" name="rear_camera">
        </div>
        <div>
            <label for="front_camera">Camera trước</label>
            <input type="text" id="front_camera" name="front_camera">
        </div>
        <div>
            <label for="chipset">Chipset</label>
            <input type="text" id="chipset" name="chipset">
        </div>
        <div>
            <label for="internal_memory">RAM</label>
            <input type="text" id="internal_memory" name="internal_memory">
        </div>
        <div>
            <label for="sim_type">Loại SIM</label>
            <input type="text" id="sim_type" name="sim_type">
        </div>
        <div>
            <label for="screen_resolution">Độ phân giải màn hình</label>
            <input type="text" id="screen_resolution" name="screen_resolution">
        </div>
        <div class="full-width">
            <label for="description">Mô tả ngắn</label>
            <textarea id="description" name="description" rows="3" required></textarea>
        </div>
        <div class="full-width">
            <label for="long_description">Mô tả chi tiết</label>
            <textarea id="long_description" name="long_description" rows="5"></textarea>
        </div>
        <div>
            <label for="video">Video</label>
            <input type="text" id="video" name="video">
        </div>
        <div>
            <label for="state">Trạng thái</label>
            <select id="state" name="state">
                <option value="new">Mới</option>
                <option value="used">Đã qua sử dụng</option>
            </select>
        </div>
        <div>
            <label for="sale_price">Giá khuyến mãi</label>
            <input type="number" id="sale_price" name="sale_price">
        </div>
        <div>
            <label for="sale_percent">Phần trăm khuyến mãi</label>
            <input type="number" id="sale_percent" name="sale_percent">
        </div>
        <button type="submit">Thêm sản phẩm</button>
    </form>

    <h2>Danh sách sản phẩm</h2>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Giá</th>
            <th>Hành động</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?= $product['product_id'] ?></td>
                <td><?= htmlspecialchars($product['name']) ?></td>
                <td><?= number_format($product['price'], 0, ',', '.') ?> VND</td>
                <td>
                    <a href="?delete_id=<?= $product['product_id'] ?>" class="delete-btn">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
