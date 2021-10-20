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

            echo "Draft success";
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
        (!isset($_REQUEST['progress'])) ||
        (!isset($_REQUEST['role'])) ||
        (!isset($_REQUEST['role'])) ||
        (!isset($_REQUEST['result'])) ||
        (!isset($_REQUEST['comment']))
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
    $result = mysqli_real_escape_string($conn, $_REQUEST['result']);
    $comment = mysqli_real_escape_string($conn, $_REQUEST['comment']);

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

    $strSQL = "SELECT * FROM rec_reviewer WHERE rv_reply_status = 'not-send' AND rv_reviewer_id = '$reviewer_id' AND rv_session_id = '$session_id' AND rv_delete = '0'";
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
    }else{
        $return['status'] = 'Fail';
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

        $q6 = mysqli_real_escape_string($conn, $_REQUEST['q6']);
        $q6_info = mysqli_real_escape_string($conn, $_REQUEST['q6_info']);

        $q7 = mysqli_real_escape_string($conn, $_REQUEST['q7']);
        $q7_info = mysqli_real_escape_string($conn, $_REQUEST['q7_info']);

        $strSQL = "SELECT * FROM rec_assesment_closing WHERE rac_sid = '$session_id' AND rac_id_reviewer = '$uid' AND rac_complete_review = '0'";
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
                      rac_q6 = '$q6',
                      rac_q6_info = '$q6_info',
                      rac_q7 = '$q7',
                      rac_q7_info = '$q7_info',
                      rac_udatetime = '$datetime'
                      WHERE rac_sid = '$session_id' AND rac_id_reviewer = '$uid' AND rac_complete_review = '0'
                      ";

                $res = $db->execute($strSQL);
                $return['status'] = 'Success';
        }else{
            $strSQL = "INSERT INTO rec_assesment_closing (`rac_q1`, `rac_q1_info`, `rac_q2`, `rac_q2_info`, `rac_q3`, `rac_q3_info`, `rac_q4`, `rac_q4_info`, `rac_q5`, `rac_q5_info`, `rac_q6`, `rac_q6_info`, `rac_q7`, `rac_q7_info`, `rac_id_reviewer`, `rac_udatetime`, `rac_submit_datetime`, `rac_complete_review`, `rac_sid`) VALUES 
                        '$q1', '$q1_info', '$q2', '$q2_info', '$q3', 
                        '$q3_info', '$q4', '$q4_info', '$q5', '$q5_info', 
                        '$q6', '$q6_info', '$q7', '$q7_info', '$uid', 
                        '$datetime', '$datetime', '0', '$session_id',
                    ";
            $res = $db->insert($strSQL, false);
            if($res){
                $return['status'] = 'Success';
            }else{
                $return['status'] = 'Fail';
            }
        }
    }

    echo json_encode($return);
    mysqli_close($conn);
    die();
    
}