var file_1 = 0
var file_2 = 0
var current_session = window.localStorage.getItem('rmis_curr_cont_session')
if(current_session == null)
{
  current_session = $('#txtRef').val()
  window.localStorage.setItem('rmis_curr_cont_session', $('#txtRef').val())
}else{
  if($('#txtRef').val() != current_session){
    window.location = './mod-progressform-6?uid=1&role=pm&id_rs=3003&progress=6&session=' + current_session
  }
}

var progress_id = 6

var txtQ6_o = CKEDITOR.replace( 'txtQ6_o', {  height: '150px' });
var txtQ7_2_o = CKEDITOR.replace( 'txtQ7_2_o', { height: '150px' });
var txtQ7_3_o = CKEDITOR.replace( 'txtQ7_3_o', { height: '150px' });

var txtQ8 = CKEDITOR.replace( 'txtQ8', {
  wordcount : {
    showCharCount : false,
    showWordCount : true,
    maxWordCount: 500
  },
  height: '400px'
});

var dropzone_1 = new Dropzone("#mydropzone_1", {
  url: "../../controller/general/upload.php?stage=progress_file&uid=" + $('#txtUid').val() + "&path=1&progress=6&id_rs=" + $('#txtIdrs').val() + '&ref=' + $('#txtRef').val(),
  acceptedFiles: 'application/pdf',
  maxFilesize: 100,
  init: function(){
    this.on("complete", function(file) {
      this.removeFile(file);
      console.log(file.xhr.responseText);
      if(file.xhr.responseText == 'Y'){
        getFileProgress(true)
      }
    });
  }
});

var dropzone_2 = new Dropzone("#mydropzone_2", {
  url: "../../controller/general/upload.php?stage=progress_file&uid=" + $('#txtUid').val() + "&path=2&progress=6&id_rs=" + $('#txtIdrs').val() + '&ref=' + $('#txtRef').val(),
  acceptedFiles: 'application/pdf, .docx, .doc',
  maxFilesize: 100,
  init: function(){
    this.on("complete", function(file) {
      this.removeFile(file);
      console.log(file.xhr.responseText);
      if(file.xhr.responseText == 'Y'){
        getFileProgress(true)
      }
    });
  }
});

var dropzone_3 = new Dropzone("#mydropzone_3", {
  url: "../../controller/general/upload.php?stage=progress_file&uid=" + $('#txtUid').val() + "&path=3&progress=6&id_rs=" + $('#txtIdrs').val() + '&ref=' + $('#txtRef').val(),
  acceptedFiles: 'application/pdf, .docx, .doc',
  maxFilesize: 100,
  init: function(){
    this.on("complete", function(file) {
      this.removeFile(file);
      console.log(file.xhr.responseText);
      if(file.xhr.responseText == 'Y'){
        getFileProgress(true)
      }
    });
  }
});

var dropzone_4 = new Dropzone("#mydropzone_4", {
  url: "../../controller/general/upload.php?stage=progress_file&uid=" + $('#txtUid').val() + "&path=4&progress=6&id_rs=" + $('#txtIdrs').val() + '&ref=' + $('#txtRef').val(),
  acceptedFiles: 'application/pdf, .docx, .doc',
  maxFilesize: 100,
  init: function(){
    this.on("complete", function(file) {
      this.removeFile(file);
      console.log(file.xhr.responseText);
      if(file.xhr.responseText == 'Y'){
        getFileProgress(true)
      }
    });
  }
});

function setFilesection(section_id){
  $('.txtUploadIdrs').val(current_project)
  $('#fileUploadModal_' + section_id).modal()
}

function getFileProgress(editable){
  file_1 = 0
  file_2 = 0
  if($('#txtIdrs').val() != null){
    for(var i = 1; i <= 4; i++){
      getFileProgressByPath(i, $('#txtIdrs').val(), editable)
    }
  }
}

function deleteFileProgress(fid){
  swal({
    title: "คุยแน่ใจหรือไม่",
    text: "หากลบแล้วจะไม่สามารถกู้คืนไฟล์นี้ได้อีก หากเป็นไฟล์ที่เคยส่งสำนักงานแล้ว การลบไฟล์จะทำให้การพิจารณาล่าช้าลง",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "ยืนยันการลบ",
    cancelButtonText: "ยกเลิก",
    closeOnConfirm: true
  },
  function(){
    var param = {
      uid: $('#txtUid').val(),
      id_rs: $('#txtIdrs').val(),
      fid: fid
    }
    preload.show()
    var jxr = $.post(conf.api + 'v5/progress.php?stage=delete_progress_file', param, function(){})
               .always(function(resp){
                 if(resp == 'Y'){
                   getFileProgress()
                   preload.hide()
                 }else{
                   preload.hide()
                   swal("เกิดข้อผิดพลาด", "ไม่สามารถลบไฟล์ได้", "error")
                 }
               })

  });
}

function getFileProgressByPath(path, pid, editable){
  var param = {
    id_rs: pid,
    path: path,
    progress: progress_id,
    ref: $('#txtRef').val()
  }
  var jxr = $.post(conf.api + 'v5/progress.php?stage=list_progress_file', param, function(){}, 'json')
             .always(function(snap){
               console.log(snap);
               if(fnc.json_exist(snap)){
                 $('#file_path_' + path).empty()
                 snap.forEach(i=>{

                   if(path == 1){ file_1++; }
                   if(path == 2){ file_2++; }

                   $file_status = '<span class="text-danger" style="font-size: 0.8em;">ยังไม่ทำการส่ง</span>'
                   $download = '<a href="../tmp_file/' + i.f_name + '" target="_blank" class="mr-2 text-primary"><i class="fas fa-download"></i> ดาวน์โหลด</a>'
                   if(i.f_full_path != null){
                     $download = '<a href="' + i.f_full_path + '" target="_blank" class="mr-2 text-primary"><i class="fas fa-download"></i> ดาวน์โหลด</a>'
                   }

                   $delete = '<a href="Javascript:deleteFileProgress(\'' + i.fid + '\')" class="mr-2 text-danger"><i class="fas fa-times"></i> ลบไฟล์</a>'

                   if(i.f_pi_allow_delete == '0'){
                     $file_status = '<span class="text-danger" style="font-size: 0.9em;">เอกสารรอการตรวจสอบ</span>'
                     $delete = '<a href="Javascript:void(0)" class="mr-2 text-muted"><i class="fas fa-times"></i> ไม่อนุญาตให้ลบไฟล์ในขั้นตอนนี้</a>'
                   }

                   if(i.f_approval_status == 1){
                     $file_status = '<span class="text-success" style="font-size: 0.8em;">เอกสารถูกต้อง</span>'
                   }else if(i.f_approval_status == 2){
                     $file_status = '<span class="text-danger" style="font-size: 0.8em;">เอกสารรอการแก้ไข</span>'
                   }
                   $data = '<tr>' +
                              '<td style="vertical-align: top;">' +
                                i.f_name +
                                '<div style="font-size: 0.8em;">' +
                                  $download +
                                  $delete +
                                '</div>' +
                              '</td>' +
                              '<td style="vertical-align: top;">' + $file_status + '</td>' +
                           '</tr>'

                   if(editable == false){
                     $data = '<tr>' +
                                '<td style="vertical-align: top;">' +
                                  i.f_name +
                                  '<div style="font-size: 0.8em;">' +
                                    $download +
                                  '</div>' +
                                '</td>' +
                                '<td style="vertical-align: top;">' + $file_status + '</td>' +
                             '</tr>'
                   }
                   $('#file_path_' + path).append($data)
                 })
                 $('.btnCloseModal').trigger('click')
                 preload.hide()
               }else{
                 $('#file_path_' + path).html('<tr><td colspan="2" class="text-center">ไม่พบรายการไฟล์ที่อัพโหลด</td></tr>')
               }
             })
}

function sendProgress(pid){
  swal({   title: "คำเตือน",
             text: "หากส่งแล้วจะไม่สามารถแก้ไขได้อีกจนกว่าจะได้รับการตอบกลับจากเจ้าหน้าที่",
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
                 p6.conf_record()
               }
            });
}

$(function(){
  $('#txtQ2').click(function(){
    if($(this).is(":checked")){
      $('#txtQ1').prop('checked', false);
      $('#part_1_skip').removeClass('dn')
    }else{
      $('#part_1_skip').addClass('dn')
    }
  })

  $('#txtQ1').click(function(){
    if($(this).is(":checked")){
      $('#txtQ2').prop('checked', false);
      $('#part_1_skip').addClass('dn')
    }
  })

  $('#txtQ4_2').click(function(){
    if($(this).is(":checked")){
      $('#txtQ4_1').prop('checked', false);
      $('#hdQ4').removeClass('dn')
    }else{
      $('#hdQ4').addClass('dn')
    }
  })

  $('#txtQ4_1').click(function(){
    if($(this).is(":checked")){
      if($('#file_path_1').html() != '<tr><td colspan="2" class="text-center">ไม่พบรายการไฟล์ที่อัพโหลด</td></tr>'){
        swal({   title: "คำเตือน",
             text: "การเปลี่ยนคำตอบนี้จะทำให้ไฟล์ที่ได้อัพโหลดไว้ในข้อนี้ถูกลบไปด้วย",
             type: "warning",
             showCancelButton: true,
             confirmButtonColor: "#DD6B55",
             confirmButtonText: "ยืนยันเปลี่ยนคำตอบ",
             cancelButtonText: "ยกเลิก",
             closeOnConfirm: false,
             closeOnCancel: true },
             function(isConfirm){
               if (isConfirm) {
                 $('#txtQ4_2').prop('checked', false);
                 $('#hdQ4').addClass('dn')
               }else{
                 $('#txtQ4_1').prop('checked', false);
               }
            });
      }else{
        $('#txtQ4_2').prop('checked', false);
        $('#hdQ4').addClass('dn')
      }
    }
  })

  $('#txtQ5_2').click(function(){
    if($(this).is(":checked")){
      $('#txtQ5_1').prop('checked', false);
      $('#hdQ5').removeClass('dn')
    }else{
      $('#hdQ5').addClass('dn')
    }
  })

  $('#txtQ5_1').click(function(){
    if($(this).is(":checked")){
      if($('#file_path_2').html() != '<tr><td colspan="2" class="text-center">ไม่พบรายการไฟล์ที่อัพโหลด</td></tr>'){
        swal({   title: "คำเตือน",
             text: "การเปลี่ยนคำตอบนี้จะทำให้ไฟล์ที่ได้อัพโหลดไว้ในข้อนี้ถูกลบไปด้วย",
             type: "warning",
             showCancelButton: true,
             confirmButtonColor: "#DD6B55",
             confirmButtonText: "ยืนยันเปลี่ยนคำตอบ",
             cancelButtonText: "ยกเลิก",
             closeOnConfirm: false,
             closeOnCancel: true },
             function(isConfirm){
               if (isConfirm) {
                 $('#txtQ5_2').prop('checked', false);
                 $('#hdQ5').addClass('dn')
               }else{
                 $('#txtQ5_1').prop('checked', false);
               }
            });
      }else{
        $('#txtQ5_2').prop('checked', false);
        $('#hdQ5').addClass('dn')
      }
    }
  })

  $('#txtQ6_3').click(function(){
    if($(this).is(":checked")){
      $('#txtQ6_1').prop('checked', false);
      $('#txtQ6_2').prop('checked', false);
      $('#hdQ6').removeClass('dn')
    }else{
      txtQ6_o.setData('')
      $('#hdQ6').addClass('dn')
    }
  })

  $('#txtQ6_2').click(function(){
    if($(this).is(":checked")){
      $('#txtQ6_1').prop('checked', false);
      $('#txtQ6_3').prop('checked', false);
      txtQ6_o.setData('')
      $('#hdQ6').addClass('dn')
    }else{

    }
  })

  $('#txtQ6_1').click(function(){
    if($(this).is(":checked")){
      $('#txtQ6_2').prop('checked', false);
      $('#txtQ6_3').prop('checked', false);
      $('#hdQ6').addClass('dn')
      txtQ6_o.setData('')
    }
  })

  $('#txtQ7_3').click(function(){
    if($(this).is(":checked")){
      $('#txtQ7_1').prop('checked', false);
      $('#txtQ7_2').prop('checked', false);
      $('#hdQ7_2').addClass('dn')
      $('#hdQ7_3').removeClass('dn')
      txtQ7_2_o.setData('')
    }else{

    }
  })

  $('#txtQ7_2').click(function(){
    if($(this).is(":checked")){
      $('#txtQ7_1').prop('checked', false);
      $('#txtQ7_3').prop('checked', false);
      $('#hdQ7_3').addClass('dn')
      $('#hdQ7_2').removeClass('dn')
      txtQ7_3_o.setData('')
    }else{
      $('#hdQ7_2').addClass('dn')
      txtQ7_2_o.setData('')
    }
  })

  $('#txtQ7_1').click(function(){
    if($(this).is(":checked")){
      console.log('asd');
      $('#txtQ7_2').prop('checked', false);
      $('#txtQ7_3').prop('checked', false);
      $('#hdQ7_2').addClass('dn')
      $('#hdQ7_3').addClass('dn')
      txtQ7_2_o.setData('')
      txtQ7_3_o.setData('')
    }
  })

})

$(document).ready(function(){
  // setTimeout(function(){
  //   p6.init_record()
  // }, 10000)
})

var p6 = {
  conf_record(){
    $q1 = 'na'
    if($('#txtQ1').is(":checked")){ $q1 = '0' }
    if($('#txtQ2').is(":checked")){ $q1 = '1' }

    $q3 = 'na'
    if($('#txtQ4_1').is(":checked")){ $q3 = '0' }
    if($('#txtQ4_2').is(":checked")){ $q3 = '1' }

    $q4 = 'na'
    if($('#txtQ5_1').is(":checked")){ $q4 = '0' }
    if($('#txtQ5_2').is(":checked")){ $q4 = '1' }

    $q5 = 'na'
    if($('#txtQ6_1').is(":checked")){ $q5 = '1' }
    if($('#txtQ6_2').is(":checked")){ $q5 = '2' }
    if($('#txtQ6_3').is(":checked")){ $q5 = '3' }

    var param = {
      uid: $('#txtUid').val(),
      id_rs: $('#txtIdrs').val(),
      ref: $('#txtRef').val(),
      q1: $q1,
      q1_1: $('#txtQ2_1').val(),
      q1_2: $('#txtQ2_2').val(),
      q1_3: $('#txtQ2_3').val(),
      q1_4: $('#txtQ2_4').val(),
      q1_5: $('#txtQ2_5').val(),
      q1_6: $('#txtQ2_6').val(),
      q2_1: $('#txtQ3_1').val(),
      q2_2: $('#txtQ3_2').val(),
      q2_3: $('#txtQ3_3').val(),
      q3: $q3,
      q4: $q4,
      q5: $q5,
      q5_o: txtQ6_o.getData(),
      q6: $q5,
      q61_o: txtQ7_2_o.getData(),
      q62_o: txtQ7_3_o.getData(),
      q7: txtQ8.getData(),
    }

    var jxr = $.post(conf.api + 'v5/progress_6.php?stage=send_6', param, function(){})
               .always(function(resp){
                 console.log(resp);
                 if(resp == 'Y'){
                   setTimeout(function(){
                     preload.hide()
                     swal({    title: "สำเร็จ",
                      text: "รายงานของท่านถูกส่งเรียบร้อยแล้ว",
                      type: "success",
                      showCancelButton: false,
                      confirmButtonColor: "#1fb87c",
                      confirmButtonText: "กลับหน้าแรก",
                      closeOnConfirm: true },
                      function(){
                        window.location = '../index?uid=' + $('#txtUid').val() + '&role=pm'
                      });
                   }, 1000)
                 }else{
                   setTimeout(function(){
                     preload.hide()
                     swal({    title: "เกิดข้อผิดพลาด",
                      text: "กรุณาลองส่งใหม่อีกครั้ง หรือติดต่อเจ้าหน้าที่",
                      type: "error",
                      showCancelButton: false,
                      confirmButtonColor: "#DD6B55",
                      confirmButtonText: "รับทราบ",
                      closeOnConfirm: true },
                      function(){
                        // window.location = '../index?uid=' + $('#txtUid').val() + '&role=pm'
                      });
                   }, 1000)
                 }
               })
  },
  init_record(){
    $q1 = 'na'
    if($('#txtQ1').is(":checked")){ $q1 = '0' }
    if($('#txtQ2').is(":checked")){ $q1 = '1' }

    $q3 = 'na'
    if($('#txtQ4_1').is(":checked")){ $q3 = '0' }
    if($('#txtQ4_2').is(":checked")){ $q3 = '1' }

    $q4 = 'na'
    if($('#txtQ5_1').is(":checked")){ $q4 = '0' }
    if($('#txtQ5_2').is(":checked")){ $q4 = '1' }

    $q5 = 'na'
    if($('#txtQ6_1').is(":checked")){ $q5 = '1' }
    if($('#txtQ6_2').is(":checked")){ $q5 = '2' }
    if($('#txtQ6_3').is(":checked")){ $q5 = '3' }

    $q6 = 'na'
    if($('#txtQ7_1').is(":checked")){ $q6 = '1' }
    if($('#txtQ7_2').is(":checked")){ $q6 = '2' }
    if($('#txtQ7_3').is(":checked")){ $q6 = '3' }

    var param = {
      uid: $('#txtUid').val(),
      id_rs: $('#txtIdrs').val(),
      ref: $('#txtRef').val(),
      q1: $q1,
      q1_1: $('#txtQ2_1').val(),
      q1_2: $('#txtQ2_2').val(),
      q1_3: $('#txtQ2_3').val(),
      q1_4: $('#txtQ2_4').val(),
      q1_5: $('#txtQ2_5').val(),
      q1_6: $('#txtQ2_6').val(),
      q2_1: $('#txtQ3_1').val(),
      q2_2: $('#txtQ3_2').val(),
      q2_3: $('#txtQ3_3').val(),
      q3: $q3,
      q4: $q4,
      q5: $q5,
      q5_o: txtQ6_o.getData(),
      q6: $q6,
      q61_o: txtQ7_2_o.getData(),
      q62_o: txtQ7_3_o.getData(),
      q7: txtQ8.getData(),
    }

    var jxr = $.post(conf.api + 'v5/progress.php?stage=draft_6', param, function(resp){ console.log(resp); })

  }
}
