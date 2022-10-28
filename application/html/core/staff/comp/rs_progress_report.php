<?php 
$c_progress = 0;
$c_amend = 0;
$c_deviation = 0;
$c_lsae = 0;
$c_esae = 0;
$c_closing = 0;
$c_terminate = 0;

$strSQL = "SELECT COUNT(rp_id) cn FROM rec_progress WHERE rp_id_rs = '$id_rs' AND rp_sending_status = '1' AND rp_confirm_1 = '0' AND rp_delete_status = '0' AND rp_progress_id = 'closing'";
$res6 = $db->fetch($strSQL, false);
if(($res6) && ($res6['cn'] > 0)){ $c_closing = $res6['cn']; }

$strSQL = "SELECT COUNT(rp_id) cn FROM rec_progress WHERE rp_id_rs = '$id_rs' AND rp_sending_status = '1' AND rp_confirm_1 = '0'AND rp_delete_status = '0' AND rp_progress_id = 'terminate'";
$res7 = $db->fetch($strSQL, false);
if(($res7) && ($res7['cn'] > 0)){ $c_terminate = $res7['cn']; }
?>
<h4 class="mb-0 text-dark">รายงานโครงการวิจัย</h4>
<div class="card bg-white">

<div class="card-body pt-2 text-dark">
        <div class="row">
            <div class="col-12 col-sm-3">
                รหัสโครงการ : 
            </div>
            <div class="col-12 col-sm-3"><span class="badge badge-danger round">REC.<?php echo $resResearch['code_apdu']; ?></span></div>
            <div class="col-12 col-sm-3">
                    รหัสลงทะเบียน : 
                </div>
                <div class="col-12 col-sm-3 text-dark"><span class="badge badge-secondary round"><?php echo $resResearch['id_rs']; ?></span></div>
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
                <a href="" class="text-success float-right"><i class="bx bx-pencil"></i></a>
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
        
    </div>

    <div class="card-body p-0">
        <div class="pl-2 pr-2">
        <ul class="nav nav-pills card-header-pills ml-0" id="pills-tab" role="tablist">
            <!-- <li class="nav-item">
                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-closing" aria-selected="false">Progress<?php if($c_progress != 0){ echo ' <span class="badge badge-pill- badge-danger pl-1 pr-1 round" style="padding-left: 10px !important; padding-right: 12px !important;" >'.$c_progress.'</span>';} ?></a>
            </li> -->
            <li class="nav-item">
                <a class="nav-link active" id="pills-closing-tab" data-toggle="pill" href="#pills-closing" role="tab" aria-controls="pills-closing" aria-selected="false">Closing<?php if($c_closing != 0){ echo ' <span class="badge badge-pill- badge-danger pl-1 pr-1 round" style="padding-left: 10px !important; padding-right: 12px !important;" >'.$c_closing.'</span>';} ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-terminate-tab" data-toggle="pill" href="#pills-terminate" role="tab" aria-controls="pills-terminate" aria-selected="false">Termination<?php if($c_terminate != 0){ echo ' <span class="badge badge-pill- badge-danger pl-1 pr-1 round" style="padding-left: 10px !important; padding-right: 12px !important;" >'.$c_terminate.'</span>';} ?></a>
            </li>
        </ul>
        </div>
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

            <div class="tab-pane fade show active pb-3" id="pills-closing" role="tabpanel" aria-labelledby="pills-closing-tab">
            <?php 
                if($c_closing == 0){
                    ?>
                    <h4 class="card-title mt-3">ไม่มีแบบรายงานรอตรวจสอบ</h4>
                    <?php
                }else{
                    ?>
                    <table class="table table-striped mt-0 text-dark">
                        <thead>
                            <tr class="bg-secondary">
                                <th style="width: 30px;" class="text-white"></th>
                                <th style="width: 120px;" class="text-white">รหัสรายงาน</th>
                                <th style="width: 150px;" class="text-white">วัน-เวลาที่ส่ง</th>
                                <th style="width: 100px;" class="text-white">สถานะปัจจุบัน</th>
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
                                            <button class="btn btn-icon btn-success m-0" style="width: 38px; height: 36px; padding-bottom: 13px;" onclick="openForm('closing', '<?php echo $row['rp_id_rs'];?>', '<?php echo $row['rp_session'];?>')"><i class="bx bx-search"></i></button>
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