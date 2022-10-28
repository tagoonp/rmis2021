// console.log($('#txtUid').val());
var authen = {
    login(){
        var param = {
            username: $('#txtUsername').val(),
            password: $('#txtPassword').val(),
            role: $('#txtRole').val()
        }
        console.log(param);
        var jxr = $.post(login_api + 'authen.php?stage=login', param, function(){}, 'json')
                   .always(function(snap){
                       console.log(snap);
                        if(snap.status == 'Already register'){
                            window.location = 'already-register?id=' + $('#txtUsername').val()
                        }else if(snap.status == 'Found by useraccount'){
                            window.localStorage.setItem(conf.prefix + 'uid', snap.uid)
                            window.localStorage.setItem(conf.prefix + 'role', $('#txtRole').val())

                            window.localStorage.setItem('rmis_current_user', snap.uid)
                            window.localStorage.setItem('rmis_current_role', $('#txtRole').val())
                            setTimeout(function(){
                                if($('#txtRole').val() == 'chairman'){
                                  window.location = controller + 'create_session?uid=' + snap.uid + '&role=' + $('#txtRole').val();
                                }else{
                                  window.location = controller + 'create_session?uid=' + snap.uid + '&role=' + $('#txtRole').val();
                                }
                              }, 2000)
                        }else if(snap.status == 'Found by personnel'){
                            window.location = 'personnel-register?id=' + $('#txtUsername').val();
                        }else{
                            preload.hide()
                            Swal.fire({
                                icon: "error",
                                title: 'ขออภัย',
                                text: "ไม่พบข้อมูลบัญชีผู้ใช้งานระบบ",
                                confirmButtonText: 'ลองใหม่',
                                confirmButtonClass: 'btn btn-danger',
                            })
                        }
                   })
    },
    update_profile(){
        $check = 0; $('.form-control').removeClass('is-invalid');
        if($('#txtPrefixTh').val() == ''){ $check++; $('#txtPrefixTh').addClass('is-invalid'); }
        if($('#txtFnameTh').val() == ''){ $check++; $('#txtFnameTh').addClass('is-invalid'); }
        if($('#txtLnameTh').val() == ''){ $check++; $('#txtLnameTh').addClass('is-invalid'); }

        if($('#txtPrefixEn').val() == ''){ $check++; $('#txtPrefixEn').addClass('is-invalid'); }
        if($('#txtFnameEn').val() == ''){ $check++; $('#txtFnameEn').addClass('is-invalid'); }
        if($('#txtLnameEn').val() == ''){ $check++; $('#txtLnameEn').addClass('is-invalid'); }

        if($('#txtPosition').val() == ''){ $check++; $('#txtPosition').addClass('is-invalid'); }
        if($('#txtDept').val() == ''){ $check++; $('#txtDept').addClass('is-invalid'); }

        if($('#txtDept').val() == '19'){
            if($('#txtOtherDeptTh').val() == ''){ $check++; $('#txtOtherDeptTh').addClass('is-invalid'); }
            if($('#txtOtherDeptEn').val() == ''){ $check++; $('#txtOtherDeptEn').addClass('is-invalid'); }
        }

        if($('#txtPosition').val() == '9'){
            if($('#txtPositionOther').val() == ''){ $check++; $('#txtPositionOther').addClass('is-invalid'); }
        }

        if($check != 0){
            return ;
        }

        var param = {
            uid: $('#txtUid').val(),
            sid: $('#txtSid').val(),
            prefix_th: $('#txtPrefixTh').val(),
            prefix_en: $('#txtPrefixEn').val(),
            fname_th: $('#txtFnameTh').val(),
            fname_en: $('#txtFnameEn').val(),
            lname_th: $('#txtLnameTh').val(),
            lname_en: $('#txtLnameEn').val(),
            position: $('#txtPosition').val(),
            position_other: $('#txtPositionOther').val(),
            dept: $('#txtDept').val(),
            dept_th: $('#txtOtherDeptTh').val(),
            dept_en: $('#txtOtherDeptEn').val(),
            exp: $('#txtExpertise').val(),
            ri: $('#txtRi').val()
        }

        preload.show()

        var jxr = $.post(api + 'authen?stage=updateprofile', param, function(){}, 'json')
                   .always(function(snap){
                       console.log(snap);
                        if(snap.status == 'Success'){
                            preload.hide()
                            Swal.fire({
                                title: 'ปรับปรุงข้อมูลสำเร็จ',
                                text: "กดปุ่ม -ตกลง- เพื่อทำการรีโหลดข้อมูล",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'ตกลง',
                                confirmButtonClass: 'btn btn-success',
                                buttonsStyling: false,
                            }).then(function (result) {
                                if (result.value) {
                                    window.location.reload()
                                }
                            })
                        }else{
                            preload.hide()
                            Swal.fire({
                                icon: "error",
                                title: 'เกิดข้อผิดพลาด!',
                                text: "ไม่สามารถดำเนินการได้ กรุณาลองใหม่อีกครั้ง หรือแจ้งเจ้าหน้าที่",
                                confirmButtonText: 'รับทราบ',
                                confirmButtonClass: 'btn btn-danger',
                            })
                        }
                   })


    },
    update_password(id){
        $check = 0; $('.form-control').removeClass('is-invalid');
        if($('#txtPassword0').val() == ''){ $check++; $('#txtPassword0').addClass('is-invalid'); }
        if($('#txtPassword1').val() == ''){ $check++; $('#txtPassword1').addClass('is-invalid'); }
        if($('#txtPassword2').val() == ''){ $check++; $('#txtPassword2').addClass('is-invalid'); }
        if($('#txtPassword1').val() != $('#txtPassword2').val()){
            $check++; $('#txtPassword2').addClass('is-invalid');
        }

        if($check != 0){
            return ;
        }

        var param = {
             uid: id,
             old_pwd: $('#txtPassword0').val(),
             new_pwd: $('#txtPassword1').val(),
             sid: $('#txtSid').val()
        }

        preload.show()

        var jxr = $.post(api + 'authen?stage=updatepassword', param, function(){}, 'json')
                   .always(function(snap){
                       console.log(snap);
                        if(snap.status == 'Success'){
                            preload.hide()
                            Swal.fire({
                                title: 'ปรับปรุงรหัสผ่านสำเร็จ',
                                text: "กดปุ่ม -ตกลง- เพื่อทำการรีโหลดข้อมูล",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'ตกลง',
                                confirmButtonClass: 'btn btn-success',
                                buttonsStyling: false,
                            }).then(function (result) {
                                if (result.value) {
                                    window.location.reload()
                                }
                            })
                        }else if(snap.status == 'invalidpwd'){
                            preload.hide()
                            Swal.fire({
                                icon: "error",
                                title: 'เกิดข้อผิดพลาด!',
                                text: "รหัสผ่านเดิมของท่านไม่ถูกต้อง",
                                confirmButtonText: 'ลองใหม่อีกครั้ง',
                                confirmButtonClass: 'btn btn-danger',
                            })
                        }else{
                            preload.hide()
                            Swal.fire({
                                icon: "error",
                                title: 'เกิดข้อผิดพลาด!',
                                text: "ไม่สามารถดำเนินการได้ กรุณาลองใหม่อีกครั้ง หรือแจ้งเจ้าหน้าที่",
                                confirmButtonText: 'รับทราบ',
                                confirmButtonClass: 'btn btn-danger',
                            })
                        }
                   })


    },
    updatePassword(){
        var param = {
            sid: $('#txtSid').val(),
            password: $('#txtPassword1').val()
        }

        preload.show()

        var jxr = $.post(api + 'authen?stage=resetpassword', param, function(){}, 'json')
                   .always(function(snap){
                       console.log(snap);
                       preload.hide()
                       if(snap.status == 'Success'){
                            Swal.fire({
                                title: 'ปรับปรุงข้อมูลสำเร็จ',
                                text: "รหัสผ่านของท่านถูกปรับปรุงเรียบร้อยแล้ว กดปุ่ม -ตกลง- เพื่อเข้าสู่ระบบ",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'ตกลง',
                                confirmButtonClass: 'btn btn-success',
                                buttonsStyling: false,
                            }).then(function (result) {
                                if (result.value) {
                                    window.location = './'
                                }
                            })
                       }else{
                            Swal.fire({
                                icon: "error",
                                title: 'เกิดข้อผิดพลาด!',
                                text: "ไม่สามารถดำเนินการได้ กรุณาลองใหม่อีกครั้ง หรือแจ้งเจ้าหน้าที่",
                                confirmButtonText: 'รับทราบ',
                                confirmButtonClass: 'btn btn-danger',
                            })
                       }
                   })
    },
    resetPassword(email){
        var param = {
            email: email
        }

        preload.show()

        var jxr = $.post(api + 'authen?stage=sendresetpasswordlink', param, function(){}, 'json')
                   .always(function(snap){
                       console.log(snap);
                       preload.hide()
                       if(snap.status == 'Success'){
                            Swal.fire({
                                icon: "success",
                                title: 'สำเร็จ',
                                text: "Reset password link ถูกส่งเรียบร้อยแล้ว!",
                                confirmButtonText: 'รับทราบ',
                                confirmButtonClass: 'btn btn-danger',
                            })
                       }else{
                            Swal.fire({
                                icon: "error",
                                title: 'เกิดข้อผิดพลาด!',
                                text: "ไม่สามารถดำเนินการได้ กรุณาลองใหม่อีกครั้ง หรือแจ้งเจ้าหน้าที่",
                                confirmButtonText: 'รับทราบ',
                                confirmButtonClass: 'btn btn-danger',
                            })
                       }
                   })
    },
    update_contact(){
        $check = 0; $('.form-control').removeClass('is-invalid');
        if($('#txtPhone').val() == ''){ $check++; $('#txtPhone').addClass('is-invalid'); }
        if($('#txtOffice').val() == ''){ $check++; $('#txtOffice').addClass('is-invalid'); }

        if($check != 0){
            return ;
        }

        var param = {
            uid: $('#txtUid').val(),
            sid: $('#txtSid').val(),
            phone: $('#txtPhone').val(),
            office: $('#txtOffice').val(),
            address: $('#txtAddress').val(),
            fax: $('#txtFax').val()
        }

        preload.show()

        var jxr = $.post(api + 'authen?stage=updatecontact', param, function(){}, 'json')
                   .always(function(snap){
                       console.log(snap);
                        if(snap.status == 'Success'){
                            preload.hide()
                            Swal.fire({
                                title: 'ปรับปรุงข้อมูลสำเร็จ',
                                text: "กดปุ่ม -ตกลง- เพื่อทำการรีโหลดข้อมูล",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'ตกลง',
                                confirmButtonClass: 'btn btn-success',
                                buttonsStyling: false,
                            }).then(function (result) {
                                if (result.value) {
                                    window.location.reload()
                                }
                            })
                        }else{
                            preload.hide()
                            Swal.fire({
                                icon: "error",
                                title: 'เกิดข้อผิดพลาด!',
                                text: "ไม่สามารถดำเนินการได้ กรุณาลองใหม่อีกครั้ง หรือแจ้งเจ้าหน้าที่",
                                confirmButtonText: 'รับทราบ',
                                confirmButtonClass: 'btn btn-danger',
                            })
                        }
                   })
    }
}

$(function(){
    $('#txtDept').change(function(){
        if($('#txtDept').val() == '19'){
            $('.other_dept').removeClass('dn')
        }else{
            $('.other_dept').addClass('dn')
            $('#txtOtherDeptTh').val('')
            $('#txtOtherDeptEn').val('')
        }
    })

    $('#txtPosition').change(function(){
        if($('#txtPosition').val() == '9'){
            $('.other_position').removeClass('dn')
        }else{
            $('.other_position').addClass('dn')
            $('#txtPositionOther').val('')
        }
    })

    
})

$(function(){

    $('#resetPasswordForm').submit(function(){
        $check = 0;
        $('.form-control').removeClass('is-invalid')
        if($('#txtUsername').val() == ''){
            $check++; $('#txtUsername').addClass('is-invalid')
        }

        if($check != 0){
            Swal.fire({
                icon: "error",
                title: 'ขออภัย',
                text: "กรุณากรอกข้อมูลอีเมลที่ท่านเคยสมัครใช้งานระบบ",
                confirmButtonText: 'รับทราบ',
                confirmButtonClass: 'btn btn-danger',
            })
            return ;
        }

        preload.show()
        authen.resetPassword($('#txtUsername').val())
    })

    $('#createPasswordForm').submit(function(){
        $check = 0;
        $('.form-control').removeClass('is-invalid')
        if($('#txtPassword1').val() == ''){
            $check++; $('#txtPassword1').addClass('is-invalid')
        }

        if($('#txtPassword1').val() == ''){
            $check++; $('#txtPassword2').addClass('is-invalid')
        }

        if($('#txtPassword1').val() != $('#txtPassword2').val()){
            $check++; $('#txtPassword2').addClass('is-invalid')
            Swal.fire({
                icon: "error",
                title: 'ขออภัย',
                text: "รหัสผ่านไม่ตรงกัน",
                confirmButtonText: 'ลองใหม่',
                confirmButtonClass: 'btn btn-danger',
            })
            return ;
        }

        if($check != 0){
            Swal.fire({
                icon: "error",
                title: 'ขออภัย',
                text: "กรุณากรอกข้อมูลให้ครบถ้วน!",
                confirmButtonText: 'รับทราบ',
                confirmButtonClass: 'btn btn-danger',
            })
            return ;
        }

        preload.show()
        authen.updatePassword()
    })

    $('#loginForm').submit(function(){
        $check = 0;
        $('.form-control').removeClass('is-invalid')
        if($('#txtUsername').val() == ''){
            $check++; $('#txtUsername').addClass('is-invalid')
        }
        if($('#txtPassword').val() == ''){
            $check++; $('#txtPassword').addClass('is-invalid')
        }

        if($check != 0){
            Swal.fire({
                icon: "error",
                title: 'ขออภัย',
                text: "กรุณากรอกข้อมูลให้ครบถ้วน!",
                confirmButtonText: 'รับทราบ',
                confirmButtonClass: 'btn btn-danger',
            })
            return ;
        }

        preload.show()
        authen.login()
    })
})