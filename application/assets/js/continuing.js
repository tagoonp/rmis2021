var comment_1 = null
if($('#txtCommentCheckDoc').length){
    comment_1 = CKEDITOR.replace( 'txtCommentCheckDoc', {
        wordcount : {
        showCharCount : false,
        showWordCount : true
        },
        height: '300px'
    });
}

var comment_20 = null
if($('#txtComment20').length){
    comment_20 = CKEDITOR.replace( 'txtComment20', {
        wordcount : {
        showCharCount : false,
        showWordCount : true
        },
        height: '300px'
    });
}


var staffNote = null
if($('#txtNote').length){
    staffNote = CKEDITOR.replace( 'txtNote', {
        wordcount : {
        showCharCount : false,
        showWordCount : true
        },
        height: '100px'
    });
}

var ecnoteToAnserComment = null
if($('#txtMessage20').length){
    ecnoteToAnserComment = CKEDITOR.replace( 'txtMessage20', {
        wordcount : {
        showCharCount : false,
        showWordCount : true
        },
        height: '200px'
    });
}

$(function(){
    $('#txtNextOperation').change(function(){
        if($('#txtNextOperation').val() == '3'){
            $('#textReplyto').text('นักวิจัย')
        }else{
            $('#textReplyto').text('เจ้าหน้าที่')
        }
    })
})

var progress = {
    return_1(){
        $check = 0
        $('.form-control').removeClass('is-invalid')
        if($('#txtReturn_1').val() == ''){
            $check++;
            $('#txtReturn_1').addClass('is-invalid')
        }
        if(comment_1.getData() == ''){
            $check++;
        }
        if($check != 0){
            Swal.fire({
                icon: "error",
                title: 'คำเตือน',
                text: 'กรุณากรอกข้อมูลให้ครบถ้วน',
                confirmButtonClass: 'btn btn-danger',
            })
            return ;
        }

        Swal.fire({
            title: 'คำเตือน',
            text: "หากมีการปรับปรุงข้อมูลในแบบฟอร์ม ให้กดปุ่มบันทึกการปรับปรุงข้อมูลก่อน",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ตรวจสอบแล้วและยืนยันดำเนินการต่อ',
            cancelButtonText: 'กลับไปตรวจสอบ',
            confirmButtonClass: 'btn btn-danger mb-1 btn-block',
            cancelButtonClass: 'btn btn-secondary btn-block',
            buttonsStyling: false,
        }).then(function (result) {
            if (result.value) {
                var param = {
                    id_rs: $('#txtResearchId').val(),
                    session_id: $('#txtSessionId').val(),
                    uid: $('#txtUid').val(),
                    role: $('#txtRole').val(),
                    comment: comment_1.getData(),
                    result: $('#txtReturn_1').val(),
                    progress: $('#txtProgress').val()
                }

                // console.log(param);
                preload.show()
                // return ;
        
                var jxr = $.post(api + 'progress?stage=result_stage1', param, function(){}, 'json')
                           .always(function(snap){
                               console.log(snap);
                                if(snap.status == 'Fail'){
                                    preload.hide()
                                    Swal.fire({
                                        icon: "error",
                                        title: 'เกิดข้อผิดพลาด',
                                        text: 'ไม่สามารถดำเนินการได้',
                                        confirmButtonClass: 'btn btn-danger',
                                    })
                                    return ;
                                }else{
                                    preload.hide()
                                    Swal.fire({
                                        title: 'ดำเนินการสำเร็จ',
                                        text: "กรุณากด ตกลง เพื่อกลับสู่หน้าหลัก",
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
                                }
                            })
        
                // if($('#txtReturn_1').val() == '1') // ส่งกลับนักวิจัย
            }
        })
        
    },
    return_after_check_comment(){
        $check = 0;
        $('#form-control').removeClass('is-invalid')

        if($('#txtNextOperation').val() == ''){
            $('#txtNextOperation').addClass('is-invalid')
            $check++;
        }

        if(ecnoteToAnserComment.getData() == ''){
            $check++;
        }

        if($check != 0){
            Swal.fire({
                icon: "error",
                title: 'คำเตือน',
                text: 'กรุณากรอกข้อมูลให้ครบถ้วน',
                confirmButtonClass: 'btn btn-danger',
            })
            return ;
        }

        $warning_msg = 'ท่านยืนยันการส่งข้อมูลยังเจ้าหน้าที่เพื่อนำเข้าที่ประชุมหรือไม่?';
        if($('#txtNextOperation').val() == '3'){
            $warning_msg = 'ท่านยืนยันการส่งข้อมูลไปยังนักวิจัยเพื่อตอบข้อคำถาม/ข้อเสนอแนะหรือไม่?';
        }

        Swal.fire({
            title: 'ยืนยันดำเนินการ',
            text: $warning_msg,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ยืนยัน',
            cancelButtonText: 'ยกเลิก',
            confirmButtonClass: 'btn btn-danger mr-1',
            cancelButtonClass: 'btn btn-secondary',
            buttonsStyling: false,
        }).then(function (result) {
            if (result.value) {
                var param = {
                    uid: $('#txtUid').val(),
                    role: $('#txtRole').val(),
                    message: ecnoteToAnserComment.getData(),
                    return_choice: $('#txtNextOperation').val(),
                    id_rs: $('#txtPid').val(),
                    session_id: $('#txtSessionID').val()
                }
                if($('#txtNextOperation').val() == '3'){
                    // ส่งนักวิจัยตอบข้อเสนอแนะ 
                    var jxr = $.post(api + 'progress?stage=result_to_20_withcomment', param, function(){}, 'json')
                    .always(function(snap){
                        console.log(snap);
                        preload.hide()
                        if(snap.status == 'Success'){
                            Swal.fire({
                                title: 'สำเร็จ',
                                text: 'ข้อมูลถูกส่งไปยังนักวิจัยเรียบร้อยแล้ว',
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
                            Swal.fire({
                                icon: "error",
                                title: 'เกิดข้อผิดพลาด',
                                text: 'ไม่สามารถดำเนินการได้',
                                confirmButtonClass: 'btn btn-danger',
                            })
                            return ; 
                        }
                    })
                }else if($('#txtNextOperation').val() == '4'){
                    // ส่งเจ้าหน้าที่ส่ง reiewer
                    var jxr = $.post(api + 'progress?stage=result_to_4', param, function(){}, 'json')
                    .always(function(snap){
                        console.log(snap);
                    })
                }else{
                    // ส่งเจ้าหน้าที่บรรจุวาระ
                    var jxr = $.post(api + 'progress?stage=result_to_15', param, function(){}, 'json')
                    .always(function(snap){
                        console.log(snap);
                    })
                }
            }
        })

    },
    return_pi_answer_comment(){
        if(ecnoteToAnserComment.getData() == ''){
            Swal.fire({
                icon: "error",
                title: 'คำเตือน',
                text: 'กรุณากรอกข้อมูลเพื่อส่งถึงนักวิจัย',
                confirmButtonClass: 'btn btn-danger',
            })
            return ; 
        }
    },
    return_20(){ // ส่งนักวิจัยเพ่ือดำเนินการอื่น ๆ
        $check = 0
        $('.form-control').removeClass('is-invalid')
        
        if(comment_20.getData() == ''){
            Swal.fire({
                icon: "error",
                title: 'คำเตือน',
                text: 'กรุณากรอกข้อมูลให้ครบถ้วน',
                confirmButtonClass: 'btn btn-danger',
            })
            return ;
        }
        var param = {
            uid: $('#txtUid').val(),
            role: $('#txtRole').val(),
            id_rs: $('#txtPid').val(),
            session_id: $('#txtSessionID').val(),
            message: comment_20.getData()
        }
        preload.show()
        var jxr = $.post(api + 'progress?stage=set_status_20', param, function(){}, 'json')
                           .always(function(snap){
                                console.log(snap);
                                preload.hide()
                                if(snap.status == 'Success'){
                                    Swal.fire({
                                        title: 'ดำเนินการสำเร็จ',
                                        text: "ข้อมูลถูกส่งไปยังนักวิจัยเรียบร้อยแล้ว",
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
                                    return ;
                                }else{
                                    preload.hide()
                                    Swal.fire({
                                        icon: "error",
                                        title: 'เกิดข้อผิดพลาด',
                                        text: 'ไม่สามารถดำเนินการได้',
                                        confirmButtonClass: 'btn btn-danger',
                                    })
                                }
                            })
    }
}

function showEcMessage(id_rs, session_id){
    $('#ec_msg_list').html('<tr><td class="text-center"><i class="bx bx-sync bx-spin text-primary" style="font-size: 3.5em;"></i></td></tr>')
    $('#modalEcMessage').modal()
    var param = {id_rs: id_rs, session_id: session_id}
    console.log(param);
    var jxr = $.post(api + 'progress?stage=get_ec_message', param, function(){}, 'json')
               .always(function(snap){
                   if(snap.status == 'Fail'){
                        $('#ec_msg_list').html('<tr><td class="text-center">ไม่พบข้อความจากสำนักงาน ฯ</td></tr>')
                   }else{
                        $check_unread = 0;
                        snap.data.forEach(element => {
                            if(element.msg_read == '0'){
                                $check_unread++
                            }
                            if($check_unread != 0){

                            }
                        });
                   }
               })
}

function openForm(form, id_rs, session_id){
    console.log(id_rs, session_id);
    window.location = 'progressform_' + form + '?id_rs=' + id_rs + '&session_id=' + session_id
}

function openCommandModal(modalName, param1){
    $('#' + modalName).modal()
    if(modalName == 'modalStep1'){
        $('#txtReturn_1').val(param1)
        setTimeout(() => {
            $('#txtCommentCheckDoc').focus()
        }, 500);
    }
}

function deleteFile(uid, file_id, session_id, id_rs){
    var param = {
        uid: uid,
        file_id: file_id,
        session_id: session_id,
        id_rs: id_rs
    }

    Swal.fire({
        title: 'คำเตือน',
        text: "หากลบไฟล์นี้แล้วจะไม่สามารถนำกลับมาได้อีก",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ลบ',
        cancelButtonText: 'ยกเลิก',
        confirmButtonClass: 'btn btn-danger mr-1',
        cancelButtonClass: 'btn btn-secondary',
        buttonsStyling: false,
    }).then(function (result) {
        if (result.value) {
            preload.show()
            console.log(param);
        }
    })
}

function openChat(){
    Swal.fire({
        title: 'ขออภัย',
        text: "ฟังก์ชันนี้ยังไม่เปิดให้ใช้งาน",
        icon: 'warning',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ปิด',
        cancelButtonText: 'ยกเลิก',
        confirmButtonClass: 'btn btn-danger',
        cancelButtonClass: 'btn btn-secondary',
        buttonsStyling: false,
    }).then(function (result) {
        if (result.value) {
            
        }
    })
}

function openNoteModal(){
    $('#noteModal').modal()
}

function saveContNote(){
    if(staffNote.getData() == ''){
        Swal.fire({
            icon: "warning",
            title: 'คำเตือน',
            text: 'กรุุณากรอกข้อความหรือบันทึกก่อน',
            confirmButtonClass: 'btn btn-danger',
        })
        return ;
    }
    var param = {
        uid: $('#txtUid').val(),
        role: $('#txtRole').val(),
        id_rs: $('#txtResearchId').val(),
        session_id: $('#txtSessionId').val(),
        count_range: $('#txtCount').val(),
        msg: staffNote.getData()
    }
    preload.show()
    var jxr = $.post(api + 'note?stage=save_cont_note', param, function(){}, 'json')
                           .always(function(snap){
                                refreshContNote()
                           })

}

function refreshContNote(){
    var param = {
        id_rs: $('#txtResearchId').val()
    }
    var jxr = $.post(api + 'note?stage=get_note', param, function(){}, 'json')
                           .always(function(snap){
                                $('#noteList').empty()
                                if(snap.status == 'Success'){
                                    snap.data.forEach(i => {
                                        $role = '<span class="badge badge-primary round">PI</span>'
                                        if((i.log_by_role == 'pi') || (i.log_by_role == 'pm')){
                                            $role = '<span class="badge badge-primary round">PI</span>'
                                        }else if(i.log_by_role == 'staff'){
                                            $role = '<span class="badge badge-success round">Staff</span>'
                                        }else if(i.log_by_role == 'ec'){
                                            $role = '<span class="badge badge-warning round">EC</span>'
                                        }else if(i.log_by_role == 'reviewer'){
                                            $role = '<span class="badge badge-secondary round">Reviewer</span>'
                                        }else if(i.log_by_role == 'chairman'){
                                            $role = '<span class="badge badge-danger round">Chairman</span>'
                                        }
                                        $data = '<tr>' + 
                                                    '<td style="vertical-align: top;">' + i.log_datetime + '</td>' + 
                                                    '<td style="vertical-align: top;">' + 
                                                        '<div>' +
                                                            '<span class="badge badge-lighe-secondary">' + i.log_activity + '</span>' +
                                                        '</div>' +
                                                        i.log_detail + 
                                                    '</td>' + 
                                                    '<td style="vertical-align: top;">' + 
                                                        '<div style="padding-bottom: 4px;">' + 
                                                            $role +
                                                        '</div>' + 
                                                        i.fname + ' ' + i.lname + 
                                                    '</td>' + 
                                                '</tr>'
                                        $('#noteList').append($data)
                                    });
                                    preload.hide()
                                }else{
                                    $('#noteList').append('<tr><td colspan="3" class="text-center">Note not found</td></tr>')
                                }
                           })
}