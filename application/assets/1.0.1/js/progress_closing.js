Dropzone.autoDiscover = false;

if(($('#mydropzone_4').length) || ($('#mydropzone_5').length) || ($('#mydropzone_8').length) || ($('#mydropzone_9').length)){
    var dropzone_4 = new Dropzone("#mydropzone_4", {
        dictDefaultMessage: '<i class="bx bx-upload"></i> อัพโหลดไฟล์ที่นี่',
        url: rmisc_api + '/upload_file_attach.php?progress=closing&fileposition=4&uid=' + $('#txtUid').val() + '&pid=' + $('#txtPid').val() + '&session_id=' + $('#txtSessionID').val(),
        acceptedFiles: 'application/pdf, .docx, .doc, image/*, .xls, .xlsx',
        maxFilesize: 100,
        init: function(){
            this.on("complete", function(file) {
            console.log(file);
            this.removeFile(file);
            // alert(file.xhr.responseText)
            if(file.xhr.responseText == "Success"){
                Swal.fire({
                        icon: "success",
                        title: 'อัพโหลดสำเร็จ',
                        text: 'วิดีโอถูกอัพโหลดเรียบร้อยแล้ว',
                        confirmButtonClass: 'btn btn-success',
                })
    
                getFileProgressSubmissionList($('#txtUid').val(), $('#txtSessionID').val(), 'closing', '4')
            }else{
                Swal.fire({
                                    icon: "error",
                                    title: 'เกิดข้อผิดพลาด',
                                    text: 'อัพโหลดไม่สำเร็จ',
                                    confirmButtonClass: 'btn btn-danger',
                            })
                getFileProgressSubmissionList($('#txtUid').val(), $('#txtSessionID').val(), 'closing', '4')
            }
            });
        }
    });
    
    var dropzone_5 = new Dropzone("#mydropzone_5", {
        dictDefaultMessage: '<i class="bx bx-upload"></i> อัพโหลดไฟล์ที่นี่',
        url: rmisc_api + '/upload_file_attach.php?progress=closing&fileposition=5&uid=' + $('#txtUid').val() + '&pid=' + $('#txtPid').val() + '&session_id=' + $('#txtSessionID').val(),
        acceptedFiles: 'application/pdf, .docx, .doc, image/*, .xls, .xlsx',
        maxFilesize: 100,
        init: function(){
            this.on("complete", function(file) {
            console.log(file);
            this.removeFile(file);
            if(file.xhr.responseText == "Success"){
                Swal.fire({
                        icon: "success",
                        title: 'อัพโหลดสำเร็จ',
                        text: 'วิดีโอถูกอัพโหลดเรียบร้อยแล้ว',
                        confirmButtonClass: 'btn btn-success',
                })
    
                getFileProgressSubmissionList($('#txtUid').val(), $('#txtSessionID').val(), 'closing', '5')
            }else{
                Swal.fire({
                                    icon: "error",
                                    title: 'เกิดข้อผิดพลาด',
                                    text: 'อัพโหลดไม่สำเร็จ',
                                    confirmButtonClass: 'btn btn-danger',
                            })
                getFileProgressSubmissionList($('#txtUid').val(), $('#txtSessionID').val(), 'closing', '5')
            }
            });
        }
    });
    
    var dropzone_8 = new Dropzone("#mydropzone_8", {
        dictDefaultMessage: '<i class="bx bx-upload"></i> อัพโหลดไฟล์ที่นี่',
        url: rmisc_api + '/upload_file_attach.php?progress=closing&fileposition=8&uid=' + $('#txtUid').val() + '&pid=' + $('#txtPid').val() + '&session_id=' + $('#txtSessionID').val(),
        acceptedFiles: 'application/pdf, .docx, .doc, image/*, .xls, .xlsx',
        maxFilesize: 100,
        init: function(){
            this.on("complete", function(file) {
            console.log(file.xhr.responseText);
            
            this.removeFile(file);
            if(file.xhr.responseText == "Success"){
                Swal.fire({
                        icon: "success",
                        title: 'อัพโหลดสำเร็จ',
                        text: 'วิดีโอถูกอัพโหลดเรียบร้อยแล้ว',
                        confirmButtonClass: 'btn btn-success',
                })
    
                getFileProgressSubmissionList($('#txtUid').val(), $('#txtSessionID').val(), 'closing', '8')
            }else{
                Swal.fire({
                                    icon: "error",
                                    title: 'เกิดข้อผิดพลาด',
                                    text: 'อัพโหลดไม่สำเร็จ',
                                    confirmButtonClass: 'btn btn-danger',
                            })
                getFileProgressSubmissionList($('#txtUid').val(), $('#txtSessionID').val(), 'closing', '8')
            }
            });
        }
    });
    
    var dropzone_9 = new Dropzone("#mydropzone_9", {
        dictDefaultMessage: '<i class="bx bx-upload"></i> อัพโหลดไฟล์ที่นี่',
        url: rmisc_api + '/upload_file_attach.php?progress=closing&fileposition=9&uid=' + $('#txtUid').val() + '&pid=' + $('#txtPid').val() + '&session_id=' + $('#txtSessionID').val(),
        acceptedFiles: 'application/pdf, .docx, .doc, image/*, .xls, .xlsx',
        maxFilesize: 100,
        init: function(){
                this.on("complete", function(file) {
                console.log(file.xhr.responseText);
                this.removeFile(file);
                if(file.xhr.responseText == "Success"){
                    Swal.fire({
                            icon: "success",
                            title: 'อัพโหลดสำเร็จ',
                            text: 'วิดีโอถูกอัพโหลดเรียบร้อยแล้ว',
                            confirmButtonClass: 'btn btn-success',
                    })
    
                    getFileProgressSubmissionList($('#txtUid').val(), $('#txtSessionID').val(), 'closing', '9')
                }else{
                    Swal.fire({
                            icon: "error",
                            title: 'เกิดข้อผิดพลาด',
                            text: 'อัพโหลดไม่สำเร็จ',
                            confirmButtonClass: 'btn btn-danger',
                    })
                    getFileProgressSubmissionList($('#txtUid').val(), $('#txtSessionID').val(), 'closing', '9')
                }
            });
        }
    });
}


var form9 = {
    addStage1Result(){
        form9.autoUpdate('closing')

        $check = 0;
        $val = $('input[name=radio_1]:checked').val()

        $msg_arr = [];

        if(($val == '1') && ($('#txtQ1').val() == '')){
            $('#txtQ1').addClass('is-invalid')
            $check++;
            $msg_arr.push('1')
        }else{
            if($val == null){
                $check++
            }else{
                if($('#txtQ2_1').val() == ''){
                    $('#txtQ2_1').addClass('is-invalid'); $check++; $msg_arr.push('2.1')
                }
                if($('#txtQ2_2').val() == ''){
                    $('#txtQ2_2').addClass('is-invalid'); $check++; $msg_arr.push('2.2')
                }
                if($('#txtQ2_3').val() == ''){
                    $('#txtQ2_3').addClass('is-invalid'); $check++; $msg_arr.push('2.3')
                }
                if($('#txtQ2_4').val() == ''){
                    $('#txtQ2_4').addClass('is-invalid'); $check++; $msg_arr.push('2.4')
                }
                if($('#txtQ2_5').val() == ''){
                    $('#txtQ2_5').addClass('is-invalid'); $check++; $msg_arr.push('2.5')
                }
                if($('#txtQ2_6').val() == ''){
                    $('#txtQ2_6').addClass('is-invalid'); $check++;  $msg_arr.push('2.6')
                }
            }
        }

        if($('#txtQ3_1').val() == ''){
            $('#txtQ3_1').addClass('is-invalid'); $check++; $msg_arr.push('3.1')
        }
        if($('#txtQ3_2').val() == ''){
            $('#txtQ3_2').addClass('is-invalid'); $check++; $msg_arr.push('3.2')
        }
        if($('#txtQ3_3').val() == ''){
            $('#txtQ3_3').addClass('is-invalid'); $check++; $msg_arr.push('3.3')
        }

        if($('#txtReturn').val() == ''){
            $('#txtReturn').addClass('is-invalid'); $check++; $msg_arr.push('ผลการตรวจสอบเอกสาร')
        }

        if(comment.getData() == ''){
           $check++; $msg_arr.push('Comment')
        }

        $val4 = $('input[name=radio_4]:checked').val()
        $val5 = $('input[name=radio_5]:checked').val()
        $val6 = $('input[name=radio_6]:checked').val()
        $val7 = $('input[name=radio_7]:checked').val()

        if($val4 == 'na'){ $check++; $msg_arr.push('4') }
        if($val5 == 'na'){ $check++; $msg_arr.push('5')  }
        if($val6 == 'na'){ $check++; $msg_arr.push('6')  }
        if($val7 == 'na'){ $check++; $msg_arr.push('7')  }

        if($check != 0){
            $err = '';
            if($msg_arr.length > 0){
                $err = ' (ข้อ ' + $msg_arr.join(", ") + ')'
            }
            
            Swal.fire(
                {
                icon: "error",
                title: 'คำเตือน',
                text: 'กรุณากรอกข้อมูลให้ครบถ้วน' + $err,
                confirmButtonClass: 'btn btn-danger',
                }
            )
            return ;
        }


        Swal.fire({
            title: 'ยืนยันดำเนินการ',
            text: "หากส่งแล้วจะไม่สามารถแก้ไขได้",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ยืนยัน',
            cancelButtonText: 'ตรวจสอบอีกครั้ง',
            confirmButtonClass: 'btn btn-danger mr-1',
            cancelButtonClass: 'btn btn-secondary',
            buttonsStyling: false,
        }).then(function (result) {
            if (result.value) {
                var param = {
                    uid: $('#txtUid').val(),
                    session_id: $('#txtSessionID').val(),
                    id_rs: $('#txtPid').val(),
                    role: $('#txtRole').val(),
                    progress: 'closing',
                    q1: $('input[name=radio_1]:checked').val(),
                    q1_info: $('#txtQ1').val(),
                    q2_1: $('#txtQ2_1').val(),
                    q2_2: $('#txtQ2_2').val(),
                    q2_3: $('#txtQ2_3').val(),
                    q2_4: $('#txtQ2_4').val(),
                    q2_5: $('#txtQ2_5').val(),
                    q2_6: $('#txtQ2_6').val(),
                    q3_1: $('#txtQ3_1').val(),
                    q3_2: $('#txtQ3_2').val(),
                    q3_3: $('#txtQ3_3').val(),
                    q4: $('input[name=radio_4]:checked').val(),
                    q5: $('input[name=radio_5]:checked').val(),
                    q6: $('input[name=radio_6]:checked').val(),
                    q6_info: $('#txtQ6').val(),
                    q7: $('input[name=radio_7]:checked').val(),
                    q7_1_info: $('#txtQ7_1').val(),
                    q7_2_info: $('#txtQ7_2').val(),
                    result: $('#txtReturn').val(),
                    comment: comment.getData()
                }
                console.log(param);
                var jxr = $.post(rmisc_api + 'progress?stage=result_stage1', param, function(){}, 'json')
                           .always(function(snap){
                               console.log(snap);
                               if(snap.status == 'Success'){
                                    $text = 'ส่งข้อมูลถึงนักวิจัยเรียบร้อยแล้ว'
                                    if($('#txtResult').val() == '2'){
                                        $text = 'ส่งข้อมูลถึงเลขาเรียบร้อยแล้ว'
                                    }
                                    Swal.fire({
                                        title: 'ดำเนินการสำเร็จ',
                                        text: $text,
                                        icon: 'success',
                                        showCancelButton: false,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'กลับหน้าหลัก',
                                        confirmButtonClass: 'btn btn-danger mr-1',
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
                                        title: 'เกิดข้อผิดพลาด!',
                                        text: 'ไม่สามารถส่งรายงานได้ กรุณาติดต่อเจ้าหน้าที่',
                                        confirmButtonClass: 'btn btn-danger',
                                        }
                                    )
                               }
                           })
            }
        })
    },
    addStage3Result(){
        $check = 0;
        $('.form-control').removeClass('is-invalid')

        if($('#txtReturn').val() == ''){
            $('#txtReturn').addClass('is-invalid'); $check++; 
        }

        if(comment.getData() == ''){
           $check++; 
        }

        if($check != 0){
            Swal.fire(
                {
                icon: "error",
                title: 'คำเตือน',
                text: 'กรุณากรอกข้อมูลถึงเจ้าหน้าที่หรือนักวิจัยให้ครบถ้วน',
                confirmButtonClass: 'btn btn-danger',
                }
            )
            return ;
        }

        var param = {
            session_id: $('#txtSessionID').val(),
            result: $('#txtReturn').val(),
            uid: $('#txtUid').val(),
            role: $('#txtRole').val(),
            comment: comment.getData()
        }

        Swal.fire({
            title: 'ยืนยันดำเนินการ',
            text: "กรุณาตรวจสอบข้อมูลให้ถูกต้องก่อนทำการส่ง",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ยืนยันส่ง',
            cancelButtonText: 'ตรวจสอบอีกครั้ง',
            confirmButtonClass: 'btn btn-danger mr-1',
            cancelButtonClass: 'btn btn-secondary',
            buttonsStyling: false,
        }).then(function (result) {
            if (result.value) {
                var jxr = $.post(rmisc_api + 'progress?stage=confirm_stage3', param, function(){}, 'json')
                           .always(function(snap){
                               console.log(snap);
                               if(snap.status == 'Success'){
                                    Swal.fire({
                                        title: 'สำเร็จ',
                                        text: "ข้อมูลถูกส่งเรียบร้อยแล้ว",
                                        icon: 'success',
                                        showCancelButton: false,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'กลับหน้าหลัก',
                                        confirmButtonClass: 'btn btn-danger mr-1',
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
                                        title: 'เกิดข้อผิดพลาด!',
                                        text: 'ไม่สามารถดำเนินการได้',
                                        confirmButtonClass: 'btn btn-danger',
                                        }
                                    )
                               }
                           })
            }
        })
    },
    send(){

        form9.autoUpdate('closing')

        $check = 0;
        $val = $('input[name=radio_1]:checked').val()

        $msg_arr = [];

        if(($val == '1') && ($('#txtQ1').val() == '')){
            $('#txtQ1').addClass('is-invalid')
            $check++;
            $msg_arr.push('1')
        }else{
            if($val == null){
                $check++
            }else{
                if($('#txtQ2_1').val() == ''){
                    $('#txtQ2_1').addClass('is-invalid'); $check++; $msg_arr.push('2.1')
                }
                if($('#txtQ2_2').val() == ''){
                    $('#txtQ2_2').addClass('is-invalid'); $check++; $msg_arr.push('2.2')
                }
                if($('#txtQ2_3').val() == ''){
                    $('#txtQ2_3').addClass('is-invalid'); $check++; $msg_arr.push('2.3')
                }
                if($('#txtQ2_4').val() == ''){
                    $('#txtQ2_4').addClass('is-invalid'); $check++; $msg_arr.push('2.4')
                }
                if($('#txtQ2_5').val() == ''){
                    $('#txtQ2_5').addClass('is-invalid'); $check++; $msg_arr.push('2.5')
                }
                if($('#txtQ2_6').val() == ''){
                    $('#txtQ2_6').addClass('is-invalid'); $check++;  $msg_arr.push('2.6')
                }
            }
        }

        if($('#txtQ3_1').val() == ''){
            $('#txtQ3_1').addClass('is-invalid'); $check++; $msg_arr.push('3.1')
        }
        if($('#txtQ3_2').val() == ''){
            $('#txtQ3_2').addClass('is-invalid'); $check++; $msg_arr.push('3.2')
        }
        if($('#txtQ3_3').val() == ''){
            $('#txtQ3_3').addClass('is-invalid'); $check++; $msg_arr.push('3.3')
        }

        $val4 = $('input[name=radio_4]:checked').val()
        $val5 = $('input[name=radio_5]:checked').val()
        $val6 = $('input[name=radio_6]:checked').val()
        $val7 = $('input[name=radio_7]:checked').val()

        if($val4 == 'na'){ $check++; $msg_arr.push('4') }
        if($val5 == 'na'){ $check++; $msg_arr.push('5')  }
        if($val6 == 'na'){ $check++; $msg_arr.push('6')  }
        if($val7 == 'na'){ $check++; $msg_arr.push('7')  }

        if($check != 0){
            $err = '';
            if($msg_arr.length > 0){
                $err = ' (ข้อ ' + $msg_arr.join(", ") + ')'
            }
            
            Swal.fire(
                {
                icon: "error",
                title: 'คำเตือน',
                text: 'กรุณากรอกข้อมูลให้ครบถ้วน' + $err,
                confirmButtonClass: 'btn btn-danger',
                }
            )
            return ;
        }


        Swal.fire({
            title: 'ท่านยืนยันการส่งรายงานสรุปผลการวิจัย (Final report form) หรือไม่?',
            text: "หากส่งแล้วจะไม่สามารถแก้ไขได้จนกว่าจะได้รับการตอบกลับจากเจ้าหน้าที่",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ยืนยัน',
            cancelButtonText: 'ตรวจสอบอีกครั้ง',
            confirmButtonClass: 'btn btn-danger mr-1',
            cancelButtonClass: 'btn btn-secondary',
            buttonsStyling: false,
        }).then(function (result) {
            if (result.value) {
                var param = {
                    uid: $('#txtUid').val(),
                    session_id: $('#txtSessionID').val(),
                    id_rs: $('#txtPid').val(),
                    role: $('#txtRole').val(),
                    progress: 'closing',
                    q1: $('input[name=radio_1]:checked').val(),
                    q1_info: $('#txtQ1').val(),
                    q2_1: $('#txtQ2_1').val(),
                    q2_2: $('#txtQ2_2').val(),
                    q2_3: $('#txtQ2_3').val(),
                    q2_4: $('#txtQ2_4').val(),
                    q2_5: $('#txtQ2_5').val(),
                    q2_6: $('#txtQ2_6').val(),
                    q3_1: $('#txtQ3_1').val(),
                    q3_2: $('#txtQ3_2').val(),
                    q3_3: $('#txtQ3_3').val(),
                    q4: $('input[name=radio_4]:checked').val(),
                    q5: $('input[name=radio_5]:checked').val(),
                    q6: $('input[name=radio_6]:checked').val(),
                    q6_info: $('#txtQ6').val(),
                    q7: $('input[name=radio_7]:checked').val(),
                    q7_1_info: $('#txtQ7_1').val(),
                    q7_2_info: $('#txtQ7_2').val()
                }
                var jxr = $.post(rmisc_api + 'progress?stage=send', param, function(){}, 'json')
                           .always(function(snap){
                               console.log(snap);
                               if(snap.status == 'Success'){
                                    Swal.fire({
                                        title: 'ส่งรายงานสำเร็จ',
                                        text: "กรุณาตรวจสอบสถานะรายงานเป็นระยะ หากมีข้อสงสัยกรุณาโทรสอบถามเจ้าหน้าที่",
                                        icon: 'success',
                                        showCancelButton: false,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'กลับหน้าหลัก',
                                        confirmButtonClass: 'btn btn-danger mr-1',
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
                                        title: 'เกิดข้อผิดพลาด!',
                                        text: 'ไม่สามารถส่งรายงานได้ กรุณาติดต่อเจ้าหน้าที่',
                                        confirmButtonClass: 'btn btn-danger',
                                        }
                                    )
                               }
                           })
            }
        })
    },
    autoUpdate(progress){
        var param = {
            uid: $('#txtUid').val(),
            sid: $('#txtSessionID').val(),
            progress: progress,
            q1: $('input[name=radio_1]:checked').val(),
            q1_info: $('#txtQ1').val(),
            q2_1: $('#txtQ2_1').val(),
            q2_2: $('#txtQ2_2').val(),
            q2_3: $('#txtQ2_3').val(),
            q2_4: $('#txtQ2_4').val(),
            q2_5: $('#txtQ2_5').val(),
            q2_6: $('#txtQ2_6').val(),
            q3_1: $('#txtQ3_1').val(),
            q3_2: $('#txtQ3_2').val(),
            q3_3: $('#txtQ3_3').val(),
            q4: $('input[name=radio_4]:checked').val(),
            q5: $('input[name=radio_5]:checked').val(),
            q6: $('input[name=radio_6]:checked').val(),
            q6_info: $('#txtQ6').val(),
            q7: $('input[name=radio_7]:checked').val(),
            q7_1_info: $('#txtQ7_1').val(),
            q7_2_info: $('#txtQ7_2').val()
        }
        var jxr = $.post(rmisc_api + 'progress?stage=autosave', param, function(resp){ console.log(resp); })

        
    }
}

$(function(){
    $('input[name=radio_1]').click(function(){
        $val = $('input[name=radio_1]:checked').val()
        if($val == '1'){
            $('#hd1').removeClass('dn')
            $('#hd2').addClass('dn')
            $('#txtQ2_1').val('')
            $('#txtQ2_2').val('')
            $('#txtQ2_3').val('')
            $('#txtQ2_4').val('')
            $('#txtQ2_5').val('')
            $('#txtQ2_6').val('')

            $('#txtQ3_1').val('0')
            $('#txtQ3_2').val('0')
            $('#txtQ3_3').val('0')

            
        }else{
            $('#hd1').addClass('dn')
            $('#hd2').removeClass('dn')
            $('#txtQ1').val('')

            $('#txtQ3_1').val('')
            $('#txtQ3_2').val('')
            $('#txtQ3_3').val('')
        }
    })

    $('input[name=radio_6]').click(function(){
        $val = $('input[name=radio_6]:checked').val()
        if($val == '2'){
            $('#hd63').removeClass('dn')
        }else{
            $('#hd63').addClass('dn')
            $('#txtQ6').val('')
        }
    })

    $('input[name=radio_7]').click(function(){
        $val = $('input[name=radio_7]:checked').val()
        if($val == '1'){
            $('#hd72').removeClass('dn')
            $('#hd73').addClass('dn')
            $('#txtQ7_3').val('')
        }else if($val == '2'){
            $('#hd72').addClass('dn')
            $('#hd73').removeClass('dn')
            $('#txtQ7_2').val('')
        }else{
            $('#hd72').addClass('dn')
            $('#hd73').addClass('dn')
            $('#txtQ7_2').val('')
            $('#txtQ7_3').val('')
        }
    })

})

function getFileProgressSubmissionList(uid, session_id, progress, filepath){
    var param = {
        uid: uid,
        session_id: session_id,
        progress: progress,
        fileposition: filepath
    }
    var jxr = $.post(rmisc_api + 'progress?stage=get_submission_file', param, function(){}, 'json')
                           .always(function(snap){
                               console.log(snap);
                               if(snap.status == 'Success'){
                                    $('#' + progress + '_' + filepath).empty()
                                    $c = 1;
                                    snap.data.forEach(i => {
                                        $ald = '';
                                        if((i.rpfs_allow_delete == '0') && ($('#txtRole').val() != 'staff') && ($('#txtRole').val() != 'ec')){
                                            $ald = 'disabled';
                                        }
                                        $('#' + progress + '_' + filepath).append(
                                            '<tr>' + 
                                                '<td>' + $c + '. ' + i.rpfs_name + '</td>' + 
                                                '<td class="text-right">' + 
                                                    '<button class="btn btn-outline-success btn-icon btn-sm" style="padding-top: 3px; padding-bottom: 10px; margin-right: 4px;" onclick="openFile(\'' + i.rpfs_url + '\')"><i class="bx bx-download"></i></button>'  +    
                                                    '<button class="btn btn-outline-danger btn-icon btn-sm" ' + $ald + '  style="padding-top: 3px; padding-bottom: 10px;" onclick="deleteFile(\'' + i.rpfs_id + '\', \'' + progress + '\', \'' + filepath + '\')"><i class="bx bx-trash"></i></button>'  +
                                                '</td>' + 
                                            '</tr>'
                                        )
                                        $c++
                                    }); 
                               }else{
                                $('#' + progress + '_' + filepath).html('<tr><td colspan="2" class="text-center">ไม่มีไฟล์แนบ</td></tr>')
                               }
                           })
}

function openFile(file_name){
    window.open(file_name, target="_blank")
}

function deleteFile(file_id, progress, file_path){
    Swal.fire({
        title: 'คำเตือน',
        text: "หากลบไฟล์ดังกล่าวจะไม่สามารถนำกลับมาได้อีก",
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
                file_id: file_id,
                session_id: $('#txtSessionID').val()
            }
            var jxr = $.post(rmisc_api + 'progress?stage=delete_submission_file', param, function(){}, 'json')
                                   .always(function(snap){
                                       if(snap.status == 'Success'){

                                       }else{
                                            Swal.fire({
                                                icon: "error",
                                                title: 'เกิดข้อผิดพลาด!',
                                                text: 'ไม่สามารถลบไฟล์ได้',
                                                confirmButtonClass: 'btn btn-danger',
                                            })
                                       }

                                       getFileProgressSubmissionList($('#txtUid').val(), $('#txtSessionID').val(), progress, file_path)
                                   })
        }
    })
}

var f9ass = {
    checkClick(item, choice){
        if(item == '1'){
            if($('input[name=txtrQ' + item + ']:checked').val() == '2'){
                $('#hinfo' + item).removeClass('dn')
            }else{
                $('#hinfo' + item).addClass('dn')
                $('#txtrComment1').val('') 
            }
        }

        if(item == '2'){
            if($('input[name=txtrQ' + item + ']:checked').val() == '2'){
                $('#hinfo' + item).removeClass('dn')
            }else{
                $('#hinfo' + item).addClass('dn')
                $('#txtrComment' + item).val('') 
            }
        }

        if(item == '3'){
            if($('input[name=txtrQ' + item + ']:checked').val() == '2'){
                $('#hinfo' + item).removeClass('dn')
            }else{
                $('#hinfo' + item).addClass('dn')
                $('#txtrComment' + item).val('') 
            }
        }

        if(item == '4'){
            if(($('input[name=txtrQ' + item + ']:checked').val() == '2') || ($('input[name=txtrQ' + item + ']:checked').val() == '3')){
                $('#hinfo' + item).removeClass('dn')
            }else{
                $('#hinfo' + item).addClass('dn')
                $('#txtrComment' + item).val('') 
            }
        }

        if(item == '5'){
            if($('input[name=txtrQ' + item + ']:checked').val() == '3'){
                $('#hinfo' + item).removeClass('dn')
            }else{
                $('#hinfo' + item).addClass('dn')
                $('#txtrComment' + item).val('') 
            }
        }

        if(item == '6'){
            if(($('input[name=txtrQ' + item + ']:checked').val() == '2') || ($('input[name=txtrQ' + item + ']:checked').val() == '3')){
                $('#hinfo' + item).removeClass('dn')
            }else{
                $('#hinfo' + item).addClass('dn')
                $('#txtrComment' + item).val('') 
            }
        }

        if(item == '7'){
            $('#hinfo' + item).removeClass('dn')
        }
    },
    saveAssesment(){
        $q1 = $('input[name=txtrQ1]:checked').val()
        $q2 = $('input[name=txtrQ2]:checked').val()
        $q3 = $('input[name=txtrQ3]:checked').val()
        $q4 = $('input[name=txtrQ4]:checked').val()
        $q5 = $('input[name=txtrQ5]:checked').val()
        $q6 = $('input[name=txtrQ6]:checked').val()
        $q7 = $('input[name=txtrQ7]:checked').val()

        if(($q1 == 'na') || ($q2 == 'na') || ($q3 == 'na') || ($q4 == 'na') || ($q5 == 'na') || ($q6 == 'na') || ($q7 == 'na')){
            Swal.fire({
                icon: "error",
                title: 'เกิดข้อผิดพลาด!',
                text: 'กรุณาตอบแบบประเมินให้ครบถ้วน',
                confirmButtonClass: 'btn btn-danger',
            })
            return ;
        }

        var param = {
            uid: $('#txtUid').val(),
            q1: $q1,
            q1_info: $('#txtrComment1').val(),
            q2: $q2,
            q2_info: $('#txtrComment2').val(),
            q3: $q3,
            q3_info: $('#txtrComment3').val(),
            q4: $q4,
            q4_info: $('#txtrComment4').val(),
            q5: $q5,
            q5_info: $('#txtrComment5').val(),
            q6: $q6,
            q6_info: $('#txtrComment6').val(),
            q7: $q7,
            q7_info: $('#txtrComment7').val(),
            session_id: $('#txtSessionID').val(),
            progress: 'closing'
        }

        // if($('#txtRole').val() == 'ec'){
            var jxr = $.post(rmisc_api + 'progress?stage=assesment_submission', param, function(){}, 'json')
                       .always(function(snap){
                           console.log(snap);
                           if(snap.status == 'Success'){
                               $('#modalAssesment').modal('hide')
                                Swal.fire({
                                    icon: "success",
                                    title: 'บันทึกสำเร็จ!',
                                    text: 'แบบประเมินถูกบันทึกเรียบร้อยแล้ว',
                                    confirmButtonClass: 'btn btn-danger',
                                })
                           }else{
                                Swal.fire({
                                    icon: "error",
                                    title: 'เกิดข้อผิดพลาด!',
                                    text: 'ไม่สามารถบันทึกแบบประเมินได้',
                                    confirmButtonClass: 'btn btn-danger',
                                })
                           }
                       })
        // }else{
        //     Swal.fire({
        //         title: 'คำเตือน',
        //         text: "หากลบไฟล์ดังกล่าวจะไม่สามารถนำกลับมาได้อีก",
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'ยืนยัน',
        //         cancelButtonText: 'ยกเลิก',
        //         confirmButtonClass: 'btn btn-danger mr-1',
        //         cancelButtonClass: 'btn btn-secondary',
        //         buttonsStyling: false,
        //     }).then(function (result) {
        //         if (result.value) {
    
        //         }
        //     })
        // }
        
    }
}