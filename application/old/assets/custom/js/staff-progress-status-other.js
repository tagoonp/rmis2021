var message_other = null
var message_21 = null
var message_send_ec_2 = null

if($("#message_box_other").length) {
    message_other = CKEDITOR.replace( 'message_box_other', {
        wordcount : {
        showCharCount : false,
        showWordCount : true,
        },
        height: '250px'
    });
}

if($("#message_box_21").length) {
    message_21 = CKEDITOR.replace( 'message_box_21', {
        wordcount : {
        showCharCount : false,
        showWordCount : true,
        },
        height: '250px'
    });
}

if($("#messagebox_send_ec_2").length) {
    message_send_ec_2 = CKEDITOR.replace( 'messagebox_send_ec_2', {
        wordcount : {
        showCharCount : false,
        showWordCount : true
        },
        height: '200px'
    });
}


$(function(){
    // For status = 1

    $('.form_status_21').submit(function(){

      $('.form-control').removeClass('is-invalid')

      if($('#txtResult21').val() == ''){
        $('#txtResult21').addClass('is-invalid')
        swal("คำเตือน", "กรุณาเลือกผลการตรวจสอบก่อน", "error")
        return ;
      }

      if(message_21.getData() == ''){
          swal("คำเตือน", "กรุณากรอกข้อความก่อน", "error")
          return ;
      }

      var param = {
        uid: current_user,
        id_rs: current_project,
        message: message_21.getData()
      }

      if($('#txtResult21').val() == '2'){ // Invalid document
        status_other.send_message_21_invalid(param)
      }else{ // Valid document
        status_other.send_message_21_valid(param)
      }
      return ;

    })

    $('.form_status_other').submit(function(){
      if(message_other.getData() == ''){ swal("คำเตือน", "กรุณากรอกข้อความก่อน", "error"); return ; }

      var param = {
        uid: current_user,
        id_rs: current_project,
        message: message_other.getData()
      }

      status_other.send_message_other(param)
      return ;

    })
    // End form_status_other

    $('#btnSummarySend').click(function(){

      console.log($('#txtMatee').text().trim());
      if(message_send_ec_2.getData() == ''){
        swal("คำเตือน", "กรุณาเพิ่มบันทึกหรือข้อความส่งต่อก่อน", "error")
        return ;
      }

      if($('#txtMatee').text().trim() == 'ยังไม่กำหนด'){
        swal({
          title: "คำเตือน",
          text: "คุณยังไม่ได้ทำการระบุมติจากที่ประชุม กด ตกลง หากต้องการดำเนินการต่อ หรือกด กลับไปแก้ไข เพื่อกลับไปเพิ่มมติจากที่ประชุม",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "ตกลง",
          cancelButtonText: "กลับไปแก้ไข",
          closeOnConfirm: false
        },
        function(){
          swal({
            title: "ยืนยันการดำเนินการ",
            text: "ยืนยันการไปสู่หน้าส่งข้อเสนอแนะต่อเลขา EC",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "ตกลง",
            cancelButtonText: "ยกเลิก",
            closeOnConfirm: true
          },function(){

            preload.show()

            var param = {
              id_rs: current_project,
              uid: current_user,
              msg: message_send_ec_2.getData()
            }
            var jxr = $.post(conf.api + 'staff/change_research_status?stage=to28', param, function(){})
                       .always(function(resp){
                         console.log(resp);
                         if(resp == 'Y'){

                           var param2 = {
                             id_rs: current_project,
                             id: current_user
                           }

                           var jxhr2 = $.post(conf.api + 'general/get_ec_info_response_to_research_with_check.php', param2, function(){}, 'json')
                                       .always(function(snap){
                                         console.log(snap);
                                         if((snap != '') && (snap.length > 0)){

                                           snap.forEach(function(i){
                                             var dataContent2 = '<h3>REC.' + i.code_apdu + ' รอดำเนินการ</h3>' +
                                                               '<p>เรียน ' + i.fname + ' ' + i.lname + '</p>' +
                                                               '<p>มีการแจ้งโครงการวิจัยรอดำเนินการ รหัส REC.' + i.code_apdu + ' กรุณาเข้าสู่ระบบ RMIS และดำเนินการต่อ' +
                                                               'ได้ที่ ' + conf.domain +' </p>' +
                                                               '<p>จึงเรียนมาเพื่อทราบ <br>ระบบสารสนเทศเพื่อการจัดการงานวิจัย (RMIS)</p>';

                                             var param = {
                                               title: 'REC.' + i.code_apdu + ' : รอดำเนินการ',
                                               content: dataContent2,
                                               user: 'rmismedpsu@gmail.com',
                                               key: 'cm1pc21lZHBzdUBnbWFpbC5jb20yMDE5LTEwLTIyIDIxOjU4OjU3MTI0LjEyMi40Mi4yNDU=',
                                               toemail: i.email,
                                               toname: i.fname + ' ' + i.lname
                                             }

                                             fnc.send_email(param, 'index.php?uid=' + current_user + '&role=' + current_role, 'กดตกลงเพื่อกลับสู่หน้ารายการ', 'ระบบได้ดำเนินการตามกระบวนที่ท่านได้ดำเนินการแล้ว แต่เกิดข้อผิดพลาดในส่วนของการส่งอีเมล กรุณาแจ้งเจ้าหน้าที่เพื่อตรวจสอบและดำเนินการแก้ไข', true)
                                             return ;
                                           })

                                         }else{
                                           preload.hide()
                                           swal("คำเตือน", "ไม่พบข้อมูลเลขา", "error")
                                           return ;
                                         }
                                       }, 'json')
                         }else{
                           setTimeout(function(){
                             preload.hide()
                             swal("ขออภัย", "ไม่สามารถดำเนินการได้", "error")
                           }, 1000)
                         }
                       })
          })
        });

      }else{
        swal({
          title: "ยืนยันการดำเนินการ",
          text: "ยืนยันการไปสู่หน้าส่งข้อเสนอแนะต่อเลขา EC",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "ตกลง",
          cancelButtonText: "ยกเลิก",
          closeOnConfirm: true
        },function(){

          preload.show()

          var param = {
            id_rs: current_project,
            uid: current_user,
            msg: message_send_ec_2.getData()
          }
          var jxr = $.post(conf.api + 'staff/change_research_status?stage=to28', param, function(){})
                     .always(function(resp){
                       console.log(resp);
                       if(resp == 'Y'){

                         var param2 = {
                           id_rs: current_project,
                           id: current_user
                         }

                         var jxhr2 = $.post(conf.api + 'general/get_ec_info_response_to_research_with_check.php', param2, function(){}, 'json')
                                     .always(function(snap){
                                       console.log(snap);
                                       if((snap != '') && (snap.length > 0)){

                                         snap.forEach(function(i){
                                           var dataContent2 = '<h3>REC.' + i.code_apdu + ' รอการดำเนินการ</h3>' +
                                                             '<p>เรียน ' + i.fname + ' ' + i.lname + '</p>' +
                                                             '<p>มีการแจ้งโครงการวิจัยรอดำเนินการ รหัส REC.' + i.code_apdu + ' กรุณาเข้าสู่ระบบ RMIS และดำเนินการต่อ' +
                                                             'ได้ที่ ' + conf.domain +' </p>' +
                                                             '<p>จึงเรียนมาเพื่อทราบ <br>ระบบสารสนเทศเพื่อการจัดการงานวิจัย (RMIS)</p>';

                                           var param = {
                                             title: 'REC.' + i.code_apdu + ' : รอการดำเนินการ',
                                             content: dataContent2,
                                             user: 'rmismedpsu@gmail.com',
                                             key: 'cm1pc21lZHBzdUBnbWFpbC5jb20yMDE5LTEwLTIyIDIxOjU4OjU3MTI0LjEyMi40Mi4yNDU=',
                                             toemail: i.email,
                                             toname: i.fname + ' ' + i.lname
                                           }

                                           fnc.send_email(param, 'index.php?uid=' + current_user + '&role=' + current_role, 'กดตกลงเพื่อกลับสู่หน้ารายการ', 'ระบบได้ดำเนินการตามกระบวนที่ท่านได้ดำเนินการแล้ว แต่เกิดข้อผิดพลาดในส่วนของการส่งอีเมล กรุณาแจ้งเจ้าหน้าที่เพื่อตรวจสอบและดำเนินการแก้ไข', true)
                                           return ;
                                         })

                                       }else{
                                         preload.hide()
                                         swal("คำเตือน", "ไม่พบข้อมูลเลขา", "error")
                                         return ;
                                       }
                                     }, 'json')
                       }else{
                         setTimeout(function(){
                           preload.hide()
                           swal("ขออภัย", "ไม่สามารถดำเนินการได้", "error")
                         }, 1000)
                       }
                     })
        })
      }

    })
})

var status_other = {
    send_message_21_invalid(param){
      swal({
          title: "คำเตือน",
          text: "ท่านยืนยันการดำเนินการหรือไม่",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "ยืนยัน",
          cancelButtonText: "ยกเลิก",
          closeOnConfirm: true
      },function(){
        preload.show()
        var xjr = $.post(conf.api + 'staff/rs_status_other?stage=change_to_20', param, function(){}, 'json')
                   .always(function(snap){
                       console.log(snap);
                        if(fnc.json_exist(snap)){
                            snap.forEach(i => {
                                var dataContent = '<h3>ชื่อเรื่อง : ผลการตรวจสอบความถูกต้องของเอกสารโครงการวิจัยที่ขอรับพิจารณาจริยธรรมการวิจัยในมนุษย์</h3>' +
                                                  '<p>ชื่อโครงการ (ภาษาไทย) : ' + i.title_th + '</p>' +
                                                  '<p>ชื่อโครงการ (English) : ' + i.title_en + ' </p>' +
                                                  '<p>รหัสโครงการ : ' + i.rec_id + ' </p>' +
                                                  '<p>เรียน ' + i.fullname + '</p>' +
                                                  "<p>เจ้าหน้าที่ได้ทำการตรวจสอบความครบถ้วนและถูกต้องเอกสาร พบว่า <span style=\"color: red;\"><strong style=color:red;>เอกสารยังไม่ถูกต้อง/ไม่ครบถ้วน</strong></span> จึงขอให้ท่านดำเนินการต่อไปนี้</p>" +
                                                  '<p style="padding: 20px; background: rgb(240, 240, 240);"> -------------------------------------------' +
                                                    '<div style="padding: 20px; background: rgb(240, 240, 240);">' + message_21.getData() + '</div>' +
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
      })
    },
    send_message_21_valid(param){
      swal({
          title: "คำเตือน",
          text: "ท่านยืนยันการดำเนินการหรือไม่",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "ใช่",
          cancelButtonText: "ยกเลิก",
          closeOnConfirm: true
      },function(){
          preload.show()
          var xjr = $.post(conf.api + 'staff/rs_status_other?stage=change_to_3_or_6', param, function(){}, 'json')
                 .always(function(snap){
                   console.log(snap);
                      if(fnc.json_exist(snap)){
                          snap.forEach(i=>{
                                    var dataContent = '<p style="font-size: 1.3em;"><strong>รหัสโครงการ <span style="color: red;">REC ' + i.rec_id + '</span></strong></p>' +
                                                      '<p><strong>ชื่อโครงการ (ภาษาไทย)</strong> ' + i.title_th + '<br><strong>ชื่อโครงการ (English)</strong> ' + i.title_en + '</p>' +
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
                                          title: "{No-reply} REC." + i.rec_id + " : แจ้งผลการตรวจสอบเอกสารหลังได้รับเอกสารเพิ่มเพิ่ม/แก้ไขตามข้อเสนอแนะ",
                                          content: str,
                                          user: 'rmismedpsu@gmail.com',
                                          key: 'cm1pc21lZHBzdUBnbWFpbC5jb20yMDE5LTEwLTIyIDIxOjU4OjU3MTI0LjEyMi40Mi4yNDU=',
                                          toemail: i.email,
                                          toname: i.fullname
                                    }
                                    fnc.send_email(param, 'none', 'กดตกลงเพื่อกลับสู่หน้าแรก', 'ระบบได้ดำเนินการตามกระบวนที่ท่านได้ดำเนินการแล้ว แต่เกิดข้อผิดพลาดในส่วนของการส่งอีเมล กรุณาแจ้งเจ้าหน้าที่เพื่อตรวจสอบและดำเนินการแก้ไข', false)

                                    var dataContent2 = '<h3>REC.' + i.rec_id + ' โครงการวิจัยรอการตรวจสอบ</h3>' +
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
    },
    send_message_other(param){
      swal({
          title: "คำเตือน",
          text: "ท่านยืนยันการดำเนินการหรือไม่",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "ยืนยัน",
          cancelButtonText: "ยกเลิก",
          closeOnConfirm: true
      },function(){
        preload.show()
        var xjr = $.post(conf.api + 'staff/rs_status_other?stage=change_to_20', param, function(){}, 'json')
                   .always(function(snap){
                     if(fnc.json_exist(snap)){
                       snap.forEach(i=>{
                         $frow = '<strong>รหัสโครงการ</strong> <span style="color: red;">REC.' + i.rec_id + '</span><br>'
                         if((i.rec_id == '') || (i.rec_id == null)){
                           $frow = '<strong>รหัสลงทะเบียนโครงการ</strong> <span style="color: red;">' + current_project + '</span><br>'
                         }
                                 var dataContent = $frow +
                                                   '<p>' +
                                                      '<strong>เรื่อง</strong> ขอเอกสารเพิ่มเติมเพื่อประกอบการพิจารณาจริยธรรมการวิจัยในมนุษย์ / โครงการรอดำเนินการอื่น ๆ<br>' +
                                                      $frow +
                                                      '<strong>เรียน</strong> ' + i.fullname +
                                                   '</p>' +
                                                   '<p>' +
                                                   'เนื่องจากทางสำนักงานจริยธรรมการวิจัยในมนุษย์ได้ทำการตรวจสอบข้อมูลโครงการวิจัยเรื่อง ' + i.title_th + ' (' + i.title_en + ') และมีความเห็นจากเลขานุการเพื่อขอรายละเอียด/เอกสารเพิ่มเติม ดังนี้' +
                                                   '</p>' +
                                                   '<p>' +
                                                    param.message +
                                                   '</p>' +
                                                   '<p>จึงเรียนมาเพื่อทราบและดำเนินการต่อไป</p>' +
                                                   '<p>หมายเหตุ : กรุณาอย่าตอบกลับทาง e-mail นี้ <br>ท่านสามารถตรวจสอบสถานะของโครงการโดยเข้าไปที่ระบบ RMIS ' + conf.domain + '  หรือติดต่อเจ้าหน้าที่ (คุณณัฎฐา  ศิริรักษ์) โทร.1149, 1157</p>';

                                 var str = dataContent.replace(/\n/g, ' ')
                                 var param3 = {
                                       title: "{No-reply} REC." + i.rec_id + " : ขอเอกสารเพิ่มเติมเพื่อประกอบการพิจารณาจริยธรรมการวิจัยในมนุษย์ / ดำเนินการอื่น ๆ",
                                       content: str,
                                       user: 'rmismedpsu@gmail.com',
                                       key: 'cm1pc21lZHBzdUBnbWFpbC5jb20yMDE5LTEwLTIyIDIxOjU4OjU3MTI0LjEyMi40Mi4yNDU=',
                                       toemail: i.email,
                                       toname: i.fullname
                                 }
                                 fnc.send_email(param3, 'index?uid=' + current_user + '&role=staff', 'กดตกลงเพื่อกลับสู่หน้าแรก', 'ระบบได้ดำเนินการตามกระบวนที่ท่านได้ดำเนินการแล้ว แต่เกิดข้อผิดพลาดในส่วนของการส่งอีเมล กรุณาแจ้งเจ้าหน้าที่เพื่อตรวจสอบและดำเนินการแก้ไข', true)

                       })
                     }else{
                       preload.hide()
                       swal("เกิดข้อผิดพลาด", "ไม่สามารถปรับสถานะโครงการได้", "error")
                     }
                   })
      })


    },
    status1_denine(param){
        preload.show()
        var xjr = $.post(conf.api + 'staff/rs_status_1?stage=change_to_2', param, function(){}, 'json')
                   .always(function(snap){
                       console.log(snap);
                        if(fnc.json_exist(snap)){
                            snap.forEach(i => {
                                var dataContent = '<h3>ชื่อเรื่อง : ผลการตรวจสอบความถูกต้องของเอกสารโครงการวิจัยที่ขอรับพิจารณาจริยธรรมการวิจัยในมนุษย์</h3>' +
                                                '<p>ชื่อโครงการ (ภาษาไทย) : ' + $('#title_th').text() + '</p>' +
                                                '<p>ชื่อโครงการ (English) : ' + $('#title_en').text() + ' </p>' +
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
