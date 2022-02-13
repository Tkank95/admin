$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Add Config
    $("#addIncomeCategory").submit(function (event) {
        event.preventDefault();
        let name = $("#name").val();

        $.ajax({
            url: 'income/category/add',
            type: "POST",
            data: {name: name},
            success: function (data) {
                if (data.code === 200) {
                    $('#datatable').DataTable().ajax.reload();
                    toastr.success('Loại thu nhập mới được thêm thành công.', 'Thêm mới thành công');
                    Swal.fire('Thêm mới', 'Loại thu nhập mới được thêm thành công.', 'success');
                    $("#addIncomeCategory")[0].reset();
                    $("#incomeCategoryModal").modal('hide');
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
        $.get('income/category/edit/' + id, function (data) {
            $("#id").val(data.id);
            $("#name1").val(data.name);
            $("#editIncomeCategoryModal").modal('toggle');
        });
    })

    // Update Config
    $("#editIncomeCategory").submit(function (e) {
        e.preventDefault();
        let id = $("#id").val();
        let name = $("#name1").val();

        $.ajax({
            url: 'income/category/edit/' + id,
            type: "PUT",
            data: {id: id, name: name},
            success: function (data) {
                if (data.code === 200) {
                    $('#datatable').DataTable().ajax.reload();
                    toastr.success('Loại thu nhập được cập nhật thành công.', 'Cập nhật thành công');
                    Swal.fire('Cập nhật', 'Loại thu nhập được cập nhật thành công.', 'success');
                    $("#editIncomeCategoryModal").modal('hide');
                    $("#editIncomeCategory")[0].reset();
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
        deleteAll(idsArr, 'income/category/delete/', 'Loại thu nhập')
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
                required: 'Bạn chưa nhập tên loại thu nhập.',
                maxlength: 'Tên loại thu nhập tối đa 255 ký tự.'
            },
            name1: {
                required: 'Bạn chưa nhập tên loại thu nhập.',
                maxlength: 'Tên loại thu nhập tối đa 255 ký tự.'
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

