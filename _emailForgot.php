<?php
include 'db.php';
require 'scripts/send_email.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $email = trim($_POST['email']); // Loại bỏ khoảng trắng thừa
    $_SESSION["email"] = $email;

    // Kiểm tra định dạng email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'invalid_email';
        exit();
    }

    try {
        // Tìm kiếm email trong cơ sở dữ liệu
        $stmt = $pdo->prepare("SELECT * FROM users WHERE TRIM(email) = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(); // Lấy trực tiếp dòng dữ liệu

        if ($user) {
            // Sinh mã xác thực ngẫu nhiên
            $verificationCode = rand(100000, 999999);
            $_SESSION['verification_code'] = $verificationCode;

            // Cấu hình email
            $subject = "Your Verification Code";
            $body = "Your Verification Code to Reset Password is: <strong>$verificationCode</strong>";
            $altBody = "Your Verification Code to Reset Password is: $verificationCode";

            // Gửi email
            $sendResult = sendEmail($email, $user['name'], $subject, $body, $altBody);

            if ($sendResult === true) {
                echo 'email_exists'; // Email gửi thành công
            } else {
                error_log("Failed to send email to $email.");
                echo 'email_failed'; // Thông báo lỗi gửi email
            }
        } else {
            echo 'email_not_found'; // Email không tồn tại
        }
    } catch (Exception $e) {
        // Xử lý lỗi khi truy vấn cơ sở dữ liệu hoặc gửi email
        error_log("Error in email forgot: " . $e->getMessage());
        echo 'error';
    }
} else {
    echo 'invalid_request'; // Đảm bảo chỉ chấp nhận POST
}
