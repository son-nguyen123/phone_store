
<?php
// Kết nối tới cơ sở dữ liệu SQLite
try {
    $db = new PDO('sqlite:phone_store.sqlite');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Lỗi kết nối cơ sở dữ liệu: " . $e->getMessage());
}

// Xử lý khi người dùng gửi form thêm sản phẩm vào bảng comparison
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $data = [
            'product_name' => $_POST['product_name'] ?? '',
            'product_image' => $_POST['product_image'] ?? '',
            'feature_cpu' => $_POST['feature_cpu'] ?? '',
            'feature_ram' => $_POST['feature_ram'] ?? '',
            'feature_gpu' => $_POST['feature_gpu'] ?? '',
            'feature_screen' => $_POST['feature_screen'] ?? '',
        ];

        $sql = "INSERT INTO comparison (
            product_name, product_image, feature_cpu, feature_ram, feature_gpu, feature_screen
        ) VALUES (
            :product_name, :product_image, :feature_cpu, :feature_ram, :feature_gpu, :feature_screen
        )";

        $stmt = $db->prepare($sql);
        $stmt->execute($data);
        echo "<p style='color: green;'>Sản phẩm đã được thêm vào bảng so sánh!</p>";
    } catch (PDOException $e) {
        echo "<p style='color: red;'>Lỗi khi thêm sản phẩm: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
}

// Xử lý khi người dùng yêu cầu xóa sản phẩm trong bảng comparison
if (isset($_GET['delete_id'])) {
    try {
        $delete_id = (int)$_GET['delete_id'];
        $stmt = $db->prepare("DELETE FROM comparison WHERE id = :id");
        $stmt->execute([':id' => $delete_id]);
        echo "<p style='color: green;'>Sản phẩm đã được xóa thành công!</p>";
    } catch (PDOException $e) {
        echo "<p style='color: red;'>Lỗi khi xóa sản phẩm: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
}

// Lấy danh sách sản phẩm từ bảng comparison
try {
    $comparisons = $db->query("SELECT * FROM comparison")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Lỗi khi lấy danh sách sản phẩm: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Sản phẩm So sánh</title>
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
        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
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
    <h1>Thêm Sản phẩm vào bảng So sánh</h1>
    <form method="POST">
        <label for="product_name">Tên Sản phẩm:</label>
        <input type="text" id="product_name" name="product_name" required>

        <label for="product_image">Đường dẫn hình ảnh:</label>
        <input type="text" id="product_image" name="product_image" required>

        <label for="feature_cpu">CPU:</label>
        <input type="text" id="feature_cpu" name="feature_cpu">

        <label for="feature_ram">RAM:</label>
        <input type="text" id="feature_ram" name="feature_ram">

        <label for="feature_gpu">GPU:</label>
        <input type="text" id="feature_gpu" name="feature_gpu">

        <label for="feature_screen">Màn hình:</label>
        <input type="text" id="feature_screen" name="feature_screen">

        <button type="submit">Thêm Sản phẩm</button>
    </form>

    <h1>Danh sách Sản phẩm So sánh</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên Sản phẩm</th>
                <th>Hình ảnh</th>
                <th>CPU</th>
                <th>RAM</th>
                <th>GPU</th>
                <th>Màn hình</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($comparisons as $comparison): ?>
                <tr>
                    <td><?= $comparison['id'] ?></td>
                    <td><?= $comparison['product_name'] ?></td>
                    <td><img src="<?= $comparison['product_image'] ?>" alt="<?= $comparison['product_name'] ?>" width="100"></td>
                    <td><?= $comparison['feature_cpu'] ?></td>
                    <td><?= $comparison['feature_ram'] ?></td>
                    <td><?= $comparison['feature_gpu'] ?></td>
                    <td><?= $comparison['feature_screen'] ?></td>
                    <td><a href="?delete_id=<?= $comparison['id'] ?>" class="delete-btn">Xóa</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
