$(function () {
    $('.checkbox_wrapper').on('click', function (){
        $(this).parents('.collapse').find('.checkbox_childrent').prop('checked', $(this).prop('checked'));
    });

    $('.checkall').on('click', function (){
        $(this).parents().find('.checkbox_childrent').prop('checked', $(this).prop('checked'));
        $(this).parents().find('.checkbox_wrapper').prop('checked', $(this).prop('checked'));
    });


    // validate form
    // =======================================================
    $("#role").validate({
        rules: {
            name: {
                required: true,
            },
            display_name: {
                required: true,
            },
            permision_id: {
                required: true,
            }
        },
        messages: {
            name: {
                required: 'Bạn chưa nhập tên vai trò',
            },
            display_name: {
                required: 'Bạn chưa nhập mô tả vai trò',
            },
            permision_id: {
                required: 'Bạn chưa chọn các quyền cho vai trò',
            }
        }
    });
});

