$(function () {
    $('.image').on('change', function () {
        preview('image')
    });

    $('body').on('click', '.deleteAll', function (event) {
        event.preventDefault();
        let idsArr = [];
        $(".checkbox:checked").each(function () {
            idsArr.push($(this).attr('id'));
        });
        deleteAll(idsArr, 'slide/delete/', 'Slide')
    });

    // validate form
    // =======================================================
    $("#slide").validate({
        rules: {
            name: {
                required: true,
                maxlength: 100
            },
            link: {
                required: true,
                url: true,
            },
            status: {
                required: true,
            },
            top: {
                required: true,
            },
            content: {
                required: true,
            },
            description: {
                required: true,
            },
            thumb: {
                required: true,
                extension: "png|jpg|svg|jpeg"
            }
        },
        messages: {
            name: {
                required: 'Bạn chưa nhập tên slide',
                maxlength: 'Tên slide tối đa 100 ký tự'
            },
            link: {
                required: 'Bạn chưa nhập link liên kết',
                url: 'Định dạng link url không đúng',
            },
            status: {
                required: 'Bạn chưa chọn status',
            },
            top: {
                required: 'Bạn chưa chọn top',
            },
            content: {
                required: 'Bạn chưa nhập nội dung slide',
            },
            description: {
                required: 'Bạn chưa nhập nội dung mô tả join job',
            },
            thumb: {
                required: 'Bạn chưa chọn ảnh slide',
                extension: 'Định dạng ảnh không đúng'
            },
        }
    })
})

