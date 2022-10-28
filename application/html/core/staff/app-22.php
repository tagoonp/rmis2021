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

$c_progress = 0;
$c_amend = 0;
$c_deviation = 0;
$c_lsae = 0;
$c_esae = 0;
$c_closing = 0;
$c_terminate = 0;

$strSQL = "SELECT COUNT(rp_id) cn FROM rec_progress WHERE rp_progress_status = '22' AND rp_sending_status = '1' AND rp_confirm_1 = '1' AND rp_delete_status = '0' AND rp_progress_id = 'closing'";
$res6 = $db->fetch($strSQL, false);
if(($res6) && ($res6['cn'] > 0)){ $c_closing = $res6['cn']; }

$strSQL = "SELECT COUNT(rp_id) cn FROM rec_progress WHERE rp_progress_status = '22' AND rp_sending_status = '1' AND rp_confirm_1 = '1'AND rp_delete_status = '0' AND rp_progress_id = 'terminate'";
$res7 = $db->fetch($strSQL, false);
if(($res7) && ($res7['cn'] > 0)){ $c_terminate = $res7['cn']; }

?>

<input type="hidden" id="txtSid" value="<?php echo $_SESSION['rmis_id'];?>">
<input type="hidden" id="txtUid" value="<?php echo $_SESSION['rmis_uid'];?>">
<input type="hidden" id="txtRole" value="<?php echo $_SESSION['rmis_role'];?>">

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
                        <h2 class="brand-text mb-0"><span class="text-success">RMIS</span>@Cont</h2>
                    </a></li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="bx bx-x d-block d-xl-none font-medium-4 primary"></i><i class="toggle-icon bx bx-disc font-medium-4 d-none d-xl-block primary" data-ticon="bx-disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="lines">
                
                <li class="nav-item"><a href="./"><i class="menu-livicon" data-icon="home"></i><span class="menu-title text-truncate" data-i18n="Email">หน้าแรก</span></a></li>
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
            </div>
            
            <div class="content-header row">
                <div class="content-header-left col-12 mb-2 mt-1">
                    <h3>โครงการที่รอออกใบรับรอง/รับทราบ</h3>
                    <div class="breadcrumbs-top">
                        <div class="breadcrumb-wrapper d-none d-sm-block">
                            <ol class="breadcrumb p-0 mb-0 pl-1">
                                <li class="breadcrumb-item"><a href="./"><i class="bx bx-home-alt"></i></a></li>
                                <li class="breadcrumb-item active">โครงการที่รอออกใบรับรอง/รับทราบ</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-body" >
                <div class="card text-center">
                        <div class="card-body">
                            <ul class="nav nav-pills card-header-pills ml-0" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-closing-tab" data-toggle="pill" href="#pills-closing" role="tab" aria-controls="pills-closing" aria-selected="false">Closing<?php if($c_closing != 0){ echo ' <span class="badge badge-pill- badge-danger pl-1 pr-1 round" style="padding-left: 10px !important; padding-right: 12px !important;" >'.$c_closing.'</span>';} ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-terminate-tab" data-toggle="pill" href="#pills-terminate" role="tab" aria-controls="pills-terminate" aria-selected="false">Termination<?php if($c_terminate != 0){ echo ' <span class="badge badge-pill- badge-danger pl-1 pr-1 round" style="padding-left: 10px !important; padding-right: 12px !important;" >'.$c_terminate.'</span>';} ?></a>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">

                                <div class="tab-pane fade pt-3 pb-3" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
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

                                <div class="tab-pane active show fade pb-3" id="pills-closing" role="tabpanel" aria-labelledby="pills-closing-tab">
                                <?php 
                                    if($c_closing == 0){
                                        ?>
                                        <h4 class="card-title mt-3">ไม่มีแบบรายงานรอตรวจสอบ</h4>
                                        <?php
                                    }else{
                                        ?>
                                        <div class="table-responsive">
                                        <table class="table table-striped mt-3">
                                            <thead>
                                                <tr>
                                                    <!-- <th style="width: 180px;"></th> -->
                                                    <!-- <th style="width: 120px;">รหัสรายงาน</th> -->
                                                    <th>ข้อมูลโครงการ</th>
                                                    <!-- <th style="width: 150px;">วัน-เวลาที่ส่ง</th>
                                                    <th style="width: 100px;">สถานะปัจจุบัน</th> -->
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $strSQL = "SELECT * FROM rec_progress a INNER JOIN research b ON a.rp_id_rs = b.id_rs
                                                            INNER JOIN type_status_research c ON a.rp_progress_status = c.id_status_research
                                                            WHERE 
                                                            a.rp_progress_status = '22' AND a.rp_sending_status = '1' AND a.rp_confirm_1 = '1' AND a.rp_delete_status = '0' AND a.rp_progress_id = 'closing'";
                                                $res = $db->fetch($strSQL, true, false);
                                                if(($res) && ($res['status'])){
                                                    foreach ($res['data'] as $row) {
                                                        ?>
                                                        <tr>
                                                            <td style="vertical-align: top;">
                                                                <div>
                                                                    <span class="badge badge-success mb-1 round"><?php echo $row['rp_progress_id']."-".$row['rp_session']; ?></span>
                                                                    <span class="badge badge-secondary mb-1 round"><?php echo "REC.".$row['code_apdu']; ?></span>
                                                                </div>
                                                                <div>
                                                                    <span class="text-white"><?php 
                                                                    if($row['title_th'] == '-'){
                                                                        echo $row['title_en'];
                                                                    }else{
                                                                        echo $row['title_th']. " (".$row['title_en'].")";
                                                                    }
                                                                    ?></span>
                                                                </div>
                                                                <div>
                                                                <div>
                                                                    หัวหน้าโครงการ : 
                                                                    <?php 
                                                                    $strSQL = "SELECT fname, lname FROM userinfo WHERE user_id = '".$row['rp_uid']."' LIMIT 1";
                                                                    $resPi = $db->fetch($strSQL, false);
                                                                    if($resPi){
                                                                        echo $resPi['fname']." ".$resPi['lname'];
                                                                    }else{
                                                                        echo "-";
                                                                    }
                                                                    ?>
                                                                </div> 
                                                                <div class="" style="padding-top: 5px;"><span class="badge round badge-light-warning"><?php echo $row['status_name']; ?></span></div>
                                                                <div style="padding-top: 5px;">
                                                                <button class="btn btn-icon btn-success" style="padding-bottom: 10px; margin-top: 3px;" onclick="openForm('closing', '<?php echo $row['rp_id_rs'];?>', '<?php echo $row['rp_session'];?>')"><i class="bx bx-search"></i></button>
                                                                <button class="btn btn-icon btn-success" style="padding-bottom: 10px; margin-top: 3px;" onclick="window.location='app-approval?id_rs=<?php echo $row['rp_id_rs'];?>&session_id=<?php echo $row['rp_session'];?>'"><i class="bx bx-pencil"></i></button>
                                                                <button class="btn btn-icon btn-danger" style="padding-bottom: 10px; margin-top: 3px;"><i class="bx bx-trash"></i></button>
                                                                </div>
                                                            </td>
                                                            
                                                        </tr>
                                                        <?php
                                                    }
                                                }else{
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $strSQL; ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                        </div>
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
                                                            a.rp_progress_status = '22' AND a.rp_sending_status = '1' AND a.rp_confirm_1 = '1' AND a.rp_delete_status = '0' AND a.rp_progress_id = 'terminate'";
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
    </script>

</body>
<!-- END: Body-->

</html>