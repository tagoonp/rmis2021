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
                    <div class="col-xl-8 col-11">
                        <div class="card bg-authentication mb-0">
                            <div class="row m-0">
                                <!-- left section-login -->
                                <div class="col-md-6 col-12 px-0">
                                    <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center">
                                        <div class="card-header pb-1">
                                            <div class="card-title">
                                                <img src="http://localhost/rmis2021/application/img/logo-20190225.png" alt="" style="width: 80%">
                                            </div>
                                        </div>
                                        <div class="card-body pt-2">
                                            <h4 class="text-dark">เข้าสู่ระบบ</h4>
                                            <form onsubmit="return false;" id="loginForm">
                                                <div class="form-group mb-50">
                                                    <!-- <label class="text-bold-600" for="exampleInputEmail1">Email address</label> -->
                                                    <label class="control-label f500" for="val-username">บัญชีผู้ใช้งาน <span class="text-danger">**</span></label>
                                                    <input type="text" class="form-control" id="txtUsername" placeholder="กรอก E-mail address" autofocus></div>
                                                <div class="form-group">
                                                    <!-- <label class="text-bold-600" for="exampleInputPassword1">Password</label> -->
                                                    <input type="password" class="form-control" id="txtPassword" placeholder="กรอกรหัสผ่าน">

                                                    
                                                </div>
                                                <div class="form-group">
                                                        <label class="control-label f500" for="val-username">สิทธิ์การเข้าใช้งาน <span class="text-danger">**</span></label>
                                                        <select class="form-control" name="txtRole" id="txtRole">
                                                            <option value="pm">นักวิจัยหลัก (หัวหน้าโครงการ)</option>
                                                            <option value="staff">เจ้าหน้าที่</option>
                                                            <option value="ec">เลขา EC</option>
                                                            <option value="reviewer">ผู้เชี่ยวชาญอิสระ</option>
                                                            <option value="chairman">ประธาน EC</option>
                                                            <option value="administrator">ผู้ดูแลระบบ</option>
                                                        </select>
                                                    </div>
                                                <div class="text-right pb-1">
                                                    <div class="text-right"></div>
                                                </div>
                                                <button type="submit" class="btn btn-success glow w-100 position-relative">เข้าสู่ระบบ<i id="icon-arrow" class="bx bx-right-arrow-alt"></i></button>
                                            </form>
                                            <div class="row">
                                                <div class="col-12 pt-2">
                                                    <div class="form-group d-flex flex-md-row flex-column justify-content-between align-items-center">
                                                        <div class="text-left">
                                                        บุคคลภายนอกคณะแพทย์ ฯ<a href="auth-register.html"> - สมัครที่นี่ -</a>
                                                        </div>
                                                        <div class="text-right">
                                                            <a href="auth-forgot-password" class="card-link">ลืมรหัสผ่าน ?</a>
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
                                <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
                                    <div >
                                        <h5 class="f500 text-dark" style="border: dashed; border-width: 0px 0px 0px 0px; border-color: rgb(232, 232, 232); font-weight: 300;"><i class="fa fa-rss"></i> ข่าวประกาศ</h5>
                                        <div class="p-2 mt-1 fs08 text-left" style="background: #fff; border-radius: 0px; border: solid; border-width: 0px 0px 0px 3px; border-color: rgb(255, 0, 38); cursor: pointer;" onclick="showModal('NewsModal2')" id="">
                                            ขอความร่วมมือสำหรับโครงการ Multicenter sponsor trial <small class="text-danger">[Click เพื่ออ่าน]</small>
                                        </div>

                                    </div>

                                    <div class="mt-1">
                                        <div class="pl-2 pr-2 mt-10 pt-1 pb-1 fs08 text-dark" style="background: #fff; border-radius: 0px; border: solid; border-width: 0px 0px 0px 3px; border-color: rgb(2, 167, 88);">
                                            <h6 class="mb-15 text-danger" style=" font-weight: 300;"><span class="f500">** เฉพาะบุคลากรคณะแพทย์ **</span> (การเข้าระบบครั้งแรก)</h6>
                                            <p class="txt-dark text-left" style="color: #000;">
                                            <ol style="padding-left: 30px; padding-bottom: 0px;"  class="text-dark text-left">
                                                <li>Username = รหัสบุคลากร </li>
                                                <li>Password = วันเกิด ใช้ปี คศ. (dd/mm/yyyy) เช่น 07/08/1982 </li>
                                            </ol>
                                            <div class="f500 text-dark pt-0 mb-0 text-left">
                                                ระบบจะเข้าสู่หน้าข้อมูลส่วนตัว ให้ท่านทำการตรวจสอบข้อมูลและแก้ไขให้ถูกต้อง บันทึกชื่อ e-mail ที่จะใช้เป็น username  และกำหนด password ใหม่ กดปุ่มบันทึก
                                            </div>
                                            <div class="f500 text-danger pt-1 mb-0 text-left">
                                                * การเข้าใช้งานครั้งต่อไป ต้องใช้ e-mail address และ password ดังกล่าวเพื่อเข้าระบบ
                                            </div>
                                            </p>
                                        </div>

                                        <div class="p-2 mt-1 pt-1 fs08" style="background: #fff; border-radius: 0px; border: solid; border-width: 0px 0px 0px 3px; border-color: rgb(2, 167, 88);">
                                            <h6 class="mb-15 text-dark text-left" style=" font-weight: 300;"><span class="f500">สำหรับบุคลากรภายนอกคณะแพทย์</span> ให้ดำเนินการดังนี้เพื่อเริ่มต้นใช้งาน</h6>
                                            <p class="text-dark" style="color: #000;">
                                            <ol style="padding-left: 30px; padding-bottom: 10px;"  class="text-dark text-left">
                                                <li>กดปุ่ม <a href="register">"สมัครใช้งานสำหรับบุคคลภายนอกคณะแพทย์"</a> </li>
                                                <li>กรอกข้อมูลในแบบฟอร์มลงทะเบียนเพื่อใช้งานระบบ (สำหรับบุคคลภายนอกคณะแพทยศาสตร์) ให้ครบถ้วน และกดปุ่ม "ลงทะเบียน"</li>
                                                <li>หากลงทะเบียนสำเร็จ ระบบจะส่งอีเมล์ไปยังอีเมลที่ท่านทำการสมัครเพื่อให้กด Link เพื่อยืนยันตัวตนอีกครั้ง</li>
                                                <li>เมื่อยืนยันตัวตนสำเร็จ ท่านสามารถใช้อีเมล์และรหัสผ่านที่สมัครเข้าสู่ระบบได้</li>
                                            </ol>
                                            </p>
                                        </div>

                                    </div>
                                </div>
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
