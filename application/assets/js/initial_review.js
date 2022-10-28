$file_arr = [];
var files;

$(function(){
    $('.file_upload').on('change', prepareUpload);
    $('#uploadFileAttahed').on('click', uploadFiles);

    if($('#table-activity').length){
        $('#table-activity').dataTable()
    }
})

function uploadFiles(event){
    $check = 0;
    $('.form-control').removeClass('is-invalid')
    if ( $('#txtFileGroup').val() == '' ){
        $check++;
      $('#txtFileGroup').addClass('is-invalid')
    }

    if ( $('#txtVersion').val() == '' ){
      $('#txtVersion').addClass('is-invalid')
      $check++;
    }

    if($check != 0){ return ;}

    if ( document.getElementById('media').value.length == 0 ){
        Swal.fire(
            {
            icon: "error",
            title: 'ขออภัย!',
            text: 'กรุณาเลือกไฟล์ก่อนทำการอัพโหลด',
            confirmButtonClass: 'btn btn-danger',
            }
        )
      return ;
    }

    event.preventDefault();
    preload.show()

    var formData = new FormData($('#uploadForm')[0]);

    $.each(files, function(key, value)
    {
        $.each(value, function(key, value){
          formData.append(key, value);
        })
    });

    $.ajax({
      xhr: function(){
        var xhr = new window.XMLHttpRequest();
        xhr.upload.addEventListener('progress', function(e){

          if(e.lengthComputable){
            console.log('Byte loaded : ' + e.loaded);
            console.log('Total size : ' + e.total);
            console.log('Percentage : ' + (e.loaded / e.total));

            var percentage = Math.round((e.loaded / e.total) * 100);

            $('#progressUploadBar').attr('aria-valuenow', percentage).css('width', percentage + '%')
          }
        })
        return xhr;
      },
      url: conf.api + 'upload_file_research_attach_backward.php?files',
      type: 'POST',
      data: formData,
      processData: false, // Don't process the files
      contentType: false, // Set content type to false as jQuery will tell the server its a query string request
      success: function(data, textStatus, jqXHR)
      {
            console.log(data);
            console.log(textStatus);
            console.log(jqXHR);
            // return ;
            setTimeout(function(){
              window.location.reload()
            }, 1000)

            $('#media').val('')
            return ;
      },
      error: function(jqXHR, textStatus, errorThrown)
      {
        preload.hide()
            swal({    title: "ไม่สามารถอัพโหลดไฟล์ได้",
              text: "กรุณาลองใหม่ หรือส่งไฟล์ให้เจ้าหน้าที่ผ่านทางอีเมล์!",
              type: "error",
              showCancelButton: false,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "รับทราบ",
              closeOnConfirm: true },
            function(){

            });

            // Handle errors here
            console.log('ERRORS: ' + textStatus);
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
            setTimeout(function(){
              $('#progressbar').addClass('dn')
            }, 1000)
            $('#progressbar').addClass('dn')
      }
    })
    return ;
  }
  // End uploadFiles

  function prepareUpload(event){
    files = event.target.files;
  }
  // End prepareUpload


var init_file = {
    delete(fid){
        Swal.fire({
            title: 'คำเตือน',
            text: "หากลบแล้วจะไม่สามารถนำกลับมาได้อีก",
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
                preload.show()
                var param = {
                    id_rs: $('#txtIdRs').val(),
                    id_file: fid,
                    uid: $('#txtUid').val(),
                    role: $('#txtRole').val()
                }
                var jxr = $.post(api + 'research_management?stage=delfile', param, function(){}, 'json')
                           .always(function(snap){
                               if(snap.status == 'Success'){
                                   window.location.reload()
                               }else{
                                   preload.hide()
                               }
                            })
            }
        })
    }
}