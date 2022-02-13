$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Xoá nhiều bản ghi
    $('body').on('click', '.deleteAll', function (event) {
        event.preventDefault();
        let idsArr = [];
        $(".checkbox:checked").each(function () {
            idsArr.push($(this).attr('id'));
        });
        deleteAll(idsArr, 'job/delete/', 'Đơn đăng ký casting')
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

