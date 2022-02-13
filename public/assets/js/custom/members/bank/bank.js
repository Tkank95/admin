$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    // validate form
    // =======================================================
    $("#bank").validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            name: {
                required: true,
                minlength: 6,
                maxlength: 30
            },
            account: {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 20
            },
            bank_name: {
                required: true
            },
            branch: {
                required: true
            }
        },
        messages: {
            email: {
                required: 'Bạn chưa chọn Email.',
                email: 'Email không hợp lệ.'
            },
            name: {
                required: 'Bạn chưa nhập họ và tên chủ tài khoản.',
                minlength: 'Họ và tên tối thiểu 6 ký tự.',
                maxlength: 'Họ và tên tối đa 30 ký tự.'
            },
            account: {
                required: 'Bạn chưa nhập số tài khoản.',
                number: 'Số tài khoản không hợp lệ.',
                minlength: 'Số tài khoản tối thiểu 10 ký tự.',
                maxlength: 'Số tài khoản tối đa 20 ký tự.'
            },
            bank_name: {
                required: 'Bạn chưa chọn tên ngân hàng.'
            },
            branch: {
                required: 'Bạn chưa chọn chi nhánh ngân hàng.'
            }
        }
    });

    /*Get Application từ Category */
    $(function () {
        $('#user_id').on('change', function () {
            let id = this.value;
            $.ajax({
                url: 'user/load/' + id,
                type: 'GET',
                dataType: 'json',
                success: function (result) {
                    $.each(result, function (key, value) {
                        $("#fullname").val(value.name);
                        $("#username").val(value.username);
                        $("#name").val(value.name);
                        $("#position").val(value.position);
                        $('#account').val('');
                        $('#bank_name').val('').trigger("change");
                        $('#branch').val('').trigger("change");
                    });
                },
                error: function (data) {
                    toastr.error('Lỗi tìm kiếm.', 'Error!');
                    Swal.fire(
                        'Error!',
                        'Lỗi tìm kiếm.',
                        'error'
                    )
                }
            });
        });
    });
});

