<?php
// Kết nối tới cơ sở dữ liệu SQLite
try {
    $db = new PDO('sqlite:phone_store.sqlite');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Lỗi kết nối cơ sở dữ liệu: " . $e->getMessage());
}

// Xử lý khi người dùng gửi form thêm bình luận
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $data = [
            'user_id' => $_POST['user_id'] ?? 0,
            'product_id' => $_POST['product_id'] ?? 0,
            'product_table' => $_POST['product_table'] ?? '',
            'content' => $_POST['content'] ?? '',
        ];

        $sql = "INSERT INTO comments (user_id, product_id, product_table, content)
                VALUES (:user_id, :product_id, :product_table, :content)";

        $stmt = $db->prepare($sql);
        $stmt->execute($data);
        echo "<p style='color: green;'>Bình luận đã được thêm thành công!</p>";
    } catch (PDOException $e) {
        echo "<p style='color: red;'>Lỗi khi thêm bình luận: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
}

// Xử lý khi người dùng yêu cầu xóa bình luận
if (isset($_GET['delete_id'])) {
    try {
        $delete_id = (int)$_GET['delete_id'];
        $stmt = $db->prepare("DELETE FROM comments WHERE comment_id = :comment_id");
        $stmt->execute([':comment_id' => $delete_id]);
        echo "<p style='color: green;'>Bình luận đã được xóa thành công!</p>";
    } catch (PDOException $e) {
        echo "<p style='color: red;'>Lỗi khi xóa bình luận: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
}

// Lấy danh sách bình luận từ cơ sở dữ liệu
try {
    $comments = $db->query("SELECT * FROM comments")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Lỗi khi lấy danh sách bình luận: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Bình luận</title>
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
        <h1>Thêm Bình luận</h1>
        <form method="POST">
            <label for="user_id">User ID:</label>
            <input type="number" id="user_id" name="user_id" required>
            
            <label for="product_id">Product ID:</label>
            <input type="number" id="product_id" name="product_id" required>
            
            <label for="product_table">Product Table:</label>
            <input type="text" id="product_table" name="product_table" required>
            
            <label for="content">Bình luận:</label>
            <textarea id="content" name="content" rows="4" required></textarea>

            <button type="submit">Thêm Bình luận</button>
        </form>

        <h1>Danh sách Bình luận</h1>
        <table>
            <thead>
                <tr>
                    <th>Comment ID</th>
                    <th>User ID</th>
                    <th>Product ID</th>
                    <th>Product Table</th>
                    <th>Nội dung</th>
                    <th>Thời gian</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($comments as $comment): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($comment['comment_id']); ?></td>
                        <td><?php echo htmlspecialchars($comment['user_id']); ?></td>
                        <td><?php echo htmlspecialchars($comment['product_id']); ?></td>
                        <td><?php echo htmlspecialchars($comment['product_table']); ?></td>
                        <td><?php echo htmlspecialchars($comment['content']); ?></td>
                        <td><?php echo htmlspecialchars($comment['time']); ?></td>
                        <td>
                            <a href="?delete_id=<?php echo $comment['comment_id']; ?>" class="delete-btn">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
