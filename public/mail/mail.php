<?php

function mailToParent($studentLogin, $mysqli, $message) {
    // get student id by login
    $studentID = $mysqli->query('SELECT id FROM users WHERE login="' . $studentLogin . '"');
    $studentID = $studentID->fetch_assoc();
    $studentID = $studentID['id'];

// get parent id
    $parentID = $mysqli->query('SELECT parent_id FROM student_parent WHERE student_id="' . $studentID . '"');
    $parentID = $parentID->fetch_assoc();
    $parentID = $parentID['parent_id'];

// get parent email
    $parentEmail = $mysqli->query('SELECT email FROM users WHERE id="' . $parentID . '"');
    $parentEmail = $parentEmail->fetch_assoc();
    $parentEmail = $parentEmail['email'];

// other email values
    $subject = "Образовательные результаты";
    $header = "Content-type:text/html; charset = UTF-8 \r\n";
    $header .="From: administration@laboratorium.ru\n";
    $header .="Reply to " . $parentEmail . "\n";

    mail($parentEmail, $subject, $message, $header);
}
?>
