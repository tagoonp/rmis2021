var approval = {
    updateSigntype($uid, $progress){
        $check = 0;
        $('.form-control').removeClass('is-invalid')
        if($('#txtSigntype').val() == ''){ $check++; $('#txtSigntype').addClass('is-invalid')}
        if($('#txtSigntype').val() == 'manual'){
            if($('#txtManualDate').val() == ''){
                $check++; $('#txtManualDate').addClass('is-invalid')
            }
        }
        if($check != 0){ return ;}

        var param = {
            id_rs: $('#txtIdrs').val(),
            session_id: $('#txtSessionid').val(),
            signtype: $('#txtSigntype').val(),
            signdate: $('#txtManualDate').val(),
            progress: $progress,
            uid: $uid
        }

        var jxr = $.post(api + 'admin?stage=update_signtype', param, function(){}, 'json')
                                   .always(function(snap){
                                       console.log(snap);
                                    //    return ;
                                       if(snap.status == 'Success'){
                                        preload.hide()
                                           $('#modalSigntype').modal('hide')
                                            if($('#txtSigntype').val() == 'manual'){
                                                $d = $('#txtManualDate').val().split('-')
                                                $('#textSigndate').text($d[2] + "/" + $d[1] + "/" + $d[0])
                                            }else if($('#txtSigntype').val() == 'ec'){
                                                $('#textSigndate').text('< Display after ec secretary confirmation >')
                                            }else{
                                                $('#textSigndate').text('< Display after chairman sign >')
                                            }
                                       }else{
                                            preload.hide()
                                            Swal.fire({
                                                icon: "error",
                                                title: 'เกิดข้อผิดพลาด!',
                                                text: 'ไม่สามารถแก้ไขข้อมูลได้',
                                                confirmButtonClass: 'btn btn-danger',
                                            })
                                       }
                                   })
    },
    assignMeeting(){
        $check = 0;
        $('.form-control').removeClass('is-invalid')

        if($('#txtMeeting').val() == ''){ $check++; $('#txtMeeting').addClass('is-invalid')}
        if($('#txtAganda').val() == ''){ $check++; $('#txtAganda').addClass('is-invalid')}
        if($('#txtDate').val() == ''){ $check++; $('#txtDate').addClass('is-invalid')}
        if($('#txtMonth').val() == ''){ $check++; $('#txtMonth').addClass('is-invalid')}
        if($('#txtYear').val() == ''){ $check++; $('#txtYear').addClass('is-invalid')}

        if($check != 0){ return ;}

        var param = {
            uid: $('#txtUid').val(),
            id_rs: $('#txtIdrs').val(),
            session_id: $('#txtSessionId').val(),
            meeting: $('#txtMeeting').val(),
            agenda: $('#txtAganda').val(),
            datemeeting: $('#txtYear').val() + '-' + $('#txtMonth').val() + '-' + $('#txtDate').val()
        }

        preload.show()
        console.log(param);
        // return ;

        var jxr = $.post(api + 'admin?stage=assign_meeting', param, function(){}, 'json')
                                   .always(function(snap){
                                    //    console.log(snap);
                                    //    return ;
                                       if(snap.status == 'Success'){
                                            // window.location.reload()

                                            preload.hide()
                                            Swal.fire({
                                                title: 'ส่งสำเร็จ',
                                                text: "บันจุเข้าที่ประชุมเรียบร้อยแล้ว",
                                                icon: 'success',
                                                showCancelButton: false,
                                                confirmButtonColor: '#3085d6',
                                                cancelButtonColor: '#d33',
                                                confirmButtonText: 'กลับหน้าหลัก',
                                                confirmButtonClass: 'btn btn-success',
                                                buttonsStyling: false,
                                            }).then(function (result) {
                                                if (result.value) {
                                                    window.location = './'
                                                }
                                            })

                                       }else{
                                            preload.hide()
                                            Swal.fire({
                                                icon: "error",
                                                title: 'เกิดข้อผิดพลาด!',
                                                text: 'ไม่สามารถแก้ไขข้อมูลได้',
                                                confirmButtonClass: 'btn btn-danger',
                                            })
                                       }
                                   })
    },
    updateMeeting(){
        $check = 0;
        $('.form-control').removeClass('is-invalid')

        if($('#txtMeeting').val() == ''){ $check++; $('#txtMeeting').addClass('is-invalid')}
        if($('#txtAganda').val() == ''){ $check++; $('#txtAganda').addClass('is-invalid')}
        if($('#txtDate').val() == ''){ $check++; $('#txtDate').addClass('is-invalid')}
        if($('#txtMonth').val() == ''){ $check++; $('#txtMonth').addClass('is-invalid')}
        if($('#txtYear').val() == ''){ $check++; $('#txtYear').addClass('is-invalid')}

        if($check != 0){ return ;}

        var param = {
            id_rs: $('#txtIdrs').val(),
            session_id: $('#txtSessionid').val(),
            meeting: $('#txtMeeting').val(),
            agenda: $('#txtAganda').val(),
            datemeeting: $('#txtYear').val() + '-' + $('#txtMonth').val() + '-' + $('#txtDate').val()
        }

        preload.show()
        console.log(param);
        // return;

        var jxr = $.post(api + 'admin?stage=update_meeting', param, function(){}, 'json')
                                   .always(function(snap){
                                       if(snap.status == 'Success'){
                                            window.location.reload()
                                       }else{
                                            preload.hide()
                                            Swal.fire({
                                                icon: "error",
                                                title: 'เกิดข้อผิดพลาด!',
                                                text: 'ไม่สามารถแก้ไขข้อมูลได้',
                                                confirmButtonClass: 'btn btn-danger',
                                            })
                                       }
                                   })
    },
    updatePi(){

        $check = 0;
        $('.form-control').removeClass('is-invalid')

        if($('#txtDept').val() == '19'){
            if(($('#txtDeptTh').val() == '') || ($('#txtDeptEn').val() == '')){
                if($('#txtDeptTh').val() == ''){ $('#txtDeptTh').addClass('is-invalid') }
                if($('#txtDeptEn').val() == ''){ $('#txtDeptEn').addClass('is-invalid') }
                $check++;
                return ;
            }
        }

        if($('#txtFnameEn').val() == ''){ $check++; $('#txtFnameEn').addClass('is-invalid')}
        if($('#txtLnameEn').val() == ''){ $check++; $('#txtLnameEn').addClass('is-invalid')}
        if($('#txtDept').val() == ''){ $check++; $('#txtDept').addClass('is-invalid')}

        if($check != 0){ return ;}
        
        var param = {
            user_id: $('#txtAccountId').val(),
            fname_en: $('#txtFnameEn').val(),
            lname_en: $('#txtLnameEn').val(),
            dept: $('#txtDept').val(),
            dept_th: $('#txtDeptTh').val(),
            dept_en: $('#txtDeptEn').val()
        }

        preload.show()
        console.log(param);

        var jxr = $.post(api + 'admin?stage=update_pi_info_by_doc', param, function(){}, 'json')
                                   .always(function(snap){
                                       console.log(snap);
                                       if(snap.status == 'Success'){
                                            window.location.reload()
                                       }else{
                                            preload.hide()
                                            Swal.fire({
                                                icon: "error",
                                                title: 'เกิดข้อผิดพลาด!',
                                                text: 'ไม่สามารถแก้ไขข้อมูลได้',
                                                confirmButtonClass: 'btn btn-danger',
                                            })
                                       }
                                   })
    },
    updateResearch(){
        $check = 0;
        $('.form-control').removeClass('is-invalid')

        if($('#txtTitleTh').val() == ''){ $check++; $('#txtTitleTh').addClass('is-invalid')}
        if($('#txtTitleEn').val() == ''){ $check++; $('#txtTitleEn').addClass('is-invalid')}

        if($check != 0){ return ;}
        
        var param = {
            id_rs: $('#txtIdrs').val(),
            title_th: $('#txtTitleTh').val(),
            title_en: $('#txtTitleEn').val(),
            protocol_no: $('#txtProtocol').val()
        }

        preload.show()
        console.log(param);

        var jxr = $.post(api + 'admin?stage=update_research_info_by_doc', param, function(){}, 'json')
                                   .always(function(snap){
                                       console.log(snap);
                                       if(snap.status == 'Success'){
                                            window.location.reload()
                                       }else{
                                            preload.hide()
                                            Swal.fire({
                                                icon: "error",
                                                title: 'เกิดข้อผิดพลาด!',
                                                text: 'ไม่สามารถแก้ไขข้อมูลได้',
                                                confirmButtonClass: 'btn btn-danger',
                                            })
                                       }
                                   })
    },
    sendTocheck($progress){

        $('.form-control').removeClass('is-invalid')
        $check = 0;

        if($('#textSigndate').text() == '-'){
            $check++;
        }

        if($('#txtEc').val() == ''){
            $('#txtEc').addClass('is-invalid')
            $check++;
        }

        if($check != 0){
            Swal.fire({
                icon: "warning",
                title: 'คำเตือน',
                text: 'กรุณาเลือกวันที่ลงนาม และเลขาตรวจใบรับรอง',
                confirmButtonClass: 'btn btn-danger',
            })
            return ;
        }

        Swal.fire({
            title: 'คำเตือน',
            text: "หากส่งเลขาแล้วจะไม่นำกลับมาได้อีก",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ยืนยันส่ง',
            cancelButtonText: 'ยกเลิก',
            confirmButtonClass: 'btn btn-danger mr-1',
            cancelButtonClass: 'btn btn-secondary',
            buttonsStyling: false,
        }).then(function (result) {
            if (result.value) {
                preload.show();
                var param = {
                    uid: $('#txtUid').val(),
                    role: $('#txtRole').val(),
                    id_rs: $('#txtIdrs').val(),
                    session_id: $('#txtSessionid').val(),
                    doc_content: editor_doclist.getData(),
                    progress: $progress,
                    ec: $('#txtEc').val()
                }
                var jxr = $.post(api + 'admin?stage=send_approval_check', param, function(){}, 'json')
                                   .always(function(snap){
                                       console.log(snap);
                                       if(snap.status == 'Success'){
                                            preload.hide()
                                            Swal.fire({
                                                title: 'ส่งสำเร็จ',
                                                text: "เอกสารใบรับรอง/รับทราบนี้ถูกส่งไปยังประธานเรียบร้อยแล้ว",
                                                icon: 'success',
                                                showCancelButton: false,
                                                confirmButtonColor: '#3085d6',
                                                cancelButtonColor: '#d33',
                                                confirmButtonText: 'กลับหน้าหลัก',
                                                confirmButtonClass: 'btn btn-success',
                                                buttonsStyling: false,
                                            }).then(function (result) {
                                                if (result.value) {
                                                    window.location = './'
                                                }
                                            })
                                       }else{
                                            preload.hide()
                                            Swal.fire({
                                                icon: "error",
                                                title: 'เกิดข้อผิดพลาด!',
                                                text: 'ไม่สามารถส่งข้อมูลได้',
                                                confirmButtonClass: 'btn btn-danger',
                                            })
                                       }
                                   })
            }
        })
    },
    sendToSign($progress){
        $('.form-control').removeClass('is-invalid')
        $check = 0;

        if($('#textSigndate').text() == '-'){
            $check++;
        }

        if($check != 0){
            Swal.fire({
                icon: "warning",
                title: 'คำเตือน',
                text: 'กรุณาเลือกวันที่ลงนาม',
                confirmButtonClass: 'btn btn-danger',
            })
            return ;
        }

        Swal.fire({
            title: 'คำเตือน',
            text: "หากส่งประธานแล้วจะไม่นำกลับมาได้อีก",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ยืนยันส่ง',
            cancelButtonText: 'ยกเลิก',
            confirmButtonClass: 'btn btn-danger mr-1',
            cancelButtonClass: 'btn btn-secondary',
            buttonsStyling: false,
        }).then(function (result) {
            if (result.value) {
                preload.show();
                var param = {
                    uid: $('#txtUid').val(),
                    role: $('#txtRole').val(),
                    id_rs: $('#txtIdrs').val(),
                    session_id: $('#txtSessionid').val(),
                    doc_content: editor_doclist.getData(),
                    progress: $progress
                }
                console.log(param);
                var jxr = $.post(api + 'admin?stage=send_approval_sign', param, function(){}, 'json')
                                   .always(function(snap){
                                       console.log(snap);
                                       if(snap.status == 'Success'){
                                            preload.hide()
                                            Swal.fire({
                                                title: 'ส่งสำเร็จ',
                                                text: "เอกสารใบรับรอง/รับทราบนี้ถูกส่งไปยังเลขาเรียบร้อยแล้ว",
                                                icon: 'success',
                                                showCancelButton: false,
                                                confirmButtonColor: '#3085d6',
                                                cancelButtonColor: '#d33',
                                                confirmButtonText: 'กลับหน้าหลัก',
                                                confirmButtonClass: 'btn btn-success',
                                                buttonsStyling: false,
                                            }).then(function (result) {
                                                if (result.value) {
                                                    window.location = './'
                                                }
                                            })
                                       }else{
                                            preload.hide()
                                            Swal.fire({
                                                icon: "error",
                                                title: 'เกิดข้อผิดพลาด!',
                                                text: 'ไม่สามารถส่งข้อมูลได้',
                                                confirmButtonClass: 'btn btn-danger',
                                            })
                                       }
                                   })
            }
        })
    }
}

$(function(){
    $('#txtDept').change(function(){
        if($('#txtDept').val() == '19'){
            $('.extDept').removeClass('dn')
        }else{
            $('.extDept').addClass('dn')
            $('#txtDeptTh').val('')
            $('#txtDeptEn').val('')
        }
    })
})