<div class="p-0 table-responsive">
                                    <table class="table table-striped mb-0 text-dark">
                                        <thead>
                                            <tr>
                                                <th style="font-size: 1em !important; width: 40px;" class="text-dark"></th>
                                                <th style="font-size: 1em !important; width: 250px;" class="text-dark">Report ID.</th>
                                                <th style="font-size: 1em !important; width: 200px;" class="text-dark">สถานะปัจจุบัน</th>
                                                <th style="font-size: 1em !important; width: 200px;" class="text-dark">วัน/เวลาที่ยื่น</th>
                                                <th style="font-size: 1em !important; width: 270px;" class="text-dark">วัน/เวลาที่รับรอง</th>
                                            </tr>
                                        </thead>
                                        <tbody class=" text-dark">
                                            <?php 
                                            $strSQL = "SELECT * FROM rec_progress a LEFT JOIN type_status_research b ON a.rp_progress_status = b.id_status_research 
                                            WHERE a.rp_id_rs = '$id_rs' AND a.rp_progress_id = 'closing' AND a.rp_delete_status = '0'";
                                            $res = $db->fetch($strSQL, true, true);
                                            if(($res) && ($res['count'] > 0)){
                                                foreach ($res['data'] as $row) {
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php 
                                                            if(($row['rp_progress_status'] == '0') || ($row['rp_progress_status'] == '2') || ($row['rp_progress_status'] == '20')){
                                                                ?>
                                                                <button class="btn  btn-success btn-icon text-white" style="padding-bottom: 10px;" onclick="window.location='progressform_<?php echo $row['rp_progress_id']; ?>_create?id_rs=<?php echo $id_rs;?>&session_id=<?php echo $row['rp_session'];?>'" data-toggle="tooltip" data-placement="top" title="แก้ไขรายงาน/ตอบข้อเสนอแนะ"><i class="bx bx-pencil"></i></button>
                                                                <?php
                                                            }else{
                                                                ?>
                                                                <button class="btn btn-icon btn-success text-white" style="padding-bottom: 10px;" onclick="window.location='progressform_<?php echo $row['rp_progress_id']; ?>_view?id_rs=<?php echo $id_rs;?>&session_id=<?php echo $row['rp_session'];?>'" data-toggle="tooltip" data-placement="top" title="ดูรายงาน"><i class="bx bx-search"></i></button>
                                                                <?php
                                                            }
                                                            ?>
                                                            
                                                            <?php 
                                                            $strSQL = "SELECT COUNT * cn FROM rec_ec_message WHERE msg_id_rs = '$id_rs' AND msg_session_id = '".$row['rp_progress_id']."' AND msg_read = '0'";
                                                            $resMsg = $db->fetch($strSQL, false, false);
                                                            if(($resMsg) && ($resMsg['cn'] > 0)){
                                                                ?>
                                                                <span class="badge badge-danger p-0" style="height:10px; width: 10px; position: fixed; margin-top: 0px; margin-left: -10px;">&nbsp;</span>
                                                                <?php
                                                            }
                                                            ?>
                                                            
                                                        </td>
                                                        <td class="text-dark"><?php echo $row['rp_progress_id']."-".$row['rp_session'];?></td>
                                                        <td class="text-dark">
                                                            <?php 
                                                            if($row['rp_sending_status'] == '0'){ echo '<span class="badge badge-danger round">'."ยังไม่ส่ง".'</span>'; }
                                                            else{
                                                                echo '<span class="badge badge-danger round">'.$row['status_name'].'</span>';

                                                                if(($resMsg) && ($resMsg['cn'] > 0)){
                                                                    ?>
                                                                    <span class="badge badge-danger round">มีข้อความจากสำนักงานที่ท่านยังไม่อ่าน</span>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </td>
                                                        <td><?php 
                                                        if($row['rp_sending_status'] == '0'){ echo "ฉบับร่าง"; }else{echo $row['rp_sending_datetime'];}?></td>
                                                        <td><?php 
                                                        if($row['rp_progress_status'] == '18'){
                                                            echo $row['rp_signdate'];
                                                        }else{ echo "-"; }
                                                        ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }else{
                                                ?>
                                                <tr>
                                                    <td colspan="5" class="text-center">ไม่พบรายงานปิดโครงการ</td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            
                                        </tbody>
                                    </table>
                                </div>