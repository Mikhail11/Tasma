<?php

        $message = 'Клиент заполнил следующее: <br/>';
        $eol = "<br/>";
        $EOL = "\r\n";
        $boundary     = "--".md5(uniqid(time()));
        $message .= $eol;

        if (isset($_POST['name'])) {
            $message .= 'Имя: '.$_POST['name'].$eol;
        }
        if (isset($_POST['number'])) {
            $message .= 'Телефон: '.$_POST['number'].$eol;
        }
        if (isset($_POST['email'])) {
            $message .= 'E-mail: '.$_POST['email'].$eol;
        }
        if (isset($_POST['organisation'])) {
            $message .= 'Организация: '.$_POST['organisation'].$eol;
        }
        if (isset($_POST['comment'])) {
            $message .= 'Подробная информация: '.$_POST['comment'].$eol;
        }
        if (isset($_POST['project_type'])) {
            $message .= 'Тип проекта: '.$_POST['project_type'].$eol;
        }
        if (isset($_POST['project_time'])) {
            $message .= 'Хронометраж: '.$_POST['project_time'].$eol;
        }
        if (isset($_POST['filename'])) {
            $file = $_POST['filename'];
        } else {
            $file = '';
        }



// файл
$mailTo = "optimisist@gmail.com"; // кому
$from = "noreply@from.ru"; // от кого
$subject = "Заявка";

$r = sendMailAttachment($mailTo, $from, $subject, $message, $file); // отправка письма c вложением
echo ($r)?'Ваша заявка отправлена!':'Ошибка. Письмо не отправлено!';
//$r = sendMailAttachment($mailTo, $from, $subject, $message); // отправка письма без вложения
//echo ($r)?'Письмо отправлено':'Ошибка. Письмо не отправлено!';


function sendMailAttachment($mailTo, $from, $subject, $message, $file = false){
    $separator = "---"; // разделитель в письме
    // Заголовки для письма
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "From: $from\nReply-To: $from\n"; // задаем от кого письмо
    $headers .= "Content-Type: multipart/mixed; boundary=\"$separator\""; // в заголовке указываем разделитель
    // если письмо с вложением
    if($file){
        $bodyMail = "--$separator\n"; // начало тела письма, выводим разделитель
        $bodyMail .= "Content-Type:text/html; charset=\"utf-8\"\n"; // кодировка письма
        $bodyMail .= "Content-Transfer-Encoding: 7bit\n\n"; // задаем конвертацию письма
        $bodyMail .= $message."\n"; // добавляем текст письма
        $bodyMail .= "--$separator\n";
       $fileRead = fopen($file, "r"); // открываем файл
        $contentFile = fread($fileRead, filesize($file)); // считываем его до конца
        fclose($fileRead); // закрываем файл
        $bodyMail .= "Content-Type: application/octet-stream; name==?utf-8?B?".base64_encode(basename($file))."?=\n";
        $bodyMail .= "Content-Transfer-Encoding: base64\n"; // кодировка файла
        $bodyMail .= "Content-Disposition: attachment; filename==?utf-8?B?".base64_encode(basename($file))."?=\n\n";
        $bodyMail .= chunk_split(base64_encode($contentFile))."\n"; // кодируем и прикрепляем файл
        $bodyMail .= "--".$separator ."--\n";
    // письмо без вложения
    }else{
        $bodyMail = $message;
    }
    $result = mail($mailTo, $subject, $bodyMail, $headers); // отправка письма
    return $result;
}
?>
