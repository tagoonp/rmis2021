<div class="pt-2">
    <div class="row form-group text-dark">
        <div class="col-12">2.1 โครงการนี้ หัวหน้าโครงการเป็นนักศึกษา <span class="text-danger">ที่ไม่มีรหัสบุคลากรคณะแพทยศาสตร์ มอ.</span> ใช่หรือไม่? <span class="text-danger">*</span></div>
        <div class="col-12">
            <ul class="list-unstyled mb-0 pt-1">
                <li class="d-inline-block mr-2 mb-1" style="display: none !important;">
                    <fieldset>
                        <div class="radio radio-success">
                            <input type="radio" name="txt2_1" id="txt2_1_0" checked value="na">
                            <label for="txt2_1_1">Danger</label>
                        </div>
                    </fieldset>
                </li>
                <li class="d-inline-block mr-2 mb-1">
                    <fieldset>
                        <div class="radio radio-success">
                            <input type="radio" name="txt2_1" id="txt2_1_1" value="1" <?php if($prev_info){ if($prev_info['cotype'] == '1'){ echo "checked"; }} ?>>
                            <label for="txt2_1_1" class="text-dark">ไม่ใช่</label>
                        </div>
                    </fieldset>
                </li>
                <li class="d-inline-block mr-2 mb-1">
                    <fieldset>
                        <div class="radio radio-success">
                            <input type="radio" name="txt2_1" id="txt2_1_2"  value="2" <?php if($prev_info){ if($prev_info['cotype'] == '2'){ echo "checked"; }} ?>>
                            <label for="txt2_1_2" class="text-dark">ใช่</label>
                        </div>
                    </fieldset>
                </li>
            </ul>
            
        </div>
    </div>

    <div class="row form-group text-dark">
        <div class="col-12">2.2 หน้าที่/ความรับผิดชอบของหัวหน้าโครงการ <span class="text-danger">*</span></div>
        <div class="col-12">
            <div class="form-group">
                <textarea name="txtResponse" id="txtResponse" cols="30" rows="3" class="form-control" placeholder="กรอกหน้าที่ ความรับผิดชอบของหัวหน้าโครงการ"><?php if($prev_info){ echo $prev_info['pm_job']; } ?></textarea>
            </div>
        </div>
    </div>

    <div class="row form-group text-dark">
        <div class="col-12">2.3 รายชื่อผู้ร่วมวิจัย <span class="text-muted">(ถ้ามี)</span></div>
        <div class="col-12 pt-1">
        <span class="text-danger">** ให้เขียนชื่อของผู้มีส่วนเกี่ยวข้องกับขั้นตอนการดำเนินการวิจัยทุกคน (รวมถึงผู้ช่วยวิจัย ผู้ขอความยินยอม) รายชื่อในระบบนี้ไม่จำเป็นต้องตรงกับรายนามของผู้นิพนธ์</span>
        </div>
        <div class="col-12 pt-1">
            <button class="btn btn-success btn-sm mb-1" data-toggle="modal" data-target="#modalCopi"><i class="bx bx-plus"></i> คลิกที่นี่เพื่อเพิ่มผู้ร่วมวิจัย</button>
            <div class="colist">
                <?php 
                $strSQL = "SELECT * FROM pm_team WHERE co_rs_id = '$id_rs' OR co_sess_id = '".$prev_info['session_id']."'";
                $resCo = $db->fetch($strSQL, true, true);
                if(($resCo) && ($resCo['status'])){
                    ?>
                    <div class="row">
                        <?php  
                        foreach ($resCo['data'] as $row) {
                            ?>
                            <div class="col-12 col-sm-6">
                                <div class="card bg-white" style="border: dashed; border-width: 1px; border-color: #888;">
                                    <div class="card-body text-dark">
                                        <div class="row">
                                            <div class="col-12 pb-1">
                                                <?php 
                                                if($row['co_pid'] != null){
                                                    $strSQL = "SELECT profile FROM useraccount WHERE id_pm = '".$row['co_pid']."' AND profile != '' LIMIT 1";
                                                    $res = $db->fetch($strSQL, false, false);
                                                    if($res){
                                                        if (file_exists($res['profile'])) {
                                                            ?><img class="round" src="<?php echo $current_user['profile'];?>" alt="avatar" height="40" width="40"></span><?php
                                                        }else{
                                                            ?><img class="round" src="../../../old/assets/img/avatar/avatar-1.png" alt="avatar" height="40" width="40"></span><?php
                                                        }
                                                    }else{
                                                        ?><img class="round" src="../../../old/assets/img/avatar/avatar-1.png" alt="avatar" height="40" width="40"></span><?php
                                                    }
                                                }else{
                                                    ?><img class="round" src="../../../old/assets/img/avatar/avatar-1.png" alt="avatar" height="40" width="40"></span><?php
                                                }
                                                
                                                ?>
                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12" style="font-size: 1.2em;"><?php echo $row['co_fname']." ".$row['co_lname']; ?></div>
                                                    <div class="col-12">หน้าที่ : <?php echo $row['co_job']; ?></div>
                                                    <div class="col-12 pt-1">
                                                        <button class="btn btn-primary btn-icon" onclick="research.setCopi('<?php echo $row['copi_id'];?>', '<?php echo $row['dept_type'];?>')"  style="padding: 5px 10px 10px 10px;"><i class="bx bx-pencil"></i></button>    
                                                        <button class="btn btn-icon btn-danger" onclick="research.deleteCopi('<?php echo $row['copi_id'];?>')" style="padding: 5px 10px 10px 10px;"><i class="bx bx-trash"></i></button>    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }else{
                    ?>
                    <div class="col-12 p-1" style="border:dashed; border-width: 1px 1px 1px 1px; border-radius: 5px;">ไม่พบข้อมูลผู้ร่วมวิจัย</div>
                    <?php
                }
                ?>
                
            </div>
        </div>
    </div>

    

    <hr>
    <div class="row">
        <div class="col-6">
            <button class="btn btn-primary btn-sm" onclick="window.location='research-register?stage=1&id_rs=<?php echo $id_rs; ?>'"><i class="bx bx-left-arrow-alt"></i> ไปส่วนที่ 1</button>
        </div>
        <div class="col-6 text-right">
            <button class="btn btn-primary btn-sm" onclick="research.save_path2()">ไปส่วนที่ 3 <i class="bx bx-right-arrow-alt"></i></button>
        </div>
    </div>

</div>

<div class="modal fade" id="modalCopiInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-dark" id="exampleModalCenterTitle">เพิ่มข้อมูลผู้ร่วมวิจัยภายในคณะ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form onsubmit="return false;" id="coPiForm">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="">รหัสบุคคลากร :</label>
                            <input type="text" class="form-control" id="txtCoPid" readonly>
                        </div>
                        <div class="form-group col-12 col-sm-4">
                            <label for="">คำนำหน้าชื่อ (ไทย) :</label>
                            <input type="text" class="form-control" id="txtCoPrefixTh">
                        </div>
                        <div class="form-group col-12 col-sm-4">
                            <label for="">ชื่อ (ภาษาไทย) : <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="txtCoFnameTh">
                        </div>
                        <div class="form-group col-12 col-sm-4">
                            <label for="">นามสกุล (ภาษาไทย) : <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="txtCoLnameTh">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-12 col-sm-4">
                            <label for="">Prefix :</label>
                            <input type="text" class="form-control" id="txtCoPrefixEn">
                        </div>
                        <div class="form-group col-12 col-sm-4">
                            <label for="">Name : <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="txtCoFnameEn">
                        </div>
                        <div class="form-group col-12 col-sm-4">
                            <label for="">Surname : <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="txtCoLnameEn">
                        </div>
                    </div>

                    <div class="row dn" id="CoEmailDiv">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">E-mail address : <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="txtCoEmail">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="">หน่วยงาน : <span class="text-danger">*</span></label>
                                <select class="form-control" name="txtCodeptname" id="txtCodeptname">
                                    <option value="">-- เลือกหน่วยงานภายในคณะแพทย์ --</option>
                                    <?php
                                    $strSQL = "SELECT * FROM dept WHERE id_dept != '19' ORDER BY dept_name";
                                    $resultDept = $db->fetch($strSQL, true, false);
                                    if(($resultDept) && ($resultDept['status'])){
                                        foreach ($resultDept['data'] as $rfow) {
                                            ?>
                                            <option value="<?php echo $rfow['id_dept'];?>"><?php echo $rfow['dept_name'];?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">หน้าที่ความรับผิดชอบในโครงการ : <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="txtCoResponse">
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button class="btn btn-success" onclick="research.addInternalCo()">บันทึก</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalCopiInternalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-dark" id="exampleModalCenterTitle">แก้ไขข้อมูลผู้ร่วมวิจัย</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body pt-3">
                <form onsubmit="return false;" id="coPiForm">
                    <div class="row">
                        <div class="form-group col-12 dn">
                            <label for="">Record ID :</label>
                            <input type="text" class="form-control" id="txtCoRid_u" readonly>
                        </div>
                        <div class="form-group col-12 col-sm-4">
                            <label for="">คำนำหน้าชื่อ (ไทย) :</label>
                            <input type="text" class="form-control" id="txtCoPrefixTh_u">
                        </div>
                        <div class="form-group col-12 col-sm-4">
                            <label for="">ชื่อ (ภาษาไทย) : <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="txtCoFnameTh_u">
                        </div>
                        <div class="form-group col-12 col-sm-4">
                            <label for="">นามสกุล (ภาษาไทย) : <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="txtCoLnameTh_u">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-12 col-sm-4">
                            <label for="">Prefix :</label>
                            <input type="text" class="form-control" id="txtCoPrefixEn_u">
                        </div>
                        <div class="form-group col-12 col-sm-4">
                            <label for="">Name : <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="txtCoFnameEn_u">
                        </div>
                        <div class="form-group col-12 col-sm-4">
                            <label for="">Surname : <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="txtCoLnameEn_u">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">หน้าที่ความรับผิดชอบ : <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="txtCoResponse_u">
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button class="btn btn-success" onclick="research.UpdateInternalCo()">บันทึก</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalCopiExternalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-dark" id="exampleModalCenterTitle">แก้ไขข้อมูลผู้ร่วมวิจัย</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body pt-3">
                <form onsubmit="return false;" id="coPiForm">
                    <div class="row">
                        <div class="form-group col-12 dn">
                            <label for="">Record ID :</label>
                            <input type="text" class="form-control" id="txtCoRid_ue" readonly>
                        </div>
                        <div class="form-group col-12 col-sm-4">
                            <label for="">คำนำหน้าชื่อ (ไทย) :</label>
                            <input type="text" class="form-control" id="txtCoPrefixTh_ue">
                        </div>
                        <div class="form-group col-12 col-sm-4">
                            <label for="">ชื่อ (ภาษาไทย) : <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="txtCoFnameTh_ue">
                        </div>
                        <div class="form-group col-12 col-sm-4">
                            <label for="">นามสกุล (ภาษาไทย) : <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="txtCoLnameTh_ue">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-12 col-sm-4">
                            <label for="">Prefix :</label>
                            <input type="text" class="form-control" id="txtCoPrefixEn_ue">
                        </div>
                        <div class="form-group col-12 col-sm-4">
                            <label for="">Name : <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="txtCoFnameEn_ue">
                        </div>
                        <div class="form-group col-12 col-sm-4">
                            <label for="">Surname : <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="txtCoLnameEn_ue">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">ชื่อหน่วยงานที่สังกัด (ภาษาไทย) : <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="txtDeptnameTh_ue">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Department / Institution name (English) : <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="txtDeptnameEn_ue">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">E-mail address : <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="txtCoEmail_ue">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">หน้าที่ความรับผิดชอบ : <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="txtCoResponse_ue">
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button class="btn btn-success" onclick="research.UpdateExternalCo()">บันทึก</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalCopi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-white" id="exampleModalCenterTitle">เพิ่มผู้ร่วมวิจัย</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="bx bx-x"></i>
                    </button>
                </div>
                <div class="modal-body pl-2 pr-2">
                    <p class="text-danger">
                        ** ไม่ต้องเพิ่มชื่อของหัวหน้าโครงการ
                    </p>
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" aria-controls="home" role="tab" aria-selected="true">
                                <i class="bx bx-home align-middle"></i>
                                <span class="align-middle">ภายในคณะแพทยศาสตร์ มอ.</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" aria-controls="profile" role="tab" aria-selected="false">
                                <i class="bx bx-user-plus align-middle"></i>
                                <span class="align-middle">เพิ่มใหม่ / ภายนอก</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active pl-2 pr-2" id="home" aria-labelledby="home-tab" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-striped dataex-co-pi">
                                    <thead>
                                        <tr>
                                            <th>ชื่อ - นามสกุล</th>
                                            <th>รหัสบุคลากร</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 

                                        $strSQL = "SELECT id_per, name, surname, dept 
                                                   FROM personnel 
                                                   WHERE 
                                                   id_per != '".$current_user['id_pm']."'
                                                   AND position != 'ยาม' AND position NOT LIKE '%คนงาน%' AND position NOT LIKE '%แม่บ้าน%' AND position NOT LIKE '%ช่าง%' AND position NOT LIKE '%คนสวน%'  ORDER BY name";
                                        $resCopi = $db->fetch($strSQL, true, false);
                                        if(($resCopi) && ($resCopi['status'])){
                                            foreach($resCopi['data'] as $row){
                                                ?>
                                                <tr>
                                                    <td><?php echo $row['name']. " " . $row['surname']; ?></td>
                                                    <td><?php echo $row['id_per']; ?></td>
                                                    <td class="text-right">
                                                        <button class="btn btn-icon btn-outline-secondary" onclick="research.searchInternalCo('<?php echo $row['id_per']; ?>', '<?php echo $row['name']; ?>', '<?php echo $row['surname']; ?>')"><i class="bx bx-plus"></i></button>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane p-2 pb-1" id="profile" aria-labelledby="profile-tab" role="tabpanel">
                            <form onsubmit="return false;" id="coPiForm">
                                <div class="row">
                                    <div class="form-group col-12 col-sm-4">
                                        <label for="">คำนำหน้าชื่อ (ไทย) :</label>
                                        <input type="text" class="form-control" id="txtPrefixTh">
                                    </div>
                                    <div class="form-group col-12 col-sm-4">
                                        <label for="">ชื่อ (ภาษาไทย) : <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="txtFnameTh">
                                    </div>
                                    <div class="form-group col-12 col-sm-4">
                                        <label for="">นามสกุล (ภาษาไทย) : <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="txtLnameTh">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-12 col-sm-4">
                                        <label for="">Prefix :</label>
                                        <input type="text" class="form-control" id="txtPrefixEn">
                                    </div>
                                    <div class="form-group col-12 col-sm-4">
                                        <label for="">Name : <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="txtFnameEn">
                                    </div>
                                    <div class="form-group col-12 col-sm-4">
                                        <label for="">Surname : <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="txtLnameEn">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">E-mail address : <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" id="txtEmail">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">ประเภทบุคลากร : <span class="text-danger">*</span></label>
                                            <select name="txtCopitype" id="txtCopitype" class="form-control">
                                                <option value="2">บุคลากรภายนอก คณะแพทยศาสตร์ มอ.</option>
                                                <option value="1">บุคลากรภายใน คณะแพทยศาสตร์ มอ.</option>
                                            </select>

                                            <div style="padding-top: 4px;">
                                                <small>
                                                Note : หากเป็นบุคคลากรภายในคณะแพทย์ ให้ตรวจสอบจากรายชื่อในกลุ่ม "ภายในคณะแพทยศาสตร์" ก่อน หากค้นหาไม่เจอให้มาเพิ่มในส่วนนี้
                                                </small>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="externalCopi">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">ชื่อหน่วยงานที่สังกัด (ภาษาไทย) : <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="txtDeptnameTh">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">Department / Institution name (English) : <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="txtDeptnameEn">
                                        </div>
                                    </div>
                                </div>

                                <div id="internalCopi" class="dn">
                                    <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">หน่วยงาน : <span class="text-danger">*</span></label>
                                            <select class="form-control" name="txtPdeptname" id="txtPdeptname">
                                                <option value="">-- เลือกหน่วยงานภายในคณะแพทย์ --</option>
                                                <?php
                                                $strSQL = "SELECT * FROM dept WHERE id_dept != '19' ORDER BY dept_name";
                                                $resultDept = $db->fetch($strSQL, true, false);
                                                if(($resultDept) && ($resultDept['status'])){
                                                    foreach ($resultDept['data'] as $rfow) {
                                                        ?>
                                                        <option value="<?php echo $rfow['id_dept'];?>"><?php echo $rfow['dept_name'];?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">หน้าที่ความรับผิดชอบ : <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="txtExtCoResponse">
                                        </div>
                                    </div>
                                    <div class="col-12 text-center">
                                        <button class="btn btn-success" onclick="research.addExternalCoPi()">บันทึก</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>