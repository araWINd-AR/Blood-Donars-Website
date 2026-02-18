<?php
// send_interest.php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/PHPMailer/src/Exception.php';
require __DIR__ . '/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    exit("Method Not Allowed");
}

// ✅ Read + basic sanitize
$name       = trim($_POST["name"] ?? "");
$gender     = trim($_POST["gender"] ?? "");
$bloodGroup = trim($_POST["blood_group"] ?? "");
$email      = trim($_POST["email"] ?? "");
$phone      = trim($_POST["phone"] ?? "");

// ✅ Validate
if ($name === "" || $gender === "" || $bloodGroup === "" || $email === "" || $phone === "") {
    exit("All fields are required.");
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    exit("Invalid email address.");
}

// ✅ Your admin receiving emails (where you want to receive messages)
$adminEmail1 = "aravindganipisetty@gmail.com";
$adminEmail2 = "ganiaravind699@gmail.com";

// ✅ Gmail SMTP sender (you must use App Password, not normal password)
$gmailUser = "YOUR_GMAIL@gmail.com";         // sender gmail
$gmailAppPassword = "YOUR_APP_PASSWORD";     // 16-char app password

$mail = new PHPMailer(true);

try {
    // SMTP settings
    $mail->isSMTP();
    $mail->Host       = "smtp.gmail.com";
    $mail->SMTPAuth   = true;
    $mail->Username   = $gmailUser;
    $mail->Password   = $gmailAppPassword;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // From / To
    $mail->setFrom($gmailUser, "VRSEC Blood Donors Website");
    $mail->addAddress($adminEmail1);
    $mail->addAddress($adminEmail2);

    // Reply-to user (so you can reply directly)
    $mail->addReplyTo($email, $name);

    // Email content
    $mail->isHTML(true);
    $mail->Subject = "New Blood Donation Interest - " . $name;

    $mail->Body =
        "<h2>New Donor Interest Submitted</h2>
        <p><b>Name:</b> " . htmlspecialchars($name) . "</p>
        <p><b>Gender:</b> " . htmlspecialchars($gender) . "</p>
        <p><b>Blood Group:</b> " . htmlspecialchars($bloodGroup) . "</p>
        <p><b>Email:</b> " . htmlspecialchars($email) . "</p>
        <p><b>Phone:</b> " . htmlspecialchars($phone) . "</p>
        <hr>
        <p>Sent from: <b>localhost/aravindweb</b></p>";

    $mail->AltBody =
        "New Donor Interest Submitted\n" .
        "Name: $name\nGender: $gender\nBlood Group: $bloodGroup\nEmail: $email\nPhone: $phone\n";

    $mail->send();

    // ✅ After send, go back with a success msg
    header("Location: details.html?sent=1");
    exit;

} catch (Exception $e) {
    // Show error (for debugging)
    exit("Mailer Error: " . $mail->ErrorInfo);
}
