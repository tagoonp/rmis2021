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

$stage = 1;
if(isset($_REQUEST['id_rs'])){
    $id_rs = mysqli_real_escape_string($conn, $_REQUEST['id_rs']);
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
                <li class="nav-item"><a href="page-knowledge-base" class="text-white" target="_blank"><i class="menu-livicon" data-icon="info-alt"></i><span class="menu-title text-truncate" data-i18n="Documentation">ข้อมูลการใช้งาน</span></a>
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
                    <h3 class="text-dark">รายงานโครงการวิจัย REC. <?php echo $resResearch['code_apdu']; ?></h3>
                    <div class="breadcrumbs-top">
                        <div class="breadcrumb-wrapper d-none d-sm-block">
                            <ol class="breadcrumb p-0 mb-0 pl-1">
                                <li class="breadcrumb-item"><a href="./"><i class="bx bx-home-alt"></i> หน้าแรก</a></li>
                                <li class="breadcrumb-item"><a href="./rec-all">โครงการที่อยู่ระหว่างดำเนินการวิจัย</a></li>
                                <li class="breadcrumb-item active">REC.<?php echo $resResearch['code_apdu']; ?></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-body" >
                <div class="card bg-white">
                    <div class="card-header bg-secondary text-dark">
                        <h4 class="mb-0 text-white">ข้อมูลโครงการวิจัย</h4>
                    </div>
                    <div class="card-body pt-2 text-dark">
                        <div class="row">
                            <div class="col-12 col-sm-3 text-dark">
                                รหัสโครงการ : 
                            </div>
                            <div class="col-12 col-sm-9"><span class="badge badge-danger round">REC.<?php echo $resResearch['code_apdu']; ?></span></div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-12 col-sm-3  text-dark">
                                ชื่อโครงการวิจัย (ภาษาไทย) : 
                            </div>
                            <div class="col-12 col-sm-9 text-dark">
                                <?php
                                echo $resResearch['title_th'];
                                ?>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-12 col-sm-3 text-dark">
                                Project title : 
                            </div>
                            <div class="col-12 col-sm-9 text-dark">
                                <?php
                                echo $resResearch['title_en'];
                                ?>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-12 col-sm-3 text-dark">
                                ประเภทการพิจารณา : 
                            </div>
                            <div class="col-12 col-sm-9">
                                <?php 
                                $strSQL = "SELECT rct_type FROM research_consider_type WHERE rct_id_rs = '$id_rs'";
                                $res = $db->fetch($strSQL, false, false);
                                $considerType = '';
                                if($res){ echo $res['rct_type']; $considerType = $res['rct_type']; } else { echo "N/A"; }
                                ?>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-12 col-sm-3">
                                วันที่การรับรอง/ต่ออายุล่าสุด : 
                            </div>
                            <div class="col-12 col-sm-9">
                                <?php 


                                $strSQL = "SELECT * FROM rec_progress WHERE rp_id_rs = '$id_rs' AND rp_progress_id = 'progress' AND rp_progress_status = '18' ORDER BY rp_id DESC LIMIT 1";
                                $res = $db->fetch($strSQL, false, false);
                                if($res){ 
                                    echo "Check with progress log"; 
                                } else { 
                                    if($considerType == 'Exempt'){
                                        $strSQL = "SELECT rai_sign_date FROM research_acknowledge_info WHERE rai_id_rs = '$id_rs' ORDER BY rai_id DESC LIMIT 1";
                                        $res = $db->fetch($strSQL, false, false);
                                        if($res){
                                            echo date('d M Y', strtotime($res['rai_sign_date']));
                                        }else{
                                            echo "N/A";
                                        }
                                    }else{
                                        $strSQL = "SELECT rai_sign_date FROM research_expedited_info WHERE rai_id_rs = '$id_rs' ORDER BY rai_id DESC LIMIT 1";
                                        $res = $db->fetch($strSQL, false, false);
                                        if($res){
                                            echo date('d M Y', strtotime($res['rai_sign_date']));
                                        }else{
                                            echo "N/A";
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-12 col-sm-3">
                                วันที่ใบรับรองหมดอายุ : 
                            </div>
                            <div class="col-12 col-sm-9">
                                <?php 
                                if($considerType == 'Exempt'){
                                    $strSQL = "SELECT rai_expired_date FROM research_acknowledge_info WHERE rai_id_rs = '$id_rs' ORDER BY rai_id DESC LIMIT 1";
                                    $res = $db->fetch($strSQL, false, false);
                                    if($res){
                                        echo date('d M Y', strtotime($res['rai_expired_date']));
                                    }else{
                                        echo "N/A";
                                    }
                                }else{
                                    $strSQL = "SELECT rai_expired_date FROM research_expedited_info WHERE rai_id_rs = '$id_rs' ORDER BY rai_id DESC LIMIT 1";
                                    $res = $db->fetch($strSQL, false, false);
                                    if($res){
                                        echo date('d M Y', strtotime($res['rai_expired_date']));
                                    }else{
                                        echo "N/A";
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-12">
                                <button class="btn btn-success" onclick="createReport('<?php echo $id_rs; ?>')"><i class="bx bx-plus"></i> สร้างรายงาน</button>
                                <!-- <button class="btn btn-secondary" onclick="window.open('https://rmis2.medicine.psu.ac.th/rmis/pm/research_register?uid=<?php ?>&role=pm', '_blank')"><i class="bx bx-window-open"></i> ดูข้อมูลการยื่นขอพิจารณา EC</button> -->
                                <button class="btn btn-success"><i class="bx bx-file"></i> ดูข้อมูล Initial review</button>
                                <button class="btn btn-success"><i class="bx bx-file"></i> รายการใบรับรอง/รับทราบ</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header bg-secondary">
                        <h4 class="mb-0 text-white">รายงานการดำเนินการวิจัยของโครงการนี้</h4>
                    </div>
                    <?php 
                    $strSQL = "SELECT * FROM rec_progress a INNER JOIN type_status_research b ON a.rp_progress_status = b.id_status_research 
                                WHERE a.rp_id_rs = '$id_rs' 
                                AND a.rp_progress_status IN ('2', '20')
                                AND a.rp_progress_id = 'progress' AND a.rp_delete_status = '0'";
                    $resProgress = $db->fetch($strSQL, true, true);
                    
                    $strSQL = "SELECT * FROM rec_progress a INNER JOIN type_status_research b ON a.rp_progress_status = b.id_status_research 
                               WHERE a.rp_id_rs = '$id_rs' 
                               AND a.rp_progress_status IN ('1', '2', '20')
                               AND a.rp_progress_id = 'closing' AND a.rp_delete_status = '0'";
                    $resClosing = $db->fetch($strSQL, true, true);

                    $strSQL = "SELECT * FROM rec_progress a INNER JOIN type_status_research b ON a.rp_progress_status = b.id_status_research 
                               WHERE a.rp_id_rs = '$id_rs' 
                               AND a.rp_progress_status IN ('2', '20')
                               AND a.rp_progress_id = 'terminate' AND a.rp_delete_status = '0'";
                    $resTerminate = $db->fetch($strSQL, true, true);
                    ?>
                    <div class="card-body bg-white pt-1 pl-0 pr-0 pb-0">
                        <ul class="nav nav-tabs" role="tablist" style="border: none !important;">
                            <li class="nav-item ml-1">
                                <!-- <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" aria-controls="home" role="tab" aria-selected="true">
                                    <span class="align-middle">Progress report <?php if(($resClosing) && ($resProgress['count'] > 0)){ ?> <span class="badge badge-danger round" style="height: 22px; width: 22px; padding: 6px 5px; position: absolute; margin-top: -20px;"><?php echo $resProgress['count']; ?></span><?php } ?></span>
                                </a> -->
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" id="closing-tab" data-toggle="tab" href="#closing" aria-controls="profile" role="tab" aria-selected="false">
                                    <span class="align-middle">Closing <?php if(($resClosing) && ($resClosing['count'] > 0)){ ?> <span class="badge badge-danger round" style="height: 22px; width: 22px; padding: 6px 5px; position: absolute; margin-top: -20px;"><?php echo $resClosing['count']; ?></span><?php } ?></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="terminate-tab" data-toggle="tab" href="#terminate" aria-controls="about" role="tab" aria-selected="false">
                                    <span class="align-middle">Termination <?php if(($resTerminate) && ($resTerminate['count'] > 0)){ ?> <span class="badge badge-danger round" style="height: 22px; width: 22px; padding: 6px 5px; position: absolute; margin-top: -20px;"><?php echo $resTerminate['count']; ?></span><?php } ?></span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content p-0">
                            <div class="tab-pane " id="home" aria-labelledby="home-tab" role="tabpanel">
                                <?php require('./comp/progress_list.php'); ?>
                            </div>
                            <div class="tab-pane active" id="closing" aria-labelledby="closing-tab" role="tabpanel">
                                <?php require('./comp/closing_list.php'); ?>
                            </div>
                            <div class="tab-pane" id="terminate" aria-labelledby="terminate-tab" role="tabpanel">
                                <?php require('./comp/terminate_list.php'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>

    <div class="modal fade" id="modalReport" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-dark" id="exampleModalCenterTitle">สร้างรายงานการดำเนินการวิจัย</h5>
                </div>
                <div class="modal-body">
                    <label for="" class="text-dark">เลือกประเภทรายงาน : <span class="text-danger">*</span></label>
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

    <div class="modal fade" id="modalEcMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-secondary pt-2">
                    <h5 class="modal-title text-dark" id="exampleModalCenterTitle">ข้อความจากสำนักงาน ฯ</h5>
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
    <script src="../../../assets/js/continuing.js?v=<?php echo filemtime('../../../assets/js/continuing.js'); ?>"></script>

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