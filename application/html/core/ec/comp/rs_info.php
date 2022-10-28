<h4 class="mb-0 text-white">ข้อมูลโครงการวิจัย</h4>
<div class="card">
    <div class="card-body pt-2">
        <div class="row">
            <div class="col-12 col-sm-3">
                รหัสโครงการ : 
            </div>
            <div class="col-12 col-sm-3"><span class="badge badge-danger round">REC.<?php echo $resResearch['code_apdu']; ?></span></div>
            <div class="col-12 col-sm-3">
                    รหัสลงทะเบียน : 
                </div>
                <div class="col-12 col-sm-3 text-white"><span class="badge badge-secondary round"><?php echo $resResearch['id_rs']; ?></span></div>
        </div>
        <div class="row mt-1">
            <div class="col-12 col-sm-3">
                ชื่อโครงการวิจัย : 
            </div>
            <div class="col-12 col-sm-9">
                <?php
                if($resResearch['title_th'] != '-'){
                    ?>
                    <a href="#" class="text-white"><?php echo "<h5 class='text-white mb-0'>".$resResearch['title_th']. "</h5><small>(".$resResearch['title_en'].")</small>"; ?></a>
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
            <div class="col-12 col-sm-3 text-white">
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
                <span class="text-white">
                    <?php 
                    $strSQL = "SELECT * FROM useraccount a INNER JOIN userinfo b ON a.id = b.user_id 
                            INNER JOIN dept c ON b.id_dept = c.id_dept
                            WHERE a.id_pm = '".$resResearch['id_pm']."'";
                    $resPi = $db->fetch($strSQL, false, false);
                    if($resPi){
                        echo $resPi['fname']." ".$resPi['lname'];
                        ?>
                        <a href="" class="text-success float-right"><i class="bx bx-pencil"></i></a>
                        <div>
                            สังกัด : <?php 
                            if($resPi['id_dept'] == '19'){
                                echo $resPi['dept'];
                            }else{
                                echo $resPi['dept_name'];
                            }
                            ?>
                        </div>
                        <div>
                            โทรศัพท์ : <?php echo $resPi['tel_mobile']; ?>
                        </div>
                        <div>
                            E-mail address : <?php echo $resPi['email']; ?>
                        </div>
                        <?php
                    }else{
                        echo "NA";
                    }
                    ?>
                    </span>
                
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-12 col-sm-3">
                คำสำคัญ : 
            </div>
            <div class="col-12 col-sm-9 text-white">
                <?php 
                echo $resResearch['keywords_th']." (".$resResearch['keywords_en'].")";
                ?>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-12 col-sm-3">
                ประเภทโครงการวิจัย : 
            </div>
            <div class="col-12 col-sm-9 text-white">
                <?php 
                echo $resResearch['type_name'];
                ?>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-12 col-sm-3">
                ระยะเวลาดำเนินโครงการ : 
            </div>
            <div class="col-12 col-sm-9 text-white">
                <?php 
                echo date('d M Y', strtotime($resResearch['start_date']))." - ".date('d M Y', strtotime($resResearch['finish_date']));
                ?>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-12 col-sm-3">
                งบประมาณ : 
            </div>
            <div class="col-12 col-sm-9 text-white">
                <?php 
                echo number_format($resResearch['budget'])." บาท";
                ?>
            </div>
        </div>
        
        <div class="row mt-1">
            <div class="col-12 col-sm-3">
                แหล่งทุน : 
            </div>
            <div class="col-12 col-sm-9">
                <?php
                if($resResearch['source_funds'] != '-') echo "-"; else echo $resResearch['source_funds'];
                ?>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-12 col-sm-3">
                วันที่ได้รับการรับรองครั้งแรก : 
            </div>
            <div class="col-12 col-sm-3 text-white">
            <?php 
                $strSQL = "SELECT rai_sign_date FROM research_acknowledge_info WHERE rai_id_rs = '$id_rs' AND rai_sign_status = '1' ORDER BY rai_id DESC LIMIT 1";
                if($resType['rct_type'] != 'Exempt'){
                    $strSQL = "SELECT rai_sign_date FROM research_expedited_info WHERE rai_id_rs = '$id_rs' AND rai_sign_status = '1' ORDER BY rai_id DESC LIMIT 1";
                }
                $resType = $db->fetch($strSQL, false, false);
                if($resType){
                    echo date('d M Y', strtotime($resType['rai_sign_date']));
                }
                ?>
                <div>
                <?php 
                $strSQL = "SELECT * FROM research_assign_fullboard_agendar WHERE rafa_id_rs = '$id_rs' AND rafa_status = '1' ORDER BY rafa_id DESC LIMIT 1";
                $resResearchRafa = $db->fetch($strSQL, false, false);
                echo "การประชุมครั้งที่ ".$resResearchRafa['rafa_agn']." | Panal ".$resResearchRafa['rafa_panal'];
                ?>
                </div>
            </div>
        </div>

        <div class="row mt-1">
            <div class="col-12 col-sm-3">
                ผู้ร่วมวิจัย : 
            </div>
            <div class="col-12 col-sm-9">
                <?php
                if($resResearch['source_funds'] != '-') echo "-"; else echo $resResearch['source_funds'];
                ?>
                <a href="" class="text-success float-right"><i class="bx bx-plus"></i></a>
            </div>
        </div>

        <div class="row mt-1">
            <div class="col-12 col-sm-3">
                โครงการ Sponser : 
            </div>
            <div class="col-12 col-sm-9">
                <?php
                if($resResearch['source_funds'] != '-') echo "-"; else echo $resResearch['source_funds'];
                ?>
                <a href="" class="text-success float-right"><i class="bx bx-pencil"></i></a>
            </div>
        </div>

        <div class="row mt-1">
            <div class="col-12 col-sm-3">
                โครงการแพทยศาสตร์ศึกษา : 
            </div>
            <div class="col-12 col-sm-9">
                <?php
                if($resResearch['source_funds'] != '-') echo "-"; else echo $resResearch['source_funds'];
                ?>
                <a href="" class="text-success float-right"><i class="bx bx-pencil"></i></a>
            </div>
        </div>

    </div>
</div>