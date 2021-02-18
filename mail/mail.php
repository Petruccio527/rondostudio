<?php
// несколько получателей
$to  = 'alex17b@yandex.ru' . ', '; // обратите внимание на запятую
$to .= 'peter.butrimoff@yandex.ru';
// тема письма
$subject = 'Заявка с сайта';
// текст письма
$message = '
<html>
<head>
  <title>Заявка с сайта</title>
</head>
<body>
  <p>Содержание</p>
  <table>
    <tr>
      <td>Имя</td>
      <td>'.$_POST['name'].'</td>
    </tr>
    <tr>
      <td>Телефон</td>
      <td>'.$_POST['phone'].'</td>
    </tr>
    <tr>
      <td>Сообщение</td>
      <td>'.$_POST['skype'].'</td>
    </tr>
  </table>
</body>
</html>
';
// Для отправки HTML-письма должен быть установлен заголовок Content-type
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
// Дополнительные заголовки
// $headers .= 'To: Mary <info@lending.rguitar.ru>' . "\r\n";
$headers .= 'From: ЗВУКОЗАПИСЬ РОНДО <info@lending.rguitar.ru>' . "\r\n";
// $headers .= 'Cc: info@lending.rguitar.ru' . "\r\n";
// $headers .= 'Bcc: info@lending.rguitar.ru' . "\r\n";
// Отправляем
mail($to, $subject, $message, $headers);
header('Location: /spasibo');
?>

