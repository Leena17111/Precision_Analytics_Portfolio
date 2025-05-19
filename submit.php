<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name    = $_POST["name"]    ?? '';
    $email   = $_POST["email"]   ?? '';
    $subject = $_POST["subject"] ?? '';
    $message = $_POST["message"] ?? '';

    $errors = [];

    //  Validate input
    if (empty($name)) {
        $errors[] = "Name is required.";
    }

    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email format is invalid.";
    }

    if (empty($subject)) {
        $errors[] = "Subject is required.";
    }

    if (empty($message)) {
        $errors[] = "Message is required.";
    }

    if (empty($errors)) {
        // Sanitize inputs first
        $name    = filter_var($name, FILTER_SANITIZE_SPECIAL_CHARS);
        $email   = filter_var($email, FILTER_SANITIZE_EMAIL);
        $subject = filter_var($subject, FILTER_SANITIZE_SPECIAL_CHARS);
        $message = filter_var($message, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // Prepare and bind statement
        $stmt = $conn->prepare("INSERT INTO contact_form (name, email, subject, message) VALUES (?, ?, ?, ?)");
        if (!$stmt) {
            $errorMessage = "Prepare failed: " . $conn->error;
        } else {
            $stmt->bind_param("ssss", $name, $email, $subject, $message);

            if (!$stmt->execute()) {
                $errorMessage = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            } else {
                // Send the email
                $to = "precisionanalytics.official@gmail.com";

                $body = "You received a message from <strong>$name</strong>:<br><br>"
                    . "<strong>Email:</strong> $email<br>"
                    . "<strong>Subject:</strong> $subject<br>"
                    . "<strong>Message:</strong><br>" . nl2br($message);

                $headers  = "From: noreply@precisionanalytics.com\r\n";
                $headers .= "Reply-To: $email\r\n";
                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

                mail($to, $subject, $body, $headers);

                // Redirect to contact.html with success flag
                header("Location: contact.html?success=1");
                exit();
            }
            $stmt->close();
        }
        $conn->close();
    } else {
        // Show validation errors (optional: you can redirect with error info instead)
        echo "<h3 class='php-error-header'>Please fix the following errors:</h3>";
        echo "<ul class='php-error-list'>";
        foreach ($errors as $err) {
            echo "<li>$err</li>";
        }
        echo "</ul>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Contact Form</title>
</head>
<body>
</body>
</html>
