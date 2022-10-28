<?php

require('../../../configuration/server.inc.php');
require('../../../configuration/configuration.php');
require('../../../configuration/database.php'); 
require('../../../configuration/session.php'); 

// include "../conf.inc.php";
// include "../connect.inc.php";
// include "../function.inc.php";
// include "./function.php";

$db = new Database();
$conn = $db->conn();

$sid = mysqli_real_escape_string($conn, $_SESSION['rmis_id']);
$role = mysqli_real_escape_string($conn, $_SESSION['rmis_role']);
$uid = mysqli_real_escape_string($conn, $_SESSION['rmis_uid']);

include "../../../configuration/user.inc.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>RMIS ::  <?php echo $role;?></title>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

  <!-- General CSS Files -->
  <link rel="stylesheet" href="../../../old/node_modules/bootstrap/dist/css/bootstrap.min.css" >
  <link rel="stylesheet" href="../../../old/node_modules/@fortawesome/fontawesome-free/css/all.css">
  <link rel="stylesheet" href="../../../old/node_modules/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="../../../old/node_modules/sweetalert/dist/sweetalert.css">
  <link rel="stylesheet" href="../../../old/node_modules/preload.js/dist/css/preload.css">
  <!-- <link rel="stylesheet" href="../v3/vendors/bower_components/bootstrap-datepicker/bootstrap-datepicker3.min.css" /> -->
  <!-- CSS Libraries -->
  <link rel="stylesheet" href="../../../old/node_modules/dropzone/dist/min/dropzone.min.css">

  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="../../../old/assets/css/style.css">
  <link rel="stylesheet" href="../../../old/assets/custom/css/style.css">
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
                    <img alt="image" src="../../../old/assets/img/avatar/avatar-1.png" class="rounded-circle">
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
                    <img alt="image" src="../../../old/assets/img/avatar/avatar-2.png" class="rounded-circle">
                  </div>
                  <div class="dropdown-item-desc">
                    <b>Dedik Sugiharto</b>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                    <div class="time">12 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item dropdown-item-unread">
                  <div class="dropdown-item-avatar">
                    <img alt="image" src="../../../old/assets/img/avatar/avatar-3.png" class="rounded-circle">
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
                    <img alt="image" src="../../../old/assets/img/avatar/avatar-4.png" class="rounded-circle">
                  </div>
                  <div class="dropdown-item-desc">
                    <b>Ardian Rahardiansyah</b>
                    <p>Duis aute irure dolor in reprehenderit in voluptate velit ess</p>
                    <div class="time">16 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-avatar">
                    <img alt="image" src="../../../old/assets/img/avatar/avatar-5.png" class="rounded-circle">
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
            <img alt="image" src="../../../old/assets/img/avatar/avatar-3.png" class="rounded-circle mr-1">
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
            <h1>ลงทะเบียนเสนอโครงการวิจัย <br><small>(Research registration)</small> </h1>
          </div>

          <div class="section-body">
              <div class="row">
                <div class="col-12">
                  <div class="row">
                    <div class="col-12 col-sm-3">
                      <div class="list-group" id="list-tab" role="tablist">
                        <!-- <a class="list-group-item list-group-item-action active bdn" id="list-home-list" data-toggle="list" href="#list-home" role="tab">Home</a> -->
                        <a class="list-group-item list-group-item-action flex-column align-items-start active bdn" id="list-part1-list" data-toggle="list" href="#list-part1" role="tab">
                          <p class="mb-1">ส่วนที่ 1 : </p>
                          <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">ข้อมูลโครงการวิจัย</h6>
                            <span id="badge1" class="badge badge-danger text-white badge-pill dn" style="padding: 10px 9px; margin-top: -3px;"><i class="fas fa-check" style="margin-left: 2px;"></i></span>
                          </div>
                        </a>
                        <a class="list-group-item dn list-group-item-action flex-column bdn" id="list-part2-list" data-toggle="list" href="#list-part2" role="tab" onclick="project.check_current_project()">
                          <p class="mb-1">ส่วนที่ 2 : </p>
                          <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">ข้อมูลผู้ร่วมวิจัย</h6>
                            <span  id="badge2" class="badge badge-danger text-white badge-pill dn" style="padding: 10px 9px; margin-top: -3px;"><i class="fas fa-check" style="margin-left: 2px;"></i></span>
                          </div>
                        </a>
                        <a class="list-group-item dn list-group-item-action flex-column bdn" id="list-part3-list" data-toggle="list" href="#list-part3" role="tab" onclick="project.check_current_project()">
                          <p class="mb-1">ส่วนที่ 3 : </p>
                          <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">ทุนวิจัย</h6>
                            <span id="badge3" class="badge badge-danger text-white badge-pill dn" style="padding: 10px 9px; margin-top: -3px;"><i class="fas fa-check" style="margin-left: 2px;"></i></span>
                          </div>
                        </a>
                        <a class="list-group-item dn  list-group-item-action flex-column bdn" id="list-part4-list" data-toggle="list" href="#list-part4" role="tab" onclick="project.check_current_project()">
                          <p class="mb-1">ส่วนที่ 4 : </p>
                          <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">สรุปย่อโครงการวิจัย</h6>
                            <span id="badge4" class="badge badge-danger text-white badge-pill dn" style="padding: 10px 9px; margin-top: -3px;"><i class="fas fa-check" style="margin-left: 2px;"></i></span>
                          </div>
                        </a>
                        <a class="list-group-item dn list-group-item-action flex-column bdn" id="list-part5-list" data-toggle="list" href="#list-part5" role="tab" onclick="project.check_current_project(); showAdvice()">
                          <p class="mb-1">ส่วนที่ 5 : </p>
                          <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">อัพโหลดไฟล์เอกสาร</h6>
                            <span id="badge5" class="badge badge-danger text-white badge-pill dn" style="padding: 10px 9px; margin-top: -3px;"><i class="fas fa-check" style="margin-left: 2px;"></i></span>
                          </div>
                        </a>
                      </div>
                    </div>
                    <div class="col-12 col-sm-9">

                      <div class="alert alert-danger alert-dismissible show fade">
                        <div class="alert-body">
                          <button class="close" data-dismiss="alert">
                            <span>&times;</span>
                          </button>
                          กรุณากรอกข้อมูลให้ครบถ้วน โดยเฉพาะส่วนที่มีเครื่องหมาย **
                        </div>
                      </div>

                      <div class="alert alert-danger alert-dismissible show fade" id="hint_p1">
                        <div class="alert-body">
                          <button class="close" data-dismiss="alert">
                            <span>&times;</span>
                          </button>
                          กรุณาเพิ่มข้อมูลส่วนที่ 1 ให้ครบถ้านก่อน จึงจะสามารถกรอกข้อมูลส่วนอื่น ๆ ได้
                        </div>
                      </div>

                      <div class="alert alert-danger alert-dismissible show fade">
                        <div class="alert-body">
                          <button class="close" data-dismiss="alert">
                            <span>&times;</span>
                          </button>
                          กรุณากรอกข้อมูลให้ครบถ้วนทุกส่วน (ทางซ้ายมือ) จนกว่าจะมีเครื่องหมาย <i class="fas fa-check-circle"></i> แสดงในแต่ละส่วนจนครบ
                        </div>
                      </div>

                      <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active pt-0" id="list-part1" role="tabpanel" aria-labelledby="list-part1-list">
                          <div class="card">
                            <div class="card-header" style="background: rgb(73, 82, 88);">
                              <h4 class="text-white">ส่วนที่ 1 : ข้อมูลโครงการวิจัย</h4>
                            </div>
                            <div class="card-body">
                              <div class="row">
                                <div class="col-12 col-sm-4">
                                  <label for="">ชื่อโครงการวิจัย <span class="text-danger">*</span><br> <small>(ภาษาไทย)</small> </label>
                                </div>
                                <div class="col-12 col-sm-8">
                                  <div class="form-group">
                                    <textarea name="txtTitle_th" id="txtTitle_th" style="height: 120px !important;" rows="8" cols="80" class="form-control" ></textarea>
                                    <div style="font-size: 0.9em;" class="text-muted"><u>Note</u> : Enter - if this project no have title in Thai language.</div>
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-12 col-sm-4">
                                  <label for="">Project title <span class="text-danger">*</span><br> <small>(English)</small> </label>
                                </div>
                                <div class="col-12 col-sm-8">
                                  <div class="form-group">
                                    <textarea name="txtTitle_en" id="txtTitle_en" style="height: 120px !important;" rows="8" cols="80" class="form-control"></textarea>
                                    <div style="font-size: 0.9em;" class="text-muted"><u>Note</u> : Enter project title in English.</div>
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-12 col-sm-4">
                                  <label for="">คำสำคัญ <span class="text-danger">*</span><br> <small>(ภาษาไทย)</small> </label>
                                </div>
                                <div class="col-12 col-sm-8">
                                  <div class="form-group">
                                    <textarea name="txtKeyword_th" id="txtKeyword_th" rows="8" cols="80" class="form-control"></textarea>
                                    <div style="font-size: 0.9em;" class="text-muted"><u>Note</u> : กรอกคำสำคัญ 2 - 5 คำ (ภาษาไทย) โดยแต่ละคำให้คั่วด้วยเครื่องหมายคอมม่า (,) เช่น คำที่ 1, คำที่ 2, คำที่ 3 | Enter (-) if this project no keywords in Thai. </div>
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-12 col-sm-4">
                                  <label for="">Keywords <span class="text-danger">*</span><br> <small>(English)</small> </label>
                                </div>
                                <div class="col-12 col-sm-8">
                                  <div class="form-group">
                                    <textarea name="txtKeyword_en" id="txtKeyword_en" rows="8" cols="80" class="form-control"></textarea>
                                    <div style="font-size: 0.9em;" class="text-muted"><u>Note</u> : Enter 2 - 5 keywors and each word separated by comma (,) for example: keyword1, keyword2, keyword3</div>
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-12 col-sm-4">
                                    <label for="">ประเภทของการวิจัย <br><small>Type of research</small> <span class="text-danger">*</span></label>
                                </div>
                                <div class="col-12 col-sm-8">
                                  <div class="form-group">
                                    <select class="form-control" name="txtResearchtype" id="txtResearchtype">
                                      <option value=""> -- เลือกประเภทการวิจัย --</option>
                                      <?php
                                      $strSQL = "SELECT * FROM type_research WHERE 1 ORDER BY rt_seq";
                                      $resultRT = mysqli_query($conn, $strSQL);
                                      if($resultRT){
                                        while($r = mysqli_fetch_array($resultRT)){
                                          ?>
                                          <option value="<?php echo $r['id_type'];?>"><?php echo $r['type_name'];?></option>
                                          <?php
                                        }
                                      }
                                      ?>
                                    </select>
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-12 col-sm-4">
                                    <label for="">วันที่คาดว่าจะดำเนินโครงการ <br><small>Estimate date to start and finish project</small> <span class="text-danger">*</span></label>
                                </div>
                                <div class="col-12 col-sm-8">
                                  <div class="form-group">
                                    <input type="text" name="txtStartdate" id="txtStartdate"  class="form-control datepicker">
                                  </div>
                                  <!-- <class="form-group">
                                    <input type="text" name="txtStartdateRange" id="txtStartdateRange"  class="form-control datepicker" readonly>
                                  </div> -->
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-12 col-sm-4">
                                    <label for="">วันที่คาดว่าโครงการสิ้นสุด <br><small>Estimate date that project will be finish</small> <span class="text-danger">*</span></label>
                                </div>
                                <div class="col-12 col-sm-8">
                                  <div class="form-group">
                                    <input type="text" name="txtFinishdate" id="txtFinishdate"  class="form-control datepicker" >
                                  </div>
                                </div>
                              </div>

                            </div>
                            <div class="card-body">
                              <div class="" style="padding: 20px; background: rgb(242, 242, 242);">
                                <h6 class="text-dark">ส่วนแสดงความครบถ้วนของการกรอกข้อมูล (Remark area)</h6>
                                <hr>
                                <div class="remarkArea">
                                  <div class="text-center">
                                      ไม่มีข้อมูลการแจ้งเตือนของโครงการนี้
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- <div class="card-footer text-right">
                              <button type="button" class="btn btn-primary bsdn" onclick="saveDraft(1)">บันทึกแบบร่าง</button>
                            </div> -->
                          </div>
                          <!-- .card  -->

                          <div class="row">
                            <div class="col-sm-12 text-right">
                              <button type="button" class="btn btn-primary bsdn float-left" onclick="saveDraft()">ตรวจสอบความครบถ้วนอีกครั้ง</button>
                              <button type="button" class="btn btn-primary bsdn" onclick="saveDraft(1)">บันทึกแบบร่าง</button>
                              <button type="button" class="btn btn-danger bsdn dn btnFinal" onclick="project.saveFinal()">บันทึก</button>
                            </div>
                          </div>
                        </div>

                        <div class="tab-pane fade pt-0" id="list-part2" role="tabpanel" aria-labelledby="list-part2-list">
                          <div class="card">
                            <div class="card-header" style="background: rgb(73, 82, 88);">
                              <h4 class="text-white">ส่วนที่ 2 : ข้อมูลผู้ร่วมวิจัย</h4>
                            </div>
                            <div class="card-body">
                              <div class="row">
                                <div class="col-12 col-sm-4">
                                    <label for="">โครงการนี้ หัวหน้าโครงการเป็นนักศึกษา<span class="text-danger">ที่ไม่มีรหัสบุคลากรคณะแพทยศาสตร์ มอ.</span>ใช่หรือไม่? <span class="text-danger">*</span></label>
                                </div>
                                <div class="col-12 col-sm-8">
                                  <div class="form-group">
                                    <select class="form-control" name="txtIsadvice" id="txtIsadvice">
                                      <option value="1" selected> 1. ไม่ใช่</option>
                                      <option value="2"> 2. ใช่ (อาจารย์ที่ปรึกษาเป็นผู้ลงข้อมูลแทนนักศึกษา)</option>
                                    </select>
                                  </div>
                                </div>
                              </div>

                              <div class="row dn">
                                <div class="col-12 col-sm-4">
                                    <label for="">สัดส่วนการวิจัยของหัวหน้าโครงการ (%) <span class="text-danger">*</span></label>
                                </div>
                                <div class="col-12 col-sm-8 ">
                                  <div class="form-group">
                                    <input type="number" name="txtRatepm" id="txtRatepm" value="100" class="form-control" readonly>
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-12 col-sm-4">
                                    <label for="">หน้าที่/ความรับผิดชอบของหัวหน้าโครงการ <span class="text-danger">*</span></label>
                                </div>
                                <div class="col-12 col-sm-8">
                                  <div class="form-group">
                                    <input type="text" name="txtPiresponse" id="txtPiresponse" class="form-control" >
                                    <div style="font-size: 0.9em;" class="text-muted"><u>Note</u> : กรอกหน้าที่ ความรับผิดชอบของหัวหน้าโครงการ.</div>
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-12">
                                  <h6>รายชื่อผู้ร่วมวิจัย</h6>
                                  <div class="text-danger p-3" style="border: dashed; border-width: 1px 1px 1px 1px; border-color: rgb(240, 134, 134); background: rgb(245, 244, 244); font-size: 0.8em; ">
                                    ** ให้เขียนชื่อของผู้มีส่วนเกี่ยวข้องกับขั้นตอนการดำเนินการวิจัยทุกคน (รวมถึงผู้ช่วยวิจัย ผู้ขอความยินยอม)
                                    รายชื่อในระบบนี้ไม่จำเป็นต้องตรงกับรายนามของผู้นิพนธ์
                                  </div>
                                  <table class="table table-striped mt-2">
                                    <thead>
                                      <tr class="bg-primary">
                                        <th class="text-white" style="width: 100px;">ลำดับที่</th>
                                        <th class="text-white">ชื่อ - นามสกุล</th>
                                        <th class="text-white" style="width: 200px;">หน้าที่</th>
                                        <th class="text-white" style="width: 150px;"></th>
                                      </tr>
                                    </thead>
                                    <tbody id="copi_list">
                                      <tr><td colspan="4" class="text-center">ไม่พบข้อมูลผู้ร่วมวิจัย</td></tr>
                                    </tbody>
                                  </table>
                                </div>
                                <div class="col-12 pt-2 pb-2 text-center">
                                  <button type="button" class="btn btn-primary bsdn"  data-toggle="modal" data-target="#researchteamModal" id="copiBtn"><i class="fas fa-plus"></i> คลิกที่นี่เพื่อเพิ่มผู้ร่วมวิจัย</button>
                                </div>
                              </div>



                            </div>
                            <div class="card-body">
                              <div class="" style="padding: 20px; background: rgb(242, 242, 242);">
                                <h6 class="text-dark">ส่วนแสดงความครบถ้วนของการกรอกข้อมูล (Remark area)</h6>
                                <hr>
                                <div class="remarkArea">
                                  <div class="text-center">
                                      ไม่มีข้อมูลการแจ้งเตือนของโครงการนี้
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- <div class="card-footer text-right">
                              <button type="button" class="btn btn-primary bsdn" onclick="saveDraft(1)">บันทึกแบบร่าง</button>
                            </div> -->
                          </div>
                          <!-- .card  -->
                          <div class="row">
                            <div class="col-sm-12 text-right">
                              <button type="button" class="btn btn-primary bsdn float-left" onclick="saveDraft()">ตรวจสอบความครบถ้วนอีกครั้ง</button>
                              <button type="button" class="btn btn-primary bsdn" onclick="saveDraft(1)">บันทึกแบบร่าง</button>
                              <button type="button" class="btn btn-danger bsdn dn btnFinal" onclick="project.saveFinal()">บันทึก</button>
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane fade pt-0" id="list-part3" role="tabpanel" aria-labelledby="list-part3-list">
                          <div class="card">
                            <div class="card-header" style="background: rgb(73, 82, 88);">
                              <h4 class="text-white">ส่วนที่ 3 : ทุนวิจัย</h4>
                            </div>
                            <div class="card-body">
                              <div class="row">
                                <div class="col-12 col-sm-4">
                                    <label for="">โครงการนี้ <span class="text-danger">มีแหล่งทุนวิจัยหรือไม่?</span> <span class="text-danger">*</span></label>
                                </div>
                                <div class="col-12 col-sm-8">
                                  <div class="form-group">
                                    <select class="form-control" name="txtFundexist" id="txtFundexist">
                                      <option value="1" selected>มีแหล่งทุน</option>
                                      <option value="0">ไม่มีแหล่งทุน</option>
                                    </select>
                                  </div>
                                </div>
                              </div>

                              <div class="fundingInfo">
                                <div class="row">
                                  <div class="col-12 col-sm-4">
                                      <label for="">แหล่งทุนวิจัย <span class="text-danger">*</span></label>
                                      <div style="font-size: 0.9em;" class="text-muted"><u>Note</u> : หากมีงบประมาณในแหล่งทุนใด ให้ระบุจำนวนเงิน โดยให้ใส่เพียงตัวเลขเท่านั้น (ไม่ต้องใส่ ,)</div>
                                  </div>
                                  <div class="col-12 col-sm-8">
                                    <div class="">
                                      <div class="row">
                                        <div class="col-12">
                                          <div class="form-group mb-2">
                                            <label class="custom-switch mt-0 pl-0">
                                              <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" id="cb1">
                                              <span class="custom-switch-indicator"></span>
                                              <span class="custom-switch-description ml-3" style="font-size: 1.2em;">ทุนวิจัยคณะแพทยศาสตร์</span>
                                            </label>
                                            <div class="form-group mb-2 dn" id="cb1_info">
                                              <input type="number" name="" value="0" min="0" class="form-control fundBuget" id="txtFunding1">
                                            </div>
                                          </div>

                                          <div class="form-group mb-2">
                                            <label class="custom-switch mt-0 pl-0">
                                              <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" id="cb2">
                                              <span class="custom-switch-indicator"></span>
                                              <span class="custom-switch-description ml-3" style="font-size: 1.2em;">ทุนงบประมาณแผ่นดิน</span>
                                            </label>
                                            <div class="form-group mb-2 dn" id="cb2_info">
                                              <input type="number" name="" value="0" min="0" class="form-control fundBuget" id="txtFunding2">
                                            </div>
                                          </div>

                                          <div class="form-group mb-2">
                                            <label class="custom-switch mt-0 pl-0">
                                              <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" id="cb7">
                                              <span class="custom-switch-indicator"></span>
                                              <span class="custom-switch-description ml-3" style="font-size: 1.2em;">ทุนภาคเอกชน (Industry sponsored trial)</span>
                                            </label>
                                            <div class="dn" id="cb7_info">
                                              <div class="form-group mb-1">
                                                <input type="number" name="" value="0" min="0" class="form-control fundBuget"  id="txtFunding7">
                                              </div>
                                              <div class="form-group mb-2" >
                                                <input type="text" name="" value="" class="form-control" placeholder="เลขที่โครงการ (Protocol No.)"  id="txtFunding7_info">
                                              </div>
                                            </div>
                                          </div>

                                          <div class="form-group mb-2">
                                            <label class="custom-switch mt-0 pl-0">
                                              <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" id="cb3">
                                              <span class="custom-switch-indicator"></span>
                                              <span class="custom-switch-description ml-3" style="font-size: 1.2em;">ทุนรายได้มหาวิทยาลัยสงขลานครินทร์ <br><span class="text-danger">** เช่น ทุนพัฒนานักวิจัย</span></span>
                                            </label>
                                            <div class="form-group mb-2 dn" id="cb3_info">
                                              <input type="number" name="" value="0" min="0" class="form-control fundBuget" id="txtFunding3">
                                            </div>
                                          </div>

                                          <div class="form-group mb-2">
                                            <label class="custom-switch mt-0 pl-0">
                                              <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" id="cb4">
                                              <span class="custom-switch-indicator"></span>
                                              <span class="custom-switch-description ml-3" style="font-size: 1.2em;">ทุนอื่น ๆ ภายในประเทศ <br><span class="text-danger">** เช่น สกว, สสส, สวทช, ทุนวิจัยคณะอื่น ๆ ฯลฯ</span></span>
                                            </label>
                                            <div class="form-group mb-2 dn" id="cb4_info">
                                              <input type="number" name="" value="0" min="0" class="form-control fundBuget" id="txtFunding4">
                                            </div>
                                          </div>

                                          <div class="form-group mb-4">
                                            <label class="custom-switch mt-0 pl-0">
                                              <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" id="cb5">
                                              <span class="custom-switch-indicator"></span>
                                              <span class="custom-switch-description ml-3" style="font-size: 1.2em;">ทุนอื่น ๆ ภายนอกประเทศ <br><span class="text-danger">** เช่น NIH, WHO, EU ฯลฯ</span> </span>
                                            </label>
                                            <div class="form-group mb-2 dn" id="cb5_info">
                                              <input type="number" name="" value="0" min="0" class="form-control fundBuget" id="txtFunding5">
                                            </div>
                                          </div>

                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-12 col-sm-4">
                                    <label for="">ชื่อแหล่งทุนวิจัย <span class="text-danger">*</span></label>
                                  </div>
                                  <div class="col-12 col-sm-8">
                                    <div class="form-group">
                                      <textarea name="txtFundingsource" id="txtFundingsource" rows="8" cols="80" class="form-control"></textarea>
                                      <div style="font-size: 0.9em;" class="text-muted"><u>Note</u> : กรอกชื่อแหล่งทุนวิจัย โดยแต่ละทุนให้คั่นด้วยเครื่องหมายคอมม่า (,)</div>
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-12 col-sm-4">
                                      <label for="">งบประมาณทั้งโครงการ <span class="text-danger">*</span><br> <small>(บาท)</small> </label>
                                  </div>
                                  <div class="col-12 col-sm-8">
                                    <div class="form-group">
                                      <input type="number" name="txtBudget" min="0" id="txtBudget" value="0" class="form-control" readonly>
                                    </div>
                                  </div>
                                </div>
                              </div>




                            </div>
                            <div class="card-body">
                              <div class="" style="padding: 20px; background: rgb(242, 242, 242);">
                                <h6 class="text-dark">ส่วนแสดงความครบถ้วนของการกรอกข้อมูล (Remark area)</h6>
                                <hr>
                                <div class="remarkArea">
                                  <div class="text-center">
                                      ไม่มีข้อมูลการแจ้งเตือนของโครงการนี้
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- <div class="card-footer text-right">
                              <button type="button" class="btn btn-primary bsdn" onclick="saveDraft(1)">บันทึกแบบร่าง</button>
                            </div> -->
                          </div>
                          <!-- .card  -->

                          <div class="row">
                            <div class="col-sm-12 text-right">
                              <button type="button" class="btn btn-primary bsdn float-left" onclick="saveDraft()">ตรวจสอบความครบถ้วนอีกครั้ง</button>
                              <button type="button" class="btn btn-primary bsdn" onclick="saveDraft(1)">บันทึกแบบร่าง</button>
                              <button type="button" class="btn btn-danger bsdn dn btnFinal" onclick="project.saveFinal()">บันทึก</button>
                            </div>
                          </div>

                        </div>

                        <div class="tab-pane fade pt-0" id="list-part4" role="tabpanel" aria-labelledby="list-part4-list">
                          <div class="card">
                            <div class="card-header" style="background: rgb(73, 82, 88);">
                              <h4 class="text-white">ส่วนที่ 4 : สรุปย่อโครงการวิจัย (Synopsis) โดยความยาวไม่เกิน 500 คำ</h4>
                            </div>
                            <div class="card-body p-0">
                              <div class="form-group">
                                <textarea name="brief_reports" id="brief_reports" rows="8" cols="80" class="form-control"></textarea>
                              </div>
                            </div>
                            <div class="card-body">
                              <div class="" style="padding: 20px; background: rgb(242, 242, 242);">
                                <h6 class="text-dark">ส่วนแสดงความครบถ้วนของการกรอกข้อมูล (Remark area)</h6>
                                <hr>
                                <div class="remarkArea">
                                  <div class="text-center">
                                      ไม่มีข้อมูลการแจ้งเตือนของโครงการนี้
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- <div class="card-footer text-right">
                              <button type="button" class="btn btn-primary bsdn" onclick="saveDraft(1)">บันทึกแบบร่าง</button>
                            </div> -->
                          </div>
                          <!-- .card  -->
                          <div class="row">
                            <div class="col-sm-12 text-right">
                              <button type="button" class="btn btn-primary bsdn float-left" onclick="saveDraft()">ตรวจสอบความครบถ้วนอีกครั้ง</button>
                              <button type="button" class="btn btn-primary bsdn" onclick="saveDraft(1)">บันทึกแบบร่าง</button>
                              <button type="button" class="btn btn-danger bsdn dn btnFinal" onclick="project.saveFinal()">บันทึก</button>
                            </div>
                          </div>
                        </div>

                        <div class="tab-pane fade pt-0" id="list-part5" role="tabpanel" aria-labelledby="list-part5-list">
                          <h4 class="text-dark mt-4">ส่วนที่ 5 : อัพโหลดไฟล์เอกสารโครงการวิจัย</h4>
                          <label for="" class="text-dark">กลุ่มที่ 1 : Submission form <span class="text-danger">**</span><br><span class="text-danger">(ต้องเป็น scanned file ที่มีลายเซ็นและเลขที่หนังสือจากหน่วยงานต้นสังกัดครบถ้วน)</span></label>
                          <div class="card">
                            <div class="card-body p-0">
                              <table class="table table-striped table-sm- table-bordered- mb-0">
                                <thead>
                                  <tr class="bg-primary">
                                    <th class="text-white">ไฟล์ที่อัพโหลด</th>
                                    <th class="text-white" style="width: 20%;">สถานะ</th>
                                  </tr>
                                </thead>
                                <tbody id="file_path_1">
                                  <tr>
                                    <td colspan="2" class="text-center">ไม่พบรายการไฟล์ที่อัพโหลด</td>
                                  </tr>
                                </tbody>
                                <tbody>
                                  <tr>
                                    <td colspan="2" class="text-center"><a href="Javascript:setFilesection(1)" class="btn btn-secondary btn-sm text-dark bsdn"><i class="fas fa-upload"></i> Click ที่นี่ เพื่ออัพโหลดไฟล์กลุ่มที่ 1</a></td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                          <!-- .card  -->

                          <label for="" class="text-dark">กลุ่มที่ 2 : Protocol <span class="text-danger">**</span></label>
                          <div class="card">
                            <div class="card-body p-0">
                              <table class="table table-striped table-sm- table-bordered- mb-0">
                                <thead>
                                  <tr class="bg-primary">
                                    <th class="text-white">ไฟล์ที่อัพโหลด</th>
                                    <th class="text-white" style="width: 20%;">สถานะ</th>
                                  </tr>
                                </thead>
                                <tbody id="file_path_2">
                                  <tr>
                                    <td colspan="2" class="text-center">ไม่พบรายการไฟล์ที่อัพโหลด</td>
                                  </tr>
                                </tbody>
                                <tbody>
                                  <tr>
                                    <td colspan="2" class="text-center"><a href="Javascript:setFilesection(2)" class="btn btn-secondary btn-sm text-dark bsdn"><i class="fas fa-upload"></i> Click ที่นี่ เพื่ออัพโหลดไฟล์กลุ่มที่ 2</a></td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>

                          <label for="" class="text-dark">กลุ่มที่ 3 : Information sheet and Consent form<br><span style="color: rgb(61, 61, 61);">(เอกสารชี้แจงและขอความยินยอม หรือเอกสารขอยกเว้นการขอความยินยอมจากอาสาสมัคร)</span>
                            <br><span class="text-danger">หากเป็นภาษาไทยต้องแนบไฟล์ word (.doc, .docx) ด้วย</span></label>
                          <div class="card">
                            <div class="card-body p-0">
                              <table class="table table-striped table-sm- table-bordered- mb-0">
                                <thead>
                                  <tr class="bg-primary">
                                    <th class="text-white">ไฟล์ที่อัพโหลด</th>
                                    <th class="text-white" style="width: 20%;">สถานะ</th>
                                  </tr>
                                </thead>
                                <tbody id="file_path_3">
                                  <tr>
                                    <td colspan="2" class="text-center">ไม่พบรายการไฟล์ที่อัพโหลด</td>
                                  </tr>
                                </tbody>
                                <tbody>
                                  <tr>
                                    <td colspan="2" class="text-center"><a href="Javascript:setFilesection(3)" class="btn btn-secondary btn-sm text-dark bsdn"><i class="fas fa-upload"></i> Click ที่นี่ เพื่ออัพโหลดไฟล์กลุ่มที่ 3</a></td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>

                          <label for="" class="text-dark">กลุ่มที่ 4 : Case record form<br><span  style="color: rgb(61, 61, 61);">เช่น แบบบันทึกข้อมูล แบบสอบถาม</span></label>
                          <div class="card">
                            <div class="card-body p-0">
                              <table class="table table-striped table-sm- table-bordered- mb-0">
                                <thead>
                                  <tr class="bg-primary">
                                    <th class="text-white">ไฟล์ที่อัพโหลด</th>
                                    <th class="text-white" style="width: 20%;">สถานะ</th>
                                  </tr>
                                </thead>
                                <tbody id="file_path_4">
                                  <tr>
                                    <td colspan="2" class="text-center">ไม่พบรายการไฟล์ที่อัพโหลด</td>
                                  </tr>
                                </tbody>
                                <tbody>
                                  <tr>
                                    <td colspan="2" class="text-center"><a href="Javascript:setFilesection(4)" class="btn btn-secondary btn-sm text-dark bsdn"><i class="fas fa-upload"></i> Click ที่นี่ เพื่ออัพโหลดไฟล์กลุ่มที่ 4</a></td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>

                          <label for="" class="text-dark">กลุ่มที่ 5 : Subject material <br><span  style="color: rgb(61, 61, 61);">เช่น ใบประชาสัมพันธ์ Telephone script คู่มืออาสาสมัคร</span> </label>
                          <div class="card">
                            <div class="card-body p-0">
                              <table class="table table-striped table-sm- table-bordered- mb-0">
                                <thead>
                                  <tr class="bg-primary">
                                    <th class="text-white">ไฟล์ที่อัพโหลด</th>
                                    <th class="text-white" style="width: 20%;">สถานะ</th>
                                  </tr>
                                </thead>
                                <tbody id="file_path_5">
                                  <tr>
                                    <td colspan="2" class="text-center">ไม่พบรายการไฟล์ที่อัพโหลด</td>
                                  </tr>
                                </tbody>
                                <tbody>
                                  <tr>
                                    <td colspan="2" class="text-center"><a href="Javascript:setFilesection(5)" class="btn btn-secondary btn-sm text-dark bsdn"><i class="fas fa-upload"></i> Click ที่นี่ เพื่ออัพโหลดไฟล์กลุ่มที่ 5</a></td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>

                          <label for="" class="text-dark">กลุ่มที่ 6 : Legal document<br><span  style="color: rgb(61, 61, 61);">เอกสารทางกฏหมาย เช่น MTA, CTA, Insurance</span> </label>
                          <div class="card">
                            <div class="card-body p-0">
                              <table class="table table-striped table-sm- table-bordered- mb-0">
                                <thead>
                                  <tr class="bg-primary">
                                    <th class="text-white">ไฟล์ที่อัพโหลด</th>
                                    <th class="text-white" style="width: 20%;">สถานะ</th>
                                  </tr>
                                </thead>
                                <tbody id="file_path_6">
                                  <tr>
                                    <td colspan="2" class="text-center">ไม่พบรายการไฟล์ที่อัพโหลด</td>
                                  </tr>
                                </tbody>
                                <tbody>
                                  <tr>
                                    <td colspan="2" class="text-center"><a href="Javascript:setFilesection(6)" class="btn btn-secondary btn-sm text-dark bsdn"><i class="fas fa-upload"></i> Click ที่นี่ เพื่ออัพโหลดไฟล์กลุ่มที่ 6</a></td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>

                          <label for="" class="text-dark">กลุ่มที่ 7 : เอกสารประกอบอื่น ๆ<br><span style="color: rgb(61, 61, 61);">เช่น Investigator's Brochure, Data agreement</span><br><small class="text-danger">เฉพาะโครงการ Sponsor ให้แนบไฟล์ตาราง Budget เป็น Excel (.xls)</small></label>
                          <div class="card">
                            <div class="card-body p-0">
                              <table class="table table-striped table-sm- table-bordered- mb-0">
                                <thead>
                                  <tr class="bg-primary">
                                    <th class="text-white">ไฟล์ที่อัพโหลด</th>
                                    <th class="text-white" style="width: 20%;">สถานะ</th>
                                  </tr>
                                </thead>
                                <tbody id="file_path_7">
                                  <tr>
                                    <td colspan="2" class="text-center">ไม่พบรายการไฟล์ที่อัพโหลด</td>
                                  </tr>
                                </tbody>
                                <tbody>
                                  <tr>
                                    <td colspan="2" class="text-center"><a href="Javascript:setFilesection(7)" class="btn btn-secondary btn-sm text-dark bsdn"><i class="fas fa-upload"></i> Click ที่นี่ เพื่ออัพโหลดไฟล์กลุ่มที่ 7</a></td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>

                          <label for="" class="text-dark">กลุ่มที่ 8 : Updated CV, หลักฐานการอบรมจริยธรรมการวิจัยในมนุษย์ <span class="text-danger">**</span><br><span  style="color: rgb(61, 61, 61);">(GCP/Human subject protection course)</span></label>
                          <div class="card">
                            <div class="card-body p-0">
                              <table class="table table-striped table-sm- table-bordered- mb-0">
                                <thead>
                                  <tr class="bg-primary">
                                    <th class="text-white">ไฟล์ที่อัพโหลด</th>
                                    <th class="text-white" style="width: 20%;">สถานะ</th>
                                  </tr>
                                </thead>
                                <tbody id="file_path_8">
                                  <tr>
                                    <td colspan="2" class="text-center">ไม่พบรายการไฟล์ที่อัพโหลด</td>
                                  </tr>
                                </tbody>
                                <tbody>
                                  <tr>
                                    <td colspan="2" class="text-center"><a href="Javascript:setFilesection(8)" class="btn btn-secondary btn-sm text-dark bsdn"><i class="fas fa-upload"></i> Click ที่นี่ เพื่ออัพโหลดไฟล์กลุ่มที่ 8</a></td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>

                          <label for="" class="text-dark">กลุ่มที่ 9 : ใบนำส่งเงินค่าธรรมเนียม</label>
                          <div class="card">
                            <div class="card-body p-0">
                              <table class="table table-striped table-sm- table-bordered- mb-0">
                                <thead>
                                  <tr class="bg-primary">
                                    <th class="text-white">ไฟล์ที่อัพโหลด</th>
                                    <th class="text-white" style="width: 20%;">สถานะ</th>
                                  </tr>
                                </thead>
                                <tbody id="file_path_9">
                                  <tr>
                                    <td colspan="2" class="text-center">ไม่พบรายการไฟล์ที่อัพโหลด</td>
                                  </tr>
                                </tbody>
                                <tbody>
                                  <tr>
                                    <td colspan="2" class="text-center"><a href="Javascript:setFilesection(9)" class="btn btn-secondary btn-sm text-dark bsdn"><i class="fas fa-upload"></i> Click ที่นี่ เพื่ออัพโหลดไฟล์กลุ่มที่ 9</a></td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>

                          <label for="" class="text-dark">กลุ่มที่ 10 : ไฟล์อื่น ๆ (เฉพาะโครงการที่ลงทะเบียนก่อน 1 ม.ค. 61)</label>
                          <div class="card" style="border:none;">
                            <div class="card-body p-0" style="border:none;">
                              <table class="table table-striped table-sm- table-bordered- mb-0">
                                <thead>
                                  <tr class="bg-primary">
                                    <th class="text-white">ไฟล์ที่อัพโหลด</th>
                                    <th class="text-white" style="width: 20%;">สถานะ</th>
                                  </tr>
                                </thead>
                                <tbody id="file_path_10">
                                  <tr>
                                    <td colspan="2" class="text-center">ไม่พบรายการไฟล์ที่อัพโหลด</td>
                                  </tr>
                                </tbody>
                                <tbody>
                                  <tr>
                                    <td colspan="2" class="text-center"><a href="Javascript:setFilesection(10)" class="btn btn-secondary btn-sm text-dark bsdn"><i class="fas fa-upload"></i> Click ที่นี่ เพื่ออัพโหลดไฟล์กลุ่มที่ 10</a></td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>

                          <div class="card">
                            <div class="card-body">
                              <div class="" style="padding: 20px; background: rgb(242, 242, 242);">
                                <h6 class="text-dark">ส่วนแสดงความครบถ้วนของการกรอกข้อมูล (Remark area)</h6>
                                <hr>
                                <div class="remarkArea">
                                  <div class="text-center">
                                      ไม่มีข้อมูลการแจ้งเตือนของโครงการนี้
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-sm-12 text-right">
                              <button type="button" class="btn btn-primary bsdn float-left" onclick="saveDraft()">ตรวจสอบความครบถ้วนอีกครั้ง</button>
                              <button type="button" class="btn btn-primary bsdn" onclick="saveDraft(1)">บันทึกแบบร่าง</button>
                              <button type="button" class="btn btn-danger bsdn dn btnFinal" onclick="project.saveFinal()">บันทึก</button>
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

  <!-- Modal -->
  <div class="modal fade" id="fileUploadModal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title text-white pb-3" id="exampleModalLabel">อัพโหลดไฟล์งานวิจัย : Submission form</h5>
          <button type="button" class="close text-white btnCloseModal" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="dropzone" id="mydropzone_1">
            <div class="fallback">
              <input name="file" type="file" multiple />
            </div>
            <input type="text" name="txtUploadIdrs_1" id="txtUploadIdrs_1" class="txtUploadIdrs dn">
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="fileUploadModal_2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title text-white pb-3" id="exampleModalLabel">อัพโหลดไฟล์งานวิจัย : Protocol</h5>
          <button type="button" class="close text-white btnCloseModal" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="dropzone" id="mydropzone_2">
            <div class="fallback">
              <input name="file" type="file" multiple />
            </div>
            <input type="text" name="txtUploadIdrs_2" class="txtUploadIdrs dn" value="">
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="fileUploadModal_3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title text-white pb-3" id="exampleModalLabel">อัพโหลดไฟล์งานวิจัย : Information sheet and Consent form</h5>
          <button type="button" class="close text-white btnCloseModal" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="dropzone" id="mydropzone_3">
            <div class="fallback">
              <input name="file" type="file" multiple />
            </div>
            <input type="text" name="txtUploadIdrs_3" class="txtUploadIdrs dn" value="">
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="fileUploadModal_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title text-white pb-3" id="exampleModalLabel">อัพโหลดไฟล์งานวิจัย : Case record form</h5>
          <button type="button" class="close text-white btnCloseModal" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="dropzone" id="mydropzone_4">
            <div class="fallback">
              <input name="file" type="file" multiple />
            </div>
            <input type="text" name="txtUploadIdrs_4" class="txtUploadIdrs dn" value="">
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="fileUploadModal_5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title text-white pb-3" id="exampleModalLabel">อัพโหลดไฟล์งานวิจัย : Subject material</h5>
          <button type="button" class="close text-white btnCloseModal" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="dropzone" id="mydropzone_5">
            <div class="fallback">
              <input name="file" type="file" multiple />
            </div>
            <input type="text" name="txtUploadIdrs_5" class="txtUploadIdrs dn" value="">
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="fileUploadModal_6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title text-white pb-3" id="exampleModalLabel">อัพโหลดไฟล์งานวิจัย : Legal document</h5>
          <button type="button" class="close text-white btnCloseModal" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="dropzone" id="mydropzone_6">
            <div class="fallback">
              <input name="file" type="file" multiple />
            </div>
            <input type="text" name="txtUploadIdrs_6" class="txtUploadIdrs dn" value="">
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="fileUploadModal_7" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title text-white pb-3" id="exampleModalLabel">อัพโหลดไฟล์งานวิจัย : เอกสารประกอบอื่น ๆ</h5>
          <button type="button" class="close text-white btnCloseModal" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="dropzone" id="mydropzone_7">
            <div class="fallback">
              <input name="file" type="file" multiple />
            </div>
            <input type="text" name="txtUploadIdrs_7" class="txtUploadIdrs dn" value="">
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="fileUploadModal_8" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title text-white pb-3" id="exampleModalLabel">อัพโหลดไฟล์งานวิจัย : Updated CV, หลักฐานการอบรมจริยธรรมการวิจัยในมนุษย์</h5>
          <button type="button" class="close text-white btnCloseModal" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="dropzone" id="mydropzone_8">
            <div class="fallback">
              <input name="file" type="file" multiple />
            </div>
            <input type="text" name="txtUploadIdrs_8" class="txtUploadIdrs dn" value="">
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="fileUploadModal_9" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title text-white pb-3" id="exampleModalLabel">อัพโหลดไฟล์งานวิจัย : ใบนำส่งเงินค่าธรรมเนียม</h5>
          <button type="button" class="close text-white btnCloseModal" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="dropzone" id="mydropzone_9">
            <div class="fallback">
              <input name="file" type="file" multiple />
            </div>
            <input type="text" name="txtUploadIdrs_9" class="txtUploadIdrs dn" value="">
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="fileUploadModal_10" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title text-white pb-3" id="exampleModalLabel">อัพโหลดไฟล์งานวิจัย : ไฟล์อื่น ๆ (เฉพาะโครงการที่ลงทะเบียนก่อน 1 ม.ค. 61)</h5>
          <button type="button" class="close text-white btnCloseModal" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="dropzone" id="mydropzone_10">
            <div class="fallback">
              <input name="file" type="file" multiple />
            </div>
            <input type="text" name="txtUploadIdrs_10" class="txtUploadIdrs dn" value="">
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script type="text/javascript" src="../../../old/node_modules/jquery/dist/jquery.min.js" ></script>
  <script type="text/javascript" src="../../../old/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="../../../old/node_modules/popper.js/dist/umd/popper.min.js"></script>
  <script type="text/javascript" src="../../../old/node_modules/sweetalert/dist/sweetalert.min.js"></script>
  <script type="text/javascript" src="../../../old/node_modules/moment/min/moment.min.js"></script>
  <!-- <script src="../v3/vendors/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script> -->
  <script type="text/javascript" src="../../../old/node_modules/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script type="text/javascript" src="../../../old/node_modules/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
  <script type="text/javascript" src="../../../old/node_modules/ckeditor_lite/ckeditor.js"></script>
  <script type="text/javascript" src="../../../old/node_modules/preload.js/dist/js/preload.js"></script>
  <script type="text/javascript" src="../../../old/node_modules/dropzone/dist/min/dropzone.min.js"></script>
  <script src="../../../old/assets/js/stisla.js"></script>

  <!-- Template JS File -->
  <script src="../../../old/assets/js/scripts.js"></script>
  <script src="../../../old/assets/custom/js/config.js?token=<?php echo $dateu; ?>"></script>
  <script src="../../../old/assets/custom/js/authen.js?token=<?php echo $dateu; ?>"></script>
  <script src="../../../old/assets/custom/js/custom.js?token=<?php echo $dateu; ?>"></script>
  <script src="../../../old/assets/custom/js/function.js?token=<?php echo $dateu; ?>"></script>
  <script src="../../../old/assets/custom/js/pi.2.1.js?token=<?php echo $dateu; ?>"></script>
  <script src="../../../old/assets/custom/js/research_register.js?token=<?php echo $dateu; ?>"></script>

  <script>

      var pageUpdate = 0

      var dropzone_1 = new Dropzone("#mydropzone_1", {
        url: "../controller/general/upload.php?stage=register_file&uid=" + current_user + "&path=1",
        acceptedFiles: 'application/pdf',
        maxFilesize: 100,
        init: function(){
          this.on("complete", function(file) {
            this.removeFile(file);
            console.log(file.xhr.responseText);
            if(file.xhr.responseText == 'Y'){
              project.getFileResearch(true)
            }
          });
        }
      });

      var dropzone_2 = new Dropzone("#mydropzone_2", {
        url: "../controller/general/upload.php?stage=register_file&uid=" + current_user + "&path=2",
        acceptedFiles: 'application/pdf, .docx, .doc',
        maxFilesize: 100,
        init: function(){
          this.on("complete", function(file) {
            this.removeFile(file);
            if(file.xhr.responseText == 'Y'){
              project.getFileResearch()
            }
          });
        }
      });

      var dropzone_3 = new Dropzone("#mydropzone_3", {
        url: "../controller/general/upload.php?stage=register_file&uid=" + current_user + "&path=3",
        acceptedFiles: 'application/pdf, .docx, .doc',
        maxFilesize: 100,
        init: function(){
          this.on("complete", function(file) {
            this.removeFile(file);
            if(file.xhr.responseText == 'Y'){
              project.getFileResearch()
            }
          });
        }
      });

      var dropzone_4 = new Dropzone("#mydropzone_4", {
        url: "../controller/general/upload.php?stage=register_file&uid=" + current_user + "&path=4",
        acceptedFiles: 'application/pdf, .docx, .doc',
        maxFilesize: 100,
        init: function(){
          this.on("complete", function(file) {
            this.removeFile(file);
            if(file.xhr.responseText == 'Y'){
              project.getFileResearch()
            }
          });
        }
      });

      var dropzone_5 = new Dropzone("#mydropzone_5", {
        url: "../controller/general/upload.php?stage=register_file&uid=" + current_user + "&path=5",
        acceptedFiles: 'application/pdf, .docx, .doc',
        maxFilesize: 100,
        init: function(){
          this.on("complete", function(file) {
            this.removeFile(file);
            if(file.xhr.responseText == 'Y'){
              project.getFileResearch()
            }
          });
        }
      });

      var dropzone_6 = new Dropzone("#mydropzone_6", {
        url: "../controller/general/upload.php?stage=register_file&uid=" + current_user + "&path=6",
        acceptedFiles: 'application/pdf, .docx, .doc',
        maxFilesize: 100,
        init: function(){
          this.on("complete", function(file) {
            this.removeFile(file);
            if(file.xhr.responseText == 'Y'){
              project.getFileResearch()
            }
          });
        }
      });

      var dropzone_7 = new Dropzone("#mydropzone_7", {
        url: "../controller/general/upload.php?stage=register_file&uid=" + current_user + "&path=7",
        acceptedFiles: 'application/pdf, .docx, .doc, .xls, .xlsx',
        maxFilesize: 100,
        init: function(){
          this.on("complete", function(file) {
            this.removeFile(file);
            if(file.xhr.responseText == 'Y'){
              project.getFileResearch()
            }
          });
        }
      });

      var dropzone_8 = new Dropzone("#mydropzone_8", {
        url: "../controller/general/upload.php?stage=register_file&uid=" + current_user + "&path=8",
        acceptedFiles: 'application/pdf, .docx, .doc',
        maxFilesize: 100,
        init: function(){
          this.on("complete", function(file) {
            this.removeFile(file);
            console.log(file.xhr.responseText);
            if(file.xhr.responseText == 'Y'){
              project.getFileResearch()
            }
          });
        }
      });

      var dropzone_9 = new Dropzone("#mydropzone_9", {
        url: "../controller/general/upload.php?stage=register_file&uid=" + current_user + "&path=9",
        acceptedFiles: 'application/pdf',
        maxFilesize: 100,
        init: function(){
          this.on("complete", function(file) {
            this.removeFile(file);
            if(file.xhr.responseText == 'Y'){
              project.getFileResearch()
            }
          });
        }
      });

      var dropzone_10 = new Dropzone("#mydropzone_10", {
        url: "../controller/general/upload.php?stage=register_file&uid=" + current_user + "&path=10",
        acceptedFiles: 'application/pdf, .docx, .doc',
        maxFilesize: 100,
        init: function(){
          this.on("complete", function(file) {
            this.removeFile(file);
            if(file.xhr.responseText == 'Y'){
              project.getFileResearch()
            }
          });
        }
      });

      var brief_reports = CKEDITOR.replace( 'brief_reports', {
        wordcount : {
          showCharCount : false,
          showWordCount : true,
          maxWordCount: 500
        },
        height: '550px'
      });

      var checkStep = true;

      $(document).ready(function(){


          if(current_project != null){
            setTimeout(function(){
              project.get_rs_info()
            }, 2000)
          }else{
            $('#txtStartdate').daterangepicker({
                singleDatePicker: true,
                locale: {
                    cancelLabel: 'Clear',
                    format: "YYYY-MM-DD",
                    daysOfWeek: [ "อา.", "จ.",   "อ.",   "พ.", "พฤ.", "ศ.", "ส." ],
                    monthNames: thmonth2
                }
            })

            $('#txtFinishdate').daterangepicker({
                singleDatePicker: true,
                locale: {
                    cancelLabel: 'Clear',
                    format: "YYYY-MM-DD",
                    daysOfWeek: [ "อา.", "จ.",   "อ.",   "พ.", "พฤ.", "ศ.", "ส." ],
                    monthNames: thmonth2
                }
            })

            setTimeout(() => {
              preload.hide()
            }, 1000);
          }



          setInterval(function(){
              saveDraft()
          }, 5000);
        })

      $(function(){

        $('.fundBuget').keyup(function(){

          $f1 = parseInt($('#txtFunding1').val());
          $f2 = parseInt($('#txtFunding2').val());
          $f7 = parseInt($('#txtFunding7').val());
          $f3 = parseInt($('#txtFunding3').val());
          $f4 = parseInt($('#txtFunding4').val());
          $f5 = parseInt($('#txtFunding5').val());

          $sumf = $f1 + $f2 + $f7 + $f3 + $f4 + $f5;

          $('#txtBudget').val($sumf);

        })

        $('#cb1').click(function(){
          if($(this).is(":checked")){
            $('#cb1_info').removeClass('dn')
          }else{
            $('#cb1_info').addClass('dn')
          }
        })

        $('#cb2').click(function(){
          if($(this).is(":checked")){
            $('#cb2_info').removeClass('dn')
          }else{
            $('#cb2_info').addClass('dn')
          }
        })

        $('#cb7').click(function(){
          if($(this).is(":checked")){
            $('#cb7_info').removeClass('dn')
          }else{
            $('#cb7_info').addClass('dn')
          }
        })

        $('#cb3').click(function(){
          if($(this).is(":checked")){
            $('#cb3_info').removeClass('dn')
          }else{
            $('#cb3_info').addClass('dn')
          }
        })

        $('#cb4').click(function(){
          if($(this).is(":checked")){
            $('#cb4_info').removeClass('dn')
          }else{
            $('#cb4_info').addClass('dn')
          }
        })

        $('#cb5').click(function(){
          if($(this).is(":checked")){
            $('#cb5_info').removeClass('dn')
          }else{
            $('#cb5_info').addClass('dn')
          }
        })

        $('#txtFundexist').change(function(){
          if($('#txtFundexist').val() == '0'){
            $('.fundingInfo').addClass('dn')
          }else{
            $('.fundingInfo').removeClass('dn')
          }
        })

        $('#copiBtn').click(function(){
          $('#txtCopi_id').val('')
        })

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
          กรุณากรอกข้อมูลให้ครบถ้วนโดยไม่ต้องกรอกข้อมูลของหัวหน้าโครงการ
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
              <label for="">คำนำหน้าชื่อ : </label>
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
              <label for="">Prefix : </label>
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
            <label for="">ประเภทบุคลากร : <span class="text-danger">*</span></label>
            <select class="form-control" name="txtPtype" id="txtPtype">
              <option value="1">บุคลากรภายใน คณะแพทยศาสตร์ มอ.</option>
              <option value="2">บุคลากรภายนอก คณะแพทยศาสตร์ มอ.</option>
            </select>
          </div>

          <div class="iDept">
            <div class="form-group mb-3">
              <label for="">หน่วยงาน : <span class="text-danger">*</span></label>
              <select class="form-control" name="txtPdeptname" id="txtPdeptname">
                <option value="">-- เลือกหน่วยงานภายในคณะแพทย์ --</option>
                <?php
                $strSQL = "SELECT * FROM dept WHERE id_dept != '19' ORDER BY dept_name";
                $resultDept = mysqli_query($conn, $strSQL);
                if(($resultDept) && (mysqli_num_rows($resultDept) > 0)){
                  while($rfow = mysqli_fetch_array($resultDept)){
                    ?>
                    <option value="<?php echo $rfow['id_dept'];?>"><?php echo $rfow['dept_name'];?></option>
                    <?php
                  }
                }
                ?>
              </select>
              <small>
                * ในกรณีหน่วยงานไม่ปรากฏอยู่ในรายชื่อดังกล่าว ให้เลือกประเภทบุคลากรเป็น "บุคลากรภายนอก" เพื่อเพิ่มชื่อหน่วยงานใหม่
              </small>
            </div>
          </div>

          <div class="oDept dn">
            <div class="form-group mb-3">
              <label for="">ชื่อหน่วยงานที่สังกัด (ภาษาไทย) : <span class="text-danger">*</span></label>
              <input type="text" id="txtDept_th" name="" value="" class="form-control" placeholder="กรอกชื่อหน่วยงานที่สังกัดของผู้ร่วมวิจัยท่านนี้ ...">
            </div>

            <div class="form-group mb-3">
              <label for="">Department / Institution name (English) : <span class="text-danger">*</span></label>
              <input type="text" id="txtDept_en" name="" value="" class="form-control" placeholder="Enter institution or department name ...">
            </div>
          </div>

          <div class="row">
            <div class="form-group col-12 col-sm-4 mb-3 dn">
              <label for="">สัดส่วน (%) : <span class="text-danger">*</span></label>
              <input type="number" min="1" max="99" id="txtRatioteam" name="" value="" class="form-control" placeholder="">
            </div>
            <div class="form-group col-12">
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
