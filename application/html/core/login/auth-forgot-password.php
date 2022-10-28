<?php 
require('../../../configuration/server.inc.php');
require('../../../configuration/configuration.php');
require('../../../configuration/database.php'); 
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
    <meta name="description" content="RMIS :: Research Management Information System">
    <meta name="keywords" content="RMIS, HREC, PSU">
    <meta name="author" content="RMIS :: Research Management Information System">
    <title>RMIS:ระบบสารสนเทศเพื่อการจัดการงานวิจัย คณะแพทยศาสตร์ มอ.</title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai:wght@100;300;400&display=swap" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/components.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/authentication.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/extensions/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/preload.js/dist/css/preload.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <!-- <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">    -->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css?v=<?php echo filemtime('../../../assets/css/style.css'); ?>">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern dark-layout 1-column  navbar-sticky footer-static bg-full-screen-image  blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column" data-layout="dark-layout">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- login page start -->
                <section id="auth-login" class="row flexbox-container">
                    <div class="col-xl-4 col-11">
                        <div class="card bg-authentication mb-0">
                            <div class="row m-0">
                                <!-- left section-login -->
                                <div class="col-md-12 col-12 px-0">
                                    <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center">
                                        <div class="card-header pb-1">
                                            <div class="card-title">
                                                <img src="http://localhost/rmis2021/application/img/logo-20190225.png" alt="" style="width: 80%">
                                            </div>
                                        </div>
                                        <div class="card-body pt-2">
                                            <h4 class="text-dark">ลืมรหัสผ่าน</h4>
                                            <form onsubmit="return false;" id="resetPasswordForm" autocomplete="off">
                                                <div class="form-group mb-50">
                                                    <!-- <label class="text-bold-600" for="exampleInputEmail1">Email address</label> -->
                                                    <label class="control-label f500" for="val-username">กรอก E-mail address ที่ท่านใช้สมัครเพื่อรับลิงค์สำหรับการ reset password <span class="text-danger">**</span></label>
                                                    <input type="text" class="form-control" id="txtUsername" placeholder="กรอก E-mail address" autofocus>
                                                </div>
                    
                                                <div class="text-right pb-1">
                                                    <div class="text-right"></div>
                                                </div>
                                                <button type="submit" class="btn btn-success glow w-100 position-relative">ส่ง Reset password link<i id="icon-arrow" class="bx bx-right-arrow-alt"></i></button>
                                            </form>
                                            <div class="row">
                                                <div class="col-12 pt-2">
                                                    <div class="form-group d-flex flex-md-row flex-column justify-content-between align-items-center">
                                                        <div class="text-center">
                                                            กลับไปยังหน้า <a href="./"> - เข้าสู่ระบบ -</a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <hr>
                                                    <div class="text-danger">** หากพบปัญหาการใช้งาน ติดต่อ คุณณัฎฐา (กิ๊ก) หน่วยส่งเสริมและพัฒนาทางวิชาการ ( 1149, 1157)</div>
                                                    <div class="pt-2 text-muted" style="font-size: 0.9em;">
                                                        RMIS :: Research Management Information System<br>
                                                        Copyright © 2013 หน่วยส่งเสริมและพัฒนาทางวิชาการ<br>
                                                        คณะแพทยศาสตร์ มหาวิทยาลัยสงขลานครินทร์
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- right section image -->
                                
                            </div>
                        </div>
                    </div>
                </section>
                <!-- login page ends -->

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <!-- sample modal content -->
    <div id="NewsModal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <!-- <div class="modal-header" style="background: rgb(255, 0, 61);">
                <h5 class="modal-title text-white" id="exampleModalLabel" style="font-weight: 400;">ประกาศ</h5>
            </div> -->
            <div class="modal-body pb-2">
                <p>
                <div class="text-center pb-20">
                    <i class="fas fa-exclamation-triangle text-danger fa-5x"></i>
                </div>
                <h4 class="text-center text-danger">ขอความร่วมมือ</h4>
                <p class="text-center">
                    โครงการวิจัยที่เป็น Multicenter Sponsor Trial ขอให้ยื่นโครงการเพื่อขอรับรองที่ CREC กรณีมีข้อสงสัยให้โทรสอบถามเจ้าหน้าที่สำนักงานหน่วยส่งเสริมและพัฒนาทางวิชาการ (1149, 1157)
                </p>
                <div class="text-right pt-10">
                    <button class="btn btn-secondary btn-block" data-dismiss="modal">ปิด</button>
                </div>
                </p>
            </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


    <!-- BEGIN: Vendor JS-->
    <script src="../../../app-assets/vendors/js/vendors.min.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <script src="../../../app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
    <script src="../../../app-assets/vendors/preload.js/dist/js/preload.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../assets/js/core.js?v=<?php echo filemtime('../../../assets/js/core.js'); ?>"></script>
    <script src="../../../assets/js/authen.js?v=<?php echo filemtime('../../../assets/js/authen.js'); ?>"></script>

    <script>
        preload.hide()

        function showModal(id){
            $("#" + id).modal();
        }
    </script>
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>
