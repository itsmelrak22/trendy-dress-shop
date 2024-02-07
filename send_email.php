<?php
require("PHPMailer/src/PHPMailer.php");
require("PHPMailer/src/SMTP.php");


function sendCustomerEmail($MAIL_TO, $PASSWORD, $RECEIVER_NAME, $STATUS, $SUBJECT){

    $statusMessages = array(
        "PLACED_ORDER" => "We have received your order! We're currently preparing your items. You'll receive an update when your order is ready to ship. Thank you for choosing our store!",
        "TO_SHIP" => "Your order has been processed and is now ready to be shipped. We'll update you once your package is on its way. Thank you for shopping with us!",
        "TRANSIT" => "Good news! Your order is on its way. You can track your package with the tracking number provided. We hope you're as excited as we are!",
        "DELIVERED" => "Your package has been delivered! We hope you love your new clothes. Thank you for shopping with us and we look forward to serving you again.",
        "CANCELLED" => "Your order has been cancelled as per your request. If you have any questions or need further assistance, feel free to contact us. We're here to help!"
    );

    $mailTo = $MAIL_TO;

    $mail = new PHPMailer\PHPMailer\PHPMailer();
    // $mail->SMTPDebug = 3;
    $mail->isSMTP();
    $mail->Host = "mail.smtp2go.com";
    $mail->SMTPAuth = true;

    $mail->Username = "trendydressshop.online";
    $mail->Password = "password";
    $mail->SMTPSecure = "tls";

    $mail->Port = "2525";
    $mail->From = "admin@trendydressshop.online";
    $mail->FromName = "Trendy Dress Shop";
    $mail->addAddress($mailTo, $RECEIVER_NAME );

    $mail->isHTML('true');
    $mail->Subject = $SUBJECT;
    $mail->Body = $body;
    $mail->AltBody = "Alt Body";

    if(!$mail->send()){
        return 500;
        // echo "Mailer Error :". $mail->ErrorInfo;
    }else{
        return 200;
        // echo "Message Sent";
    }
}


?>