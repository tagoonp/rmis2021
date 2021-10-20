var progress = {
    getProgressReportList(pg){
        var progress_word = ''

        if(pg == 'Progress'){ progress_word = 'แบบรายงานความก้าวหน้าการดำเนินงานวิจัย<br>(Progress Report Form)' }
        if(pg == 'Amendment'){ progress_word = 'แบบเสนอขอแก้ไขเพิ่มเติมโครงการวิจัย<br>(Submission Form for Amendment)' }
        if(pg == 'Deviation'){ progress_word = 'แบบรายงานการดeเนินงานวิจัยที่เบี่ยงเบนหรือไม่ปฎิบัติตามข้อกำหนด<br>(Deviation/Non-compliance Report Form)' }
        if(pg == 'LocalSAE'){ progress_word = 'แบบรายงานเบื้องต้นสำหรับเหตุการณ์ไม่พึงประสงค์ ชนิดร้ายแรงที่เกิดในสถาบัน<br>(Local SAE-expedited report form)' }
        if(pg == 'ExtSAE'){ progress_word = 'แบบสรุปรายงานเหตุการณ์ไม่พึงประสงค์ชนิดร้ายแรงที่เกิดแก่อาสาสมัครนอกสถาบัน<br>(External SAE/SUSAR Report Form)' }
        if(pg == 'Closing'){ progress_word = 'แบบรายงานสรุปผลการวิจัย กรณีปิดโครงการปกติ<br>(Final Report Form)' }
        if(pg == 'Terminate'){ progress_word = 'แบบรายงานการยุติโครงการวิจัยก่อนกำหนด<br>(Termination Report Form)' }
        var jxr = $.post(rmis_api + 'progress?stage=getreportlist', {uid: $uid, progress: pg}, function(){}, 'json')
                   .always(function(snap){ 
                       if(snap.status == 'Success'){
                            $('#panaResearchAll').html('<h3 class="text-left">รายชื่อโครงการวิจัยที่อยู่ระหว่างดำเนินการ</h3><table class="table talbe-striped">' +
                                '<thead><tr><th>ชื่อโครงการวิจัย</th><th style="width: 200px;">วันที่รับรอง</th><th style="width: 200px;">วันหมดอายุ</th><th style="width: 140px;">แจ้งเตือน</th></tr></thead>' +
                                '<tbody id="tableResearchList"></tbody>' +
                            '</table>')
                            $c = 0;
                            snap.data.forEach(i => {
                                $title = i.title_th + ' (' + i.title_en + ')'
                                if(i.title_th == '-'){
                                    $title = i.title_en
                                }

                                $conside = '<span class="badge badge-secondary round mb-1">Exempt</span>'
                                if(snap.ext_data[$c].consider_rtype != 'Exempt'){
                                    $conside = '<span class="badge badge-success round mb-1">' + snap.ext_data[$c].consider_rtype + '</span>'
                                }
                                $('#tableResearchList').append('<tr>' +
                                    '<td><span class="badge badge-secondary round mb-1">EC.' + i.code_apdu + '</span> ' + $conside + ' <br>' + $title + 
                                        '<div>' + 
                                            '<button class="btn btn-primary- btn-icon btn-sm"><i class="bx bx-pencil"></i> สร้างรายงาน</button> | ' +
                                            '<button class="btn btn-primary- btn-icon btn-sm"><i class="bx bx-search"></i> ดูข้อมูล</button>' +
                                        '</div>' +
                                    '</td>' +
                                    '<td>' + snap.ext_data[$c].app_date + '</td>' +
                                    '<td>' + snap.ext_data[$c].exp_date + '</td>' +
                                    '<td>' + 
                                    '</td>' +
                                '</tr>')
                                $c++;
                            });
                       }else{
                            $('#panaResearch' + pg).html('<h4 class="card-title">ไม่พบ' + progress_word + '</h4>')
                       }
                    })
    },
    getProgressReportListByID(pg, id_rs){
        var progress_word = ''

        $pgd = '';

        if(pg == 'Progress'){ progress_word = 'แบบรายงานความก้าวหน้าการดำเนินงานวิจัย<br>(Progress Report Form)'; $pgd = 'disabled'; }
        if(pg == 'Amendment'){ progress_word = 'แบบเสนอขอแก้ไขเพิ่มเติมโครงการวิจัย<br>(Submission Form for Amendment)'; $pgd = 'disabled'; }
        if(pg == 'Deviation'){ progress_word = 'แบบรายงานการดeเนินงานวิจัยที่เบี่ยงเบนหรือไม่ปฎิบัติตามข้อกำหนด<br>(Deviation/Non-compliance Report Form)'; $pgd = 'disabled';  }
        if(pg == 'LocalSAE'){ progress_word = 'แบบรายงานเบื้องต้นสำหรับเหตุการณ์ไม่พึงประสงค์ ชนิดร้ายแรงที่เกิดในสถาบัน<br>(Local SAE-expedited report form)'; $pgd = 'disabled';  }
        if(pg == 'ExtSAE'){ progress_word = 'แบบสรุปรายงานเหตุการณ์ไม่พึงประสงค์ชนิดร้ายแรงที่เกิดแก่อาสาสมัครนอกสถาบัน<br>(External SAE/SUSAR Report Form)'; $pgd = 'disabled';  }
        if(pg == 'Closing'){ progress_word = 'แบบรายงานสรุปผลการวิจัย กรณีปิดโครงการปกติ<br>(Final Report Form)' }
        if(pg == 'Terminate'){ progress_word = 'แบบรายงานการยุติโครงการวิจัยก่อนกำหนด<br>(Termination Report Form)' }

        var jxr = $.post(rmis_api + 'progress?stage=getreportlistbypm', {uid: $uid, id_rs: id_rs, progress: pg.toLowerCase(), role: $role}, function(){}, 'json')
                   .always(function(snap){ 
                       console.log(snap);
                    //    return ;
                       if(snap.status == 'Success'){
                            $('#panaResearch' + pg).html('<table class="table talbe-striped">' +
                                '<thead><tr><th>รหัสรายงาน</th><th style="width: 200px;">ประเภท</th><th style="width: 200px;">สถานะปัจจุบัน</th><th style="width: 200px;">วันที่รับรอง</th><th style="width: 200px;">วันหมดอายุ</th></tr></thead>' +
                                '<tbody id="tableResearchList' + pg + '"></tbody>' +
                            '</table>')
                            $c = 0;
                            snap.data.forEach(i => {
                                $('#tableResearchList' + pg).append('<tr>' +
                                    '<td style="vertical-align: top;" class="text-dark"><span class="badge badge-secondary round" style="font-size: 1.1em;">ID : ' + i.rp_session + '</span>' +
                                        '<div>' + 
                                            '<button class="btn btn-primary- btn-icon round btn-sm" style="padding-bottom: 14px;"><i class="bx bx-search"></i> ดูข้อมูล</button>' +
                                        '</div>' +
                                    '</td>' +
                                    '<td style="vertical-align: top;" class="text-dark">' + pg + '</td>' +
                                    '<td style="vertical-align: top;" class="text-dark"></td>' +
                                    '<td style="vertical-align: top;" class="text-dark">' + checkifnull(i.rp_app_date) + '</td>' +
                                    '<td style="vertical-align: top;" class="text-dark">' + checkifnull(i.rp_exp_date) + '</td>' +
                                '</tr>')
                                $c++;
                            });
                       }else{

                        $pgd = ''

                        if(pg == 'Progress'){  $pgd = 'disabled'; }
                        if(pg == 'Amendment'){  $pgd = 'disabled'; }
                        if(pg == 'Deviation'){  $pgd = 'disabled';  }
                        if(pg == 'LocalSAE'){  $pgd = 'disabled';  }
                        if(pg == 'ExtSAE'){ $pgd = 'disabled';  }
                        if(pg == 'Closing'){  }
                        if(pg == 'Terminate'){ }

                           if($pgd == 'disabled'){
                               console.log('a');
                                $('#panaResearch' + pg).html('<h4 class="card-title">ไม่พบ' + progress_word + '</h4><br><button class="btn btn-primary" disabled onclick="progress.createReport(\'' + pg + '\')">สร้างรายงาน</button>')
                           }else{
                            console.log('b');
                                $('#panaResearch' + pg).html('<h4 class="card-title">ไม่พบ' + progress_word + '</h4><br><button class="btn btn-primary" onclick="progress.createReport(\'' + pg + '\')">สร้างรายงาน</button>')
                           }
                       }
                    })
    },
    createReport(pg){

        console.log(pg);

        var progress_word = ''
        if(pg == 'Progress'){ progress_word = 'แบบรายงานความก้าวหน้าการดำเนินงานวิจัย (Progress Report Form)'; $pgd = 'disabled'; }
        if(pg == 'Amendment'){ progress_word = 'แบบเสนอขอแก้ไขเพิ่มเติมโครงการวิจัย (Submission Form for Amendment)'; $pgd = 'disabled'; }
        if(pg == 'Deviation'){ progress_word = 'แบบรายงานการดeเนินงานวิจัยที่เบี่ยงเบนหรือไม่ปฎิบัติตามข้อกำหนด (Deviation/Non-compliance Report Form)'; $pgd = 'disabled';  }
        if(pg == 'LocalSAE'){ progress_word = 'แบบรายงานเบื้องต้นสำหรับเหตุการณ์ไม่พึงประสงค์ ชนิดร้ายแรงที่เกิดในสถาบัน (Local SAE-expedited report form)'; $pgd = 'disabled';  }
        if(pg == 'ExtSAE'){ progress_word = 'แบบสรุปรายงานเหตุการณ์ไม่พึงประสงค์ชนิดร้ายแรงที่เกิดแก่อาสาสมัครนอกสถาบัน (External SAE/SUSAR Report Form)'; $pgd = 'disabled';  }
        if(pg == 'Closing'){ progress_word = 'แบบรายงานสรุปผลการวิจัย กรณีปิดโครงการปกติ (Final Report Form)' }
        if(pg == 'Terminate'){ progress_word = 'แบบรายงานการยุติโครงการวิจัยก่อนกำหนด (Termination Report Form)' }
        
        if((pg == 'Closing') || (pg == 'Terminate')){
            Swal.fire({
                title: 'คำเตือน',
                text: "ท่านยืนยันการสร้าง" + progress_word + ' หรือไม่?',
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
                        uid: $('#txtUid').val(),
                        id_rs: $('#txtPid').val(),
                        progress: pg.toLowerCase()
                    }
                    var jxr = $.post(rmis_api + 'progress?stage=create_session', param, function(){}, 'json')
                               .always(function(snap){
                                   console.log(snap);
                                   if(snap.status == 'Success'){
                                       window.location = 'progressform_' + pg.toLowerCase() + '?project_id=' + $('#txtPid').val() + '&psid=' + snap.session_id
                                   }else if(snap.status == 'Duplicate'){
                                        Swal.fire(
                                            {
                                            icon: "error",
                                            title: 'พบข้อมูลซ้ำ',
                                            text: 'ท่านเคยมีการสร้างหรือยื่นแบบรายงานนี้ไปแล้ว กรุณาตรวจสอบ หรือติดต่อเจ้าหน้าที่',
                                            confirmButtonClass: 'btn btn-danger',
                                            }
                                        )
                                   }else{
                                        Swal.fire(
                                            {
                                            icon: "error",
                                            title: 'เกิดข้อผิดพลาด!',
                                            text: 'ไม่สามารถสร้างแบบรายงานได้ กรุณาติดต่อเจ้าหน้าที่',
                                            confirmButtonClass: 'btn btn-danger',
                                            }
                                        )
                                   }
                               })
                }
            })
        }else{
            Swal.fire({
                title: 'คำเตือน',
                text: "หากลบแล้วจะไม่สามารถนำกลับมาได้อีก",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ยืนยันลบ',
                cancelButtonText: 'ยกเลิก',
                confirmButtonClass: 'btn btn-danger mr-1',
                cancelButtonClass: 'btn btn-secondary',
                buttonsStyling: false,
            }).then(function (result) {
                if (result.value) {

                }
            })
        }
    }
}

function openForm(form, project_id, sid){
    window.location = 'progressform_' + form + '?project_id=' + project_id + '&psid=' + sid
}