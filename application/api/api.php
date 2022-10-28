<?php 
require('../configuration/server.inc.php');
require('../configuration/configuration.php');
require('../configuration/database.php'); 

header("Content-type: application/json; charset=utf-8");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$db = new Database();
$conn = $db->conn();

// https://rmis2.medicine.psu.ac.th/rmis2021/application/api/api.php?stage=get_reviewer_list&api_key=$utodj@Xkdo%pskaXXor547Sx

if(!isset($_REQUEST['stage'])){
  mysqli_close($conn);
  die();
}

$stage = mysqli_real_escape_string($conn, $_REQUEST['stage']);

if($stage == 'create_progress_form'){
  if(
    (!isset($_REQUEST['uid'])) ||
    (!isset($_REQUEST['progress'])) ||
    (!isset($_REQUEST['id_rs']))
  ){
      $return['status'] = 'Fail';
      $return['error_message'] = 'Error x1001';
      echo json_encode($return);
      mysqli_close($conn);
      die();
  }

  $uid = mysqli_real_escape_string($conn, $_REQUEST['uid']);
  $progress = mysqli_real_escape_string($conn, $_REQUEST['progress']);
  $id_rs = mysqli_real_escape_string($conn, $_REQUEST['id_rs']);
  $sid = $dateu;

  if(($progress == 'closing') || ($progress == 'terminate')){
      $strSQL = "SELECT * FROM rec_progress WHERE rp_id_rs = '$id_rs' AND rp_delete_status = '0' AND rp_progress_id IN ('closing','terminate')";
      $res = $db->fetch($strSQL, false, false);
      if($res){
          $return['status'] = 'Found';
          $return['session_id'] = $res['rp_session'];
          echo json_encode($return);
          mysqli_close($conn);
          die();
      }
      
      $strSQL = "INSERT INTO rec_progress (`rp_uid`, `rp_id_year`, `rp_id_rs`, `rp_progress_id`, `rp_session`, `rp_sending_status`)
                 VALUES ('$uid', '$year', '$id_rs', '$progress', '$sid', '0')
                ";
      $res = $db->insert($strSQL, false);
      if($res){
          $return['status'] = 'Success';
          $return['session_id'] = $sid;
      }else{  
          $return['status'] = 'Fail';
      }
  }else{
      $strSQL = "INSERT INTO rec_progress (`rp_uid`, `rp_id_year`, `rp_id_rs`, `rp_progress_id`, `rp_session`, `rp_sending_status`)
                 VALUES ('$uid', '$year', '$id_rs', '$progress', '$sid', '0')
                ";
      $res = $db->insert($strSQL, false);
      if($res){
          $return['status'] = 'Success';
          $return['session_id'] = $sid;
      }else{  
          $return['status'] = 'Fail';
      }
  }
  echo json_encode($return);
  mysqli_close($conn);
  die();
}

// https://rmis2.medicine.psu.ac.th/rmis2021/application/api/api.php?stage=get_rmis_research_token&api_key=$utodj@Xkdo%pskaXXor547Sx&personal_id=..........
if($stage == 'get_rmis_research_token'){
    if(
        (!isset($_REQUEST['api_key'])) ||
        (!isset($_REQUEST['personal_id']))
      ){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }

    $api_key = mysqli_real_escape_string($conn, $_REQUEST['api_key']);
    $personal_id = mysqli_real_escape_string($conn, $_REQUEST['personal_id']);
    $generate_token = api_RandomString(20).date('U');

    $sysdatetime = date('Y-m-d H:i:s');

    $strSQL = "INSERT INTO research_token (`rst_token`, `rst_personal_id`, `rst_datetime`) VALUES ('$generate_token', '$personal_id', '$sysdatetime')";
    $resInsert = $db->insert($strSQL, false);

    if($resInsert){
        $return['status'] = 'Success';
        $return['rmis_research_token'] = $generate_token;
    }else{
        $return['status'] = 'Fail (1x0002)';
        // $return['error'] = $strSQL;
    }

    echo json_encode($return);
    mysqli_close($conn);
    die();

}

if($stage == 'get_reviewer_list'){
    if(
        (!isset($_REQUEST['api_key']))
      ){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }

    $api_key = mysqli_real_escape_string($conn, $_REQUEST['api_key']);

    $strSQL = "SELECT id_pm, username, usertype,prefix_th, prefix_en, fname, lname,fname_en, lname_en, dept_name, dept_name_en, email  FROM useraccount a INNER JOIN userinfo b ON a.id = b.user_id
                LEFT JOIN dept c ON b.id_dept = c.id_dept
               WHERE a.reviewer_role = '1'
               AND a.delete_status = '0'
               AND a.allow_status = '1'
              ";
    $res = $db->fetch($strSQL, true, false);
    if(($res) && ($res['status'])){
        $return['status'] = 'Success';
        $return['data'] = $res['data'];
    }else{
        $return['status'] = 'No record found';
        $return['error_message'] = 'Error x1001';
    }
    
    echo json_encode($return , JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    mysqli_close($conn);
    die();
    
}

function api_RandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
