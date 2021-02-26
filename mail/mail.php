<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

$name = $_POST['name'];
$phone = $_POST['phone'];
$comment = $_POST['comment'];

$message = <<<EOT
<html lang="ru">
<head>
  <title>Заявка с сайта</title>
</head>
<body>
  <p>Содержание</p>
  <table>
    <tr>
      <td>Имя</td>
      <td>$name</td>
    </tr>
    <tr>
      <td>Телефон</td>
      <td>$phone</td>
    </tr>
    <tr>
      <td>Комментарий</td>
      <td>$comment</td>
    </tr>
  </table>
</body>
</html>
EOT;

$alt_message = <<<EOT
Заявка с сайта

Содержание
Имя: $name
Телефон: $phone
Сообщение: $comment
EOT;


//Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.yandex.ru';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'info@rguitar.ru';                     //SMTP username
    $mail->Password   = '9I4I2bTbMK';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    $mail->CharSet = 'UTF-8';

    //Recipients
    $mail->setFrom('info@rguitar.ru', 'Студия звукозаписи «Рондо»');
    $mail->addAddress('as@solotony.com', 'Joe User');     //Add a recipient
    //$mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo('info@rguitar.ru', 'Студия звукозаписи «Рондо»');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Заявка с сайта';
    $mail->Body    = $message;
    $mail->AltBody = $alt_message;

    $mail->send();
    #echo 'Message has been sent';
    header('Location: /spasibo');
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}