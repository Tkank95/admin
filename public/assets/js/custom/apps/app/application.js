$(function () {
    // validate form
    // =======================================================
    $("#application").validate({
        rules: {
            cate_id: {
                required: true,
            },
            name: {
                required: true,
                minlength: 4,
                maxlength: 10
            },
            logo: {
                required: true,
                extension: "png|jpg|svg|jpeg|gif",
                accept: "image/*",
                maxsize: 15728640,
            },
            logo_img: {
                required: true,
                extension: "png|jpg|svg|jpeg|gif",
                accept: "image/*",
                maxsize: 15728640,
            },
            link_download: {
                required: true,
                url: true,
                minlength:6,
                maxlength:200
            },
            top: {
                required: true,
            },
            status: {
                required: true,
            }
        },
        messages: {
            cate_id: {
                required: 'Bạn chưa chọn thể loại ứng dụng.',
            },
            name: {
                required: 'Bạn chưa nhập tên ứng dụng.',
                minlength: 'Tên ứng dụng tối thiểu 4 ký tự.',
                maxlength: 'Tên ứng dụng tối đa 10 ký tự.'
            },
            logo: {
                required: 'Bạn chưa chọn ảnh logo ứng dụng.',
                extension: 'Định dạng ảnh logo không đúng.',
                accept: 'Định dạng ảnh logo không đúng.',
                maxsize: 'Ảnh logo tối đa 15mb',
            },
            logo_img: {
                required: 'Bạn chưa chọn ảnh logo ứng dụng.',
                extension: 'Định dạng ảnh logo không đúng.',
                accept: 'Định dạng ảnh logo không đúng.',
                maxsize: 'Ảnh logo tối đa 15mb',
            },
            link_download: {
                required: 'Bạn chưa nhập link tải ứng dụng.',
                url: 'Định dạng link tải không đúng',
                minlength: 'Link tải ứng dụng tối thiểu 6 ký tự.',
                maxlength: 'Link tải ứng dụng tối đa 200 ký tự.'
            },
            top: {
                required: 'Bạn chưa chọn top ứng dụng',
            },
            status: {
                required: 'Bạn chưa chọn trạng thái',
            }
        }
    });

    $('.logo').on('change', function () {
        preview('logo')
    });
});

