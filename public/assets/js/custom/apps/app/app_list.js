$(function () {
    $('body').on('click', '.active_status', function (event) {
        event.preventDefault();
        let id = $(this).data('id');
        active_status(id, 'app/active/', 'Ứng dụng')
    });

    $('body').on('click', '.deactive_status', function (event) {
        event.preventDefault();
        let id = $(this).data('id');
        deactive_status(id, 'app/deactive/', 'Ứng dụng')
    });

    // Thay đổi trạng thái status sang block
    $('body').on('click', '.active_status_cate', function (event) {
        event.preventDefault();
        let id = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "Thao tác sẽ kích hoạt lại thể loại ứng dụng!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, active it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'app/active/' + id,
                    type: 'POST',
                    datatype: 'JSON',
                    data: {id: id},
                    success: function (data) {
                        if (data.code === 200) {
                            let timerInterval;
                            toastr.success('Unlock thành công Thể loại ứng dụng', 'Kích hoạt');
                            Swal.fire({
                                title: 'Active!',
                                text: 'Kích hoạt thành công Thể loại ứng dụng',
                                icon: 'success',
                                timer: 6000,
                                timerProgressBar: true,
                                html: 'Kích hoạt thành công Thể loại ứng dụng, <br/><br/> ' +
                                    'Tự động tải lại trang sau <strong style="color: red"></strong> giây.<br/><br/>',
                                didOpen: () => {
                                    Swal.showLoading()
                                    timerInterval = setInterval(() => {
                                        Swal.getHtmlContainer().querySelector('strong')
                                            .textContent = (Swal.getTimerLeft() / 1000)
                                            .toFixed(0)
                                    }, 1000)
                                },
                                willClose: () => {
                                    clearInterval(timerInterval)
                                },
                            }).then(function () {
                                    location.reload();
                                }
                            );
                        } else {
                            toastr.error('Kích hoạt lỗi vui lòng thử lại', 'Error!');
                            Swal.fire(
                                'Error!',
                                'Kích hoạt lỗi vui lòng thử lại',
                                'error'
                            )
                        }
                    }
                })
            }
        })
    });

    // Thay đổi trạng thái status sang unlock
    $('body').on('click', '.deactive_status_cate', function (event) {
        event.preventDefault();
        let id = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "Thao tác sẽ vô hiệu hoá thể loại ứng dụng!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Disable it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'app/deactive/' + id,
                    type: 'POST',
                    datatype: 'JSON',
                    data: {id: id},
                    success: function (data) {
                        if (data.code === 200) {
                            let timerInterval;
                            toastr.success('Vô hiệu hoá thành công thể loại ứng dụng', ' Vô hiệu hoá!');
                            Swal.fire({
                                title: 'Block!',
                                icon: 'success',
                                timer: 6000,
                                timerProgressBar: true,
                                html: 'Vô hiệu hoá thành công Thể loại ứng dụng, <br/><br/> Tự động tải lại trang sau <strong style="color: red"></strong> giây.',
                                didOpen: () => {
                                    Swal.showLoading()

                                    timerInterval = setInterval(() => {
                                        Swal.getHtmlContainer().querySelector('strong')
                                            .textContent = (Swal.getTimerLeft() / 1000)
                                            .toFixed(0)
                                    }, 1000)
                                },
                                willClose: () => {
                                    clearInterval(timerInterval)
                                }
                            }).then(function () {
                                    location.reload();
                                }
                            );
                        } else {
                            toastr.error('Vô hiệu hoá lỗi vui lòng thử lại', 'Error!');
                            Swal.fire(
                                'Error!',
                                'Vô hiệu hoá lỗi vui lòng thử lại',
                                'error'
                            )
                        }
                    }
                })
            }
        })
    });

    $('body').on('click', '.deleteAll', function (event) {
        event.preventDefault();
        let idsArr = [];
        $(".checkbox:checked").each(function () {
            idsArr.push($(this).attr('id'));
        });
        deleteAll(idsArr, 'app/delete/', 'Ứng dụng')
    });

    // Show Warning Delete
    $('body').on('click', '.showDelete', function () {
        toastr.warning('Vui lòng xoá ứng dụng trước.', 'Warning!');
        Swal.fire(
            'Warning!',
            'Vui lòng xoá ứng dụng trước.',
            'warning'
        )
    });
});
