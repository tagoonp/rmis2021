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

if(!isset($_REQUEST['stage'])){
  mysqli_close($conn);
  die();
}

$stage = mysqli_real_escape_string($conn, $_REQUEST['stage']);

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

    $strSQL = "SELECT * FROM useraccount a INNER JOIN userinfo b ON a.id = b.user_id
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
    
    echo json_encode($return , JSON_PRETTY_PRINT);
    mysqli_close($conn);
    die();
    
}