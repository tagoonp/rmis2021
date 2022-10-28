var progress_core = {
    end_review_session(){
        Swal.fire({
            title: 'คำเตือน',
            text: "ท่านยืนยันดำเนินการนี้หรือไม่",
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
                    id_rs: $('#txtResearchId').val(),
                    session_id: $('#txtSessionId').val(),
                    progress: $('#txtProgress').val(),
                    uid: $('#txtUid').val()
                }
                console.log(param);
                var jxr = $.post(api + 'progress?stage=end_review_session', param, function(){}, 'json')
                           .always(function(snap){
                               preload.show()
                               if(snap.status == 'Success'){
                                    window.location.reload()
                               }else{
                                    preload.hide()
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
    }
}