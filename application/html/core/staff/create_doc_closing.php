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

if(
    (!isset($_REQUEST['id_rs'])) ||
    (!isset($_REQUEST['session_id']))
){
    $db->close();
    header('Location: ./index');
    die();
}

$id_rs = mysqli_real_escape_string($conn, $_REQUEST['id_rs']);
$session_id = mysqli_real_escape_string($conn, $_REQUEST['session_id']);

$strSQL = "SELECT * FROM rec_progress WHERE rp_id_rs = '$id_rs' AND rp_session = '$session_id' AND rp_delete_status = '0'";
$res_peport = $db->fetch($strSQL, false);
if($res_peport){

}else{
    $db->close();
    header('Location: ./index');
    die();
}

$rec_reserch = '';
$strSQL = "SELECT * FROM research WHERE id_rs = '$id_rs' ";
$rec_reserch = $db->fetch($strSQL, false);

$strSQL = "SELECT * FROM userinfo a LEFT JOIN dept b ON a.id_dept = b.id_dept WHERE a.user_id = '".$res_peport['rp_uid']."'";
$rec_pi = $db->fetch($strSQL, false);

$strSQL = "SELECT * FROM userinfo a LEFT JOIN dept b ON a.id_dept = b.id_dept WHERE a.user_id = '".$res_peport['rp_uid']."'";
$rec_pi = $db->fetch($strSQL, false);

$meeting_info = false;
$strSQL = "SELECT * FROM rec_assign_fullboard_agendar WHERE rafa_id_rs = '$id_rs' AND rafa_session = '$session_id' AND rafa_status = '1' LIMIT 1";
$resRafa = $db->fetch($strSQL, false);

if($resRafa){
    $meeting_info = $resRafa;
}

$docinfo = null;
$strSQL = "SELECT * FROM rec_approval_info WHERE rai_id_rs = '$id_rs' AND rai_session_id = '$session_id' ORDER BY rai_id DESC LIMIT 1";
$resDoc = $db->fetch($strSQL, false);
if($resDoc){
    $docinfo = $resDoc;
}

?>

<input type="hidden" id="txtSid" value="<?php echo $_SESSION['rmis_id'];?>">
<input type="hidden" id="txtUid" value="<?php echo $_SESSION['rmis_uid'];?>">
<input type="hidden" id="txtRole" value="<?php echo $_SESSION['rmis_role'];?>">
<input type="hidden" id="txtSessionid" value="<?php echo $session_id;?>">
<input type="hidden" class="form-control" id="txtIdrs" readonly value="<?php echo $id_rs;?>">

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
                    <h3>ใบรับรอง/รับทราบการปิดโครงการ (Final Report)</h3>
                    <div class="breadcrumbs-top">
                        <div class="breadcrumb-wrapper d-none d-sm-block">
                            <ol class="breadcrumb p-0 mb-0 pl-1">
                                <li class="breadcrumb-item"><a href="./"><i class="bx bx-home-alt"></i></a></li>
                                <li class="breadcrumb-item"><a href="./">REC.<?php echo $rec_reserch['code_apdu']; ?></a></li>
                                <li class="breadcrumb-item"><a href="./app-approval?id_rs=<?php echo $id_rs; ?>&session_id=<?php echo $session_id; ?>">ใบรับรอง/รับทราบ</a></li>
                                <li class="breadcrumb-item active">Final Report Generater</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-body" >
                <div class="card bg-white">
                        <div class="card-body">
                            <div class="table-responsive">
                            <div class="formDemo">
                                <table class="table table-borderless text-dark formDemo" >
                                    <tr>
                                        <td width="50%">Effective date: 1 November 2021</td>
                                        <td class="text-right">AL-032</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-center">
                                            <img src="https://rmis2.medicine.psu.ac.th/rmis/img/psu-bw-logo.jpg" alt="" width="80">
                                            <h3 class="mt-2 text-dark" style="color: #000 !important; font-size: 24px;">Human Research Ethics Committee</h3>
                                            <h3 class=""  style="color: #000 !important; font-size: 20px;">Faculty of Medicine, Prince of Songkla University</h3>
                                            <hr>
                                            <h3 class="mt-3 mb-0" style="color: #000 !important; font-size: 24px;">Final Report</h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <table class="table table-borderless text-dark table-sm">
                                                <tbody>
                                                    <tr>
                                                        <td style="color: #000 !important; font-size: 16px; width: 200px; vertical-align: top;">Principal Investigator</td>
                                                        <td style="color: #000 !important; font-size: 16px; vertical-align: top;"><?php echo $rec_pi['fname_en']." ".$rec_pi['lname_en']; ?><a  href="Javascript:updatePi('<?php echo $rec_pi['user_id']; ?>')" class="float-right"><i class="bx bx-pencil"></i></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="color: #000 !important; font-size: 16px; vertical-align: top;">Affiliation</td>
                                                        <td style="color: #000 !important; font-size: 16px; vertical-align: top;"><?php if($rec_pi['id_dept'] == '19'){ echo $rec_pi['dept_en']; }else{ echo $rec_pi['dept_name_en']; } ?><a href="Javascript:updatePi('<?php echo $rec_pi['user_id']; ?>')" class="float-right"><i class="bx bx-pencil"></i></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="color: #000 !important; font-size: 16px; vertical-align: top;">REC.</td>
                                                        <td style="color: #000 !important; font-size: 16px; vertical-align: top;"><?php echo $rec_reserch['code_apdu']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="color: #000 !important; font-size: 16px; vertical-align: top;">Protocol Number</td>
                                                        <td style="color: #000 !important; font-size: 16px; vertical-align: top;"><?php if($rec_reserch['protocol_no'] == null){ echo "-"; }else{echo $rec_reserch['protocol_no'];} ?><a href="Javascript:updateResearch('<?php echo $id_rs; ?>')" class="float-right"><i class="bx bx-pencil"></i></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="color: #000 !important; font-size: 16px; vertical-align: top;">Protocol Title</td>
                                                        <td style="color: #000 !important; font-size: 16px; vertical-align: top;"><?php echo $rec_reserch['title_en']; ?><a  href="Javascript:updateResearch('<?php echo $id_rs; ?>')" class="float-right"><i class="bx bx-pencil"></i></a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <textarea name="txtDoclist" id="txtDoclist" cols="30" rows="10" class="form-control"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="color: #000 !important; font-size: 16px;">
                                        <p style="color: #000 !important; font-size: 16px;">
                                        Have/has been reviewed and acknowledged by Human Research Ethics Committee (HREC) of Faculty of Medicine Prince of Songkla University. 
The determination was (will be) documented in the meeting minutes of HREC meeting <span id="time_meeting"  style="color: #000 !important; font-size: 16px;">............/........</span> agenda <span id="agenda_meeting"  style="color: #000 !important; font-size: 16px;">............</span> on <span id="date_meeting" style="color: #000 !important; font-size: 16px;">...................</span> <a href="Javascript:updateDocinfo('<?php echo $id_rs; ?>', '<?php echo $session_id; ?>')" class="float-right"><i class="bx bx-pencil"></i></a>
                                        </p>
                                        <p style="color: #000 !important; font-size: 16px;">
                                        The research documents will be kept for 3 years from the acknowledged date before the discard 
                                        </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td class="text-center" style="color: #000 !important; font-size: 16px;">
                                        <span class="text-danger">................................</span><br>
                                        <span class="text-danger" >< Display after sign ></span><br>
                                        Chairman of Human Research Ethics Committee<br>
                                        Faculty of Medicine, Prince of Songkla University<br>
                                        Date <span class="text-danger" id="textSigndate"><?php if($docinfo){ echo date('d/m/Y', strtotime($docinfo['rai_sign_date'])); }else{ echo "-";} ?></span><a  href="Javascript:updateSigntype('<?php echo $id_rs; ?>')" class="float-right"><i class="bx bx-pencil"></i></a>

                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="text-center pt-3 pb-1">
                                <div class="row">
                                    <div class="col-12 col-sm-4 offset-sm-4">
                                        <div class="form-group">
                                            <select name="txtEc" id="txtEc" class="form-control">
                                                <option value="">-- เลือกเลขาตรวจสอบใบรับรอง --</option>
                                                <?php 
                                                $strSQL = "SELECT fname, lname, id FROM useraccount a INNER JOIN userinfo b ON a.id = b.user_id WHERE a.ec_role = '1' AND a.delete_status = '0' AND a.active_status = '1' ORDER BY fname";
                                                $resEc = $db->fetch($strSQL, true, false);
                                                if(($resEc) && ($resEc['status'])){
                                                    foreach ($resEc['data'] as $row) {
                                                        ?>
                                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['fname']." ".$row['lname']; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-danger round" onclick="approval.sendTocheck('closing')"><i class="bx bx-paper-plane mr-1"></i> ส่งเลขาเพื่อพิจารณาใบรับรอง</button>
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

    <div class="modal fade" id="modalSigntype" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">แก้ไขข้อมูลนักวิจัย</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="bx bx-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form onsubmit="return false;" id="pi_form">
                        <div class="form-group">
                            <label for="">วันที่ลงนาม : <span class="text-danger">*</span></label>
                            <select name="txtSigntype" id="txtSigntype" class="form-control">
                                <option value="">-- เลือก --</option>
                                <option value="chairman">ประธานลงนามรับรอง</option>
                                <!-- <option value="ec">เลขารับรอง</option> -->
                                <option value="manual">เลือกวันที่แบบ manual</option>
                            </select>
                        </div>

                        <div class="form-group dn" id="txtSigndate">
                            <label for="">วันที่รับรอง : <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="txtManualDate"  >
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">ปิด</span>
                    </button>
                    <button type="button" class="btn btn-primary ml-1" onclick="approval.updateSigntype('<?php echo $_SESSION['rmis_uid'];?>', 'closing')">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">บันทึก</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalPi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">แก้ไขข้อมูลนักวิจัย</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="bx bx-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form onsubmit="return false;" id="pi_form">
                        <div class="form-group dn">
                            <label for="">ID : <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="txtAccountId" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">ขื่อ : <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="txtFnameEn" value="<?php echo $rec_pi['fname_en'];?>" >
                        </div>
                        <div class="form-group">
                            <label for="">นามสกุล : <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="txtLnameEn"  value="<?php echo $rec_pi['lname_en'];?>">
                        </div>
                        <div class="form-group">
                            <label for="">สาขาวิชา/หน่วยงาน : <span class="text-danger">*</span></label>
                            <select name="txtDept" id="txtDept" class="form-control">
                                <option value="">-- เลือก --</option>
                                <?php 
                                $strSQL = "SELECT * FROM dept WHERE 1 ORDER BY dept_name";
                                $resDept = $db->fetch($strSQL, true, false);
                                if(($resDept) && ($resDept['status'])){
                                    foreach ($resDept['data'] as $row) {
                                        ?>
                                        <option value="<?php echo $row['id_dept'];?>" <?php if($rec_pi['id_dept'] == $row['id_dept']){ echo "selected"; } ?>><?php echo $row['dept_name'];?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="extDept <?php if($rec_pi['id_dept'] != '19'){ echo "dn"; }?> ">
                            <div class="form-group">
                                <label for="">ชื่อหน่วยงานอื่น ๆ (ภาษาไทย) : <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="txtDeptTh" value="<?php echo $rec_pi['dept'];?>">
                            </div>
                            <div class="form-group">
                                <label for="">ชื่อหน่วยงานอื่น ๆ (English) : <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="txtDeptEn" value="<?php echo $rec_pi['dept_en'];?>">
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">ปิด</span>
                    </button>
                    <button type="button" class="btn btn-primary ml-1" onclick="approval.updatePi()">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">บันทึก</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalResearch" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">แก้ไขข้อมูลโครงการวิจัย</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="bx bx-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form onsubmit="return false;" id="research_approval_update">
                        <div class="form-group">
                            <label for="">ชื่อภาษาไทย : <span class="text-danger">*</span></label>
                            <textarea name="txtTitleTh" class="form-control" id="txtTitleTh" cols="30" rows="5"><?php echo $rec_reserch['title_th']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">ชื่อภาษาอังกฤษ : <span class="text-danger">*</span></label>
                            <textarea name="txtTitleEn" class="form-control" id="txtTitleEn" cols="30" rows="5"><?php echo $rec_reserch['title_en']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Prorocol Number : <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="txtProtocol" value="<?php echo $rec_reserch['protocol_no']; ?>">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">ปิด</span>
                    </button>
                    <button type="button" class="btn btn-primary ml-1" onclick="approval.updateResearch()">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">บันทึก</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalAganda" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">แก้ไขข้อมูลการประชุม</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="bx bx-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form onsubmit="return false;" id="research_approval_update">
                        <div class="form-group">
                            <label for="">ครั้งที่ประชุม : <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="txtMeeting" value="<?php if($meeting_info){ echo $meeting_info['rafa_agn']; } ?>">
                        </div>
                        <div class="form-group">
                            <label for="">วาระ : <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="txtAganda" value="<?php if($meeting_info){ echo $meeting_info['rafa_panal']; } ?>">
                        </div>
                        <?php 
                        $dd = ''; $mm = ''; $yy = '';
                        if($resRafa){
                            $b = explode("-", $meeting_info['rafa_date']);
                            $dd = $b['2'];
                            $mm = $b['1'];
                            $yy = $b['0'];
                        }
                        ?>
                        <div class="row">
                            <div class="form-group col-4">
                                <label for="">วันที่ประชุม : <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="txtDate" min="1" max="31" placeholder="ใส่ 1-31" value="<?php echo $dd; ?>">
                            </div>
                            <div class="form-group col-4">
                                <label for="">เดือน : <span class="text-danger">*</span></label>
                                <select name="txtMonth" id="txtMonth" class="form-control">
                                    <option value="">-- เลือกเดือน --</option>
                                    <?php 
                                    for ($i=1; $i <= 12 ; $i++) { 
                                        ?>
                                        <option value="<?php if($i < 10){ $j = "0".$i; echo $j ; }else{ $j = $i; echo $j;  } ?>" <?php if($mm == $j){ echo "selected"; }?>><?php if($i < 10){ echo "0".$i; }else{ echo $i;  } ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-4">
                                <label for="">ปี พ.ศ. : <span class="text-danger">*</span></label>
                                <select name="txtYear" id="txtYear" class="form-control">
                                    <option value="">-- เลือกปี --</option>
                                    <?php 
                                    for ($i=date('Y'); $i >= (date('Y') - 5) ; $i--) { 
                                        ?>
                                        <option value="<?php echo $i; ?>" <?php if($yy == $i){ echo "selected"; }?>><?php echo $i+543; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">ปิด</span>
                    </button>
                    <button type="button" class="btn btn-primary ml-1" onclick="approval.updateMeeting()">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">บันทึก</span>
                    </button>
                </div>
            </div>
        </div>
    </div>


    <!-- BEGIN: Vendor JS-->
    <script src="../../../app-assets/vendors/js/vendors.min.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
    <script src="../../../app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
    <script src="../../../app-assets/vendors/preload.js/dist/js/preload.js"></script>
    <script src="../../../app-assets/vendors/ckeditor_lite/ckeditor.js"></script>
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
    <script src="../../../assets/js/rec_approval.js?v=<?php echo filemtime('../../../assets/js/rec_approval.js'); ?>"></script>

    <script>
        preload.hide()
        var editor_doclist = null
        $(document).ready(function(){
            if($("#txtDoclist").length) {
                editor_doclist = CKEDITOR.replace( 'txtDoclist', {
                    wordcount : {
                    showCharCount : false,
                    showWordCount : true,
                    },
                    height: '250px'
                });

                editor_doclist.setData('<p>The document (s) including: <ol><li>...</li><li>...</li><li>...</li><li>...</li></ol></p>')
            }

            if($('#txtMeeting').val() != ''){
                $('#time_meeting').text($('#txtMeeting').val())
                $('#agenda_meeting').text($('#txtAganda').val())
                $('#date_meeting').text($('#txtDate').val() + '/' + $('#txtMonth').val() + '/' + $('#txtYear').val())
            }
        })

        $(function(){
            $('#txtSigntype').change(function(){
                if($('#txtSigntype').val() == 'manual'){
                    $('#txtSigndate').removeClass('dn')
                }else{
                    $('#txtSigndate').addClass('dn')
                }
            })
        })

        function updatePi(id){
            $('#txtAccountId').val(id)
            $('#modalPi').modal()
        }

        function updateResearch(){
            $('#modalResearch').modal()
        }

        function updateDocinfo(id_rs, session){
            $('#modalAganda').modal()
        }

        function updateSigntype(){
            $('#modalSigntype').modal()
        }

        function sendTocheck(){
            if($('#date_meeting').text() == '...................'){
                Swal.fire({
                    icon: "error",
                    title: 'ไม่สามารถดำเนินการได้',
                    text: 'กรุณากรอกข้อมูลที่จำเป็นให้ครบถ้วน',
                    confirmButtonClass: 'btn btn-danger',
                })
                return ;
            }
            Swal.fire({
                title: 'คำเตือน',
                text: "หากส่งเลขาแล้วจะไม่สามารถแก้ไขได้อีก",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ยืนยันส่ง',
                cancelButtonText: 'ยกเลิก',
                confirmButtonClass: 'btn btn-danger mr-1',
                cancelButtonClass: 'btn btn-secondary',
                buttonsStyling: false,
            }).then(function (result) {
                if (result.value) {
                }
            })
        }
    </script>

</body>
<!-- END: Body-->

</html>