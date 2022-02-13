$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
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
                email: true,
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
                number: 'Dữ liệu không hợp lệ.',
            },
            filter2: {
                number: 'Dữ liệu không hợp lệ.',
            },
            filter3: {
                email: 'Không đúng định dạng email',
            },
            start_date: {
                date: 'Không đúng định dạng ngày tháng'
            },
            end_date: {
                date: 'Không đúng định dạng ngày tháng',
            }
        }
    });

// Banned user.
    $('body').on('click', '.banned', function (event) {
        event.preventDefault();
        var id = $(this).data('id');
        // opens edit modal and inserts values
        $.get('user/show-ban/' + id, function (data) {
            $("#id").val(data.id);
            $("#avatar").attr({'src': data.avatar});
            $("#name").html(data.name);
            $("#email").html(data.email);
            if (data.banned_until != null) {
                $("#until").html(moment(data.banned_until).format("DD-MM-YYYY HH:mm:ss") + ' (' + moment(data.banned_until).fromNow(true) + ')');
            } else {
                $("#until").html('No ban');
            }
            $("#bannedUser").modal('toggle');
        });
    })

// Update Banned
    $('body').on('click', '.save', function (event) {
        event.preventDefault();
        let id = $("#id").val();
        let banned_until = $("#banSelect").val();

        $.ajax({
            url: 'user/ban/' + id,
            type: "POST",
            data: {
                id: id,
                banned_until: banned_until,
            },
            success: function (response) {
                if (response.error === false) {
                    $("#banned")[0].reset();
                    $("#banSelect").select2("val", "0");
                    $("#bannedUser").modal('hide');
                    $('#datatable').DataTable().ajax.reload();
                    toastr.success('Update banned thành công', 'Banned');
                    Swal.fire(
                        'Banned!',
                        'Update banned thành công',
                        'success'
                    )
                }
            },
            error: function (data) {
                toastr.error('Update banned lỗi vui lòng thử lại', 'Error!');
                Swal.fire(
                    'Error!',
                    'Update banned lỗi vui lòng thử lại',
                    'error'
                )
            }
        });
    });

    $('body').on('click', '.active_status', function (event) {
        event.preventDefault();
        let id = $(this).data('id');
        active_status(id, 'user/active/', 'Tài khoản người dùng')
    });

    $('body').on('click', '.deactive_status', function (event) {
        event.preventDefault();
        let id = $(this).data('id');
        deactive_status(id, 'user/deactive/', 'Tài khoản người dùng')
    });

    $('body').on('click', '.deleteAll', function (event) {
        event.preventDefault();
        let idsArr = [];
        $(".checkbox:checked").each(function () {
            idsArr.push($(this).attr('id'));
        });
        deleteAll(idsArr, 'user/delete/', 'Tài khoản người dùng')
    });
})
;


