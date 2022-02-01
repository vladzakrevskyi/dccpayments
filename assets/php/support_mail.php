<?php
require("smtp.php");
header("Access-Control-Allow-Origin: *");

    // Only process POST reqeusts.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form fields and remove whitespace.
        $name = strip_tags(trim($_POST["con_name"]));
        $name = str_replace(array("\r","\n"),array(" "," "),$name);
        $email = trim($_POST["con_email"]);
        $message = trim($_POST["con_message"]);

        // Check that data was sent to the mailer.
        if ( empty($name) OR empty($message) OR empty($email) ) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Please complete the form and try again.";
            exit;
        }

        // Set the recipient email address.
        $recipient = "dmitry@gnuhost.eu";

        // Set the email subject.
        $subject = "Contact from DCC Payments website from $name";

        // Build the email content.
        $email_content = nl2br("Name: $name \n Email: $email \n\n Message: $message") ;

        // Build the email headers.
       	$email_headers = "MIME-Version: 1.0" . "\r\n";
        $email_headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $email_headers .= 'From:' . $name . ' ' . 'noreply@dccpayments.com' . "\r\n";
        $email_headers .= 'Reply-To:' . $email . "\r\n";

        // Send the email.
        if (MailSmtp($recipient, $subject, $email_content, $email_headers)) {
            // Set a 200 (okay) response code.
            http_response_code(200);
            echo "Thank You! ".$name." , Your message has been sent.";
        } else {
            // Set a 500 (internal server error) response code.
            http_response_code(500);
            echo "Oops! Something went wrong and we couldn't send your message.";
        }

    } else {
        // Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo "There was a problem with your submission, please try again.";
    }

?>
