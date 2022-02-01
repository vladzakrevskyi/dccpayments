<?php
if(isset($_POST['submit'])){
    require 'phpmailer/PHPMailer.php';
    require 'phpmailer/SMTP.php';


try {
    //Server settings
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'dcc.gnuhost.eu';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'info@dcc.gnuhost.eu';                     // SMTP username
    $mail->Password   = 'dF@v5b89';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('from@dccpayments.com', 'Mailer');
    $mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
    $mail->addAddress('ellen@example.com');               // Name is optional
    $mail->addReplyTo('info@example.com', 'Information');

    // Attachments
    $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
};





header("Access-Control-Allow-Origin: *");

    // Only process POST reqeusts.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form fields and remove whitespace.
        $name = strip_tags(trim($_POST["con_name"]));
        $name = str_replace(array("\r","\n"),array(" "," "),$name);
        $phone = trim($_POST["con_phone"]);
        $state = trim($_POST["con_state"]);
        $email = trim($_POST["con_email"]);
        $message = trim($_POST["con_message"]);

        // Check that data was sent to the mailer.
        if ( empty($name) OR empty($phone) OR empty($state) OR empty($message) OR empty($email) ) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Please complete the form and try again.";
            exit;
        }

        // Set the recipient email address.
        $recipient = "dmitry@gnuhost.eu";

        // Set the email subject.
        $subject = "Request from DCC Payments website from $name";

        // Build the email content.
        $email_content = nl2br("Phone: $phone \n State: $state \n Name: $name \n Email: $email \n\n Message: $message") ;

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

