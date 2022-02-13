$(function () {
    // validate form
    // =======================================================
    $("#news").validate({
        rules: {
            title: {
                required: true,
                maxlength: 100
            },
            app_id: {
                required: true,
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
            image: {
                required: true,
                extension: "png|jpg|svg|jpeg"
            }
        },
        messages: {
            title: {
                required: 'Bạn chưa nhập tiêu đề tin tức',
                maxlength: 'Tiêu đề tin tối đa 100 ký tự'
            },
            app_id: {
                required: 'Bạn chưa chọn ứng dụng'
            },
            status: {
                required: 'Bạn chưa chọn status',
            },
            top: {
                required: 'Bạn chưa chọn Top cho tin tức',
            },
            content: {
                required: 'Bạn chưa nhập nội dung tin tức',
            },
            image: {
                required: 'Bạn chưa chọn ảnh',
                extension: 'Định dạng ảnh không hợp lệ'
            }
        }
    });

    $('.image').on('change', function () {
        preview('image')
    });

    /*Get Application từ Category */
    $(function () {
        $('#cate').on('change', function () {
            var id = this.value;
            $("#app_id").html('<option value="0" disabled selected>Processing...</option>');
            $.ajax({
                url: 'category/load/' + id,
                type: 'GET',
                dataType: 'json',
                success: function (result) {
                    $('#app_id').removeAttr('disabled');
                    $('#app_id').html('<option value="0" disabled selected>Chọn ứng dụng live stream</option>');
                    $.each(result, function (key, value) {
                        $("#app_id").append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                }
            });
        });
    });
});

