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

  <style media="screen">
  img {
    -webkit-print-color-adjust: exact;
  }
  </style>
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
                          <button class="btn btn-secondary text-dark bsdn mr-1 mb-1" id="btnAction_2"  onclick="window.location='research_view_all_owner_file?uid=<?php echo $uid; ?>&role=<?php echo $role; ?>&id_rs=<?php echo $id_rs;?>'"><i class="fas fa-upload"></i> เอกสารแนบ</button>
                          <button class="btn btn-secondary text-dark bsdn mr-1 mb-1" id="btnAction_4"  onclick="window.location='research_view_all_owner_comment?uid=<?php echo $uid; ?>&role=<?php echo $role; ?>&id_rs=<?php echo $id_rs;?>'"><i class="fas fa-comment-alt"></i> ข้อเสนอแนะ</button>
                          <button class="btn btn-primary bsdn mr-1 mb-1" id="btnAction_5"  onclick="window.location='research_view_all_owner_approval?uid=<?php echo $uid; ?>&role=<?php echo $role; ?>&id_rs=<?php echo $id_rs;?>'"><i class="far fa-file"></i> ใบรับรอง</button>
                        </div>

                            <h6 class="mt-3 text-dark">รายการใบรับรอง/รับทราบ</h6>

                            <table class="table table-striped table-bordered table-sm">
                                <thead>
                                    <tr class="bg-primary">
                                        <th class="pl-2 pr-2 text-white" style="width: 50px;">#</th>
                                        <th class="pl-2 pr-2 text-white">รหัส</th>
                                        <th class="pl-2 pr-2 text-white" style="width: 80px;">ภาษา</th>
                                        <th class="pl-2 pr-2 text-white" style="width: 150px;">สร้างเมื่อ</th>
                                        <th class="pl-2 pr-2 text-white" style="width: 150px;">วันหมดอายุ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    // $strSQL = "SELECT * FROM init_approval_doc WHERE iad_rs_id = '$id_rs' AND delete_status = '0'";


                                    if($dataResearch1['id_status_research'] == 18){
                                      $strSQL = "SELECT * FROM research_acknowledge_info WHERE rai_id_rs = '$id_rs' AND rai_sign_status = '1' AND rai_status = '1'";
                                      if(($dataResearch1['rct_type'] == "Fullboard (Bio)") || ($dataResearch1['rct_type'] == "Fullboard (Social)") || ($dataResearch1['rct_type'] == "Expedited")){
                                        $strSQL = "SELECT * FROM research_expedited_info WHERE rai_id_rs = '$id_rs' AND rai_sign_status = '1' AND rai_status = '1'";
                                      }
                                      // echo $strSQL;
                                      $resultFile = mysqli_query($conn, $strSQL);
                                      if(($resultFile) && (mysqli_num_rows($resultFile) > 0)){
                                          $c = 1;
                                          while($dataFile = mysqli_fetch_array($resultFile)){
                                              ?>
                                              <tr>
                                                  <td class="pl-2 pr-2"><?php echo $c;?></td>
                                                  <td class="pl-2 pr-2">
                                                    <?php echo $dataFile['rai_ref'];?>
                                                    <div class="pt-1">
                                                      <button type="button" class="btn btn-primary btn-sm bsdn" onclick="setDoc('<?php echo $dataFile['rai_id'];?>', '<?php echo $dataResearch1['rct_type']; ?>')"><i class="fas fa-search"></i> ดูใบรับรอง</button>
                                                    </div>
                                                  </td>
                                                  <td class="pl-2 pr-2"><?php echo $dataFile['rai_lang'];?></td>
                                                  <td class="pl-2 pr-2"><?php echo DateThai($dataFile['rai_sign_date'], true);?></td>
                                                  <td class="pl-2 pr-2"><?php
                                                  // echo $dataFile['rai_expired_date'];
                                                  if($dataFile['rai_expired_date'] != NULL){
                                                    echo DateThai($dataFile['rai_expired_date'], true);
                                                  }else{
                                                    echo "-";
                                                  }
                                                  ?></td>
                                                  <!-- <td></td> -->
                                              </tr>
                                              <?php
                                              $c++;
                                          }
                                      }else{
                                          echo '<tr><td colspan="5" class="pl-3">ไม่พบเอกสารใบรับรอง/รับทราบ</td></tr>';
                                      }

                                    }else{
                                        echo '<tr><td colspan="5" class="pl-3">ไม่พบเอกสารใบรับรอง/รับทราบ</td></tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>


                        </div>
                    </div>


                    <div class="dn" id="approvalPanal">
                      <div class="row">
                        <div class="col-4">
                          <h6 class="text-dark">ใบรับรอง</h6>
                        </div>
                        <div class="col-8 text-right">
                          <button type="button" class="btn btn-primary bsdnml-1 bsdn" onclick="printAsFile2('printArea')"><i class="fas fa-print"></i> พิมพ์</button>
                        </div>

                      </div>
                      <div class="card mt-3 ">
                        <div class="card-body">
                          <div class="">
                            <div class="approvalBody">

                            </div>

                            <div class="approvalBody_buffer dn" id="printArea">

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
          <input type="hidden" value="<?php echo $dataResearch1['id_rs'];?>" id="textId_rs">
        </div>
        <div class="footer-right">
          2.3.0
        </div>
      </footer>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="modalStatus1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-warning pb-4">
          <h5 class="modal-title text-white" id="exampleModalLabel">ดำเนินการ</h5>
          <button type="button" class="close btnCloseModal text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h5 class="text-dark">ตรวจสอบข้อมูลโครงการวิจัย</h5>
          <form onsubmit="return false;" class="form_status_1">
              <div class="form-group mb-1">
                  <label for="">ผลการตรวจสอบเอกสาร <span class="text-danger">**</span></label>
                  <select class="form-control" name="txtResult" id="txtResult" required>
                      <option value="">-- กรุณาเลือกผลการตรวจสอบเอกสาร --</option>
                      <option value="2">เอกสารไม่ถูกต้อง/ไม่ครบถ้วน</option>
                      <option value="3">เอกสารเบื้องต้นถูกต้อง เสนอเลขา EC ตรวจสอบ</option>
                  </select>
              </div>

              <div class="dn" id="doc_corect_div">
                  <div class="form-group mb-1">
                      <label for="">ส่งต่อเลขา ฯ <span class="text-danger">**</span></label>
                      <select class="form-control" name="txtEC" id="txtEC">
                          <option value="">-- กรุณาเลือกเลขา EC --</option>
                          <?php
                          $strSQL = "SELECT * FROM useraccount a INNER JOIN userinfo  b ON a.id = b.user_id WHERE a.ec_role = '1' ORDER BY b.fname DESC";
                          $query = mysqli_query($conn, $strSQL);
                          if($query){
                          while ($row = mysqli_fetch_array($query)) {
                              ?>
                              <option value="<?php echo $row['id'];?>" ><?php echo $row['fname']." ".$row['lname'];?></option>
                              <?php
                          }
                          }
                          ?>
                      </select>
                  </div>

                  <div class="form-group mb-1">
                      <label for="">รหัสปี <span class="text-danger">**</span></label>
                      <select class="form-control" name="txtYear" id="txtYear">
                              <option value="">-- เลือกปี --</option>
                              <?php
                              $strSQL = "SELECT * FROM year WHERE 1 ORDER BY id_year DESC";
                              $result = mysqli_query($conn, $strSQL);
                              if($result){
                                  while($row = mysqli_fetch_array($result)){
                                      ?>
                                      <option value="<?php echo $row['id_year'];?>" <?php if(($row['id_year']+2542) == (date('Y') + 543)){ echo "selected"; }?>><?php echo $row['year_name'];?></option>
                                      <?php
                                  }
                              }
                              ?>
                      </select>
                  </div>

                  <div class="row">
                      <div class="form-group col-6 mb-2">
                          <label for="" class="f500 txt-dark">รหัสภาควิชา/หน่วยงาน <span class="text-danger">**</span></label>
                          <input type="number" name="txtDept" id="txtDept"  min="1" max="99" class="form-control" value="<?php echo $dataResearch1['id_dept'];?>">
                      </div>
                      <div class="form-group col-6 mb-2">
                          <label for="" class="f500 txt-dark">รหัสประเภทบุคลากร <span class="text-danger">**</span></label>
                          <input type="number" name="txtPertype" id="txtPertype"  min="1" max="99" class="form-control" value="<?php echo $dataResearch1['id_personnel'];?>">
                      </div>
                  </div>
              </div>

              <div class="form-group">
                      <label for="exampleInputuname_3" class="control-label"><span class="f500">ข้อความตอบกลับหัวหน้าโครงการ หรือ Note ถึงเลขา EC <span class="text-danger">**</label>
                      <textarea name="message_box_1" id="message_box_1" rows="8" cols="80" class="form-control" placeholder=""></textarea>
              </div>

              <div class="form-group text-right">
                  <button type="button" class="btn btn-secondary bsdn" data-dismiss="modal">ยกเลิก</button>
                  <button class="btn btn-danger bsdn"><i class="fas fa-paper-plane"></i> บันทึกและส่ง</button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- .modal status 1  -->

  <!-- Modal -->
  <div class="modal fade" id="modalNotify" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h5 class="modal-title text-white pb-3" id="exampleModalLabel">** สำคัญ..โปรดให้ความสนใจ **</h5>
          <button type="button" class="close text-white btnCloseModal" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p style="text-shadow: none !important;">
            1. เมื่อโครงการวิจัยผ่านการรับรองแล้ว <span class="text-danger"><strong>กรุณาตรวจสอบความถูกต้องของใบรับรองพิจารณาจริยธรรมการวิจัย (Certificate of approval) และดูกำหนดระยะเวลาในการรายงานความก้าวหน้า และวันหมดอายุของโครงการวิจัย</strong></span> โดยทั่วไปคณะกรรมการจะให้การรับรองไม่เกิน 1 ปี นักวิจัยต้องต่ออายุอย่างน้อยทุก 1 ปี
            (นักวิจัยสามารถตรวจสอบใบรับรองและ download ได้จากระบบออนไลน์ RMIS)
          </p>

          <p>
            2. นักวิจัยจะต้องดำเนินการวิจัยตามขั้นตอนต่าง ๆ ที่ระบุไว้ในโครงร่างการวิจัยโดยเคร่งครัด <span class="text-danger"><strong>โดยใช้เอกสารชี้แจงและหนังสือแสดงความยินยอม รวมถึงเอกสารอื่น ๆ ที่ได้ผ่านการรับรองจากคณะกรรมการแล้วเท่านั้น (ต้องมีตราประทับจากสำนักงานจริยธรรมการวิจัยในมนุษย์)</strong></span>
            (สำนักงาน EC จะส่งเอกสารฉบับที่มีตราประทับไปให้นักวิจัยที่หน่วยงาน หากไม่ได้รับเอกสารเหล่านี้จาก EC โปรดร้องขอจากเจ้าหน้าที่ EC)
          </p>

          <p>
            3. นักวิจัยจะไม่สามารถรับอาสาสมัครใหม่ระหว่างที่โครงการวิจัยหมดอายุและข้อมูลที่เก็บในช่วงที่ขาดอายุอาจจะไม่ได้รับอนุญาตให้นำไปวิเคราะห์
          </p>

          <p>
            4.  หากนักวิจัยต้องการจัดให้มีเอกสารโฆษณา/ ประชาสัมพันธ์โครงการวิจัย จะต้องส่งเอกสารมาให้คณะกรรมการฯ พิจารณาและประทับตรารับรองก่อนนำเอกสารไปใช้ประชาสัมพันธ์
          </p>

          <div class="text-center pt-2">
            <button type="button" name="button" class="btn btn-danger bsdn"  data-dismiss="modal">รับทราบ</button>
          </div>

        </div>
      </div>
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
          $('#modalNotify').modal()
      })

      function setCheckboxValue(fid){
        if($('#checkBox_' + fid).is(":checked")){
            $file_arr.push(fid)
        }else{
            $file_arr = jQuery.grep($file_arr, function(value) {
            return value != fid;
            });
        }

        console.log($file_arr);

      }

      function setDoc(id, type){
        var param = {
          id_rs: current_project,
          rai_id: id,
          conside_type: type
        }
        var jxr = $.post(conf.api + 'general/research_register?stage=get_approve_doc', param, function(){}, 'json')
                   .always(function(snap){
                     if(fnc.json_exist(snap)){
                       snap.forEach(i=>{
                         $('#approvalPanal').removeClass('dn')
                         var resp = i.rai_full_content
                         var str = resp.replace(/col-xs/g, 'col')
                         var str2 = str.replace(/images/g, 'img')
                         var str3 = str2.replace(/font-size/g, 'font-size-')
                         $('.approvalBody').html(str3)
                         $('.approvalBody').css('font-size', '16px')
                         $('.signature').html('<img src="http://rmis2.medicine.psu.ac.th/rmis_old/images/signate/sig2-th.png" width="170">')
                         $('#appDate1').html(fnc.convertThaidate(i.rai_sign_date))
                         $('.appDate1').html(fnc.convertThaidate(i.rai_sign_date))
                         $('.approveDate_1').html(fnc.convertThaidate(i.rai_sign_date))
                         $('.approveDate_2').html(fnc.convertThaidate(i.rai_sign_date))
                         $('#expDate1').html(fnc.convertThaidate(i.rai_expired_date))
                         $('#noDoc').html(i.rai_id)
                         $('#noRef').html(i.rai_ref)
                         $('.approvalBody_buffer').html($('.approvalBody').html())
                       })
                     }

                   })
      }

      function printAsFile2(){
        var printData = $('.approvalBody_buffer').html()
        PopUp(printData)
      }

      function PopUp(data) {
        var mywindow = window.open('','','left=0,top=0,width=950,height=600,toolbar=0,scrollbars=0,status=0,addressbar=0');

        var is_chrome = Boolean(mywindow.chrome);
        var isPrinting = false;
        var printData = '<!DOCTYPE html>' +
                        '<html lang="en">' +
                        '<head>' +
                          '<title>RMIS Approval Document</title>' +
                          '<meta charset="UTF-8">' +
                          '<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">' +
                          '<link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css" >' +
                          '<link rel="stylesheet" href="../assets/css/style.css">' +
                          '<link rel="stylesheet" href="../assets/custom/css/style.css">' +
                          '<style media="screen">' +
                          'body {font-size: 16px !important; padding-left: 40px; padding-right: 40px;}' +
                          'img {' +
                            '-webkit-print-color-adjust: exact;' +
                          '}' +
                          '</style>' +
                        '</head>' +
                        '<body style="font-size: 16px !important; padding-left: 40px; padding-right: 40px;">' + data + '</body></html>'

        mywindow.document.write(printData);
        mywindow.document.close(); // necessary for IE >= 10 and necessary before onload for chrome


        if (is_chrome) {
            mywindow.onload = function() { // wait until all resources loaded
                isPrinting = true;
                mywindow.focus(); // necessary for IE >= 10
                mywindow.print();  // change window to mywindow
                mywindow.close();// change window to mywindow
                isPrinting = false;
            };
            setTimeout(function () { if(!isPrinting){mywindow.print();mywindow.close();} }, 300);
        }
        else {
            mywindow.document.close(); // necessary for IE >= 10
            mywindow.focus(); // necessary for IE >= 10
            mywindow.print();
            mywindow.close();
        }

        return true;
    }
  </script>

</body>
</html>
