<div class="row">
    <div class="col-12 col-sm-9"><h4 class="mb-0 text-dark">บันทึกกิจกรรมของโครงการวิจัยในช่วง Continuing Review</h4></div>
</div>

<div class="card bg-white">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="table-activity">
                <thead class="bg-secondary">
                    <th class="text-white col-2" >วัน-เวลา</th>
                    <th class="text-white">กิจรรม</th>
                    <th class="text-white col-2">โดย</th>
                </thead>
                <tbody>
                    <?php 
                    $strSQL = "SELECT * FROM rec_progress_log WHERE rpl_session IN (SELECT rp_session FROM rec_progress WHERE rp_id_rs = '$id_rs' AND rp_sending_status = '1' AND rp_delete_status = '0') ORDER BY rpl_datetime DESC";
                    $res = $db->fetch($strSQL, true, true);
                    if(($res) && ($res['status'])){
                        foreach ($res['data'] as $row) {
                            ?>
                            <tr>
                                <td style="vertical-align: top;"><?php echo $row['rpl_datetime']; ?></td>
                                <td style="vertical-align: top;">
                                    <div>
                                        <span class="badge badge-lighe-secondary"><?php echo $row['rpl_activity']; ?></span>
                                    </div>
                                    <?php echo $row['rpl_message']; ?>
                                </td>
                                <td style="vertical-align: top;"><?php echo $row['rpl_role']." : " .$row['rpl_uid']; ?></td>
                            </tr>
                            <?php
                        }
                    }else{
                        ?>
                        <tr>
                            <td colspan="3" class="text-center">Activity not found</td>
                        </tr>
                        <?php
                    }
                    ?>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>