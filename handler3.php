<?php
    $email = $_POST["email"];
    $request = $_POST["request"];

    $to = "nadya.grishko.1999@gmail.com";
    $subject = "Новая заявка с формы";

    $message = "Email: $email\n";
    $message .= "Запрос: $request\n";

    $headers = "From: $email" . "\r\n" .
    "Reply-To: $email" .  "\r\n" . 
    "X-Mailer: PHP/" . phpversion();
    // mail($to, $subject, $message, $headers);
    if (mail($to, $subject, $message, $headers)) {
        echo "Письмо отправлено";
    } else {
        echo "Ошибка";
    }
?>
