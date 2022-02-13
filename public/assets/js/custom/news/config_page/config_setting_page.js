$(function () {
    // Add Config
    $("#addConfigPage").submit(function (event) {
        event.preventDefault();
        let config_key = $("#config_key").val();
        let config_value = $("#config_value").val();

        $.ajax({
            url: 'config/add',
            type: "POST",
            data: {
                config_key: config_key,
                config_value: config_value,
            },
            success: function (data) {
                if (data.code === 200) {
                    $('#datatable').DataTable().ajax.reload();
                    Swal.fire(
                        'Create ' + data.key,
                        'Add Config Setting Page Success.',
                        'success'
                    )
                    $("#addConfigPage")[0].reset();
                    $("#configPageModal").modal('hide');
                }
            },
            error: function (data) {
                let errors = data.responseJSON;
                let errorsHtml = "";
                $.each(errors, function (key, value) {
                    errorsHtml += "<li>" + value[0] + "</li>";
                });
                toastr.error(errorsHtml, "Tìm kiếm lỗi!");
                Swal.fire("Error!", errorsHtml, "error");
            }
        });
    });

    // Edit Config
    $('body').on('click', '.action_edit', function (event) {
        event.preventDefault();
        var id = $(this).data('id');
        // opens edit modal and inserts values
        $.get('config/edit/' + id, function (data) {
            $("#id").val(data.id);
            $("#config_key1").val(data.config_key);
            $("#config_value1").val(data.config_value);
            $("#editConfigPageModal").modal('toggle');
        });
    })

    // Update Config
    $("#editConfigPage").submit(function (e) {
        e.preventDefault();
        let id = $("#id").val();
        let config_key = $("#config_key1").val();
        let config_value = $("#config_value1").val();

        $.ajax({
            url: 'config/edit/' + id,
            type: "PUT",
            data: {
                id: id,
                config_key: config_key,
                config_value: config_value,
            },
            success: function (data) {
                if (data.code === 200) {
                    $('#datatable').DataTable().ajax.reload();
                    Swal.fire(
                        'Update ' + data.key,
                        'Update Config Setting Page Success.',
                        'success'
                    )
                    $("#editConfigPageModal").modal('hide');
                    $("#editConfigPage")[0].reset();
                }
            },
            error: function (data) {
                let errors = data.responseJSON;
                let errorsHtml = "";
                $.each(errors, function (key, value) {
                    errorsHtml += "<li>" + value[0] + "</li>";
                });
                toastr.error(errorsHtml, "Tìm kiếm lỗi!");
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
        deleteAll(idsArr, 'config/delete/', 'Config Page')
    });

    // validate form
    // =======================================================
    $("#addConfigPage").validate({
        rules: {
            config_key: {
                required: true,
                maxlength: 30
            },
            config_value: {
                required: true,
                maxlength: 500
            },
        },
        messages: {
            config_key: {
                required: 'Bạn chưa nhập config key',
                maxlength: 'Tên config tối đa 30 ký tự'
            },
            config_value: {
                required: 'Bạn chưa nhập nội dung config',
                maxlength: 'Nội dung config tối đa 500 ký tự'
            }
        }
    });
    $("#editConfigPage").validate({
        rules: {
            config_key1: {
                required: true,
                maxlength: 30
            },
            config_value1: {
                required: true,
                maxlength: 500
            },
        },
        messages: {
            config_key1: {
                required: 'Bạn chưa nhập config key',
                maxlength: 'Tên config tối đa 30 ký tự'
            },
            config_value1: {
                required: 'Bạn chưa nhập nội dung config',
                maxlength: 'Nội dung config tối đa 500 ký tự'
            }
        }
    });
});

