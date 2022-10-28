<?php 
if($resProgress0['rp_progress_status'] == '1'){
    ?>
    <button type="button" class="list-group-item list-group-item-action text-dark" onclick="openCommandModal('modalStep1', '1')"><i class="bx bx-x"></i> เอกสารไม่ถูกต้อง ส่งกลับ PI</button>
    <button type="button" class="list-group-item list-group-item-action text-dark" onclick="openCommandModal('modalStep1', '2')"><i class="bx bx-check"></i> เอกสารถูกต้อง ส่งเลขา</button>
    <?php
}

if($resProgress0['rp_progress_status'] == '4'){
    ?>
    <button type="button" class="list-group-item list-group-item-action text-dark"><i class="bx bx-x"></i> ส่ง Reviewer</button>
    <button type="button" class="list-group-item list-group-item-action text-dark"><i class="bx bx-check"></i> ส่งเลขาเลือก Reviewer เพิ่ม</button>
    <?php
}

if($resProgress0['rp_progress_status'] == '17'){
    ?>
    <button type="button" class="list-group-item list-group-item-action text-dark" onclick="openCommandModal('modalStep20', '1')"><i class="bx bx-paper-plane"></i> ส่งนักวิจัยเพื่อขอข้อมูลเพิ่มเติม</button>
    <button type="button" class="list-group-item list-group-item-action text-dark" onclick="openCommandModal('modalStep1', '1')"><i class="bx bx-refresh"></i> เปลี่ยนเลขา</button>
    <?php
}

if($resProgress0['rp_progress_status'] == '21'){
    ?>
    <button type="button" class="list-group-item list-group-item-action text-dark" onclick="window.location = 'progress_comment?id_rs=<?php echo $id_rs; ?>&session_id=<?php echo $session_id;?>'"><i class="bx bx-comment"></i> ตรวจข้อคำถาม/ข้อเสนอแนะ</button>
    <button type="button" class="list-group-item list-group-item-action text-dark" onclick="openCommandModal('modalStep20', '1')"><i class="bx bx-x"></i> เอกสารไม่ถูกต้อง/ไม่ครบถ้วน ส่งกลับ PI</button>
    <button type="button" class="list-group-item list-group-item-action text-dark" onclick="openCommandModal('modalStep1', '2')"><i class="bx bx-check"></i> เอกสารถูกต้อง ส่งเลขา</button>
    <?php
}
?>

<button type="button" class="list-group-item list-group-item-action text-dark" onclick="openNoteModal()"><i class="bx bx-pencil"></i> Note สำหรับสำนักงาน</button>

<div class="modal fade" id="noteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-full modal-dialog-centered modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h5 class="modal-title text-white" id="exampleModalCenterTitle">บันทึกสำหรับสำนักงาน</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form onsubmit="return false;">
                    <div class="form-group">
                        <label for="">การคำนวณวันดำเนินการ : <span class="text-danger">*</span></label>
                        <select name="txtCount" id="txtCount" class="form-control">
                            <option value="0" selected>ไม่ใช้เพื่อคำนวน Timeline</option>
                            <option value="1" >ใช้คำนวน Timeline</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">บันทึก : <span class="text-danger">*</span></label>
                        <textarea name="txtNote" id="txtNote" class="form-control" cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group text-right">
                        <button type="button" class="btn btn-danger" onclick="saveContNote()">บันทึก</button>
                    </div>
                </form>
                <hr>
                <div class="table-responsive">
                    <table class="table table-striped" id="table-note">
                        <thead class="bg-secondary">
                            <th class="text-white col-2">วัน-เวลา</th>
                            <th class="text-white">กิจรรม</th>
                            <th class="text-white col-2">โดย</th>
                        </thead>
                        <tbody id="noteList">
                            <?php 
                            $strSQL = "SELECT * FROM rec_note a LEFT JOIN userinfo b ON a.log_by_id = b.user_id WHERE a.log_session_id = '$session_id' AND a.log_id_rs = '$id_rs' ORDER BY a.log_datetime DESC";
                            $res = $db->fetch($strSQL, true, true);
                            if(($res) && ($res['status'])){
                                foreach ($res['data'] as $row) {
                                    ?>
                                    <tr>
                                        <td style="vertical-align: top;"><?php echo $row['log_datetime']; ?></td>
                                        <td style="vertical-align: top;">
                                            <div style="padding-bottom: 4px;">
                                                <span class="badge badge-lighe-secondary"><?php echo $row['log_activity']; ?></span>
                                            </div>
                                            <?php echo $row['log_detail']; ?>
                                        </td>
                                        <td style="vertical-align: top;">
                                            <div style="padding-bottom: 4px;">
                                            <?php  
                                            if(($row['log_by_role'] == 'pi') || ($row['log_by_role'] == 'pm')){
                                                ?>
                                                <span class="badge badge-primary round">PI</span>
                                                <?php
                                            }else if($row['log_by_role'] == 'staff'){
                                                ?>
                                                <span class="badge badge-success round">Staff</span>
                                                <?php
                                            }else if($row['log_by_role'] == 'ec'){
                                                ?>
                                                <span class="badge badge-warning round">EC</span>
                                                <?php
                                            }else if($row['log_by_role'] == 'reviewer'){
                                                ?>
                                                <span class="badge badge-secondary round">Reviewer</span>
                                                <?php
                                            }else if($row['log_by_role'] == 'chairman'){
                                                ?>
                                                <span class="badge badge-danger round">Chairman</span>
                                                <?php
                                            }
                                            ?>
                                            </div>
                                            <?php echo $row['fname']." ".$row['lname']; ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }else{
                                ?>
                                <tr><td colspan="3" class="text-center">Note not found</td></tr>
                                <?php
                            }
                            ?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalStep1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-full modal-dialog-centered modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h5 class="modal-title text-white" id="exampleModalCenterTitle">บันทึกผลการตรวจสอบเอกสาร</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form onsubmit="return false;">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group d-none">
                                <label for="" style="font-size: 1em;">ผลการตรวจสอบ : <span class="text-danger">*</span></label>
                                <select name="txtReturn_1" id="txtReturn_1" class="form-control">
                                    <option value="">-- เลือกผลการตรวจสอบ --</option>
                                    <option value="1">เอกสารถูกไม่ต้อง ส่งนักวิจัยเพื่อแก้ไข</option>
                                    <option value="2">เอกสารถูกต้อง ส่งต่อเลขา ฯ</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="" style="font-size: 1em;">บันทึกถึงนักวิจัยหรือเลขา ฯ : <span class="text-danger">*</span></label>
                                <textarea name="txtCommentCheckDoc" id="txtCommentCheckDoc" cols="30" rows="10" class="form-control"></textarea>
                            </div>

                            <div class="form-group text-right">
                                <button class="btn btn-danger" onclick="progress.return_1()">บันทึกและส่ง</button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalStep20" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-full modal-dialog-centered modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h5 class="modal-title text-white" id="exampleModalCenterTitle">ส่งนักวิจัยเพื่อขอข้อมูล/เอกสารเพิ่มเติม/ดำเนินการอื่น ๆ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form onsubmit="return false;">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="" style="font-size: 1em;">บันทึกถึงนักวิจัย : <span class="text-danger">*</span></label>
                                <textarea name="txtComment20" id="txtComment20" cols="30" rows="10" class="form-control"></textarea>
                            </div>

                            <div class="form-group text-right">
                                <button class="btn btn-danger" onclick="progress.return_20()">บันทึกและส่ง</button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>