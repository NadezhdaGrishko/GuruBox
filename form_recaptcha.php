<?php
    $branch = $_POST["branch"];
    $subject_area = $_POST["subject_area"];
    $cycle = $_POST["cycle"];
    $knowledge = $_POST["knowledge"];
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
        die('Подтвердите, что вы не робот');
    }

    $to = "info@masicteam.ru";
    $subject = "Новая заявка с формы Guru Box";

    if (!empty($_FILES['file']['name'][0])) {
        $fileCount = count($_FILES['file']['name']);
        $fileList = '';
    for ($i = 0; $i < $fileCount; $i++) {
        $fileName = $_FILES['file']['name'][$i];
        $fileTmpName = $_FILES['file']['tmp_name'][$i];
        $fileList .= "Attached File " . ($i + 1) . ": $fileName\n";
        move_uploaded_file($fileTmpName, "./uploads/$fileName");
    }
    } else {
        $fileCount = 0;
    }

    $message = "Отрасль: $branch\n";
    $message .= "Предметная область: $subject_area\n";
    $message .= "Этап или цикл: $cycle\n";
    $message .= "Знания по существу: $knowledge\n";

    $headers = "From: boxguru.ru";

    if (mail($to, $subject, $message, $headers)) {
        echo "Письмо отправлено";
    } else {
        echo "Ошибка";
    }
?>
