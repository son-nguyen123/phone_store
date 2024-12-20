
<?php
// Kết nối tới cơ sở dữ liệu SQLite
try {
    $db = new PDO('sqlite:phone_store.sqlite');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Lỗi kết nối cơ sở dữ liệu: " . $e->getMessage());
}

// Xử lý khi người dùng gửi form thêm người dùng
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $data = [
            'name' => $_POST['name'] ?? '',
            'email' => $_POST['email'] ?? '',
            'password_hash' => password_hash($_POST['password'] ?? '', PASSWORD_BCRYPT),
            'date_of_birth' => $_POST['date_of_birth'] ?? '',
            'profile_image' => $_POST['profile_image'] ?? '',
            'cart' => $_POST['cart'] ?? '',
            'address' => $_POST['address'] ?? '',
            'order_price' => $_POST['order_price'] ?? 0.00,
            'address_shipping' => $_POST['address_shipping'] ?? '',
            'note' => $_POST['note'] ?? '',
            'number' => $_POST['number'] ?? '',
            'name_user' => $_POST['name_user'] ?? '',
        ];

        $sql = "INSERT INTO users (
            name, email, password_hash, date_of_birth, profile_image, cart, address, order_price, 
            address_shipping, note, number, name_user
        ) VALUES (
            :name, :email, :password_hash, :date_of_birth, :profile_image, :cart, :address, :order_price, 
            :address_shipping, :note, :number, :name_user
        )";

        $stmt = $db->prepare($sql);
        $stmt->execute($data);
        echo "<p style='color: green;'>Người dùng đã được thêm thành công!</p>";
    } catch (PDOException $e) {
        echo "<p style='color: red;'>Lỗi khi thêm người dùng: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
}

// Xử lý khi người dùng yêu cầu xóa người dùng
if (isset($_GET['delete_id'])) {
    try {
        $delete_id = (int)$_GET['delete_id'];
        $stmt = $db->prepare("DELETE FROM users WHERE user_id = :user_id");
        $stmt->execute([':user_id' => $delete_id]);
        echo "<p style='color: green;'>Người dùng đã được xóa thành công!</p>";
    } catch (PDOException $e) {
        echo "<p style='color: red;'>Lỗi khi xóa người dùng: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
}

// Lấy danh sách người dùng từ cơ sở dữ liệu
try {
    $users = $db->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Lỗi khi lấy danh sách người dùng: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Người Dùng</title>
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
        <h1>Thêm Người Dùng Mới</h1>
        <form action="" method="POST">
            <label for="name">Tên người dùng:</label>
            <input type="text" name="name" id="name" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>

            <label for="password">Mật khẩu:</label>
            <input type="password" name="password" id="password" required>

            <label for="date_of_birth">Ngày sinh:</label>
            <input type="date" name="date_of_birth" id="date_of_birth" required>

            <label for="profile_image">Ảnh đại diện:</label>
            <input type="text" name="profile_image" id="profile_image">

            <label for="cart">Giỏ hàng:</label>
            <input type="text" name="cart" id="cart">

            <label for="address">Địa chỉ:</label>
            <input type="text" name="address" id="address">

            <label for="order_price">Tổng giá trị đơn hàng:</label>
            <input type="number" name="order_price" id="order_price" step="0.01">

            <label for="address_shipping">Địa chỉ giao hàng:</label>
            <input type="text" name="address_shipping" id="address_shipping">

            <label for="note">Ghi chú:</label>
            <textarea name="note" id="note"></textarea>

            <label for="number">Số điện thoại:</label>
            <input type="text" name="number" id="number">

            <label for="name_user">Tên người dùng:</label>
            <input type="text" name="name_user" id="name_user">

            <button type="submit">Thêm người dùng</button>
        </form>

        <h1>Danh sách Người Dùng</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Ngày sinh</th>
                    <th>Địa chỉ</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['user_id']); ?></td>
                    <td><?php echo htmlspecialchars($user['name']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td><?php echo htmlspecialchars($user['date_of_birth']); ?></td>
                    <td><?php echo htmlspecialchars($user['address']); ?></td>
                    <td>
                        <a href="?delete_id=<?php echo $user['user_id']; ?>" class="delete-btn">Xóa</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
