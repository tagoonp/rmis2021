
var message_fb_notify = null
var fileApprovalStatus = 0

if($("#txtFBNotify").length) {
    message_fb_notify = CKEDITOR.replace( 'txtFBNotify', {
        wordcount : {
        showCharCount : false,
        showWordCount : true
        },
        height: '300px'
    });

    $fbConntent = '<p><strong>เรื่อง</strong> แจ้งวาระการพิจารณาจริยธรรมการวิจัยในกรรมการเต็มชุด</p>' +
                      '<p><strong>เรียน</strong> ' + $('#txtPi').text() + ' ที่นับถือ</p>' +
                      '<p>ตามที่ท่านเสนอโครงร่างการวิจัยเพื่อขอรับพิจารณาจริยธรรมการวิจัยในมนุษย์ เรื่อง ' + $('#txtThtitle').text() + ' (' + $('#txtEntitle').text() + ') หมายเลขโครงการ <span style="color:red;">REC.' + $('#txtCode').text() + '</span> <br>โครงการของท่านได้ถูกกำหนดให้นำเข้า<strong>พิจารณาโดยคณะกรรมการเต็มชุด ในการประชุม ครั้งที่ ....../....... วันที่ ......... ช่วงเวลา .......</strong></p>' +
                      '<p><strong>ขอให้ท่าน standby ในวันเวลาดังกล่าว เนื่องจากกรรมการอาจโทรศัพท์สอบถามข้อมูลเกี่ยวกับโครงการของท่านเพิ่มเติมระหว่างพิจารณา</strong></p>' +
                      '<p>จึงเรียนมาเพื่อทราบ&nbsp;<br />' +
                      'ระบบสารสนเทศเพื่อการจัดการงานวิจัย (RMIS)</p>' +
                      '<p>หมายเหตุ : <br>* ท่านสามารถตรวจสอบสถานะโครงการของท่านด้วยตนเองได้ที่ ' + conf.domain + ' <br>*** กรุณาอย่าตอบกลับทางอีเมลฉบับนี้ หากมีข้อสงสัย กรุณาติดต่อเจ้าหน้าที่สำนักงาน คุณณัฎฐา ศิริรักษ์ โทร 1149, 1157</p>'
                       ;
    message_fb_notify.setData($fbConntent)
}



$('.form_board_notify').submit(function(){
    sendFBPI();
})

function sendFBPI(){
    var check = 0;
    var emailContent = message_fb_notify.getData();
    $('.form-group').removeClass('is-invalid')

    if($('#txtTimemeeting').val() == ''){
      check++
      $('#txtTimemeeting').addClass('is-invalid')
    }

    if($('#txtSet').val() == ''){
      check++
      $('#txtSet').addClass('is-invalid')
    }

    if($('#txtAgender').val() == ''){
      check++
      $('#txtAgender').addClass('is-invalid')
    }

    if($('#m_date').val() == ''){
      check++
      $('#m_date').addClass('is-invalid')
    }

    if(emailContent == ''){
      check++
    }

    if(check != 0){
      swal("ขออภัย", "กรุณากรอกข้อมูลให้ครบถ้วน", "error")
      return ;
    }

    swal({
      title: "ยืนยันดำเนินการ",
      text: "หากดำเนินการแล้ว จะไม่สามารถกลับมาแก้ไขได้อีก",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "ยืนยัน",
      cancelButtonText: "ยกเลิก",
      closeOnConfirm: true },
    function(){

      $('#btnCloseModal').trigger('click')
      preload.show()

      //Set mdate US
      var md = $('#m_date').val()
      var x = md.split('-')
      var new_md = (x[0] - 543) + '-' + x[1] + '-' + x[2]
      var new_md = md

      var param = {
        id_rs: $('#textId_rs').val(),
        id: current_user,
        tmeeting: $('#txtTimemeeting').val(),
        mset: $('#txtSet').val(),
        argendar: $('#txtAgender').val(),
        mdate: new_md
      }

    //   console.log(param);
    //   return ;

      var jxhr = $.post(conf.api + 'staff/set_fb_argendar.php', param, function(){})
                  .always(function(resp){
                    if(resp == 'Y'){

                      var param2 = {
                        id_rs: $('#textId_rs').val()
                      }

                      var jxh = $.post(conf.api + 'general/check_board_ec.php', param2, function(){}, 'json')
                                 .always(function(r2){
                                   console.log(r2);
                                   if((r2 != '') && (r2.length > 0)){
                                      r2.forEach(function(rr){
                                        var ec_content = '<p>เรื่อง แจ้งวาระการเข้ารับการพิจารณาโดยคณะกรรมการเต็มชุด</p>' +
                                                         '<p>เรียน คุณ' + rr.fname + ' ' + rr.lname + '</p>' +
                                                         '<p>โครงการ REC.' + $('#txtCode').text() + ' ได้ถูกกำหนดให้นำเข้าพิจารณาในกรรมการเต็มชุด โดยมีท่านเป็นเลขาการประชุมในการประชุม ครั้งที่ ' + $('#txtTimemeeting').val() + ' ประจำวันที่ ' + fnc.convertThaidate(new_md) + ' วาระ ' + $('#txtAgender').val() + ' ชุดที่ ' + $('#txtSet').val() + '</p>' +
                                                         '<p>จึงเรียนมาเพื่อทราบ<br>ระบบสารสนเทศเพื่อการจัดการงานวิจัย (RMIS)</p>';

                                         var param = {
                                           title: "แจ้งวาระการเข้ารับการพิจารณาโดยคณะกรรมการเต็มชุด (Fullboard review) โครงการ REC." + $('#txtCode').text() ,
                                           content: ec_content,
                                           user: conf.mail_user,
                                           key: conf.mail_key,
                                           toemail: rr.email,
                                           toname: rr.fname + ' ' + rr.lname
                                          }

                                          fnc.send_email(param, 'none', 'ท่านได้ทำการปรับปรุงรหัสผ่านสำเร็จแล้ว ทั้งนี้ ระบบจะส่งข้อมูลรหัสผ่านใหม่ของท่านไปยังอีเมล', 'ระบบได้ดำเนินการตามกระบวนที่ท่านได้ดำเนินการแล้ว แต่เกิดข้อผิดพลาดในส่วนของการส่งอีเมล กรุณาแจ้งเจ้าหน้าที่เพื่อตรวจสอบและดำเนินการแก้ไข', false)

                                      })
                                   }else{
                                     console.log('ec error');
                                     alert('Error')
                                   }
                                 }, 'json')

                      var str = emailContent.replace(/\n/g, ' ')

                      var param = {
                       title: "แจ้งวาระการเข้ารับการพิจารณาโดยคณะกรรมการเต็มชุด (Fullboard review) โครงการ REC." + $('#txtCode').text() ,
                       content: str,
                       user: conf.mail_user,
                       key: conf.mail_key,
                       toemail: $('#txtpiEmail').val(),
                       toname: $('#txtPi').text()
                      }

                      fnc.send_email(param, 'reload', 'ข้อมูลถูกส่งไปยังผู้วิจัยเรียบร้อยแล้ว', 'ระบบได้ดำเนินการตามกระบวนที่ท่านได้ดำเนินการแล้ว แต่เกิดข้อผิดพลาดในส่วนของการส่งอีเมล กรุณาแจ้งเจ้าหน้าที่เพื่อตรวจสอบและดำเนินการแก้ไข', true)
                      return ;

                    }else{
                      swal("เกิดข้อผิดพลาด", "ไม่สามารถบันทึกและส่งข้อมููลได้", "error")
                      preload.hide()
                      return ;
                    }
                  })
                  .fail(function(){ onFail() })

      console.log(param);
      return ;



    });

  }

  $(function(){
    $('#fbReset').click(function(){
      swal({   title: "คำเตือน!",
           text: "ปุ่มนี้ใช้กับโครงการที่พร้อมเข้าประชุม Fullboard เท่านั้น",
           type: "warning",
           showCancelButton: true,
           confirmButtonColor: "#DD6B55",
           confirmButtonText: "ยืนยัน",
           cancelButtonText: "ยกเลิก",
           closeOnConfirm: false,
           closeOnCancel: true },
           function(isConfirm){
               if (isConfirm) {

                preload.show()

                var param = {
                  id_rs: $('#textId_rs').val(),
                  id: current_user
                }

                var jxr = $.post(conf.api + 'staff/reset_fb_agender.php', param, function(){})
                            .always(function(resp){
                              if(resp == 'Y'){
                                window.location.reload()
                              }else{
                              swal("เกิดข้อผิดพลาด", "ไม่สามารถบันทึกข้อมููลได้", "error")
                              preload.hide()
                              }
                            })
               }
          });
    })


    $('.projectTitleForm').submit(function(){
      $check = 0
      $('.form-control').removeClass('is-invalid')
      if($('#txtThtitle').val() == ''){
        $('#txtThtitle').addClass('is-invalid')
        $check++
      }
      if($('#txtEntitle').val() == ''){
        $('#txtEntitle').addClass('is-invalid')
        $check++
      }

      if($check != 0){
        return ;
      }

      if(current_project == null){
        swal({   title: "คำเตือน!",
             text: "การส่งข้อมูลไม่ครบถ้วน กดต่อลงเพื่อกลับสู่หน้าหลัก",
             type: "warning",
             showCancelButton: false,
             confirmButtonColor: "#DD6B55",
             confirmButtonText: "ยืนยัน",
             cancelButtonText: "ยกเลิก",
             closeOnConfirm: false,
             closeOnCancel: true },
        function(isConfirm){
            window.location = 'index?uid=' + current_user + '&role=' + current_role
        });
      }

      var param = {
        uid: current_user,
        id_rs: current_project,
        role: current_role,
        title_th: $('#txtThtitle').val(),
        title_en: $('#txtEntitle').val()
      }

      swal({
        title: "คำเตือน!",
        text: "กรุณาตรวจสอบความถูกต้องก่อนดำเนินการ กดปุ่ม ยืนยัน เพื่อดำเนินการต่อ",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "ยืนยัน",
        cancelButtonText: "ยกเลิก",
        closeOnConfirm: true,
        closeOnCancel: true
      },
      function(isConfirm){
        preload.show()
        var jxt = $.post(conf.api + 'staff/change_reseach_info?stage=updatetitle', param, function(){})
                   .always(function(resp){
                     setTimeout(function(){
                       if(resp == 'Y'){
                         preload.hide()
                         swal({
                           title: "ดำเนินการสำเร็จ",
                           text: "กด ตกลง เพื่อทำการรีโหลดข้อมูล",
                           type: "success",
                           showCancelButton: false,
                           confirmButtonColor: "#DD6B55",
                           confirmButtonText: "ยืนยัน",
                           cancelButtonText: "ตกลง",
                           closeOnConfirm: true,
                           closeOnCancel: true
                         },
                         function(isConfirm){
                           window.location.reload()
                         });
                       }else{
                         preload.hide()
                         swal("เกิดข้อผิดพลาด", "ไม่สามารถบันทึกข้อมููลได้", "error")
                       }
                     }, 1000)
                   })
      });

    })
  })
