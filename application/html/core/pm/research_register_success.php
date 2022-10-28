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

$uid = mysqli_real_escape_string($conn, $_GET['uid']);
$role = mysqli_real_escape_string($conn, $_GET['role']);

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

              <div class="row mt-3">
                <div class="col-lg-12">
                  <div class="" id="printArea">
                    <div class="card">
                      <div class="card-body">
                        <div class="text-center pt-5 pb-3 ">
                          <i class="fas fa-check text-primary" style="font-size: 5em;"></i>
                          <h2 class="text-dark mt-4">ลงทะเบียนโครงการวิจัยสำเร็จ</h2>
                          <p>
                            กรุณาตรวจสอบสถานะโครงการวิจัยและอีเมลอย่างสม่ำเสมอ หากมีข้อสงสัยใดๆ กรุณาติดต่อเจ้าหน้าที่ (คุณณัฏฐา ที่ 1149, 1157)
                          </p>
                        </div>

                        <div class="row">
                          <div class="col-lg-12">
                            <div class="text-center pb-3">
                              <button type="button" class="btn btn-primary bsdn" onclick="window.location = 'index?uid=<?php echo $uid;?>&role=<?php echo $role;?>'"><i class="fas fa-home"></i> กลับหน้าหลัก</button>
                            </div>
                          </div>
                        </div>

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
