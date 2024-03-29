<?php 
require('../../../configuration/server.inc.php');
require('../../../configuration/configuration.php');
require('../../../configuration/database.php'); 
require('../../../configuration/session.php'); 

// header('Location: '.RMIS_DOMAIN );
// die();

$db = new Database();
$conn = $db->conn();
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
    <title>Basic Card - RMIS@MED PSU - Bootstrap HTML admin template</title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
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
    <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-static-top bg-success navbar-brand-center">
        <div class="navbar-header d-xl-block d-none">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item"><a class="navbar-brand" href="../../../html/ltr/horizontal-menu-template-dark/index.html">
                        <div class="brand-logo"><img class="logo" src="../../../app-assets/images/logo/logo-light.png"></div>
                        <h2 class="brand-text mb-0">RMIS@MED PSU</h2>
                    </a></li>
            </ul>
        </div>
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                        <ul class="nav navbar-nav">
                            <li class="nav-item mobile-menu mr-auto"><a class="nav-link nav-menu-main menu-toggle" href="javascript:void(0);"><i class="bx bx-menu"></i></a></li>
                        </ul>
                    </div>
                    <ul class="nav navbar-nav float-right d-flex align-items-center">
                        <li class="nav-item nav-search"><a class="nav-link nav-link-search pt-2"><i class="ficon bx bx-search"></i></a>
                            <div class="search-input">
                                <div class="search-input-icon"><i class="bx bx-search primary"></i></div>
                                <input class="input" type="text" placeholder="Explore RMIS@MED PSU..." tabindex="-1" data-search="template-search">
                                <div class="search-input-close"><i class="bx bx-x"></i></div>
                                <ul class="search-list"></ul>
                            </div>
                        </li>
                        <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="javascript:void(0);" data-toggle="dropdown"><i class="ficon bx bx-bell bx-tada bx-flip-horizontal"></i><span class="badge badge-pill badge-danger badge-up">5</span></a>
                            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                                <li class="dropdown-menu-header">
                                    <div class="dropdown-header px-1 py-75 d-flex justify-content-between"><span class="notification-title">7 new Notification</span><span class="text-bold-400 cursor-pointer">Mark all as read</span></div>
                                </li>
                                <li class="scrollable-container media-list"><a class="d-flex justify-content-between" href="javascript:void(0);">
                                        <div class="media d-flex align-items-center">
                                            <div class="media-left pr-0">
                                                <div class="avatar mr-1 m-0"><img src="../../../app-assets/images/portrait/small/avatar-s-11.jpg" alt="avatar" height="39" width="39"></div>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading"><span class="text-bold-500">Congratulate Socrates Itumay</span> for work anniversaries</h6><small class="notification-text">Mar 15 12:32pm</small>
                                            </div>
                                        </div>
                                    </a><a class="d-flex justify-content-between read-notification cursor-pointer" href="javascript:void(0);">
                                        <div class="media d-flex align-items-center">
                                            <div class="media-left pr-0">
                                                <div class="avatar mr-1 m-0"><img src="../../../app-assets/images/portrait/small/avatar-s-16.jpg" alt="avatar" height="39" width="39"></div>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading"><span class="text-bold-500">New Message</span> received</h6><small class="notification-text">You have 18 unread messages</small>
                                            </div>
                                        </div>
                                    </a><a class="d-flex justify-content-between cursor-pointer" href="javascript:void(0);">
                                        <div class="media d-flex align-items-center py-0">
                                            <div class="media-left pr-0"><img class="mr-1" src="../../../app-assets/images/icon/sketch-mac-icon.png" alt="avatar" height="39" width="39"></div>
                                            <div class="media-body">
                                                <h6 class="media-heading"><span class="text-bold-500">Updates Available</span></h6><small class="notification-text">Sketch 50.2 is currently newly added</small>
                                            </div>
                                            <div class="media-right pl-0">
                                                <div class="row border-left text-center">
                                                    <div class="col-12 px-50 py-75 border-bottom">
                                                        <h6 class="media-heading text-bold-500 mb-0">Update</h6>
                                                    </div>
                                                    <div class="col-12 px-50 py-75">
                                                        <h6 class="media-heading mb-0">Close</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a><a class="d-flex justify-content-between cursor-pointer" href="javascript:void(0);">
                                        <div class="media d-flex align-items-center">
                                            <div class="media-left pr-0">
                                                <div class="avatar bg-primary bg-lighten-5 mr-1 m-0 p-25"><span class="avatar-content text-primary font-medium-2">LD</span></div>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading"><span class="text-bold-500">New customer</span> is registered</h6><small class="notification-text">1 hrs ago</small>
                                            </div>
                                        </div>
                                    </a><a href="javascript:void(0);">
                                        <div class="media d-flex align-items-center justify-content-between">
                                            <div class="media-left pr-0">
                                                <div class="media-body">
                                                    <h6 class="media-heading">New Offers</h6>
                                                </div>
                                            </div>
                                            <div class="media-right">
                                                <div class="custom-control custom-switch">
                                                    <input class="custom-control-input" type="checkbox" checked id="notificationSwtich">
                                                    <label class="custom-control-label" for="notificationSwtich"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </a><a class="d-flex justify-content-between cursor-pointer" href="javascript:void(0);">
                                        <div class="media d-flex align-items-center">
                                            <div class="media-left pr-0">
                                                <div class="avatar bg-danger bg-lighten-5 mr-1 m-0 p-25"><span class="avatar-content"><i class="bx bxs-heart text-danger"></i></span></div>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading"><span class="text-bold-500">Application</span> has been approved</h6><small class="notification-text">6 hrs ago</small>
                                            </div>
                                        </div>
                                    </a><a class="d-flex justify-content-between read-notification cursor-pointer" href="javascript:void(0);">
                                        <div class="media d-flex align-items-center">
                                            <div class="media-left pr-0">
                                                <div class="avatar mr-1 m-0"><img src="../../../app-assets/images/portrait/small/avatar-s-4.jpg" alt="avatar" height="39" width="39"></div>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading"><span class="text-bold-500">New file</span> has been uploaded</h6><small class="notification-text">4 hrs ago</small>
                                            </div>
                                        </div>
                                    </a><a class="d-flex justify-content-between cursor-pointer" href="javascript:void(0);">
                                        <div class="media d-flex align-items-center">
                                            <div class="media-left pr-0">
                                                <div class="avatar bg-rgba-danger m-0 mr-1 p-25">
                                                    <div class="avatar-content"><i class="bx bx-detail text-danger"></i></div>
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading"><span class="text-bold-500">Finance report</span> has been generated</h6><small class="notification-text">25 hrs ago</small>
                                            </div>
                                        </div>
                                    </a><a class="d-flex justify-content-between cursor-pointer" href="javascript:void(0);">
                                        <div class="media d-flex align-items-center border-0">
                                            <div class="media-left pr-0">
                                                <div class="avatar mr-1 m-0"><img src="../../../app-assets/images/portrait/small/avatar-s-16.jpg" alt="avatar" height="39" width="39"></div>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading"><span class="text-bold-500">New customer</span> comment recieved</h6><small class="notification-text">2 days ago</small>
                                            </div>
                                        </div>
                                    </a></li>
                                <li class="dropdown-menu-footer"><a class="dropdown-item p-50 text-primary justify-content-center" href="javascript:void(0);">Read all notifications</a></li>
                            </ul>
                        </li>
                        <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="javascript:void(0);" data-toggle="dropdown">
                                <div class="user-nav d-lg-flex d-none"><span class="user-name">John Doe</span><span class="user-status">Available</span></div><span><img class="round" src="../../../app-assets/images/portrait/small/avatar-s-11.jpg" alt="avatar" height="40" width="40"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right pb-0"><a class="dropdown-item" href="page-user-profile.html"><i class="bx bx-user mr-50"></i> Edit Profile</a><a class="dropdown-item" href="app-email.html"><i class="bx bx-envelope mr-50"></i> My Inbox</a><a class="dropdown-item" href="app-todo.html"><i class="bx bx-check-square mr-50"></i> Task</a><a class="dropdown-item" href="app-chat.html"><i class="bx bx-message mr-50"></i> Chats</a>
                                <div class="dropdown-divider mb-0"></div><a class="dropdown-item" href="auth-login.html"><i class="bx bx-power-off mr-50"></i> Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
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
                <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="index.html" data-toggle="dropdown"><i class="menu-livicon" data-icon="desktop"></i><span data-i18n="Dashboard">หน้าแรก</span></a>
                    <ul class="dropdown-menu">
                        <li data-menu=""><a class="dropdown-item align-items-center" href="dashboard-ecommerce.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="eCommerce">eCommerce</span></a>
                        </li>
                        <li data-menu=""><a class="dropdown-item align-items-center" href="dashboard-analytics.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Analytics">Analytics</span></a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="menu-livicon" data-icon="comments"></i><span data-i18n="Apps">Apps</span></a>
                    <ul class="dropdown-menu">
                        <li data-menu=""><a class="dropdown-item align-items-center" href="app-email.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Email">Email</span></a>
                        </li>
                        <li data-menu=""><a class="dropdown-item align-items-center" href="app-chat.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Chat">Chat</span></a>
                        </li>
                        <li data-menu=""><a class="dropdown-item align-items-center" href="app-todo.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Todo">Todo</span></a>
                        </li>
                        <li data-menu=""><a class="dropdown-item align-items-center" href="app-calendar.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Calendar">Calendar</span></a>
                        </li>
                        <li data-menu=""><a class="dropdown-item align-items-center" href="app-kanban.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Kanban">Kanban</span></a>
                        </li>
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a class="dropdown-item align-items-center dropdown-toggle" href="#" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Invoice">Invoice</span></a>
                            <ul class="dropdown-menu">
                                <li data-menu=""><a class="dropdown-item align-items-center" href="app-invoice-list.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Invoice List">Invoice List</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="app-invoice.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Invoice">Invoice</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="app-invoice-edit.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Invoice Edit">Invoice Edit</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="app-invoice-add.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Invoice Add">Invoice Add</span></a>
                                </li>
                            </ul>
                        </li>
                        <li data-menu=""><a class="dropdown-item align-items-center" href="app-file-manager.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="File Manager">File Manager</span></a>
                        </li>
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a class="dropdown-item align-items-center dropdown-toggle" href="#" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="User">User</span></a>
                            <ul class="dropdown-menu">
                                <li data-menu=""><a class="dropdown-item align-items-center" href="app-users-list.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="List">List</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="app-users-view.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="View">View</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="app-users-edit.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Edit">Edit</span></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="menu-livicon" data-icon="briefcase"></i><span data-i18n="UI">UI</span></a>
                    <ul class="dropdown-menu">
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a class="dropdown-item align-items-center dropdown-toggle" href="#" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Content">Content</span></a>
                            <ul class="dropdown-menu">
                                <li data-menu=""><a class="dropdown-item align-items-center" href="content-grid.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Grid">Grid</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="content-typography.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Typography">Typography</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="content-text-utilities.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Text Utilities">Text Utilities</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="content-syntax-highlighter.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Syntax Highlighter">Syntax Highlighter</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="content-helper-classes.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Helper Classes">Helper Classes</span></a>
                                </li>
                            </ul>
                        </li>
                        <li data-menu=""><a class="dropdown-item align-items-center" href="colors.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Colors">Colors</span></a>
                        </li>
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a class="dropdown-item align-items-center dropdown-toggle" href="#" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Icons">Icons</span></a>
                            <ul class="dropdown-menu">
                                <li data-menu=""><a class="dropdown-item align-items-center" href="icons-boxicons.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="boxicons">Boxicons</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="icons-livicons.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="LivIcons">LivIcons</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a class="dropdown-item align-items-center dropdown-toggle" href="#" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Card">Card</span></a>
                            <ul class="dropdown-menu">
                                <li class="active" data-menu=""><a class="dropdown-item align-items-center" href="card-basic.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Basic">Basic</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="card-actions.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Card Actions">Card Actions</span></a>
                                </li>
                            </ul>
                        </li>
                        <li data-menu=""><a class="dropdown-item align-items-center" href="widgets.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Card Widgets">Widgets</span></a>
                        </li>
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a class="dropdown-item align-items-center dropdown-toggle" href="#" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Components">Components</span></a>
                            <ul class="dropdown-menu">
                                <li data-menu=""><a class="dropdown-item align-items-center" href="component-alerts.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Alerts">Alerts</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="component-buttons-basic.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Buttons">Buttons</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="component-breadcrumbs.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Breadcrumbs">Breadcrumbs</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="component-carousel.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Carousel">Carousel</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="component-collapse.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Collapse">Collapse</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="component-dropdowns.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Dropdowns">Dropdowns</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="component-list-group.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="List Group">List Group</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="component-modals.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Modals">Modals</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="component-pagination.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Pagination">Pagination</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="component-navbar.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Navbar">Navbar</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="component-tabs-component.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Tabs Component">Tabs Component</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="component-pills-component.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Pills Component">Pills Component</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="component-tooltips.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Tooltips">Tooltips</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="component-popovers.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Popovers">Popovers</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="component-badges.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Badges">Badges</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="component-pill-badges.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Pill Badges">Pill Badges</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="component-progress.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Progress">Progress</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="component-media-objects.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Media Objects">Media Objects</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="component-spinner.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Spinner">Spinner</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="component-bs-toast.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Toasts">Toasts</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a class="dropdown-item align-items-center dropdown-toggle" href="#" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Extra Components">Extra Components</span></a>
                            <ul class="dropdown-menu">
                                <li data-menu=""><a class="dropdown-item align-items-center" href="ex-component-avatar.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Avatar">Avatar</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="ex-component-chips.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Chips">Chips</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="ex-component-divider.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Divider">Divider</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a class="dropdown-item align-items-center dropdown-toggle" href="#" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Extensions">Extensions</span></a>
                            <ul class="dropdown-menu">
                                <li data-menu=""><a class="dropdown-item align-items-center" href="ext-component-sweet-alerts.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Sweet Alert">Sweet Alert</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="ext-component-toastr.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Toastr">Toastr</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="ext-component-noui-slider.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="NoUi Slider">NoUi Slider</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="ext-component-drag-drop.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Drag &amp; Drop">Drag &amp; Drop</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="ext-component-tour.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Tour">Tour</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="ext-component-swiper.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="l18n">Swiper</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="ext-component-treeview.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="l18n">Treeview</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="ext-component-block-ui.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="l18n">Block-UI</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="ext-component-media-player.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="l18n">Media Player</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="ext-component-miscellaneous.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Miscellaneous">Miscellaneous</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="ext-component-i18n.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="I18n">i18n</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="ext-component-ratings.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Ratings">Ratings</span></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="menu-livicon" data-icon="thumbnails-big"></i><span data-i18n="Forms &amp; Tables">Forms &amp; Tables</span></a>
                    <ul class="dropdown-menu">
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a class="dropdown-item align-items-center dropdown-toggle" href="#" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Form Elements">Form Elements</span></a>
                            <ul class="dropdown-menu">
                                <li data-menu=""><a class="dropdown-item align-items-center" href="form-inputs.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Input">Input</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="form-input-groups.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Input Groups">Input Groups</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="form-number-input.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Number Input">Number Input</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="form-select.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Select">Select</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="form-radio.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Radio">Radio</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="form-checkbox.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Checkbox">Checkbox</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="form-switch.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Switch">Switch</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="form-textarea.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Textarea">Textarea</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="form-quill-editor.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Quill Editor">Quill Editor</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="form-file-uploader.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="File Uploader">File Uploader</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="form-date-time-picker.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Date &amp; Time Picker">Date &amp; Time Picker</span></a>
                                </li>
                            </ul>
                        </li>
                        <li data-menu=""><a class="dropdown-item align-items-center" href="form-layout.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Form Layout">Form Layout</span></a>
                        </li>
                        <li data-menu=""><a class="dropdown-item align-items-center" href="form-wizard.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Form Wizard">Form Wizard</span></a>
                        </li>
                        <li data-menu=""><a class="dropdown-item align-items-center" href="form-validation.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Form Validation">Form Validation</span></a>
                        </li>
                        <li data-menu=""><a class="dropdown-item align-items-center" href="form-repeater.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Form Repeater">Form Repeater</span></a>
                        </li>
                        <li data-menu=""><a class="dropdown-item align-items-center" href="table.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Table">Table</span></a>
                        </li>
                        <li data-menu=""><a class="dropdown-item align-items-center" href="table-extended.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Table">Table extended</span></a>
                        </li>
                        <li data-menu=""><a class="dropdown-item align-items-center" href="table-datatable.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Datatable">Datatable</span></a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="menu-livicon" data-icon="notebook"></i><span data-i18n="Pages">Pages</span></a>
                    <ul class="dropdown-menu">
                        <li data-menu=""><a class="dropdown-item align-items-center" href="page-user-profile.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="User Profile">User Profile</span></a>
                        </li>
                        <li data-menu=""><a class="dropdown-item align-items-center" href="page-faq.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="FAQ">FAQ</span></a>
                        </li>
                        <li data-menu=""><a class="dropdown-item align-items-center" href="page-knowledge-base.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Knowledge Base">Knowledge Base</span></a>
                        </li>
                        <li data-menu=""><a class="dropdown-item align-items-center" href="page-search.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Search">Search</span></a>
                        </li>
                        <li data-menu=""><a class="dropdown-item align-items-center" href="page-account-settings.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Account Settings">Account Settings</span></a>
                        </li>
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a class="dropdown-item align-items-center dropdown-toggle" href="#" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Starter kit">Starter kit</span></a>
                            <ul class="dropdown-menu">
                                <li data-menu=""><a class="dropdown-item align-items-center" href="../../../starter-kit/ltr/horizontal-menu-template-dark/sk-layout-1-column.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="1 column">1 column</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="../../../starter-kit/ltr/horizontal-menu-template-dark/sk-layout-2-columns.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="2 columns">2 columns</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="../../../starter-kit/ltr/horizontal-menu-template-dark/sk-layout-fixed-navbar.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Fixed navbar">Fixed navbar</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="../../../starter-kit/ltr/horizontal-menu-template-dark/sk-layout-fixed.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Fixed layout">Fixed layout</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="../../../starter-kit/ltr/horizontal-menu-template-dark/sk-layout-static.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Static layout">Static layout</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a class="dropdown-item align-items-center dropdown-toggle" href="#" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Authentication">Authentication</span></a>
                            <ul class="dropdown-menu">
                                <li data-menu=""><a class="dropdown-item align-items-center" href="auth-login.html" data-toggle="dropdown" target="_blank"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Login">Login</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="auth-register.html" data-toggle="dropdown" target="_blank"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Register">Register</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="auth-forgot-password.html" data-toggle="dropdown" target="_blank"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Forgot Password">Forgot Password</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="auth-reset-password.html" data-toggle="dropdown" target="_blank"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Reset Password">Reset Password</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="auth-lock-screen.html" data-toggle="dropdown" target="_blank"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Lock Screen">Lock Screen</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a class="dropdown-item align-items-center dropdown-toggle" href="#" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Miscellaneous">Miscellaneous</span></a>
                            <ul class="dropdown-menu">
                                <li data-menu=""><a class="dropdown-item align-items-center" href="page-coming-soon.html" data-toggle="dropdown" target="_blank"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Coming Soon">Coming Soon</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="error-404.html" data-toggle="dropdown" target="_blank"><i class="bx bx-right-arrow-alt"></i><span data-i18n="404">404</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="error-500.html" data-toggle="dropdown" target="_blank"><i class="bx bx-right-arrow-alt"></i><span data-i18n="500">500</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="page-not-authorized.html" data-toggle="dropdown" target="_blank"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Not Authorized">Not Authorized</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item align-items-center" href="page-maintenance.html" data-toggle="dropdown" target="_blank"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Maintenance">Maintenance</span></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="menu-livicon" data-icon="pie-chart"></i><span data-i18n="Charts &amp; Maps">Charts &amp; Maps</span></a>
                    <ul class="dropdown-menu">
                        <li data-menu=""><a class="dropdown-item align-items-center" href="chart-apex.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Apex">Apex</span></a>
                        </li>
                        <li data-menu=""><a class="dropdown-item align-items-center" href="chart-chartjs.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Chartjs">Chartjs</span></a>
                        </li>
                        <li data-menu=""><a class="dropdown-item align-items-center" href="chart-chartist.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Chartist">Chartist</span></a>
                        </li>
                        <li data-menu=""><a class="dropdown-item align-items-center" href="maps-leaflet.html" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Leaflet Maps">Leaflet Maps</span></a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="menu-livicon" data-icon="morph-folder"></i><span data-i18n="Others">Others</span></a>
                    <ul class="dropdown-menu">
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a class="dropdown-item align-items-center dropdown-toggle" href="#" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Menu Levels">Menu Levels</span></a>
                            <ul class="dropdown-menu">
                                <li data-menu=""><a class="dropdown-item align-items-center" href="#" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i><span data-i18n="Second Level">Second Level</span></a>
                                </li>
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
                </li>
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
                        <h5 class="content-header-title float-left pr-1 mb-0">ระบบรายงานความก้าวหน้างานวิจัย</h5>
                        <div class="breadcrumb-wrapper d-none d-sm-block">
                            <ol class="breadcrumb p-0 mb-0 pl-1">
                                <li class="breadcrumb-item"><a href="index.html"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Card</a>
                                </li>
                                <li class="breadcrumb-item active">Basic Card
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="alert bg-rgba-primary">
                    <i class="bx bx-info-circle mr-1 align-middle"></i>
                    <span class="align-middle">
                        Click <a href="https://getbootstrap.com/docs/4.5/components/card/" target="_blank"><u>here</u></a>
                        for more info on cards.
                    </span>
                </div>
                <!-- Basic card section start -->
                <section id="content-types">
                    <div class="row">
                        <div class="col-xl-4 col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Card With Header And Footer</h4>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">
                                        Gummies bonbon apple pie fruitcake icing biscuit apple pie jelly-o sweet roll. Toffee
                                        sugar plum sugar plum jelly-o jujubes bonbon dessert carrot cake. Caramels liquorice biscuit ice cream fruitcake cotton candy tart.
                                    </p>
                                </div>
                                <img class="img-fluid" src="../../../app-assets/images/slider/11.png" alt="Card image cap">
                                <div class="card-footer d-flex justify-content-between">
                                    <span>Card Footer</span>
                                    <button class="btn btn-light-primary">Read More</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 col-sm-12">
                            <div class="card">
                                <img src="../../../app-assets/images/slider/10.png" class="card-img-top img-fluid" alt="singleminded">
                                <div class="card-header">
                                    <h4 class="card-title">Be Single Minded</h4>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">
                                        Chocolate sesame snaps apple pie danish cupcake sweet roll jujubes tiramisu.Gummies
                                        bonbon apple pie fruitcake icing biscuit apple pie jelly-o sweet roll.
                                    </p>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Cras justo odio</li>
                                    <li class="list-group-item">Dapibus ac facilisis in</li>
                                    <li class="list-group-item">Vestibulum at eros</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Carousel</h4>
                                    <h6 class="card-subtitle">Support card subtitle</h6>
                                </div>
                                <div id="carousel-example-card" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <li data-target="#carousel-example-card" data-slide-to="0" class="active"></li>
                                        <li data-target="#carousel-example-card" data-slide-to="1"></li>
                                        <li data-target="#carousel-example-card" data-slide-to="2"></li>
                                    </ol>
                                    <div class="carousel-inner rounded-0" role="listbox">
                                        <div class="carousel-item active">
                                            <img src="../../../app-assets/images/slider/01.jpg" class="d-block w-100" alt="First slide">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="../../../app-assets/images/slider/02.jpg" class="d-block w-100" alt="Second slide">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="../../../app-assets/images/slider/03.jpg" class="d-block w-100" alt="Third slide">
                                        </div>
                                    </div>
                                    <a class="carousel-control-prev" href="#carousel-example-card" role="button" data-slide="prev">
                                        <span class="bx bx-chevron-left icon-prev" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carousel-example-card" role="button" data-slide="next">
                                        <span class="bx bx-chevron-right icon-next" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt assumenda mollitia
                                        officia dolorum eius quasi.Chocolate sesame snaps apple pie danish cupcake sweet roll jujubes tiramisu.
                                    </p>
                                    <p class="card-text">
                                        Gummies bonbon apple pie fruitcake icing biscuit apple pie jelly-o sweet roll. Toffee sugar plum sugar
                                        plum jelly-o jujubes bonbon dessert carrot cake. Sweet pie candy jelly.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 col-sm-12">
                            <div class="card collapse-icon accordion-icon-rotate">
                                <div class="card-header">
                                    <h4 class="card-title">Accordion</h4>
                                </div>
                                <div class="card-body">
                                    <div class="accordion" id="cardAccordion">
                                        <div class="card">
                                            <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" role="button">
                                                <span class="collapsed collapse-title">Accordion Item 1</span>
                                            </div>
                                            <div id="collapseOne" class="collapse pt-1" aria-labelledby="headingOne" data-parent="#cardAccordion">
                                                <div class="card-body">
                                                    Cheesecake muffin cupcake dragée lemon drops tiramisu cake gummies chocolate cake. Marshmallow tart
                                                    croissant. Tart dessert tiramisu marzipan lollipop lemon drops.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card collapse-header">
                                            <div class="card-header" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" role="button">
                                                <span class="collapsed collapse-title">Accordion Item 2</span>
                                            </div>
                                            <div id="collapseTwo" class="collapse pt-1" aria-labelledby="headingTwo" data-parent="#cardAccordion">
                                                <div class="card-body">
                                                    Pastry pudding cookie toffee bonbon jujubes jujubes powder topping. Jelly beans gummi bears sweet
                                                    roll bonbon muffin liquorice. Wafer lollipop sesame snaps.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card open">
                                            <div class="card-header" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree" role="button">
                                                <span class="collapsed collapse-title">Accordion Item 3</span>
                                            </div>
                                            <div id="collapseThree" class="collapse show pt-1" aria-labelledby="headingThree" data-parent="#cardAccordion">
                                                <div class="card-body">
                                                    Sweet pie candy jelly. Sesame snaps biscuit sugar plum. Sweet roll topping fruitcake. Caramels
                                                    liquorice biscuit ice cream fruitcake cotton candy tart.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="headingFour" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour" role="button">
                                                <span class="collapsed  collapse-title">Accordion Item 4</span>
                                            </div>
                                            <div id="collapseFour" class="collapse pt-1" aria-labelledby="headingFour" data-parent="#cardAccordion">
                                                <div class="card-body">
                                                    Sweet pie candy jelly. Sesame snaps biscuit sugar plum. Sweet roll topping fruitcake. Caramels
                                                    liquorice biscuit ice cream fruitcake cotton candy tart.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Video Card</h4>
                                </div>
                                <div class="embed-responsive embed-responsive-item embed-responsive-16by9">
                                    <iframe src="https://www.youtube.com/embed/1La4QzGeaaQ" allowfullscreen></iframe>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">
                                        Candy cupcake sugar plum oat cake wafer marzipan jujubes.
                                        Jelly-o sesame snaps cheesecake topping. Cupcake fruitcake macaroon donut pastry gummies tiramisu
                                        chocolate bar muffin.
                                    </p>
                                    <a href="javascript:void(0);" class="card-link">Card link</a>
                                    <a href="javascript:void(0);" class="card-link">Another link</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Feedback Form</h4>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">
                                        Gummies bonbon apple pie fruitcake icing biscuit apple pie jelly-o sweet roll. Toffee sugar plum sugar
                                        plum jelly-o jujubes bonbon dessert carrot cake.
                                    </p>
                                    <form class="form" method="post" action="javascript:void(0)">
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label for="feedback1" class="sr-only">Name</label>
                                                <input type="text" id="feedback1" class="form-control" placeholder="Name" name="name">
                                            </div>
                                            <div class="form-group">
                                                <label for="feedback4" class="sr-only">Last Game</label>
                                                <input type="text" id="feedback4" class="form-control" placeholder="Last Name" name="LastName">
                                            </div>
                                            <div class="form-group">
                                                <label for="feedback2" class="sr-only">Email</label>
                                                <input type="email" id="feedback2" class="form-control" placeholder="Email" name="email">
                                            </div>
                                            <div class="form-group">
                                                <select name="reason" class="form-control">
                                                    <option value="Inquiry">Inquiry</option>
                                                    <option value="Complain">complaints</option>
                                                    <option value="Quotation">Quotation</option>
                                                </select>
                                            </div>
                                            <div class="form-group form-label-group">
                                                <textarea class="form-control" id="label-textarea" rows="3" placeholder="Suggestion"></textarea>
                                                <label for="label-textarea"></label>
                                            </div>
                                        </div>
                                        <div class="form-actions d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary mr-1">Submit</button>
                                            <button type="reset" class="btn btn-light-primary">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="card">
                                <img class="card-img-top img-fluid" src="../../../app-assets/images/slider/05.jpg" alt="Card image cap" />
                                <div class="card-header">
                                    <h4 class="card-title">Top Image Cap</h4>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">
                                        Jelly-o sesame snaps cheesecake topping. Cupcake fruitcake macaroon donut
                                        pastry gummies tiramisu chocolate bar muffin. Dessert bonbon caramels brownie chocolate bar
                                        chocolate tart dragée.
                                    </p>
                                    <p class="card-text">
                                        Cupcake fruitcake macaroon donut pastry gummies tiramisu chocolate bar muffin.
                                    </p>
                                    <button class="btn btn-primary block">Update now</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Bottom Image Cap</h4>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">
                                        Jelly-o sesame snaps cheesecake topping. Cupcake fruitcake macaroon donut
                                        pastry gummies tiramisu chocolate bar muffin. Dessert bonbon caramels brownie chocolate bar
                                        chocolate tart dragée.
                                    </p>
                                    <p class="card-text">
                                        Cupcake fruitcake macaroon donut pastry gummies tiramisu chocolate bar
                                        muffin.
                                    </p>
                                    <small class="text-muted">Last updated 3 mins ago</small>
                                </div>
                                <img class="card-img-bottom img-fluid" src="../../../app-assets/images/slider/06.jpg" alt="Card image cap">
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Basic Card types section end -->

                <!-- Card Captions and Overlay section start -->
                <section id="card-caps">
                    <div class="row">
                        <div class="col-xl-3 col-md-6 col-sm-12">
                            <div class="card">
                                <img class="card-img img-fluid" src="../../../app-assets/images/slider/08.jpg" alt="Card image">
                                <div class="card-img-overlay overlay-success d-flex justify-content-between flex-column">
                                    <div class="overlay-content">
                                        <p class="card-text text-ellipsis">
                                            Sugar plum tiramisu sweet. Cake jelly marshmallow cotton candy chupa
                                            chups.
                                        </p>
                                    </div>
                                    <div class="overlay-status">
                                        <p class="mb-25"><small>Last updated 3 mins ago</small></p>
                                        <a href="javascript:void(0);" class="btn btn-success">Check More </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-sm-12">
                            <div class="card">
                                <img class="card-img img-fluid" src="../../../app-assets/images/slider/07.jpg" alt="Card image">
                                <div class="card-img-overlay overlay-dark bg-overlay d-flex justify-content-between flex-column">
                                    <div class="overlay-content">
                                        <h4 class="card-title mb-50">Online Messages</h4>
                                        <p class="card-text text-ellipsis">
                                            Sugar plum tiramisu sweet. Cake jelly marshmallow cotton candy chupa
                                            chups.
                                        </p>
                                    </div>
                                    <div class="overlay-status">
                                        <p class="mb-25"><small>Last updated 3 mins ago</small></p>
                                        <a href="javascript:void(0);" class="white">Check More </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-sm-12">
                            <div class="card">
                                <img class="card-img img-fluid" src="../../../app-assets/images/slider/08.jpg" alt="Card image">
                                <div class="card-img-overlay overlay-dark d-flex justify-content-between flex-column">
                                    <div class="overlay-content">
                                        <p class="card-text text-ellipsis">
                                            Sugar plum tiramisu sweet. Cake jelly marshmallow cotton candy chupa
                                            chups.
                                        </p>
                                    </div>
                                    <div class="overlay-status">
                                        <p class="mb-25"><small>Last updated 3 mins ago</small></p>
                                        <a href="javascript:void(0);" class="btn btn-outline-info">Check More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-sm-12">
                            <div class="card">
                                <img class="card-img img-fluid" src="../../../app-assets/images/slider/07.jpg" alt="Card image">
                                <div class="card-img-overlay overlay-warning d-flex justify-content-between flex-column">
                                    <div class="overlay-content">
                                        <h4 class="card-title mb-50">Image Overlay</h4>
                                        <p class="card-text text-ellipsis">
                                            Sugar plum tiramisu sweet. Cake jelly marshmallow cotton candy chupa
                                            chups.
                                        </p>
                                    </div>
                                    <div class="overlay-status">
                                        <p class="mb-25"><small>Last updated 3 mins ago</small></p>
                                        <a href="javascript:void(0);" class="white">Check More </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Card Captions and Overlay section end -->
                <!-- Navigation -->
                <section id="card-navigation">
                    <h5 class="mt-3 mb-2">Navigation</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card text-center">
                                <div class="card-body">
                                    <ul class="nav nav-pills card-header-pills ml-0" id="pills-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Home</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link disabled" href="javascript:void(0);" tabindex="-1" aria-disabled="true">Disabled</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                            <h4 class="card-title">Special title treatment</h4>
                                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                            <a href="javascript:void(0);" class="btn btn-outline-primary">Go home</a>
                                        </div>
                                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                            <h4 class="card-title">Special title treatment</h4>
                                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                            <a href="javascript:void(0);" class="btn btn-outline-primary">Go profile</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card text-center mb-3">
                                <div class="card-body">
                                    <ul class="nav nav-tabs" id="nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link disabled" href="javascript:void(0);" tabindex="-1" aria-disabled="true">Disabled</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <h4 class="card-title">Special title treatment</h4>
                                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                            <a href="javascript:void(0);" class="btn btn-outline-primary">Go home</a>
                                        </div>
                                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                            <h4 class="card-title">Special title treatment</h4>
                                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                            <a href="javascript:void(0);" class="btn btn-outline-primary">Go profile</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ Navigation -->

                <!-- Background variants section start -->
                <section id="bg-variants">
                    <div class="row">
                        <div class="col-12 mt-3 mb-1">
                            <h4 class="text-uppercase">Background variants</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4 col-sm-6 col-12">
                            <div class="card">
                                <div class="row no-gutters">
                                    <div class="col-md-12 col-lg-4">
                                        <img src="../../../app-assets/images/banner/banner-35.jpg" alt="element 01" class="h-100 w-100 rounded-left">
                                    </div>
                                    <div class="col-md-12 col-lg-8">
                                        <div class="card-body">
                                            <p class="card-text text-ellipsis">
                                                Tiramisu dessert gingerbread topping tiramisu tart bonbon. Powder
                                                cotton candy sweet roll sugar plum donut jelly-o donut chocolate.
                                            </p>
                                            <span><i class="bx bx-heart font-size-large align-middle mr-50"></i> 1 ARTICLE</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 col-12">
                            <div class="card bg-primary bg-lighten-1">
                                <div class="row no-gutters">
                                    <div class="col-lg-4 col-md-12 d-flex align-items-center justify-content-center p-1">
                                        <img src="../../../app-assets/images/elements/apple-lap.png" class="card-img img-fluid" alt="apple-lap.png">
                                    </div>
                                    <div class="col-lg-8 col-md-12">
                                        <div class="card-body text-center">
                                            <h4 class="card-title white">New Arrival</h4>
                                            <p class="card-text white">Mac Book.</p>
                                            <button class="btn btn-secondary">Buy Now</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 col-12">
                            <div class="card">
                                <div class="row no-gutters">
                                    <div class="col-lg-8 col-12">
                                        <div class="card-body">
                                            <p class="card-text text-ellipsis">
                                                Tiramisu dessert gingerbread topping tiramisu tart bonbon. Powder
                                                cotton candy sweet roll sugar plum donut.
                                            </p>
                                            <button class="btn btn-info">View More</button>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <img src="../../../app-assets/images/banner/banner-30.jpg" alt="element 01" class="h-100 w-100 rounded-right">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 col-12">
                            <div class="card text-center bg-secondary bg-lighten-1">
                                <div class="card-body text-white">
                                    <img src="../../../app-assets/images/elements/amazon-speaker.png" alt="element 05" class="mb-1 w-100" height="200">
                                    <h4 class="card-title white">Amazon Echo</h4>
                                    <p class="card-text">945 items</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 col-12">
                            <div class="card text-center">
                                <div class="card-body">
                                    <img src="../../../app-assets/images/elements/beats-headphones.png" alt="element 02" class="mb-1">
                                    <h4 class="card-title">Beats Headphone</h4>
                                    <p class="card-text">456 items</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 col-12">
                            <div class="card text-center bg-danger bg-lighten-2">
                                <div class="card-body">
                                    <img src="../../../app-assets/images/elements/ipad-pro.png" alt="element 06" height="150" class="mb-1">
                                    <h4 class="card-title white">New Arrival</h4>
                                    <p class="card-text white">Donut toffee candy brownie.</p>
                                    <button class="btn btn-danger white">Buy Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Background variants section end -->

                <!-- Groups section start -->
                <section id="groups">
                    <div class="row match-height">
                        <div class="col-12 mt-3 mb-1">
                            <h4 class="text-uppercase">Groups</h4>
                        </div>
                    </div>
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card-group">
                                <div class="card">
                                    <img class="card-img-top img-fluid" src="../../../app-assets/images/pages/content-img-3.jpg" alt="Card image cap">
                                    <div class="card-header">
                                        <h4 class="card-title">Card title</h4>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">
                                            This card has supporting text below as a natural lead-in to additional
                                            content.</p>
                                        <small class="text-muted">Last updated 3 mins ago</small>
                                    </div>
                                </div>
                                <div class="card">
                                    <img class="card-img-top img-fluid" src="../../../app-assets/images/pages/content-img-2.jpg" alt="Card image cap" />
                                    <div class="card-header">
                                        <h4 class="card-title">Card title</h4>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">
                                            This card has supporting text below as a natural lead-in to additional
                                            content.
                                        </p>
                                        <small class="text-muted">Last updated 3 mins ago</small>
                                    </div>
                                </div>
                                <div class="card">
                                    <img class="card-img-top img-fluid" src="../../../app-assets/images/pages/content-img-4.jpg" alt="Card image cap">
                                    <div class="card-header">
                                        <h4 class="card-title">Card title</h4>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">
                                            This card has supporting text below as a natural lead-in to additional
                                            content.
                                        </p>
                                        <small class="text-muted">Last updated 3 mins ago</small>
                                    </div>
                                </div>
                                <div class="card">
                                    <img class="card-img-top img-fluid" src="../../../app-assets/images/pages/content-img-1.jpg" alt="Card image cap">
                                    <div class="card-header">
                                        <h4 class="card-title">Card title</h4>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">
                                            This card has supporting text below as a natural lead-in to additional
                                            content.
                                        </p>
                                        <small class="text-muted">Last updated 3 mins ago</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Groups section end -->

                <!-- Decks section start -->
                <section id="decks">
                    <div class="row match-height">
                        <div class="col-12 mt-3 mb-1">
                            <h4 class="text-uppercase">Decks</h4>
                        </div>
                    </div>
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card-deck-wrapper">
                                <div class="card-deck">
                                    <div class="row no-gutters">
                                        <div class="col-md-3 col-sm-6 mb-sm-1">
                                            <div class="card">
                                                <img class="card-img-top img-fluid" src="../../../app-assets/images/slider/01.jpg" alt="Card image cap" />
                                                <div class="card-header">
                                                    <h4 class="card-title">Card title</h4>
                                                </div>
                                                <div class="card-body">
                                                    <p class="card-text">
                                                        This card has supporting text below as a natural lead-in to
                                                        additional content.
                                                    </p>
                                                    <small class="text-muted">Last updated 3 mins ago</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 mb-sm-1">
                                            <div class="card">
                                                <img class="card-img-top img-fluid" src="../../../app-assets/images/slider/04.jpg" alt="Card image cap" />
                                                <div class="card-header">
                                                    <h4 class="card-title">Card title</h4>
                                                </div>
                                                <div class="card-body">
                                                    <p class="card-text">
                                                        This card has supporting text below as a natural lead-in to
                                                        additional content.
                                                    </p>
                                                    <small class="text-muted">Last updated 3 mins ago</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <div class="card">
                                                <img class="card-img-top img-fluid" src="../../../app-assets/images/slider/05.jpg" alt="Card image cap" />
                                                <div class="card-header">
                                                    <h4 class="card-title">Card title</h4>
                                                </div>
                                                <div class="card-body">
                                                    <p class="card-text">
                                                        This card has supporting text below as a natural lead-in to
                                                        additional content.</p>
                                                    <small class="text-muted">Last updated 3 mins ago</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <div class="card">
                                                <img class="card-img-top img-fluid" src="../../../app-assets/images/slider/06.jpg" alt="Card image cap" />
                                                <div class="card-header">
                                                    <h4 class="card-title">Card title</h4>
                                                </div>
                                                <div class="card-body">
                                                    <p class="card-text">
                                                        This card has supporting text below as a natural lead-in to
                                                        additional content.</p>
                                                    <small class="text-muted">Last updated 3 mins ago</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Decks section end -->

                <!-- Columns section start -->
                <section id="columns">
                    <div class="row">
                        <div class="col-12 mt-3 mb-1">
                            <h4 class="text-uppercase">Columns</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-1">
                            <div class="card-columns">
                                <div class="card">
                                    <img class="card-img-top img-fluid" src="../../../app-assets/images/slider/09.png" alt="Card image cap">
                                    <div class="card-header">
                                        <h4 class="card-title">Card title</h4>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">
                                            Some quick example text to build on the card title and make up the bulk
                                            of the card's content.
                                        </p>
                                        <a href="javascript:void(0);" class="btn btn-outline-primary">Go somewhere</a>
                                    </div>
                                </div>
                                <div class="card bg-primary text-center">
                                    <div class="card-body">
                                        <img src="../../../app-assets/images/elements/iphone-x.png" alt="element 05" width="150" class="mb-1 img-fluid">
                                        <h4 class="card-title text-white">iPhone 11</h4>
                                        <p class="card-text text-white">945 items</p>
                                    </div>
                                </div>
                                <div class="card position-static text-white bg-danger bg-lighten-1 text-center">
                                    <div class="card-body">
                                        <img src="../../../app-assets/images/elements/ipad-pro.png" alt="element 02" width="120" class="mb-1 img-fluid">
                                        <h4 class="card-title text-white">iPad Mini</h4>
                                        <p class="card-text">456 items</p>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Bottom Image Cap</h4>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">
                                            Jelly-o sesame snaps cheesecake topping. Cupcake fruitcake macaroon
                                            donut pastry gummies tiramisu chocolate bar muffin. Dessert bonbon caramels brownie
                                            chocolate bar chocolate tart dragée.
                                        </p>
                                        <p class="card-text">
                                            Cupcake fruitcake macaroon donut pastry gummies tiramisu chocolate bar
                                            muffin.
                                        </p>
                                        <small class="text-muted">Last updated 3 mins ago</small>
                                    </div>
                                    <img class="card-img-bottom img-fluid" src="../../../app-assets/images/slider/04.jpg" alt="Card image cap">
                                </div>
                                <div class="card text-white">
                                    <img class="card-img img-fluid position-sticky" src="../../../app-assets/images/slider/03.jpg" alt="Card image">
                                    <div class="card-img-overlay overlay-warning">
                                        <h4 class="card-title white mb-50">Overlay Card</h4>
                                        <p class="card-text text-ellipsis">
                                            Sugar plum tiramisu sweet. Cake jelly marshmallow cotton candy chupa
                                            chups carrot cake topping chupa chups.
                                        </p>
                                        <small>Last updated 3 mins ago</small>
                                    </div>
                                </div>
                                <div class="card border-info text-center bg-transparent">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 mb-50 d-flex justify-content-center">
                                                <img src="../../../app-assets/images/elements/macbook-pro.png" alt="element 04" width="150" class="float-left mt-1 img-fluid">
                                            </div>
                                            <div class="col-md-6 col-sm-12 d-flex justify-content-center flex-column">
                                                <h4>
                                                    <span class="badge badge-light-info">New Arrival</span>
                                                </h4>
                                                <p class="card-text">Mac Book.</p>
                                            </div>
                                        </div>
                                        <button class="btn btn-info mt-50">Buy Now</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Columns section end -->

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <!-- demo chat-->
    <div class="widget-chat-demo">
        <!-- widget chat demo footer button start -->
        <button class="btn btn-primary chat-demo-button glow px-1"><i class="livicon-evo" data-options="name: comments.svg; style: lines; size: 24px; strokeColor: #fff; autoPlay: true; repeat: loop;"></i></button>
        <!-- widget chat demo footer button ends -->
        <!-- widget chat demo start -->
        <div class="widget-chat widget-chat-demo d-none">
            <div class="card mb-0">
                <div class="card-header border-bottom p-0">
                    <div class="media m-75">
                        <a href="JavaScript:void(0);">
                            <div class="avatar mr-75">
                                <img src="../../../app-assets/images/portrait/small/avatar-s-2.jpg" alt="avtar images" width="32" height="32">
                                <span class="avatar-status-online"></span>
                            </div>
                        </a>
                        <div class="media-body">
                            <h6 class="media-heading mb-0 pt-25"><a href="javaScript:void(0);">Kiara Cruiser</a></h6>
                            <span class="text-muted font-small-3">Active</span>
                        </div>
                    </div>
                    <div class="heading-elements">
                        <i class="bx bx-x widget-chat-close float-right my-auto cursor-pointer"></i>
                    </div>
                </div>
                <div class="card-body widget-chat-container widget-chat-demo-scroll">
                    <div class="chat-content">
                        <div class="badge badge-pill badge-light-secondary my-1">today</div>
                        <div class="chat">
                            <div class="chat-body">
                                <div class="chat-message">
                                    <p>How can we help? 😄</p>
                                    <span class="chat-time">7:45 AM</span>
                                </div>
                            </div>
                        </div>
                        <div class="chat chat-left">
                            <div class="chat-body">
                                <div class="chat-message">
                                    <p>Hey John, I am looking for the best admin template.</p>
                                    <p>Could you please help me to find it out? 🤔</p>
                                    <span class="chat-time">7:50 AM</span>
                                </div>
                            </div>
                        </div>
                        <div class="chat">
                            <div class="chat-body">
                                <div class="chat-message">
                                    <p>Stack admin is the responsive bootstrap 4 admin template.</p>
                                    <span class="chat-time">8:01 AM</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer border-top p-1">
                    <form class="d-flex" onsubmit="widgetChatMessageDemo();" action="javascript:void(0);">
                        <input type="text" class="form-control chat-message-demo mr-75" placeholder="Type here...">
                        <button type="submit" class="btn btn-primary glow px-1"><i class="bx bx-paper-plane"></i></button>
                    </form>
                </div>
            </div>
        </div>
        <!-- widget chat demo ends -->

    </div>
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-dark">
        <p class="clearfix mb-0"><span class="float-left d-inline-block">2021 &copy; PIXINVENT</span><span class="float-right d-sm-inline-block d-none">Crafted with<i class="bx bxs-heart pink mx-50 font-small-3"></i>by<a class="text-uppercase" href="https://1.envato.market/pixinvent_portfolio" target="_blank">Pixinvent</a></span>
            <button class="btn btn-primary btn-icon scroll-top" type="button"><i class="bx bx-up-arrow-alt"></i></button>
        </p>
    </footer>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="../../../app-assets/vendors/js/vendors.min.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../../../app-assets/vendors/js/ui/jquery.sticky.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/horizontal-menu.js"></script>
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>