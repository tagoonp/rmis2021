Dropzone.autoDiscover = false;
var dropzone_4 = new Dropzone("#mydropzone_4", {
    dictDefaultMessage: '<i class="bx bx-upload"></i> อัพโหลดไฟล์ที่นี่',
    url: '../../../../api/video_upload_2.php?uid=' + $('#txtUid').val() + '&pid=' + $('#txtPid').val(),
    acceptedFiles: 'application/pdf, .docx, .doc, image/*, .xls, .xlsx',
    maxFilesize: 100,
    init: function(){
        this.on("complete", function(file) {
        console.log(file);
        this.removeFile(file);
        // alert(file.xhr.responseText)
        if(file.xhr.responseText == "Y"){
            Swal.fire({
                                icon: "success",
                                title: 'อัพโหลดสำเร็จ',
                                text: 'วิดีโอถูกอัพโหลดเรียบร้อยแล้ว',
                                confirmButtonClass: 'btn btn-success',
                        })
        }else{
            Swal.fire({
                                icon: "error",
                                title: 'อัพโหลดไม่สำเร็จ กรุณาลองใหม่โดยเลือกอัพโหลดจากอัลบัมภาพ',
                                text: 'ไม่สามารถตั้งเวลาได้ กรุณาลองใหม่อีกครั้ง',
                                confirmButtonClass: 'btn btn-danger',
                        })
        }
        });
    }
});

var dropzone_5 = new Dropzone("#mydropzone_5", {
    dictDefaultMessage: '<i class="bx bx-upload"></i> อัพโหลดไฟล์ที่นี่',
    url: '../../../../api/video_upload_2.php?uid=' + $('#txtUid').val() + '&pid=' + $('#txtPid').val(),
    acceptedFiles: 'application/pdf, .docx, .doc, image/*, .xls, .xlsx',
    maxFilesize: 100,
    init: function(){
        this.on("complete", function(file) {
        console.log(file);
        this.removeFile(file);
        // alert(file.xhr.responseText)
        if(file.xhr.responseText == "Y"){
            Swal.fire({
                                icon: "success",
                                title: 'อัพโหลดสำเร็จ',
                                text: 'วิดีโอถูกอัพโหลดเรียบร้อยแล้ว',
                                confirmButtonClass: 'btn btn-success',
                        })
        }else{
            Swal.fire({
                                icon: "error",
                                title: 'อัพโหลดไม่สำเร็จ กรุณาลองใหม่โดยเลือกอัพโหลดจากอัลบัมภาพ',
                                text: 'ไม่สามารถตั้งเวลาได้ กรุณาลองใหม่อีกครั้ง',
                                confirmButtonClass: 'btn btn-danger',
                        })
        }
        });
    }
});

var dropzone_8 = new Dropzone("#mydropzone_8", {
    dictDefaultMessage: '<i class="bx bx-upload"></i> อัพโหลดไฟล์ที่นี่',
    url: '../../../../api/video_upload_2.php?uid=' + $('#txtUid').val() + '&pid=' + $('#txtPid').val(),
    acceptedFiles: 'application/pdf, .docx, .doc, image/*, .xls, .xlsx',
    maxFilesize: 100,
    init: function(){
        this.on("complete", function(file) {
        console.log(file);
        this.removeFile(file);
        // alert(file.xhr.responseText)
        if(file.xhr.responseText == "Y"){
            Swal.fire({
                                icon: "success",
                                title: 'อัพโหลดสำเร็จ',
                                text: 'วิดีโอถูกอัพโหลดเรียบร้อยแล้ว',
                                confirmButtonClass: 'btn btn-success',
                        })
        }else{
            Swal.fire({
                                icon: "error",
                                title: 'อัพโหลดไม่สำเร็จ กรุณาลองใหม่โดยเลือกอัพโหลดจากอัลบัมภาพ',
                                text: 'ไม่สามารถตั้งเวลาได้ กรุณาลองใหม่อีกครั้ง',
                                confirmButtonClass: 'btn btn-danger',
                        })
        }
        });
    }
});

var dropzone_9 = new Dropzone("#mydropzone_9", {
    dictDefaultMessage: '<i class="bx bx-upload"></i> อัพโหลดไฟล์ที่นี่',
    url: '../../../../api/video_upload_2.php?uid=' + $('#txtUid').val() + '&pid=' + $('#txtPid').val(),
    acceptedFiles: 'application/pdf, .docx, .doc, image/*, .xls, .xlsx',
    maxFilesize: 100,
    init: function(){
        this.on("complete", function(file) {
        console.log(file);
        this.removeFile(file);
        // alert(file.xhr.responseText)
        if(file.xhr.responseText == "Y"){
            Swal.fire({
                                icon: "success",
                                title: 'อัพโหลดสำเร็จ',
                                text: 'วิดีโอถูกอัพโหลดเรียบร้อยแล้ว',
                                confirmButtonClass: 'btn btn-success',
                        })
        }else{
            Swal.fire({
                                icon: "error",
                                title: 'อัพโหลดไม่สำเร็จ กรุณาลองใหม่โดยเลือกอัพโหลดจากอัลบัมภาพ',
                                text: 'ไม่สามารถตั้งเวลาได้ กรุณาลองใหม่อีกครั้ง',
                                confirmButtonClass: 'btn btn-danger',
                        })
        }
        });
    }
});

var form9 = {
    send(){

        $check = 0;
        $val = $('input[name=radio_1]:checked').val()

        if(($val == '1') && ($('#txtQ1').val() == '')){
            $('#txtQ1').addClass('is-invalid')
            $check++;
        }else{
            if($val == null){
                $check++
            }else{
                if($('#txtQ2_1').val() == ''){
                    $('#txtQ2_1').addClass('is-invalid'); $check++;
                }
                if($('#txtQ2_2').val() == ''){
                    $('#txtQ2_2').addClass('is-invalid'); $check++;
                }
                if($('#txtQ2_3').val() == ''){
                    $('#txtQ2_3').addClass('is-invalid'); $check++;
                }
                if($('#txtQ2_4').val() == ''){
                    $('#txtQ2_4').addClass('is-invalid'); $check++;
                }
                if($('#txtQ2_5').val() == ''){
                    $('#txtQ2_5').addClass('is-invalid'); $check++;
                }
                if($('#txtQ2_6').val() == ''){
                    $('#txtQ2_6').addClass('is-invalid'); $check++;
                }
            }
        }

        if($('#txtQ3_1').val() == ''){
            $('#txtQ3_1').addClass('is-invalid'); $check++;
        }
        if($('#txtQ3_2').val() == ''){
            $('#txtQ3_2').addClass('is-invalid'); $check++;
        }
        if($('#txtQ3_3').val() == ''){
            $('#txtQ3_3').addClass('is-invalid'); $check++;
        }

        $val4 = $('input[name=radio_4]:checked').val()
        $val5 = $('input[name=radio_5]:checked').val()
        $val6 = $('input[name=radio_6]:checked').val()
        $val7 = $('input[name=radio_7]:checked').val()

        if($val4 == null){ $check++; }
        if($val5 == null){ $check++; }
        if($val6 == null){ $check++; }
        if($val7 == null){ $check++; }

        if($check != 0){
            Swal.fire(
                {
                icon: "error",
                title: 'คำเตือน',
                text: 'กรุณากรอกข้อมูลให้ครบถ้วน',
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
                    id_rs: $('#txtPid').val(),
                    progress: pg.toLowerCase()
                }
                var jxr = $.post(rmis_api + 'progress?stage=create_session', param, function(){}, 'json')
                           .always(function(snap){
                               console.log(snap);
                               if(snap.status == 'Success'){
                                   window.location = 'progressform_' + pg.toLowerCase() + '?project_id=' + $('#txtPid').val() + '&psid=' + snap.session_id
                               }else if(snap.status == 'Duplicate'){
                                    Swal.fire(
                                        {
                                        icon: "error",
                                        title: 'พบข้อมูลซ้ำ',
                                        text: 'ท่านเคยมีการสร้างหรือยื่นแบบรายงานนี้ไปแล้ว กรุณาตรวจสอบ หรือติดต่อเจ้าหน้าที่',
                                        confirmButtonClass: 'btn btn-danger',
                                        }
                                    )
                               }else{
                                    Swal.fire(
                                        {
                                        icon: "error",
                                        title: 'เกิดข้อผิดพลาด!',
                                        text: 'ไม่สามารถสร้างแบบรายงานได้ กรุณาติดต่อเจ้าหน้าที่',
                                        confirmButtonClass: 'btn btn-danger',
                                        }
                                    )
                               }
                           })
            }
        })
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
        }else{
            $('#hd1').addClass('dn')
            $('#hd2').removeClass('dn')
            $('#txtQ1').val('')
        }
    })
})