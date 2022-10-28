<?php 
require('../../../configuration/server.inc.php');
require('../../../configuration/configuration.php');
require('../../../configuration/database.php'); 
require('../../../configuration/session.php'); 

$purpose_role = 'pm';
if($purpose_role != $_SESSION['rmis_role']){
    header('Location: '. ROOT_DOMAIN .'application/html/core/login.php');
    die();
}

$db = new Database();
$conn = $db->conn();

require('../../../configuration/user.inc.php'); 


if(isset($_REQUEST['id_rs'])){
    $id_rs = mysqli_real_escape_string($conn, $_REQUEST['id_rs']);
}else{
    header('Location: ./');
    die();
}

if(isset($_REQUEST['session_id'])){
    $session_id = mysqli_real_escape_string($conn, $_REQUEST['session_id']);
}else{
    header('Location: ./');
    die();
}

$strSQL = "SELECT * FROM research WHERE id_rs = '$id_rs'";
$resResearch = $db->fetch($strSQL, false, false);
if(!$resResearch){
    header('Location: ./');
    die();
}

$strSQL = "SELECT * FROM rec_progress WHERE rp_id_rs = '$id_rs' AND rp_session = '$session_id' AND rp_delete_status = '0'";
$resProgress0 = $db->fetch($strSQL, false, false);
if(!$resProgress0){
    header('Location: ./');
    die();
}
$pgStatus = false;

$strSQL = "SELECT * FROM rec_progress_closing WHERE rpx_session = '$session_id' LIMIT 1";
$resProgress = $db->fetch($strSQL, false);
$pgStatus = false;
if($resProgress){
    $pgStatus = true;
}

?>

<input type="hidden" id="txtSessionID" value="<?php echo $session_id; ?>">
<input type="hidden" id="txtPid" value="<?php echo $id_rs; ?>">

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
    <title>RMIS@MED PSU for PI</title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai:wght@100;300;400&display=swap" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/charts/apexcharts.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/extensions/dragula.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/components.css">
    <!-- END: Theme CSS-->

    
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/widgets.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/extensions/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/preload.js/dist/css/preload.css">
    <link rel="stylesheet" type="text/css" href="../../../tools/dropzone/dist/min/dropzone.min.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css?v=<?php echo filemtime('../../../assets/css/style.css'); ?>">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<style>
    body.dark-layout .card {
        background-color: #272e48;
        box-shadow: none !important;
    }
</style>
<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern dark-layout 2-columns  navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="dark-layout">

    <!-- BEGIN: Header-->
    <div class="header-navbar-shadow"></div>
    <?php require('./comp/header.php'); ?>
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto"><a class="navbar-brand" href="../../../html/ltr/vertical-menu-template-dark/index.html">
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
                        <h2 class="brand-text mb-0"><span class="text-success">RMIS</span>@<span class="text-dark">PSU</span></h2>
                    </a></li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="bx bx-x d-block d-xl-none font-medium-4 primary"></i><i class="toggle-icon bx bx-disc font-medium-4 d-none d-xl-block primary" data-ticon="bx-disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="lines">
                
                <li class="nav-item"><a href="./" class="text-white"><i class="menu-livicon" data-icon="home"></i><span class="menu-title text-truncate" data-i18n="Email">หน้าแรก</span></a></li>
                <li class="nav-item"><a href="./app-search" class="text-white"><i class="menu-livicon" data-icon="search"></i><span class="menu-title text-truncate" data-i18n="Email">ค้นหาข้อมูล</span></a></li>

                
                
                <li class="navigation-header text-truncate"><span data-i18n="Support">สนับสนุน</span>
                </li>
                <li class="nav-item"><a href="page-knowledge-base"  class="text-white"target="_blank"><i class="menu-livicon" data-icon="info-alt"></i><span class="menu-title text-truncate" data-i18n="Documentation">ข้อมูลการใช้งาน</span></a>
                </li>
                <li class="nav-item"><a href="https://rmis2.medicine.psu.ac.th/documentation/" class="text-white" target="_blank"><i class="menu-livicon" data-icon="morph-folder"></i><span class="menu-title text-truncate" data-i18n="Documentation">คู่มือการใช้งาน</span></a>
                </li>
            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">

            <div class="content-header row">
                <div class="content-header-left col-12 mb-2 mt-1 pl-sm-1 pr-sm-1 pl-3 pr-3 pt-2 pt-sm-0">
                    <h3 class="text-dark">รายงานปิดโครงการวิจัย (Project closing report)</h3>
                    <div class="breadcrumbs-top">
                        <div class="breadcrumb-wrapper d-none d-sm-block">
                            <ol class="breadcrumb p-0 mb-0 pl-1">
                                <li class="breadcrumb-item"><a href="./"><i class="bx bx-home-alt"></i> หน้าแรก</a></li>
                                <li class="breadcrumb-item"><a href="./rec-all">โครงการที่อยู่ระหว่างดำเนินการวิจัย</a></li>
                                <li class="breadcrumb-item"><a href="./rec-report-list?id_rs=<?php echo $id_rs; ?>">REC.<?php echo $resResearch['code_apdu']; ?></a></li>
                                <li class="breadcrumb-item active"><?php echo $resProgress0['rp_progress_id']; ?>-<?php echo $session_id; ?></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-body" >
                <div class="card">
                    <div class="card-header bg-secondary text-dark">
                        <h4 class="mb-0 text-white">ข้อมูลโครงการวิจัย</h4>
                    </div>
                    <div class="card-body bg-white text-dark pt-2">
                        <div class="row">
                            <div class="col-12 col-sm-3">
                                รหัสโครงการ : 
                            </div>
                            <div class="col-12 col-sm-3">
                                <span class="badge badge-danger round">REC.<?php echo $resResearch['code_apdu']; ?></span>
                            </div>
                            <div class="col-12 col-sm-3">
                            ประเภทการพิจารณา : 
                            </div>
                            <div class="col-12 col-sm-3">
                                <span class="badge badge-danger round"><?php 
                                $strSQL = "SELECT rct_type FROM research_consider_type WHERE rct_id_rs = '$id_rs'";
                                $resType = $db->fetch($strSQL, false, false);
                                if($resType) echo $resType['rct_type']; else echo "NA";
                                ?></span>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-12 col-sm-3">
                                ชื่อโครงการวิจัย: 
                            </div>
                            <div class="col-12 col-sm-9">
                                <?php
                                if($resResearch['title_th'] != '-'){
                                    ?>
                                    <a href="#" class="text-dark"><?php echo "<h5 class='text-dark mb-0'>".$resResearch['title_th']. "<br><br><span class='text-muted'>".$resResearch['title_en']."</span></h5>"; ?></a>
                                    <?php
                                }else{
                                    echo $resResearch['title_en'];
                                }
                                ?>
                            </div>
                        </div>
                        <?php 
                        if(($resProgress0['rp_progress_status'] == '2') || ($resProgress0['rp_progress_status'] == '20') ){
                            ?>
                            <div class="row mt-1">
                                <div class="col-12 col-sm-3">ข้อความจากสำนักงาน :</div>
                                <div class="col-12 col-sm-9 text-danger">
                                    <?php 
                                    $strSQL = "SELECT * FROM rec_progress_log WHERE rpl_session = '".$resProgress0['rp_session']."' AND rpl_relate_status IN ('2', '20') ORDER BY rpl_datetime DESC LIMIT 1";
                                    $res = $db->fetch($strSQL, false, false);
                                    if($res){
                                        echo $res['rpl_activity']."<br>--------------------<br>".$res['rpl_message'];
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header bg-secondary">
                        <h4 class="mb-0 text-white">แบบฟอร์มรายงานปิดโครงการ</h4>
                    </div>
                    
                    <div class="card-body bg-white pt-1 text-dark">
                        <form action="#" >
                            <fieldset>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="mb-0">
                                            <p>1. โครงการนี้เป็นโครงการที่<span class="text-danger" style="font-size: 1.5em;">ไม่เกี่ยวกับอาสาสมัคร</span> (เช่น Retrospective ไม่มีข้อมูลระบุตัวตน) ใช่หรือไม่</p>
                                            <ul class="list-unstyled mb-0">
                                                <li class="d-inline-block mr-2 mb-1">
                                                    <fieldset class="dn">
                                                        <div class="radio radio-success">
                                                            <input type="radio" name="radio_1" id="radio_1_0" value="na" checked>
                                                            <label for="radio_1_0">ใช่</label>
                                                        </div>
                                                    </fieldset>
                                                </li>
                                                <li class="d-inline-block mr-2 mb-1">
                                                    <fieldset>
                                                        <div class="radio radio-success">
                                                            <input type="radio" name="radio_1" id="radio_1_1" value="1" <?php if(($pgStatus) && ($resProgress['rp5_qs1'] == '1')){ echo "checked"; }?>>
                                                            <label for="radio_1_1" class="text-dark">ใช่</label>
                                                        </div>
                                                    </fieldset>
                                                </li>
                                                <li class="d-inline-block mr-2 mb-1">
                                                    <fieldset>
                                                        <div class="radio radio-success">
                                                            <input type="radio" name="radio_1" id="radio_1_2" value="0" <?php if(($pgStatus) && ($resProgress['rp5_qs1'] == '0')){ echo "checked"; }?>>
                                                            <label for="radio_1_2" class="text-dark">ไม่ใช่ (มีอาสาสมัครในการวิจัย)</label>
                                                        </div>
                                                    </fieldset>
                                                </li>
                                            </ul>

                                            <div class="pt-0 mb-1 <?php if(($pgStatus) && ($resProgress['rp5_qs1'] == '1')){}else{ echo "dn"; }?>" id="hd1">
                                                <textarea name="txtQ1" id="txtQ1" cols="30" rows="4" placeholder="ระบุหมายเหตุ" class="form-control"><?php if(($pgStatus) && ($resProgress['rp5_qs1'] == '1')){ echo $resProgress['rp5_qs1_remak']; } ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 <?php if(($pgStatus) && ($resProgress['rp5_qs1'] == '0')){  }else{ echo "dn"; }?>" id="hd2">
                                        <div>
                                            <div class="row">
                                                <div class="col-12"><span class="text-dark" style="font-size: 1.05em;">2. กรณีที่โครงการมีอาสาสมัคร กรุณากรอกจำนวนอาสาสมัครต่อไปนี้ <span class="text-danger">*</span></span></div>
                                                <div class="col-12">
                                                    <div class="" style="padding: 10px; border: dashed; border-radius: 10px; border-width: 1px 1px 1px 1px; border-color: #ccc;">
                                                        <div class="row">
                                                            <div class="col-12 col-sm-6 pt-1">
                                                                <p>2.1 โครงการเกี่ยวข้องกับการมีอาสาสมัคร <span class="text-danger">(กรอกตัวเลขทุกช่อง ถ้าไม่มีให้ใส่เลข 0)</span></p>
                                                                <div class="pt-1 mb-2 pl-2">
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

                                                            <div class="col-6">
                                                                <div class="row">
                                                                    <div class="col-12 pt-1">
                                                                        <p>2.2 จำนวนอาสาสมัครที่เกิด <span class="text-danger">Serious adverse event (ถ้าไม่มีให้ใส่เลข 0)</span></p>
                                                                        <div class="pt-1 mb-2 pl-2">
                                                                            <div class="form-group row align-items-center">
                                                                                <div class="col-lg-7 col-6">
                                                                                    <label for="first-name" class="col-form-label text-dark" style="font-size: 1em;">- อาสาสมัครในสถานวิจัย : <span class="text-danger">*</span></label>
                                                                                </div>
                                                                                <div class="col-lg-5 col-6">
                                                                                    <input type="number" id="txtQ3_1" class="form-control" name="txtQ3_1" placeholder=""  min="0" value="<?php if($pgStatus){ echo $resProgress['rp5_qs3_1']; } ?>"  />
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row align-items-center">
                                                                                <div class="col-lg-7 col-6">
                                                                                    <label for="first-name" class="col-form-label text-dark" style="font-size: 1em;">- อาสาสมัครในประเทศ : <span class="text-muted">* ถ้ามี SUSAR</span></label>
                                                                                </div>
                                                                                <div class="col-lg-5 col-6">
                                                                                    <input type="number" id="txtQ3_2" class="form-control" name="txtQ3_2" placeholder=""  min="0" value="<?php if($pgStatus){ echo $resProgress['rp5_qs3_2']; } ?>"  />
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
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <hr>
                                        <span class="text-dark" style="font-size: 1.05em;">2. ตั้งแต่เริ่มโครงการ เคยมี protocol deviation/violation หรือ compliance issue หรือไม่ <span class="text-danger">*</span></span>
                                        <div class="pt-2 pb-0">
                                            <ul class="list-unstyled mb-0">
                                                <li class="d-inline-block mr-2 mb-1">
                                                    <fieldset class="dn">
                                                        <div class="radio radio-success">
                                                            <input type="radio" name="radio_4" id="radio_4_0" value="na" checked>
                                                            <label for="radio_4_0">ใช่</label>
                                                        </div>
                                                    </fieldset>
                                                </li>
                                                <li class="d-inline-block mr-2 mb-1">
                                                    <fieldset>
                                                        <div class="radio radio-success">
                                                            <input type="radio" name="radio_4" id="radio_4_1" value="0" <?php if(($pgStatus) && ($resProgress['rp5_qs4'] == '0')){ echo "checked"; }?>>
                                                            <label for="radio_4_1" class="text-dark">ไม่เคย</label>
                                                        </div>
                                                    </fieldset>
                                                </li>
                                                <li class="d-inline-block mr-2 mb-1">
                                                    <fieldset>
                                                        <div class="radio radio-success">
                                                            <input type="radio" name="radio_4" id="radio_4_2" value="1" <?php if(($pgStatus) && ($resProgress['rp5_qs4'] == '1')){ echo "checked"; }?>>
                                                            <label for="radio_4_2" class="text-dark">เคย (กรุณาแนบหลักฐานประกอบ)</label>
                                                        </div>
                                                    </fieldset>
                                                </li>
                                            </ul>

                                            
                                            <div class="pt-1 mb-0 <?php if(($pgStatus) && ($resProgress['rp5_qs4'] == '1')){  }else{ echo "dn"; }?>"  id="hd42">
                                                <div class="row">
                                                    <div class="col-12 text-left pt-1 pb-1">
                                                        <button class="btn btn-secondary" type="button" onclick="showUploadModal('4')"><i class="bx bx-upload"></i> คลิกที่นี่เพื่ออัพโหลด</button>
                                                    </div>
                                                </div>
                                                <table class="table table-striped text-dark">
                                                    <thead>
                                                        <tr class="bg-light">
                                                            <th class="text-dark">ชื่อไฟล์</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="closing_4"><tr><td colspan="2" class="text-center">ไม่มีไฟล์แนบ</td></tr></tbody>
                                                </table>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <hr>
                                        <span class="text-dark" style="font-size: 1.05em;">3. ตั้งแต่เริ่มโครงการ เคยมีเรื่องร้องเรียนเกี่ยวกับโครงการหรือไม่ <span class="text-danger">*</span></span>
                                        <div class="pt-2 pb-0">
                                            <ul class="list-unstyled mb-0">
                                                <li class="d-inline-block mr-2 mb-1">
                                                    <fieldset class="dn">
                                                        <div class="radio radio-success">
                                                            <input type="radio" name="radio_5" id="radio_5_0" value="na" checked>
                                                            <label for="radio_5_0">ใช่</label>
                                                        </div>
                                                    </fieldset>
                                                </li>
                                                <li class="d-inline-block mr-2 mb-1">
                                                    <fieldset>
                                                        <div class="radio radio-success">
                                                            <input type="radio" name="radio_5" id="radio_5_1" value="0" <?php if(($pgStatus) && ($resProgress['rp5_qs5'] == '0')){ echo "checked"; }?>>
                                                            <label for="radio_5_1" class="text-dark">ไม่เคย</label>
                                                        </div>
                                                    </fieldset>
                                                </li>
                                                <li class="d-inline-block mr-2 mb-1">
                                                    <fieldset>
                                                        <div class="radio radio-success">
                                                            <input type="radio" name="radio_5" id="radio_5_2" value="1" <?php if(($pgStatus) && ($resProgress['rp5_qs5'] == '1')){ echo "checked"; }?>>
                                                            <label for="radio_5_2" class="text-dark">เคย (กรุณาแนบหลักฐานประกอบ)</label>
                                                        </div>
                                                    </fieldset>
                                                </li>
                                            </ul>

                                            
                                            <div class="pt-0 mb-2  <?php if(($pgStatus) && ($resProgress['rp5_qs5'] == '1')){  }else{ echo "dn"; }?>"  id="hd52">
                                                <div class="row">
                                                    <div class="col-12 text-left pt-1 pb-1">
                                                        <button class="btn btn-secondary" type="button" onclick="showUploadModal('5')"><i class="bx bx-upload"></i> คลิกที่นี่เพื่ออัพโหลด</button>
                                                    </div>
                                                </div>
                                                <table class="table table-striped text-dark">
                                                    <thead>
                                                        <tr class="bg-light">
                                                            <th class="text-dark">ชื่อไฟล์</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="closing_5"><tr><td colspan="2" class="text-center">ไม่มีไฟล์แนบ</td></tr></tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                    <hr>
                                        <span class="text-dark" style="font-size: 1.05em;">4. การนำเสนอผล มี<u class="text-danger">ข้อมูลระบุตัวตน</u> หรือมีโอกาสที่จะเกิดผล<u>กระทบเชิงลบ</u>ต่ออาสาสมัครหรือชุมชนของอาสาสมัครหรือไม่ <span class="text-danger">*</span></span>
                                        <div class="pt-2 pb-2">
                                            <fieldset>
                                                <div class="radio dn">
                                                    <input type="radio" class="checkbox-input" id="radio_6_0" name="radio_6" value="na" checked >
                                                </div>
                                                <div class="radio mb-1 radio-success">
                                                    <input type="radio" class="checkbox-input" id="radio_6_1" name="radio_6" value="0"  <?php if(($pgStatus) && ($resProgress['rp5_qs6'] == '0')){ echo "checked"; }?>>
                                                    <label for="radio_6_1" class="text-dark">โครงการไม่เกี่ยวข้องกับอาสาสมัคร</label>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <div class="radio mb-1 radio-success">
                                                    <input type="radio" class="checkbox-input" id="radio_6_2" name="radio_6" value="1" <?php if(($pgStatus) && ($resProgress['rp5_qs6'] == '1')){ echo "checked"; }?>>
                                                    <label for="radio_6_2" class="text-dark">ไม่มีความเสี่ยง</label>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <div class="radio radio-success">
                                                    <input type="radio" class="checkbox-input" id="radio_6_3" name="radio_6" value="2" <?php if(($pgStatus) && ($resProgress['rp5_qs6'] == '2')){ echo "checked"; }?>>
                                                    <label for="radio_6_3" class="text-dark">มีความเสี่ยงบ้าง และมีแผนลดควาามเสี่ยง คือ </label>
                                                </div>
                                                <div class="pt-1 mb-2 <?php if(($pgStatus) && ($resProgress['rp5_qs6'] == '2')){}else{ echo "dn"; }?>"  id="hd63">
                                                    <textarea name="txtQ6" id="txtQ6" cols="30" rows="4" placeholder="ระบุแผนลดควาามเสี่ยง" class="form-control"><?php if(($pgStatus) && ($resProgress['rp5_qs6'] == '2')){ echo $resProgress['rp5_qs6_info']; } ?></textarea>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <hr>
                                        <span class="text-dark" style="font-size: 1.05em;">5. มีแผนการติดตามและดูแลอาสาสมัครหลังสิ้นสุดโครงการอย่างไร <span class="text-danger">*</span></span>
                                        <div class="pt-2 pb-2">
                                            <fieldset>
                                                <div class="radio dn">
                                                    <input type="radio" class="checkbox-input" id="radio_7_0" name="radio_7" value="na" checked >
                                                </div>
                                                <div class="radio mb-1 radio-success">
                                                    <input type="radio" class="checkbox-input" id="radio_7_1" name="radio_7" value="0" <?php if(($pgStatus) && ($resProgress['rp5_qs7'] == '0')){ echo "checked"; }?>>
                                                    <label for="radio_7_1" class="text-dark">โครงการไม่เกี่ยวข้องกับอาสาสมัคร</label>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <div class="radio mb-1 radio-success">
                                                    <input type="radio" class="checkbox-input" id="radio_7_2" name="radio_7" value="1" <?php if(($pgStatus) && ($resProgress['rp5_qs7'] == '1')){ echo "checked"; }?>>
                                                    <label for="radio_7_2" class="text-dark">ไม่มีแผน <span class="text-danger">ต้องชี้แจงเหตุผล</span></label>
                                                </div>
                                                <div class="pt-1 mb-2 <?php if(($pgStatus) && ($resProgress['rp5_qs7'] == '1')){}else{ echo "dn"; }?>" id="hd72">
                                                    <textarea name="txtQ7_1" id="txtQ7_1" cols="30" rows="4" placeholder="ระบุเหตุผล" class="form-control"><?php if(($pgStatus) && ($resProgress['rp5_qs7'] == '1')){ echo $resProgress['rp5_qs7_info_1']; } ?></textarea>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <div class="radio radio-success">
                                                    <input type="radio" class="checkbox-input" id="radio_7_3" name="radio_7" value="2" <?php if(($pgStatus) && ($resProgress['rp5_qs7'] == '2')){ echo "checked"; }?>>
                                                    <label for="radio_7_3" class="text-dark">มีแผนการจัดการและดูแล คือ </label>
                                                </div>
                                                <div class="pt-1 mb-2 <?php if(($pgStatus) && ($resProgress['rp5_qs7'] == '2')){}else{ echo "dn"; }?>" id="hd73">
                                                    <textarea name="txtQ7_2" id="txtQ7_2" cols="30" rows="4" placeholder="ระบุแผนการจัดการและดูแล" class="form-control"><?php if(($pgStatus) && ($resProgress['rp5_qs7'] == '2')){ echo $resProgress['rp5_qs7_info_2']; } ?></textarea>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <hr>
                                        <div class="row">
                                            <div class="col-12"><span class="text-dark" style="font-size: 1.05em;">6. Final report <span class="text-danger"></span></span></div>
                                            <div class="col-12 text-left pt-1">
                                                <button class="btn btn-secondary" type="button"  onclick="showUploadModal('8')"><i class="bx bx-upload"></i> คลิกที่นี่เพื่ออัพโหลด</button>
                                            </div>
                                        </div>
                                        <div class="pt-1 mb-2 dn0"  id="hd52">
                                                <table class="table table-striped text-dark">
                                                    <thead>
                                                        <tr class="bg-light">
                                                            <th class="text-dark">ชื่อไฟล์</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="closing_8"><tr><td colspan="2" class="text-center">ไม่มีไฟล์แนบ</td></tr></tbody>
                                                </table>
                                            </div>
                                    </div>
                                    <div class="col-12">
                                        <hr>
                                        <div class="row">
                                            <div class="col-12" style="padding-top: 10px;">7. Manuscript ที่ตีพิมพ์หรือมีเลข doi แล้ว <span class="text-danger">หากไม่มี เจ้าหน้าที่จะบันทึกว่านักวิจัยค้างส่ง</span></div>
                                            <div class="col-12 text-left">
                                                <button class="btn btn-secondary" type="button"  onclick="showUploadModal('9')"><i class="bx bx-upload"></i> คลิกที่นี่เพื่ออัพโหลด</button>
                                            </div>
                                        </div>
                                        <div class="pt-1 mb-2 dn0">
                                                <table class="table table-striped text-dark">
                                                    <thead>
                                                        <tr class="bg-light">
                                                            <th class="text-dark">ชื่อไฟล์</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="closing_9"><tr><td colspan="2" class="text-center">ไม่มีไฟล์แนบ</td></tr></tbody>
                                                </table>
                                            </div>
                                    </div>

                                    <div class="col-12">
                                        <hr>
                                        <span class="text-dark" style="font-size: 1.05em;">8. สรุปผลการศึกษา <span class="text-danger">ไม่เกิน 3000 คำ ประกอบด้วย Rationale, Objectives, Design, Methods, Results และ Conclusion</span><br><span class="text-danger"><small>(ถ้าเป็นโครงการ Multi-center หรือ อัพโหลดไฟล์ในข้อที่ 8 หรือ 9 ไปแล้ว ไม่ต้องกรอกข้อนี้)</small></span><br></span>
                                        <div class="form-group">
                                            <textarea name="txtQ9" id="txtQ9" cols="30" rows="10" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-12 text-center">
                                                    <hr>
                                        <button type="button" class="btn btn-danger btn-lg round" onclick="form9.send()">บันทึกและส่ง</button>
                                    </div>

                                </div>
                            </fieldset>
                            <!-- body content of step 2 end-->
                        </form>
                    </div>
                </div>
            </div>
        </div>  
    </div>

    <div class="modal fade" id="modalUpload4" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-white" id="exampleModalCenterTitle">อัพโหลดเอกสาร protocol deviation/violation หรือ compliance issue ที่เกี่ยวข้อง</h5>
                </div>
                <div class="modal-body">
                    <div action="#"  id="mydropzone_4" class="dropzone text-center" style="min-height: 50px !important;  background: transparent;border: dashed; border-radius: 10px; border-width: 1px; border-color: #888; ">
                        <div class="fallback">
                            <input name="file" type="file" multiple />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalUpload5" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-white" id="exampleModalCenterTitle">อัพโหลดเอกสารร้องเรียนที่เกี่ยวข้อง</h5>
                </div>
                <div class="modal-body">
                    <div action="#"  id="mydropzone_5" class="dropzone text-center" style="min-height: 50px !important;  background: transparent;border: dashed; border-radius: 10px; border-width: 1px; border-color: #888; ">
                        <div class="fallback">
                            <input name="file" type="file" multiple />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalUpload8" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-white" id="exampleModalCenterTitle">อัพโหลด Final report</h5>
                </div>
                <div class="modal-body">
                    <div action="#"  id="mydropzone_8" class="dropzone text-center" style="min-height: 50px !important;  background: transparent;border: dashed; border-radius: 10px; border-width: 1px; border-color: #888; ">
                        <div class="fallback">
                            <input name="file" type="file" multiple />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalUpload9" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-white" id="exampleModalCenterTitle">อัพโหลด Manuscript ที่ตีพิมพ์หรือมีเลข doi แล้ว</h5>
                </div>
                <div class="modal-body">
                    <div action="#"  id="mydropzone_9" class="dropzone text-center" style="min-height: 50px !important;  background: transparent;border: dashed; border-radius: 10px; border-width: 1px; border-color: #888; ">
                        <div class="fallback">
                            <input name="file" type="file" multiple />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalFileAdvice" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-body pt-2 text-dark">
                    <div class="text-center pb-2">
                        <img src="../../../img/alert_2.png" alt="" width="100">
                    </div>
                    <h3 class="text-center text-danger">คำแนะนำในการอัพโหลดไฟล์เอกสารงานวิจัย</h3>
                    <ol>
                    <li>ให้ตั้งชื่อไฟล์เป็นภาษาอังกฤษ โดยห้ามใช้อัขระพิเศษ เช่น # * [] {}</li>
                    <li>ในการตั้งชื่อไฟล์ ไม่ควรตั้งชื่อความยาวเกิน 200 ตัวอักษร</li>
                    <li>ควรระบุเวอร์ชั่นของไฟล์นั้น ๆ ให้ชัดเจน เช่น  Protocol_20191013_v1.pdf เป็นต้น</li>
                    <li>หากมีการตีกลับจากเจ้าหน้าที่เพื่อแก้ไข <span class="text-danger">กรุณาอย่าลบไฟล์ที่เคยส่งไปยังสำนักงานแล้วออกโดยเด็ดขาด</span> เพราะเจ้าหน้าที่ต้องใช้เพื่อการเปรียบเทียบการแก้ไข และอาจทำให้การพิจารณาล่าช้าได้</li>
                    </ol>

                    <div class="text-center pb-1">
                        <button type="button" class="btn btn-danger btn-block btn-lg bsdn" style="font-size: 1em;" data-dismiss="modal">รับทราบ</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <?php 
    // require('../componants/footer.php');
    ?>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="../../../app-assets/vendors/js/vendors.min.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
    <script src="../../../app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
    <script src="../../../app-assets/vendors/preload.js/dist/js/preload.js"></script>
    <script src="../../../tools/dropzone/dist/min/dropzone.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <script src="../../../app-assets/vendors/ckeditor_full/ckeditor.js"></script>
    <!-- END: Theme JS-->


    <script src="../../../assets/js/core.js?v=<?php echo filemtime('../../../assets/js/core.js'); ?>"></script>
    <script src="../../../assets/js/authen.js?v=<?php echo filemtime('../../../assets/js/authen.js'); ?>"></script>
    <script src="../../../assets/js/continuing.js?v=<?php echo filemtime('../../../assets/js/continuing.js'); ?>"></script>
    <script src="../../../assets/js/progress_closing.js?v=<?php echo filemtime('../../../assets/js/progress_closing.js'); ?>"></script>

    <script>
        preload.hide()


        $('#modalFileAdvice').modal()

        getFileProgressSubmissionList($('#txtUid').val(), $('#txtSessionID').val(), 'closing', '4')
        getFileProgressSubmissionList($('#txtUid').val(), $('#txtSessionID').val(), 'closing', '5')
        getFileProgressSubmissionList($('#txtUid').val(), $('#txtSessionID').val(), 'closing', '8')
        getFileProgressSubmissionList($('#txtUid').val(), $('#txtSessionID').val(), 'closing', '9')

        setInterval(() => {
                form9.autoUpdate('closing')
        }, 10000);

        var recent_selected_project = null

        function createReport(id_rs){
            recent_selected_project = id_rs
            $('#modalReport').modal()
        }
        function gotoReport(){
            var param = {
                uid: $('#txtUid').val(),
                progress: $('#txtReportype').val(),
                id_rs: recent_selected_project
            }
            preload.show()
            var jxr = $.post(api + 'api?stage=create_progress_form', param, function(){}, 'json')
                       .always(function(snap){
                           if(snap.status == 'Success'){
                                window.location = 'progressform_' + $('#txtReportype').val() + '?id_rs=' + recent_selected_project + '&session_id=' + snap.session_id
                           }else if(snap.status == 'Found'){
                                preload.hide()
                                Swal.fire({
                                    title: 'คำเตือน',
                                    text: "ตรวจพบรายงานปิด/ยุติโครงการแล้ว กรุณาตรวจสอบและดำเนินการต่อจากรายงานดังกล่าว",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'ดูรายการ',
                                    cancelButtonText: 'เลือกใหม่',
                                    confirmButtonClass: 'btn btn-danger mr-1',
                                    cancelButtonClass: 'btn btn-secondary',
                                    buttonsStyling: false,
                                }).then(function (result) {
                                    if (result.value) {
                                        window.location = './rec-report-list?id_rs=' + recent_selected_project
                                    }
                                })
                           }else{
                                preload.hide()
                                Swal.fire({
                                    icon: "error",
                                    title: 'เกิดข้อผิดพลาด',
                                    text: 'ไม่สามารถสร้างรายงานได้',
                                    confirmButtonClass: 'btn btn-danger',
                                })
                           }
                       })
        }
    </script>

</body>
<!-- END: Body-->

</html>