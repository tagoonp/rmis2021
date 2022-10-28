<?php
include "../conf.inc.php";
include "../connect.inc.php";
include "../function.inc.php";
include "./function.php";

if((!isset($_GET['uid'])) || ($_GET['uid'] == '')){
    header('Location: ../index');
    die();
}

if((!isset($_GET['role'])) || ($_GET['role'] == '')){
    header('Location: ../index');
    die();
}

if((!isset($_GET['pid'])) || ($_GET['pid'] == '')){
    header('Location: ../index');
    die();
}

$uid = mysqli_real_escape_string($conn, $_GET['uid']);
$role = mysqli_real_escape_string($conn, $_GET['role']);
$id_rs = mysqli_real_escape_string($conn, $_GET['pid']);

$strSQL = "SELECT * FROM useraccount a INNER JOIN userinfo b ON a.id = b.user_id
           LEFT JOIN type_personnel c on b.id_personnel = c.id_personnel
           LEFT JOIN type_prefix d ON b.id_prefix = d.id_prefix
           WHERE a.id = '$uid' AND a.active_status = '1' AND a.delete_status = '0' AND a.allow_status = '1' AND a.".$role."_role = '1' LIMIT 1";
$resultUser = mysqli_query($conn, $strSQL);
$dataUser = null;
if(($resultUser) && (mysqli_num_rows($resultUser) > 0)){
    $dataUser = mysqli_fetch_assoc($resultUser);
}else{
    header('Location: ../index');
    die();
}

$userFullname = $dataUser['fname']." ".$dataUser['lname'];
if(($dataUser['fname'] == NULL) || ($dataUser['fname'] == '-') || ($dataUser['fname'] == '')){
    $userFullname = $dataUser['fname_en']." ".$dataUser['lname_en'];
}


// Check research information
$strSQL = "SELECT * FROM research a INNER JOIN useraccount b ON a.id_pm = b.id_pm
           LEFT JOIN userinfo c ON b.id = c.user_id
           LEFT JOIN type_research d ON a.id_type = d.id_type
           LEFT JOIN year e ON a.id_year = e.id_year
           LEFT JOIN type_status_research f ON a.id_status_research = f.id_status_research
           LEFT JOIN type_personnel g ON a.id_personnel = g.id_personnel
           LEFT JOIN research_consider_type h ON a.id_rs = h.rct_id_rs
           WHERE
           a.id_rs = '$id_rs'
          ";
$query = mysqli_query($conn, $strSQL);
$rsData = null;
if(!$query){
  die();
}

$rsData = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>RMIS ::  <?php echo $role;?></title>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

  <!-- General CSS Files -->
  <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css" >
  <link rel="stylesheet" href="../node_modules/@fortawesome/fontawesome-free/css/all.css">
  <link rel="stylesheet" href="../node_modules/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="../node_modules/sweetalert/dist/sweetalert.css">
  <link rel="stylesheet" href="../node_modules/preload.js/dist/css/preload.css">
  <!-- CSS Libraries -->
  <link rel="stylesheet" href="../node_modules/dropzone/dist/min/dropzone.min.css">

  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/custom/css/style.css">
</head>

<style media="screen">
  #tmp_table > tbody > tr > td{
    vertical-align: top;
    padding: 10px;
  }
</style>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <!-- <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li> -->
            <li><a href="index?uid=<?php echo $uid; ?>&role=<?php echo $role; ?>" data-toggle="sidebar-" class="nav-link" style="font-size: 24px; font-weight: bold;">RMIS</li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          </ul>
          <div class="search-element">
            <!-- <input class="form-control" type="search" placeholder="ค้นหา ..." aria-label="Search" data-width="250"> -->
            <!-- <button class="btn" type="submit"><i class="fas fa-search"></i></button> -->
            <!-- <div class="search-backdrop"></div> -->
          </div>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown dropdown-list-toggle dn"><a href="#" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle beep-"><i class="far fa-envelope"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
              <div class="dropdown-header">Messages
                <div class="float-right">
                  <a href="#">Mark All As Read</a>
                </div>
              </div>
              <div class="dropdown-list-content dropdown-list-message">
                <a href="#" class="dropdown-item dropdown-item-unread">
                  <div class="dropdown-item-avatar">
                    <img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle">
                    <div class="is-online"></div>
                  </div>
                  <div class="dropdown-item-desc">
                    <b>Kusnaedi</b>
                    <p>Hello, Bro!</p>
                    <div class="time">10 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item dropdown-item-unread">
                  <div class="dropdown-item-avatar">
                    <img alt="image" src="../assets/img/avatar/avatar-2.png" class="rounded-circle">
                  </div>
                  <div class="dropdown-item-desc">
                    <b>Dedik Sugiharto</b>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                    <div class="time">12 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item dropdown-item-unread">
                  <div class="dropdown-item-avatar">
                    <img alt="image" src="../assets/img/avatar/avatar-3.png" class="rounded-circle">
                    <div class="is-online"></div>
                  </div>
                  <div class="dropdown-item-desc">
                    <b>Agung Ardiansyah</b>
                    <p>Sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <div class="time">12 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-avatar">
                    <img alt="image" src="../assets/img/avatar/avatar-4.png" class="rounded-circle">
                  </div>
                  <div class="dropdown-item-desc">
                    <b>Ardian Rahardiansyah</b>
                    <p>Duis aute irure dolor in reprehenderit in voluptate velit ess</p>
                    <div class="time">16 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-avatar">
                    <img alt="image" src="../assets/img/avatar/avatar-5.png" class="rounded-circle">
                  </div>
                  <div class="dropdown-item-desc">
                    <b>Alfa Zulkarnain</b>
                    <p>Exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
                    <div class="time">Yesterday</div>
                  </div>
                </a>
              </div>
              <div class="dropdown-footer text-center">
                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </li>
          <li class="dropdown dropdown-list-toggle dn"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep-"><i class="far fa-bell"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
              <div class="dropdown-header">Notifications
                <div class="float-right">
                  <a href="#">Mark All As Read</a>
                </div>
              </div>
              <div class="dropdown-list-content dropdown-list-icons">
                <a href="#" class="dropdown-item dropdown-item-unread">
                  <div class="dropdown-item-icon bg-primary text-white">
                    <i class="fas fa-code"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    Template update is available now!
                    <div class="time text-primary">2 Min Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-icon bg-info text-white">
                    <i class="far fa-user"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    <b>You</b> and <b>Dedik Sugiharto</b> are now friends
                    <div class="time">10 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-icon bg-success text-white">
                    <i class="fas fa-check"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    <b>Kusnaedi</b> has moved task <b>Fix bug header</b> to <b>Done</b>
                    <div class="time">12 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-icon bg-danger text-white">
                    <i class="fas fa-exclamation-triangle"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    Low disk space. Let's clean it!
                    <div class="time">17 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-icon bg-info text-white">
                    <i class="fas fa-bell"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    Welcome to Stisla template!
                    <div class="time">Yesterday</div>
                  </div>
                </a>
              </div>
              <div class="dropdown-footer text-center">
                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </li>
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">สวัสดี, คุณ<?php echo $userFullname;?> ( <?php echo $role; ?> )</div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="profile?uid=<?php echo $uid;?>&role=<?php echo $role; ?>" class="dropdown-item has-icon">
                <i class="far fa-user"></i> ข้อมูลส่วนตัว
              </a>
              <a href="activities?uid=<?php echo $uid;?>&role=<?php echo $role; ?>" class="dropdown-item has-icon">
                <i class="fas fa-bolt"></i> บันทึกกิจกรรม
              </a>
              <a href="settings?uid=<?php echo $uid;?>&role=<?php echo $role; ?>" class="dropdown-item has-icon">
                <i class="fas fa-cog"></i> ตั้งค่า
              </a>
              <div class="dropdown-divider"></div>
              <a href="Javascript:authen.signout()" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> ออกจากระบบ
              </a>
            </div>
          </li>
        </ul>
      </nav>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header mb-3">
            <h1>ตรวจสอบข้อมูลการลงทะเบียนเสนอโครงการวิจัย <br><small>(Research registration)</small> </h1>
          </div>

          <div class="section-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="text-right pb-3">
                  <button type="button" class="btn btn-primary bsdn float-left" onclick="window.history.back()"><i class="fas fa-wrench"></i> กลับไปแก้ไขข้อมูลโครงการ</button>
                  <button type="button" class="btn btn-primary bsdn float-left ml-1" onclick="printAsFile('printArea')"><i class="fas fa-print"></i> พิมพ์</button>
                  <button type="button" class="btn btn-danger bsdn" onclick="project.confirmSending(1)"><i class="fas fa-paper-plane"></i> ยืนยันและส่งข้อมูล</button>
                </div>
              </div>
            </div>

              <div class="row">
                <div class="col-lg-12">
                  <div class="" id="printArea">
                    <div class="card">
                      <div class="card-body">
                        <div class="text-center pt-3 pb-3">
                          <h5>แบบเสนอเพื่อลงทะเบียนโครงการวิจัยและขอรับการพิจารณาด้านจริยธรรมการวิจัยในมนุษย์</h5>
                          <h5>คณะแพทยศาสตร์ มหาวิทยาลัยสงขลานครินทร์</h5>
                        </div>
                        <table class="table table-sm table-striped mb-0 table-bordered" id="tmp_table">
                          <tbody>
                            <tr>
                              <td colspan="2" style="background: rgb(52, 189, 148); color: #fff;">ข้อมูลโครงการ</td>
                            </tr>
                            <tr>
                              <td style="width: 30%;">รหัสการลงทะเบียน</td>
                              <td class="text-danger"><?php echo $rsData['id_rs']; ?></td>
                            </tr>
                            <tr>
                              <td>หัวหน้าโครงการ</td>
                              <td class="text-dark">
                                <?php
                                if($rsData['fname'] == '-'){

                                }else{
                                  echo $rsData['prefix_th'].$rsData['fname']." ".$rsData['lname']." (".$rsData['prefix_en'].$rsData['fname_en']." ".$rsData['lname_en'].")";
                                }
                                ?>
                              </td>
                            </tr>
                            <tr>
                              <td>ชื่อโครงการ (ภาษาไทย)</td>
                              <td class="text-dark">
                                <?php if($rsData['title_th'] == ''){ echo "-"; }else{ echo $rsData['title_th']; } ?>
                              </td>
                            </tr>
                            <tr>
                              <td>ชื่อโครงการ (English)</td>
                              <td class="text-dark">
                                <?php if($rsData['title_en'] == ''){ echo "-"; }else{ echo $rsData['title_en']; } ?>
                              </td>
                            </tr>
                            <tr>
                              <td>คำสำคัญ (ภาษาไทย)</td>
                              <td class="text-dark">
                                <?php if($rsData['keywords_th'] == ''){ echo "-"; }else{ echo $rsData['keywords_th']; } ?>
                              </td>
                            </tr>
                            <tr>
                              <td>Keywords (English)</td>
                              <td class="text-dark">
                                <?php if($rsData['keywords_en'] == ''){ echo "-"; }else{ echo $rsData['keywords_en']; } ?>
                              </td>
                            </tr>
                            <tr>
                              <td>ประเภทการวิจัย</td>
                              <td class="text-dark"><?php echo $rsData['type_name']; ?></td>
                            </tr>
                            <tr>
                              <td>ระยะเวลาโครงการ</td>
                              <td class="text-dark">
                                เริ่มต้นโครงการ : <span class="text-primary"><?php echo DateThai($rsData['start_date'], true); ?></span>  วันที่สิ้นสุด : <span class="text-primary"><?php echo DateThai($rsData['finish_date'], true); ?></span><br>
                                รวมระยะเวลาดำเนินการ : <span class="text-primary"><?php echo DateDiff($rsData['start_date'], $rsData['finish_date'], 'day'); ?></span> วัน
                              </td>
                            </tr>
                            <tr>
                              <td>งบประมาณ</td>
                              <td class="text-dark"><?php echo number_format($rsData['budget'])." บาท"; ?></td>
                            </tr>
                            <tr>
                              <td>ทุนวิจัย</td>
                              <td class="text-dark">
                                <?php
                                if($rsData['ts0'] == 1){
                                  echo "เป็นโครงการที่มีทุนวิจัยสนับสนุน";
                                }else{
                                  echo "เป็นโครงการที่ไม่มีทุนวิจัย";
                                }
                                ?>
                              </td>
                            </tr>
                            <tr>
                              <td>กลุ่มแหล่งทุน</td>
                              <td class="text-dark">
                                <?php if($rsData['ts1'] == 1){ echo "- ทุนวิจัยคณะแพทยศาสตร์<br>";} ?>
                                <?php if($rsData['ts2'] == 1){ echo "- ทุนงบประมาณแผ่นดิน<br>";} ?>
                                <?php if($rsData['ts7'] == 1){ echo "- ทุนภาคเอกชน<br>";} ?>
                                <?php if($rsData['ts3'] == 1){ echo "- เงินรายได้มหาวิทยาลัยสงขลานครินทร์<br>";} ?>
                                <?php if($rsData['ts4'] == 1){ echo "- ทุนอื่น ๆ ภายในประเทศ<br>";} ?>
                                <?php if($rsData['ts5'] == 1){ echo "- ทุนอื่น ๆ ภายนอกประเทศ<br>";} ?>
                              </td>
                            </tr>
                            <tr>
                              <td>ชื่อแหล่งทุน</td>
                              <td class="text-dark"><?php echo $rsData['source_funds']; ?></td>
                            </tr>
                            <tr class="dn">
                              <td>สัดส่วนการทำวิจัยของหัวหน้าโครงการ</td>
                              <td class="text-dark"><?php echo $rsData['rate_pm']; ?> %</td>
                            </tr>
                            <tr>
                              <td>ผู้ร่วมวิจัย</td>
                              <td class="text-dark">
                                <?php
                                $strSQL = "SELECT * FROM pm_team WHERE co_rs_id = '$id_rs'";
                                $query = mysqli_query($conn, $strSQL);
                                if($query){
                                  while ($row = mysqli_fetch_array($query)) {
                                    echo "- ".$row['co_prefix_approval'].$row['co_fname']. " " .$row['co_lname']." ( ".$row['co_job']." )<br>";
                                  }
                                }
                                ?>
                              </td>
                            </tr>
                            <tr>
                              <td colspan="2" style="background: rgb(52, 189, 148); color: #fff;">เอกสารแนบ</td>
                            </tr>
                            <tr>
                              <td>Submission form</td>
                              <td>
                                <?php
                                $strSQL = "SELECT * FROM file_research_attached WHERE f_group = '1' AND f_delete_status = '0' AND (f_rs_id = '$id_rs' OR f_session_id IN (SELECT session_id FROM research WHERE id_rs = '$id_rs')) ORDER BY fid ASC";
                                $query = mysqli_query($conn, $strSQL);
                                if(($query) && (mysqli_num_rows($query) > 0)){
                                  while ($row = mysqli_fetch_array($query)) {
                                    echo "- ".$row['f_name']."<br>";
                                  }
                                }else{
                                  echo "-";
                                }
                                ?>
                              </td>
                            </tr>
                            <tr>
                              <td>Protocol</td>
                              <td>
                                <?php
                                $strSQL = "SELECT * FROM file_research_attached WHERE f_group = '2' AND f_delete_status = '0' AND (f_rs_id = '$id_rs' OR f_session_id IN (SELECT session_id FROM research WHERE id_rs = '$id_rs')) ORDER BY fid ASC";
                                $query = mysqli_query($conn, $strSQL);
                                if(($query) && (mysqli_num_rows($query) > 0)){
                                  while ($row = mysqli_fetch_array($query)) {
                                    echo "- ".$row['f_name']."<br>";
                                  }
                                }else{
                                  echo "-";
                                }
                                ?>
                              </td>
                            </tr>
                            <tr>
                              <td>Information sheet and Concent form</td>
                              <td>
                                <?php
                                $strSQL = "SELECT * FROM file_research_attached WHERE f_group = '3' AND f_delete_status = '0' AND (f_rs_id = '$id_rs' OR f_session_id IN (SELECT session_id FROM research WHERE id_rs = '$id_rs')) ORDER BY fid ASC";
                                $query = mysqli_query($conn, $strSQL);
                                if(($query) && (mysqli_num_rows($query) > 0)){
                                  while ($row = mysqli_fetch_array($query)) {
                                    echo "- ".$row['f_name']."<br>";
                                  }
                                }else{
                                  echo "-";
                                }
                                ?>
                              </td>
                            </tr>
                            <tr>
                              <td>Case Record Form</td>
                              <td>
                                <?php
                                $strSQL = "SELECT * FROM file_research_attached WHERE f_group = '4' AND f_delete_status = '0' AND (f_rs_id = '$id_rs' OR f_session_id IN (SELECT session_id FROM research WHERE id_rs = '$id_rs')) ORDER BY fid ASC";
                                $query = mysqli_query($conn, $strSQL);
                                if(($query) && (mysqli_num_rows($query) > 0)){
                                  while ($row = mysqli_fetch_array($query)) {
                                    echo "- ".$row['f_name']."<br>";
                                  }
                                }else{
                                  echo "-";
                                }
                                ?>
                              </td>
                            </tr>
                            <tr>
                              <td>Subject materials</td>
                              <td>
                                <?php
                                $strSQL = "SELECT * FROM file_research_attached WHERE f_group = '5' AND f_delete_status = '0' AND (f_rs_id = '$id_rs' OR f_session_id IN (SELECT session_id FROM research WHERE id_rs = '$id_rs')) ORDER BY fid ASC";
                                $query = mysqli_query($conn, $strSQL);
                                if(($query) && (mysqli_num_rows($query) > 0)){
                                  while ($row = mysqli_fetch_array($query)) {
                                    echo "- ".$row['f_name']."<br>";
                                  }
                                }else{
                                  echo "-";
                                }
                                ?>
                              </td>
                            </tr>
                            <tr>
                              <td>Legal Document</td>
                              <td>
                                <?php
                                $strSQL = "SELECT * FROM file_research_attached WHERE f_group = '6' AND f_delete_status = '0' AND (f_rs_id = '$id_rs' OR f_session_id IN (SELECT session_id FROM research WHERE id_rs = '$id_rs')) ORDER BY fid ASC";
                                $query = mysqli_query($conn, $strSQL);
                                if(($query) && (mysqli_num_rows($query) > 0)){
                                  while ($row = mysqli_fetch_array($query)) {
                                    echo "- ".$row['f_name']."<br>";
                                  }
                                }else{
                                  echo "-";
                                }
                                ?>
                              </td>
                            </tr>
                            <tr>
                              <td>เอกสารประกอบอื่น ๆ</td>
                              <td>
                                <?php
                                $strSQL = "SELECT * FROM file_research_attached WHERE f_group = '7' AND f_delete_status = '0' AND (f_rs_id = '$id_rs' OR f_session_id IN (SELECT session_id FROM research WHERE id_rs = '$id_rs')) ORDER BY fid ASC";
                                $query = mysqli_query($conn, $strSQL);
                                if(($query) && (mysqli_num_rows($query) > 0)){
                                  while ($row = mysqli_fetch_array($query)) {
                                    echo "- ".$row['f_name']."<br>";
                                  }
                                }else{
                                  echo "-";
                                }
                                ?>
                              </td>
                            </tr>
                            <tr>
                              <td>Updated CV, GCP</td>
                              <td>
                                <?php
                                $strSQL = "SELECT * FROM file_research_attached WHERE f_group = '8' AND f_delete_status = '0' AND (f_rs_id = '$id_rs' OR f_session_id IN (SELECT session_id FROM research WHERE id_rs = '$id_rs')) ORDER BY fid ASC";
                                $query = mysqli_query($conn, $strSQL);
                                if(($query) && (mysqli_num_rows($query) > 0)){
                                  while ($row = mysqli_fetch_array($query)) {
                                    echo "- ".$row['f_name']."<br>";
                                  }
                                }else{
                                  echo "-";
                                }
                                ?>
                              </td>
                            </tr>
                            <tr>
                              <td>ใบนำส่งเงินค่าธรรมเนียม</td>
                              <td>
                                <?php
                                $strSQL = "SELECT * FROM file_research_attached WHERE f_group = '9' AND f_delete_status = '0' AND (f_rs_id = '$id_rs' OR f_session_id IN (SELECT session_id FROM research WHERE id_rs = '$id_rs')) ORDER BY fid ASC";
                                $query = mysqli_query($conn, $strSQL);
                                if(($query) && (mysqli_num_rows($query) > 0)){
                                  while ($row = mysqli_fetch_array($query)) {
                                    echo "- ".$row['f_name']."<br>";
                                  }
                                }else{
                                  echo "-";
                                }
                                ?>
                              </td>
                            </tr>
                            <tr>
                              <td>อื่น ๆ <br><small>(เฉพาะโครงการลงทะเบียนก่อน 1 ม.ค. 61)</small> </td>
                              <td>
                                <?php
                                $strSQL = "SELECT * FROM file_research_attached WHERE f_group = '10' AND f_delete_status = '0' AND (f_rs_id = '$id_rs' OR f_session_id IN (SELECT session_id FROM research WHERE id_rs = '$id_rs')) ORDER BY fid ASC";
                                $query = mysqli_query($conn, $strSQL);
                                if(($query) && (mysqli_num_rows($query) > 0)){
                                  while ($row = mysqli_fetch_array($query)) {
                                    echo "- ".$row['f_name']."<br>";
                                  }
                                }else{
                                  echo "-";
                                }
                                ?>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


          </div>
        </section>
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2018 <div class="bullet"></div> โดย <a href="http://medinfo2.psu.ac.th/research/hrec/" target="_blank">หน่วยส่งเสริมและพัฒนาทางวิชาการ</a>
        </div>
        <div class="footer-right">
          2.3.0
        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script type="text/javascript" src="../node_modules/jquery/dist/jquery.min.js" ></script>
  <script type="text/javascript" src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="../node_modules/popper.js/dist/umd/popper.min.js"></script>
  <script type="text/javascript" src="../node_modules/sweetalert/dist/sweetalert.min.js"></script>
  <script type="text/javascript" src="../node_modules/moment/min/moment.min.js"></script>
  <script type="text/javascript" src="../node_modules/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script type="text/javascript" src="../node_modules/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
  <script type="text/javascript" src="../node_modules/ckeditor_lite/ckeditor.js"></script>
  <script type="text/javascript" src="../node_modules/preload.js/dist/js/preload.js"></script>
  <script type="text/javascript" src="../node_modules/dropzone/dist/min/dropzone.min.js"></script>
  <script src="../assets/js/stisla.js"></script>

  <!-- Template JS File -->
  <script src="../assets/js/scripts.js"></script>
  <script src="../assets/custom/js/config.js?token=<?php echo $sysdateu; ?>"></script>
  <script src="../assets/custom/js/authen.js?token=<?php echo $sysdateu; ?>"></script>
  <script src="../assets/custom/js/custom.js?token=<?php echo $sysdateu; ?>"></script>
  <script src="../assets/custom/js/function.js?token=<?php echo $sysdateu; ?>"></script>
  <script src="../assets/custom/js/pi.2.1.js?token=<?php echo $sysdateu; ?>"></script>
  <script src="../assets/custom/js/research_register.js?token=<?php echo $sysdateu; ?>"></script>

  <script>



      $(document).ready(function(){
        if(current_project != null){
          if(current_project != <?php echo $id_rs;?>){
            window.location = './index?uid=' + current_user + '&role=' + current_role
            return ;
          }
        }else{
          window.location = './index?uid=' + current_user + '&role=' + current_role
          return ;
        }

        setTimeout(() => {
          preload.hide()
        }, 1000);
      })

      $(function(){

      })

      function showAdvice(){
        $('#fileAdviceModal').modal()
      }

      function setFilesection(section_id){
        $('.txtUploadIdrs').val(current_project)
        $('#fileUploadModal_' + section_id).modal()
      }

  </script>

</body>
</html>

<!-- Modal -->
<div class="modal fade" id="fileAdviceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title text-white pb-3" id="exampleModalLabel">คำแนะนำ</h5>
        <button type="button" class="close text-white btnCloseModal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4 class="text-center pt-4">คำแนะนำในการอัพโหลดไฟล์เอกสารงานวิจัย</h4>
        <ol>
          <li>ให้ตั้งชื่อไฟล์เป็นภาษาอังกฤษ โดยห้ามใช้อัขระพิเศษ เช่น # * [] {}</li>
          <li>ในการตั้งชื่อไฟล์ ไม่ควรตั้งชื่อความยาวเกิน 200 ตัวอักษร</li>
          <li>ควรระบุเวอร์ชั่นของไฟล์นั้น ๆ ให้ชัดเจน เช่น  Protocol_20191013_v1.pdf เป็นต้น</li>
          <li>หากมีการตีกลับจากเจ้าหน้าที่เพื่อแก้ไข <span class="text-danger">กรุณาอย่าลบไฟล์ที่เคยส่งไปยังสำนักงานแล้วออกโดยเด็ดขาด</span> เพราะเจ้าหน้าที่ต้องใช้เพื่อการเปรียบเทียบการแก้ไข และอาจทำให้การพิจารณาล่าช้าได้</li>
        </ol>

        <div class="text-center pb-4">
          <button type="button" class="btn btn-danger btn-block btn-lg bsdn" style="font-size: 1em;" data-dismiss="modal">รับทราบ</button>
        </div>
      </div>
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="researchteamModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title text-white pb-3" id="exampleModalLabel">เพิ่ม / แก้ไขข้อมูลผู้ร่วมวิจัย</h5>
        <button type="button" class="close text-white btnCloseModal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="alert alert-warning">
          ไม่ต้องเพิ่มชื่อของหัวหน้าโครงการ
        </div>

        <div class="alert alert-warning">
          กรุณากรอกข้อมูลให้ครบถ้วนโดยไม่ต้องกรอกข้อมูลของหัวหน้าโครงการ และสัดส่วนรวมทั้งโครงการไม่เกิน 100%.
        </div>

        <form class="copiForm" onsubmit="return false;">
          <div class="row">
            <div class="form-group col-12 col-sm-4 mb-2 dn">
              <label for="">ID : <span class="text-danger">*</span></label>
              <input type="text" id="txtCopi_id" required name="" value="" class="form-control" placeholder="">
              <div class="p-1 text-muted" style="font-size: 0.8em;">
                * คำนำหน้าชื่อนี้จะถูกนำไปแสดงในใบรับรอง
              </div>
            </div>
            <div class="form-group col-12 col-sm-4 mb-2">
              <label for="">คำนำหน้าชื่อ : <span class="text-danger">*</span></label>
              <input type="text" id="txtPrefix_th" required name="" value="" class="form-control" placeholder="">
              <div class="p-1 text-muted" style="font-size: 0.8em;">
                * คำนำหน้าชื่อนี้จะถูกนำไปแสดงในใบรับรอง
              </div>
            </div>
            <div class="form-group col-12 col-sm-4 mb-2">
              <label for="">ชื่อ : <span class="text-danger">*</span></label>
              <input type="text" id="txtFname_th" required name="" value="" class="form-control" placeholder="">
            </div>
            <div class="form-group col-12 col-sm-4 mb-2">
              <label for="">นามสกุล : <span class="text-danger">*</span></label>
              <input type="text" id="txtLname_th" required name="" value="" class="form-control" placeholder="">
            </div>
          </div>

          <div class="row">
            <div class="form-group col-12 col-sm-4 mb-2">
              <label for="">Prefix : <span class="text-danger">*</span></label>
              <input type="text" id="txtPrefix_en" required name="" value="" class="form-control" placeholder="">
              <div class="p-1 text-muted" style="font-size: 0.8em;">
                * This prefix will ve shown in certificate of approval.
              </div>
            </div>
            <div class="form-group col-12 col-sm-4 mb-2">
              <label for="">Name : <span class="text-danger">*</span></label>
              <input type="text" id="txtFname_en" required name="" value="" class="form-control" placeholder="">
            </div>
            <div class="form-group col-12 col-sm-4 mb-2">
              <label for="">Surname : <span class="text-danger">*</span></label>
              <input type="text" id="txtLname_en" required name="" value="" class="form-control" placeholder="">
            </div>
          </div>

          <div class="form-group mb-3">
            <label for="">E-mail address : <span class="text-danger">*</span></label>
            <input type="email" id="txtEmail" name="" value="" class="form-control">
          </div>

          <div class="form-group mb-3">
            <label for="">ชื่อหน่วยงานที่สังกัด (ภาษาไทย) : <span class="text-danger">*</span></label>
            <input type="text" id="txtDept_th" name="" value="" class="form-control" placeholder="กรอกชื่อหน่วยงานที่สังกัดของผู้ร่วมวิจัยท่านนี้ ...">
          </div>

          <div class="form-group mb-3">
            <label for="">Department / Institution name (English) : <span class="text-danger">*</span></label>
            <input type="text" id="txtDept_en" name="" value="" class="form-control" placeholder="Enter institution or department name ...">
          </div>

          <div class="row">
            <div class="form-group col-12 col-sm-4 mb-3">
              <label for="">สัดส่วน (%) : <span class="text-danger">*</span></label>
              <input type="number" min="1" max="99" id="txtRatioteam" name="" value="" class="form-control" placeholder="">
            </div>
            <div class="form-group col-12 col-sm-8 mb-3">
              <label for="">หน้าที่ความรับผิดชอบ : <span class="text-danger">*</span></label>
              <input type="text" id="txtResponseteam" name="" value="" class="form-control" placeholder="">
            </div>
          </div>
        </form>

        <div class="text-right pb-4 pt-4">
          <button type="button" class="btn btn-primary btn-block- btn-lg bsdn" style="font-size: 1em;" onclick="saveCopi()">บันทึก</button>
        </div>
      </div>
    </div>
  </div>
</div>
