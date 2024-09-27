<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';







function sent_mail($sender_name,$recipient,$subject,$body){

$mail = new PHPMailer(true);

try {
    // ตั้งค่าเซิร์ฟเวอร์
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'Strorage.ok@gmail.com';
    $mail->Password   = 'bods lmvh pttn zcvb';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // ผู้รับ
    $mail->setFrom('Strorage.ok@gmail.com', $sender_name);
    $mail->addAddress($recipient);

    // เนื้อหา
    $mail->isHTML(false);
    $mail->Subject = $subject;
    $mail->Body    = $body;

    $mail->send();
    return true;
} catch (Exception $e) {
    // echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
    return false;
}

}


// sent_mail('me','xpi','Test email','This is a test email.');

?>



