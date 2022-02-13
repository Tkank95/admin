$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Edit Feedback
    $('body').on('click', '.action_edit', function (event) {
        event.preventDefault();
        var id = $(this).data('id');
        // opens edit modal
        $.get('feedback/edit/' + id, function (data) {
            $("#id").val(data.id);
            var reply = '<span class="badge badge-warning"> Chưa trả lời </span>';
            if (data.result !== null){
                reply = '<span class="badge badge-primary"> Đã trả lời </span> ' + ' <span class="badge badge-success">' + data.updated_at + '</span>';
                $("#result").val(data.result);
            }
            $("#modalHeading").html('Trả lời phản hồi #' + id + '  ' + reply)
            $("#content_feedback").val(data.content);
            $("#editFeedbackModal").modal('toggle');
        });
    })

    // Update Feedback
    $("#editFeedback").submit(function (e) {
        e.preventDefault();
        let id = $("#id").val();
        let result = $("#result").val();

        $.ajax({
            url: 'feedback/edit/' + id,
            type: "Post",
            data: {
                id: id,
                result: result,
            },
            success: function (data) {
                if (data.code === 200) {
                    $('#datatable').DataTable().ajax.reload();
                    toastr.success('Trả lời phản hồi thành công.', 'Update success');
                    Swal.fire('Update', 'Trả lời phản hồi thành công.', 'success');
                    $("#editFeedbackModal").modal('hide');
                    $("#editFeedback")[0].reset();
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

    // Xoá nhiều bản ghi
    $('body').on('click', '.deleteAll', function (event) {
        event.preventDefault();
        let idsArr = [];
        $(".checkbox:checked").each(function () {
            idsArr.push($(this).attr('id'));
        });
        deleteAll(idsArr, 'feedback/delete/', 'Feedback')
    });

    $("#filter").validate({
        rules: {
            filter1: {
                number: true,
            },
            filter2: {
                number: true,
                minlength: 10,
                maxLength: 10
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
                number: 'Bắt buộc là số',
            },
            filter2: {
                number: 'Bắt buộc là số',
                minlength: 'Số điện thoại 10 số.',
                maxLength: 'Số điện thoại 10 số.'
            },
            filter3: {
                email: 'Email không đúng định dạng',
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

