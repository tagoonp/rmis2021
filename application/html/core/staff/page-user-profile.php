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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/page-user-profile.css">
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
            </div>
            <div class="content-body">
                <!-- page user profile start -->
                <section class="page-user-profile">
                    <div class="row">
                        <div class="col-12">
                            <!-- user profile heading section start -->
                            <div class="card">
                                <div class="user-profile-images">
                                    <!-- user timeline image -->
                                    <img src="../../../app-assets/images/profile/post-media/profile-banner.jpg" class="img-fluid rounded-top user-timeline-image" alt="user timeline image">
                                    <!-- user profile image -->
                                    <img src="../../../app-assets/images/portrait/small/avatar-s-16.jpg" class="user-profile-image rounded" alt="user profile image" height="140" width="140">
                                </div>
                                <div class="user-profile-text">
                                    <h4 class="mb-0 text-bold-500 profile-text-color"><?php echo $current_user['fname']." ".$current_user['lname']; ?></h4>
                                    <small><span class="badge badge-success round"><?php echo $role; ?></span></small>
                                </div>
                                <!-- user profile nav tabs start -->
                                <div class="card-body px-0">
                                    <ul class="nav user-profile-nav justify-content-center justify-content-md-start nav-pills border-bottom-0 mb-0" role="tablist">
                                        <li class="nav-item mb-0">
                                            <a class="nav-link d-flex px-1 active" id="profile-tab" data-toggle="tab" href="#profile" aria-controls="profile" role="tab" aria-selected="true"><i class="bx bx-user"></i><span class="d-none d-md-block">ข้อมูลส่วนตัว</span></a>
                                        </li>
                                        <!-- <li class="nav-item mb-0">
                                            <a class=" nav-link d-flex px-1" id="feed-tab" data-toggle="tab" href="#feed" aria-controls="feed" role="tab" aria-selected="false"><i class="bx bx-user"></i><span class="d-none d-md-block">ข้อมูลทั่วไป</span></a>
                                        </li> -->
                                        <li class="nav-item mb-0">
                                            <a class="nav-link d-flex px-1" id="friends-tab" data-toggle="tab" href="#friends" aria-controls="friends" role="tab" aria-selected="false"><i class="bx bx-key"></i><span class="d-none d-md-block">ความปลอดภัย</span></a>
                                        </li>
                                        <li class="nav-item mb-0">
                                            <a class="nav-link d-flex px-1" id="activity-tab" data-toggle="tab" href="#activity" aria-controls="activity" role="tab" aria-selected="false"><i class="bx bx-menu"></i><span class="d-none d-md-block">บันทึกกิจกรรม</span></a>
                                        </li>
                                        
                                        
                                    </ul>
                                </div>
                                <!-- user profile nav tabs ends -->
                            </div>
                            <!-- user profile heading section ends -->

                            <!-- user profile content section start -->
                            <div class="row">
                                <!-- user profile nav tabs content start -->
                                <div class="col-12 col-lg-7">
                                    <div class="tab-content">
                                        <div class="tab-pane" id="feed" aria-labelledby="feed-tab" role="tabpanel">
                                            <!-- user profile nav tabs feed start -->
                                            <div class="row">
                                                <!-- user profile nav tabs feed left section start -->
                                                <div class="col-lg-4">
                                                    <!-- user profile nav tabs feed left section info card start -->
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h5 class="card-title mb-1">Info
                                                                <i class="cursor-pointer bx bx-dots-vertical-rounded float-right"></i>
                                                            </h5>
                                                            <ul class="list-unstyled mb-0">
                                                                <li class="d-flex align-items-center mb-25">
                                                                    <i class="bx bx-briefcase mr-50 cursor-pointer"></i><span>UX
                                                                        Designer at<a href="JavaScript:void(0);">&nbsp;google</a></span>
                                                                </li>
                                                                <li class="d-flex align-items-center mb-25">
                                                                    <i class="bx bx-briefcase mr-50 cursor-pointer"></i> <span>Former
                                                                        UI
                                                                        Designer at<a href="JavaScript:void(0);">&nbsp;CBI</a></span>
                                                                </li>
                                                                <li class="d-flex align-items-center mb-25">
                                                                    <i class="bx bx-receipt mr-50 cursor-pointer"></i> <span>Studied
                                                                        <a href="JavaScript:void(0);">&nbsp;IT science</a> at<a href="JavaScript:void(0);">&nbsp;Torronto</a></span>
                                                                </li>
                                                                <li class="d-flex align-items-center mb-25">
                                                                    <i class="bx bx-receipt mr-50 cursor-pointer"></i><span>Studied at
                                                                        <a href="JavaScript:void(0);">&nbsp;College of new Jersey</a></span>
                                                                </li>
                                                                <li class="d-flex align-items-center">
                                                                    <i class="bx bx-rss mr-50 cursor-pointer"></i> <span>Followed by<a href="JavaScript:void(0);">&nbsp;338 people</a></span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <!-- user profile nav tabs feed left section info card ends -->
                                                    <!-- user profile nav tabs feed left section trending card start -->
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h5 class="card-title mb-1">What's trending<i class="cursor-pointer bx bx-dots-vertical-rounded float-right"></i></h5>
                                                            <ul class="list-unstyled mb-0">
                                                                <li class="d-flex mb-25">
                                                                    <i class="cursor-pointer bx bx-trending-up text-primary mr-50 mt-25"></i><span>
                                                                        <a href="JavaScript:void(0);" class="mr-50">#ManJonas:</a>Frest comes with built-in
                                                                    </span>
                                                                </li>
                                                                <li class="d-flex mb-25">
                                                                    <i class="cursor-pointer bx bx-trending-up text-primary mr-50 mt-25"></i><span>
                                                                        <a href="JavaScript:void(0);" class="mr-50">LadyJonas:</a>dark layouts, select as</span>
                                                                </li>
                                                                <li class="d-flex mb-25">
                                                                    <i class="cursor-pointer bx bx-trending-up text-primary mr-50 mt-25"></i><span>
                                                                        <a href="JavaScript:void(0);" class="mr-50">#Germany:</a>Frest comes with built-in
                                                                    </span>
                                                                </li>
                                                                <li class="d-flex mb-25">
                                                                    <i class="cursor-pointer bx bx-trending-up text-primary mr-50 mt-25"></i><span>
                                                                        <a href="JavaScript:void(0);" class="mr-50">#SundayNoon:</a>dark layouts, select as</span>
                                                                </li>
                                                                <li class="d-flex">
                                                                    <i class="cursor-pointer bx bx-trending-up text-primary mr-50 mt-25"></i><span>
                                                                        <a href="JavaScript:void(0);" class="mr-50">NoWorries:</a>heme navigation with you</span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <!-- user profile nav tabs feed left section trending card ends -->
                                                    <!-- user profile nav tabs feed left section like page card start -->
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h6><img src="../../../app-assets/images/profile/pages/pixinvent.jpg" class="mr-25 round" alt="logo" height="28">
                                                                Pixinvent<span class="text-muted"> (Page)</span>
                                                                <i class="cursor-pointer bx bx-dots-vertical-rounded float-right"></i></h6>
                                                            <div class="mb-1 font-small-2">
                                                                <i class="cursor-pointer bx bxs-star text-warning"></i>
                                                                <i class="cursor-pointer bx bxs-star text-warning"></i>
                                                                <i class="cursor-pointer bx bxs-star text-warning"></i>
                                                                <i class="cursor-pointer bx bxs-star text-warning"></i>
                                                                <i class="cursor-pointer bx bx-star text-muted"></i>
                                                                <span class="ml-50 text-muted text-bold-500">4.6 (142 reviews)</span>
                                                            </div>
                                                            <div class="d-flex">
                                                                <button class="btn btn-sm btn-light-primary d-flex mr-50"><i class="cursor-pointer bx bx-like font-small-3 mb-25 mr-sm-25"></i><span class="d-none d-sm-block">Like</span></button>
                                                                <button class="btn btn-sm btn-light-primary d-flex"><i class="cursor-pointer bx bx-share-alt font-small-3 mb-25 mr-sm-25"></i><span class="d-none d-sm-block">Share</span></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- user profile nav tabs feed left section like page card ends -->
                                                    <!-- user profile nav tabs feed left section today's events card start -->
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h5 class="card-title mb-1">Today's Events<i class="cursor-pointer bx bx-dots-vertical-rounded float-right"></i>
                                                            </h5>
                                                            <div class="user-profile-event">
                                                                <div class="pb-1 d-flex align-items-center">
                                                                    <i class="cursor-pointer bx bx-radio-circle-marked text-primary mr-25"></i>
                                                                    <small>10:00am</small>
                                                                </div>
                                                                <h6 class="text-bold-500 font-small-3">Breakfast at the agency</h6>
                                                                <p class="text-muted font-small-2">Multi language support enable you to create your
                                                                    personalized apps in your language.</p>
                                                                <i class="cursor-pointer bx bx-map text-muted align-middle"></i>
                                                                <span class="text-muted"><small>Monkdev Agency</small></span>
                                                                <!-- user profile likes avatar start -->
                                                                <ul class="list-unstyled users-list d-flex align-items-center mt-1">
                                                                    <li data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" title="Lilian Nenez" class="avatar pull-up">
                                                                        <img src="../../../app-assets/images/portrait/small/avatar-s-21.jpg" alt="Avatar" height="30" width="30">
                                                                    </li>
                                                                    <li data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" title="Alberto Glotzbach" class="avatar pull-up">
                                                                        <img src="../../../app-assets/images/portrait/small/avatar-s-22.jpg" alt="Avatar" height="30" width="30">
                                                                    </li>
                                                                    <li data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" title="Alberto Glotzbach" class="avatar pull-up">
                                                                        <img src="../../../app-assets/images/portrait/small/avatar-s-23.jpg" alt="Avatar" height="30" width="30">
                                                                    </li>
                                                                    <li class="pl-50 text-muted font-small-3">
                                                                        +10 more
                                                                    </li>
                                                                </ul>
                                                                <!-- user profile likes avatar ends -->
                                                            </div>
                                                            <hr>
                                                            <div class="user-profile-event">
                                                                <div class="pb-1 d-flex align-items-center">
                                                                    <i class="cursor-pointer bx bx-radio-circle-marked text-primary mr-25"></i>
                                                                    <small>10:00pm</small>
                                                                </div>
                                                                <h6 class="text-bold-500 font-small-3">Work eith persistance and you can achive it.</h6>
                                                            </div>
                                                            <hr>
                                                            <div class="user-profile-event">
                                                                <div class="pb-1 d-flex align-items-center">
                                                                    <i class="cursor-pointer bx bx-radio-circle-marked text-primary mr-25"></i>
                                                                    <small>6:00am</small>
                                                                </div>
                                                                <div class="pb-1">
                                                                    <h6 class="text-bold-500 font-small-3">Take that granted hotdog</h6>
                                                                    <i class="cursor-pointer bx bx-map text-muted align-middle"></i>
                                                                    <span class="text-muted"><small>Monkdev Agency</small></span>
                                                                </div>
                                                            </div>
                                                            <button class="btn btn-block btn-secondary">Check all your Events</button>
                                                        </div>
                                                    </div>
                                                    <!-- user profile nav tabs feed left section today's events card ends -->
                                                </div>
                                                <!-- user profile nav tabs feed left section ends -->
                                                <!-- user profile nav tabs feed middle section start -->
                                                <div class="col-lg-8">
                                                    <!-- user profile nav tabs feed middle section post card start -->
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <!-- user profile middle section blogpost nav tabs card start -->
                                                            <ul class="nav nav-pills justify-content-center justify-content-sm-start border-bottom-0" role="tablist">
                                                                <li class="nav-item">
                                                                    <a class="nav-link active d-flex" id="user-status-tab" data-toggle="tab" href="#user-status" aria-controls="user-status" role="tab" aria-selected="true"><i class="bx bx-detail align-text-top"></i>
                                                                        <span class="d-none d-md-block">Status</span>
                                                                    </a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link d-flex" id="multimedia-tab" data-toggle="tab" href="#user-multimedia" aria-controls="user-multimedia" role="tab" aria-selected="false"><i class="bx bx-movie align-text-top"></i>
                                                                        <span class="d-none d-md-block">Multimedia</span>
                                                                    </a>
                                                                </li>
                                                                <li class="nav-item mr-0">
                                                                    <a class="nav-link d-flex" id="blog-tab" data-toggle="tab" href="#user-blog" aria-controls="user-blog" role="tab" aria-selected="false"><i class="bx bx-chat align-text-top"></i>
                                                                        <span class="d-none d-md-block">Blog Post</span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                            <div class="tab-content pl-0">
                                                                <div class="tab-pane active" id="user-status" aria-labelledby="user-status-tab" role="tabpanel">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-1 col-2">
                                                                                    <div class="avatar">
                                                                                        <img src="../../../app-assets/images/portrait/small/avatar-s-2.jpg" alt="user image" width="32" height="32">
                                                                                        <span class="avatar-status-online"></span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-11 col-10">
                                                                                    <textarea class="form-control border-0 shadow-none" id="user-post-textarea" rows="3" placeholder="Share what you are thinking here..."></textarea>
                                                                                </div>
                                                                            </div>
                                                                            <hr>
                                                                            <div class="card-footer p-0">
                                                                                <i class="cursor-pointer bx bx-camera font-medium-5 text-muted mr-1 pt-50" data-toggle="tooltip" data-popup="tooltip-custom" data-placement="top" title="Upload a picture"></i>
                                                                                <i class="cursor-pointer bx bx-face font-medium-5 text-muted mr-1 pt-50" data-toggle="tooltip" data-popup="tooltip-custom" data-placement="top" title="Tag your friend"></i>
                                                                                <i class="cursor-pointer bx bx-map font-medium-5 text-muted pt-50" data-toggle="tooltip" data-popup="tooltip-custom" data-placement="top" title="Share your location"></i>
                                                                                <span class=" float-sm-right d-flex flex-sm-row flex-column justify-content-end">
                                                                                    <button class="btn btn-light-primary mr-0 my-1 my-sm-0 mr-sm-1">Preview</button>
                                                                                    <button class="btn btn-primary">Post Status</button>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane" id="user-multimedia" aria-labelledby="multimedia-tab" role="tabpanel">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-1 col-2">
                                                                                    <div class="avatar">
                                                                                        <img src="../../../app-assets/images/portrait/small/avatar-s-2.jpg" alt="user image" width="32" height="32">
                                                                                        <span class="avatar-status-online"></span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-11 col-10">
                                                                                    <textarea class="form-control border-0 shadow-none" id="user-postmulti-textarea" rows="3" placeholder="Share what you are thinking here..."></textarea>
                                                                                </div>
                                                                            </div>
                                                                            <hr>
                                                                            <div class="card-footer p-0">
                                                                                <i class="cursor-pointer bx bx-camera font-medium-5 text-muted mr-1 pt-50" data-toggle="tooltip" data-popup="tooltip-custom" data-placement="top" title="Upload a picture"></i>
                                                                                <i class="cursor-pointer bx bx-face font-medium-5 text-muted mr-1 pt-50" data-toggle="tooltip" data-popup="tooltip-custom" data-placement="top" title="Tag your friend"></i>
                                                                                <i class="cursor-pointer bx bx-map font-medium-5 text-muted pt-50" data-toggle="tooltip" data-popup="tooltip-custom" data-placement="top" title="Share your location"></i>
                                                                                <span class=" float-sm-right d-flex flex-sm-row flex-column justify-content-end">
                                                                                    <button class="btn btn-light-primary mr-0 my-1 my-sm-0 mr-sm-1">Preview</button>
                                                                                    <button class="btn btn-primary">Post Status</button>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane" id="user-blog" aria-labelledby="blog-tab" role="tabpanel">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-1 col-2">
                                                                                    <div class="avatar">
                                                                                        <img src="../../../app-assets/images/portrait/small/avatar-s-2.jpg" alt="user image" width="32" height="32">
                                                                                        <span class="avatar-status-online"></span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-11 col-10">
                                                                                    <textarea class="form-control border-0 shadow-none" id="user-postblog-textarea" rows="3" placeholder="Share what you are thinking here..."></textarea>
                                                                                </div>
                                                                            </div>
                                                                            <hr>
                                                                            <div class="card-footer p-0">
                                                                                <i class="cursor-pointer bx bx-camera font-medium-5 text-muted mr-1 pt-50" data-toggle="tooltip" data-popup="tooltip-custom" data-placement="top" title="Upload a picture"></i>
                                                                                <i class="cursor-pointer bx bx-face font-medium-5 text-muted mr-1 pt-50" data-toggle="tooltip" data-popup="tooltip-custom" data-placement="top" title="Tag your friend"></i>
                                                                                <i class="cursor-pointer bx bx-map font-medium-5 text-muted pt-50" data-toggle="tooltip" data-popup="tooltip-custom" data-placement="top" title="Share your location"></i>
                                                                                <span class=" float-sm-right d-flex flex-sm-row flex-column justify-content-end">
                                                                                    <button class="btn btn-light-primary mr-0 my-1 my-sm-0 mr-sm-1">Preview</button>
                                                                                    <button class="btn btn-primary">Post Status</button>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- user profile middle section blogpost nav tabs card ends -->
                                                        </div>
                                                    </div>
                                                    <!-- user profile nav tabs feed middle section post card ends -->
                                                    <!-- user profile nav tabs feed middle section user-1 card starts -->
                                                    <div class="card">
                                                        <div class="card-header user-profile-header">
                                                            <div class="avatar mr-50 align-top">
                                                                <img src="../../../app-assets/images/portrait/small/avatar-s-10.jpg" alt="user avatar" width="32" height="32">
                                                                <span class="avatar-status-online"></span>
                                                            </div>
                                                            <div class="d-inline-block mt-25">
                                                                <h6 class="mb-0 text-bold-500">Martina Ash <span class="text-bold-400">shared a
                                                                    </span><a href="JavaScript:void(0);">link</a></h6>
                                                                <p class="text-muted"><small>7 hours ago</small></p>
                                                            </div>
                                                            <i class='cursor-pointer bx bx-dots-vertical-rounded float-right'></i>
                                                        </div>
                                                        <div class="card-body py-0">
                                                            <p>Unlimited color options allows you to set your application color as per your branding 🤩.</p>
                                                            <div class="d-flex border rounded">
                                                                <div class="user-profile-images"><img src="../../../app-assets/images/banner/banner-29.jpg" alt="post" class="img-fluid user-profile-card-image">
                                                                </div>
                                                                <div class="p-1">
                                                                    <h5>Algolia Integration 😎</h5>
                                                                    <p class="user-profile-ellipsis">Algolia helps businesses across industries quickly create
                                                                        relevant, scalable, and lightning fast search and discovery experiences.</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-footer d-flex justify-content-between pt-1">
                                                            <div class="d-flex align-items-center">
                                                                <i class="cursor-pointer bx bx-heart user-profile-like font-medium-4"></i>
                                                                <p class="mb-0 ml-25">18</p>
                                                                <!-- user profile likes avatar start -->
                                                                <div class="d-none d-sm-block">
                                                                    <ul class="list-unstyled users-list m-0 d-flex align-items-center ml-1">
                                                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" title="Lilian Nenez" class="avatar pull-up">
                                                                            <img src="../../../app-assets/images/portrait/small/avatar-s-21.jpg" alt="Avatar" height="30" width="30">
                                                                        </li>
                                                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" title="Alberto Glotzbach" class="avatar pull-up">
                                                                            <img src="../../../app-assets/images/portrait/small/avatar-s-22.jpg" alt="Avatar" height="30" width="30">
                                                                        </li>
                                                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" title="Alberto Glotzbach" class="avatar pull-up">
                                                                            <img src="../../../app-assets/images/portrait/small/avatar-s-23.jpg" alt="Avatar" height="30" width="30">
                                                                        </li>
                                                                        <li class="d-inline-block pl-50">
                                                                            <p class="text-muted mb-0 font-small-3">+10 more</p>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <!-- user profile likes avatar ends -->
                                                            </div>
                                                            <div class="d-flex align-items-center">
                                                                <i class="cursor-pointer bx bx-comment-dots font-medium-4"></i>
                                                                <span class="ml-25">52</span>
                                                                <i class="cursor-pointer bx bx-share-alt font-medium-4 ml-1"></i>
                                                                <span class="ml-25">22</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- user profile nav tabs feed middle section user-1 card ends -->
                                                    <!-- user profile nav tabs feed middle section story swiper start -->
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h5 class="card-title mb-0">Stories</h5>
                                                            <div class="user-profile-stories swiper-container pt-1">
                                                                <div class="swiper-wrapper user-profile-images">
                                                                    <div class="swiper-slide">
                                                                        <img src="../../../app-assets/images/profile/portraits/avatar-portrait-1.jpg" class="rounded user-profile-stories-image" alt="story image">
                                                                        <div class="card-img-overlay bg-overlay">
                                                                            <div class="user-swiper-text">ureka_23</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="swiper-slide">
                                                                        <img src="../../../app-assets/images/profile/portraits/avatar-portrait-2.jpg" class="rounded user-profile-stories-image" alt="story image">
                                                                        <div class="card-img-overlay bg-overlay">
                                                                            <div class="user-swiper-text">devine_lena</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="swiper-slide">
                                                                        <img src="../../../app-assets/images/profile/portraits/avatar-portrait-3.jpg" class="rounded user-profile-stories-image" alt="story image">
                                                                        <div class="card-img-overlay bg-overlay">
                                                                            <div class="user-swiper-text">venice_like852</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="swiper-slide">
                                                                        <img src="../../../app-assets/images/profile/portraits/avatar-portrait-4.jpg" class="rounded user-profile-stories-image" alt="story image">
                                                                        <div class="card-img-overlay bg-overlay">
                                                                            <div class="user-swiper-text">june5211</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="swiper-slide">
                                                                        <img src="../../../app-assets/images/profile/portraits/avatar-portrait-5.jpg" class="rounded user-profile-stories-image" alt="story image">
                                                                        <div class="card-img-overlay bg-overlay">
                                                                            <div class="user-swiper-text">defloya_456</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- user profile nav tabs feed middle section story swiper ends -->
                                                    <!-- user profile nav tabs feed middle section user-2 card starts -->
                                                    <div class="card">
                                                        <div class="card-header user-profile-header">
                                                            <div class="avatar mr-50 align-top">
                                                                <img src="../../../app-assets/images/portrait/small/avatar-s-11.jpg" alt="avtar image" width="32" height="32">
                                                                <span class="avatar-status-offline"></span>
                                                            </div>
                                                            <div class="d-inline-block mt-25">
                                                                <h6 class="mb-0 text-bold-500">Jonny Richie</h6>
                                                                <p class="text-muted"><small>2 hours ago</small></p>
                                                            </div>
                                                            <i class="cursor-pointer bx bx-dots-vertical-rounded float-right"></i>
                                                        </div>
                                                        <div class="card-body py-0">
                                                            <p>Beautifully crafted, clean & modern designed admin✨ theme with 3 different demos & light -
                                                                dark versions. Lifetime updates with new demos and features is guaranteed</p>
                                                        </div>
                                                        <div class="card-footer d-flex justify-content-between pb-0">
                                                            <div class="d-flex align-items-center">
                                                                <i class="cursor-pointer bx bx-heart user-profile-like font-medium-4"></i>
                                                                <p class="mb-0 ml-25">49</p>
                                                                <!-- user profile likes avatar start -->
                                                                <div class="d-none d-sm-block">
                                                                    <ul class="list-unstyled users-list m-0 d-flex align-items-center ml-1">
                                                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" title="Lilian Nenez" class="avatar pull-up">
                                                                            <img src="../../../app-assets/images/portrait/small/avatar-s-24.jpg" alt="Avatar" height="30" width="30">
                                                                        </li>
                                                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" title="Alberto Glotzbach" class="avatar pull-up">
                                                                            <img src="../../../app-assets/images/portrait/small/avatar-s-25.jpg" alt="Avatar" height="30" width="30">
                                                                        </li>
                                                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" title="Alberto Glotzbach" class="avatar pull-up">
                                                                            <img src="../../../app-assets/images/portrait/small/avatar-s-26.jpg" alt="Avatar" height="30" width="30">
                                                                        </li>
                                                                        <li class="d-inline-block pl-50">
                                                                            <p class="text-muted mb-0 font-small-3">+10 more</p>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <!-- user profile likes avatar ends -->
                                                            </div>
                                                            <div class="d-flex align-items-center">
                                                                <i class="cursor-pointer bx bx-comment-dots font-medium-4"></i>
                                                                <span class="ml-25">45</span>
                                                                <i class="cursor-pointer bx bx-share-alt font-medium-4 ml-1"></i>
                                                                <span class="ml-25">1</span>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <!-- user profile comments start -->
                                                        <div class="card-header user-profile-header pt-0">
                                                            <div class="avatar mr-50 align-top">
                                                                <img src="../../../app-assets/images/portrait/small/avatar-s-12.jpg" alt="avtar image" width="32" height="32">
                                                                <span class="avatar-status-away"></span>
                                                            </div>
                                                            <div class="d-inline-block mt-25">
                                                                <h6 class="mb-0 text-bold-500 font-small-3">Ananbella Queen</h6>
                                                                <p class="text-muted"><small>24 mins ago</small></p>
                                                            </div>
                                                            <i class='cursor-pointer bx bx-dots-vertical-rounded float-right'></i>
                                                        </div>
                                                        <div class="card-body py-0">
                                                            <p>Easy & smart fuzzy search🕵🏻 functionality which enables users to search quickly.</p>
                                                        </div>
                                                        <div class="card-footer user-comment-footer pb-0">
                                                            <i class="cursor-pointer bx bx-heart user-profile-like font-medium-4 align-middle"></i>
                                                            <span class="ml-25">30</span>
                                                            <span class="ml-1">reply</span>
                                                        </div>
                                                        <hr>
                                                        <div class="card-header user-profile-header pt-0">
                                                            <div class="avatar mr-50 align-top">
                                                                <img src="../../../app-assets/images/portrait/small/avatar-s-13.jpg" alt="avtar images" width="32" height="32">
                                                                <span class="avatar-status-busy"></span>
                                                            </div>
                                                            <div class="d-inline-block mt-25">
                                                                <h6 class="mb-0 text-bold-500 font-small-3">Jackey Potter</h6>
                                                                <p class="text-muted"><small>1 hours ago</small></p>
                                                            </div>
                                                            <i class='cursor-pointer bx bx-dots-vertical-rounded float-right'></i>
                                                        </div>
                                                        <div class="card-body py-0">
                                                            <p>Unlimited color🖌 options allows you to set your application color as per your branding 🤪.</p>
                                                        </div>
                                                        <div class="card-footer user-comment-footer pb-0">
                                                            <i class="cursor-pointer bx bx-heart user-profile-like font-medium-4 align-middle"></i>
                                                            <span class="ml-25">80</span>
                                                            <span class="ml-1">reply</span>
                                                        </div>
                                                        <hr>
                                                        <div class="form-group row align-items-center px-1">
                                                            <div class="col-2 col-sm-1">
                                                                <div class="avatar">
                                                                    <img src="../../../app-assets/images/portrait/small/avatar-s-2.jpg" alt="avtar images" width="32" height="32">
                                                                    <span class="avatar-status-online"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-11 col-10">
                                                                <textarea class="form-control" id="user-comment-textarea" rows="1" placeholder="comment.."></textarea>
                                                            </div>
                                                        </div>
                                                        <!-- user profile comments ends -->
                                                    </div>
                                                    <!-- user profile nav tabs feed middle section user-2 card ends -->
                                                    <!-- user profile nav tabs feed middle section user-3 card starts -->
                                                    <div class="card">
                                                        <div class="card-header user-profile-header">
                                                            <div class="avatar mr-50 align-top">
                                                                <img src="../../../app-assets/images/portrait/small/avatar-s-14.jpg" alt="avtar images" width="32" height="32">
                                                                <span class="avatar-status-online"></span>
                                                            </div>
                                                            <div class="d-inline-block mt-25">
                                                                <h6 class="mb-0 text-bold-500">Anna Mull</h6>
                                                                <p class="text-muted"><small>7 hours ago</small></p>
                                                            </div>
                                                            <i class='cursor-pointer bx bx-dots-vertical-rounded float-right'></i>
                                                        </div>
                                                        <div class="card-body py-0">
                                                            <p>To avoid winding up with a large bundle, it’s good to get ahead of the problem and use "Code
                                                                Splitting 🕹".</p>
                                                            <img src="../../../app-assets/images/profile/post-media/2.jpg" alt="user image" class="img-fluid">
                                                        </div>
                                                        <div class="card-footer d-flex justify-content-between pt-1">
                                                            <div class="d-flex align-items-center">
                                                                <i class="cursor-pointer bx bx-heart user-profile-like font-medium-4"></i>
                                                                <p class="mb-0 ml-25">77</p>
                                                                <!-- user profile likes avatar start -->
                                                                <div class="d-none d-sm-block">
                                                                    <ul class="list-unstyled users-list m-0 d-flex align-items-center ml-1">
                                                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" title="Lilian Nenez" class="avatar pull-up">
                                                                            <img src="../../../app-assets/images/portrait/small/avatar-s-11.jpg" alt="Avatar" height="30" width="30">
                                                                        </li>
                                                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" title="Alberto Glotzbach" class="avatar pull-up">
                                                                            <img src="../../../app-assets/images/portrait/small/avatar-s-12.jpg" alt="Avatar" height="30" width="30">
                                                                        </li>
                                                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" title="Alberto Glotzbach" class="avatar pull-up">
                                                                            <img src="../../../app-assets/images/portrait/small/avatar-s-13.jpg" alt="Avatar" height="30" width="30">
                                                                        </li>
                                                                        <li class="d-inline-block pl-50">
                                                                            <p class="text-muted mb-0 font-small-3">+10 more</p>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <!-- user profile likes avatar ends -->
                                                            </div>
                                                            <div class="d-flex align-items-center">
                                                                <i class="cursor-pointer bx bx-comment-dots font-medium-4"></i>
                                                                <span class="ml-25">12</span>
                                                                <i class="cursor-pointer bx bx-share-alt font-medium-4 ml-1"></i>
                                                                <span class="ml-25">12</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- user profile nav tabs feed middle section user-3 card ends -->
                                                    <!-- user profile nav tabs feed middle section user-4 card starts -->
                                                    <div class="card">
                                                        <div class="card-header user-profile-header">
                                                            <div class="avatar mr-50 align-top">
                                                                <img src="../../../app-assets/images/portrait/small/avatar-s-18.jpg" alt="avtar images" width="32" height="32">
                                                                <span class="avatar-status-online"></span>
                                                            </div>
                                                            <div class="d-inline-block mt-25">
                                                                <h6 class="mb-0 text-bold-500">Petey Cruiser</h6>
                                                                <p class="text-muted"><small>21 hours ago</small></p>
                                                            </div>
                                                            <i class='cursor-pointer bx bx-dots-vertical-rounded float-right'></i>
                                                        </div>
                                                        <div class="card-body py-0">
                                                            <p>It's more efficient 🙌 to split each route's components into a separate chunk, and only load
                                                                them when the route is visited. Frest comes with built-in light and dark layouts, select as
                                                                per your preference.</p>
                                                        </div>
                                                        <div class="card-footer d-flex justify-content-between pt-1">
                                                            <div class="d-flex align-items-center">
                                                                <i class="cursor-pointer bx bx-heart user-profile-like font-medium-4"></i>
                                                                <p class="mb-0 ml-25">0</p>
                                                            </div>
                                                            <div class="d-flex align-items-center">
                                                                <i class="cursor-pointer bx bx-comment-dots font-medium-4"></i>
                                                                <span class="ml-25">0</span>
                                                                <i class="cursor-pointer bx bx-share-alt font-medium-4 ml-1"></i>
                                                                <span class="ml-25">2</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- user profile nav tabs feed middle section user-4 card ends -->
                                                </div>
                                                <!-- user profile nav tabs feed middle section ends -->
                                            </div>
                                            <!-- user profile nav tabs feed ends -->
                                        </div>
                                        <div class="tab-pane " id="activity" aria-labelledby="activity-tab" role="tabpanel">
                                            <!-- user profile nav tabs activity start -->
                                            <div class="card">
                                                <div class="card-body">

                                                    <?php 
                                                    $strSQL = "SELECT * FROM log_pm WHERE user_id = '".$current_user['id']."' ORDER BY log_datetime DESC LIMIT 6";
                                                    $resLog = $db->fetch($strSQL, true, true);
                                                    if(($resLog) && ($resLog['status'])){
                                                        echo '<ul class="timeline">';
                                                        foreach ($resLog['data'] as $row) {
                                                            ?>
                                                            <li class="timeline-item timeline-icon-success active">
                                                                <div class="timeline-time"><?php echo $row['log_datetime']; ?></div>
                                                                <h6 class="timeline-title"><?php echo $row['log_activity']; ?></h6>
                                                                <p class="timeline-text">IP <a href="JavaScript:void(0);"><?php echo $row['log_ip']; ?></a></p>
                                                                <!-- <div class="timeline-content">
                                                                    Welcome to video game and lame is very creative
                                                                </div> -->
                                                            </li>
                                                            <?php
                                                        }
                                                        echo '</ul>';
                                                    }
                                                    ?>
                                                    <!-- timeline start -->
                                                    <!-- <ul class="timeline">
                                                        
                                                        <li class="timeline-item timeline-icon-primary active">
                                                            <div class="timeline-time">5 days ago</div>
                                                            <h6 class="timeline-title">Jonny Richie attached file</h6>
                                                            <p class="timeline-text">on <a href="JavaScript:void(0);">Project name</a></p>
                                                            <div class="timeline-content">
                                                                <img src="../../../app-assets/images/icon/sketch.png" alt="document" height="36" width="27" class="mr-50">Data Folder
                                                            </div>
                                                        </li>
                                                        <li class="timeline-item timeline-icon-danger active">
                                                            <div class="timeline-time">7 hours ago</div>
                                                            <h6 class="timeline-title">Mathew Slick docs</h6>
                                                            <p class="timeline-text">on <a href="JavaScript:void(0);">Project name</a></p>
                                                            <div class="timeline-content">
                                                                <img src="../../../app-assets/images/icon/pdf.png" alt="document" height="36" width="27" class="mr-50">Received Pdf
                                                            </div>
                                                        </li>
                                                        <li class="timeline-item timeline-icon-info active">
                                                            <div class="timeline-time">5 hour ago</div>
                                                            <h6 class="timeline-title">Petey Cruiser send you a message</h6>
                                                            <p class="timeline-text">on <a href="JavaScript:void(0);">Redited message</a></p>
                                                            <div class="timeline-content">
                                                                Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it
                                                                is
                                                                pain, but because occasionally circumstances
                                                            </div>
                                                        </li>
                                                        <li class="timeline-item timeline-icon-warning">
                                                            <div class="timeline-time">2 min ago</div>
                                                            <h6 class="timeline-title">Anna mull liked </h6>
                                                            <p class="timeline-text">on <a href="JavaScript:void(0);">Liked</a></p>
                                                            <div class="timeline-content">
                                                                The Amairates
                                                            </div>
                                                        </li>
                                                    </ul> -->
                                                    <!-- timeline ends -->
                                                    <div class="text-center">
                                                        <button class="btn btn-primary" onclick="window.location = 'page-user-activity'">View All Activity</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- user profile nav tabs activity start -->
                                        </div>
                                        <div class="tab-pane" id="friends" aria-labelledby="friends-tab" role="tabpanel">
                                            <!-- user profile nav tabs friends start -->
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5>บัญชีผู้ใช้งาน</h5>
                                                    <div class="row">
                                                        <div class="col-4">Username : </div>
                                                        <div class="col-8"><?php echo $current_user['username']; ?></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4">E-mail address : </div>
                                                        <div class="col-8"><?php echo $current_user['email']; ?></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4">รหัสผ่าน : </div>
                                                        <div class="col-8">
                                                            <?php 
                                                            $passlen = strlen(base64_decode($current_user['password']));
                                                            for ($i=0; $i < $passlen; $i++) { 
                                                                ?>
                                                                <i class="bx bxs-circle" style="font-size: 0.7em;"></i>
                                                                <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                        <button class="btn btn-sm d-none d-sm-block float-right btn-light-primary" data-toggle="modal" data-target="#modalPassword">
                                                                                <i class="cursor-pointer bx bx-edit font-small-3 mr-50"></i><span>เปลี่ยนรหัสผ่าน</span>
                                                                            </button>
                                                                            <button class="btn btn-sm d-block d-sm-none btn-block text-center btn-light-primary" data-toggle="modal" data-target="#modalPassword">
                                                                                <i class="cursor-pointer bx bx-edit font-small-3 mr-25"></i><span>เปลี่ยนรหัสผ่าน</span></button>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <!-- user profile nav tabs friends ends -->
                                        </div>
                                        <div class="tab-pane active" id="profile" aria-labelledby="profile-tab" role="tabpanel">
                                            <!-- user profile nav tabs profile start -->
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="row">
                                                                        <div class="col-12 text-center text-sm-left">
                                                                            <h6 class="media-heading mb-0 badge badge-light-success round"><?php echo $role; ?></h6>
                                                                            <h3 class="text-white"><?php echo $current_user['fname']." ".$current_user['lname']; ?></h3>
                                                                            <h5 class="text-muted"><?php echo $current_user['fname_en']." ".$current_user['lname_en']; ?></h5>
                                                                        </div>
                                                                        <div class="col-12 text-center text-sm-left">
                                                                            <div class="mb-1">
                                                                                <span class="mr-0"><small>โครงการวิจัยที่ยื่นขอพิจารณา</small> 122 โครงการ</span> | 
                                                                                <span class="mr-1"><small>โครงการที่รับเป็นผู้เชี่ยวชาญอิสระ</small> 4.7k โครงการ</span>
                                                                            </div>
                                                                            <p>
                                                                                <div><small>หน่วยงานที่สังกัด</small></div>
                                                                                <div>
                                                                                    <p class="text-white"><?php echo $current_user['dept_name']; ?>
                                                                                    <?php if($current_user['id_dept'] == '19'){ echo "(".$current_user['dept'].")";} ?>
                                                                                    <br>
                                                                                    <?php echo $current_user['dept_name_en']; ?>
                                                                                    <?php if($current_user['id_dept'] == '19'){ echo "(".$current_user['dept_en'].")";} ?>
                                                                                    </p>
                                                                                </div>
                                                                            </p>

                                                                            <p>
                                                                                <div><small>ตำแหน่ง (Position)</small></div>
                                                                                <div class="text-white">
                                                                                    <p  class="text-white"><?php echo $current_user['personnel_name']; ?></p>
                                                                                </div>
                                                                            </p>

                                                                            <p>
                                                                                <div><small>สาขาเชี่ยวชาญ (Expertise)</small></div>
                                                                                <div class="text-white">
                                                                                    <p  class="text-white"><?php echo $current_user['expertise']; ?></p>
                                                                                </div>
                                                                            </p>

                                                                            <p>
                                                                                <div><small>งานวิจัยที่สนใจ (Research interest)</small></div>
                                                                                <div class="text-white">
                                                                                    <p  class="text-white"><?php echo $current_user['rs_interest']; ?></p>
                                                                                </div>
                                                                            </p>

                                                                            <button class="btn btn-sm d-none d-sm-block float-right btn-light-primary" data-toggle="modal" data-target="#modalProfile">
                                                                                <i class="cursor-pointer bx bx-edit font-small-3 mr-50"></i><span>แก้ไขข้อมูลส่วนตัว</span>
                                                                            </button>
                                                                            <button class="btn btn-sm d-block d-sm-none btn-block text-center btn-light-primary" data-toggle="modal" data-target="#modalProfile">
                                                                                <i class="cursor-pointer bx bx-edit font-small-3 mr-25"></i><span>แก้ไขข้อมูลส่วนตัว</span></button>
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

                                <div class="modal fade" id="modalProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalCenterTitle">แก้ไขข้อมูลส่วนตัว</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <i class="bx bx-x"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form onsubmit="return false;" id="profile_form">
                                                    <div class="row">
                                                        <div class="from-group col-12 col-sm-4">
                                                            <label for="">คำนำหน้าชื่อ : <span class="text-danger">*</span></label>
                                                            <input type="text" id="txtPrefixTh" name="txtPrefixTh" class="form-control" value="<?php echo $current_user['prefix_th'];?>">
                                                            <small>นาย/นาง/นางสาว</small>
                                                        </div>
                                                        <div class="from-group col-12 col-sm-4">
                                                            <label for="">ชื่อ : <span class="text-danger">*</span></label>
                                                            <input type="text" id="txtFnameTh" name="txtFnameTh" class="form-control" value="<?php echo $current_user['fname'];?>">
                                                        </div>
                                                        <div class="from-group col-12 col-sm-4">
                                                            <label for="">นามสกุล : <span class="text-danger">*</span></label>
                                                            <input type="text" id="txtLnameTh" name="txtLnameTh" class="form-control" value="<?php echo $current_user['lname'];?>">
                                                        </div>
                                                    </div>

                                                    <div class="row mt-2">
                                                        <div class="from-group col-12 col-sm-4">
                                                            <label for="">Prefix : <span class="text-danger">*</span></label>
                                                            <input type="text" id="txtPrefixEn" name="txtPrefixEn" class="form-control" value="<?php echo $current_user['prefix_en'];?>">
                                                            <small>Mr./Ms.</small>
                                                        </div>
                                                        <div class="from-group col-12 col-sm-4">
                                                            <label for="">First name : <span class="text-danger">*</span></label>
                                                            <input type="text" id="txtFnameEn" name="txtFnameEn" class="form-control" value="<?php echo $current_user['fname_en'];?>">
                                                        </div>
                                                        <div class="from-group col-12 col-sm-4">
                                                            <label for="">Surname : <span class="text-danger">*</span></label>
                                                            <input type="text" id="txtLnameEn" name="txtLnameEn" class="form-control" value="<?php echo $current_user['lname_en'];?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group mt-2">
                                                        <label for="">ตำแหน่ง (Position) : <span class="text-danger">*</span></label>
                                                        <select name="txtPosition" id="txtPosition" class="form-control">
                                                                <option value="">-- เลือก --</option>
                                                                <?php 
                                                                $strSQL = "SELECT * FROM type_personnel WHERE 1 ORDER BY id_personnel";
                                                                $res = $db->fetch($strSQL, true, false);
                                                                if(($res) && ($res['status'])){
                                                                    foreach ($res['data'] as $row) {
                                                                        $check = '';
                                                                        if($current_user['id_personnel'] == $row['id_personnel']){
                                                                            $check = 'selected';
                                                                        }
                                                                        ?>
                                                                        <option value="<?php echo $row['id_personnel']; ?>" <?php echo $check; ?>><?php echo $row['personnel_name']; ?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                    </div>

                                                    <div class="other_position <?php  if($current_user['id_dept'] != '9'){ echo "dn"; }?>">
                                                        <div class="from-group">
                                                            <label for="">ประเภทตำแหน่งอื่น ๆ : <span class="text-danger">*</span></label>
                                                            <input type="text" id="txtPositionOther" name="txtPositionOther" class="form-control" value="<?php echo $current_user['person_other'];?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group mt-2">
                                                        <label for="">หน่วยงานที่สังกัด (Position) : <span class="text-danger">*</span></label>
                                                        <select name="txtDept" id="txtDept" class="form-control">
                                                                <option value="">-- เลือก --</option>
                                                                <option value="19" <?php if($current_user['id_dept'] == '19'){ echo "selected"; } ?>>บุคคลภายนอกคณะแพทยศาสตร์</option>
                                                                <option disabled="disabled">--------------------------------------</option>
                                                                <?php 
                                                                $strSQL = "SELECT * FROM dept WHERE id_dept != '19' ORDER BY dept_name";
                                                                $res = $db->fetch($strSQL, true, false);
                                                                if(($res) && ($res['status'])){
                                                                    foreach ($res['data'] as $row) {
                                                                        $check = '';
                                                                        if($current_user['id_dept'] == $row['id_dept']){
                                                                            $check = 'selected';
                                                                        }
                                                                        ?>
                                                                        <option value="<?php echo $row['id_dept']; ?>" <?php echo $check; ?>><?php echo $row['dept_name']; ?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                    </div>

                                                    <div class="other_dept <?php  if($current_user['id_dept'] != '19'){ echo "dn"; }?>">
                                                        <div class="from-group">
                                                            <label for="">ชื่อหน่วยงานที่สังกัด : <span class="text-danger">*</span></label>
                                                            <input type="text" id="txtOtherDeptTh" name="txtOtherDeptTh" class="form-control" value="<?php echo $current_user['dept'];?>">
                                                        </div>

                                                        <div class="from-group mt-2">
                                                            <label for="">Department / Institution name (English) : <span class="text-danger">*</span></label>
                                                            <input type="text" id="txtOtherDeptEn" name="txtOtherDeptEn" class="form-control" value="<?php echo $current_user['dept_en'];?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group mt-2">
                                                        <label for="">สาขาเชี่ยวชาญ (Expertise) :</label>
                                                        <textarea name="txtExpertise" id="txtExpertise" cols="30" rows="4" class="form-control"><?php echo $current_user['expertise']; ?></textarea>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="">งานวิจัยที่สนใจ (Research interest) :</label>
                                                        <textarea name="txtRi" id="txtRi" cols="30" rows="4" class="form-control"><?php echo $current_user['rs_interest']; ?></textarea>
                                                    </div>

                                                    
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">ปิด</span>
                                                </button>
                                                <button type="button" class="btn btn-success ml-1" onclick="authen.update_profile()">
                                                    <i class="bx bx-check d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">บันทึก</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="modalContact" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalCenterTitle">แก้ไขข้อมูลการติดต่อ</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <i class="bx bx-x"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form onsubmit="return false;" id="profile_form">
                                                    <div class="row">
                                                        <div class="from-group col-12 col-sm-12">
                                                            <label for="">E-mail address : <span class="text-danger">*</span></label>
                                                            <input type="text" id="txtEmail" name="txtEmail" class="form-control" value="<?php echo $current_user['email'];?>" readonly>
                                                        </div>
                                                        <div class="from-group col-12 col-sm-12 mt-2">
                                                            <label for="">ที่อยู่ : </label>
                                                            <textarea name="txtAddress" id="txtAddress" cols="30" rows="3" class="form-control"><?php echo $current_user['address'];?></textarea>
                                                        </div>
                                                        <div class="from-group col-12 col-sm-4 mt-2">
                                                            <label for="">หมายเลขโทรศัพท์มือถือ : <span class="text-danger">*</span></label>
                                                            <input type="text" id="txtPhone" name="txtPhone" class="form-control" value="<?php echo $current_user['tel_mobile'];?>">
                                                        </div>
                                                        <div class="from-group col-12 col-sm-4 mt-2">
                                                            <label for="">โทรศัพท์สำนักงาน : <span class="text-danger">*</span></label>
                                                            <input type="text" id="txtOffice" name="txtOffice" class="form-control" value="<?php echo $current_user['tel_office'];?>">
                                                        </div>
                                                        <div class="from-group col-12 col-sm-4 mt-2">
                                                            <label for="">FAX : </label>
                                                            <input type="text" id="txtFax" name="txtFax" class="form-control" value="<?php echo $current_user['tel_fax'];?>">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">ปิิด</span>
                                                </button>
                                                <button type="button" class="btn btn-success ml-1" onclick="authen.update_contact()">
                                                    <i class="bx bx-check d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">บันทึก</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="modalPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalCenterTitle">เปลี่ยนรหัสผ่าน</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <i class="bx bx-x"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form onsubmit="return false;" id="profile_form">
                                                    <div class="row">
                                                        <div class="from-group col-12 col-sm-12">
                                                            <label for="">รหัสผ่านเดิม : <span class="text-danger">*</span></label>
                                                            <input type="password" id="txtPassword0" name="txtPassword0" class="form-control" >
                                                        </div>
                                                        <div class="from-group col-12 col-sm-12 mt-2">
                                                            <label for="">รหัสผ่านใหม่ : <span class="text-danger">*</span></label>
                                                            <input type="password" id="txtPassword1" name="txtPassword1" class="form-control" >
                                                        </div>
                                                        <div class="from-group col-12 col-sm-12 mt-2">
                                                            <label for="">ยืนยันรหัสผ่านใหม่ : <span class="text-danger">*</span> </label>
                                                            <input type="password" id="txtPassword2" name="txtPassword2" class="form-control" >
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">ปิิด</span>
                                                </button>
                                                <button type="button" class="btn btn-success ml-1" onclick="authen.update_password('<?php echo $current_user['id'];?>')">
                                                    <i class="bx bx-check d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">บันทึก</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-5">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">ข้อมูลการติดต่อ</h5>
                                            <ul class="list-unstyled">
                                                <li><i class="cursor-pointer bx bx-map mb-1 mr-50"></i><?php echo $current_user['address'] ?></li>
                                                <li><i class="cursor-pointer bx bx-envelope mb-1 mr-50"></i><?php echo $current_user['email'] ?></li>
                                            </ul>
                                            <div class="row">
                                                <div class="col-12">
                                                    <h6><small class="text-muted">หมายเลขโทรศัพท์มือถือ</small></h6>
                                                    <p><?php echo $current_user['tel_mobile']; ?></p>
                                                </div>
                                                <div class="col-12">
                                                    <h6><small class="text-muted">โทรศัพท์สำนักงาน</small></h6>
                                                    <p><?php echo $current_user['tel_office']; ?></p>
                                                </div>
                                                <div class="col-12">
                                                    <h6><small class="text-muted">แฟกซ์</small></h6>
                                                    <p><?php echo $current_user['tel_fax']; ?></p>
                                                </div>
                                            </div>
                                            <button class="btn btn-sm d-none d-sm-block float-right btn-light-primary mb-2" data-toggle="modal" data-target="#modalContact">
                                                <i class="cursor-pointer bx bx-edit font-small-3 mr-50"></i><span>แก้ไขข้อมูลการติดต่อ</span>
                                            </button>
                                            <button class="btn btn-sm d-block d-sm-none btn-block text-center btn-light-primary" data-toggle="modal" data-target="#modalContact">
                                                <i class="cursor-pointer bx bx-edit font-small-3 mr-25"></i><span>แก้ไขข้อมูลการติดต่อ</span></button>
                                        </div>
                                    </div>
                                    <!-- user profile nav tabs profile ends -->
                                </div>
                                <!-- user profile nav tabs content ends -->
                            </div>
                            <!-- user profile content section start -->
                        </div>
                    </div>
                </section>
                <!-- page user profile ends -->

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
    <script src="../../../app-assets/vendors/js/extensions/swiper.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <script src="../../../app-assets/js/scripts/pages/page-user-profile.js"></script>
    <!-- END: Theme JS-->


    <script src="../../../assets/js/core.js?v=<?php echo filemtime('../../../assets/js/core.js'); ?>"></script>
    <script src="../../../assets/js/authen.js?v=<?php echo filemtime('../../../assets/js/authen.js'); ?>"></script>
    <script src="../../../assets/js/staff-function.js?v=<?php echo filemtime('../../../assets/js/staff-function.js'); ?>"></script>

    <script>
        preload.hide()
    </script>

</body>
<!-- END: Body-->

</html>