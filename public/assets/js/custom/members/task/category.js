$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Add Config
    $("#addTaskTag").submit(function (event) {
        event.preventDefault();
        let name = $("#name").val();

        $.ajax({
            url: 'task/tag/add',
            type: "POST",
            data: {name: name},
            success: function (data) {
                if (data.code === 200) {
                    $('#datatable').DataTable().ajax.reload();
                    toastr.success('Thẻ nhiệm vụ mới được thêm thành công.', 'Thêm mới thành công');
                    Swal.fire('Thêm mới', 'Thẻ nhiệm vụ mới được thêm thành công.', 'success');
                    $("#addTaskTag")[0].reset();
                    $("#taskTagModal").modal('hide');
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

    // Edit Config
    $('body').on('click', '.action_edit', function (event) {
        event.preventDefault();
        var id = $(this).data('id');
        // opens edit modal and inserts values
        $.get('task/tag/edit/' + id, function (data) {
            $("#id").val(data.id);
            $("#name1").val(data.name);
            $("#editTaskTagModal").modal('toggle');
        });
    })

    // Update Config
    $("#editTaskTagModal").submit(function (e) {
        e.preventDefault();
        let id = $("#id").val();
        let name = $("#name1").val();

        $.ajax({
            url: 'task/tag/edit/' + id,
            type: "PUT",
            data: {id: id, name: name},
            success: function (data) {
                if (data.code === 200) {
                    $('#datatable').DataTable().ajax.reload();
                    toastr.success('Thẻ nhiệm vụ được cập nhật thành công.', 'Cập nhật thành công');
                    Swal.fire('Cập nhật', 'Thẻ nhiệm vụ được cập nhật thành công.', 'success');
                    $("#editTaskTagModal").modal('hide');
                    $("#editTaskTag")[0].reset();
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
        deleteAll(idsArr, 'task/tag/delete/', 'Thẻ nhiệm vụ')
    });

    // validate form content
    // =======================================================
    $("#content").validate({
        rules: {
            name: {
                required: true,
                maxlength: 255
            },
            name1: {
                required: true,
                maxlength: 255
            },
            datatableSearch: {
                maxlength: 255
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
            name: {
                required: 'Bạn chưa nhập tên thẻ nhiệm vụ.',
                maxlength: 'Tên thẻ nhiệm vụ tối đa 255 ký tự.'
            },
            name1: {
                required: 'Bạn chưa nhập tên thẻ nhiệm vụ.',
                maxlength: 'Tên thẻ nhiệm vụ tối đa 255 ký tự.'
            },
            datatableSearch: {
                maxlength: 'Tối đa 255 ký tự.'
            },
            start_date: {
                date: 'Không đúng định dạng ngày tháng'
            },
            end_date: {
                date: 'Không đúng định dạng ngày tháng',
            }
        }
    });
});

