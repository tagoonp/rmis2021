<div class="row">
    <div class="col-12 col-sm-9"><h4 class="mb-0 text-dark">บันทึกกิจกรรมของโครงการวิจัยในช่วง Initial Review</h4></div>
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
                    $strSQL = "SELECT * FROM log_research WHERE id_rs = '$id_rs' ORDER BY log_datetime DESC";
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
                                <td style="vertical-align: top;"><?php echo $row['log_by']; ?></td>
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