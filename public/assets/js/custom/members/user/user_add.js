$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Yêu cầu password
    $.validator.addMethod("passwordRuler", function (value, element) {
        return this.optional(element) || /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,32}$/i.test(value);
    }, "Hãy nhập password từ 8 đến 32 ký tự bao gồm chữ hoa, chữ thường và chữ số");

    // Yêu cầu Email
    $.validator.addMethod("laxEmail", function (value, element) {
        return this.optional(element) || /^([a-zA-Z0-9_\-]+[\+\.])*([a-zA-Z0-9_\-])+@[a-zA-Z0-9]+([_\-\.][a-zA-Z0-9]+)*\.[a-zA-Z0-9]+([\-.][a-zA-Z0-9]+)*$/.test(value);
    }, "Email không hợp lệ. Vui lòng nhập địa chỉ email hợp lệ.");

    // Check username không có ký tự dặc biệt
    $.validator.addMethod('usernameRuler', function (value, element) {
        return this.optional(element) || /^([a-zA-Z0-9]).{5,15}$/i.test(value);
    }, 'Username gồm các ký tự chữ và số.');

    $.validator.addMethod("minAge", function (value, element, min) {
        var today = new Date();
        var birthDate = new Date(value);
        var age = today.getFullYear() - birthDate.getFullYear();
        var m = today.getMonth() - birthDate.getMonth();

        if (age > min + 1) {
            return true;
        }
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }

        return age >= min;
    }, "Bạn chưa đủ 13 tuổi!");

    $.validator.addMethod("maxAge", function (value, element, max) {
        var today = new Date();
        var birthDate = new Date(value);
        var age = today.getFullYear() - birthDate.getFullYear();
        var m = today.getMonth() - birthDate.getMonth();

        if (age < max + 1) {
            return true;
        }
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }

        return age <= max;
    }, "Khai thật tuổi của bạn đi!");

    let email = $("#email").val();
    let username = $("#username").val();

    $("#addUser").validate({
        rules: {
            name: {
                required: true,
                minlength: 6,
                maxlength: 30
            },
            email: {
                required: true,
                email: true,
                laxEmail: true,
                remote: {
                    url: 'check/email',
                    type: "post",
                    data: {
                        email: $(email).val()
                    },
                    dataFilter: function (data) {
                        let json = JSON.parse(data);
                        if (json.msg === 'true') {
                            return "\"" + "Email đã có người sử dụng" + "\"";
                        } else {
                            return 'true';
                        }
                    }
                }
            },
            phone: {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 10
            },
            birthday: {
                required: true,
                date: true,
                minAge: 13,
                maxAge: 70
            },
            address: {
                required: true,
                minlength: 8,
                maxlength: 100
            },
            facebook: {
                required: true,
                minlength: 5,
                maxlength: 100,
                url: true
            },
            username: {
                required: true,
                minlength: 6,
                maxlength: 15,
                usernameRuler: true,
                remote: {
                    url: 'check/username',
                    type: 'post',
                    data: {
                        username: $(username).val()
                    },
                    dataFilter: function (data) {
                        let json = JSON.parse(data);
                        if (json.msg === 'true') {
                            return "\"" + "Username đã có người sử dụng" + "\"";
                        } else {
                            return 'true';
                        }
                    }
                }
            },
            password: {
                required: true,
                passwordRuler: true,
                minlength: 8,
                maxlength: 32
            },
            confirmpassword: {
                required: true,
                minlength: 6,
                maxlength: 32,
                equalTo: "#password",
                passwordRuler: true
            },
            position: {
                required: true
            },
            role: {
                required: true
            },
            avatar: {
                required: true,
                extension: "png|jpg|svg|jpeg|gif",
                accept: "image/*",
                maxsize: 15728640
            },
            status: {
                required: true,
                number: true
            },
            gender: {
                required: true,
                number: true
            }
        },
        messages: {
            name: {
                required: "Bạn chưa nhập họ và tên",
                minlength: "Họ và tên tối thiểu 6 ký tự",
                maxlength: "Họ và tên tối đa 30 ký tự",
            },
            email: {
                required: "Bạn chưa nhập Email",
                email: "Email không đúng định dạng",
                unique: "Email đã có người sử dụng"
            },
            phone: {
                required: "Bạn chưa nhập số điện thoại",
                number: "Số điện thoại phải là số",
                minlength: "Số điện thoại 10 số",
                maxlength: "Số điện thoại có 10 số"
            },
            birthday: {
                required: "Bạn chưa nhập ngày sinh",
                date: "Bạn chưa nhập ngày sinh không hợp lệ",
                minAge: "Bạn chưa đủ 13 tuổi!"
            },
            address: {
                required: "Bạn chưa nhập địa chỉ",
                minlength: "Địa chỉ tối thiểu 6 ký tự",
                maxlength: "Địa chỉ tối đa 100 ký tự"
            },
            facebook: {
                required: "Bạn chưa nhập facebook",
                minlength: 'Link facebook tối thiểu 5 ký tự',
                maxlength: 'Link facebook tối đa 100 ký tự',
                url: "Link facebook không hợp lệ",
            },
            username: {
                required: "Bạn chưa đặt username",
                minlength: "Username tối thiểu 6 ký tự",
                maxlength: "Username tối đa 32 ký tự"
            },
            password: {
                required: "Bạn chưa đặt mật khẩu",
                minlength: "Mật khẩu tối thiểu 8 ký tự",
                maxlength: "Mật khẩu tối đa 32 ký tự"
            },
            confirmpassword: {
                required: "Bạn chưa nhập lại mật khẩu",
                minlength: "Mật khẩu tối thiểu 8 ký tự",
                maxlength: "Mật khẩu tối đa 32 ký tự",
                equalTo: "Mật khẩu không khớp. Vui lòng nhập lại"
            },
            position: {
                required: "Bạn chưa chọn vị trí"
            },
            role: {
                required: "Bạn chưa chọn phân quyền"
            },
            avatar: {
                required: 'Bạn chưa chọn logo ứng dụng',
                extension: 'Định dạng logo không đúng',
                accept: 'Định dạng logo không đúng.',
                maxsize: "Ảnh tối đa 15mb"
            },
            status: {
                required: "Bạn chưa chọn trạng thái tài khoản",
                number: 'Trạng thái tài khoản không hợp lệ.'
            },
            gender: {
                required: "Bạn chưa chọn giới tính",
                number: 'Giới tính không hợp lệ.'
            }
        }
    });

    // Hiển thị dữ liệu sau khi nhập
    $('body').on('click', '.show_view', function show_view() {
        $('#nameview').text($('#name').val());
        $('#usernameview').text($('#username').val());
        $('#emailview').text($('#email').val());
        $('#phoneview').text($('#phone').val());
        $('#birthdayview').text($('#birthday').val());

        $('#genderview').text($('input[name="gender"]:checked').val() === '0' ? 'Nữ' : 'Nam');
        $('#positionview').text($('#position option:selected').text());
        $('#permissionview').text($('#role option:selected').toArray().map(item => item.text).join(', '));
        $('#statusview').text($('input[name="status"]:checked').val() === '0' ? 'Khoá vĩnh viễn' : 'Hoạt động');
        $('#teamview').text($('#team').val());

        $('#addressview').text($('#address').val());
        $('#facebookview').text($('#facebook').val());
    });


    // INITIALIZATION OF FILE ATTACH
    // =======================================================
    $('.js-file-attach').each(function () {
        var customFile = new HSFileAttach($(this)).init();
    });

    // INITIALIZATION OF STEP FORM
    // =======================================================
    $('.js-step-form').each(function () {
        var stepForm = new HSStepForm($(this), {
            finish: function () {
                $("#addUserStepFormProgress").hide();
                $("#addUserStepFormContent").hide();
                $("#successMessageContent").show();
            }
        }).init();
    });
});

