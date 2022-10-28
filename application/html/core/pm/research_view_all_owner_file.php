<?php
include "../conf.inc.php";
include "../connect.inc.php";
include "../function.inc.php";

if((!isset($_GET['uid'])) || ($_GET['uid'] == '')){
    header('Location: ../index');
    die();
}

if((!isset($_GET['role'])) || ($_GET['role'] == '')){
    header('Location: ../index');
    die();
}

if((!isset($_GET['id_rs'])) || ($_GET['id_rs'] == '')){
    header('Location: ../index');
    die();
}

$uid = mysqli_real_escape_string($conn, $_GET['uid']);
$role = mysqli_real_escape_string($conn, $_GET['role']);
$id_rs = mysqli_real_escape_string($conn, $_GET['id_rs']);

$strSQL = "SELECT * FROM useraccount a INNER JOIN userinfo b ON a.id = b.user_id WHERE a.id = '$uid' AND a.active_status = '1' AND a.delete_status = '0' AND a.allow_status = '1' AND a.".$role."_role = '1'";
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

$strSQL = "SELECT * FROM research a LEFT JOIN type_research b ON a.id_type  = b.id_type
                                LEFT JOIN type_status_research c ON a.id_status_research = c.id_status_research
                                LEFT JOIN type_personnel d ON a.id_personnel = d.id_personnel
                                LEFT JOIN dept e ON a.id_dept = e.id_dept
                                LEFT JOIN useraccount f ON a.id_pm = f.id_pm
                                LEFT JOIN userinfo  g ON f.id = g.user_id
                                LEFT JOIN research_consider_type h ON a.id_rs = h.rct_id_rs
                                WHERE
                                  a.draft_status = '0'
                                  AND a.id_rs = '$id_rs'
                                  AND a.delete_flag = 'N'
                                  AND a.sendding_status = 'Y'
                                  AND a.research_status = 'new'
                                  AND f.delete_status = '0'";
$resultResearch1 = mysqli_query($conn, $strSQL);
$dataResearch1 = null;
if(($resultResearch1) && (mysqli_num_rows($resultResearch1) > 0)){
    $dataResearch1 = mysqli_fetch_assoc($resultResearch1);
}else{
    header('Location: ../index');
    die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>RMIS :: <?php echo $role;?></title>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Blank Page &mdash; Stisla</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css" >
  <link rel="stylesheet" href="../node_modules/@fortawesome/fontawesome-free/css/all.css">
  <link rel="stylesheet" href="../node_modules/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="../node_modules/sweetalert/dist/sweetalert.css">
  <link rel="stylesheet" href="../node_modules/preload.js/dist/css/preload.css">

  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/custom/css/style.css">
</head>

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
            <input class="form-control" type="search" placeholder="ค้นหา ..." aria-label="Search" data-width="250">
            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
            <div class="search-backdrop"></div>
            <div class="search-result">
              <div class="search-header">
                Histories
              </div>
              <div class="search-item">
                <a href="#">How to hack NASA using CSS</a>
                <a href="#" class="search-close"><i class="fas fa-times"></i></a>
              </div>
              <div class="search-item">
                <a href="#">Kodinger.com</a>
                <a href="#" class="search-close"><i class="fas fa-times"></i></a>
              </div>
              <div class="search-item">
                <a href="#">#Stisla</a>
                <a href="#" class="search-close"><i class="fas fa-times"></i></a>
              </div>
              <div class="search-header">
                Result
              </div>
              <div class="search-item">
                <a href="#">
                  <img class="mr-3 rounded" width="30" src="../assets/img/products/product-3-50.png" alt="product">
                  oPhone S9 Limited Edition
                </a>
              </div>
              <div class="search-item">
                <a href="#">
                  <img class="mr-3 rounded" width="30" src="../assets/img/products/product-2-50.png" alt="product">
                  Drone X2 New Gen-7
                </a>
              </div>
              <div class="search-item">
                <a href="#">
                  <img class="mr-3 rounded" width="30" src="../assets/img/products/product-1-50.png" alt="product">
                  Headphone Blitz
                </a>
              </div>
              <div class="search-header">
                Projects
              </div>
              <div class="search-item">
                <a href="#">
                  <div class="search-icon bg-danger text-white mr-3">
                    <i class="fas fa-code"></i>
                  </div>
                  Stisla Admin Template
                </a>
              </div>
              <div class="search-item">
                <a href="#">
                  <div class="search-icon bg-primary text-white mr-3">
                    <i class="fas fa-laptop"></i>
                  </div>
                  Create a new Homepage Design
                </a>
              </div>
            </div>
          </div>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle beep_"><i class="far fa-envelope"></i></a>
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
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep_"><i class="far fa-bell"></i></a>
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
            <div class="d-sm-none d-lg-inline-block">สวัสดี, คุณ<?php echo $userFullname;?></div></a>
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
          <div class="section-header">
            <h1>ข้อมูลโครงการวิจัย</h1>
          </div>

          <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                      <div class="col-12">
                        <?php
                        if(($dataResearch1['title_th'] == '') || ($dataResearch1['title_th'] == '-')){
                          if(($dataResearch1['code_apdu'] == '') || ($dataResearch1['code_apdu'] == 'NULL')){
                            echo '<h6 class="text-danger">รหัสลงทะเบียน. '.$dataResearch1['id_rs'].'</h6>';
                          }else{
                            echo '<h6 class="text-danger">REC. '.$dataResearch1['code_apdu'].'</h6>';
                          }
                          ?>
                          <h4 class="text-dark"><?php echo $dataResearch1['title_en'];?></h4>
                          <?php
                        }else{
                          if(($dataResearch1['code_apdu'] == '') || ($dataResearch1['code_apdu'] == 'NULL')){
                            echo '<h6 class="text-danger">รหัสลงทะเบียน. '.$dataResearch1['id_rs'].'</h6>';
                          }else{
                            echo '<h6 class="text-danger">REC. '.$dataResearch1['code_apdu'].'</h6>';
                          }
                          ?>
                          <h4 class="text-dark"><?php echo $dataResearch1['title_th'];?></h4>
                          <h5 class="text-dark" style="font-weight: 300;"><?php echo $dataResearch1['title_en'];?></h5>
                          <?php
                        }
                        ?>
                        <div class="row">
                          <div class="col-12 text-dark">
                            หัวหน้าโครงการ : <?php echo $dataResearch1['fname']." ".$dataResearch1['lname'];?>
                          </div>
                          <div class="col-12 text-dark">
                          ประเภทการพิจารณา : <?php if($dataResearch1['rct_type'] == NULL){echo "<span class=text-danger>ยังไม่กำหนด</span>";}else{echo "<span class=text-danger>".$dataResearch1['rct_type']."</span>";}?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="p-0">
                              <button class="btn btn-secondary text-dark bsdn mr-1 mb-1" id="btnAction_1"  onclick="window.location='research_view_all_owner?uid=<?php echo $uid; ?>&role=<?php echo $role; ?>&id_rs=<?php echo $id_rs;?>'"><i class="fas fa-info-circle"></i> ข้อมูลเบื้องต้น</button>
                              <button class="btn btn-primary bsdn mr-1 mb-1" id="btnAction_2"  onclick="window.location='research_view_all_owner_file?uid=<?php echo $uid; ?>&role=<?php echo $role; ?>&id_rs=<?php echo $id_rs;?>'"><i class="fas fa-upload"></i> เอกสารแนบ</button>
                              <button class="btn btn-secondary text-dark bsdn mr-1 mb-1" id="btnAction_4"  onclick="window.location='research_view_all_owner_comment?uid=<?php echo $uid; ?>&role=<?php echo $role; ?>&id_rs=<?php echo $id_rs;?>'"><i class="fas fa-comment-alt"></i> ข้อเสนอแนะ</button>
                              <button class="btn btn-secondary text-dark bsdn mr-1 mb-1" id="btnAction_5"  onclick="window.location='research_view_all_owner_approval?uid=<?php echo $uid; ?>&role=<?php echo $role; ?>&id_rs=<?php echo $id_rs;?>'"><i class="far fa-file"></i> ใบรับรอง</button>
                            </div>

                            <div class="" id="fileResult">
                              <h6 class="mt-3 text-dark"><span class="text-primary mr-2">Group 1 :</span>Submission form</h6>
                              <table class="table table-striped table-bordered table-sm">
                                  <thead>
                                      <tr class="bg-gray">
                                          <th class="pl-2 pr-2 text-white">ชื่อไฟล์</th>
                                          <th class="text-white" style="width: 150px;">สถานะ</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                                      $strSQL = "SELECT * FROM file_research_attached WHERE (f_rs_id = '$id_rs' OR f_session_id IN (SELECT session_id FROM research WHERE id_rs = '$id_rs')) AND f_delete_status = '0' AND f_group = '1'";
                                      $resultFile = mysqli_query($conn, $strSQL);
                                      if(($resultFile) && (mysqli_num_rows($resultFile) > 0)){
                                          while($dataFile = mysqli_fetch_array($resultFile)){
                                              ?>
                                              <tr>
                                                  <td class="pl-2 pr-2">
                                                    <a href="<?php if($dataFile['f_full_path'] == NULL){ echo "../tmp_file/".$dataFile['f_name']; }else{ echo $dataFile['f_full_path']; } ?>" target="_blank" class="btn btn-sm btn-primary bsdn mr-2"><i class="fas fa-download"></i></a> <?php echo $dataFile['f_name'];?>
                                                  </td>
                                                  <td class="pl-2 pr-2">
                                                      <?php
                                                      if($dataFile['f_approval_status'] == '1'){
                                                          echo '<span class="text-primary badge bg-primary text-white"><i class="fas fa-check"></i> เอกสารถูกต้อง</span>';
                                                      }else if($dataFile['f_approval_status'] == '2'){
                                                          echo '<span class="text-danger badge bg-danger text-white"><i class="fas fa-clock"></i> เอกสารรอการแก้ไข</span>';
                                                      }else{
                                                          echo '<i class="fas fa-clock"></i> ยังไม่ตรวจสอบ';
                                                      }
                                                      ?>
                                                  </td>
                                              </tr>
                                              <?php
                                          }
                                      }else{
                                          echo '<tr><td colspan="4" class="pl-3">ไม่พบไฟล์แนบ</td></tr>';
                                      }
                                      ?>
                                  </tbody>
                              </table>

                              <h6 class="mt-3 text-dark"><span class="text-primary mr-2">Group 2 :</span>Protocol</h6>
                              <table class="table table-striped table-bordered table-sm">
                                  <thead>
                                      <tr class="bg-gray">
                                          <th class="pl-2 pr-2 text-white">ชื่อไฟล์</th>
                                          <th class="text-white" style="width: 150px;">สถานะ</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  <?php
                                      $strSQL = "SELECT * FROM file_research_attached WHERE (f_rs_id = '$id_rs' OR f_session_id IN (SELECT session_id FROM research WHERE id_rs = '$id_rs')) AND f_delete_status = '0' AND f_group = '2'";
                                      $resultFile = mysqli_query($conn, $strSQL);
                                      if(($resultFile) && (mysqli_num_rows($resultFile) > 0)){
                                          while($dataFile = mysqli_fetch_array($resultFile)){
                                              ?>
                                              <tr>
                                              <td class="pl-2 pr-2"><a href="<?php if($dataFile['f_full_path'] == NULL){ echo "../tmp_file/".$dataFile['f_name']; }else{ echo $dataFile['f_full_path']; } ?>" target="_blank" class="btn btn-sm btn-primary bsdn mr-2"><i class="fas fa-download"></i></a> <?php echo $dataFile['f_name'];?></td>

                                                  <td class="pl-2 pr-2">
                                                    <?php
                                                    if($dataFile['f_approval_status'] == '1'){
                                                        echo '<span class="text-primary badge bg-primary text-white"><i class="fas fa-check"></i> เอกสารถูกต้อง</span>';
                                                    }else if($dataFile['f_approval_status'] == '2'){
                                                        echo '<span class="text-danger badge bg-danger text-white"><i class="fas fa-clock"></i> เอกสารรอการแก้ไข</span>';
                                                    }else{
                                                        echo '<i class="fas fa-clock"></i> ยังไม่ตรวจสอบ';
                                                    }
                                                    ?>
                                                  </td>
                                              </tr>
                                              <?php
                                          }
                                      }else{
                                          echo '<tr><td colspan="4" class="pl-3">ไม่พบไฟล์แนบ</td></tr>';
                                      }
                                      ?>
                                  </tbody>
                              </table>

                              <h6 class="mt-3 text-dark"><span class="text-primary mr-2">Group 3 :</span>Information sheet and Consent Form</h6>

                              <table class="table table-striped table-bordered table-sm">
                                  <thead>
                                      <tr class="bg-gray">
                                          <th class="pl-2 pr-2 text-white">ชื่อไฟล์</th>
                                          <th class="text-white" style="width: 150px;">สถานะ</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  <?php
                                      $strSQL = "SELECT * FROM file_research_attached WHERE (f_rs_id = '$id_rs' OR f_session_id IN (SELECT session_id FROM research WHERE id_rs = '$id_rs')) AND f_delete_status = '0' AND f_group = '3'";
                                      $resultFile = mysqli_query($conn, $strSQL);
                                      if(($resultFile) && (mysqli_num_rows($resultFile) > 0)){
                                          while($dataFile = mysqli_fetch_array($resultFile)){
                                              ?>
                                              <tr>
                                              <td class="pl-2 pr-2"><a href="<?php if($dataFile['f_full_path'] == NULL){ echo "../tmp_file/".$dataFile['f_name']; }else{ echo $dataFile['f_full_path']; } ?>" target="_blank" class="btn btn-sm btn-primary bsdn mr-2"><i class="fas fa-download"></i></a> <?php echo $dataFile['f_name'];?></td>

                                                  <td class="pl-2 pr-2">
                                                    <?php
                                                    if($dataFile['f_approval_status'] == '1'){
                                                        echo '<span class="text-primary badge bg-primary text-white"><i class="fas fa-check"></i> เอกสารถูกต้อง</span>';
                                                    }else if($dataFile['f_approval_status'] == '2'){
                                                        echo '<span class="text-danger badge bg-danger text-white"><i class="fas fa-clock"></i> เอกสารรอการแก้ไข</span>';
                                                    }else{
                                                        echo '<i class="fas fa-clock"></i> ยังไม่ตรวจสอบ';
                                                    }
                                                    ?>
                                                  </td>
                                              </tr>
                                              <?php
                                          }
                                      }else{
                                          echo '<tr><td colspan="4" class="pl-3">ไม่พบไฟล์แนบ</td></tr>';
                                      }
                                      ?>
                                  </tbody>
                              </table>

                              <h6 class="mt-3 text-dark"><span class="text-primary mr-2">Group 4 :</span>Case Record Form</h6>

                              <table class="table table-striped table-bordered table-sm">
                                  <thead>
                                      <tr class="bg-gray">
                                          <th class="pl-3 text-white">ชื่อไฟล์</th>
                                          <th class="text-white" style="width: 150px;">สถานะ</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  <?php
                                      $strSQL = "SELECT * FROM file_research_attached WHERE (f_rs_id = '$id_rs' OR f_session_id IN (SELECT session_id FROM research WHERE id_rs = '$id_rs')) AND f_delete_status = '0' AND f_group = '4'";
                                      $resultFile = mysqli_query($conn, $strSQL);
                                      if(($resultFile) && (mysqli_num_rows($resultFile) > 0)){
                                          while($dataFile = mysqli_fetch_array($resultFile)){
                                              ?>
                                              <tr>
                                              <td class="pl-2 pr-2"><a href="<?php if($dataFile['f_full_path'] == NULL){ echo "../tmp_file/".$dataFile['f_name']; }else{ echo $dataFile['f_full_path']; } ?>" target="_blank" class="btn btn-sm btn-primary bsdn mr-2"><i class="fas fa-download"></i></a> <?php echo $dataFile['f_name'];?></td>

                                                  <td class="pl-2 pr-2">
                                                    <?php
                                                    if($dataFile['f_approval_status'] == '1'){
                                                        echo '<span class="text-primary badge bg-primary text-white"><i class="fas fa-check"></i> เอกสารถูกต้อง</span>';
                                                    }else if($dataFile['f_approval_status'] == '2'){
                                                        echo '<span class="text-danger badge bg-danger text-white"><i class="fas fa-clock"></i> เอกสารรอการแก้ไข</span>';
                                                    }else{
                                                        echo '<i class="fas fa-clock"></i> ยังไม่ตรวจสอบ';
                                                    }
                                                    ?>
                                                  </td>
                                              </tr>
                                              <?php
                                          }
                                      }else{
                                          echo '<tr><td colspan="4" class="pl-3">ไม่พบไฟล์แนบ</td></tr>';
                                      }
                                      ?>
                                  </tbody>
                              </table>

                              <h6 class="mt-3 text-dark"><span class="text-primary mr-2">Group 5 :</span>Subject Material</h6>

                              <table class="table table-striped table-bordered table-sm">
                                  <thead>
                                      <tr class="bg-gray">
                                          <th class="pl-3 text-white">ชื่อไฟล์</th>
                                          <th class="text-white" style="width: 150px;">สถานะ</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  <?php
                                      $strSQL = "SELECT * FROM file_research_attached WHERE (f_rs_id = '$id_rs' OR f_session_id IN (SELECT session_id FROM research WHERE id_rs = '$id_rs')) AND f_delete_status = '0' AND f_group = '5'";
                                      $resultFile = mysqli_query($conn, $strSQL);
                                      if(($resultFile) && (mysqli_num_rows($resultFile) > 0)){
                                          while($dataFile = mysqli_fetch_array($resultFile)){
                                              ?>
                                              <tr>
                                                <td class="pl-2 pr-2"><a href="<?php if($dataFile['f_full_path'] == NULL){ echo "../tmp_file/".$dataFile['f_name']; }else{ echo $dataFile['f_full_path']; } ?>" target="_blank" class="btn btn-sm btn-primary  bsdn mr-2"><i class="fas fa-download"></i></a> <?php echo $dataFile['f_name'];?></td>
                                                <td class="pl-2 pr-2">
                                                  <?php
                                                  if($dataFile['f_approval_status'] == '1'){
                                                      echo '<span class="text-primary badge bg-primary text-white"><i class="fas fa-check"></i> เอกสารถูกต้อง</span>';
                                                  }else if($dataFile['f_approval_status'] == '2'){
                                                      echo '<span class="text-danger badge bg-danger text-white"><i class="fas fa-clock"></i> เอกสารรอการแก้ไข</span>';
                                                  }else{
                                                      echo '<i class="fas fa-clock"></i> ยังไม่ตรวจสอบ';
                                                  }
                                                  ?>
                                                </td>
                                              </tr>
                                              <?php
                                          }
                                      }else{
                                          echo '<tr><td colspan="4" class="pl-3">ไม่พบไฟล์แนบ</td></tr>';
                                      }
                                      ?>
                                  </tbody>
                              </table>

                              <h6 class="mt-3 text-dark"><span class="text-primary mr-2">Group 6 :</span>Legal Document</h6>

                              <table class="table table-striped table-bordered table-sm">
                                  <thead>
                                      <tr class="bg-gray">
                                          <th class="pl-3 text-white">ชื่อไฟล์</th>
                                          <th class="text-white" style="width: 150px;">สถานะ</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  <?php
                                      $strSQL = "SELECT * FROM file_research_attached WHERE (f_rs_id = '$id_rs' OR f_session_id IN (SELECT session_id FROM research WHERE id_rs = '$id_rs')) AND f_delete_status = '0' AND f_group = '6'";
                                      $resultFile = mysqli_query($conn, $strSQL);
                                      if(($resultFile) && (mysqli_num_rows($resultFile) > 0)){
                                          while($dataFile = mysqli_fetch_array($resultFile)){
                                              ?>
                                              <tr>
                                                <td class="pl-2 pr-2"><a href="<?php if($dataFile['f_full_path'] == NULL){ echo "../tmp_file/".$dataFile['f_name']; }else{ echo $dataFile['f_full_path']; } ?>" target="_blank" class="btn btn-sm btn-primary bsdn mr-2"><i class="fas fa-download"></i></a> <?php echo $dataFile['f_name'];?></td>
                                                <td class="pl-2 pr-2">
                                                  <?php
                                                  if($dataFile['f_approval_status'] == '1'){
                                                      echo '<span class="text-primary badge bg-primary text-white"><i class="fas fa-check"></i> เอกสารถูกต้อง</span>';
                                                  }else if($dataFile['f_approval_status'] == '2'){
                                                      echo '<span class="text-danger badge bg-danger text-white"><i class="fas fa-clock"></i> เอกสารรอการแก้ไข</span>';
                                                  }else{
                                                      echo '<i class="fas fa-clock"></i> ยังไม่ตรวจสอบ';
                                                  }
                                                  ?>
                                                </td>
                                              </tr>
                                              <?php
                                          }
                                      }else{
                                          echo '<tr><td colspan="4" class="pl-3">ไม่พบไฟล์แนบ</td></tr>';
                                      }
                                      ?>
                                  </tbody>
                              </table>

                              <h6 class="mt-3 text-dark"><span class="text-primary mr-2">Group 7 :</span>เอกสารประกอบอื่น ๆ</h6>

                              <table class="table table-striped table-bordered table-sm">
                                  <thead>
                                      <tr class="bg-gray">
                                          <th class="pl-3 text-white">ชื่อไฟล์</th>
                                          <th class="text-white" style="width: 150px;">สถานะ</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  <?php
                                      $strSQL = "SELECT * FROM file_research_attached WHERE (f_rs_id = '$id_rs' OR f_session_id IN (SELECT session_id FROM research WHERE id_rs = '$id_rs')) AND f_delete_status = '0' AND f_group = '7'";
                                      $resultFile = mysqli_query($conn, $strSQL);
                                      if(($resultFile) && (mysqli_num_rows($resultFile) > 0)){
                                          while($dataFile = mysqli_fetch_array($resultFile)){
                                              ?>
                                              <tr>
                                                <td class="pl-2 pr-2"><a href="<?php if($dataFile['f_full_path'] == NULL){ echo "../tmp_file/".$dataFile['f_name']; }else{ echo $dataFile['f_full_path']; } ?>" target="_blank" class="btn btn-sm btn-primary bsdn mr-2"><i class="fas fa-download"></i></a> <?php echo $dataFile['f_name'];?></td>
                                                <td class="pl-2 pr-2">
                                                  <?php
                                                  if($dataFile['f_approval_status'] == '1'){
                                                      echo '<span class="text-primary badge bg-primary text-white"><i class="fas fa-check"></i> เอกสารถูกต้อง</span>';
                                                  }else if($dataFile['f_approval_status'] == '2'){
                                                      echo '<span class="text-danger badge bg-danger text-white"><i class="fas fa-clock"></i> เอกสารรอการแก้ไข</span>';
                                                  }else{
                                                      echo '<i class="fas fa-clock"></i> ยังไม่ตรวจสอบ';
                                                  }
                                                  ?>
                                                </td>
                                              </tr>
                                              <?php
                                          }
                                      }else{
                                          echo '<tr><td colspan="4" class="pl-3">ไม่พบไฟล์แนบ</td></tr>';
                                      }
                                      ?>
                                  </tbody>
                              </table>

                              <h6 class="mt-3 text-dark"><span class="text-primary mr-2">Group 8 :</span>Updated CV, หลักฐานการอบรมจริยธรรมวิจัย</h6>
                              <table class="table table-striped table-bordered table-sm">
                                  <thead>
                                      <tr class="bg-gray">
                                          <th class="pl-3 text-white">ชื่อไฟล์</th>
                                          <th class="text-white" style="width: 150px;">สถานะ</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  <?php
                                      $strSQL = "SELECT * FROM file_research_attached WHERE (f_rs_id = '$id_rs' OR f_session_id IN (SELECT session_id FROM research WHERE id_rs = '$id_rs')) AND f_delete_status = '0' AND f_group = '8'";
                                      $resultFile = mysqli_query($conn, $strSQL);
                                      if(($resultFile) && (mysqli_num_rows($resultFile) > 0)){
                                          while($dataFile = mysqli_fetch_array($resultFile)){
                                              ?>
                                              <tr>
                                                <td class="pl-2 pr-2"><a href="<?php if($dataFile['f_full_path'] == NULL){ echo "../tmp_file/".$dataFile['f_name']; }else{ echo $dataFile['f_full_path']; } ?>" target="_blank" class="btn btn-sm btn-primary bsdn mr-2"><i class="fas fa-download"></i></a> <?php echo $dataFile['f_name'];?></td>
                                                <td class="pl-2 pr-2">
                                                  <?php
                                                  if($dataFile['f_approval_status'] == '1'){
                                                      echo '<span class="text-primary badge bg-primary text-white"><i class="fas fa-check"></i> เอกสารถูกต้อง</span>';
                                                  }else if($dataFile['f_approval_status'] == '2'){
                                                      echo '<span class="text-danger badge bg-danger text-white"><i class="fas fa-clock"></i> เอกสารรอการแก้ไข</span>';
                                                  }else{
                                                      echo '<i class="fas fa-clock"></i> ยังไม่ตรวจสอบ';
                                                  }
                                                  ?>
                                                </td>
                                              </tr>
                                              <?php
                                          }
                                      }else{
                                          echo '<tr><td colspan="4" class="pl-3">ไม่พบไฟล์แนบ</td></tr>';
                                      }
                                      ?>
                                  </tbody>
                              </table>

                              <h6 class="mt-3 text-dark"><span class="text-primary mr-2">Group 9 :</span>ใบนำส่งเงินค่าธรรมเนียม</h6>
                              <table class="table table-striped table-bordered table-sm">
                                  <thead>
                                      <tr class="bg-gray">
                                          <th class="pl-3 text-white">ชื่อไฟล์</th>
                                          <th class="text-white" style="width: 150px;">สถานะ</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  <?php
                                      $strSQL = "SELECT * FROM file_research_attached WHERE (f_rs_id = '$id_rs' OR f_session_id IN (SELECT session_id FROM research WHERE id_rs = '$id_rs')) AND f_delete_status = '0' AND f_group = '9'";
                                      $resultFile = mysqli_query($conn, $strSQL);
                                      if(($resultFile) && (mysqli_num_rows($resultFile) > 0)){
                                          while($dataFile = mysqli_fetch_array($resultFile)){
                                              ?>
                                              <tr>
                                                <td class="pl-2 pr-2"><a href="<?php if($dataFile['f_full_path'] == NULL){ echo "../tmp_file/".$dataFile['f_name']; }else{ echo $dataFile['f_full_path']; } ?>" target="_blank" class="btn btn-sm btn-primary bsdn mr-2"><i class="fas fa-download"></i></a> <?php echo $dataFile['f_name'];?></td>
                                                <td class="pl-2 pr-2">
                                                  <?php
                                                  if($dataFile['f_approval_status'] == '1'){
                                                      echo '<span class="text-primary badge bg-primary text-white"><i class="fas fa-check"></i> เอกสารถูกต้อง</span>';
                                                  }else if($dataFile['f_approval_status'] == '2'){
                                                      echo '<span class="text-danger badge bg-danger text-white"><i class="fas fa-clock"></i> เอกสารรอการแก้ไข</span>';
                                                  }else{
                                                      echo '<i class="fas fa-clock"></i> ยังไม่ตรวจสอบ';
                                                  }
                                                  ?>
                                                </td>
                                              </tr>
                                              <?php
                                          }
                                      }else{
                                          echo '<tr><td colspan="4" class="pl-3">ไม่พบไฟล์แนบ</td></tr>';
                                      }
                                      ?>
                                  </tbody>
                              </table>

                              <h6 class="mt-3 text-dark"><span class="text-primary mr-2">Group 10 :</span>อื่น ๆ (เฉพาะโครงการที่ลงทะเบียนก่อน 1 ม.ค. 61)</h6>
                              <table class="table table-striped table-bordered table-sm">
                                  <thead>
                                      <tr class="bg-gray">
                                          <th class="pl-3 text-white">ชื่อไฟล์</th>
                                          <th class="text-white" style="width: 150px;">สถานะ</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  <?php
                                      $strSQL = "SELECT * FROM file_research_attached WHERE (f_rs_id = '$id_rs' OR f_session_id IN (SELECT session_id FROM research WHERE id_rs = '$id_rs')) AND f_delete_status = '0' AND f_group = '10'";
                                      $resultFile = mysqli_query($conn, $strSQL);
                                      if(($resultFile) && (mysqli_num_rows($resultFile) > 0)){
                                          while($dataFile = mysqli_fetch_array($resultFile)){
                                              ?>
                                              <tr>
                                                <td class="pl-2 pr-2"><a href="<?php if($dataFile['f_full_path'] == NULL){ echo "../tmp_file/".$dataFile['f_name']; }else{ echo $dataFile['f_full_path']; } ?>" target="_blank" class="btn btn-sm btn-primary  bsdn mr-2"><i class="fas fa-download"></i></a> <?php echo $dataFile['f_name'];?></td>
                                                <td class="pl-2 pr-2">
                                                  <?php
                                                  if($dataFile['f_approval_status'] == '1'){
                                                      echo '<span class="text-primary badge bg-primary text-white"><i class="fas fa-check"></i> เอกสารถูกต้อง</span>';
                                                  }else if($dataFile['f_approval_status'] == '2'){
                                                      echo '<span class="text-danger badge bg-danger text-white"><i class="fas fa-clock"></i> เอกสารรอการแก้ไข</span>';
                                                  }else{
                                                      echo '<i class="fas fa-clock"></i> ยังไม่ตรวจสอบ';
                                                  }
                                                  ?>
                                                </td>
                                              </tr>
                                              <?php
                                          }
                                      }else{
                                          echo '<tr><td colspan="4" class="pl-3">ไม่พบไฟล์แนบ</td></tr>';
                                      }
                                      ?>
                                  </tbody>
                              </table>
                            </div>
                            <!-- .file_result -->
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
          <input type="hidden" value="<?php echo $dataResearch1['id_rs'];?>" id="textId_rs">
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
  <script type="text/javascript" src="../node_modules/preload.js/dist/js/preload.js"></script>
  <script type="text/javascript" src="../node_modules/ckeditor_lite/ckeditor.js"></script>
  <script src="../assets/js/stisla.js"></script>

  <!-- Template JS File -->
  <script src="../assets/js/scripts.js"></script>
  <script src="../assets/custom/js/config.js?token=<?php echo $sysdateu; ?>"></script>
  <script src="../assets/custom/js/authen.js?token=<?php echo $sysdateu; ?>"></script>
  <script src="../assets/custom/js/custom.js?token=<?php echo $sysdateu; ?>"></script>
  <script src="../assets/custom/js/function.js?token=<?php echo $sysdateu; ?>"></script>
  <script src="../assets/custom/js/pi.2.1.js?token=<?php echo $sysdateu; ?>"></script>

  <script>

      $file_arr = [];

      $(document).ready(function(){
          preload.hide()
      })

      function setCheckboxValue(fid){
        if($('#checkBox_' + fid).is(":checked")){
            $file_arr.push(fid)
        }else{
            $file_arr = jQuery.grep($file_arr, function(value) {
            return value != fid;
            });
        }
      }

      function approveFile(stage, fid){
        var param = {
          uid: <?php echo $uid;?>,
          id_rs: <?php echo $id_rs;?>,
          fid: fid,
          to_status: stage
        }

        preload.show()

        var jxr = $.post(conf.api + 'staff/file_research_attach?stage=change_approve_status', param, function(){})
                   .always(function(resp){
                     if(resp == 'Y'){
                      window.location.reload()
                     }else{
                       preload.hide()
                       swal("เกิดข้อผิดพลาด!", "ไม่สามารถเปลี่ยนสถานะของไฟล์เอกสารได้", "error")
                     }
                   })

      }
  </script>

</body>
</html>
