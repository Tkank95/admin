$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // const testst = moment(cast_datetime).format('MM/DD/YYYY hh:mm:ss a');

    $('#cast_datetime').attr("datetime", moment().subtract(4, 'days').format("MM/DD/YYYY hh:mm:ss"))

    function getAge(value) {
        return ~~((new Date() - new Date(value)) / (31556952000));
    }

    // Check chọn có hợp đồng hay không
    $('input:radio[name="contract"]').change(function () {
        if ($(this).is(':checked')  && $(this).val() === '1') {
            $('#contract_status').removeAttr('disabled');
            $('#contract_status').val('0').trigger("change");
        } else {
            $('#contract_status').attr('disabled', '');
            $('#contract_status').val('4').trigger("change");
        }
    });

    // Check chọn game hay không
    $('#talent').change(function () {
        if ($(this).val() === 'Live stream Game') {
            $('#game').removeAttr('disabled');
        } else {
            $('#game').attr('disabled', '');
        }
    });

    /*Get info user từ email */
    $(function () {
        $('#user_id').on('change', function () {
            var id = this.value;
            $.ajax({
                url: 'job/get/user/' + id,
                type: 'GET',
                dataType: 'json',
                success: function (result) {
                    $.each(result, function (key, value) {
                        var age = getAge(value.birthday);

                        $("#fullname").val(value.name);
                        $("#username").val(value.username);
                        $("#gender").val(value.gender);
                        $("#position").val(value.position);
                        $("#phone").val(value.phone);
                        $("#facebook").val(value.facebook);

                        // Dưới 18 tuổi thì in đậm và màu nền đỏ
                        if (age < '18') {
                            $("#birthday").css({'background-color': '#ff0000', 'font-weight': 'bold'});
                            $("#birthday").val(value.birthday);
                        } else {
                            $("#birthday").removeAttr('style')
                            $("#birthday").val(value.birthday);
                        }

                        // Tài khoản bị vô hiệu hoá thì in đậm và màu nền đỏ
                        if (value.status === 'Disabled account') {
                            $("#status").css({'background-color': '#ff0000', 'font-weight': 'bold'});
                            $("#status").val(value.status);
                        } else {
                            $("#status").removeAttr('style')
                            $("#status").val(value.status);
                        }

                        // Bị band thì in đậm và màu nền đỏ
                        if (value.banned_until === null) {
                            $("#banned_until").removeAttr('style')
                            value.banned_until = 'Không bị band';
                            $("#banned_until").val(value.banned_until);
                        } else {
                            $("#banned_until").css({'background-color': '#ff0000', 'font-weight': 'bold'});
                            $("#banned_until").val(value.banned_until);
                        }
                    });
                }
            });
        });
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

    $('.cmnd_mt').on('change', function () {
        preview('cmnd_mt')
    });

    $('.cmnd_ms_img').on('change', function () {
        preview('cmnd_ms')
    });

    $('.selfie_cmnd').on('change', function () {
        preview('selfie_cmnd')
    });

    $('.selfie_team_img').on('change', function () {
        preview('selfie_team')
    });

    $('.selfie').on('change', function () {
        preview('selfie')
    });

    // Check số cmnd 9 số hoặc cccd 12 số
    $.validator.addMethod('checkCMND', function (value, element) {
        return this.optional(element) || /\b\d{9}\b|\d{12}/i.test(value);
    }, 'CMND 9 số hoặc CCCD 12 số.');

    $("#applyJob").validate({
        rules: {
            user_id: {
                digits: true,
                required: true
            },
            cate: {
                digits: true,
                required: true
            },
            app_id: {
                digits: true,
                required: true
            },
            id_in_app: {
                required: true,
                minlength: 4,
                maxlength: 15
            },
            team: {
                required: true
            },
            worked: {
                required: true,
                digits: true
            },
            talent: {
                required: true
            },
            game: {
                minlength: 2,
                maxlength: 100
            },
            nickname: {
                required: true,
                maxlength: 50
            },
            experience: {
                minlength: 2,
                maxlength: 100
            },
            video_casting: {
                minlength: 2,
                maxlength: 100,
                url: true
            },
            rank_image: {
                minlength: 2,
                maxlength: 100,
                url: true
            },
            number_cmnd: {
                minlength: 9,
                checkCMND: true
            },
            cmnd_mt: {
                extension: "png|jpg|svg|jpeg",
                accept: "image/*"
            },
            cmnd_ms: {
                extension: "png|jpg|svg|jpeg",
                accept: "image/*"
            },
            selfie_cmnd: {
                extension: "png|jpg|svg|jpeg",
                accept: "image/*"
            },
            selfie: {
                extension: "png|jpg|svg|jpeg",
                accept: "image/*"
            },
            selfie_team: {
                extension: "png|jpg|svg|jpeg",
                accept: "image/*"
            },
            video_proof: {
                minlength: 2,
                maxlength: 100,
                url: true
            },
            result:{
                required: true,
                min: 0,
                max: 2
            },
            wage: {
                required: true,
                number: true
            },
            contract:{
                required: true,
                min: 0,
                max: 1
            },
            contract_status:{
                required: true,
                min: 0,
                max: 4
            },
            active:{
                required: true,
                min: 0,
                max: 1
            },
            pass_date:{
                date: true
            },
            start_day:{
                date:true
            },
            policy:{
                required: true,
                minlength: 5,
                maxlength: 100,
                url: true
            }
        },
        messages: {
            user_id: {
                digits: 'User không hợp lệ.',
                required: 'Bạn chưa chọn user.'
            },
            app_id: {
                digits: 'Ứng dụng không hợp lệ.',
                required: 'Bạn chưa chọn ứng dụng.'
            },
            cate: {
                digits: 'Thể loại không hợp lệ.',
                required: 'Bạn chưa chọn thể loại.'
            },
            id_in_app: {
                required: 'Bạn chưa nhập ID.',
                minlength: 'ID tối thiểu 4 ký tự.',
                maxlength: 'ID tối đa 15 ký tự.'
            },
            team: {
                required: 'Bạn chưa chọn Agency.'
            },
            worked: {
                required: 'Bạn chưa chọn mục này.',
                digits: 'Lựa chọn không hợp lệ.'
            },
            talent: {
                required: 'Bạn chưa chọn tài năng.'
            },
            game: {
                minlength: 'Game tối thiểu 2 ký tự',
                maxlength: 'Game tối đa 100 ký tự.'
            },
            nickname: {
                required: 'Bạn chưa nhập mục này',
                maxlength: 'Nickname tối đa 50 ký tự.'
            },
            experience: {
                minlength: 'Các app tối thiểu 2 ký tự.',
                maxlength: 'Các app tối đa 100 ký tự.'
            },
            video_casting: {
                minlength: 'Link video tối thiểu 2 ký tự',
                maxlength: 'Link video tối đa 100 ký tự.',
                url: 'Link video không hợp lệ.'
            },
            rank_image: {
                minlength: 'Link ảnh tối thiểu 2 ký tự',
                maxlength: 'Link ảnh tối đa 100 ký tự.',
                url: 'Link ảnh không hợp lệ.'
            },
            number_cmnd: {
                minlength: 'Số CMND/CCCD 9 hoặc 12 số.'
            },
            cmnd_mt: {
                extension: 'Định dạng ảnh không đúng.'
            },
            cmnd_ms: {
                extension: 'Định dạng ảnh không đúng.'
            },
            selfie_cmnd: {
                extension: 'Định dạng ảnh không đúng.'
            },
            selfie: {
                extension: 'Định dạng ảnh không đúng.'
            },
            selfie_team: {
                extension: 'Định dạng ảnh không đúng.'
            },
            video_proof: {
                minlength: 'Link video tối thiểu 2 ký tự',
                maxlength: 'Link video tối đa 100 ký tự.',
                url: 'Link video không hợp lệ.'
            },
            result:{
                required: 'Bạn chưa chọn kết quả cast.',
                min: 'Lựa chọn không hợp lệ.',
                max: 'Lựa chọn không hợp lệ.'
            },
            wage: {
                required: 'Bạn chưa nhập mức lương.',
                number: 'Lương phải là số.'
            },
            contract:{
                required: 'Bạn chưa chọn hợp đồng.',
                min: 'Lựa chọn không hợp lệ.',
                max: 'Lựa chọn không hợp lệ.'
            },
            contract_status:{
                required: 'Bạn chưa chọn trạng thái hợp đồng.',
                min: 'Lựa chọn không hợp lệ.',
                max: 'Lựa chọn không hợp lệ.'
            },
            active:{
                required: 'Bạn chưa chọn hiệu lực live',
                min: 'Lựa chọn không hợp lệ.',
                max: 'Lựa chọn không hợp lệ.'
            },
            pass_date:{
                date: 'Định dạng ngày không hợp lệ.'
            },
            start_day:{
                date:'Định dạng ngày không hợp lệ.'
            },
            policy:{
                required: 'Bạn chưa nhập link chính sách.',
                minlength: 'Link tối thiểu 5 ký tự.',
                maxlength: 'Link tối đa 5 ký tự.',
                url: 'Link chính sách không hợp lệ.'
            }
        }
    });
})

