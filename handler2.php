<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $request = $_POST["request"];

    $to = "info@masicteam.ru";
    $subject = "Новая заявка с формы";

    $message = "Email: $email\n";
    $message .= "Запрос: $request\n";

    $headers = "From: boxguru.ru";
    mail($to, $subject, $message, $headers);
}
?>
