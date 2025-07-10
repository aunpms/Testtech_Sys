<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP; // เพิ่มบรรทัดนี้

require '../libs/PHPMailer/Exception.php';
require '../libs/PHPMailer/PHPMailer.php';
require '../libs/PHPMailer/SMTP.php'; // เพิ่มบรรทัดนี้

function send_reset_email($recipient_email, $recipient_name, $reset_link) {
    $mail = new PHPMailer(true); // Enable exceptions

    try {
        // Server settings (ตามข้อมูลที่คุณอั๋นให้มา)
        $mail->SMTPDebug = 0;                      // Enable verbose debug output (0 = off, 2 = client and server messages)
        $mail->isSMTP();                           // Send using SMTP
        $mail->Host       = 'mail.hdz-water.com';    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                  // Enable SMTP authentication
        $mail->Username   = 'payslip@hdz-water.com'; // SMTP username (อีเมลผู้ส่ง)
        $mail->Password   = 'hydrozone1999';                // SMTP password (รหัสผ่านอีเมลผู้ส่ง)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port       = 587;                   // TCP port to connect to

        // Recipients
        $mail->setFrom('payslip@hdz-water.com', 'A-Unit HR System'); // ผู้ส่ง (อีเมลและชื่อที่แสดง)
        $mail->addAddress($recipient_email, $recipient_name); // ผู้รับ (อีเมลและชื่อ)
        $mail->addReplyTo('payslip@hdz-water.com', 'A-Unit HR System'); // ตอบกลับไปที่อีเมลนี้

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->CharSet = 'UTF-8'; // <--- เพิ่มบรรทัดนี้
        $mail->Subject = 'A-Unit HR: ลิงก์สำหรับรีเซ็ตรหัสผ่านของคุณ';
        $mail->Body    = "
            <html>
            <head>
                <title>รีเซ็ตรหัสผ่าน A-Unit HR</title>
                <style>
                    body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                    .container { width: 80%; margin: 20px auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; background-color: #f9f9f9; }
                    .button { display: inline-block; padding: 10px 20px; margin-20px 0; background-color: #007bff; color: #ffffff; text-decoration: none; border-radius: 5px; }
                    .footer { margin-top: 30px; font-size: 0.9em; color: #777; }
                </style>
            </head>
            <body>
                <div class='container'>
                    <h2>เรียน คุณ{$recipient_name},</h2>
                    <p>เราได้รับคำขอรีเซ็ตรหัสผ่านสำหรับบัญชีของคุณ.</p>
                    <p>กรุณาคลิกลิงก์ด้านล่างเพื่อตั้งรหัสผ่านใหม่:</p>
                    <p><a href='{$reset_link}' class='button'>รีเซ็ตรหัสผ่านของคุณ</a></p>
                    <p>หากคุณไม่ได้ร้องขอการรีเซ็ตรหัสผ่านนี้ โปรดเพิกเฉยอีเมลนี้.</p>
                    <p class='footer'>
                        ขอแสดงความนับถือ,<br>
                        ทีมงาน A-Unit HR
                    </p>
                </div>
            </body>
            </html>
        ";
        $mail->AltBody = 'โปรดคลิกลิงก์นี้เพื่อรีเซ็ตรหัสผ่านของคุณ: ' . $reset_link . ' หากคุณไม่ได้ร้องขอการรีเซ็ตรหัสผ่านนี้ โปรดเพิกเฉยอีเมลนี้.'; // สำหรับ Client ที่ไม่รองรับ HTML

        $mail->send();
        return true; // ส่งสำเร็จ
    } catch (Exception $e) {
        // Echo PHPMailer error message for debugging purposes
        // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return false; // ส่งไม่สำเร็จ
    }
}
?>