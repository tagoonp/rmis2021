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

<input type="hidden" id="txtResearchId" value="<?php echo $id_rs; ?>">
<input type="hidden" id="txtSessionId" value="<?php echo $session_id; ?>">
<input type="hidden" id="txtProgress" value="<?php echo $resProgress0['rp_progress_id']; ?>">

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
                        <h2 class="brand-text mb-0 text-white"><span class="text-success">RMIS</span>@PSU</h2>
                    </a></li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="bx bx-x d-block d-xl-none font-medium-4 primary"></i><i class="toggle-icon bx bx-disc font-medium-4 d-none d-xl-block primary" data-ticon="bx-disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="lines">
                
                <li class="nav-item"><a href="./" class="text-white"><i class="menu-livicon" data-icon="home"></i><span class="menu-title text-truncate" data-i18n="Email">หน้าแรก</span></a></li>
                <li class="nav-item"><a href="./dashboard" class="text-white"><i class="menu-livicon" data-icon="bar-chart"></i><span class="menu-title text-truncate" data-i18n="Email">กระดานภาพรวม</span></a></li>

                
                <li class="navigation-header text-truncate"><span data-i18n="Support">สนับสนุน</span>
                </li>
                <li class="nav-item"><a href="page-knowledge-base" class="text-white" target="_blank"><i class="menu-livicon" data-icon="info-alt"></i><span class="menu-title text-truncate" data-i18n="Documentation">ข้อมูลการใช้งาน</span></a>
                </li>
                <li class="nav-item"><a href="https://rmis2.medicine.psu.ac.th/documentation/"  class="text-white" target="_blank"><i class="menu-livicon" data-icon="morph-folder"></i><span class="menu-title text-truncate" data-i18n="Documentation">คู่มือการใช้งาน</span></a>
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
            </div>
            
            <div class="content-header row">
                <div class="content-header-left col-12 mb-2 mt-1">
                    <h3 class="text-dark">รายงานโครงการวิจัยปิดโครงการ (Closing report)</h3>
                    <div class="breadcrumbs-top">
                        <div class="breadcrumb-wrapper d-none d-sm-block">
                            <ol class="breadcrumb p-0 mb-0 pl-1">
                                <li class="breadcrumb-item"><a href="./"><i class="bx bx-home-alt"></i></a></li>
                                <li class="breadcrumb-item active"><a href="./research-info?id_rs=<?php echo $id_rs; ?>">REC. <?php echo $resResearch['code_apdu']; ?></a></li>
                                <li class="breadcrumb-item active"><?php echo $resProgress0['rp_progress_id'];?>-<?php echo $session_id; ?></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-body">
                <div class="row">
                    <div class="col-12 col-sm-9">
                    <h4 class="mb-0 text-dark">ข้อมูลโครงการวิจัย</h4>
                        <div class="card bg-white text-dark">
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
                                            <a href="#" class="text-dark"><?php echo "<h5 class='text-dark mb-0'>".$resResearch['title_th']. "</h5><small>(".$resResearch['title_en'].")</small>"; ?></a>
                                            <?php
                                        }else{
                                            echo $resResearch['title_en'];
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-12 col-sm-3">
                                        ประเภทการพิจารณา Initial review : 
                                    </div>
                                    <div class="col-12 col-sm-3 text-success">
                                        <?php 
                                        $strSQL = "SELECT rct_type FROM research_consider_type WHERE rct_id_rs = '$id_rs'";
                                        $resType = $db->fetch($strSQL, false, false);
                                        if($resType) echo $resType['rct_type']; else echo "NA";
                                        ?>
                                    </div>
                                    <div class="col-12 col-sm-3 ">
                                        Protocol number : 
                                    </div>
                                    <div class="col-12 col-sm-3 text-dark">
                                        <?php if($resResearch['protocol_no'] == '') echo "-"; else echo $resResearch['protocol_no']; ?>
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-12 col-sm-3">
                                        <div>
                                            หัวหน้าโครงการ : 
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-9">
                                        <span class="text-dark">
                                            <?php 
                                            $strSQL = "SELECT * FROM useraccount a INNER JOIN userinfo b ON a.id = b.user_id 
                                                    INNER JOIN dept c ON b.id_dept = c.id_dept
                                                    WHERE a.id_pm = '".$resResearch['id_pm']."'";
                                            $resPi = $db->fetch($strSQL, false, false);
                                            if($resPi){
                                                echo $resPi['fname']." ".$resPi['lname'];
                                                ?>
                                                <div>
                                                    สังกัด : <?php 
                                                    if($resPi['id_dept'] == '19'){
                                                        echo $resPi['dept'];
                                                    }else{
                                                        echo $resPi['dept_name'];
                                                    }
                                                    ?>
                                                </div>
                                                <div>
                                                    โทรศัพท์ : <?php echo $resPi['tel_mobile']; ?>
                                                </div>
                                                <div>
                                                    E-mail address : <?php echo $resPi['email']; ?>
                                                </div>
                                                <?php
                                            }else{
                                                echo "NA";
                                            }
                                            ?>
                                            </span>
                                        
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-12 col-sm-3">
                                        แหล่งทุน : 
                                    </div>
                                    <div class="col-12 col-sm-9">
                                        <?php
                                        if($resResearch['source_funds'] != '-') echo "-"; else echo $resResearch['source_funds'];
                                        ?>
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-12 col-sm-3">
                                        วันที่ได้รับการรับรองครั้งแรก : 
                                    </div>
                                    <div class="col-12 col-sm-3 text-dark">
                                    <?php 
                                        $strSQL = "SELECT rai_sign_date FROM research_acknowledge_info WHERE rai_id_rs = '$id_rs' AND rai_sign_status = '1' ORDER BY rai_id DESC LIMIT 1";
                                        if($resType['rct_type'] != 'Exempt'){
                                            $strSQL = "SELECT rai_sign_date FROM research_expedited_info WHERE rai_id_rs = '$id_rs' AND rai_sign_status = '1' ORDER BY rai_id DESC LIMIT 1";
                                        }
                                        $resType = $db->fetch($strSQL, false, false);
                                        if($resType){
                                            echo date('d M Y', strtotime($resType['rai_sign_date']));
                                        }
                                        ?>
                                        <div>
                                        <?php 
                                        $strSQL = "SELECT * FROM research_assign_fullboard_agendar WHERE rafa_id_rs = '$id_rs' AND rafa_status = '1' ORDER BY rafa_id DESC LIMIT 1";
                                        $resResearchRafa = $db->fetch($strSQL, false, false);
                                        echo "การประชุมครั้งที่ ".$resResearchRafa['rafa_agn']." | Panal ".$resResearchRafa['rafa_panal'];
                                        ?>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-3">
                                        วันที่ยื่นรายงาน : 
                                    </div>
                                    <div class="col-12 col-sm-3 text-dark">
                                        <?php echo $resProgress0['rp_sending_datetime']; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h4 class="text-dark">แบบรายงานปิดโครงการ</h4>
                        <div class="card bg-white">
                            <div class="card-body text-dark">
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <h4 class="text-dark">สรุปจำนวนอาสาสมัคร</h4>
                                        <div class="mb-1">
                                            <fieldset>
                                                <div class="radio dn">
                                                    <input type="radio" class="checkbox-input" id="radio_0" name="radio_1" value="na" checked>>
                                                </div>
                                                <div class="radio radio-danger">
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
                                                <div class="radio radio-danger">
                                                    <input type="radio" class="checkbox-input" id="radio_2" name="radio_1" value="2" <?php if(($pgStatus) && ($resProgress['rp5_qs1'] == '2')){ echo "checked"; }?>>
                                                    <label for="radio_2" class="text-dark">2. โครงการเกี่ยวข้องกับการมีอาสาสมัคร&nbsp;<span class="text-danger">(กรอกตัวเลขทุกช่อง ถ้าไม่มีให้ใส่เลข 0)</span></label>
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
                                    <div class="col-12 col-sm-6">
                                        <div>
                                            <span class="text-white" style="font-size: 1.05em;">3. จำนวนอาสาสมัครที่เกิด <span class="text-danger">Serious adverse event (ถ้าไม่มีให้ใส่เลข 0)</span></span>
                                            <div class="pt-1 mb-2 pl-2">
                                                <div class="form-group row align-items-center">
                                                    <div class="col-lg-7 col-6">
                                                        <label for="first-name" class="col-form-label text-white" style="font-size: 1em;">- อาสาสมัครในสถานวิจัย : <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-lg-5 col-6">
                                                        <input type="number" id="txtQ3_1" class="form-control" name="txtQ3_1" placeholder="" min="0" value="<?php if($pgStatus){ echo $resProgress['rp5_qs3_1']; } ?>"  />
                                                    </div>
                                                </div>

                                                <div class="form-group row align-items-center">
                                                    <div class="col-lg-7 col-6">
                                                        <label for="first-name" class="col-form-label text-white" style="font-size: 1em;">- อาสาสมัครในประเทศ : <span class="text-muted">* ถ้ามี SUSAR</span></label>
                                                    </div>
                                                    <div class="col-lg-5 col-6">
                                                        <input type="number" id="txtQ3_2" class="form-control" name="txtQ3_2" placeholder="" min="0" value="<?php if($pgStatus){ echo $resProgress['rp5_qs3_2']; } ?>"  />
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

                                    <div class="col-12 col-sm-12">
                                        <hr>
                                        <span class="text-white" style="font-size: 1.05em;">4. ตั้งแต่เริ่มโครงการ เคยมี protocal deviation/violation หรือ compliance issue หรือไม่ <span class="text-danger">*</span></span>
                                        <div class="pt-2 pb-2">
                                            <fieldset>
                                                <div class="radio dn">
                                                    <input type="radio" class="checkbox-input" id="radio_4_0" name="radio_4" value="na" checked >
                                                </div>

                                                <div class="radio mb-1">
                                                    <input type="radio" class="checkbox-input" id="radio_4_1" name="radio_4" value="0"  <?php if(($pgStatus) && ($resProgress['rp5_qs4'] == '0')){ echo "checked"; }?>>
                                                    <label for="radio_4_1" class="text-white">ไม่เคย</label>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <div class="radio radio-danger">
                                                    <input type="radio" class="checkbox-input" id="radio_4_2" name="radio_4" value="1" <?php if(($pgStatus) && ($resProgress['rp5_qs4'] == '1')){ echo "checked"; }?>>
                                                    <label for="radio_4_2" class="text-white">เคย (กรุณาแนบหลักฐานประกอบ)</label>
                                                </div>
                                            </fieldset>
                                            <div class="pt-1 mb-2 dn0"  id="hd52">
                                                <table class="table text-white">
                                                    <thead>
                                                        <tr class="bg-secondary">
                                                            <th class="text-white">ชื่อไฟล์</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="closing_4">
                                                        <?php 
                                                        $strSQL = "SELECT * FROM rec_progress_file_submit WHERE rpfs_id_rs = '$id_rs' AND rpfs_session = '$session_id' AND rpfs_delete = '0' AND rpfs_position = '4'";
                                                        $resFile = $db->fetch($strSQL, true, false);
                                                        if(($resFile) && ($resFile['status'])){
                                                            foreach ($resFile['data'] as $row) {
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $row['rpfs_name']; ?></td>
                                                                    <td class="text-right">
                                                                        <button class="btn btn-icon" onclick="window.open('<?php echo $row['rpfs_url'];?>', '_blank')"><i class="bx bx-download"></i></button>    
                                                                        <button class="btn btn-icon" onclick="deleteFile('<?php echo $uid; ?>', '<?php echo $row['rpfs_url'];?>', '<?php echo $session_id;?>', '<?php echo $id_rs;?>')"><i class="bx bx-trash text-danger"></i></button>    
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        }else{
                                                            ?><tr><td colspan="2" class="text-center">ไม่มีไฟล์แนบ</td></tr><?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                    <tbody>
                                                        <tr>
                                                            <td colspan="2" class="text-center">
                                                                <button class="btn btn-secondary" onclick="showModalUploadfile('4', '<?php echo $id_rs; ?>', '<?php echo $id_rs; ?>')"><i class="bx bx-upload"></i> คลิกที่นี่เพื่ออัพโหลดไฟล์</button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12">
                                        <hr>
                                        <span class="text-white" style="font-size: 1.05em;">5. ตั้งแต่เริ่มโครงการ เคยมีเรื่องร้องเรียนเกี่ยวกับโครงการหรือไม่ <span class="text-danger">*</span></span>
                                        <div class="pt-2 pb-2">
                                            <fieldset>
                                                <div class="radio dn">
                                                    <input type="radio" class="checkbox-input" id="radio_5_0" name="radio_5" value="na" checked >
                                                </div>
                                                <div class="radio mb-1">
                                                    <input type="radio" class="checkbox-input" id="radio_5_1" name="radio_5" value="0"  <?php if(($pgStatus) && ($resProgress['rp5_qs5'] == '0')){ echo "checked"; }?>>
                                                    <label for="radio_5_1" class="text-white">ไม่เคย</label>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <div class="radio radio-danger">
                                                    <input type="radio" class="checkbox-input" id="radio_5_2" name="radio_5" value="1"  <?php if(($pgStatus) && ($resProgress['rp5_qs5'] == '1')){ echo "checked"; }?>>
                                                    <label for="radio_5_2" class="text-white">เคย (กรุณาแนบหลักฐานประกอบ)</label>
                                                </div>
                                                
                                            </fieldset>
                                            <div class="pt-1 mb-2 dn0"  id="hd52">
                                                <table class="table text-white">
                                                    <thead>
                                                        <tr class="bg-secondary">
                                                            <th class="text-white">ชื่อไฟล์</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="closing_5">
                                                        <?php 
                                                        $strSQL = "SELECT * FROM rec_progress_file_submit WHERE rpfs_id_rs = '$id_rs' AND rpfs_session = '$session_id' AND rpfs_delete = '0' AND rpfs_position = '5'";
                                                        $resFile = $db->fetch($strSQL, true, false);
                                                        if(($resFile) && ($resFile['status'])){
                                                            foreach ($resFile['data'] as $row) {
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $row['rpfs_name']; ?></td>
                                                                    <td class="text-right">
                                                                        <button class="btn btn-icon" onclick="window.open('<?php echo $row['rpfs_url'];?>', '_blank')"><i class="bx bx-download"></i></button>    
                                                                        <button class="btn btn-icon" onclick="deleteFile('<?php echo $uid; ?>', '<?php echo $row['rpfs_url'];?>', '<?php echo $session_id;?>', '<?php echo $id_rs;?>')"><i class="bx bx-trash text-danger"></i></button>    
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        }else{
                                                            ?><tr><td colspan="2" class="text-center">ไม่มีไฟล์แนบ</td></tr><?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                    <tbody>
                                                        <tr>
                                                            <td colspan="2" class="text-center">
                                                                <button class="btn btn-secondary" onclick="showModalUploadfile('5')"><i class="bx bx-upload"></i> คลิกที่นี่เพื่ออัพโหลดไฟล์</button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6">
                                        <hr>
                                        <span class="text-white" style="font-size: 1.05em;">6. การนำเสนอผล มี<u>ข้อมูลระบุตัวตน</u> หรือมีโอกาสที่จะเกิดผล<u>กระทบเชิงลบ</u>ต่ออาสาสมัครหรือชุมชนของอาสาสมัครหรือไม่ <span class="text-danger">*</span></span>
                                        <div class="pt-2 pb-2">
                                            <fieldset>
                                                <div class="radio dn">
                                                    <input type="radio" class="checkbox-input" id="radio_6_0" name="radio_6" value="na" checked >
                                                </div>
                                                <div class="radio mb-1">
                                                    <input type="radio" class="checkbox-input" id="radio_6_1" name="radio_6" value="0"  <?php if(($pgStatus) && ($resProgress['rp5_qs6'] == '0')){ echo "checked"; }?>>
                                                    <label for="radio_6_1" class="text-white">โครงการไม่เกี่ยวข้องกับอาสาสมัคร</label>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <div class="radio mb-1">
                                                    <input type="radio" class="checkbox-input" id="radio_6_2" name="radio_6" value="1" <?php if(($pgStatus) && ($resProgress['rp5_qs6'] == '1')){ echo "checked"; }?>>
                                                    <label for="radio_6_2" class="text-white">ไม่มีความเสี่ยง</label>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <div class="radio radio-danger">
                                                    <input type="radio" class="checkbox-input" id="radio_6_3" name="radio_6" value="2" <?php if(($pgStatus) && ($resProgress['rp5_qs6'] == '2')){ echo "checked"; }?>>
                                                    <label for="radio_6_3" class="text-white">มีความเสี่ยงบ้าง และมีแผนลดควาามเสี่ยง คือ </label>
                                                </div>
                                                <div class="pt-1 mb-2 <?php if(($pgStatus) && ($resProgress['rp5_qs6'] == '2')){}else{ echo "dn"; }?>"  id="hd63">
                                                    <textarea name="txtQ6" id="txtQ6" cols="30" rows="4" placeholder="ระบุแผนลดควาามเสี่ยง" class="form-control"><?php if(($pgStatus) && ($resProgress['rp5_qs6'] == '2')){ echo $resProgress['rp5_qs6_info']; } ?></textarea>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <hr>
                                        <span class="text-white" style="font-size: 1.05em;">7. มีแผนการติดตามและดูแลอาสาสมัครหลังสิ้นสุดโครงการอย่างไร <span class="text-danger">*</span></span>
                                        <div class="pt-2 pb-2">
                                            <fieldset>
                                                <div class="radio dn">
                                                    <input type="radio" class="checkbox-input" id="radio_7_0" name="radio_7" value="na" checked >
                                                </div>
                                                <div class="radio mb-1">
                                                    <input type="radio" class="checkbox-input" id="radio_7_1" name="radio_7" value="0" <?php if(($pgStatus) && ($resProgress['rp5_qs7'] == '0')){ echo "checked"; }?>>
                                                    <label for="radio_7_1" class="text-white">โครงการไม่เกี่ยวข้องกับอาสาสมัคร</label>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <div class="radio mb-1">
                                                    <input type="radio" class="checkbox-input" id="radio_7_2" name="radio_7" value="1" <?php if(($pgStatus) && ($resProgress['rp5_qs7'] == '1')){ echo "checked"; }?>>
                                                    <label for="radio_7_2" class="text-white">ไม่มีแผน <span class="text-danger">ต้องชี้แจงเหตุผล</span></label>
                                                </div>
                                                <div class="pt-1 mb-2 <?php if(($pgStatus) && ($resProgress['rp5_qs7'] == '1')){}else{ echo "dn"; }?>" id="hd72">
                                                    <textarea name="txtQ7_1" id="txtQ7_1" cols="30" rows="4" placeholder="ระบุเหตุผล" class="form-control"><?php if(($pgStatus) && ($resProgress['rp5_qs7'] == '1')){ echo $resProgress['rp5_qs7_info_1']; } ?></textarea>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <div class="radio radio-danger">
                                                    <input type="radio" class="checkbox-input" id="radio_7_3" name="radio_7" value="2" <?php if(($pgStatus) && ($resProgress['rp5_qs7'] == '2')){ echo "checked"; }?>>
                                                    <label for="radio_7_3" class="text-white">มีแผนการจัดการและดูแล คือ </label>
                                                </div>
                                                <div class="pt-1 mb-2 <?php if(($pgStatus) && ($resProgress['rp5_qs7'] == '2')){}else{ echo "dn"; }?>" id="hd73">
                                                    <textarea name="txtQ7_2" id="txtQ7_2" cols="30" rows="4" placeholder="ระบุแผนการจัดการและดูแล" class="form-control"><?php if(($pgStatus) && ($resProgress['rp5_qs7'] == '2')){ echo $resProgress['rp5_qs7_info_2']; } ?></textarea>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-12">
                                        <hr>
                                        <span class="text-white" style="font-size: 1.05em;">8. Final report <span class="text-danger">*</span></span>
                                        <div class="pt-1 mb-2 dn0"  id="hd52">
                                                <table class="table text-white">
                                                    <thead>
                                                        <tr class="bg-secondary">
                                                            <th class="text-white">ชื่อไฟล์</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="closing_8">
                                                        <?php 
                                                        $strSQL = "SELECT * FROM rec_progress_file_submit WHERE rpfs_id_rs = '$id_rs' AND rpfs_session = '$session_id' AND rpfs_delete = '0' AND rpfs_position = '8'";
                                                        $resFile = $db->fetch($strSQL, true, false);
                                                        if(($resFile) && ($resFile['status'])){
                                                            foreach ($resFile['data'] as $row) {
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $row['rpfs_name']; ?></td>
                                                                    <td class="text-right">
                                                                        <button class="btn btn-icon" onclick="window.open('<?php echo $row['rpfs_url'];?>', '_blank')"><i class="bx bx-download"></i></button>    
                                                                        <button class="btn btn-icon" onclick="deleteFile('<?php echo $uid; ?>', '<?php echo $row['rpfs_url'];?>', '<?php echo $session_id;?>', '<?php echo $id_rs;?>')"><i class="bx bx-trash text-danger"></i></button>    
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        }else{
                                                            ?><tr><td colspan="2" class="text-center">ยังไม่มีไฟล์ Final report แนบ</td></tr><?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                    <tbody>
                                                        <tr>
                                                            <td colspan="2" class="text-center">
                                                                <button class="btn btn-secondary" onclick="showModalUploadfile('8')"><i class="bx bx-upload"></i> คลิกที่นี่เพื่ออัพโหลดไฟล์</button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                    </div>

                                    <div class="col-12 col-sm-12">
                                    <hr>
                                    <span class="text-white" style="font-size: 1.05em;">9. Manuscript <span class="text-danger">หากไม่มี เจ้าหน้าที่จะบันทึกว่านักวิจัยค้างส่ง</span></span>
                                        <div class="pt-1 mb-2 dn0"  id="hd52">
                                            <table class="table text-white">
                                                <thead>
                                                    <tr class="bg-secondary">
                                                        <th class="text-white">ชื่อไฟล์</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="closing_9">
                                                    <?php 
                                                    $strSQL = "SELECT * FROM rec_progress_file_submit WHERE rpfs_id_rs = '$id_rs' AND rpfs_session = '$session_id' AND rpfs_delete = '0' AND rpfs_position = '9'";
                                                    $resFile = $db->fetch($strSQL, true, false);
                                                    if(($resFile) && ($resFile['status'])){
                                                        foreach ($resFile['data'] as $row) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $row['rpfs_name']; ?></td>
                                                                <td class="text-right">
                                                                    <button class="btn btn-icon" onclick="window.open('<?php echo $row['rpfs_url'];?>', '_blank')"><i class="bx bx-download"></i></button>    
                                                                    <button class="btn btn-icon" onclick="deleteFile('<?php echo $uid; ?>', '<?php echo $row['rpfs_url'];?>', '<?php echo $session_id;?>', '<?php echo $id_rs;?>')"><i class="bx bx-trash text-danger"></i></button>    
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }else{
                                                        ?><tr><td colspan="2" class="text-center">ยังไม่มีไฟล์ Manuscript แนบ</td></tr><?php
                                                    }
                                                    ?>
                                                </tbody>
                                                <tbody>
                                                    <tr>
                                                        <td colspan="2" class="text-center">
                                                            <button class="btn btn-secondary" onclick="showModalUploadfile('9')"><i class="bx bx-upload"></i> คลิกที่นี่เพื่ออัพโหลดไฟล์</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="col-12 pt-3 text-center">
                                        <hr>
                                        <span class="text-danger">** หมายเหตุ : หากท่านมีการปรับปรุงข้อมูลใด ๆ ในหน้านี้ กรุณากด "ยืนยันการปรับปรุงข้อมูล" ด้านล่างก่อนดำเนินการต่อด้วย</span>
                                        <div class="pt-2">
                                            <button class="btn btn-danger btn-lg">บันทึกการปรับปรุงข้อมูล</button>
                                        </div>
                                    </div>

                                    <div class="col-12 pt-3">
                                        <?php 
                                        if(($resProgress0['rp_progress_status'] == '1') || ($resProgress0['rp_progress_status'] == '21')){
                                            ?>
                                            <hr>
                                            <h4 class="py-50 text-dark">การดำเนินการ</h4>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="" style="font-size: 1em;">ผลการตรวจสอบ : <span class="text-danger">*</span></label>
                                                        <select name="txtReturn_1" id="txtReturn_1" class="form-control">
                                                            <option value="">-- เลือกผลการตรวจสอบ --</option>
                                                            <option value="1">เอกสารถูกไม่ต้อง ส่งนักวิจัยเพื่อแก้ไข</option>
                                                            <option value="2">เอกสารถูกต้อง ส่งต่อเลขา ฯ</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="" style="font-size: 1em;">บันทึกถึงนักวิจัยหรือเลขา ฯ : <span class="text-danger">*</span></label>
                                                        <textarea name="txtCommentCheckDoc" id="txtCommentCheckDoc" cols="30" rows="10" class="form-control"></textarea>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="text-center" onclick="progress.return_1()"><button class="btn btn-danger btn-lg"><i class="bx bx-paper-plane"></i> บันทึกและส่ง</button></div>  
                                            <?php
                                        }
                                        ?>
                                    </div>
</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-3">
                        <h5 class="text-white">Initial review information</h5>
                        <div class="list-group">
                            <button type="button" class="list-group-item list-group-item-action text-white" onclick="window.location='research-info?id_rs=<?php echo $id_rs; ?>'"><i class="bx bx-info-circle"></i> ข้อมูลโครงการวิจัย</button>
                            <button type="button" class="list-group-item list-group-item-action text-white" onclick="window.location='research-info?id_rs=<?php echo $id_rs; ?>&stage=5'"><i class="bx bx-list-ul"></i> ดูรายงานทั้งหมดของโครงการนี้</button>
                            <button type="button" class="list-group-item list-group-item-action text-white" data-toggle="modal" data-target="#modalOperation"><i class="bx bx-wrench"></i> ดำเนินการต่อ</button>
                        </div>

                        <h5 class="text-white mt-3">คำสั่งดำเนินการ</h5>
                        <div class="list-group">
                            <button type="button" class="list-group-item list-group-item-action text-danger"><i class="bx bx-trash"></i> ลบ/ถอนรายงานฉบับนี้</button>
                        </div>

                    </div>
                </div>
            </div>

        </div>  
    </div>

    <div class="modal fade" id="modalUpload" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-secondary pt-2">
                    <h5 class="modal-title text-white" id="exampleModalCenterTitle">อัพโหลดไฟล์เอกสาร</h5>
                </div>
                <div class="modal-body">
                    <table class="table table-striped mb-0">
                        <tbody id="ec_msg_list">
                            <tr><td class="text-center"><i class="bx bx-sync bx-spin text-primary" style="font-size: 3.5em;"></i></td></tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary ml-1"  data-dismiss="modal">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">ปิด</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalOperation" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-danger pt-2">
                    <h5 class="modal-title text-white" id="exampleModalCenterTitle">ดำเนินการต่อ</h5>
                </div>
                <?php 
                if($resProgress0['rp_progress_status'] == '1'){
                    require('./comp/operation_1.php');
                }
                ?>
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
    <script src="../../../tools/ckeditor_lite/ckeditor.js"></script>
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
    <script src="../../../assets/js/continuing.js?v=<?php echo filemtime('../../../assets/js/continuing.js'); ?>"></script>

    <script>
        preload.hide()
    </script>

</body>
<!-- END: Body-->

</html>