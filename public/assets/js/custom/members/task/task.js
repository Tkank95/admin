$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // validate form
    // =======================================================
    $("#filter").validate({
        rules: {
            filter1: {
                digits: true
            },
            filter2: {
                digits: true
            },
            filter3: {
                date: true
            },
            datatableSearch: {
                maxlength: 255
            },
            start_date: {
                date: true,
                lessThan: '#end_date'
            },
            end_date: {
                required: function () { // Bắt buộc nhập nếu start_date khác rỗng
                    return $("#start_date").val() !== "";
                },
                date: true,
                greaterThan: "#start_date"
            }
        },
        messages: {
            filter1: {
                digits: 'Dữ liệu không hợp lệ.',
            },
            filter2: {
                digits: 'Dữ liệu không hợp lệ.',
            },
            filter3: {
                required: 'Dữ liệu không hợp lệ.',
            },
            datatableSearch: {
                maxlength: 'Tối đa 255 ký tự.'
            },
            start_date: {
                date: 'Không đúng định dạng ngày tháng'
            },
            end_date: {
                required: 'Ngày kết thúc không được để trống.',
                date: 'Không đúng định dạng ngày tháng',
            }
        }
    });

    $("#addTask").validate({
        rules: {
            tag_id: {
                required: true,
                digits: true
            },
            name: {
                required: true,
                minlength: 6,
                maxlength: 255
            },
            user_id: {
                required: true,
                digits: true
            },
            due_date: {
                required: true,
                date: true
            },
            status: {
                required: true,
                digits: true
            }
        },
        messages: {
            tag_id: {
                required: 'Bạn chưa chọn thẻ công việc, nhiệm vụ.',
                digits: 'Dữ liệu không hợp lệ.'
            },
            name: {
                required: 'Bạn chưa nhập tên công việc, nhiệm vụ',
                minlength: 'Tên tối thiểu 6 ký tự.',
                maxlength: 'Tên tối đa 255 ký tự.'
            },
            user_id: {
                required: 'Bạn chưa chọn người thực hiện',
                digits: 'Dữ liệu không hợp lệ.'
            },
            due_date: {
                required: 'Bạn chưa chọn hạn hoàn thành.',
                date: 'Dữ liệu không hợp lệ.'
            },
            status: {
                required: 'Bạn chưa chọn trạng thái công việc',
                digits: 'Dữ liệu không hợp lệ.'
            }
        }
    });

    $("#editTask").validate({
        rules: {
            tag_id1: {
                required: true,
                digits: true
            },
            name1: {
                required: true,
                minlength: 6,
                maxlength: 255
            },
            user_id1: {
                required: true,
                digits: true
            },
            due_date1: {
                required: true,
                date: true
            },
            status1: {
                required: true,
                digits: true
            }
        },
        messages: {
            tag_id1: {
                required: 'Bạn chưa chọn thẻ công việc, nhiệm vụ.',
                digits: 'Dữ liệu không hợp lệ.'
            },
            name1: {
                required: 'Bạn chưa nhập tên công việc, nhiệm vụ',
                minlength: 'Tên tối thiểu 6 ký tự.',
                maxlength: 'Tên tối đa 255 ký tự.'
            },
            user_id1: {
                required: 'Bạn chưa chọn người thực hiện',
                digits: 'Dữ liệu không hợp lệ.'
            },
            due_date1: {
                required: 'Bạn chưa chọn hạn hoàn thành.',
                date: 'Dữ liệu không hợp lệ.'
            },
            status1: {
                required: 'Bạn chưa chọn trạng thái công việc',
                digits: 'Dữ liệu không hợp lệ.'
            }
        }
    });

    $('.select-search').each(function () {
        $.HSCore.components.HSSelect2.init($(this), {
            placeholder: 'Tìm kiếm username',
            searchInputPlaceholder: 'Nhập username tìm kiếm',
            minimumInputLength: 1,
            templateResult: formatRepo,
            templateSelection: formatRepoSelection,
            ajax: {
                url: 'search/member',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                username: item.username,
                                id: item.id,
                                avatar: item.avatar
                            }
                        })
                    };
                },
                cache: true
            }
        });
    });

    function formatRepo(repo) {
        if (repo.loading) {
            return repo.username;
        }

        return $('<span class="d-flex align-items-center"><img class="avatar-xs rounded-circle mr-2" ' +
            'src="' + repo.avatar + '" alt="' + repo.username + '"/><span>' + repo.username + '</span></span>'
        );
    }

    function formatRepoSelection(repo) {
        if (!repo.id) {
            return 'Tìm kiếm username';
        }

        let username = repo.username || repo.element.text;
        let avatar = repo.avatar || repo.element.avatar;

        var $state = $('<span class="d-flex align-items-center"><img class="avatar-xs rounded-circle mr-2" src="" alt=""/><span></span></span>');

        $state.find("span").text(username);
        $state.find("img").attr({src: avatar, alt: username});

        return $state;
    }

    function show_alert(id) {
        if (id !== '') {
            $('body').attr('onbeforeunload', "return 'You have unsaved changes!';");
        }
    }

    // INITIALIZATION OF DROPZONE FILE ATTACH MODULE
    // =======================================================
    $('.js-dropzone').each(function () {
        var id = $(this).attr('id');
        var upload = (id === 'attachFiles') ? $('.upload') : $('.upload1');
        var dropzone = $.HSCore.components.HSDropzone.init('#' + id, {
            paramName: "attachFiles",
            url: "task/attachment",
            headers: {
                'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
            },
            maxFilesize: 15,
            maxThumbnailFilesize: 15,
            createImageThumbnails: true,
            maxFiles: 1,
            acceptedFiles: "image/*,.xlsx,.xls,.pdf,.doc,.docx,.csv,.ppt,.pptx,.rar,.zip,.avi,.mp3,.wma,.wav,.mp4,.mkv,.flv,.mpg,.mov,.txt",
            success: function (file, response) {
                if (response.code === 200) {
                    id === 'attachFiles' ? upload.val(response.source) : upload.val(response.source);
                    var anchorEl = document.createElement('a');
                    anchorEl.setAttribute('href', response.source);
                    anchorEl.setAttribute('target', '_blank');
                    anchorEl.innerHTML = "<br>Download";
                    file.previewTemplate.appendChild(anchorEl);
                    show_alert(upload);
                } else {
                    dropzone.removeFile(file);
                    Swal.fire("Thêm file lỗi!", response.message, "error");
                    toastr.error(response.message, 'Error!');
                }
            },
            error: function (file, response) {
                dropzone.removeFile(file);

                var errorsHtml = '';
                if ($.type(response) === "string") {
                    errorsHtml = response;
                } else {
                    $.each(response, function (key, value) {
                        errorsHtml += "<li>" + value[0] + "</li>";
                    });
                }
                Swal.fire("Thêm file lỗi!", errorsHtml, "error");
                toastr.error(errorsHtml, 'Error!');
            },
        });

        dropzone.on("removedfile", function () {
            detachment(id, upload.val(), '');
        });
    });

    function detachment(div, id, attachment) {
        if (id !== '') {
            $.post({
                url: 'task/detachment',
                data: {id: id, attachment: attachment},
                success: function (data) {
                    if (data.code === 200) {
                        div === 'attachFiles' ? $('.upload').val('') : $('.upload1').val('');
                        $('body').removeAttr('onbeforeunload');
                        toastr.success('Xoá file thành công', 'Remove File Success');
                    } else {
                        toastr.error(data.message, 'Error!');
                    }
                },
                error: function (file, response) {
                    var errorsHtml = '';
                    $.each(response, function (key, value) {
                        errorsHtml += "<li>" + value[0] + "</li>";
                    });
                    Swal.fire("Xoá file lỗi!", errorsHtml, "error");
                    toastr.error(errorsHtml, 'Error!');
                }
            })
        } else
            return true;
    }

    // Add Task
    $("#addTask").submit(function (event) {
        event.preventDefault();

        $.ajax({
            url: 'task/add',
            type: "POST",
            data: {
                tag_id: $("#tag_id").val(),
                name: $("#name").val(),
                user_id: $("#user_id").val(),
                start: $("#start").val(),
                end: $("#end").val(),
                repeat: $("#repeat").val(),
                location: $("#location").val(),
                status: $("#status").val(),
                attachment: $("#attachment").val(),
                description: $("#description").val()
            },
            success: function (data) {
                if (data.code === 200) {
                    $('#datatable').DataTable().ajax.reload();
                    $('body').removeAttr('onbeforeunload');
                    toastr.success('Công việc, nhiệm vụ mới được thêm thành công.', 'Thêm mới thành công');
                    Swal.fire('Thêm mới', 'Công việc, nhiệm vụ mới được thêm thành công.', 'success');
                    $("#taskModal").modal('hide');
                    $("#addTask")[0].reset();

                    $("#tag_id").val('').trigger('change');
                    $("#user_id").val('').trigger('change');
                    $("#status").val(1).trigger('change');
                    $("#repeat").val('').trigger('change');

                    Dropzone.forElement("#showAttachFiles").removeAllFiles(true);
                    Dropzone.forElement("#attachFiles1").removeAllFiles(true);
                }
            },
            error: function (data) {
                let errors = data.responseJSON;
                let errorsHtml = "";
                $.each(errors, function (key, value) {
                    errorsHtml += "<li>" + value[0] + "</li>";
                });
                toastr.error(errorsHtml, "Thêm mới lỗi!");
                Swal.fire("Error!", errorsHtml, "error");
            }
        });
    });

    $('body').on('click', '.removeAttachFiles', function (event) {
        event.preventDefault();

        detachment('#showAttachFiles', $(this).data('dz-remove'), $(this).data('attachment-id'));

        Dropzone.forElement("#showAttachFiles").removeAllFiles(true);
        Dropzone.forElement("#attachFiles1").removeAllFiles(true);

        $('#showAttachFiles').css('display', 'none');
        $('#attachFiles1').css('display', 'block');

    })

    // Edit Task
    $('body').on('click', '.action_edit', function (event) {
        event.preventDefault();
        var id = $(this).data('id');

        // opens edit modal and inserts values
        $.get('task/edit/' + id, function (data) {
            $("#id").val(data.task.id);
            $("#tag_id1").val(data.task.tag_id).trigger('change');
            $("#name1").val(data.task.name);
            $("#due_date1").val((data.task.due_date));
            $("#status1").val(data.task.status).trigger('change');
            $("#start1").val(data.task.start);
            $("#end1").val(data.task.end);
            $("#repeat1").val(data.task.repeat).trigger('change');
            $("#location1").val(data.task.location);
            $("#attachment1").val(data.task.attachment);
            $("#description1").val(data.task.description);
            $("#create_at").text(data.task.created_at);
            $("#update_at").text(data.task.updated_at);


            var userSelect = $('#user_id1');
            $.ajax({
                type: 'GET',
                url: 'search/get-member/' + data.task.user_id
            }).then(function (data) {
                // create the option and append to Select2
                var option = new Option(data[0].username, data[0].id, true, true);
                option.avatar = data[0].avatar;
                userSelect.append(option).trigger('change');

                userSelect.trigger({
                    type: 'select2:select',
                    params: {
                        data: data
                    }
                });
            });

            $.each(data.user, function (key, value) {
                $("#created_id").attr("href", '/user/edit/' + data.user[0].id);
                $("#created_avatar").attr("src", data.user[0].avatar);
                $("#created_username").text(data.user[0].username);
                $("#created_name").text(data.user[0].name);
            });

            if (data.task.attachment !== null || $("#attachment1").val() !== '') {
                $("#attachFiles1").css('display', 'none');
                $("#showAttachFiles").css('display', 'block');
                $("#showAttachFiles").html('<div class="col h-100 px-1 mb-2 dz-processing dz-image-preview dz-complete">\n' +
                    '    <div class="dz-preview dz-file-preview">\n' +
                    '        <div class="d-flex justify-content-end dz-close-icon"><small class="tio-clear removeAttachFiles" data-attachment-id="' + data.task.id + '" data-dz-remove="' + data.task.attachment + '"></small></div>\n' +
                    '        <div class="dz-details media"><div class="dz-img"><img class="img-fluid dz-img-inner" data-dz-thumbnail="" alt="' + data.filename + '" src="' + data.thumb + '"></div>\n' +
                    '            <div class="media-body dz-file-wrapper"><h6 class="dz-filename"><span class="dz-title" data-dz-name="">' + data.filename + '</span></h6>\n' +
                    '                <div class="dz-size" data-dz-size="">' + data.filesize + '\n' +
                    '            </div>\n' +
                    '        </div>\n' +
                    '        <div class="dz-progress progress">\n' +
                    '            <div class="dz-upload progress-bar bg-success" role="progressbar" style="width: 100%;" aria-valuenow="0"\n' +
                    '                 aria-valuemin="0" aria-valuemax="100" data-dz-uploadprogress=""></div>\n' +
                    '        </div>\n' +
                    '        <div class="d-flex align-items-center">\n' +
                    '            <div class="dz-success-mark"><span class="tio-checkmark-circle"></span></div>\n' +
                    '            <div class="dz-error-mark"><span class="tio-checkmark-circle-outlined"></span></div>\n' +
                    '            <div class="dz-error-message"><small data-dz-errormessage=""></small></div>\n' +
                    '        </div>\n' +
                    '    </div>\n' +
                    '    <a href="' + data.task.attachment + '" target="_blank"><br>Download</a></div>');
            } else {
                $("#attachFiles1").css('display', 'block');
                $("#showAttachFiles").css('display', 'none');
            }

            $("#editTaskModal").modal('toggle');
        });
    })

    // Update Task
    $("#editTask").submit(function (e) {
        e.preventDefault();
        let id = $("#id").val();

        $.ajax({
            url: 'task/edit/' + id,
            type: "PUT",
            data: {
                tag_id: $("#tag_id1").val(),
                name: $("#name1").val(),
                user_id: $("#user_id1").val(),
                due_date: $("#due_date1").val(),
                status: $("#status1").val(),
                start: $("#start1").val(),
                end: $("#end1").val(),
                repeat: $("#repeat1").val(),
                location: $("#location1").val(),
                attachment: $("#attachment1").val(),
                description: $("#description1").val()
            },
            success: function (data) {
                if (data.code === 200) {
                    $('#datatable').DataTable().ajax.reload();
                    toastr.success('Công việc, nhiệm vụ được cập nhật thành công.', 'Cập nhật thành công');
                    Swal.fire('Cập nhật', 'Công việc, nhiệm vụ được cập nhật thành công.', 'success');
                    $("#editTaskModal").modal('hide');
                    $('body').removeAttr('onbeforeunload');
                    $("#attachment1").val('');
                    $("#editTask")[0].reset();

                    Dropzone.forElement("#showAttachFiles").removeAllFiles(true);
                    Dropzone.forElement("#attachFiles1").removeAllFiles(true);
                }
            },
            error: function (data) {
                let errors = data.responseJSON;
                let errorsHtml = "";
                $.each(errors, function (key, value) {
                    errorsHtml += "<li>" + value[0] + "</li>";
                });
                toastr.error(errorsHtml, "Cập nhật lỗi!");
                Swal.fire("Error!", errorsHtml, "error");
            }
        });
    });

    $('body').on('click', '.deleteAll', function (event) {
        event.preventDefault();
        let idsArr = [];
        $(".checkbox:checked").each(function () {
            idsArr.push($(this).attr('id'));
        });
        deleteAll(idsArr, 'task/category/delete/', 'Công việc, nhiệm vụ')
    });

    $('.filterDateStart').click(function () {
        $('#filterDateStart').val($(this).attr('id'));
        $('#datatable').DataTable().ajax.reload();
    });

});

