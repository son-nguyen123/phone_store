
<?php
// Kết nối tới cơ sở dữ liệu SQLite
try {
    $db = new PDO('sqlite:phone_store.sqlite');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Lỗi kết nối cơ sở dữ liệu: " . $e->getMessage());
}

// Xử lý khi người dùng gửi form thêm banner
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_banner'])) {
    try {
        $data = [
            'image_path' => $_POST['image_path'] ?? '',
            'alt_text' => $_POST['alt_text'] ?? '',
            'slide_order' => $_POST['slide_order'] ?? 0,
            'active' => isset($_POST['active']) ? 1 : 0,
        ];

        $sql = "INSERT INTO banners (image_path, alt_text, slide_order, active) 
                VALUES (:image_path, :alt_text, :slide_order, :active)";
        $stmt = $db->prepare($sql);
        $stmt->execute($data);
        echo "<p style='color: green;'>Banner đã được thêm thành công!</p>";
    } catch (PDOException $e) {
        echo "<p style='color: red;'>Lỗi khi thêm banner: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
}

// Xử lý khi người dùng yêu cầu xóa banner
if (isset($_GET['delete_id'])) {
    try {
        $delete_id = (int)$_GET['delete_id'];
        $stmt = $db->prepare("DELETE FROM banners WHERE banner_id = :banner_id");
        $stmt->execute([':banner_id' => $delete_id]);
        echo "<p style='color: green;'>Banner đã được xóa thành công!</p>";
    } catch (PDOException $e) {
        echo "<p style='color: red;'>Lỗi khi xóa banner: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
}

// Lấy danh sách banner từ cơ sở dữ liệu
try {
    $banners = $db->query("SELECT * FROM banners")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Lỗi khi lấy danh sách banner: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Banner</title>
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
        <h1>Thêm Banner Mới</h1>
        <form action="" method="POST">
            <label for="image_path">Đường dẫn hình ảnh</label>
            <input type="text" name="image_path" id="image_path" required>

            <label for="alt_text">Văn bản mô tả hình ảnh (Alt Text)</label>
            <input type="text" name="alt_text" id="alt_text">

            <label for="slide_order">Thứ tự hiển thị</label>
            <input type="number" name="slide_order" id="slide_order" value="0" required>

            <label for="active">Trạng thái (Active)</label>
            <input type="checkbox" name="active" id="active">

            <button type="submit" name="submit_banner">Thêm Banner</button>
        </form>

        <h1>Danh sách Banner</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Đường dẫn hình ảnh</th>
                    <th>Văn bản mô tả</th>
                    <th>Thứ tự hiển thị</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($banners as $banner): ?>
                    <tr>
                        <td><?= $banner['banner_id'] ?></td>
                        <td><img src="<?= $banner['image_path'] ?>" alt="<?= $banner['alt_text'] ?>" width="100"></td>
                        <td><?= $banner['alt_text'] ?></td>
                        <td><?= $banner['slide_order'] ?></td>
                        <td><?= $banner['active'] ? 'Kích hoạt' : 'Không kích hoạt' ?></td>
                        <td><a href="?delete_id=<?= $banner['banner_id'] ?>" class="delete-btn">Xóa</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
