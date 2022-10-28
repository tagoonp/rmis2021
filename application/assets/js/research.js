var research = {
    dropResearch(id, name){
        $('#modalDrop').modal()
        $('#txtDropIdrs').val(id)
        $('#txtDropRsname').val(name)
        setTimeout(function(){ $('#txtDropReasson').focus() }, 500)
    },
    confDropResearch(){
        $('#txtDropReasson').removeClass('is-invalid')
        if($('#txtDropReasson').val() == ''){
            $('#txtDropReasson').addClass('is-invalid')
            return ;
        }
        Swal.fire({
            title: 'คำเตือน',
            text: "หากลบ/ถอนโครงการแล้วจะไม่สามารถนำกลับมาได้อีก",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ยืนยันลบ',
            cancelButtonText: 'ยกเลิก',
            confirmButtonClass: 'btn btn-success mr-1',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
        }).then(function (result) {
            if (result.value) {
                var param = {
                    id_rs: $('#txtDropIdrs').val(),
                    uid:  $('#txtUid').val(),
                    reason:  $('#txtDropRsname').val()
                }
                preload.show()
                var jxr = $.post(api + 'research_register?stage=drop_project', param, function(){}, 'json')
                           .always(function(snap){
                               console.log(snap);
                                preload.hide()
                                if(snap.status == 'Success'){
                                    Swal.fire({
                                        title: 'ยื่นลบ/ถอนโครงการสำเร็จ',
                                        text: "โครงการนี้ของท่านจะถูกตรวจสอบโดยเจ้าหน้าที่ต่อไป",
                                        icon: 'success',
                                        showCancelButton: false,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'รับทราบ',
                                        confirmButtonClass: 'btn btn-success',
                                        buttonsStyling: false,
                                    }).then(function (result) {
                                        window.location.reload()
                                    })
                                }else{
                                    if(snap.message == 'Duplicate record'){
                                        Swal.fire({
                                            title: 'ดำเนินการสำเร็จ',
                                            text: "โครงการนี้ถูกส่งไปยังเจ้าหน้าที่เรียบร้อยแล้ว",
                                            icon: 'success',
                                            showCancelButton: false,
                                            confirmButtonColor: '#3085d6',
                                            cancelButtonColor: '#d33',
                                            confirmButtonText: 'รับทราบ',
                                            confirmButtonClass: 'btn btn-success',
                                            buttonsStyling: false,
                                        }).then(function (result) {
                                            window.location.reload()
                                        })
                                    }else{
                                        Swal.fire({
                                            icon: "error",
                                            title: 'เกิดข้อผิดพลาด',
                                            text: "ไม่สามารถลบ/ขอถออนโครงการได้",
                                            confirmButtonText: 'ลองใหม่',
                                            confirmButtonClass: 'btn btn-danger',
                                        })
                                    }
                                }
                           })
            }
        })
    },
    save_path1(){
        $check = 0;
        $('.form-control').removeClass('is-invalid')
        if($('#txtTitleTh').val() == ''){
            $check++; $('#txtTitleTh').addClass('is-invalid')
        }
        if($('#txtTitleEn').val() == ''){
            $check++; $('#txtTitleEn').addClass('is-invalid')
        }
        if($('#txtKeywordTh').val() == ''){
            $check++; $('#txtKeywordTh').addClass('is-invalid')
        }
        if($('#txtKeywordEn').val() == ''){
            $check++; $('#txtKeywordEn').addClass('is-invalid')
        }
        if($('#txtResearchtype').val() == ''){
            $check++; $('#txtResearchtype').addClass('is-invalid')
        }
        if($('#txtStartDate').val() == ''){
            $check++; $('#txtStartDate').addClass('is-invalid')
        }
        if($('#txtStartMonth').val() == ''){
            $check++; $('#txtStartMonth').addClass('is-invalid')
        }
        if($('#txtStartYear').val() == ''){
            $check++; $('#txtStartYear').addClass('is-invalid')
        }
        if($('#txtFinishDate').val() == ''){
            $check++; $('#txtFinishDate').addClass('is-invalid')
        }
        if($('#txtFinishMonth').val() == ''){
            $check++; $('#txtFinishMonth').addClass('is-invalid')
        }
        if($('#txtFinishYear').val() == ''){
            $check++; $('#txtFinishYear').addClass('is-invalid')
        }
        if($check != 0){ 
            Swal.fire({
                icon: "error",
                title: 'ขออภัย',
                text: "กรุณากรอกข้อมูลให้ครบถ้วน",
                confirmButtonText: 'รับทราบ',
                confirmButtonClass: 'btn btn-danger',
            })
            return ; 
        }
        var param = {
            uid: $('#txtUid').val(),
            title_th: $('#txtTitleTh').val(),
            title_en: $('#txtTitleEn').val(),
            keyword_th: $('#txtKeywordTh').val(),
            keyword_en: $('#txtKeywordEn').val(),
            rs_type: $('#txtResearchtype').val(),
            start: $('#txtStartYear').val() + '-' + $('#txtStartMonth').val() + '-' + $('#txtStartDate').val(),
            end: $('#txtFinishYear').val() + '-' + $('#txtFinishMonth').val() + '-' + $('#txtFinishDate').val(),
            id_rs: $('#txt_idrs').val()
        }

        console.log(param);

        var jxr = $.post(api + 'research_register?stage=save_path_1', param, function(){}, 'json')
                   .always(function(snap){
                       console.log(snap);
                       if(snap.status == 'Success'){
                            window.location = './research-register?stage=2&id_rs=' + snap.id_rs
                       }else{
                            preload.hide()
                            if(snap.error_message == 'Invalid user information'){
                                Swal.fire({
                                    icon: "error",
                                    title: 'เกิดข้อผิดพลาด',
                                    text: "ระบบตรวจพบว่าข้อมูลส่วนตัวของท่านยังไม่สมบูรณ์ กรุณาไปหน้าข้อมูลส่วนตัวเพื่อปรับปรุงข้อมูลส่วนตัวของท่านก่อนลงทะเบียนโครงการวิจัย",
                                    confirmButtonText: 'รับทราบ',
                                    confirmButtonClass: 'btn btn-danger',
                                })
                            }else{
                                Swal.fire({
                                    icon: "error",
                                    title: 'เกิดข้อผิดพลาด',
                                    text: "ไม่สามารถบันทึกข้อมูลได้",
                                    confirmButtonText: 'ลองใหม่',
                                    confirmButtonClass: 'btn btn-danger',
                                })
                            }
                            return ;
                       }
                   })
    },
    save_path2(){
        $check = 0;
        $('.form-control').removeClass('is-invalid')
        if($('#txtResponse').val() == ''){
            $check++; $('#txtResponse').addClass('is-invalid')
        }
        if($("input[name='txt2_1']:checked").val() == 'na'){
            $check++;
        }

        if($check != 0){ 
            Swal.fire({
                icon: "error",
                title: 'ขออภัย',
                text: "กรุณากรอกข้อมูลให้ครบถ้วน",
                confirmButtonText: 'รับทราบ',
                confirmButtonClass: 'btn btn-danger',
            })
            return ; 
        }

        var param = {
            uid: $('#txtUid').val(),
            id_rs: $('#txt_idrs').val(),
            resp: $('#txtResponse').val(),
            cotype: $("input[name='txt2_1']:checked").val()
        }

        preload.show()

        console.log(param);

        var jxr = $.post(api + 'research_register?stage=save_path_2', param, function(){}, 'json')
                   .always(function(snap){
                       console.log(snap);
                       if(snap.status == 'Success'){
                            window.location = './research-register?stage=3&id_rs=' + snap.id_rs
                       }else{
                            preload.hide()
                            Swal.fire({
                                icon: "error",
                                title: 'เกิดข้อผิดพลาด',
                                text: "ไม่สามารถบันทึกข้อมูลได้",
                                confirmButtonText: 'ลองใหม่',
                                confirmButtonClass: 'btn btn-danger',
                            })
                            return ;
                       }
                   })
    },
    save_path3(){
        $check = 0;
        $('.form-control').removeClass('is-invalid')

        $f = $("input[name='txt3_1']:checked").val();

        if($('#txtFundname').val() == ''){
            $check++; $('#txtFundname').addClass('is-invalid')
        }

        if($check != 0){ 
            Swal.fire({
                icon: "error",
                title: 'ขออภัย',
                text: "กรุณากรอกข้อมูลให้ครบถ้วน",
                confirmButtonText: 'รับทราบ',
                confirmButtonClass: 'btn btn-danger',
            })
            return ; 
        }

        if($f == '1'){
            if($('#txtBudget').val() == '0'){
                Swal.fire({
                    icon: "error",
                    title: 'ขออภัย',
                    text: "กรุณากรอกแหน่งทุนอย่างน้อย 1 แหล่ง",
                    confirmButtonText: 'รับทราบ',
                    confirmButtonClass: 'btn btn-danger',
                })
                return ; 
            }
        }

        $f1 = 0; $f2 = 0; $f3 = 0; $f4 = 0; $f5 = 0; $f6 = 0;

        if($('#colorCheckbox1').is(":checked")){ $f1 = 1; }
        if($('#colorCheckbox2').is(":checked")){ $f2 = 1; } 
        if($('#colorCheckbox3').is(":checked")){ $f3 = 1; }
        if($('#colorCheckbox4').is(":checked")){ $f4 = 1; }
        if($('#colorCheckbox5').is(":checked")){ $f5 = 1; }
        if($('#colorCheckbox6').is(":checked")){ $f6 = 1; }
            

        var param = {
            uid: $('#txtUid').val(),
            id_rs: $('#txt_idrs').val(),
            anyfund: $f,
            f1: $f1,
            f1b: returnZero($('#txtFund1').val()),
            f2: $f2,
            f2b: returnZero($('#txtFund2').val()),
            f3: $f4,
            f3b: returnZero($('#txtFund4').val()),
            f4: $f5,
            f4b: returnZero($('#txtFund5').val()),
            f5: $f6,
            f5b: returnZero($('#txtFund6').val()),
            f7: $f3,
            f7b: returnZero($('#txtFund3').val()),
            fundname: $('#txtFundname').val(),
            budget: $('#txtBudget').val()
        }

        // console.log(param);
        // return ;
        
        preload.show()

        var jxr = $.post(api + 'research_register?stage=save_path_3', param, function(){}, 'json')
                   .always(function(snap){
                       console.log(snap);
                    //    return ;
                       if(snap.status == 'Success'){
                            window.location = './research-register?stage=4&id_rs=' + snap.id_rs
                       }else{
                            preload.hide()
                            Swal.fire({
                                icon: "error",
                                title: 'เกิดข้อผิดพลาด',
                                text: "ไม่สามารถบันทึกข้อมูลได้",
                                confirmButtonText: 'ลองใหม่',
                                confirmButtonClass: 'btn btn-danger',
                            })
                            return ;
                       }
                   })


    },
    save_path4(){
        $check = 0;
        $('.form-control').removeClass('is-invalid')

        if(brief_research.getData() == ''){
            Swal.fire({
                icon: "error",
                title: 'ขออภัย',
                text: "กรุณากรอกข้อมูลให้ครบถ้วน",
                confirmButtonText: 'รับทราบ',
                confirmButtonClass: 'btn btn-danger',
            })
            return ; 
        }

        var param = {
            uid: $('#txtUid').val(),
            id_rs: $('#txt_idrs').val(),
            brief: brief_research.getData()
        }
        
        preload.show()

        var jxr = $.post(api + 'research_register?stage=save_path_4', param, function(){}, 'json')
                   .always(function(snap){
                       console.log(snap);
                    //    return ;
                       if(snap.status == 'Success'){
                            window.location = './research-register?stage=5&id_rs=' + snap.id_rs
                       }else{
                            preload.hide()
                            Swal.fire({
                                icon: "error",
                                title: 'เกิดข้อผิดพลาด',
                                text: "ไม่สามารถบันทึกข้อมูลได้",
                                confirmButtonText: 'ลองใหม่',
                                confirmButtonClass: 'btn btn-danger',
                            })
                            return ;
                       }
                   })


    },
    addExternalCoPi(){
        $check = 0;
        $('.form-control').removeClass('is-invalid')
        
        if($('#txtFnameTh').val() == ''){
            $check++; $('#txtFnameTh').addClass('is-invalid')
        }
        if($('#txtLnameTh').val() == ''){
            $check++; $('#txtLnameTh').addClass('is-invalid')
        }

        if($('#txtFnameEn').val() == ''){
            $check++; $('#txtFnameEn').addClass('is-invalid')
        }
        if($('#txtLnameEn').val() == ''){
            $check++; $('#txtLnameEn').addClass('is-invalid')
        }

        if($('#txtEmail').val() == ''){
            $check++; $('#txtEmail').addClass('is-invalid')
        }
        if($('#txtCopitype').val() == ''){
            $check++; $('#txtCopitype').addClass('is-invalid')
        }

        if($('#txtExtCoResponse').val() == ''){
            $check++; $('#txtExtCoResponse').addClass('is-invalid')
        }

        if($('#txtCopitype').val() == '1'){
            if($('#txtPdeptname').val() == ''){
                $check++; $('#txtPdeptname').addClass('is-invalid')
            }
        }

        if($('#txtCopitype').val() == '2'){
            if($('#txtDeptnameTh').val() == ''){
                $check++; $('#txtDeptnameTh').addClass('is-invalid')
            }

            if($('#txtDeptnameEn').val() == ''){
                $check++; $('#txtDeptnameEn').addClass('is-invalid')
            }
        }

        var param = {
            uid: $('#txtUid').val(),
            id_rs: $('#txt_idrs').val(),
            prefix_th: $('#txtPrefixTh').val(),
            fname_th: $('#txtFnameTh').val(),
            lname_th: $('#txtLnameTh').val(),
            prefix_en: $('#txtPrefixEn').val(),
            fname_en: $('#txtFnameEn').val(),
            lname_en: $('#txtLnameEn').val(),
            email: $('#txtEmail').val(),
            cotype: $('#txtCopitype').val(),
            deptnameth: $('#txtDeptnameTh').val(),
            deptnameen: $('#txtDeptnameEn').val(),
            deptin: $('#txtPdeptname').val(),
            resp: $('#txtExtCoResponse').val(),
            session_id: $('#txt_session_id').val(),
            copi_type: 'external'
        }

        // console.log(param);
        // return ;

        var jxr = $.post(api + 'research_register?stage=add_copi_external', param, function(){}, 'json')
                    .always(function(snap){
                        console.log(snap);
                        preload.hide()
                        if(snap.status == 'Success'){
                            Swal.fire({
                                title: 'เพิ่มสำเร็จ',
                                text: "เพิ่มผู้ร่วมวิจัยเรียบร้อยแล้ว",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'แสดงข้อมูล',
                                cancelButtonText: '',
                                confirmButtonClass: 'btn btn-success',
                                buttonsStyling: false,
                            }).then(function (result) {
                                if (result.value) {
                                    window.location.reload()
                                }
                            })
                        }else{
                            Swal.fire({
                                icon: "error",
                                title: 'ขออภัย',
                                text: "ไม่สามารถเพิ่มผู้ร่วมวิจัยได้",
                                confirmButtonText: 'ลองใหม่',
                                confirmButtonClass: 'btn btn-danger',
                            })
                            return ; 
                        }
                    })
    },
    deleteCopi(id){
        Swal.fire({
            title: 'ยืนยันดำเนินการ',
            text: "ท่านยืนยันลบผู้ร่วมวิจัยท่านนี้หรือไม่",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ยืนยันลบ',
            cancelButtonText: 'ยกเลิก',
            confirmButtonClass: 'btn btn-success mr-1',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
        }).then(function (result) {
            if (result.value) {
                var param = {
                    id_rs: $('#txt_idrs').val(),
                    id_copi: id
                }
                preload.show()
                var jxr = $.post(api + 'research_register?stage=delete_copi', param, function(){}, 'json')
                           .always(function(snap){
                                if(snap.status == 'Success'){
                                    window.location.reload()
                                }else{
                                    preload.hide()
                                    Swal.fire({
                                        icon: "error",
                                        title: 'เกิดข้อผิดพลาด',
                                        text: "ไม่สามารถลบรายการได้",
                                        confirmButtonText: 'ลองใหม่',
                                        confirmButtonClass: 'btn btn-danger',
                                    })
                                }
                           })
            }
        })
    },
    setCopi(rid, dt){
        preload.show()
        
        var param = {
            id: rid
        }
        var jxr = $.post(api + 'research_register?stage=get_copi_info', param, function(){}, 'json')
               .always(function(snap){
                    preload.hide()
                    if(snap.status == 'Success'){
                        if(dt == '1'){
                            $('#modalCopiInternalUpdate').modal()
                            $('#txtCoRid_u').val(rid)
                            $('#txtCoPrefixTh_u').val(snap.data.co_prefix_approval)
                            $('#txtCoFnameTh_u').val(snap.data.co_fname)
                            $('#txtCoLnameTh_u').val(snap.data.co_lname)

                            $('#txtCoPrefixEn_u').val(snap.data.co_prefix_approval_en)
                            $('#txtCoFnameEn_u').val(snap.data.co_fname_en)
                            $('#txtCoLnameEn_u').val(snap.data.co_lname_en)

                            $('#txtCoResponse_u').val(snap.data.co_job)
                        }else{
                            $('#modalCopiExternalUpdate').modal()

                            $('#txtCoRid_ue').val(rid)
                            $('#txtCoPrefixTh_ue').val(snap.data.co_prefix_approval)
                            $('#txtCoFnameTh_ue').val(snap.data.co_fname)
                            $('#txtCoLnameTh_ue').val(snap.data.co_lname)

                            $('#txtCoPrefixEn_ue').val(snap.data.co_prefix_approval_en)
                            $('#txtCoFnameEn_ue').val(snap.data.co_fname_en)
                            $('#txtCoLnameEn_ue').val(snap.data.co_lname_en)
                            $('#txtCoEmail_ue').val(snap.data.co_email)

                            $('#txtDeptnameTh_ue').val(snap.data.co_dept)
                            $('#txtDeptnameEn_ue').val(snap.data.co_dept_en)

                            $('#txtCoResponse_ue').val(snap.data.co_job)
                        }
                    }else{
                        Swal.fire({
                            icon: "error",
                            title: 'เกิดข้อผิดพลาด',
                            text: "ไม่สามารถตรวจสอบข้อมูลผู้ร่วมวิจัยได้",
                            confirmButtonText: 'ลองใหม่',
                            confirmButtonClass: 'btn btn-danger',
                        })
                    }
               })
       
    },
    UpdateExternalCo(){
        $check = 0;
        $('.form-control').removeClass('is-invalid')
        if($('#txtCoRid_ue').val() == ''){
            $check++; $('#txtCoRid_ue').addClass('is-invalid')
        }
        if($('#txtCoFnameTh_ue').val() == ''){
            $check++; $('#txtCoFnameTh_ue').addClass('is-invalid')
        }
        if($('#txtCoLnameTh_ue').val() == ''){
            $check++; $('#txtCoLnameTh_ue').addClass('is-invalid')
        }
        if($('#txtCoFnameEn_ue').val() == ''){
            $check++; $('#txtCoFnameEn_ue').addClass('is-invalid')
        }
        if($('#txtCoLnameEn_ue').val() == ''){
            $check++; $('#txtCoLnameEn_ue').addClass('is-invalid')
        }
        if($('#txtCoResponse_ue').val() == ''){
            $check++; $('#txtCoResponse_ue').addClass('is-invalid')
        }
        if($('#txtDeptnameTh_ue').val() == ''){
            $check++; $('#txtDeptnameTh_ue').addClass('is-invalid')
        }
        if($('#txtDeptnameEn_ue').val() == ''){
            $check++; $('#txtDeptnameEn_ue').addClass('is-invalid')
        }
        if($('#txtCoEmail_ue').val() == ''){
            $check++; $('#txtCoEmail_ue').addClass('is-invalid')
        }

        if($check != 0){ 
            Swal.fire({
                icon: "error",
                title: 'คำเตือน',
                text: "กรุณากรอกข้อมูลให้ครบถ้วน",
                confirmButtonText: 'รับทราบ',
                confirmButtonClass: 'btn btn-danger',
            })
            return ; 
        }

        preload.show()
        var param = {
            id_rs: $('#txt_idrs').val(),
            session_id: $('#txt_session_id').val(),
            id_record: $('#txtCoRid_ue').val(),
            prefix_th: $('#txtCoPrefixTh_ue').val(),
            fname_th: $('#txtCoFnameTh_ue').val(),
            lname_th: $('#txtCoLnameTh_ue').val(),
            prefix_en: $('#txtCoPrefixEn_ue').val(),
            fname_en: $('#txtCoFnameEn_ue').val(),
            lname_en: $('#txtCoLnameEn_ue').val(),
            dept_th: $('#txtDeptnameTh_ue').val(),
            dept_en: $('#txtDeptnameEn_ue').val(),
            email: $('#txtCoEmail_ue').val(),
            resp: $('#txtCoResponse_ue').val(),
            uid: $('#txtUid').val(),
            copi_type: 'external',
        }

        var jxr = $.post(api + 'research_register?stage=update_copi', param, function(){}, 'json')
                   .always(function(snap){
                        console.log(snap);
                        preload.hide()
                        if(snap.status == 'Success'){
                            Swal.fire({
                                title: 'สำเร็จ',
                                text: "แก้ไขข้อมูลผู้ร่วมวิจัยเรียบร้อยแล้ว",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'แสดงข้อมูล',
                                cancelButtonText: '',
                                confirmButtonClass: 'btn btn-success',
                                buttonsStyling: false,
                            }).then(function (result) {
                                if (result.value) {
                                    window.location.reload()
                                }
                            })
                        }else{
                            Swal.fire({
                                icon: "error",
                                title: 'ขออภัย',
                                text: "ไม่สามารถแก้ไขข้อมูลได้",
                                confirmButtonText: 'ลองใหม่',
                                confirmButtonClass: 'btn btn-danger',
                            })
                            return ; 
                        }
                   })
    },
    UpdateInternalCo(){
        $check = 0;
        $('.form-control').removeClass('is-invalid')
        if($('#txtCoRid_u').val() == ''){
            $check++; $('#txtCoRid_u').addClass('is-invalid')
        }
        if($('#txtCoFnameTh_u').val() == ''){
            $check++; $('#txtCoFnameTh_u').addClass('is-invalid')
        }
        if($('#txtCoLnameTh_u').val() == ''){
            $check++; $('#txtCoLnameTh_u').addClass('is-invalid')
        }
        if($('#txtCoFnameEn_u').val() == ''){
            $check++; $('#txtCoFnameEn_u').addClass('is-invalid')
        }
        if($('#txtCoLnameEn_u').val() == ''){
            $check++; $('#txtCoLnameEn_u').addClass('is-invalid')
        }
        if($('#txtCoResponse_u').val() == ''){
            $check++; $('#txtCoResponse_u').addClass('is-invalid')
        }

        if($check != 0){ 
            Swal.fire({
                icon: "error",
                title: 'คำเตือน',
                text: "กรุณากรอกข้อมูลให้ครบถ้วน",
                confirmButtonText: 'รับทราบ',
                confirmButtonClass: 'btn btn-danger',
            })
            return ; 
        }
        preload.show()
        var param = {
            id_rs: $('#txt_idrs').val(),
            session_id: $('#txt_session_id').val(),
            id_record: $('#txtCoRid_u').val(),
            prefix_th: $('#txtCoPrefixTh_u').val(),
            fname_th: $('#txtCoFnameTh_u').val(),
            lname_th: $('#txtCoLnameTh_u').val(),
            prefix_en: $('#txtCoPrefixEn_u').val(),
            fname_en: $('#txtCoFnameEn_u').val(),
            lname_en: $('#txtCoLnameEn_u').val(),
            resp: $('#txtCoResponse_u').val(),
            uid: $('#txtUid').val(),
            copi_type: 'internal',
        }

        var jxr = $.post(api + 'research_register?stage=update_copi', param, function(){}, 'json')
                   .always(function(snap){
                        console.log(snap);
                        preload.hide()
                        if(snap.status == 'Success'){
                            Swal.fire({
                                title: 'สำเร็จ',
                                text: "แก้ไขข้อมูลผู้ร่วมวิจัยเรียบร้อยแล้ว",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'แสดงข้อมูล',
                                cancelButtonText: '',
                                confirmButtonClass: 'btn btn-success',
                                buttonsStyling: false,
                            }).then(function (result) {
                                if (result.value) {
                                    window.location.reload()
                                }
                            })
                        }else{
                            Swal.fire({
                                icon: "error",
                                title: 'ขออภัย',
                                text: "ไม่สามารถแก้ไขข้อมูลได้",
                                confirmButtonText: 'ลองใหม่',
                                confirmButtonClass: 'btn btn-danger',
                            })
                            return ; 
                        }
                   })
    },
    addInternalCo(){
        $check = 0;
        $('.form-control').removeClass('is-invalid')
        if($('#txtCoPid').val() == ''){
            $check++; $('#txtCoPid').addClass('is-invalid')
        }
        if($('#txtCoFnameTh').val() == ''){
            $check++; $('#txtCoFnameTh').addClass('is-invalid')
        }
        if($('#txtCoLnameTh').val() == ''){
            $check++; $('#txtCoLnameTh').addClass('is-invalid')
        }
        if($('#txtCoFnameEn').val() == ''){
            $check++; $('#txtCoFnameEn').addClass('is-invalid')
        }
        if($('#txtCoLnameEn').val() == ''){
            $check++; $('#txtCoLnameEn').addClass('is-invalid')
        }

        if($('#txtCoEmail').val() == ''){
            $check++; $('#txtCoEmail').addClass('is-invalid')
        }
        if($('#txtCoEmail').val() == ''){
            $check++; $('#txtCoEmail').addClass('is-invalid')
        }
        if($('#txtCoResponse').val() == ''){
            $check++; $('#txtCoResponse').addClass('is-invalid')
        }
        
        if($check != 0){ 
            Swal.fire({
                icon: "error",
                title: 'ขออภัย',
                text: "กรุณากรอกข้อมูลให้ครบถ้วน",
                confirmButtonText: 'รับทราบ',
                confirmButtonClass: 'btn btn-danger',
            })
            return ; 
        }

        var param = {
            id_rs: $('#txt_idrs').val(),
            session_id: $('#txt_session_id').val(),
            copi_type: 'internal',
            copi_pid: $('#txtCoPid').val(),
            prefix_th: $('#txtPrefixTh').val(),
            fname_th: $('#txtCoFnameTh').val(),
            lname_th: $('#txtCoLnameTh').val(),
            prefix_en: $('#txtCoPrefixEn').val(),
            fname_en: $('#txtCoFnameEn').val(),
            lname_en: $('#txtCoLnameEn').val(),
            email: $('#txtCoEmail').val(),
            dept: $('#txtCodeptname').val(),
            resp: $('#txtCoResponse').val(),
            uid: $('#txtUid').val()
        }

        console.log(param);

        var jxr = $.post(api + 'research_register?stage=add_copi_internal', param, function(){}, 'json')
                   .always(function(snap){
                       console.log(snap);
                       preload.hide()
                       if(snap.status == 'Success'){
                            Swal.fire({
                                title: 'เพิ่มสำเร็จ',
                                text: "เพิ่มผู้ร่วมวิจัยเรียบร้อยแล้ว",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'แสดงข้อมูล',
                                cancelButtonText: '',
                                confirmButtonClass: 'btn btn-success',
                                buttonsStyling: false,
                            }).then(function (result) {
                                if (result.value) {
                                    window.location.reload()
                                }
                            })
                       }else{
                            Swal.fire({
                                icon: "error",
                                title: 'ขออภัย',
                                text: "ไม่สามารถเพิ่มผู้ร่วมวิจัยได้",
                                confirmButtonText: 'ลองใหม่',
                                confirmButtonClass: 'btn btn-danger',
                            })
                            return ; 
                       }
                   })
        
    },
    searchInternalCo(pidCo, fname, lname){
        var param = {
            id_rs: $('#txt_idrs').val(),
            session_id: $('#txt_session_id').val(),
            copi_type: 'internal',
            copi_pid: pidCo,
            uid: $('#txtUid').val()
        }
        preload.show()

        $('#modalCopi').modal('hide')
        $('#modalCopiInfo').modal()

        $('#txtCoPid').val(pidCo)
        $('#txtCoFnameTh').val(fname)
        $('#txtCoLnameTh').val(lname)

        var jxr = $.post(api + 'research_register?stage=check_copi_internal', param, function(){}, 'json')
                   .always(function(snap){
                       console.log(snap);
                       if(snap.status == 'Success'){
                           snap.data.forEach(i => {
                                $('#txtCoFnameEn').val(i.fname_en)
                                $('#txtCoLnameEn').val(i.lname_en)
                                $('#txtCoEmail').val(i.email)
                                $('#txtCodeptname').val(i.id_dept)
                                $('#CoEmailDiv').addClass('dn')
                           });
                       }else{
                        $('#txtCoEmail').val('')
                        $('#txtCodeptname').val('')
                        $('#CoEmailDiv').removeClass('dn')
                       }
                   })

        preload.hide()


        
    }
}

$(function(){
    $('#txtCopitype').change(function(){
        $('#txtPdeptname').val('')
        $('#txtDeptnameTh').val('')
        $('#txtDeptnameEn').val('')
        if($('#txtCopitype').val() == '1'){
            $('#externalCopi').addClass('dn')
            $('#internalCopi').removeClass('dn')
        }else{
            $('#externalCopi').removeClass('dn')
            $('#internalCopi').addClass('dn')
        }
    })

    $("input[name='txt3_1']").click(function(){
        if($("input[name='txt3_1']:checked").val() == '1'){
            $('#fundPanal').removeClass('dn')
        }else{
            $('#fundPanal').addClass('dn')
        }
    })

    $('#colorCheckbox1').click(function(){
        if($(this).is(":checked")){
            $('#fund1').removeClass('dn')
            $('#txtFund1').focus()
        }else{
            $('#fund1').addClass('dn')
            $('#txtFund1').val('')
        }
    })

    $('#colorCheckbox2').click(function(){
        if($(this).is(":checked")){
            $('#fund2').removeClass('dn')
            $('#txtFund2').focus()
        }else{
            $('#fund2').addClass('dn'); $('#txtFund2').val('')
        }
    })

    $('#colorCheckbox3').click(function(){
        if($(this).is(":checked")){
            $('#fund3').removeClass('dn')
            $('#txtFund3').focus()
        }else{
            $('#fund3').addClass('dn'); $('#txtFund3').val('')
        }
    })

    $('#colorCheckbox4').click(function(){
        if($(this).is(":checked")){
            $('#fund4').removeClass('dn')
            $('#txtFund4').focus()
        }else{
            $('#fund4').addClass('dn'); $('#txtFund4').val('')
        }
    })

    $('#colorCheckbox5').click(function(){
        if($(this).is(":checked")){
            $('#fund5').removeClass('dn')
            $('#txtFund5').focus()
        }else{
            $('#fund5').addClass('dn'); $('#txtFund5').val('')
        }
    })

    $('#colorCheckbox6').click(function(){
        if($(this).is(":checked")){
            $('#fund6').removeClass('dn')
            $('#txtFund6').focus()
        }else{
            $('#fund6').addClass('dn'); $('#txtFund6').val('')
        }
    })

    $('.fundBuget').keyup(function(){

        $f1 = 0; $f2 = 0; $f3 = 0; $f4 = 0; $f5 = 0; $f6 = 0;
        if($('#txtFund1').val() != ''){ $f1 = parseInt($('#txtFund1').val()); }
        if($('#txtFund2').val() != ''){ $f2 = parseInt($('#txtFund2').val()); }
        if($('#txtFund3').val() != ''){ $f3 = parseInt($('#txtFund3').val()); }
        if($('#txtFund4').val() != ''){ $f4 = parseInt($('#txtFund4').val()); }
        if($('#txtFund5').val() != ''){ $f5 = parseInt($('#txtFund5').val()); }
        if($('#txtFund6').val() != ''){ $f6 = parseInt($('#txtFund6').val()); }
        

        $sumf = $f1 + $f2 + $f3 + $f4 + $f5 + $f6;

        $('#txtBudget').val($sumf);

      })
    
})

function returnZero(input){
    if(input == ''){
        return 0;
    }else{
        return input;
    }
}