var message_send_reviewer = null
var message_send_ec = null


if($("#messagebox_send_reviewer").length) {
    message_send_reviewer = CKEDITOR.replace( 'messagebox_send_reviewer', {
        wordcount : {
        showCharCount : false,
        showWordCount : true,
        maxWordCount: 500
        },
        height: '400px'
    });
}

if($("#messagebox_send_ec").length) {
    message_send_ec = CKEDITOR.replace( 'messagebox_send_ec', {
        wordcount : {
        showCharCount : false,
        showWordCount : true,
        maxWordCount: 500
        },
        height: '200px'
    });
}


function setEmailContent_reviewer(id, rir_status, reviewer_name, reviewer_email, reviewer_password, code_apdu, rct_type){
    $('#txtRID2').val(id)

      $('#txtEM').val(reviewer_email)
      $('#txtRwtype').val(rir_status)
      $('#txtRType').val(rct_type)
      $('#txtCodeBC').val(code_apdu)
      $('#txtRwname').val(reviewer_name)
    var  content =  "<p><strong>ขอเชิญเป็นผู้เชี่ยวชาญอิสระ</strong></p>" + "<p><strong>เรียน</strong> คุณ" + reviewer_name + " ที่นับถือ </p>" +
                    "<p>สำนักงานจริยธรรมฯ คณะแพทยศาสตร์ ม.สงขลานครินทร์ ขอทาบทามท่านเป็น<u><b>ผู้เชี่ยวชาญอิสระ </b></u> เนื่องจาก ได้พิจารณาแล้วว่าท่านเป็นผู้มีความเชี่ยวชาญ และคุณวุฒิเหมาะสมในการพิจารณาโครงการที่แสดงข้างล่างนี้ " +
                        "<p>ชื่อโครงการ (ไทย) : " + $('#txtTitle_th').val() + "<br>ชื่อโครงการ (อังกฤษ) : " + $('#txtTitle_en').val() + "</p>" +
                        "เพื่อให้งานวิจัยของคณะแพทยศาสตร์มีคุณภาพ เกิดประโยชน์สูงสุด และเป็นไปตามหลักจริยธรรมการวิจัยในมนุษย์" +
                    "" +
                    "<p><strong>ขอความอนุเคราะห์จากท่าน</strong></p>" +
                        "<ol>" +
                            "<li>ประเมินโครงการวิจัย โดยกรอกความคิดเห็นและข้อแนะนำของท่านในแบบประเมิน ซึ่งอยู่ในระบบสารสนเทศเพื่อการจัดการงานวิจัย (RMIS) (คลิกลิ้งค์ด้านล่าง หากยินดีประเมินโครงการ)</li>" +
                        "</ol>" +
                    "กำหนดส่งผลการประเมินโครงการ ภายในวันที่  " + getNext14Days() + " เพื่อให้เจ้าหน้าที่สำนักงานฯ ดำเนินการต่อไปได้ตามกรอบเวลา" +
                    "<p>โปรดคลิกที่ลิ้งค์ เพื่อเลือกการตัดสินใจของท่าน</p>" +
                        "<ol>" +
                            "<li style='padding-bottom: 30px;'><u><b>ยินดีประเมินโครงการ ผ่านระบบ electronics </b></u> " + conf.domain + "controller/bp.php?email=" + reviewer_email +"&sid=" + reviewer_password + "&pid=" + id +"&next=aknowledge</a><br><br></li>" +
                            "<li style='padding-bottom: 30px;'><u><b>ยินดีประเมินโครงการ ผ่านระบบ electronics แต่ขอรับไฟล์โครงการในรูปแบบเอกสารด้วย </b></u> " + conf.domain + "controller/bp.php?email=" + reviewer_email +"&sid=" + reviewer_password + "&pid=" + id +"&next=aknowledgehardcopy</a><br><br></li>" +
                            "<li style='padding-bottom: 30px;'><u><b><span class=txt-danger>ไม่สะดวกในการประเมินโครงการ </span></b></u> " + conf.domain + "controller/bp.php?email=" + reviewer_email +"&sid=" + reviewer_password + "&pid=" + id +"&next=cannotassesment<br><br></li>" +
                        "</ol>" +
                    "" +
                    "<p>สำนักงานจริยธรรมการวิจัย ขอขอบพระคุณท่านเป็นอย่างสูงสำหรับความอนุเคราะห์ในครั้งนี้ </p>" +
                    "<p>หากลิงค์ไม่ทำงาน กรุณา copy ลิงค์เพื่อเปิดกับเว็บเบราว์เซอร์ <br>" +
                    "สอบถามเพิ่มเติม ติดต่อ คุณณัฎฐา ศิริรักษ์ สำนักงานจริยธรรมการวิจัยในมนุษย์<br>" +
                    "E-mail: sinuttha@medicine.psu.ac.th หรือ โทร. 1149 และ1157</p>" +
                    "<p>หมายเหตุ : ** กรุณาอย่าตอบกลับอีเมลฉบับนี้ (Do not reply)</p>" +
                    "<hr>" +
                    "<p>สำนักงานจริยธรรมการวิจัยในมนุษย์ หน่วยส่งเสริมและพัฒนาทางวิชาการ คณะแพทยศาสตร์ มหาวิทยาลัยสงขลานครินทร์" +
                    "<br>(Human Research Ethic Committee, Faculty of Medicine, Prince of Songkla University) </p>";
                    message_send_reviewer.setData(content)
                    $('#txtEmailTitle').val("คณะกรรมการจริยธรรมการวิจัยขอความอนุเคราะห์เป็น Reviewer ประเมินโครงการวิจัย REC." + code_apdu )
                    // console.log(content);
}

$(function(){
    $('.form_send_reviewer').submit(function(){
        var msg = message_send_reviewer.getData()
        if(msg == ''){
          swal("คำเตือน", "กรุณากรอกข้อความที่จะส่งถึงผู้เชี่ยวชาญอิสระก่อนทำการบันทึก", "error")
          return ;
        }
        swal({
            title: "ยืนยันการดำเนินการ",
            text: "คุณแน่ใจหรือไม่ที่จะส่งข้อความนี้ไปยังผู้เชี่ยวชาญอิสระ!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "ยืนยันการส่ง",
            cancelButtonText: "ยกเลิก",
            closeOnConfirm: true },
            function(){
                preload.show()

                var param = {
                rir_id: $('#txtRID2').val(),
                id: current_user,
                msg_send: msg,
                id_rs: current_project
                }

                var jxhr = $.post(conf.api + 'staff/send_reviewer_msg1.php', param, function(){})
                            .always(function(resp){
                                console.log(resp);

                                if(resp == 'Y'){
                                    var str = msg.replace(/\n/g, ' ')
                                    var param = {
                                        title: $('#txtEmailTitle').val(),
                                        content: str,
                                        user: 'rmismedpsu@gmail.com',
                                        key: 'cm1pc21lZHBzdUBnbWFpbC5jb20yMDE5LTEwLTIyIDIxOjU4OjU3MTI0LjEyMi40Mi4yNDU=',
                                        toemail: $('#txtEM').val(),
                                        toname: $('#txtRwname').val()
                                    }

                                    fnc.send_email(param, 'reload', 'ท่านส่งอีเมลถึงเชี่ยวชาญอิสระเรียบร้อยแล้ว', 'ระบบได้ดำเนินการตามกระบวนที่ท่านได้ดำเนินการแล้ว แต่เกิดข้อผิดพลาดในส่วนของการส่งอีเมล กรุณาแจ้งเจ้าหน้าที่เพื่อตรวจสอบและดำเนินการแก้ไข', true)
                                    $('.btnClosemodal').trigger('click')
                                    return ;
                                }else{

                                }
                })
        });
    })

    $('#btnFbtoEC').click(function(){
        swal({
          title: "ยืนยันการดำเนินการ",
          text: "ยืนยันส่งกลับเลขา EC เพื่อทำการเลือกผู้เชี่ยวชาญอิสระใหม่/เพิ่มเติมหรือไม่",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "ตกลง",
          cancelButtonText: "ยกเลิก",
          closeOnConfirm: true
        },function(){

          preload.show()

          var param = {
            id: current_user,
            id_rs: $('#textId_rs').val(),
            msg: message_send_ec.getData()
          }

          var jxhr = $.post(conf.api + 'staff/renew_reviewer.php', param, function(){})
                      .always(function(resp){
                        if(resp == 'Y'){
                            //Send email to ec
                            var jxhr2 = $.post(conf.api + 'general/get_ec_info_response_to_research.php', param, function(){}, 'json')
                                        .always(function(snap){
                                          console.log(snap);
                                          if((snap != '') && (snap.length > 0)){

                                            snap.forEach(function(i){
                                              var dataContent2 = '<h3>REC.' + i.code_apdu + ' รอการเลือกผู้เชี่ยวชาญอิสระ(เพิ่มเติม)</h3>' +
                                                                '<p>เรียน ' + i.fname + ' ' + i.lname + '</p>' +
                                                                '<p>มีการแจ้งโครงการวิจัยรอการเลือกผู้เชี่ยวชาญอิสระ(เพิ่มเติม)จากเจ้าหน้าที่ รหัส REC.' + i.code_apdu + ' กรุณาเข้าสู่ระบบ RMIS และดำเนินการต่อ' +
                                                                'ได้ที่ ' + conf.domain +' </p>' +
                                                                '<p>จึงเรียนมาเพื่อทราบ <br>ระบบสารสนเทศเพื่อการจัดการงานวิจัย (RMIS)</p>';

                                              var param = {
                                                title: 'REC.' + i.code_apdu + ' : รอการเลือกผู้เชี่ยวชาญอิสระ(เพิ่มเติม)จากเจ้าหน้าที่',
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
                                        .fail(function(){
                                            preload.hide()
                                            swal("คำเตือน", "ไม่สามารถเชื่อมต่อฐานข้อมูลได้ (1)", "error")
                                            return ;
                                        })

                        }else{
                            preload.hide()
                            swal("คำเตือน", "ไม่สามารถเชื่อมต่อฐานข้อมูลได้ (2)", "error")
                            return ;
                        }
                      })
        });
    })

    $('#btnSummary').click(function(){
      // $('#modalSummary').modal()
      $('#btnAction_4').trigger('click')
    })
})

function conFirmPayment(rir_id){
    swal({    title: "คุณแน่ใจหรือไม่",
              text: "หากปรับสถานะแล้วจะไม่สามารถกลับมาแก้ไขได้อีก",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "ยืนยัน",
              closeOnConfirm: false },
              function(){

                preload.show()

                var param = {
                    uid: current_user,
                    rir_id: rir_id
                  }

                  var jxhr = $.post(conf.api + 'staff/reviewer_payment.php', param, function(){})
                              .always(function(resp){
                                  console.log(resp);

                                if(resp == 'Y'){
                                    window.location.reload()
                                }else{
                                    preload.hide()
                                    swal("เกิดข้อผิดพลาด", "ไม่สามารถปรับสถานะได้", "error")
                                }
                              })
              });

}
