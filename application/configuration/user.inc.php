<?php 

$sid = mysqli_real_escape_string($conn, $_SESSION['rmis_id']);
$role = mysqli_real_escape_string($conn, $_SESSION['rmis_role']);
$uid = mysqli_real_escape_string($conn, $_SESSION['rmis_uid']);
// $strSQL = "SELECT * FROM useraccount a inner join userinfo b on a.id = b.user_id 
//            LEFT JOIN dept c ON b.id_dept = c.id_dept
//            LEFT JOIN type_personnel d ON b.id_personnel = d.id_personnel
//            WHERE a.id = '$uid' AND a.".$role."_role = '1' AND a.active_status = '1' AND a.delete_status = '0' AND a.allow_status = '1'";

$strSQL = "SELECT * FROM useraccount a INNER JOIN userinfo b ON a.id = b.user_id WHERE a.id = '$uid' AND a.active_status = '1' AND a.delete_status = '0' AND a.allow_status = '1' AND a.".$role."_role = '1'";
$result = $db->fetch($strSQL, false);
if($result){
    $current_user = $result;
    $my_id_pm = $result['id_pm'];
    $dataUser = $result;
}else{
    $db->close();
    // header('Location: '.RMIS_DOMAIN );
    die();
}

$userFullname = $dataUser['fname']." ".$dataUser['lname'];
if(($dataUser['fname'] == NULL) || ($dataUser['fname'] == '-') || ($dataUser['fname'] == '')){
    $userFullname = $dataUser['fname_en']." ".$dataUser['lname_en'];
}

?>

<input type="hidden" id="txtSid" value="<?php echo $_SESSION['rmis_id'];?>">
<input type="hidden" id="txtUid" value="<?php echo $_SESSION['rmis_uid'];?>">
<input type="hidden" id="txtRole" value="<?php echo $_SESSION['rmis_role'];?>">