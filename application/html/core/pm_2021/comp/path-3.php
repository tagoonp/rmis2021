<div class="pt-2">
    <div class="row form-group text-dark">
        <div class="col-5">3.1 โครงการนี้ <span class="text-danger">มีแหล่งทุนวิจัยหรือไม่?</span> <span class="text-danger">*</span></div>
        <div class="col-7">
            <ul class="list-unstyled mb-0">
                <li class="d-inline-block mr-2 mb-1">
                    <fieldset>
                        <div class="radio radio-success">
                            <input type="radio" name="txt3_1" id="txt3_1_1" value="1" checked>
                            <label for="txt3_1_1" class="text-dark">มีแหล่งทุน</label>
                        </div>
                    </fieldset>
                </li>
                <li class="d-inline-block mr-2 mb-1">
                    <fieldset>
                        <div class="radio radio-success">
                            <input type="radio" name="txt3_1" id="txt3_1_2" value="0">
                            <label for="txt3_1_2" class="text-dark">ไม่มีแหล่งทุน</label>
                        </div>
                    </fieldset>
                </li>
            </ul>
            
        </div>
    </div>

    <div id="fundPanal">
        <div class="row form-group text-dark">
            <div class="col-12">3.2 แหล่งทุนวิจัย <span class="text-danger">*</span>
                <div class="span text-muted" style="padding-top: 4px; font-size: 0.8em;">Note : หากมีงบประมาณในแหล่งทุนใด ให้ระบุจำนวนเงิน โดยให้ใส่เพียงตัวเลขเท่านั้น (ไม่ต้องใส่ ,)</div>
            </div>
            <div class="col-12 pt-1">
                <fieldset class="mb-1">
                    <div class="checkbox checkbox-success">
                        <input type="checkbox" id="colorCheckbox1" <?php if($prev_info){ if($prev_info['ts1'] == '1'){ echo "checked"; }} ?>>
                        <label for="colorCheckbox1" class="text-dark">ทุนวิจัยคณะแพยศาสตร์</label>
                    </div>
                </fieldset>

                <div style="" id="fund1" class="<?php if($prev_info){ if($prev_info['ts1'] == '0'){ echo "dn"; }}else{ echo "dn"; } ?>">
                    <div class="card bg-light">
                        <div class="card-body text-dark">
                            <div class="row">
                                <div class="col-12 col-sm-3" style="padding-top: 8px;">จำนวนเงิน : <span class="text-danger">*</span></div>
                                <div class="col-12 col-sm-9"><input type="number" id="txtFund1" class="fundBuget form-control" placeholder="ระบุเฉพาะตัวเลข ไม่ต้องใส่ ," value="<?php if($prev_info){ if($prev_info['ts1'] == '1'){ echo $prev_info['ts1_budget'];  } } ?>"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <fieldset class="mb-1">
                    <div class="checkbox checkbox-success">
                        <input type="checkbox" id="colorCheckbox2" <?php if($prev_info){ if($prev_info['ts2'] == '1'){ echo "checked"; }} ?>>
                        <label for="colorCheckbox2" class="text-dark">ทุนงบประมาณแผ่นดิน</label>
                    </div>
                </fieldset>

                <div style="" id="fund2" class="<?php if($prev_info){ if($prev_info['ts2'] == '0'){ echo "dn"; }}else{ echo "dn"; } ?>">
                    <div class="card bg-light">
                        <div class="card-body text-dark">
                            <div class="row">
                                <div class="col-12 col-sm-3" style="padding-top: 8px;">จำนวนเงิน : <span class="text-danger">*</span></div>
                                <div class="col-12 col-sm-9"><input type="number" id="txtFund2" class="fundBuget form-control" placeholder="ระบุเฉพาะตัวเลข ไม่ต้องใส่ ," value="<?php if($prev_info){ if($prev_info['ts2'] == '1'){ echo $prev_info['ts2_budget'];  } } ?>"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <fieldset class="mb-1">
                    <div class="checkbox checkbox-success">
                        <input type="checkbox" id="colorCheckbox3" <?php if($prev_info){ if($prev_info['ts7'] == '1'){ echo "checked"; }} ?>>
                        <label for="colorCheckbox3" class="text-dark">ทุนภาคเอกชน (Industry sonpored trial)</label>
                    </div>
                </fieldset>

                <div style="" id="fund3" class="<?php if($prev_info){ if($prev_info['ts7'] == '0'){ echo "dn"; }}else{ echo "dn"; } ?>">
                    <div class="card bg-light">
                        <div class="card-body text-dark">
                            <div class="row">
                                <div class="col-12 col-sm-3" style="padding-top: 8px;">จำนวนเงิน : <span class="text-danger">*</span></div>
                                <div class="col-12 col-sm-9"><input type="number" id="txtFund3" class="fundBuget form-control" placeholder="ระบุเฉพาะตัวเลข ไม่ต้องใส่ ," value="<?php if($prev_info){ if($prev_info['ts7'] == '1'){ echo $prev_info['ts7_budget'];  } } ?>"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <fieldset class="mb-1">
                    <div class="checkbox checkbox-success">
                        <input type="checkbox" id="colorCheckbox4" <?php if($prev_info){ if($prev_info['ts3'] == '1'){ echo "checked"; }} ?>>
                        <label for="colorCheckbox4" class="text-dark">ทุนรายได้มหาวิทยาลัยสงขลานครินทร์&nbsp;<span class="text-danger"> * เช่น ทุนพัฒนานักวิจัย</span></label>
                    </div>
                </fieldset>

                <div style="" id="fund4" class="<?php if($prev_info){ if($prev_info['ts3'] == '0'){ echo "dn"; }}else{ echo "dn"; } ?>">
                    <div class="card bg-light">
                        <div class="card-body text-dark">
                            <div class="row">
                                <div class="col-12 col-sm-3" style="padding-top: 8px;">จำนวนเงิน : <span class="text-danger">*</span></div>
                                <div class="col-12 col-sm-9"><input type="number" id="txtFund4" class="fundBuget form-control" placeholder="ระบุเฉพาะตัวเลข ไม่ต้องใส่ ," value="<?php if($prev_info){ if($prev_info['ts3'] == '1'){ echo $prev_info['ts3_budget'];  } } ?>"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <fieldset class="mb-1">
                    <div class="checkbox checkbox-success">
                        <input type="checkbox" id="colorCheckbox5" <?php if($prev_info){ if($prev_info['ts4'] == '1'){ echo "checked"; }} ?>>
                        <label for="colorCheckbox5" class="text-dark">ทุนอื่น ๆ ภายในประเทศ&nbsp;<span class="text-danger"> * เช่น สกว. สสส. สวทช. ทุนวิจัยคณะอื่น ๆ ฯลฯ</span></label>
                    </div>
                </fieldset>

                <div style="" id="fund5" class="<?php if($prev_info){ if($prev_info['ts4'] == '0'){ echo "dn"; }}else{ echo "dn"; } ?>">
                    <div class="card bg-light">
                        <div class="card-body text-dark">
                            <div class="row">
                                <div class="col-12 col-sm-3" style="padding-top: 8px;">จำนวนเงิน : <span class="text-danger">*</span></div>
                                <div class="col-12 col-sm-9"><input type="number" id="txtFund5" class="fundBuget form-control" placeholder="ระบุเฉพาะตัวเลข ไม่ต้องใส่ ,"  value="<?php if($prev_info){ if($prev_info['ts4'] == '1'){ echo $prev_info['ts4_budget'];  } } ?>"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <fieldset class="mb-1">
                    <div class="checkbox checkbox-success">
                        <input type="checkbox" id="colorCheckbox6" <?php if($prev_info){ if($prev_info['ts5'] == '1'){ echo "checked"; }} ?>>
                        <label for="colorCheckbox6" class="text-dark">ทุนอื่น ๆ ภายนอกประเทศ&nbsp;<span class="text-danger"> * เช่น NIH WHO EU ฯลฯ</span></label>
                    </div>
                </fieldset>

                <div style="" id="fund6" class="<?php if($prev_info){ if($prev_info['ts5'] == '0'){ echo "dn"; }}else{ echo "dn"; } ?>">
                    <div class="card bg-light">
                        <div class="card-body text-dark">
                            <div class="row">
                                <div class="col-12 col-sm-3" style="padding-top: 8px;">จำนวนเงิน : <span class="text-danger">*</span></div>
                                <div class="col-12 col-sm-9"><input type="number" id="txtFund6" class="fundBuget form-control" placeholder="ระบุเฉพาะตัวเลข ไม่ต้องใส่ ,"  value="<?php if($prev_info){ if($prev_info['ts5'] == '1'){ echo $prev_info['ts5_budget'];  } } ?>"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="row form-group text-dark">
            <div class="col-5">3.3 ชื่อแหล่งทุนวิจัย <span class="text-danger">*</span></div>
            <div class="col-7">
                <textarea name="txtFundname" id="txtFundname" cols="30" rows="3" class="form-control" placeholder="กรอกชื่อแหล่งทุนวิจัย โดยแต่ละทุนให้คั่นด้วยเครื่องหมายคอมม่า (,)"><?php if($prev_info){ echo $prev_info['source_funds']; } ?></textarea>
            </div>
        </div>

        <div class="row form-group text-dark">
            <div class="col-5" style="padding-top: 5px;">3.4 งบประมาณทั้งโครงการ (บาท) <span class="text-danger">*</span></div>
            <div class="col-7">
                <input type="text" class="form-control" id="txtBudget" readonly value="<?php if($prev_info){ echo $prev_info['budget']; }else{  echo "0";  } ?>" placeholder="จำนวนเงินเกิดจากผลรวมยอดเงินจากแต่ละแหล่งทุนโดยอัตโนมัติ">
            </div>
        </div>
    </div>

    <hr>
    <div class="row">
        <div class="col-6">
            <button class="btn btn-primary btn-sm" onclick="window.location='research-register?stage=2&id_rs=<?php echo $id_rs; ?>'"><i class="bx bx-left-arrow-alt"></i> ไปส่วนที่ 2</button>
        </div>
        <div class="col-6 text-right">
            <button class="btn btn-primary btn-sm" onclick="research.save_path3()">ไปส่วนที่ 4 <i class="bx bx-right-arrow-alt"></i></button>
        </div>
    </div>

</div>