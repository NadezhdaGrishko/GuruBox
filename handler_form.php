<?php
    $branch = $_POST["branch"];
    $subject_area = $_POST["subject_area"];
    $cycle = $_POST["cycle"];
    $knowledge = $_POST["knowledge"];

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
