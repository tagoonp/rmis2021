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

$commentFound = false;
$strSQL = "SELECT * FROM rec_comment_round WHERE crc_id_rs = '$id_rs' AND crc_session_id = '$session_id'";
$resCommentRound = $db->fetch($strSQL, true, true);
if(($resCommentRound) && ($resCommentRound['count'] > 0)){
    $commentFound = true;
}

?>

<input type="hidden" id="txtResearchId" value="<?php echo $id_rs; ?>">
<input type="hidden" id="txtSessionId" value="<?php echo $session_id; ?>">
<input type="hidden" id="txtProgress" value="<?php echo $resProgress0['rp_progress_id']; ?>">

<input type="hidden" id="txtPid" value="<?php echo $id_rs; ?>">
<input type="hidden" id="txtSessionID" value="<?php echo $session_id; ?>">

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
                    <h3 class="text-dark">จัดการข้อเสนอแนะ รายงานโครงการวิจัย (<?php echo $resProgress0['rp_progress_id']; ?> report)</h3>
                    <div class="breadcrumbs-top">
                        <div class="breadcrumb-wrapper d-none d-sm-block">
                            <ol class="breadcrumb p-0 mb-0 pl-1">
                                <li class="breadcrumb-item"><a href="./"><i class="bx bx-home-alt"></i></a></li>
                                <li class="breadcrumb-item active"><a href="./research-info?id_rs=<?php echo $id_rs; ?>">REC. <?php echo $resResearch['code_apdu']; ?></a></li>
                                <li class="breadcrumb-item"><a href="./progress_<?php echo $resProgress0['rp_progress_id']; ?>?id_rs=<?php echo $id_rs; ?>&session_id=<?php echo $session_id; ?>"><?php echo $resProgress0['rp_progress_id'];?>-<?php echo $session_id; ?></a></li>
                                <li class="breadcrumb-item active">จัดการข้อเสนอแนะ</li>
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
                                                <?php
                                            }else{
                                                echo "NA";
                                            }
                                            ?>
                                            </span>
                                        
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-8" style="padding-top: 5px;"><h4 class="text-dark">ข้อเสนอแนะ</h4></div>
                            <div class="col-12 col-sm-4 pb-1">
                             <?php 
                                if($commentFound){
                                    ?>
                                    <select name="txtRound" id="txtRound" class="form-control">
                                        <option value="" selected>-- รอบที่ --</option>
                                        <?php 
                                        foreach ($resCommentRound['data'] as $row) {
                                            ?>
                                            <option value="<?php echo $row['crc_round'];?>"><?php echo "รอบที่ ".$row['crc_round'];?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="card bg-white">
                            <div class="card-body text-dark">
                                <?php 
                                if(!$commentFound){
                                    ?>
                                    <div class="pt-3 pb-3 text-center">
                                        ยังพบขอคำถาม/ข้อเสนอแนะสำหรับโครงการนี้
                                        <p class="text-danger">
                                            <small>กรุณาตรวจสอบรายละเอียดจาก Note ของรายงาน</small>
                                            <div class="pt-0">
                                                <button class="btn btn-light-secondary" onclick="window.history.back()">กลับหน้ารายละเอียดรายงาน</button>
                                            </div>
                                        </p>
                                    </div>
                                    <?php
                                }else{

                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-3">
                        <h5 class="text-dark">Initial review information</h5>
                        <div class="list-group">
                            <button type="button" class="list-group-item list-group-item-action text-dark" onclick="window.location='research-info?id_rs=<?php echo $id_rs; ?>'"><i class="bx bx-info-circle"></i> ข้อมูลโครงการวิจัย</button>
                            <button type="button" class="list-group-item list-group-item-action text-dark" onclick="window.location='research-info?id_rs=<?php echo $id_rs; ?>&stage=5'"><i class="bx bx-list-ul"></i> ดูรายงานทั้งหมดของโครงการนี้</button>
                        </div>

                        <h5 class="text-dark mt-3">คำสั่งดำเนินการ</h5>
                        <div class="list-group">
                            <?php 
                            require('./comp/progress_command.php');
                            ?>
                            
                            <button type="button" class="list-group-item list-group-item-action text-danger"><i class="bx bx-trash"></i> ลบ/ถอนรายงานฉบับนี้</button>
                        </div>

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

    <div class="modal fade" id="modalRenameFile" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h5 class="modal-title text-white" id="exampleModalCenterTitle">แก้ไขชื่อไฟล์</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form onsubmit="return false;">
                    <div class="form-group dn">
                        <label for="">File ID : </label>
                        <input type="text" class="form-control" id="txtRenameId" readonly>
                    </div>

                    <div class="form-group">
                        <label for="">ชื่อไฟล์เดิม : </label>
                        <input type="text" class="form-control" id="txtRenamePrev" readonly>
                    </div>

                    <div class="form-group">
                        <label for="">ชื่อไฟล์เดิม : <span class="text-danger">** ตั้งด้วยภาษาอังกฤษ ห้ามใช้อัขระพิเศษ และห้ามเว้นวรรค (แนะนำให้ใช้ _) และกรุณาใส่นามสกุลไฟล์ให้เหมือนเดิม</span> </label>
                        <input type="text" class="form-control" id="txtRenameNew">
                    </div>

                    <div class="form-group text-right">
                        <button class="btn btn-danger" onclick="confRename()">บันทึก</button>
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
    <script src="../../../tools/ckeditor_lite/ckeditor.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <script src="../../../tools/dropzone/dist/min/dropzone.min.js"></script>
    <!-- END: Theme JS-->


    <script src="../../../assets/js/core.js?v=<?php echo filemtime('../../../assets/js/core.js'); ?>"></script>
    <script src="../../../assets/js/authen.js?v=<?php echo filemtime('../../../assets/js/authen.js'); ?>"></script>
    <script src="../../../assets/js/continuing.js?v=<?php echo filemtime('../../../assets/js/continuing.js'); ?>"></script>
    <script src="../../../assets/js/progress_closing.js?v=<?php echo filemtime('../../../assets/js/progress_closing.js'); ?>"></script>

    <script>
        preload.hide()

        getFileProgressSubmissionList($('#txtUid').val(), $('#txtSessionId').val(), 'closing', '4')
        getFileProgressSubmissionList($('#txtUid').val(), $('#txtSessionId').val(), 'closing', '5')
        getFileProgressSubmissionList($('#txtUid').val(), $('#txtSessionId').val(), 'closing', '8')
        getFileProgressSubmissionList($('#txtUid').val(), $('#txtSessionId').val(), 'closing', '9')

    </script>

</body>
<!-- END: Body-->

</html>