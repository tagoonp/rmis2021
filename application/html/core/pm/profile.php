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
            <div class="container">
              <h1>ข้อมูลส่วนตัว <small>(Profile)</small> </h1>
            </div>
          </div>

          <div class="section-body">
            <div class="container">
              <div class="row">
                <div class="col-12">
                  <h6>ข้อมูลทั่วไป<a href="#" class="float-right text-danger"  data-toggle="modal" data-target="#modalProfile">- <i class="fas fa-pencil-alt"></i> แก้ไขข้อมูล -</a></h6>
                  <div class="card">
                    <div class="card-body p-0">
                      <table class="table table-striped mb-0">
                        <tbody>
                          <tr>
                            <td style="width: 30%; vertical-align: top;" class="text-dark- pt-3 pb-3">ชื่อ - นามสกุล</td>
                            <td class="text-primary pt-3 pb-3" style="vertical-align: top;">
                              <?php echo $dataUser['prefix_th'].$dataUser['fname']." ".$dataUser['lname'];?><br>
                              <?php
                                if($dataUser['fname_en'] != NULL){
                                  echo $dataUser['prefix_en'].$dataUser['fname_en']." ".$dataUser['lname_en'];
                                }
                              ?>
                            </td>
                          </tr>
                          <?php
                          if($dataUser['id_dept'] == 19){
                            ?>
                            <tr>
                              <td style="width: 30%; vertical-align: top;" class="text-dark- pt-3 pb-3">หน่วยงานที่สังกัด<br>(Department/Institution)</td>
                              <td class="text-primary pt-3 pb-3" style="vertical-align: top;">
                                <?php echo $dataUser['dept'];?><br>
                                <?php
                                  if($dataUser['dept_en'] != NULL){
                                    echo $dataUser['dept_en'];
                                  }
                                ?>
                              </td>
                            </tr>
                            <?php
                          }
                          ?>
                          <tr>
                            <td style="width: 30%; vertical-align: top;" class="text-dark- pt-3 pb-3">ตำแหน่ง<br>(Position)</td>
                            <td class="text-primary pt-3 pb-3" style="vertical-align: top;"><?php echo $dataUser['personnel_name'];?></td>
                          </tr>
                          <tr>
                            <td style="width: 30%; vertical-align: top;" class="text-dark- pt-3 pb-3">สาขาเชี่ยวชาญ<br>(Expertise)</td>
                            <td class="text-primary pt-3 pb-3" style="vertical-align: top;"><?php echo $dataUser['expertise'];?></td>
                          </tr>
                          <tr>
                            <td style="width: 30%; vertical-align: top;" class="text-dark- pt-3 pb-3">งานวิจัยที่สนใจ<br>(Research interest)</td>
                            <td class="text-primary pt-3 pb-3" style="vertical-align: top;"><?php echo $dataUser['rs_interest'];?></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>

                  <h6>ข้อมูลการติดต่อ<a href="#" class="float-right text-danger" data-toggle="modal" data-target="#modalContact">- <i class="fas fa-pencil-alt"></i> แก้ไขข้อมูล -</a></h6>
                  <div class="card">
                    <div class="card-body p-0">
                      <table class="table table-striped mb-0">
                        <tbody>
                          <tr>
                            <td style="width: 30%; vertical-align: top;" class="text-dark- pt-3 pb-3">E-mail address:</td>
                            <td class="text-primary pt-3 pb-3" style="vertical-align: top;"><?php echo $dataUser['email'];?></td>
                          </tr>
                          <tr>
                            <td style="width: 30%; vertical-align: top;" class="text-dark- pt-3 pb-3">โทรศัพท์มือถือ<br>(Mobile)</td>
                            <td class="text-primary pt-3 pb-3" style="vertical-align: top;"><?php echo $dataUser['tel_mobile'];?></td>
                          </tr>
                          <tr>
                            <td style="width: 30%; vertical-align: top;" class="text-dark- pt-3 pb-3">โทรศัพท์สำนักงาน<br>(Office number)</td>
                            <td class="text-primary pt-3 pb-3" style="vertical-align: top;"><?php echo $dataUser['tel_office'];?></td>
                          </tr>
                          <tr>
                            <td style="width: 30%; vertical-align: top;" class="text-dark- pt-3 pb-3">แฟกซ์<br>(Fax)</td>
                            <td class="text-primary pt-3 pb-3" style="vertical-align: top;"><?php echo $dataUser['tel_fax'];?></td>
                          </tr>
                          <tr>
                            <td style="width: 30%; vertical-align: top;" class="text-dark- pt-3 pb-3">ที่อยู่ปัจจุบัน<br>(Address)</td>
                            <td class="text-primary pt-3 pb-3" style="vertical-align: top;"><?php echo $dataUser['address'];?></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>

                  <h6>รหัสผ่าน<a href="#" class="float-right text-danger" data-toggle="modal" data-target="#modalPassword">- <i class="fas fa-pencil-alt"></i> เปลี่ยนรหัสผ่าน -</a></h6>
                  <div class="card">
                    <div class="card-body p-0">
                      <table class="table table-striped mb-0">
                        <tbody>
                          <tr>
                            <td style="width: 30%; vertical-align: top;" class="text-dark- pt-3 pb-3">รหัสผ่าน:</td>
                            <td class="text-primary pt-3 pb-3" style="vertical-align: top;">
                              <?php
                              // echo base64_decode($dataUser['password']);
                              $pwd = base64_decode($dataUser['password']);
                              for ($i=0; $i < strlen($pwd); $i++) {
                                echo "<i class='fas fa-circle' style='font-size: 0.4em !important; margin-right: 3px;'></i>";
                              }
                              ?>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>

                  <h6>การเชื่อมโยงข้อมูลภายนอก</h6>
                  <div class="card">
                    <div class="card-body p-0">
                      <table class="table table-striped mb-0">
                        <tbody>
                          <tr>
                            <td style="width: 30%; vertical-align: top;" class="text-dark- pt-3 pb-3">RMIS link code :</td>
                            <td class="text-primary pt-3 pb-3" style="vertical-align: top;">
                              <?php
                              echo $dataUser['user_code'];
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
  <script type="text/javascript" src="../node_modules/preload.js/dist/js/preload.js"></script>
  <script src="../assets/js/stisla.js"></script>

  <!-- Template JS File -->
  <script src="../assets/js/scripts.js"></script>
  <script src="../assets/custom/js/config.js?token=<?php echo $sysdateu; ?>"></script>
  <script src="../assets/custom/js/authen.js?token=<?php echo $sysdateu; ?>"></script>
  <script src="../assets/custom/js/custom.js?token=<?php echo $sysdateu; ?>"></script>
  <script src="../assets/custom/js/function.js?token=<?php echo $sysdateu; ?>"></script>
  <script src="../assets/custom/js/pi.2.1.js?token=<?php echo $sysdateu; ?>"></script>

  <script>
      $(document).ready(function(){
          setTimeout(() => {
            preload.hide()
          }, 1000);
      })

      $(function(){
        $('.contactForm').submit(function(){
          let check = 0
          $('.form-control').removeClass('is-invalid')
          if($('#txtEmail').val() == ''){ check++; $('#txtEmail').addClass('is-invalid'); }
          if($('#txtPhone').val() == ''){ check++; $('#txtPhone').addClass('is-invalid'); }
          if(check!=0){
            return ;
          }
          var param = {
            uid: current_user,
            email: $('#txtEmail').val(),
            phone: $('#txtPhone').val(),
            office: $('#txtOffice').val(),
            fax: $('#txtFax').val(),
            address: $('#txtAddress').val()
          }
          preload.show()
          authen.update_contact(param)
        })

        $('.passwordForm').submit(function(){
          let check = 0
          $('.form-control').removeClass('is-invalid')
          if($('#txtPassword').val() == ''){ check++; $('#txtPassword').addClass('is-invalid'); }
          if($('#txtPassword2').val() == ''){ check++; $('#txtPassword2').addClass('is-invalid'); }

          if(check!=0){
            swal("คำเตือน", "กรุณากรอกข้อมูลให้ครบถ้วน", "warning")
            return ;
          }

          if($('#txtPassword').val() != $('#txtPassword2').val()){
            swal("คำเตือน", "กรุณายืนยันรหัสผ่านให้ตรงกัน", "warning")
            return ;
          }

          var param = {
            uid: current_user,
            password: $('#txtPassword').val()
          }
          preload.show()
          authen.update_password(param)

        })

        $('.profileForm').submit(function(){
          let check = 0
          $('.form-control').removeClass('is-invalid')
          if($('#txtPrefix_en').val() == ''){ check++; $('#txtPrefix_en').addClass('is-invalid'); }
          if($('#txtPrefix_th').val() == ''){ check++; $('#txtPrefix_th').addClass('is-invalid'); }
          if($('#txtFname_th').val() == ''){ check++; $('#txtFname_th').addClass('is-invalid'); }
          if($('#txtLname_en').val() == ''){ check++; $('#txtLname_en').addClass('is-invalid'); }
          if($('#txtFname_th').val() == ''){ check++; $('#txtFname_th').addClass('is-invalid'); }
          if($('#txtLname_en').val() == ''){ check++; $('#txtLname_en').addClass('is-invalid'); }
          if($('#txtPosition').val() == ''){ check++; $('#txtPosition').addClass('is-invalid'); }

          if($('#txtDept').val() == '19'){
              if($('#txtDept_th').val() == ''){ check++; $('#txtDept_th').addClass('is-invalid'); }
              if($('#txtDept_en').val() == ''){ check++; $('#txtDept_en').addClass('is-invalid'); }
          }

          if($('#txtExpertise').val() == ''){ check++; $('#txtExpertise').addClass('is-invalid'); }
          if($('#txtRsinterest').val() == ''){ check++; $('#txtRsinterest').addClass('is-invalid'); }


          if(check!=0){
            swal("คำเตือน", "กรุณากรอกข้อมูลให้ครบถ้วน", "warning")
            return ;
          }
          var param = {
            uid: current_user,
            prefix_th: $('#txtPrefix_th').val(),
            prefix_en: $('#txtPrefix_en').val(),
            fname_th: $('#txtFname_th').val(),
            fname_en: $('#txtFname_en').val(),
            lname_th: $('#txtLname_th').val(),
            lname_en: $('#txtLname_en').val(),
            ptyle: $('#txtPosition').val(),
            dept: $('#txtDept').val(),
            dept_th: $('#txtDept_th').val(),
            dept_en: $('#txtDept_en').val(),
            expertise: $('#txtExpertise').val(),
            rs_interest: $('#txtRsinterest').val()
          }
          preload.show()
          authen.update_profile(param)
        })
      })

  </script>

</body>
</html>

<!-- Modal -->
<div class="modal fade" id="modalProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title text-white pb-3" id="exampleModalLabel">แก้ไขข้อมูลส่วนตัว</h5>
        <button type="button" class="close text-white btnCloseModal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="profileForm" onsubmit="return false;">
          <div class="row">
            <div class="form-group col-12 col-sm-4 mb-2">
              <label for="">คำนำหน้าชื่อ : <span class="text-danger">*</span></label>
              <input type="text" id="txtPrefix_th" required name="" value="<?php echo $dataUser['prefix_th'];?>" class="form-control" placeholder="กรอกอีเมลแอดเดรส ...">
              <div class="p-1 text-muted" style="font-size: 0.8em;">
                * คำนำหน้าชื่อนี้จะถูกนำไปแสดงในใบรับรอง
              </div>
            </div>
            <div class="form-group col-12 col-sm-4 mb-2">
              <label for="">ชื่อ : <span class="text-danger">*</span></label>
              <input type="text" id="txtFname_th" required name="" value="<?php echo $dataUser['fname'];?>" class="form-control" placeholder="กรอกอีเมลแอดเดรส ...">
            </div>
            <div class="form-group col-12 col-sm-4 mb-2">
              <label for="">นามสกุล : <span class="text-danger">*</span></label>
              <input type="text" id="txtLname_th" required name="" value="<?php echo $dataUser['lname'];?>" class="form-control" placeholder="กรอกอีเมลแอดเดรส ...">
            </div>
          </div>

          <div class="row">
            <div class="form-group col-12 col-sm-4 mb-2">
              <label for="">Prefix : <span class="text-danger">*</span></label>
              <input type="text" id="txtPrefix_en" required name="" value="<?php echo $dataUser['prefix_en'];?>" class="form-control" placeholder="กรอกอีเมลแอดเดรส ...">
              <div class="p-1 text-muted" style="font-size: 0.8em;">
                * This prefix will ve shown in certificate of approval.
              </div>
            </div>
            <div class="form-group col-12 col-sm-4 mb-2">
              <label for="">Name : <span class="text-danger">*</span></label>
              <input type="text" id="txtFname_en" required name="" value="<?php echo $dataUser['fname_en'];?>" class="form-control" placeholder="กรอกอีเมลแอดเดรส ...">
            </div>
            <div class="form-group col-12 col-sm-4 mb-2">
              <label for="">Surname : <span class="text-danger">*</span></label>
              <input type="text" id="txtLname_en" required name="" value="<?php echo $dataUser['lname_en'];?>" class="form-control" placeholder="กรอกอีเมลแอดเดรส ...">
            </div>
          </div>

          <div class="form-group mb-2">
            <label for="">ตำแหน่ง (Position) : <span class="text-danger">*</span></label>
            <select class="form-control" name="txtPosition" id="txtPosition">
              <option value="">-- เลือกตำแหน่ง (Choose position) --</option>
              <?php
              $strSQL = "SELECT * FROM type_personnel WHERE 1 ORDER BY id_personnel";
              $resultPersonnal = mysqli_query($conn, $strSQL);
              if($resultPersonnal){
                while($row = mysqli_fetch_array($resultPersonnal)){
                  $check = '';
                  if($dataUser['id_personnel'] == $row['id_personnel']){
                    $check = 'selected';
                  }
                  echo "<option value='".$row['id_personnel']."' $check>".$row['personnel_name']."</option>";
                }
              }
              ?>
            </select>
          </div>

          <div class="form-group dn mb-2">
            <label for="">Department : <span class="text-danger">*</span></label>
            <input type="text" id="txtDept" name="" value="<?php echo $dataUser['id_dept'];?>" class="form-control" placeholder="กรอกอีเมลแอดเดรส ...">
          </div>

          <?php
          if($dataUser['id_dept'] == 19){
            ?>
            <div class="form-group mb-2">
              <label for="">ชื่อหน่วยงานที่สังกัด (ภาษาไทย) : <span class="text-danger">*</span></label>
              <input type="text" id="txtDept_th" name="" value="<?php echo $dataUser['dept'];?>" class="form-control" placeholder="กรอกชื่อหน่วยงานที่สังกัด...">
            </div>

            <div class="form-group mb-2">
              <label for="">Department / Institution name (English) : <span class="text-danger">*</span></label>
              <input type="text" id="txtDept_en" name="" value="<?php echo $dataUser['dept_en'];?>" class="form-control" placeholder="Enter institution or department name ...">
            </div>
            <?php
          }
          ?>
          <div class="form-group mb-2">
            <label for="">สาขาเชี่ยวชาญ (Expertise) : <span class="text-danger">*</span></label>
            <textarea name="name" required id="txtExpertise" style="height: 100px !important;" rows="8" cols="80" class="form-control" placeholder="กรอกสาขาเชี่ยวชาญ แต่ละด้านให้คั่นด้วย comma (,) ..."><?php echo $dataUser['expertise'];?></textarea>
          </div>
          <div class="form-group">
            <label for="">งานวิจัยที่สนใจ (Research interest) : <span class="text-danger">*</span></label>
            <textarea name="name" required id="txtRsinterest" style="height: 100px !important;" rows="8" cols="80" class="form-control" placeholder="กรอกงานวิจัยที่สนใจ แต่ละงานให้คั่นด้วย comma (,) ..."><?php echo $dataUser['rs_interest'];?></textarea>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block btn-lg bsdn">บันทึก</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalContact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title text-white pb-3" id="exampleModalLabel">แก้ไขข้อมูลการติดต่อ</h5>
        <button type="button" class="close text-white btnCloseModal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="contactForm" onsubmit="return false;">
          <div class="form-group">
            <label for="">E-mail address : <span class="text-danger">*</span></label>
            <input type="email" id="txtEmail" required name="" value="<?php echo $dataUser['email'];?>" class="form-control" placeholder="กรอกอีเมลแอดเดรส ...">
          </div>
          <div class="form-group">
            <label for="">โทรศัพท์มือถือ : <span class="text-danger">*</span></label>
            <input type="text" id="txtPhone" required name="" value="<?php echo $dataUser['tel_mobile'];?>" class="form-control" placeholder="กรอกหมายเลขโทรศัพท์มือถือ ...">
          </div>
          <div class="form-group">
            <label for="">โทรศัพท์สำนักงาน : </label>
            <input type="text" id="txtOffice" name="" value="<?php echo $dataUser['tel_office'];?>" class="form-control" placeholder="กรอกหมายเลขโทรศัพท์สำนักงาน ...">
          </div>
          <div class="form-group">
            <label for="">แฟกซ์ :</label>
            <input type="text" id="txtFax" name="" value="<?php echo $dataUser['tel_fax'];?>" class="form-control" placeholder="กรอกหมายเลขแฟกซ์ ...">
          </div>
          <div class="form-group">
            <label for="">ที่อยู่ปัจจุบัน :</label>
            <textarea name="name" id="txtAddress" style="height: 100px !important;" rows="8" cols="80" class="form-control" placeholder="กรอกที่อยู่ปัจจุบัน ..."><?php echo $dataUser['address'];?></textarea>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block btn-lg bsdn">บันทึก</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title text-white pb-3" id="exampleModalLabel">แก้ไขรหัสผ่าน</h5>
        <button type="button" class="close text-white btnCloseModal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="passwordForm" onsubmit="return false;">
          <div class="form-group">
            <label for="">ตั้งรหัสผ่านใหม่ : <span class="text-danger">*</span></label>
            <input type="text" id="txtPassword" required class="form-control" placeholder="ตั้งรหัสผ่านใหม่ของท่าน ...">
          </div>
          <div class="form-group">
            <label for="">ยืนยันรหัสผ่านใหม่อีกครั้ง : <span class="text-danger">*</span></label>
            <input type="password" id="txtPassword2" required class="form-control" placeholder="กรอกรหัสผ่านใหม่ให้เหมือนกับด้านบน ...">
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block btn-lg bsdn">บันทึก</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
