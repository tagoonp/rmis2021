<?php 
$strSQL = "SELECT *, DATE(a.rp_sending_datetime) send_date FROM rec_progress a INNER JOIN research b ON a.rp_id_rs = b.id_rs
INNER JOIN type_status_research c ON a.rp_progress_status = c.id_status_research
INNER JOIN rec_progress_closing d ON a.rp_session = d.rpx_session
WHERE 
a.rp_sending_status = '1' AND a.rp_confirm_1 = '0' AND a.rp_delete_status = '0' AND a.rp_progress_id = 'closing' AND a.rp_session = '$session_id' AND a.rp_id_rs = '$id_rs'";
$resProgress = $db->fetch($strSQL, false);
$pgStatus = false;
if($resProgress){
$pgStatus = true;
}
?>
<h5 class="text-white">แบบรายงานสรุปผลการวิจัย <span class="text-warning">กรณีปิดโครงการปกติ (Final Report Form)</span></h5>
<hr>
<div class="row">
    <div class="col-12 col-sm-6">
        <h4>สรุปจำนวนอาสาสมัคร</h4>
        <div class="mb-1">
            <fieldset>
                <div class="radio dn">
                    <input type="radio" class="checkbox-input" id="radio_0" name="radio_1" value="na" checked>>
                </div>
                <div class="radio radio-success">
                    <input type="radio" class="checkbox-input" id="radio_1" name="radio_1" value="1" <?php if(($pgStatus) && ($resProgress['rp5_qs1'] == '1')){ echo "checked"; }?>>
                    <label for="radio_1" class="text-white">1. โครงการไม่เกี่ยวกับอาสาสมัคร (เช่น Retrospective ไม่มีข้อมูลระบุตัวตน)</label>
                </div>
            </fieldset>
            <div class="pt-1 mb-2 <?php if(($pgStatus) && ($resProgress['rp5_qs1'] == '1')){}else{ echo "dn"; }?>" id="hd1">
                <textarea name="txtQ1" id="txtQ1" cols="30" rows="4" placeholder="ระบุหมายเหตุ" class="form-control"><?php if(($pgStatus) && ($resProgress['rp5_qs1'] == '1')){ echo $resProgress['rp5_qs1_remak']; } ?></textarea>
            </div>
        </div>

        <div>
            <fieldset>
                <div class="radio radio-success">
                    <input type="radio" class="checkbox-input" id="radio_2" name="radio_1" value="2" <?php if(($pgStatus) && ($resProgress['rp5_qs1'] == '2')){ echo "checked"; }?>>
                    <label for="radio_2" class="text-white">2. โครงการเกี่ยวข้องกับการมีอาสาสมัคร&nbsp;<span class="text-danger">(กรอกตัวเลขทุกช่อง ถ้าไม่มีให้ใส่เลข 0)</span></label>
                </div>
            </fieldset>
            <div class="pt-1 mb-2 pl-2 <?php if(($pgStatus) && ($resProgress['rp5_qs1'] == '2')){}else{ echo "dn"; }?> " id="hd2">
                <div class="form-group row align-items-center">
                    <div class="col-lg-7 col-6">
                        <label for="first-name" class="col-form-label text-white" style="font-size: 1em;">- จำนวนอาสาสมัครที่ EC รับรอง : <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-lg-5 col-6">
                        <input type="number" class="form-control" name="txtQ2_1" id="txtQ2_1" min="0" value="<?php if($pgStatus){ echo $resProgress['rp5_qs2_1']; } ?>" />
                    </div>
                </div>

                <div class="form-group row align-items-center">
                    <div class="col-lg-7 col-6">
                        <label for="first-name" class="col-form-label text-white" style="font-size: 1em;">- จำนวนที่เซ็นยินยอม : <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-lg-5 col-6">
                        <input type="number" class="form-control" name="txtQ2_2" id="txtQ2_2"  min="0"  value="<?php if($pgStatus){ echo $resProgress['rp5_qs2_2']; } ?>" />
                    </div>
                </div>

                <div class="form-group row align-items-center">
                    <div class="col-lg-7 col-6">
                        <label for="first-name" class="col-form-label text-white" style="font-size: 1em;">- จำนวนที่ไม่ผ่านคัดกรอง : <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-lg-5 col-6">
                        <input type="number"  class="form-control" name="txtQ2_3" id="txtQ2_3" min="0"  value="<?php if($pgStatus){ echo $resProgress['rp5_qs2_3']; } ?>" />
                    </div>
                </div>

                <div class="form-group row align-items-center">
                    <div class="col-lg-7 col-6">
                        <label for="first-name" class="col-form-label text-white" style="font-size: 1em;">- จำนวนที่ถอนตัว : <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-lg-5 col-6">
                        <input type="number"  class="form-control" name="txtQ2_4" id="txtQ2_4" min="0"  value="<?php if($pgStatus){ echo $resProgress['rp5_qs2_4']; } ?>" />
                    </div>
                </div>

                <div class="form-group row align-items-center">
                    <div class="col-lg-7 col-6">
                        <label for="first-name" class="col-form-label text-white" style="font-size: 1em;">- จำนวนที่เสียชีวิต : <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-lg-5 col-6">
                        <input type="number"  class="form-control" name="txtQ2_5" id="txtQ2_5" min="0"  value="<?php if($pgStatus){ echo $resProgress['rp5_qs2_5']; } ?>"/>
                    </div>
                </div>

                <div class="form-group row align-items-center">
                    <div class="col-lg-7 col-6">
                        <label for="first-name" class="col-form-label text-white" style="font-size: 1em;">- จำนวนที่อยู่จนสิ้นสุดการศึกษา : <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-lg-5 col-6">
                        <input type="number"  class="form-control" name="txtQ2_6" id="txtQ2_6" min="0"  value="<?php if($pgStatus){ echo $resProgress['rp5_qs2_6']; } ?>" />
                    </div>
                </div>

            </div>
        </div>

    </div>
    <div class="col-12 col-sm-6">
        <div>
            <span class="text-white" style="font-size: 1.05em;">3. จำนวนอาสาสมัครที่เกิด <span class="text-danger">Serious adverse event (ถ้าไม่มีให้ใส่เลข 0)</span></span>
            <div class="pt-1 mb-2 pl-2">
                <div class="form-group row align-items-center">
                    <div class="col-lg-7 col-6">
                        <label for="first-name" class="col-form-label text-white" style="font-size: 1em;">- อาสาสมัครในสถานวิจัย : <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-lg-5 col-6">
                        <input type="number" id="txtQ3_1" class="form-control" name="txtQ3_1" placeholder="" min="0" value="<?php if($pgStatus){ echo $resProgress['rp5_qs3_1']; } ?>"  />
                    </div>
                </div>

                <div class="form-group row align-items-center">
                    <div class="col-lg-7 col-6">
                        <label for="first-name" class="col-form-label text-white" style="font-size: 1em;">- อาสาสมัครในประเทศ : <span class="text-muted">* ถ้ามี SUSAR</span></label>
                    </div>
                    <div class="col-lg-5 col-6">
                        <input type="number" id="txtQ3_2" class="form-control" name="txtQ3_2" placeholder="" min="0" value="<?php if($pgStatus){ echo $resProgress['rp5_qs3_2']; } ?>"  />
                    </div>
                </div>

                <div class="form-group row align-items-center">
                    <div class="col-lg-7 col-6">
                        <label for="first-name" class="col-form-label text-white" style="font-size: 1em;">- อาสาสมัครทั้งโลก : <span class="text-muted">* ถ้ามี SUSAR</span></label>
                    </div>
                    <div class="col-lg-5 col-6">
                        <input type="number" id="txtQ3_3" class="form-control" name="txtQ3_3" placeholder="" min="0" value="<?php if($pgStatus){ echo $resProgress['rp5_qs3_3']; } ?>"  />
                    </div>
                </div>


            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6">
        <hr>
        <span class="text-white" style="font-size: 1.05em;">4. ตั้งแต่เริ่มโครงการ เคยมี protocal deviation/violation หรือ compliance issue หรือไม่ <span class="text-danger">*</span></span>
        <div class="pt-2 pb-2">
            <fieldset>
                <div class="radio dn">
                    <input type="radio" class="checkbox-input" id="radio_4_0" name="radio_4" value="na" checked >
                </div>

                <div class="radio mb-1">
                    <input type="radio" class="checkbox-input" id="radio_4_1" name="radio_4" value="0"  <?php if(($pgStatus) && ($resProgress['rp5_qs4'] == '0')){ echo "checked"; }?>>
                    <label for="radio_4_1" class="text-white">ไม่เคย</label>
                </div>
            </fieldset>
            <fieldset>
                <div class="radio">
                    <input type="radio" class="checkbox-input" id="radio_4_2" name="radio_4" value="1" <?php if(($pgStatus) && ($resProgress['rp5_qs4'] == '1')){ echo "checked"; }?>>
                    <label for="radio_4_2" class="text-white">เคย (กรุณาแนบหลักฐานประกอบ)</label>
                </div>
            </fieldset>
            <div class="pt-1 mb-2 dn0"  id="hd52">
                <table class="table table-striped text-white">
                    <thead>
                        <tr class="bg-secondary">
                            <th class="text-white">ชื่อไฟล์</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="closing_4">
                        <tr><td colspan="2" class="text-center">ไม่มีไฟล์แนบ</td></tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td colspan="2">
                                <div action="#"  id="mydropzone_4" class="dropzone text-center" style="min-height: 50px !important;  background: transparent;border: dashed; border-radius: 10px; border-width: 1px; border-color: #888; ">
                                    <div class="fallback">
                                        <input name="file" type="file" multiple />
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6">
        <hr>
        <span class="text-white" style="font-size: 1.05em;">5. ตั้งแต่เริ่มโครงการ เคยมีเรื่องร้องเรียนเกี่ยวกับโครงการหรือไม่ <span class="text-danger">*</span></span>
        <div class="pt-2 pb-2">
            <fieldset>
                <div class="radio dn">
                    <input type="radio" class="checkbox-input" id="radio_5_0" name="radio_5" value="na" checked >
                </div>
                <div class="radio mb-1">
                    <input type="radio" class="checkbox-input" id="radio_5_1" name="radio_5" value="0"  <?php if(($pgStatus) && ($resProgress['rp5_qs5'] == '0')){ echo "checked"; }?>>
                    <label for="radio_5_1" class="text-white">ไม่เคย</label>
                </div>
            </fieldset>
            <fieldset>
                <div class="radio">
                    <input type="radio" class="checkbox-input" id="radio_5_2" name="radio_5" value="1"  <?php if(($pgStatus) && ($resProgress['rp5_qs5'] == '1')){ echo "checked"; }?>>
                    <label for="radio_5_2" class="text-white">เคย (กรุณาแนบหลักฐานประกอบ)</label>
                </div>
                
            </fieldset>
            <div class="pt-1 mb-2 dn0"  id="hd52">
                <table class="table table-striped text-white">
                    <thead>
                        <tr class="bg-secondary">
                            <th class="text-white">ชื่อไฟล์</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="closing_5">
                        <tr><td colspan="2" class="text-center">ไม่มีไฟล์แนบ</td></tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td colspan="2">
                                <div action="#"  id="mydropzone_5" class="dropzone text-center" style="min-height: 50px !important;  background: transparent;border: dashed; border-radius: 10px; border-width: 1px; border-color: #888; ">
                                    <div class="fallback">
                                        <input name="file" type="file" multiple />
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6">
        <hr>
        <span class="text-white" style="font-size: 1.05em;">6. การนำเสนอผล มี<u>ข้อมูลระบุตัวตน</u> หรือมีโอกาสที่จะเกิดผล<u>กระทบเชิงลบ</u>ต่ออาสาสมัครหรือชุมชนของอาสาสมัครหรือไม่ <span class="text-danger">*</span></span>
        <div class="pt-2 pb-2">
            <fieldset>
                <div class="radio dn">
                    <input type="radio" class="checkbox-input" id="radio_6_0" name="radio_6" value="na" checked >
                </div>
                <div class="radio mb-1">
                    <input type="radio" class="checkbox-input" id="radio_6_1" name="radio_6" value="0"  <?php if(($pgStatus) && ($resProgress['rp5_qs6'] == '0')){ echo "checked"; }?>>
                    <label for="radio_6_1" class="text-white">โครงการไม่เกี่ยวข้องกับอาสาสมัคร</label>
                </div>
            </fieldset>
            <fieldset>
                <div class="radio mb-1">
                    <input type="radio" class="checkbox-input" id="radio_6_2" name="radio_6" value="1" <?php if(($pgStatus) && ($resProgress['rp5_qs6'] == '1')){ echo "checked"; }?>>
                    <label for="radio_6_2" class="text-white">ไม่มีความเสี่ยง</label>
                </div>
            </fieldset>
            <fieldset>
                <div class="radio">
                    <input type="radio" class="checkbox-input" id="radio_6_3" name="radio_6" value="2" <?php if(($pgStatus) && ($resProgress['rp5_qs6'] == '2')){ echo "checked"; }?>>
                    <label for="radio_6_3" class="text-white">มีความเสี่ยงบ้าง และมีแผนลดควาามเสี่ยง คือ </label>
                </div>
                <div class="pt-1 mb-2 <?php if(($pgStatus) && ($resProgress['rp5_qs6'] == '2')){}else{ echo "dn"; }?>"  id="hd63">
                    <textarea name="txtQ6" id="txtQ6" cols="30" rows="4" placeholder="ระบุแผนลดควาามเสี่ยง" class="form-control"><?php if(($pgStatus) && ($resProgress['rp5_qs6'] == '2')){ echo $resProgress['rp5_qs6_info']; } ?></textarea>
                </div>
            </fieldset>
        </div>
    </div>
    <div class="col-12 col-sm-6">
        <hr>
        <span class="text-white" style="font-size: 1.05em;">7. มีแผนการติดตามและดูแลอาสาสมัครหลังสิ้นสุดโครงการอย่างไร <span class="text-danger">*</span></span>
        <div class="pt-2 pb-2">
            <fieldset>
                <div class="radio dn">
                    <input type="radio" class="checkbox-input" id="radio_7_0" name="radio_7" value="na" checked >
                </div>
                <div class="radio mb-1">
                    <input type="radio" class="checkbox-input" id="radio_7_1" name="radio_7" value="0" <?php if(($pgStatus) && ($resProgress['rp5_qs7'] == '0')){ echo "checked"; }?>>
                    <label for="radio_7_1" class="text-white">โครงการไม่เกี่ยวข้องกับอาสาสมัคร</label>
                </div>
            </fieldset>
            <fieldset>
                <div class="radio mb-1">
                    <input type="radio" class="checkbox-input" id="radio_7_2" name="radio_7" value="1" <?php if(($pgStatus) && ($resProgress['rp5_qs7'] == '1')){ echo "checked"; }?>>
                    <label for="radio_7_2" class="text-white">ไม่มีแผน <span class="text-danger">ต้องชี้แจงเหตุผล</span></label>
                </div>
                <div class="pt-1 mb-2 <?php if(($pgStatus) && ($resProgress['rp5_qs7'] == '1')){}else{ echo "dn"; }?>" id="hd72">
                    <textarea name="txtQ7_1" id="txtQ7_1" cols="30" rows="4" placeholder="ระบุเหตุผล" class="form-control"><?php if(($pgStatus) && ($resProgress['rp5_qs7'] == '1')){ echo $resProgress['rp5_qs7_info_1']; } ?></textarea>
                </div>
            </fieldset>
            <fieldset>
                <div class="radio">
                    <input type="radio" class="checkbox-input" id="radio_7_3" name="radio_7" value="2" <?php if(($pgStatus) && ($resProgress['rp5_qs7'] == '2')){ echo "checked"; }?>>
                    <label for="radio_7_3" class="text-white">มีแผนการจัดการและดูแล คือ </label>
                </div>
                <div class="pt-1 mb-2 <?php if(($pgStatus) && ($resProgress['rp5_qs7'] == '2')){}else{ echo "dn"; }?>" id="hd73">
                    <textarea name="txtQ7_2" id="txtQ7_2" cols="30" rows="4" placeholder="ระบุแผนการจัดการและดูแล" class="form-control"><?php if(($pgStatus) && ($resProgress['rp5_qs7'] == '2')){ echo $resProgress['rp5_qs7_info_2']; } ?></textarea>
                </div>
            </fieldset>
        </div>
    </div>

    <div class="col-12 col-sm-6">
        <hr>
        <span class="text-white" style="font-size: 1.05em;">8. Final report <span class="text-danger">*</span></span>
        <div class="pt-1 mb-2 dn0"  id="hd52">
                <table class="table table-striped text-white">
                    <thead>
                        <tr class="bg-secondary">
                            <th class="text-white">ชื่อไฟล์</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="closing_8">
                        <tr><td colspan="2" class="text-center">ยังไม่มีไฟล์ Final report แนบ</td></tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td colspan="2">
                                <div action="#"  id="mydropzone_8" class="dropzone text-center" style="min-height: 50px !important;  background: transparent;border: dashed; border-radius: 10px; border-width: 1px; border-color: #888; ">
                                    <div class="fallback">
                                        <input name="file" type="file" multiple />
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
    </div>

    <div class="col-12 col-sm-6">
        <hr>
        <span class="text-white" style="font-size: 1.05em;">9. Manuscript <span class="text-danger">หากไม่มี เจ้าหน้าที่จะบันทึกว่านักวิจัยค้างส่ง</span></span>
            <div class="pt-1 mb-2 dn0"  id="hd52">
                    <table class="table table-striped text-white">
                        <thead>
                            <tr class="bg-secondary">
                                <th class="text-white">ชื่อไฟล์</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="closing_9">
                            <tr><td colspan="2" class="text-center">ยังไม่มีไฟล์ Manuscript แนบ</td></tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <td colspan="2">
                                    <div action="#"  id="mydropzone_9" class="dropzone text-center" style="min-height: 50px !important;  background: transparent;border: dashed; border-radius: 10px; border-width: 1px; border-color: #888; ">
                                        <div class="fallback">
                                            <input name="file" type="file" multiple />
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
    </div>

    <div class="col-12 pt-3">
        <?php 
        if(($res_peport['rp_progress_status'] == '1') || ($res_peport['rp_progress_status'] == '21')){
            ?>
            <hr>
            <h4 class="py-50 text-dark">การดำเนินการ</h4>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="" style="font-size: 1em;">ผลการตรวจสอบ : <span class="text-danger">*</span></label>
                        <select name="txtReturn" id="txtReturn" class="form-control">
                            <option value="">-- เลือกผลการตรวจสอบ --</option>
                            <option value="1">เอกสารถูกไม่ต้อง ส่งนักวิจัยเพื่อแก้ไข</option>
                            <option value="2">เอกสารถูกต้อง ส่งต่อเลขา ฯ</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="" style="font-size: 1em;">บันทึกถึงนักวิจัยหรือเลขา ฯ : <span class="text-danger">*</span></label>
                        <textarea name="txtComment" id="txtComment" cols="30" rows="10" class="form-control"></textarea>
                    </div>

                </div>
            </div>
            <div class="text-center"><button class="btn btn-danger btn-lg">ดำเนินการต่อ</button></div>  
            <?php
        }
        ?>
    </div>
</div>
