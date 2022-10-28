<?php 
require '../vendor/autoload.php'; // If you're using Composer (recommended)

function sendEmail($db, $stage, $session, $id_rs, $uid, $reciver, $subject, $content, $errMessage){
    $email = new \SendGrid\Mail\Mail(); 
    $email->setFrom(SENDGRID_SENDER_EMAIL, SENDGRID_SENDER_NAME);
    $email->setSubject($subject);
    $email->addTo($reciver);
    $email->addContent("text/html", $content);
    $sendgrid = new \SendGrid(SENDGRID_API_KEY);
    try {
        $response = $sendgrid->send($email);
        // print $response->statusCode() . "\n";
        // print_r($response->headers());
        // print $response->body() . "\n";
    } catch (Exception $e) {
        echo 'Caught exception: '. $e->getMessage() ."\n";
        $strSQL = "INSERT INTO rec_error_log 
                (`erl_datetime`, `erl_stage`, `erl_tag`, `erl_uid`, `erl_session`, `erl_id_rs`)
                VALUES
                ('".date('Y-m-d H:i:s')."', '$stage', '$errMessage', '$uid', '$session', '$id_rs')
                ";
        $db->insert($strSQL, false);
        $db->close();
    }

}
?>