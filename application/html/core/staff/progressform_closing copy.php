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

if((!isset($_REQUEST['id_rs'])) || ($_REQUEST['id_rs'] == '')){
    $db->close();
    header("location:javascript://history.go(-1)");
    die();
}

$id_rs = mysqli_real_escape_string($conn, $_REQUEST['id_rs']);
$session_id = mysqli_real_escape_string($conn, $_REQUEST['session_id']);

$strSQL = "SELECT * FROM rec_progress WHERE rp_id_rs = '$id_rs' AND rp_session = '$session_id' AND rp_sending_status = '1'";
$res = $db->fetch($strSQL, false);
if(!$res){
    $db->close();
    header("Location: ./");
    die();
}

$strSQL = "SELECT *, DATE(a.rp_sending_datetime) send_date FROM rec_progress a INNER JOIN research b ON a.rp_id_rs = b.id_rs
           INNER JOIN type_status_research c ON a.rp_progress_status = c.id_status_research
           INNER JOIN rec_progress_closing d ON a.rp_session = d.rpx_session
           WHERE 
           a.rp_sending_status = '1' AND a.rp_confirm_1 = '0' AND a.rp_delete_status = '0' AND a.rp_progress_id = 'closing' AND a.rp_session = '$session_id' AND a.rp_id_rs = '$id_rs'";
$resProgress = $db->fetch($strSQL, false);
$pgStatus = false;
if($resProgress){
    $pgStatus = true;
}
?>

<input type="hidden" id="txtSid" value="<?php echo $_SESSION['rmis_id'];?>">
<input type="hidden" id="txtUid" value="<?php echo $_SESSION['rmis_uid'];?>">
<input type="hidden" id="txtRole" value="<?php echo $_SESSION['rmis_role'];?>">
<input type="hidden" id="txtPid" value="<?php echo $id_rs;?>">
<input type="hidden" id="txtSessionID" value="<?php echo $session_id;?>">

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
    <title>RMIS@MED PSU Continuing Report for PI</title>
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
    <link rel="stylesheet" type="text/css" href="../../../tools/dropzone/dist/min/dropzone.min.css">

    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/menu/menu-types/horizontal-menu.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/forms/wizard.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/components.css">
    <!-- <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/dark-layout.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/semi-dark-layout.css"> -->
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
                <li class="nav-item"><a class="dropdown-toggle nav-link  text-dark" href="./" ><i class="menu-livicon" data-icon="home"></i><span data-i18n="Apps">หน้าแรก</span></a></li>

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
                 -->
                <!-- <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="menu-livicon" data-icon="morph-folder"></i><span data-i18n="Others">Others</span></a>
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
                        <h5 class="content-header-title float-left pr-1 mb-0 text-dark">ระบบรายงานความก้าวหน้างานวิจัย</h5>
                        <div class="breadcrumb-wrapper d-none d-sm-block">
                            <ol class="breadcrumb p-0 mb-0 pl-1">
                                <li class="breadcrumb-item"><a href="./"><i class="bx bx-home-alt"></i></a></li>
                                <li class="breadcrumb-item"><a href="Javascript:window.location.history.back()">รายงานโครงการวิจัย <span class="apducode"></span></a></li>
                                <li class="breadcrumb-item"><a href="#">Closing</a></li>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
            <div class="row">
                        <div class="col-12">
                            <h3 class=" text-dark mb-2">แบบรายงานสรุปผลการวิจัย กรณีปิดโครงการปกติ (Final Report Form)</h3>
                        </div>
                    </div>
                <!-- Basic card section start -->

                <!-- Navigation -->
                <section id="card-navigation">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="py-50 text-dark">ข้อมูลโครงการวิจัย</h4>
                            <div class="card">
                                <div class="card-body p-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <table class="table table-striped mb-0" style="font-size: 0.8em;">
                                                <tbody>
                                                    <tr>
                                                        <td style="width: 50%;"><div>หมายเลขโครงการ : </div><span class="badge badge-success round" style="font-size: 1.3em; margin-top: 3px;"><?php echo $resProgress['code_apdu']; ?></span></td>
                                                        <td><div>Protocol No. : </div><span class="" style="font-size: 1.3em; margin-top: 3px;"><?php if($resProgress['protocol_no'] == ''){ echo "-"; }else{  echo $resProgress['protocol_no']; } ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2"><div>ชื่อโครงการ : </div><div class="text-dark" style="font-size: 1.3em; margin-top: 3px;"><?php if($resProgress['title_th'] == '-'){ echo $resProgress['title_en']; }else{ echo $resProgress['title_th']. " (".$resProgress['title_en'].")";} ?></div></td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="2">
                                                        <div>หัวหน้าโครงการ : </div>
                                                        <div class="text-dark" style="font-size: 1.3em; margin-top: 3px;">
                                                            <?php 
                                                            $strSQL = "SELECT * FROM userinfo a 
                                                                       LEFT JOIN dept b ON a.id_dept = b.id_dept 
                                                                       INNER JOIN useraccount c ON a.user_id = c.id
                                                                       WHERE a.user_id = '".$resProgress['rp_uid']."' ORDER BY a.id_p DESC LIMIT 1";
                                                            $resPI = $db->fetch($strSQL, false);
                                                            if($resPI){
                                                                ?>
                                                                <h6 style="font-size: 1.1em;" class="th text-dark"><?php echo $resPI['prefix_th'].$resPI['fname']." ".$resPI['lname']."<br>"; ?></h6>
                                                                <?php
                                                                if($resPI['id_dept'] == '19'){
                                                                    echo "สังกัด :".$resPI['dept'];
                                                                }else{
                                                                    echo "สังกัด :".$resPI['dept_name'];
                                                                }
                                                                echo "<br>โทรศัพท์ : ".$resPI['tel_mobile']."<br>E-mail address : ".$resPI['email'];
                                                            }else{
                                                                echo "NA";
                                                            }
                                                            ?>
                                                        </div>
                                                    </td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="2"><div>Funding source <span class="text-muted">(ถ้ามี)</span> : </div><div class="text-dark" style="font-size: 1.3em; margin-top: 3px;"><?php echo $resProgress['source_funds'] ?></div></td>
                                                    </tr>

                                                    <tr>
                                                        <td style="width: 50%;">
                                                            <div>วันที่ได้รับใบรับรองครั้งแรกจาก EC : </div>
                                                            <div style="font-size: 1.3em; margin-top: 3px;" class="text-danger">
                                                            <?php 

                                                            $strSQL = "SELECT * FROM rec_progress WHERE rp_progress_id = 'progress' AND rp_delete_status = '0' AND rp_confirm_1 = '1' ORDER BY rp_id DESC LIMIT 1";
                                                            $resRec = $db->fetch($strSQL, false);
                                                            if($resRec){
                                                                echo $resRec['rp_app_date'];
                                                            }else{
                                                                $strSQL = "SELECT * FROM research_consider_type WHERE rct_id_rs = '$id_rs' AND rct_status = '1' ORDER BY rct_id DESC LIMIT 1";
                                                                $resType = $db->fetch($strSQL, false);
                                                                if($resType){
                                                                    if($resType['rct_type'] == 'Exempt'){
                                                                        $strSQL = "SELECT DATE(rai_sign_date) app_date FROM research_acknowledge_info WHERE rai_id_rs = '$id_rs' AND rai_sign_status = '1' ORDER BY rai_id DESC LIMIT 1";
                                                                        $resSign= $db->fetch($strSQL, false);
                                                                        if($resSign){
                                                                            echo $resSign['app_date'];
                                                                        }else{
                                                                            echo "NA";
                                                                        }
                                                                    }else{
                                                                        $strSQL = "SELECT DATE(rai_sign_date) app_date FROM research_expedited_info WHERE rai_id_rs = '$id_rs' AND rai_sign_status = '1' ORDER BY rai_id DESC LIMIT 1";
                                                                        $resSign= $db->fetch($strSQL, false);
                                                                        if($resSign){
                                                                            echo $resSign['app_date'];
                                                                        }else{
                                                                            echo "NA";
                                                                        }
                                                                    }
                                                                }else{
                                                                    echo "NA";
                                                                }
                                                            }

                                                            
                                                            ?>
                                                            </div>
                                                        </td>
                                                        <td><div>วันที่ยื่นรายงาน : </div><span class="" style="font-size: 1.3em; margin-top: 3px;"><?php echo $resProgress['send_date']; ?></span></td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body  mt-2">
                                    <form action="#" >
                                        <fieldset>
                                            <div class="row">
                                                <div class="col-12">
                                                    <h4 class="py-50 text-dark">สรุปจำนวนอาสาสมัคร</h4>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="mb-1">
                                                        <fieldset>
                                                            <div class="radio dn">
                                                                <input type="radio" class="checkbox-input" id="radio_0" name="radio_1" value="na" checked>>
                                                            </div>
                                                            <div class="radio">
                                                                <input type="radio" class="checkbox-input" id="radio_1" name="radio_1" value="1" <?php if(($pgStatus) && ($resProgress['rp5_qs1'] == '1')){ echo "checked"; }?>>
                                                                <label for="radio_1" class="text-dark">1. โครงการไม่เกี่ยวกับอาสาสมัคร (เช่น Retrospective ไม่มีข้อมูลระบุตัวตน)</label>
                                                            </div>
                                                        </fieldset>
                                                        <div class="pt-1 mb-2 <?php if(($pgStatus) && ($resProgress['rp5_qs1'] == '1')){}else{ echo "dn"; }?>" id="hd1">
                                                            <textarea name="txtQ1" id="txtQ1" cols="30" rows="4" placeholder="ระบุหมายเหตุ" class="form-control"><?php if(($pgStatus) && ($resProgress['rp5_qs1'] == '1')){ echo $resProgress['rp5_qs1_remak']; } ?></textarea>
                                                        </div>
                                                    </div>

                                                    <div>
                                                        <fieldset>
                                                            <div class="radio">
                                                                <input type="radio" class="checkbox-input" id="radio_2" name="radio_1" value="2" <?php if(($pgStatus) && ($resProgress['rp5_qs1'] == '2')){ echo "checked"; }?>>
                                                                <label for="radio_2" class="text-dark">2. โครงการเกี่ยวข้องกับการมีอาสาสมัคร <span class="text-danger">(กรอกตัวเลขทุกช่อง ถ้าไม่มีให้ใส่เลข 0)</span></label>
                                                            </div>
                                                        </fieldset>
                                                        <div class="pt-1 mb-2 pl-2 <?php if(($pgStatus) && ($resProgress['rp5_qs1'] == '2')){}else{ echo "dn"; }?> " id="hd2">
                                                            <div class="form-group row align-items-center">
                                                                <div class="col-lg-7 col-6">
                                                                    <label for="first-name" class="col-form-label text-dark" style="font-size: 1em;">- จำนวนอาสาสมัครที่ EC รับรอง : <span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-lg-5 col-6">
                                                                    <input type="number" class="form-control" name="txtQ2_1" id="txtQ2_1" min="0" value="<?php if($pgStatus){ echo $resProgress['rp5_qs2_1']; } ?>" />
                                                                </div>
                                                            </div>

                                                            <div class="form-group row align-items-center">
                                                                <div class="col-lg-7 col-6">
                                                                    <label for="first-name" class="col-form-label text-dark" style="font-size: 1em;">- จำนวนที่เซ็นยินยอม : <span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-lg-5 col-6">
                                                                    <input type="number" class="form-control" name="txtQ2_2" id="txtQ2_2"  min="0"  value="<?php if($pgStatus){ echo $resProgress['rp5_qs2_2']; } ?>" />
                                                                </div>
                                                            </div>

                                                            <div class="form-group row align-items-center">
                                                                <div class="col-lg-7 col-6">
                                                                    <label for="first-name" class="col-form-label text-dark" style="font-size: 1em;">- จำนวนที่ไม่ผ่านคัดกรอง : <span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-lg-5 col-6">
                                                                    <input type="number"  class="form-control" name="txtQ2_3" id="txtQ2_3" min="0"  value="<?php if($pgStatus){ echo $resProgress['rp5_qs2_3']; } ?>" />
                                                                </div>
                                                            </div>

                                                            <div class="form-group row align-items-center">
                                                                <div class="col-lg-7 col-6">
                                                                    <label for="first-name" class="col-form-label text-dark" style="font-size: 1em;">- จำนวนที่ถอนตัว : <span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-lg-5 col-6">
                                                                    <input type="number"  class="form-control" name="txtQ2_4" id="txtQ2_4" min="0"  value="<?php if($pgStatus){ echo $resProgress['rp5_qs2_4']; } ?>" />
                                                                </div>
                                                            </div>

                                                            <div class="form-group row align-items-center">
                                                                <div class="col-lg-7 col-6">
                                                                    <label for="first-name" class="col-form-label text-dark" style="font-size: 1em;">- จำนวนที่เสียชีวิต : <span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-lg-5 col-6">
                                                                    <input type="number"  class="form-control" name="txtQ2_5" id="txtQ2_5" min="0"  value="<?php if($pgStatus){ echo $resProgress['rp5_qs2_5']; } ?>"/>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row align-items-center">
                                                                <div class="col-lg-7 col-6">
                                                                    <label for="first-name" class="col-form-label text-dark" style="font-size: 1em;">- จำนวนที่อยู่จนสิ้นสุดการศึกษา : <span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-lg-5 col-6">
                                                                    <input type="number"  class="form-control" name="txtQ2_6" id="txtQ2_6" min="0"  value="<?php if($pgStatus){ echo $resProgress['rp5_qs2_6']; } ?>" />
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-sm-6">
                                                    <div>
                                                        <span class="text-dark" style="font-size: 1.05em;">3. จำนวนอาสาสมัครที่เกิด <span class="text-danger">Serious adverse event (ถ้าไม่มีให้ใส่เลข 0)</span></span>
                                                        <div class="pt-1 mb-2 pl-2">
                                                            <div class="form-group row align-items-center">
                                                                <div class="col-lg-7 col-6">
                                                                    <label for="first-name" class="col-form-label text-dark" style="font-size: 1em;">- อาสาสมัครในสถานวิจัย : <span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-lg-5 col-6">
                                                                    <input type="number" id="txtQ3_1" class="form-control" name="txtQ3_1" placeholder="" min="0" value="<?php if($pgStatus){ echo $resProgress['rp5_qs3_1']; } ?>"  />
                                                                </div>
                                                            </div>

                                                            <div class="form-group row align-items-center">
                                                                <div class="col-lg-7 col-6">
                                                                    <label for="first-name" class="col-form-label text-dark" style="font-size: 1em;">- อาสาสมัครในประเทศ : <span class="text-muted">* ถ้ามี SUSAR</span></label>
                                                                </div>
                                                                <div class="col-lg-5 col-6">
                                                                    <input type="number" id="txtQ3_2" class="form-control" name="txtQ3_2" placeholder="" min="0" value="<?php if($pgStatus){ echo $resProgress['rp5_qs3_2']; } ?>"  />
                                                                </div>
                                                            </div>

                                                            <div class="form-group row align-items-center">
                                                                <div class="col-lg-7 col-6">
                                                                    <label for="first-name" class="col-form-label text-dark" style="font-size: 1em;">- อาสาสมัครทั้งโลก : <span class="text-muted">* ถ้ามี SUSAR</span></label>
                                                                </div>
                                                                <div class="col-lg-5 col-6">
                                                                    <input type="number" id="txtQ3_3" class="form-control" name="txtQ3_3" placeholder="" min="0" value="<?php if($pgStatus){ echo $resProgress['rp5_qs3_3']; } ?>"  />
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <hr>
                                                    <span class="text-dark" style="font-size: 1.05em;">4. ตั้งแต่เริ่มโครงการ เคยมี protocal deviation/violation หรือ compliance issue หรือไม่ <span class="text-danger">*</span></span>
                                                    <div class="pt-2 pb-2">
                                                        <fieldset>
                                                            <div class="radio dn">
                                                                <input type="radio" class="checkbox-input" id="radio_4_0" name="radio_4" value="na" checked >
                                                            </div>

                                                            <div class="radio mb-1">
                                                                <input type="radio" class="checkbox-input" id="radio_4_1" name="radio_4" value="0"  <?php if(($pgStatus) && ($resProgress['rp5_qs4'] == '0')){ echo "checked"; }?>>
                                                                <label for="radio_4_1" class="text-dark">ไม่เคย</label>
                                                            </div>
                                                        </fieldset>
                                                        <fieldset>
                                                            <div class="radio">
                                                                <input type="radio" class="checkbox-input" id="radio_4_2" name="radio_4" value="1" <?php if(($pgStatus) && ($resProgress['rp5_qs4'] == '1')){ echo "checked"; }?>>
                                                                <label for="radio_4_2" class="text-dark">เคย (กรุณาแนบหลักฐานประกอบ)</label>
                                                            </div>
                                                        </fieldset>
                                                        <div class="pt-1 mb-2 dn0"  id="hd52">
                                                            <table class="table table-striped text-dark">
                                                                <thead>
                                                                    <tr class="bg-secondary">
                                                                        <th class="text-white">ชื่อไฟล์</th>
                                                                        <th></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="closing_4">
                                                                    <tr><td colspan="2" class="text-center">ไม่มีไฟล์แนบ</td></tr>
                                                                </tbody>
                                                                <tbody>
                                                                    <tr>
                                                                        <td colspan="2">
                                                                            <div action="#"  id="mydropzone_4" class="dropzone text-center" style="min-height: 50px !important;  background: transparent;border: dashed; border-radius: 10px; border-width: 1px; border-color: #888; ">
                                                                                <div class="fallback">
                                                                                    <input name="file" type="file" multiple />
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <hr>
                                                    <span class="text-dark" style="font-size: 1.05em;">5. ตั้งแต่เริ่มโครงการ เคยมีเรื่องร้องเรียนเกี่ยวกับโครงการหรือไม่ <span class="text-danger">*</span></span>
                                                    <div class="pt-2 pb-2">
                                                        <fieldset>
                                                            <div class="radio dn">
                                                                <input type="radio" class="checkbox-input" id="radio_5_0" name="radio_5" value="na" checked >
                                                            </div>
                                                            <div class="radio mb-1">
                                                                <input type="radio" class="checkbox-input" id="radio_5_1" name="radio_5" value="0"  <?php if(($pgStatus) && ($resProgress['rp5_qs5'] == '0')){ echo "checked"; }?>>
                                                                <label for="radio_5_1" class="text-dark">ไม่เคย</label>
                                                            </div>
                                                        </fieldset>
                                                        <fieldset>
                                                            <div class="radio">
                                                                <input type="radio" class="checkbox-input" id="radio_5_2" name="radio_5" value="1"  <?php if(($pgStatus) && ($resProgress['rp5_qs5'] == '1')){ echo "checked"; }?>>
                                                                <label for="radio_5_2" class="text-dark">เคย (กรุณาแนบหลักฐานประกอบ)</label>
                                                            </div>
                                                            
                                                        </fieldset>
                                                        <div class="pt-1 mb-2 dn0"  id="hd52">
                                                            <table class="table table-striped text-dark">
                                                                <thead>
                                                                    <tr class="bg-secondary">
                                                                        <th class="text-white">ชื่อไฟล์</th>
                                                                        <th></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="closing_5">
                                                                    <tr><td colspan="2" class="text-center">ไม่มีไฟล์แนบ</td></tr>
                                                                </tbody>
                                                                <tbody>
                                                                    <tr>
                                                                        <td colspan="2">
                                                                            <div action="#"  id="mydropzone_5" class="dropzone text-center" style="min-height: 50px !important;  background: transparent;border: dashed; border-radius: 10px; border-width: 1px; border-color: #888; ">
                                                                                <div class="fallback">
                                                                                    <input name="file" type="file" multiple />
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                <hr>
                                                    <span class="text-dark" style="font-size: 1.05em;">6. การนำเสนอผล มี<u>ข้อมูลระบุตัวตน</u> หรือมีโอกาสที่จะเกิดผล<u>กระทบเชิงลบ</u>ต่ออาสาสมัครหรือชุมชนของอาสาสมัครหรือไม่ <span class="text-danger">*</span></span>
                                                    <div class="pt-2 pb-2">
                                                        <fieldset>
                                                            <div class="radio dn">
                                                                <input type="radio" class="checkbox-input" id="radio_6_0" name="radio_6" value="na" checked >
                                                            </div>
                                                            <div class="radio mb-1">
                                                                <input type="radio" class="checkbox-input" id="radio_6_1" name="radio_6" value="0"  <?php if(($pgStatus) && ($resProgress['rp5_qs6'] == '0')){ echo "checked"; }?>>
                                                                <label for="radio_6_1" class="text-dark">โครงการไม่เกี่ยวข้องกับอาสาสมัคร</label>
                                                            </div>
                                                        </fieldset>
                                                        <fieldset>
                                                            <div class="radio mb-1">
                                                                <input type="radio" class="checkbox-input" id="radio_6_2" name="radio_6" value="1" <?php if(($pgStatus) && ($resProgress['rp5_qs6'] == '1')){ echo "checked"; }?>>
                                                                <label for="radio_6_2" class="text-dark">ไม่มีความเสี่ยง</label>
                                                            </div>
                                                        </fieldset>
                                                        <fieldset>
                                                            <div class="radio">
                                                                <input type="radio" class="checkbox-input" id="radio_6_3" name="radio_6" value="2" <?php if(($pgStatus) && ($resProgress['rp5_qs6'] == '2')){ echo "checked"; }?>>
                                                                <label for="radio_6_3" class="text-dark">มีความเสี่ยงบ้าง และมีแผนลดควาามเสี่ยง คือ </label>
                                                            </div>
                                                            <div class="pt-1 mb-2 <?php if(($pgStatus) && ($resProgress['rp5_qs6'] == '2')){}else{ echo "dn"; }?>"  id="hd63">
                                                                <textarea name="txtQ6" id="txtQ6" cols="30" rows="4" placeholder="ระบุแผนลดควาามเสี่ยง" class="form-control"><?php if(($pgStatus) && ($resProgress['rp5_qs6'] == '2')){ echo $resProgress['rp5_qs6_info']; } ?></textarea>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <hr>
                                                    <span class="text-dark" style="font-size: 1.05em;">7. มีแผนการติดตามและดูแลอาสาสมัครหลังสิ้นสุดโครงการอย่างไร <span class="text-danger">*</span></span>
                                                    <div class="pt-2 pb-2">
                                                        <fieldset>
                                                            <div class="radio dn">
                                                                <input type="radio" class="checkbox-input" id="radio_7_0" name="radio_7" value="na" checked >
                                                            </div>
                                                            <div class="radio mb-1">
                                                                <input type="radio" class="checkbox-input" id="radio_7_1" name="radio_7" value="0" <?php if(($pgStatus) && ($resProgress['rp5_qs7'] == '0')){ echo "checked"; }?>>
                                                                <label for="radio_7_1" class="text-dark">โครงการไม่เกี่ยวข้องกับอาสาสมัคร</label>
                                                            </div>
                                                        </fieldset>
                                                        <fieldset>
                                                            <div class="radio mb-1">
                                                                <input type="radio" class="checkbox-input" id="radio_7_2" name="radio_7" value="1" <?php if(($pgStatus) && ($resProgress['rp5_qs7'] == '1')){ echo "checked"; }?>>
                                                                <label for="radio_7_2" class="text-dark">ไม่มีแผน <span class="text-danger">ต้องชี้แจงเหตุผล</span></label>
                                                            </div>
                                                            <div class="pt-1 mb-2 <?php if(($pgStatus) && ($resProgress['rp5_qs7'] == '1')){}else{ echo "dn"; }?>" id="hd72">
                                                                <textarea name="txtQ7_1" id="txtQ7_1" cols="30" rows="4" placeholder="ระบุเหตุผล" class="form-control"><?php if(($pgStatus) && ($resProgress['rp5_qs7'] == '1')){ echo $resProgress['rp5_qs7_info_1']; } ?></textarea>
                                                            </div>
                                                        </fieldset>
                                                        <fieldset>
                                                            <div class="radio">
                                                                <input type="radio" class="checkbox-input" id="radio_7_3" name="radio_7" value="2" <?php if(($pgStatus) && ($resProgress['rp5_qs7'] == '2')){ echo "checked"; }?>>
                                                                <label for="radio_7_3" class="text-dark">มีแผนการจัดการและดูแล คือ </label>
                                                            </div>
                                                            <div class="pt-1 mb-2 <?php if(($pgStatus) && ($resProgress['rp5_qs7'] == '2')){}else{ echo "dn"; }?>" id="hd73">
                                                                <textarea name="txtQ7_2" id="txtQ7_2" cols="30" rows="4" placeholder="ระบุแผนการจัดการและดูแล" class="form-control"><?php if(($pgStatus) && ($resProgress['rp5_qs7'] == '2')){ echo $resProgress['rp5_qs7_info_2']; } ?></textarea>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <hr>
                                                    <span class="text-dark" style="font-size: 1.05em;">8. Final report <span class="text-danger">*</span></span>
                                                    <div class="pt-1 mb-2 dn0"  id="hd52">
                                                            <table class="table table-striped text-dark">
                                                                <thead>
                                                                    <tr class="bg-secondary">
                                                                        <th class="text-white">ชื่อไฟล์</th>
                                                                        <th></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="closing_8">
                                                                    <tr><td colspan="2" class="text-center">ยังไม่มีไฟล์ Final report แนบ</td></tr>
                                                                </tbody>
                                                                <tbody>
                                                                    <tr>
                                                                        <td colspan="2">
                                                                            <div action="#"  id="mydropzone_8" class="dropzone text-center" style="min-height: 50px !important;  background: transparent;border: dashed; border-radius: 10px; border-width: 1px; border-color: #888; ">
                                                                                <div class="fallback">
                                                                                    <input name="file" type="file" multiple />
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <hr>
                                                    <span class="text-dark" style="font-size: 1.05em;">9. Manuscript <span class="text-danger">หากไม่มี เจ้าหน้าที่จะบันทึกว่านักวิจัยค้างส่ง</span></span>
                                                    <div class="pt-1 mb-2 dn0"  id="hd52">
                                                            <table class="table table-striped text-dark">
                                                                <thead>
                                                                    <tr class="bg-secondary">
                                                                        <th class="text-white">ชื่อไฟล์</th>
                                                                        <th></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="closing_9">
                                                                    <tr><td colspan="2" class="text-center">ยังไม่มีไฟล์ Manuscript แนบ</td></tr>
                                                                </tbody>
                                                                <tbody>
                                                                    <tr>
                                                                        <td colspan="2">
                                                                            <div action="#"  id="mydropzone_9" class="dropzone text-center" style="min-height: 50px !important;  background: transparent;border: dashed; border-radius: 10px; border-width: 1px; border-color: #888; ">
                                                                                <div class="fallback">
                                                                                    <input name="file" type="file" multiple />
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                </div>
                                                <div class="col-12">
                                                    <hr>
                                                    <h4 class="py-50 text-dark">การดำเนินการ</h4>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="" style="font-size: 1em;">ผลการตรวจสอบ : <span class="text-danger">*</span></label>
                                                                <select name="txtReturn" id="txtReturn" class="form-control">
                                                                    <option value="">-- เลือกผลการตรวจสอบ --</option>
                                                                    <option value="1">เอกสารถูกไม่ต้อง ส่งนักวิจัยเพื่อแก้ไข</option>
                                                                    <option value="2">เอกสารถูกต้อง ส่งต่อเลขา ฯ</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="" style="font-size: 1em;">บันทึกถึงนักวิจัยหรือเลขา ฯ : <span class="text-danger">*</span></label>
                                                                <textarea name="txtComment" id="txtComment" cols="30" rows="10" class="form-control"></textarea>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 text-center pt-2">
                                                    <!-- <hr> -->
                                                    <button class="btn btn-danger btn-lg round" onclick="form9.addStage1Result()">บันทึกและส่ง</button>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <!-- body content of step 2 end-->
                                    </form>
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
    <script src="../../../app-assets/vendors/js/extensions/jquery.steps.min.js"></script>
    <script src="../../../app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
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
    <script src="../../../tools/dropzone/dist/min/dropzone.min.js"></script>
    <script src="../../../tools/ckeditor_lite/ckeditor.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/horizontal-menu.js"></script>
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>

    <script src="../../../app-assets/js/scripts/forms/wizard-steps.js"></script>
    
    <!-- END: Theme JS-->
    <!-- RMIS Continuing Script  -->
    <script src="../../../assets/1.0.1/js/core.js?v=<?php echo filemtime('../../../assets/1.0.1/js/core.js'); ?>"></script>
    <script src="../../../assets/1.0.1/js/user.js?v=<?php echo filemtime('../../../assets/1.0.1/js/user.js'); ?>"></script>
    <script src="../../../assets/1.0.1/js/project.js?v=<?php echo filemtime('../../../assets/1.0.1/js/project.js'); ?>"></script>
    <script src="../../../assets/1.0.1/js/continuing.js?v=<?php echo filemtime('../../../assets/1.0.1/js/continuing.js'); ?>"></script>
    <script src="../../../assets/1.0.1/js/progress_closing.js?v=<?php echo filemtime('../../../assets/1.0.1/js/progress_closing.js'); ?>"></script>
    <!-- BEGIN: Page JS-->
    <!-- END: Page JS-->

    <script>

        var comment = ''
        if($("#txtComment").length) {
            comment = CKEDITOR.replace( 'txtComment', {
                height: '100px'
            });
        }
        
        $(document).ready(function(){
            project.getInfo($('#txtPid').val())
            getFileProgressSubmissionList($('#txtUid').val(), $('#txtSessionID').val(), 'closing', '4')
            getFileProgressSubmissionList($('#txtUid').val(), $('#txtSessionID').val(), 'closing', '5')
            getFileProgressSubmissionList($('#txtUid').val(), $('#txtSessionID').val(), 'closing', '8')
            getFileProgressSubmissionList($('#txtUid').val(), $('#txtSessionID').val(), 'closing', '9')
        })
    </script>

</body>
<!-- END: Body-->

</html>