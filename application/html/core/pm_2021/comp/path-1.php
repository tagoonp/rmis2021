<div class="pt-2">
    <div class="row form-group text-dark">
        <div class="col-12 col-sm-12">1.1 ชื่อโครงการวิจัย <small>(ภาษาไทย)</small> <span class="text-danger">*</span><div></div></div>
        <div class="col-12 col-sm-12">
            <div class="form-group">
                <textarea name="txtTitleTh" id="txtTitleTh" cols="30" rows="4" class="form-control"><?php if($prev_info){ echo $prev_info['title_th']; } ?></textarea>
                <div style="padding-top: 4px;">
                    <small class="text-muted">
                    Note : Enter - if this project no have title in Thai language.
                    </small>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-12">1.2 Project title <small>(English)</small> <span class="text-danger">*</span></div>
        <div class="col-12 col-sm-12">
            <div class="form-group">
                <textarea name="txtTitleEn" id="txtTitleEn" cols="30" rows="4" class="form-control"><?php if($prev_info){ echo $prev_info['title_en']; } ?></textarea>
                <div style="padding-top: 4px;">
                    <small class="text-muted">
                    Note : Enter project title in English.
                    </small>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-5">1.3 คำสำคัญ <span class="text-danger">*</span><div><small>(ภาษาไทย)</small></div></div>
        <div class="col-12 col-sm-7">
            <div class="form-group">
                <input type="text" id="txtKeywordTh" class="form-control" value="<?php if($prev_info){ echo $prev_info['keywords_th']; } ?>">
                <div style="padding-top: 4px;">
                    <small class="text-muted">
                    Note : กรอกคำสำคัญ 2 - 5 คำ (ภาษาไทย) โดยแต่ละคำให้คั่นด้วยเครื่องหมายคอมม่า (,) เช่น คำที่ 1, คำที่ 2, คำที่ 3 | Enter (-) if this project no keywords in Thai.
                    </small>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-5">1.4 Keywords <span class="text-danger">*</span><div><small>(English)</small></div></div>
        <div class="col-12 col-sm-7">
            <div class="form-group">
                <input type="text" id="txtKeywordEn" class="form-control" value="<?php if($prev_info){ echo $prev_info['keywords_en']; } ?>">
                <div style="padding-top: 4px;">
                    <small class="text-muted">
                    Note : Enter 2 - 5 keywors and each word separated by comma (,) for example: keyword1, keyword2, keyword3
                    </small>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-5">1.5 ประเภทของการวิจัย <span class="text-danger">*</span><div><small>(Type of research)</small></div></div>
        <div class="col-12 col-sm-7">
            <div class="form-group">
                <select class="form-control" name="txtResearchtype" id="txtResearchtype">
                    <option value=""> -- เลือกประเภทการวิจัย --</option>
                    <?php
                    $strSQL = "SELECT * FROM type_research WHERE 1 ORDER BY rt_seq";
                    $resultRT = $db->fetch($strSQL, true, false);
                    if(($resultRT) && ($resultRT['status'])){
                        foreach ($resultRT['data'] as $r) {
                            ?>
                            <option value="<?php echo $r['id_type'];?>" <?php if($prev_info){ if($prev_info['id_type'] == $r['id_type']){ echo "selected"; } } ?>><?php echo $r['type_name'];?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="col-12 col-sm-5">1.6 วันที่คาดว่าจะดำเนินโครงการ <span class="text-danger">*</span><div><small>(Estimate date to start and finish project)</small></div></div>
        <div class="col-12 col-sm-7">
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <select class="form-control" name="txtStartDate" id="txtStartDate">
                            <option value=""> -- Date --</option>
                            <?php
                                for ($i=1; $i <= 31; $i++) { 
                                $j = $i;
                                if($i < 10){
                                    $j = '0'.$j;
                                }

                                $sd = '';
                                $sm = '';
                                $sy = '';
                                if($prev_info){ 
                                    $b = explode("-", $prev_info['start_date']);
                                    if(sizeof($b) > 1){
                                        $sd = $b[2];
                                        $sm = $b[1];
                                        $sy = $b[0];
                                    }
                                }
                                ?>
                                <option value="<?php echo $j;?>" <?php if($prev_info){ if($sd == $j){ echo "selected"; } } ?>><?php echo $j;?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <select class="form-control" name="txtStartMonth" id="txtStartMonth">
                            <option value=""> -- Month --</option>
                            <?php
                            for ($i=1; $i <= 12; $i++) { 
                                $j = $i;
                                if($i < 10){
                                    $j = '0'.$j;
                                }
                                ?>
                                <option value="<?php echo $j;?>" <?php if($prev_info){ if($sm == $j){ echo "selected"; } } ?>><?php echo $j;?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <select class="form-control" name="txtStartYear" id="txtStartYear">
                            <option value=""> -- Year --</option>
                            <?php
                            for ($i=$year; $i < $year+2; $i++) { 
                                ?>
                                <option value="<?php echo $i;?>" <?php if($prev_info){ if($sy == $i){ echo "selected"; } } ?>><?php echo $i;?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-5">1.7 วันที่คาดว่าโครงการสิ้นสุด <span class="text-danger">*</span><div><small>(Estimate date that project will be finish)</small></div></div>
        <div class="col-12 col-sm-7">
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <select class="form-control" name="txtFinishDate" id="txtFinishDate">
                            <option value=""> -- Date --</option>
                            <?php

                            if($prev_info){ 
                                $b = explode("-", $prev_info['finish_date']);
                                if(sizeof($b) > 1){
                                    $ed = $b[2];
                                    $em = $b[1];
                                    $ey = $b[0];
                                }
                            }

                            for ($i=1; $i <= 31; $i++) { 
                                $j = $i;
                                if($i < 10){
                                    $j = '0'.$j;
                                }
                                ?>
                                <option value="<?php echo $j;?>" <?php if($prev_info){ if($ed == $j){ echo "selected"; } } ?>><?php echo $j;?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <select class="form-control" name="txtFinishMonth" id="txtFinishMonth">
                            <option value=""> -- Month --</option>
                            <?php
                            for ($i=1; $i <= 12; $i++) { 
                                $j = $i;
                                if($i < 10){
                                    $j = '0'.$j;
                                }
                                ?>
                                <option value="<?php echo $j;?>" <?php if($prev_info){ if($em == $j){ echo "selected"; } } ?>><?php echo $j;?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <select class="form-control" name="txtFinishYear" id="txtFinishYear">
                            <option value=""> -- Year --</option>
                            <?php
                            for ($i=$year; $i < $year+10; $i++) { 
                                ?>
                                <option value="<?php echo $i;?>"<?php if($prev_info){ if($ey == $i){ echo "selected"; } } ?>><?php echo $i;?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <hr>
    <div class="row">
        <div class="col-6">

        </div>
        <div class="col-6 text-right">
            <button class="btn btn-primary btn-sm" onclick="research.save_path1()">บันทึกและไปส่วนที่ 2 <i class="bx bx-right-arrow-alt"></i></button>
        </div>
    </div>

</div>