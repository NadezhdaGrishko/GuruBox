<?php
    $email = $_POST["email"];
    $request = $_POST["request"];
    $captcha = $_POST['g-recaptcha-response'];

    // Проверка reCAPTCHA
    $secretKey = "6LeKmtMrAAAAAF1NefdS0N9KP3v8BgyMX8fhhaII";
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = [
        'secret' => $secretKey,
        'response' => $captcha,
        'remoteip' => $_SERVER['REMOTE_ADDR']
    ];

    $options = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data)
        ]
    ];

    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    $responseKeys = json_decode($response, true);

    if (!$responseKeys["success"]) {
        echo 'Ошибка: Подтвердите, что вы не робот';
        exit;
    }

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
