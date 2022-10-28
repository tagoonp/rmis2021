var reviewer_q = 0;
var reviewer_ec = 0; // ตัวเช็คว่าเลขาเป็น rev เองหรือไม่
var reviewer_ec_reviewed = 0; // ตัวเช็คว่าเลขาเป็น rev เองหรือไม่

var reviewer_ec_message1 = 0; // ตัวเช็คว่าเลขาเป็น rev เองหรือไม่

listReviewer()

if($('#txtMessageReturn1').length){
    reviewer_ec_message1 = CKEDITOR.replace( 'txtMessageReturn1', {
        wordcount : {
        showCharCount : false,
        showWordCount : true
        },
        height: '300px'
    });
}

function openFormEc(form, id_rs, session_id){
    console.log(id_rs, session_id);
    window.location = 'progressform_' + form + '?id_rs=' + id_rs + '&session_id=' + session_id
}

function addReviewer(ret, renn){

    if($('#txtType_' + ret).val() == ''){
        Swal.fire(
                            {
                            icon: "error",
                            title: 'เกิดข้อผิดพลาด!',
                            text: 'กรุณาเลือกประเภทการพิจารณา',
                            confirmButtonClass: 'btn btn-danger',
                            }
                        )
        return ;
    }
    var param = {
        reviewer_id: ret,
        reviewer_type: $('#txtType_' + ret).val(),
        session_id: $('#txtSessionID').val()
    }
    var jxr = $.post(api + 'progress?stage=add_reviewer', param, function(){}, 'json')
                .always(function(snap){
                    console.log(snap);
                    listReviewer()
                    if(snap.status == 'Success'){
                        Swal.fire(
                            {
                            icon: "success",
                            title: 'สำเร็จ',
                            text: 'คุณ' + renn + 'ถูกเพิ่มเป็นผุ้เชี่ยวชาญอิสระเรียบร้อยแล้ว',
                            confirmButtonClass: 'btn btn-danger',
                            }
                        )
                    }else{
                        Swal.fire(
                            {
                            icon: "error",
                            title: 'เกิดข้อผิดพลาด!',
                            text: 'ไม่สามารถเพิ่มคุณ' + renn + 'ได้',
                            confirmButtonClass: 'btn btn-danger',
                            }
                        )
                    }
                })
}

function listReviewer(){
    reviewer_q = 0;
    var param = {
        session_id: $('#txtSessionID').val()
    }
    var jxr = $.post(api + 'progress?stage=list_reviewer', param, function(){}, 'json')
                .always(function(snap){
                    console.log(snap);
                    // return ;
                    if(snap.status == 'Success'){
                        $('#reviewerList').empty()
                        $c = 0;
                        snap.data.forEach(i => {

                            console.log(i);

                            reviewer_q++;
                            $comm = i.rv_comment
                            if(i.rv_comment == null){
                                $comm = '-'
                            }

                            $bg = 'primary'
                            if(i.rv_reviewer_type == 'Fullboard'){
                                $bg = 'danger'
                            }

                            $send = '';
                            if(i.rv_session_end == '1'){
                                $send = ' disabled '
                            }

                            $btnPencil = ''
                            if($('#txtUid').val() == i.rv_reviewer_id){
                                reviewer_ec++;
                                $btnPencil = '<button ' + $send + ' class="btn btn-secondary btn-sm btn-icon" style="margin-right: 4px; padding-bottom: 8px; padding-top: 5px;" onclick="showModalAssesment(' + i.rv_reviewer_id + ', \'' + i.rv_session_id + '\')"><i class="bx bx-pencil"></i></button>'
                            }

                            $review_status = '<span class="badge badge-secondary round">ยังไม่ทำแบบประเมิน</span><br>'
                            if(snap.review_status[$c] == 1){
                                $review_status = '<span class="badge badge-success round">ทำแบบประเมินเรียบร้อยแล้ว</span><br>'
                                reviewer_ec_reviewed++;
                            }

                            

                            $('#reviewerList').append('<tr>' + 
                                                        '<td><span class="badge badge-' + $bg + ' round">' + i.rv_reviewer_type + '</span><br>' + i.fname + ' ' + i.lname + '</td>' + 
                                                        '<td>' + $review_status + '</td>' +
                                                        '<td class="text-right col-3">' + 
                                                            $btnPencil + 
                                                            '<button ' + $send + ' onclick="deleteReviewer(\'' + i.rv_reviewer_id + '\', \'' + i.rv_session_id + '\', \'' + i.fname + ' ' + i.lname + '\')" class="btn btn-danger btn-sm btn-icon" style="padding-bottom: 8px; padding-top: 5px;"><i class="bx bx-trash"></i></button>' +
                                                        '</td>' +
                                                    '</td>')
                            $c++;
                        });
                    }else{
                        $('#reviewerList').html('<tr><td colspan="3" class="text-center">ยังไม่มีการเลือกกรรมการ</td></tr>')
                    }
                })
}

function showModalAssesment(id_rev, id_sess){
    var param = {
        reviewer_id: id_rev,
        session_id: $('#txtSessionID').val(),
        progress_id: 'closing',
        id_asssess: id_sess
    }

    console.log(param);
    var jxr = $.post(api + 'progress?stage=get_asses_info', param, function(){}, 'json')
               .always(function(snap){
                   console.log(snap);
                //    return ;
                    if(snap.status == 'Success'){
                        $('input:radio[name=txtrQ1][value=' + snap.data.rac_q1 + ']').attr('checked', true);
                        $('input:radio[name=txtrQ2][value=' + snap.data.rac_q2 + ']').attr('checked', true);
                        $('input:radio[name=txtrQ3][value=' + snap.data.rac_q3 + ']').attr('checked', true);
                        $('input:radio[name=txtrQ4][value=' + snap.data.rac_q4 + ']').attr('checked', true);
                        $('input:radio[name=txtrQ5][value=' + snap.data.rac_q5 + ']').attr('checked', true);
                        $('input:radio[name=txtrQ7][value=' + snap.data.rac_q7 + ']').attr('checked', true);

                        if(snap.data.rac_q1 == '2'){
                            $('#hinfo1').removeClass('dn'); $('#txtrComment1').val(snap.data.rac_q1_info)
                        }

                        if(snap.data.rac_q2 == '2'){
                            $('#hinfo2').removeClass('dn'); $('#txtrComment2').val(snap.data.rac_q2_info)
                        }

                        if(snap.data.rac_q3 == '2'){
                            $('#hinfo3').removeClass('dn'); $('#txtrComment3').val(snap.data.rac_q3_info)
                        }

                        if((snap.data.rac_q4 == '2') || (snap.data.rac_q4 == '3')){
                            $('#hinfo4').removeClass('dn'); $('#txtrComment4').val(snap.data.rac_q4_info)
                        }

                        if((snap.data.rac_q7 == '1') || (snap.data.rac_q7 == '2') || (snap.data.rac_q7 == '3')){
                            $('#hinfo7').removeClass('dn');
                            $('#txtrComment7').val(snap.data.rac_q7_info)
                        }
                        // console.log('aaaa');
                        $('#modalAssesment').modal()
                    }else{
                        $('#modalAssesment').modal()
                    }
               })

    
}

function openCommentModal(a){
    revComment.setData('')
    $('#txtCommentId').val('')
    $('#commentModal').modal()
}

function deleteReviewer(id_rev, id_session, fname){
    Swal.fire({
        title: 'คำเตือน',
        text: "ยืนยันการลบ " + fname + " ออกจากรายการกรรมการสำหรับรายงานนี้หรือไม่",
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
                session_id: id_session,
                reviewer_id: id_rev
            }
            var jxr = $.post(api + 'progress?stage=delete_reviewer', param, function(){}, 'json')
                .always(function(snap){
                    if(snap.status == 'Success'){
                        listReviewer()
                    }else{
                        listReviewer()
                        Swal.fire(
                            {
                            icon: "error",
                            title: 'เกิดข้อผิดพลาด!',
                            text: 'ไม่สามารถลบคุณ' + fname + 'ได้',
                            confirmButtonClass: 'btn btn-danger',
                            }
                        )
                    }
                })
        }
    })
}

$(function(){
    $('#txtReturnEcStep1').change(function(){
        console.log($('#txtReturnEcStep1').val());
        $('#btnNext').html('บันทึกและส่ง <i class="bx bx-chevron-right"></i>')
        if($('#txtReturnEcStep1').val() == '1') // ส่งเจ้าหน้าที่เพื่อขอข้อมูลเพิ่มเติมหรือดำเนินการอื่น ๆ
        {
            $('#txtReturn1Div').removeClass('dn')
        }else if($('#txtReturnEcStep1').val() == '2'){
            console.log('asd');
            $('#txtReturn1Div').addClass('dn')
            reviewer_ec_message1.setData('')
            $('#btnNext1').trigger('click')
            $('#btnNext').html('ต่อไป <i class="bx bx-chevron-right"></i>')
        }else{
            $('#txtReturn1Div').addClass('dn')
            reviewer_ec_message1.setData('')
        }

    })
})

var ec = {
    operate_1(){
        if($('#txtReturnEcStep1').val() == ''){
            Swal.fire(
                {
                icon: "error",
                title: 'เกิดข้อผิดพลาด!',
                text: 'กรุณาเลือกกระบวนการดำเนินการ',
                confirmButtonClass: 'btn btn-danger',
                }
            )
            return ;
        }

        if($('#txtReturnEcStep1').val() == '1'){ // ส่งเจ้าหน้าที่เพื่อขอข้อมูลเพิ่มเติมหรือดำเนินการอื่น ๆ
            $data = reviewer_ec_message1.getData()
            if($data == ''){
                Swal.fire(
                    {
                    icon: "error",
                    title: 'เกิดข้อผิดพลาด!',
                    text: 'กรุณากรอกข้อความก่อนดำเนินการ',
                    confirmButtonClass: 'btn btn-danger',
                    }
                )
                return ;
            }

            var param = {
                uid: $('#txtUid').val(),
                role: $('#txtRole').val(),
                id_rs: $('#txtPid').val(),
                session_id: $('#txtSessionID').val(),
                message: $data
            }   
            preload.show()
            var jxr = $.post(api + 'progress_ec?stage=ec_stage_to_17', param, function(){}, 'json')
                .always(function(snap){
                    preload.hide()
                    if(snap.status == 'Success'){
                        Swal.fire({
                            title: 'สำเร็จ',
                            text: "ข้อมูลถูกส่งไปยังเจ้าหน้าที่เรียบร้อยแล้ว",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'กลับหน้าหลัก',
                            cancelButtonText: 'ยกเลิก',
                            confirmButtonClass: 'btn btn-success',
                            cancelButtonClass: 'btn btn-secondary',
                            buttonsStyling: false,
                        }).then(function (result) {
                            if (result.value) {
                                window.location = './'
                            }
                        })
                    }else{
                        Swal.fire(
                            {
                            icon: "error",
                            title: 'เกิดข้อผิดพลาด',
                            text: 'ไม่สามารถดำเนินการได้',
                            confirmButtonClass: 'btn btn-danger',
                            }
                        )
                    }
                })
        }else if($('#txtReturnEcStep1').val() == '2'){ // เลือก Reviewer
            $('#modalOperation').modal('hide')
            $('#modalMainReviewer').modal()
            f9ass.listCommentStaff()
        }
        

        
    }
}