<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

function sendEmail($recipientEmail, $recipientName, $subject, $body, $altBody = '') {
    $mail = new PHPMailer(true);
    
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Host SMTP của Gmail
        $mail->SMTPAuth   = true; 
        $mail->Username   = 'sonthieucansa@gmail.com'; // Địa chỉ email gửi đi của bạn
        $mail->Password   = 'cjqk haoa hqli hptq'; // Mật khẩu ứng dụng bạn vừa tạo
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Bật mã hóa STARTTLS
        $mail->Port       = 587; // Port SMTP cho STARTTLS

        $mail->setFrom('sonthieucansa@gmail.com', 'SShop'); // Địa chỉ email gửi đi
        $mail->addAddress($recipientEmail, $recipientName); // Địa chỉ nhận email và tên người nhận
        $mail->isHTML(true); // Cho phép gửi email dạng HTML
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AltBody = $altBody; // Nội dung email thay thế cho các client không hỗ trợ HTML

        $mail->send(); // Gửi email
        return true; // Trả về true nếu gửi thành công
    } catch (Exception $e) {
        return "Mail could not be sent. Mailer Error: {$mail->ErrorInfo}"; // Báo lỗi nếu gửi thất bại
    }
}
?>