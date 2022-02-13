<?php
return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute phải được chấp nhận.',
    'active_url' => ':attribute không phải là một URL hợp lệ.',
    'after' => ':attribute phải là một ngày sau :date.',
    'after_or_equal' => ':attribute phải là một ngày sau hoặc bằng :date.',
    'alpha' => ':attribute chỉ có thể chứa các chữ cái.',
    'alpha_dash' => ':attribute chỉ có thể chứa các chữ cái, số, dấu gạch ngang và dấu gạch dưới.',
    'alpha_num' => ':attribute chỉ có thể chứa các chữ cái và số.',
    'array' => ':attribute phải là một mảng.',
    'before' => ':attribute phải là một ngày trước :date.',
    'before_or_equal' => ':attribute phải là một ngày trước hoặc bằng :date.',
    'between' => [
        'numeric' => ':attribute trong khoảng :min và :max.',
        'file' => ':attribute trong khoảng :min và :max kilobytes.',
        'string' => ':attribute trong khoảng :min và :max ký tự.',
        'array' => ':attribute trong khoảng :min và :max items.',
    ],
    'boolean' => ':attribute giá trị là sai hoặc đúng, 0 hoặc 1.',
    'confirmed' => ':attribute không khớp.',
    'date' => ':attribute không phải là ngày hợp lệ.',
    'date_equals' => ':attribute phải là một ngày bằng :date.',
    'date_format' => ':attribute không đúng định dạng :format.',
    'different' => ':attribute và :other phải khác nhau.',
    'digits' => ':attribute phải là :digits chữ số.',
    'digits_between' => ':attribute từ :min đến :max chữ số.',
    'dimensions' => ':attribute có kích thước hình ảnh không hợp lệ.',
    'distinct' => ':attribute có giá trị trùng lặp.',
    'email' => ':attribute không hợp lệ.',
    'ends_with' => ':attribute phải kết thúc bằng một trong các giá trị sau: :values.',
    'exists' => ':attribute đã chọn không hợp lệ.',
    'file' => ':attribute phải là một tập tin.',
    'filled' => ':attribute phải có một giá trị.',
    'gt' => [
        'numeric' => ':attribute phải lớn hơn :value.',
        'file' => ':attribute phải lớn hơn :value kilobytes.',
        'string' => ':attribute phải lớn hơn :value ký tự.',
        'array' => ':attribute phải có nhiều hơn :value items.',
    ],
    'gte' => [
        'numeric' => ':attribute phải lớn hơn hoặc bằng :value.',
        'file' => ':attribute phải lớn hơn hoặc bằng :value kilobytes.',
        'string' => ':attribute phải lớn hơn hoặc bằng :value ký tự.',
        'array' => ':attribute phải có :value items hoặc nhiều hơn.',
    ],
    'image' => ':attribute phải là hình ảnh.',
    'in' => ':attribute đã chọn không hợp lệ.',
    'in_array' => ':attribute không tồn tại trong :other.',
    'integer' => ':attribute phải là số nguyên.',
    'ip' => ':attribute phải là một địa chỉ IP hợp lệ.',
    'ipv4' => ':attribute phải là địa chỉ IPv4 hợp lệ.',
    'ipv6' => ':attribute phải là địa chỉ IPv6 hợp lệ.',
    'json' => ':attribute phải là một chuỗi JSON hợp lệ.',
    'lt' => [
        'numeric' => ':attribute phải nhỏ hơn :value.',
        'file' => ':attribute phải nhỏ hơn :value kilobytes.',
        'string' => ':attribute phải nhỏ hơn :value ký tự.',
        'array' => ':attribute phải có nhỏ hơn :value items.',
    ],
    'lte' => [
        'numeric' => ':attribute phải nhỏ hơn hoặc bằng :value.',
        'file' => ':attribute phải nhỏ hơn hoặc bằng :value kilobytes.',
        'string' => ':attribute phải nhỏ hơn hoặc bằng :value ký tự.',
        'array' => ':attribute không được lớn hơn :value items.',
    ],
    'max' => [
        'numeric' => ':attribute không được lớn hơn :max.',
        'file' => ':attribute tối đa :max kilobytes.',
        'string' => ':attribute tối đa :max ký tự.',
        'array' => ':attribute tối đa :max items.',
    ],
    'mimes' => ':attribute phải là một tệp: :values.',
    'mimetypes' => ':attribute phải là một tệp: :values.',
    'min' => [
        'numeric' => ':attribute tối thiểu :min.',
        'file' => ':attribute tối thiểu :min kilobytes.',
        'string' => ':attribute tối thiểu :min ký tự.',
        'array' => ':attribute tối thiểu :min items.',
    ],
    'multiple_of' => ':attribute phải là bội số của :value',
    'not_in' => ':attribute đã chọn không hợp lệ.',
    'not_regex' => ':attribute định dạng không hợp lệ.',
    'numeric' => ':attribute là một số.',
    'password' => 'Mật khẩu không đúng.',
    'present' => ':attribute phải có.',
    'regex' => ':attribute định dạng không hợp lệ.',
    'required' => ':attribute bắt buộc, không được để trống.',
    'required_if' => ':attribute không được để trống khi :other is :value.',
    'required_unless' => ':attribute không được để trống khi :other thuộc :values.',
    'required_with' => ':attribute không được để trống khi có giá trị :values.',
    'required_with_all' => ':attribute không được để trống khi có nhiều giá trị :values.',
    'required_without' => ':attribute không được để trống khi không có giá trị :values.',
    'required_without_all' => ':attribute không được để trống khi không có giá trị nào trong số: :values.',
    'same' => ':attribute và :other phải giống nhau.',
    'size' => [
        'numeric' => ':attribute phải là :size.',
        'file' => ':attribute phải là :size kilobytes.',
        'string' => ':attribute phải là :size ký tự.',
        'array' => ':attribute phải chứa các mục :size.',
    ],
    'starts_with' => ':attribute phải bắt đầu bằng một trong những giá trị: :values.',
    'string' => ':attribute phải là một chuỗi ký tự.',
    'timezone' => ':attribute phải là một khu vực hợp lệ.',
    'unique' => ':attribute đã được sử dụng.',
    'uploaded' => ':attribute không tải lên được.',
    'url' => ':attribute định dạng url không hợp lệ.',
    'uuid' => ':attribute phải là một UUID hợp lệ.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];

//return [
//
//    /*
//    |--------------------------------------------------------------------------
//    | Validation Language Lines
//    |--------------------------------------------------------------------------
//    |
//    | The following language lines contain the default error messages used by
//    | the validator class. Some of these rules have multiple versions such
//    | as the size rules. Feel free to tweak each of these messages here.
//    |
//    */
//
//    'accepted' => 'The :attribute must be accepted.',
//    'active_url' => 'The :attribute is not a valid URL.',
//    'after' => 'The :attribute must be a date after :date.',
//    'after_or_equal' => 'The :attribute must be a date after or equal to :date.',
//    'alpha' => 'The :attribute may only contain letters.',
//    'alpha_dash' => 'The :attribute may only contain letters, numbers, dashes and underscores.',
//    'alpha_num' => 'The :attribute may only contain letters and numbers.',
//    'array' => 'The :attribute must be an array.',
//    'before' => 'The :attribute must be a date before :date.',
//    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
//    'between' => [
//        'numeric' => 'The :attribute must be between :min and :max.',
//        'file' => 'The :attribute must be between :min and :max kilobytes.',
//        'string' => 'The :attribute must be between :min and :max characters.',
//        'array' => 'The :attribute must have between :min and :max items.',
//    ],
//    'boolean' => 'The :attribute field must be true or false.',
//    'confirmed' => 'The :attribute confirmation does not match.',
//    'date' => 'The :attribute is not a valid date.',
//    'date_equals' => 'The :attribute must be a date equal to :date.',
//    'date_format' => 'The :attribute does not match the format :format.',
//    'different' => 'The :attribute and :other must be different.',
//    'digits' => 'The :attribute must be :digits digits.',
//    'digits_between' => 'The :attribute must be between :min and :max digits.',
//    'dimensions' => 'The :attribute has invalid image dimensions.',
//    'distinct' => 'The :attribute field has a duplicate value.',
//    'email' => 'The :attribute must be a valid email address.',
//    'ends_with' => 'The :attribute must end with one of the following: :values.',
//    'exists' => 'The selected :attribute is invalid.',
//    'file' => 'The :attribute must be a file.',
//    'filled' => 'The :attribute field must have a value.',
//    'gt' => [
//        'numeric' => 'The :attribute must be greater than :value.',
//        'file' => 'The :attribute must be greater than :value kilobytes.',
//        'string' => 'The :attribute must be greater than :value characters.',
//        'array' => 'The :attribute must have more than :value items.',
//    ],
//    'gte' => [
//        'numeric' => 'The :attribute must be greater than or equal :value.',
//        'file' => 'The :attribute must be greater than or equal :value kilobytes.',
//        'string' => 'The :attribute must be greater than or equal :value characters.',
//        'array' => 'The :attribute must have :value items or more.',
//    ],
//    'image' => 'The :attribute must be an image.',
//    'in' => 'The selected :attribute is invalid.',
//    'in_array' => 'The :attribute field does not exist in :other.',
//    'integer' => 'The :attribute must be an integer.',
//    'ip' => 'The :attribute must be a valid IP address.',
//    'ipv4' => 'The :attribute must be a valid IPv4 address.',
//    'ipv6' => 'The :attribute must be a valid IPv6 address.',
//    'json' => 'The :attribute must be a valid JSON string.',
//    'lt' => [
//        'numeric' => 'The :attribute must be less than :value.',
//        'file' => 'The :attribute must be less than :value kilobytes.',
//        'string' => 'The :attribute must be less than :value characters.',
//        'array' => 'The :attribute must have less than :value items.',
//    ],
//    'lte' => [
//        'numeric' => 'The :attribute must be less than or equal :value.',
//        'file' => 'The :attribute must be less than or equal :value kilobytes.',
//        'string' => 'The :attribute must be less than or equal :value characters.',
//        'array' => 'The :attribute must not have more than :value items.',
//    ],
//    'max' => [
//        'numeric' => 'The :attribute may not be greater than :max.',
//        'file' => 'The :attribute may not be greater than :max kilobytes.',
//        'string' => 'The :attribute may not be greater than :max characters.',
//        'array' => 'The :attribute may not have more than :max items.',
//    ],
//    'mimes' => 'The :attribute must be a file of type: :values.',
//    'mimetypes' => 'The :attribute must be a file of type: :values.',
//    'min' => [
//        'numeric' => 'The :attribute must be at least :min.',
//        'file' => 'The :attribute must be at least :min kilobytes.',
//        'string' => 'The :attribute must be at least :min characters.',
//        'array' => 'The :attribute must have at least :min items.',
//    ],
//    'multiple_of' => 'The :attribute must be a multiple of :value',
//    'not_in' => 'The selected :attribute is invalid.',
//    'not_regex' => 'The :attribute format is invalid.',
//    'numeric' => 'The :attribute must be a number.',
//    'password' => 'The password is incorrect.',
//    'present' => 'The :attribute field must be present.',
//    'regex' => 'The :attribute format is invalid.',
//    'required' => 'The :attribute field is required.',
//    'required_if' => 'The :attribute field is required when :other is :value.',
//    'required_unless' => 'The :attribute field is required unless :other is in :values.',
//    'required_with' => 'The :attribute field is required when :values is present.',
//    'required_with_all' => 'The :attribute field is required when :values are present.',
//    'required_without' => 'The :attribute field is required when :values is not present.',
//    'required_without_all' => 'The :attribute field is required when none of :values are present.',
//    'same' => 'The :attribute and :other must match.',
//    'size' => [
//        'numeric' => 'The :attribute must be :size.',
//        'file' => 'The :attribute must be :size kilobytes.',
//        'string' => 'The :attribute must be :size characters.',
//        'array' => 'The :attribute must contain :size items.',
//    ],
//    'starts_with' => 'The :attribute must start with one of the following: :values.',
//    'string' => 'The :attribute must be a string.',
//    'timezone' => 'The :attribute must be a valid zone.',
//    'unique' => 'The :attribute has already been taken.',
//    'uploaded' => 'The :attribute failed to upload.',
//    'url' => 'The :attribute format is invalid.',
//    'uuid' => 'The :attribute must be a valid UUID.',
//
//    /*
//    |--------------------------------------------------------------------------
//    | Custom Validation Language Lines
//    |--------------------------------------------------------------------------
//    |
//    | Here you may specify custom validation messages for attributes using the
//    | convention "attribute.rule" to name the lines. This makes it quick to
//    | specify a specific custom language line for a given attribute rule.
//    |
//    */
//
//    'custom' => [
//        'attribute-name' => [
//            'rule-name' => 'custom-message',
//        ],
//    ],
//
//    /*
//    |--------------------------------------------------------------------------
//    | Custom Validation Attributes
//    |--------------------------------------------------------------------------
//    |
//    | The following language lines are used to swap our attribute placeholder
//    | with something more reader friendly such as "E-Mail Address" instead
//    | of "email". This simply helps us make our message more expressive.
//    |
//    */
//
//    'attributes' => [],
//
//];
