<?php 
require('../../../configuration/server.inc.php');
require('../../../configuration/configuration.php');
require('../../../configuration/database.php'); 
require('../../../configuration/session.php'); 

$purpose_role = 'staff';
if($purpose_role != $_SESSION['rmis_role']){
    header('Location: '. ROOT_DOMAIN .'application/html/core/login.php');
    die();
}

$db = new Database();
$conn = $db->conn();
?>

<input type="hidden" id="txtSid" value="<?php echo $_SESSION['rmis_id'];?>">
<input type="hidden" id="txtUid" value="<?php echo $_SESSION['rmis_uid'];?>">
<input type="hidden" id="txtRole" value="<?php echo $_SESSION['rmis_role'];?>">

<?php 
$c_progress = 0;
$c_amend = 0;
$c_deviation = 0;
$c_lsae = 0;
$c_esae = 0;
$c_closing = 0;
$c_terminate = 0;

$strSQL = "SELECT COUNT(rp_id) cn FROM rec_progress 
           WHERE 
           rp_sending_status = '1' 
           AND rp_confirm_1 = '1' 
           AND rp_delete_status = '0' 
           AND rp_progress_id = 'closing'
           AND rp_session IN (SELECT rwp_session_id FROM rec_wait_staff_progress WHERE rwp_status = '1')
           ";
$res6 = $db->fetch($strSQL, false);
if(($res6) && ($res6['cn'] > 0)){ $c_closing = $res6['cn']; }

$strSQL = "SELECT COUNT(rp_id) cn FROM rec_progress WHERE rp_sending_status = '1' AND rp_confirm_1 = '1'AND rp_delete_status = '0' AND rp_progress_id = 'terminate'";
$res7 = $db->fetch($strSQL, false);
if(($res7) && ($res7['cn'] > 0)){ $c_terminate = $res7['cn']; }

?>

<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="RMIS@MED PSU admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, RMIS@MED PSU admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>RMIS@MED PSU Continuing Report for Staff</title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/extensions/sweetalert2.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/components.css">
    <!-- <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/semi-dark-layout.css"> -->
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/menu/menu-types/horizontal-menu.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu navbar-static dark-layout 2-columns   footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="2-columns" data-layout="dark-layout">

    <!-- BEGIN: Header-->
    <?php require('comp/header.php'); ?>
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    <div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-sticky navbar-dark navbar-without-dd-arrow" role="navigation" data-menu="menu-wrapper">
        <div class="navbar-header d-xl-none d-block">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto"><a class="navbar-brand" href="index.html">
                        <div class="brand-logo">
                            <svg class="logo" width="26px" height="26px" viewbox="0 0 26 26" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>icon</title>
                                <defs>
                                    <lineargradient id="linearGradient-1" x1="50%" y1="0%" x2="50%" y2="100%">
                                        <stop stop-color="#5A8DEE" offset="0%"></stop>
                                        <stop stop-color="#699AF9" offset="100%"></stop>
                                    </lineargradient>
                                    <lineargradient id="linearGradient-2" x1="0%" y1="0%" x2="100%" y2="100%">
                                        <stop stop-color="#FDAC41" offset="0%"></stop>
                                        <stop stop-color="#E38100" offset="100%"></stop>
                                    </lineargradient>
                                </defs>
                                <g id="Sprite" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="sprite" transform="translate(-69.000000, -61.000000)">
                                        <g id="Group" transform="translate(17.000000, 15.000000)">
                                            <g id="icon" transform="translate(52.000000, 46.000000)">
                                                <path id="Combined-Shape" d="M13.5909091,1.77272727 C20.4442608,1.77272727 26,7.19618701 26,13.8863636 C26,20.5765403 20.4442608,26 13.5909091,26 C6.73755742,26 1.18181818,20.5765403 1.18181818,13.8863636 C1.18181818,13.540626 1.19665566,13.1982714 1.22574292,12.8598734 L6.30410592,12.859962 C6.25499466,13.1951893 6.22958398,13.5378796 6.22958398,13.8863636 C6.22958398,17.8551125 9.52536149,21.0724191 13.5909091,21.0724191 C17.6564567,21.0724191 20.9522342,17.8551125 20.9522342,13.8863636 C20.9522342,9.91761479 17.6564567,6.70030817 13.5909091,6.70030817 C13.2336969,6.70030817 12.8824272,6.72514561 12.5388136,6.77314791 L12.5392575,1.81561642 C12.8859498,1.78721495 13.2366963,1.77272727 13.5909091,1.77272727 Z"></path>
                                                <path id="Combined-Shape" d="M13.8863636,4.72727273 C18.9447899,4.72727273 23.0454545,8.82793741 23.0454545,13.8863636 C23.0454545,18.9447899 18.9447899,23.0454545 13.8863636,23.0454545 C8.82793741,23.0454545 4.72727273,18.9447899 4.72727273,13.8863636 C4.72727273,13.5378966 4.74673291,13.1939746 4.7846258,12.8556254 L8.55057141,12.8560055 C8.48653249,13.1896162 8.45300462,13.5340745 8.45300462,13.8863636 C8.45300462,16.887125 10.8856023,19.3197227 13.8863636,19.3197227 C16.887125,19.3197227 19.3197227,16.887125 19.3197227,13.8863636 C19.3197227,10.8856023 16.887125,8.45300462 13.8863636,8.45300462 C13.529522,8.45300462 13.180715,8.48740462 12.8430777,8.55306931 L12.8426531,4.78608796 C13.1851829,4.7472336 13.5334422,4.72727273 13.8863636,4.72727273 Z" fill="#4880EA"></path>
                                                <path id="Combined-Shape" d="M13.5909091,1.77272727 C20.4442608,1.77272727 26,7.19618701 26,13.8863636 C26,20.5765403 20.4442608,26 13.5909091,26 C6.73755742,26 1.18181818,20.5765403 1.18181818,13.8863636 C1.18181818,13.540626 1.19665566,13.1982714 1.22574292,12.8598734 L6.30410592,12.859962 C6.25499466,13.1951893 6.22958398,13.5378796 6.22958398,13.8863636 C6.22958398,17.8551125 9.52536149,21.0724191 13.5909091,21.0724191 C17.6564567,21.0724191 20.9522342,17.8551125 20.9522342,13.8863636 C20.9522342,9.91761479 17.6564567,6.70030817 13.5909091,6.70030817 C13.2336969,6.70030817 12.8824272,6.72514561 12.5388136,6.77314791 L12.5392575,1.81561642 C12.8859498,1.78721495 13.2366963,1.77272727 13.5909091,1.77272727 Z" fill="url(#linearGradient-1)"></path>
                                                <rect id="Rectangle" x="0" y="0" width="7.68181818" height="7.68181818"></rect>
                                                <rect id="Rectangle" fill="url(#linearGradient-2)" x="0" y="0" width="7.68181818" height="7.68181818"></rect>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <h2 class="brand-text mb-0">RMIS@MED PSU</h2>
                    </a></li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="bx bx-x d-block d-xl-none font-medium-4 primary toggle-icon"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <!-- Horizontal menu content-->
        <div class="navbar-container main-menu-content" data-menu="menu-container">
            <!-- include ../../../includes/mixins-->
            <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="lines">
                <li class="nav-item"><a class="dropdown-toggle nav-link text-dark" href="./" ><i class="menu-livicon" data-icon="home"></i><span data-i18n="Apps">หน้าแรก</span></a></li>

                <!-- <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="menu-livicon" data-icon="comments"></i><span data-i18n="Apps">แบบรายงาน/แบบเสนอ</span></a>
                    <ul class="dropdown-menu">
                        <li data-menu=""><a class="dropdown-item align-items-center" href="app-email.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Email">รายงานความก้าวหน้าโครงการ (Progress report)</span></a>
                        </li>
                        <li data-menu=""><a class="dropdown-item align-items-center" href="app-chat.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Chat">แบบเสนอขอแก้ไขเพิ่มเติมโครงการวิจัย (Amendment)</span></a>
                        </li>
                        <li data-menu=""><a class="dropdown-item align-items-center" href="app-todo.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Todo">แบบรายงานการดำเนินงานวิจัยที่เบี่ยงเบน (Deviation/Non-compliance)</span></a>
                        </li>
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a class="dropdown-item align-items-center dropdown-toggle" href="#" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Invoice">รายงานเหตุการณ์ไม่พึงประสงค์ชนิดร้าย</span></a>
                            <ul class="dropdown-menu">
                                <li data-menu=""><a class="dropdown-item align-items-center" href="app-invoice-list.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Invoice List">ในสถาบัน (Local SAE-expedited)</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="app-invoice.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Invoice">นอกสถาบัน (External SAE/SUSAR)</span></a>
                                </li>
                            </ul>
                        </li>
                        <li data-menu=""><a class="dropdown-item align-items-center" href="app-file-manager.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="File Manager">แบบรายงานสรุปผลการวิจัย (Scheduled Closing)</span></a>
                        <li data-menu=""><a class="dropdown-item align-items-center" href="app-file-manager.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="File Manager">แบบรายงานการยุติโครงการวิจัยก่อนกำหนด (Termination Report Form)</span></a>
                        </li>
                    </ul>
                </li>
                
                <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="menu-livicon" data-icon="morph-folder"></i><span data-i18n="Others">Others</span></a>
                    <ul class="dropdown-menu">
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a class="dropdown-item align-items-center dropdown-toggle" href="#" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Menu Levels">Menu Levels</span></a>
                            <ul class="dropdown-menu">
                                <li data-menu=""><a class="dropdown-item align-items-center" href="#" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Second Level">Second Level</span></a></li>
                                <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a class="dropdown-item align-items-center dropdown-toggle" href="#" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Second Level">Second Level</span></a>
                                    <ul class="dropdown-menu">
                                        <li data-menu=""><a class="dropdown-item align-items-center" href="#" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Third Level">Third Level</span></a>
                                        </li>
                                        <li data-menu=""><a class="dropdown-item align-items-center" href="#" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Third Level">Third Level</span></a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="disabled" data-menu=""><a class="dropdown-item align-items-center" href="#" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Disabled Menu">Disabled Menu</span></a>
                        </li>
                        <li data-menu=""><a class="dropdown-item align-items-center" href="https://pixinvent.com/demo/RMIS@MED PSU-clean-bootstrap-admin-dashboard-template/documentation" data-toggle="dropdown" target="_blank"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Documentation">Documentation</span></a>
                        </li>
                        <li data-menu=""><a class="dropdown-item align-items-center" href="https://pixinvent.ticksy.com/" data-toggle="dropdown" target="_blank"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Raise Support">Raise Support</span></a>
                        </li>
                    </ul>
                </li> -->
            </ul>
        </div>
        <!-- /horizontal menu content-->
    </div>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-12 mb-2 mt-1">
                    <div class="breadcrumbs-top">
                        <h5 class="content-header-title float-left pr-1 mb-0 text-dark">โครงการที่อยู่ระหว่างรอการดำเนินการโดยเจ้าหน้าที่</h5>
                        <div class="breadcrumb-wrapper d-none d-sm-block">
                            <ol class="breadcrumb p-0 mb-0 pl-1">
                                <li class="breadcrumb-item"><a href="./"><i class="bx bx-home-alt"></i></a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic card section start -->

                <!-- Navigation -->
                <section id="card-navigation">
                    <div class="row">
                        <div class="col-12">
                        <div class="card text-center">
                                <div class="card-body">
                                    <ul class="nav nav-pills card-header-pills ml-0" id="pills-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Progress<?php if($c_progress != 0){ echo ' <span class="badge badge-pill- badge-danger pl-1 pr-1 round" style="padding-left: 10px !important; padding-right: 12px !important;" >'.$c_progress.'</span>';} ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-amend-tab" data-toggle="pill" href="#pills-amend" role="tab" aria-controls="pills-amend" aria-selected="false">Amendment<?php if($c_amend != 0){ echo ' <span class="badge badge-pill- badge-danger pl-1 pr-1 round" style="padding-left: 10px !important; padding-right: 12px !important;" >'.$c_amend.'</span>';} ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-deviation-tab" data-toggle="pill" href="#pills-deviation" role="tab" aria-controls="pills-deviation" aria-selected="false">Deviation/Non-compliance<?php if($c_deviation != 0){ echo ' <span class="badge badge-pill- badge-danger pl-1 pr-1 round" style="padding-left: 10px !important; padding-right: 12px !important;" >'.$c_deviation.'</span>';} ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-localsae-tab" data-toggle="pill" href="#pills-localsae" role="tab" aria-controls="pills-localsae" aria-selected="false">Local SAE<?php if($c_lsae != 0){ echo ' <span class="badge badge-pill- badge-danger pl-1 pr-1 round" style="padding-left: 10px !important; padding-right: 12px !important;" >'.$c_lsae.'</span>';} ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-externalsae-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-externalsae" aria-selected="false">External SAE<?php if($c_esae != 0){ echo ' <span class="badge badge-pill- badge-danger pl-1 pr-1 round" style="padding-left: 10px !important; padding-right: 12px !important;" >'.$c_esae.'</span>';} ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-closing-tab" data-toggle="pill" href="#pills-closing" role="tab" aria-controls="pills-closing" aria-selected="false">Closing<?php if($c_closing != 0){ echo ' <span class="badge badge-pill- badge-danger pl-1 pr-1 round" style="padding-left: 10px !important; padding-right: 12px !important;" >'.$c_closing.'</span>';} ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-terminate-tab" data-toggle="pill" href="#pills-terminate" role="tab" aria-controls="pills-terminate" aria-selected="false">Termination<?php if($c_terminate != 0){ echo ' <span class="badge badge-pill- badge-danger pl-1 pr-1 round" style="padding-left: 10px !important; padding-right: 12px !important;" >'.$c_terminate.'</span>';} ?></a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="pills-tabContent">

                                        <div class="tab-pane fade show active pt-3 pb-3" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                            <?php 
                                            if($c_progress == 0){
                                                ?>
                                                <h4 class="card-title">ไม่มีแบบรายงานรอตรวจสอบ</h4>
                                                <?php
                                            }else{

                                            }
                                            ?>
                                        </div>

                                        <div class="tab-pane fade pt-3 pb-3" id="pills-amend" role="tabpanel" aria-labelledby="pills-amend-tab">
                                            <?php 
                                            if($c_amend == 0){
                                                ?>
                                                <h4 class="card-title">ไม่มีแบบรายงานรอตรวจสอบ</h4>
                                                <?php
                                            }else{
                                                
                                            }
                                            ?>
                                        </div>

                                        <div class="tab-pane fade pt-3 pb-3" id="pills-deviation" role="tabpanel" aria-labelledby="pills-deviation-tab">
                                        <?php 
                                            if($c_deviation == 0){
                                                ?>
                                                <h4 class="card-title">ไม่มีแบบรายงานรอตรวจสอบ</h4>
                                                <?php
                                            }else{
                                                
                                            }
                                            ?>
                                        </div>
                                        <div class="tab-pane fade pt-3 pb-3" id="pills-localsae" role="tabpanel" aria-labelledby="pills-localsae-tab">
                                        <?php 
                                            if($c_lsae == 0){
                                                ?>
                                                <h4 class="card-title">ไม่มีแบบรายงานรอตรวจสอบ</h4>
                                                <?php
                                            }else{
                                                
                                            }
                                            ?>
                                        </div>

                                        <div class="tab-pane fade pt-3 pb-3" id="pills-externalsae" role="tabpanel" aria-labelledby="pills-externalsae-tab">
                                        <?php 
                                            if($c_esae == 0){
                                                ?>
                                                <h4 class="card-title">ไม่มีแบบรายงานรอตรวจสอบ</h4>
                                                <?php
                                            }else{
                                                
                                            }
                                            ?>
                                        </div>

                                        <div class="tab-pane fade pb-3" id="pills-closing" role="tabpanel" aria-labelledby="pills-closing-tab">
                                        <?php 
                                            if($c_closing == 0){
                                                ?>
                                                <h4 class="card-title mt-3">ไม่มีแบบรายงานรอตรวจสอบ</h4>
                                                <?php
                                            }else{
                                                ?>
                                                <table class="table table-striped mt-3">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 120px;">รหัสรายงาน</th>
                                                            <th>ชื่อโครงการ</th>
                                                            <th style="width: 150px;">วัน-เวลาที่ส่ง</th>
                                                            <th style="width: 100px;">สถานะปัจจุบัน</th>
                                                            <th style="width: 200px;"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                        $strSQL = "SELECT * FROM rec_progress a INNER JOIN research b ON a.rp_id_rs = b.id_rs
                                                                   INNER JOIN type_status_research c ON a.rp_progress_status = c.id_status_research
                                                                   WHERE 
                                                                   a.rp_sending_status = '1' 
                                                                   AND a.rp_confirm_1 = '1' 
                                                                   AND a.rp_delete_status = '0' 
                                                                   AND a.rp_progress_id = 'closing'
                                                                   AND rp_session IN (SELECT rwp_session_id FROM rec_wait_staff_progress WHERE rwp_status = '1')";
                                                        $res = $db->fetch($strSQL, true, false);
                                                        if(($res) && ($res['status'])){
                                                            foreach ($res['data'] as $row) {
                                                                ?>
                                                                <tr>
                                                                    <td style="vertical-align: top;"><?php echo $row['rp_session']; ?></td>
                                                                    <td style="vertical-align: top;" class="text-dark">
                                                                        <div>
                                                                            <span class="badge badge-secondary mb-1 round"><?php echo "REC.".$row['code_apdu']; ?></span>
                                                                        </div>
                                                                        <?php 
                                                                        if($row['title_th'] == '-'){
                                                                            echo $row['title_en'];
                                                                        }else{
                                                                            echo $row['title_th']. " (".$row['title_en'].")";
                                                                        }
                                                                        ?>
                                                                        <div>
                                                                        หัวหน้าโครงการ :
                                                                        </div> 
                                                                    </td>
                                                                    <td style="vertical-align: top;"><?php echo $row['rp_sending_datetime']; ?></td>
                                                                    <td style="vertical-align: top;"><span class="badge round badge-light-danger"><?php echo $row['status_name']; ?></span></td>
                                                                    <td style="vertical-align: top;" class="text-right">
                                                                        <button class="btn btn-icon btn-success" style="padding-bottom: 10px;" onclick="openForm('closing', '<?php echo $row['rp_id_rs'];?>', '<?php echo $row['rp_session'];?>')"><i class="bx bx-search"></i></button>
                                                                        <?php 
                                                                        if($row['rp_progress_status'] == '22'){
                                                                            ?>
                                                                            <button class="btn btn-icon btn-success" style="padding-bottom: 10px;" onclick="window.location = 'approve_doc?session_id=<?php echo $row['rp_session'];?>'"><i class="bx bx-wrench"></i></button>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                        <button class="btn btn-icon btn-danger" style="padding-bottom: 10px;"><i class="bx bx-trash"></i></button>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                                <?php
                                            }
                                            ?>
                                        </div>

                                        <div class="tab-pane fade pt-3 pb-3" id="pills-terminate" role="tabpanel" aria-labelledby="pills-terminate-tab">
                                        <?php 
                                            // if(($c_terminate == 0) || ($c_terminate == null)){
                                            if($c_terminate == 0){
                                                ?>
                                                <h4 class="card-title">ไม่มีแบบรายงานรอตรวจสอบ</h4>
                                                <?php
                                            }else{
                                                ?>
                                                <table class="table table-striped mt-3">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 120px;">รหัสรายงาน</th>
                                                            <th>ชื่อโครงการ</th>
                                                            <th style="width: 150px;">วัน-เวลาที่ส่ง</th>
                                                            <th style="width: 100px;">สถานะปัจจุบัน</th>
                                                            <th style="width: 160px;"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                        $strSQL = "SELECT * FROM rec_progress a INNER JOIN research b ON a.rp_id_rs = b.id_rs
                                                                   INNER JOIN type_status_research c ON a.rp_progress_status = c.id_status_research
                                                                   WHERE 
                                                                   a.rp_sending_status = '1' AND a.rp_confirm_1 = '0' AND a.rp_delete_status = '0' AND a.rp_progress_id = 'terminate'";
                                                        $res = $db->fetch($strSQL, true, false);
                                                        if(($res) && ($res['status'])){
                                                            foreach ($res['data'] as $row) {
                                                                ?>
                                                                <tr>
                                                                    <td style="vertical-align: top;"><?php echo $row['rp_session']; ?></td>
                                                                    <td style="vertical-align: top;" class="text-dark">
                                                                        <div>
                                                                            <span class="badge badge-success mb-1 round"><?php echo "REC.".$row['code_apdu']; ?></span>
                                                                        </div>
                                                                        <?php 
                                                                        if($row['title_th'] == '-'){
                                                                            echo $row['title_en'];
                                                                        }else{
                                                                            echo $row['title_th']. " (".$row['title_en'].")";
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td style="vertical-align: top;"><?php echo $row['rp_sending_datetime']; ?></td>
                                                                    <td style="vertical-align: top;"><span class="badge round badge-light-danger"><?php echo $row['status_name']; ?></span></td>
                                                                    <td style="vertical-align: top;" class="text-right">
                                                                        <button class="btn btn-icon btn-success" style="padding-bottom: 10px;" onclick="openForm('terminate', '<?php echo $row['rp_id_rs'];?>', '<?php echo $row['rp_session'];?>')"><i class="bx bx-search"></i></button>
                                                                        <button class="btn btn-icon btn-danger" style="padding-bottom: 10px;"><i class="bx bx-trash"></i></button>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        }else{

                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ Navigation -->

            </div>
        </div>
    </div>
    <!-- END: Content-->
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <?php 
    // require('comp/footer.php');
    ?>


    <!-- BEGIN: Vendor JS-->
    <script src="../../../app-assets/vendors/js/vendors.min.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../../../app-assets/vendors/js/ui/jquery.sticky.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
    <script src="../../../app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
    <script src="../../../app-assets/vendors/js/extensions/polyfill.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/horizontal-menu.js"></script>
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    
    <!-- END: Theme JS-->
    <!-- RMIS Continuing Script  -->
    <script src="../../../assets/1.0.1/js/core.js?v=<?php echo filemtime('../../../assets/1.0.1/js/core.js'); ?>"></script>
    <script src="../../../assets/1.0.1/js/user.js?v=<?php echo filemtime('../../../assets/1.0.1/js/user.js'); ?>"></script>
    <script src="../../../assets/1.0.1/js/project.js?v=<?php echo filemtime('../../../assets/1.0.1/js/project.js'); ?>"></script>
    <script src="../../../assets/1.0.1/js/continuing.js?v=<?php echo filemtime('../../../assets/1.0.1/js/continuing.js'); ?>"></script>
    <!-- BEGIN: Page JS-->
    <!-- END: Page JS-->

    <script>
        $(document).ready(function(){
            project.getList()
            progress.getProgressReportList('Progress')
            progress.getProgressReportList('Amendment')
            progress.getProgressReportList('Deviation')
            progress.getProgressReportList('LocalSAE')
            progress.getProgressReportList('ExtSAE')
            progress.getProgressReportList('Closing')
            progress.getProgressReportList('Terminate') 
        })
    </script>

</body>
<!-- END: Body-->

</html>