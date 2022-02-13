$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// Xoá dữ liệu nhập tìm kiếm
function resetInput() {
    $('#search-filter').find(':input').val('').trigger("change");
}

// Action
$(function () {
    // Ngày kết thúc phải lớn hơn ngày bắt đầu
    $.validator.addMethod("greaterThan", function (value, element, params) {
        if ($(params).val() !== '' || $(params).val() > new Date(value)) {
            if (!/Invalid|NaN/.test(new Date(value))) {
                return new Date(value) >= new Date($(params).val());
            }

            return isNaN(value) && isNaN($(params).val())
                || (Number(value) >= Number($(params).val()));
        } else {
            return true;
        }
    }, 'Phải lớn hơn hoặc bằng ngày bắt đầu.');

    // Ngày bắt đầu phải nhỏ hơn ngày kết thúc
    $.validator.addMethod("lessThan", function (value, element, params) {
        if ($(params).val() !== '' || $(params).val() > new Date(value)) {
            if (!/Invalid|NaN/.test(new Date(value))) {
                return new Date(value) <= new Date($(params).val());
            }

            return isNaN(value) && isNaN($(params).val())
                || (Number(value) <= Number($(params).val()));
        } else {
            return true;
        }
    }, 'Phải nhỏ hơn hoặc bằng ngày kết thúc.');

    $.validator.addMethod("nullDate", function () {
        var startDate = $('#start_date').val();
        var endDate = $('#end_date').val();
        if (startDate === '' && endDate === '') {
            return true;
        }
    });

    // Bổ sung js datatable
    let datatable = $.HSCore.components.HSDatatables.init($('#datatable'), {
        retrieve: true,
        info: {"totalQty": "#datatableWithPaginationInfoTotalQty"},
        entries: "#datatableEntries",
        isResponsive: true,
        isShowPaging: false,
        pagination: "datatablePagination",
        select: {
            style: 'multi',
            selector: 'td:first-child input[type="checkbox"]',
            classMap: {
                checkAll: '#datatableCheckAll',
                counter: '#datatableCounter',
                counterInfo: '#datatableCounterInfo'
            }
        }
    });

    // Nếu checkbox all đang chọn khi chuyển trang thì uncheck
    datatable.on('draw', function () {
        $('#datatableCheckAll').prop('checked', false);
        $('#datatableCounterInfo').css('display', 'none');
    });

    $('.apply').click(function () {
        $('#datatable').DataTable().ajax.reload();
    });

    $('#reset').click(function (event) {
        event.preventDefault();
        resetInput();
        $('#datatable').DataTable().ajax.reload();
    });

    // Tìm kiếm
    $('#datatableSearch').on('input', function () {
        clearTimeout(this.delay);
        this.delay = setTimeout(function () {
            $(this).trigger('search');
        }.bind(this), 1000);
    }).on('search', function () {
        $('#datatable').DataTable().ajax.reload();
    });

    // XUẤT DATA BẢNG
    $('#export-copy').click(function () {
        datatable.button('.buttons-copy').trigger()
    });

    $('#export-excel').click(function () {
        datatable.button('.buttons-excel').trigger()
    });

    $('#export-csv').click(function () {
        datatable.button('.buttons-csv').trigger()
    });

    $('#export-pdf').click(function () {
        datatable.button('.buttons-pdf').trigger()
    });

    $('#export-print').click(function () {
        datatable.button('.buttons-print').trigger()
    });
    // END XUẤT DATA BẢNG

    // Ẩn hiện column
    // =======================================================
    $('#col2').change(function (e) {
        datatable.columns(2).visible(e.target.checked)
    })

    $('#col3').change(function (e) {
        datatable.columns(3).visible(e.target.checked)
    })

    $('#col4').change(function (e) {
        datatable.columns(4).visible(e.target.checked)
    })

    $('#col5').change(function (e) {
        datatable.columns(5).visible(e.target.checked)
    })

    $('#col6').change(function (e) {
        datatable.columns(6).visible(e.target.checked)
    })

    $('#col7').change(function (e) {
        datatable.columns(7).visible(e.target.checked)
    })

    $('#col8').change(function (e) {
        datatable.columns(8).visible(e.target.checked)
    })

    $('#col9').change(function (e) {
        datatable.columns(9).visible(e.target.checked)
    })

    $('#col10').change(function (e) {
        datatable.columns(10).visible(e.target.checked)
    })

    $('#col11').change(function (e) {
        datatable.columns(11).visible(e.target.checked)
    })

    $('#col12').change(function (e) {
        datatable.columns(12).visible(e.target.checked)
    })

    $('#col13').change(function (e) {
        datatable.columns(13).visible(e.target.checked)
    })
    // END UNFOLD COLUMN
    // =======================================================
});

// Khởi tạo danh sách list view
// function table(url, pageLength, column) {
//     let datatable = $.HSCore.components.HSDatatables.init($('#datatable'), {
//         processing: true,
//         serverSide: true,
//         autoWidth: false,
//         pageLength: pageLength,
//         deferRender: true,
//         // stateSave: true,
//         info: {"totalQty": "#datatableWithPaginationInfoTotalQty"},
//         searching: false,
//         entries: "#datatableEntries",
//         isResponsive: true,
//         isShowPaging: false,
//         pagination: "datatablePagination",
//         order: [],
//         ajax: {
//             url: url,
//             dataType: 'json',
//             data: function (d) {
//                 d.filter1 = $('#filter1').val();
//                 d.filter2 = $('#filter2').val();
//                 d.filter3 = $('#filter3').val();
//                 d.start_date = $('#start_date').val();
//                 d.end_date = $('#end_date').val();
//                 d.datatableSearch = $('#datatableSearch').val();
//             },
//             error: function (data) {
//                 let errors = data.responseJSON;
//                 let errorsHtml = '';
//                 $.each(errors, function (key, value) {
//                     errorsHtml += '<li>' + value[0] + '</li>';
//                 });
//                 toastr.error(errorsHtml, "Tìm kiếm lỗi!");
//                 Swal.fire('Error!', errorsHtml, 'error');
//                 resetInput();
//                 $('#datatable_processing').hide();
//             }
//         },
//         columns: column,
//         language: {
//             zeroRecords: '<div class="text-center p-4">' +
//                 '<img class="mb-3" src="/assets/svg/illustrations/sorry.svg" alt="Image Description" style="width: 7rem;">' +
//                 '<p class="mb-0">No data to show</p>' +
//                 '</div>',
//             processing: '<div class="text-center p-4"><img class="mb-3" src="/assets/images/load.gif" alt="Image Description" ></div>',
//             LoadingRecords: '<div class="text-center p-4"><img class="mb-3" src="/assets/images/load.gif" alt="Image Description" style="width: 7rem;"></div>'
//         },
//         select: {
//             style: 'multi',
//             selector: 'td:first-child input[type="checkbox"]',
//             classMap: {
//                 checkAll: '#datatableCheckAll',
//                 counter: '#datatableCounter',
//                 counterInfo: '#datatableCounterInfo'
//             }
//         },
//         // dom: 'Bfrtip',
//         // buttons: [
//         //     {
//         //         extend: 'copy',
//         //         className: 'd-none',
//         //         exportOptions: {
//         //             columns: [0, ':visible']
//         //         }
//         //     },
//         //     {
//         //         extend: 'excelHtml5',
//         //         className: 'd-none',
//         //         exportOptions: {
//         //             columns: [0, ':visible']
//         //         }
//         //     },
//         //     {
//         //         extend: 'csv',
//         //         className: 'd-none',
//         //         exportOptions: {
//         //             columns: [0, ':visible']
//         //         }
//         //     },
//         //     {
//         //         extend: 'pdfHtml5',
//         //         className: 'd-none',
//         //         exportOptions: {
//         //             columns: [0, ':visible']
//         //         }
//         //     },
//         //     {
//         //         extend: 'print',
//         //         className: 'd-none',
//         //         exportOptions: {
//         //             columns: [0, ':visible']
//         //         }
//         //     },
//         // ],
//     });
//
//     // Tìm kiếm
//     $('#datatableSearch').on('input', function () {
//         clearTimeout(this.delay);
//         this.delay = setTimeout(function () {
//             $(this).trigger('search');
//         }.bind(this), 1000);
//     }).on('search', function () {
//         datatable.draw();
//     });
//
//     // XUẤT DATA BẢNG
//     $('#export-copy').click(function () {
//
//         var query = {
//             filter1: $('#filter1').val(),
//             filter2: $('#filter2').val(),
//             filter3: $('#filter3').val(),
//             start_date: $('#start_date').val(),
//             end_date: $('#end_date').val(),
//             datatableSearch: $('#datatableSearch').val()
//         }
//         window.open("export/news?" + $.param(query), '_blank') ;
//     });
//
//     $('#export-excel').click(function () {
//         datatable.button('.buttons-excel').trigger()
//     });
//
//     $('#export-csv').click(function () {
//         datatable.button('.buttons-csv').trigger()
//     });
//
//     $('#export-pdf').click(function () {
//         datatable.button('.buttons-pdf').trigger()
//     });
//
//     $('#export-print').click(function () {
//         datatable.button('.buttons-print').trigger()
//     });
//     // END XUẤT DATA BẢNG
//
//     // Ẩn hiện column
//     // =======================================================
//     $('#col1').change(function (e) {
//         datatable.columns(1).visible(e.target.checked)
//     })
//
//     $('#col2').change(function (e) {
//         datatable.columns(2).visible(e.target.checked)
//     })
//
//     $('#col3').change(function (e) {
//         datatable.columns(3).visible(e.target.checked)
//     })
//
//     $('#col4').change(function (e) {
//         datatable.columns(4).visible(e.target.checked)
//     })
//
//     $('#col5').change(function (e) {
//         datatable.columns(5).visible(e.target.checked)
//     })
//
//     $('#col6').change(function (e) {
//         datatable.columns(6).visible(e.target.checked)
//     })
//
//     $('#col7').change(function (e) {
//         datatable.columns(7).visible(e.target.checked)
//     })
//
//     $('#col8').change(function (e) {
//         datatable.columns(8).visible(e.target.checked)
//     })
//
//     $('#col9').change(function (e) {
//         datatable.columns(9).visible(e.target.checked)
//     })
//
//     $('#col10').change(function (e) {
//         datatable.columns(10).visible(e.target.checked)
//     })
//
//     $('#col11').change(function (e) {
//         datatable.columns(11).visible(e.target.checked)
//     })
//
//     $('#col12').change(function (e) {
//         datatable.columns(12).visible(e.target.checked)
//     })
//     // END UNFOLD COLUMN
//     // =======================================================
// }

// Thay đổi trạng thái status sang block
function active_status(id, url, object) {
    Swal.fire({
        title: 'Are you sure?',
        text: "Thao tác sẽ kích hoạt lại " + object + "!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, active it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url + id,
                type: 'POST',
                datatype: 'JSON',
                data: {id: id},
                success: function (data) {
                    if (data.code === 200) {
                        $('#datatable').DataTable().ajax.reload();
                        toastr.success(object + ' unlock thành công', 'Kích hoạt');
                        Swal.fire(
                            'Active!',
                            object + ' đã được kích hoạt thành công',
                            'success'
                        )
                    }
                },
                error: function (data) {
                    toastr.error('Kích hoạt lỗi vui lòng thử lại', 'Error!');
                    Swal.fire(
                        'Error!',
                        'Kích hoạt lỗi vui lòng thử lại',
                        'error'
                    )
                }
            })
        }
    })
}

// Thay đổi trạng thái status sang unlock
function deactive_status(id, url, object) {
    Swal.fire({
        title: 'Are you sure?',
        text: "Thao tác sẽ vô hiệu hoá " + object + "!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, block it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url + id,
                type: 'POST',
                datatype: 'JSON',
                data: {id: id},
                success: function (data) {
                    if (data.code === 200) {
                        $('#datatable').DataTable().ajax.reload();
                        toastr.success(object + ' vô hiệu hoá thành công', ' Vô hiệu hoá!');
                        Swal.fire(
                            'Block!',
                            object + ' vô hiệu hoá thành công',
                            'success'
                        )
                    }
                },
                error: function (data) {
                    toastr.error('Vô hiệu hoá lỗi vui lòng thử lại', 'Error!');
                    Swal.fire(
                        'Error!',
                        'Vô hiệu hoá lỗi vui lòng thử lại',
                        'error'
                    )
                }
            })
        }
    })
}

// Xoá 1 bản ghi
$(document).on('click', '.action_delete', function (event) {
    event.preventDefault();
    let url = $(this).data('url');

    Swal.fire({
        title: 'Are you sure?',
        text: "Bạn sẽ không thể khôi phục sau khi xoá!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#datatable_processing').show();
            toastr.info('Đang xoá, vui lòng chờ.', 'Deleted!');
            $.ajax({
                type: 'DELETE',
                datatype: 'JSON',
                url: url,
                success: function (data) {
                    if (data.code === 200) {
                        $('#datatable').DataTable().ajax.reload();
                        toastr.success('Xoá thành công.', 'Deleted!');
                        Swal.fire(
                            'Deleted!',
                            'Xoá thành công.',
                            'success'
                        )
                    }
                },
                error: function (data) {
                    $('#datatable_processing').hide();
                    toastr.error('Xoá lỗi vui lòng thử lại', 'Error!');
                    Swal.fire(
                        'Error!',
                        'Xoá lỗi vui lòng thử lại',
                        'error'
                    )
                }
            })
        }
    })
});

// Xoá nhiều bản ghi
function deleteAll(idsArr, url, object) {
    if (idsArr.length <= 0) {
        alert("Bạn chưa chọn dữ liệu để xoá");
    } else {
        Swal.fire({
            title: 'Are you sure?',
            text: "Bạn đang thực hiện xoá nhiều " + object + " cùng lúc!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#datatable_processing').show();
                toastr.info('Đang xoá, vui lòng chờ.', 'Deleted!');
                let strIds = idsArr.join(",");
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    datatype: 'JSON',
                    data: 'ids=' + strIds,
                    success: function (data) {
                        if (data.code === 200) {
                            $('#datatable').DataTable().ajax.reload();
                            $('#datatableCheckAll').prop('checked', false); // Bỏ chọn checkbox all
                            $('#datatableCounterInfo').css('display', 'none'); // Ẩn bộ đếm chọn
                            toastr.success(object + ' đã chọn được xoá thành công.', 'Deleted multiple!')
                            Swal.fire(
                                'Deleted!',
                                object + ' đã chọn được xoá thành công.',
                                'success'
                            )
                        }
                    },
                    error: function (data) {
                        $('#datatable_processing').hide();
                        toastr.error('Xoá lỗi vui lòng thử lại', 'Error!');
                        Swal.fire(
                            'Error!',
                            'Xoá lỗi vui lòng thử lại',
                            'error'
                        )
                    }
                })
            }
        })
    }
}





