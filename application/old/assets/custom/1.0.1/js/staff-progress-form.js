function openModal(){
    console.log(fileApprovalStatus);
    // Check progress id
    var param = {
        uid: current_user,
        id_rs: $('#textId_rs').val()
    }

    preload.show()

    var xjr = $.post(conf.api + 'staff/research?stage=info', param, function(){}, 'json')
               .always(function(snap){
                    if(fnc.json_exist(snap)){
                        snap.forEach(i=>{
                            if(i.id_status_research == '4'){
                                $('#btnAction_3').trigger('click')
                            }else if(i.id_status_research == '19'){
                                $('#modalStatusOther').modal();
                            }else{
                              if(fileApprovalStatus == 1){
                                $('#modalStatus' + i.id_status_research).modal();
                              }else{
                                swal("คำเตือน", "กรุณาตรวจสอบและปรับปรุงสถานะของไฟล์โครงการวิจัยก่อน", "warning")
                              }
                            }
                        })
                        preload.hide()
                    }

               })

}
