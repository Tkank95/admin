$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Tiền thanh toán nhỏ hơn Đến số tiền
    $.validator.addMethod("lessThanCurrent", function (value, element) {
        var item = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".").replace(/\D/g, "");
        var params = $("#filter3").val().replace(/\B(?=(\d{3})+(?!\d))/g, ".").replace(/\D/g, "");

        if (params !== '' || params > item) {
            if (!/Invalid|NaN/.test(item)) {
                return item <= params;
            }

            return isNaN(item) && isNaN(params) || (Number(item) <= Number(params));
        } else {
            return true;
        }
    }, 'Phải nhỏ hơn hoặc bằng "Đến số tiền".');

    // Đến số tiền lớn hơn Tiền thanh toán
    $.validator.addMethod("greaterThanCurrent", function (value, element) {
        var item = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".").replace(/\D/g, "");
        var params = $("#filter2").val().replace(/\B(?=(\d{3})+(?!\d))/g, ".").replace(/\D/g, "");

        if (params !== '' || params > item) {
            if (!/Invalid|NaN/.test(item)) {
                return item >= params;
            }

            return isNaN(item) && isNaN(params) || (Number(item) >= Number(params));
        } else {
            return true;
        }
    }, 'Phải lớn hơn hoặc bằng "Tiền thanh toán".');

    // validate form
    // =======================================================
    $("#filter").validate({
        rules: {
            filter1: {
                date: true
            },
            filter2: {
                required: function (element) { // Bắt buộc nhập nếu filter2 khác rỗng
                    return $("#filter3").val() !== "";
                },
                lessThanCurrent: true
            },
            filter3: {
                required: function (element) { // Bắt buộc nhập nếu filter2 khác rỗng
                    return $("#filter2").val() !== "";
                },
                greaterThanCurrent: true
            },
            datatableSearch: {
                maxlength: 255
            },
            start_date: {
                date: true,
                lessThan: '#end_date'
            },
            end_date: {
                required: function (element) { // Bắt buộc nhập nếu start_date khác rỗng
                    return $("#start_date").val() !== "";
                },
                date: true,
                greaterThan: "#start_date"
            }
        },
        messages: {
            filter1: {
                date: 'Không đúng định dạng ngày tháng.',
            },
            filter2: {
                required: 'Trường này bắt buộc nhập.'
            },
            filter3: {
                required: 'Trường này bắt buộc nhập.'
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

    $("#addExpense").validate({
        rules: {
            payment_date: {
                required: true,
                date: true
            },
            expense_cate: {
                required: true
            },
            amount_vnd: {
                required: true
            }
        },
        messages: {
            payment_date: {
                required: 'Bạn chưa nhập ngày giờ thanh toán',
                date: 'Không đúng định dạng ngày tháng.'
            },
            expense_cate: {
                required: 'Bạn chưa chọn loại chi phí.'
            },
            amount_vnd: {
                required: 'Bạn chưa nhập số tiền.'
            }
        }
    });

    $("#editExpense").validate({
        rules: {
            payment_date1: {
                required: true,
                date: true
            },
            expense_cate1: {
                required: true
            },
            amount_vnd1: {
                required: true
            }
        },
        messages: {
            payment_date1: {
                required: 'Bạn chưa nhập ngày giờ thanh toán',
                date: 'Không đúng định dạng ngày tháng.'
            },
            expense_cate1: {
                required: 'Bạn chưa chọn loại chi phí.'
            },
            amount_vnd1: {
                required: 'Bạn chưa nhập số tiền.'
            }
        }
    });

    // Add Config
    $("#addExpense").submit(function (event) {
        event.preventDefault();

        $.ajax({
            url: 'expense/add',
            type: "POST",
            data: {
                payment_date: $("#payment_date").val(),
                expense_cate: $("#expense_cate").val(),
                amount_vnd: $("#amount_vnd").val().replace(/\B(?=(\d{3})+(?!\d))/g, ".").replace(/\D/g, ""),
                amount_usd: $("#amount_usd").val(),
                rate: $("#rate").val().replace(/\B(?=(\d{3})+(?!\d))/g, ".").replace(/\D/g, ""),
                description: $("#description").val()
            },
            success: function (data) {
                if (data.code === 200) {
                    $('#datatable').DataTable().ajax.reload();
                    toastr.success('Chi phí thanh toán mới được thêm thành công.', 'Thêm mới thành công');
                    Swal.fire('Thêm mới', 'Chi phí thanh toán mới được thêm thành công.', 'success');
                    $("#addExpense")[0].reset();
                    $("#expenseModal").modal('hide');
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
        $.get('expense/edit/' + id, function (data) {
            $("#id").val(data.id);
            $("#payment_date1").val(data.payment_date);
            $("#expense_cate1").val(data.expense_cate).trigger('change');
            $("#amount_vnd1").val((data.amount_vnd).toLocaleString());
            $("#amount_usd1").val(data.amount_usd);
            $("#rate1").val((data.rate).toLocaleString());
            $("#description1").val(data.description);
            $("#editExpenseModal").modal('toggle');
        });
    })

    // Update Config
    $("#editExpense").submit(function (e) {
        e.preventDefault();
        let id = $("#id").val();

        $.ajax({
            url: 'expense/edit/' + id,
            type: "PUT",
            data: {
                payment_date: $("#payment_date1").val(),
                expense_cate: $("#expense_cate1").val(),
                amount_vnd: $("#amount_vnd1").val().replace(/\B(?=(\d{3})+(?!\d))/g, ".").replace(/\D/g, ""),
                amount_usd: $("#amount_usd1").val(),
                rate: $("#rate1").val().replace(/\B(?=(\d{3})+(?!\d))/g, ".").replace(/\D/g, ""),
                description: $("#description1").val()
            },
            success: function (data) {
                if (data.code === 200) {
                    $('#datatable').DataTable().ajax.reload();
                    toastr.success('Chi phí thanh toán được cập nhật thành công.', 'Cập nhật thành công');
                    Swal.fire('Cập nhật', 'Chi phí thanh toán được cập nhật thành công.', 'success');
                    $("#editExpenseModal").modal('hide');
                    $("#editExpense")[0].reset();
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
        deleteAll(idsArr, 'expense/category/delete/', 'Chi phí thanh toán')
    });

    $('input.convert-number').keyup(function (event) {
        // skip for arrow keys
        if (event.which >= 37 && event.which <= 40) return;

        // format number
        $(this).val(function (index, value) {
            return value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        });
    });
});

