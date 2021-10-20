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

if(!isset($_REQUEST['progress'])){
  mysqli_close($conn);
  die();
}

$progress = mysqli_real_escape_string($conn, $_REQUEST['progress']);

if($progress == 'closing'){
    if(
        (!isset($_REQUEST['uid'])) ||
        (!isset($_REQUEST['pid'])) ||
        (!isset($_REQUEST['session_id'])) ||
        (!isset($_REQUEST['fileposition']))
      ){
        echo 'Fail x1001';
        mysqli_close($conn);
        die();
    }

    $uid = mysqli_real_escape_string($conn, $_REQUEST['uid']);
    $id_rs = mysqli_real_escape_string($conn, $_REQUEST['pid']);
    $fileposition = mysqli_real_escape_string($conn, $_REQUEST['fileposition']);
    $session_id = mysqli_real_escape_string($conn, $_REQUEST['session_id']);

    if (!empty($_FILES)) {
        $path = '../tmp_file/closing-'.$session_id;
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }
    
        $originalName = $_FILES['file']['name'];

        $generatedName = $dateu.'-closing-'.$_FILES['file']['name'];
        $filePath = $path."/".$generatedName;

        if (move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
            $fileUrl = ROOT_DOMAIN.'tmp_file/closing-'.$session_id.'/'.$generatedName;

            $strSQL = "INSERT INTO rec_progress_file_submit 
                       (
                           `rpfs_name`, `rpfs_url`, `rpfs_progress`, `rpfs_position`, `rpfs_id_rs`, `rpfs_session`, `rpfs_udatetime`
                       )
                       VALUES 
                       (
                           '$originalName', '$fileUrl', 'closing', '$fileposition', '$id_rs', '$session_id', '$datetime'
                       )
                       ";
            $resInsert = $db->insert($strSQL, false);
            if($resInsert){
                echo "Success";
            }else{
                echo "Fail x1003";
            }
            $db->close(); 
            die();
        }
    }else{
        echo "Fail x1002";
        $db->close(); 
        die();
    }

    
}