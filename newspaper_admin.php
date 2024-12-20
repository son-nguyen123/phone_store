
<?php
// Kết nối tới cơ sở dữ liệu SQLite
try {
    $db = new PDO('sqlite:phone_store.sqlite');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Lỗi kết nối cơ sở dữ liệu: " . $e->getMessage());
}

// Xử lý khi người dùng gửi form thêm bài báo
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $data = [
            'image_news' => $_POST['image_news'] ?? '',
            'others_image_news' => $_POST['others_image_news'] ?? '',
            'news' => $_POST['news'] ?? '',
            'author' => $_POST['author'] ?? '',
        ];

        $sql = "INSERT INTO newspaper (image_news, others_image_news, news, author) 
                VALUES (:image_news, :others_image_news, :news, :author)";

        $stmt = $db->prepare($sql);
        $stmt->execute($data);
        echo "<p style='color: green;'>Bài báo đã được thêm thành công!</p>";
    } catch (PDOException $e) {
        echo "<p style='color: red;'>Lỗi khi thêm bài báo: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
}

// Xử lý khi người dùng yêu cầu xóa bài báo
if (isset($_GET['delete_id'])) {
    try {
        $delete_id = (int)$_GET['delete_id'];
        $stmt = $db->prepare("DELETE FROM newspaper WHERE id = :id");
        $stmt->execute([':id' => $delete_id]);
        echo "<p style='color: green;'>Bài báo đã được xóa thành công!</p>";
    } catch (PDOException $e) {
        echo "<p style='color: red;'>Lỗi khi xóa bài báo: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
}

// Lấy danh sách bài báo từ cơ sở dữ liệu
try {
    $articles = $db->query("SELECT * FROM newspaper ORDER BY time DESC")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Lỗi khi lấy danh sách bài báo: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý bài báo</title>
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
    </style>
</head>
<body>
<?php include 'admin/header.php'; ?>
<div class="container">
    <h1>Thêm bài báo mới</h1>
    <form method="POST" action="">
        <label for="image_news">Hình ảnh chính:</label>
        <input type="text" id="image_news" name="image_news" placeholder="URL hình ảnh chính">

        <label for="others_image_news">Hình ảnh khác:</label>
        <input type="text" id="others_image_news" name="others_image_news" placeholder="URL hình ảnh khác">

        <label for="news">Nội dung bài báo:</label>
        <textarea id="news" name="news" rows="5" class="full-width" placeholder="Nội dung bài báo"></textarea>

        <label for="author">Tác giả:</label>
        <input type="text" id="author" name="author" placeholder="Tên tác giả">

        <button type="submit">Thêm bài báo</button>
    </form>

    <h2>Danh sách bài báo</h2>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Hình ảnh chính</th>
            <th>Nội dung</th>
            <th>Thời gian</th>
            <th>Tác giả</th>
            <th>Hành động</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($articles as $article): ?>
            <tr>
                <td><?= $article['id'] ?></td>
                <td><img src="<?= htmlspecialchars($article['image_news']) ?>" alt="Hình ảnh" style="max-width: 100px;"></td>
                <td><?= htmlspecialchars(substr($article['news'], 0, 50)) ?>...</td>
                <td><?= htmlspecialchars($article['time']) ?></td>
                <td><?= htmlspecialchars($article['author']) ?></td>
                <td>
                    <a href="?delete_id=<?= $article['id'] ?>" class="delete-btn">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
