<?php

$to = "richardcobain@outlook.com";
$subject = "Заголовок письма";
$message = "<p>Text</p>";


$header = "Content-type:text/html; charset = windows-1251 \r\n";
$header .="From: azat.rak@mail.ru";
$header .="Reply to richardcobain@outlook.com";

mail($to, $subject, $message, $header);
?>
