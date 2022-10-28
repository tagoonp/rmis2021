<?php 
$c_progress = 0;
$c_amend = 0;
$c_deviation = 0;
$c_lsae = 0;
$c_esae = 0;
$c_closing = 0;
$c_terminate = 0;

$strSQL = "SELECT COUNT(rp_id) cn 
            FROM rec_progress WHERE 
            rp_id_rs = '$id_rs' 
            AND rp_sending_status = '1' 
            AND rp_confirm_1 = '0' 
            AND rp_delete_status = '0' AND rp_progress_id = 'closing'";
$res6 = $db->fetch($strSQL, false);
if(($res6) && ($res6['cn'] > 0)){ $c_closing = $res6['cn']; }

$strSQL = "SELECT COUNT(rp_id) cn FROM rec_progress WHERE rp_id_rs = '$id_rs' AND rp_sending_status = '1' AND rp_confirm_1 = '0'AND rp_delete_status = '0' AND rp_progress_id = 'terminate'";
$res7 = $db->fetch($strSQL, false);
if(($res7) && ($res7['cn'] > 0)){ $c_terminate = $res7['cn']; }
?>
<h4 class="mb-0 text-white">รายงานโครงการวิจัย</h4>
<div class="card text-center">
    <div class="card-body">
        <ul class="nav nav-pills card-header-pills ml-0" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-closing" aria-selected="false">Progress<?php if($c_progress != 0){ echo ' <span class="badge badge-pill- badge-danger pl-1 pr-1 round" style="padding-left: 10px !important; padding-right: 12px !important;" >'.$c_progress.'</span>';} ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-closing-tab" data-toggle="pill" href="#pills-closing" role="tab" aria-controls="pills-closing" aria-selected="false">Closing<?php if($c_closing != 0){ echo ' <span class="badge badge-pill- badge-danger pl-1 pr-1 round" style="padding-left: 10px !important; padding-right: 12px !important;" >'.$c_closing.'</span>';} ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-terminate-tab" data-toggle="pill" href="#pills-terminate" role="tab" aria-controls="pills-terminate" aria-selected="false">Termination<?php if($c_terminate != 0){ echo ' <span class="badge badge-pill- badge-danger pl-1 pr-1 round" style="padding-left: 10px !important; padding-right: 12px !important;" >'.$c_terminate.'</span>';} ?></a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">

            <div class="tab-pane fade show active pt-3 pb-3" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
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

            <div class="tab-pane fade pb-3" id="pills-closing" role="tabpanel" aria-labelledby="pills-closing-tab">
            <?php 
                if($c_closing == 0){
                    ?>
                    <h4 class="card-title mt-3">ไม่มีแบบรายงานรอตรวจสอบ</h4>
                    <?php
                }else{
                    ?>
                    <table class="table table-striped mt-3">
                        <thead>
                            <tr>
                                <th style="width: 160px;"></th>
                                <th style="width: 120px;">รหัสรายงาน</th>
                                <th style="width: 150px;">วัน-เวลาที่ส่ง</th>
                                <th style="width: 100px;">สถานะปัจจุบัน</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $strSQL = "SELECT * FROM rec_progress a INNER JOIN research b ON a.rp_id_rs = b.id_rs
                                        INNER JOIN type_status_research c ON a.rp_progress_status = c.id_status_research
                                        WHERE 
                                        a.rp_id_rs = '$id_rs' AND a.rp_sending_status = '1' AND a.rp_confirm_1 = '0' AND a.rp_delete_status = '0' AND a.rp_progress_id = 'closing'";
                            $res = $db->fetch($strSQL, true, false);
                            if(($res) && ($res['status'])){
                                foreach ($res['data'] as $row) {
                                    ?>
                                    <tr>
                                        <td style="vertical-align: top;" class="text-left">
                                            <button class="btn btn-icon text-success m-0" style="width: 38px; height: 36px; padding-bottom: 13px;" onclick="openForm('closing', '<?php echo $row['rp_id_rs'];?>', '<?php echo $row['rp_session'];?>')"><i class="bx bx-search"></i></button>
                                        </td>
                                        <td style="vertical-align: top;"><?php echo $row['rp_progress_id']."-".$row['rp_session']; ?></td>
                                        <td style="vertical-align: top;"><?php echo $row['rp_sending_datetime']; ?></td>
                                        <td style="vertical-align: top;"><span class="badge round badge-danger"><?php echo $row['status_name']; ?></span></td>
                                        
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php
                }
                ?>
            </div>

            <div class="tab-pane fade pt-3 pb-3" id="pills-terminate" role="tabpanel" aria-labelledby="pills-terminate-tab">
            <?php 
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
                                        a.rp_id_rs = '$id_rs' AND a.rp_sending_status = '1' AND a.rp_confirm_1 = '0' AND a.rp_delete_status = '0' AND a.rp_progress_id = 'terminate'";
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