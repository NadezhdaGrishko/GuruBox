<?php
    $email = $_POST["email"];
    $request = $_POST["request"];

    $to = "info@masicteam.ru";
    $subject = "Новая заявка с формы Guru Box";

    $message = "Email: $email\n";
    $message .= "Запрос: $request\n";

    $headers = "From: $email" . "\r\n" .
    "Reply-To: $email" .  "\r\n"; 

    if (mail($to, $subject, $message, $headers)) {
        echo "Письмо отправлено";
    } else {
        echo "Ошибка";
    }
?>
