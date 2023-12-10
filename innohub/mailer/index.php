<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mail Sender</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" 
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap Form -->
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="black">
    <div class="container py-5">
        <div class="row ">
            <div class="col-md-8 mx-auto inner p-5">
                <h2 class="text-center fw-bold mb-4">Bulk Mail Sender</h2>
		<!-- <div class='alert alert-success'>Email sent successfully.</div> -->
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row ">
                        <div class="col-6  mb-3">
                            <label for="sender_name" class="form-label">Sender Name</label>
                            <input type="text" class="button form-control" id="sender_name" name="name" placeholder="Harendra" required>
                        </div>
                        <!-- <div class="col-6 mb-3">
                            <label for="sender" class="form-label">Sender Email</label>
                            <input type="email" class="form-control button" id="sender" name="email" placeholder="aman@domain.com" required>
                        </div> -->
                        <div class="col-6 mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text"  class="form-control button" id="subject" name="subject" placeholder="How are you?" required>
                        </div>
                        <!-- <div class="col-6">
                            <label for="attachments" class="form-label">Attachments (Multiple)</label>
                            <input type="file" class="form-control button" multiple id="attachments" name="attachments[]" placeholder="name@example.com">
                        </div> -->
                    </div>
                    <div class="mb-3">
                        <label for="recipient" class="form-label">Recipient Emails</label>
                        <textarea class="form-control button" id="recipient" name="email" placeholder="xyz@domain.com,
abc@domain.com" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="body" class="form-label">Body</label>
                        <textarea class="form-control button" id="body" name="body" placeholder="Hello,
Write your content here." rows="5" required></textarea>
                    </div>
                    <div>
                        <button class="btn btn-primary me-2 button" name="send" type="submit">Send Email</button>
                        <button class="btn btn-danger button" type="reset">Reset Form</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>




<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST['send']))

{
  $name=$_POST['name'];
  $subject=$_POST['subject'];
  $mail=$_POST['email'];
  $body=$_POST['body'];

  
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function


//Load Composer's autoloader
// require 'vendor/autoload.php';
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'streetman718@gmail.com';                     //SMTP username
    $mail->Password   = 'jxfl jfek xriw vvst';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('streetman718@gmail.com', 'Mailer');

    $recipientInput = $_POST['email']; // Assuming you are using a form with POST method

    // Split the input into an array of email addresses
    $recipients = explode(',', $recipientInput);

    foreach ($recipients as $recipient) {
        // Add a recipient
        $mail->addAddress(trim($recipient));

        // Email content
        // $mail->isHTML(true);  // Set email format to HTML
        // $mail->Subject = 'Subject';
        // $mail->Body    = 'This is the HTML message body';

        // Send the email
        // $mail->send();

        // Clear all addresses and attachments for the next iteration
        // $mail->clearAddresses();
    
    // $mail->addAddress('nainishsingh51@gmail.com', 'Chhetri');     //Add a recipient
    // $mail->addAddress($_POST["email"]);   
    // $mail->addAddress($_POST["email"]); 
    // $mail->addAddress('tulsivaasu@gmail.com', 'Chhetri');     
    // $mail->addAddress('anisha.sharma@jagannath.org', 'anisha');
    // $mail->addAddress('krusnansh2003@gmail.com', 'krusnansh');
    // $mail->addAddress('sk111kushwaha@gmail.com', 'lodu');  
             //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = "Subject : $subject";
    $mail->Body    = "Sender name : $name <br> Message : $body" ;
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    }
    echo "<script>
    alert('Sent Succesfully');
    document.location.href = 'index.php';
    </script>
    ";


} 
catch (Exception $e) {
    echo "<div class='alert'>Message could not be sent.</div>";
}


}


?>
