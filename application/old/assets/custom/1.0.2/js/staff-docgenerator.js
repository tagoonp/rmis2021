var editor_doclist = null


if($("#txtDoclist").length) {
    editor_doclist = CKEDITOR.replace( 'txtDoclist', {
        wordcount : {
        showCharCount : false,
        showWordCount : true,
        },
        height: '250px'
    });
}

$(function(){
  $('#btnBacktoinfo').click(function(){
    window.history.back()
  })
})

function checkDoclist(lang){
  $previous_content = $('#docList').html()

  var param = {
    id_rs: current_project,
    lang: lang
  }
  var jxr = $.post(conf.api + 'staff/approval_doc?stage=doclist', param , function(resp){})
             .always(function(resp){
               if(resp == 'N'){
                 editor_doclist.setData($previous_content)
               }else{
                 editor_doclist.setData(resp)
               }
             })
}

function sendECReview(lang, type){
  preload.show()
  var param = {
    id_rs: current_project,
    uid: current_user,
    lang: lang,
    fullcontent: $('#printArea1').html(),
    doctype: type
  }
  var jxr = $.post(conf.api + 'staff/approval_doc?stage=sendtoreview', param , function(){})
             .always(function(resp){
               if(resp == 'Y'){
                 var param = {
                       id: current_user,
                       id_rs: current_project,
                       status: '1'
                 }

                 var jxhrx = $.post(conf.api + 'general/get_ec_info_response_to_research_with_check', param, function(){}, 'json')
                              .always(function(snap){
                                if(fnc.json_exist(snap)){
                                  snap.forEach(i=>{
                                    var dataContent2 = '<h3>REC.' + i.code_apdu + ' โครงการวิจัยรอดำเนินการ</h3>' +
                                                       '<p>เรียน ' + i.fname + ' ' + i.lname + '</p>' +
                                                       '<p>มีโครงการวิจัยรอดำเนินการ รหัส REC.' + i.code_apdu + ' กรุณาเข้าสู่ระบบ RMIS และดำเนินการต่อ' +
                                                       'ได้ที่ ' + conf.domain +'</a></p>' +
                                                       '<p>จึงเรียนมาเพื่อทราบ <br>ระบบสารสนเทศเพื่อการจัดการงานวิจัย (RMIS)</p>';
                                    var str = dataContent2.replace(/\n/g, ' ')
                                    var param3 = {
                                          title: "โครงการวิจัยรอดำเนินการ",
                                          content: str,
                                          user: 'rmismedpsu@gmail.com',
                                          key: 'cm1pc21lZHBzdUBnbWFpbC5jb20yMDE5LTEwLTIyIDIxOjU4OjU3MTI0LjEyMi40Mi4yNDU=',
                                          toemail: i.email,
                                          toname: i.fname + ' ' + i.lname
                                    }
                                    fnc.send_email(param3, 'none', 'กดตกลงเพื่อกลับสู่หน้าแรก', 'ระบบได้ดำเนินการตามกระบวนที่ท่านได้ดำเนินการแล้ว แต่เกิดข้อผิดพลาดในส่วนของการส่งอีเมล กรุณาแจ้งเจ้าหน้าที่เพื่อตรวจสอบและดำเนินการแก้ไข', false)

                                    setTimeout(function(){
                                      preload.hide()
                                      swal({
                                        title: "ดำเนินการสำเร็จ",
                                        text: "ข้อมูลถูกส่งไปยังเลขา EC เรียบร้อยแล้ว",
                                        type: "warning",
                                        showCancelButton: false,
                                        confirmButtonColor: "#DD6B55",
                                        confirmButtonText: "รับทราบ",
                                        cancelButtonText: "ยกเลิก",
                                        closeOnConfirm: true },
                                      function(){
                                        window.location = './index?uid=' + current_user + '&role=' + current_role
                                      })
                                    }, 5000)

                                  })
                                }else{
                                  setTimeout(function(){
                                    preload.hide()
                                    swal({
                                      title: "ดำเนินการสำเร็จ",
                                      text: "ข้อมูลถูกส่งไปยังเลขา EC เรียบร้อยแล้ว โดยไม่มีอีเมลแจ้งเตือน",
                                      type: "warning",
                                      showCancelButton: false,
                                      confirmButtonColor: "#DD6B55",
                                      confirmButtonText: "รับทราบ",
                                      cancelButtonText: "ยกเลิก",
                                      closeOnConfirm: true },
                                    function(){
                                      window.location = './index?uid=' + current_user + '&role=' + current_role
                                    })
                                  }, 1000)
                                }
                              })
               }else{
                 preload.hide()
                 swal("เกิดข้อผิดพลาด", "ไม่สามารทำการบันทึกได้", "error")
               }
             })
}

function sendCMReview(lang, dtype){

  swal({
    title: "ยืนยันดำเนินการ",
    text: "หากดำเนินการแล้วจะไม่สามารถนำกลับมาแก้ไขได้อีก",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "ยืนยัน",
    cancelButtonText: "ยกเลิก",
    closeOnConfirm: true },
  function(){

    preload.show()
    var param = {
      id_rs: current_project,
      uid: current_user,
      lang: lang,
      fullcontent: $('#printArea1').html(),
      doctype: dtype
    }
    var jxr = $.post(conf.api + 'staff/approval_doc?stage=sendtosign', param , function(){})
               .always(function(resp){

                 console.log(resp);
                 if(resp == 'Y'){

                   var param = {
                         id: current_user,
                         id_rs: current_project,
                         status: '1'
                   }

                   var jxhrx = $.post(conf.api + 'staff/get_chairman_info', param, function(){}, 'json')
                                .always(function(snap){
                                  if(fnc.json_exist(snap)){
                                    snap.forEach(i=>{
                                      var dataContent2 = '<h3>REC.' + $('#txtRec').text() + ' โครงการวิจัยรอดำเนินการ</h3>' +
                                                         '<p>เรียน ' + i.fname + ' ' + i.lname + '</p>' +
                                                         '<p>มีโครงการวิจัยรอลงนาม รหัส REC.' + $('#txtRec').text() + ' กรุณาเข้าสู่ระบบ RMIS และดำเนินการต่อ' +
                                                         'ได้ที่ ' + conf.domain +'</a></p>' +
                                                         '<p>จึงเรียนมาเพื่อทราบ <br>ระบบสารสนเทศเพื่อการจัดการงานวิจัย (RMIS)</p>';
                                      var str = dataContent2.replace(/\n/g, ' ')
                                      var param3 = {
                                            title: "โครงการวิจัยรอดำเนินการ",
                                            content: str,
                                            user: 'rmismedpsu@gmail.com',
                                            key: 'cm1pc21lZHBzdUBnbWFpbC5jb20yMDE5LTEwLTIyIDIxOjU4OjU3MTI0LjEyMi40Mi4yNDU=',
                                            toemail: i.email,
                                            toname: i.fname + ' ' + i.lname
                                      }
                                      fnc.send_email(param3, 'none', 'กดตกลงเพื่อกลับสู่หน้าแรก', 'ระบบได้ดำเนินการตามกระบวนที่ท่านได้ดำเนินการแล้ว แต่เกิดข้อผิดพลาดในส่วนของการส่งอีเมล กรุณาแจ้งเจ้าหน้าที่เพื่อตรวจสอบและดำเนินการแก้ไข', false)

                                      setTimeout(function(){
                                        preload.hide()
                                        swal({
                                          title: "ดำเนินการสำเร็จ",
                                          text: "ข้อมูลถูกส่งไปยังประธานเรียบร้อยแล้ว",
                                          type: "warning",
                                          showCancelButton: false,
                                          confirmButtonColor: "#DD6B55",
                                          confirmButtonText: "รับทราบ",
                                          cancelButtonText: "ยกเลิก",
                                          closeOnConfirm: true },
                                        function(){
                                          window.location = './index?uid=' + current_user + '&role=' + current_role
                                        })
                                      }, 5000)

                                    })
                                  }else{
                                    setTimeout(function(){
                                      preload.hide()
                                      swal({
                                        title: "ดำเนินการสำเร็จ",
                                        text: "ข้อมูลถูกส่งไปยังประธานเรียบร้อยแล้ว โดยไม่มีอีเมลแจ้งเตือน",
                                        type: "warning",
                                        showCancelButton: false,
                                        confirmButtonColor: "#DD6B55",
                                        confirmButtonText: "รับทราบ",
                                        cancelButtonText: "ยกเลิก",
                                        closeOnConfirm: true },
                                      function(){
                                        window.location = './index?uid=' + current_user + '&role=' + current_role
                                      })
                                    }, 1000)
                                  }
                                })
                 }else{
                   preload.hide()
                   swal("เกิดข้อผิดพลาด", "ไม่สามารทำการบันทึกได้", "error")
                 }
               })

  });

}
