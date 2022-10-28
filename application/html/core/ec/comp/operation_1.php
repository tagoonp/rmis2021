<form onsubmit="return false;">
    <div class="form-group">
        <label for="">เลือกกระบวนการต่อไป : <span class="text-danger">*</span></label>
        <select name="txtReturnEcStep1" id="txtReturnEcStep1" class="form-control">
            <option value="">-- เลือก --</option>
            <option value="4">ส่งเจ้าหน้าที่เพื่อออกใบรับรอง/รับทราบ</option>
            <option value="1">ส่งเจ้าหน้าที่เพื่อขอข้อมูลเพิ่มเติมจากนักวิจัย/ดำเนินการอื่น ๆ</option>
            <!-- <option value="6">ส่งนักวิจัยเพื่อแก้ไขตามข้อเสนอแนะ</option>
            <option value="2">ส่งกรรมการพิจารณา</option> -->
            <option value="2">เลือก Reviewer</option>
            <option value="5">นำเข้าประชุมคณะกรรมการเต็มชุด (รอนำเข้าที่ประชุมโดยเจ้าหน้าที่)</option>
            <!-- <option value="3">ส่งเจ้าหน้าที่เพื่อดำเนินการอื่น ๆ</option> -->
        </select>
    </div>
    <div id="txtReturn1Div" class="dn">
        <div class="form-group">
            <label for="">ข้อความถึงเจ้าหน้าที่หรือนักวิจัย : <span class="text-danger">*</span></label>
            <textarea name="txtMessageReturn1" id="txtMessageReturn1" cols="30" rows="10"></textarea>
        </div>
    </div>
    <div class="form-group text-right">
        <button class="btn btn-danger" id="btnNext1" onclick="ec.operate_1()" id="btnNext">บันทึกและส่ง <i class="bx bx-chevron-right"></i></button>
    </div>
</form>

