$(document).on('ready', function () {
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
                number: true,
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
                number: 'Dữ liệu không hợp lệ.',
            },
            start_date: {
                date: 'Không đúng định dạng ngày tháng'
            },
            end_date: {
                date: 'Không đúng định dạng ngày tháng',
            }
        }
    });

    $('body').on('click', '.active_status', function (event) {
        event.preventDefault();
        let id = $(this).data('id');
        active_status(id, 'rule/active/', 'Quy định live')
    });

    $('body').on('click', '.deactive_status', function (event) {
        event.preventDefault();
        let id = $(this).data('id');
        deactive_status(id, 'rule/deactive/', 'Quy định live')
    });

    $('body').on('click', '.deleteAll', function (event) {
        event.preventDefault();
        let idsArr = [];
        $(".checkbox:checked").each(function () {
            idsArr.push($(this).attr('id'));
        });
        deleteAll(idsArr, 'rule/delete/', 'Quy định live')
    });
});

