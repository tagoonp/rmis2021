<div class="modal-body">
    <div class="row">
        <div class="col-12">
            <div class="form-group d-none">
                <label for="" class="text-white" style="font-size: 1em;">ผลการตรวจสอบ : <span class="text-danger">*</span></label>
                <select name="txtReturn_1" id="txtReturn_1" class="form-control">
                    <option value="">-- เลือกผลการตรวจสอบ --</option>
                    <option value="1">เอกสารถูกไม่ต้อง ส่งนักวิจัยเพื่อแก้ไข</option>
                    <option value="2">เอกสารถูกต้อง ส่งต่อเลขา ฯ</option>
                </select>
            </div>

            <div class="form-group">
                <label for="" class="text-white" style="font-size: 1em;">บันทึกถึงนักวิจัยหรือเลขา ฯ : <span class="text-danger">*</span></label>
                <textarea name="txtComment_1" id="txtComment_1" cols="30" rows="10" class="form-control"></textarea>
            </div>

        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger ml-1" onclick="progress.return_1()">
        <i class="bx bx-check d-block d-sm-none"></i>
        <span class="d-none d-sm-block">บันทึกและส่ง</span>
    </button>
</div>