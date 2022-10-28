<div class="pt-2">
    <div class="row form-group text-dark">
        <div class="col-12">4.1 สรุปย่อโครงการวิจัย (Synopsis) <span class="text-danger">โดยความยาวไม่เกิน 500 คำ</span> <span class="text-danger">*</span></div>
        <div class="col-12 pt-2">
            <textarea name="txtBrief" id="txtBrief" cols="30" rows="10"><?php if($prev_info){ echo $prev_info['brief_reports']; }?></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <button class="btn btn-primary btn-sm" onclick="window.location='research-register?stage=3&id_rs=<?php echo $id_rs; ?>'"><i class="bx bx-left-arrow-alt"></i> ไปส่วนที่ 3</button>
        </div>
        <div class="col-6 text-right">
            <button class="btn btn-primary btn-sm" onclick="research.save_path4()">ไปส่วนที่ 5 <i class="bx bx-right-arrow-alt"></i></button>
        </div>
    </div>

</div>