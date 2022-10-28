<?php 
require('../configuration/server.inc.php');
require('../configuration/configuration.php');
require('../configuration/database.php'); 

if((!isset($_REQUEST['uid'])) || (!isset($_REQUEST['role']))){
  mysqli_close($conn);
  echo "aaa";
  die();
}

$db = new Database();
$conn = $db->conn();

require('../configuration/sendemail.php'); 

$uid = mysqli_real_escape_string($conn, $_REQUEST['uid']);
$role = mysqli_real_escape_string($conn, $_REQUEST['role']);

$_SESSION['rmis_uid'] = $uid;
$_SESSION['rmis_role'] = $role;
$_SESSION['rmis_id'] = session_id();

// echo $_SESSION['rmis_role'];
// die();

$strSQL = "SELECT * FROM useraccount a INNER JOIN userinfo b ON a.id = b.user_id WHERE a.id = '$uid' LIMIT 1";
$res = $db->fetch($strSQL, false, false);

if($res){
  $email = $res['email'];
  $title = "[RMIS] แจ้งเตือนการเข้าใช้งานระบบ";
  $content = '<p>เรียน คุณ'.$res['fname']." ".$res['lname'].'</p>';
  $content .= '<p>ท่านได้ทำการล๊อคอินเข้าใช้งานระบบ RMIS ผ่าน IP Address '.$ip.' หากนี่ไม่ใช่กิจกรรมของท่าน กรุณาติดต่อเจ้าน้าที่เพื่อตรวจสอบข้อมูลและดำเนินการต่อไป</p>';
  $content .= '<p>จึงเรียนมาเพื่อทราบ หากมีข้อสงสัยกรุณาโทรติดต่อสำนักงาน</p>';
  $content .= '<p>ด้วยความเคารพอย่างสูง</p>';
  sendEmail($db, 'แจ้งเตือนการเข้าใช้งานระบบ', '', '', $uid, $email, "แจ้งเตือนการเข้าใช้งานระบบ", $content, '');
}

?>
<script>
  window.localStorage.setItem('rmis5_uid', '<?php echo $uid; ?>')
  window.localStorage.setItem('rmis5_role', '<?php echo $role; ?>')
</script>
<?php

if($_SESSION['rmis_role'] == 'chairman'){
  header('Location: '.ROOT_DOMAIN.'chairman2/index?uid='.$uid.'&role='.$role);
}else{
  header('Location: '.ROOT_DOMAIN.'html/core/'.$role.'/index?uid='.$uid.'&role='.$role);
}


die();




?>