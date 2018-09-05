<?php

$mailTo = '';
$configFile = 'config.php';
if (file_exists($configFile)) {
    include($configFile);
} else {
    http_response_code(500);
    exit();
}

if (empty($_POST['name']) ||
    empty($_POST['email']) ||
    empty($_POST['phone']) ||
    empty($_POST['message']) ||
    !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    http_response_code(500);
    exit();
}

$name = strip_tags(htmlspecialchars($_POST['name']));
$email = strip_tags(htmlspecialchars($_POST['email']));
$phone = strip_tags(htmlspecialchars($_POST['phone']));
$message = strip_tags(htmlspecialchars($_POST['message']));
$date = date('d/m/Y H:i:s');

$subject = "FrankProjects Contact Form";
$body  = "You have received a new message from your website contact form.\n\n";
$body .= "Here are the details:\n\n";
$body .= "Name: {$name}\n\n";
$body .= "Email: {$email}\n\n";
$body .= "Phone: {$phone}\n\n";
$body .= "Message:\n{$message}\n\n";
$body .= "Send on {$date} (IP address " . $_SERVER['REMOTE_ADDR'] . ") from " . $_SERVER['HTTP_HOST'] . "\n\n";

$header = "From: FrankProjects Contact Form <noreply@frankprojects.com>";

if (!mail($mailTo, $subject, $body, $header)) {
    http_response_code(500);
}
