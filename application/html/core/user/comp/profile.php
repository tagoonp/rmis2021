<div class="row">
    <div class="col-12 pt-1">
        <h3>ข้อมูลส่วนตัว<br><small>User profile</small></h3>
        <div class="card">
            <div class="card-header">ข้อมูลทั่วไป</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-3 text-dark">ชื่อ - นามสกุล : <span class="text-danger">*</span> </div>
                    <div class="col-12 col-sm-9">
                        <div class="row">
                            <div class="form-group col-12 col-sm-4">
                                <select name="" id="" class="form-control">
                                    <option value="">-- เลือกคำนำหน้าชื่อ --</option>
                                </select>
                            </div>
                            <div class="form-group col-12 col-sm-4">
                                <input type="text" class="form-control" placeholder="ชื่อ" value="<?php echo $dataUser['fname']; ?>">
                            </div>
                            <div class="form-group col-12 col-sm-4">
                                <input type="text" class="form-control" placeholder="นามสกุล" value="<?php echo $dataUser['lname']; ?>">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-12 col-sm-4">
                                <select name="" id="" class="form-control">
                                    <option value="">-- Name prefix --</option>
                                </select>
                            </div>
                            <div class="form-group col-12 col-sm-4">
                                <input type="text" class="form-control" placeholder="Name" value="<?php echo $dataUser['fname_en']; ?>">
                            </div>
                            <div class="form-group col-12 col-sm-4">
                                <input type="text" class="form-control" placeholder="Surname" value="<?php echo $dataUser['lname_en']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-3 text-dark">หน่วยงานที่สังกัด<br>(Department/Institution) : </div>
                    <div class="col-12 col-sm-9">
                        <div class="form-group">
                            <textarea name="" id="" cols="30" rows="3" class="form-control" placeholder="ชื่อหน่วยงานที่สังกัด (ภาษาไทย)"></textarea>
                        </div>

                        <div class="form-group">
                            <textarea name="" id="" cols="30" rows="3" class="form-control" placeholder="Department/Institution"></textarea>
                        </div>
                    </div>

                    <div class="col-12 col-sm-3 text-dark">ตำแหน่ง<br>(Position) :  <span class="text-danger">*</span></div>
                    <div class="col-12 col-sm-9">
                        <div class="form-group">
                            <select name="" id="" class="form-control">
                                <option value="">-- เลือกตำแหน่ง --</option>
                                <?php 
                                $strSQL = "SELECT * FROM type_personnel WHERE 1";
                                $res = $db->fetch($strSQL, true, false);
                                if(($res) && ($res['status'])){
                                    foreach ($res['data'] as $row) {
                                        ?>
                                        <option value="<?php echo $row['id_personnel'];?>" <?php if($row['id_personnel'] == $dataUser['id_personnel']){ echo "selected"; } ?>><?php echo $row['personnel_name'];?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-sm-3 text-dark">สาขาเชี่ยวชาญ<br>(Expertise) : <span class="text-danger">*</span></div>
                    <div class="col-12 col-sm-9">
                        <div class="form-group">
                            <textarea name="" id="" cols="30" rows="3" class="form-control" placeholder="กรอกสาขาเชี่ยวชาญ แต่ละด้านให้คั่นด้วย comma (,) .."><?php echo $dataUser['expertise']; ?></textarea>
                        </div>
                    </div>

                    <div class="col-12 col-sm-3 text-dark">งานวิจัยที่สนใจ<br>(Research interest) : <span class="text-danger">*</span></div>
                    <div class="col-12 col-sm-9">
                        <div class="form-group">
                            <textarea name="" id="" cols="30" rows="3" class="form-control" placeholder="กรอกงานวิจัยที่สนใจ แต่ละงานให้คั่นด้วย comma (,) ..."><?php echo $dataUser['rs_interest']; ?></textarea>
                        </div>
                    </div>

                    <div class="col-12 col-sm-9 offset-sm-3">
                        <button class="btn btn-success" type="button">บันทึกข้อมูล</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">ข้อมูลการติดต่อ</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-3 text-dark">E-mail address : </div>
                    <div class="col-12 col-sm-9">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="E-mail address" readonly value="<?php echo $dataUser['email']; ?>">
                                <div style="padding-left: 3px; padding-top: 3px;"><small>หากต้องการเปลี่ยน E-mail address กรุณาติดต่อเจ้าหน้าที่</small></div>
                            </div>
                    </div>

                    <div class="col-12 col-sm-3 text-dark">โทรศัพท์มือถือ<br>(Mobile) : <span class="text-danger">*</span></div>
                    <div class="col-12 col-sm-9">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="หมายเลขโทรสัพท์มือถือ" value="<?php echo $dataUser['tel_mobile']; ?>">
                            </div>
                    </div>

                    <div class="col-12 col-sm-3 text-dark">โทรศัพท์สำนักงาน<br>(Office number) : <span class="text-danger">*</span></div>
                    <div class="col-12 col-sm-9">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="หมายเลขโทรศัพท์สำนักงาน"  value="<?php echo $dataUser['tel_office']; ?>">
                            </div>
                    </div>

                    <div class="col-12 col-sm-3 text-dark">แฟกซ์<br>(Fax) : </div>
                    <div class="col-12 col-sm-9">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="หมายเลขโทรสาร" value="<?php echo $dataUser['tel_fax']; ?>">
                            </div>
                    </div>

                    <div class="col-12 col-sm-3 text-dark">ที่อยู่ปัจจุบัน<br>(Address) : <span class="text-danger">*</span></div>
                    <div class="col-12 col-sm-9">
                        <div class="form-group">
                            <textarea name="" id="" cols="30" rows="3" class="form-control" placeholder="กรอกที่อยู่ปัจุุบัน ..."><?php echo $dataUser['address']; ?></textarea>
                        </div>
                    </div>

                    <div class="col-12 col-sm-9 offset-sm-3">
                        <button class="btn btn-success" type="button">บันทึกข้อมูล</button>
                    </div>

                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">รหัสผ่าน</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-3 text-dark">ที่อยู่ปัจจุบัน<br>(Address) : <span class="text-danger">*</span></div>
                    <div class="col-12 col-sm-9">
                        <div class="form-group">
                            <textarea name="" id="" cols="30" rows="3" class="form-control" placeholder="กรอกที่อยู่ปัจุุบัน ..."><?php echo $dataUser['address']; ?></textarea>
                        </div>
                    </div>
                    <div class="col-12 col-sm-9 offset-sm-3">
                        <button class="btn btn-success" type="button">เปลี่ยนรหัสผ่าน</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">การเชื่อมโยงข้อมูลภายนอก</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-3 text-dark pb-1">Line OA<br>(สำหรับรับการแจ้งเตือน) : </div>
                    <div class="col-12 col-sm-9">
                        ยังไม่เปิดให้ใช้งาน
                    </div>

                    <div class="col-12 col-sm-3 text-dark">PSU Passport : </div>
                    <div class="col-12 col-sm-9">
                        ยังไม่เปิดให้ใช้งาน
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>