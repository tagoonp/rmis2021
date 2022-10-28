<div class="row">
    <div class="col-12 col-sm-9"><h4 class="mb-0 text-dark">บันทึกข้อความ</h4></div>
</div>

<div class="card bg-white">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="table-activity">
                <thead class="bg-secondary">
                    <th class="text-white col-2">วัน-เวลา</th>
                    <th class="text-white">กิจรรม</th>
                    <th class="text-white col-2">โดย</th>
                </thead>
                <tbody>
                    <?php 
                    $strSQL = "SELECT * FROM log_note a LEFT JOIN userinfo b ON a.log_by_id = b.user_id WHERE a.log_id_rs = '$id_rs' ORDER BY a.log_datetime DESC";
                    $res = $db->fetch($strSQL, true, true);
                    if(($res) && ($res['status'])){
                        foreach ($res['data'] as $row) {
                            ?>
                            <tr>
                                <td style="vertical-align: top;"><?php echo $row['log_datetime']; ?></td>
                                <td style="vertical-align: top;">
                                    <div>
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
                                <?php echo $row['fname']." ".$row['lname']; ?></td>
                            </tr>
                            <?php
                        }
                    }else{
                        ?>
                        <tr>
                            <td colspan="3" class="text-center">Note not found</td>
                        </tr>
                        <?php
                    }
                    ?>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>