$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Add Config
    $("#addExpenseCategory").submit(function (event) {
        event.preventDefault();
        let name = $("#name").val();

        $.ajax({
            url: 'expense/category/add',
            type: "POST",
            data: {name: name},
            success: function (data) {
                if (data.code === 200) {
                    $('#datatable').DataTable().ajax.reload();
                    toastr.success('Loại chi phí mới được thêm thành công.', 'Thêm mới thành công');
                    Swal.fire('Thêm mới', 'Loại chi phí mới được thêm thành công.', 'success');
                    $("#addExpenseCategory")[0].reset();
                    $("#expenseCategoryModal").modal('hide');
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
        $.get('expense/category/edit/' + id, function (data) {
            $("#id").val(data.id);
            $("#name1").val(data.name);
            $("#editExpenseCategoryModal").modal('toggle');
        });
    })

    // Update Config
    $("#editExpenseCategory").submit(function (e) {
        e.preventDefault();
        let id = $("#id").val();
        let name = $("#name1").val();

        $.ajax({
            url: 'expense/category/edit/' + id,
            type: "PUT",
            data: {id: id, name: name},
            success: function (data) {
                if (data.code === 200) {
                    $('#datatable').DataTable().ajax.reload();
                    toastr.success('Loại chi phí được cập nhật thành công.', 'Cập nhật thành công');
                    Swal.fire('Cập nhật', 'Loại chi phí được cập nhật thành công.', 'success');
                    $("#editExpenseCategoryModal").modal('hide');
                    $("#editExpenseCategory")[0].reset();
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
        deleteAll(idsArr, 'expense/category/delete/', 'Loại chi phí')
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
                required: 'Bạn chưa nhập tên loại chi phí.',
                maxlength: 'Tên loại chi phí tối đa 255 ký tự.'
            },
            name1: {
                required: 'Bạn chưa nhập tên loại chi phí.',
                maxlength: 'Tên loại chi phí tối đa 255 ký tự.'
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

