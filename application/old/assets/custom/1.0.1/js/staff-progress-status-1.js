var message_1 = null
var comment_new = null
var comment_update = null

if($("#message_box_1").length) {
    message_1 = CKEDITOR.replace( 'message_box_1', {
        wordcount : {
        showCharCount : false,
        showWordCount : true,
        maxWordCount: 500
        },
        height: '250px'
    });
}

if($("#txtComment_new").length) {
    comment_new = CKEDITOR.replace( 'txtComment_new', {
        wordcount : {
        showCharCount : false,
        showWordCount : true
        },
        height: '250px'
    });
}

if($("#txtComment_update").length) {
    comment_update = CKEDITOR.replace( 'txtComment_update', {
        wordcount : {
        showCharCount : false,
        showWordCount : true
        },
        height: '250px'
    });
}

$(function(){
    // For status = 1

    $('.form_status_1').submit(function(){

        if($('#txtResult').val() == ''){
          swal("คำเตือน", "กรุณากรอกเลือกผลการพิจารณาเอกสาร", "error"); return ;
        }

        if($('#txtResult').val() == '2'){
          if(message_1.getData() == ''){
            swal("คำเตือน", "กรุณากรอกข้อความที่จะส่งถึงหัวหน้าโครงการวิจัยก่อนทำการบันทึก", "error"); return ;
          }

          var param = {
            uid: current_user,
            id_rs: $('#textId_rs').val(),
            message: message_1.getData()
          }

          status_1.status1_denine(param)
          return ;
        }

        if($('#txtResult').val() == '3'){
          $check = 0
          $('.form-control').removeClass('is-invalid')

          if($('#txtYear').val() == ''){
            $check++
            $('#txtYear').addClass('is-invalid')
          }

          if($('#txtDept').val() == ''){
            $check++
            $('#txtDept').addClass('is-invalid')
          }

          if($('#txtPertype').val() == ''){
            $check++
            $('#txtPertype').addClass('is-invalid')
          }

          if($('#txtEC').val() == ''){
            $check++
            $('#txtEC').addClass('is-invalid')
          }

          if($check != 0){
            return ;
          }


          if(message_1.getData() == ''){
              swal("คำเตือน", "กรุณากรอกข้อความที่จะส่งถึงเลขาสำนักงาน", "error")
              return ;
          }

          var param = {
            uid: current_user,
            id_rs: $('#textId_rs').val(),
            id_ec: $('#txtEC').val(),
            year: $('#txtYear').val(),
            dept: $('#txtDept').val(),
            personnel: $('#txtPertype').val(),
            message: message_1.getData()
          }

          status_1.status1_success(param)
          return ;
        }

      })
      // End form_status_1

      $('#txtResult').change(function(){
        if($('#txtResult').val() == '2'){ // เอกสารไม่ถูกต้อง
          $('#doc_corect_div').addClass('dn')
          $('#txtEC').val('')
        }else if($('#txtResult').val() == '3'){ // เอกสารถูกต้อง
          $('#doc_corect_div').removeClass('dn')
        }else{
          $('#doc_corect_div').addClass('dn')
          $('#txtEC').val('')
        }
      })

    // End for status = 1
})

var status_1 = {
    status1_denine(param){
        preload.show()
        var xjr = $.post(conf.api + 'staff/rs_status_1?stage=change_to_2', param, function(){}, 'json')
                   .always(function(snap){
                       console.log(snap);
                        if(fnc.json_exist(snap)){
                            snap.forEach(i => {
                                var dataContent = '<h3>ชื่อเรื่อง : ผลการตรวจสอบความถูกต้องของเอกสารโครงการวิจัยที่ขอรับพิจารณาจริยธรรมการวิจัยในมนุษย์</h3>' +
                                                '<p>ชื่อโครงการ (ภาษาไทย) : ' + i.title_th + '</p>' +
                                                '<p>ชื่อโครงการ (English) : ' + i.title_en + ' </p>' +
                                                '<p>เรียน ' + i.fullname + '</p>' +
                                                "<p>เจ้าหน้าที่ได้ทำการตรวจสอบความครบถ้วนและถูกต้องเอกสารเบื้องต้นพบว่า <span style=\"color: red;\"><strong style=color:red;>เอกสารยังไม่ถูกต้อง/ไม่ครบถ้วน</strong></span> จึงขอให้ท่านดำเนินการต่อไปนี้" +
                                                '</p>' +
                                                '<p style="padding: 20px; background: rgb(240, 240, 240);"> -------------------------------------------' +
                                                  '<div style="padding: 20px; background: rgb(240, 240, 240);">' + message_1.getData() + '</div>' +
                                                '------------------------------------------- </p>' +
                                                '<p>กรุณายื่นเอกสารผ่านระบบ RMIS มาเพื่อตรวจสอบอีกครั้ง <strong>ระบบจะแจ้งผลการตรวจสอบทางอีเมลแก่ท่านภายใน 3 วันทำการ</stong></p>' +
                                                '<p>หมายเหตุ : กรุณาอย่าตอบกลับทาง e-mail นี้ <br>' +
                                                'ท่านสามารถตรวจสอบสถานะของโครงการโดยเข้าไปที่ระบบ RMIS ' + conf.domain +' หรือติดต่อเจ้าหน้าที่ (คุณณัฎฐา  ศิริรักษ์) โทร.1149, 1157';

                                var str = dataContent.replace(/\n/g, ' ')

                                var param = {
                                    title: "ผลการตรวจสอบความถูกต้องของเอกสารโครงการวิจัยที่ขอรับพิจารณาจริยธรรมการวิจัยในมนุษย์",
                                    content: str,
                                    user: 'rmismedpsu@gmail.com',
                                    key: 'cm1pc21lZHBzdUBnbWFpbC5jb20yMDE5LTEwLTIyIDIxOjU4OjU3MTI0LjEyMi40Mi4yNDU=',
                                    toemail: i.email,
                                    toname: i.fullname
                                }
                                fnc.send_email(param, 'index?uid=' + current_user + '&role=staff', 'กดตกลงเพื่อกลับสู่หน้าแรก', 'ระบบได้ดำเนินการตามกระบวนที่ท่านได้ดำเนินการแล้ว แต่เกิดข้อผิดพลาดในส่วนของการส่งอีเมล กรุณาแจ้งเจ้าหน้าที่เพื่อตรวจสอบและดำเนินการแก้ไข', true)
                            })
                        }else{
                            swal("เกิดข้อผิดพลาด", "ไม่สามารถเชื่อมต่อฐานข้อมูลได้ กรุณาลองใหม่ภายหลัง", "error")
                            preload.hide()
                            return ;
                        }
                   })
    },
    status1_success(param){

        preload.show()

        // 1. Check research file approval status

        // var param_checkfile = {
        //     id_rs: param.id_rs
        // }
        //
        // var jxr1 = $.post(conf.api + 'staff/rs_status_1?stage=check_file_approval', param_checkfile, function(){})
        //             .always(function(resp){
        //               console.log(resp);
        //                 // if(resp != 'Y'){
        //                 //     swal("ขออภัย", "กรุณาตรวจสอบและระบุผลการตรวจสอบไฟล์งานวิจัยให้ครบก่อน", "error")
        //                 //     preload.hide()
        //                 //     return ;
        //                 // }
        //             })
        // 2. Send result to ec
        preload.hide()
        swal({
            title: "คำเตือน",
            text: "ท่านยืนยันการปรับปรุงสถานะโครงการหรือไม่",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "ใช่",
            cancelButtonText: "ยกเลิก",
            closeOnConfirm: true
        },function(){
            preload.show()
            var xjr = $.post(conf.api + 'staff/rs_status_1?stage=change_to_3', param, function(){}, 'json')
                   .always(function(snap){
                        if(fnc.json_exist(snap)){
                            snap.forEach(i=>{
                                      var dataContent = '<p style="font-size: 1.3em;"><strong>รหัสโครงการ <span style="color: red;">REC ' + i.rec_id + '</span></strong></p>' +
                                                        '<p><strong>ชื่อโครงการ (ภาษาไทย)</strong> ' + $('#title_th').text() + '<br><strong>ชื่อโครงการ (English)</strong> ' + $('#title_en').text() + '</p>' +
                                                        '<p>' +
                                                          '<strong>รหัสโครงการวิจัยของท่านคือ REC ' + i.rec_id + '</strong>' +
                                                        '</p>' +
                                                        '<p>' +
                                                        ' •	เอกสารจะถูกส่งต่อเลขา EC เพื่อตรวจสอบความครบถ้วนเพิ่มเติมและพิจารณาประเภทของการพิจารณาต่อไป<br>' +
                                                        ' •	หากโครงการเข้าข่ายต้องรับการพิจารณาโดยคณะกรรมการเต็มชุด สำนักงานฯ จะแจ้งจำนวนชุดของเอกสารในรูปแบบ hard copy ให้ท่านทราบภายใน 7 วันทำการ<br>' +
                                                        ' •	ขอให้ท่านตรวจสอบอีเมลของท่านเป็นระยะ (รวมถึง junk box)' +
                                                        '</p>' +
                                                        '<p>หมายเหตุ : กรุณาอย่าตอบกลับทาง e-mail นี้ <br>ท่านสามารถตรวจสอบสถานะของโครงการโดยเข้าไปที่ระบบ RMIS ' + conf.domain + '  หรือติดต่อเจ้าหน้าที่ (คุณณัฎฐา  ศิริรักษ์) โทร.1149, 1157</p>' +
                                                        '<p><span style=\"color: red;\"><strong style=color:red;>** กรณีเป็น industrial sponsored trial ขอให้จัดส่งเอกสารในรูป hard copy จำนวน 14 ชุดมาที่สำนักงานโดยเร็วหลังได้อีเมลนี้</strong></span></p>';

                                      var str = dataContent.replace(/\n/g, ' ')
                                      var param = {
                                            title: "{No-reply} REC." + i.rec_id + " : แจ้งรหัสโครงการ",
                                            content: str,
                                            user: 'rmismedpsu@gmail.com',
                                            key: 'cm1pc21lZHBzdUBnbWFpbC5jb20yMDE5LTEwLTIyIDIxOjU4OjU3MTI0LjEyMi40Mi4yNDU=',
                                            toemail: i.email,
                                            toname: i.fullname
                                      }
                                      fnc.send_email(param, 'none', 'กดตกลงเพื่อกลับสู่หน้าแรก', 'ระบบได้ดำเนินการตามกระบวนที่ท่านได้ดำเนินการแล้ว แต่เกิดข้อผิดพลาดในส่วนของการส่งอีเมล กรุณาแจ้งเจ้าหน้าที่เพื่อตรวจสอบและดำเนินการแก้ไข', false)

                                      var dataContent2 = '<h3>REC.' + i.rec_id + ' โครงการวิจัยรอการตรวจสอบความถูกต้อง</h3>' +
                                                         '<p>เรียน ' + i.ec_fullname + '</p>' +
                                                         '<p>มีโครงการวิจัยรอการตรวจสอบความถูกต้อง รหัส REC.' + i.rec_id + ' กรุณาเข้าสู่ระบบ RMIS และดำเนินการต่อ' +
                                                         'ได้ที่ ' + conf.domain +'</a></p>' +
                                                         '<p>จึงเรียนมาเพื่อทราบ <br>ระบบสารสนเทศเพื่อการจัดการงานวิจัย (RMIS)</p>';
                                      var str = dataContent2.replace(/\n/g, ' ')
                                      var param3 = {
                                            title: "REC." + i.rec_id + " : โครงการวิจัยรอการตรวจสอบความถูกต้อง/แยกประเภท",
                                            content: str,
                                            user: 'rmismedpsu@gmail.com',
                                            key: 'cm1pc21lZHBzdUBnbWFpbC5jb20yMDE5LTEwLTIyIDIxOjU4OjU3MTI0LjEyMi40Mi4yNDU=',
                                            toemail: i.ec_email,
                                            toname: i.ec_fullname
                                      }
                                      fnc.send_email(param3, 'index?uid=' + current_user + '&role=staff', 'กดตกลงเพื่อกลับสู่หน้าแรก', 'ระบบได้ดำเนินการตามกระบวนที่ท่านได้ดำเนินการแล้ว แต่เกิดข้อผิดพลาดในส่วนของการส่งอีเมล กรุณาแจ้งเจ้าหน้าที่เพื่อตรวจสอบและดำเนินการแก้ไข', true)

                            })
                        }else{
                            swal("เกิดข้อผิดพลาด", "ไม่สามารถเชื่อมต่อฐานข้อมูลได้ กรุณาลองใหม่ภายหลัง", "error")
                            preload.hide()
                            return ;
                        }
                   })
        });
    }
}
