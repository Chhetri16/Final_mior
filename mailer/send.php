<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["send"])) {
    // Set the sender's name, email, subject, and message
    $senderName = $_POST["sender_name"];
    $senderEmail = $_POST["sender"];
    $subject = $_POST["subject"];
    $body = $_POST["body"];

    // Set recipient emails
    $recipientEmails = explode(",", $_POST["recipient"]);

    // Additional headers
    $headers = "From: $senderName <$senderEmail>\r\n";
    $headers .= "Reply-To: $senderEmail\r\n";
    $headers .= "CC: cc@example.com\r\n"; // Add CC emails if needed
    $headers .= "BCC: bcc@example.com\r\n"; // Add BCC emails if needed

    // Handle attachments
    if (!empty($_FILES["attachments"]["name"][0])) {
        $attachments = array();
        $totalFiles = count($_FILES["attachments"]["name"]);

        for ($i = 0; $i < $totalFiles; $i++) {
            $fileName = $_FILES["attachments"]["name"][$i];
            $tmpName = $_FILES["attachments"]["tmp_name"][$i];
            $attachments[] = array("name" => $fileName, "tmp_name" => $tmpName);
        }

        foreach ($attachments as $attachment) {
            $file = $attachment["tmp_name"];
            $fileType = mime_content_type($file);
            $fileSize = filesize($file);

            $fileContent = file_get_contents($file);
            $fileContent = chunk_split(base64_encode($fileContent));

            $boundary = md5(uniqid(rand(), true));

            // Attach the file to the email
            $headers .= "--$boundary\r\n";
            $headers .= "Content-Type: $fileType; name=\"$fileName\"\r\n";
            $headers .= "Content-Transfer-Encoding: base64\r\n";
            $headers .= "Content-Disposition: attachment; filename=\"$fileName\"\r\n\r\n";
            $headers .= "$fileContent\r\n\r\n";
        }

        $headers .= "--$boundary--";
    }

    // Send email to each recipient
    foreach ($recipientEmails as $recipient) {
        mail($recipient, $subject, $body, $headers);
    }

    echo '<div class="alert alert-success">Email sent successfully.</div>';
} else {
    // Redirect to the form page if accessed directly without form submission
    header("Location: your_form_page.html");
    exit();
}
?>
