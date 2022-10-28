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

$uid = mysqli_real_escape_string($conn, $_GET['uid']);
$role = mysqli_real_escape_string($conn, $_GET['role']);

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>RMIS :: <?php echo $role;?></title>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

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
          <div class="section-header">
            <h1>หน้าแรก</h1>
          </div>

          <div class="section-body">
              <div class="row">
                  <div class="col-12 col-sm-4 mb-4">
                      <h5 class="text-dark">เสนอโครงการวิจัยใหม่</h5>
                      <h6>(Submit new initial review)</h6>
                      <button class="btn btn-success btn-block text-left"  data-toggle="modal" data-target="#submitNewInitial"><i class="fas fa-plus"></i> ลงทะเบียนโครงการวิจัยใหม่</button>
                      <button class="btn btn-success btn-block text-left" id="submitNewInitialUnsend" onclick=gotoPage("rs-status-1-unsend?uid=<?php echo $uid;?>&role=<?php echo $role;?>")><i class="fas fa-bars"></i> โครงการวิจัยที่ยังไม่ยืนยันการส่ง</button>
                      <?php
                      $strSQL = "SELECT * FROM research a INNER JOIN type_research b ON a.id_type  = b.id_type
                      INNER JOIN type_status_research c ON a.id_status_research = c.id_status_research
                      INNER JOIN type_personnel d ON a.id_personnel = d.id_personnel
                      INNER JOIN dept e ON a.id_dept = e.id_dept
                      INNER JOIN useraccount f ON a.id_pm = f.id_pm
                      INNER JOIN userinfo  g ON f.id = g.user_id
                      WHERE
                        a.draft_status = '0'
                        AND a.delete_flag = 'N'
                        AND a.sendding_status = 'Y'
                        AND a.research_status = 'new'
                        AND f.delete_status = '0'
                        AND (a.id_status_research = '2' OR a.id_status_research = '20')
                        AND g.user_id = '$uid'";
                      $result = mysqli_query($conn, $strSQL);
                      if(($result) && (mysqli_num_rows($result) > 0)){
                        ?>
                        <button class="btn btn-warning btn-block text-left" onclick="window.location='rs-wait-update-list-1?uid=<?php echo $uid;?>&role=<?php echo $role;?>&year=<?php echo $sysdateyear; ?>'"><i class="fas fa-bars"></i> แบบเสนอรอการแก้ไข/ตอบข้อเสนอแนะ ( <?php echo mysqli_num_rows($result); ?> )</button>
                        <?php
                      }else{
                        ?>
                        <button class="btn btn-success btn-block text-left" onclick="window.location='rs-wait-update-list-1?uid=<?php echo $uid;?>&role=<?php echo $role;?>&year=<?php echo $sysdateyear; ?>'"><i class="fas fa-bars"></i> แบบเสนอรอการแก้ไข/ตอบข้อเสนอแนะ</button>
                        <?php
                      }
                      ?>

                      <button class="btn btn-success btn-block text-left" onclick="window.location='rs-wait-update-list-2?uid=<?php echo $uid;?>&role=<?php echo $role;?>&year=<?php echo $sysdateyear; ?>'"><i class="fas fa-bars"></i> แบบเสนอรอการตอบข้อคำถาม</button>
                      <button class="btn btn-success btn-block text-left" onclick="window.location='your-init-list?uid=<?php echo $uid;?>&role=<?php echo $role;?>&year=<?php echo $sysdateyear; ?>'"><i class="fas fa-bars"></i> ตรวจสอบโครงการวิจัยทั้งหมดของท่าน</button>
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
  <script type="text/javascript" src="../node_modules/preload.js/dist/js/preload.js"></script>
  <script src="../assets/js/stisla.js"></script>

  <!-- Template JS File -->
  <script src="../assets/js/scripts.js"></script>
  <script src="../assets/custom/js/config.js?token=<?php echo $sysdateu; ?>"></script>
  <script src="../assets/custom/js/authen.js?token=<?php echo $sysdateu; ?>"></script>
  <script src="../assets/custom/js/custom.js?token=<?php echo $sysdateu; ?>"></script>
  <script src="../assets/custom/js/function.js?token=<?php echo $sysdateu; ?>"></script>
  <script src="../assets/custom/js/research_register.js?token=<?php echo $sysdateu; ?>"></script>
  <script src="../assets/custom/js/pi.2.1.js?token=<?php echo $sysdateu; ?>"></script>

  <script>
      $(document).ready(function(){
        $('#modalNotify').modal()
        window.localStorage.removeItem(conf.prefix + 'project')
        setTimeout(() => {
          preload.hide()
          project.list_unsend_project()
        }, 1000);
      })
  </script>

</body>
</html>

<!-- Modal -->
<div class="modal fade" id="modalNotify" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="border-radius: 0px;">
      <div class="modal-body">
        <div class="text-center pt-4 pb-4">
          <i class="fas fa-exclamation-circle text-warning" style="font-size: 5em;"></i>
        </div>
        <h4 class="text-center text-dark">สำคัญ</h4>
        <p>
          <div class="text-center">
            สำนักงานจะสื่อสารทางอีเมล์ที่ท่านให้ไว้ <span class="text-danger">บางครั้งอาจอยู่ใน Junk box</span> ขอให้ตรวจสอบ Junk box ของท่าน หรือเข้าไปในระบบ RMIS เป็นระยะเพื่อตรวจสอบสถานะ
          </div>
          <div class="text-center pt-3">
            <div class="pt-3">
              <button type="button" class="btn btn-danger bsdn btn-lg" data-dismiss="modal" style="font-size: 1em;">รับทราบ</button>
            </div>
          </div>
        </p>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="submitNewInitial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary pb-4">
        <h5 class="modal-title text-white" id="exampleModalLabel">ข้อตกลงและเงื่อนไข</h5>
        <button type="button" class="close text-white btnCloseModal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>
          <ol>
            <li>การลงทะเบียนส่วนนี้ หมายถึง <span class="text-danger" style="font-size: 1.4em;">การลงทะเบียนงานวิจัยที่ยังไม่ผ่านการรับรอง</span> </li>
            <li>หากลงทะเบียนโครงการค้างอยู่ ให้ปิดกล่องข้อความนี้และเลือกปุ่ม "แบบเสนอโครงการฉบับร่าง"</li>
            <li>ผู้ลงข้อมูล<span class="text-danger" style="font-size: 1.4em;">ต้องเป็นหัวหน้าโครงการเท่านั้น</span> (ถ้ามีผู้ลงข้อมูลแทน ต้องใช้ username และ password ของหัวหน้าโครงการเท่านั้น)</li>
          </ol>
          <div class="text-center pt-3">
            ตอบ "ตกลง" เพื่อยอมรับเงื่อนไขและทำการลงทะเบียนงานวิจัยใหม่
            <div class="pt-4">
              <button type="button" class="btn btn-primary bsdn btn-lg" style="font-size: 1em;" onclick="window.location='research_register?uid=<?php echo $uid;?>&role=<?php echo $role;?>'">ตกลง</button>
            </div>
          </div>
        </p>
      </div>
    </div>
  </div>
</div>
