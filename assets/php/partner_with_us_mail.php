<?php
header("Access-Control-Allow-Origin: *");

    // Only process POST reqeusts.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form fields and remove whitespace.
        $name = strip_tags(trim($_POST["name"]));
        $name = str_replace(array("\r","\n"),array(" "," "),$name);
        $name_company = trim($_POST["name_company"]);
        $phone = trim($_POST["phone"]);
        $email = trim($_POST["email"]);
        $message = trim($_POST["message"]);

        // Check that data was sent to the mailer.
        if ( empty($name_company) OR empty($name) OR empty($phone) OR empty($message) OR empty($email) ) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Please complete the form and try again.";
            exit;
        }

        // Set the recipient email address.
        $recipient = "dmitry@gnuhost.eu";

        // Set the email subject.
        $subject = "Arden - Test Mail From $name";

        // Build the email content.
        $email_content = nl2br("Company_name: $name_company \n Name: $name \n Phone: $phone \n Email: $email \n Message: $message") ;

        // Build the email headers.
       	$email_headers = "MIME-Version: 1.0" . "\r\n";
        $email_headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $email_headers .= 'From:' . $name . ' ' . 'noreply@dccpayments.com' . "\r\n";
        $email_headers .= 'Reply-To:' . $email . "\r\n";

        // Send the email.
        if (mail($recipient, $subject, $email_content, $email_headers)) {
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

