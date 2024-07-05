<?php

include('conn/conn.php'); // Include your database connection script

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';



// //Load Composer's autoloader
// require 'vendor/autoload.php';


 if (isset($_POST['pre_id']) && $_POST['pre_id'] !== '') {
    
        // Initialize table HTML
        $message_body = '<h3> I agree with the prices you sent. I accept your quotation. Deliver the order to the address provided.</h3>';

        $pre_id = $_POST['pre_id'];
        
        // Query to select email for the given pre_id
        $sql = "SELECT email FROM prescription_details WHERE pre_id = $pre_id";

        // Perform the query
        $result = mysqli_query($conn, $sql);

        // Check if query was successful
        if ($result) {
            // Check if any rows were returned
            if (mysqli_num_rows($result) > 0) {
                // Fetch the email
                $row = mysqli_fetch_assoc($result);
                $email = $row['email'];

                // Now $email contains the email associated with $pre_id
                //echo "Email for pre_id $pre_id is: $email";
            } else {
                //echo "No email found for pre_id $pre_id";
            }
        } else {
            //echo "Error executing query: " . mysqli_error($conn);
        }
   
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->Username   = 'universitydoc254@gmail.com';                     //SMTP username
            $mail->Password   = 'pgedfybivpmewrpq';                               //SMTP password

            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom( $email ,  $email );
            $mail->addAddress('universitydoc254@gmail.com', 'Tharika');       //Add a recipient
            // $mail->addAddress('ellen@example.com');               //Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Accept Message';
            $mail->Body    =  $message_body ;



        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';


        if($mail->send()){
            echo "email sent!";
        }
        else{
            echo "email not sent!";
        }    


        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    else{
        echo "parameter not found";
    }
?>