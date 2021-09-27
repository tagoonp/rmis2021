$uid = $('#txtUid').val()
$role = $('#txtRole').val()

var user = {
    info(){
        var jxr = $.post(rmis_api + 'user?stage=profile', {uid: $uid, role: $role}, function(){}, 'json')
                   .always(function(snap){ 
                       if(snap.status == 'Success'){
                           $('.user-name').html(snap.data.fname + ' ' + snap.data.lname)
                           if($role == 'pm'){ $('.user-status').text('นักวิจัย') }
                           if($role == 'staff'){ $('.user-status').text('เจ้าหน้าที่') }
                           if($role == 'ec'){ $('.user-status').text('เลขา ec') }
                           if($role == 'reviewer'){ $('.user-status').text('ผู้เชี่ยวชาญอิสระ') }
                           if($role == 'chairman'){ $('.user-status').text('ประธานสำนักงาน') }
                       }else{

                       }
                    })
    }
}

user.info()