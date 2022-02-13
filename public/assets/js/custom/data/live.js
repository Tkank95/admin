$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // INITIALIZATION OF EDITABLE TABLE
    // =======================================================
    $('#datatable').on('click', '.js-edit', function () {
        event.preventDefault();
        $('#datatable tbody tr').editable({
            keyboard: true,
            dblclick: true,
            button: true,
            buttonSelector: '.js-edit',
            maintainWidth: false,
            edit: function (values) {
                $('.js-edit .js-edit-icon', this).removeClass('tio-edit').addClass('tio-done');
                $(this).find('td[data-field] input').addClass('form-control form-control-sm');
            },
            save: function (values) {
                var id = $(this).data('id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Thao tác sẽ chỉnh sửa dữ liệu live, có thể sẽ làm sai số liệu tính lương của idol!",
                    icon: 'warning',
                    allowOutsideClick: false,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, update it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post('data/live/edit/' + id, values)
                            .done(function (data) {
                                if (data.code === 200) {
                                    Swal.fire('Cập nhật!', 'Cập nhật thành công ID ' + data.id_in_app, 'success');
                                    toastr.success('Cập nhật thành công ID' + data.id_in_app, 'Cập nhật!');
                                }
                            })
                            .fail(function (data) {
                                let errors = data.responseJSON;
                                let errorsHtml = "";
                                $.each(errors, function (key, value) {
                                    errorsHtml += "<li>" + value[0] + "</li>";
                                });
                                toastr.error(errorsHtml, "Error!");
                                Swal.fire("Error!", errorsHtml, "error");
                            });
                        $('.js-edit .js-edit-icon', this).removeClass('tio-done').addClass('tio-edit');
                    } else {
                        $('.js-edit .js-edit-icon', this).removeClass('tio-done').addClass('tio-edit');
                    }
                })
            },
            cancel: function (values) {
                toastr.warning('Đã huỷ cập nhật.', "Thông báo");
                $('.js-edit .js-edit-icon', this).removeClass('tio-done').addClass('tio-edit');
            }
        })
    });


    // Xoá nhiều bản ghi
    $('body').on('click', '.deleteAll', function (event) {
        event.preventDefault();
        let idsArr = [];
        $(".checkbox:checked").each(function () {
            idsArr.push($(this).attr('id'));
        });
        deleteAll(idsArr, 'data/live/delete/', 'Số liệu live stream')
    });

    $("#filter").validate({
        rules: {
            filter1: {
                number: true,
            },
            filter2: {
                number: true,
            },
            filter3: {
                date: true,
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
                number: 'Bắt buộc là số',
            },
            filter2: {
                number: 'Bắt buộc là số',
            },
            filter3: {
                date: 'Không đúng định dạng ngày tháng',
            },
            start_date: {
                date: 'Không đúng định dạng ngày tháng'
            },
            end_date: {
                date: 'Không đúng định dạng ngày tháng',
            }
        }
    });
})

