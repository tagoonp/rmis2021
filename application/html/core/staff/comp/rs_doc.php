
<?php 
$strSQL = "SELECT * FROM research a LEFT JOIN type_research b ON a.id_type  = b.id_type
LEFT JOIN type_status_research c ON a.id_status_research = c.id_status_research
LEFT JOIN type_personnel d ON a.id_personnel = d.id_personnel
LEFT JOIN dept e ON a.id_dept = e.id_dept
LEFT JOIN useraccount f ON a.id_pm = f.id_pm
LEFT JOIN userinfo  g ON f.id = g.user_id
LEFT JOIN research_consider_type h ON a.id_rs = h.rct_id_rs
WHERE
  a.draft_status = '0'
  AND a.id_rs = '$id_rs'
  AND a.sendding_status = 'Y'
  AND a.research_status = 'new'
  AND f.delete_status = '0'";
$resultResearch1 = mysqli_query($conn, $strSQL);
$dataResearch1 = null;
if(($resultResearch1) && (mysqli_num_rows($resultResearch1) > 0)){
    $dataResearch1 = mysqli_fetch_assoc($resultResearch1);
}else{
    echo "Research info missing";
    // header('Location: ../index');
    die();
}
?>

<div class="row">
    <div class="col-12 col-sm-9"><h4 class="mb-0 text-dark">เอกสารโครงการวิจัย</h4></div>
    <div class="col-12 col-sm-3 pb-1">
        <button class="btn btn-danger btn-block" data-toggle="modal" data-target="#uploadFileModal"><i class="bx bx-upload"></i> อัพโหลดไฟล์</button>
    </div>
</div>

<div class="modal fade" id="uploadFileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header bg-secondary">
        <h5 class="modal-title pb-0 text-white" id="exampleModalLabel">อัพโหลดไฟล์โครงการวิจัย</h5>
        <button type="button" class="close btnCloseModal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" enctype="multipart/form-data" id="uploadForm" onsubmit="return false;" >

          <div class="form-group dn">
            <input type="text" id="txtIdRS" name="txtIdRS"  value="<?php echo $id_rs; ?>">
          </div>

          <div class="form-group dn">
            <input type="text" id="txtRssessionid" name="txtRssessionid" value="<?php echo $dataResearch1['session_id']; ?>">
          </div>

          <div class="form-group dn">
            <input type="text" id="txtOwnerID" name="txtOwnerID" readonly value="<?php echo $dataResearch1['id']; ?>">
          </div>

          <div class="form-group dn">
            <input type="text" id="txtStaff" name="txtStaff" readonly value="<?php echo $uid; ?>">
          </div>

          <div class="row">
            <div class="form-group col-8">
              <label for="" class="fz08">File group <span class="text-danger">*</span></label>
              <select class="form-control" name="txtFileGroup" id="txtFileGroup">
                <option value="">-- เลือกกลุ่มไฟล์แนบ --</option>
                <option value="1">Group 1 : Submission form</option>
                <option value="2">Group 2 : Protocol</option>
                <option value="3">Group 3 : Information sheet and Consent Form</option>
                <option value="4">Group 4 : Case Record Form</option>
                <option value="5">Group 5 : Subject Material</option>
                <option value="6">Group 6 : Legal Document</option>
                <option value="7">Group 7 : เอกสารประกอบอื่น ๆ</option>
                <option value="8">Group 8 : Updated CV, GCP</option>
                <option value="9">Group 9 : ใบนำส่งเงินค่าธรรมเนียม</option>
              </select>
            </div>

            <div class="form-group col-4">
              <label for="" class="fz08">Version <span class="text-danger">*</span></label>
              <input type="number" name="txtVersion" id="txtVersion" class="form-control">
            </div>

          </div>

          <div class="form-group">
            <label for="" class="f500 text-dark">เลือกไฟล์และกดปุ่มอัพโหลด <span class="text-danger">*</span> </label>
            <div class="">
              <input id="media" name="media" type="file" class="file_upload form-group">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary- cp bsdn" data-dismiss="modal">ยกเลิก</button>
        <button type="button" class="btn btn-success cp bsdn" id="uploadFileAttahed"><i class="fas fa-upload"></i> อัพโหลด</button>
      </div>
    </div>
  </div>
</div>

<div class="card bg-white">
    <div class="card-header bg-secondary text-white">Group 1 : Submission form</div>
    <div class="card-body">
        <?php 
        $strSQL = "SELECT * FROM file_research_attached WHERE f_rs_id = '$id_rs' AND f_delete_status = '0' AND f_group = '1'";
        $res = $db->fetch($strSQL, true, false);
        if(($res) && ($res['status'])){
            foreach ($res['data'] as $row) {
                ?>
                <div class="pt-2">
                    <div class="row">
                        <div class="col-2 col-sm-1">
                            <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                <input type="checkbox" class="custom-control-input" id="customSwitch11" <?php if($row['f_approval_status'] == '1'){ echo "checked"; } ?>>
                                <label class="custom-control-label" for="customSwitch11">
                                    <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                    <span class="switch-icon-right"><i class="bx bx-x"></i></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-10 col-sm-8"><?php echo $row['f_name']; ?></div>
                        <div class="col-12 col-sm-3 text-right">
                            <button class="btn btn-light-success btn-icon btn-sm" onclick="window.open('<?php echo $row['f_full_path'];?>', '_blank')" style="padding: 6px 10px 13px 10px;"><i class="bx bx-download"></i></button>
                            <!-- <button class="btn btn-light-success btn-icon btn-sm" style="padding: 6px 10px 13px 10px;"><i class="bx bx-pencil"></i></button> -->
                            <button class="btn btn-light-danger btn-icon btn-sm" onclick="init_file.delete('<?php echo $row['fid'];?>')" style="padding: 6px 10px 13px 10px;"><i class="bx bx-x"></i></button>
                        </div>
                    </div>
                </div>
                <?php
            }
        }else{
            ?><div class="text-center pt-2 pb-2">ไม่พบไฟล์</div><?php
        }
        ?>
    </div>
</div>
<div class="card bg-white">
    <div class="card-header bg-secondary text-white">Group 2 : Protocol</div>
    <div class="card-body">
    <?php 
        $strSQL = "SELECT * FROM file_research_attached WHERE f_rs_id = '$id_rs' AND f_delete_status = '0' AND f_group = '2'";
        $res = $db->fetch($strSQL, true, false);
        if(($res) && ($res['status'])){
            foreach ($res['data'] as $row) {
                ?>
                <div class="pt-2">
                    <div class="row">
                        <div class="col-2 col-sm-1">
                            <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                <input type="checkbox" class="custom-control-input" id="customSwitch11" <?php if($row['f_approval_status'] == '1'){ echo "checked"; } ?>>
                                <label class="custom-control-label" for="customSwitch11">
                                    <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                    <span class="switch-icon-right"><i class="bx bx-x"></i></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-10 col-sm-8"><?php echo $row['f_name']; ?></div>
                        <div class="col-12 col-sm-3 text-right">
                            <button class="btn btn-light-success btn-icon btn-sm" onclick="window.open('<?php echo $row['f_full_path'];?>', '_blank')" style="padding: 6px 10px 13px 10px;"><i class="bx bx-download"></i></button>
                            <!-- <button class="btn btn-light-success btn-icon btn-sm" style="padding: 6px 10px 13px 10px;"><i class="bx bx-pencil"></i></button> -->
                            <button class="btn btn-light-danger btn-icon btn-sm" onclick="init_file.delete('<?php echo $row['fid'];?>')" style="padding: 6px 10px 13px 10px;"><i class="bx bx-x"></i></button>
                        </div>
                    </div>
                </div>
                <?php
            }
        }else{
            ?><div class="text-center pt-2 pb-2">ไม่พบไฟล์</div><?php
        }
        ?>
    </div>
</div>
<div class="card bg-white">
    <div class="card-header bg-secondary text-white">Group 3 : Information sheet and Consent Form</div>
    <div class="card-body">
    <?php 
        $strSQL = "SELECT * FROM file_research_attached WHERE f_rs_id = '$id_rs' AND f_delete_status = '0' AND f_group = '3'";
        $res = $db->fetch($strSQL, true, false);
        if(($res) && ($res['status'])){
            foreach ($res['data'] as $row) {
                ?>
                <div class="pt-2">
                    <div class="row">
                        <div class="col-2 col-sm-1">
                            <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                <input type="checkbox" class="custom-control-input" id="customSwitch11" <?php if($row['f_approval_status'] == '1'){ echo "checked"; } ?>>
                                <label class="custom-control-label" for="customSwitch11">
                                    <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                    <span class="switch-icon-right"><i class="bx bx-x"></i></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-10 col-sm-8"><?php echo $row['f_name']; ?></div>
                        <div class="col-12 col-sm-3 text-right">
                            <button class="btn btn-light-success btn-icon btn-sm"  onclick="window.open('<?php echo $row['f_full_path'];?>', '_blank')" style="padding: 6px 10px 13px 10px;"><i class="bx bx-download"></i></button>
                            <!-- <button class="btn btn-light-success btn-icon btn-sm" style="padding: 6px 10px 13px 10px;"><i class="bx bx-pencil"></i></button> -->
                            <button class="btn btn-light-danger btn-icon btn-sm" onclick="init_file.delete('<?php echo $row['fid'];?>')" style="padding: 6px 10px 13px 10px;"><i class="bx bx-x"></i></button>
                        </div>
                    </div>
                </div>
                <?php
            }
        }else{
            ?><div class="text-center pt-2 pb-2">ไม่พบไฟล์</div><?php
        }
        ?>
    </div>
</div>
<div class="card bg-white">
    <div class="card-header bg-secondary text-white">Group 4 : Case Record Form</div>
    <div class="card-body">
    <?php 
        $strSQL = "SELECT * FROM file_research_attached WHERE f_rs_id = '$id_rs' AND f_delete_status = '0' AND f_group = '4'";
        $res = $db->fetch($strSQL, true, false);
        if(($res) && ($res['status'])){
            foreach ($res['data'] as $row) {
                ?>
                <div class="pt-2">
                    <div class="row">
                        <div class="col-2 col-sm-1">
                            <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                <input type="checkbox" class="custom-control-input" id="customSwitch11" <?php if($row['f_approval_status'] == '1'){ echo "checked"; } ?>>
                                <label class="custom-control-label" for="customSwitch11">
                                    <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                    <span class="switch-icon-right"><i class="bx bx-x"></i></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-10 col-sm-8"><?php echo $row['f_name']; ?></div>
                        <div class="col-12 col-sm-3 text-right">
                            <button class="btn btn-light-success btn-icon btn-sm"  onclick="window.open('<?php echo $row['f_full_path'];?>', '_blank')" style="padding: 6px 10px 13px 10px;"><i class="bx bx-download"></i></button>
                            <!-- <button class="btn btn-light-success btn-icon btn-sm" style="padding: 6px 10px 13px 10px;"><i class="bx bx-pencil"></i></button> -->
                            <button class="btn btn-light-danger btn-icon btn-sm" style="padding: 6px 10px 13px 10px;"><i class="bx bx-x"></i></button>
                        </div>
                    </div>
                </div>
                <?php
            }
        }else{
            ?><div class="text-center pt-2 pb-2">ไม่พบไฟล์</div><?php
        }
        ?>
    </div>
</div>
<div class="card bg-white">
    <div class="card-header bg-secondary text-white">Group 5 : Subject Material</div>
    <div class="card-body">
    <?php 
        $strSQL = "SELECT * FROM file_research_attached WHERE f_rs_id = '$id_rs' AND f_delete_status = '0' AND f_group = '5'";
        $res = $db->fetch($strSQL, true, false);
        if(($res) && ($res['status'])){
            foreach ($res['data'] as $row) {
                ?>
                <div class="pt-2">
                    <div class="row">
                        <div class="col-2 col-sm-1">
                            <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                <input type="checkbox" class="custom-control-input" id="customSwitch11" <?php if($row['f_approval_status'] == '1'){ echo "checked"; } ?>>
                                <label class="custom-control-label" for="customSwitch11">
                                    <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                    <span class="switch-icon-right"><i class="bx bx-x"></i></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-10 col-sm-8"><?php echo $row['f_name']; ?></div>
                        <div class="col-12 col-sm-3 text-right">
                            <button class="btn btn-light-success btn-icon btn-sm" onclick="window.open('<?php echo $row['f_full_path'];?>', '_blank')" style="padding: 6px 10px 13px 10px;"><i class="bx bx-download"></i></button>
                            <!-- <button class="btn btn-light-success btn-icon btn-sm" style="padding: 6px 10px 13px 10px;"><i class="bx bx-pencil"></i></button> -->
                            <button class="btn btn-light-danger btn-icon btn-sm" style="padding: 6px 10px 13px 10px;"><i class="bx bx-x"></i></button>
                        </div>
                    </div>
                </div>
                <?php
            }
        }else{
            ?><div class="text-center pt-2 pb-2">ไม่พบไฟล์</div><?php
        }
        ?>
    </div>
</div>
<div class="card bg-white">
    <div class="card-header bg-secondary text-white">Group 6 : Legal Document</div>
    <div class="card-body">
    <?php 
        $strSQL = "SELECT * FROM file_research_attached WHERE f_rs_id = '$id_rs' AND f_delete_status = '0' AND f_group = '6'";
        $res = $db->fetch($strSQL, true, false);
        if(($res) && ($res['status'])){
            foreach ($res['data'] as $row) {
                ?>
                <div class="pt-2">
                    <div class="row">
                        <div class="col-2 col-sm-1">
                            <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                <input type="checkbox" class="custom-control-input" id="customSwitch11" <?php if($row['f_approval_status'] == '1'){ echo "checked"; } ?>>
                                <label class="custom-control-label" for="customSwitch11">
                                    <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                    <span class="switch-icon-right"><i class="bx bx-x"></i></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-10 col-sm-8"><?php echo $row['f_name']; ?></div>
                        <div class="col-12 col-sm-3 text-right">
                            <button class="btn btn-light-success btn-icon btn-sm" onclick="window.open('<?php echo $row['f_full_path'];?>', '_blank')" style="padding: 6px 10px 13px 10px;"><i class="bx bx-download"></i></button>
                            <!-- <button class="btn btn-light-success btn-icon btn-sm" style="padding: 6px 10px 13px 10px;"><i class="bx bx-pencil"></i></button> -->
                            <button class="btn btn-light-danger btn-icon btn-sm" style="padding: 6px 10px 13px 10px;"><i class="bx bx-x"></i></button>
                        </div>
                    </div>
                </div>
                <?php
            }
        }else{
            ?><div class="text-center pt-2 pb-2">ไม่พบไฟล์</div><?php
        }
        ?>
    </div>
</div>
<div class="card bg-white">
    <div class="card-header bg-secondary text-white">Group 7 : เอกสารประกอบอื่น ๆ</div>
    <div class="card-body">
    <?php 
        $strSQL = "SELECT * FROM file_research_attached WHERE f_rs_id = '$id_rs' AND f_delete_status = '0' AND f_group = '7'";
        $res = $db->fetch($strSQL, true, false);
        if(($res) && ($res['status'])){
            foreach ($res['data'] as $row) {
                ?>
                <div class="pt-2">
                    <div class="row">
                        <div class="col-2 col-sm-1">
                            <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                <input type="checkbox" class="custom-control-input" id="customSwitch11" <?php if($row['f_approval_status'] == '1'){ echo "checked"; } ?>>
                                <label class="custom-control-label" for="customSwitch11">
                                    <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                    <span class="switch-icon-right"><i class="bx bx-x"></i></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-10 col-sm-8"><?php echo $row['f_name']; ?></div>
                        <div class="col-12 col-sm-3 text-right">
                            <button class="btn btn-light-success btn-icon btn-sm" onclick="window.open('<?php echo $row['f_full_path'];?>', '_blank')" style="padding: 6px 10px 13px 10px;"><i class="bx bx-download"></i></button>
                            <!-- <button class="btn btn-light-success btn-icon btn-sm" style="padding: 6px 10px 13px 10px;"><i class="bx bx-pencil"></i></button> -->
                            <button class="btn btn-light-danger btn-icon btn-sm" style="padding: 6px 10px 13px 10px;"><i class="bx bx-x"></i></button>
                        </div>
                    </div>
                </div>
                <?php
            }
        }else{
            ?><div class="text-center pt-2 pb-2">ไม่พบไฟล์</div><?php
        }
        ?>
    </div>
</div>
<div class="card bg-white">
    <div class="card-header bg-secondary text-white">Group 8 : Updated CV, หลักฐานการอบรมจริยธรรมวิจัย</div>
    <div class="card-body">
    <?php 
        $strSQL = "SELECT * FROM file_research_attached WHERE f_rs_id = '$id_rs' AND f_delete_status = '0' AND f_group = '8'";
        $res = $db->fetch($strSQL, true, false);
        if(($res) && ($res['status'])){
            foreach ($res['data'] as $row) {
                ?>
                <div class="pt-2">
                    <div class="row">
                        <div class="col-2 col-sm-1">
                            <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                <input type="checkbox" class="custom-control-input" id="customSwitch11" <?php if($row['f_approval_status'] == '1'){ echo "checked"; } ?>>
                                <label class="custom-control-label" for="customSwitch11">
                                    <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                    <span class="switch-icon-right"><i class="bx bx-x"></i></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-10 col-sm-8"><?php echo $row['f_name']; ?></div>
                        <div class="col-12 col-sm-3 text-right">
                            <button class="btn btn-light-success btn-icon btn-sm" onclick="window.open('<?php echo $row['f_full_path'];?>', '_blank')" style="padding: 6px 10px 13px 10px;"><i class="bx bx-download"></i></button>
                            <!-- <button class="btn btn-light-success btn-icon btn-sm" style="padding: 6px 10px 13px 10px;"><i class="bx bx-pencil"></i></button> -->
                            <button class="btn btn-light-danger btn-icon btn-sm" style="padding: 6px 10px 13px 10px;"><i class="bx bx-x"></i></button>
                        </div>
                    </div>
                </div>
                <?php
            }
        }else{
            ?><div class="text-center pt-2 pb-2">ไม่พบไฟล์</div><?php
        }
        ?>
    </div>
</div>
<div class="card bg-white">
    <div class="card-header bg-secondary text-white">Group 9 : ใบนำส่งเงินค่าธรรมเนียม</div>
    <div class="card-body">
    <?php 
        $strSQL = "SELECT * FROM file_research_attached WHERE f_rs_id = '$id_rs' AND f_delete_status = '0' AND f_group = '9'";
        $res = $db->fetch($strSQL, true, false);
        if(($res) && ($res['status'])){
            foreach ($res['data'] as $row) {
                ?>
                <div class="pt-2">
                    <div class="row">
                        <div class="col-2 col-sm-1">
                            <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                <input type="checkbox" class="custom-control-input" id="customSwitch11" <?php if($row['f_approval_status'] == '1'){ echo "checked"; } ?>>
                                <label class="custom-control-label" for="customSwitch11">
                                    <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                    <span class="switch-icon-right"><i class="bx bx-x"></i></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-10 col-sm-8"><?php echo $row['f_name']; ?></div>
                        <div class="col-12 col-sm-3 text-right">
                            <button class="btn btn-light-success btn-icon btn-sm" onclick="window.open('<?php echo $row['f_full_path'];?>', '_blank')" style="padding: 6px 10px 13px 10px;"><i class="bx bx-download"></i></button>
                            <!-- <button class="btn btn-light-success btn-icon btn-sm" style="padding: 6px 10px 13px 10px;"><i class="bx bx-pencil"></i></button> -->
                            <button class="btn btn-light-danger btn-icon btn-sm" style="padding: 6px 10px 13px 10px;"><i class="bx bx-x"></i></button>
                        </div>
                    </div>
                </div>
                <?php
            }
        }else{
            ?><div class="text-center pt-2 pb-2">ไม่พบไฟล์</div><?php
        }
        ?>
    </div>
</div>
<div class="card bg-white">
    <div class="card-header bg-secondary text-white">Group 10 : อื่น ๆ (เฉพาะโครงการที่ลงทะเบียนก่อน 1 ม.ค. 61)</div>
    <div class="card-body">
    <?php 
        $strSQL = "SELECT * FROM file_research_attached WHERE f_rs_id = '$id_rs' AND f_delete_status = '0' AND f_group = '10'";
        $res = $db->fetch($strSQL, true, false);
        if(($res) && ($res['status'])){
            foreach ($res['data'] as $row) {
                ?>
                <div class="pt-2">
                    <div class="row">
                        <div class="col-2 col-sm-1">
                            <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                <input type="checkbox" class="custom-control-input" id="customSwitch11" <?php if($row['f_approval_status'] == '1'){ echo "checked"; } ?>>
                                <label class="custom-control-label" for="customSwitch11">
                                    <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                    <span class="switch-icon-right"><i class="bx bx-x"></i></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-10 col-sm-8"><?php echo $row['f_name']; ?></div>
                        <div class="col-12 col-sm-3 text-right">
                            <button class="btn btn-light-success btn-icon btn-sm" onclick="window.open('<?php echo $row['f_full_path'];?>', '_blank')" style="padding: 6px 10px 13px 10px;"><i class="bx bx-download"></i></button>
                            <!-- <button class="btn btn-light-success btn-icon btn-sm" style="padding: 6px 10px 13px 10px;"><i class="bx bx-pencil"></i></button> -->
                            <button class="btn btn-light-danger btn-icon btn-sm" style="padding: 6px 10px 13px 10px;"><i class="bx bx-x"></i></button>
                        </div>
                    </div>
                </div>
                <?php
            }
        }else{
            ?><div class="text-center pt-2 pb-2">ไม่พบไฟล์</div><?php
        }
        ?>
    </div>
</div>