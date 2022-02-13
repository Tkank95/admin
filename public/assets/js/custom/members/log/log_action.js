$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#filter").validate({
        rules: {
            filter1: {
                string: true,
            },
            filter2: {
                number: true,
            },
            filter3: {
                string: true,
            },
            start_date: {
                date: true,
                lessThan: '#end_date'
            },
            end_date: {
                date: true,
                greaterThan: "#start_date"
            }
        },
        messages: {
            filter1: {
                string: 'Vui lòng nhập văn bản',
            },
            filter2: {
                number: 'Bắt buộc là số',
            },
            filter3: {
                string: 'Vui lòng nhập văn bản',
            },
            start_date: {
                date: 'Không đúng định dạng ngày tháng'
            },
            end_date: {
                date: 'Không đúng định dạng ngày tháng',
            }
        }
    });

    // Chuyển ký tự đầu sang chữ hoa
    function jsUcfirst(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    // Random ký tự
    function getRandomString(length) {
        var randomChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789$./';
        var result = '';
        for (var i = 0; i < length; i++) {
            result += randomChars.charAt(Math.floor(Math.random() * randomChars.length));
        }
        return result;
    }

    // Chuyển đổi dữ liệu chỉnh sửa property
    function convert(key, value) {
        if (key === 'banned_until') {
            if (value === '1970-01-01T00:00:00.000000Z') {
                value = 'Null';
            } else {
                value = '<span class="btn btn-danger btn-xs">' + moment(value).format("YYYY-MM-DD HH:mm:ss") + '</span>';
            }
        }
        if (key === 'status') {
            if (value === 1) {
                value = '<span class="btn btn-primary btn-xs">Active</span>';
                return value;
            } else {
                value = '<span class="btn btn-danger btn-xs">NO</span>';
            }
        }
        if (key === 'position') {
            if (value === 1) {
                value = 'Administrator (Admin)';
            } else if (value === 2) {
                value = 'Supermoderator (Smod)';
            } else if (value === 3) {
                value = 'Moderator (Mod)';
            } else if (value === 4) {
                value = 'Agency';
            } else if (value === 5) {
                value = 'User';
            } else {
                value = 'Lỗi, không có vị trí này';
            }
        }
        if (key === 'password') {
            value = getRandomString(60);
        }
        if (key === 'avatar' || key === 'image' || key === 'logo' || key === 'icon' || key === 'cmnd_mt' || key === 'cmnd_ms'
            || key === 'selfie_cmnd' || key === 'selfie' || key === 'selfie_team') {

            value = '<img src=' + value + ' width="100px" height="100px"  alt="' + value + '"/>';
        }
        return value;
    }

    $('body').on('click', '.deleteAll', function (event) {
        event.preventDefault();
        let idsArr = [];
        $(".checkbox:checked").each(function () {
            idsArr.push($(this).attr('id'));
        });
        deleteAll(idsArr, 'log/delete-multiple-action/', 'Lịch sử hành động')
    });

    // Show detail log action
    $('body').on('click', '.detail', function () {
        var id = $(this).data('id');

        //opens show detail modal values
        $.get('log/log-action/detail/' + id, function (data) {
            $('#modalHeading').text('Log Action ' + data.log.log_name + ' #' + data.log.id);
            //Action info
            $("#logName").text(data.log.log_name);
            $("#logDescription").text(data.log.description);
            $("#logSubId").text(data.log.subject_id !== null ? data.log.subject_id : 'Null');
            $("#logUserId").text(data.log.causer_id);
            $("#logMethod").text(data.log.agent.method);
            $("#logIp").text(data.log.ip);
            $("#logUrl").text(data.log.subject_type);
            $("#logTime").text(data.log.created_at);

            // User info
            $.each(data.user, function (key, value) {
                $('#logFullName').text(value.name);
                $('#logUsername').text(value.username);
                $('#logEmail').text(value.email);
                $('#logCreate').text(value.created_at);
                $('#logUpdate').text(value.updated_at);

                if (value.status === 0) {
                    $('#logStatus').html('<span class="btn btn-danger btn-xs">NO</span>');
                } else {
                    $('#logStatus').text('Active');
                }

                if (value.banned_until === '1970-01-01 08:00:00') {
                    $('#logBanned').text('No banned');
                } else {
                    $('#logBanned').html('<span class="btn btn-danger btn-xs">' + moment(value.banned_until).format("YYYY-MM-DD HH:mm:ss") + '</span>');
                }

                if (value.position === 1) {
                    $('#logPosition').text('Administrator (Admin)');
                } else if (value.position === 2) {
                    $('#logPosition').text('Supermoderator (Smod)');
                } else if (value.position === 3) {
                    $('#logPosition').text('Moderator (Mod)');
                } else if (value.position === 4) {
                    $('#logPosition').text('Agency');
                } else if (value.position === 5) {
                    $('#logPosition').text('User');
                } else {
                    $('#logPosition').text('Lỗi, không có vị trí này');
                }
            })

            // Device info
            $('#logType').text(data.log.agent.type);
            $('#logPlatForm').text(data.log.agent.platform);
            $('#logPlatFormVersion').text(data.log.agent.platform_version);
            $('#logDevice').text(data.log.agent.device);
            $('#logBrowser').text(data.log.agent.browser);
            $('#logBrowserVersion').text(data.log.agent.browser_version);
            $('#logLanguages').text(data.log.agent.languages);
            $('#logRobot').text(data.log.agent.robot);
            $('#logMatch').text(data.log.agent.match);
            $('#logAgent').text(data.log.agent.agent);

            // Properties
            if (data.log.agent.method === 'DELETE') {
                $('#dataOld').css('display', 'none');
                $('#old').css('display', 'none');
                $('#dataNew').css('display', 'none');
                $('#new').css('display', 'none');
                $('#dataAuth').css('display', 'none');
                $('#auth').css('display', 'none');
                $('#dataDeleted').css('display', 'block');
                $('#deleted').css('display', 'block');
                $('#dataDetail').css('display', 'none');
                $('#showDetail').css('display', 'none');
                $('#dataExport').css('display', 'none');
                $('#showExport').css('display', 'none');
            } else if (data.log.log_name === 'login') {
                $('#dataOld').css('display', 'none');
                $('#old').css('display', 'none');
                $('#dataNew').css('display', 'none');
                $('#new').css('display', 'none');
                $('#dataAuth').css('display', 'block');
                $('#auth').css('display', 'block');
                $('#dataDeleted').css('display', 'none');
                $('#deleted').css('display', 'none');
                $('#dataDetail').css('display', 'none');
                $('#showDetail').css('display', 'none');
                $('#dataExport').css('display', 'none');
                $('#showExport').css('display', 'none');
            } else if (data.log.log_name === 'download') {
                $('#dataOld').css('display', 'none');
                $('#old').css('display', 'none');
                $('#dataNew').css('display', 'none');
                $('#new').css('display', 'none');
                $('#dataAuth').css('display', 'none');
                $('#auth').css('display', 'none');
                $('#dataDeleted').css('display', 'none');
                $('#deleted').css('display', 'none');
                $('#dataDetail').css('display', 'none');
                $('#showDetail').css('display', 'none');
                $('#dataExport').css('display', 'block');
                $('#showExport').css('display', 'block');
            } else if (data.log.description === 'Viewer List' || data.log.description === 'Viewer Create') {
                $('#dataOld').css('display', 'none');
                $('#old').css('display', 'none');
                $('#dataNew').css('display', 'none');
                $('#new').css('display', 'none');
                $('#dataAuth').css('display', 'none');
                $('#auth').css('display', 'none');
                $('#dataDeleted').css('display', 'none');
                $('#deleted').css('display', 'none');
                $('#dataDetail').css('display', 'none');
                $('#showDetail').css('display', 'none');
                $('#dataExport').css('display', 'none');
                $('#showExport').css('display', 'none');
            } else if (data.log.description === 'Viewer Detail') {
                $('#dataOld').css('display', 'none');
                $('#old').css('display', 'none');
                $('#dataNew').css('display', 'none');
                $('#new').css('display', 'none');
                $('#dataAuth').css('display', 'none');
                $('#auth').css('display', 'none');
                $('#dataDeleted').css('display', 'none');
                $('#deleted').css('display', 'none');
                $('#dataDetail').css('display', 'block');
                $('#showDetail').css('display', 'block');
                $('#dataExport').css('display', 'none');
                $('#showExport').css('display', 'none');
            } else {
                $('#dataOld').css('display', 'block');
                $('#old').css('display', 'block');
                $('#dataNew').css('display', 'block');
                $('#new').css('display', 'block');
                $('#dataAuth').css('display', 'none');
                $('#auth').css('display', 'none');
                $('#dataDeleted').css('display', 'none');
                $('#deleted').css('display', 'none');
                $('#dataDetail').css('display', 'none');
                $('#showDetail').css('display', 'none');
                $('#dataExport').css('display', 'none');
                $('#showExport').css('display', 'none');
            }

            $('#old').empty();
            $.each(data.log.properties.old, function (key, value) {
                const convertDataOld = convert(key, value);
                $('#old').append('<dl class="row"><dt class="col-sm-auto">' + jsUcfirst(key) + ':' + '</dt><dd class="col-md-auto">' + convertDataOld + '</dd></dl>');
            })

            $('#new').empty();
            $.each(data.log.properties.attributes, function (key, value) {
                const convertDataNew = convert(key, value);
                $('#new').append('<dl class="row"><dt class="col-sm-auto" >' + jsUcfirst(key) + ':' + '</dt><dd class="col-md-auto">' + convertDataNew + '</dd></dl>');
            })

            $('#auth').empty();
            $.each(data.log.properties.success || data.log.properties.error, function (key, value) {
                const convertDataNew = convert(key, value);
                $('#auth').append('<dl class="row"><dt class="col-sm-auto" style="width: 130px">' + jsUcfirst(key) + ':' + '</dt><dd class="col-md-auto">' + convertDataNew + '</dd></dl>');
            })

            $('#deleted').empty();
            if (data.log.properties.attributes) {
                $.each(data.log.properties.attributes, function (key, value) {
                    const convertDataNew = convert(key, value);
                    $('#deleted').append('<dl class="row"><dt class="col-sm-auto">' + jsUcfirst(key) + ':' + '</dt><dd class="col-md-auto">' + convertDataNew + '</dd></dl>');
                })
            }
            if (data.log.properties.delete) {
                $('#dataDeleted').css('display', 'none');
                for (var i = 0; i < data.log.properties.delete.length; i = i + 1) {
                    $('#deleted').append('<div class="card-header mb-3"><h5 class="card-header-title" style="color: red">Data Deleted ' + i + '</h5></div>');
                    $.each(data.log.properties.delete[i], function (key, value) {
                        const convertDataNew = convert(key, value);
                        $('#deleted').append('<dl class="row"><dt class="col-sm-auto">' + jsUcfirst(key) + ':' + '</dt><dd class="col-md-auto">' + convertDataNew + '</dd></dl>');
                    })
                }
            }

            $('#showDetail').empty();
            $.each(data.log.properties.show, function (key, value) {
                const convertDataNew = convert(key, value);
                $('#showDetail').append('<dl class="row"><dt class="col-sm-auto" style="width: 140px">' + jsUcfirst(key) + ':' + '</dt><dd class="col-md-auto">' + convertDataNew + '</dd></dl>');
            })

            $('#showExport').empty();
            $.each(data.log.properties.download, function (key, value) {
                const convertDataNew = convert(key, value);
                $('#showExport').append('<dl class="row"><dt class="col-sm-auto" style="width: 115px">' + jsUcfirst(key) + ':' + '</dt><dd class="col-md-auto">' + convertDataNew + '</dd></dl>');
            })

            $("#logDetail").modal('toggle');
        });
    })
});


