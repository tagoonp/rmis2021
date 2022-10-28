<?php 
$strSQL = "SELECT * FROM research WHERE id_rs = '$id_rs'";
$resResearch = $db->fetch($strSQL, false, false);
?>
<h5 class="text-white">ข้อมูลโครงการวิจัย</h5>
<hr>
<div class="row">
    <div class="col-12 col-sm-4">หมายเลขโครงการ :</div>
    <div class="col-12 col-sm-7 text-white pb-1"><span class="badge badge-light-success round"><?php echo "REC.".$resResearch['code_apdu'] ?></span></div>

    <div class="col-12 col-sm-4">Protocol No. :</div>
    <div class="col-12 col-sm-7 text-white pb-1"><?php if($resResearch['protocol_no'] == ''){echo "-"; }else{echo $resResearch['protocol_no'];} ?></div>

    <div class="col-12 col-sm-4">ชื่อโครงการ :</div>
    <div class="col-12 col-sm-7 text-white pb-1"><?php echo $resResearch['title_th']." (".$resResearch['title_en'].")"; ?></div>

    <div class="col-12 col-sm-4">หัวหน้าโครงการ :</div>
    <div class="col-12 col-sm-7 text-white pb-1">
        <?php 
        $strSQL = "SELECT * FROM useraccount a INNER JOIN userinfo b ON a.id = b.user_id
                   INNER JOIN dept c ON b.id_dept = c.id_dept
                   WHERE a.id_pm = '".$resResearch['id_pm']."'
                  ";
        $resResearcher = $db->fetch($strSQL, false, false);
        if($resResearcher){
            echo $resResearcher['fname']." ".$resResearcher['lname']."<br>".$resResearcher['fname_en']." ".$resResearcher['lname_en'];
            ?>
            
            <div style="padding-top: 8px;">
                <small>
                    สังกัด : <?php if($resResearcher['id_dept'] == '19'){ echo $resResearcher['dept_name']." (".$resResearcher['dept'].")"; }else{ echo $resResearcher['dept_name']; } ?>
                </small>
            </div>
            <?php
        }else{
            echo "-";
        }
        ?>
    </div>

    <div class="col-12 col-sm-4">Funding source (ถ้ามี) :</div>
    <div class="col-12 col-sm-7 text-white pb-1"><?php if($resResearch['source_funds'] == ''){echo "-"; }else{echo $resResearch['source_funds'];} ?></div>

    

    <div class="col-12 col-sm-4">ประเภทการพิจารณา Initial review :</div>
    <div class="col-12 col-sm-7 text-white pb-1 text-danger">
        <?php 
        $strSQL = "SELECT rct_type FROM research_consider_type WHERE rct_id_rs = '$id_rs' AND rct_status = '1' ORDER BY rct_id DESC LIMIT 1";
        $resResearchtype = $db->fetch($strSQL, false, false);
        echo $resResearchtype['rct_type'];
        ?>
    </div>

    <div class="col-12 col-sm-4">วันที่ได้รับใบรับรองครั้งแรกจาก EC :</div>
    <div class="col-12 col-sm-7 text-white pb-1">
        <?php 
        $strSQL = "SELECT rai_sign_date FROM research_acknowledge_info WHERE rai_id_rs = '$id_rs' AND rai_sign_status = '1' AND rai_review_status = 'signed' ORDER BY rai_id DESC LIMIT 1";
        if($resResearchtype['rct_type'] != 'Exempt'){
            $strSQL = "SELECT rai_sign_date FROM research_expedited_info WHERE rai_id_rs = '$id_rs' AND rai_sign_status = '1' AND rai_review_status = 'signed' ORDER BY rai_id DESC LIMIT 1";
        }
        $resResearchtype = $db->fetch($strSQL, false, false);
        echo date('d M Y', strtotime($resResearchtype['rai_sign_date']));
        ?>
    </div>

    <div class="col-12 col-sm-4">วาระการประชุม Initial review :</div>
    <div class="col-12 col-sm-7 text-white pb-1">
        <?php 
        $strSQL = "SELECT * FROM research_assign_fullboard_agendar WHERE rafa_id_rs = '$id_rs' AND rafa_status = '1' ORDER BY rafa_id DESC LIMIT 1";
        $resResearchRafa = $db->fetch($strSQL, false, false);
        echo "การประชุมครั้งที่ ".$resResearchRafa['rafa_agn']." | Panal ".$resResearchRafa['rafa_panal'];
        ?>
    </div>
    <div class="col-12 offset-sm-4 pt-2">
        <button class="btn btn-success">แก้ไขข้อมูลโครงการวิจัย</button>
        <button class="btn btn-success">แก้ไขข้อมูลผู้วิจัย</button>
    </div>

</div>