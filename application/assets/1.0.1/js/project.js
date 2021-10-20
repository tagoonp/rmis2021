var project = {
    getList(){
        var jxr = $.post(rmis_api + 'project_pm?stage=getlist', {uid: $uid}, function(){}, 'json')
                   .always(function(snap){ 
                       console.log(snap);
                       if(snap.status == 'Success'){
                            $('#panaResearchAll').html('<h3 class="text-left  text-dark">รายชื่อโครงการวิจัยที่อยู่ระหว่างดำเนินการ</h3><table class="table talbe-striped">' +
                                '<thead><tr><th>ชื่อโครงการวิจัย</th><th style="width: 200px;">วันที่รับรอง</th><th style="width: 200px;">วันหมดอายุ</th><th style="width: 200px;">วันที่ต้องรายงานความก้าวหน้า</th><th style="width: 200px;">ท่านยังดำเนินการไม่แล้วเสร็จ</th></tr></thead>' +
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
                                    '<td class=" text-dark"><span class="badge badge-secondary round mb-1">EC.' + i.code_apdu + '</span> ' + $conside + ' <br>' + $title + 
                                        '<div>' + 
                                            '<button class="btn btn-primary- btn-icon btn-sm" onclick=""><i class="bx bx-pencil"></i> สร้างรายงาน</button> | ' +
                                            '<button class="btn btn-primary- btn-icon btn-sm" onclick="window.location = \'report_list?project_id=' + i.id_rs + '&rtype=' + snap.ext_data[$c].consider_rtype + '\'"><i class="bx bx-search"></i> ดูข้อมูล</button>' +
                                        '</div>' +
                                    '</td>' +
                                    '<td>' + snap.ext_data[$c].app_date + '</td>' +
                                    '<td>' + snap.ext_data[$c].exp_date + '</td>' +
                                    '<td>2018-09-27<br>ส่งภายใน 30 วันก่อนถึงกำหนด</td>' +
                                    '<td><span class="badge badge-danger">Amedment (3)</span><span class="badge badge-danger">Deviation (1)</span><span class="badge badge-danger">Closing (1)</span></td>' +
                                '</tr>')
                                $c++;
                            });
                       }else{
                            $('#panaResearchAll').html('<h4 class="card-title">ไม่่พบโครงการวิจัยที่อยู่ระหว่างกำลังดำเนินการวิจัย</h4><p class="card-text">กรุณาติดต่อเจ้าหน้าที่เพื่อทำการนำเข้าข้อมูล</p>')
                       }
                    })
    },
    getInfo(pid){
        var jxr = $.post(rmis_api + 'project?stage=getinfo', {uid: $uid, role: $role, id_rs: pid}, function(){}, 'json')
                   .always(function(snap){ 
                        if(snap.status == 'Success'){
                            $('#textCodeApdu').html('<span class="badge badge-success round" style="margin-top: 4px; font-size: 1.1em;">REC.' + snap.data.code_apdu + '</span>')
                            $('#textTitleTH').html(snap.data.title_th)
                            $('#textTitleEN').html(snap.data.title_en)
                            $('#textKeyword').html(snap.data.keywords_th + '<br>' + snap.data.keywords_en)
                            $('.apducode').text('( REC.' + snap.data.code_apdu + ')')
                        }
                   })
    }
}