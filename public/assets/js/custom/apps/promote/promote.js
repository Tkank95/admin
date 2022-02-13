$(document).on('ready', function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // validate form
    $("#promoteApp").validate({
        // Xác thực nội dung ẩn
        ignore: 'input[type=hidden]',

        rules: {
            cate: {
                required: true,
                number: true,
            },
            app_id: {
                required: true,
                number: true,
            },
            title: {
                required: true,
                minlength: 6,
                maxlength: 255
            },
            banner: {
                required: true,
                extension: "png|jpg|svg|jpeg|gif",
                accept: "image/*",
                maxsize: 15728640,
            },
            banner_img: {
                required: true,
                extension: "png|jpg|svg|jpeg|gif",
                accept: "image/*",
                maxsize: 15728640,
            },
            content: {
                required: true
            },
            register: {
                required: true
            },
            status: {
                required: true,
                number: true
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
            title: {
                required: 'Bạn chưa nhập tiêu đề.',
                minlength: 'Tiêu đề tối thiểu 6 ký tự.',
                maxlength: 'Tiêu đề tối đa 255 ký tự.'
            },
            banner: {
                required: 'Bạn chưa chọn ảnh banner.',
                extension: 'Định dạng ảnh không hợp lệ.',
                accept: 'Định dạng ảnh không hợp lệ.',
                maxsize: 'Kích thước tối đa 15mb.'
            },
            banner_img: {
                required: 'Bạn chưa chọn ảnh banner.',
                extension: 'Định dạng ảnh không hợp lệ.',
                accept: 'Định dạng ảnh không hợp lệ.',
                maxsize: 'Kích thước tối đa 15mb.'
            },
            content: {
                required: 'Bạn chưa nhập nội dung'
            },
            register: {
                required: 'Bạn chưa nhập hướng dẫn đăng ký'
            },
            status: {
                required: 'Bạn chưa chọn trạng thái.',
                number: 'Trạng thái không hợp lệ.'
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

    $('.banner').on('change', function () {
        preview('banner')
    });
});

