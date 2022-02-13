$(document).on('ready', function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // validate form
    $("#ruleLive").validate({
        rules: {
            cate: {
                required: true,
                number: true,
            },
            app_id: {
                required: true,
                number: true,
            },
            active_day: {
                required: true,
                date: true
            },
            status: {
                required: true,
                number: true,
            },
            live_rule: {
                required: true
            }
        },
        messages: {
            cate: {
                required: 'Bạn chưa chọn thể loại.',
                number: 'Thể loại không hợp lệ.'
            },
            app_id: {
                required: 'Bạn chưa chọn ứng dụng.',
                number: 'Ứng dụng không hợp lệ.'
            },
            active_day: {
                required: 'Bạn chưa chọn ngày hiệu lực.',
                date: 'Ngày hiệu lực không hợp lệ.'
            },
            status: {
                required: 'Bạn chưa chọn trạng thái.',
                number: 'Trạng thái không hợp lệ.'
            },
            live_rule: {
                required: 'Bạn chưa nhập quy định live.'
            }
        }
    });

    /*Get Application từ Category */
    $('#cate').on('change', function () {
        var id = this.value;
        $("#app_id").html('<option value="0" disabled selected>Processing...</option>');
        $.ajax({
            url: 'category/load/' + id,
            type: 'GET',
            dataType: 'json',
            success: function (result) {
                $('#app_id').removeAttr('disabled');
                $('#app_id').html('<option value="0" disabled selected>Chọn app</option>');
                $.each(result, function (key, value) {
                    $("#app_id").append('<option value="' + value.id + '">' + value.name + '</option>');
                });
            }
        });
    });
});

