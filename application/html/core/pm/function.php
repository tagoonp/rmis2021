<?php
function checkProcessBtn1($conn, $uid, $role){
    $id_year = date('Y') - 2000;
    $strSQL = "SELECT * FROM research a INNER JOIN type_research b ON a.id_type  = b.id_type
          INNER JOIN type_status_research c ON a.id_status_research = c.id_status_research
          INNER JOIN type_personnel d ON a.id_personnel = d.id_personnel
          INNER JOIN dept e ON a.id_dept = e.id_dept
          INNER JOIN useraccount f ON a.id_pm = f.id_pm
          INNER JOIN userinfo  g ON f.id = g.user_id
          WHERE
            a.draft_status = '0'
            AND a.delete_flag = 'N'
            AND a.sendding_status = 'Y'
            AND a.research_status = 'new'
            AND f.delete_status = '0'
            AND a.id_year > '$id_year'
            AND (a.id_status_research = '1' OR a.id_status_research = '9')
            ORDER BY a.date_submit";
    $query = mysqli_query($conn, $strSQL);
    if(($query) && (mysqli_num_rows($query) > 0)){
        $nrow = mysqli_num_rows($query);
        echo '<button class="btn btn-warning btn-block text-left" onclick=gotoPage("rs-status-1?uid='.$uid.'&role='.$role.'")><i class="fas fa-bars"></i> ตรวจสอบความถูกต้องเอกสาร ('.$nrow.')</button>';
    }else{
        echo '<button class="btn btn-success btn-block text-left" onclick=gotoPage("rs-status-1?uid='.$uid.'&role='.$role.'")><i class="fas fa-bars"></i> ตรวจสอบความถูกต้องเอกสาร</button>';
    }
}

function checkProcessBtn2($conn, $uid, $role){
    $id_year = date('Y') - 2000;
    $strSQL = "SELECT * FROM research a INNER JOIN type_research b ON a.id_type  = b.id_type
          INNER JOIN type_status_research c ON a.id_status_research = c.id_status_research
          INNER JOIN type_personnel d ON a.id_personnel = d.id_personnel
          INNER JOIN dept e ON a.id_dept = e.id_dept
          INNER JOIN useraccount f ON a.id_pm = f.id_pm
          INNER JOIN userinfo  g ON f.id = g.user_id
          WHERE
            a.draft_status = '0'
            AND a.delete_flag = 'N'
            AND a.sendding_status = 'Y'
            AND a.research_status = 'new'
            AND f.delete_status = '0'
            AND a.id_year > '$id_year'
            AND (a.id_status_research = '2' OR a.id_status_research = '9' OR a.id_status_research = '20')
            ORDER BY a.date_submit";
    $query = mysqli_query($conn, $strSQL);
    if(($query) && (mysqli_num_rows($query) > 0)){
        $nrow = mysqli_num_rows($query);
        echo '<button class="btn btn-success btn-block text-left" onclick=gotoPage("rs-status-edit-list?uid='.$uid.'&role='.$role.'")><i class="fas fa-bars"></i> ตรวจสอบความถูกต้องเอกสาร ('.$nrow.')</button>';
    }else{
        echo '<button class="btn btn-success btn-block text-left" onclick=gotoPage("rs-status-edit-list?uid='.$uid.'&role='.$role.'")><i class="fas fa-bars"></i> ตรวจสอบความถูกต้องเอกสาร</button>';
    }
}

function checkProcessBtn3($conn, $uid, $role){
    // $strSQL = "SELECT * FROM research a INNER JOIN type_research b ON a.id_type  = b.id_type
    //       INNER JOIN type_status_research c ON a.id_status_research = c.id_status_research
    //       INNER JOIN type_personnel d ON a.id_personnel = d.id_personnel
    //       INNER JOIN dept e ON a.id_dept = e.id_dept
    //       INNER JOIN research_new_progress f ON a.id_rs = f.rwp_id_rs
    //       INNER JOIN useraccount g ON a.id_pm = g.id_pm
    //       INNER JOIN userinfo h ON g.id = h.user_id
    //       INNER JOIN research_consider_type i ON a.id_rs = i.rct_id_rs
    //       WHERE
    //         a.draft_status = '0'
    //         AND a.delete_flag = 'N'
    //         AND a.sendding_status = 'Y'
    //         AND g.delete_status = '0'
    //         AND a.id_status_research not in ('1', '5')
    //         AND a.code_apdu != ''
    //         AND f.rwp_status = '0'
    //         AND i.rct_type NOT IN ('Fullboard (Social)', 'Fullboard (Bio)') OR i.rct_type IS NULL
    //         ";
    $strSQL = "SELECT * FROM research a LEFT JOIN type_research b ON a.id_type  = b.id_type
              LEFT JOIN type_status_research c ON a.id_status_research = c.id_status_research
              LEFT JOIN type_personnel d ON a.id_personnel = d.id_personnel
              LEFT JOIN dept e ON a.id_dept = e.id_dept
              LEFT JOIN research_new_progress f ON a.id_rs = f.rwp_id_rs
              LEFT JOIN useraccount g ON a.id_pm = g.id_pm
              LEFT JOIN userinfo h ON g.id = h.user_id
              LEFT JOIN research_consider_type i ON a.id_rs = i.rct_id_rs
              WHERE
                a.draft_status = '0'
                AND a.delete_flag = 'N'
                AND a.sendding_status = 'Y'
                AND g.delete_status = '0'
                AND a.id_status_research not in ('1', '5')
                AND a.code_apdu != ''
                AND f.rwp_status = '0'
                AND (i.rct_type NOT IN ('Fullboard (Social)', 'Fullboard (Bio)') OR i.rct_type IS NULL OR i.rct_type IS NULL)";
    $query = mysqli_query($conn, $strSQL);
    if(($query) && (mysqli_num_rows($query) > 0)){
        $nrow = mysqli_num_rows($query);
        echo '<button class="btn btn-warning btn-block text-left" onclick=gotoPage("rs-status-wait-progress?uid='.$uid.'&role='.$role.'")><i class="fas fa-bars"></i> โครงการรอดำเนินการ ('.$nrow.')</button>';
    }else{
        echo '<button class="btn btn-success btn-block text-left" onclick=gotoPage("rs-status-wait-progress?uid='.$uid.'&role='.$role.'")><i class="fas fa-bars"></i> โครงการรอดำเนินการ</button>';
    }
}

function checkProcessBtn4($conn, $uid, $role){
    $id_year = date('Y') - 2000;
    $strSQL = "SELECT * FROM research a INNER JOIN type_research b ON a.id_type  = b.id_type
          INNER JOIN type_status_research c ON a.id_status_research = c.id_status_research
          INNER JOIN type_personnel d ON a.id_personnel = d.id_personnel
          INNER JOIN dept e ON a.id_dept = e.id_dept
          INNER JOIN research_new_progress f ON a.id_rs = f.rwp_id_rs
          INNER JOIN useraccount g ON a.id_pm = g.id_pm
          INNER JOIN userinfo h ON g.id = h.user_id
          INNER JOIN research_consider_type i ON a.id_rs = i.rct_id_rs
          WHERE
            a.draft_status = '0'
            AND a.delete_flag = 'N'
            AND a.sendding_status = 'Y'
            AND g.delete_status = '0'
            AND a.id_status_research not in ('1', '5')
            AND a.code_apdu != ''
            AND f.rwp_status = '0'
            AND a.id_year > '$id_year'
            AND i.rct_type IN ('Fullboard (Social)', 'Fullboard (Bio)')
            ";
    $query = mysqli_query($conn, $strSQL);
    if(($query) && (mysqli_num_rows($query) > 0)){
        $nrow = mysqli_num_rows($query);
        echo '<button class="btn btn-warning btn-block text-left" onclick=gotoPage("rs-status-wait-progress-fb?uid='.$uid.'&role='.$role.'")><i class="fas fa-bars"></i> โครงการ Fullboard รอดำเนินการ ('.$nrow.')</button>';
    }else{
        echo '<button class="btn btn-success btn-block text-left" onclick=gotoPage("rs-status-wait-progress-fb?uid='.$uid.'&role='.$role.'")><i class="fas fa-bars"></i> โครงการ Fullboard รอดำเนินการ</button>';
    }
}
?>
