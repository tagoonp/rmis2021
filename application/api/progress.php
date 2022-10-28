<?php 
require('../configuration/server.inc.php');
require('../configuration/configuration.php');
require('../configuration/database.php'); 
require('../configuration/session.php'); 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$db = new Database();
$conn = $db->conn();

require('../configuration/sendemail.php'); 

if(!isset($_REQUEST['stage'])){
  mysqli_close($conn);
  die();
}

$stage = mysqli_real_escape_string($conn, $_REQUEST['stage']);

if($stage == 'end_review_session'){
    if(
        (!isset($_REQUEST['id_rs'])) ||
        (!isset($_REQUEST['session_id'])) ||
        (!isset($_REQUEST['progress'])) ||
        (!isset($_REQUEST['uid']))
      ){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }
    $id_rs = mysqli_real_escape_string($conn, $_REQUEST['id_rs']);
    $session_id = mysqli_real_escape_string($conn, $_REQUEST['session_id']);
    $progress = mysqli_real_escape_string($conn, $_REQUEST['progress']);
    $uid = mysqli_real_escape_string($conn, $_REQUEST['uid']);

    $strSQL = "UPDATE rec_reviewer SET rv_session_end = '1' WHERE rv_session_id = '$session_id'";
    $res = $db->execute($strSQL);

    $strSQL = "UPDATE rec_assesment_".$progress." SET rac_session_end = '1' WHERE rac_sid = '$session_id'";
    $res = $db->execute($strSQL);

    $strSQL = "UPDATE rec_comment SET recc_q_end = '1' WHERE recc_session_id = '$session_id'";
    $res = $db->execute($strSQL);


    $strSQL = "INSERT INTO rec_progress_log (`rpl_datetime`, `rpl_uid`, `rpl_role`, `rpl_calculate`, `rpl_activity`, `rpl_message`, `rpl_session`, `rpl_relate_status`)
                VALUES ('$datetime', '$uid', 'ec', '0', 'Reset review session', ', '$session_id', '20')
                ";
    $resInsert = $db->insert($strSQL, false);

    $strSQL = "INSERT INTO rec_note (`log_activity`, `log_detail`, `log_ip`, `log_datetime`, `log_id_rs`,  `log_session_id`, `log_by_role`, `log_countrange`, `log_by_id`)
            VALUES ('Add not', '<p>[System] Reset review session</p>', '$ip', '$datetime', '$id_rs', '$session_id', 'ec', '0', '$uid')
            ";
    $resInsert = $db->insert($strSQL, false);

    $return['status'] = 'Success';
    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'set_status_20'){
    if(
        (!isset($_REQUEST['id_rs'])) ||
        (!isset($_REQUEST['session_id'])) ||
        (!isset($_REQUEST['uid'])) ||
        (!isset($_REQUEST['role'])) ||
        (!isset($_REQUEST['message']))
      ){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }
    $id_rs = mysqli_real_escape_string($conn, $_REQUEST['id_rs']);
    $session_id = mysqli_real_escape_string($conn, $_REQUEST['session_id']);
    $uid = mysqli_real_escape_string($conn, $_REQUEST['uid']);
    $role = mysqli_real_escape_string($conn, $_REQUEST['role']);
    $message = mysqli_real_escape_string($conn, $_REQUEST['message']);

    $strSQL = "SELECT * FROM rec_progress WHERE rp_id_rs = '$id_rs' AND rp_session = '$session_id'";
    $resCheck = $db->fetch($strSQL, false, false);
    if($resCheck){
        $owner_id = $resCheck['rp_uid'];

        $strSQL = "UPDATE rec_progress SET rp_progress_status = '20' WHERE rp_id_rs = '$id_rs' AND rp_session = '$session_id' ";
        $res = $db->execute($strSQL);
        if($res){

            $strSQL = "UPDATE rec_wait_staff_progress SET rwp_status = '1' WHERE rwp_session_id = '$session_id' ";
            $res = $db->execute($strSQL);

            $strSQL = "INSERT INTO rec_progress_log (`rpl_datetime`, `rpl_uid`, `rpl_role`, `rpl_calculate`, `rpl_activity`, `rpl_message`, `rpl_session`, `rpl_relate_status`)
                        VALUES ('$datetime', '$uid', '$role', '1', 'เจ้าหน้าที่ส่งกลับนักวิจัยเพื่อขอเอกสารเพิ่มเติมจากนักวิจัย/ดำเนินการอื่น ๆ', '$message', '$session_id', '20')
                        ";
            $resInsert = $db->insert($strSQL, false);

            $strSQL = "INSERT INTO rec_note (`log_activity`, `log_detail`, `log_ip`, `log_datetime`, `log_id_rs`,  `log_session_id`, `log_by_role`, `log_countrange`, `log_by_id`)
                        VALUES ('Add not', '<p>[System] เจ้าหน้าที่ส่งกลับนักวิจัยเพื่อขอเอกสารเพิ่มเติมจากนักวิจัย/ดำเนินการอื่น ๆ</p>$message', '$ip', '$datetime', '$id_rs', '$session_id', '$role', '1', '$uid')
                            ";
            $resInsert = $db->insert($strSQL, false);

            // Send to PI
            $strSQL = "SELECT * FROM research WHERE id_rs = '$id_rs' LIMIT 1";
            $resResearch = $db->fetch($strSQL, false, false);
            $code_apdu = $resResearch['code_apdu'];

            $strSQL = "SELECT * FROM useraccount a INNER JOIN userinfo b ON a.id = b.user_id WHERE a.id = '$owner_id' LIMIT 1";
            $resUser = $db->fetch($strSQL, false, false);

            $strSQL = "INSERT INTO account_line_log (`all_datetime`, `all_message`, `all_uid`, `all_id_rs`)
                    VALUES ('$datetime', 'โครงการ REC.'.$code_apdu.' ถูกเปลี่ยนสถานะเป็น รายงานรอเอกสาร/ข้อมูลเพิ่มเติมจากนักวิจัย กรุณาเข้าสู่ระบบเพื่อดำเนินการต่อไป', '$uid', '$id_rs')
                    ";
            $resInsert = $db->insert($strSQL, false);

            // E-mail to P
            if($resUser){
                $email = $resUser['email'];
                $title = "รายงานรอเอกสาร/ข้อมูลเพิ่มเติมจากนักวิจัย";
                $content = '<p><strong>ชื่อเรื่อง : รายงานรอเอกสาร/ข้อมูลเพิ่มเติมจากนักวิจัย</strong></p>';
                $content = '<p>ชื่อโครงการ (ภาษาไทย) : '.$resResearch['title_th'].'<br>ชื่อโครงการ (English) : '.$resResearch['title_en'].'<br>รหัสโครงการ : REC.'.$resResearch['code_apdu'].'</p>';
                $content .= '<p>เรียน คุณ'.$resUser['fname']." ".$resUser['lname'].'</p>';
                $content .= '<p>รายงานของโครงการวิจัย รหัส REC.'.$resResearch['code_apdu'].'  ถูกเปลี่ยนสถานะเป็น รายงานรอเอกสาร/ข้อมูลเพิ่มเติมจากนักวิจัย กรุณาเข้าสู่ระบบเพื่อดำเนินการต่อไป</p>';
                $content .= '<p>หมายเหตุ : กรุณาอย่าตอบกลับทาง e-mail นี้<br>ท่านสามารถตรวจสอบสถานะของโครงการโดยเข้าไปที่ระบบ RMIS https://rmis2.medicine.psu.ac.th/rmis/ หรือติดต่อเจ้าหน้าที่ (คุณดลญา ทองปิด) โทร.1157, 1149</p>';
                sendEmail($db, 'แจ้งเตือนการส่งรายงานปิดโครงการวิจัย', $session_id, '', $uid, $resUser['email'], "รายงานรอเอกสาร/ข้อมูลเพิ่มเติมจากนักวิจัย โครงการวิจัย REC. $code_apdu", $content, '');
            }   
                
            $return['status'] = 'Success';

        }else{
            $return['status'] = 'Fail';
            $return['error_message'] = 'Can not update status';
        }
    }else{
        $return['status'] = 'Fail';
        $return['error_message'] = 'Can not update status';
    }

    
    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'get_ec_message'){
    if(
        (!isset($_REQUEST['id_rs'])) ||
        (!isset($_REQUEST['session_id']))
      ){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }
    $id_rs = mysqli_real_escape_string($conn, $_REQUEST['id_rs']);
    $session_id = mysqli_real_escape_string($conn, $_REQUEST['session_id']);
    $strSQL = "SELECT * FROM rec_ec_message WHERE msg_id_rs = '$id_rs' AND msg_session_id = '$session_id' ORDER BY msg_datetime DESC";
    $res = $db->fetch($strSQL, true, true);
    if(($res) && ($res['status'])){
        $return['status'] = "Success";
        $return['data'] = $res['data'];
    }else{
        $return['status'] = "Fail";
        $return['error_message'] = 'Error x1002';
    }
    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'get_submission_file'){
    if(
        (!isset($_REQUEST['uid'])) ||
        (!isset($_REQUEST['session_id'])) ||
        (!isset($_REQUEST['progress'])) ||
        (!isset($_REQUEST['fileposition']))
      ){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }

    $uid = mysqli_real_escape_string($conn, $_REQUEST['uid']);
    $session_id = mysqli_real_escape_string($conn, $_REQUEST['session_id']);
    $progress = mysqli_real_escape_string($conn, $_REQUEST['progress']);
    $fileposition = mysqli_real_escape_string($conn, $_REQUEST['fileposition']);

    $strSQL = "SELECT * FroM rec_progress_file_submit WHERE rpfs_progress = '$progress' AND rpfs_session = '$session_id' AND rpfs_position = '$fileposition' AND rpfs_delete = '0'";
    $res = $db->fetch($strSQL, true, false);
    if(($res) && ($res['status'])){
        $return['status'] = "Success";
        $return['data'] = $res['data'];
    }else{
        $return['status'] = "Fail";
        $return['error_message'] = 'Error x1001';
    }
    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'delete_submission_file'){
    if(
        (!isset($_REQUEST['uid'])) ||
        (!isset($_REQUEST['file_id'])) ||
        (!isset($_REQUEST['session_id']))
      ){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }

    $uid = mysqli_real_escape_string($conn, $_REQUEST['uid']);
    $file_id = mysqli_real_escape_string($conn, $_REQUEST['file_id']);
    $session_id = mysqli_real_escape_string($conn, $_REQUEST['session_id']);

    $strSQL = "UPDATE rec_progress_file_submit SET rpfs_delete = '1' WHERE rpfs_id = '$file_id' AND rpfs_session = '$session_id'";
    $res = $db->execute($strSQL);

    $return['status'] = 'Success';
    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'autosave'){
    if(
        (!isset($_REQUEST['uid'])) ||
        (!isset($_REQUEST['sid'])) ||
        (!isset($_REQUEST['progress']))
      ){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }

    $uid = mysqli_real_escape_string($conn, $_REQUEST['uid']);
    $sid = mysqli_real_escape_string($conn, $_REQUEST['sid']);
    $progress = mysqli_real_escape_string($conn, $_REQUEST['progress']);

    if($progress == 'closing'){
        $q1 = mysqli_real_escape_string($conn, $_REQUEST['q1']);
        $q1_info = mysqli_real_escape_string($conn, $_REQUEST['q1_info']);
        $q2_1 = mysqli_real_escape_string($conn, $_REQUEST['q2_1']);
        $q2_2 = mysqli_real_escape_string($conn, $_REQUEST['q2_2']);
        $q2_3 = mysqli_real_escape_string($conn, $_REQUEST['q2_3']);
        $q2_4 = mysqli_real_escape_string($conn, $_REQUEST['q2_4']);
        $q2_5 = mysqli_real_escape_string($conn, $_REQUEST['q2_5']);
        $q2_6 = mysqli_real_escape_string($conn, $_REQUEST['q2_6']);
        $q3_1 = mysqli_real_escape_string($conn, $_REQUEST['q3_1']);
        $q3_2 = mysqli_real_escape_string($conn, $_REQUEST['q3_2']);
        $q3_3 = mysqli_real_escape_string($conn, $_REQUEST['q3_3']);
        $q4 = mysqli_real_escape_string($conn, $_REQUEST['q4']);
        $q5 = mysqli_real_escape_string($conn, $_REQUEST['q5']);
        $q6 = mysqli_real_escape_string($conn, $_REQUEST['q6']);
        $q6_info = mysqli_real_escape_string($conn, $_REQUEST['q6_info']);
        $q7 = mysqli_real_escape_string($conn, $_REQUEST['q7']);
        $q7_1_info = mysqli_real_escape_string($conn, $_REQUEST['q7_1_info']);
        $q7_2_info = mysqli_real_escape_string($conn, $_REQUEST['q7_2_info']);
        $uid = mysqli_real_escape_string($conn, $_REQUEST['uid']);

        $strSQL = "SELECT * FROM rec_progress_closing WHERE rpx_session = '$sid' LIMIT 1";
        $resCheck = $db->fetch($strSQL, false);
        if($resCheck){
            // Update
            $q8 = 0;
            $q9 = 0;

            $strSQL = "SELECT * FROM rec_progress_file_submit WHERE rpfs_delete = '0' AND rpfs_progress = 'closing' AND rpfs_session = '$sid' AND rpfs_position = '8' LIMIT 1";
            $resC = $db->fetch($strSQL, false);
            if($resC){ $q8 = '1'; }

            $strSQL = "SELECT * FROM rec_progress_file_submit WHERE rpfs_delete = '0' AND rpfs_progress = 'closing' AND rpfs_session = '$sid' AND rpfs_position = '9' LIMIT 1";
            $resC = $db->fetch($strSQL, false);
            if($resC){ $q9 = '1'; }

            $strSQL = "UPDATE rec_progress_closing 
                       SET 
                       rp5_qs1 = '$q1',
                       rp5_qs1_remak = '$q1_info',
                       rp5_qs2_1 = '$q2_1',
                       rp5_qs2_2 = '$q2_2',
                       rp5_qs2_3 = '$q2_3',
                       rp5_qs2_4 = '$q2_4',
                       rp5_qs2_5 = '$q2_5',
                       rp5_qs2_6 = '$q2_6',
                       rp5_qs3_1 = '$q3_1',
                       rp5_qs3_2 = '$q3_2',
                       rp5_qs3_3 = '$q3_3',
                       rp5_qs4 = '$q4',
                       rp5_qs5 = '$q5',
                       rp5_qs6 = '$q6',
                       rp5_qs6_info = '$q6_info',
                       rp5_qs7 = '$q7',
                       rp5_qs7_info_1 = '$q7_1_info',
                       rp5_qs7_info_2 = '$q7_2_info',
                       rp5_qs8 = '$q8',
                       rp5_qs9 = '$q9'
                       WHERE 
                       rpx_session = '$sid'
                      ";
            $res = $db->execute($strSQL);
            echo "Draft success";

        }else{
            // Insert new
            $q8 = 0;
            $q9 = 0;

            $strSQL = "SELECT * FROM rec_progress_file_submit WHERE rpfs_delete = '0' AND rpfs_progress = 'closing' AND rpfs_session = '$sid' AND rpfs_position = '8' LIMIT 1";
            $resC = $db->fetch($strSQL, false);
            if($resC){ $q8 = '1'; }

            $strSQL = "SELECT * FROM rec_progress_file_submit WHERE rpfs_delete = '0' AND rpfs_progress = 'closing' AND rpfs_session = '$sid' AND rpfs_position = '9' LIMIT 1";
            $resC = $db->fetch($strSQL, false);
            if($resC){ $q9 = '1'; }

            $strSQL = "INSERT INTO rec_progress_closing 
                        (
                            `rp5_qs1`, `rp5_qs1_remak`, `rp5_qs2_1`, `rp5_qs2_2`, `rp5_qs2_3`, 
                            `rp5_qs2_4`, `rp5_qs2_5`, `rp5_qs2_6`, `rp5_qs3_1`, `rp5_qs3_2`, 
                            `rp5_qs3_3`, `rp5_qs4`, `rp5_qs5`, `rp5_qs6`, `rp5_qs6_info`, 
                            `rp5_qs7`, `rp5_qs7_info_1`, `rp5_qs7_info_2`, `rp5_qs8`, `rp5_qs9`, 
                            `rpx_session`, `rp5_uid`, `rp5_udatetime`, `rp5_status`
                        )
                       VALUES 
                        (
                            '$q1', '$q1_info', '$q2_1', '$q2_2', '$q2_3', 
                            '$q2_4', '$q2_5', '$q2_6', '$q3_1', '$q3_2', 
                            '$q3_3', '$q4', '$q5', '$q6', '$q6_info', 
                            '$q7', '$q7_1_info', '$q7_2_info', '$q8', '$q9',
                            '$sid', '$uid', '$datetime', '1'
                        )
                      ";
            $res = $db->insert($strSQL, false);

            echo "Draft success";
            echo $strSQL; 
        }

    }
    $db->close();
    die();
}

if($stage == 'send'){
    if(
        (!isset($_REQUEST['uid'])) ||
        (!isset($_REQUEST['session_id'])) ||
        (!isset($_REQUEST['progress'])) ||
        (!isset($_REQUEST['role'])) ||
        (!isset($_REQUEST['id_rs']))
      ){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }

    $uid = mysqli_real_escape_string($conn, $_REQUEST['uid']);
    $sid = mysqli_real_escape_string($conn, $_REQUEST['session_id']);
    $progress = mysqli_real_escape_string($conn, $_REQUEST['progress']);
    $id_rs = mysqli_real_escape_string($conn, $_REQUEST['id_rs']);
    $role = mysqli_real_escape_string($conn, $_REQUEST['role']);

    if($progress == 'closing'){
        $q1 = mysqli_real_escape_string($conn, $_REQUEST['q1']);
        $q1_info = mysqli_real_escape_string($conn, $_REQUEST['q1_info']);
        $q2_1 = mysqli_real_escape_string($conn, $_REQUEST['q2_1']);
        $q2_2 = mysqli_real_escape_string($conn, $_REQUEST['q2_2']);
        $q2_3 = mysqli_real_escape_string($conn, $_REQUEST['q2_3']);
        $q2_4 = mysqli_real_escape_string($conn, $_REQUEST['q2_4']);
        $q2_5 = mysqli_real_escape_string($conn, $_REQUEST['q2_5']);
        $q2_6 = mysqli_real_escape_string($conn, $_REQUEST['q2_6']);
        $q3_1 = mysqli_real_escape_string($conn, $_REQUEST['q3_1']);
        $q3_2 = mysqli_real_escape_string($conn, $_REQUEST['q3_2']);
        $q3_3 = mysqli_real_escape_string($conn, $_REQUEST['q3_3']);
        $q4 = mysqli_real_escape_string($conn, $_REQUEST['q4']);
        $q5 = mysqli_real_escape_string($conn, $_REQUEST['q5']);
        $q6 = mysqli_real_escape_string($conn, $_REQUEST['q6']);
        $q6_info = mysqli_real_escape_string($conn, $_REQUEST['q6_info']);
        $q7 = mysqli_real_escape_string($conn, $_REQUEST['q7']);
        $q7_1_info = mysqli_real_escape_string($conn, $_REQUEST['q7_1_info']);
        $q7_2_info = mysqli_real_escape_string($conn, $_REQUEST['q7_2_info']);

        $strSQL = "SELECT * FROM rec_progress_closing WHERE rpx_session = '$sid' LIMIT 1";
        $resCheck = $db->fetch($strSQL, false);
        if($resCheck){
            // Update
            $q8 = 0;
            $q9 = 0;

            $strSQL = "SELECT * FROM rec_progress_file_submit WHERE rpfs_delete = '0' AND rpfs_progress = 'closing' AND rpfs_session = '$sid' AND rpfs_position = '8' LIMIT 1";
            $resC = $db->fetch($strSQL, false);
            if($resC){ $q8 = '1'; }

            $strSQL = "SELECT * FROM rec_progress_file_submit WHERE rpfs_delete = '0' AND rpfs_progress = 'closing' AND rpfs_session = '$sid' AND rpfs_position = '9' LIMIT 1";
            $resC = $db->fetch($strSQL, false);
            if($resC){ $q9 = '1'; }

            $strSQL = "UPDATE rec_progress_file_submit SET rpfs_allow_delete = '0' WHERE rpfs_session = '$sid'  AND rpfs_progress = 'closing' ";
            $res = $db->execute($strSQL);

            $strSQL = "UPDATE rec_progress_closing 
                       SET 
                       rp5_qs1 = '$q1',
                       rp5_qs1_remak = '$q1_info',
                       rp5_qs2_1 = '$q2_1',
                       rp5_qs2_2 = '$q2_2',
                       rp5_qs2_3 = '$q2_3',
                       rp5_qs2_4 = '$q2_4',
                       rp5_qs2_5 = '$q2_5',
                       rp5_qs2_6 = '$q2_6',
                       rp5_qs3_1 = '$q3_1',
                       rp5_qs3_2 = '$q3_2',
                       rp5_qs3_3 = '$q3_3',
                       rp5_qs4 = '$q4',
                       rp5_qs5 = '$q5',
                       rp5_qs6 = '$q6',
                       rp5_qs6_info = '$q6_info',
                       rp5_qs7 = '$q7',
                       rp5_qs7_info_1 = '$q7_1_info',
                       rp5_qs7_info_2 = '$q7_2_info',
                       rp5_qs8 = '$q8',
                       rp5_qs9 = '$q9'
                       WHERE 
                       rpx_session = '$sid'
                      ";
            $res = $db->execute($strSQL);
            
            $strSQL = "UPDATE rec_progress SET rp_progress_status = '1', rp_sending_status = '1', rp_sending_datetime = '$datetime' WHERE rp_id_rs = '$id_rs' AND rp_progress_id = '$progress' AND rp_session = '$sid'";
            $res = $db->execute($strSQL);

            $strSQL = "INSERT INTO rec_progress_log (`rpl_datetime`, `rpl_uid`, `rpl_role`, `rpl_calculate`, `rpl_activity`, `rpl_message`, `rpl_session`, `rpl_relate_status`)
                       VALUES ('$datetime', '$uid', '$role', '1', 'นักวิจัยส่งรายงานปิดโครงการ', 'รหัสรายงาน $sid', '$sid', '1')
                      ";
            $resInsert = $db->insert($strSQL, false);

            // 
            $strSQL = "SELECT code_apdu, title_th, title_en FROM research WHERE id_rs = '$id_rs' LIMIT 1";
            $resResearch = $db->fetch($strSQL, false);

            $strSQL = "SELECT id FROM useraccount WHERE id_pm = '$uid' LIMIT 1";
            $resPm = $db->fetch($strSQL, false, false);
            $code_apdu = $resResearch['code_apdu']; 
            $strSQL = "INSERT INTO account_line_log (`all_datetime`, `all_message`, `all_uid`, `all_id_rs`)
                    VALUES ('$datetime', 'ท่านได้ทำการส่งรายงานปิดโครงการวิจัย โครงการ REC.$code_apdu หากไม่ใช่การดำเนินการของท่าน กรุณาตรวจสอบข้อมูล', '$uid', '$id_rs')
                    ";
            $resInsert = $db->insert($strSQL, false);

            // E-mail to PI
            $strSQL = "SELECT email FROM useraccount WHERE id = '$uid'";
            $resUser = $db->fetch($strSQL, false, false);

            $strSQL = "SELECT * FROM userinfo WHERE user_id = '$uid'";
            $resUserInfo = $db->fetch($strSQL, false, false);

            if($resUser){
                $email = $resUser['email'];
                $title = "แจ้งผลการส่งรายงานปิดโครงการ";
                $content = '<p><strong>ชื่อเรื่อง : แจ้งเตือนการส่งรายงานปิดโครงการวิจัย</strong></p>';
                $content = '<p>ชื่อโครงการ (ภาษาไทย) : '.$resResearch['title_th'].'<br>ชื่อโครงการ (English) : '.$resResearch['title_en'].'<br>รหัสโครงการ : REC.'.$resResearch['code_apdu'].'</p>';
                $content .= '<p>เรียน คุณ'.$resUserInfo['fname']." ".$resUserInfo['lname'].'</p>';
                $content .= '<p>ท่านได้ทำการส่งรายงานปิดโครงการวิจัยของโครงการวิจัย รหัส REC0'.$resResearch['code_apdu'].' เรียบร้อยแล้ว กรุณาตรวจสอบสถานะของรายงานอย่างสม่ำเสมอ</p>';
                $content .= '<p>หมายเหตุ : กรุณาอย่าตอบกลับทาง e-mail นี้<br>ท่านสามารถตรวจสอบสถานะของโครงการโดยเข้าไปที่ระบบ RMIS https://rmis2.medicine.psu.ac.th/rmis/ หรือติดต่อเจ้าหน้าที่ (คุณดลญา ทองปิด) โทร.1157, 1149</p>';
                sendEmail($db, 'แจ้งเตือนการส่งรายงานปิดโครงการวิจัย', $sid, '', $uid, $resUser['email'], "แจ้งผลการส่งรายงานปิดโครงการวิจัย (REF. $sid)", $content, '');
            }   
            
            $return['status'] = 'Success';
        }else{
            // Insert new
            $q8 = 0;
            $q9 = 0;

            $strSQL = "SELECT * FROM rec_progress_file_submit WHERE rpfs_delete = '0' AND rpfs_progress = 'closing' AND rpfs_session = '$sid' AND rpfs_position = '8' LIMIT 1";
            $resC = $db->fetch($strSQL, false);
            if($resC){ $q8 = '1'; }

            $strSQL = "SELECT * FROM rec_progress_file_submit WHERE rpfs_delete = '0' AND rpfs_progress = 'closing' AND rpfs_session = '$sid' AND rpfs_position = '9' LIMIT 1";
            $resC = $db->fetch($strSQL, false);
            if($resC){ $q9 = '1'; }

            $strSQL = "UPDATE rec_progress_file_submit SET rpfs_allow_delete = '0' WHERE rpfs_session = '$sid'  AND rpfs_progress = 'closing' ";
            $res = $db->execute($strSQL);

            $strSQL = "INSERT INTO rec_progress_closing 
                        (
                            `rp5_qs1`, `rp5_qs1_remak`, `rp5_qs2_1`, `rp5_qs2_2`, `rp5_qs2_3`, 
                            `rp5_qs2_4`, `rp5_qs2_5`, `rp5_qs2_6`, `rp5_qs3_1`, `rp5_qs3_2`, 
                            `rp5_qs3_3`, `rp5_qs4`, `rp5_qs5`, `rp5_qs6`, `rp5_qs6_info`, 
                            `rp5_qs7`, `rp5_qs7_info_1`, `rp5_qs7_info_2`, `rp5_qs8`, `rp5_qs9`, 
                            `rpx_session`
                        )
                       VALUES 
                        (
                            '$q1', '$q1_info', '$q2_1', '$q2_2', '$q2_3', 
                            '$q2_4', '$q2_5', '$q2_6', '$q3_1', '$q3_2', 
                            '$q3_3', '$q4', '$q5', '$q6', '$q6_info', 
                            '$q7', '$q7_1_info', '$q7_2_info', '$q8', '$q9',
                            '$sid'
                        )
                      ";
            $res = $db->insert($strSQL, false);
            $strSQL = "UPDATE rec_progress SET rp_progress_status = '1', rp_sending_status = '1', rp_sending_datetime = '$datetime' WHERE rp_id_rs = '$id_rs' AND rp_progress_id = '$progress' AND rp_session = '$sid'";
            $res = $db->execute($strSQL);

            $strSQL = "INSERT INTO rec_progress_log (`rpl_datetime`, `rpl_uid`, `rpl_role`, `rpl_calculate`, `rpl_activity`, `rpl_message`, `rpl_session`, `rpl_relate_status`)
                       VALUES ('$datetime', '$uid', '$role', '1', 'นักวิจัยส่งรายงานปิดโครงการ', 'รหัสรายงาน $sid', '$sid', '1')
                      ";
            $resInsert = $db->insert($strSQL, false);
            $return['status'] = 'Success';
        }
    } // End closing 

    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'result_stage1'){
    if(
        (!isset($_REQUEST['uid'])) ||
        (!isset($_REQUEST['session_id'])) ||
        (!isset($_REQUEST['id_rs'])) ||
        (!isset($_REQUEST['role'])) ||
        (!isset($_REQUEST['result'])) ||
        (!isset($_REQUEST['comment'])) ||
        (!isset($_REQUEST['progress']))
      ){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }

    $uid = mysqli_real_escape_string($conn, $_REQUEST['uid']);
    $session_id = mysqli_real_escape_string($conn, $_REQUEST['session_id']);
    $id_rs = mysqli_real_escape_string($conn, $_REQUEST['id_rs']);
    $role = mysqli_real_escape_string($conn, $_REQUEST['role']);
    $result = mysqli_real_escape_string($conn, $_REQUEST['result']);
    $comment = mysqli_real_escape_string($conn, $_REQUEST['comment']);
    $progress = mysqli_real_escape_string($conn, $_REQUEST['progress']);

    $strSQL = "SELECT * FROM rec_progress WHERE rp_session = '$session_id' AND rp_id_rs = '$id_rs'";
    $resRec  = $db->fetch($strSQL, false, false);

    $strSQL = "SELECT id_pm, code_apdu FROM research WHERE id_rs = '$id_rs'";
    $resRes = $db->fetch($strSQL, false, false);
    $code_apdu = $resRes['code_apdu'];
    $id_pm = $resRes['id_pm'];
    if($resRec){

        $strSQL = "UPDATE rec_progress_file_submit SET rpfs_allow_delete = '0' WHERE rpfs_session = '$session_id' ";
        $res = $db->execute($strSQL);
        
        $current_status = $resRec['rp_progress_status'];
        $current_progress = $resRec['rp_progress_id'];

        
        $current_progress_th = '';
        if($current_progress == 'closing'){
            $current_progress_th = 'Final report';
        }else if($current_progress == 'terminate'){
            $current_progress_th = 'Termination report';
        }

        if($result == '1'){ // Incorrect document
            if($current_status == '1'){
                // Update rec_progress status to incorrect document
                $strSQL = "UPDATE rec_progress SET rp_progress_status = '2' WHERE  rp_session = '$session_id' AND rp_id_rs = '$id_rs'";
                $resUpdate = $db->execute($strSQL);
                // Insert progress log
                $strSQL = "INSERT INTO rec_progress_log (`rpl_datetime`, `rpl_uid`, `rpl_role`, `rpl_calculate`, `rpl_activity`, `rpl_message`, `rpl_session`, `rpl_relate_status`)
                       VALUES ('$datetime', '$uid', '$role', '1', 'เอกสารไม่ถูกต้อง', '$comment', '$session_id', '2')
                        ";
                $resInsert = $db->insert($strSQL, false);

                $strSQL = "INSERT INTO rec_note (`log_activity`, `log_detail`, `log_ip`, `log_datetime`, `log_id_rs`,  `log_session_id`, `log_by_role`, `log_countrange`, `log_by_id`)
                       VALUES ('Add not', '<p>[System] เอกสารไม่ถูกต้อง</p>$comment', '$ip', '$datetime', '$id_rs', '$session_id', '$role', '1', '$uid')
                        ";
                $resInsert = $db->insert($strSQL, false);

                $strSQL = "SELECT id FROM useraccount WHERE id_pm = '$id_pm' LIMIT 1";
                $resPm = $db->fetch($strSQL, false, false);

                $strSQL = "INSERT INTO account_line_log (`all_datetime`, `all_message`, `all_uid`, `all_id_rs`)
                       VALUES ('$datetime', 'รายงาน$current_progress_th โครงการ REC.$code_apdu เอกสารไม่ถูกต้อง', '".$resPm['id']."', '$id_rs')
                        ";
                $resInsert = $db->insert($strSQL, false);

                // E-mail to PI
                $strSQL = "SELECT code_apdu, title_th, title_en FROM research WHERE id_rs = '$id_rs' LIMIT 1";
                $resResearch = $db->fetch($strSQL, false);

                $strSQL = "SELECT email FROM useraccount WHERE id = '".$resPm['id']."'";
                $resUser = $db->fetch($strSQL, false, false);

                $strSQL = "SELECT * FROM userinfo WHERE user_id = '".$resPm['id']."'";
                $resUserInfo = $db->fetch($strSQL, false, false);

                if($resUser){
                    $email = $resUser['email'];
                    $title = "ผลการตรวจสอบความถูกต้องของเอกสารโครงการวิจัยที่ขอรับพิจารณาจริยธรรมการวิจัยในมนุษย์";
                    $content = '<p><strong>ชื่อเรื่อง : ผลการตรวจสอบความถูกต้องของเอกสารโครงการวิจัยที่ขอรับพิจารณาจริยธรรมการวิจัยในมนุษย์</strong></p>';
                    $content = '<p>ชื่อโครงการ (ภาษาไทย) : '.$resResearch['title_th'].'<br>ชื่อโครงการ (English) : '.$resResearch['title_en'].'<br>รหัสโครงการ : REC.'.$resResearch['code_apdu'].'</p>';
                    $content .= '<p>เรียน คุณ'.$resUserInfo['fname']." ".$resUserInfo['lname'].'</p>';
                    $content .= '<p>เจ้าหน้าที่ได้ทำการตรวจสอบความครบถ้วนและถูกต้องเอกสาร'.$current_progress_th.' พบว่า <strong color="red">เอกสารยังไม่ถูกต้อง/ไม่ครบถ้วน</strong> จึงขอให้ท่านดำเนินการต่อไปนี้</p>';
                    $content .= '<p>--------------------'.$comment.'--------------------</p>';
                    $content .= '<p>กรุณายื่นเอกสารผ่านระบบ RMIS มาเพื่อตรวจสอบอีกครั้ง ระบบจะแจ้งผลการตรวจสอบทางอีเมลแก่ท่านภายใน 3 วันทำการ</p>';
                    $content .= '<p>หมายเหตุ : กรุณาอย่าตอบกลับทาง e-mail นี้<br>ท่านสามารถตรวจสอบสถานะของโครงการโดยเข้าไปที่ระบบ RMIS https://rmis2.medicine.psu.ac.th/rmis/ หรือติดต่อเจ้าหน้าที่ (คุณดลญา ทองปิด) โทร.1157, 1149</p>';
                    sendEmail($db, 'เอกสารไม่ถูกต้อง', $session_id, '', $resPm['id'], $resUser['email'], "ผลการตรวจสอบความถูกต้องของเอกสาร ".$current_progress_th." (REC. ".$resResearch['code_apdu'].")", $content, '');
                }   

                $return['status'] = 'Success';
            }else if($current_status == '21'){

            }else{

            }
        }
        else // Corrent document -> send to ec
        {
            $strSQL = "SELECT * FROM rec_progress WHERE rp_session = '$session_id' AND rp_id_rs = '$id_rs'";
            $resCheck = $db->fetch($strSQL, false, false);
            if($resCheck){
                $pm_id = $resCheck['rp_uid'];
                if($current_status == '1'){ // เอกสารยื่นถูกต้อง ส่งต่อเลขา
                    $strSQL = "INSERT INTO rec_progress_log (`rpl_datetime`, `rpl_uid`, `rpl_role`, `rpl_calculate`, `rpl_activity`, `rpl_message`, `rpl_session`, `rpl_relate_status`)
                               VALUES ('$datetime', '$uid', '$role', '1', 'เอกสารถูกต้อง', '$comment', '$session_id', '3')
                            ";
                    $resInsert = $db->insert($strSQL, false);
    
                    $strSQL = "INSERT INTO rec_note (`log_activity`, `log_detail`, `log_ip`, `log_datetime`, `log_id_rs`,  `log_session_id`, `log_by_role`, `log_countrange`, `log_by_id`)
                           VALUES ('Add not', '<p>[System] เอกสารถูกต้อง ส่งต่อเลขา</p>$comment', '$ip', '$datetime', '$id_rs', '$session_id', '$role', '1', '$uid')
                            ";
                    $resInsert = $db->insert($strSQL, false);
    
                    // เลือกเลขา
                    $strSQL = "SELECT rct_fb_ec FROM research_consider_type WHERE rct_id_rs = '$id_rs'";
                    $resEc = $db->fetch($strSQL, false, false);
                    if($resEc){
    
                        $id_ec = $resEc['rct_fb_ec'];
    
                        $strSQL = "UPDATE rec_progress SET rp_progress_status = '3', rp_id_ec = '$id_ec', rp_confirm_1 = '1' WHERE  rp_session = '$session_id' AND rp_id_rs = '$id_rs'";
                        $resUpdate = $db->execute($strSQL);
    
                        // E-mail to PI
                        $strSQL = "SELECT code_apdu, title_th, title_en FROM research WHERE id_rs = '$id_rs' LIMIT 1";
                        $resResearch = $db->fetch($strSQL, false);
    
                        $strSQL = "SELECT email FROM useraccount WHERE id = '$id_ec'";
                        $resUser = $db->fetch($strSQL, false, false);
    
                        $strSQL = "SELECT * FROM userinfo WHERE user_id = '$id_ec'";
                        $resUserInfo = $db->fetch($strSQL, false, false);

                        if($resUser){
                            $email = $resUser['email'];
                            $title = "รายงานรอตรวจสอบโดยเลขานุการสำนักงาน ฯ";
                            $content = '<p>เรียน คุณ'.$resUserInfo['fname']." ".$resUserInfo['lname'].'</p>';
                            $content .= '<p>ท่านมีรายงานที่รอดำเนินการ กรุณาเข้าสู่ระบบเพื่อดำเนินการต่อ</p>';
                            $content .= '<p>ด้วยความเคารพอย่างสูง<br>ระบบส่งอีเมลอัตโนมัติโดย RMIS</p>';
                            sendEmail($db, 'รายงานรอตรวจสอบโดยเลขานุการสำนักงาน', $session_id, '', $id_ec, $resUser['email'], "รายงานรอตรวจสอบโดยเลขานุการสำนักงาน ฯ (REC. ".$resResearch['code_apdu'].")", $content, '');
                        }   
    
    
                        // Send response to PI
                        $strSQL = "INSERT INTO account_line_log (`all_datetime`, `all_message`, `all_uid`, `all_id_rs`)
                               VALUES ('$datetime', 'รายงาน $current_progress_th โครงการ REC.$code_apdu เอกสารถูกต้อง', '$pm_id', '$id_rs')
                                ";
                        $resInsert = $db->insert($strSQL, false);
                        $strSQL = "SELECT * FROM useraccount a INNER JOIN userinfo b ON a.id = b.user_id WHERE a.id = '$pm_id'";
                        $resUserInfo = $db->fetch($strSQL, false, false);
        
                        if($resUser){
                            $email = $resUser['email'];
                            $title = "ผลการตรวจสอบความถูกต้องของเอกสารโครงการวิจัยที่ขอรับพิจารณาจริยธรรมการวิจัยในมนุษย์";
                            $content = '<p><strong>ชื่อเรื่อง : ผลการตรวจสอบความถูกต้องของเอกสารโครงการวิจัยที่ขอรับพิจารณาจริยธรรมการวิจัยในมนุษย์</strong></p>';
                            $content = '<p>ชื่อโครงการ (ภาษาไทย) : '.$resResearch['title_th'].'<br>ชื่อโครงการ (English) : '.$resResearch['title_en'].'<br>รหัสโครงการ : REC.'.$resResearch['code_apdu'].'</p>';
                            $content .= '<p>เรียน คุณ'.$resUserInfo['fname']." ".$resUserInfo['lname'].'</p>';
                            $content .= '<p>ระบบเรียนนำเพื่อแจ้งให้ท่านทราบว่า รายงาน '.$current_progress_th.' ของโครงการ รหัส REC. '.$resResearch['code_apdu'].' เจ้าหน้าที่ได้ทำการตรวจสอบความครบถ้วนและถูกต้องเอกสาร และผลการตรวจสอบคือ <strong style="color: red;">เอกสารถูกต้อง</strong> และกำลังเข้าสู่กระบวนการพิจารณาจากสำนักงานต่อไป</p>';
                            $content .= '<p>จึงเรียนมาเพื่อทราบ</p>';
                            $content .= '<p>หมายเหตุ : กรุณาอย่าตอบกลับทาง e-mail นี้<br>ท่านสามารถตรวจสอบสถานะของโครงการโดยเข้าไปที่ระบบ RMIS https://rmis2.medicine.psu.ac.th/rmis/ หรือติดต่อเจ้าหน้าที่ (คุณดลญา ทองปิด) โทร.1157, 1149</p>';
                            sendEmail($db, 'เอกสารถูกต้อง', $session_id, '', $rpm_id, $resUser['email'], "ผลการตรวจสอบความถูกต้องของเอกสาร ".$current_progress_th." (REC. ".$resResearch['code_apdu'].")", $content, '');
                        }   
    
    
                        $return['status'] = 'Success';
                    }else{
                        $return['status'] = 'EC Not found';
                    }
                }
    
                if($current_status == '21'){ // เอกสารถูกต้อง นักวิจัยส่งกลับหลังจากแก้ไข/ตอบข้อเสนอแนะ
                    $strSQL = "INSERT INTO rec_progress_log (`rpl_datetime`, `rpl_uid`, `rpl_role`, `rpl_calculate`, `rpl_activity`, `rpl_message`, `rpl_session`, `rpl_relate_status`)
                               VALUES ('$datetime', '$uid', '$role', '1', 'เอกสารถูกต้อง', '$comment', '$session_id', '21')
                            ";
                    $resInsert = $db->insert($strSQL, false);
    
                    $strSQL = "INSERT INTO rec_note (`log_activity`, `log_detail`, `log_ip`, `log_datetime`, `log_id_rs`,  `log_session_id`, `log_by_role`, `log_countrange`, `log_by_id`)
                           VALUES ('Add not', '<p>[System] เอกสารถูกต้อง ส่งต่อเลขา</p>$comment', '$ip', '$datetime', '$id_rs', '$session_id', '$role', '1', '$uid')
                            ";
                    $resInsert = $db->insert($strSQL, false);
    
                    // เลือกเลขา
                    $strSQL = "SELECT rct_fb_ec FROM research_consider_type WHERE rct_id_rs = '$id_rs'";
                    $resEc = $db->fetch($strSQL, false, false);
                    if($resEc){
    
                        $id_ec = $resEc['rct_fb_ec'];
    
                        $strSQL = "UPDATE rec_progress SET rp_progress_status = '28', rp_id_ec = '$id_ec', rp_confirm_1 = '1' WHERE  rp_session = '$session_id' AND rp_id_rs = '$id_rs'";
                        $resUpdate = $db->execute($strSQL);
    
                        // E-mail to PI
                        $strSQL = "SELECT code_apdu, title_th, title_en FROM research WHERE id_rs = '$id_rs' LIMIT 1";
                        $resResearch = $db->fetch($strSQL, false);
    
                        $strSQL = "SELECT email FROM useraccount WHERE id = '$id_ec'";
                        $resUser = $db->fetch($strSQL, false, false);
    
                        $strSQL = "SELECT * FROM userinfo WHERE user_id = '$id_ec'";
                        $resUserInfo = $db->fetch($strSQL, false, false);

                        if($resUser){
                            $email = $resUser['email'];
                            $title = "รายงานรอตรวจสอบโดยเลขานุการสำนักงาน ฯ";
                            $content = '<p>เรียน คุณ'.$resUserInfo['fname']." ".$resUserInfo['lname'].'</p>';
                            $content .= '<p>ท่านมีรายงานที่รอดำเนินการ กรุณาเข้าสู่ระบบเพื่อดำเนินการต่อ</p>';
                            $content .= '<p>ด้วยความเคารพอย่างสูง<br>ระบบส่งอีเมลอัตโนมัติโดย RMIS</p>';
                            sendEmail($db, 'รายงานรอตรวจสอบโดยเลขานุการสำนักงาน', $session_id, '', $id_ec, $resUser['email'], "รายงานรอตรวจสอบโดยเลขานุการสำนักงาน ฯ (REC. ".$resResearch['code_apdu'].")", $content, '');
                        }   
    
    
                        // Send response to PI
                        $strSQL = "INSERT INTO account_line_log (`all_datetime`, `all_message`, `all_uid`, `all_id_rs`)
                               VALUES ('$datetime', 'รายงาน $current_progress_th โครงการ REC.$code_apdu เอกสารถูกต้อง', '$pm_id', '$id_rs')
                                ";
                        $resInsert = $db->insert($strSQL, false);
                        $strSQL = "SELECT * FROM useraccount a INNER JOIN userinfo b ON a.id = b.user_id WHERE a.id = '$pm_id'";
                        $resUserInfo = $db->fetch($strSQL, false, false);
        
                        if($resUser){
                            $email = $resUser['email'];
                            $title = "ผลการตรวจสอบความถูกต้องของเอกสารโครงการวิจัยที่ขอรับพิจารณาจริยธรรมการวิจัยในมนุษย์";
                            $content = '<p><strong>ชื่อเรื่อง : ผลการตรวจสอบความถูกต้องของเอกสารโครงการวิจัยที่ขอรับพิจารณาจริยธรรมการวิจัยในมนุษย์</strong></p>';
                            $content = '<p>ชื่อโครงการ (ภาษาไทย) : '.$resResearch['title_th'].'<br>ชื่อโครงการ (English) : '.$resResearch['title_en'].'<br>รหัสโครงการ : REC.'.$resResearch['code_apdu'].'</p>';
                            $content .= '<p>เรียน คุณ'.$resUserInfo['fname']." ".$resUserInfo['lname'].'</p>';
                            $content .= '<p>ระบบเรียนนำเพื่อแจ้งให้ท่านทราบว่า รายงาน '.$current_progress_th.' ของโครงการ รหัส REC. '.$resResearch['code_apdu'].' เจ้าหน้าที่ได้ทำการตรวจสอบความครบถ้วนและถูกต้องเอกสารเรียบร้อยแล้ว และกำลังเข้าสู่กระบวนการพิจารณาจากสำนักงานต่อไป</p>';
                            $content .= '<p>จึงเรียนมาเพื่อทราบ</p>';
                            $content .= '<p>หมายเหตุ : กรุณาอย่าตอบกลับทาง e-mail นี้<br>ท่านสามารถตรวจสอบสถานะของโครงการโดยเข้าไปที่ระบบ RMIS https://rmis2.medicine.psu.ac.th/rmis/ หรือติดต่อเจ้าหน้าที่ (คุณดลญา ทองปิด) โทร.1157, 1149</p>';
                            sendEmail($db, 'เอกสารถูกต้อง', $session_id, '', $rpm_id, $resUser['email'], "ผลการตรวจสอบความถูกต้องของเอกสาร ".$current_progress_th." (REC. ".$resResearch['code_apdu'].")", $content, '');
                        }   
    
    
                        $return['status'] = 'Success';
                    }else{
                        $return['status'] = 'EC Not found';
                    }
                }
            }else{
                $return['status'] = 'Fail';
                $return['error_message'] = 'Report not found';
            }
        }

    }else{ // Progress not found
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1002';
    }

    echo json_encode($return);
    mysqli_close($conn);
    die();

    if($progress == 'closing'){
        $q1 = mysqli_real_escape_string($conn, $_REQUEST['q1']);
        $q1_info = mysqli_real_escape_string($conn, $_REQUEST['q1_info']);
        $q2_1 = mysqli_real_escape_string($conn, $_REQUEST['q2_1']);
        $q2_2 = mysqli_real_escape_string($conn, $_REQUEST['q2_2']);
        $q2_3 = mysqli_real_escape_string($conn, $_REQUEST['q2_3']);
        $q2_4 = mysqli_real_escape_string($conn, $_REQUEST['q2_4']);
        $q2_5 = mysqli_real_escape_string($conn, $_REQUEST['q2_5']);
        $q2_6 = mysqli_real_escape_string($conn, $_REQUEST['q2_6']);
        $q3_1 = mysqli_real_escape_string($conn, $_REQUEST['q3_1']);
        $q3_2 = mysqli_real_escape_string($conn, $_REQUEST['q3_2']);
        $q3_3 = mysqli_real_escape_string($conn, $_REQUEST['q3_3']);
        $q4 = mysqli_real_escape_string($conn, $_REQUEST['q4']);
        $q5 = mysqli_real_escape_string($conn, $_REQUEST['q5']);
        $q6 = mysqli_real_escape_string($conn, $_REQUEST['q6']);
        $q6_info = mysqli_real_escape_string($conn, $_REQUEST['q6_info']);
        $q7 = mysqli_real_escape_string($conn, $_REQUEST['q7']);
        $q7_1_info = mysqli_real_escape_string($conn, $_REQUEST['q7_1_info']);
        $q7_2_info = mysqli_real_escape_string($conn, $_REQUEST['q7_2_info']);

        $strSQL = "SELECT * FROM rec_progress_closing WHERE rpx_session = '$sid' LIMIT 1";
        $resCheck = $db->fetch($strSQL, false);
        if($resCheck){
            // Update
            $q8 = 0;
            $q9 = 0;

            $strSQL = "SELECT * FROM rec_progress_file_submit WHERE rpfs_delete = '0' AND rpfs_progress = 'closing' AND rpfs_session = '$sid' AND rpfs_position = '8' LIMIT 1";
            $resC = $db->fetch($strSQL, false);
            if($resC){ $q8 = '1'; }

            $strSQL = "SELECT * FROM rec_progress_file_submit WHERE rpfs_delete = '0' AND rpfs_progress = 'closing' AND rpfs_session = '$sid' AND rpfs_position = '9' LIMIT 1";
            $resC = $db->fetch($strSQL, false);
            if($resC){ $q9 = '1'; }

            

            $strSQL = "UPDATE rec_progress_closing 
                       SET 
                       rp5_qs1 = '$q1',
                       rp5_qs1_remak = '$q1_info',
                       rp5_qs2_1 = '$q2_1',
                       rp5_qs2_2 = '$q2_2',
                       rp5_qs2_3 = '$q2_3',
                       rp5_qs2_4 = '$q2_4',
                       rp5_qs2_5 = '$q2_5',
                       rp5_qs2_6 = '$q2_6',
                       rp5_qs3_1 = '$q3_1',
                       rp5_qs3_2 = '$q3_2',
                       rp5_qs3_3 = '$q3_3',
                       rp5_qs4 = '$q4',
                       rp5_qs5 = '$q5',
                       rp5_qs6 = '$q6',
                       rp5_qs6_info = '$q6_info',
                       rp5_qs7 = '$q7',
                       rp5_qs7_info_1 = '$q7_1_info',
                       rp5_qs7_info_2 = '$q7_2_info',
                       rp5_qs8 = '$q8',
                       rp5_qs9 = '$q9'
                       WHERE 
                       rpx_session = '$sid'
                      ";
            $res = $db->execute($strSQL);
            
            $strSQL = "UPDATE rec_progress SET rp_sending_status = '1', rp_sending_datetime = '$datetime' WHERE rp_id_rs = '$id_rs' AND rp_progress_id = '$progress' AND rp_session = '$sid'";
            $res = $db->execute($strSQL);

            $strSQL = "INSERT INTO rec_progress_log (`rpl_datetime`, `rpl_uid`, `rpl_role`, `rpl_calculate`, `rpl_activity`, `rpl_message`, `rpl_session`, `rpl_relate_status`)
                       VALUES ('$datetime', '$uid', '$role', '1', 'นักวิจัยส่งรายงานปิดโครงการ', 'รหัสรายงาน $sid', '$sid', '1')
                      ";
            $resInsert = $db->insert($strSQL, false);


            if($result == '1'){
                $strSQL = "UPDATE rec_progress SET rp_progress_status = '2' WHERE rp_id_rs = '$id_rs' AND rp_progress_id = '$progress' AND rp_session = '$sid'";
                $res = $db->execute($strSQL);

                $strSQL = "INSERT INTO rec_progress_log (`rpl_datetime`, `rpl_uid`, `rpl_role`, `rpl_calculate`, `rpl_activity`, `rpl_message`, `rpl_session`, `rpl_relate_status`)
                       VALUES ('$datetime', '$uid', '$role', '1', 'เอกสารไม่ถูกต้อง', '$comment', '$sid', '2')
                      ";
                $resInsert = $db->insert($strSQL, false);

                $strSQL = "SELECT email FROM useraccount WHERE id_pm IN (SELECT id_pm FROM research WHERE id_rs = '$id_rs') ORDER BY id DESC LIMIT 1";
                $resEmail = $db->fetch($strSQL, false);

                $strSQL = "SELECT code_apdu, title_th, title_en FROM research WHERE id_rs = '$id_rs' LIMIT 1";
                $resResearch = $db->fetch($strSQL, false);

                if(($resEmail) && ($resResearch)){
                    
                    $title = $resResearch['title_th']." (".$resResearch['title_en'].")";
                    if($resResearch['title_th'] == '-'){
                        $title = $resResearch['title_en'];
                    }
                    $content = '<p>เรียน นักวิจัยที่นับถือ</p>';
                    $content .= '<p>เนื่องด้วยเจ้าหน้าที่ได้ตรวจสอบรายงานปิดโครงการของโครงการวิจัย <strong>"'.$title.'"</strong> รหัสโครงการ REC.'.$resResearch['code_apdu'].' โดยมีผลการตรวจสอบ คือ <strong>เอกสารไม่ถูกต้อง</strong> โดยมีข้อมูลเพิ่มเติมจากเจ้าหน้าที่ ดังนี้</p>';
                    $content .= '<p>--------------------<br><strong>ข้อความจากเจ้าหน้าที่</strong><br>'.$comment.'<br>--------------------</p>';
                    $content .= '<p>จึงเรียนมาเพื่อให้ท่านดำเนินการแก้ไขและส่งกลับมายังสำนักงานผ่านระบบ RMIS หากมีข้อสงสัยกรุณาโทรติดต่อสำนักงาน</p>';
                    $content .= '<p>ด้วยความเคารพอย่างสูง</p>';
                    sendEmail($db, 'ตรวจสอบความถูกต้องเอกสาร (ไม่ถูกต้อง)', $sid, $id_rs, $uid, $resEmail['email'], "ผลการตรวจสอบความถูกต้องเอกสารรายงานปิดโครงการ REC.".$resResearch['code_apdu']." (เอกสารไม่ถูกต้อง)", $content, $comment);

                    $strSQL = "SELECT email, id FROM useraccount WHERE id IN (SELECT rct_fb_ec FROM research_consider_type WHERE rct_id_rs = '$id_rs' ORDER BY rct_id DESC) LIMIT 1";
                    $resEc = $db->fetch($strSQL, false);
                    if($resEc){
                        $return['status'] = 'Success1_1_1';
                        $id_ec = $resEc['id'];
                        $strSQL = "UPDATE rec_progress SET rp_id_ec = '$id_ec' WHERE rp_id_rs = '$id_rs' AND rp_progress_id = '$progress' AND rp_session = '$sid'";
                        $res = $db->execute($strSQL);

                        // $return['message'] = $strSQL;

                        $content = '<p>เรียน เลขานุการสำนักงาน ฯ</p>';
                        $content .= '<p>โครงการวิจัย <strong>"'.$title.'"</strong> รหัสโครงการ REC.'.$resResearch['code_apdu'].' รอดำเนินการ</p>';
                        $content .= '<p>ด้วยความเคารพอย่างสูง</p>';
                        sendEmail($db, 'เอกสารถูกต้อง รอเสนอเลขา EC', $sid, $id_rs, $uid, $resEc['email'], "รายงานปิดโครงการ REC.".$resResearch['code_apdu']." (เอกสารถูกต้อง) รอดำเนินการต่อ", $content, $comment);
                    }else{
                        $return['status'] = 'Success1_1_2';
                        // $return['message'] = $strSQL;
                    }
                }
            }else if($result == '2'){
                
                $strSQL = "UPDATE rec_progress SET rp_progress_status = '3', rp_confirm_1 = '1' WHERE rp_id_rs = '$id_rs' AND rp_progress_id = '$progress' AND rp_session = '$sid'";
                $res = $db->execute($strSQL);

                $strSQL = "INSERT INTO rec_progress_log (`rpl_datetime`, `rpl_uid`, `rpl_role`, `rpl_calculate`, `rpl_activity`, `rpl_message`, `rpl_session`, `rpl_relate_status`)
                       VALUES ('$datetime', '$uid', '$role', '1', 'เอกสารถูกต้อง', '$comment', '$sid', '3')
                      ";
                $resInsert = $db->insert($strSQL, false);

                $strSQL = "SELECT email FROM useraccount WHERE id_pm IN (SELECT id_pm FROM research WHERE id_rs = '$id_rs') ORDER BY id DESC LIMIT 1";
                $resEmail = $db->fetch($strSQL, false);

                $strSQL = "SELECT code_apdu, title_th, title_en FROM research WHERE id_rs = '$id_rs' LIMIT 1";
                $resResearch = $db->fetch($strSQL, false);

                if(($resEmail) && ($resResearch)){
                    $title = $resResearch['title_th']." (".$resResearch['title_en'].")";
                    if($resResearch['title_th'] == '-'){
                        $title = $resResearch['title_en'];
                    }
                    $content = '<p>เรียน นักวิจัยที่นับถือ</p>';
                    $content .= '<p>เนื่องด้วยเจ้าหน้าที่ได้ตรวจสอบรายงานปิดโครงการของโครงการวิจัย <strong>"'.$title.'"</strong> รหัสโครงการ REC.'.$resResearch['code_apdu'].' โดยมีผลการตรวจสอบ คือ <strong>เอกสารถูกต้อง</strong> และเข้าสู่กระบวนการส่งเพื่อพิจารณาต่อไป</p>';
                    $content .= '<p>จึงเรียนมาเพื่อให้ท่านดำเนินการแก้ไขและส่งกลับมายังสำนักงานผ่านระบบ RMIS หากมีข้อสงสัยกรุณาโทรติดต่อสำนักงาน</p>';
                    $content .= '<p>ด้วยความเคารพอย่างสูง</p>';
                    sendEmail($db, 'ตรวจสอบความถูกต้องเอกสาร (เอกสารถูกต้อง)', $sid, $id_rs, $uid, $resEmail['email'], "ผลการตรวจสอบความถูกต้องเอกสารรายงานปิดโครงการ REC.".$resResearch['code_apdu']." (เอกสารถูกต้อง)", $content, $comment);

                    $strSQL = "SELECT email, id FROM useraccount WHERE id IN (SELECT rct_fb_ec FROM research_consider_type WHERE rct_id_rs = '$id_rs' ORDER BY rct_id DESC) LIMIT 1";
                    $resEc = $db->fetch($strSQL, false);
                    if($resEc){

                        $id_ec = $resEc['id'];
                        $strSQL = "UPDATE rec_progress SET rp_id_ec = '$id_ec' WHERE rp_id_rs = '$id_rs' AND rp_progress_id = '$progress' AND rp_session = '$sid'";
                        $res = $db->execute($strSQL);
                        // $return['message'] = $strSQL;

                        $content = '<p>เรียน เลขานุการสำนักงาน ฯ</p>';
                        $content .= '<p>โครงการวิจัย <strong>"'.$title.'"</strong> รหัสโครงการ REC.'.$resResearch['code_apdu'].' รอดำเนินการ</p>';
                        $content .= '<p>ด้วยความเคารพอย่างสูง</p>';
                        sendEmail($db, 'เอกสารถูกต้อง รอเสนอเลขา EC', $sid, $id_rs, $uid, $resEc['email'], "รายงานปิดโครงการ REC.".$resResearch['code_apdu']." (เอกสารถูกต้อง) รอดำเนินการต่อ", $content, $comment);
                    }
                }
            }

            $return['status'] = 'Success';
        }else{
            $return['status'] = 'Fail x1002';
        }
    } // End closing 

    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'rename_file'){
    if(
        (!isset($_REQUEST['file_id'])) ||
        (!isset($_REQUEST['uid'])) ||
        (!isset($_REQUEST['role'])) ||
        (!isset($_REQUEST['id_rs'])) ||
        (!isset($_REQUEST['session_id'])) ||
        (!isset($_REQUEST['new_name']))
      ){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }

    $uid = mysqli_real_escape_string($conn, $_REQUEST['uid']);
    $role = mysqli_real_escape_string($conn, $_REQUEST['role']);
    $new_name = mysqli_real_escape_string($conn, $_REQUEST['new_name']);
    $file_id = mysqli_real_escape_string($conn, $_REQUEST['file_id']);
    $id_rs = mysqli_real_escape_string($conn, $_REQUEST['id_rs']);
    $session_id = mysqli_real_escape_string($conn, $_REQUEST['session_id']);

    $strSQL = "SELECT rpfs_name FROM rec_progress_file_submit WHERE rpfs_id = '$file_id'";
    $resCheck = $db->fetch($strSQL, false, false);
    if($resCheck){
        $prevName = $resCheck['rpfs_name'];
        $strSQL = "UPDATE rec_progress_file_submit SET rpfs_name = '$new_name' WHERE rpfs_id = '$file_id'";
        $res = $db->execute($strSQL);
    
        if($res){
            $strSQL = "INSERT INTO rec_progress_log (`rpl_datetime`, `rpl_uid`, `rpl_role`, `rpl_calculate`, `rpl_activity`, `rpl_message`, `rpl_session`, `rpl_relate_status`)
                       VALUES ('$datetime', '$uid', '$role', '0', 'แก้ไขชื่อไฟล์ (Ref File ID : $file_id)', 'จาก $prevName เป็น $new_name', '$session_id', '-')
                      ";
            $resInsert = $db->insert($strSQL, false);

            $return['status'] = 'Success';
        }else{
            $return['status'] = 'Fail';
            $return['error_message'] = 'Error x1003';
        }
    }else{
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1002';
    }
    echo json_encode($return);
    mysqli_close($conn);
    die();
    
}

if($stage == 'add_reviewer'){
    if(
        (!isset($_REQUEST['reviewer_id'])) ||
        (!isset($_REQUEST['reviewer_type'])) ||
        (!isset($_REQUEST['session_id']))
      ){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }

    $reviewer_id = mysqli_real_escape_string($conn, $_REQUEST['reviewer_id']);
    $reviewer_type = mysqli_real_escape_string($conn, $_REQUEST['reviewer_type']);
    $session_id = mysqli_real_escape_string($conn, $_REQUEST['session_id']);

    $strSQL = "SELECT * FROM rec_reviewer WHERE rv_reply_status = 'not-send' AND rv_reviewer_id = '$reviewer_id' AND rv_session_id = '$session_id' AND rv_delete = '0' AND rv_session_end = '0'";
    $res = $db->fetch($strSQL, false);
    if($res){
        $return['status'] = 'Duplicate';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }

    $strSQL = "INSERT INTO rec_reviewer (`rv_reviewer_id`, `rv_reviewer_type`, `rv_session_id`, `rv_assign_datetime`) VALUES ('$reviewer_id', '$reviewer_type', '$session_id', '$datetime')";
    $res = $db->insert($strSQL, false);
    if($res){
        $return['status'] = 'Success';
    }else{
        $return['status'] = 'Fail';
    }
    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'list_reviewer'){
    if(
        (!isset($_REQUEST['session_id']))
      ){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }

    $session_id = mysqli_real_escape_string($conn, $_REQUEST['session_id']);

    $strSQL = "SELECT * FROM rec_reviewer a INNER JOIN userinfo b ON a.rv_reviewer_id = b.user_id 
               WHERE 
               a.rv_session_id = '$session_id' AND a.rv_delete = '0'";
    $res = $db->fetch($strSQL, true);
    if(($res) && ($res['status'])){
        $return['status'] = 'Success';
        $return['data'] = $res['data'];

        $b = array();
        $c = 0;

        foreach ($res['data'] as $row) {
            $strSQL = "SELECT rp_progress_id FROM rec_progress WHERE rp_session = '$session_id'";
            $res = $db->fetch($strSQL, false);
            if($res){
                $strSQL = "SELECT * FROM rec_assesment_".$res['rp_progress_id']." WHERE rac_id_reviewer = '".$row['rv_reviewer_id']."' AND rac_complete_review = '1' AND rac_newround = '0' ";
                $resC = $db->fetch($strSQL, false);
                if($resC){
                    $return['review_status'][$c] = 1;
                }else{
                    $return['review_status'][$c] = 0;
                    $return['review_status'][$c] = $strSQL;
                }
            }else{
                $return['review_status'][$c] = 0;
            }
            $c++;
        }
        
    }else{
        $return['status'] = 'Fail';
    }
    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'get_asses_info'){
    if(
        (!isset($_REQUEST['session_id'])) ||
        (!isset($_REQUEST['reviewer_id'])) ||
        (!isset($_REQUEST['id_asssess']))
      ){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }

    $session_id = mysqli_real_escape_string($conn, $_REQUEST['session_id']);
    $reviewer_id = mysqli_real_escape_string($conn, $_REQUEST['reviewer_id']);
    $progress_id = mysqli_real_escape_string($conn, $_REQUEST['progress_id']);
    $id_asssess = mysqli_real_escape_string($conn, $_REQUEST['id_asssess']);

    $strSQL = "SELECT * FROM rec_assesment_".$progress_id." 
              WHERE 
              rac_id_reviewer = '$reviewer_id' 
              AND rac_sid = '$session_id' 
              AND rac_newround = '0' 
              AND rac_complete_review = '1' 
              AND rac_session_end = '0'
              ORDER BY rac_id 
              DESC LIMIT 1";
    $res = $db->fetch($strSQL, false);
    if($res){
        $return['status'] = 'Success';
        $return['data'] = $res;
    }else{
        $return['status'] = 'Fail';
        $return['cmd'] = $strSQL;
    }
    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'delete_reviewer'){
    if(
        (!isset($_REQUEST['session_id'])) ||
        (!isset($_REQUEST['reviewer_id']))
      ){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }

    $session_id = mysqli_real_escape_string($conn, $_REQUEST['session_id']);
    $reviewer_id = mysqli_real_escape_string($conn, $_REQUEST['reviewer_id']);

    $strSQL = "UPDATE rec_reviewer SET rv_delete = '1' WHERE rv_session_id = '$session_id' AND rv_reviewer_id = '$reviewer_id'";
    $res = $db->execute($strSQL);
    $return['status'] = 'Success';
    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'confirm_stage3'){
    if(
        (!isset($_REQUEST['session_id'])) ||
        (!isset($_REQUEST['result'])) ||
        (!isset($_REQUEST['uid'])) ||
        (!isset($_REQUEST['comment'])) ||
        (!isset($_REQUEST['role']))
      ){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }

    $session_id = mysqli_real_escape_string($conn, $_REQUEST['session_id']);
    $result = mysqli_real_escape_string($conn, $_REQUEST['result']);
    $uid = mysqli_real_escape_string($conn, $_REQUEST['uid']);
    $role = mysqli_real_escape_string($conn, $_REQUEST['role']);
    $comment = mysqli_real_escape_string($conn, $_REQUEST['comment']);

    if($result == '1'){
        $strSQL = "UPDATE rec_progress SET rp_progress_status = '17' WHERE rp_session = '$session_id'";
        $res = $db->execute($strSQL);

        $strSQL = "INSERT INTO rec_progress_log (`rpl_datetime`, `rpl_uid`, `rpl_role`, `rpl_calculate`, `rpl_activity`, `rpl_message`, `rpl_session`, `rpl_relate_status`)
                   VALUES ('$datetime', '$uid', '$role', '1', 'เลขาส่งเจ้าหน้าที่เพื่อขอเอกสารเพิ่มเติมหรือดำเนินการอื่น ๆ จากนักวิจัย', '$comment', '$session_id', '17')
                  ";
        $resInsert = $db->insert($strSQL, false);

        $strSQL = "INSERT INTO rec_wait_staff_progress (`rwp_title`, `rwp_info`, `rwp_session_id`, `rwp_datetime`, `rwp_status`, `rwp_notify_by`)
                   VALUES ('เลขาส่งเจ้าหน้าที่เพื่อขอเอกสารเพิ่มเติมหรือดำเนินการอื่น ๆ จากนักวิจัย', '$comment', '$session_id', '$datetime', '1', '$uid')
                  ";
        $resInsert = $db->insert($strSQL, false);

        $return['status'] = 'Success';
    }

    if($result == '2'){
        $strSQL = "UPDATE rec_progress SET rp_progress_status = '4' WHERE rp_session = '$session_id'";
        $res = $db->execute($strSQL);

        $strSQL = "INSERT INTO rec_progress_log (`rpl_datetime`, `rpl_uid`, `rpl_role`, `rpl_calculate`, `rpl_activity`, `rpl_message`, `rpl_session`, `rpl_relate_status`)
                   VALUES ('$datetime', '$uid', '$role', '1', 'เลขาส่งเจ้าหน้าที่เพื่อส่งแบบประเมินไปยังผู้เชี่ยวชาญอิสระ', '$comment', '$session_id', '4')
                  ";
        $resInsert = $db->insert($strSQL, false);

        $strSQL = "INSERT INTO rec_wait_staff_progress (`rwp_title`, `rwp_info`, `rwp_session_id`, `rwp_datetime`, `rwp_status`, `rwp_notify_by`)
                   VALUES ('เลขาส่งเจ้าหน้าที่เพื่อส่งแบบประเมินไปยังผู้เชี่ยวชาญอิสระ', '$comment', '$session_id', '$datetime', '1', '$uid')
                  ";
        $resInsert = $db->insert($strSQL, false);

        $return['status'] = 'Success';
    }

    if($result == '1'){
        $strSQL = "UPDATE rec_progress SET rp_progress_status = '17' WHERE rp_session = '$session_id'";
        $res = $db->execute($strSQL);

        $strSQL = "INSERT INTO rec_progress_log (`rpl_datetime`, `rpl_uid`, `rpl_role`, `rpl_calculate`, `rpl_activity`, `rpl_message`, `rpl_session`, `rpl_relate_status`)
                   VALUES ('$datetime', '$uid', '$role', '1', 'เลขาส่งเจ้าหน้าที่เพื่อขอเอกสารเพิ่มเติมหรือดำเนินการอื่น ๆ จากนักวิจัย', '$comment', '$session_id', '17')
                  ";
        $resInsert = $db->insert($strSQL, false);

        $strSQL = "INSERT INTO rec_wait_staff_progress (`rwp_title`, `rwp_info`, `rwp_session_id`, `rwp_datetime`, `rwp_status`, `rwp_notify_by`)
                   VALUES ('เลขาส่งเจ้าหน้าที่เพื่อขอเอกสารเพิ่มเติมหรือดำเนินการอื่น ๆ จากนักวิจัย', '$comment', '$session_id', '$datetime', '1', '$uid')
                  ";
        $resInsert = $db->insert($strSQL, false);

        $return['status'] = 'Success';
    }

    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'assesment_submission'){
    $session_id = mysqli_real_escape_string($conn, $_REQUEST['session_id']);
    $progress = mysqli_real_escape_string($conn, $_REQUEST['progress']);
    $uid = mysqli_real_escape_string($conn, $_REQUEST['uid']);
    $role = mysqli_real_escape_string($conn, $_REQUEST['role']);

    if($progress == 'closing'){
        $q1 = mysqli_real_escape_string($conn, $_REQUEST['q1']);
        $q1_info = mysqli_real_escape_string($conn, $_REQUEST['q1_info']);

        $q2 = mysqli_real_escape_string($conn, $_REQUEST['q2']);
        $q2_info = mysqli_real_escape_string($conn, $_REQUEST['q2_info']);

        $q3 = mysqli_real_escape_string($conn, $_REQUEST['q3']);
        $q3_info = mysqli_real_escape_string($conn, $_REQUEST['q3_info']);

        $q4 = mysqli_real_escape_string($conn, $_REQUEST['q4']);
        $q4_info = mysqli_real_escape_string($conn, $_REQUEST['q4_info']);

        $q5 = mysqli_real_escape_string($conn, $_REQUEST['q5']);
        $q5_info = mysqli_real_escape_string($conn, $_REQUEST['q5_info']);

        $q7 = mysqli_real_escape_string($conn, $_REQUEST['q7']);
        $q7_info = mysqli_real_escape_string($conn, $_REQUEST['q7_info']);

        $strSQL = "SELECT * FROM rec_assesment_closing WHERE rac_sid = '$session_id' AND rac_id_reviewer = '$uid' AND rac_complete_review = '1' AND rac_newround = '0' AND rac_session_end = '0'";
        $res = $db->fetch($strSQL, false);

        if($res){
            $strSQL = "UPDATE 
                        rec_assesment_closing 
                      SET 
                      rac_q1 = '$q1',
                      rac_q1_info = '$q1_info',
                      rac_q2 = '$q2',
                      rac_q2_info = '$q2_info',
                      rac_q3 = '$q3',
                      rac_q3_info = '$q3_info',
                      rac_q4 = '$q4',
                      rac_q4_info = '$q4_info',
                      rac_q5 = '$q5',
                      rac_q5_info = '$q5_info',
                      rac_q7 = '$q7',
                      rac_q7_info = '$q7_info',
                      rac_udatetime = '$datetime'
                      WHERE 
                      rac_sid = '$session_id' 
                      AND rac_id_reviewer = '$uid' 
                      AND rac_newround = '0'
                      AND rac_session_end = '0'
                      ";

                $res = $db->execute($strSQL);
                $return['status'] = 'Success';

            if($q1 == '2'){ insertComment($db, $session_id, '1', $q1, '2', $q1_info, $uid, $datetime, 'จำนวนอาสาสมัครที่เข้าร่วมโครงการวิจัยเป็นไปตามแผนที่วางไว้หรือไม่'); }
            if($q2 == '2'){ insertComment($db, $session_id, '2', $q2, '2', $q2_info, $uid, $datetime, 'การดำเนินงานเป็นไปตามโครงร่างการวิจัยที่รับรองหรือไม่'); }
            if($q3 == '2'){ insertComment($db, $session_id, '3', $q3, '2', $q3_info, $uid, $datetime, 'ประโยชน์และผลกระทบต่ออาสาสมัครเหมาะสม'); }
            if(($q4 == '2') || ($q4 == '3')) { insertComment($db, $session_id, '4', $q4, '2', $q4_info, $uid, $datetime, 'การดำเนินการที่เกี่ยวข้องกับอาสาสมัครหลังสิ้นสุดการวิจัยเหมาะสม'); }
            // if($q5 == '2'){ insertComment($db, $session_id, '5', $q5, '2', $q5_info, $uid, $datetime); }
            if($q7 == '2'){ insertComment($db, $session_id, '6', $q7, '2', $q7_info, $uid, $datetime, 'ความเห็นกรรมการ'); }

            $return['status'] = 'Success';
            
        }else{
            $strSQL = "INSERT INTO rec_assesment_closing (`rac_q1`, `rac_q1_info`, `rac_q2`, `rac_q2_info`, `rac_q3`, `rac_q3_info`, `rac_q4`, `rac_q4_info`, `rac_q5`, `rac_q5_info`,  `rac_q7`, `rac_q7_info`, `rac_id_reviewer`, `rac_udatetime`, `rac_submit_datetime`, `rac_complete_review`, `rac_sid`) VALUES 
                        ('$q1', '$q1_info', '$q2', '$q2_info', '$q3', 
                        '$q3_info', '$q4', '$q4_info', '$q5', '$q5_info', 
                        '$q7', '$q7_info', '$uid', 
                        '$datetime', '$datetime', '1', '$session_id')
                    ";
            $res = $db->insert($strSQL, false);
            if($res){

                if($q1 == '2'){ insertComment($db, $session_id, '1', $q1, '2', $q1_info, $uid, $datetime, 'จำนวนอาสาสมัครที่เข้าร่วมโครงการวิจัยเป็นไปตามแผนที่วางไว้หรือไม่'); }
                if($q2 == '2'){ insertComment($db, $session_id, '2', $q2, '2', $q2_info, $uid, $datetime, 'การดำเนินงานเป็นไปตามโครงร่างการวิจัยที่รับรองหรือไม่'); }
                if($q3 == '2'){ insertComment($db, $session_id, '3', $q3, '2', $q3_info, $uid, $datetime, 'ประโยชน์และผลกระทบต่ออาสาสมัครเหมาะสม'); }
                if(($q4 == '2') || ($q4 == '3')) { insertComment($db, $session_id, '4', $q4, '2', $q4_info, $uid, $datetime, 'การดำเนินการที่เกี่ยวข้องกับอาสาสมัครหลังสิ้นสุดการวิจัยเหมาะสม'); }
                // if($q5 == '2'){ insertComment($db, $session_id, '5', $q5, '2', $q5_info, $uid, $datetime); }
                if($q7 == '2'){ insertComment($db, $session_id, '6', $q7, '2', $q7_info, $uid, $datetime, 'ความเห็นกรรมการ'); }

                $return['status'] = 'Success';
            }else{
                $return['status'] = 'Fail';
                $return['msg'] = $strSQL;
            }
        }
    }

    echo json_encode($return);
    mysqli_close($conn);
    die();
    
}

if($stage == 'result_to_20_withcomment'){ // ส่งนักวิจัยตอบข้อเสนอแนะ
    if(
        (!isset($_REQUEST['uid'])) ||
        (!isset($_REQUEST['role'])) ||
        (!isset($_REQUEST['message'])) ||
        (!isset($_REQUEST['return_choice'])) ||
        (!isset($_REQUEST['id_rs'])) ||
        (!isset($_REQUEST['session_id']))
      ){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }
    $uid = mysqli_real_escape_string($conn, $_REQUEST['uid']);
    $role = mysqli_real_escape_string($conn, $_REQUEST['role']);
    $message = mysqli_real_escape_string($conn, $_REQUEST['message']);
    $return_choice = mysqli_real_escape_string($conn, $_REQUEST['return_choice']);
    $id_rs = mysqli_real_escape_string($conn, $_REQUEST['id_rs']);
    $session_id = mysqli_real_escape_string($conn, $_REQUEST['session_id']);

    $mx = 1;
    $strSQL = "SELECT MAX(crc_round) mx FROM rec_comment_round WHERE crc_session_id = '$session_id' AND crc_id_rs = '$id_rs'";
    $res = $db->fetch($strSQL, false, false);
    if($res){
        $mx = $res['mx'] + 1;
    }

    $strSQL = "UPDATE rec_comment SET recc_id_round = '$mx', recc_send_datetime = '$datetime' WHERE recc_session_id = '$session_id'";
    $resUpdate = $db->execute($strSQL);

    $strSQL = "UPDATE rec_progress SET rp_progress_status = '20' WHERE rp_id_rs = '$id_rs' AND rp_session = '$session_id'";
    $resUpdate = $db->execute($strSQL);

    $strSQL = "INSERT INTO rec_progress_log (`rpl_datetime`, `rpl_uid`, `rpl_role`, `rpl_calculate`, `rpl_activity`, `rpl_message`, `rpl_session`, `rpl_relate_status`)
                       VALUES ('$datetime', '$uid', '$role', '1', 'เลขาส่งนักวิจัยเพื่อตอบข้อเสนอแนะ', 'รหัสรายงาน $session_id', '$session_id', '20')
                ";
    $resInsert = $db->insert($strSQL, false);

    $strSQL = "INSERT INTO rec_note (`log_activity`, `log_detail`, `log_ip`, `log_datetime`, `log_id_rs`,  `log_session_id`, `log_by_role`, `log_countrange`, `log_by_id`)
                        VALUES ('Add not', '<p>[System] เลขาส่งนักวิจัยเพื่อตอบข้อเสนอแนะ</p>$message', '$ip', '$datetime', '$id_rs', '$session_id', '$role', '1', '$uid')
                            ";
    $resInsert = $db->insert($strSQL, false); 

    // Send e-mail to pi

    $strSQL = "SELECT * FROM useraccount a INNER JOIN userinfo b ON a.id = b.user_id WHERE a.id IN (SELECT rp_uid FROM rec_progress WHERE rp_id_rs = '$id_rs' AND rp_session = '$session_id') ORDER BY id DESC LIMIT 1";
    $resEmail = $db->fetch($strSQL, false);

    $strSQL = "SELECT code_apdu, title_th, title_en FROM research WHERE id_rs = '$id_rs' LIMIT 1";
    $resResearch = $db->fetch($strSQL, false);

    if(($resEmail) && ($resResearch)){
        $title = $resResearch['title_th']." (".$resResearch['title_en'].")";
        if($resResearch['title_th'] == '-'){
            $title = $resResearch['title_en'];
        }
        $content = '<p>เรียน นักวิจัยที่นับถือ</p>';
        $content .= '<p>เนื่องด้วยเจ้าหน้าที่ได้ตรวจสอบรายงานปิดโครงการของโครงการวิจัย <strong>"'.$title.'"</strong> รหัสโครงการ REC.'.$resResearch['code_apdu'].' สำนักงานได้ทำการพิจารณาและมีข้อเสนอแนะซึ่งได้แนบผ่านระบบ RMIS แล้ว ขอให้ท่านเข้าสู่ระบบและดำเนินการตาม/ตอบข้อเสนอแนะต่อไป</p>';
        $content .= '<p>จึงเรียนมาเพื่อให้ท่านดำเนินการแก้ไขและส่งกลับมายังสำนักงานผ่านระบบ RMIS หากมีข้อสงสัยกรุณาโทรติดต่อสำนักงาน</p>';
        $content .= '<p>ด้วยความเคารพอย่างสูง</p>';
        sendEmail($db, 'รายงานโครงการวิจัย REC.'.$resResearch['code_apdu'].'รอดำเนินการ/ตอบข้อเสนอแนะ', $session_id, $id_rs, $uid, $resEmail['email'], "ผลการตรวจสอบความถูกต้องเอกสารรายงานปิดโครงการ REC.".$resResearch['code_apdu']." (เอกสารถูกต้อง)", $content, $message);

    }

    $return['status'] = 'Success';
    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'result_to_15'){ // ส่งเจ้าหน้าที่นำเข้าที่ประชุม

}

if($stage == 'result_to_4'){ // ส่งเจ้าหน้าที่ส่ง Reviewer เพิ่มเติม

}


if($stage == 'save_other_comment'){
    $session_id = mysqli_real_escape_string($conn, $_REQUEST['sid']);
    $uid = mysqli_real_escape_string($conn, $_REQUEST['uid']);
    $comment = mysqli_real_escape_string($conn, $_REQUEST['comment']);

    $strSQL = "SELECT MAX(recc_seq) mx FROM rec_comment WHERE recc_session_id = '$session_id' AND recc_delete = '0'";
    $resCheck = $db->fetch($strSQL, false, false);
    $seq = 1; if($resCheck){ $seq = $resCheck['mx'] + 1; }

    $strSQL = "INSERT INTO rec_comment (`recc_seq`, `recc_comment`, `recc_id_reviewer`, `recc_id_round`, `recc_create_datetime`, `recc_session_id`)
               VALUES ('$seq', '$comment', '$uid', NULL, '$datetime', '$session_id')
              ";
    $resInsert = $db->insert($strSQL, false);
    if($resInsert){
        $return['status'] = 'Success';
    }else{
        $return['status'] = 'Fail';
    }
    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'reviewer_comment_submission'){
    $session_id = mysqli_real_escape_string($conn, $_REQUEST['sid']);
    $cid = mysqli_real_escape_string($conn, $_REQUEST['cid']);
    $progress = mysqli_real_escape_string($conn, $_REQUEST['progress']);
    $uid = mysqli_real_escape_string($conn, $_REQUEST['uid']);
    $comment = mysqli_real_escape_string($conn, $_REQUEST['comment']);

    $m = 1;
    $seq = 1;

    $strSQL = "SELECT MAX(recc_id_round) mx FROM rec_comment WHERE recc_session_id = '$session_id' AND recc_status = '4' AND recc_delete = '0'";
    $res = $db->fetch($strSQL, false);
    if($res){
        if($res['mx'] != null)
            $m = $res['mx'];
    }

    $strSQL = "SELECT MAX(recc_seq) mx FROM rec_comment WHERE 1";
    $res = $db->fetch($strSQL, false);
    if($res){
        if($res['mx'] != null)
            $seq = $res['mx'] + 1;
    }

    if($cid == ''){
        $strSQL = "INSERT INTO rec_comment (`recc_comment`, `recc_seq`, `recc_id_reviewer`, `recc_id_round`, `recc_create_datetime`, `recc_session_id`, `recc_progress`)
               VALUES ('$comment', '$seq', '$uid', '$m', '$datetime', '$session_id', '$progress')
              ";
        $res = $db->insert($strSQL, false);
        if($res){
            $return['status'] = 'Success';
        }else{
            $return['status'] = 'Fail';
            $return['msg'] = $strSQL;
        }
    }else{

        $strSQL = "UPDATE rec_comment SET recc_comment = '$comment', recc_create_datetime = '$datetime' WHERE recc_id = '$cid'";
        $res = $db->execute($strSQL);
        $return['status'] = 'Success';

    }

    

    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'reviewer_comment_delete'){
    $session_id = mysqli_real_escape_string($conn, $_REQUEST['sid']);
    $id_recc = mysqli_real_escape_string($conn, $_REQUEST['id_recc']);

    $strSQL = "UPDATE rec_comment SET recc_delete = '1' WHERE recc_id = '$id_recc' AND recc_session_id = '$session_id' ";
    $res = $db->execute($strSQL);

    $return['status'] = 'Success';
    // $return['data'] = $strSQL;
    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'reviewer_comment_list_staff'){
    $session_id = mysqli_real_escape_string($conn, $_REQUEST['sid']);
    $progress = mysqli_real_escape_string($conn, $_REQUEST['progress']);

    $strSQL = "SELECT * FROM rec_comment a INNER JOIN userinfo b ON a.recc_id_reviewer = b.user_id
               LEFT JOIN rec_assesment_closing_ref c ON a.recc_q_number = c.racr_ass_no
               WHERE 
               a.recc_session_id = '$session_id' 
               AND a.recc_delete = '0'
               AND a.recc_q_end = '0'
               ORDER BY a.recc_q_number, a.recc_seq";
    $res = $db->fetch($strSQL, true);
    if(($res) && ($res['status'])){
        $return['status'] = 'Success';
        $b = array();
        $c = 0;
        foreach ($res['data'] as $row) {
            $b['recc_id'] = $row['recc_id'];
            $b['recc_seq'] = $row['recc_seq'];
            $b['recc_comment'] = $row['recc_comment'];
            $b['recc_status'] = $row['recc_status'];
            $b['recc_id_reviewer'] = $row['recc_id_reviewer'];
            $b['recc_id_round'] = $row['recc_id_round'];
            $b['recc_title'] = $row['racr_ass_question'];
            $b['recc_fullname'] = $row['fname']." ".$row['lname'];

            if($c == 0){
                $b['recc_up_to'] = '0';
                $b['recc_down_to'] = $res['data'][$c+1]['recc_seq'];
            }else if($c == (sizeof($res['data']) - 1)){
                $b['recc_up_to'] = $res['data'][$c-1]['recc_seq'];
                $b['recc_down_to'] = '0';
            }else{
                $b['recc_up_to'] = $res['data'][$c-1]['recc_seq'];
                $b['recc_down_to'] = $res['data'][$c+1]['recc_seq'];
            }
            $return['data'][] = $b;
            $c++;
        }

        
    }else{
        $return['status'] = 'Fail';
        $return['msg'] = $strSQL;
    }
    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'reviewer_comment_changeseq'){
    $session_id = mysqli_real_escape_string($conn, $_REQUEST['sid']);
    $id_recc = mysqli_real_escape_string($conn, $_REQUEST['id_recc']);
    $up = mysqli_real_escape_string($conn, $_REQUEST['up']);
    $down = mysqli_real_escape_string($conn, $_REQUEST['down']);
    $direction = mysqli_real_escape_string($conn, $_REQUEST['direction']);
    $curr = mysqli_real_escape_string($conn, $_REQUEST['curr']);

    if($direction == '0'){ // Up

        $strSQL = "SELECT recc_id FROM rec_comment WHERE recc_session_id = '$session_id' AND recc_seq = '$up'";
        $res = $db->fetch($strSQL, false);
        $target_id = $res['recc_id'];

        $strSQL = "UPDATE rec_comment SET recc_seq = '$up' WHERE recc_session_id = '$session_id' AND recc_seq = '$curr'";
        $res = $db->execute($strSQL);

        $strSQL = "UPDATE rec_comment SET recc_seq = '$curr' WHERE recc_session_id = '$session_id' AND recc_id = '$target_id'";
        $res = $db->execute($strSQL);

    }else{

        $strSQL = "SELECT recc_id FROM rec_comment WHERE recc_session_id = '$session_id' AND recc_seq = '$down'";
        $res = $db->fetch($strSQL, false);
        $target_id = $res['recc_id'];

        $strSQL = "UPDATE rec_comment SET recc_seq = '$down' WHERE recc_session_id = '$session_id' AND recc_id = '$id_recc'";
        $res = $db->execute($strSQL);

        $strSQL = "UPDATE rec_comment SET recc_seq = '$curr' WHERE recc_session_id = '$session_id' AND recc_id = '$target_id'";
        $res = $db->execute($strSQL);
    }

    

    $return['status'] = 'Success';
    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'reviewer_comment_forupdate'){
    $session_id = mysqli_real_escape_string($conn, $_REQUEST['sid']);
    $cid = mysqli_real_escape_string($conn, $_REQUEST['cid']);
    $progress = mysqli_real_escape_string($conn, $_REQUEST['progress']);

    $strSQL = "SELECT * FROM rec_comment WHERE recc_session_id = '$session_id' AND recc_id = '$cid' ORDER BY recc_seq";
    $res = $db->fetch($strSQL, true);
    if($res){
        $return['status'] = 'Success';
        $return['data'] = $res['data'];
    }else{
        $return['status'] = 'Fail';
        $return['msg'] = $strSQL;
    }
    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'send_staff_tomakedoc'){
    $session_id = mysqli_real_escape_string($conn, $_REQUEST['session_id']);
    $progress = mysqli_real_escape_string($conn, $_REQUEST['progress']);
    $uid = mysqli_real_escape_string($conn, $_REQUEST['uid']);
    $role = mysqli_real_escape_string($conn, $_REQUEST['role']);
    $comment = mysqli_real_escape_string($conn, $_REQUEST['comment']);

    $strSQL = "INSERT INTO rec_wait_staff_progress (`rwp_title`, `rwp_info`, `rwp_session_id`, `rwp_datetime`, `rwp_status`, `rwp_notify_by`) 
               VALUES ('เลขาส่งเจ้าหน้าที่เพื่อออกใบรับรอง/รับทราบ', '$comment', '$session_id', '$datetime', '1', '$uid')
              ";
    $res = $db->insert($strSQL, false);

    $strSQL = "UPDATE rec_progress SET rp_progress_status = '22' WHERE rp_progress_id = '$progress' AND rp_session = '$session_id'";
    $res = $db->execute($strSQL);

    $strSQL = "INSERT INTO rec_progress_log (`rpl_datetime`, `rpl_uid`, `rpl_role`, `rpl_calculate`, `rpl_activity`, `rpl_message`, `rpl_session`, `rpl_relate_status`)
                       VALUES ('$datetime', '$uid', '$role', '1', 'เลขาส่งเจ้าหน้าที่เพื่อออกใบรับรอง/รับทราบ', 'รหัสรายงาน $session_id', '$session_id', '1')
                ";
    $resInsert = $db->insert($strSQL, false);
    $return['status'] = 'Success';
    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'send_staff_addboard'){
    $session_id = mysqli_real_escape_string($conn, $_REQUEST['session_id']);
    $progress = mysqli_real_escape_string($conn, $_REQUEST['progress']);
    $uid = mysqli_real_escape_string($conn, $_REQUEST['uid']);
    $role = mysqli_real_escape_string($conn, $_REQUEST['role']);
    $comment = mysqli_real_escape_string($conn, $_REQUEST['comment']);

    $strSQL = "INSERT INTO rec_wait_staff_progress (`rwp_title`, `rwp_info`, `rwp_session_id`, `rwp_datetime`, `rwp_status`, `rwp_notify_by`) 
               VALUES ('เลขาส่งเจ้าหน้าที่เพื่อนำเข้าที่ประชุม', '$comment', '$session_id', '$datetime', '1', '$uid')
              ";
    $res = $db->insert($strSQL, false);

    $strSQL = "UPDATE rec_progress SET rp_progress_status = '15' WHERE rp_progress_id = '$progress' AND rp_session = '$session_id'";
    $res = $db->execute($strSQL);

    $strSQL = "INSERT INTO rec_progress_log (`rpl_datetime`, `rpl_uid`, `rpl_role`, `rpl_calculate`, `rpl_activity`, `rpl_message`, `rpl_session`, `rpl_relate_status`)
                       VALUES ('$datetime', '$uid', '$role', '1', 'เลขาส่งเจ้าหน้าที่เพื่อนำเข้าที่ประชุม', 'รหัสรายงาน $session_id', '$session_id', '1')
                ";
    $resInsert = $db->insert($strSQL, false);
    $return['status'] = 'Success';
    echo json_encode($return);
    mysqli_close($conn);
    die();
}

function insertComment($db, $session_id, $q, $value, $ref, $comment, $uid, $datetime, $point){
    // insertComment($db, $session_id, '1', $q1, '2'. $q1_info, $uid, $datetime);
    $strSQL = "UPDATE rec_comment SET recc_delete = '1' WHERE recc_q_number = '$q' AND recc_id_reviewer = '$uid' AND recc_id_round IS NULL AND recc_session_id = '$session_id'";
    $db->execute($strSQL);

    $strSQL = "SELECT MAX(recc_seq) mx FROM rec_comment WHERE recc_session_id = '$session_id' AND recc_delete = '0'";
    $resCheck = $db->fetch($strSQL, false, false);
    $seq = 1; if($resCheck){ $seq = $resCheck['mx'] + 1; }

    $strSQL = "INSERT INTO rec_comment (`recc_seq`, `recc_q_number`, `recc_q_point`, `recc_comment`, `recc_id_reviewer`, `recc_id_round`, `recc_create_datetime`, `recc_session_id`)
               VALUES ('$seq', '$q', '$point', '$comment', '$uid', NULL, '$datetime', '$session_id')
              ";
    $resInsert = $db->insert($strSQL, false);
}