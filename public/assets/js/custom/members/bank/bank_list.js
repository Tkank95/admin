$(function () {
    $("#filter").validate({
        rules: {
            filter1: {
                string: true,
            },
            filter2: {
                string: true,
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

    $('body').on('click', '.deleteAll', function (event) {
        event.preventDefault();
        let idsArr = [];
        $(".checkbox:checked").each(function () {
            idsArr.push($(this).attr('id'));
        });
        deleteAll(idsArr, 'bank/delete/', 'Thông tin ngân hàng')
    });
});
