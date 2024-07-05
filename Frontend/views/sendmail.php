<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

$response = array('status' => '', 'message' => '');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $companyname = filter_input(INPUT_POST, 'companyname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    

    if (!$email) {
        $response['status'] = 'error';
        $response['message'] = 'Invalid email address.';
        echo json_encode($response);
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = 0;                       // Enable verbose debug output
        $mail->isSMTP();                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';       // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                   // Enable SMTP authentication
        $mail->Username   = 'balasaikshirsagar@gmail.com'; // SMTP username
        $mail->Password   = 'bbhl mwkc ixdx zxzi';        // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable implicit TLS encryption
        $mail->Port       = 465;                    // TCP port to connect to

        
        $mail->setFrom('balasaikshirsagar@gmail.com', 'KSHIRSAGAR BALASAI');
        $mail->addAddress($email, $firstname); 

        
        $mail->isHTML(true);  
        $mail->Subject = 'Registration Details - Enco Parts';
        $mail->Body    = '<h2>Thank You For Registering with Us</h2>
                          <h4>Your Details as per Registration:</h4>
                          <h4>First Name: ' . htmlspecialchars($firstname) . '</h4>
                          <h4>Last Name: ' . htmlspecialchars($lastname) . '</h4>
                          <h4>Company Name: ' . htmlspecialchars($companyname) . '</h4>
                          <h4>Phone: ' . htmlspecialchars($phone) . '</h4>
                          <h4>Email: ' . htmlspecialchars($email) . '</h4>';
        $mail->AltBody = 'Thank You For Registering with Us. Here are your details: FirstName: ' . $firstname . ', LastName: ' . $lastname . ', CompanyName: ' . $companyname . ', Phone: ' . $phone . ', Email: ' . $email;

        $mail->send();
        $response['status'] = 'success';
        $response['message'] = 'Email has been sent successfully';
    } catch (Exception $e) {
        $response['status'] = 'error';
        $response['message'] = 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
    }

    echo json_encode($response);
} else {
    header("Location: ./indexNew.php");
    exit(0);
}
?>
