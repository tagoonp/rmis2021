<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

function sendEmail($db, $stage, $session, $id_rs, $uid, $reciver, $subject, $content, $errMessage){
    $mail = new PHPMailer(true);

    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();          
        $mail->charSet = "utf-8";                                  //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'rmismedpsu@gmail.com';                     //SMTP username
        $mail->Password   = 'songserm';                            //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    
        $subject = '';
        $content = '';

        $mail->setFrom('rmismedpsu@gmail.com', 'Research Management Information System, PSU');
        $mail->addAddress($reciver);     //Add a recipient
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $content;
        $mail->AltBody = $content;
    
        $mail->send();
        
    } catch (Exception $e) {
        // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        $strSQL = "INSERT INTO rec_error_log 
                   (`erl_datetime`, `erl_stage`, `erl_tag`, `erl_uid`, `erl_session`, `erl_id_rs`)
                   VALUES
                   ('".date('Y-m-d H:i:s')."', '$stage', '$errMessage', '$uid', '$session', '$id_rs')
                  ";
        $db->insert($strSQL, false);

    }

}
?>