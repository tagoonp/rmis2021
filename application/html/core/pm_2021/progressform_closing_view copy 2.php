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

$strSQL = "SELECT * FROM rec_progress_closing WHERE rpx_session = '$session_id' LIMIT 1";
$resProgress = $db->fetch($strSQL, false);
$pgStatus = false;
if(!$resProgress){
    $db->close();
    header('Location: ./');
    die();
}else{
    $pgStatus = true;
}
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/semi-dark-layout.css">
    <!-- END: Theme CSS-->

    
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/widgets.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/dashboard-analytics.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/extensions/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/preload.js/dist/css/preload.css">
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
                        <h2 class="brand-text mb-0"><span class="text-success">RMIS</span>@<span class="text-white">PSU</span></h2>
                    </a></li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="bx bx-x d-block d-xl-none font-medium-4 primary"></i><i class="toggle-icon bx bx-disc font-medium-4 d-none d-xl-block primary" data-ticon="bx-disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="lines">
                
                <li class="active nav-item"><a href="./"><i class="menu-livicon" data-icon="home"></i><span class="menu-title text-truncate" data-i18n="Email">หน้าแรก</span></a></li>
                <li class="nav-item"><a href="./app-search"><i class="menu-livicon" data-icon="search"></i><span class="menu-title text-truncate" data-i18n="Email">ค้นหาข้อมูล</span></a></li>

                
                
                <li class="navigation-header text-truncate"><span data-i18n="Support">สนับสนุน</span>
                </li>
                <li class="nav-item"><a href="page-knowledge-base" target="_blank"><i class="menu-livicon" data-icon="info-alt"></i><span class="menu-title text-truncate" data-i18n="Documentation">ข้อมูลการใช้งาน</span></a>
                </li>
                <li class="nav-item"><a href="https://rmis2.medicine.psu.ac.th/documentation/" target="_blank"><i class="menu-livicon" data-icon="morph-folder"></i><span class="menu-title text-truncate" data-i18n="Documentation">คู่มือการใช้งาน</span></a>
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
                    <h3 class="text-white">รายงานปิดโครงการวิจัย (Project closing report)</h3>
                    <div class="breadcrumbs-top">
                        <div class="breadcrumb-wrapper d-none d-sm-block">
                            <ol class="breadcrumb p-0 mb-0 pl-1">
                                <li class="breadcrumb-item"><a href="./"><i class="bx bx-home-alt"></i> หน้าแรก</a></li>
                                <li class="breadcrumb-item"><a href="./rec-all">โครงการที่อยู่ระหว่างดำเนินการวิจัย</a></li>
                                <li class="breadcrumb-item"><a href="./rec-report-list?id_rs=<?php echo $id_rs; ?>">REC.<?php echo $resResearch['code_apdu']; ?></a></li>
                                <li class="breadcrumb-item"><a href="Javascript:void()"><?php echo $resProgress0['rp_progress_id']; ?>-<?php echo $session_id; ?></a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-body" >
                <div class="card">
                    <div class="card-header bg-secondary text-white">
                        <h4 class="mb-0 text-white">ข้อมูลโครงการวิจัย</h4>
                    </div>
                    <div class="card-body pt-2">
                        <div class="row">
                            <div class="col-12 col-sm-3">
                                รหัสโครงการ : 
                            </div>
                            <div class="col-12 col-sm-9"><span class="badge badge-danger round">REC.<?php echo $resResearch['code_apdu']; ?></span></div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-12 col-sm-3">
                                ชื่อโครงการวิจัย : 
                            </div>
                            <div class="col-12 col-sm-9">
                                <?php
                                if($resResearch['title_th'] != '-'){
                                    ?>
                                    <a href="#" class="text-white"><?php echo "<h5 class='text-white mb-0'>".$resResearch['title_th']. "</h5><small>(".$resResearch['title_en'].")</small>"; ?></a>
                                    <?php
                                }else{
                                    echo $resResearch['title_en'];
                                }
                                ?>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-12">
                                <button class="btn btn-secondary" onclick="window.location='./rec-report-list?id_rs=<?php echo $id_rs; ?>'"><i class="bx bx-chevron-left"></i> กลับหน้าโครงการวิจัย</button>
                                <button class="btn btn-danger float-right"><i class="bx bx-trash"></i> ลบ/ขอถอนรายงานฉบับนี้</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header bg-secondary">
                        <h4 class="mb-0 text-white">แบบฟอร์มรายงานปิดโครงการ</h4>
                    </div>
                    
                    <div class="card-body pt-1 text-white">
                        <form action="#" >
                            <fieldset>
                                <div class="row">
                                    <div class="col-12">
                                        <h4 class="py-50 text-white">สรุปจำนวนอาสาสมัคร</h4>
                                        <div class="alert alert-danger mb-2" role="alert">
                                        หน้านี้เป็นข้อมูลสำหรับการดูเท่านั้น การแก้ไขข้อมูลใด ๆ ในหน้านี้จะไม่ส่งผลต่อรายงานที่ท่านส่งไปยังสำนักงานแล้ว (View only form)
                                        </div>
                                        
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-1">
                                            <fieldset>
                                                <div class="radio dn">
                                                    <input type="radio" class="checkbox-input" id="radio_0" name="radio_1" value="na" checked>>
                                                </div>
                                                <div class="radio radio-success">
                                                    <input type="radio" class="checkbox-input" id="radio_1" name="radio_1" value="1" <?php if(($pgStatus) && ($resProgress['rp5_qs1'] == '1')){ echo "checked"; }?>>
                                                    <label for="radio_1" class="text-white">1. โครงการไม่เกี่ยวกับอาสาสมัคร (เช่น Retrospective ไม่มีข้อมูลระบุตัวตน)</label>
                                                </div>
                                            </fieldset>
                                            <div class="pt-1 mb-2 <?php if(($pgStatus) && ($resProgress['rp5_qs1'] == '1')){}else{ echo "dn"; }?>" id="hd1">
                                                <textarea name="txtQ1" id="txtQ1" cols="30" rows="4" placeholder="ระบุหมายเหตุ" class="form-control"><?php if(($pgStatus) && ($resProgress['rp5_qs1'] == '1')){ echo $resProgress['rp5_qs1_remak']; } ?></textarea>
                                            </div>
                                        </div>

                                        <div>
                                            <fieldset>
                                                <div class="radio radio-success">
                                                    <input type="radio" class="checkbox-input" id="radio_2" name="radio_1" value="2" <?php if(($pgStatus) && ($resProgress['rp5_qs1'] == '2')){ echo "checked"; }?>>
                                                    <label for="radio_2" class="text-white">2. โครงการเกี่ยวข้องกับการมีอาสาสมัคร <span class="text-danger">(กรอกตัวเลขทุกช่อง ถ้าไม่มีให้ใส่เลข 0)</span></label>
                                                </div>
                                            </fieldset>
                                            <div class="pt-1 mb-2 pl-2 <?php if(($pgStatus) && ($resProgress['rp5_qs1'] == '2')){}else{ echo "dn"; }?> " id="hd2">
                                                <div class="form-group row align-items-center">
                                                    <div class="col-lg-7 col-6">
                                                        <label for="first-name" class="col-form-label text-white" style="font-size: 1em;">- จำนวนอาสาสมัครที่ EC รับรอง : <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-lg-5 col-6">
                                                        <input type="number" class="form-control" name="txtQ2_1" id="txtQ2_1" min="0" value="<?php if($pgStatus){ echo $resProgress['rp5_qs2_1']; } ?>" />
                                                    </div>
                                                </div>

                                                <div class="form-group row align-items-center">
                                                    <div class="col-lg-7 col-6">
                                                        <label for="first-name" class="col-form-label text-white" style="font-size: 1em;">- จำนวนที่เซ็นยินยอม : <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-lg-5 col-6">
                                                        <input type="number" class="form-control" name="txtQ2_2" id="txtQ2_2"  min="0"  value="<?php if($pgStatus){ echo $resProgress['rp5_qs2_2']; } ?>" />
                                                    </div>
                                                </div>

                                                <div class="form-group row align-items-center">
                                                    <div class="col-lg-7 col-6">
                                                        <label for="first-name" class="col-form-label text-white" style="font-size: 1em;">- จำนวนที่ไม่ผ่านคัดกรอง : <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-lg-5 col-6">
                                                        <input type="number"  class="form-control" name="txtQ2_3" id="txtQ2_3" min="0"  value="<?php if($pgStatus){ echo $resProgress['rp5_qs2_3']; } ?>" />
                                                    </div>
                                                </div>

                                                <div class="form-group row align-items-center">
                                                    <div class="col-lg-7 col-6">
                                                        <label for="first-name" class="col-form-label text-white" style="font-size: 1em;">- จำนวนที่ถอนตัว : <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-lg-5 col-6">
                                                        <input type="number"  class="form-control" name="txtQ2_4" id="txtQ2_4" min="0"  value="<?php if($pgStatus){ echo $resProgress['rp5_qs2_4']; } ?>" />
                                                    </div>
                                                </div>

                                                <div class="form-group row align-items-center">
                                                    <div class="col-lg-7 col-6">
                                                        <label for="first-name" class="col-form-label text-white" style="font-size: 1em;">- จำนวนที่เสียชีวิต : <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-lg-5 col-6">
                                                        <input type="number"  class="form-control" name="txtQ2_5" id="txtQ2_5" min="0"  value="<?php if($pgStatus){ echo $resProgress['rp5_qs2_5']; } ?>"/>
                                                    </div>
                                                </div>

                                                <div class="form-group row align-items-center">
                                                    <div class="col-lg-7 col-6">
                                                        <label for="first-name" class="col-form-label text-white" style="font-size: 1em;">- จำนวนที่อยู่จนสิ้นสุดการศึกษา : <span class="text-danger">*</span></label>
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
                                            <span class="text-white" style="font-size: 1.05em;">3. จำนวนอาสาสมัครที่เกิด <span class="text-danger">Serious adverse event (ถ้าไม่มีให้ใส่เลข 0)</span></span>
                                            <div class="pt-1 mb-2 pl-2">
                                                <div class="form-group row align-items-center">
                                                    <div class="col-lg-7 col-6">
                                                        <label for="first-name" class="col-form-label text-white" style="font-size: 1em;">- อาสาสมัครในสถานวิจัย : <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-lg-5 col-6">
                                                        <input type="number" id="txtQ3_1" class="form-control" name="txtQ3_1" placeholder=""  min="0" value="<?php if($pgStatus){ echo $resProgress['rp5_qs3_1']; } ?>"  />
                                                    </div>
                                                </div>

                                                <div class="form-group row align-items-center">
                                                    <div class="col-lg-7 col-6">
                                                        <label for="first-name" class="col-form-label text-white" style="font-size: 1em;">- อาสาสมัครในประเทศ : <span class="text-muted">* ถ้ามี SUSAR</span></label>
                                                    </div>
                                                    <div class="col-lg-5 col-6">
                                                        <input type="number" id="txtQ3_2" class="form-control" name="txtQ3_2" placeholder=""  min="0" value="<?php if($pgStatus){ echo $resProgress['rp5_qs3_2']; } ?>"  />
                                                    </div>
                                                </div>

                                                <div class="form-group row align-items-center">
                                                    <div class="col-lg-7 col-6">
                                                        <label for="first-name" class="col-form-label text-white" style="font-size: 1em;">- อาสาสมัครทั้งโลก : <span class="text-muted">* ถ้ามี SUSAR</span></label>
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
                                        <span class="text-white" style="font-size: 1.05em;">4. ตั้งแต่เริ่มโครงการ เคยมี protocal deviation/violation หรือ compliance issue หรือไม่ <span class="text-danger">*</span></span>
                                        <div class="pt-2 pb-2">
                                            <fieldset>
                                                <div class="radio dn">
                                                    <input type="radio" class="checkbox-input" id="radio_4_0" name="radio_4" value="na" checked >
                                                </div>

                                                <div class="radio mb-1 radio-success">
                                                    <input type="radio" class="checkbox-input" id="radio_4_1" name="radio_4" value="0"  <?php if(($pgStatus) && ($resProgress['rp5_qs4'] == '0')){ echo "checked"; }?>>
                                                    <label for="radio_4_1" class="text-white">ไม่เคย</label>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <div class="radio radio-success">
                                                    <input type="radio" class="checkbox-input" id="radio_4_2" name="radio_4" value="1" <?php if(($pgStatus) && ($resProgress['rp5_qs4'] == '1')){ echo "checked"; }?>>
                                                    <label for="radio_4_2" class="text-white">เคย (กรุณาแนบหลักฐานประกอบ)</label>
                                                </div>
                                            </fieldset>
                                            <div class="pt-1 mb-2 dn0"  id="hd52">
                                                <table class="table table-striped text-white">
                                                    <thead>
                                                        <tr class="bg-secondary">
                                                            <th class="text-white">ชื่อไฟล์</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="closing_4">
                                                        <tr><td colspan="2" class="text-center">ไม่มีไฟล์แนบ</td></tr>
                                                    </tbody>
                                                    
                                                </table>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <hr>
                                        <span class="text-white" style="font-size: 1.05em;">5. ตั้งแต่เริ่มโครงการ เคยมีเรื่องร้องเรียนเกี่ยวกับโครงการหรือไม่ <span class="text-danger">*</span></span>
                                        <div class="pt-2 pb-2">
                                            <fieldset>
                                                <div class="radio dn">
                                                    <input type="radio" class="checkbox-input" id="radio_5_0" name="radio_5" value="na" checked >
                                                </div>
                                                <div class="radio mb-1 radio-success">
                                                    <input type="radio" class="checkbox-input" id="radio_5_1" name="radio_5" value="0"  <?php if(($pgStatus) && ($resProgress['rp5_qs5'] == '0')){ echo "checked"; }?>>
                                                    <label for="radio_5_1" class="text-white">ไม่เคย</label>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <div class="radio radio-success">
                                                    <input type="radio" class="checkbox-input" id="radio_5_2" name="radio_5" value="1"  <?php if(($pgStatus) && ($resProgress['rp5_qs5'] == '1')){ echo "checked"; }?>>
                                                    <label for="radio_5_2" class="text-white">เคย (กรุณาแนบหลักฐานประกอบ)</label>
                                                </div>
                                                
                                            </fieldset>
                                            <div class="pt-1 mb-2 dn0"  id="hd52">
                                                <table class="table table-striped text-white">
                                                    <thead>
                                                        <tr class="bg-secondary">
                                                            <th class="text-white">ชื่อไฟล์</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="closing_5">
                                                        <tr><td colspan="2" class="text-center">ไม่มีไฟล์แนบ</td></tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                    <hr>
                                        <span class="text-white" style="font-size: 1.05em;">6. การนำเสนอผล มี<u>ข้อมูลระบุตัวตน</u> หรือมีโอกาสที่จะเกิดผล<u>กระทบเชิงลบ</u>ต่ออาสาสมัครหรือชุมชนของอาสาสมัครหรือไม่ <span class="text-danger">*</span></span>
                                        <div class="pt-2 pb-2">
                                            <fieldset>
                                                <div class="radio dn">
                                                    <input type="radio" class="checkbox-input" id="radio_6_0" name="radio_6" value="na" checked >
                                                </div>
                                                <div class="radio mb-1 radio-success">
                                                    <input type="radio" class="checkbox-input" id="radio_6_1" name="radio_6" value="0"  <?php if(($pgStatus) && ($resProgress['rp5_qs6'] == '0')){ echo "checked"; }?>>
                                                    <label for="radio_6_1" class="text-white">โครงการไม่เกี่ยวข้องกับอาสาสมัคร</label>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <div class="radio mb-1 radio-success">
                                                    <input type="radio" class="checkbox-input" id="radio_6_2" name="radio_6" value="1" <?php if(($pgStatus) && ($resProgress['rp5_qs6'] == '1')){ echo "checked"; }?>>
                                                    <label for="radio_6_2" class="text-white">ไม่มีความเสี่ยง</label>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <div class="radio radio-success">
                                                    <input type="radio" class="checkbox-input" id="radio_6_3" name="radio_6" value="2" <?php if(($pgStatus) && ($resProgress['rp5_qs6'] == '2')){ echo "checked"; }?>>
                                                    <label for="radio_6_3" class="text-white">มีความเสี่ยงบ้าง และมีแผนลดควาามเสี่ยง คือ </label>
                                                </div>
                                                <div class="pt-1 mb-2 <?php if(($pgStatus) && ($resProgress['rp5_qs6'] == '2')){}else{ echo "dn"; }?>"  id="hd63">
                                                    <textarea name="txtQ6" id="txtQ6" cols="30" rows="4" placeholder="ระบุแผนลดควาามเสี่ยง" class="form-control"><?php if(($pgStatus) && ($resProgress['rp5_qs6'] == '2')){ echo $resProgress['rp5_qs6_info']; } ?></textarea>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <hr>
                                        <span class="text-white" style="font-size: 1.05em;">7. มีแผนการติดตามและดูแลอาสาสมัครหลังสิ้นสุดโครงการอย่างไร <span class="text-danger">*</span></span>
                                        <div class="pt-2 pb-2">
                                            <fieldset>
                                                <div class="radio dn">
                                                    <input type="radio" class="checkbox-input" id="radio_7_0" name="radio_7" value="na" checked >
                                                </div>
                                                <div class="radio mb-1 radio-success">
                                                    <input type="radio" class="checkbox-input" id="radio_7_1" name="radio_7" value="0" <?php if(($pgStatus) && ($resProgress['rp5_qs7'] == '0')){ echo "checked"; }?>>
                                                    <label for="radio_7_1" class="text-white">โครงการไม่เกี่ยวข้องกับอาสาสมัคร</label>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <div class="radio mb-1 radio-success">
                                                    <input type="radio" class="checkbox-input" id="radio_7_2" name="radio_7" value="1" <?php if(($pgStatus) && ($resProgress['rp5_qs7'] == '1')){ echo "checked"; }?>>
                                                    <label for="radio_7_2" class="text-white">ไม่มีแผน <span class="text-danger">ต้องชี้แจงเหตุผล</span></label>
                                                </div>
                                                <div class="pt-1 mb-2 <?php if(($pgStatus) && ($resProgress['rp5_qs7'] == '1')){}else{ echo "dn"; }?>" id="hd72">
                                                    <textarea name="txtQ7_1" id="txtQ7_1" cols="30" rows="4" placeholder="ระบุเหตุผล" class="form-control"><?php if(($pgStatus) && ($resProgress['rp5_qs7'] == '1')){ echo $resProgress['rp5_qs7_info_1']; } ?></textarea>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <div class="radio radio-success">
                                                    <input type="radio" class="checkbox-input" id="radio_7_3" name="radio_7" value="2" <?php if(($pgStatus) && ($resProgress['rp5_qs7'] == '2')){ echo "checked"; }?>>
                                                    <label for="radio_7_3" class="text-white">มีแผนการจัดการและดูแล คือ </label>
                                                </div>
                                                <div class="pt-1 mb-2 <?php if(($pgStatus) && ($resProgress['rp5_qs7'] == '2')){}else{ echo "dn"; }?>" id="hd73">
                                                    <textarea name="txtQ7_2" id="txtQ7_2" cols="30" rows="4" placeholder="ระบุแผนการจัดการและดูแล" class="form-control"><?php if(($pgStatus) && ($resProgress['rp5_qs7'] == '2')){ echo $resProgress['rp5_qs7_info_2']; } ?></textarea>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <hr>
                                        <span class="text-white" style="font-size: 1.05em;">8. Final report <span class="text-danger">*</span></span>
                                        <div class="pt-1 mb-2 dn0"  id="hd52">
                                                <table class="table table-striped text-white">
                                                    <thead>
                                                        <tr class="bg-secondary">
                                                            <th class="text-white">ชื่อไฟล์</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="closing_8">
                                                        <tr><td colspan="2" class="text-center">ยังไม่มีไฟล์ Final report แนบ</td></tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <hr>
                                        <span class="text-white" style="font-size: 1.05em;">9. Manuscript <span class="text-danger">หากไม่มี เจ้าหน้าที่จะบันทึกว่านักวิจัยค้างส่ง</span></span>
                                        <div class="pt-1 mb-2 dn0"  id="hd52">
                                                <table class="table table-striped text-white">
                                                    <thead>
                                                        <tr class="bg-secondary">
                                                            <th class="text-white">ชื่อไฟล์</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="closing_9">
                                                        <tr><td colspan="2" class="text-center">ยังไม่มีไฟล์ Manuscript แนบ</td></tr>
                                                    </tbody>
                                                </table>
                                            </div>
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

    <div class="modal fade" id="modalReport" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-white" id="exampleModalCenterTitle">สร้างรายงานการดำเนินการวิจัย</h5>
                </div>
                <div class="modal-body">
                    <label for="" class="text-white">เลือกประเภทรายงาน : <span class="text-danger">*</span></label>
                    <select name="txtReportype" id="txtReportype" class="form-control">
                        <option value="closing">รายงานปิดโครงการ (Closing report)</option>
                        <option value="terminate">รายงานยุติโครงการ (Project termination report)</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">ยกเลิก</span>
                    </button>
                    <button type="button" class="btn btn-success ml-1" onclick="gotoReport()">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">สร้าง</span>
                    </button>
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
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->


    <script src="../../../assets/js/core.js?v=<?php echo filemtime('../../../assets/js/core.js'); ?>"></script>
    <script src="../../../assets/js/authen.js?v=<?php echo filemtime('../../../assets/js/authen.js'); ?>"></script>
    <script src="../../../assets/js/wfh.js?v=<?php echo filemtime('../../../assets/js/wfh.js'); ?>"></script>

    <script>
        preload.hide()
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